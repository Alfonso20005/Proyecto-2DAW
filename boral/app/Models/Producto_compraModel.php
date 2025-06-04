<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Producto_compraModel extends Model
{
//   SELECT `id`, `nombre`, `descripcion`, `precio`, `stock`, `id_categoria_compra`, `id_proveedores` FROM `productos_compra` WHERE 1
    protected $table='productos_compra';
    protected $allowedFields=['nombre','descripcion','precio','stock','id_categoria_compra','id_proveedores'];
    
    public function obtenerProductosConProveedorYCategoria()
    {
        $sql = "SELECT productos_compra.*, 
                      IF(proveedores.razon_social IS NOT NULL AND proveedores.razon_social != '', proveedores.razon_social, CONCAT(proveedores.nombre, ' ', proveedores.apellidos)) AS proveedor_nombre,
                       categorias_compra.nombre AS categoria_nombre
                FROM productos_compra
                INNER JOIN proveedores ON productos_compra.id_proveedores = proveedores.id
                INNER JOIN categorias_compra ON productos_compra.id_categoria_compra = categorias_compra.id
                ORDER BY productos_compra.id ASC";

        
        $query = $this->query($sql);
        $datos = [];

        if ($query->getResult()) {
            $datos = $query->getResultArray();
        }

        return $datos;
    }
    
    
    public function productosPorProveedor($id_proveedor)
    {
        $productos = $this
            ->db->table('productos_compra p')
            ->select('p.id AS id_producto, 
                      p.nombre AS nombre_producto,  
                      p.precio,  
                      c.nombre AS nombre_categoria')
            ->join('categorias_compra c', 'p.id_categoria_compra = c.id', 'LEFT')
            ->join('proveedores pr', 'p.id_proveedores = pr.id', 'LEFT')
            ->where('pr.id', $id_proveedor)
            ->orderBy('p.nombre', 'ASC')
            ->get()
            ->getResultArray();

        return $productos;
    }
    
    public function obtenerProductoMaximoYMinimoStockConNombre()
{
    // Consulta para producto con más stock
    $sql_max = "
        SELECT productos_compra.*, 
               IF(proveedores.razon_social IS NOT NULL AND proveedores.razon_social != '', proveedores.razon_social, CONCAT(proveedores.nombre, ' ', proveedores.apellidos)) AS proveedor_nombre,
               categorias_compra.nombre AS categoria_nombre
        FROM productos_compra
        INNER JOIN proveedores ON productos_compra.id_proveedores = proveedores.id
        INNER JOIN categorias_compra ON productos_compra.id_categoria_compra = categorias_compra.id
        WHERE productos_compra.stock IS NOT NULL
        ORDER BY productos_compra.stock DESC
        LIMIT 1
    ";

    $query_max = $this->query($sql_max);
    $producto_max = $query_max->getRowArray();

    // Consulta para producto con menos stock
    $sql_min = "
        SELECT productos_compra.*, 
               IF(proveedores.razon_social IS NOT NULL AND proveedores.razon_social != '', proveedores.razon_social, CONCAT(proveedores.nombre, ' ', proveedores.apellidos)) AS proveedor_nombre,
               categorias_compra.nombre AS categoria_nombre
        FROM productos_compra
        INNER JOIN proveedores ON productos_compra.id_proveedores = proveedores.id
        INNER JOIN categorias_compra ON productos_compra.id_categoria_compra = categorias_compra.id
        WHERE productos_compra.stock IS NOT NULL
        ORDER BY productos_compra.stock ASC
        LIMIT 1
    ";

    $query_min = $this->query($sql_min);
    $producto_min = $query_min->getRowArray();

    return [
        'max' => $producto_max,
        'min' => $producto_min
    ];
}



}
?>