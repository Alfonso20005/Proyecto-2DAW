-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2025 a las 19:51:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_compra`
--

CREATE TABLE `categorias_compra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias_compra`
--

INSERT INTO `categorias_compra` (`id`, `nombre`) VALUES
(1, 'Harinas'),
(2, 'Huevos y lacteos'),
(3, 'Azucares'),
(4, 'Chocolates');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_venta`
--

CREATE TABLE `categorias_venta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias_venta`
--

INSERT INTO `categorias_venta` (`id`, `nombre`) VALUES
(1, 'Pasteleria'),
(2, 'Bolleria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `id_pedido`, `id_producto_venta`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(3, 4, 2, 1, 2.30, 3.63),
(4, 4, 2, 2, 2.30, 4.78),
(6, 6, 4, 1, 1.60, 1.66),
(7, 6, 3, 1, 10.75, 11.83),
(14, 9, 2, 1, 2.30, 2.39),
(15, 9, 4, 1, 1.60, 1.66),
(16, 9, 5, 1, 1.50, 1.56),
(17, 10, 1, 2, 15.50, 37.51),
(18, 12, 1, 1, 15.50, 16.12),
(19, 12, 2, 1, 2.30, 2.39),
(20, 11, 6, 1, 10.00, 12.10),
(21, 13, 4, 2, 1.60, 3.33),
(22, 13, 5, 1, 1.50, 1.65),
(23, 2, 1, 1, 15.50, 17.05),
(24, 2, 2, 1, 2.30, 2.53),
(25, 13, 6, 1, 10.00, 10.40),
(26, 14, 1, 1, 15.50, 16.12),
(27, 15, 7, 1, 11.00, 11.44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidores`
--

CREATE TABLE `distribuidores` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cif_nif_nie` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `distribuidores`
--

INSERT INTO `distribuidores` (`id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `telefono`, `id_usuarios`) VALUES
(1, 'Tahona Palas', 'Fernando', 'Palas', '22222222R', '692783672', 7),
(2, 'Laramar', '', '', '73445442W', '669710107', 2),
(4, 'Cimorra', 'Alberto', 'Cimorra', '12345678W', '612345678', 4),
(5, 'Borao', 'Adrian', 'Borao', '54768901T', '681010372', 3),
(6, 'Prudencio', 'Prudencio', 'Sanz', '45645928A', '692543668', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `email`, `descripcion`, `estado`, `fecha`) VALUES
(1, 'boralpasteleria@gmail.com', '<p>Hubo un problema al hacer los pedidos</p>', 'resuelto', '2025-03-31'),
(2, 'boralpasteleria@gmail.com', '<p>Problemas con la foto de perfil</p>', 'sin resolver', '2025-03-31'),
(3, 'boralpasteleria@gmail.com', '<p>pROMBLEMAS REGISTRO</p>', 'resuelto', '2025-03-31'),
(4, 'a@gmail.com', '<p>Tengo problemas al descargar los albaranes</p>', 'sin resolver', '2025-04-02'),
(5, 'a@gmail.com', '<p>Problemicas tecnicos</p>', 'sin resolver', '2025-04-02'),
(6, 'alfonso.ascaso.lizarrondo@gmail.com', '<p>Holaaaaaaaa funcionaaa??</p>', 'sin resolver', '2025-04-25'),
(7, 'boralpasteleria@gmail.com', '<p>No funciona la creacion y edicion de los pedidos</p>', 'sin resolver', '2025-05-08'),
(8, 'boralpasteleria@gmail.com', '<p>No funciona nada de la pagina web&nbsp;</p>', 'sin resolver', '2025-05-08'),
(9, 'boralpasteleria@gmail.com', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>', 'sin resolver', '2025-06-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedidos`
--

CREATE TABLE `linea_pedidos` (
  `id` int(11) NOT NULL,
  `id_pedidos` int(11) NOT NULL,
  `id_productos_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double NOT NULL,
  `iva` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `linea_pedidos`
--

INSERT INTO `linea_pedidos` (`id`, `id_pedidos`, `id_productos_venta`, `cantidad`, `precio_unitario`, `iva`, `total`) VALUES
(1, 2, 1, 1, 15.5, 10, 17.05),
(2, 2, 2, 1, 2.3, 10, 2.53),
(3, 3, 2, 3, 2.45, 4, 7.644),
(10, 4, 2, 1, 3.3, 10, 3.63),
(11, 4, 2, 2, 2.3, 4, 4.784),
(13, 6, 4, 1, 1.6, 4, 1.664),
(14, 6, 3, 1, 10.75, 10, 11.825),
(15, 7, 2, 1, 2.3, 4, 2.392),
(16, 7, 3, 1, 10.75, 4, 11.18),
(17, 7, 5, 1, 1.5, 4, 1.56),
(18, 8, 2, 1, 2.3, 4, 2.392),
(19, 8, 5, 1, 1.5, 4, 1.56),
(20, 8, 4, 1, 1.6, 4, 1.664),
(21, 9, 2, 1, 2.3, 4, 2.392),
(22, 9, 4, 1, 1.6, 4, 1.664),
(23, 9, 5, 1, 1.5, 4, 1.56),
(24, 10, 1, 2, 15.5, 21, 37.51),
(25, 12, 1, 1, 15.5, 4, 16.12),
(26, 12, 2, 1, 2.3, 4, 2.392),
(27, 11, 6, 1, 10, 21, 12.1),
(28, 13, 4, 2, 1.6, 4, 3.328),
(29, 13, 5, 1, 1.5, 10, 1.65),
(30, 13, 6, 1, 10, 4, 10.4),
(31, 14, 1, 1, 15.5, 4, 16.12),
(32, 15, 7, 1, 11, 4, 11.44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id`, `nombre`) VALUES
(1, 'PayPal'),
(2, 'Tarjeta Credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_pedido` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','enviado','entregado','cancelado') NOT NULL DEFAULT 'pendiente',
  `total` decimal(10,2) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `fecha_pedido`, `estado`, `total`, `updated_at`) VALUES
(2, 1, '2025-03-26 00:00:00', 'entregado', 19.58, '2025-03-27 18:48:32'),
(3, 2, '2025-03-25 00:00:00', 'cancelado', 10.04, '2025-04-04 18:48:32'),
(4, 5, '2025-03-29 00:00:00', 'entregado', 8.41, '2025-04-03 18:48:32'),
(6, 10, '2025-04-03 00:00:00', 'entregado', 13.49, '2025-04-04 18:48:32'),
(9, 8, '2025-02-04 00:00:00', 'entregado', 5.62, '2025-04-04 20:11:14'),
(10, 7, '2025-04-06 00:00:00', 'enviado', 37.51, '2025-04-06 18:52:46'),
(11, 10, '2025-01-08 00:00:00', 'pendiente', 12.10, '2025-04-08 23:19:52'),
(12, 7, '2025-04-10 00:00:00', 'pendiente', 18.51, '2025-04-09 19:45:09'),
(13, 4, '2025-04-14 00:00:00', 'entregado', 15.38, '2025-04-14 21:44:41'),
(14, 15, '2025-05-01 00:00:00', 'enviado', 16.12, '2025-05-01 18:39:39'),
(15, 15, '2025-06-05 00:00:00', 'enviado', 11.44, '2025-06-05 19:04:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_compra`
--

CREATE TABLE `productos_compra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` decimal(10,0) NOT NULL DEFAULT 0,
  `id_categoria_compra` int(11) NOT NULL,
  `id_proveedores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos_compra`
--

INSERT INTO `productos_compra` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `id_categoria_compra`, `id_proveedores`) VALUES
(1, 'Harina de trigo', '<p class=\"\" data-start=\"0\" data-end=\"36\"><strong data-start=\"0\" data-end=\"17\">Ingredientes:</strong><br data-start=\"17\" data-end=\"20\">Harina de trigo.</p>\r\n<p class=\"\" data-start=\"38\" data-end=\"135\"><strong data-start=\"38\" data-end=\"55\">Conservaci&oacute;n:</strong><br data-start=\"55\" data-end=\"58\">Guardar en un lugar fresco, seco y en un recipiente herm&eacute;tico, hasta 6 meses.</p>', 10.00, 22000, 1, 1),
(2, 'Huevos', '<p class=\"\" data-start=\"0\" data-end=\"27\"><strong data-start=\"0\" data-end=\"17\">Ingredientes:</strong><br data-start=\"17\" data-end=\"20\">Huevos.</p>\r\n<p class=\"\" data-start=\"29\" data-end=\"116\"><strong data-start=\"29\" data-end=\"46\">Conservaci&oacute;n:</strong><br data-start=\"46\" data-end=\"49\">Guardar en el refrigerador, en su cart&oacute;n original, hasta 3 semanas.</p>', 10.50, 19050, 2, 2),
(3, 'Mantequilla', '<p class=\"\" data-start=\"0\" data-end=\"32\"><strong data-start=\"0\" data-end=\"17\">Ingredientes:</strong><br data-start=\"17\" data-end=\"20\">Mantequilla.</p>\r\n<p class=\"\" data-start=\"34\" data-end=\"177\"><strong data-start=\"34\" data-end=\"51\">Conservaci&oacute;n:</strong><br data-start=\"51\" data-end=\"54\">Conservar en el refrigerador, en su envase original o envuelta en papel film, hasta 1 mes. Se puede congelar hasta 6 meses.</p>', 7.36, 9550, 2, 1),
(4, 'Nata', '<p class=\"\" data-start=\"0\" data-end=\"25\"><strong data-start=\"0\" data-end=\"17\">Ingredientes:</strong><br data-start=\"17\" data-end=\"20\">Nata.</p>\r\n<p class=\"\" data-start=\"27\" data-end=\"181\"><strong data-start=\"27\" data-end=\"44\">Conservaci&oacute;n:</strong><br data-start=\"44\" data-end=\"47\">Guardar en el refrigerador, en su envase original, hasta 7 d&iacute;as despu&eacute;s de abrir. Si es nata l&iacute;quida, se puede congelar hasta 3 meses.</p>', 15.00, 7100, 2, 2),
(5, 'Azucar Blanco', '<p class=\"\" data-start=\"0\" data-end=\"34\"><strong data-start=\"0\" data-end=\"17\">Ingredientes:</strong><br data-start=\"17\" data-end=\"20\">Az&uacute;car blanco.</p>\r\n<p class=\"\" data-start=\"36\" data-end=\"130\"><strong data-start=\"36\" data-end=\"53\">Conservaci&oacute;n:</strong><br data-start=\"53\" data-end=\"56\">Conservar en un lugar fresco, seco y cerrado herm&eacute;ticamente, hasta 2 a&ntilde;os.</p>', 8.90, 5380, 3, 2),
(6, 'Chocolate Negro', '<p class=\"\" data-start=\"0\" data-end=\"36\"><strong data-start=\"0\" data-end=\"17\">Ingredientes:</strong><br data-start=\"17\" data-end=\"20\">Chocolate negro.</p>\r\n<p class=\"\" data-start=\"38\" data-end=\"113\"><strong data-start=\"38\" data-end=\"55\">Conservaci&oacute;n:</strong><br data-start=\"55\" data-end=\"58\">Guardar en un lugar fresco, seco y oscuro, hasta 1 a&ntilde;o.</p>', 23.00, 10950, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_venta`
--

CREATE TABLE `productos_venta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categoria_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos_venta`
--

INSERT INTO `productos_venta` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `id_categoria_venta`) VALUES
(1, 'Tarta Oreo', '<p>Tarta Oreo con capas de galletas y crema de queso, deliciosa y cremosa.</p>\r\n<p class=\"\" data-start=\"98\" data-end=\"172\"><strong data-start=\"98\" data-end=\"115\">Ingredientes:</strong><br data-start=\"115\" data-end=\"118\">Galletas Oreo, queso crema, nata, az&uacute;car, mantequilla.</p>\r\n<p class=\"\" data-start=\"174\" data-end=\"259\"><strong data-start=\"174\" data-end=\"191\">Conservaci&oacute;n:</strong><br data-start=\"191\" data-end=\"194\">Guardar en el refrigerador en recipiente herm&eacute;tico, hasta 3 d&iacute;as.</p>', 15.50, 1, 1),
(2, 'Palmera Chocolate', '<p class=\"\" data-start=\"0\" data-end=\"110\">Palmera de chocolate, crujiente por fuera y suave por dentro, cubierta con chocolate.</p>\r\n<p class=\"\" data-start=\"112\" data-end=\"160\"><strong data-start=\"112\" data-end=\"129\">Ingredientes:</strong><br data-start=\"129\" data-end=\"132\">Hojaldre, chocolate, az&uacute;car.</p>\r\n<p class=\"\" data-start=\"162\" data-end=\"230\"><strong data-start=\"162\" data-end=\"179\">Conservaci&oacute;n:</strong><br data-start=\"179\" data-end=\"182\">Guardar en un lugar fresco y seco, hasta 3 d&iacute;as.</p>', 2.30, 4, 2),
(3, 'Marinos Nata', '<p class=\"\" data-start=\"0\" data-end=\"94\">Marinos de nata, galletas crujientes rellenas de suave crema de nata.</p>\r\n<p class=\"\" data-start=\"96\" data-end=\"139\"><strong data-start=\"96\" data-end=\"113\">Ingredientes:</strong><br data-start=\"113\" data-end=\"116\">Galletas, nata, az&uacute;car.</p>\r\n<p class=\"\" data-start=\"141\" data-end=\"211\"><strong data-start=\"141\" data-end=\"158\">Conservaci&oacute;n:</strong><br data-start=\"158\" data-end=\"161\">Conservar en un lugar fresco y seco, hasta 5 d&iacute;as.</p>', 10.75, 2, 1),
(4, 'Napolitana Chocolate', '<p>&lt;p class=\"\" data-start=\"0\" data-end=\"104\"&gt;Napolitana de chocolate, hojaldre relleno de crema de cacao, crujiente y dulce.&lt;/p&gt; &lt;p class=\"\" data-start=\"106\" data-end=\"159\"&gt;&lt;strong data-start=\"106\" data-end=\"123\"&gt;Ingredientes:&lt;/strong&gt;&lt;br data-start=\"123\" data-end=\"126\"&gt;Hojaldre, crema de cacao, az&amp;uacute;car.&lt;/p&gt; &lt;p class=\"\" data-start=\"161\" data-end=\"229\"&gt;&lt;strong data-start=\"161\" data-end=\"178\"&gt;Conservaci&amp;oacute;n:&lt;/strong&gt;&lt;br data-start=\"178\" data-end=\"181\"&gt;Guardar en un lugar fresco y seco, hasta 3 d&amp;iacute;as.&lt;/p&gt;</p>', 1.60, 1, 2),
(5, 'Bollo Suizo', '<p>Bollo Suizo</p>', 1.50, 0, 2),
(6, 'Pastel de Naranja', '<p>Pastel de Naranja</p>', 10.00, 0, 1),
(7, 'Tarta Queso', '<p>Tarta Queso</p>', 11.00, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cif_nif_nie` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `telefono`, `email`, `direccion`, `latitud`, `longitud`) VALUES
(1, 'Puratos', 'Sergi', 'Puig', '23335678W', '692783672', 'puratos@gmail.com', 'Poligono Malpica', 41.65052880, -0.77789597),
(2, 'Supervia', 'Paco', 'Loras', '84529713W', '695483672', 'pacoloras@supervia.com', 'Cuarte', 41.59359190, -0.93888290),
(3, 'Rezusta', '', '', '55555555R', '678910806', 'rezusta@gmail.com', 'Plaza Aragon', 41.64842555, -0.88517893);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ref_productos_venta_productos_compra`
--

CREATE TABLE `ref_productos_venta_productos_compra` (
  `id` int(11) NOT NULL,
  `id_producto_venta` int(11) NOT NULL,
  `id_producto_compra` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ref_productos_venta_productos_compra`
--

INSERT INTO `ref_productos_venta_productos_compra` (`id`, `id_producto_venta`, `id_producto_compra`, `cantidad`) VALUES
(1, 1, 4, 500.00),
(2, 1, 5, 150.00),
(3, 1, 3, 50.00),
(4, 2, 1, 200.00),
(5, 2, 5, 20.00),
(6, 2, 6, 50.00),
(7, 3, 5, 100.00),
(8, 3, 2, 200.00),
(9, 3, 3, 50.00),
(10, 4, 6, 150.00),
(11, 4, 2, 50.00),
(12, 4, 1, 220.00),
(16, 5, 1, 100.00),
(17, 5, 2, 50.00),
(18, 5, 3, 25.00),
(19, 5, 5, 50.00),
(20, 6, 5, 200.00),
(21, 6, 4, 450.00),
(22, 7, 1, 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2025-03-18 17:33:03', '2025-03-18 17:33:03'),
(2, 'SuperAdmin', '2025-03-21 15:58:18', '2025-03-21 15:58:18'),
(3, 'Distribuidor', '2025-03-18 17:48:28', '2025-03-18 17:48:28'),
(4, 'Usuario', '2025-03-18 17:48:02', '2025-03-18 17:48:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `email`, `imagen`, `id_roles`, `created_at`, `updated_at`) VALUES
(1, 'Boral Adm', 'e10adc3949ba59abbe56e057f20f883e', 'boralpasteleria@gmail.com', 'public/uploads/Usuario_1.png', 1, '2025-03-18 04:31:28', '2025-04-19 07:11:28'),
(2, 'Javi21', 'e10adc3949ba59abbe56e057f20f883e', 'javalaramar@gmail.com', 'public/uploads/generica.png', 3, '2025-03-19 19:05:07', '2025-03-19 19:05:07'),
(3, 'Borao', 'e10adc3949ba59abbe56e057f20f883e', 'distribucionborao@gmail.com', 'public/uploads/generica.png', 3, '2025-04-05 15:32:16', '2025-04-05 02:24:26'),
(4, 'Alberto_Cimorra', 'e10adc3949ba59abbe56e057f20f883e', 'albertocimorra@gmail.com', 'public/uploads/generica.png', 3, '2025-03-19 08:48:03', '2025-04-05 08:22:08'),
(5, 'Luis', 'e10adc3949ba59abbe56e057f20f883e', 'luismenatobar@gmail.com', 'public/uploads/generica.png', 4, '2025-03-27 09:09:11', '2025-04-02 03:48:55'),
(6, 'Julia', 'e10adc3949ba59abbe56e057f20f883e', 'juliagonzalez@gmail.com', 'public/uploads/Usuario_6.png', 4, '2025-03-27 09:21:41', '2025-04-26 08:57:34'),
(7, 'Fernando', 'e10adc3949ba59abbe56e057f20f883e', 'palas@gmail.com', 'public/uploads/generica.png', 3, '2025-04-01 09:13:30', '2025-04-01 09:13:30'),
(8, 'Alfonso', 'b2a1d145cf561171d3f89147c165c2ec', 'alfonso.ascaso.lizarrondo@gmail.com', 'public/uploads/Usuario_8.jpg', 2, '2025-03-31 04:58:25', '2025-04-13 08:51:36'),
(9, 'Francisco', '202cb962ac59075b964b07152d234b70', 'pacalf3.0hw@gmail.com', 'public/uploads/generica.png', 4, '2025-04-02 05:38:40', '2025-04-02 05:38:40'),
(10, 'Clara', 'e10adc3949ba59abbe56e057f20f883e', 'claramolinosam@gmail.com', 'public/uploads/generica.png', 1, '2025-04-02 05:43:29', '2025-04-02 05:44:18'),
(11, 'Alex', '55a17acbbd0d2c98e76c1762ed398142', 'alexguerraaa@gmail.com', 'public/uploads/generica.png', 4, '2025-04-04 03:19:33', '2025-04-04 03:19:33'),
(12, 'Arturo', 'e10adc3949ba59abbe56e057f20f883e', 'arturoseidor@gmail.com', 'public/uploads/generica.png', 4, '2025-04-05 15:28:11', '2025-04-05 15:28:11'),
(13, 'Diego', 'd57c8f6089b0e90286d22dca4b2f5bbc', 'diego@gmail.com', 'public/uploads/generica.png', 4, '2025-04-08 16:01:40', '2025-04-08 16:01:40'),
(14, 'claramolinos', '02ffeffca582b777b74212ca2034f618', 'claramolinosa@gmail.com', 'public/uploads/generica.png', 4, '2025-04-10 17:56:35', '2025-04-10 17:56:35'),
(15, 'Prudencio', 'e10adc3949ba59abbe56e057f20f883e', 'prudenciosanz@gmail.com', 'public/uploads/generica.png', 3, '2025-04-14 21:08:01', '2025-05-01 04:45:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_compra`
--
ALTER TABLE `categorias_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_venta`
--
ALTER TABLE `categorias_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto_venta` (`id_producto_venta`);

--
-- Indices de la tabla `distribuidores`
--
ALTER TABLE `distribuidores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuarios`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea_pedidos`
--
ALTER TABLE `linea_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_metodo_pago` (`id_metodo_pago`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_compra` (`id_categoria_compra`),
  ADD KEY `id_proveedores` (`id_proveedores`);

--
-- Indices de la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_venta` (`id_categoria_venta`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ref_productos_venta_productos_compra`
--
ALTER TABLE `ref_productos_venta_productos_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto_venta` (`id_producto_venta`),
  ADD KEY `id_producto_compra` (`id_producto_compra`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_roles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_compra`
--
ALTER TABLE `categorias_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias_venta`
--
ALTER TABLE `categorias_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `distribuidores`
--
ALTER TABLE `distribuidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `linea_pedidos`
--
ALTER TABLE `linea_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ref_productos_venta_productos_compra`
--
ALTER TABLE `ref_productos_venta_productos_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_producto_venta`) REFERENCES `productos_venta` (`id`);

--
-- Filtros para la tabla `distribuidores`
--
ALTER TABLE `distribuidores`
  ADD CONSTRAINT `distribuidores_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodos_pago` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos_compra`
--
ALTER TABLE `productos_compra`
  ADD CONSTRAINT `productos_compra_ibfk_1` FOREIGN KEY (`id_categoria_compra`) REFERENCES `categorias_compra` (`id`),
  ADD CONSTRAINT `productos_compra_ibfk_2` FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  ADD CONSTRAINT `productos_venta_ibfk_1` FOREIGN KEY (`id_categoria_venta`) REFERENCES `categorias_venta` (`id`);

--
-- Filtros para la tabla `ref_productos_venta_productos_compra`
--
ALTER TABLE `ref_productos_venta_productos_compra`
  ADD CONSTRAINT `ref_productos_venta_productos_compra_ibfk_1` FOREIGN KEY (`id_producto_venta`) REFERENCES `productos_venta` (`id`),
  ADD CONSTRAINT `ref_productos_venta_productos_compra_ibfk_2` FOREIGN KEY (`id_producto_compra`) REFERENCES `productos_compra` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
