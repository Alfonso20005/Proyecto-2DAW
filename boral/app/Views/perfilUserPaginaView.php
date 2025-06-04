<!DOCTYPE html>
<html lang="en">
<head>
    <title>Boral | Perfil Usuario</title>
   <!-- Head -->
    <?php include("templates/headPagina.php"); ?>
</head>
<body>
    <!-- Header -->
    <?php include("templates/headerPagina.php"); ?>

    <br><br><br>
<div class="container">
    <div class="row justify-content-end">
        <div class="col-auto">
            <a href="<?php echo baseUrl();?>/perfilUser/volver" class="custom-link">
                <div class="hover-bg">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                    <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000"></path>
                    <path d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z" fill="#000000"></path>
                  </svg>
                </div>
                <span>Volver</span>
            </a>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center no-gutters">
    <!-- Contenedor Flex para la imagen y el formulario -->
    <div class="col-12 d-flex justify-content-center">
        
    
        <!-- Contenedor de la imagen de perfil a la izquierda -->
        <div class="col-12 col-md-4 d-flex justify-content-center flex-column align-items-center image-container">
            <div class="profile-image-wrapper">
                <img src="<?php echo session()->get('imagen');?>" alt="Imagen de perfil" class="profile-image" id="profile-image">
            </div>
            <!-- Botón de Cerrar Sesión debajo de la imagen -->
            <div class="text-center mt-3 w-35">
                <button class="Btn logout">
                    <div class="sign">
                      <svg viewBox="0 0 512 512">
                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                      </svg>
                    </div>
                    <div class="text">Cerrar</div>
                </button>
            </div>
        </div>


        <!-- Formulario de edición de perfil a la derecha -->
        <div class="col-12 col-md-6 form-container">
            <?php validation_list_errors(); $errors=validation_errors(); ?> 
            <h2 class="text-center mb-4">Editar Perfil</h2>
            <form action="<?php echo baseUrl();?>/perfilUserPagina/actualizarPagina" method="post" enctype="multipart/form-data" id="form1">
                <input type="hidden" name="id" id="id" value="<?= $datos["id"];?>">

                <!-- Usuario -->
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>" id="usuario" name="usuario" value="<?= rellenarDato($errors, $datos, "usuario");?>">
                    </div>
                    <?php if (isset($errors["usuario"])) echo validation_show_error('usuario'); ?>
                </div>

                <!-- Checkbox para mostrar/ocultar las contraseñas -->
                
       <!-- Checkbox para mostrar/ocultar las contraseñas -->
<div class="mb-3">
 
    <label for="mostrar" class="form-label mb-0" style="white-space: nowrap;">¿Cambiar contraseña?</label>
    
    <label class="switch-wrapper mb-0">
      <input type="checkbox" class="switch-input" id="mostrar" name="mostrar" <?php echo set_value('mostrar') ? 'checked' : ''; ?>>
      <div class="switch-slider">
        <div class="icon icon-lock">
          <svg viewBox="0 0 100 100" width="20" height="20">
            <path d="M30,46V38a20,20,0,0,1,40,0v8a8,8,0,0,1,8,8V74a8,8,0,0,1-8,8H30a8,8,0,0,1-8-8V54A8,8,0,0,1,30,46Zm32-8v8H38V38a12,12,0,0,1,24,0Z" fill-rule="evenodd"></path>
          </svg>
        </div>
        <div class="icon icon-unlock">
          <svg viewBox="0 0 100 100" width="20" height="20">
            <path d="M50,18A19.9,19.9,0,0,0,30,38v8a8,8,0,0,0-8,8V74a8,8,0,0,0,8,8H70a8,8,0,0,0,8-8V54a8,8,0,0,0-8-8H38V38a12,12,0,0,1,23.6-3,4,4,0,1,0,7.8-2A20.1,20.1,0,0,0,50,18Z"/>
          </svg>
        </div>
      </div>
    </label>
  
</div>

               

                <!-- Campos de contraseña -->
                <div class="mb-3" id="old-password-container" style="display: none;">
                    <label for="password" class="form-label">Contraseña anterior:</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>" id="password" name="password" placeholder="Contraseña antigua">
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <?php if (isset($errors["password"])) echo validation_show_error('password'); ?>
                </div>

                <div class="mb-3" id="password-container" style="display: none;">
                    <label for="new_password" class="form-label">Nueva contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["new_password"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control <?php echo isset($errors["new_password"]) ? 'is-invalid border border-danger' : ''; ?>" id="new_password" name="new_password" placeholder="Nueva contraseña">
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <?php if (isset($errors["new_password"])) echo validation_show_error('new_password'); ?>
                </div>

                <!-- Correo electrónico -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" value="<?= rellenarDato($errors, $datos, "email");?>">
                    </div>
                    <?php if (isset($errors["email"])) echo validation_show_error('email'); ?>
                </div>
                
                <!-- Contenedor de la imagen -->
                
                <!-- Contenedor de la imagen -->
                <div class="form-group">
                  <input type="file" name="imagen" id="imagen" class="input-file">
                  <label for="imagen" class="btn btn-tertiary js-labelFile">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i> &nbsp;
                    <span class="js-fileName">Imagen de perfil</span>
                  </label>
                    <?php if (isset($errors["imagen"])) echo validation_show_error('imagen'); ?>
                </div>


                <button type="button" class="btn btn-primary w-100" onclick="pedirContrasenaGuardar()">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
    
    
    <?php include("templates/scripts.php"); ?>
    
</body>
</html>
<style>
    /* Contenedor para imagen y formulario */
    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .profile-image-wrapper {
        text-align: center;
    }

    .profile-image {
        width: 100%;  
        height: auto;
        max-width: 250px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Formulario de perfil */
    .form-container {
        width: 100%;
        max-width: 600px;
        padding: 20px;
        background-color: transparent;
        box-shadow: none;
        border-radius: 8px;
    }

    /* Responsive para móviles */
    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }

        .profile-image {
            max-width: 150px;
        }
    }
  /* Modificar el ancho del botón de archivo para que sea igual al de los campos del formulario */
.btn-tertiary {
    color: #555;
    padding: 0;
    line-height: 40px;
    width: 100%; /* Cambiado a 100% para que ocupe todo el ancho disponible */
    margin: auto;
    display: block;
    border: 2px solid #555;
}

.input-file {
    width: 100%; /* Cambiado a 100% para que el input ocupe todo el ancho disponible */
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

/* Asegura que el label también tenga el mismo ancho que el input */
.js-labelFile {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 0 10px;
    cursor: pointer;
    display: block; /* Cambiado para asegurarse que ocupe todo el ancho */
}

.help-block{
                color:#ff0000;
            }    
    
.is-invalid {
    border: 1.5px solid red !important;
    background-color: #f9e1e1; 
    animation: remover 1.3s ease-in-out;
}

.invalid-feedback {
    font-size: 15px; 
}
 @keyframes remover {
                0% {
                    transform: translateX(0);
                }
                25% {
                    transform: translateX(-5px);
                }
                50% {
                    transform: translateX(5px);
                }
                75% {
                    transform: translateX(-5px);
                }
                100% {
                    transform: translateX(0);
                }
            }


    
/*BOTON VOLVER PARA EL EDITAR USER DE LA PAGINA PRINCIPAL*/
.custom-link {
      position: relative;
      display: inline-block;
      width: 192px;
      height: 56px;
      background-color: white;
      border-radius: 16px;
      font-size: 20px;
      font-weight: 600;
      color: black;
      text-align: center;
      line-height: 56px;
      text-decoration: none;
      overflow: hidden;
      cursor: pointer;
    }

    .hover-bg {
      position: absolute;
      top: 4px;
      left: 4px;
      width: 48px;
      height: 48px;
      background-color: #4ade80;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: width 0.5s ease;
      z-index: 10;
    }

    .custom-link:hover .hover-bg {
      width: 184px;
    }

    .custom-link span {
      position: relative;
      z-index: 20;
      transform: translateX(8px);
      transition: opacity 0.3s ease;
    }

    .custom-link:hover span {
      opacity: 0;
    }

    .custom-link svg {
      width: 25px;
      height: 25px;
    }
    
    
    
    
/*    BTTON LOG OUT*/
    .Btn {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      width: 45px;
      height: 45px;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: width 0.3s, border-radius 0.3s;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      background-color: rgb(255, 65, 65);
    }

    .sign {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .sign svg {
      width: 17px;
      height: 17px;
    }

    .sign svg path {
      fill: white;
    }

    .text {
      position: absolute;
      right: 0;
      width: 0%;
      opacity: 0;
      color: white;
      font-size: 1.2em;
      font-weight: 600;
      white-space: nowrap;
      transition: all 0.3s ease;
    }

    .Btn:hover {
      width: 132px;
      border-radius: 40px;
    }

    .Btn:hover .sign {
      width: 30%;
      padding-left: 20px;
    }

    .Btn:hover .text {
      opacity: 1;
      width: 70%;
      padding-right: 10px;
    }

    .Btn:active {
      transform: translate(2px, 2px);
    }
    
    
    
/*    CHECKBOX*/
       .switch-wrapper {
  position: relative;
  width: 66px;
  height: 28px;
 margin-left: 0 !important;
    display: flex;
    justify-content: flex-start;
}

.switch-input {
  opacity: 0;
  width: 0;
  height: 0;
}

.switch-slider {
  background-color: #f87171; /* rojo (bg-rose-400) */
  border-radius: 9999px;
  width: 100%;
  height: 100%;
  position: relative;
  transition: background-color 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  cursor: pointer;
}

.switch-slider::before {
  content: "";
  position: absolute;
  height: 20px;
  width: 20px;
  top: 4px;
  left: 4px;
  background-color: #f9fafb; /* gray-50 */
  border-radius: 50%;
  transition: transform 0.3s ease;
  z-index: 2;
}

.icon {
  position: absolute;
  top: 2px;
  width: 40px;
  height: 40px;
  z-index: 1;
}

.icon-lock {
  left: 40px;
}

.icon-unlock {
  left: 2px;
}

.icon svg path {
  stroke: #111;
  fill: #111;
}

/* ON State */
.switch-input:checked + .switch-slider {
  background-color: #4ade80; /* verde (bg-emerald-500) */
}

.switch-input:checked + .switch-slider::before {
  transform: translateX(38px);
}
    
    
</style>

<script>
    
    // JavaScript para alternar la visibilidad de los campos de contraseña
    document.getElementById('mostrar').addEventListener('change', function () {
        var oldPasswordContainer = document.getElementById('old-password-container');
        var newPasswordContainer = document.getElementById('password-container');

        if (this.checked) {
            oldPasswordContainer.style.display = 'block';  // Muestra los campos de contraseña
            newPasswordContainer.style.display = 'block';  // Muestra los campos de contraseña
        } else {
            oldPasswordContainer.style.display = 'none';   // Oculta los campos de contraseña
            newPasswordContainer.style.display = 'none';   // Oculta los campos de contraseña
        }
    });

    // Si el checkbox estaba marcado previamente, asegúrate de que los campos de contraseña se muestren
    if ($("#mostrar").is(":checked")) {
        $("#old-password-container").show();
        $("#password-container").show();
    }
    
    
  (function() {
  'use strict';

  $('.input-file').each(function() {
    var $input = $(this),
        $label = $input.next('.js-labelFile'),
        labelVal = $label.html();
    
    $input.on('change', function(element) {
      var fileName = '';
      if (element.target.value) fileName = element.target.value.split('\\').pop();
      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
    });
  });

})();

    document.addEventListener("DOMContentLoaded", function() {
        // Seleccionamos todos los botones que alternan la visibilidad
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", function() {
                let targetInput = document.getElementById(this.getAttribute("data-target"));
                let icon = this.querySelector("i");

                // Alternar entre 'password' y 'text'
                if (targetInput.type === "password") {
                    targetInput.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash"); // Icono de ocultar 👀
                } else {
                    targetInput.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye"); // Icono de mostrar 🔒
                }
            });
        });
    });
    
    
</script>
