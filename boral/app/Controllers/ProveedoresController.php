<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProveedorModel;
use App\Models\Producto_compraModel;

use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProveedoresController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new ProveedorModel();
        $data['proveedores']=$model->findAll();
        
        return view('proveedoresListView',$data);
    }
    
    public function nuevo()
    {
        return view('proveedoresNewView');
    }
    
    
   public function crear()
{
    $razon_social = $this->request->getVar('razon_social');
    
    
    // Definir las reglas de validación
    $rules = [
        'razon_social' => [
            'rules' => 'permit_empty|required_without[nombre,apellidos]' . (empty($razon_social) ? '' : '|is_unique[proveedores.razon_social]'),
            'errors' => [
                'required_without' => 'Introduce una razón social si no proporcionas nombre y apellidos',
                'is_unique' => 'La razón social ya está registrada',
            ],
        ],
        'nombre' => [
            'rules' => 'permit_empty|required_with[apellidos]|alpha_space',
            'errors' => [
                'required_with' => 'Debes introducir un nombre',
                'alpha_space' => 'El nombre solo puede tener letras y espacios',
            ],
        ],
        'apellidos' => [
            'rules' => 'permit_empty|required_with[nombre]|alpha_space',
            'errors' => [
                'required_with' => 'Debes introducir apellidos',
                'alpha_space' => 'El apellido solo puede tener letras y espacios',
            ],
        ],
        'telefono' => [
            'rules' => 'required|is_unique[proveedores.telefono]|regex_match[/^[0-9]{9}$/]|validar_telefono[proveedores.telefono]',
            'errors' => [
                'required' => 'Debes introducir un telefono',
                'is_unique' => 'Ese telefono ya esta registrado',
                'regex_match' => 'El teléfono debe tener exactamente 9 dígitos',
                'validar_telefono' => 'Telefono inválido, debe comenzar con 6, 7 o 9',
            ],
        ],
        'cif_nif_nie' => [
            'rules' => 'required|is_unique[proveedores.cif_nif_nie]|validar_cif_nif_nie',
            'errors' => [
                'required' => 'Debes introducir un cif/nie',
                'is_unique' => 'Este cif/nie ya existe',
                'validar_cif_nif_nie' => 'Cif/nie invalido',
            ],
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[proveedores.email]',
            'errors' => [
                'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
            ],
        ],
        'direccion' => [
            'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/]',
            'errors' => [
                'required' => 'La direccion es obligatoria',
                'regex_match' => 'La direccion solo puede tener letras y espacios',
               
            ],
        ],
    ];
       
    

    // Obtener los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Validar los datos con las reglas definidas
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput();
    }
        $model=new ProveedorModel();
        $razon_social=$this->request->getvar('razon_social');
        $nombre=$this->request->getvar('nombre');
        $apellidos=$this->request->getvar('apellidos');
        $telefono=$this->request->getvar('telefono');
        $cif_nif_nie=$this->request->getvar('cif_nif_nie');
        $email=$this->request->getvar('email');
        $direccion=$this->request->getvar('direccion');
        $latitud=$this->request->getvar('latitud');
        $longitud=$this->request->getvar('longitud');
         
        $newData = [
            'razon_social' => $razon_social,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'telefono' => $telefono,
            'cif_nif_nie' => $cif_nif_nie,
            'email' => $email,
            'direccion' => $direccion,
            'latitud' => $latitud,
            'longitud' => $longitud,

        ];

         
         $model->save($newData);
         
         
          return redirect()->to('/proveedores');
}

    
    public function editar()
    {
        $model=new ProveedorModel();
        $id=$this->request->getvar('id');
        
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('proveedoresEditView',$data);
    }
    
    public function actualizar()
{
    $id = $this->request->getVar('id');
    $razon_social = $this->request->getVar('razon_social');
 
    $model = new ProveedorModel();

  
    $rules = [
        'razon_social' => [
            'rules' => 'permit_empty|required_without[nombre,apellidos]' . (empty($razon_social) ? '' : '|is_unique[proveedores.razon_social,id,'.$id.']'),
            'errors' => [
                'is_unique' => 'La razón social ya está registrada',
                'required_without' => 'La razón social es obligatoria si no se proporcionan nombre o apellidos',
            ],
        ],
        'nombre' => [
            'rules' => 'permit_empty|required_with[apellidos]|alpha_space',
            'errors' => [
                'required_with' => 'Debes introducir un nombre',
                'alpha_space' => 'El nombre solo puede tener letras y espacios',
            ],
        ],
        'apellidos' => [
            'rules' => 'permit_empty|required_with[nombre]|alpha_space',
            'errors' => [
                'required_with' => 'Debes introducir apellidos',
                'alpha_space' => 'El apellido solo puede tener letras y espacios',
            ],
        ],
        'telefono' => [
            'rules' => 'required|is_unique[proveedores.telefono,id,'.$id.']|regex_match[/^[0-9]{9}$/]|validar_telefono[proveedores.telefono]',
            'errors' => [
                'required' => 'Debes introducir un telefono',
                'is_unique' => 'Ese telefono ya esta registrado',
                'regex_match' => 'El teléfono debe tener 9 dígitos',
                'validar_telefono' => 'Telefono inválido, debe comenzar con un 6, 7 o 9',

            ],
        ],
        'cif_nif_nie' => [
            'rules' => 'required|validar_cif_nif_nie|is_unique[proveedores.cif_nif_nie,id,'.$id.']',
            'errors' => [
                'required' => 'Debes introducir un cif/nie',
                'is_unique' => 'Este cif/nie ya existe',
                'validar_cif_nif_nie' => 'Cif/nie inválido',
            ],
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[proveedores.email,id,'.$id.']',
            'errors' => [
                'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
            ],
        ],
        'direccion' => [
            'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/]',
            'errors' => [
                'required' => 'La direccion es obligatoria',
                'regex_match' => 'La direccion solo puede tener letras y espacios',
               
            ],
        ],
    ];

    // Obtener los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Validación del formulario
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Obtener los nuevos valores del formulario
   $razon_social=$this->request->getvar('razon_social');
        $nombre=$this->request->getvar('nombre');
        $apellidos=$this->request->getvar('apellidos');
        $telefono=$this->request->getvar('telefono');
        $cif_nif_nie=$this->request->getvar('cif_nif_nie');
        $email=$this->request->getvar('email');
        $direccion=$this->request->getvar('direccion');
        $latitud=$this->request->getvar('latitud');
        $longitud=$this->request->getvar('longitud');

    // Actualizar los datos en la base de datos
    $model->where('id', $id)
        ->set([
            'razon_social' => $razon_social,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'telefono' => $telefono,
            'cif_nif_nie' => $cif_nif_nie,
            'email' => $email,
            'direccion' => $direccion,
            'latitud' => $latitud,
            'longitud' => $longitud,
        ])
        ->update();

    // Redirigir a la lista de proveedores
    return redirect()->to('/proveedores');
}

   
    
     public function delete()
    {
         $model=new ProveedorModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
    }
    
     public function volver()
    {
        return redirect()->to('/proveedores');
    }
    
    public function exportar()
    {
       $model = new ProveedorModel();
    $proveedores = $model->findAll();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Ruta del logo
    $logoPath = './templates/assets/images/boral.png';

    // Insertar Logo
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo Boral');
    $drawing->setPath($logoPath);
    $drawing->setHeight(80);
    $drawing->setCoordinates('A1');
    $drawing->setWorksheet($sheet);

    // Título centrado
    $sheet->mergeCells('A2:H2');
    $sheet->setCellValue('A2', 'BORAL - LISTADO DE PROVEEDORES');
    $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getRowDimension('1')->setRowHeight(60);
    $sheet->getRowDimension('2')->setRowHeight(30);
    $sheet->getRowDimension('3')->setRowHeight(15);

    // Cabecera tabla
    $sheet->setCellValue('A4', 'Id');
    $sheet->setCellValue('B4', 'Razón Social');
    $sheet->setCellValue('C4', 'Nombre');
    $sheet->setCellValue('D4', 'Apellidos');
    $sheet->setCellValue('E4', 'CIF/NIF/NIE');
    $sheet->setCellValue('F4', 'Teléfono');
    $sheet->setCellValue('G4', 'Email');
    $sheet->setCellValue('H4', 'Dirección');

    // Estilo cabecera
    $styleHeader = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '007bff']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]], 
    ];
    $sheet->getStyle('A4:H4')->applyFromArray($styleHeader);

    $count = 5;
    foreach ($proveedores as $proveedor) {
        $sheet->setCellValue('A' . $count, $proveedor['id']);
        $sheet->setCellValue('B' . $count, $proveedor['razon_social']);
        $sheet->setCellValue('C' . $count, $proveedor['nombre']);
        $sheet->setCellValue('D' . $count, $proveedor['apellidos']);
        $sheet->setCellValue('E' . $count, $proveedor['cif_nif_nie']);
        $sheet->setCellValue('F' . $count, $proveedor['telefono']);
        $sheet->setCellValue('G' . $count, $proveedor['email']);
        $sheet->setCellValue('H' . $count, $proveedor['direccion']);
        $count++;
    }

    // Ajustar columnas
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Bordes para la tabla
    $styleTableBorders = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ];

    $ultimaFila = $count - 1;
    $sheet->getStyle("A4:H{$ultimaFila}")->applyFromArray($styleTableBorders);

    // Footer con fecha
    date_default_timezone_set('Europe/Madrid');
    $fecha = date('d/m/Y H:i');
    $filaFooter = $count + 2;
    $sheet->mergeCells("A{$filaFooter}:H{$filaFooter}");
    $sheet->setCellValue("A{$filaFooter}", "Exportado el {$fecha}");
    $sheet->getStyle("A{$filaFooter}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $filaFooter2 = $filaFooter + 1;
    $sheet->mergeCells("A{$filaFooter2}:H{$filaFooter2}");
    $sheet->setCellValue("A{$filaFooter2}", "Todos los derechos reservados Boral ©");
    $sheet->getStyle("A{$filaFooter2}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Guardar Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'proveedores.xlsx';
    $writer->save($fileName);

    // Descargar correctamente
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate");
    header("Content-Length: " . filesize($fileName));
    ob_clean();
    flush();
    readfile($fileName);
    exit;
        
            
    }
    
    
    
    
    public function exportarPDF()
{
    // Obtener los proveedores
    $model = new ProveedorModel();
    $proveedores = $model->findAll();  // Usamos el modelo para obtener los proveedores

    // Preparar los datos para la vista
    $data["proveedores"] = $proveedores;
    $data["titulo"] = "BORAL - LISTADO DE PROVEEDORES";

    // Vista para mostrar los datos (como un HTML)
    $html = view('proveedores_pdfView', $data);

    // Configuración Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true); // Permitir imágenes remotas
    $dompdf = new Dompdf($options);

    // Cargar el HTML de la vista
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Mostrar el PDF en el navegador sin descargar
    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'inline; filename="proveedores.pdf"')
        ->setBody($dompdf->output());
}

    
    public function imprimir()
    {
        ini_set('memory_limit', '1024M'); 

        $model = new ProveedorModel();
        $id=$this->request->getvar('id');
        
        $proveedor=$model->where('id',$id)->first();

        $data["datosEncabezado"] = "Datos " . $proveedor["razon_social"];
        $data["razon_social"] = $proveedor["razon_social"];
        $data["nombre"] = $proveedor["nombre"];
        $data["apellidos"] = $proveedor["apellidos"];
        $data["cif_nif_nie"] = $proveedor["cif_nif_nie"];
        $data["telefono"] = $proveedor["telefono"];
        $data["email"] = $proveedor["email"];
        $data["direccion"] = $proveedor["direccion"];
        $data["id"] = $proveedor["id"];
        

        $modelProducto = new Producto_compraModel();
        $data['productos'] = $modelProducto->productosPorProveedor($id);

        // Vista normal de CodeIgniter
        $html = view('printProveedorView', $data);

        // Configuración Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Permitir imágenes remotas

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Mostrar en navegador sin descargar
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="proveedores.pdf"')
            ->setBody($dompdf->output());
    }
}
