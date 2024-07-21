-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2024 a las 19:54:30
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
  `idbar` bigint(10) NOT NULL,
  `nombar` varchar(100) DEFAULT NULL,
  `nit` bigint(10) NOT NULL,
  `emabar` varchar(100) DEFAULT NULL,
  `telbar` int(12) DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL,
  `idper` bigint(10) NOT NULL,
  `idval` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detfact`
--

CREATE TABLE `detfact` (
  `iddetfact` bigint(20) NOT NULL,
  `idfact` bigint(20) NOT NULL,
  `idprod` bigint(20) DEFAULT NULL,
  `cantidad` int(8) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `idemp` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddom` int(4) NOT NULL,
  `nomdom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idemp` bigint(10) NOT NULL,
  `nomemp` varchar(100) DEFAULT NULL,
  `emaemp` varchar(255) DEFAULT NULL,
  `celemp` int(10) DEFAULT NULL,
  `fecnaemp` date DEFAULT NULL,
  `numdocu` bigint(10) NOT NULL,
  `fotiden` varchar(255) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL,
  `idper` bigint(10) NOT NULL,
  `idval` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfact` bigint(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `idpag` int(5) NOT NULL,
  `nompag` varchar(255) DEFAULT NULL,
  `rutpag` varchar(255) DEFAULT NULL,
  `mospag` tinyint(1) DEFAULT NULL,
  `ordpag` int(5) DEFAULT NULL,
  `icopag` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagper`
--

CREATE TABLE `pagper` (
  `idpag` int(5) NOT NULL,
  `idper` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idper` bigint(10) NOT NULL,
  `nomper` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idprod` bigint(20) NOT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  `desprod` varchar(255) DEFAULT NULL,
  `vlrprod` decimal(10,2) DEFAULT NULL,
  `fotprod` varchar(255) DEFAULT NULL,
  `idval` bigint(10) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `cantprod` int(8) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idserv` tinyint(2) NOT NULL,
  `nomserv` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `codubi` int(6) NOT NULL,
  `nomubi` varchar(255) DEFAULT NULL,
  `depubi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusu` bigint(10) NOT NULL,
  `nomusu` varchar(150) DEFAULT NULL,
  `emausu` varchar(100) DEFAULT NULL,
  `celusu` int(10) DEFAULT NULL,
  `fotiden` varchar(255) DEFAULT NULL,
  `numdocu` bigint(10) NOT NULL,
  `fecnausu` date DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL,
  `idper` bigint(10) NOT NULL,
  `idval` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `idval` bigint(10) NOT NULL,
  `iddom` int(4) DEFAULT NULL,
  `nomval` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indices de la tabla `detfact`
--
ALTER TABLE `detfact`
  ADD PRIMARY KEY (`iddetfact`),
  ADD KEY `idfact` (`idfact`),
  ADD KEY `idprod` (`idprod`),
  ADD KEY `idemp` (`idemp`);

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
  ADD KEY `idbar` (`idbar`),
  ADD KEY `factura_ibfk_2` (`idusu`);

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
  ADD KEY `idusu` (`idusu`);

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
  MODIFY `idbar` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detfact`
--
ALTER TABLE `detfact`
  MODIFY `iddetfact` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idemp` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfact` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `codubi` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `idval` bigint(10) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `detfact`
--
ALTER TABLE `detfact`
  ADD CONSTRAINT `detfact_ibfk_1` FOREIGN KEY (`idfact`) REFERENCES `factura` (`idfact`),
  ADD CONSTRAINT `detfact_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`),
  ADD CONSTRAINT `detfact_ibfk_3` FOREIGN KEY (`idemp`) REFERENCES `empleado` (`idemp`);

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
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);

--
-- Filtros para la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD CONSTRAINT `pagper_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pagina` (`idpag`),
  ADD CONSTRAINT `pagper_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idval`) REFERENCES `valor` (`idval`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

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
