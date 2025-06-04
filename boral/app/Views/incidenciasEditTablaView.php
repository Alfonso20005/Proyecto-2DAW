
<?php include("templates/parte1.php");?>
<title>Boral | Incidencias Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR INCIDENCIA</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/incidencias/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    <div class="col-12 col-md-6">
        
             <?php validation_list_errors();
            $errors=validation_errors();
            ?>

        <form action="<?php echo baseUrl();?>/incidencias/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" class="form-control" id="id" name="id"  value="<?= $datos["id"];?>">    

            <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <div class="input-group">
                <div class="input-group-prepend <?php echo isset($errors["estado"]) ? 'is-invalid border border-danger' : ''; ?>">
                    <span class="input-group-text"><i class="fa-solid fa-flag"></i></span>
                </div>
                <select class="form-control <?php echo isset($errors["estado"]) ? 'is-invalid border border-danger' : ''; ?>" id="estado" name="estado">
                    <option value="sin resolver" <?= ($datos["estado"] == "sin resolver") ? "selected" : ""; ?>>Sin resolver</option>
                    <option value="resuelto" <?= ($datos["estado"] == "resuelto") ? "selected" : ""; ?>>Resuelto</option>
                </select>
                <?php if (isset($errors["estado"])): ?>
                    <div class="invalid-feedback">
                        <?php echo validation_show_error('estado'); ?>
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