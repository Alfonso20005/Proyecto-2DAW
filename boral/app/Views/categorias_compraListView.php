<?php include("templates/parte1.php");?>
<title>Boral | Categorias Compra</title>
<div class="row">
    <div class="col-12">

        <!-- Titulo con estilo de Bootstrap -->
        <p class="display-4 text-center text-primary font-weight-bold">CATEGORIAS DE COMPRA</p>

        <a href="<?php echo baseUrl();?>/categorias_compra/nuevo" class="btn btn-success mb-3">
                    <i class="fa-solid fa-plus"></i> Nueva Categoria Compra
            </a>
        <!-- Tabla con DataTables y estilos de Bootstrap -->
        <table class="table table-striped table-bordered table-hover datatable" id="tabla">
          <thead class="table-primary"> <!-- Color del encabezado -->
            <tr>
                <th>Id</th> 
                <th>Nombre</th>
                <th>Acciones</th>
           </tr>
          </thead>
          <tbody>
              
               <?php
        
        
         if(count($categorias)>0){
             foreach($categorias as $r){
                 ?>
                    <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["nombre"];?></td>  
                    <td><a href="<?php echo baseUrl();?>/categorias_compra/editar?id=<?php echo $r["id"];?>" class="btn btn-primary">
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
            title: "Desea eliminar la categoria?",
            text: "No hay vuelta atrás!",
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
                    url: "<?php echo baseUrl();?>/categorias_compra/eliminar", 
                    success: function(result){
                        if(result==1){
                            swalWithBootstrapButtons.fire({
                                title: "Eliminada!",
                                text: "Categoria eliminada",
                                icon: "success"
                            });
                            padre.hide();
                        }else{
                            swalWithBootstrapButtons.fire({
                                title: "No Eliminado!",
                                text: "Categoria NO eliminada",
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
