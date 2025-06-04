<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Categoria_ventaModel;
use App\Models\Producto_ventaModel;
use App\Models\Producto_compraModel;
use App\Models\Ref_productos_venta_productos_compraModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Dompdf\Dompdf;
use Dompdf\Options;
class Productos_ventaController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new Producto_ventaModel();
        $data['productos_venta']=$model->obtenerProductosCategoria();
        
        return view('productos_ventaListView',$data);
    }
    
    public function nuevo()
    {
        
        $options=array();
        $options['']="Selecciona una categoria";
        
        $modelCategoria=new Categoria_ventaModel();
        $categorias=$modelCategoria->findAll();
        foreach($categorias as $categoria){
            $options[$categoria["id"]]=$categoria["nombre"];
        }
        $data["optionsCategorias"]=$options;
        
        
        return view('productos_ventaNewView',$data);
    }
    
    
     public function crear()
    {
        
        $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[productos_venta.nombre]|alpha_space',
             'errors'=>[
                 'required'=>'Debes introducir un nombre de producto',
                 'is_unique'=>'El nombre del producto ya existe',
                 'alpha_space'=>'El nombre del producto no puede tener numeros',
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
        'id_categoria_venta'=>[
             'rules'=>'required',
             'errors'=>[
                 'required' => 'La categoria es obligatoria',
             ]
         ],
        
       ]; 
        
    
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     

        $model=new Producto_ventaModel();
        $nombre=$this->request->getvar('nombre');
         $descripcion=$this->request->getvar('descripcion');
         $precio=$this->request->getvar('precio');
         $stock=$this->request->getvar('stock');
         $id_categoria_venta=$this->request->getvar('id_categoria_venta');
         
         $newData=[
             'nombre'=>$nombre
             ,'descripcion'=>$descripcion
             ,'precio'=>$precio
             ,'stock'=>$stock
             ,'id_categoria_venta'=>$id_categoria_venta
         ];
         
         $model->save($newData);
         
         
         $id_producto_venta = $model->insertID();
       
        $modelProductoVenta = new Producto_ventaModel();
        $producto = $modelProductoVenta->find($id_producto_venta);
       
        $data["producto"]=$producto;
         
         
        $options=array();
        $options['']="Selecciona un Ingrediente";
        
        $modelProductoCompra = new Producto_compraModel();
        $productos_compra = $modelProductoCompra->findAll();
        foreach($productos_compra as $pro_compra){
            $options[$pro_compra["id"]]=$pro_compra["nombre"];
        }
        $data["optionsProductoCompra"]=$options;

       return view('venta_compraView',$data);
         
         
//          return redirect()->to('/productos_venta');
    }
    
    public function editar()
    {
        $model=new Producto_ventaModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        $options=array();
        $options['']="Selecciona una categoria";
        
        $modelCategoria=new Categoria_ventaModel();
        $categorias=$modelCategoria->findAll();
        foreach($categorias as $categoria){
            $options[$categoria["id"]]=$categoria["nombre"];
        }
        $data["optionsCategorias"]=$options;
        
        return view('productos_ventaEditView',$data);
    }
    
   public function actualizar()
{
    $model = new Producto_ventaModel();
    $id = $this->request->getVar('id');
    // Reglas de validación
    $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[productos_venta.nombre,id,'.$id.']|alpha_space',
             'errors'=>[
                 'required'=>'Debes introducir un nombre de producto',
                 'is_unique'=>'El nombre del producto ya existe',
                  'alpha_space'=>'El nombre del producto no puede tener numeros',
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
        'id_categoria_venta'=>[
             'rules'=>'required',
             'errors'=>[
                 'required' => 'La categoria es obligatoria',
             ]
         ]
        
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
     $id_categoria_venta=$this->request->getvar('id_categoria_venta');

    // Actualizamos los datos en la base de datos
    $model->where('id', $id)
        ->set([
            'nombre'=>$nombre
             ,'descripcion'=>$descripcion
             ,'precio'=>$precio
             ,'stock'=>$stock
             ,'id_categoria_venta'=>$id_categoria_venta
        ])
        ->update();

    // Redirigimos a la lista de usuarios
    return redirect()->to('/productos_venta');
}
    
    
    public function guardarRefProductos()
{
    $id_producto_venta = $this->request->getVar('id_producto_venta');
    $ids_producto_compra = $this->request->getVar('id_producto_compra');
    $cantidades = $this->request->getVar('cantidad');

    $model = new Ref_productos_venta_productos_compraModel();

    if ($id_producto_venta && is_array($ids_producto_compra) && is_array($cantidades)) {
        foreach ($ids_producto_compra as $i => $id_compra) {
            // Validamos que venga cantidad y producto
            if (!empty($id_compra) && isset($cantidades[$i]) && $cantidades[$i] !== '') {
                $model->insert([
                    'id_producto_venta' => $id_producto_venta,
                    'id_producto_compra' => $id_compra,
                    'cantidad' => $cantidades[$i]
                ]);
            }
        }
    }

    return redirect()->to('/productos_venta');
}


   
    
     public function delete()
    {
        $model=new Producto_ventaModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
        // return redirect()->to('/roles');
    }
    
    public function volver()
    {
        return redirect()->to('/productos_venta');
    }
    
    public function exportar()
    {
        $model = new Producto_ventaModel();
    $productos = $model->obtenerProductosCategoria();

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
    $sheet->mergeCells('A2:E2');
    $sheet->setCellValue('A2', 'BORAL - LISTADO DE PRODUCTOS DE VENTA');
    $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getRowDimension('1')->setRowHeight(60);
    $sheet->getRowDimension('2')->setRowHeight(30);
    $sheet->getRowDimension('3')->setRowHeight(15);

    // Cabecera tabla
    $sheet->setCellValue('A4', 'Id');
    $sheet->setCellValue('B4', 'Nombre');
    $sheet->setCellValue('C4', 'Precio (€)');
    $sheet->setCellValue('D4', 'Stock');
    $sheet->setCellValue('E4', 'Categoría');

    // Estilo cabecera
    $styleHeader = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '007bff']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]], 
    ];
    $sheet->getStyle('A4:E4')->applyFromArray($styleHeader);

    $count = 5;
    foreach ($productos as $producto) {
        $sheet->setCellValue('A' . $count, $producto['id']);
        $sheet->setCellValue('B' . $count, $producto['nombre']);
        $sheet->setCellValue('C' . $count, $producto['precio'] . ' €');
        $sheet->setCellValue('D' . $count, $producto['stock']);
        $sheet->setCellValue('E' . $count, $producto['categoria_nombre']);
        $count++;
    }

    // Ajustar columnas
    foreach (range('A', 'E') as $col) {
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
    $sheet->getStyle("A4:E{$ultimaFila}")->applyFromArray($styleTableBorders);

    // Footer con fecha
    date_default_timezone_set('Europe/Madrid');
    $fecha = date('d/m/Y H:i');
    $filaFooter = $count + 2;
    $sheet->mergeCells("A{$filaFooter}:E{$filaFooter}");
    $sheet->setCellValue("A{$filaFooter}", "Exportado el {$fecha}");
    $sheet->getStyle("A{$filaFooter}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $filaFooter2 = $filaFooter + 1;
    $sheet->mergeCells("A{$filaFooter2}:E{$filaFooter2}");
    $sheet->setCellValue("A{$filaFooter2}", "Todos los derechos reservados Boral ©");
    $sheet->getStyle("A{$filaFooter2}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Guardar Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'productos_venta.xlsx';
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
    // Obtener los productos de venta con su categoría
    $model = new Producto_ventaModel();
    $productosVenta = $model->obtenerProductosCategoria(); // Utilizamos el método personalizado

    // Preparar los datos para la vista
    $data["productosVenta"] = $productosVenta;
    $data["titulo"] = "BORAL - LISTADO DE PRODUCTOS DE VENTA";

    // Vista para mostrar los datos (como un HTML)
    $html = view('productos_venta_pdfView', $data);

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
        ->setHeader('Content-Disposition', 'inline; filename="productos_venta.pdf"')
        ->setBody($dompdf->output());
}

    
    
    
    
    
    
    
    
   
}
