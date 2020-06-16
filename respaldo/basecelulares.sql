-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-09-2018 a las 18:24:24
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basecelulares`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `nive_usua` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `pass`, `nombre`, `apellido`, `correo`, `nive_usua`) VALUES
(3, 'mgalvan', 'admin', 'Miguel ', 'Galvan', 'miguelgalvan@cpmama.local', 1),
(4, ' javi', '654321', 'Javier', 'Muñoz', 'javiermuñoz@cpmama.local', 1),
(5, 'angelicaverdu', '123456', 'Angelica', 'Verdu', 'angelicaverdu@cpmama.local', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `id_productos` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad_c` int(5) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`) VALUES
(1, 'Alimentación'),
(2, 'Imprenta y Papelería'),
(3, 'Uniformes'),
(4, 'Placas y GEL-ECOS'),
(5, 'Farmacia'),
(6, 'Limpieza'),
(7, 'Material Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_movimientos` int(11) NOT NULL,
  `cantidadm` int(30) NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `tipo_movimiento` varchar(50) NOT NULL,
  `admin` varchar(30) NOT NULL,
  `id_producto_m` int(50) NOT NULL,
  `motivo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimientos`, `cantidadm`, `fecha_movimiento`, `tipo_movimiento`, `admin`, `id_producto_m`, `motivo`) VALUES
(1, 2, '2018-06-14 15:50:13', 'ENTRADA', 'Javier', 10, 'reparacion'),
(2, 0, '2018-06-14 15:51:50', 'SALIDA', 'Javier', 1, 'entrega'),
(3, 0, '2018-06-14 15:58:22', 'ENTRADA', 'Angelica', 10, 'reparacion'),
(4, 0, '2018-06-14 15:59:33', 'SALIDA', 'Angelica', 2, 'entrega'),
(5, 15, '2018-06-19 13:27:59', 'ENTRADA', 'Miguel ', 1, 'compra'),
(6, 100, '2018-06-19 14:42:17', 'ENTRADA', 'Miguel ', 2, 'compra'),
(7, 100, '2018-06-19 14:43:12', 'ENTRADA', 'Miguel ', 9, 'reparacion'),
(8, 54, '2018-06-20 13:32:59', 'ENTRADA', 'Miguel ', 3, 'compra'),
(9, 85, '2018-06-20 13:58:21', 'ENTRADA', 'Miguel ', 4, 'compra'),
(10, 50, '2018-06-21 14:08:53', 'SALIDA', 'Miguel ', 2, 'venta'),
(11, 4, '2018-06-21 14:09:01', 'SALIDA', 'Miguel ', 3, 'venta'),
(12, 52000, '2018-06-21 14:37:36', 'ENTRADA', 'Miguel ', 4, 'compra'),
(13, 850, '2018-07-10 18:45:42', 'ENTRADA', 'Miguel ', 5, 'compra'),
(14, 15, '2018-08-08 15:16:37', 'SALIDA', ' JAVIER', 2, 'venta'),
(15, 2, '2018-08-27 14:23:28', 'SALIDAD', ' JAVIER', 2, 'venta'),
(16, 25, '2018-08-27 14:28:04', 'ENTRADA', ' JAVIER', 4, 'compra'),
(17, 5, '2018-09-03 14:51:20', 'ENTRADA', 'Miguel ', 15, 'compra'),
(18, 15, '2018-09-14 15:15:52', 'ENTRADA', 'Miguel ', 16, 'compra'),
(19, 150, '2018-09-14 15:15:59', 'ENTRADA', 'Miguel ', 17, 'compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_carrito`
--

CREATE TABLE IF NOT EXISTS `pedidos_carrito` (
  `id_pedido_c` int(11) NOT NULL,
  `estado_pedido` varchar(20) NOT NULL,
  `fecha_pedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_productos` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio` float NOT NULL,
  `id_categoria` int(3) NOT NULL,
  `id_proveedor` int(3) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `modelo`, `descripcion`, `marca`, `cantidad`, `precio`, `id_categoria`, `id_proveedor`, `id_user`) VALUES
(12, 'BOMBILLA LED SLIM REGULABLE', 'BOMBILLA LED', 'EFECTOLED', 33, 5.56, 7, 8, 0),
(14, 'GUANTES DE EXPLORACION MJ12', 'GUANTES EXPLO', 'NITRILO', 25, 12, 5, 9, 0),
(15, 'TONER IMPRESORA HP LASERJET 1102', 'TONER IMPRE', 'IMPRENTAS', 5, 5, 2, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedores` int(11) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fechai` varchar(40) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `telefono` int(20) NOT NULL,
  `poblacion` varchar(50) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `personal_contacto` varchar(50) NOT NULL,
  `movil` int(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedores`, `cif`, `nombre`, `correo`, `fechai`, `direccion`, `telefono`, `poblacion`, `provincia`, `cp`, `personal_contacto`, `movil`) VALUES
(8, 'A251549684', 'CENTRO DE PATOLOGIA DE LA MAMA SA', 'CENTRE@CENTRO.ES', '2018-05-24', 'JOSE ABASCAL, 40 3 IZQ', 914474621, 'MADRID', 'MADRID', '28830', 'ADOLFO DOMINGUEZ', 69878548),
(9, 'A123456798', 'MYBREAST', 'MYBREASTSL@EMAIL.COM', '', 'CALLE JOSE ABASCAL ', 912345678, 'VALENCIA', 'MADRID', '28857', 'JAVIER MUNOZ', 678909878),
(10, 'A123456780', 'PMC', 'INFO@PMC.ES', '', 'C/ SIERRA ELVIRA, Nº 11', 916066606, 'FUENLABRADA', 'MADRID', '28474', 'WEB5', 916066606);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller`
--

CREATE TABLE IF NOT EXISTS `taller` (
  `modelo` varchar(50) NOT NULL,
  `descripcion_p` varchar(300) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `n_serie` varchar(50) NOT NULL,
  `falla` varchar(300) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `id_taller` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `taller`
--

INSERT INTO `taller` (`modelo`, `descripcion_p`, `fecha_entrada`, `cliente`, `marca`, `n_serie`, `falla`, `cantidad`, `id_taller`) VALUES
('BOMBILLA LED 2700K', 'BOMBILLA LED', '2018-06-19 14:43:12', '9', 'EFECTOLED', '25465896', 'No encienden', 100, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_productos`,`id_usuario`,`id_pedido`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD UNIQUE KEY `id_movimientos` (`id_movimientos`);

--
-- Indices de la tabla `pedidos_carrito`
--
ALTER TABLE `pedidos_carrito`
  ADD PRIMARY KEY (`id_pedido_c`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `id_categoria` (`id_categoria`) USING BTREE,
  ADD KEY `id_proveedor` (`id_proveedor`) USING BTREE,
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `movil` (`movil`),
  ADD UNIQUE KEY `cif` (`cif`) USING BTREE,
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `cp` (`cp`) USING BTREE;

--
-- Indices de la tabla `taller`
--
ALTER TABLE `taller`
  ADD PRIMARY KEY (`id_taller`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimientos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `taller`
--
ALTER TABLE `taller`
  MODIFY `id_taller` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `administrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos_carrito` (`id_pedido_c`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
