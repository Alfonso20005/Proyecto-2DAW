<?php include("templates/parte1.php");?>
<title>Boral | Distribuidores New</title>
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">CREAR DISTRIBUIDOR</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/distribuidores/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>

    <div class="col-12">

        <?php validation_list_errors(); $errors=validation_errors(); ?>

        <form action="<?php echo baseUrl();?>/distribuidores/crear" method="post" enctype="multipart/form-data" id="form1">

            
            <div class="container bg-light-gray p-3 rounded mb-3 col-12">
                <div class="mb-3 col-md-6 pl-0">
                    <label for="id_usuarios" class="form-label">Usuario</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["id_usuarios"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                         <?php echo form_dropdown('id_usuarios',$optionsUsuarios,set_value('id_usuarios'),'class="' . (isset($errors["id_usuarios"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . '" id="id_usuarios" ');?>
                    </div>
                    <?php
                    if(isset($errors["id_usuarios"])) echo validation_show_error('id_usuarios');  
                    ?> 
                </div>   

                <!-- Checkbox para Crear Usuario -->
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="crear_usuario" name="crear_usuario" 
                        <?php echo set_value('crear_usuario') ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="crear_usuario">
                        <strong>Crear usuario</strong>
                    </label>
                </div>
                
                <!-- Campos adicionales (se mostrarán u ocultarán al marcar/desmarcar el checkbox) -->
                <div id="campos_adicionales" style="display:none;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="usuario" class="form-label">Nombre de Usuario</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>" id="usuario" name="usuario" placeholder="Nombre de usuario" value="<?= set_value('usuario');?>">
                        </div>
                        <?php
                        if(isset($errors["usuario"])) echo validation_show_error('usuario');  
                        ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>" id="password" name="password" placeholder="Contraseña">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="fa fa-eye"></i> <!-- Icono para el botón de mostrar/ocultar -->
                            </button>
                        </div>
                        <?php
                        if(isset($errors["password"])) echo validation_show_error('password');  
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="repetir_password" class="form-label">Repetir Contraseña</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["repetir_password"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            </div>
                          <input type="password" class="form-control <?php echo isset($errors["repetir_password"]) ? 'is-invalid border border-danger' : ''; ?>" id="repetir_password" name="repetir_password" placeholder="Repetir Contraseña">
                        
                            <button type="button" class="btn btn-outline-secondary" id="toggleRepetirPassword">
                                <i class="fa fa-eye"></i> <!-- Icono para el botón de mostrar/ocultar -->
                            </button>
                            
                        </div>
                        <?php
                        if(isset($errors["repetir_password"])) echo validation_show_error('repetir_password');  
                        ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= set_value('email');?>">
                        </div>
                        <?php
                        if(isset($errors["email"])) echo validation_show_error('email');  
                        ?>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row mb-3">
            <div class="mb-3 col-md-6">
                <label for="razon_social" class="form-label">Razon Social</label>

                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>" id="razon_social" name="razon_social" placeholder="Razon Social" value="<?= set_value('razon_social');?>">
                </div>
                <?php
                    if(isset($errors["razon_social"])) echo validation_show_error('razon_social');  
                ?>

            </div>
            
             <div class="mb-3 col-md-6">
                <label for="nombre" class="form-label">Nombre</label>

                 <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre" value="<?= set_value('nombre');?>">
                 </div>
                <?php
                    if(isset($errors["nombre"])) echo validation_show_error('nombre');  
                ?>

            </div>


            <div class="mb-3 col-md-4">
                <label for="apellidos" class="form-label">Apellidos</label>
                 <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?= set_value('apellidos');?>">
                </div>
                <?php
                    if(isset($errors["apellidos"])) echo validation_show_error('apellidos');  
                ?>
            </div>


            <div class="mb-3 col-md-4">
                <label for="telefono" class="form-label">Telefono</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>" id="telefono" name="telefono" placeholder="Telefono" value="<?= set_value('telefono');?>">
                </div>
                <?php
                    if(isset($errors["telefono"])) echo validation_show_error('telefono');  
                ?>
            </div>
            
            <div class="mb-3 col-md-4">
                <label for="cif_nif_nie" class="form-label">Cif/Nif/Nie</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["cif_nif_nie"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-passport"></i></span>
                    </div>
                     <input type="text" class="form-control <?php echo isset($errors["cif_nif_nie"]) ? 'is-invalid border border-danger' : ''; ?>" id="cif_nif_nie" name="cif_nif_nie" placeholder="Cif/Nif/Nie" value="<?= set_value('cif_nif_nie');?>">
                </div>
                <?php
                    if(isset($errors["cif_nif_nie"])) echo validation_show_error('cif_nif_nie');  
                ?>
            </div>
            
            </div>
            
         

            <div class="mb-3"> 
                <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
            </div>

        </form>

    </div>
</div>
<?php include("templates/parte2.php");?>

<!-- jQuery para manejar el checkbox -->
<script>
    $(document).ready(function() {
        // Mostrar u ocultar los campos adicionales dependiendo del checkbox y si hay un usuario seleccionado
        function toggleCamposAdicionales() {
            const usuarioSeleccionado = $('#id_usuarios').val();
            if (usuarioSeleccionado && usuarioSeleccionado !== 'ninguno') {
                // Si hay un usuario seleccionado, ocultamos los campos adicionales y desmarcamos el checkbox
                $('#campos_adicionales').hide();
                $('#crear_usuario').prop('checked', false).prop('disabled', true); // Deshabilitar el checkbox
            } else {
                // Si no hay usuario seleccionado o es 'ninguno', mostramos el checkbox y campos adicionales
                $('#crear_usuario').prop('disabled', false); // Habilitar el checkbox
                if ($('#crear_usuario').is(':checked')) {
                    $('#campos_adicionales').show();
                }
            }
        }

        // Llamar a la función de inicio para ajustar el estado de los campos
        toggleCamposAdicionales();

        // Cuando se marque o desmarque el checkbox "Crear usuario"
        $('#crear_usuario').change(function() {
            if ($(this).is(':checked')) {
                $('#campos_adicionales').show();
            } else {
                $('#campos_adicionales').hide();
            }
        });

        // Cuando cambie la selección del usuario
        $('#id_usuarios').change(function() {
            toggleCamposAdicionales();
        });
        
        
         $('#togglePassword').click(function() {
            var passwordField = $('#password');
            var icon = $(this).find('i');

            // Alternar el tipo de campo entre password y text
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash'); // Cambiar el ícono
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye'); // Cambiar el ícono
            }
        });

        // Lo mismo para "Repetir Contraseña"
        $('#toggleRepetirPassword').click(function() {
            var repetirPasswordField = $('#repetir_password');
            var icon = $(this).find('i');

            // Alternar el tipo de campo entre password y text
            if (repetirPasswordField.attr('type') === 'password') {
                repetirPasswordField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash'); // Cambiar el ícono
            } else {
                repetirPasswordField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye'); // Cambiar el ícono
            }
        });
    });
</script>

<style>
  .bg-light-gray {
    background-color: #d3d3d3; /* Gris claro */
  }
</style>





