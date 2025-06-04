
<?php include("templates/parte1.php");?>
<title>Boral | Productos Compra New</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">CREAR PRODUCTO</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/productos_compra/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
         <?php validation_list_errors();
                $errors=validation_errors();

            
        ?>
        
        <form action="<?php echo baseUrl();?>/productos_compra/crear" method="post" enctype="multipart/form-data" id="form1">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?= set_value('nombre');?>">

                        <?php if (isset($errors["nombre"])): ?>
                                <div class="invalid-feedback">
                                    <?php echo validation_show_error('nombre'); ?>
                                </div>
                        <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control  <?php echo isset($errors["descripcion"]) ? 'is-invalid' : ''; ?>" id="descripcion" name="descripcion" placeholder="Descripción del producto"><?= set_value('descripcion'); ?></textarea>
                <?php if (isset($errors["descripcion"])) echo validation_show_error('descripcion'); ?>
            </div>
            
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["precio"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                        </div>
                        <input type="number" step="0.01" class="form-control <?php echo isset($errors["precio"]) ? 'is-invalid border border-danger' : ''; ?>" id="precio" name="precio" placeholder="Precio" value="<?= set_value('precio');?>">
                         <?php if (isset($errors["precio"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('precio'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
                </div>


                <div class="mb-3 col-md-6">
                    <label for="stock" class="form-label">Stock</label>

                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["stock"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                        </div>
                        <input type="number" class="form-control <?php echo isset($errors["stock"]) ? 'is-invalid border border-danger' : ''; ?>" id="stock" name="stock" placeholder="Stock" value="<?= set_value('stock');?>">
                        <?php if (isset($errors["stock"])): ?>
                                <div class="invalid-feedback">
                                    <?php echo validation_show_error('stock'); ?>
                                </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="id_categoria_compra" class="form-label">Categoria</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["id_categoria_compra"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-folder"></i></span>
                        </div>
                        <?php  echo form_dropdown('id_categoria_compra', $optionsCategorias, set_value('id_categoria_compra'), 
                        'class="' . (isset($errors["id_categoria_compra"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . '" id="id_categoria_compra"');?>

                            <?php if (isset($errors["id_categoria_compra"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('id_categoria_compra'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="id_proveedores" class="form-label">Proveedor</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["id_proveedores"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        
                         <?php  echo form_dropdown('id_proveedores', $optionsProveedores, set_value('id_proveedores'), 
                        'class="' . (isset($errors["id_proveedores"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . '" id="id_proveedores"');?>
                        
                            <?php if (isset($errors["id_proveedores"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('id_proveedores'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
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
tinymce.init({
    selector: 'textarea#descripcion',
    language: 'es',
    height: 300,
    menubar: false,
    plugins: 'lists link',
    toolbar: 'undo redo | bold italic underline | bullist numlist | link',
    content_style: 'body { font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.6; }',
    setup: function(editor) {
        // Revisar si hay un error en el campo
        editor.on('init', function () {
            if ($('#descripcion').hasClass('is-invalid')) {
                // Si tiene la clase 'is-invalid', agrega la clase 'invalid-tinymce' al contenedor
                editor.getContainer().classList.add('invalid-tinymce');
            }
        });
    }
});



</script>