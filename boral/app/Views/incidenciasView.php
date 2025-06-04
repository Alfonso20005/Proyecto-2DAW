<?php include("templates/parte1.php"); ?>
<title>Boral | Incidencias</title>

<div class="container mt-4">
    <div class="row justify-content-end">
        <div class="col-auto">
            <a href="<?php echo baseUrl();?>/perfilUser/volver" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>&nbsp; Volver
            </a>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <?php validation_list_errors();
                $errors=validation_errors();

            
        ?>
        <div class="col-md-6">
            <h2 class="text-center">Incidencias</h2>
            <form action="<?php echo baseUrl();?>/incidencias/enviar" method="post" enctype="multipart/form-data" id="form1">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control  <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" placeholder="Email"  value="<?= set_value('email');?>">
                    </div>
                    <?php if (isset($errors["email"])) echo validation_show_error('email'); ?>
                </div>
               <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control <?php echo isset($errors["descripcion"]) ? 'is-invalid' : ''; ?>" id="descripcion" name="descripcion" placeholder="Describe la incidencia"><?= set_value('descripcion'); ?></textarea>
                    <?php if (isset($errors["descripcion"])) echo validation_show_error('descripcion'); ?>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Enviar Incidencia</button>
            </form>
        </div>
    </div>
</div>

<?php include("templates/parte2.php"); ?>



<script>
tinymce.init({
    selector: 'textarea#descripcion',
    language: 'es',
    height: 200,
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
