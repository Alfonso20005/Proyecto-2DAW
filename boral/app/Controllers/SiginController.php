<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class SiginController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        return view('loginView');
    }

    public function loginAuth()
{
    $rules = [
        'username' => [
            'rules'  => 'required',
            'errors' => ['required' => 'Debes introducir un nombre de usuario']
        ],
        'password' => [
            'rules'  => 'required|canLogin[username,password]',
            'errors' => [
                'required' => 'Debes introducir una contraseña',
                'canLogin' => 'Usuario o contraseña incorrectos'
            ]
        ],
    ];

    if (!$this->validate($rules)) {
        return view('loginView', ['validation' => $this->validator]);
    }

    // Obtener datos del usuario
    $username = $this->request->getVar('username');
    $userModel = new UsuarioModel();
    $data = $userModel->join('roles', 'usuarios.id_roles = roles.id')
        ->select('usuarios.id, usuarios.usuario, usuarios.password, usuarios.email,usuarios.imagen, usuarios.id_roles, roles.role')
        ->where('usuario', $username)
        ->first();

    // Guardar datos en la sesión
    $ses_data = [
        'id'       => $data['id'],
        'usuario'  => $data['usuario'],
        'email'    => $data['email'],
        'imagen'    => $data['imagen'],
        'id_roles' => $data['id_roles'],
        'role'     => $data['role'],
    ];
    session()->set($ses_data);

    return redirect()->to('/inicio');
}
    
    
       public function loginAuthUser()
{
    $rules = [
        'username' => [
            'rules'  => 'required',
            'errors' => ['required' => 'Introduce un nombre de usuario']
        ],
        'password' => [
            'rules'  => 'required|canLoginUser[username,password]',
            'errors' => [
                'required' => 'Introduce una contraseña',
                'canLoginUser' => 'Usuario o contraseña incorrectos'
            ]
        ],
    ];

    if (!$this->validate($rules)) {
        return view('loginUserView', ['validation' => $this->validator]);
    }

    // Obtener datos del usuario
    $username = $this->request->getVar('username');
    $userModel = new UsuarioModel();
    $data = $userModel->join('roles', 'usuarios.id_roles = roles.id')
        ->select('usuarios.id, usuarios.usuario, usuarios.password, usuarios.email,usuarios.imagen, usuarios.id_roles, roles.role')
        ->where('usuario', $username)
        ->first();

    // Guardar datos en la sesión
    $ses_data = [
        'id'       => $data['id'],
        'usuario'  => $data['usuario'],
        'email'    => $data['email'],
        'imagen'   => $data['imagen'],
        'id_roles' => $data['id_roles'],
        'role'     => $data['role'],
    ];
    session()->set($ses_data);
           
    if($data['role']=="Usuario"){
        return redirect()->to('/');
    }else{
        return redirect()->to('/inicio');
    }

    
}
    
    public function registro()
{
    $rules = [
        'user' => [
            'rules'  => 'required|is_unique[usuarios.usuario]',
            'errors' => [
                'required' => 'Introduce un nombre de usuario',
                'is_unique' => 'Este nombre de usuario ya existe'
            ]
        ],
        'emailRegistro' => [
            'rules'  => 'required|valid_email|is_unique[usuarios.email]',
            'errors' => [
                'required' => 'Introduce un correo electrónico',
                'valid_email' => 'Introduce un correo válido',
                'is_unique' => 'Este correo ya está registrado'
            ]
        ],
        'register-password' => [
            'rules'  => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
            'errors' => [
                'required' => 'Introduce una contraseña',
                'min_length' => 'La contraseña debe tener al menos 5 caracteres',
                'regex_match' => '1 minúscula, 1 mayúscula, 1 número, 1 símbolo especial',
            ]
        ],
    ];

    if (!$this->validate($rules)) {
        return view('loginUserView', ['validation' => $this->validator]);
    }

    $userModel = new UsuarioModel();

    $data = [
        'usuario' => $this->request->getVar('user'),
        'email'   => $this->request->getVar('emailRegistro'),
        'password' => md5($this->request->getVar('register-password')),
        'id_roles' => 4, 
        'imagen' => "public/uploads/generica.png", 
    ];

    $userModel->insert($data);

    // Obtener el usuario insertado
    $newUser = $userModel->where('usuario', $this->request->getVar('user'))->first();

    // Guardar en sesión
    $ses_data = [
        'id'       => $newUser['id'],
        'usuario'  => $newUser['usuario'],
        'email'    => $newUser['email'],
        'imagen'   => $newUser['imagen'],
        'id_roles' => $newUser['id_roles'],
        'role'     => 'Usuario'
    ];
    session()->set($ses_data);
        
    // Enviar el email de confirmación al usuario
    $email = service('email');
    $email->setMailType('html');
    $email->setFrom('ifc303@fpmarco.com', 'ERP BORAL');
    $email->setTo($newUser['email']);
    $email->setSubject('Bienvenido a ERP BORAL');

    // Contenido del mensaje de bienvenida
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
              ¡Bienvenido a ERP BORAL!
            </td>
          </tr>
          <tr>
            <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
              Hola, " . $newUser['usuario'] . ", gracias por registrarte.
            </td>
          </tr>
          <tr>
            <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
              Tu correo electrónico:
            </td>
          </tr>
          <tr>
            <td align='center' style='padding: 24px 0;'>
              <div style='display: inline-block; background-color: #f5f5f5; padding: 16px 24px; border-radius: 8px; font-size:32px; font-weight:bold; font-family: Arial, sans-serif; color:#000000;'>
                " . $newUser['email'] . "
              </div>
            </td>
          </tr>
          <tr>
            <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
              La contraseña la puedes cambiar desde tu perfil.
            </td>
          </tr>
          <tr>
            <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
              Saludos,<br><strong>Equipo Boral Pastelería</strong>
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


    $email->setMessage($mensajeHtml);

    // Enviar el correo
    $email->send();

    return redirect()->to('/');
}
    public function forgotPassword()
{
        return view('olvidarPasswordView');

}
    
    public function validar_correo()
{
        
        return view('olvidarPasswordView');

}
    
    public function validarCorreo()
{
    // Reglas de validación del correo
   $rules = [
        'email' => [
            'rules'  => 'required|valid_email|correoExistente',
            'errors' => [
                'required' => 'Introduce un correo electrónico',
                'valid_email' => 'Introduce un correo válido',
                'correoExistente' => 'El correo ingresado no está registrado'
            ]
        ],
    ];

    // Validamos el correo
    if (!$this->validate($rules)) {
        return view('olvidarPasswordView', ['validation' => $this->validator]);
    }

    // Obtenemos el email ingresado
    $email = $this->request->getVar('email');
        
    $codigoRecuperacion = rand(100000, 999999);
    session()->set('codigoRecuperacion', $codigoRecuperacion);
        
     $emailService = service('email');
    $emailService->setMailType('html');
    $emailService->setFrom('ifc303@fpmarco.com', 'ERP BORAL');
    $emailService->setTo($email);
    $emailService->setSubject('Recuperación de Contraseña - ERP BORAL');

    // Contenido del mensaje de recuperación de contraseña
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
                  Recuperar Contraseña
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                  Tu código de recuperación:
                </td>
              </tr>
              <tr>
                <td align='center' style='padding: 24px 0;'>
                  <div style='display: inline-block; background-color: #f5f5f5; padding: 16px 24px; border-radius: 8px; font-size:32px; font-weight:bold; letter-spacing: 8px; font-family: Arial, sans-serif; color:#000000;'>
                    $codigoRecuperacion
                  </div>
                </td>
              </tr>
              <tr>
                <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                  Saludos,<br><strong>Equipo Boral Pastelería</strong>
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

    $emailService->setMessage($mensajeHtml);

    $emailService->send();
        
    $data["email"]=$email;
       return view('numeroValidacionView',$data);
    }
    
    
    public function verificarCodigo()
{
    // Unir los 6 valores en un solo código
    $codigoIngresado = implode('', $this->request->getVar('codigo'));

    // Comprobamos si el código ingresado es igual al generado y almacenado en la sesión
    $codigoRecuperacion = session()->get('codigoRecuperacion');

    if ($codigoIngresado == $codigoRecuperacion) {
        
        return view('restablecerPasswordView');
    } else {
        // El código es incorrecto
        return view('numeroValidacionView', ['email' => $this->request->getVar('email'), 'error' => 'El código ingresado es incorrecto.']);
    }
}
    
  public function loginAuthNewPassword()
    {
        // Validar los datos de entrada
        $rules = [
            'username' => [
                'rules'  => 'required|max_length[20]|usuario_valido',
                'errors' => [
                    'required' => 'Introduce un usuario',
                    'max_length' => 'Maximo 20 letras',
                    'usuario_valido' => 'El usuario no está registrado'
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).+$/]',
                'errors' => [
                        'required' => 'Introduce una contraseña',
                        'min_length' => 'La contraseña debe tener al menos 5 caracteres',
                        'regex_match' => '1 minúscula, 1 mayúscula, 1 número, 1 símbolo especial',
                    ]
                ],
        ];
        
        
        // Verificamos si la validación pasa
        if (!$this->validate($rules)) {
            return view('restablecerPasswordView', ['validation' => $this->validator]);
        }

        // Obtenemos los datos del formulario
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Cargar el modelo de usuario
        $userModel = new UsuarioModel();

        // Verificamos si el usuario existe y actualizamos la contraseña en MD5
        $user = $userModel->where('usuario', $username)->first();

        if ($user) {
            // Actualizamos la contraseña del usuario
            $data = [
                'password' => md5($password), // Guardamos la contraseña en MD5
            ];

            // Actualizar la contraseña
            $userModel->update($user['id'], $data);

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->to("/");
        }

    }

    

}
