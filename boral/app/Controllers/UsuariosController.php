<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RoleModel;
use App\Models\UsuarioModel;
use App\Models\CallejeroModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Dompdf\Dompdf;
use Dompdf\Options;
class UsuariosController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new UsuarioModel();
        $data['usuarios']=$model->obtenerNombreRol();
        
        return view('usuariosListView',$data);
    }
    
    public function nuevo()
    {
        
        $options=array();
        $options['']="Selecciona un role";
        
        $modelRole=new RoleModel();
        $roles=$modelRole->findAll();
        foreach($roles as $role){
            $options[$role["id"]]=$role["role"];
        }
        $data["optionsRoles"]=$options;
        
        return view('usuariosNewView',$data);
    }
    
    
     public function crear()
    {
       
        
         
         $rules=[
         'usuario'=>[
             'rules'=>'required|is_unique[usuarios.usuario]',
             'errors'=>[
                 'required'=>'Debes introducir un usuario',
                 'is_unique'=>'El nombre del usuario ya existe',
             ]
         ],
          'id_roles'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes seleccionar un role',
             ]
         ],  
      'password'=>[
             'rules'=>'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
             'errors'=>[
                 'required'=>'Debes introducir una contraseña',
                 'min_length' => 'La contraseña debe tener al menos 6 caracteres',
                 'regex_match' => 'Debe tener una letra minúscula, una letra mayúscula, un número y un símbolo especial',
             ]
         ],
        'email'=>[
             'rules'=>'required|valid_email|is_unique[usuarios.email]',
             'errors'=>[
                 'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
             ]
         ],
        
       ]; 
        
    
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
          //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1
        $model=new UsuarioModel();
        $id_roles=$this->request->getvar('id_roles');
         $usuario=$this->request->getvar('usuario');
         $password=$this->request->getvar('password');
         $email=$this->request->getvar('email');
         
         $newData=[
             'id_roles'=>$id_roles
             ,'usuario'=>$usuario
             ,'password'=>md5($password)
             ,'email'=>$email
             ,'imagen'=>"public/uploads/generica.png"
             ,'created_at'=>date("Y-m-d h:i:s")
             ,'updated_at'=>date("Y-m-d h:i:s")
         ];
         
         $model->save($newData);
         
         
          return redirect()->to('/usuarios');
    }
    
    public function editar()
    {
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
         $options=array();
        $options['']="Seleccionar Usuario";
        
        $modelRole=new RoleModel();
        $roles=$modelRole->findAll();
        foreach($roles as $role){
            $options[$role["id"]]=$role["role"];
        }
        $data["optionsRoles"]=$options;
        
        return view('usuariosEditView',$data);
    }
    
   public function actualizar()
{
    $model = new UsuarioModel();
    $id = $this->request->getVar('id');
    $usuarioActual = $model->find($id);
    $password = $usuarioActual['password']; // Tomamos la contraseña actual por si no se quiere cambiar

    // Obtenemos si el checkbox de "Mostrar Contraseña" está marcado
    $mostrar = $this->request->getVar('mostrar'); 

    // Reglas de validación
    $rules = [
        'usuario' => [
            'rules' => 'required|is_unique[usuarios.usuario,id,'.$id.']',
            'errors' => [
                'required' => 'Debes introducir un usuario',
                'is_unique' => 'Este nombre de usuario ya está registrado',
            ]
        ],
        'id_roles' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Debes seleccionar un role',
            ]
        ],
        'email'=>[
             'rules'=>'required|valid_email|is_unique[usuarios.email,id,'.$id.']',
             'errors'=>[
                 'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
             ]
         ],
    ];

    // Si el checkbox "Mostrar Contraseña" está marcado
    if ($mostrar) { 
        $rules['password'] = [
            'rules' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
            'errors' => [
                'required' => 'Debes introducir una contraseña',
                'min_length' => 'La contraseña debe tener al menos 6 caracteres',
                'regex_match' => 'Debe tener una letra minúscula, una letra mayúscula, un número y un símbolo especial',
            ]
        ];
        $rules['password1'] = [
            'rules' => 'matches[password]',
            'errors' => [
                'matches' => 'Las contraseñas no coinciden',
            ]
        ];

        // Si la contraseña se va a cambiar, la obtenemos
        $password = md5($this->request->getVar('password'));
    }

    // Validamos los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Si no pasa la validación, redirigimos con los errores
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Obtenemos los datos para actualizar
    $id_roles = $this->request->getVar('id_roles');
    $usuario = $this->request->getVar('usuario');
    $email = $this->request->getVar('email');

    // Actualizamos los datos en la base de datos
    $model->where('id', $id)
        ->set([
            'id_roles' => $id_roles,
            'usuario' => $usuario,
            'password' => $password,  // Se actualiza la contraseña si es necesario
            'email' => $email,
            'updated_at' => date("Y-m-d h:i:s")
        ])
        ->update();

    // Redirigimos a la lista de usuarios
    return redirect()->to('/usuarios');
}


   
    
     public function delete()
    {
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
        // return redirect()->to('/roles');
    }
    
    public function volver()
    {
        return redirect()->to('/usuarios');
    }
    
public function exportar()
{
    $model = new UsuarioModel();
    $usuarios = $model->obtenerNombreRol();

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
    $sheet->mergeCells('A2:C2');
    $sheet->setCellValue('A2', 'BORAL - LISTADO DE USUARIOS');
    $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getRowDimension('1')->setRowHeight(60);
    $sheet->getRowDimension('2')->setRowHeight(30);
    $sheet->getRowDimension('3')->setRowHeight(15);

    // Cabecera tabla
    $sheet->setCellValue('A4', 'Role');
    $sheet->setCellValue('B4', 'Usuario');
    $sheet->setCellValue('C4', 'Email');

    // Estilo cabecera
    $styleHeader = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '007bff']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
    ];
    $sheet->getStyle('A4:C4')->applyFromArray($styleHeader);

    $count = 5;
    foreach ($usuarios as $usuario) {
        $sheet->setCellValue('A' . $count, $usuario['role']);
        $sheet->setCellValue('B' . $count, $usuario['usuario']);
        $sheet->setCellValue('C' . $count, $usuario['email']);
        $count++;
    }

    // Ajustar columnas
    foreach (range('A', 'C') as $col) {
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
    $sheet->getStyle("A4:C{$ultimaFila}")->applyFromArray($styleTableBorders);

    // Footer con fecha
    date_default_timezone_set('Europe/Madrid');
    $fecha = date('d/m/Y H:i');
    $filaFooter = $count + 2;
    $sheet->mergeCells("A{$filaFooter}:C{$filaFooter}");
    $sheet->setCellValue("A{$filaFooter}", "Exportado el {$fecha}");
    $sheet->getStyle("A{$filaFooter}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $filaFooter2 = $filaFooter + 1;
    $sheet->mergeCells("A{$filaFooter2}:C{$filaFooter2}");
    $sheet->setCellValue("A{$filaFooter2}", "Todos los derechos reservados Boral ©");
    $sheet->getStyle("A{$filaFooter2}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Guardar Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'usuarios.xlsx';
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
    // Obtener los usuarios con su rol
    $model = new UsuarioModel();
    $usuarios = $model->obtenerNombreRol();

    // Preparar los datos para la vista
    $data["usuarios"] = $usuarios;
    $data["titulo"] = "BORAL - LISTADO DE USUARIOS";

    // Vista para mostrar los datos (como un HTML)
    $html = view('usuarios_pdfView', $data);

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
        ->setHeader('Content-Disposition', 'inline; filename="usuarios.pdf"')
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
