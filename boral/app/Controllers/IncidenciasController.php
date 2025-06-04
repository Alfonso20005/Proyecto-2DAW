<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;
use App\Models\IncidenciaModel;

class IncidenciasController extends BaseController
{
    protected $helpers = ['form','comprobar'];

    public function index()
    {
        $model = new IncidenciaModel();
        $data['incidencias']=$model->findAll();
        
        if(session()->get('role')=="SuperAdmin"){
            return view('incidenciasTablaView',$data);
        }else{
            return view('incidenciasView');
        }
        
    }
    
    public function enviar()
    {
        $model = new UsuarioModel();
        
        // Reglas de validación
        $rules = [
            'email'=>[
                 'rules'=>'required|valid_email|is_not_unique[usuarios.email]',
                 'errors'=>[
                     'required' => 'El email es obligatorio',
                    'valid_email' => 'El email no tiene un formato válido',
                    'is_not_unique' => 'El email no está registrado',
                 ]
             ],
            'descripcion' => [
                'rules' => 'required',
                 'errors'=>[
                     'required' => 'La descripcion es obligatoria',
                ]
            ],
        ];
        
         // Validamos los datos del formulario
        $datos = $this->request->getPost(array_keys($rules));

        // Si no pasa la validación, redirigimos con los errores
        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Obtenemos los datos del formulario
        $email = $this->request->getPost('email');
        $descripcion = $this->request->getPost('descripcion');
        
         // Crear el contenido HTML del correo con el logo incluido
    $mensajeHtml = "
    <body style='margin:0; padding:0; background-color:#f0f0f0;'>
      <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
          <td align='center' style='padding: 20px 0;'>
            <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 420px; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.05); padding: 24px;'>
              <tr>
                <td align='center' style='padding: 40px 0 20px 0;'>
                  <img src='https://i.ibb.co/8g9y25x7/boral.png' alt='Boral Logo' width='160' style='display: block;'>
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#333333; font-family: Arial, sans-serif; font-size:24px; padding: 16px 0; font-weight:bold;'>
                  Incidencia Reportada
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                  Se ha reportado una nueva incidencia en el sistema.
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                  Email: 
                </td>
              </tr>
              <tr>
                <td align='center' style='padding: 24px 0;'>
                  <div style='display: inline-block; background-color: #f5f5f5; padding: 16px 24px; border-radius: 8px; font-size:24px; font-weight:bold;font-family: Arial, sans-serif; color:#000000;'>
                     $email 
                  </div>
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                    Descripción: 
                </td>
              </tr>
              <tr>
                <td align='center' style='padding: 24px 0;'>
                  <div style='display: inline-block; background-color: #f5f5f5; padding: 16px 24px; border-radius: 8px; font-size:14px; font-weight:bold; font-family: Arial, sans-serif; color:#000000;'>
                     $descripcion 
                  </div>
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#999999; font-family: Arial, sans-serif; font-size:12px; padding: 20px 0 0 0;'>
                  © 2025 Boral Pastelería. Todos los derechos reservados. <br>
                  <a href='#' style='color:#0066cc; text-decoration:none;'>Visita nuestro sitio web</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>";
        
        
        $email = service('email');
                    $email->setMailType('html');
                    //$this->email->attach('files/attachment.pdf');
                    $email->setFrom('ifc303@fpmarco.com', 'ERP BORAL');
                    $email->setTo('alfonso.ascaso.lizarrondo@gmail.com');
                    //$email->setCC('another@another-example.com');
                    //$email->setBCC('them@their-example.com');
                    $email->setSubject('Nueva Incidencia Reportada');


                  
        $email->setMessage($mensajeHtml);  
        $respuesta=$email->send();
        
        $email1 = $this->request->getVar('email');
        $descripcion1 = $this->request->getVar('descripcion');
        
        $model=new IncidenciaModel();
         
         $newData=[
             'email'=>$email1,
             'descripcion'=>$descripcion1,
             'estado'=>"sin resolver",
             'fecha' => date('Y-m-d H:i:s')
         ];
         
         $model->save($newData);
       
        session()->setFlashdata('success', 'Incidencia enviada correctamente!!');
        // Si el correo se envió correctamente, redirigir con un mensaje de éxito
        return redirect()->to('/inicio');
    }
    
    
     public function editar()
    {
        $model=new IncidenciaModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('incidenciasEditTablaView',$data);
    }
    
     public function actualizar()
    {
       $id=$this->request->getvar('id');
        
         
        $model=new IncidenciaModel();
        $estado=$this->request->getvar('estado');
        
        $model->where('id',$id)
            ->set(['estado'=>$estado])
            ->update();
         
         
          return redirect()->to('/incidencias');
    }
    
    
     public function volver()
    {
        return redirect()->to('/incidencias');
    }
    
}
