<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PedidoModel;
use App\Models\UsuarioModel;
use App\Models\Linea_pedidoModel;
use App\Models\Detalle_pedidoModel;
use App\Models\Producto_ventaModel;
use App\Models\Ref_productos_venta_productos_compraModel;
use App\Models\Producto_compraModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class PedidosController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new PedidoModel();
        if(session()->get('role')=="Distribuidor"){
            $data['pedidos'] = array();
            $pedido = $model->obtenerPedidosConUsuarioID(session()->get('id'));

            // Verifico si el pedido existe antes de asignarlo
            if ($pedido) {
                $data['pedidos'] = $pedido;
            } else {
                // Si no hay pedidos, array vacio
                $data['pedidos'] = [];
            }
        }else{
            $data['pedidos']=$model->obtenerPedidosConUsuario();
        }
        
        
        $options=array();
        $options['']="Selecciona un producto";
        
        $producto_venta=new Producto_ventaModel();
        $productos_venta=$producto_venta->findAll();
        foreach($productos_venta as $pro){
                $options[$pro["id"]]=$pro["nombre"];
        }
        $data["optionsProductos"]=$options;
        
        
        return view('pedidosListView',$data);
    }
    
    public function nuevo()
    {
        $options=array();
        $options['']="Selecciona un usuario";
        
        $usuario=new UsuarioModel();
        $usuarios=$usuario->findAll();
        foreach($usuarios as $user){
                $options[$user["id"]]=$user["usuario"];
        }
        $data["optionsUsuarios"]=$options;
        
        return view('pedidosNewView',$data);
    }
    
    //CUANDO AÑADO PRODUCTO AL ELEGIR QUE ME DE EL PRECIO
        public function getProductoInfo()
    {
        $productoId = $this->request->getVar('id');
        $productoModel = new Producto_ventaModel();
        $producto = $productoModel->find($productoId);

        echo json_encode($producto); // Devuelve los datos del producto (precio y stock)
    }

    
     public function crear()
    {
       
         $rules=[
         'id_usuario'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir un usuario',
                 
             ]
         ],
        'fecha_pedido' => [
            'rules' => 'required|fecha_pedido_no_pasada',
            'errors' => [
                'required' => 'Debes introducir una fecha',
                'fecha_pedido_no_pasada' => 'La fecha de pedido nueva no puede ser anterior a 7 dias antes de la fecha actual',
            ]
        ],
        'estado'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir un estado',
                 
             ]
         ],
            
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new PedidoModel();
        $id_usuario=$this->request->getvar('id_usuario');
        $fecha_pedido=$this->request->getvar('fecha_pedido');
        $estado=$this->request->getvar('estado');

         
         $newData=[
             'id_usuario'=>$id_usuario,
             'fecha_pedido' => $fecha_pedido,
             'estado'=>$estado,
             'total'=>0,
         ];
         
         $model->save($newData);
         
         
          return redirect()->to('/pedidos');
    }
    
    public function editar()
    {
        
        $model=new PedidoModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        $options=array();
        $options['']="Selecciona un usuario";
        
        $modelUsuario=new UsuarioModel();
        $usuarios=$modelUsuario->findAll();
        foreach($usuarios as $usuario){
            $options[$usuario["id"]]=$usuario["usuario"];
        }
        $data["optionsUsuario"]=$options;
        
        return view('pedidosEditView',$data);
    }
    

    
    public function actualizar()
{
    $model = new PedidoModel();
    $id = $this->request->getVar('id');
    $fecha = $model->find($id);
    $fechaAntigua = $fecha['fecha_pedido'];
    $estadoActual = $fecha['estado'];

    $rules = [
        'id_usuario' => [
            'rules' => 'required',
            'errors' => ['required' => 'Debes introducir un usuario']
        ],
        'fecha_pedido' => [
            'rules' => 'required|fecha_pedido_no_pasadaEdit['.$fechaAntigua.']',
            'errors' => [
                'required' => 'Debes introducir una fecha',
                'fecha_pedido_no_pasadaEdit' => 'La fecha de pedido nueva no puede ser anterior a 7 dias antes de la fecha actual'
            ]
        ],
        'estado' => [
            'rules' => 'required|comprobar_estado['.$estadoActual.']',
            'errors' => ['required' => 'Debes introducir un estado', 'comprobar_estado' => 'El estado no puede cambiar a uno no permitido según el estado actual.']
        ]
    ];

    $datos = $this->request->getPost(array_keys($rules));
    if (!$this->validateData($datos, $rules)) {
        return redirect()->back()->withInput();
    }

    $id_usuario = $this->request->getVar('id_usuario');
    $fecha_pedido = $this->request->getVar('fecha_pedido');
    $estado = $this->request->getVar('estado');

    $modelUsuario = new UsuarioModel();
    $usuario = $modelUsuario->find($id_usuario);
    $userEmail = $usuario['email'];

    if ($estado === 'entregado') {
        $detalleModel = new Detalle_pedidoModel();
        $productos = $detalleModel->where('id_pedido', $id)->findAll();

        $mensajeHtml = "<h2 style='color: #4CAF50;'>🎉 Tu pedido ha sido entregado</h2>";
        $mensajeHtml .= "<p>Hola <strong>" . $usuario['usuario'] . "</strong>,</p>";
        $mensajeHtml .= "<p>Tu pedido con ID <strong>" . $id . "</strong> ha sido entregado con éxito.</p>";
        $mensajeHtml .= "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; width: 100%; background-color: #f9f9f9;'>";
        $mensajeHtml .= "<tr style='background-color: #4CAF50; color: white;'><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Total</th></tr>";
        
        $totalPedido = 0;
        foreach ($productos as $producto) {
            $modelProducto = new Producto_ventaModel();
            $productoInfo = $modelProducto->find($producto['id_producto_venta']);
            
            $subtotal = $producto['cantidad'] * $producto['precio_unitario'];
            $totalPedido += $subtotal;
            
            $mensajeHtml .= "<tr style='text-align: center;'>";
            $mensajeHtml .= "<td style='padding: 8px;'>" . $productoInfo['nombre'] . "</td>";
            $mensajeHtml .= "<td>" . $producto['cantidad'] . "</td>";
            $mensajeHtml .= "<td>" . number_format($producto['precio_unitario'], 2) . "€</td>";
            $mensajeHtml .= "<td>" . number_format($subtotal, 2) . "€</td>";
            $mensajeHtml .= "</tr>";
        }
        $mensajeHtml .= "<tr style='font-weight: bold;'><td colspan='3'><strong>Total:</strong></td><td>" . number_format($totalPedido, 2) . "€</td></tr>";
        $mensajeHtml .= "</table>";
        $mensajeHtml .= "<p>Gracias por confiar en nosotros.</p>";

        $mensajeHtml .= "<div style='text-align: center; margin-top: 20px;'>";
        $mensajeHtml .= "<img src='https://i.ibb.co/8g9y25x7/boral.png' alt='Logo Boral' style='max-width: 200px;'>";
        $mensajeHtml .= "</div>";
        
        $email = service('email');
        $email->setMailType('html');
        $email->setFrom('ifc303@fpmarco.com', 'ERP BORAL');
        $email->setTo($userEmail);
        $email->setSubject('📦 Tu pedido ha sido entregado');
        $email->setMessage($mensajeHtml);
        $email->send();
    }

    $model->where('id', $id)
        ->set([
            'id_usuario' => $id_usuario,
            'fecha_pedido' => $fecha_pedido,
            'estado' => $estado,
            'updated_at' => date('Y-m-d H:i:s'),
        ])
        ->update();

    return redirect()->to('/pedidos');
}

   
    
     public function delete()
    {
        $detalleModel = new Detalle_pedidoModel(); // Modelo de detalles del pedido
        $pedidoModel = new PedidoModel(); // Modelo del pedido

        $id = $this->request->getVar('id');

        // Eliminar los detalles del pedido primero
        $detalleModel->where('id_pedido', $id)->delete();

        // Luego eliminar el pedido
        if ($pedidoModel->delete($id)) {
            echo 1; // Éxito
        } else {
            echo 0; // Error
        }
    }
    
    public function volver()
    {
        return redirect()->to('/pedidos');
    }
    
    
public function actualizarLineaPedido()
{
    $lineaPedidoModel = new Linea_pedidoModel();
    $pedidoModel = new PedidoModel();
    $detalle_pedidoModel = new Detalle_pedidoModel();
    $refModel = new Ref_productos_venta_productos_compraModel(); // Modelo para la relación
    $productosCompraModel = new Producto_compraModel(); // Modelo de productos compra

    // Obtener datos del formulario (POST)
    $id_pedidos = $this->request->getPost('id_pedidos');
    $id_productos_venta = $this->request->getPost('id_productos_venta');
    $cantidad = $this->request->getPost('cantidad');
    $precio_unitario = $this->request->getPost('precio_unitario');
    $iva = $this->request->getPost('iva');

    // Calcular el total
    $total = $cantidad * $precio_unitario * (1 + $iva / 100);

    // Insertar la línea de pedido
    $newData = [
        'id_pedidos' => $id_pedidos,
        'id_productos_venta' => $id_productos_venta,
        'cantidad' => $cantidad,
        'precio_unitario' => $precio_unitario,
        'iva' => $iva,
        'total' => $total
    ];

    if (!$lineaPedidoModel->save($newData)) {
        return redirect()->to('/pedidos');
    }

    // Insertar en la tabla detalle_pedido
    $newDetallePedido = [
        'id_pedido' => $id_pedidos,
        'id_producto_venta' => $id_productos_venta,
        'cantidad' => $cantidad,
        'precio_unitario' => $precio_unitario,
        'subtotal' => $total,
    ];

    if (!$detalle_pedidoModel->save($newDetallePedido)) {
        return redirect()->to('/pedidos');
    }

    // Actualizar el total del pedido
    $totalPedido = $lineaPedidoModel->selectSum('total')
                                    ->where('id_pedidos', $id_pedidos)
                                    ->get()
                                    ->getRow()
                                    ->total;

    $pedidoModel->update($id_pedidos, ['total' => $totalPedido]);

    // Restar ingredientes de productos_compra
    $ingredientes = $refModel->where('id_producto_venta', $id_productos_venta)->findAll();
    foreach ($ingredientes as $ingrediente) {
        $id_producto_compra = $ingrediente['id_producto_compra'];
        $cantidad_necesaria = $ingrediente['cantidad'] * $cantidad; // Se multiplica por la cantidad vendida

        // Obtener el stock actual
        $producto = $productosCompraModel->find($id_producto_compra);
        if ($producto) {
            $nuevo_stock = $producto['stock'] - $cantidad_necesaria;
            $productosCompraModel->update($id_producto_compra, ['stock' => max($nuevo_stock, 0)]);
        }
    }

    return redirect()->to('/pedidos');
}
    
public function eliminarLineaPedido()
{
    $model = new Linea_pedidoModel();
    $pedidoModel = new PedidoModel();  // Modelo de pedidos para actualizar el total
    $id = $this->request->getVar('id');

    // Eliminar la línea de pedido
    if ($model->where('id', $id)->delete()) {
        // Recalcular el total del pedido después de eliminar la línea
        $pedidoId = $this->request->getVar('id_pedidos'); // Suponiendo que pasas el ID del pedido también
        $totalNuevo = $this->calcularTotalPedido($pedidoId); // Función para recalcular el total

        // Actualizar el total del pedido en la base de datos
        $pedidoModel->update($pedidoId, ['total' => $totalNuevo]);

        echo json_encode(['status' => 'success', 'nuevoTotal' => $totalNuevo]);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

// Función para calcular el total del pedido
private function calcularTotalPedido($pedidoId)
{
    $model = new Linea_pedidoModel();
    $productos = $model->where('id_pedidos', $pedidoId)->findAll(); // Obtener todos los productos del pedido

    $total = 0;
    foreach ($productos as $producto) {
        $total += $producto['cantidad'] * $producto['precio_unitario'] * (1 + $producto['iva'] / 100);
    }

    return $total;
}


//MOSTRAR LOS PRODUCTOS QUE TIENE UN PEDIDO
    public function getProductosPorPedido() 
{
    $pedidoId = $this->request->getGet('id_pedido');
        
    $model=new Linea_pedidoModel();
    $productos=$model->getProductosPorPedido($pedidoId);
    

     echo json_encode($productos);
}
    
    
   public function actualizarLineaPedidoEdit()
{
    // Obtenemos los datos del pedido
    $id_pedido = $this->request->getPost('id_pedido');
    $productos = $this->request->getPost('productos');

    $pedidoModel = new PedidoModel();
    $lineaPedidoModel = new Linea_pedidoModel();
    $refModel = new Ref_productos_venta_productos_compraModel(); // Modelo para la relación
    $productosCompraModel = new Producto_compraModel(); // Modelo de productos compra

    $totalPedido = 0; // Inicializamos el total del pedido

    // Actualizamos las líneas de pedido
    foreach ($productos as $producto) {

        // Obtener la cantidad anterior para revertir el stock
        $lineaAnterior = $lineaPedidoModel->find($producto['id']);
        $cantidadAnterior = $lineaAnterior ? $lineaAnterior['cantidad'] : 0;

        // Calculamos el nuevo total de cada línea
        $totalLinea = $producto['cantidad'] * $producto['precio_unitario'] * (1 + $producto['iva'] / 100);

        // Actualizamos la línea de pedido en la base de datos
        $lineaPedidoModel->update($producto['id'], [
            'cantidad' => $producto['cantidad'],
            'precio_unitario' => $producto['precio_unitario'],
            'iva' => $producto['iva'],
            'total' => $totalLinea
        ]);

        // Obtener id_producto_venta desde la línea de pedido
        $lineaPedido = $lineaPedidoModel->find($producto['id']);
        if (!$lineaPedido || !isset($lineaPedido['id_productos_venta'])) {
            continue; // Si no hay producto de venta asociado, omitir
        }
        $id_producto_venta = $lineaPedido['id_productos_venta'];

        // Ajustar el stock de los ingredientes
        $ingredientes = $refModel->where('id_producto_venta', $id_producto_venta)->findAll();
        foreach ($ingredientes as $ingrediente) {
            $id_producto_compra = $ingrediente['id_producto_compra'];
            $cantidad_necesaria_nueva = $ingrediente['cantidad'] * $producto['cantidad'];
            $cantidad_necesaria_anterior = $ingrediente['cantidad'] * $cantidadAnterior;
            $ajuste_stock = $cantidad_necesaria_anterior - $cantidad_necesaria_nueva;

            // Obtener el stock actual
            $productoCompra = $productosCompraModel->find($id_producto_compra);
            if ($productoCompra) {
                $nuevo_stock = $productoCompra['stock'] + $ajuste_stock;
                $productosCompraModel->update($id_producto_compra, ['stock' => max($nuevo_stock, 0)]);
            }
        }

        // Sumamos al total del pedido
        $totalPedido += $totalLinea;
    }

    // Actualizamos el total del pedido en la tabla 'pedidos'
    $pedidoModel->update($id_pedido, [
        'total' => $totalPedido
    ]);

    // Respondemos con un mensaje de éxito
    return $this->response->setJSON([
        'status' => 'success',
        'nuevoTotal' => number_format($totalPedido, 2) . '€'
    ]);
}
    
    
public function albaran()
{
    $id=$this->request->getvar('id');
    
    $userIdSesion = session()->get('id');  
    $userRole = session()->get('role');
    
    $model = new PedidoModel();
    $pedidos = $model->obtenerProductosPorPedido($id);
    
    $distribuidorIdPedido = $pedidos[0]["userId"];
    if ($distribuidorIdPedido != $userIdSesion && !in_array($userRole, ['Administrador', 'SuperAdmin'])) {
        return redirect()->to('/pedidos');
    }
    
    // Preparar los datos para la vista
    $data["pedidos"] = $pedidos;
    $data["id"] = $pedidos[0]["idDelPedido"];
    
    $modelUser = new UsuarioModel();
    $data["infoUser"] = $modelUser->where('id',$pedidos[0]["userId"])->first();
    
    $html = view('pedidoAlbaranView', $data);

    // Configuración Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true); 
    $dompdf = new Dompdf($options);

    // Cargar el HTML de la vista
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Mostrar el PDF en el navegador sin descargar
    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'inline; filename="distribuidores.pdf"')
        ->setBody($dompdf->output());
}






}
