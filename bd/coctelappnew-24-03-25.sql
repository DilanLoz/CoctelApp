-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2025 a las 01:36:16
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
-- Base de datos: `coctelappnew`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarEstadoEntregado` ()   BEGIN
    UPDATE pedido
    SET estado = 'Entregado'
    WHERE estado_pago = 'Pagado' AND estado <> 'Entregado';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bar`
--

CREATE TABLE `bar` (
  `idbar` bigint(10) NOT NULL COMMENT 'id de bar',
  `nombar` varchar(100) DEFAULT NULL COMMENT 'nombre del bar',
  `nompropi` varchar(50) NOT NULL COMMENT 'nombre del propietario',
  `nit` bigint(10) NOT NULL COMMENT 'numero de nit',
  `emabar` varchar(100) DEFAULT NULL COMMENT 'email del bar',
  `telbar` int(12) DEFAULT NULL COMMENT 'teléfono del bar',
  `pssbar` varchar(100) NOT NULL COMMENT 'contraseña del bar',
  `dircbar` varchar(100) NOT NULL COMMENT 'dirección del bar',
  `horbar` varchar(50) DEFAULT NULL,
  `fotbar` varchar(255) DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL COMMENT 'código de ubicacion',
  `idper` bigint(10) NOT NULL COMMENT 'id del perfil',
  `idval` bigint(10) NOT NULL COMMENT 'id del valor',
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bar`
--

INSERT INTO `bar` (`idbar`, `nombar`, `nompropi`, `nit`, `emabar`, `telbar`, `pssbar`, `dircbar`, `horbar`, `fotbar`, `codubi`, `idper`, `idval`, `estado`) VALUES
(2002, 'Cabañas Norte', 'Juan Martinez', 8029812, 'caba@gmail.com', 300940912, 'e0851d399bb2954f554d93328662c70f79273f5a', 'Calle 20 #40-60 Norte', '11:00 - 17:00', NULL, 1, 30, 104, 1),
(2003, 'Bazar', 'Jose Perez', 8039923, 'baz@gmail.com', 300828821, 'a7c9f5b4f15002ac1275c418d5c77f316ae749db', 'Transversal 7 #30-50 ', '11:00 - 17:00', NULL, 2, 30, 102, 1),
(2004, 'Llanos', 'Daniel', 8749283, 'llano@gmail.com', 98311212, '661bb5ab253795539bec27058477f29f1cd506f5', 'Calle 20 #90', '11:00 - 17:00', NULL, 5, 30, 102, 1),
(2005, 'Bar Rocas', 'Juanjo', 874923, 'roca@gmail.com', 8127371, '1bbf9d535f9136ee5d4465bf0885519c6e69d181', 'Transversal 9 #10-30', '14:00 22:00', NULL, 3, 30, 102, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idcarrito` bigint(20) NOT NULL,
  `idusu` bigint(10) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `estado` enum('activo','convertido') DEFAULT 'activo',
  `direccion` varchar(100) DEFAULT NULL,
  `mensaje` varchar(100) DEFAULT NULL,
  `telefono` bigint(10) DEFAULT NULL,
  `metodo_pago` enum('Efectivo','Transferencia') DEFAULT 'Efectivo',
  `servicio` enum('No','Si') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idcarrito`, `idusu`, `fecha_creacion`, `estado`, `direccion`, `mensaje`, `telefono`, `metodo_pago`, `servicio`) VALUES
(10, 1, '2025-02-08', 'convertido', 'calle 20', 'holaa', 3123456789, 'Efectivo', 'No'),
(12, 1, '2025-02-25', 'convertido', NULL, NULL, NULL, 'Efectivo', 'No'),
(13, 1, '2025-02-25', 'convertido', NULL, NULL, NULL, 'Efectivo', 'No'),
(14, 1, '2025-02-26', NULL, 'calle 20', 'adas', 32345, 'Efectivo', 'No'),
(15, 1, NULL, NULL, NULL, NULL, NULL, 'Efectivo', 'No'),
(16, 1, '2025-02-26', NULL, NULL, NULL, NULL, 'Efectivo', 'No'),
(17, 1, '2025-02-27', NULL, NULL, NULL, NULL, 'Efectivo', 'No'),
(18, 1, '2025-02-27', NULL, NULL, NULL, NULL, 'Efectivo', 'No'),
(19, 1, '2025-02-27', NULL, NULL, NULL, NULL, 'Efectivo', 'No'),
(20, 4, '2025-03-02', 'convertido', NULL, NULL, NULL, 'Efectivo', 'No'),
(21, 1, '2025-03-02', 'convertido', NULL, NULL, NULL, 'Efectivo', 'No'),
(22, 5, '2025-03-02', 'convertido', NULL, NULL, NULL, 'Efectivo', 'No'),
(23, 1, '2025-03-02', 'convertido', NULL, NULL, NULL, 'Efectivo', 'No'),
(24, 1, '2025-03-08', 'convertido', 'calle 20', 'holaa', 23123, 'Efectivo', 'No'),
(27, 1, '2025-03-11', 'convertido', 'calle 20 #602', 'Dejar en porteria', 3123456789, 'Efectivo', 'No'),
(28, 1, '2025-03-11', 'convertido', 'calle 20 #90-20', 'Dejar en porteria', 3123456789, 'Efectivo', 'No'),
(29, 1, '2025-03-11', 'convertido', 'calle 20 #90-20', 'Dejar en porteria', 3123456789, 'Transferencia', 'No'),
(31, 1, '2025-03-13', 'convertido', 'calle 20 #90-20', 'Dejar en portería', 3123456789, 'Efectivo', 'No'),
(34, 1, '2025-03-15', 'convertido', 'calle 20 #90-20', 'Dejar en portería', 3123456789, 'Efectivo', 'Si'),
(35, 1, '2025-03-23', 'convertido', 'calle 20', 'Dejar en porteria', 3124324243, 'Efectivo', 'No'),
(36, 1, '2025-03-23', 'convertido', 'calle 20 #602', 'Dejar en porteria', 312312, 'Efectivo', 'No'),
(37, 1, '2025-03-23', 'convertido', 'calle 20', 'Dejar en porteria', 321231, 'Efectivo', 'No'),
(38, 1, '2025-03-23', 'convertido', 'calle 20 #90-20', 'Dejar en porteria', 312321, 'Efectivo', 'No'),
(39, 1, '2025-03-23', 'convertido', 'calle 20 #602', 'Dejar en portería', 213123, 'Efectivo', 'No'),
(40, 1, '2025-03-23', 'convertido', 'calle 20 #90-20', 'Dejar en portería', 3221312, 'Efectivo', 'No'),
(41, 1, '2025-03-23', 'convertido', 'calle 20 #90-20', 'Dejar en portería', 3213123, 'Efectivo', 'No');

--
-- Disparadores `carrito`
--
DELIMITER $$
CREATE TRIGGER `trg_crear_pedido_desde_carrito` AFTER UPDATE ON `carrito` FOR EACH ROW BEGIN
    IF NEW.estado = 'convertido' AND OLD.estado != 'convertido' THEN
        INSERT INTO pedido (
            idcarrito, cantidad, fecha_pedido, estado, total, 
            idusu, telefono, direccion, mensaje, metodo_pago, 
            servicio, estado_pedido
        )
        SELECT 
            NEW.idcarrito, 
            SUM(dc.cantidad), 
            NOW(), 
            'En preparación', 
            SUM(dc.cantidad * dc.precar), 
            NEW.idusu, 
            NEW.telefono, 
            NEW.direccion, 
            NEW.mensaje,  
            NEW.metodo_pago, 
            NEW.servicio,  -- ???? Se agrega el servicio 
            1  -- Estado pedido por defecto
        FROM detcarrito dc
        WHERE dc.idcarrito = NEW.idcarrito;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idcof` int(11) NOT NULL,
  `logcof` varchar(255) NOT NULL,
  `titcof` varchar(100) NOT NULL,
  `descof` varchar(255) NOT NULL,
  `foocof` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detcarrito`
--

CREATE TABLE `detcarrito` (
  `iddetcarrito` int(11) NOT NULL,
  `idcarrito` bigint(20) NOT NULL,
  `idprod` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precar` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detcarrito`
--

INSERT INTO `detcarrito` (`iddetcarrito`, `idcarrito`, `idprod`, `cantidad`, `precar`) VALUES
(26, 10, 21, 2, 24600),
(27, 10, 23, 1, 229900),
(37, 14, 21, 1, 24600),
(38, 14, 22, 2, 66900),
(39, 14, 23, 3, 229900),
(61, 16, 21, 1, 24600),
(62, 16, 22, 2, 66900),
(63, 16, 23, 3, 229900),
(68, 15, 22, 2, 66900),
(69, 15, 23, 3, 229900),
(79, 15, 21, 1, 24600),
(80, 15, 22, 2, 66900),
(81, 15, 23, 3, 229900),
(82, 17, 21, 1, 24600),
(83, 17, 22, 2, 66900),
(84, 17, 23, 3, 229900),
(85, 17, 21, 1, 24600),
(86, 17, 22, 2, 66900),
(87, 17, 23, 3, 229900),
(88, 18, 21, 1, 24600),
(89, 18, 22, 2, 66900),
(90, 18, 23, 3, 229900),
(95, 19, 22, 2, 66900),
(96, 19, 23, 3, 229900),
(97, 19, 21, 1, 24600),
(98, 19, 22, 2, 66900),
(99, 19, 23, 3, 229900),
(100, 20, 21, 1, 24600),
(101, 20, 22, 2, 66900),
(102, 20, 23, 3, 229900),
(103, 21, 21, 1, 24600),
(104, 21, 22, 2, 66900),
(105, 21, 23, 3, 229900),
(106, 22, 21, 1, 24600),
(107, 22, 22, 2, 66900),
(108, 22, 23, 3, 229900),
(109, 23, 21, 1, 24600),
(110, 23, 22, 2, 66900),
(111, 23, 23, 3, 229900),
(113, 24, 32, 2, 43900),
(114, 24, 24, 3, 147000),
(115, 24, 30, 2, 45900),
(121, 24, 35, 3, 28000),
(123, 27, 27, 2, 130200),
(124, 27, 25, 1, 72000),
(125, 28, 21, 2, 24600),
(126, 28, 35, 1, 28000),
(127, 28, 30, 2, 45900),
(128, 29, 23, 3, 229900),
(132, 31, 35, 2, 28000),
(134, 31, 24, 1, 147000),
(141, 34, 24, 3, 147000),
(142, 34, 23, 4, 229900),
(143, 34, 21, 1, 24600),
(151, 41, 24, 1, 147000);

--
-- Disparadores `detcarrito`
--
DELIMITER $$
CREATE TRIGGER `before_insert_detcarrito` BEFORE INSERT ON `detcarrito` FOR EACH ROW BEGIN
    DECLARE v_existe INT;
    DECLARE v_estado VARCHAR(10);

    SELECT COUNT(*), estado INTO v_existe, v_estado
    FROM carrito
    WHERE idcarrito = NEW.idcarrito;

    IF v_existe = 0 OR v_estado != 'activo' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El carrito especificado no existe o ya fue convertido a pedido.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detfact`
--

CREATE TABLE `detfact` (
  `iddetfact` bigint(20) NOT NULL COMMENT 'id de detalle de factura',
  `idfact` bigint(20) NOT NULL COMMENT 'id de factura',
  `idprod` bigint(20) DEFAULT NULL COMMENT 'id del producto',
  `cantidad` int(8) DEFAULT NULL COMMENT 'cantidad de productos',
  `precio_unitario` bigint(20) DEFAULT NULL COMMENT 'precio por producto',
  `total` bigint(20) DEFAULT NULL COMMENT 'subtotal del pedido',
  `idusu` bigint(10) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detfact`
--

INSERT INTO `detfact` (`iddetfact`, `idfact`, `idprod`, `cantidad`, `precio_unitario`, `total`, `idusu`, `idbar`) VALUES
(1001010, 1001, 21, 2, 200, 200, 2001, NULL),
(1001020, 1002, 30, 5, 300000, 300000, NULL, NULL),
(1001021, 1004, 21, 1, 24600, 24600, 1, NULL),
(1001098, 1083, 21, 1, 24600, 24600, NULL, 2002),
(1001099, 1083, 22, 2, 66900, 133800, NULL, 2002),
(1001100, 1083, 23, 3, 229900, 689700, NULL, 2002),
(1001101, 1084, 21, 1, 24600, 24600, NULL, 2002),
(1001102, 1084, 22, 2, 66900, 133800, NULL, 2002),
(1001103, 1084, 23, 3, 229900, 689700, NULL, 2002),
(1001104, 1085, 21, 1, 24600, 24600, NULL, 2002),
(1001105, 1085, 22, 2, 66900, 133800, NULL, 2002),
(1001106, 1085, 23, 3, 229900, 689700, NULL, 2002),
(1001107, 1086, 21, 1, 24600, 24600, NULL, 2002),
(1001108, 1086, 22, 2, 66900, 133800, NULL, 2002),
(1001109, 1086, 23, 3, 229900, 689700, NULL, 2002),
(1001110, 1087, 35, 2, 28000, 56000, NULL, 2002),
(1001111, 1087, 24, 1, 147000, 147000, NULL, 2002),
(1001112, 1088, 24, 3, 147000, 441000, NULL, 2002),
(1001113, 1088, 23, 4, 229900, 919600, NULL, 2002),
(1001114, 1088, 21, 1, 24600, 24600, NULL, 2002),
(1001115, 1089, 23, 3, 229900, 689700, NULL, 2002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detpedido`
--

CREATE TABLE `detpedido` (
  `iddetpedido` bigint(20) NOT NULL,
  `idpedido` bigint(20) NOT NULL,
  `idprod` bigint(20) NOT NULL,
  `cantidad` int(8) DEFAULT NULL,
  `precio` bigint(10) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detpedido`
--

INSERT INTO `detpedido` (`iddetpedido`, `idpedido`, `idprod`, `cantidad`, `precio`, `total`, `idusu`, `idbar`) VALUES
(109301, 100110, 36, 20, NULL, 200000, 2003, NULL),
(109307, 100125, 23, 2, NULL, 459800, 1, NULL),
(109308, 100125, 24, 1, NULL, 147000, 1, NULL),
(109309, 100125, 25, 3, NULL, 216000, 1, NULL),
(109318, 100136, 21, 1, 24600, 24600, 1, 2002),
(109324, 100142, 22, 2, 66900, 133800, 1, 2002),
(109325, 100142, 23, 3, 229900, 689700, 1, 2002),
(109326, 100142, 21, 1, 24600, 24600, 1, 2002),
(109328, 100144, 21, 1, 24600, 24600, 1, 2002),
(109329, 100144, 22, 2, 66900, 133800, 1, 2002),
(109330, 100144, 23, 3, 229900, 689700, 1, 2002),
(109331, 100144, 21, 1, 24600, 24600, 1, 2002),
(109335, 100145, 21, 1, 24600, 24600, 1, 2002),
(109338, 100148, 22, 2, 66900, 133800, 1, 2002),
(109339, 100148, 23, 3, 229900, 689700, 1, 2002),
(109340, 100148, 21, 1, 24600, 24600, 1, 2002),
(109341, 100149, 21, 1, 24600, 24600, 4, 2002),
(109342, 100149, 22, 2, 66900, 133800, 4, 2002),
(109343, 100149, 23, 3, 229900, 689700, 4, 2002),
(109344, 100150, 21, 1, 24600, 24600, 1, 2002),
(109345, 100150, 22, 2, 66900, 133800, 1, 2002),
(109346, 100150, 23, 3, 229900, 689700, 1, 2002),
(109347, 100151, 21, 1, 24600, 24600, 5, 2002),
(109348, 100151, 22, 2, 66900, 133800, 5, 2002),
(109349, 100151, 23, 3, 229900, 689700, 5, 2002),
(109350, 100152, 21, 1, 24600, 24600, 1, 2002),
(109351, 100152, 22, 2, 66900, 133800, 1, 2002),
(109352, 100152, 23, 3, 229900, 689700, 1, 2002),
(109353, 100153, 21, 2, 24600, 49200, 1, 2002),
(109354, 100153, 23, 1, 229900, 229900, 1, 2002),
(109356, 100154, 21, 1, 24600, 24600, 1, 2002),
(109357, 100154, 22, 2, 66900, 133800, 1, 2002),
(109358, 100154, 23, 3, 229900, 689700, 1, 2002),
(109359, 100155, 32, 2, 43900, 87800, 1, 2002),
(109360, 100155, 24, 3, 147000, 441000, 1, 2002),
(109361, 100155, 30, 2, 45900, 91800, 1, 2002),
(109362, 100155, 35, 3, 28000, 84000, 1, 2002),
(109366, 100156, 27, 2, 130200, 260400, 1, 2003),
(109367, 100156, 25, 1, 72000, 72000, 1, 2003),
(109369, 100157, 21, 2, 24600, 49200, 1, 2002),
(109370, 100157, 35, 1, 28000, 28000, 1, 2002),
(109371, 100157, 30, 2, 45900, 91800, 1, 2002),
(109372, 100158, 23, 3, 229900, 689700, 1, 2002),
(109373, 100159, 35, 2, 28000, 56000, 1, 2002),
(109374, 100159, 24, 1, 147000, 147000, 1, 2002),
(109375, 100160, 24, 3, 147000, 441000, 1, 2002),
(109376, 100160, 23, 4, 229900, 919600, 1, 2002),
(109377, 100160, 21, 1, 24600, 24600, 1, 2002),
(109378, 100161, 26, 2, 390000, 780000, 1, 2003),
(109379, 100162, 24, 1, 147000, 147000, 1, 2002),
(109380, 100163, 36, 1, 18000, 18000, 1, 2003),
(109381, 100164, 21, 1, 24600, 24600, 1, 2002),
(109382, 100165, 32, 1, 43900, 43900, 1, 2002),
(109383, 100166, 23, 1, 229900, 229900, 1, 2002),
(109384, 100167, 24, 1, 147000, 147000, 1, 2002);

--
-- Disparadores `detpedido`
--
DELIMITER $$
CREATE TRIGGER `trg_actualizar_totales_pedido` AFTER INSERT ON `detpedido` FOR EACH ROW BEGIN
    INSERT INTO temp_actualizar_pedido (idpedido)
    VALUES (NEW.idpedido)
    ON DUPLICATE KEY UPDATE idpedido = idpedido;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddom` int(4) NOT NULL COMMENT 'id de dominio',
  `nomdom` varchar(50) DEFAULT NULL COMMENT 'nombre del dominio\r\nnombre del dominio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`iddom`, `nomdom`) VALUES
(10, 'documentos'),
(20, 'categorias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idemp` bigint(10) NOT NULL COMMENT 'id del empleado',
  `nomemp` varchar(100) DEFAULT NULL COMMENT 'nombre del empleado',
  `emaemp` varchar(255) DEFAULT NULL COMMENT 'email del empleado',
  `celemp` int(10) DEFAULT NULL COMMENT 'celular del empleado',
  `fecnaemp` date DEFAULT NULL COMMENT 'fecha de nacimiento',
  `numdocu` bigint(10) NOT NULL COMMENT 'numero de documento del empleado',
  `fotiden` varchar(255) DEFAULT NULL COMMENT 'foto de identificación ',
  `pssemp` varchar(100) NOT NULL COMMENT 'contraseña del empleado',
  `idbar` bigint(10) DEFAULT NULL COMMENT 'id del bar',
  `codubi` int(6) DEFAULT NULL COMMENT 'codigo de ubicacion ',
  `idper` bigint(10) NOT NULL COMMENT 'id del perfil',
  `idval` bigint(10) NOT NULL COMMENT 'id de valor',
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idemp`, `nomemp`, `emaemp`, `celemp`, `fecnaemp`, `numdocu`, `fotiden`, `pssemp`, `idbar`, `codubi`, `idper`, `idval`, `estado`) VALUES
(2000, 'Martin Casa', 'martin@gmail.com', 3001782, '2000-11-20', 109020, 'fot_20250324145250.jpeg', '78adbe311449919b44220c57d7089ee5b8f306ad', 2002, 1, 20, 101, 1),
(2001, 'Jose', 'jose@gmail.com', 3001782, '2000-11-09', 102891, 'fot_20250322144602.jpeg', '$2y$10$ZoL4N1BdBgPdc6VRmuh5k./ulkTgKvxxuQ7Y0.e8YM28ZtC5BNkvu', 2003, 2, 20, 102, 1),
(4010, 'Mario', 'mario@gmail.com', 2147483647, '2013-02-27', 12434234, 'fot_20250324145237.jpeg', '5ca7bbaecd01d23728110f709a137d4dbc609531', 2002, 1, 20, 101, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfact` bigint(20) NOT NULL COMMENT 'id de factura',
  `idpedido` bigint(20) NOT NULL,
  `fecha` datetime DEFAULT NULL COMMENT 'fecha de la factura',
  `cantidad` bigint(10) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL COMMENT 'total de compra',
  `idusu` bigint(10) DEFAULT NULL COMMENT 'id de usuario ',
  `direccion` varchar(100) DEFAULT NULL,
  `estado_pago` varchar(100) DEFAULT NULL,
  `metodo_pago` varchar(100) DEFAULT NULL,
  `servicio` enum('No','Si') DEFAULT 'No',
  `idemp` bigint(10) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `estado` enum('activa','anulada') DEFAULT 'activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfact`, `idpedido`, `fecha`, `cantidad`, `total`, `idusu`, `direccion`, `estado_pago`, `metodo_pago`, `servicio`, `idemp`, `idbar`, `estado`) VALUES
(1001, 100110, '2024-11-30 00:00:00', NULL, 200.00, 2001, NULL, NULL, NULL, 'No', NULL, NULL, 'activa'),
(1002, 100125, '2025-02-28 00:00:00', NULL, 300000.00, 2002, NULL, NULL, NULL, 'No', NULL, NULL, 'anulada'),
(1004, 100136, '2025-02-27 00:00:00', NULL, 24600.00, 1, NULL, NULL, NULL, 'No', NULL, 2002, 'activa'),
(1039, 100142, '2025-02-27 00:00:00', NULL, 848100.00, 1, NULL, NULL, NULL, 'No', NULL, NULL, 'activa'),
(1070, 100148, '2025-03-01 00:00:00', 6, 848100.00, 1, NULL, 'Pagado', 'Efectivo', 'No', 2001, 2002, 'activa'),
(1083, 100149, '2025-03-02 00:00:00', 6, 848100.00, 4, '', 'Pagado', 'Efectivo', 'No', 2001, NULL, 'activa'),
(1084, 100150, '2025-03-02 18:02:52', 6, 848100.00, 1, '', 'Pagado', 'Efectivo', 'No', 2001, 2002, 'activa'),
(1085, 100151, '2025-03-02 18:06:22', 6, 848100.00, 5, '', 'Pagado', 'Efectivo', 'No', 2001, 2002, 'activa'),
(1086, 100152, '2025-03-08 16:02:41', 6, 848100.00, 1, 'Calle 308 ', 'Pagado', 'Efectivo', 'No', 2001, 2002, 'activa'),
(1087, 100159, '2025-03-13 10:45:15', 3, 203000.00, 1, 'calle 20 #90-20', 'Pagado', 'Efectivo', 'No', 2001, 2002, 'activa'),
(1088, 100160, '2025-03-18 18:59:51', 8, 1385200.00, 1, 'calle 20 #90-20', 'Pagado', 'Efectivo', 'Si', 2001, 2002, 'activa'),
(1089, 100158, '2025-03-18 19:01:12', 3, 689700.00, 1, 'calle 20 #90-20', 'Pagado', 'Transferencia', 'No', 2001, 2002, 'activa');

--
-- Disparadores `factura`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_detfact` AFTER INSERT ON `factura` FOR EACH ROW BEGIN
    IF (SELECT COUNT(*) FROM detfact WHERE idfact = NEW.idfact) = 0 THEN
        INSERT INTO detfact (idfact, idprod, cantidad, precio_unitario, total, idbar)
        SELECT 
            NEW.idfact, 
            dp.idprod, 
            dp.cantidad, 
            dp.precio, 
            dp.total, 
            dp.idbar
        FROM detpedido dp
        WHERE dp.idpedido = NEW.idpedido;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_pendientes`
--

CREATE TABLE `facturas_pendientes` (
  `idpedido` int(11) NOT NULL,
  `idfactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `idpag` int(5) NOT NULL COMMENT 'id de pagina',
  `nompag` varchar(255) DEFAULT NULL COMMENT 'nombre de la pagina',
  `rutpag` varchar(255) DEFAULT NULL COMMENT 'ruta de la pagina',
  `mospag` tinyint(1) DEFAULT NULL COMMENT 'mostrar la pagina',
  `ordpag` int(5) DEFAULT NULL COMMENT 'orden de la pagina',
  `titupag` varchar(50) DEFAULT NULL,
  `icopag` varchar(50) DEFAULT NULL COMMENT 'icono de la pagina',
  `despag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`idpag`, `nompag`, `rutpag`, `mospag`, `ordpag`, `titupag`, `icopag`, `despag`) VALUES
(1002, 'Bares', 'views/vusbares.php', 1, 2, 'Bares', '', 'Vista de bares'),
(1004, 'Cócteles', 'views/vuscoct.php', 1, 3, 'Cócteles', NULL, 'Vista de bares'),
(1005, 'Vinos', 'views/vusvino.php', 1, 4, 'Vinos', NULL, 'Vista Vinos'),
(1006, 'Licores', 'views/vuslicor.php', 1, 5, 'Licores', NULL, 'Vista Licores'),
(1007, '', 'views/vuscarcom.php', 1, 6, 'Carrito', 'fa-solid fa-cart-shopping', 'Carrito de compras'),
(1008, '', 'views/vushipe.php', 1, 7, 'Historial Usuario', 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(1009, NULL, 'views/vpusu.php', 1, 8, 'Perfil Usuario', 'fa-solid fa-user', 'Perfil usuario'),
(1011, NULL, 'views/vusdatcom.php', 2, NULL, 'Pagos Usuario', NULL, 'Formas de pago y compra final'),
(1012, NULL, 'views/vusubicom.php', 2, NULL, 'Ubicacion del pedido Usuario', NULL, 'Ubicacion del pedido y compra final'),
(1013, NULL, 'views/vusconfcom.php', 2, NULL, 'Confirmacion de compras Usuario', NULL, 'Mensaje de confirmación de compra '),
(1014, NULL, 'views/vuscocgrand.php', 2, NULL, 'Detalle de producto', NULL, 'Detalle de producto'),
(1015, 'Inicio', 'views/vusini.php', 1, 1, 'Inicio de todos los productos', NULL, ''),
(2001, 'Pedidos', 'views/vempedproc.php', 1, 8, 'Pedidos Empleado', NULL, 'Pedidos en proceso'),
(2002, 'Ganancias', 'views/vemgan.php', 1, 10, 'Ganancias Empleado', NULL, 'Ganancias '),
(2003, '', 'views/vemhipe.php', 1, 11, 'Historial Empleado', 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(2004, '', 'views/vpemp.php', 1, 12, 'Perfil Empleado', 'fa-solid fa-user', 'Perfil empleado'),
(2005, 'Pedidos Aceptados', 'views/vempedacep.php', 1, 9, 'Pedidos Aceptados', NULL, 'Pedidos aceptados por el empleado para realizar el domicilio'),
(2006, 'Vista detpedido', 'views/vempedgrand.php', 2, NULL, NULL, NULL, ''),
(2007, 'Reporte de ganancias', 'views/varplaem.php', 2, NULL, NULL, NULL, ''),
(2008, 'Detalles de pedidos aceptados', 'views/vempedacepgrand.php', 2, NULL, NULL, NULL, ''),
(3001, 'Pedidos', 'views/vbarped.php', 1, 13, 'Pedidos Bar', NULL, 'Pedidos en proceso'),
(3002, 'Ganancias', 'views/vbargan.php', 1, 14, 'Ganancias Bar', '', 'Ganancias por pedidos'),
(3003, 'Crear Productos', 'views/vbarxprod.php', 1, 15, 'Crear Productos Bar', NULL, 'CRUD Producto'),
(3004, 'Crear Empleados', 'views/vbarxem.php', 1, 16, 'Crear Empleados Bar', NULL, 'CRUD Empleado'),
(3005, '', 'views/vbarhipe.php', 1, 17, 'Historial Bar', 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(3006, '', 'views/vpbar.php', 1, 18, 'Perfil Bar', 'fa-solid fa-user', 'Perfil bar'),
(3007, 'Reporte del bar', 'views/varplabar.php', 2, NULL, 'Reporte de ganancias del bar', NULL, ''),
(3030, 'Soporte Técnico de Bares', 'views/vsoporte.php', 2, NULL, NULL, NULL, ''),
(4010, '', 'admin/views/vdom.php', 1, 19, 'ADMIN Dominio ', 'fa-brands fa-dochub', 'Dominio y valor '),
(4011, NULL, 'admin/views/vval.php', 1, NULL, 'Valor', 'fa-solid fa-gears', 'Valor'),
(4020, '', 'admin/views/vpag.php', 1, 2, 'ADMIN Paginas', 'fa-regular fa-file-powerpoint', 'Pagina'),
(4021, '', 'admin/views/vperf.php', 1, 3, 'ADMIN Perfiles', 'fa-solid fa-people-arrows', 'Perfiles'),
(4030, '', 'admin/views/vusu.php', 1, 4, 'ADMIN Usuarios', 'fa-solid fa-users', 'CRUD de Usuario'),
(4040, '', 'admin/views/vemp.php', 1, 5, 'ADMIN Empleados', 'fa-solid fa-briefcase', 'CRUD de Empleado'),
(4050, '', 'admin/views/vbar.php', 1, 6, 'ADMIN Bares', 'fa-solid fa-shop', 'CRUD de Bares'),
(4060, '', 'admin/views/vprod.php', 1, 7, 'ADMIN Productos', 'fa-solid fa-wine-glass', 'Productos de bares'),
(4070, '', 'admin/views/vgan.php', 1, 0, 'ADMIN Ganacias', 'fa-solid fa-hand-holding-dollar', 'Ganancias y gastos de los bares y empleados'),
(4080, '', 'admin/views/vcarmav.php', 1, NULL, 'ADMIN Carga Masiva', 'fa-solid fa-download', 'Carga masiva para bares y empleados '),
(4090, NULL, 'admin/views/vpedido.php', 1, NULL, 'ADMIN Pedidos', 'fa-solid fa-cart-flatbed', 'Pedidos en proceso'),
(4100, NULL, 'admin/views/vpagos.php', 1, NULL, 'ADMIN Pagos', 'fa-solid fa-money-bill-transfer', 'Pagos por los usuarios'),
(4110, NULL, 'admin/views/vubi.php', 1, NULL, 'ADMIN Ubicaciones', 'fa-solid fa-map-location-dot', 'Ubicaciones para actores'),
(5001, 'PDF Factura de historial', 'views/vfacturapdf.php', 2, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagper`
--

CREATE TABLE `pagper` (
  `idpag` int(5) NOT NULL COMMENT 'id de pagina',
  `idper` bigint(10) DEFAULT NULL COMMENT 'id de perfil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagper`
--

INSERT INTO `pagper` (`idpag`, `idper`) VALUES
(1002, 10),
(1004, 10),
(1005, 10),
(1006, 10),
(1007, 10),
(1008, 10),
(1009, 10),
(1011, 10),
(1012, 10),
(1013, 10),
(1014, 10),
(1015, 10),
(2001, 20),
(2002, 20),
(2003, 20),
(2004, 20),
(2005, 20),
(2006, 20),
(2007, 20),
(2008, 20),
(3001, 30),
(3002, 30),
(3003, 30),
(3004, 30),
(3005, 30),
(3006, 30),
(3007, 30),
(3030, 30),
(5001, 30),
(4010, 40),
(4011, 40),
(4020, 40),
(4021, 40),
(4030, 40),
(4040, 40),
(4050, 40),
(4060, 40),
(4070, 40),
(4080, 40),
(4090, 40),
(4100, 40),
(4110, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` bigint(20) NOT NULL,
  `idcarrito` bigint(20) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `estado` enum('En preparacion','En camino','Entregado') DEFAULT 'En preparacion',
  `total` bigint(20) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `telefono` bigint(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `estado_pago` enum('Pendiente','Pagado') DEFAULT 'Pendiente',
  `metodo_pago` enum('Efectivo','Transferencia') DEFAULT 'Efectivo',
  `servicio` enum('No','Si') DEFAULT 'No',
  `estado_pedido` tinyint(1) NOT NULL DEFAULT 1,
  `idemp` bigint(10) DEFAULT NULL,
  `passecret` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `idcarrito`, `cantidad`, `fecha_pedido`, `estado`, `total`, `idusu`, `telefono`, `direccion`, `mensaje`, `estado_pago`, `metodo_pago`, `servicio`, `estado_pedido`, `idemp`, `passecret`) VALUES
(100110, 10, 20, '2024-12-02 00:00:00', 'En preparacion', 200000, 2003, NULL, NULL, NULL, 'Pendiente', 'Efectivo', 'No', 3, NULL, NULL),
(100125, 12, 6, '2025-02-25 00:00:00', 'Entregado', 822800, 1, NULL, 'Calle Falsa 123', NULL, 'Pagado', 'Efectivo', 'No', 2, 2001, NULL),
(100136, 16, 1, '2025-02-26 00:00:00', 'Entregado', 24600, 1, NULL, 'Por definir', NULL, 'Pagado', 'Efectivo', 'No', 3, NULL, NULL),
(100142, 15, 6, '2025-02-27 00:00:00', 'Entregado', 848100, 1, NULL, 'Por definir', NULL, 'Pagado', 'Efectivo', 'No', 3, NULL, NULL),
(100144, 17, 7, '2025-02-28 00:00:00', 'En preparacion', 872700, 1, NULL, 'Por definir', NULL, 'Pendiente', 'Efectivo', 'No', 3, NULL, NULL),
(100145, 18, 1, '2025-02-27 00:00:00', 'En preparacion', 24600, 1, NULL, 'Por definir', NULL, 'Pendiente', 'Efectivo', 'No', 3, NULL, NULL),
(100148, 19, 6, '2025-02-28 00:00:00', 'Entregado', 848100, 1, NULL, 'Por definir', NULL, 'Pagado', 'Efectivo', 'No', 3, NULL, NULL),
(100149, 20, 6, '2025-03-02 00:00:00', 'Entregado', 848100, 4, NULL, '', '', 'Pagado', 'Efectivo', 'No', 2, 2001, NULL),
(100150, 21, 6, '2025-03-02 18:02:09', 'Entregado', 848100, 1, NULL, '', '', 'Pagado', 'Efectivo', 'No', 2, 2001, NULL),
(100151, 22, 6, '2025-03-02 18:06:00', 'Entregado', 848100, 5, 3123456789, 'Cale 124', 'Traer cambio', 'Pagado', 'Efectivo', 'No', 2, 2001, NULL),
(100152, 23, 6, '2025-03-05 13:39:26', 'Entregado', 848100, 1, 3002089200, 'Calle 308 ', 'Dejar en porteria', 'Pagado', 'Efectivo', 'No', 2, 2001, 'AH12HS63'),
(100153, 10, 3, '2025-03-10 23:56:12', 'En preparacion', 279100, 1, 3123456789, 'calle 20', 'holaa', 'Pendiente', 'Efectivo', 'No', 2, 2001, NULL),
(100154, 14, 6, '2025-03-10 23:56:57', 'En preparacion', 848100, 1, 32345, 'calle 20', 'adas', 'Pendiente', 'Efectivo', 'No', 3, NULL, NULL),
(100155, 24, 10, '2025-03-10 23:58:18', 'En preparacion', 704600, 1, 23123, 'calle 20', 'holaa', 'Pendiente', 'Efectivo', 'No', 3, NULL, NULL),
(100156, 27, 3, '2025-03-11 00:03:35', 'En preparacion', 332400, 1, 3123456789, 'calle 20 #602', 'Dejar en porteria', 'Pendiente', 'Efectivo', 'No', 3, NULL, NULL),
(100157, 28, 5, '2025-03-11 00:06:43', 'En camino', 169000, 1, 3123456789, 'calle 20 #90-20', 'Dejar en porteria', 'Pendiente', 'Efectivo', 'No', 2, 2001, NULL),
(100158, 29, 3, '2025-03-11 00:07:31', 'Entregado', 689700, 1, 3123456789, 'calle 20 #90-20', 'Dejar en porteria', 'Pagado', 'Transferencia', 'No', 2, 2001, NULL),
(100159, 31, 3, '2025-03-13 10:43:49', 'Entregado', 203000, 1, 3123456789, 'calle 20 #90-20', 'Dejar en portería', 'Pagado', 'Efectivo', 'No', 2, 2001, NULL),
(100160, 34, 8, '2025-03-16 20:22:58', 'Entregado', 1385200, 1, 3123456789, 'calle 20 #90-20', 'Dejar en portería', 'Pagado', 'Efectivo', 'Si', 2, 2001, NULL),
(100161, 35, 2, '2025-03-23 15:39:31', 'En preparacion', 780000, 1, 3124324243, 'calle 20', 'Dejar en porteria', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL),
(100162, 36, 1, '2025-03-23 15:40:12', 'En preparacion', 147000, 1, 312312, 'calle 20 #602', 'Dejar en porteria', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL),
(100163, 37, 1, '2025-03-23 15:40:48', 'En preparacion', 18000, 1, 321231, 'calle 20', 'Dejar en porteria', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL),
(100164, 38, 1, '2025-03-23 15:42:42', 'En preparacion', 24600, 1, 312321, 'calle 20 #90-20', 'Dejar en porteria', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL),
(100165, 39, 1, '2025-03-23 15:45:10', 'En preparacion', 43900, 1, 213123, 'calle 20 #602', 'Dejar en portería', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL),
(100166, 40, 1, '2025-03-23 15:46:25', 'En preparacion', 229900, 1, 3221312, 'calle 20 #90-20', 'Dejar en portería', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL),
(100167, 41, 1, '2025-03-23 15:48:47', 'En preparacion', 147000, 1, 3213123, 'calle 20 #90-20', 'Dejar en portería', 'Pendiente', 'Efectivo', 'No', 1, NULL, NULL);

--
-- Disparadores `pedido`
--
DELIMITER $$
CREATE TRIGGER `set_estado_en_camino` BEFORE UPDATE ON `pedido` FOR EACH ROW BEGIN
    -- Si se asigna un idemp y el estado aún no está en "En camino"
    IF NEW.idemp IS NOT NULL AND OLD.idemp IS NULL THEN
        SET NEW.estado = 'En camino';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_generar_factura` AFTER UPDATE ON `pedido` FOR EACH ROW BEGIN
    DECLARE v_idfact INT;
    DECLARE v_idbar INT;

    -- Verifica si el pago cambió de "Pendiente" a "Pagado"
    IF NEW.estado_pago = 'Pagado' AND OLD.estado_pago = 'Pendiente' THEN

        -- Obtiene el idbar del pedido desde la tabla detpedido
        SELECT idbar INTO v_idbar 
        FROM detpedido 
        WHERE idpedido = NEW.idpedido 
        LIMIT 1;

        -- Verifica si ya existe una factura para este pedido
        SELECT idfact INTO v_idfact 
        FROM factura 
        WHERE idpedido = NEW.idpedido 
        LIMIT 1;

        -- Si no existe, la crea con el idbar incluido
        IF v_idfact IS NULL THEN
            INSERT INTO factura (
                idpedido, fecha, idemp, cantidad, total, 
                direccion, idusu, metodo_pago, servicio, 
                estado_pago, estado, idbar
            )
            VALUES (
                NEW.idpedido, NOW(), NEW.idemp, NEW.cantidad, 
                NEW.total, NEW.direccion, NEW.idusu, NEW.metodo_pago, 
                NEW.servicio,  -- ???? Se agrega el servicio
                NEW.estado_pago, 'activa', v_idbar
            );

            SET v_idfact = LAST_INSERT_ID();
        END IF;
    END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_insertar_detpedido` AFTER INSERT ON `pedido` FOR EACH ROW BEGIN
    INSERT INTO detpedido (idpedido, idprod, cantidad, precio, total, idusu, idbar)
    SELECT 
        NEW.idpedido, 
        dc.idprod, 
        dc.cantidad, 
        dc.precar, 
        (dc.cantidad * dc.precar), 
        c.idusu, 
        p.idbar 
    FROM detcarrito dc
    JOIN producto p ON dc.idprod = p.idprod
    JOIN carrito c ON dc.idcarrito = c.idcarrito
    WHERE dc.idcarrito = NEW.idcarrito;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idper` bigint(10) NOT NULL COMMENT 'id de perfil',
  `nomper` varchar(50) NOT NULL COMMENT 'nombre del perfil',
  `pagini` bigint(10) NOT NULL COMMENT 'pagina inicial',
  `idpag` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idper`, `nomper`, `pagini`, `idpag`) VALUES
(10, 'usuarios', 1002, 1002),
(20, 'empleados', 2001, 2001),
(30, 'bares', 3001, 3001),
(40, 'ADMIN', 4010, 4060);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idprod` bigint(20) NOT NULL COMMENT 'id de producto',
  `nomprod` varchar(50) DEFAULT NULL COMMENT 'nombre del producto',
  `desprod` varchar(255) DEFAULT NULL COMMENT 'descripcion del producto',
  `caracter` varchar(255) DEFAULT NULL,
  `mililitros` bigint(10) NOT NULL,
  `vlrprod` bigint(20) DEFAULT NULL COMMENT 'valor del producto',
  `fotprod` varchar(255) DEFAULT NULL COMMENT 'foto del producto',
  `idbar` bigint(10) DEFAULT NULL COMMENT 'id del bar',
  `cantprod` int(8) DEFAULT NULL COMMENT 'cantidad del producto',
  `tipoprod` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idprod`, `nomprod`, `desprod`, `caracter`, `mililitros`, `vlrprod`, `fotprod`, `idbar`, `cantprod`, `tipoprod`, `estado`) VALUES
(21, 'Cerveza Corona X6 330ml', '✅ Pack de 6 botellas de 330ml\r\n✅ Sabor ligero y refrescante 🌿🍋\r\n✅ Origen: México 🇲🇽\r\n✅ Graduación alcohólica: 4.5%\r\n✅ Perfecta para mariscos, parrilladas y reuniones', NULL, 330, 24600, 'fot_20250324171138.png', 2002, 50, 'licor', 1),
(22, 'Ron Cacique Añejo ', '✅ Origen: Venezuela 🇻🇪\r\n✅ Graduación alcohólica: 40%\r\n✅ Sabor: Suave, con notas de madera, miel y especias\r\n✅ Ideal para: Disfrutar puro o en cócteles clásicos', NULL, 750, 66900, 'fot_20250324171230.png', 2002, 50, 'licor', 1),
(23, 'Ron La Hechicera', '✅ Origen: Colombia 🇨🇴\r\n✅ Graduación alcohólica: 40%\r\n✅ Sabor: Intenso, con toques de madera, especias y frutas maduras\r\n✅ Ideal para: Disfrutar solo o con un toque de hielo', NULL, 700, 229900, 'fot_20250324171242.png', 2002, 50, 'licor', 1),
(24, 'Whisky Johnnie Walker Black Label Blended', '✅ Origen: Escocia 🇬🇧\r\n✅ Graduación alcohólica: 40%\r\n✅ Sabor: Notas de frutas secas, vainilla, caramelo y un sutil ahumado\r\n✅ Ideal para: Tomar solo, en las rocas o en cócteles sofisticados', NULL, 700, 147000, 'fot_20250324171305.png', 2002, 50, 'licor', 1),
(25, 'Crema de Whisky Baileys', '✅ Origen: Irlanda 🇮🇪\r\n✅ Graduación alcohólica: 17%\r\n✅ Sabor: Cremoso y dulce, con notas de chocolate y vainilla\r\n✅ Ideal para: Tomar solo, con hielo o en café y postres', NULL, 700, 72000, 'fot_20250324184405.png', 2003, 50, 'licor', 1),
(26, 'Whisky Buchanans Special Reserve 18 Años Escocés 7', '✅ Origen: Escocia 🇬🇧\r\n✅ Graduación alcohólica: 40%\r\n✅ Sabor: Complejo y equilibrado, con notas de caramelo, miel y madera\r\n✅ Ideal para: Disfrutar solo o con un toque de agua o hielo', NULL, 750, 390000, 'fot_20250324184436.png', 2003, 50, 'licor', 1),
(27, 'Vino Blanco Mar de Frades Albariño', '✅ Origen: España 🇪🇸\r\n✅ Graduación alcohólica: 12.5%\r\n✅ Sabor: Frutal y refrescante, con notas cítricas y toques de salinidad\r\n✅ Ideal para: Acompañar mariscos, pescados y platos mediterráneos', NULL, 750, 130200, 'fot_20250324184429.png', 2003, 50, 'vino', 1),
(30, 'Vino Rosado Espumoso Piccini Regno Lambrusco ', '✅ Origen: Italia 🇮🇹\r\n✅ Graduación alcohólica: 8%\r\n✅ Sabor: Frutal con notas de fresa y cereza, burbujas finas y frescura equilibrada\r\n✅ Ideal para: Acompañar postres, quesos suaves o tomar bien frío', NULL, 750, 45900, 'fot_20250324171317.png', 2002, 50, 'vino', 1),
(31, 'Aperitivo Frizzantino Rosado Brut', '✅ Origen: Italia 🇮🇹\r\n✅ Graduación alcohólica: 10-11%\r\n✅ Sabor: Notas de frutos rojos y un toque floral, con burbujas finas y frescura equilibrada\r\n✅ Ideal para: Brindis, cócteles o acompañar postres y aperitivos', NULL, 750, 25200, 'fot_20250324171332.png', 2002, 50, 'vino', 1),
(32, 'Vino Rosado Santa Carolina Reservado Cabernet Sauv', '✅ Origen: Chile 🇨🇱\r\n✅ Graduación alcohólica: 12-13%\r\n✅ Sabor: Frutas rojas frescas como frambuesa y cereza, con un toque sutil de especias\r\n✅ Ideal para: Acompañar ensaladas, mariscos, sushi o tomar bien frío', NULL, 700, 43900, 'fot_20250324171344.png', 2002, 50, 'vino', 1),
(33, 'Alisos de Pasión ', '✅ Presentación: Vaso de plastico\r\n✅ Ideal para: Disfrutar solo, bien frío o como base para otros cócteles\r\n✅ Ingredientes:\r\n📍3 cl de Ron Bacardi Superior,\r\n📍2 cl de Cacao blanco,\r\n📍2 cl de Pisang,\r\n📍7 cl de Zumo de piña,\r\n📍8 cl de Zumo de mango – maracuya', NULL, 200, 20000, 'fot_20250324173603.png', 2002, 50, 'coctel', 1),
(34, 'Arrival (Espiritu Isleño)', '✅ Presentación: Vaso de plástico de 200ml\r\n✅ Sabor: Dulce y afrutado, con notas tropicales y un toque refrescante\r\n✅ Ingredientes:\r\n📍3 cl de Pisang Ambong\r\n📍2 cl de Sobieski Mandarina\r\n📍2 cl de Curaçao Blue\r\n📍9 cl de Zumo Mango-Maracuyá\r\n📍5 cl de Sirope d', NULL, 200, 25000, 'fot_20250324184802.png', 2003, 50, 'coctel', 1),
(35, 'Black Russian ', '✅ Presentación: Vaso de plastico\r\n✅ Tamaño personal grande: 200ml, para disfrutar un vaso completo y bien servido\r\n✅ Ingredientes\r\n5 cl de Vodka\r\n2 cl de Licor de café', NULL, 200, 28000, 'fot_20250324190524.png', 2002, 50, 'coctel', 1),
(36, 'Basilico', '✅ Presentación: Vaso de plástico de 200ml\r\n✅ Sabor: Frutal y ligeramente ácido, con notas de moras y ginebra\r\n✅ Ingredientes:\r\n2 cl de Jarabe de azúcar natural\r\n📍10 cl de Pepino y lima en trozos\r\n📍5 cl de Ginebra\r\n📍2 cl de Licor de melón\r\n📍3 cl de Zumo de', NULL, 200, 18000, 'fot_20250324184558.png', 2003, 50, 'coctel', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_actualizar_pedido`
--

CREATE TABLE `temp_actualizar_pedido` (
  `idpedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temp_actualizar_pedido`
--

INSERT INTO `temp_actualizar_pedido` (`idpedido`) VALUES
(100142),
(100143),
(100144),
(100145),
(100146),
(100147),
(100148),
(100149),
(100150),
(100151),
(100152),
(100153),
(100154),
(100155),
(100156),
(100157),
(100158),
(100159),
(100160),
(100161),
(100162),
(100163),
(100164),
(100165),
(100166),
(100167);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `emausu` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `codubi` int(6) NOT NULL COMMENT 'codigo de ubicacion',
  `nomubi` varchar(255) DEFAULT NULL COMMENT 'nombre de ubicacion',
  `depubi` varchar(255) DEFAULT NULL COMMENT 'dependencia de ubicacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`codubi`, `nomubi`, `depubi`) VALUES
(1, 'Bogotá', 'Bogotá'),
(2, 'Medellín', 'Antioquia'),
(3, 'Cartagena', 'Bolívar'),
(4, 'Cali', 'Valle del cauca'),
(5, 'Barranquilla', 'Atlántico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusu` bigint(10) NOT NULL COMMENT 'id de usuario',
  `nomusu` varchar(150) DEFAULT NULL COMMENT 'nombre de usuario',
  `emausu` varchar(100) DEFAULT NULL COMMENT 'email de usuario',
  `celusu` int(10) DEFAULT NULL COMMENT 'celular de usuario',
  `fotiden` varchar(255) DEFAULT NULL COMMENT 'foto de identificación',
  `numdocu` bigint(10) NOT NULL COMMENT 'numero de documento',
  `fecnausu` date DEFAULT NULL COMMENT 'fecha de nacimiento',
  `pssusu` varchar(100) NOT NULL COMMENT 'contraseña del usuario',
  `codubi` int(6) DEFAULT NULL COMMENT 'codigo de ubicacion',
  `idper` bigint(10) NOT NULL COMMENT 'id del perfil',
  `idval` bigint(10) NOT NULL COMMENT 'id valor',
  `idbar` bigint(10) DEFAULT NULL,
  `nompropi` varchar(50) DEFAULT NULL,
  `dircbar` varchar(100) DEFAULT NULL,
  `horbar` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusu`, `nomusu`, `emausu`, `celusu`, `fotiden`, `numdocu`, `fecnausu`, `pssusu`, `codubi`, `idper`, `idval`, `idbar`, `nompropi`, `dircbar`, `horbar`, `estado`) VALUES
(1, 'Dilan Lopez', 'dilaanlop@gmail.com', 300437, NULL, 1053, '2004-09-11', 'f8e1f9899ad38f957f8f2cb1dc504678c3d23ee0', 1, 10, 101, NULL, NULL, NULL, NULL, 1),
(4, 'Felipe Arias', 'felipe@gmail.com', 300212, NULL, 3030, '2008-02-13', '52109b25d2fba7f005f3052cad7c92a1861a48e1', 1, 40, 101, NULL, NULL, NULL, NULL, 1),
(5, 'Victor Cortez', 'victor@gmail.com', NULL, NULL, 4040, NULL, 'e9c2dd7a3ade9110738d897badebb8eb458920dc', 2, 40, 101, NULL, NULL, NULL, NULL, 1),
(2000, 'Martin Casa', 'martin@gmail.com', 3001782, 'fot_20250324145250.jpeg', 109020, '2000-11-20', '78adbe311449919b44220c57d7089ee5b8f306ad', 1, 20, 101, 2002, NULL, 'null', NULL, 1),
(2001, 'Jose', 'jose@gmail.com', 3001782, 'fot_20250322144602.jpeg', 102891, '2000-11-09', '$2y$10$ZoL4N1BdBgPdc6VRmuh5k./ulkTgKvxxuQ7Y0.e8YM28ZtC5BNkvu', 2, 20, 102, 2003, NULL, NULL, NULL, 1),
(2002, 'Cabañas Norte', 'caba@gmail.com', 300940912, NULL, 8029812, NULL, 'e0851d399bb2954f554d93328662c70f79273f5a', 1, 30, 104, 2002, 'Juan Martinez', 'Calle 20 #40-60 Norte', '11:00 - 17:00', 1),
(2003, 'Bazar', 'baz@gmail.com', 300828821, NULL, 8039923, NULL, 'a7c9f5b4f15002ac1275c418d5c77f316ae749db', 2, 30, 102, 2003, 'Jose Perez', 'Transversal 7 #30-50 ', '11:00 - 17:00', 1),
(2004, 'Llanos', 'llano@gmail.com', 98311212, NULL, 8749283, NULL, '661bb5ab253795539bec27058477f29f1cd506f5', 5, 30, 102, 2004, 'Daniel', 'Calle 20 #90', '11:00 - 17:00', 1),
(2005, 'Bar Rocas', 'roca@gmail.com', 8127371, NULL, 874923, NULL, '1bbf9d535f9136ee5d4465bf0885519c6e69d181', 3, 30, 102, 2005, 'Juanjo', 'Transversal 9 #10-30', '14:00 22:00', 1),
(2006, 'Maxx', 'max@gmail.com', NULL, NULL, 982612, '2002-10-22', 'a173249142de74347ea277f688bd0c9e7e957f63', 4, 10, 103, NULL, NULL, NULL, NULL, 1),
(2007, 'Yeison', 'yeison@gmail.com', NULL, NULL, 917839, '2002-08-21', 'efbc96ea93766af9a6eac77b71119a18dd739b79', 5, 10, 102, NULL, NULL, NULL, NULL, 1),
(2008, 'Juliana', 'juliana@gmail.com', NULL, NULL, 109236, '2002-05-13', '62fde584a1539593e53c79ede553cd053aec16bb', 2, 10, 101, NULL, NULL, NULL, NULL, 1),
(4010, 'Mario', 'mario@gmail.com', 2147483647, 'fot_20250324145237.jpeg', 12434234, '2013-02-27', '5ca7bbaecd01d23728110f709a137d4dbc609531', 1, 20, 101, 2002, NULL, NULL, NULL, 1);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `after_delete_usuario` AFTER DELETE ON `usuario` FOR EACH ROW BEGIN
    DELETE FROM empleado WHERE idemp = OLD.idusu;
    DELETE FROM bar WHERE idbar = OLD.idusu;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_usuario_bar` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    IF NEW.idper = 30 THEN
        INSERT INTO bar (idbar, nombar, emabar, telbar, nit, fotbar, pssbar, codubi, idval, idper, nompropi, dircbar, horbar, estado)
        VALUES (NEW.idusu, NEW.nomusu, NEW.emausu, NEW.celusu, NEW.numdocu, NEW.fotiden, NEW.pssusu, NEW.codubi, NEW.idval, NEW.idper, NEW.nompropi, NEW.dircbar, NEW.horbar, NEW.estado);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_usuario_empleado` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    IF NEW.idper = 20 THEN
        INSERT INTO empleado (idemp, nomemp, emaemp, celemp, numdocu, fecnaemp, fotiden, pssemp, codubi, idval, idper, idbar, estado)
        VALUES (NEW.idusu, NEW.nomusu, NEW.emausu, NEW.celusu, NEW.numdocu, NEW.fecnausu, NEW.fotiden, NEW.pssusu, NEW.codubi, NEW.idval, NEW.idper, NEW.idbar, NEW.estado);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_usuario_bar` AFTER UPDATE ON `usuario` FOR EACH ROW BEGIN
    IF NEW.idper = 30 THEN
        UPDATE bar
        SET nombar = NEW.nomusu, emabar = NEW.emausu, telbar = NEW.celusu, nit = NEW.numdocu, fotbar = NEW.fotiden, 
            pssbar = NEW.pssusu, nompropi = NEW.nompropi, dircbar = NEW.dircbar, horbar = NEW.horbar, 
            codubi = NEW.codubi, idper = NEW.idper, idval = NEW.idval, estado = NEW.estado
        WHERE idbar = OLD.idusu;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_usuario_empleado` AFTER UPDATE ON `usuario` FOR EACH ROW BEGIN
    IF NEW.idper = 20 THEN
        UPDATE empleado
        SET nomemp = NEW.nomusu, 
            emaemp = NEW.emausu, 
            celemp = NEW.celusu, 
            numdocu = NEW.numdocu, 
            fecnaemp = NEW.fecnausu, 
            fotiden = NEW.fotiden, 
            pssemp = NEW.pssusu, 
            idbar = NEW.idbar, 
            codubi = NEW.codubi, 
            idper = NEW.idper,
            idval = NEW.idval,
            estado = NEW.estado
        WHERE idemp = NEW.idusu; -- Usar NEW.idusu para identificar el usuario actualizado
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `idval` bigint(10) NOT NULL COMMENT 'id de valor',
  `iddom` int(4) DEFAULT NULL COMMENT 'id de dominio',
  `nomval` varchar(50) DEFAULT NULL COMMENT 'nombre del valor',
  `act` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor`
--

INSERT INTO `valor` (`idval`, `iddom`, `nomval`, `act`) VALUES
(101, 10, 'CC', 1),
(102, 10, 'CE', 1),
(103, 10, 'PA', 1),
(104, 10, 'NIT', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`idbar`),
  ADD UNIQUE KEY `nit` (`nit`),
  ADD KEY `codubi` (`codubi`),
  ADD KEY `idper` (`idper`),
  ADD KEY `idval` (`idval`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idcarrito`),
  ADD KEY `idusu` (`idusu`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idcof`);

--
-- Indices de la tabla `detcarrito`
--
ALTER TABLE `detcarrito`
  ADD PRIMARY KEY (`iddetcarrito`),
  ADD KEY `idcarrito` (`idcarrito`),
  ADD KEY `idprod` (`idprod`);

--
-- Indices de la tabla `detfact`
--
ALTER TABLE `detfact`
  ADD PRIMARY KEY (`iddetfact`),
  ADD UNIQUE KEY `idusu` (`idusu`),
  ADD KEY `idfact` (`idfact`),
  ADD KEY `idprod` (`idprod`),
  ADD KEY `fk_detfact_bar` (`idbar`);

--
-- Indices de la tabla `detpedido`
--
ALTER TABLE `detpedido`
  ADD PRIMARY KEY (`iddetpedido`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idprod` (`idprod`),
  ADD KEY `idusu` (`idusu`),
  ADD KEY `idbar` (`idbar`);

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddom`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idemp`),
  ADD UNIQUE KEY `numdocu` (`numdocu`),
  ADD KEY `idbar` (`idbar`),
  ADD KEY `codubi` (`codubi`),
  ADD KEY `idper` (`idper`),
  ADD KEY `idval` (`idval`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfact`),
  ADD KEY `factura_ibfk_2` (`idusu`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idpedido_2` (`idpedido`),
  ADD KEY `idemp` (`idemp`),
  ADD KEY `idbar` (`idbar`);

--
-- Indices de la tabla `facturas_pendientes`
--
ALTER TABLE `facturas_pendientes`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`idpag`);

--
-- Indices de la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD PRIMARY KEY (`idpag`),
  ADD KEY `idper` (`idper`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `idcarrito` (`idcarrito`),
  ADD KEY `idusu` (`idusu`),
  ADD KEY `idemp` (`idemp`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idper`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idprod`),
  ADD KEY `idbar` (`idbar`);

--
-- Indices de la tabla `temp_actualizar_pedido`
--
ALTER TABLE `temp_actualizar_pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`codubi`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusu`),
  ADD UNIQUE KEY `numdocu` (`numdocu`),
  ADD KEY `codubi` (`codubi`),
  ADD KEY `idper` (`idper`),
  ADD KEY `idval` (`idval`),
  ADD KEY `idbar` (`idbar`);

--
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`idval`),
  ADD KEY `iddom` (`iddom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bar`
--
ALTER TABLE `bar`
  MODIFY `idbar` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de bar', AUTO_INCREMENT=60002;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idcarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `detcarrito`
--
ALTER TABLE `detcarrito`
  MODIFY `iddetcarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT de la tabla `detfact`
--
ALTER TABLE `detfact`
  MODIFY `iddetfact` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de detalle de factura', AUTO_INCREMENT=1001116;

--
-- AUTO_INCREMENT de la tabla `detpedido`
--
ALTER TABLE `detpedido`
  MODIFY `iddetpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109385;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` int(4) NOT NULL AUTO_INCREMENT COMMENT 'id de dominio', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idemp` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id del empleado', AUTO_INCREMENT=30002;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfact` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de factura', AUTO_INCREMENT=1090;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id de pagina', AUTO_INCREMENT=5002;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100168;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de producto', AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `codubi` int(6) NOT NULL AUTO_INCREMENT COMMENT 'codigo de ubicacion', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de usuario', AUTO_INCREMENT=4012;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `idval` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de valor', AUTO_INCREMENT=105;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bar`
--
ALTER TABLE `bar`
  ADD CONSTRAINT `bar_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `bar_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`),
  ADD CONSTRAINT `bar_ibfk_3` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`);

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detcarrito`
--
ALTER TABLE `detcarrito`
  ADD CONSTRAINT `detcarrito_ibfk_1` FOREIGN KEY (`idcarrito`) REFERENCES `carrito` (`idcarrito`) ON DELETE CASCADE,
  ADD CONSTRAINT `detcarrito_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detfact`
--
ALTER TABLE `detfact`
  ADD CONSTRAINT `detfact_ibfk_1` FOREIGN KEY (`idfact`) REFERENCES `factura` (`idfact`),
  ADD CONSTRAINT `detfact_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`),
  ADD CONSTRAINT `detfact_ibfk_5` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `fk_detfact_bar` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detpedido`
--
ALTER TABLE `detpedido`
  ADD CONSTRAINT `detpedido_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`),
  ADD CONSTRAINT `detpedido_ibfk_2` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `detpedido_ibfk_3` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `detpedido_ibfk_4` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`),
  ADD CONSTRAINT `empleado_ibfk_4` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idemp`) REFERENCES `empleado` (`idemp`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

--
-- Filtros para la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD CONSTRAINT `pagper_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pagina` (`idpag`),
  ADD CONSTRAINT `pagper_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idemp`) REFERENCES `empleado` (`idemp`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idcarrito`) REFERENCES `carrito` (`idcarrito`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `actualizar_estado_pedidos` ON SCHEDULE EVERY 1 HOUR STARTS '2025-03-01 13:37:47' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE pedido 
    SET estado_pedido = 3 
    WHERE estado_pedido = 1  
    AND TIMESTAMPDIFF(HOUR, fecha_pedido, NOW()) > 8;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `actualizar_facturas_pendientes` ON SCHEDULE EVERY 1 SECOND STARTS '2025-02-27 15:23:02' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE pedido p
    JOIN facturas_pendientes fp ON p.idpedido = fp.idpedido
    SET p.idfactura = fp.idfactura;

    DELETE FROM facturas_pendientes WHERE idpedido IN (SELECT idpedido FROM pedido);
END$$

CREATE DEFINER=`root`@`localhost` EVENT `actualizar_pedido_cantidad` ON SCHEDULE EVERY 1 SECOND STARTS '2025-02-27 15:23:02' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE pedido p
    SET p.cantidad = (
        SELECT COALESCE(SUM(dp.cantidad), 0) 
        FROM detpedido dp 
        WHERE dp.idpedido = p.idpedido
    );
END$$

CREATE DEFINER=`root`@`localhost` EVENT `actualizar_totales_factura` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-02-27 16:55:19' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE factura f
    INNER JOIN (
        SELECT df.idfact, SUM(df.subtotal) AS total_factura
        FROM detfact df
        GROUP BY df.idfact
    ) AS temp ON f.idfact = temp.idfact
    SET f.total = temp.total_factura;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `actualizar_totales_pedido` ON SCHEDULE EVERY 1 SECOND STARTS '2025-02-27 17:15:31' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE pedido p
    INNER JOIN (
        SELECT dp.idpedido, SUM(dp.cantidad) AS cantidad_total, SUM(dp.total) AS total_pedido, MIN(dp.idusu) AS idusu_correcto
        FROM detpedido dp
        GROUP BY dp.idpedido
    ) AS temp ON p.idpedido = temp.idpedido
    SET 
        p.cantidad = temp.cantidad_total,
        p.total = temp.total_pedido,
        p.idusu = temp.idusu_correcto
    WHERE p.cantidad != temp.cantidad_total OR p.total != temp.total_pedido OR p.idusu != temp.idusu_correcto;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `eliminar_pedidos_vacios` ON SCHEDULE EVERY 5 MINUTE STARTS '2025-02-27 15:23:02' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    DELETE FROM pedido 
    WHERE idpedido NOT IN (SELECT DISTINCT idpedido FROM detpedido);
END$$

CREATE DEFINER=`root`@`localhost` EVENT `ev_anular_factura` ON SCHEDULE EVERY 1 DAY STARTS '2025-03-02 12:13:06' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE factura
    SET estado = 'anulada'
    WHERE estado = 'activa' AND fecha < NOW() - INTERVAL 3 DAY;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `procesar_actualizar_pedido` ON SCHEDULE EVERY 1 SECOND STARTS '2025-02-27 17:15:24' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE pedido p
    INNER JOIN (
        SELECT dp.idpedido, SUM(dp.cantidad) AS cantidad_total, SUM(dp.total) AS total_pedido, MIN(dp.idusu) AS idusu_correcto
        FROM detpedido_pendiente dp
        GROUP BY dp.idpedido
    ) AS temp ON p.idpedido = temp.idpedido
    SET 
        p.cantidad = temp.cantidad_total,
        p.total = temp.total_pedido,
        p.idusu = temp.idusu_correcto
    WHERE p.cantidad != temp.cantidad_total OR p.total != temp.total_pedido OR p.idusu != temp.idusu_correcto;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `procesar_detpedido_pendiente` ON SCHEDULE EVERY 1 SECOND STARTS '2025-02-27 15:23:02' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    INSERT INTO detpedido (idpedido, idprod, cantidad, precio, total, idusu, idbar)
    SELECT idpedido, idprod, cantidad, precio, total, idusu, idbar
    FROM detpedido_pendiente;

    DELETE FROM detpedido_pendiente;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `evento_actualizar_estado` ON SCHEDULE EVERY 30 SECOND STARTS '2025-03-08 16:01:41' ON COMPLETION NOT PRESERVE ENABLE DO CALL actualizarEstadoEntregado()$$

CREATE DEFINER=`root`@`localhost` EVENT `procesar_facturas` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-03-02 13:07:51' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE v_idpedido BIGINT;

    DECLARE cur CURSOR FOR SELECT idpedido FROM temp_factura;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    leer_loop: LOOP
        FETCH cur INTO v_idpedido;
        IF done THEN 
            LEAVE leer_loop;
        END IF;

        INSERT INTO factura (idpedido, fecha, idemp, cantidad, total, direccion, idusu, metodo_pago, estado_pago, estado)
        SELECT idpedido, NOW(), idemp, cantidad, total, direccion, idusu, metodo_pago, 'Pagado', 'activa'
        FROM pedido
        WHERE idpedido = v_idpedido;

        DELETE FROM temp_factura WHERE idpedido = v_idpedido;
    END LOOP;

    CLOSE cur;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
