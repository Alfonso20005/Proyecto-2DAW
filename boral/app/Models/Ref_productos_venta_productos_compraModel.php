<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Ref_productos_venta_productos_compraModel extends Model
{
    protected $table='ref_productos_venta_productos_compra';
    protected $allowedFields=['id_producto_venta', 'id_producto_compra', 'cantidad'];
    
}
?>