<?php include("templates/parte1.php");?>
<title>Boral | Roles New</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">CREAR ROLE</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/roles/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12 col-md-6">
        <?php validation_list_errors(); 
        $errors = validation_errors();
        ?>

        <form action="<?php echo baseUrl();?>/roles/crear" method="post" enctype="multipart/form-data" id="form1">
            
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["role"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-crown"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["role"]) ? 'is-invalid border border-danger' : ''; ?>" id="role" name="role" placeholder="Role" value="<?= set_value('role'); ?>">
                    
                    <!-- Mostrar error si existe -->
                    <?php if (isset($errors["role"])): ?>
                        <div class="invalid-feedback">
                            <?php echo validation_show_error('role'); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
                
            </div>

            <!-- Botón de envío -->
            <div class="mb-3"> 
                <button type="submit" class="btn btn-primary w-100" id="btnform11">Aceptar</button>
            </div>

        </form>
    </div>
</div>

<?php include("templates/parte2.php");?>


