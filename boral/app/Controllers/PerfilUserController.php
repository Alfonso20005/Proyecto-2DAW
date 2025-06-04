<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class PerfilUserController extends BaseController
{
    protected $helpers = ['form','comprobar'];

    public function index()
    {
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');
        
        // Verificamos si el id en la URL coincide con el id del usuario que ha iniciado sesión
        if ($id != session()->get('id')) {
            // Si no coinciden, redirigimos al inicio
            return redirect()->to('/inicio');
        }
        
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('perfilUserView',$data);
    }
    
    
    
    public function actualizar()
{
    $model = new UsuarioModel();
    $id = $this->request->getVar('id');
    $usuarioActual = $model->find($id);
    $password = $usuarioActual['password']; // Tomamos la contraseña actual por si no se quiere cambiar
    $id_roles = $usuarioActual['id_roles']; // Tomamos el rol actual
        

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
        'email'=>[
             'rules'=>'required|valid_email|is_unique[usuarios.email,id,'.$id.']',
             'errors'=>[
                 'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
             ]
         ],
        'imagen' => [
            'rules' => 'is_image[imagen]|max_size[imagen,1024]|mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png]',
            'errors' => [
                'is_image' => 'El archivo debe ser una imagen válida.',
                'max_size' => 'La imagen no debe superar los 1MB.',
                'mime_in' => 'El archivo debe ser de tipo JPG, JPEG, GIF o PNG.',
            ]
        ],
    ];

    // Si el checkbox "Mostrar Contraseña" está marcado
    if ($mostrar) {
    // Reglas de validación
    $rules['password'] = [
        'rules' => 'required|password_check['.$password.']', 
        'errors' => [
            'required' => 'Debes introducir una contraseña',
            'password_check' => 'La contraseña antigua es incorrecta',
        ]
    ];

    $rules['new_password'] = [
        'rules' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
        'errors' => [
            'required' => 'Debes introducir una nueva contraseña',
            'min_length' => 'La nueva contraseña debe tener al menos 6 caracteres',
            'regex_match' => 'Debe tener una letra minúscula, una letra mayúscula, un número y un símbolo especial',
        ]
    ];

    // Encriptamos la nueva contraseña en MD5
    $password = md5($this->request->getVar('new_password'));
}


    // Validamos los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Si no pasa la validación, redirigimos con los errores
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Obtenemos los datos para actualizados
    $usuario = $this->request->getVar('usuario');
    $email = $this->request->getVar('email');

    // Preparamos los datos para la actualización
    $updateData = [
        'id_roles' => $id_roles,
        'usuario' => $usuario,
        'password' => $password,  // Se actualiza la contraseña si es necesario
        'email' => $email,
        'updated_at' => date("Y-m-d h:i:s")
    ];
        
     
    // Si se subió una nueva imagen
    if ($this->request->getFile('imagen')->isValid()) {
        // Obtener el archivo de la imagen
        $file = $this->request->getFile('imagen');
        $ext = $file->guessExtension(); // Obtener la extensión del archivo

        // Crear un nombre único para la imagen
        $imageName = "Usuario_".$id.".".$ext;

        // Mover la imagen al directorio correspondiente
        $file->move(ROOTPATH . 'public/uploads', $imageName, true);

        // Establecer la ruta de la imagen
        $imagePath = 'public/uploads/'.$imageName;

        // Agregar la ruta de la imagen a los datos de actualización
        $updateData['imagen'] = $imagePath;
        
        session()->set('imagen', $imagePath);
    }

    // Actualizamos los datos en la base de datos
    $model->where('id', $id)
        ->set($updateData)
        ->update();


    // Redirigimos a la lista de usuarios
    return redirect()->to('/inicio');
}
    
    
    
     public function perfilUserPagina()
    {
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');
        
        // Verificamos si el id en la URL coincide con el id del usuario que ha iniciado sesión
        if ($id != session()->get('id')) {
            // Si no coinciden, redirigimos al inicio
            return redirect()->to('/inicio');
        }
        
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('perfilUserPaginaView',$data);
    }
    
    
    
      public function actualizarPagina()
{
    $model = new UsuarioModel();
    $id = $this->request->getVar('id');
    $usuarioActual = $model->find($id);
    $password = $usuarioActual['password']; // Tomamos la contraseña actual por si no se quiere cambiar
    $id_roles = $usuarioActual['id_roles']; // Tomamos el rol actual
        

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
        'email'=>[
             'rules'=>'required|valid_email|is_unique[usuarios.email,id,'.$id.']',
             'errors'=>[
                 'required' => 'El email es obligatorio',
                'valid_email' => 'El email no tiene un formato válido',
                'is_unique' => 'Este email ya está registrado',
             ]
         ],
        'imagen' => [
            'rules' => 'is_image[imagen]|max_size[imagen,1024]|mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png]',
            'errors' => [
                'is_image' => 'El archivo debe ser una imagen válida.',
                'max_size' => 'La imagen no debe superar los 1MB.',
                'mime_in' => 'El archivo debe ser de tipo JPG, JPEG, GIF o PNG.',
            ]
        ],
    ];

    // Si el checkbox "Mostrar Contraseña" está marcado
    if ($mostrar) {
    // Reglas de validación
    $rules['password'] = [
        'rules' => 'required|password_check['.$password.']', 
        'errors' => [
            'required' => 'Debes introducir una contraseña',
            'password_check' => 'La contraseña antigua es incorrecta',
        ]
    ];

    $rules['new_password'] = [
        'rules' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
        'errors' => [
            'required' => 'Debes introducir una nueva contraseña',
            'min_length' => 'La nueva contraseña debe tener al menos 6 caracteres',
            'regex_match' => 'Debe tener una letra minúscula, una letra mayúscula, un número y un símbolo especial',
        ]
    ];

    // Encriptamos la nueva contraseña en MD5
    $password = md5($this->request->getVar('new_password'));
}


    // Validamos los datos del formulario
    $datos = $this->request->getPost(array_keys($rules));

    // Si no pasa la validación, redirigimos con los errores
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Obtenemos los datos para actualizados
    $usuario = $this->request->getVar('usuario');
    $email = $this->request->getVar('email');

    // Preparamos los datos para la actualización
    $updateData = [
        'id_roles' => $id_roles,
        'usuario' => $usuario,
        'password' => $password,  // Se actualiza la contraseña si es necesario
        'email' => $email,
        'updated_at' => date("Y-m-d h:i:s")
    ];
        
     
    // Si se subió una nueva imagen
    if ($this->request->getFile('imagen')->isValid()) {
        // Obtener el archivo de la imagen
        $file = $this->request->getFile('imagen');
        $ext = $file->guessExtension(); // Obtener la extensión del archivo

        // Crear un nombre único para la imagen
        $imageName = "Usuario_".$id.".".$ext;

        // Mover la imagen al directorio correspondiente
        $file->move(ROOTPATH . 'public/uploads', $imageName, true);

        // Establecer la ruta de la imagen
        $imagePath = 'public/uploads/'.$imageName;

        // Agregar la ruta de la imagen a los datos de actualización
        $updateData['imagen'] = $imagePath;
        
        session()->set('imagen', $imagePath);
    }

    // Actualizamos los datos en la base de datos
    $model->where('id', $id)
        ->set($updateData)
        ->update();
    session()->set('usuario', $usuario);

    // Redirigimos a la lista de usuarios
    return redirect()->to('/');
}
    
    
    
    
    
    
    
    public function volver()
    {
        return redirect()->to('/inicio');
    }
    
    
    public function verificarContrasena()
    {
        
        $passwordIngresada = $this->request->getPost('password');

        $userId = session()->get('id');
        
        $usuarioModel=new UsuarioModel();
        $usuario=$usuarioModel->where('id',$userId)->first();
        
        $passwordIngresadaMD5 = md5($passwordIngresada);

        if ($passwordIngresadaMD5 === $usuario['password']) {
            // La contraseña es correcta
            return $this->response->setJSON(['success' => true]);
        } else {
            // La contraseña es incorrecta
            return $this->response->setJSON(['success' => false]);
        }
    }

}


