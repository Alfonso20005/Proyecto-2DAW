<?php include("templates/parte1.php");?>
<title>Boral | Usuarios Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR USUARIO</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/usuarios/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
        <?php validation_list_errors(); $errors=validation_errors(); ?>

        <form action="<?php echo baseUrl();?>/usuarios/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" name="id" id="id" value="<?= $datos["id"];?>">
            
            <!-- Usuario -->
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>" id="usuario" name="usuario" placeholder="Usuario" value="<?= rellenarDato($errors,$datos,"usuario");?>">
                </div>
                <?php if(isset($errors["usuario"])) echo validation_show_error('usuario'); ?>
            </div>

            <div class="container bg-light-gray p-3 rounded mb-3 col-12">
                 
            <!-- Checkbox para mostrar/editar la contraseña -->
                
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="mostrar" name="mostrar" 
                        <?php echo set_value('mostrar') ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="mostrar">
                        <strong>Cambiar Contraseña</strong>
                    </label>
                </div>
                <!-- Campos para cambiar contraseña (se muestran si el checkbox está marcado) -->
                <div id="campos_password" style="display:none;">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-prepend <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>" id="password" name="password" placeholder="Contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            <?php if(isset($errors["password"])) echo validation_show_error('password'); ?>
                        </div>

                        <div class="col-6 mb-3">
                            <label for="password1" class="form-label">Repetir Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-prepend <?php echo isset($errors["password1"]) ? 'is-invalid border border-danger' : ''; ?>">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control <?php echo isset($errors["password1"]) ? 'is-invalid border border-danger' : ''; ?>" id="password1" name="password1" placeholder="Repetir Contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password1">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            <?php if(isset($errors["password1"])) echo validation_show_error('password1'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= rellenarDato($errors,$datos,"email");?>">
                </div>
                <?php if(isset($errors["email"])) echo validation_show_error('email'); ?>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="id_roles" class="form-label">Role</label>
                <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["id_roles"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa-solid fa-crown"></i></span>
                        </div>
                    <?php echo form_dropdown('id_roles',$optionsRoles, rellenarDato($errors,$datos,"id_roles"),'class="' . (isset($errors["id_roles"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . ' id="id_roles" ');?>
                </div>    
                <?php if(isset($errors["id_roles"])) echo validation_show_error('id_roles'); ?>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
            </div>

        </form>
    </div>
</div>
<?php include("templates/parte2.php");?>

<script>
$(document).ready(function() {
    // Al cambiar el checkbox "Mostrar Contraseña"
    $("#mostrar").change(function() {
        // Mostrar u ocultar los campos de contraseña
        $("#campos_password").toggle($(this).is(":checked"));
    });

    // Si el checkbox "Mostrar Contraseña" está marcado por defecto
    if ($("#mostrar").is(":checked")) {
        $("#campos_password").show();
    }
    
    
     $(".toggle-password").click(function() {
        var targetInput = $("#" + $(this).data("target"));
        var icon = $(this).find("i");

        // Alternar entre 'password' y 'text'
        if (targetInput.attr("type") === "password") {
            targetInput.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            targetInput.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});
</script>

<style>
.bg-light-gray {
    background-color: #d3d3d3; /* Gris claro */
  }
.form-check-input {
    width: 15px;
    height: 15px;
    border-radius: 4px;
    background-color: #f0f0f0;
    border: 2px solid #ccc;
    transition: all 0.3s ease;
}
</style>
