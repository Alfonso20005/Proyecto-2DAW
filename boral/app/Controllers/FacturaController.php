<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DistribuidorModel;
use App\Models\PedidoModel;
use App\Models\Detalle_pedidoModel;
use App\Models\Linea_pedidoModel;
use App\Models\Producto_ventaModel;
use App\Models\UsuarioModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class FacturaController extends Controller
{
    protected $helpers=['form','comprobar'];
    
    public function index()
    {
        $options1=array();
        $options1['']="Selecciona un distribuidor";

        $distribuidor=new DistribuidorModel();
        $distribuidores=$distribuidor->findAll();
        foreach ($distribuidores as $distr) {
            // Verificar si la razón social está vacía
            if (empty($distr["razon_social"])) {
                // Si está vacía, usar el nombre y los apellidos
                $options1[$distr["id"]] = $distr["nombre"] . ' ' . $distr["apellidos"];
            } else {
                // Si no está vacía, usar la razón social
                $options1[$distr["id"]] = $distr["razon_social"];
            }
        }
        $data["optionsDistribuidores"]=$options1;
        

        return view('facturasView', $data);
    }


public function generarFactura()
{
    
    $rules=[
        'fecha'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir un mes',
             ]
         ],
          
        
       ]; 
    
    if (session()->get('role') != 'Distribuidor') {
        $rules['id_distribuidores'] = [
            'rules' => 'required',
            'errors' => [
                'required' => 'Debes introducir un distribuidor',
            ]
        ];
    }
        
    
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }
    
    $mes = $this->request->getPost('fecha') ? substr($this->request->getPost('fecha'), 5, 2) : ''; 
    $anio = $this->request->getPost('fecha') ? substr($this->request->getPost('fecha'), 0, 4) : '';
    
    $idDistribuidor = $this->request->getvar('id_distribuidores');
    
    $distribuidorModel = new DistribuidorModel();
    
    if (session()->get('role') === 'Distribuidor') {
        $idUsuario = session()->get('id');
        
        $distribuidor = $distribuidorModel->where('id_usuarios', $idUsuario)->first();
        
        // Obtener los pedidos del distribuidor
        $pedidoModel = new PedidoModel();
        $pedidos = $pedidoModel->where('id_usuario', $idUsuario)
                               ->where('MONTH(fecha_pedido)', $mes)
                               ->where('YEAR(fecha_pedido)', $anio)
                               ->findAll();

    } else {
        $distribuidor = $distribuidorModel->where('id', $idDistribuidor)->first();
        $idDistribuidorUser = $distribuidor["id_usuarios"];
        
        // Obtener los pedidos del distribuidor
        $pedidoModel = new PedidoModel();
        $pedidos = $pedidoModel->where('id_usuario', $idDistribuidorUser)
                               ->where('MONTH(fecha_pedido)', $mes)
                               ->where('YEAR(fecha_pedido)', $anio)
                               ->findAll();
    }

    // Obtener los productos de los pedidos (detalle_pedidos y linea_pedidos)
    $detallePedidoModel = new Detalle_pedidoModel(); // Modelo corregido
    $lineaPedidoModel = new Linea_pedidoModel(); // Modelo corregido
    $productoVentaModel = new Producto_ventaModel(); // Modelo corregido para productos_venta
    
    $productos = [];
    foreach ($pedidos as $pedido) {
        // Obtener los productos de la tabla detalle_pedidos
        $detallePedidos = $detallePedidoModel->where('id_pedido', $pedido['id'])->findAll();
        
        // Obtener los productos de la tabla linea_pedidos
        foreach ($detallePedidos as $detalle) {
            // Obtener el nombre del producto a partir de la tabla productos_venta
            $producto = $productoVentaModel->where('id', $detalle['id_producto_venta'])->first();

            // Verificar si el producto ya está en el array de productos
            if (!isset($productos[$producto['nombre']])) {
                $productos[$producto['nombre']] = [
                    'nombre' => $producto['nombre'], // Nombre del producto obtenido
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'iva' => 0,  // Inicializamos IVA, se puede ajustar luego
                    'total' => 0  // Inicializamos el total, se puede ajustar luego
                ];
            } else {
                // Si el producto ya existe, sumamos la cantidad y total
                $productos[$producto['nombre']]['cantidad'] += $detalle['cantidad'];
            }

            // Obtener las líneas de pedido relacionadas
            $lineaPedidos = $lineaPedidoModel->where('id_pedidos', $pedido['id'])->findAll();
            foreach ($lineaPedidos as $linea) {
                if ($linea['id_productos_venta'] == $detalle['id_producto_venta']) {
                    // Actualizar IVA y total para ese producto específico
                    $productos[$producto['nombre']]['iva'] = $linea['iva'];
                    $productos[$producto['nombre']]['total'] += $linea['total'];
                }
            }
        }
    }
    
    
    $idUsuarioDistribuidor = $distribuidor['id_usuarios'];
    $usuarioModel = new UsuarioModel();  // Aquí necesitas tener un modelo para la tabla 'usuarios'
    $usuario = $usuarioModel->where('id', $idUsuarioDistribuidor)->first();
    $emailDistribuidor = $usuario['email'];

    $empresa = [
        'nombre' => 'Mi Empresa S.A.',
        'direccion' => 'Calle Falsa 123',
        'telefono' => '123-456-789',
        'email' => 'boralpasteleria@gmail.com'
    ];
    
    // Sumar el total de los pedidos
    $totalPedidos = 0;
    foreach ($productos as $producto) {
        $totalPedidos += $producto['total'];
    }
    
    // Pasar los datos a la vista
    $data = [
        'empresa' => $empresa,
        'distribuidor' => $distribuidor,
        'productos' => $productos,
        'mes' => $mes,
        'anio' => $anio,
        'totalPedidos' => $totalPedidos,
        'email' => $emailDistribuidor
    ];
    
    $html = view('factura_pdf', $data);

    // Generación del PDF con Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    
    
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'inline; filename="factura.pdf"')
        ->setBody($dompdf->output());
}



}
