<?php include("templates/parte1.php");?>
<title>Boral | Incidencias</title>
<div class="row">
    <div class="col-12">

        <!-- Titulo con estilo de Bootstrap -->
        <p class="display-4 text-center text-primary font-weight-bold">INCIDENCIAS</p>

        <!-- Tabla con DataTables y estilos de Bootstrap -->
        <table class="table table-striped table-bordered table-hover datatable" id="tabla">
          <thead class="table-primary"> <!-- Color del encabezado -->
            <tr>
                <th>Id</th> 
                <th>Email</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Fecha incidencia</th>
                <th>Acciones</th>
           </tr>
          </thead>
          <tbody>
              
               <?php
        
         if(count($incidencias)>0){
             foreach($incidencias as $r){
                 ?>
                    <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["email"];?></td>  
                    <td><?php echo $r["descripcion"];?></td>
                    <td><?php 
                            $estado = strtolower($r["estado"]);
                            $badgeClass = '';
                            switch ($estado) {
                                case 'sin resolver':
                                    $badgeClass = 'badge-danger';
                                    break;
                                case 'resuelto':
                                    $badgeClass = 'badge-teal';
                                    break;
                            }                      
                        
                        ?>
                        <span class="badge <?php echo $badgeClass; ?>"><?php echo ucfirst($r["estado"]); ?></span>
                    </td>  
                    <td><?php echo date('d/m/Y', strtotime($r["fecha"])); ?></td> 
                    
                    <td>
                        <?php if($estado!='resuelto'){?>
                        
                            <a href="<?php echo baseUrl();?>/incidencias/editar?id=<?php echo $r["id"];?>" class="btn btn-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        <?php }else{ ?>
                            <span>Se resolvió la incidencia</span>
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
<?php include("templates/parte2.php");?>


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
