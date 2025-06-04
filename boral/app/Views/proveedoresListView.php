<?php include("templates/parte1.php");?>
<title>Boral | Proveedores</title>
<div class="row">
    <div class="col-12">

        <!-- Titulo con estilo de Bootstrap -->
        <p class="display-4 text-center text-primary font-weight-bold">PROVEEDORES</p>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="<?php echo baseUrl();?>/proveedores/nuevo" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nuevo Proveedor
                </a>
            </div>
            
            <div>
                <a href="<?php echo baseUrl();?>/proveedores/exportar" class="btn btn-success" id="exportar" data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><i class="fa-regular fa-file-excel"></i></a>
                &nbsp;
                <a href="<?php echo baseUrl();?>/proveedores/exportarPDF" class="btn btn-danger" id="pdf" data-bs-toggle="tooltip" 
                data-bs-placement="top" title="PDF"><i class="fa-solid fa-file-pdf"></i></a>
            </div>
        </div>
        <!-- Tabla con DataTables y estilos de Bootstrap -->
        <table class="table table-striped table-bordered table-hover datatable" id="tabla">
          <thead class="table-primary"> <!-- Color del encabezado -->
             <tr>

        <th>Id</th> 
        <th>Razon Social</th> 
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Acciones</th>
   </tr>
          </thead>
          <tbody>
       <?php
        
        
         if(count($proveedores)>0){
             foreach($proveedores as $r){
                 ?>

                <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["razon_social"];?></td> 
                    <td><?php echo $r["nombre"];?></td>  
                    <td><?php echo $r["apellidos"];?></td>  
                    <td><?php echo $r["telefono"];?></td>   
                    <td><?php echo $r["email"];?></td>   
                    <td>
                        <a href="<?php echo baseUrl();?>/proveedores/editar?id=<?php echo $r["id"];?>" class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        &nbsp;&nbsp;
                        <a  href="#" data-id="<?php echo $r["id"];?>" class="btn btn-danger borrar">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        &nbsp;&nbsp;
                        <a href="<?php echo baseUrl();?>/proveedores/imprimir?id=<?php echo $r["id"];?>" class="btn btn-dark">
                            <i class="fa-solid fa-print"></i>
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
                          title: "Desea eliminar al proveedor?",
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
                                     url: "<?php echo baseUrl();?>/proveedores/eliminar", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Proveedor dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Proveedor NO dado de baja",
                                              icon: "error"
                                            });
                                         }
                                    }
                                 });

                              
                            
                              
                              
                          } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                          ) {
                         /*   swalWithBootstrapButtons.fire({
                              title: "Cancelled",
                              text: "Your imaginary file is safe :)",
                              icon: "error"
                            });*/
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

