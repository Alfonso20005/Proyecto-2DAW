<?php include("templates/parte1.php"); ?>
<title>Boral | Productos Venta Ingredientes</title>

<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary font-weight-bold">INGREDIENTES PRODUCTO</h1>
    </div>

    <div class="col-12 col-md-10">
         <?php validation_list_errors();
                $errors=validation_errors();

            
        ?>
        <form action="<?php echo baseUrl();?>/productos_venta/guardarRefProductos" method="post" enctype="multipart/form-data" id="form1">

            <!-- Producto de Venta -->
            <div class="mb-4">
                <label for="producto_venta" class="form-label">Producto de Venta:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                    <input type="text" class="form-control" value="<?= $producto['nombre'] ?>" disabled>
                </div>
            </div>

            <!-- INGREDIENTES -->
            <div id="ingredientes-container">
                <div class="ingrediente-group border bg-light rounded-3 shadow-sm p-3 mb-3 position-relative">
                    <div class="row align-items-end g-3">
                        <div class="col-md-7">
                            <label class="form-label">Seleccionar un Ingrediente:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-cart-plus"></i></span>
                                <?= form_dropdown('id_producto_compra[]', $optionsProductoCompra, set_value('id_producto_compra'), 'class="form-control select2"'); ?>
                            </div>
                            
                            <?php if (isset($errors["id_producto_compra"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('id_producto_compra'); ?>
                                    </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Cantidad:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                                <input type="number" class="form-control" name="cantidad[]" id="cantidad" value="">
                            </div>
                             <?php if (isset($errors["id_producto_compra"])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo validation_show_error('id_producto_compra'); ?>
                                    </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-danger btn-sm remove-ingrediente d-none" title="Eliminar">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón para agregar más ingredientes -->
            <div class="mb-4">
                <button type="button" class="btn btn-outline-primary w-100" id="agregarIngrediente">
                    <i class="fa fa-plus-circle me-1"></i> Agregar otro ingrediente
                </button>
            </div>

            <!-- ID producto venta -->
            <input type="hidden" name="id_producto_venta" value="<?= $producto['id'] ?>">

            <!-- Botón de envío -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Inicializar select2 en los existentes
    $('.select2').select2({
        placeholder: 'Selecciona un ingrediente',
        theme:'bootstrap-5'
    });

    const container = document.getElementById('ingredientes-container');
    const btnAgregar = document.getElementById('agregarIngrediente');

    btnAgregar.addEventListener('click', () => {
        const grupoOriginal = container.querySelector('.ingrediente-group');
        const nuevoGrupo = grupoOriginal.cloneNode(true);

        // Limpiar valores
        nuevoGrupo.querySelector('input[name="cantidad[]"]').value = '';

        const select = nuevoGrupo.querySelector('select');
        select.value = '';
        select.classList.remove('select2-hidden-accessible');

        // Eliminar cualquier select2 anterior en el nuevo clon
        const oldContainer = nuevoGrupo.querySelector('.select2-container');
        if (oldContainer) oldContainer.remove();

        // Insertar nuevo grupo
        container.appendChild(nuevoGrupo);
    // Inicializar select2 en el nuevo select
            $(select).select2({
                placeholder: 'Selecciona un ingrediente',
                theme:'bootstrap-5'
            });


        // Mostrar botón eliminar
        nuevoGrupo.querySelector('.remove-ingrediente').classList.remove('d-none');
    });

    // Eliminar ingrediente
    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-ingrediente')) {
            const grupo = e.target.closest('.ingrediente-group');
            grupo.remove();
        }
    });
});
</script>

<?php include("templates/parte2.php"); ?>
