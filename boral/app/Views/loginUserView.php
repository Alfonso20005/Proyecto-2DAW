<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boral | Login User</title>
    <link rel="shortcut icon" href="<?php echo baseUrl();?>/public/templates/assets/images/boral.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?php echo baseUrl();?>/templates/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo baseUrl();?>/templates/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo baseUrl();?>/templates/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <style>
    
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    list-style: none;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #c9ffcc;
}


.container{
    position: relative;
    width: 850px;
    height: 550px;
    background: #fff;
    margin: 20px;
    border-radius: 30px;
    box-shadow: 0 0 30px rgba(0, 0, 0, .2);
    overflow: hidden;
}

    .container h1{
        font-size: 36px;
        margin: -10px 0;
        color: white !important;
    }

    .container p{
        font-size: 14.5px;
        margin: 15px 0;
    }

form{ width: 100%; }

.form-box{
    position: absolute;
    right: 0;
    width: 50%;
    height: 100%;
    background: #fff;
    display: flex;
    align-items: center;
    color: #333;
    text-align: center;
    padding: 40px;
    z-index: 1;
    transition: .6s ease-in-out 1.2s, visibility 0s 1s;
}

    .container.active .form-box{ right: 50%; }

    .form-box.register{ visibility: hidden; }
        .container.active .form-box.register{ visibility: visible; }

.input-box{
    position: relative;
    margin: 30px 0;
}

    .input-box input{
        width: 100%;
        padding: 13px 50px 13px 20px;
        background: #eee;
        border-radius: 8px;
        border: none;
        outline: none;
        font-size: 16px;
        color: #333;
        font-weight: 500;
    }

        .input-box input::placeholder{
            color: #888;
            font-weight: 400;
        }
    
    .input-box i{
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

.forgot-link{ margin: -15px 0 15px; }
    .forgot-link a{
        font-size: 14.5px;
        color: #333;
    }

.btn{
    width: 100%;
    height: 48px;
    background: #78ec74;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    font-weight: 600;
}

.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.social-icons a {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    color: #333;
    text-decoration: none;
    background-color: #fff;
    transition: background-color 0.3s ease;
}

.social-icons a:hover {
    background-color: #f5f5f5;
}

.social-icons i {
    font-size: 20px;
    margin-right: 10px;
}


.toggle-box{
    position: absolute;
    width: 100%;
    height: 100%;
}

    .toggle-box::before{
        content: '';
        position: absolute;
        left: -250%;
        width: 300%;
        height: 100%;
        background: #78ec74;
        /* border: 2px solid red; */
        border-radius: 150px;
        z-index: 2;
        transition: 1.8s ease-in-out;
    }

        .container.active .toggle-box::before{ left: 50%; }

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    /* background: seagreen; */
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 2;
    transition: .6s ease-in-out;
}

    .toggle-panel.toggle-left{ 
        left: 0;
        transition-delay: 1.2s; 
    }
        .container.active .toggle-panel.toggle-left{
            left: -50%;
            transition-delay: .6s;
        }

    .toggle-panel.toggle-right{ 
        right: -50%;
        transition-delay: .6s;
    }
        .container.active .toggle-panel.toggle-right{
            right: 0;
            transition-delay: 1.2s;
        }

    .toggle-panel p{ margin-bottom: 20px; }

    .toggle-panel .btn{
        width: 160px;
        height: 46px;
        background: transparent;
        border: 2px solid #fff;
        box-shadow: none;
    }

@media screen and (max-width: 650px){
    .container{ height: calc(100vh - 40px); }

    .form-box{
        bottom: 0;
        width: 100%;
        height: 70%;
    }

        .container.active .form-box{
            right: 0;
            bottom: 30%;
        }

    .toggle-box::before{
        left: 0;
        top: -270%;
        width: 100%;
        height: 300%;
        border-radius: 20vw;
    }

        .container.active .toggle-box::before{
            left: 0;
            top: 70%;
        }

        .container.active .toggle-panel.toggle-left{
            left: 0;
            top: -30%;
        }

    .toggle-panel{ 
        width: 100%;
        height: 30%;
    }
        .toggle-panel.toggle-left{ top: 0; }
        .toggle-panel.toggle-right{
            right: 0;
            bottom: -30%;
        }

            .container.active .toggle-panel.toggle-right{ bottom: 0; }
}
        
        .forgot-password {
    margin-top: 10px;
    text-align: center;
}

.forgot-password a {
    font-size: 14px;
    color: #0d6efd;  /* color azul link */
    text-decoration: none;
    transition: color 0.3s;
}

.forgot-password a:hover {
    color: #084298; /* tono más oscuro al pasar el mouse */
}

@media screen and (max-width: 400px){
    .form-box { padding: 20px; }

    .toggle-panel h1{font-size: 30px; }
}

    </style>
</head>
  <body>

      <div class="container">
          <div class="form-box login">
              <form method="post" action="<?php echo baseUrl();?>/SiginController/loginAuthUser" id="formularioLogin">
                  <h1 style="color: #000 !important">Iniciar Sesion</h1>
                   <?php if (isset($validation) && !empty($validation->getErrors()) && ($validation->hasError('username') || $validation->hasError('password'))): ?>
                <br>
                                <div class="alert alert-danger">
                                
                                        <?php foreach ($validation->getErrors() as $error): ?>
                                            <span><?= esc($error); ?></span>
                                <br>
                                        <?php endforeach; ?>
                                    
                                </div>
                            <?php endif; ?>
                  <div class="input-box">
                      <input type="text" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                      <i class='bx bxs-user'></i>
                  </div>
                  <!-- Formulario de Login -->
                <div class="input-box">
                    <input type="password"  placeholder="Password" id="password"  name="password"/>
                    <i class='bx bxs-lock-alt' id="lock-icon-login" style="cursor: pointer;"></i>
                    <i class='bx bxs-lock-open-alt' id="unlock-icon-login" style="display: none; cursor: pointer;"></i>
                </div>
                  <!-- <div class="forgot-link">
                      <a href="#">Forgot Password?</a>
                  </div> -->
                  <button type="submit" class="btn">Iniciar Sesion</button>
                  
                   <div class="forgot-password">
                        <a href="<?php echo base_url() ?>olvidar_contrasena">¿Olvidaste tu contraseña?</a>
                    </div>
                  <!-- <p>o con otras plataformas</p> -->
                  <div class="social-icons">
                    <a href="#" class="social-btn">
                        <i class='bx bxl-google'></i> Ingresar con Google
                    </a>
                </div>
                
              </form>
          </div>

          <div class="form-box register">
              <form method="post" action="<?php echo baseUrl();?>/registro" id="formularioRegistro">
                  <h1 style="color: #000 !important">Registrarse</h1>
                  <?php if (isset($validation) && !empty($validation->getErrors()) && !$validation->hasError('username')): ?>
                                                <br>

                          <div class="alert alert-danger">
                                    <?php foreach ($validation->getErrors() as $error): ?>
                                        <span><?= esc($error); ?></span>
                              <br>
                                    <?php endforeach; ?>
                                
                            </div>
                        <?php endif; ?>
                  <div class="input-box">
                      <input type="text" placeholder="Username" id="user" name="user">
                      <i class='bx bxs-user'></i>
                  </div>
                  <div class="input-box">
                      <input type="email" placeholder="Email" id="emailRegistro" name="emailRegistro" >
                      <i class='bx bxs-envelope' ></i>
                  </div>
                  <!-- Formulario de Registro -->
                <div class="input-box">
                    <input type="password" placeholder="Password" id="register-password" name="register-password" />
                    <i class='bx bxs-lock-alt' id="lock-icon-register" style="cursor: pointer;"></i>
                    <i class='bx bxs-lock-open-alt' id="unlock-icon-register" style="display: none; cursor: pointer;"></i>
                </div>
                  <button type="submit" class="btn">Registrarse</button>
                  <!-- <p>o con otras plataformas</p> -->
                  <div class="social-icons">
                    <a href="#" class="social-btn">
                        <i class='bx bxl-google'></i> Ingresar con Google
                    </a>
                </div>
                
              </form>
          </div>

          <div class="toggle-box">
              <div class="toggle-panel toggle-left">
                  <h1>Bienvenido de nuevo!</h1>
                  <p>¿No tienes una cuenta?</p>
                  <button class="btn register-btn">Registrarse</button>
              </div>

              <div class="toggle-panel toggle-right">
                  <h1>Hola, Bienvenido!</h1>
                  <p>¿Ya tienes una cuenta?</p>
                  <button class="btn login-btn">Iniciar Sesion</button>
              </div>
          </div>
      </div>

      <script>
      const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

//FORMULARIOS
const formularioLogin = document.getElementById("formularioLogin");
const formularioRegistro = document.getElementById("formularioRegistro");


//CAMPOS LOGIN
//PASSWORD
const loginPasswordInput = document.getElementById('password');
const lockIconLogin = document.getElementById('lock-icon-login');
const unlockIconLogin = document.getElementById('unlock-icon-login');


//CAMPOS REGISTRO
//PASSWORD
const registerPasswordInput = document.getElementById('register-password');
const lockIconRegister = document.getElementById('lock-icon-register');
const unlockIconRegister = document.getElementById('unlock-icon-register');


//BOTON REGISTRO
registerBtn.addEventListener('click', () => {
    // Restablecer los formularios
    formularioRegistro.reset();  // Resetear formulario de registro
    formularioLogin.reset();  // Resetear formulario de login

    // Restablecer tipo de input a "password" y los iconos del candado
    resetPasswordField('login');
    resetPasswordField('register');

    container.classList.add('active');
});

//BOTON LOGIN
loginBtn.addEventListener('click', () => {
    // Restablecer los formularios
    formularioRegistro.reset();  // Resetear formulario de registro
    formularioLogin.reset();  // Resetear formulario de login

    // Restablecer tipo de input a "password" y los iconos del candado
    resetPasswordField('login');
    resetPasswordField('register');
    container.classList.remove('active');
});

document.addEventListener('DOMContentLoaded', function() {
    let loginPasswordVisible = false; // Variable para controlar el estado del icono del candado

    lockIconLogin.addEventListener('click', function() {
        loginPasswordInput.type = 'text';  // Mostrar el password
        lockIconLogin.style.display = 'none';  // Ocultar candado cerrado
        unlockIconLogin.style.display = 'block';  // Mostrar candado abierto
        loginPasswordVisible = true;  // Marcamos como visible
    });

    unlockIconLogin.addEventListener('click', function() {
        loginPasswordInput.type = 'password';  // Cambiar a tipo password
        unlockIconLogin.style.display = 'none';  // Ocultar candado abierto
        lockIconLogin.style.display = 'block';  // Mostrar candado cerrado
        loginPasswordVisible = false;  // Marcamos como oculto
    });

    let registerPasswordVisible = false;  // Variable para controlar el estado del icono del candado

    lockIconRegister.addEventListener('click', function() {
        registerPasswordInput.type = 'text';  // Mostrar el password
        lockIconRegister.style.display = 'none';  // Ocultar candado cerrado
        unlockIconRegister.style.display = 'block';  // Mostrar candado abierto
        registerPasswordVisible = true;  // Marcamos como visible
    });

    unlockIconRegister.addEventListener('click', function() {
        registerPasswordInput.type = 'password';  // Cambiar a tipo password
        unlockIconRegister.style.display = 'none';  // Ocultar candado abierto
        lockIconRegister.style.display = 'block';  // Mostrar candado cerrado
        registerPasswordVisible = false;  // Marcamos como oculto
    });
});


// Función para restablecer los campos de contraseña y los iconos del candado
function resetPasswordField(formType) {
    let passwordInput, lockIcon, unlockIcon;

    if (formType === 'login') {
        passwordInput = loginPasswordInput;
        lockIcon = lockIconLogin;
        unlockIcon = unlockIconLogin;
    } else if (formType === 'register') {
        passwordInput = registerPasswordInput;
        lockIcon = lockIconRegister;
        unlockIcon = unlockIconRegister;
    }

    // Restablecer tipo de input a "password"
    passwordInput.type = 'password';
    // Restaurar iconos a su estado original
    lockIcon.style.display = 'block';
    unlockIcon.style.display = 'none';
}

      </script>
  </body>
</html>