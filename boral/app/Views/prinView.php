<?php
include("files_dompdf/config.php");
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

    <head>
        <?php
        include("files_dompdf/style.php");
        ?>
        <style>
            /* Estilo principal para las fichas */
            .ficha {
                margin-top: 20pt;
                margin-left: 10pt;
                margin-right: 10pt;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                background-color: #f9f9f9;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }

            /* Estilo para los títulos de las secciones */
            .section-title {
                font-size: 18pt;
                font-weight: bold;
                background-color: #d0f5d0; /* verde claro para el fondo */
                padding: 10px;
                text-align: center;
                border-radius: 5px;
                color: #2e7d32; /* verde fuerte para el texto */
                margin-bottom: 15px;
            }

            /* Estilo para cada "campo" en la ficha */
            .field {
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                font-size: 14pt;
                border-bottom: 1px solid #ddd;
            }

            .field label {
                font-weight: bold;
                width: 40%;
                color: #333;
            }

            .field .value {
                width: 55%;

                color: #555;
            }

            /* Estilo para las fichas de los talleres */
            .talleres .field {
                font-size: 14pt;
            }

            .talleres .field:last-child {
                border-bottom: none;
            }

            .ultimo{
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                font-size: 14pt;
                border-bottom: 1px solid #ddd;
            }

            /* Estilo de los contenedores de las fichas */
            .container {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            
            .posicionIMG{
               margin-top: -220px;
                
                text-align: right;
            }
        </style>
    </head>

    <body>
        <table class="paginaA4" cellspacing=0 cellpadding=0>
            <?php
            include("files_dompdf/cabecera.php");
            ?>
            <tr class="contenido">
                <td class="contenido">
                    <div class="container">
                        <!-- Ficha de Datos Personales -->
                        <div class="ficha" style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <!-- Columna Izquierda: Datos -->
                            <div style="width: 50%;">
                                <div class="section-title">Datos Personales</div>
                                <div class="field">
                                    <label>Nombre:</label>
                                    <span class="value"><?php echo $nombre; ?></span>
                                </div>
                                <div class="field">
                                    <label>Apellidos:</label>
                                    <span class="value"><?php echo $apellidos; ?></span>
                                </div>
                                <div class="field">
                                    <label>Razón Social:</label>
                                    <span class="value"><?php echo $razon_social; ?></span>
                                </div>
                                <div class="field">
                                    <label>CIF:</label>
                                    <span class="value"><?php echo $cif_nif_nie; ?></span>
                                </div>
                                 <div class="field">
                                    <label>Email:</label>
                                    <span class="value"><?php echo $email; ?></span>
                                </div>
                            </div>
                            <div class="posicionIMG">
                                <img src="<?= baseUrl();?>/templates/assets/images/logo<?php echo $id;?>.png" style="width: 200px; height: 200px;">
                            </div>


                        </div>
                        
                        
                        <div class="ficha talleres">
                            <div class="section-title">Información de Pedidos</div>

                            <?php if (count($pedidos) > 0): ?>
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #d0f5d0; color: #2e7d32; padding: 10px; text-align: left; font-size: 14pt;">Fecha del Pedido</th>
                                            <th style="background-color: #d0f5d0; color: #2e7d32; padding: 10px; text-align: left; font-size: 14pt;">Estado del Pedido</th>
                                            <th style="background-color: #d0f5d0; color: #2e7d32; padding: 10px; text-align: left; font-size: 14pt;">Total del Pedido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pedidos as $p): ?>
                                            <tr style="border-bottom: 1px solid #ddd;">
                                                <td style="padding: 8px; font-size: 14pt; color: #555;"><?php echo date('d/m/Y', strtotime($p["fecha_pedido"])); ?></td>
                                                <td style="padding: 8px; font-size: 14pt; color: #555;"><?php echo ucfirst($p["estado"]); ?></td>
                                                <td style="padding: 8px; font-size: 14pt; color: #555;"><?php echo $p['total']; ?>€</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p style="font-size: 14pt; color: #555;">No existen pedidos asociados a este distribuidor.</p>
                            <?php endif; ?>
                        </div>

                    </div>
                </td>
            </tr>
            <?php
            include("files_dompdf/pie.php");
            ?>
        </table>
    </body>

</html>
