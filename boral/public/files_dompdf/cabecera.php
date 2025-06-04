<tr class="cabecera">
    <td class="contenedor">
        <table>
            <tr>
            <td class="cab1"><img src="<?php echo baseUrl();?>/templates/assets/images/boral.png" class="logo"></td>
            <td  class="cab2"><h1><?php echo $datosEncabezado;?></h1></td>
            <td class="cab3">
                <table>
                    <tr><td><?php echo $email;?></td></tr>
                    <?php 
                        $telefono_formateado = preg_replace('/(\d{3})(\d{2})(\d{2})(\d{2})/', '+34 $1 $2 $3 $4', $telefono);
                    ?>
                    <tr><td><?php echo $telefono_formateado; ?></td></tr>
                </table>    
            </td>
            </tr>
        </table>
    </td>
</tr>  