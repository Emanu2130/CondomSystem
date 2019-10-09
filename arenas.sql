-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-04-2011 a las 19:44:38
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `arenas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes_tipos`
--

CREATE TABLE IF NOT EXISTS `comprobantes_tipos` (
  `id_comprobante` int(225) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(225) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_comprobante`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `comprobantes_tipos`
--

INSERT INTO `comprobantes_tipos` (`id_comprobante`, `nombre_tipo`, `descripcion`) VALUES
(1, 'Valor Fiscal', 'Valor Fiscal'),
(2, 'Consumidor Final', 'Consumidor Final'),
(3, 'Ninguno', 'Ninguno'),
(4, 'Recibo Simple', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_bancarias`
--

CREATE TABLE IF NOT EXISTS `cuentas_bancarias` (
  `id_banco` int(255) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(255) NOT NULL,
  `Banco` varchar(255) NOT NULL,
  `numero_cuenta` varchar(255) NOT NULL,
  `ejecutivo_cuenta` varchar(255) NOT NULL,
  `telefono_ejecutivo` varchar(255) NOT NULL,
  `tipo_cuenta` varchar(255) NOT NULL,
  `moneda` varchar(255) NOT NULL,
  `notas` text,
  PRIMARY KEY (`id_banco`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `cuentas_bancarias`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE IF NOT EXISTS `egresos` (
  `id_pago` int(255) NOT NULL AUTO_INCREMENT,
  `estado` varchar(225) NOT NULL,
  `total_rd` double NOT NULL,
  `total_us` double NOT NULL,
  `total_euros` double NOT NULL,
  `Impuestos_pagados` double NOT NULL,
  `Numero_Referencia` varchar(255) NOT NULL,
  `Comprobante_fiscal` varchar(255) NOT NULL,
  `tipo_comprobante` varchar(225) NOT NULL,
  `Metodo_pago` varchar(255) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `tipo1` varchar(255) NOT NULL,
  `notas` text,
  `Empresa` varchar(255) NOT NULL,
  `locacion` varchar(255) NOT NULL,
  `cuenta_banco` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pago`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `egresos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos_tipo1`
--

CREATE TABLE IF NOT EXISTS `egresos_tipo1` (
  `id_tipo` int(255) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Volcar la base de datos para la tabla `egresos_tipo1`
--

INSERT INTO `egresos_tipo1` (`id_tipo`, `tipo`) VALUES
(5, 'Agua potable'),
(10, 'Empleados'),
(11, 'Pagos honorarios profesionales'),
(13, 'Impuestos'),
(20, 'Motoconcho'),
(21, 'Prestamo a empleados'),
(25, 'Electricidad'),
(26, 'Telefono'),
(41, 'Caja Chica'),
(49, 'TSS'),
(56, 'Comision'),
(59, 'sistema contable'),
(60, 'Agua alcantarillado'),
(64, 'Donación y/o Ayuda'),
(107, 'Modificacion Registro Mercantil'),
(67, 'Insentivo empleado'),
(68, 'Parqueos'),
(69, 'transporte'),
(70, 'Envios de paquetes'),
(76, 'Avance trabajo'),
(77, 'Renta de vehiculo'),
(81, 'Empleados extra'),
(83, 'Viajes'),
(88, 'Regalia'),
(94, 'Pagina web'),
(100, 'Celulares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(255) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(255) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `Posicion` varchar(225) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `ultimas_vacaciones` varchar(255) NOT NULL,
  `proximas_vacaciones` varchar(255) NOT NULL,
  `salario_mensual` double NOT NULL,
  `salario_quincenal` double NOT NULL,
  `deducible_afp` double NOT NULL,
  `deducible_sf` double NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `empleados`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `rnc` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `empresas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE IF NOT EXISTS `ingresos` (
  `id_ingreso` int(25) NOT NULL AUTO_INCREMENT,
  `tipo_ingreso` int(255) NOT NULL,
  `estado` varchar(225) NOT NULL,
  `Numero_Factura` varchar(25) NOT NULL,
  `Fecha_Factura` date NOT NULL,
  `Fecha_Dep` date NOT NULL,
  `Descripcion` text NOT NULL,
  `Valor_RD` double NOT NULL,
  `Valor_US` double NOT NULL,
  `Valor_Euros` double NOT NULL,
  `Valor_Tarjeta_credito` double NOT NULL,
  `NCF` varchar(255) NOT NULL,
  `tipo_comprobante` varchar(225) NOT NULL,
  `Empresa` varchar(255) NOT NULL,
  `locacion` varchar(255) NOT NULL,
  `proveedor` varchar(225) DEFAULT NULL,
  `cuenta_banco` varchar(225) NOT NULL,
  PRIMARY KEY (`id_ingreso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `ingresos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_tipos`
--

CREATE TABLE IF NOT EXISTS `ingresos_tipos` (
  `id_ingresos` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ingresos`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `ingresos_tipos`
--

INSERT INTO `ingresos_tipos` (`id_ingresos`, `nombre`) VALUES
(1, 'Venta'),
(8, 'Honorarios'),
(7, 'Reembolso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locaciones`
--

CREATE TABLE IF NOT EXISTS `locaciones` (
  `id_locacion` int(255) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `notas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_locacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `locaciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE IF NOT EXISTS `metodos_pago` (
  `id_metodo` int(255) NOT NULL AUTO_INCREMENT,
  `metodo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_metodo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_metodo`, `metodo`) VALUES
(1, 'Cheque'),
(2, 'Efectivo'),
(3, 'Deposito'),
(4, 'Transferencia'),
(5, 'Tarjeta de credito'),
(6, 'Tarjeta de debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE IF NOT EXISTS `nomina` (
  `id_nomina` int(225) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(225) NOT NULL,
  `empleado` int(225) NOT NULL,
  `monto_pago` double NOT NULL,
  `deducible_afp` double NOT NULL,
  `deducible_sf` double NOT NULL,
  `fecha` date NOT NULL,
  `notas` varchar(225) NOT NULL,
  PRIMARY KEY (`id_nomina`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `nomina`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `rnc_cedula` varchar(255) NOT NULL,
  `telefonos` varchar(255) NOT NULL,
  `notas` text,
  `Empresa` varchar(255) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `proveedores`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `user_id` int(25) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) NOT NULL,
  `clave` varchar(25) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `usuario`, `clave`, `Nombre`) VALUES
(4, 'admin', 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
