<?php include("templates/parte1.php");?>
<title>Boral | Productos Compra</title>
<div class="row">
    <div class="col-12">

        <!-- Titulo con estilo de Bootstrap -->
        <p class="display-4 text-center text-primary font-weight-bold">PRODUCTOS DE COMPRAR</p>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="<?php echo baseUrl();?>/productos_compra/nuevo" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nuevo Producto Compra
                </a>
            </div>
            
            <div>
                <a href="<?php echo baseUrl();?>/productos_compra/exportar" class="btn btn-success" id="exportar" data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><i class="fa-regular fa-file-excel"></i></a>
                &nbsp;
                <a href="<?php echo baseUrl();?>/productos_compra/exportarPDF" class="btn btn-danger" id="pdf" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF"><i class="fa-solid fa-file-pdf"></i></a>
            </div>
        </div>
                  
        <!-- Tabla con DataTables y estilos de Bootstrap -->
        <table class="table table-striped table-bordered table-hover datatable" id="tabla">
          <thead class="table-primary"> <!-- Color del encabezado -->
            <tr>
                <th>Id</th> 
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>Proveedor</th>
                <th>Acciones</th>
           </tr>
          </thead>
          <tbody>
        <?php
        
        if(count($productos_compra)>0){
            foreach($productos_compra as $r){
                ?>
                <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["nombre"];?></td>  
                    <td><?php echo $r["precio"]. " €";?></td>  
                    <?php if((int)$r["stock"] > 5000){ ?>
                        <td><?php echo $r["stock"]. " gr.";?></td>
                    <?php }else{ ?>
                        <td><span class="badge badge-danger"><?php echo $r["stock"]. " gr.";?></span></td>
                    <?php
                        // Si el stock es menor a 5000, envio un email de alerta
                        $email = service('email');
                        $email->setMailType('html');
                        $email->setFrom('ifc303@fpmarco.com', 'ERP BORAL');
                        $email->setTo('alfonso.ascaso.lizarrondo@gmail.com');
                        $email->setSubject('⚠️ Alerta: Baja Existencia de Producto');

                        // Contenido del mensaje con iconos
                        $mensajeHtml = "
                            <body style='margin:0; padding:0; background-color:#f0f0f0;'>
                              <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                  <td align='center' style='padding: 20px 0;'>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 420px; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.05); padding: 24px;'>
                                      <tr>
                                        <td align='center' style='padding: 40px 0 20px 0;'>
                                          <img src='https://i.ibb.co/8g9y25x7/boral.png' alt='Boral Logo' width='160' style='display: block;'>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='color:#333333; font-family: Arial, sans-serif; font-size:24px; padding: 16px 0; font-weight:bold;'>
                                            Alerta de Stock Bajo
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                                          Este producto tiene pocas existencias:
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='padding: 24px 0;'>
                                          <div style='display: inline-block; background-color: #f5f5f5; padding: 16px 24px; border-radius: 8px; font-size:32px; font-weight:bold;  font-family: Arial, sans-serif; color:#000000;'>
                                            " . $r['nombre'] . "
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                                          Stock actual:
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='padding: 24px 0;'>
                                          <div style='display: inline-block; background-color: #f5f5f5; padding: 16px 24px; border-radius: 8px; font-size:32px; font-weight:bold;  font-family: Arial, sans-serif; color:#000000;'>
                                            " . $r['stock'] . " gr.
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='color:#555555; font-family: Arial, sans-serif; font-size:16px; padding: 12px 0;'>
                                          Saludos,<br><strong>Equipo Boral Pastelería</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td align='center' style='color:#999999; font-family: Arial, sans-serif; font-size:12px; padding: 20px 0 0 0;'>
                                          © 2025 Boral Pastelería. Todos los derechos reservados. <br>
                                          <a href='#' style='color:#0066cc; text-decoration:none;'>Visita nuestro sitio web</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </body>";

                        $email->setMessage($mensajeHtml);
                        $email->send();
                        ?>

                    <?php }?>
                    <td><?php echo $r["categoria_nombre"];?></td>  
                    <td><?php echo $r["proveedor_nombre"];?></td>  
                    <td>
                        <a href="<?php echo baseUrl();?>/productos_compra/editar?id=<?php echo $r["id"];?>" class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        &nbsp;&nbsp;
                        <a href="#" data-id="<?php echo $r["id"];?>" class="btn btn-danger borrar">
                            <i class="fa-solid fa-trash"></i>
                        </a>    
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
<?php include("templates/parte2.php");?>

<script>
    

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
            title: "Desea eliminar el producto?",
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
                    url: "<?php echo baseUrl();?>/productos_compra/eliminar", 
                    success: function(result){
                        if(result==1){
                            swalWithBootstrapButtons.fire({
                                title: "Eliminado!",
                                text: "Producto dado de baja",
                                icon: "success"
                            });
                            padre.hide();
                        }else{
                            swalWithBootstrapButtons.fire({
                                title: "No Eliminado!",
                                text: "Producto NO dado de baja",
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
</style>
