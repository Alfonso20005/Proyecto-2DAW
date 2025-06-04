
<?php include("templates/parte1.php");?>
<title>Boral | Categorias Compra Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR CATEGORIA</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/categorias_compra/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    <div class="col-12 col-md-6">
        
             <?php validation_list_errors();
            $errors=validation_errors();
            ?>

        <form action="<?php echo baseUrl();?>/categorias_compra/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" class="form-control" id="id" name="id"  value="<?= $datos["id"];?>">    

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Categoria</label>
                     <?php
                            if(isset($errors["nombre"])) 
                                $valor=$datos["nombre"]; 
                            else { 
                            if(set_value("nombre")!="")  $valor=set_value("nombre");
                            else  $valor=$datos["nombre"]; 
                            }
                        ?>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fas fa-book"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre Categoria" value="<?= $datos["nombre"];?>">
                         <?php if(isset($errors["nombre"])): ?>
                            <div class="invalid-feedback">
                                    <?php echo validation_show_error('nombre'); ?>
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