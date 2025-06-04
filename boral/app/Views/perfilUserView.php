<?php include("templates/parte1.php"); ?>
<title>Boral | Perfil Usuario</title>

<div class="container">
    <div class="row justify-content-end">
        <div class="col-auto">
            <a href="<?php echo baseUrl();?>/perfilUser/volver" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>&nbsp; Volver
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
                
                <a href="#" class="btn btn-danger w-100 logout"><i class="fa-solid fa-power-off"></i> &nbsp; Cerrar Sesión</a>
            </div>
        </div>


        <!-- Formulario de edición de perfil a la derecha -->
        <div class="col-12 col-md-6 form-container">
            <?php validation_list_errors(); $errors=validation_errors(); ?> 
            <h2 class="text-center mb-4">Editar Perfil</h2>
            <form action="<?php echo baseUrl();?>/perfilUser/actualizar" method="post" enctype="multipart/form-data" id="form1">
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
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="mostrar" name="mostrar" <?php echo set_value('mostrar') ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="mostrar"><strong>¿Cambiar contraseña?</strong></label>
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

<?php include("templates/parte2.php"); ?>

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
