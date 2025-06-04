<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table='pedidos';
    protected $allowedFields=['id_usuario', 'fecha_pedido', 'estado','total'];
   
    
public function obtenerPedidosConUsuario() {
    // Construcción de la consulta para obtener los datos de pedidos y el usuario asociado
    $sql = "SELECT pedidos.*, usuarios.usuario AS usuario_nombre 
            FROM pedidos 
            INNER JOIN usuarios ON pedidos.id_usuario = usuarios.id";
    
    // Ejecutamos la consulta
    $query = $this->db->query($sql);
    $datos = array();
 
    // Si la consulta devuelve resultados, los guardamos en el array
    if ($query->getResult()) {
        $datos = $query->getResultArray();
    }

    // Retornamos los resultados
    return $datos;
}
    
    
    
    public function obtenerPedidosConUsuarioID($id) {
    // Construcción de la consulta para obtener los datos de pedidos y el usuario asociado
    $sql = "SELECT pedidos.*, usuarios.usuario AS usuario_nombre 
            FROM pedidos 
            INNER JOIN usuarios ON pedidos.id_usuario = usuarios.id
            where id_usuario =".$id;
    
    // Ejecutamos la consulta
    $query = $this->db->query($sql);
    $datos = array();
 
    // Si la consulta devuelve resultados, los guardamos en el array
    if ($query->getResult()) {
        $datos = $query->getResultArray();
    }

    // Retornamos los resultados
    return $datos;
}
    
    
    public function contarPedidosTotales()
    {
        $sql = "SELECT COUNT(*) AS total_pedidos FROM pedidos WHERE estado IN ('entregado', 'enviado')"; 
        $query = $this->query($sql);
        $resultado = $query->getRow();  // Obtener una sola fila del resultado
        
        return $resultado ? $resultado->total_pedidos : 0;  // Retornar el total de pedidos
    }
    
    
   public function contarPedidosHoy()
    {
        // Contar pedidos creados hoy o entregados hoy (aunque hayan sido creados antes)
        $sql = "
            SELECT COUNT(*) AS pedidos_hoy 
            FROM pedidos 
            WHERE 
                DATE(fecha_pedido) = CURDATE()
                OR (estado = 'entregado' AND DATE(updated_at) = CURDATE());
        ";

        $query = $this->query($sql);
        $resultado = $query->getRow();  // Obtener una sola fila del resultado

        return $resultado ? $resultado->pedidos_hoy : 0;  // Retornar el número de pedidos realizados o entregados hoy
    }

    
    
     public function calcularValorPromedioPedido()
    {
        // Consulta SQL para obtener el valor promedio de los pedidos
        $sql = "SELECT AVG(total) AS valor_promedio_pedido FROM pedidos WHERE estado IN ('entregado', 'enviado')";
        
        $query = $this->query($sql);
        $resultado = $query->getRow();  // Obtener una sola fila del resultado
        
        return $resultado ? $resultado->valor_promedio_pedido : 0;  // Retornar el valor promedio de los pedidos
    }
    

    // Método para obtener el valor del último pedido
    public function obtenerUltimoPedido()
    {
        $sql = "SELECT total FROM pedidos WHERE estado IN ('entregado', 'enviado') ORDER BY fecha_pedido DESC LIMIT 1";
        $query = $this->query($sql);
        $resultado = $query->getRow();  // Obtener una sola fila del resultado

        return $resultado ? $resultado->total : 0;  // Retornar el valor del último pedido
    }

    
    
    public function totalPedidosSemanaActualYSemanaPasada()
    {
        // Consulta para obtener el total de los pedidos de la semana actual y la semana pasada
         $sql = "SELECT
                    SUM(CASE WHEN WEEK(fecha_pedido) = WEEK(CURDATE()) THEN total ELSE 0 END) AS total_semana_actual,
                    SUM(CASE WHEN WEEK(fecha_pedido) = WEEK(CURDATE()) - 1 THEN total ELSE 0 END) AS total_semana_pasada
                FROM pedidos
                WHERE estado IN ('entregado', 'enviado')";

        $query = $this->query($sql);
        $resultado = $query->getRow();  // Obtener una sola fila del resultado
        
        return $resultado ? $resultado : null;  // Retornar el total de ambos valores
    }
    
    
    
    public function listaPedidosPorDistribuidor($id_distribuidores)
{
    $pedidos = $this
        ->db->table('pedidos')
        ->join('usuarios', 'pedidos.id_usuario = usuarios.id', 'LEFT')
        ->join('distribuidores', 'distribuidores.id_usuarios = usuarios.id', 'LEFT')
        ->select('pedidos.id, pedidos.fecha_pedido, pedidos.estado, pedidos.total, pedidos.updated_at, 
                  CONCAT(usuarios.email) AS usuario')
        ->where('distribuidores.id', $id_distribuidores)
        ->orderBy('pedidos.fecha_pedido', 'DESC')
        ->get()
        ->getResultArray();

    return $pedidos;
}
    
  public function obtenerTopDistribuidores()
{
    $builder = $this->db->table('distribuidores d');
    $builder->select('d.razon_social, COALESCE(SUM(p.total), 0) as total_vendido');
    $builder->join('usuarios u', 'd.id_usuarios = u.id', 'left');
    $builder->join('pedidos p', "p.id_usuario = u.id AND p.estado != 'cancelado'", 'left');
    $builder->groupBy('d.razon_social');
    $builder->orderBy('total_vendido', 'DESC');
    $builder->limit(5);
    
    $query = $builder->get();
    return $query->getResult();
}

public function obtenerTopProductosPorCantidad()
{
    $builder = $this->db->table('detalle_pedidos dp');
    $builder->select('pv.nombre, COALESCE(SUM(dp.cantidad), 0) as cantidad_total');
    $builder->join('productos_venta pv', 'dp.id_producto_venta = pv.id');
    $builder->join('pedidos p', 'dp.id_pedido = p.id');
    $builder->where('p.estado !=', 'cancelado');
    $builder->groupBy('pv.nombre');
    $builder->orderBy('cantidad_total', 'DESC');
    $builder->limit(5);

    return $builder->get()->getResult();
}

public function obtenerVentasPorMesDelAnio() {
    $anio = date('Y');
    $mes_actual = date('n'); // Mes actual como número (1-12)

    $sql = "SELECT 
                MONTH(fecha_pedido) AS mes, 
                SUM(total) AS total_ventas 
            FROM pedidos 
            WHERE YEAR(fecha_pedido) = ? 
              AND estado != 'cancelado'
            GROUP BY mes 
            ORDER BY mes";

    $query = $this->db->query($sql, [$anio]);

    // Inicializamos array con null en todos los meses
    $ventas_por_mes = array_fill(1, 12, null);

    // Procesamos los resultados
    if ($query->getResult()) {
        $resultados = $query->getResultArray();
        foreach ($resultados as $fila) {
            $mes = (int) $fila['mes'];
            // Solo llenamos datos hasta el mes actual
            if ($mes <= $mes_actual) {
                $ventas_por_mes[$mes] = (float) $fila['total_ventas'];
            }
        }
    }

    // Reindexamos (0-11) para JS
    return array_values($ventas_por_mes);
}

    
public function obtenerProductosPorPedido($pedido_id) {
    // Consulta SQL para obtener los productos asociados al pedido y el total del pedido
    $sql = "SELECT 
                pe.id AS idDelPedido,
                pe.id_usuario AS userId,
                p.nombre AS producto_nombre, 
                dp.cantidad, 
                dp.precio_unitario, 
                dp.subtotal,
                pe.total AS total_pedido
            FROM 
                detalle_pedidos dp
            INNER JOIN productos_venta p ON dp.id_producto_venta = p.id
            INNER JOIN pedidos pe ON dp.id_pedido = pe.id
            WHERE 
                pe.id = '$pedido_id'";
    
    // Ejecutamos la consulta pasando el ID del pedido
    $query = $this->db->query($sql, ['pedido_id' => $pedido_id]);
    
    // Obtener los resultados en caso de que haya productos
    $productos = array();
    if ($query->getResult()) {
        $productos = $query->getResultArray();
    }

    // Retornar los productos junto con el total del pedido
    return $productos;
}
    
    
public function graficaVentasMes() {
    // Consulta SQL para obtener las ventas totales del mes actual
    $sql = "SELECT MONTH(fecha_pedido) AS mes, 
                   SUM(total) AS total_pedido 
            FROM pedidos 
            WHERE MONTH(fecha_pedido) = MONTH(CURDATE()) 
            GROUP BY mes 
            ORDER BY mes;";

    // Ejecutamos la consulta sin necesidad de pasar un parámetro
    $query = $this->db->query($sql);

    return $query->getResultArray();
}


    
    

     

}
?>