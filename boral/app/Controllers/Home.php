<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UsuarioModel;
use App\Models\PedidoModel;
use App\Models\Producto_ventaModel;
use App\Models\Producto_compraModel;
use App\Models\Detalle_pedidoModel;
use App\Models\Categoria_ventaModel;

class Home extends BaseController
{
     protected $helpers=['form'];
   public function index()
{

    //KPIS
    $model = new UsuarioModel();
    $total_usuarios = $model->contarUsuariosTotales();  // Llamamos al método para contar los usuarios
     $usuarios_hoy = $model->contarUsuariosHoy();  // Llamamos al método para contar los usuarios de hoy
    $data["total_usuarios"] = $total_usuarios;  // Pasamos el total de usuarios a la vista
    $data["usuarios_hoy"] = $usuarios_hoy;
    
       
    $modelPedido = new PedidoModel();
    $total_pedidos = $modelPedido->contarPedidosTotales();
    $pedidos_hoy = $modelPedido->contarPedidosHoy();
       
    $valor_promedio_pedido = $modelPedido->calcularValorPromedioPedido();  // Llamamos al método para obtener el valor promedio
    $data["valor_promedio_pedido"] = $valor_promedio_pedido;   
    
    $ultimo_pedido = $modelPedido->obtenerUltimoPedido();  // Llamamos al método para obtener el valor promedio
    $data["ultimo_pedido"] = $ultimo_pedido;   
       
    $data["total_pedidos"] = $total_pedidos; 
    $data["pedidos_hoy"] = $pedidos_hoy;
       
   // Obtener el total de los pedidos de la semana actual y la semana pasada
    $totales = $modelPedido->totalPedidosSemanaActualYSemanaPasada();
    $data["total_semana_actual"] = $totales->total_semana_actual;
    $data["total_semana_pasada"] = $totales->total_semana_pasada;
    
       
       
    //GRAFICAS
       
    //Productos por categoria venta
    $productos_venta_model = new Producto_ventaModel();
    $productos = $productos_venta_model->obtenerProductosVendidosPorCategoria();
    $data["bolleria"] = $productos[0]['cantidad_vendida'];  
    $data["pasteleria"] = $productos[1]['cantidad_vendida'];  
    
       
    //Ranking Distribuidores
    $top_distribuidores = $modelPedido->obtenerTopDistribuidores();
    $data["top_distribuidores"] = $top_distribuidores;

    //Ranking productos
    $top_productos_cantidad = $modelPedido->obtenerTopProductosPorCantidad();
    $data["top_productos_cantidad"] = $top_productos_cantidad;
       
    //Grafica ventas en el año
    $ventas_por_mes = $modelPedido->obtenerVentasPorMesDelAnio();
    $data["ventas_por_mes"] = array_values($ventas_por_mes); 
    
    //Grafica producto mas stock vs menor stock
    $modelProductoCompra = new Producto_compraModel();
    $producto_stock = $modelProductoCompra->obtenerProductoMaximoYMinimoStockConNombre();
    $data["producto_max_stock"] = $producto_stock['max'];
    $data["producto_min_stock"] = $producto_stock['min'];

       
    //GRAFICA ventas mes actual
    $ventasMes = $modelPedido->graficaVentasMes();

    if (!empty($ventasMes)) {
        $data["mes"] = $ventasMes[0]['mes'];  
        $data["ventasDelMes"] = $ventasMes[0]['total_pedido']; 
    } else {
        $data["mes"] = (int)date("n");
        $data["ventasDelMes"] = 0;
    }

       
    return view('inicio', $data);
}

   




    
    
}
