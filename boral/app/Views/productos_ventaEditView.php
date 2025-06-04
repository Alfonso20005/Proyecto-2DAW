<?php include("templates/parte1.php");?>
<title>Boral | Productos Venta Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR PRODUCTOS</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/productos_venta/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
        <?php validation_list_errors(); $errors=validation_errors(); ?>

        <form action="<?php echo baseUrl();?>/productos_venta/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" name="id" id="id" value="<?= $datos["id"];?>">
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?= rellenarDato($errors,$datos,"nombre");?>">

                        <?php if (isset($errors["nombre"])): ?>
                                <div class="invalid-feedback">
                                    <?php echo validation_show_error('nombre'); ?>
                                </div>
                        <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control <?php echo isset($errors["descripcion"]) ? 'is-invalid' : ''; ?>" id="descripcion" name="descripcion" placeholder="Descripción del producto"><?= set_value('descripcion'); ?></textarea>
                <?php if (isset($errors["descripcion"])) echo validation_show_error('descripcion'); ?>
            </div>
            
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="precio" class="form-label">Precio</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["precio"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                        </div>
                        <input type="number" step="0.01" class="form-control <?php echo isset($errors["precio"]) ? 'is-invalid border border-danger' : ''; ?>" id="precio" name="precio" placeholder="Precio" value="<?= rellenarDato($errors,$datos,"precio");?>">
                         <?php if (isset($errors["precio"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('precio'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
                </div>


                <div class="mb-3 col-md-4">
                    <label for="stock" class="form-label">Stock</label>

                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["stock"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                        </div>
                        <input type="number" class="form-control <?php echo isset($errors["stock"]) ? 'is-invalid border border-danger' : ''; ?>" id="stock" name="stock" placeholder="Stock" value="<?= rellenarDato($errors,$datos,"stock");?>">
                        <?php if (isset($errors["stock"])): ?>
                                <div class="invalid-feedback">
                                    <?php echo validation_show_error('stock'); ?>
                                </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-3 col-md-4">
                    <label for="id_categoria_venta" class="form-label">Categoria</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["id_categoria_venta"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="fas fa-folder"></i></span>
                        </div>
                        <?php  echo form_dropdown('id_categoria_venta', $optionsCategorias, rellenarDato($errors,$datos,"id_categoria_venta"), 
                        'class="' . (isset($errors["id_categoria_venta"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . '" id="id_categoria_venta"');?>

                            <?php if (isset($errors["id_categoria_venta"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('id_categoria_venta'); ?>
                                    </div>
                            <?php endif; ?>
                    </div>
                </div>
                
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
            </div>

        </form>
    </div>
</div>
<?php include("templates/parte2.php");?>

<script>
 tinymce.init({
    language: 'tinymce_7.5.0\tinymce\langs\es.js',
    selector: 'textarea#descripcion',
    height: 400,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
        'anchor', 'searchreplace', 'visualblocks',
        'insertdatetime', 'media', 'table', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
    'bold italic backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
     setup: function(editor) {
        editor.on('init', function() {
            editor.setContent(`<?=rellenarDato($errors,$datos,"descripcion");?>`);
            
            if (<?php echo isset($errors['descripcion']) ? 'true' : 'false'; ?>) {
                editor.getContainer().classList.add('invalid-tinymce');
            }
        });
    }
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
