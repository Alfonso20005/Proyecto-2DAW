<?php include("templates/parte1.php");?>
<title>Boral | Pedidos</title>
<div class="row">
    <div class="col-12">
        <p class="display-4 text-center text-primary font-weight-bold">PEDIDOS</p>
        <?php if (session()->get('role') !== 'Distribuidor'){ ?>
            <a href="<?php echo baseUrl();?>/pedidos/nuevo" class="btn btn-success mb-3">
                <i class="fa-solid fa-plus"></i> Nuevo Pedido
            </a>
        <?php } ?>
        <!-- Tabla con DataTables y estilos de Bootstrap -->
        <table class="table table-striped table-bordered table-hover datatable" id="tabla">
          <thead class="table-primary">
            <tr>
                <th>Id</th> 
                <th>Usuario</th>
                <th>Fecha Pedido</th>
                <th>Estado</th>
                <th>Total</th>
                
                    <th>Acciones</th>
          
           </tr>
          </thead>
          <tbody>
               <?php
         if(count($pedidos)>0){
             foreach($pedidos as $r){
                 ?>
                    <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["usuario_nombre"];?></td>  
                    <td><?php echo date('d/m/Y', strtotime($r["fecha_pedido"]));?></td>  
                    <td>
                        <?php 
                        $estado = strtolower($r["estado"]); // Convertir el estado a minúsculas para evitar errores en comparación
                        $badgeClass = '';

                        // Determinar el color del estado
                        switch ($estado) {
                            case 'pendiente':
                                $badgeClass = 'badge-warning';
                                break;
                            case 'enviado':
                                $badgeClass = 'badge-primary';
                                break;
                            case 'entregado':
                                $badgeClass = 'badge-success';
                                break;
                            case 'cancelado':
                                $badgeClass = 'badge-danger';
                                break;
                            default:
                                $badgeClass = 'badge-secondary'; // Por defecto, si el estado no coincide
                                break;
                        }
                        ?>
                        <span class="badge <?php echo $badgeClass; ?>"><?php echo ucfirst($r["estado"]); ?></span>
                    </td>

                    <td><?php echo $r["total"]. "€";?></td>  
                        <td>
                            <?php if (session()->get('role') !== 'Distribuidor'){ ?>
                             <!-- Verificar el estado para deshabilitar el botón -->
                                <?php if ($estado !== 'entregado' && $estado !== 'cancelado' && $estado !== 'enviado') { ?>
                                    <a href="#" data-toggle="modal" data-target="#detallePedidoModal" data-id="<?php echo $r['id']; ?>" class="btn btn-success ver-detalles" data-bs-toggle="tooltip" data-bs-placement="top" title="Añadir Producto">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Añadir Producto">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                <?php } ?>

                            &nbsp;&nbsp;
                           <a href="#" data-toggle="modal" data-target="#detallePedidoModalMostrar" data-id="<?php echo $r['id']; ?>" data-estado="<?php echo $estado; ?>" class="btn btn-purple" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Productos">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            &nbsp;&nbsp;
                            
                            <?php } ?>
                            
                            <?php if ($estado !== 'cancelado') { ?>
                                <a href="<?php echo baseUrl();?>/pedidos/albaran?id=<?php echo $r["id"];?>" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Albaran">
                                    <i class="fa-solid fa-file-invoice"></i>
                                </a>
                                &nbsp;&nbsp;
                            <?php }else{ ?>
                                <a href="#" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Albaran">
                                    <i class="fa-solid fa-file-invoice"></i>
                                </a>
                                &nbsp;&nbsp;
                            <?php } ?>
                        <?php if (session()->get('role') !== 'Distribuidor'){ ?>
                            <a href="<?php echo baseUrl();?>/pedidos/editar?id=<?php echo $r["id"];?>" class="btn btn-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            &nbsp;&nbsp;
                            <a href="#" data-id="<?php echo $r["id"];?>" class="btn btn-danger borrar">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        <?php } ?>
                        </td>
                        
                    </tr>
                <?php
             }
         }
        ?>
          </tbody>
        </table>
    </div>
</div>

<!-- Modal para mostrar los detalles del pedido y añadir productos -->
<div class="modal fade" id="detallePedidoModal" tabindex="-1" role="dialog" aria-labelledby="detallePedidoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-grande" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallePedidoModalLabel">Detalles del Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idPedido">

        <!-- Botón para añadir un nuevo producto -->
        <button type="button" class="btn btn-success mb-3" id="btnAñadirProducto">
            Añadir Producto
        </button>

        <!-- Tabla con los productos añadidos al pedido -->
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-primary">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Iva</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tablaProductos">
            <tr id="filaNuevoProducto" style="display:none;">
                <td>
                    <?php echo form_dropdown('productoNuevo', $optionsProductos, set_value('productoNuevo'), 
                        'class="form-control" id="productoNuevo"'); ?>
                </td>
                <td><input type="number" class="form-control" id="stockNuevo" placeholder="Cantidad"></td>
                <td><input type="number" class="form-control" id="precioNuevo" placeholder="Precio Unitario" step="0.01" min="0"></td>
                <td>
                    <select class="form-control" id="ivaNuevo">
                        <option value="4">4%</option>
                        <option value="10">10%</option>
                        <option value="21">21%</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" id="totalNuevo" placeholder="Total" disabled></td>
                <td>
                    <a href="#" class="btn btn-primary" id="guardarProductoNuevo">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </a>

                    <button type="button" class="btn btn-danger" id="cancelarAñadirProducto"><i class="fa-solid fa-xmark"></i></button>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal solo para mostrar los productos asociados a un pedido -->
<div class="modal fade" id="detallePedidoModalMostrar" tabindex="-1" role="dialog" aria-labelledby="detallePedidoModalMostrarLabel" aria-hidden="true">
  <div class="modal-dialog modal-grande" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallePedidoModalMostrarLabel">Productos asociados del Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idPedidoMostrar">

        <!-- Tabla solo con los productos añadidos al pedido (sin botón para añadir productos) -->
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-primary">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Iva</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tablaProductosMostrar">
            <!-- Las filas de productos se agregarán dinámicamente con JavaScript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="#" class="btn btn-success" id="guardarCambios">
            <i class="fa-solid fa-save"></i> Guardar Cambios
        </a>
      </div>
    </div>
  </div>
</div>

<?php include("templates/parte2.php");?>

<script>
$(document).ready(function() {
    // Limpiar el modal cada vez que se cierra
    $("#detallePedidoModal").on('hide.bs.modal', function() {
        $("#productoNuevo").val('');
        $("#stockNuevo").val('');
        $("#precioNuevo").val('');
        $("#ivaNuevo").val('');
        $("#totalNuevo").val('');
        $("#filaNuevoProducto").hide();
    });

    $("#detallePedidoModal").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // El botón que abre el modal
        var idPedido = button.data('id'); // El ID del pedido
        $(this).find('#idPedido').val(idPedido); // Guardamos el ID en un campo oculto
        $("#filaNuevoProducto").hide(); // Nos aseguramos de que se oculte la fila
    });

    $("#btnAñadirProducto").click(function() {
        $("#filaNuevoProducto").show(); // Mostrar la fila para agregar un nuevo producto
    });

    // Al cambiar cualquier valor en los inputs, calculamos el total
    $("#productoNuevo, #stockNuevo, #precioNuevo, #ivaNuevo").on("input", function() {
        actualizarTotal();
    });

    // Función para actualizar el total
    function actualizarTotal() {
        let cantidad = parseFloat($("#stockNuevo").val());
        let precio = parseFloat($("#precioNuevo").val());
        let iva = parseFloat($("#ivaNuevo").val());

        if (cantidad && precio && iva) {
            let total = cantidad * precio * (1 + iva / 100);
            $("#totalNuevo").val(total.toFixed(2) + "€");
        }
    }

    // Actualizar precio y stock cuando se seleccione un producto
    $("#productoNuevo").change(function() {
        let productoId = $(this).val();
        
        if (productoId) {
            $.ajax({
                url: "<?php echo baseUrl(); ?>/pedidos/getProductoInfo",
                method: "GET",
                data: { id: productoId },
                success: function(data) {
                    let producto = JSON.parse(data);
                    $("#precioNuevo").val(producto.precio);  // Establece el precio
                    $("#stockNuevo").val('').prop('disabled', false);  // El campo de cantidad ahora es editable

                    // Llamar a la función para actualizar el total cuando se cambia el producto
                    actualizarTotal();
                }
            });
        }
    });

    $("#guardarProductoNuevo").click(function() {
        let id_productos_venta = $("#productoNuevo").val();
        let cantidad = parseInt($("#stockNuevo").val());
        let precio_unitario = parseFloat($("#precioNuevo").val());
        let iva = parseFloat($("#ivaNuevo").val());
        let id_pedidos = $("#idPedido").val(); // Obtener el ID del pedido

        if (!id_productos_venta || !cantidad || !precio_unitario || !iva) {
            Swal.fire("Por favor, complete todos los campos.");
            return;
        }

        $.ajax({
            url: "<?= base_url();?>/pedidos/actualizarLineaPedido",
            type: "POST", 
            data: {
                id_pedidos: id_pedidos,
                id_productos_venta: id_productos_venta,
                cantidad: cantidad,
                precio_unitario: precio_unitario,
                iva: iva
            },
            success: function(response) {
                Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Producto guardado correctamente.",
                  showConfirmButton: false,
                  timer: 1500
                });
                setTimeout(function() {
                    location.reload(); // Recargar la página o actualizar la tabla si es necesario
                }, 1500);
            },
            error: function(xhr) {
                console.log("Error al guardar el producto: " + xhr.responseText);
            }
        });
    });

    // Limpiar el modal cada vez que se cierra
    $("#detallePedidoModalMostrar").on('hide.bs.modal', function() {
        $("#tablaProductosMostrar").empty();  // Limpiar la tabla de productos
    });

    $("#detallePedidoModalMostrar").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // El botón que abre el modal
        var id_pedido = button.data('id'); // El ID del pedido
        var estado = button.data('estado'); // El estado del pedido (recibido desde el atributo `data-estado`)
        $(this).find('#idPedidoMostrar').val(id_pedido); // Guardamos el ID en un campo oculto
        
        $.ajax({
            url: "<?php echo baseUrl(); ?>/pedidos/getProductosPorPedido",  // Llamada al controlador
            method: "GET",  // Método GET
            data: { id_pedido: id_pedido },  // Enviar el id del pedido
            success: function(data) {
                var productos = JSON.parse(data);  // Suponemos que la respuesta es un JSON
                
                // Limpiar la tabla antes de agregar nuevos productos
                $("#tablaProductosMostrar").empty();
                
                // Mostrar los productos en la tabla
                productos.forEach(function(producto) {
                    var fila = `
                        <tr>
                            <td>${producto.producto}</td>
                            <td><input type="number" value="${producto.cantidad}" class="form-control cantidad" data-id="${producto.id}"></td>
                            <td><input type="number" min="0" value="${producto.precio_unitario}" class="form-control precio" data-id="${producto.id}"></td>
                            <td>
                                <select class="form-control iva" data-id="${producto.id}">
                                    <option value="4" ${producto.iva == 4 ? 'selected' : ''}>4%</option>
                                    <option value="10" ${producto.iva == 10 ? 'selected' : ''}>10%</option>
                                    <option value="21" ${producto.iva == 21 ? 'selected' : ''}>21%</option>
                                </select>
                            </td>
                            <td class="total">${(producto.cantidad * producto.precio_unitario * (1 + producto.iva / 100)).toFixed(2)}€</td>
                            <td>
                                ${estado === "cancelado" || estado === "enviado" || estado === "entregado" ? '' : `
                                    <a href="#" class="btn btn-danger eliminarProductoLinea" data-id="${producto.id}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                `}
                            </td>
                        </tr>
                    `;
                    $("#tablaProductosMostrar").append(fila);
                });
                // Verificamos el estado del pedido para ocultar o deshabilitar las acciones
                if (estado === "cancelado" || estado === "entregado" || estado === "enviado") {
                $("#guardarCambios").hide();
            } else {
                $("#guardarCambios").show();
            } 
                
               $(".eliminarProductoLinea").click(function() {
                    let id = $(this).attr("data-id");
                    let padre = $(this).parent().parent();
                    let pedidoId = $("#idPedidoMostrar").val();

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success ml-3",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: "¿Desea eliminar un producto del pedido?",
                        text: "No hay vuelta atrás!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "No, cancelar",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo baseUrl(); ?>/pedidos/eliminarLineaPedido",
                                data: { id: id, id_pedidos: pedidoId },
                                type: "GET",
                                success: function(response) {
                                    let data = JSON.parse(response);
                                    if (data.status === "success") {
                                        swalWithBootstrapButtons.fire(
                                            "Eliminado",
                                            "El producto fue eliminado del pedido.",
                                            "success"
                                        );
                                        padre.fadeOut();
                                        $("#totalPedido").text(data.nuevoTotal + "€");
                                        setTimeout(function() {
                                            location.reload(); // Recargar la página o actualizar la tabla si es necesario
                                        }, 1500);
                                    } else {
                                        swalWithBootstrapButtons.fire(
                                            "Error",
                                            "No se pudo eliminar el producto.",
                                            "error"
                                        );
                                    }
                                },
                                error: function(xhr) {
                                    console.log("Error al eliminar el producto: " + xhr.responseText);
                                }
                            });
                        }
                    });
                });

                // Recalcular el total cuando se editen las cantidades o precios
                $(".cantidad, .precio, .iva").on('input', function() {
                    var tr = $(this).closest('tr');
                    var cantidad = tr.find('.cantidad').val();
                    var precio = tr.find('.precio').val();
                    var iva = tr.find('.iva').val();
                    var total = cantidad * precio * (1 + iva / 100);
                    tr.find('.total').text(total.toFixed(2) + "€");
                });
            },
            error: function(xhr) {
                console.log("Error al obtener los productos: " + xhr.responseText);
            }
        });
    });

    // Guardar los cambios y actualizar en el backend
    $("#guardarCambios").click(function() {
        var id_pedido = $("#idPedidoMostrar").val();
        var productos = [];

        // Recopilar todos los productos modificados
        $("#tablaProductosMostrar tr").each(function() {
            var productoId = $(this).find(".cantidad").data('id');
            var cantidad = $(this).find(".cantidad").val();
            var precio = $(this).find(".precio").val();
            var iva = $(this).find(".iva").val();
            var total = $(this).find(".total").text().replace("€", "");

            productos.push({
                id: productoId,
                cantidad: cantidad,
                precio_unitario: precio,
                iva: iva,
                total: total
            });
        });

        // Enviar los datos al backend para actualizar las líneas del pedido
        $.ajax({
            url: "<?php echo baseUrl(); ?>/pedidos/actualizarLineaPedidoEdit",  // Llamada al backend
            type: "POST",
            data: {
                id_pedido: id_pedido,
                productos: productos
            },
            success: function(response) {

                if (response.status === "success") {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Pedido actualizado correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Actualizar el total del pedido
                    $("#totalPedido").text(response.nuevoTotal + "€");
                     setTimeout(function() {
                        location.reload(); // Recargar la página o actualizar la tabla si es necesario
                    }, 1500);
                    // Cerrar el modal
                    $('#detallePedidoModalMostrar').modal('hide');
                } else {
                    Swal.fire("Error", "No se pudo actualizar el pedido.", "error");
                }
            },
            error: function(xhr) {
                console.log("Error al actualizar el pedido: " + xhr.responseText);
            }
        });
    });
});
    
    

    // Acción de borrar
    $(".borrar").click(function(){
        let id=$(this).attr('data-id');
        let padre=$(this).parent().parent();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ml-3",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Desea eliminar el pedido?",
            text: "no hay vuelta atrás!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, mantener!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data:{id:id},
                    method:"POST",
                    url: "<?php echo baseUrl();?>/pedidos/eliminar", 
                    success: function(result){
                        if(result==1){
                            swalWithBootstrapButtons.fire({
                                title: "Eliminado!",
                                text: "Pedido eliminado",
                                icon: "success"
                            });
                            padre.hide();
                        }else{
                            swalWithBootstrapButtons.fire({
                                title: "No Eliminado!",
                                text: "Pedido NO eliminado",
                                icon: "error"
                            });
                        }
                    }
                });
            }
        }); 
    });

</script>



<!-- Estilos adicionales si es necesario -->
<style>
    .table {
        font-size: 14px;
    }

    .display-4 {
        font-size: 3rem; /* Tamaño grande para el título */
    }

    .text-primary {
        color: #007bff !important; /* Color primario de Bootstrap */
    }

    .font-weight-bold {
        font-weight: bold;
    }

    /* Estilo para el encabezado de la tabla (thead) */
    .table-primary {
        background-color: #007bff !important; /* Fondo azul para el encabezado */
        color: white; /* Texto blanco */
    }

    /* Estilo para las filas en el tbody */
    tbody tr:hover {
        background-color: #f1f1f1; /* Fondo gris claro cuando el ratón pasa por encima de una fila */
    }

    /* Estilo para resaltar las filas alternadas (zebra stripes) */
    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Fondo gris muy claro para las filas impares */
    }

    .modal-dialog.modal-grande {
        max-width: 90%;
        width: 90%;
    }
</style>
