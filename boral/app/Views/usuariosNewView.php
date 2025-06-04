
<?php include("templates/parte1.php");?>
<title>Boral | Usuarios New</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">CREAR USUARIO</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/usuarios/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
         <?php validation_list_errors();
                $errors=validation_errors();

            
        ?>
        
        <form action="<?php echo baseUrl();?>/usuarios/crear" method="post" enctype="multipart/form-data" id="form1">
    
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="usuario" class="form-label">Usuario</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control <?php echo isset($errors["usuario"]) ? 'is-invalid border border-danger' : ''; ?>" id="usuario" name="usuario" placeholder="Usuario" value="<?= set_value('usuario');?>">

                            <?php if (isset($errors["usuario"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('usuario'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control <?php echo isset($errors["password"]) ? 'is-invalid border border-danger' : ''; ?>" id="password" name="password" placeholder="Password">
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        
                         <?php if (isset($errors["password"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('password'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
                </div>


                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>

                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= set_value('email');?>">
                        <?php if (isset($errors["email"])): ?>
                                <div class="invalid-feedback">
                                    <?php echo validation_show_error('email'); ?>
                                </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="id_roles" class="form-label">Role</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["id_roles"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fa-solid fa-crown"></i></span>
                        </div>
                        <?php  echo form_dropdown('id_roles', $optionsRoles, set_value('id_roles'), 
                        'class="' . (isset($errors["id_roles"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . '" id="id_roles"');?>
                    </div>
                    <?php
                          if(isset($errors["id_roles"])) echo validation_show_error('id_roles');  
                        ?> 
                </div>


                <div class="mb-3 col-md-12"> 
                    <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
                </div>
            </div>  
        </form>
        
    </div>
    
</div>
<?php include("templates/parte2.php");?>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleccionamos todos los botones de alternar contraseña
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", function() {
                let targetInput = document.getElementById(this.getAttribute("data-target"));
                let icon = this.querySelector("i");

                // Alternar entre 'password' y 'text'
                if (targetInput.type === "password") {
                    targetInput.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash"); // Cambia a icono de ocultar
                } else {
                    targetInput.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye"); // Cambia a icono de mostrar
                }
            });
        });
    });
</script>
