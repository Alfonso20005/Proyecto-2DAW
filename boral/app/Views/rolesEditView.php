
<?php include("templates/parte1.php");?>
<title>Boral | Roles Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR ROLE</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/roles/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    <div class="col-12 col-md-6">
        
             <?php validation_list_errors();
            $errors=validation_errors();
            ?>

        <form action="<?php echo baseUrl();?>/roles/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" class="form-control" id="id" name="id"  value="<?= $datos["id"];?>">    

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                     <?php
                            if(isset($errors["role"])) 
                                $valor=$datos["role"]; 
                            else { 
                            if(set_value("role")!="")  $valor=set_value("role");
                            else  $valor=$datos["role"]; 
                            }
                        ?>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["role"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-crown"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["role"]) ? 'is-invalid border border-danger' : ''; ?>" id="role" name="role" placeholder="Role" value="<?= $datos["role"];?>">
                         <?php if(isset($errors["role"])): ?>
                            <div class="invalid-feedback">
                                    <?php echo validation_show_error('role'); ?>
                            </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3"> 
                <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
            </div>

        </form>
        
    </div>
</div>
<?php include("templates/parte2.php");?>