-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 17:47:56
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
-- Base de datos: `coctelapp`
--

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
  `idval` bigint(10) NOT NULL COMMENT 'id del valor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bar`
--

INSERT INTO `bar` (`idbar`, `nombar`, `nompropi`, `nit`, `emabar`, `telbar`, `pssbar`, `dircbar`, `horbar`, `fotbar`, `codubi`, `idper`, `idval`) VALUES
(2002, 'Cabañas', 'Juan Martinez', 8029812, 'caba@gmail.com', 300940912, 'e0851d399bb2954f554d93328662c70f79273f5a', 'Calle 20 #40-60 Norte', NULL, NULL, 1, 30, 102),
(2003, 'Bazar', 'Jose Perez', 8039923, 'baz@gmail.com', 300828821, 'a7c9f5b4f15002ac1275c418d5c77f316ae749db', 'Transversal 7 #30-50 ', NULL, NULL, 2, 30, 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idcarrito` bigint(20) NOT NULL,
  `idusu` bigint(10) NOT NULL,
  `fecha_creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `detfact`
--

CREATE TABLE `detfact` (
  `iddetfact` bigint(20) NOT NULL COMMENT 'id de detalle de factura',
  `idfact` bigint(20) NOT NULL COMMENT 'id de factura',
  `idprod` bigint(20) DEFAULT NULL COMMENT 'id del producto',
  `fecha` date DEFAULT NULL,
  `cantidad` int(8) DEFAULT NULL COMMENT 'cantidad de productos',
  `precio_unitario` decimal(10,2) DEFAULT NULL COMMENT 'precio por producto',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'subtotal del pedido',
  `idemp` bigint(10) DEFAULT NULL COMMENT 'id del empleado',
  `idbar` bigint(10) NOT NULL COMMENT 'id del bar',
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detfact`
--

INSERT INTO `detfact` (`iddetfact`, `idfact`, `idprod`, `fecha`, `cantidad`, `precio_unitario`, `subtotal`, `idemp`, `idbar`, `idusu`) VALUES
(1001010, 1001, 21, NULL, 2, 200.00, 200.00, 2000, 2003, 2001),
(1001020, 1002, 30, NULL, 5, 300000.00, 300000.00, 2000, 2003, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detpedido`
--

CREATE TABLE `detpedido` (
  `iddetpedido` bigint(20) NOT NULL,
  `idpedido` bigint(20) NOT NULL,
  `idprod` bigint(20) NOT NULL,
  `cantidad` int(8) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`cantidad` * `precio_unitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `idserv` tinyint(2) DEFAULT NULL COMMENT 'id del servicio',
  `idbar` bigint(10) DEFAULT NULL COMMENT 'id del bar',
  `codubi` int(6) DEFAULT NULL COMMENT 'codigo de ubicacion ',
  `idper` bigint(10) NOT NULL COMMENT 'id del perfil',
  `idval` bigint(10) NOT NULL COMMENT 'id de valor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idemp`, `nomemp`, `emaemp`, `celemp`, `fecnaemp`, `numdocu`, `fotiden`, `pssemp`, `idserv`, `idbar`, `codubi`, `idper`, `idval`) VALUES
(2000, 'Martin Casas', 'martin@gmail.com', 3001782, '2000-11-20', 109020, NULL, '78adbe311449919b44220c57d7089ee5b8f306ad', 1, 2002, 1, 20, 101),
(2001, 'Jose', 'jose@gmail.com', 3001782, '2000-11-09', 102891, NULL, '15bb060fd110a4f67c6b5b287072524f345ec1b7', 2, 2003, 2, 20, 101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfact` bigint(20) NOT NULL COMMENT 'id de factura',
  `idpedido` bigint(20) NOT NULL,
  `fecha` date DEFAULT NULL COMMENT 'fecha de la factura',
  `idbar` bigint(10) DEFAULT NULL COMMENT 'id del bar',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'total de compra',
  `idusu` bigint(10) DEFAULT NULL COMMENT 'id de usuario '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfact`, `idpedido`, `fecha`, `idbar`, `total`, `idusu`) VALUES
(1001, 100110, '2024-11-30', 2003, 200.00, 2001),
(1002, 100120, '2024-11-30', 2003, 300000.00, 2002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metpago`
--

CREATE TABLE `metpago` (
  `idmetpago` tinyint(2) NOT NULL,
  `nommetpago` varchar(50) DEFAULT NULL,
  `nomtitu` varchar(255) DEFAULT NULL,
  `cvv` int(4) DEFAULT NULL,
  `fecvenci` date DEFAULT NULL,
  `numtarj` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metpago`
--

INSERT INTO `metpago` (`idmetpago`, `nommetpago`, `nomtitu`, `cvv`, `fecvenci`, `numtarj`) VALUES
(1, 'TARJETA DEBITO', NULL, NULL, NULL, NULL),
(2, 'PSE', NULL, NULL, NULL, NULL),
(3, 'CONTRA ENTREGA', NULL, NULL, NULL, NULL);

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
(1002, 'Bares', 'views/vusbares.php', 1, 1, 'Bares', '', 'Vista de bares'),
(1004, 'Cócteles', 'views/vuscoct.php', 1, 2, 'Cócteles', NULL, 'Vista de bares'),
(1005, 'Vinos', 'views/vusvino.php', 1, 3, 'Vinos', NULL, 'Vista Vinos'),
(1006, 'Licores', 'views/vuslicor.php', 1, 4, 'Licores', NULL, 'Vista Licores'),
(1007, '', 'views/vuscarcom.php', 1, 5, 'Carrito', 'fa-solid fa-cart-shopping', 'Carrito de compras'),
(1008, '', 'views/vushipe.php', 1, 6, 'Historial Usuario', 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(1009, NULL, 'views/vpusu.php', 1, 7, 'Perfil Usuario', 'fa-regular fa-user', 'Perfil usuario'),
(1011, NULL, 'views/vusdatcom.php', 2, NULL, 'Pagos Usuario', NULL, 'Formas de pago y compra final'),
(1012, NULL, 'views/vusubicom.php', 2, NULL, 'Ubicacion del pedido Usuario', NULL, 'Ubicacion del pedido y compra final'),
(1013, NULL, 'views/vusconfcom.php', 2, NULL, 'Confirmacion de compras Usuario', NULL, 'Mensaje de confirmación de compra '),
(1014, NULL, 'views/vuscocgrand.php', 2, NULL, 'Detalle de producto', NULL, 'Detalle de producto'),
(2001, 'Pedidos', 'views/vexbpedproc.php', 1, 8, 'Pedidos Empleado', NULL, 'Pedidos en proceso'),
(2002, 'Ganancias', 'views/vemgan.php', 1, 9, 'Ganancias Empleado', NULL, 'Ganancias '),
(2003, '', 'views/vemhipe.php', 1, 10, 'Historial Empleado', 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(2004, '', 'views/vpemp.php', 1, 11, 'Perfil Empleado', 'fa-regular fa-user', 'Perfil empleado'),
(3001, 'Pedidos', 'views/vexbpedproc.php', 1, 12, 'Pedidos Bar', NULL, 'Pedidos en proceso'),
(3002, 'Ganancias', 'views/vbargan.php', 1, 13, 'Ganancias Bar', '', 'Ganancias por pedidos'),
(3003, 'Crear Productos', 'views/vbarxprod.php', 1, 14, 'Crear Productos Bar', NULL, 'CRUD Producto'),
(3004, 'Crear Empleados', 'views/vbarxem.php', 1, 15, 'Crear Empleados Bar', NULL, 'CRUD Empleado'),
(3005, '', 'views/vbarhipe.php', 1, 16, 'Historial Bar', 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(3006, '', 'views/vpbar.php', 1, 17, 'Perfil Bar', 'fa-regular fa-user', 'Perfil bar'),
(4010, '', 'admin/views/vdom.php', 1, 18, 'ADMIN Dominio ', 'fa-brands fa-dochub', 'Dominio y valor '),
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
(4110, NULL, 'admin/views/vubi.php', 1, NULL, 'ADMIN Ubicaciones', 'fa-solid fa-map-location-dot', 'Ubicaciones para actores');

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
(2001, 20),
(2002, 20),
(2003, 20),
(2004, 20),
(3001, 30),
(3002, 30),
(3003, 30),
(3004, 30),
(3005, 30),
(3006, 30),
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
  `idcarrito` bigint(20) NOT NULL,
  `idmetpago` tinyint(2) NOT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente',
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(40, 'ADMIN', 4010, 4010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idprod` bigint(20) NOT NULL COMMENT 'id de producto',
  `nomprod` varchar(50) DEFAULT NULL COMMENT 'nombre del producto',
  `desprod` varchar(255) DEFAULT NULL COMMENT 'descripcion del producto',
  `vlrprod` decimal(10,2) DEFAULT NULL COMMENT 'valor del producto',
  `fotprod` varchar(255) DEFAULT NULL COMMENT 'foto del producto',
  `idval` bigint(10) DEFAULT NULL COMMENT 'id del valor',
  `idbar` bigint(10) DEFAULT NULL COMMENT 'id del bar',
  `cantprod` int(8) DEFAULT NULL COMMENT 'cantidad del producto',
  `idserv` tinyint(2) DEFAULT NULL COMMENT 'id del servicio',
  `idusu` bigint(10) DEFAULT NULL COMMENT 'id de usuario',
  `tipoprod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idprod`, `nomprod`, `desprod`, `vlrprod`, `fotprod`, `idval`, `idbar`, `cantprod`, `idserv`, `idusu`, `tipoprod`) VALUES
(21, 'Cerveza Corona X6 330ml', 'Cerveza Corona NRB X6', 24600.00, '4000499c42c271523e5bc4b9b119ef0f.png', NULL, 2002, 50, NULL, NULL, 'licor'),
(22, 'Ron Cacique Añejo 750ml', 'Ron Cacique', 66900.00, 'fe879151d70cf0f62b08d8a72a7536ae.png', NULL, 2002, 50, NULL, NULL, 'licor'),
(23, 'Ron La Hechicera', 'Ron', 229900.00, '5e4cd055149e2b70270ef67fbaf30cb6.png', NULL, 2002, 50, NULL, NULL, 'licor'),
(24, 'Whisky Johnnie Walker Black Label Blended', 'Walker', 147000.00, 'a715abda12e9bbee0e2213ee63a0487c.png', NULL, 2002, 50, NULL, NULL, 'licor'),
(25, 'Crema de Whisky Baileys', 'Crema', 72000.00, '1ba8d2e9a1244bef62a26d38bfed7834.png', NULL, 2003, 50, NULL, NULL, 'licor'),
(26, 'Whisky Buchanans Special Reserve 18 Años Escocés 7', 'Whisky', 390000.00, '8ec420678643604d5113889587120fa9.png', NULL, 2003, 50, NULL, NULL, 'licor'),
(27, 'Vino Blanco Mar de Frades Albariño', 'Vino', 130200.00, '5cffd4545dabfaa781ada1e64cec3f91.png', NULL, 2003, 50, NULL, NULL, 'vino'),
(30, 'Vino Rosado Espumoso Piccini Regno Lambrusco 750ml', 'vino', 45900.00, 'a29267fbbb10d04826afbc7f679c9856.png', NULL, 2002, 50, NULL, NULL, 'vino'),
(31, 'Aperitivo Frizzantino Rosado Brut 750ml', 'vino', 25200.00, '6f592e718d717e41796741a3fc3cd642.png', NULL, 2002, 50, NULL, NULL, 'vino'),
(32, 'Vino Rosado Santa Carolina Reservado Cabernet Sauv', 'vino', 43900.00, 'd948e059d6a935d572438d6b739dd3c0.png', NULL, 2002, 50, NULL, NULL, 'vino'),
(33, 'Angel 200ml', 'coctel', 20000.00, '33a8ab3758424f4ac0f3d55b8ceec7af.png', NULL, 2002, 50, NULL, NULL, 'coctel'),
(34, 'Arrival (Espiritu Isleño)', 'coctel', 25000.00, 'd5b0bceec7137b2030b7081247ef8798.png', NULL, 2003, 50, NULL, NULL, 'coctel'),
(35, 'Black Russian 250ml', 'Coctel', 28.00, '07276a65314afcbaac014573c8b9d4f4.png', NULL, 2002, 50, NULL, NULL, 'coctel'),
(36, 'Bramble 200ml', 'coctel', 18.00, '15a38352e93759bc0ceaf1105f412cb9.png', NULL, 2003, 50, NULL, NULL, 'coctel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idserv` tinyint(2) NOT NULL COMMENT 'id de servicio',
  `nomserv` varchar(50) DEFAULT NULL COMMENT 'nombre del servicio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idserv`, `nomserv`) VALUES
(1, 'Domiciliario'),
(2, 'Bartender');

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
  `idserv` tinyint(2) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `nompropi` varchar(50) DEFAULT NULL,
  `dircbar` varchar(100) DEFAULT NULL,
  `horbar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusu`, `nomusu`, `emausu`, `celusu`, `fotiden`, `numdocu`, `fecnausu`, `pssusu`, `codubi`, `idper`, `idval`, `idserv`, `idbar`, `nompropi`, `dircbar`, `horbar`) VALUES
(1, 'Dilan Lopez', 'dilan@gmail.com', NULL, NULL, 1053, '2004-09-11', 'e5c9b13cea0a3a0e4b38f906906390d85463388a', NULL, 10, 101, NULL, NULL, NULL, NULL, NULL),
(4, 'Sebastian Martinez', 'sebas@gmail.com', NULL, NULL, 3030, NULL, '52109b25d2fba7f005f3052cad7c92a1861a48e1', NULL, 40, 101, NULL, NULL, NULL, NULL, NULL),
(5, 'Victor Cortez', 'victor@gmail.com', NULL, NULL, 4040, NULL, 'e9c2dd7a3ade9110738d897badebb8eb458920dc', NULL, 40, 101, NULL, NULL, NULL, NULL, NULL),
(2000, 'Martin Casas', 'martin@gmail.com', 3001782, NULL, 109020, '2000-11-20', '78adbe311449919b44220c57d7089ee5b8f306ad', 1, 20, 101, 1, 2002, NULL, NULL, NULL),
(2001, 'Jose', 'jose@gmail.com', 3001782, NULL, 102891, '2000-11-09', '15bb060fd110a4f67c6b5b287072524f345ec1b7', 2, 20, 101, 2, 2003, NULL, NULL, NULL),
(2002, 'Cabañas', 'caba@gmail.com', 300940912, NULL, 8029812, NULL, 'e0851d399bb2954f554d93328662c70f79273f5a', 1, 30, 102, NULL, NULL, 'Juan Martinez', 'Calle 20 #40-60 Norte', NULL),
(2003, 'Bazar', 'baz@gmail.com', 300828821, NULL, 8039923, NULL, 'a7c9f5b4f15002ac1275c418d5c77f316ae749db', 2, 30, 102, NULL, NULL, 'Jose Perez', 'Transversal 7 #30-50 ', NULL);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `after_delete_usuario` AFTER DELETE ON `usuario` FOR EACH ROW BEGIN
    -- Eliminar de la tabla empleado
    DELETE FROM empleado
    WHERE idemp = OLD.idusu;

    -- Eliminar de la tabla bar
    DELETE FROM bar
    WHERE idbar = OLD.idusu;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_usuario` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    -- Verificar el valor de idper
    IF NEW.idper = 20 THEN
        -- Insertar en la tabla empleado
        INSERT INTO empleado (
            idemp, nomemp, emaemp, celemp, fecnaemp, numdocu, fotiden, pssemp, idserv, idbar, codubi, idper, idval
        ) VALUES (
            NEW.idusu, NEW.nomusu, NEW.emausu, NEW.celusu, NEW.fecnausu, NEW.numdocu, NEW.fotiden, NEW.pssusu, NEW.idserv, NEW.idbar, NEW.codubi, NEW.idper, NEW.idval
        );
    ELSEIF NEW.idper = 30 THEN
        -- Insertar en la tabla bar
        INSERT INTO bar (
            idbar, nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, horbar, fotbar, codubi, idper, idval
        ) VALUES (
            NEW.idusu, NEW.nomusu, NEW.nompropi, NEW.numdocu, NEW.emausu, NEW.celusu, NEW.pssusu, NEW.dircbar, NEW.horbar, NEW.fotiden, NEW.codubi, NEW.idper, NEW.idval
        );
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_usuario` AFTER UPDATE ON `usuario` FOR EACH ROW BEGIN
    -- Actualizar en la tabla empleado
    UPDATE empleado
    SET 
        nomemp = NEW.nomusu,
        emaemp = NEW.emausu,
        celemp = NEW.celusu,
        fecnaemp = NEW.fecnausu,
        numdocu = NEW.numdocu,
        fotiden = NEW.fotiden,
        pssemp = NEW.pssusu,
        idserv = NEW.idserv,
        idbar = NEW.idbar,
        codubi = NEW.codubi,
        idper = NEW.idper,
        idval = NEW.idval
    WHERE idemp = OLD.idusu;

    -- Actualizar en la tabla bar
    UPDATE bar
    SET 
        nombar = NEW.nomusu,
        nompropi = NEW.nompropi,
        nit = NEW.numdocu,
        emabar = NEW.emausu,
        telbar = NEW.celusu,
        pssbar = NEW.pssusu,
        dircbar = NEW.dircbar,
        horbar = NEW.horbar,
        fotbar = NEW.fotiden,
        codubi = NEW.codubi,
        idper = NEW.idper,
        idval = NEW.idval
    WHERE idbar = OLD.idusu;
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
(102, 10, 'NIT', 1),
(103, 10, 'CE', 1);

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
-- Indices de la tabla `detfact`
--
ALTER TABLE `detfact`
  ADD PRIMARY KEY (`iddetfact`),
  ADD UNIQUE KEY `idusu` (`idusu`),
  ADD KEY `idfact` (`idfact`),
  ADD KEY `idprod` (`idprod`),
  ADD KEY `idemp` (`idemp`),
  ADD KEY `idbar` (`idbar`);

--
-- Indices de la tabla `detpedido`
--
ALTER TABLE `detpedido`
  ADD PRIMARY KEY (`iddetpedido`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idprod` (`idprod`);

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
  ADD KEY `idval` (`idval`),
  ADD KEY `idserv` (`idserv`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfact`),
  ADD KEY `idbar` (`idbar`),
  ADD KEY `factura_ibfk_2` (`idusu`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idpedido_2` (`idpedido`);

--
-- Indices de la tabla `metpago`
--
ALTER TABLE `metpago`
  ADD PRIMARY KEY (`idmetpago`);

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
  ADD KEY `idmetpago` (`idmetpago`);

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
  ADD KEY `idval` (`idval`),
  ADD KEY `idbar` (`idbar`),
  ADD KEY `idusu` (`idusu`),
  ADD KEY `idserv` (`idserv`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idserv`);

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
  ADD KEY `idserv` (`idserv`),
  ADD KEY `idserv_2` (`idserv`),
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
  MODIFY `idbar` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de bar', AUTO_INCREMENT=4008;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idcarrito` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detfact`
--
ALTER TABLE `detfact`
  MODIFY `iddetfact` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de detalle de factura', AUTO_INCREMENT=1001021;

--
-- AUTO_INCREMENT de la tabla `detpedido`
--
ALTER TABLE `detpedido`
  MODIFY `iddetpedido` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` int(4) NOT NULL AUTO_INCREMENT COMMENT 'id de dominio', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idemp` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id del empleado', AUTO_INCREMENT=2005;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfact` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de factura', AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT de la tabla `metpago`
--
ALTER TABLE `metpago`
  MODIFY `idmetpago` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id de pagina', AUTO_INCREMENT=4122;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de producto', AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idserv` tinyint(2) NOT NULL AUTO_INCREMENT COMMENT 'id de servicio', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `codubi` int(6) NOT NULL AUTO_INCREMENT COMMENT 'codigo de ubicacion', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de usuario', AUTO_INCREMENT=2004;

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
-- Filtros para la tabla `detfact`
--
ALTER TABLE `detfact`
  ADD CONSTRAINT `detfact_ibfk_1` FOREIGN KEY (`idfact`) REFERENCES `factura` (`idfact`),
  ADD CONSTRAINT `detfact_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`),
  ADD CONSTRAINT `detfact_ibfk_3` FOREIGN KEY (`idemp`) REFERENCES `empleado` (`idemp`),
  ADD CONSTRAINT `detfact_ibfk_4` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `detfact_ibfk_5` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);

--
-- Filtros para la tabla `detpedido`
--
ALTER TABLE `detpedido`
  ADD CONSTRAINT `detpedido_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`),
  ADD CONSTRAINT `detpedido_ibfk_2` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`),
  ADD CONSTRAINT `empleado_ibfk_4` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`),
  ADD CONSTRAINT `empleado_ibfk_5` FOREIGN KEY (`idserv`) REFERENCES `servicio` (`idserv`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);

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
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idcarrito`) REFERENCES `carrito` (`idcarrito`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idmetpago`) REFERENCES `metpago` (`idmetpago`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idpedido`) REFERENCES `factura` (`idpedido`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idserv`) REFERENCES `servicio` (`idserv`),
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`idserv`) REFERENCES `servicio` (`idserv`),
  ADD CONSTRAINT `usuario_ibfk_5` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
