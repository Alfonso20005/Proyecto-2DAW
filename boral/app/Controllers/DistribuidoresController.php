<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DistribuidorModel;
use App\Models\PedidoModel;
use App\Models\UsuarioModel;

use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DistribuidoresController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new DistribuidorModel();
        if(session()->get('role')=="Distribuidor"){
            $data['distribuidores']= array();
            $data['distribuidores'][0]=$model->where('id_usuarios',session()->get('id'))->first();
        }else{
            $data['distribuidores']=$model->findAll();
        }
//        var_dump($data['distribuidores']);
        return view('distribuidoresListView',$data);
    }
    
    public function nuevo()
    {
         $options=array();
        $options['']="Selecciona un usuario";
        
        $usuario=new UsuarioModel();
        $usuarios=$usuario->encontrarUserDistribuidor();
        foreach($usuarios as $user){
                $options[$user["id"]]=$user["usuario"];
        }
        $data["optionsUsuarios"]=$options;
        return view('distribuidoresNewView',$data);
    }
    
    
   public function crear()
{
    $razon_social = $this->request->getVar('razon_social');
    
    //Verifico si el checkbox esta activado
    $crear_usuario = $this->request->getVar('crear_usuario');
    
    // Definir las reglas de validación
    $rules = [
        'razon_social' => [
            'rules' => 'permit_empty|required_without[nombre,apellidos]' . (empty($razon_social) ? '' : '|is_unique[distribuidores.razon_social]'),
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
            'rules' => 'required|is_unique[distribuidores.telefono]|regex_match[/^[0-9]{9}$/]|validar_telefono[distribuidores.telefono]',
            'errors' => [
                'required' => 'Debes introducir un telefono',
                'is_unique' => 'Ese telefono ya esta registrado',
                'regex_match' => 'El teléfono debe tener exactamente 9 dígitos',
                'validar_telefono' => 'Telefono inválido, debe comenzar con 6, 7 o 9',
            ],
        ],
        'cif_nif_nie' => [
            'rules' => 'required|is_unique[distribuidores.cif_nif_nie]|validar_cif_nif_nie',
            'errors' => [
                'required' => 'Debes introducir un cif/nie',
                'is_unique' => 'Este cif/nie ya existe',
                'validar_cif_nif_nie' => 'Cif/nie invalido',
            ],
        ],
    ];
       
       // Si el checkbox "Crear usuario" no está marcado, agregar validación para el campo de usuario
    if (!$crear_usuario) {
        $rules['id_usuarios'] = [
            'rules' => 'required',
            'errors' => [
                'required' => 'El usuario es obligatorio cuando no se está creando un nuevo usuario',
            ],
        ];
    }

    // Si el checkbox "Crear usuario" está marcado, agregar las validaciones del usuario
    if ($crear_usuario) {
        // Validaciones para usuario, contraseña y email solo si el checkbox está marcado
        $rules['usuario'] = [
            'rules' => 'required|min_length[3]|is_unique[usuarios.usuario]',
            'errors' => [
                'required' => 'El nombre de usuario es obligatorio',
                'min_length' => 'El nombre de usuario debe tener al menos 3 caracteres',
                'is_unique' => 'Este nombre de usuario ya está registrado',
            ],
        ];
        $rules['email'] = [
            'rules' => 'required|valid_email|is_unique[usuarios.email]',
            'errors' => [
                'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
            ],
        ];
        $rules['password'] = [
            'rules' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
            'errors' => [
                'required' => 'Debes introducir una contraseña',
                'min_length' => 'La contraseña debe tener al menos 6 caracteres',
                'regex_match' => 'Debe tener una letra minúscula, una letra mayúscula, un número y un símbolo especial',
            ],
        ];
        $rules['repetir_password'] = [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Debes repetir la contraseña',
                'matches' => 'Las contraseñas no coinciden',
            ],
        ];
    }

    // Obtener los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Validar los datos con las reglas definidas
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput();
    }

    // Crear el modelo de distribuidor
    $distribuidorModel = new DistribuidorModel();

    // Si el checkbox "Crear usuario" está marcado
    if ($crear_usuario) {
        // Insertar el usuario si el checkbox está marcado
        $usuarioModel = new UsuarioModel();
        $usuarioData = [
            'usuario' => $this->request->getVar('usuario'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'email' => $this->request->getVar('email'),
            'imagen'=>"public/uploads/generica.png",
            'id_roles' => 3, // Asignar rol por defecto
        ];
        $usuarioModel->save($usuarioData);

        // Obtener el ID del usuario recién insertado
        $id_usuario = $usuarioModel->getInsertID();

        // Insertar el distribuidor
        $distribuidorData = [
            'razon_social' => $this->request->getVar('razon_social'),
            'nombre' => $this->request->getVar('nombre'),
            'apellidos' => $this->request->getVar('apellidos'),
            'cif_nif_nie' => $this->request->getVar('cif_nif_nie'),
            'telefono' => $this->request->getVar('telefono'),
            'id_usuarios' => $id_usuario, // Relacionar distribuidor con el usuario
        ];
    } else {
        // Si no se marca el checkbox, solo insertamos el distribuidor
        $distribuidorData = [
            'razon_social' => $this->request->getVar('razon_social'),
            'nombre' => $this->request->getVar('nombre'),
            'apellidos' => $this->request->getVar('apellidos'),
            'cif_nif_nie' => $this->request->getVar('cif_nif_nie'),
            'telefono' => $this->request->getVar('telefono'),
            'id_usuarios' => $this->request->getVar('id_usuarios'), // Usar el id de usuario seleccionado
        ];
        
        //SI EL USUARIO YA ESTA CREADO PERO NO TIENE ROL DE DISTRIBUIDOR, AL CREARLO LE ACTUALIZAMOS EL ROLE
        $usuarioModel = new UsuarioModel();
        
        $usuarioModel->where('id', $this->request->getVar('id_usuarios'))
        ->set([
           'id_roles' => 3,
        ])
        ->update();
    }

    // Guardar el distribuidor
    $distribuidorModel->save($distribuidorData);

    // Redirigir a la lista de distribuidores
    return redirect()->to('/distribuidores');
}

    
    public function editar()
    {
        $model=new DistribuidorModel();
        $id=$this->request->getvar('id');

        $userRole = session()->get('role'); 
        $userIdIncioSesion = session()->get('id');

        $distribuidorLogueado = $model->where('id_usuarios', $userIdIncioSesion)->first();
        $distribuidor = $model->where('id', $id)->first(); 
        

        if ($distribuidor['id_usuarios'] != $userIdIncioSesion && !in_array($userRole, ['Administrador', 'SuperAdmin'])) {
            return redirect()->to('/distribuidores');
        }

        
        $id_usuarios = $distribuidor['id_usuarios'];
         $options=array();
        $options['']="Selecciona un usuario";
        
        $modelUsuario=new UsuarioModel();
        $usuarios=$modelUsuario->encontrarUserDistribuidor1($id_usuarios);
        foreach($usuarios as $user){
                $options[$user["id"]]=$user["usuario"];
        }
        
        $data["optionsUsuarios"]=$options;
        
        $data["datos"] = $distribuidor;
        
        return view('distribuidoresEditView',$data);
    }
    
    public function actualizar()
{
    $id = $this->request->getVar('id');
    $razon_social = $this->request->getVar('razon_social');
 
    $model = new DistribuidorModel();
    $distribuidor = $model->find($id);

        
    // Si user no es distribuidor, permito la validación de id_usuarios
    $id_usuarios_rules = (session()->get('role') !== 'Distribuidor') 
        ? 'required' 
        : 'permit_empty';
  
    $rules = [
        'razon_social' => [
            'rules' => 'permit_empty|required_without[nombre,apellidos]' . (empty($razon_social) ? '' : '|is_unique[distribuidores.razon_social,id,'.$id.']'),
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
            'rules' => 'required|is_unique[distribuidores.telefono,id,'.$id.']|regex_match[/^[0-9]{9}$/]|validar_telefono[distribuidores.telefono]',
            'errors' => [
                'required' => 'Debes introducir un telefono',
                'is_unique' => 'Ese telefono ya esta registrado',
                'regex_match' => 'El teléfono debe tener 9 dígitos',
                'validar_telefono' => 'Telefono inválido, debe comenzar con un 6, 7 o 9',

            ],
        ],
        'cif_nif_nie' => [
            'rules' => 'required|validar_cif_nif_nie|is_unique[distribuidores.cif_nif_nie,id,'.$id.']',
            'errors' => [
                'required' => 'Debes introducir un cif/nie',
                'is_unique' => 'Este cif/nie ya existe',
                'validar_cif_nif_nie' => 'Cif/nie inválido',
            ],
        ],
        
        'id_usuarios' => [
            'rules' => $id_usuarios_rules,
            'errors' => [
                'required' => 'Debes introducir un usuario',
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
    $razon_social = $this->request->getVar('razon_social');
    $nombre = $this->request->getVar('nombre');
    $apellidos = $this->request->getVar('apellidos');
    $telefono = $this->request->getVar('telefono');
    $cif_nif_nie = $this->request->getVar('cif_nif_nie');
    $id_usuarios = session()->get('role') !== 'Distribuidor' ? $this->request->getVar('id_usuarios') : $distribuidor['id_usuarios'];

    // Actualizar los datos en la base de datos
    $model->where('id', $id)
        ->set([
            'razon_social' => $razon_social,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'telefono' => $telefono,
            'cif_nif_nie' => $cif_nif_nie,
            'id_usuarios' => $id_usuarios,
        ])
        ->update();

    // Redirigir a la lista de distribuidores
    return redirect()->to('/distribuidores');
}

   
    
//     public function delete()
//    {
//         $model=new DistribuidorModel();
//        $id=$this->request->getvar('id');
//       
//       if($model->where('id', $id)->delete()) echo 1;
//         else echo 0;
//    }
    
    
    public function delete()
{
    $model = new DistribuidorModel();
    $id = $this->request->getVar('id');

    // Primero, obtener el distribuidor para conseguir el ID del usuario
    $distribuidor = $model->where('id', $id)->first();

    if ($distribuidor) {
        // Obtener el ID del usuario asociado al distribuidor
        $id_usuario = $distribuidor['id_usuarios'];

        // Actualizar el rol del usuario a "Usuario" (id 4)
        $usuarioModel = new UsuarioModel();
        $usuarioModel->where('id', $id_usuario)
            ->set(['id_roles' => 4]) // Rol de usuario
            ->update();
        
        // Eliminar el distribuidor
        if ($model->where('id', $id)->delete()) {
            echo 1; // El distribuidor se eliminó correctamente
        } else {
            echo 0; // Error al eliminar el distribuidor
        }
    } else {
        echo 0; // Distribuidor no encontrado
    }
}

    
     public function volver()
    {
        return redirect()->to('/distribuidores');
    }
    
    public function exportar()
    {
         $model = new DistribuidorModel();
    $distribuidores = $model->findAll();

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
    $sheet->mergeCells('A2:F2');
    $sheet->setCellValue('A2', 'BORAL - LISTADO DE DISTRIBUIDORES');
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

    // Estilo cabecera
    $styleHeader = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '007bff']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]], 
    ];
    $sheet->getStyle('A4:F4')->applyFromArray($styleHeader);

    $count = 5;
    foreach ($distribuidores as $distribuidor) {
        $sheet->setCellValue('A' . $count, $distribuidor['id']);
        $sheet->setCellValue('B' . $count, $distribuidor['razon_social']);
        $sheet->setCellValue('C' . $count, $distribuidor['nombre']);
        $sheet->setCellValue('D' . $count, $distribuidor['apellidos']);
        $sheet->setCellValue('E' . $count, $distribuidor['cif_nif_nie']);
        $sheet->setCellValue('F' . $count, $distribuidor['telefono']);
        $count++;
    }

    // Ajustar columnas
    foreach (range('A', 'F') as $col) {
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
    $sheet->getStyle("A4:F{$ultimaFila}")->applyFromArray($styleTableBorders);

    // Footer con fecha
    date_default_timezone_set('Europe/Madrid');
    $fecha = date('d/m/Y H:i');
    $filaFooter = $count + 2;
    $sheet->mergeCells("A{$filaFooter}:F{$filaFooter}");
    $sheet->setCellValue("A{$filaFooter}", "Exportado el {$fecha}");
    $sheet->getStyle("A{$filaFooter}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $filaFooter2 = $filaFooter + 1;
    $sheet->mergeCells("A{$filaFooter2}:F{$filaFooter2}");
    $sheet->setCellValue("A{$filaFooter2}", "Todos los derechos reservados Boral ©");
    $sheet->getStyle("A{$filaFooter2}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Guardar Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'distribuidores.xlsx';
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
    

    public function imprimir()
    {
        ini_set('memory_limit', '1024M'); 

        $model = new DistribuidorModel();
        $id = $this->request->getVar('id');

        $distribuidor = $model
        ->select('distribuidores.*, usuarios.email')
        ->join('usuarios', 'distribuidores.id_usuarios = usuarios.id')
        ->where('distribuidores.id', $id)
        ->first();

        if (!$distribuidor) {
            return "Distribuidor no encontrado.";
        }

        $data["datosEncabezado"] = "Datos " . $distribuidor["razon_social"];
        $data["razon_social"] = $distribuidor["razon_social"];
        $data["nombre"] = $distribuidor["nombre"];
        $data["apellidos"] = $distribuidor["apellidos"];
        $data["cif_nif_nie"] = $distribuidor["cif_nif_nie"];
        $data["telefono"] = $distribuidor["telefono"];
        $data["email"] = $distribuidor["email"];
        $data["id"] = $distribuidor["id"];
        
        $modelPedido = new PedidoModel();
        $data['pedidos'] = $modelPedido->listaPedidosPorDistribuidor($id);


        // Vista normal de CodeIgniter
        $html = view('prinView', $data);

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
            ->setHeader('Content-Disposition', 'inline; filename="distribuidores.pdf"')
            ->setBody($dompdf->output());
    }
    
    public function exportarPDF()
{
    // Obtener los distribuidores
    $model = new DistribuidorModel();
    $distribuidores = $model->findAll();  // Usamos el modelo para obtener los distribuidores

    // Preparar los datos para la vista
    $data["distribuidores"] = $distribuidores;
    $data["titulo"] = "BORAL - LISTADO DE DISTRIBUIDORES";

    // Vista para mostrar los datos (como un HTML)
    $html = view('distribuidores_pdfView', $data);

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
        ->setHeader('Content-Disposition', 'inline; filename="distribuidores.pdf"')
        ->setBody($dompdf->output());
}


}
