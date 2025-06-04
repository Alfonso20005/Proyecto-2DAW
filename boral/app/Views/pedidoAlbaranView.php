<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albarán - Nº <?= $id ?></title>
    <style>
        /* General */
        body { font-family: 'Arial', sans-serif; font-size: 12px; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; padding: 20px; }
        h1, h2, h3, p { margin: 0; padding: 0; }

        /* Header */
        .header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #28a745; }
        .header h1 { font-size: 48px; font-weight: bold; color: #28a745; margin-bottom: 10px; }
        .header p { font-size: 14px; color: #555; }
        .logo { width: 150px; height: auto; margin-bottom: 20px; }

        /* Info Table */
        .info-table { width: 100%; margin: 30px 0; border-collapse: collapse; }
        .info-table td { vertical-align: top; padding: 5px; font-size: 14px; color: #555; }
        .info-left { text-align: left; padding-right: 20px; }
        .info-right { text-align: left; padding-left: 40px; }
        .info-separator { border-left: 2px solid #28a745; }
        .info-title { font-size: 18px; color: #28a745; font-weight: bold; margin-bottom: 10px; }

        /* Table */
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .invoice-table th { background-color: #d4edda; font-weight: bold; color: #28a745; }
        .invoice-table td { font-size: 14px; color: #555; }
        .invoice-table tfoot { font-weight: bold; }

        /* Total */
        .total { font-size: 16px; font-weight: bold; text-align: right; padding-top: 20px; }

        /* Footer */
        .footer { 
            position: fixed; 
            bottom: 0; 
            left: 0; 
            width: 100%; 
            background-color: #f7f7f7; 
            padding: 20px 0; 
            text-align: center; 
        }
        .footer img { width: 120px; margin-bottom: 10px; }
        .footer p { font-size: 12px; color: #555; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
   
    <div class="header" style="position: relative; height: 100px;">
        <h1 style="position: absolute; top: 20px; left: 20px; font-size: 48px; color: #28a745; margin: 0;">ALBARÁN</h1>
        <img src="<?= base_url('templates/assets/images/boral.png') ?>" alt="Logo Boral" style="position: absolute; top: 10px; right: 20px; height: 80px;">
    </div>

    <!-- Empresa y Cliente -->
    <table class="info-table">
        <tr>
            <td class="info-left" style="width: 48%;">
                <div class="info-title">Datos de la Empresa</div>
                <p><strong>Nombre:</strong> Boral Pastelería S.L</p>
                <p><strong>Dirección:</strong> Polígono Argualas, 20</p>
                <p><strong>Teléfono:</strong> +34 669 71 01 07</p>
                <p><strong>Email:</strong> 	boralpasteleria@gmail.com</p>
            </td>
            <td class="info-separator" style="width: 20%;"></td>
            <td class="info-right" style="width: 32%;">
                <div class="info-title">Datos del Cliente</div>
                    <p><strong>Nombre:</strong> <?= esc($infoUser['usuario']) ?></p>
                    <p><strong>Email:</strong> <?= esc($infoUser['email']) ?></p>
            </td>
        </tr>
    </table>

    <!-- Título Albarán -->
    <h2 style="text-align: center; font-size: 32px; color: #28a745; font-weight: bold; text-transform: uppercase; margin-top: 40px; letter-spacing: 1px; padding-bottom: 10px;">
        Albarán Nº <?= $id ?>
    </h2>

    <!-- Tabla de Productos -->
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario (€)</th>
                <th>Subtotal (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?= esc($pedido['producto_nombre']) ?></td>
                    <td><?= esc($pedido['cantidad']) ?></td>
                    <td><?= number_format($pedido['precio_unitario'], 2, ',', '.') ?> €</td>
                    <td><?= number_format($pedido['subtotal'], 2, ',', '.') ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total">Total Albarán:</td>
                <td class="total"><?= number_format($pedidos[0]['total_pedido'], 2, ',', '.') ?> €</td>
            </tr>
        </tfoot>
    </table>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                &copy; 1998 - <?php echo date('Y'); ?> Boral Pastelería. Todos los derechos reservados.
            </div>
        </div>
    </div>
</footer>

</body>
</html>
