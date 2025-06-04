<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Visual Web
$routes->get('/', 'Dashboard::index');
$routes->get('login', 'Dashboard::login');
$routes->match( ['get','post'],'/SiginController/loginAuthUser', 'SiginController::loginAuthUser');
$routes->post('registro', 'SiginController::registro');
$routes->get('olvidar_contrasena', 'SiginController::forgotPassword');
$routes->post('validarCorreo', 'SiginController::validarCorreo');
$routes->post('verificarCodigo', 'SiginController::verificarCodigo');
$routes->match( ['get','post'],'/SiginController/loginAuthNewPassword', 'SiginController::loginAuthNewPassword');


//FACTURAS
$routes->get('/factura', 'FacturaController::index',['filter'=>'authAdmin']);
    
$routes->match(['get', 'post'], '/facturas/generar', 'FacturaController::generarFactura',['filter'=>'authAdmin']);


//Inciar sesion Como admin
$routes->get('/admin', 'Home::index',['filter' => ['authGuard', 'authDistribuidor']]);

//Dashboard de administracion
$routes->get('/inicio', 'Home::index',['filter' => ['authGuard', 'authDistribuidor']]);

//Login
$routes->match( ['get','post'],'/SiginController/loginAuth', 'SiginController::loginAuth');
$routes->get('/salir', 'ProfileController::cerrar_sesion');
$routes->get('/sigin', 'SiginController::index',['filter'=>'noauthGuard']);


//Perfil User
$routes->get('/perfilUser', 'PerfilUserController::index',['filter'=>'authAdmin']);
$routes->match(['get', 'post'], '/perfilUser/actualizar', 'PerfilUserController::actualizar',['filter'=>['authAdmin']]);
$routes->get('/perfilUser/volver','PerfilUserController::volver',['filter'=>['authAdmin']]);
$routes->post('/perfilUser/verificarContrasena', 'PerfilUserController::verificarContrasena');

//Perfil user de la pagina web
$routes->get('/perfilUserPagina', 'PerfilUserController::perfilUserPagina');
$routes->match(['get', 'post'], '/perfilUserPagina/actualizarPagina', 'PerfilUserController::actualizarPagina');


//BOTON INCIDENCIAS
$routes->get('/incidencias', 'IncidenciasController::index',['filter'=>'authAdmin']);
$routes->match(['get', 'post'],'/incidencias/enviar', 'IncidenciasController::enviar');

$routes->match(['get', 'post'],'/incidencias/editar', 'IncidenciasController::editar',['filter'=>'authAdmin']);
$routes->match(['get', 'post'],'/incidencias/actualizar', 'IncidenciasController::actualizar',['filter'=>'authAdmin']);

$routes->get('/incidencias/volver','IncidenciasController::volver',['filter'=>['authAdmin']]);
    
// ROLES
$routes->get('/roles', 'RolesController::index',['filter'=>['authDistribuidor']]);
$routes->get('/roles/volver','RolesController::volver',['filter'=>['authDistribuidor']]);
$routes->get('/roles/nuevo', 'RolesController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/roles/crear', 'RolesController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/roles/editar', 'RolesController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/roles/actualizar', 'RolesController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/roles/eliminar', 'RolesController::delete',['filter'=>['authDistribuidor']]);

// USUARIOS
$routes->get('/usuarios', 'UsuariosController::index',['filter'=>['authDistribuidor']]);
$routes->get('/usuarios/volver','UsuariosController::volver',['filter'=>['authDistribuidor']]);
$routes->get('/usuarios/nuevo', 'UsuariosController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/usuarios/crear', 'UsuariosController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/usuarios/editar', 'UsuariosController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/usuarios/actualizar', 'UsuariosController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/usuarios/eliminar', 'UsuariosController::delete',['filter'=>['authDistribuidor']]);
$routes->get('/usuarios/grafica', 'UsuariosController::grafica',['filter'=>['authDistribuidor']]);
$routes->get('/usuarios/grafica2', 'UsuariosController::grafica2',['filter'=>['authDistribuidor']]);
$routes->get('/usuarios/grafica3', 'UsuariosController::grafica3',['filter'=>['authDistribuidor']]);
$routes->get('/usuarios/graficas', 'UsuariosController::graficas',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/usuarios/exportar', 'UsuariosController::exportar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/usuarios/exportarPDF', 'UsuariosController::exportarPDF',['filter'=>['authDistribuidor']]);





// DISTRIBUIDORES
$routes->get('/distribuidores', 'DistribuidoresController::index',['filter'=>['authAdmin']]);
$routes->get('/distribuidores/volver','DistribuidoresController::volver',['filter'=>['authAdmin']]);
$routes->get('/distribuidores/nuevo', 'DistribuidoresController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/distribuidores/crear', 'DistribuidoresController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/distribuidores/editar', 'DistribuidoresController::editar',['filter'=>['authAdmin']]);
$routes->match(['get', 'post'], '/distribuidores/actualizar', 'DistribuidoresController::actualizar',['filter'=>['authAdmin']]);
$routes->match(['get', 'post'], '/distribuidores/eliminar', 'DistribuidoresController::delete',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/distribuidores/exportar', 'DistribuidoresController::exportar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/distribuidores/imprimir', 'DistribuidoresController::imprimir',['filter'=>['authAdmin']]);
$routes->match(['get', 'post'], '/distribuidores/exportarPDF', 'DistribuidoresController::exportarPDF',['filter'=>['authDistribuidor']]);


// PROVEEDORES
$routes->get('/proveedores', 'ProveedoresController::index',['filter'=>['authDistribuidor']]);
$routes->get('/proveedores/volver','ProveedoresController::volver',['filter'=>['authDistribuidor']]);
$routes->get('/proveedores/nuevo', 'ProveedoresController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/crear', 'ProveedoresController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/editar', 'ProveedoresController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/actualizar', 'ProveedoresController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/eliminar', 'ProveedoresController::delete',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/exportar', 'ProveedoresController::exportar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/exportarPDF', 'ProveedoresController::exportarPDF',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/proveedores/imprimir', 'ProveedoresController::imprimir',['filter'=>['authDistribuidor']]);

// CATEGORIAS PARA COMPRA
$routes->get('/categorias_compra', 'Categorias_compraController::index',['filter'=>['authDistribuidor']]);
$routes->get('/categorias_compra/volver','Categorias_compraController::volver',['filter'=>['authDistribuidor']]);
$routes->get('/categorias_compra/nuevo', 'Categorias_compraController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_compra/crear', 'Categorias_compraController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_compra/editar', 'Categorias_compraController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_compra/actualizar', 'Categorias_compraController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_compra/eliminar', 'Categorias_compraController::delete',['filter'=>['authDistribuidor']]);


// PRODUCTOS PARA COMPRAR
$routes->get('/productos_compra', 'Productos_compraController::index',['filter'=>['authDistribuidor']]);
$routes->get('/productos_compra/volver','Productos_compraController::volver',['filter'=>['authDistribuidor']]);
$routes->get('/productos_compra/nuevo', 'Productos_compraController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_compra/crear', 'Productos_compraController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_compra/editar', 'Productos_compraController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_compra/actualizar', 'Productos_compraController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_compra/eliminar', 'Productos_compraController::delete',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_compra/exportar', 'Productos_compraController::exportar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_compra/exportarPDF', 'Productos_compraController::exportarPDF',['filter'=>['authDistribuidor']]);


// CATEGORIAS PARA VENTA
$routes->get('/categorias_venta', 'Categorias_ventaController::index',['filter'=>['authDistribuidor']]);
$routes->get('/categorias_venta/volver','Categorias_ventaController::volver',['filter'=>['authDistribuidor']]);
$routes->get('/categorias_venta/nuevo', 'Categorias_ventaController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_venta/crear', 'Categorias_ventaController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_venta/editar', 'Categorias_ventaController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_venta/actualizar', 'Categorias_ventaController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/categorias_venta/eliminar', 'Categorias_ventaController::delete',['filter'=>['authDistribuidor']]);
    

// PRODUCTOS PARA VENDER
$routes->get('/productos_venta', 'Productos_ventaController::index',['filter'=>['authAdmin']]);
$routes->get('/productos_venta/volver','Productos_ventaController::volver',['filter'=>['authAdmin']]);
$routes->get('/productos_venta/nuevo', 'Productos_ventaController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_venta/crear', 'Productos_ventaController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_venta/editar', 'Productos_ventaController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_venta/actualizar', 'Productos_ventaController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_venta/eliminar', 'Productos_ventaController::delete',['filter'=>['authDistribuidor']]);
$routes->post('/productos_venta/guardarRefProductos', 'Productos_ventaController::guardarRefProductos',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/productos_venta/exportar', 'Productos_ventaController::exportar');
$routes->match(['get', 'post'], '/productos_venta/exportarPDF', 'Productos_ventaController::exportarPDF',['filter'=>['authAdmin']]);
    
        
// PEDIDOS
$routes->get('/pedidos', 'PedidosController::index',['filter'=>['authAdmin']]);
$routes->get('/pedidos/volver','PedidosController::volver',['filter'=>['authAdmin']]);
$routes->get('/pedidos/nuevo', 'PedidosController::nuevo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/pedidos/crear', 'PedidosController::crear',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/pedidos/editar', 'PedidosController::editar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/pedidos/actualizar', 'PedidosController::actualizar',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/pedidos/eliminar', 'PedidosController::delete',['filter'=>['authDistribuidor']]);

//OBTENER LOS DATOS DEL PRODUCTO QUE ELIJO
$routes->match(['get', 'post'], '/pedidos/getProductoInfo', 'PedidosController::getProductoInfo',['filter'=>['authDistribuidor']]);
$routes->match(['get', 'post'], '/pedidos/albaran', 'PedidosController::albaran',['filter'=>['authAdmin']]);



// LINEA DE PEDIDOS

//VER LOS PRODUCTOS ASOCIADOS AL PEDIDO
$routes->get('/pedidos/getProductosPorPedido', 'PedidosController::getProductosPorPedido',['filter'=>['authAdmin']]);
$routes->get('/pedidos/eliminarLineaPedido', 'PedidosController::eliminarLineaPedido',['filter'=>['authAdmin']]);
//Inserto en linea pedidos y actualizo el total del pedido
$routes->post('pedidos/actualizarLineaPedido', 'PedidosController::actualizarLineaPedido',['filter'=>['authAdmin']]);
$routes->post('/pedidos/actualizarLineaPedidoEdit', 'PedidosController::actualizarLineaPedidoEdit',['filter'=>['authAdmin']]);

