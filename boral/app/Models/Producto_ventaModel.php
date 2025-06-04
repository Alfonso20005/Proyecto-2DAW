<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Producto_ventaModel extends Model
{

    protected $table='productos_venta';
    protected $allowedFields=['nombre','descripcion','precio','stock','id_categoria_venta'];
    
    public function obtenerProductosCategoria()
    {
        $sql = "SELECT productos_venta.*, 
                       categorias_venta.nombre AS categoria_nombre
                FROM productos_venta
                INNER JOIN categorias_venta ON productos_venta.id_categoria_venta = categorias_venta.id
                ORDER BY productos_venta.id ASC";

        
        $query = $this->query($sql);
        $datos = [];

        if ($query->getResult()) {
            $datos = $query->getResultArray();
        }

        return $datos;
    }
    
    
    public function obtenerProductosVendidosPorCategoria()
{
    // Consulta SQL para contar los productos vendidos por cada categoría
    $sql = "
        SELECT  
            COUNT(detalle_pedidos.id_producto_venta) AS cantidad_vendida
        FROM detalle_pedidos
        INNER JOIN productos_venta ON detalle_pedidos.id_producto_venta = productos_venta.id
        INNER JOIN categorias_venta ON productos_venta.id_categoria_venta = categorias_venta.id
        GROUP BY categorias_venta.id
        ORDER BY cantidad_vendida DESC
    ";

    // Ejecutar la consulta
    $query = $this->query($sql);
    $datos = [];

    // Si la consulta devuelve resultados, los asignamos a $datos
    if ($query->getResult()) {
        $datos = $query->getResultArray();
    }

    // Retornamos los datos con la cantidad de productos vendidos por cada categoría
    return $datos;
}

}
?>