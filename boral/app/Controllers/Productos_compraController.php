<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Categoria_compraModel;
use App\Models\Producto_compraModel;
use App\Models\ProveedorModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Dompdf\Dompdf;
use Dompdf\Options;
class Productos_compraController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new Producto_compraModel();
        $data['productos_compra']=$model->obtenerProductosConProveedorYCategoria();
        
        return view('productos_compraListView',$data);
    }
    
    public function nuevo()
    {
        
        $options=array();
        $options['']="Selecciona una categoria";
        
        $modelCategoria=new Categoria_compraModel();
        $categorias=$modelCategoria->findAll();
        foreach($categorias as $categoria){
            $options[$categoria["id"]]=$categoria["nombre"];
        }
        $data["optionsCategorias"]=$options;
        
        
        $options1=array();
        $options1['']="Selecciona un proveedor";

        $proveedor=new ProveedorModel();
        $proveedores=$proveedor->findAll();
        foreach ($proveedores as $pro) {
            // Verificar si la razón social está vacía
            if (empty($pro["razon_social"])) {
                // Si está vacía, usar el nombre y los apellidos
                $options1[$pro["id"]] = $pro["nombre"] . ' ' . $pro["apellidos"];
            } else {
                // Si no está vacía, usar la razón social
                $options1[$pro["id"]] = $pro["razon_social"];
            }
        }
        $data["optionsProveedores"]=$options1;
        
        return view('productos_compraNewView',$data);
    }
    
    
     public function crear()
    {
        
        $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[productos_compra.nombre]',
             'errors'=>[
                 'required'=>'Debes introducir un nombre de producto',
                 'is_unique'=>'El nombre del producto ya existe',
             ]
         ],
          'descripcion'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes poner una descripcion',
             ]
         ],  
          'precio' => [
            'rules' => 'required|decimal|greater_than[0]',
            'errors' => [
                'required' => 'Debes introducir un precio',
                'decimal' => 'El precio debe ser un número válido',
                'greater_than' => 'El precio debe ser mayor que 0',
            ]
        ],  
          'stock' => [
            'rules' => 'required|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'Debes introducir un precio',
                'greater_than_equal_to' => 'El stock no puede ser menor que 0',
            ]
        ],
        'id_categoria_compra'=>[
             'rules'=>'required',
             'errors'=>[
                 'required' => 'La categoria es obligatoria',
             ]
         ],
            
        'id_proveedores'=>[
             'rules'=>'required',
             'errors'=>[
                 'required' => 'El proveedor es obligatorio',
             ]
         ],
        
       ]; 
        
    
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     

        $model=new Producto_compraModel();
        $nombre=$this->request->getvar('nombre');
         $descripcion=$this->request->getvar('descripcion');
         $precio=$this->request->getvar('precio');
         $stock=$this->request->getvar('stock');
         $id_categoria_compra=$this->request->getvar('id_categoria_compra');
         $id_proveedores=$this->request->getvar('id_proveedores');
         
         $newData=[
             'nombre'=>$nombre
             ,'descripcion'=>$descripcion
             ,'precio'=>$precio
             ,'stock'=>$stock
             ,'id_categoria_compra'=>$id_categoria_compra
             ,'id_proveedores'=>$id_proveedores
         ];
         
         $model->save($newData);
         
         
          return redirect()->to('/productos_compra');
    }
    
    public function editar()
    {
        $model=new Producto_compraModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        $options=array();
        $options['']="Selecciona una categoria";
        
        $modelCategoria=new Categoria_compraModel();
        $categorias=$modelCategoria->findAll();
        foreach($categorias as $categoria){
            $options[$categoria["id"]]=$categoria["nombre"];
        }
        $data["optionsCategorias"]=$options;
        
        
        $options1=array();
        $options1['']="Selecciona un proveedor";
        
        $modelProveedor=new ProveedorModel();
        $proveedores=$modelProveedor->findAll();
        foreach($proveedores as $pro){
            if (empty($pro["razon_social"])) {
                // Si está vacía, usar el nombre y los apellidos
                $options1[$pro["id"]] = $pro["nombre"] . ' ' . $pro["apellidos"];
            } else {
                // Si no está vacía, usar la razón social
                $options1[$pro["id"]] = $pro["razon_social"];
            }
            
        }
        $data["optionsProveedores"]=$options1;
        
        return view('productos_compraEditView',$data);
    }
    
   public function actualizar()
{
    $model = new Producto_compraModel();
    $id = $this->request->getVar('id');
    // Reglas de validación
    $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[productos_compra.nombre,id,'.$id.']',
             'errors'=>[
                 'required'=>'Debes introducir un nombre de producto',
                 'is_unique'=>'El nombre del producto ya existe',
             ]
         ],
          'descripcion'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes poner una descripcion',
             ]
         ],  
          'precio' => [
            'rules' => 'required|decimal|greater_than[0]',
            'errors' => [
                'required' => 'Debes introducir un precio',
                'decimal' => 'El precio debe ser un número válido',
                'greater_than' => 'El precio debe ser mayor que 0',
            ]
        ],  
          'stock' => [
            'rules' => 'required|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'Debes introducir un precio',
                'greater_than_equal_to' => 'El stock no puede ser menor que 0',
            ]
        ],
        'id_categoria_compra'=>[
             'rules'=>'required',
             'errors'=>[
                 'required' => 'La categoria es obligatoria',
             ]
         ],
            
        'id_proveedores'=>[
             'rules'=>'required',
             'errors'=>[
                 'required' => 'El proveedor es obligatorio',
             ]
         ],
        
       ]; 
        
    // Validamos los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Si no pasa la validación, redirigimos con los errores
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Obtenemos los datos para actualizar
     $nombre=$this->request->getvar('nombre');
     $descripcion=$this->request->getvar('descripcion');
     $precio=$this->request->getvar('precio');
     $stock=$this->request->getvar('stock');
     $id_categoria_compra=$this->request->getvar('id_categoria_compra');
     $id_proveedores=$this->request->getvar('id_proveedores');

    // Actualizamos los datos en la base de datos
    $model->where('id', $id)
        ->set([
            'nombre'=>$nombre
             ,'descripcion'=>$descripcion
             ,'precio'=>$precio
             ,'stock'=>$stock
             ,'id_categoria_compra'=>$id_categoria_compra
             ,'id_proveedores'=>$id_proveedores
        ])
        ->update();

    // Redirigimos a la lista de usuarios
    return redirect()->to('/productos_compra');
}


   
    
     public function delete()
    {
        $model=new Producto_compraModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
        // return redirect()->to('/roles');
    }
    
    public function volver()
    {
        return redirect()->to('/productos_compra');
    }
    
    public function exportar()
    {
       $model = new Producto_compraModel();
    $productos = $model->obtenerProductosConProveedorYCategoria();

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
    $sheet->setCellValue('A2', 'BORAL - LISTADO DE PRODUCTOS DE COMPRA');
    $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getRowDimension('1')->setRowHeight(60);
    $sheet->getRowDimension('2')->setRowHeight(30);
    $sheet->getRowDimension('3')->setRowHeight(15);

    // Cabecera tabla
    $sheet->setCellValue('A4', 'Id');
    $sheet->setCellValue('B4', 'Nombre');
    $sheet->setCellValue('C4', 'Precio (€)');
    $sheet->setCellValue('D4', 'Stock (gr)');
    $sheet->setCellValue('E4', 'Categoría');
    $sheet->setCellValue('F4', 'Proveedor');

    // Estilo cabecera
    $styleHeader = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '007bff']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]], 
    ];
    $sheet->getStyle('A4:F4')->applyFromArray($styleHeader);

    $count = 5;
    foreach ($productos as $producto) {
        $sheet->setCellValue('A' . $count, $producto['id']);
        $sheet->setCellValue('B' . $count, $producto['nombre']);
        $sheet->setCellValue('C' . $count, $producto['precio'] . ' €');
        $sheet->setCellValue('D' . $count, $producto['stock'] . ' gr');
        $sheet->setCellValue('E' . $count, $producto['categoria_nombre']);
        $sheet->setCellValue('F' . $count, $producto['proveedor_nombre']);
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
    $fileName = 'productos_compra.xlsx';
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
    // Obtener los productos de compra con su proveedor y categoría
    $model = new Producto_compraModel();
    $productosCompra = $model->obtenerProductosConProveedorYCategoria(); // Utilizamos el método personalizado

    // Preparar los datos para la vista
    $data["productosCompra"] = $productosCompra;
    $data["titulo"] = "BORAL - LISTADO DE PRODUCTOS DE COMPRA";

    // Vista para mostrar los datos (como un HTML)
    $html = view('productos_compra_pdfView', $data);

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
        ->setHeader('Content-Disposition', 'inline; filename="productos_compra.pdf"')
        ->setBody($dompdf->output());
}

    
    
    
    
    
    
    
    
    
     public function grafica()
    {
         $model=new UsuarioModel();
         $usuarios=$model->datosgrafica();
         $data["datos"]=$usuarios;
         $datalabel=array();
         $ticks=array();
         if(count($usuarios)>0){
             $i=1;
             foreach($usuarios as $user){
                 array_push($datalabel,"[".$i.",".$user["numUsuarios"]."]");
                 array_push($ticks,"[".$i.",'".$user["role"]."']");
                 $i++;
             }
         }
         $datalabel=implode(",",$datalabel);
         $ticks=implode(",",$ticks);
         $data["datalabel"]=$datalabel;
         $data["ticks"]=$ticks;
       return view('graficaView',$data);
    }
    public function grafica2()
    {
         $model=new UsuarioModel();
         $usuarios=$model->datosgrafica();
         $data["datos"]=$usuarios;
         $xValues=array();
         $yValues=array();
         $colores='"red", "green","blue","orange","brown"';
        
    //"red", "green","blue","orange","brown"
         if(count($usuarios)>0){
             $i=0;
             foreach($usuarios as $user){
                 array_push($yValues,$user["numUsuarios"]);
                 array_push($xValues,"'".$user["role"]."'");
                  
                 $i++;
             }
         }
         $yValues=implode(",",$yValues);
         $xValues=implode(",",$xValues);
         // $colores=implode(",",$colores);
         $data["yValues"]=$yValues;
         $data["xValues"]=$xValues;
        $data["colores"]=$colores;
       return view('graficaPieView',$data);
    }
     public function grafica3()
    {
         $model=new UsuarioModel();
         $usuarios=$model->datosgrafica();
         $data["datos"]=$usuarios;
         $datalabel=array();
         $ticks=array();
         if(count($usuarios)>0){
             $i=1;
             foreach($usuarios as $user){
                 array_push($datalabel,"[".$i.",".$user["numUsuarios"]."]");
                 array_push($ticks,"[".$i.",'".$user["role"]."']");
                 $i++;
             }
         }
         $datalabel=implode(",",$datalabel);
         $ticks=implode(",",$ticks);
         $data["datalabel"]=$datalabel;
         $data["ticks"]=$ticks;
       return view('graficaLineView',$data);
    }
    
    
     public function graficas()
{
    $model = new UsuarioModel();
    $usuarios = $model->datosgrafica();
    $data["datos"] = $usuarios;
    $datalabel = array();
    $ticks = array();

    // Graficas de usuarios
    if (count($usuarios) > 0) {
        $i = 1;
        foreach ($usuarios as $user) {
            array_push($datalabel, "[" . $i . "," . $user["numUsuarios"] . "]");
            array_push($ticks, "[" . $i . ",'" . $user["role"] . "']");
            $i++;
        }
    }
    $datalabel = implode(",", $datalabel);
    $ticks = implode(",", $ticks);
    $data["datalabel"] = $datalabel;
    $data["ticks"] = $ticks;
    $data["idGrafBarra"] = "id1";
    $dataC["grafica1"] = view('graf_barraView', $data);
    $data["idGrafBarra"] = "id2";
    $dataC["grafica2"] = view('graf_barraView', $data);

    $xValues = array();
    $yValues = array();
    $colores = '"red", "green", "blue", "orange", "brown"';

    if (count($usuarios) > 0) {
        $i = 0;
        foreach ($usuarios as $user) {
            array_push($yValues, $user["numUsuarios"]);
            array_push($xValues, "'" . $user["role"] . "'");
            $i++;
        }
    }
    $yValues = implode(",", $yValues);
    $xValues = implode(",", $xValues);
    $data["yValues"] = $yValues;
    $data["xValues"] = $xValues;
    $data["colores"] = $colores;
    $data["idGrafPie"] = "id3";
    $dataC["grafica3"] = view('graf_pieView', $data);

    // Graficas de barrios
    $model1 = new CallejeroModel();
    $barrios = $model1->datosBarrios(); // Asegúrate de que esta función devuelva los datos correctamente
    $barriosLabels = array();
    $barriosValues = array();

//         var_dump($barrios);
    if (count($barrios) > 0) {
        $i=1;
        foreach ($barrios as $barrio) {
            array_push($barriosLabels,"[".$i.",'".$barrio["barrio_rural"]."']");
            array_push($barriosValues,"[".$i.",".$barrio["numBarrios"]."]");
            $i++;
        }
    }


    $barriosLabels = implode(",", $barriosLabels);
    $barriosValues = implode(",", $barriosValues);

//         var_dump($barriosLabels);
    // Asignamos los datos para la nueva gráfica de barrios
    $data["barriosLabels"] = $barriosLabels;
    $data["barriosValues"] = $barriosValues;
    $data["idGrafBarrios"] = "id5";  // ID para la nueva gráfica de barrios
    $dataC["grafica5"] = view('grafBarrioView', $data);  // Vista para la gráfica de barrios

    // Graficas de líneas
    $data["idGrafLine"] = "id4";
    $dataC["grafica4"] = view('graf_LineView', $data);

    // Finalmente, se devuelven todas las vistas
    return view('graficasView', $dataC);
}

}
