-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2024 a las 23:25:07
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
  `nit` int(10) DEFAULT NULL,
  `emabar` varchar(100) DEFAULT NULL,
  `telbar` int(12) DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detpedido`
--

CREATE TABLE `detpedido` (
  `idfact` bigint(20) DEFAULT NULL,
  `idprod` bigint(20) DEFAULT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  `virprod` bigint(11) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL,
  `nomusu` varchar(150) DEFAULT NULL,
  `celusu` int(10) DEFAULT NULL,
  `ubixped` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detpedxfact`
--

CREATE TABLE `detpedxfact` (
  `idfact` bigint(20) DEFAULT NULL,
  `idemp` bigint(10) DEFAULT NULL,
  `idprod` bigint(20) DEFAULT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  `virprod` bigint(11) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL,
  `nomusu` varchar(150) DEFAULT NULL,
  `celusu` int(10) DEFAULT NULL,
  `ubixped` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddom` int(4) NOT NULL,
  `nomdom` text DEFAULT NULL
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
  `tipdocu` int(15) DEFAULT NULL,
  `fotiden` varchar(255) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfact` bigint(20) NOT NULL,
  `fecfact` date DEFAULT NULL,
  `idprod` bigint(20) DEFAULT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  `virprod` bigint(11) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL,
  `nomusu` varchar(150) DEFAULT NULL,
  `celusu` int(10) DEFAULT NULL,
  `nomubi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `idpag` int(5) DEFAULT NULL,
  `nompag` varchar(255) DEFAULT NULL,
  `rutpag` varchar(255) DEFAULT NULL,
  `mospag` tinyint(1) DEFAULT NULL,
  `ordpag` int(5) DEFAULT NULL,
  `icopag` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idper` bigint(10) NOT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `idemp` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idprod` bigint(20) NOT NULL,
  `nomprod` varchar(50) DEFAULT NULL,
  `desprod` varchar(255) DEFAULT NULL,
  `virprod` bigint(11) DEFAULT NULL,
  `fotprod` varchar(255) DEFAULT NULL,
  `idcate` bigint(20) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `cantprod` int(8) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `idserv` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pxp`
--

CREATE TABLE `pxp` (
  `idpag` int(5) NOT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `idemp` bigint(10) DEFAULT NULL,
  `idbar` bigint(10) DEFAULT NULL,
  `idper` bigint(10) DEFAULT NULL
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
  `tipdocu` int(20) DEFAULT NULL,
  `fecnausu` date DEFAULT NULL,
  `codubi` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `idcate` bigint(20) NOT NULL,
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
  ADD KEY `nombar` (`nombar`,`telbar`,`codubi`),
  ADD KEY `codubi` (`codubi`);

--
-- Indices de la tabla `detpedido`
--
ALTER TABLE `detpedido`
  ADD KEY `idfact` (`idfact`,`idprod`,`nomprod`,`virprod`,`idserv`,`nomusu`,`celusu`,`ubixped`),
  ADD KEY `idprod` (`idprod`);

--
-- Indices de la tabla `detpedxfact`
--
ALTER TABLE `detpedxfact`
  ADD KEY `idfact` (`idfact`,`idemp`,`idprod`,`nomprod`,`virprod`,`idserv`,`nomusu`,`celusu`,`ubixped`),
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
  ADD UNIQUE KEY `tipdocu` (`tipdocu`),
  ADD KEY `nomemp` (`nomemp`,`celemp`,`idserv`,`idbar`,`codubi`),
  ADD KEY `codubi` (`codubi`),
  ADD KEY `idserv` (`idserv`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfact`),
  ADD KEY `idprod` (`idprod`,`nomprod`,`virprod`,`idserv`,`nomusu`,`celusu`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD KEY `idpag` (`idpag`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idper`),
  ADD KEY `idusu` (`idusu`,`idbar`,`idemp`),
  ADD KEY `idbar` (`idbar`),
  ADD KEY `idemp` (`idemp`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idprod`),
  ADD KEY `idcate` (`idcate`),
  ADD KEY `nomprod` (`nomprod`,`desprod`,`virprod`,`idbar`,`cantprod`,`idusu`,`idserv`),
  ADD KEY `idusu` (`idusu`),
  ADD KEY `idserv` (`idserv`),
  ADD KEY `idbar` (`idbar`);

--
-- Indices de la tabla `pxp`
--
ALTER TABLE `pxp`
  ADD PRIMARY KEY (`idpag`),
  ADD KEY `idusu` (`idusu`,`idemp`,`idbar`,`idper`),
  ADD KEY `idper` (`idper`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idserv`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`codubi`),
  ADD KEY `depubi` (`depubi`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusu`),
  ADD KEY `nomusu` (`nomusu`,`celusu`,`codubi`),
  ADD KEY `codubi` (`codubi`);

--
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`idcate`),
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
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `idper` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pxp`
--
ALTER TABLE `pxp`
  MODIFY `idpag` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idserv` tinyint(2) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idcate` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bar`
--
ALTER TABLE `bar`
  ADD CONSTRAINT `bar_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`);

--
-- Filtros para la tabla `detpedido`
--
ALTER TABLE `detpedido`
  ADD CONSTRAINT `detpedido_ibfk_1` FOREIGN KEY (`idfact`) REFERENCES `factura` (`idfact`),
  ADD CONSTRAINT `detpedido_ibfk_2` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`);

--
-- Filtros para la tabla `detpedxfact`
--
ALTER TABLE `detpedxfact`
  ADD CONSTRAINT `detpedxfact_ibfk_1` FOREIGN KEY (`idemp`) REFERENCES `empleado` (`idemp`),
  ADD CONSTRAINT `detpedxfact_ibfk_2` FOREIGN KEY (`idfact`) REFERENCES `factura` (`idfact`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idserv`) REFERENCES `servicio` (`idserv`);

--
-- Filtros para la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD CONSTRAINT `pagina_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pxp` (`idpag`);

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `perfiles_ibfk_2` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`),
  ADD CONSTRAINT `perfiles_ibfk_3` FOREIGN KEY (`idemp`) REFERENCES `empleado` (`idemp`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcate`) REFERENCES `valor` (`idcate`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idserv`) REFERENCES `servicio` (`idserv`),
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`idbar`) REFERENCES `bar` (`idbar`);

--
-- Filtros para la tabla `pxp`
--
ALTER TABLE `pxp`
  ADD CONSTRAINT `pxp_ibfk_1` FOREIGN KEY (`idper`) REFERENCES `perfiles` (`idper`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
