<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Alinea todo al principio (arriba) */
            margin-bottom: 20px;
        }
        .header img {
            height: 80px;
        }
        .header .info {
            margin-left: 500px;
            font-size: 12px;
            margin-top: -95px; 
        }
        .header .info .info-box p {
            margin: 0;
        }
        
        h2 {
            font-size: 16px;
            margin: 0;
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }

        .info-box {
            background-color: #f0f0f0; 
            padding: 15px;
            border-radius: 8px; 
            font-size: 12px;
            text-align: left; 
            width: 200px; 
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="<?= base_url('templates/assets/images/boral.png') ?>" alt="Logo Boral">
        <div class="info">
            <div class="info-box">
                <h3>DATOS BORAL</h3>
                <p><strong>Email</strong>: boralpasteleria@gmail.com</p>
                <p><strong>Ubicación</strong>: Polígono Argualas</p>
                <p><strong>Telefono</strong>: +(34) 699 71 01 07</p>
            </div>
        </div>
    </div>
    <h2><?= $titulo ?></h2>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
        </tr>
        <?php foreach ($productosVenta as $producto): ?>
            <tr>
                <td><?= $producto['nombre'] ?></td>
                <td><?= $producto['precio'] ?> €</td>
                <td><?= $producto['stock'] ?></td>
                <td><?= $producto['categoria_nombre'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
