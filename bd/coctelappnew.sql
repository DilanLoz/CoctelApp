-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 04:45:29
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
-- Base de datos: `coctel`
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
  `codubi` int(6) DEFAULT NULL COMMENT 'código de ubicacion',
  `idper` bigint(10) NOT NULL COMMENT 'id del perfil',
  `idval` bigint(10) NOT NULL COMMENT 'id del valor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bar`
--

INSERT INTO `bar` (`idbar`, `nombar`, `nompropi`, `nit`, `emabar`, `telbar`, `pssbar`, `dircbar`, `codubi`, `idper`, `idval`) VALUES
(2, 'Bazzar', 'Mateo', 211312, 'baz@gmail.com', 21312312, 'bazz', '', 1, 30, 102),
(3, 'Mar', 'Martin', 12123, 'mar@gmail.com', 2312321, '', '', 1, 30, 102),
(8, 'bazbar', '', 9000, 'baz@gmail.com', 32010, 'baz123', '', 2, 30, 102);

--
-- Disparadores `bar`
--
DELIMITER $$
CREATE TRIGGER `after_delete_bar` AFTER DELETE ON `bar` FOR EACH ROW BEGIN
    DELETE FROM usuario
    WHERE idusu = OLD.idbar;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_bar` AFTER INSERT ON `bar` FOR EACH ROW BEGIN
    -- Insertar en la tabla usuario cuando se inserte un nuevo bar
    INSERT INTO usuario (idusu, nomusu, emausu, numdocu, celusu, fecnausu, pssusu, codubi, idval, idper)
    VALUES (NEW.idbar, NEW.nombar, NEW.emabar, NEW.nit, NEW.nit, NULL, NEW.pssbar, NEW.codubi, NEW.idval, 30);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_bar` AFTER UPDATE ON `bar` FOR EACH ROW BEGIN
    UPDATE usuario
    SET 
        nomusu = NEW.nombar,
        emausu = NEW.emabar,
        numdocu = NEW.nit,  -- Asumiendo que `nit` en `bar` corresponde a `numdocu` en `usuario`
        celusu = NEW.telbar,
        codubi = NEW.codubi,
        idval = NEW.idval,
        pssusu = NEW.pssbar
    WHERE idusu = NEW.idbar;
END
$$
DELIMITER ;

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
  `cantidad` int(8) DEFAULT NULL COMMENT 'cantidad de productos',
  `precio_unitario` decimal(10,2) DEFAULT NULL COMMENT 'precio por producto',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'subtotal del pedido',
  `idemp` bigint(10) DEFAULT NULL COMMENT 'id del empleado',
  `idbar` bigint(10) NOT NULL COMMENT 'id del bar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detfact`
--

INSERT INTO `detfact` (`iddetfact`, `idfact`, `idprod`, `cantidad`, `precio_unitario`, `subtotal`, `idemp`, `idbar`) VALUES
(1, 1, 2, 2, 80.00, 80.00, 2, 2);

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
(2, 'Jose', 'Martin', 1212, '2004-08-01', 123123, '', '', 1, 2, 1, 20, 101),
(7, 'juan', 'juan@gmail.com', 3002020, '2016-11-09', 10900, NULL, 'juan123', 1, 2, 1, 20, 101);

--
-- Disparadores `empleado`
--
DELIMITER $$
CREATE TRIGGER `after_delete_empleado` AFTER DELETE ON `empleado` FOR EACH ROW BEGIN
    DELETE FROM usuario
    WHERE idusu = OLD.idemp;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_empleado` AFTER INSERT ON `empleado` FOR EACH ROW BEGIN
    -- Insertar en la tabla usuario cuando se inserte un nuevo empleado
    INSERT INTO usuario (idusu, nomusu, emausu, numdocu, celusu, fecnausu, pssusu, codubi, idval, idper)
    VALUES (NEW.idemp, NEW.nomemp, NEW.emaemp, NEW.numdocu, NEW.celemp, NEW.fecnaemp, NEW.pssemp, NEW.codubi, NEW.idval, 20);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_empleado` AFTER UPDATE ON `empleado` FOR EACH ROW BEGIN
    UPDATE usuario
    SET 
        nomusu = NEW.nomemp,
        emausu = NEW.emaemp,
        numdocu = NEW.numdocu,
        celusu = NEW.celemp,
        fecnausu = NEW.fecnaemp,
        pssusu = NEW.pssemp,
        codubi = NEW.codubi
    WHERE idusu = NEW.idemp;
END
$$
DELIMITER ;

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
(1, 0, '2024-08-22', 2, 200.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metpago`
--

CREATE TABLE `metpago` (
  `idmetpago` tinyint(2) NOT NULL,
  `nommetpago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metpago`
--

INSERT INTO `metpago` (`idmetpago`, `nommetpago`) VALUES
(1, 'TARJETA DEBITO'),
(2, 'PSE'),
(3, 'CONTRA ENTREGA');

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
  `icopag` varchar(50) DEFAULT NULL COMMENT 'icono de la pagina',
  `despag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`idpag`, `nompag`, `rutpag`, `mospag`, `ordpag`, `icopag`, `despag`) VALUES
(1002, 'Bares', 'views/vusbares.php', 1, 1, NULL, 'Vista bares'),
(1004, 'Cócteles', 'views/vuscoct.php', 1, 2, NULL, 'Vista Cocteles'),
(1005, 'Vinos', 'views/vusvino.php', 1, 3, NULL, 'Vista Vinos'),
(1006, 'Licores', 'views/vuslicor.php', 1, 4, NULL, 'Vista Licores'),
(1007, '', 'views/vuscarcomp.php', 1, 7, 'fa-solid fa-cart-shopping', 'Carrito de compras'),
(1008, '', 'views/vushipe.php', 1, 5, 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(1009, NULL, 'views/vpusu.php', 1, NULL, 'fa-regular fa-user', 'Perfil usuario'),
(2001, 'Pedidos', 'views/vexbpedproc.php', 1, 1, NULL, 'Pedidos en proceso'),
(2002, 'Ganancias', 'views/vemgan.php', 1, 2, NULL, 'Ganancias '),
(2003, '', 'views/vemhipe.php', 1, 3, 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(2004, '', 'views/vpemp.php', 1, 4, 'fa-regular fa-user', 'Perfil empleado'),
(3001, 'Pedidos', 'views/vexbpedproc.php', 1, 1, NULL, 'Pedidos en proceso'),
(3002, 'Ganancias', 'views/vemgan.php', 1, 2, '', 'Ganancias por pedidos'),
(3003, 'Crear Productos', 'views/vbarxprod.php', 1, 3, NULL, 'CRUD Producto'),
(3004, 'Crear Empleados', 'views/vbarxem.php', 1, 4, NULL, 'CRUD Empleado'),
(3005, '', 'views/vbarhipe.php', 1, 5, 'fa-solid fa-clipboard-list', 'Historial de pedidos'),
(3006, '', 'views/vpbar.php', 1, 6, 'fa-regular fa-user', 'Perfil bar');

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
(2001, 20),
(2002, 20),
(2003, 20),
(2004, 20),
(3001, 30),
(3002, 30),
(3003, 30),
(3004, 30),
(3005, 30),
(3006, 30);

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
  `pagini` bigint(10) NOT NULL COMMENT 'pagina inicial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idper`, `nomper`, `pagini`) VALUES
(10, 'usuarios', 1002),
(20, 'empleados', 2001),
(30, 'bares', 3001);

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
  `idusu` bigint(10) DEFAULT NULL COMMENT 'id de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idprod`, `nomprod`, `desprod`, `vlrprod`, `fotprod`, `idval`, `idbar`, `cantprod`, `idserv`, `idusu`) VALUES
(2, 'Ron', 'Ron caldas', 40.00, '', 104, 2, 222, 1, 1),
(3, 'Coctel Fresco', 'Coctel fresco de frutas y soda', 12000.00, NULL, NULL, NULL, 30, NULL, NULL),
(4, 'Coctel Fresco', 'Coctel fresco de frutas y soda', 12000.00, NULL, NULL, NULL, 30, NULL, NULL),
(5, 'Coctel Bueno', 'Bueno', 20000.00, NULL, NULL, NULL, 30, NULL, NULL),
(6, 'Coctel Muy Fresco', 'fresco', 18000.00, NULL, NULL, NULL, 20, NULL, NULL);

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
(1, 'domicilio');

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
(1, 'bogota', 'bogota'),
(2, 'medellin', 'antioquia ');

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
  `idval` bigint(10) NOT NULL COMMENT 'id valor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusu`, `nomusu`, `emausu`, `celusu`, `fotiden`, `numdocu`, `fecnausu`, `pssusu`, `codubi`, `idper`, `idval`) VALUES
(1, 'Dilan Lopez', 'dilan@gmail.com', NULL, NULL, 1053, '2004-09-11', 'e5c9b13cea0a3a0e4b38f906906390d85463388a', NULL, 10, 101),
(2, 'Felipe Arias', 'felipe@gmail.com', NULL, NULL, 1010, NULL, 'b5d1ce5349055ec47461f33bffd2fe17ba85a658', NULL, 20, 101),
(3, 'Daniel Felipe', 'daniel@gmail.com', NULL, NULL, 2020, NULL, 'e11843ffa9c0dee79882cca1d8213b774a701835', NULL, 30, 101),
(4, 'Sebastian Martinez', 'sebas@gmail.com', NULL, NULL, 3030, NULL, '52109b25d2fba7f005f3052cad7c92a1861a48e1', NULL, 10, 101),
(5, 'Victor Cortez', 'victor@gmail.com', NULL, NULL, 4040, NULL, 'e9c2dd7a3ade9110738d897badebb8eb458920dc', NULL, 10, 101),
(7, 'juan', 'juan@gmail.com', 3002020, NULL, 10900, '2016-11-09', 'juan123', 1, 20, 101),
(8, 'bazbar', 'baz@gmail.com', 9000, NULL, 9000, NULL, 'baz123', 2, 30, 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `idval` bigint(10) NOT NULL COMMENT 'id de valor',
  `iddom` int(4) DEFAULT NULL COMMENT 'id de dominio',
  `nomval` varchar(50) DEFAULT NULL COMMENT 'nombre del valor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor`
--

INSERT INTO `valor` (`idval`, `iddom`, `nomval`) VALUES
(101, 10, 'CC'),
(102, 10, 'NIT'),
(103, 10, 'CE'),
(104, 20, 'Licores');

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
  ADD KEY `idval` (`idval`);

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
  MODIFY `idbar` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de bar', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idcarrito` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detfact`
--
ALTER TABLE `detfact`
  MODIFY `iddetfact` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de detalle de factura', AUTO_INCREMENT=2;

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
  MODIFY `idemp` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id del empleado', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfact` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de factura', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `metpago`
--
ALTER TABLE `metpago`
  MODIFY `idmetpago` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id de pagina', AUTO_INCREMENT=3007;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id de producto', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idserv` tinyint(2) NOT NULL AUTO_INCREMENT COMMENT 'id de servicio', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `codubi` int(6) NOT NULL AUTO_INCREMENT COMMENT 'codigo de ubicacion', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'id de usuario', AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `detfact_ibfk_4` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

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
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
