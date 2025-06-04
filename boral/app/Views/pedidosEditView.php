<?php include("templates/parte1.php");?>
<title>Boral | Pedidos Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR PEDIDO</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/pedidos/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
        <?php validation_list_errors(); $errors=validation_errors(); ?>

        <form action="<?php echo baseUrl();?>/pedidos/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" name="id" id="id" value="<?= $datos["id"];?>">
            
            <!-- Usuario -->
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["id_usuario"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <?php echo form_dropdown('id_usuario',$optionsUsuario, rellenarDato($errors,$datos,"id_usuario"),'class="' . (isset($errors["id_usuario"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . ' id="id_usuario" ');?>
                </div>
                <?php if(isset($errors["id_usuario"])) echo validation_show_error('id_usuario'); ?>
            </div>
            
        <div class="row">
            <div class="mb-3  col-md-6">
                <label for="fecha_pedido" class="form-label">Fecha de Pedido</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["fecha_pedido"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control <?php echo isset($errors["fecha_pedido"]) ? 'is-invalid' : ''; ?>" 
                       id="fecha_pedido" name="fecha_pedido" 
                       value="<?= isset($datos["fecha_pedido"]) ? substr($datos["fecha_pedido"], 0, 10) : date('Y-m-d'); ?>">
                </div>
                 <?php
                    if(isset($errors["fecha_pedido"])) echo validation_show_error('fecha_pedido');  
                    ?> 
            </div>

            
           <div class="mb-3 col-md-6">
                <label for="estado" class="form-label">Estado</label>

                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["estado"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                    </div>
                    <select id="estado" name="estado" class="form-control <?php echo isset($errors["estado"]) ? 'is-invalid' : ''; ?>">
                        <option value="pendiente" <?php echo (isset($datos["estado"]) && $datos["estado"] == 'pendiente') || old('estado') == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="enviado" <?php echo (isset($datos["estado"]) && $datos["estado"] == 'enviado') || old('estado') == 'enviado' ? 'selected' : ''; ?>>Enviado</option>
                        <option value="entregado" <?php echo (isset($datos["estado"]) && $datos["estado"] == 'entregado') || old('estado') == 'entregado' ? 'selected' : ''; ?>>Entregado</option>
                        <option value="cancelado" <?php echo (isset($datos["estado"]) && $datos["estado"] == 'cancelado') || old('estado') == 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                    </select>


                </div>
                <?php
                    if(isset($errors["estado"])) echo validation_show_error('estado');  
                    ?> 
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
