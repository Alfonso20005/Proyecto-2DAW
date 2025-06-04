<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Linea_pedidoModel extends Model
{
    protected $table='linea_pedidos';
    protected $allowedFields=['id_pedidos', 'id_productos_venta', 'cantidad','precio_unitario','iva','total'];
    
    
    public function getProductosPorPedido($pedidoId) {
    // Consulta SQL para obtener los productos relacionados a un pedido específico
    $sql = "SELECT productos_venta.nombre as producto, 
                   linea_pedidos.cantidad, 
                   linea_pedidos.precio_unitario, 
                   linea_pedidos.iva,
                   linea_pedidos.total,
                   linea_pedidos.id 
            FROM linea_pedidos 
            INNER JOIN productos_venta ON linea_pedidos.id_productos_venta = productos_venta.id 
            WHERE linea_pedidos.id_pedidos = ?";
    
    // Ejecutamos la consulta
    $query = $this->query($sql, [$pedidoId]); // Pasamos el $pedidoId como parámetro

    $datos = array();

    // Verificamos si la consulta ha devuelto resultados
    if ($query->getResult()) {
        $datos = $query->getResultArray();
    }

    // Retornamos los resultados
    return $datos;
}

    
    

}
?>