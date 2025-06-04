<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Detalle_pedidoModel extends Model
{
    protected $table='detalle_pedidos';
    protected $allowedFields=['id_pedido', 'id_producto_venta', 'cantidad','precio_unitario','subtotal'];
   
}
?>