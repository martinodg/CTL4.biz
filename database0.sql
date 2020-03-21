-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Mar 11, 2020 at 02:50 PM
-- Server version: 10.4.11-MariaDB-1:10.4.11+maria~bionic
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5346465f6a756c696a75373740676d61696c2e636f6d`
--

-- --------------------------------------------------------

--
-- Table structure for table `albalinea`
--

CREATE TABLE `albalinea` (
  `codalbaran` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albalineap`
--

CREATE TABLE `albalineap` (
  `codalbaran` int(10) NOT NULL DEFAULT 0,
  `codproveedor` int(5) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albalineaptmp`
--

CREATE TABLE `albalineaptmp` (
  `codalbaran` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albalineatmp`
--

CREATE TABLE `albalineatmp` (
  `codalbaran` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albaranes`
--

CREATE TABLE `albaranes` (
  `codalbaran` int(11) NOT NULL,
  `codfactura` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `iva` tinyint(4) NOT NULL DEFAULT 0,
  `codcliente` int(5) DEFAULT 0,
  `estado` varchar(1) CHARACTER SET utf8 DEFAULT '1',
  `totalalbaran` float NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albaranesp`
--

CREATE TABLE `albaranesp` (
  `codalbaran` int(5) NOT NULL DEFAULT 0,
  `codproveedor` int(5) NOT NULL DEFAULT 0,
  `codfactura` int(20) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `iva` tinyint(4) NOT NULL DEFAULT 0,
  `estado` varchar(1) DEFAULT '1',
  `totalalbaran` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albaranesptmp`
--

CREATE TABLE `albaranesptmp` (
  `codalbaran` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Temporal de albaranes de proveedores para controlar acceso s';

-- --------------------------------------------------------

--
-- Table structure for table `albaranestmp`
--

CREATE TABLE `albaranestmp` (
  `codalbaran` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `codarticulo` int(10) NOT NULL,
  `codfamilia` int(5) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `impuesto` float NOT NULL,
  `codproveedor1` int(5) NOT NULL DEFAULT 1,
  `codproveedor2` int(5) NOT NULL,
  `descripcion_corta` varchar(30) NOT NULL,
  `codubicacion` int(3) NOT NULL,
  `stock` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL,
  `stock_minimo` decimal(6,2) NOT NULL,
  `codumstock_minimo` int(5) NOT NULL,
  `aviso_minimo` varchar(1) NOT NULL DEFAULT '0',
  `datos_producto` varchar(200) NOT NULL,
  `fecha_alta` date NOT NULL DEFAULT '0000-00-00',
  `codembalaje` int(3) NOT NULL,
  `unidades_caja` int(8) NOT NULL,
  `codumunidades_caja` int(5) NOT NULL,
  `precio_ticket` varchar(1) NOT NULL DEFAULT '0',
  `modificar_ticket` varchar(1) NOT NULL DEFAULT '0',
  `observaciones` text NOT NULL,
  `precio_compra` float(10,2) DEFAULT NULL,
  `precio_almacen` float(10,2) DEFAULT NULL,
  `precio_tienda` float(10,2) DEFAULT NULL,
  `precio_pvp` float(10,2) DEFAULT NULL,
  `precio_iva` float(10,2) DEFAULT NULL,
  `codigobarras` varchar(15) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Articulos';

--
-- Dumping data for table `articulos`
--



--
-- Table structure for table `artpro`
--

CREATE TABLE `artpro` (
  `codarticulo` varchar(15) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `codbatch` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` int(8) NOT NULL,
  `fechai` date NOT NULL,
  `horai` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `fechaf` date NOT NULL,
  `horaf` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `batch`
--



-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `codcliente` int(5) NOT NULL,
  `Pais` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nif` varchar(12) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL DEFAULT 0,
  `localidad` varchar(35) NOT NULL,
  `codformapago` int(2) NOT NULL DEFAULT 0,
  `codentidad` int(2) NOT NULL DEFAULT 0,
  `cuentabancaria` varchar(20) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `web` varchar(45) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Clientes';

--
-- Dumping data for table `clientes`
--


-- --------------------------------------------------------

--
-- Table structure for table `cobros`
--

CREATE TABLE `cobros` (
  `id` int(11) NOT NULL,
  `codfactura` int(11) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `importe` float NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechacobro` date NOT NULL DEFAULT '0000-00-00',
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cobros de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `company_data`
--

CREATE TABLE `company_data` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(60) NOT NULL,
  `contact_telephone` varchar(20) NOT NULL,
  `main_email` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `language` varchar(40) NOT NULL,
  `address` varchar(80) NOT NULL,
  `zip_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `embalajes`
--

CREATE TABLE `embalajes` (
  `codembalaje` int(3) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Embalajes';

--
-- Dumping data for table `embalajes`
--



-- --------------------------------------------------------

--
-- Table structure for table `entidades`
--

CREATE TABLE `entidades` (
  `codentidad` int(2) NOT NULL,
  `nombreentidad` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidades Bancarias';

-- --------------------------------------------------------

--
-- Table structure for table `estaciones`
--

CREATE TABLE `estaciones` (
  `codestacion` int(5) NOT NULL,
  `nombre` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `estaciones`
--



-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `codestado` int(1) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`codestado`, `estado`) VALUES
(1, 'initializated'),
(2, 'ended'),
(3, 'dischard'),
(4, 'activated'),
(5, 'deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `factulinea`
--

CREATE TABLE `factulinea` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `factulineap`
--

CREATE TABLE `factulineap` (
  `codfactura` varchar(20) NOT NULL DEFAULT '',
  `codproveedor` int(5) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `factulineaptmp`
--

CREATE TABLE `factulineaptmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores temporal';

-- --------------------------------------------------------

--
-- Table structure for table `factulineatmp`
--

CREATE TABLE `factulineatmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Temporal de linea de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `estado` varchar(1) NOT NULL DEFAULT '0',
  `totalfactura` float NOT NULL,
  `fechavencimiento` date NOT NULL DEFAULT '0000-00-00',
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='facturas de ventas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `facturasp`
--

CREATE TABLE `facturasp` (
  `codfactura` varchar(20) NOT NULL DEFAULT '',
  `codproveedor` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `estado` varchar(1) NOT NULL DEFAULT '0',
  `totalfactura` float NOT NULL,
  `fechapago` date NOT NULL DEFAULT '0000-00-00',
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='facturas de compras a proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `facturasptmp`
--

CREATE TABLE `facturasptmp` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas de proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `facturastmp`
--

CREATE TABLE `facturastmp` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `familias`
--

CREATE TABLE `familias` (
  `codfamilia` int(5) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='familia de articulos';

--
-- Dumping data for table `familias`
--
INSERT INTO `familias` (`codfamilia`, `nombre`, `borrado`) VALUES
(1, 'Raw material', '0'),
(2, 'Intermediat product', '0'),
(3, 'Final porduct', '0');

-- --------------------------------------------------------

--
-- Table structure for table `formapago`
--

CREATE TABLE `formapago` (
  `codformapago` int(2) NOT NULL,
  `nombrefp` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Forma de pago';

--
-- Dumping data for table `formapago`
--

INSERT INTO `formapago` (`codformapago`, `nombrefp`, `borrado`) VALUES
(1, 'Cash', '0'),
(2, 'Credit Card', '0'),
(3, 'Bank transaction', '0'),
(4, 'Cheques', '0'),
(5, 'Bitcoins', '1');

-- --------------------------------------------------------

--
-- Table structure for table `impuestos`
--

CREATE TABLE `impuestos` (
  `codimpuesto` int(3) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `valor` float NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tipos de impuestos';

--
-- Dumping data for table `impuestos`
--



-- --------------------------------------------------------

--
-- Table structure for table `librodiario`
--

CREATE TABLE `librodiario` (
  `id` int(8) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `tipodocumento` varchar(1) NOT NULL,
  `coddocumento` varchar(20) NOT NULL,
  `codcomercial` int(5) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numpago` varchar(30) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Movimientos diarios';

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--

CREATE TABLE `lote` (
  `codlote` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` int(8) DEFAULT NULL,
  `fechai` date NOT NULL,
  `horai` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `fechaf` date DEFAULT NULL,
  `horaf` varchar(8) COLLATE latin1_spanish_ci DEFAULT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metaprocesos`
--

CREATE TABLE `metaprocesos` (
  `codproceso` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `esbatch` int(1) NOT NULL,
  `cantidad` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL,
  `codstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `metaprocesos`
--



-- --------------------------------------------------------

--
-- Table structure for table `metaprocesoslinea`
--

CREATE TABLE `metaprocesoslinea` (
  `codrecord` int(11) NOT NULL,
  `codproceso` int(5) NOT NULL,
  `codlinea` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `metaprocesoslinea`
--


-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `codfactura` varchar(20) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `importe` float NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechapago` date DEFAULT '0000-00-00',
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pagos de facturas a proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE `pais` (
  `codPais` int(5) NOT NULL,
  `lengua` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombrePais` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`codPais`, `lengua`, `nombrePais`, `borrado`) VALUES
(1, 'Spanish', 'Argentina', '0'),
(2, 'Spanish', 'Spain', '0'),
(3, 'English', 'United States of America', '0');

-- --------------------------------------------------------

--
-- Table structure for table `presulinea`
--

CREATE TABLE `presulinea` (
  `codpresupuesto` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presulineatmp`
--

CREATE TABLE `presulineatmp` (
  `codpresupuesto` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presupuestos`
--

CREATE TABLE `presupuestos` (
  `codpresupuesto` int(11) NOT NULL,
  `codfactura` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `iva` tinyint(4) NOT NULL DEFAULT 0,
  `codcliente` int(5) DEFAULT 0,
  `estado` varchar(1) CHARACTER SET utf8 DEFAULT '1',
  `totalpresupuesto` float NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presupuestostmp`
--

CREATE TABLE `presupuestostmp` (
  `codpresupuesto` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';

-- --------------------------------------------------------

--
-- Table structure for table `procesos`
--

CREATE TABLE `procesos` (
  `codproceso` int(5) NOT NULL,
  `codmproceso` int(35) NOT NULL,
  `bolasoc` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `codunidadmedida` int(2) NOT NULL,
  `fechai` date NOT NULL,
  `horai` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `horaf` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `fechaf` date NOT NULL,
  `codestacion` int(5) NOT NULL,
  `codtrabajador` int(5) NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `procesos`
--


-- --------------------------------------------------------

--
-- Table structure for table `proclinea`
--

CREATE TABLE `proclinea` (
  `codproclinea` int(5) NOT NULL,
  `codproceso` int(5) NOT NULL,
  `codlinea` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proclinea`
--


-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `codproveedor` int(5) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nif` varchar(12) NOT NULL,
  `codpais` int(3) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL,
  `localidad` varchar(35) NOT NULL,
  `codentidad` int(2) NOT NULL,
  `cuentabancaria` varchar(20) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `web` varchar(45) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Proveedores';

--
-- Dumping data for table `proveedores`
--



--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `codprovincia` int(2) NOT NULL,
  `codpais` int(3) NOT NULL,
  `stateCode` varchar(4) NOT NULL,
  `nombreprovincia` varchar(40) NOT NULL,
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias';

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`codprovincia`, `codpais`, `stateCode`, `nombreprovincia`, `region`) VALUES
(1, 2, '', 'Alava', ''),
(2, 2, '', 'Albacete', ''),
(3, 2, '', 'Alicante', ''),
(4, 2, '', 'Almeria', ''),
(5, 2, '', 'Asturias', ''),
(6, 2, '', 'Avila', ''),
(7, 2, '', 'Badajoz', ''),
(8, 2, '', 'Baleares', ''),
(9, 2, '', 'Barcelona', ''),
(10, 2, '', 'Burgos', ''),
(11, 2, '', 'Caceres', ''),
(12, 2, '', 'Cadiz', ''),
(13, 2, '', 'Cantabria', ''),
(14, 2, '', 'Castellon', ''),
(15, 2, '', 'Ceuta', ''),
(16, 2, '', 'Ciudad Real', ''),
(17, 2, '', 'Cordoba', ''),
(18, 2, '', 'La Coru?a', ''),
(19, 2, '', 'Cuenca', ''),
(20, 2, '', 'Gerona', ''),
(21, 2, '', 'Granada', ''),
(22, 2, '', 'Guadalajara', ''),
(23, 2, '', 'Guipuzcoa', ''),
(24, 2, '', 'Huelva', ''),
(25, 2, '', 'Huesca', ''),
(26, 2, '', 'Jaen', ''),
(27, 2, '', 'Leon', ''),
(28, 2, '', 'Lerida', ''),
(29, 2, '', 'Lugo', ''),
(30, 2, '', 'Madrid', ''),
(31, 2, '', 'Malaga', ''),
(32, 2, '', 'Melilla', ''),
(33, 2, '', 'Murcia', ''),
(34, 2, '', 'Navarra', ''),
(35, 2, '', 'Orense', ''),
(36, 2, '', 'Palencia', ''),
(37, 2, '', 'Las Palmas', ''),
(38, 2, '', 'Pontevedra', ''),
(39, 2, '', 'La Rioja', ''),
(40, 2, '', 'Salamanca', ''),
(41, 2, '', 'Sta. Cruz de Tenerife', ''),
(42, 2, '', 'Segovia', ''),
(43, 2, '', 'Sevilla', ''),
(44, 2, '', 'Soria', ''),
(45, 2, '', 'Tarragona', ''),
(46, 2, '', 'Teruel', ''),
(47, 2, '', 'Toledo', ''),
(48, 2, '', 'Valencia', ''),
(49, 2, '', 'Valladolid', ''),
(50, 2, '', 'Vizcaya', ''),
(51, 2, '', 'Zamora', ''),
(52, 2, '', 'Zaragoza', ''),
(53, 3, 'AK', 'Alaska', ''),
(54, 3, 'AZ', 'Arizona', ''),
(55, 3, 'AR', 'Arkansas', ''),
(56, 3, 'CA', 'California', ''),
(57, 3, 'CO', 'Colorado', ''),
(58, 3, 'CT', 'Connecticut', ''),
(59, 3, 'DE', 'Delaware', ''),
(60, 3, 'DC', 'District of Columbia', ''),
(61, 3, 'FL', 'Florida', ''),
(62, 3, 'GA', 'Georgia', ''),
(63, 3, 'HI', 'Hawaii', ''),
(64, 3, 'ID', 'Idaho', ''),
(65, 3, 'IL', 'Illinois', ''),
(66, 3, 'IN', 'Indiana', ''),
(67, 3, 'IA', 'Iowa', ''),
(68, 3, 'KS', 'Kansas', ''),
(69, 3, 'KY', 'Kentucky', ''),
(70, 3, 'LA', 'Louisiana', ''),
(71, 3, 'ME', 'Maine', ''),
(72, 3, 'MD', 'Maryland', ''),
(73, 3, 'MA', 'Massachusetts', ''),
(74, 3, 'MI', 'Michigan', ''),
(75, 3, 'MN', 'Minnesota', ''),
(76, 3, 'MS', 'Mississippi', ''),
(77, 3, 'MO', 'Missouri', ''),
(78, 3, 'MT', 'Montana', ''),
(79, 3, 'NE', 'Nebraska', ''),
(80, 3, 'NV', 'Nevada', ''),
(81, 3, 'NH', 'New Hampshire', ''),
(82, 3, 'NJ', 'New Jersey', ''),
(83, 3, 'NM', 'New Mexico', ''),
(84, 3, 'NY', 'New York', ''),
(85, 3, 'NC', 'North Carolina', ''),
(86, 3, 'ND', 'North Dakota', ''),
(87, 3, 'OH', 'Ohio', ''),
(88, 3, 'OK', 'Oklahoma', ''),
(89, 3, 'OR', 'Oregon', ''),
(90, 3, 'PA', 'Pennsylvania', ''),
(91, 3, 'PR', 'Puerto Rico', ''),
(92, 3, 'RI', 'Rhode Island', ''),
(93, 3, 'SC', 'South Carolina', ''),
(94, 3, 'SD', 'South Dakota', ''),
(95, 3, 'TN', 'Tennessee', ''),
(96, 3, 'TX', 'Texas', ''),
(97, 3, 'UT', 'Utah', ''),
(98, 3, 'VT', 'Vermont', ''),
(99, 3, 'VA', 'Virginia', ''),
(100, 3, 'WA', 'Washington', ''),
(101, 3, 'WV', 'West Virginia', ''),
(102, 3, 'WI', 'Wisconsin', ''),
(103, 3, 'WY', 'Wyoming', ''),
(104, 3, 'AL', 'Alabama', ''),
(105, 1, 'BA', 'Buenos Aires', ''),
(106, 1, 'GBA', 'Buenos Aires-GBA', ''),
(107, 1, 'CABA', 'Capital Federal', ''),
(108, 1, 'CTMC', 'Catamarca', ''),
(109, 1, 'CHCO', 'Chaco', ''),
(110, 1, 'CHBT', 'Chubut', ''),
(111, 1, 'CDBA', 'Córdoba', ''),
(112, 1, 'CRT', 'Corrientes', ''),
(113, 1, 'ENR', 'Entre Ríos', ''),
(114, 1, 'FRZ', 'Formosa', ''),
(115, 1, 'JJY', 'Jujuy', ''),
(116, 1, 'LP', 'La Pampa', ''),
(117, 1, 'LRJ', 'La Rioja', ''),
(118, 1, 'MDZ', 'Mendoza', ''),
(119, 1, 'MSN', 'Misiones', ''),
(120, 1, 'NQN', 'Neuquén', ''),
(121, 1, 'RNGR', 'Río Negro', ''),
(122, 1, 'SAL', 'Salta', ''),
(123, 1, 'SNJN', 'San Juan', ''),
(124, 1, 'SNLS', 'San Luis', ''),
(125, 1, 'STCZ', 'Santa Cruz', ''),
(126, 1, 'STFE', 'Santa Fe', ''),
(127, 1, 'SDE', 'Santiago del Estero', ''),
(128, 1, 'TDF', 'Tierra del Fuego', ''),
(129, 1, 'TUCU', 'Tucumán', '');

-- --------------------------------------------------------

--
-- Table structure for table `tabbackup`
--

CREATE TABLE `tabbackup` (
  `id` int(6) NOT NULL,
  `denominacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `archivo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipoproceso`
--

CREATE TABLE `tipoproceso` (
  `codtipo` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipoproceso`
--

INSERT INTO `tipoproceso` (`codtipo`, `nombre`) VALUES
(0, 'lot'),
(1, 'batch');

-- --------------------------------------------------------

--
-- Table structure for table `trabajadores`
--

CREATE TABLE `trabajadores` (
  `codtrabajador` int(5) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `nif` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(14) COLLATE latin1_spanish_ci NOT NULL,
  `movil` varchar(14) COLLATE latin1_spanish_ci NOT NULL,
  `movilavisos` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `emailavisos` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `trabajadores`
--


-- --------------------------------------------------------

--
-- Table structure for table `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `codubicacion` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ubicaciones';

--
-- Dumping data for table `ubicaciones`
--



-- --------------------------------------------------------

--
-- Table structure for table `unidadesmedidas`
--

CREATE TABLE `unidadesmedidas` (
  `codunidadmedida` int(2) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unidadesmedidas`
--

INSERT INTO `unidadesmedidas` (`codunidadmedida`, `nombre`) VALUES
(0, 'Undefined'),
(1, 'gr.'),
(2, 'lbs.'),
(3, 'units'),
(4, 'kg.');

--
-- Indexes for dumped tables
--
--
-- Indexes for table `albalinea`
--
ALTER TABLE `albalinea`
  ADD PRIMARY KEY (`codalbaran`,`numlinea`);

--
-- Indexes for table `albalineap`
--
ALTER TABLE `albalineap`
  ADD PRIMARY KEY (`codalbaran`,`codproveedor`,`numlinea`);

--
-- Indexes for table `albalineaptmp`
--
ALTER TABLE `albalineaptmp`
  ADD PRIMARY KEY (`codalbaran`,`numlinea`);

--
-- Indexes for table `albalineatmp`
--
ALTER TABLE `albalineatmp`
  ADD PRIMARY KEY (`codalbaran`,`numlinea`);

--
-- Indexes for table `albaranes`
--
ALTER TABLE `albaranes`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `albaranesp`
--
ALTER TABLE `albaranesp`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `albaranesptmp`
--
ALTER TABLE `albaranesptmp`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `albaranestmp`
--
ALTER TABLE `albaranestmp`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`codarticulo`);

--
-- Indexes for table `artpro`
--
ALTER TABLE `artpro`
  ADD PRIMARY KEY (`codarticulo`,`codfamilia`,`codproveedor`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`codbatch`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codcliente`);

--
-- Indexes for table `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_data`
--
ALTER TABLE `company_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `embalajes`
--
ALTER TABLE `embalajes`
  ADD PRIMARY KEY (`codembalaje`);

--
-- Indexes for table `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`codentidad`);

--
-- Indexes for table `estaciones`
--
ALTER TABLE `estaciones`
  ADD PRIMARY KEY (`codestacion`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codestado`);

--
-- Indexes for table `factulinea`
--
ALTER TABLE `factulinea`
  ADD PRIMARY KEY (`codfactura`,`numlinea`);

--
-- Indexes for table `factulineap`
--
ALTER TABLE `factulineap`
  ADD PRIMARY KEY (`codfactura`,`codproveedor`,`numlinea`);

--
-- Indexes for table `factulineaptmp`
--
ALTER TABLE `factulineaptmp`
  ADD PRIMARY KEY (`codfactura`,`numlinea`);

--
-- Indexes for table `factulineatmp`
--
ALTER TABLE `factulineatmp`
  ADD PRIMARY KEY (`codfactura`,`numlinea`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`codfactura`);

--
-- Indexes for table `facturasp`
--
ALTER TABLE `facturasp`
  ADD PRIMARY KEY (`codfactura`,`codproveedor`);

--
-- Indexes for table `facturasptmp`
--
ALTER TABLE `facturasptmp`
  ADD PRIMARY KEY (`codfactura`);

--
-- Indexes for table `facturastmp`
--
ALTER TABLE `facturastmp`
  ADD PRIMARY KEY (`codfactura`);

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`codfamilia`);

--
-- Indexes for table `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`codformapago`);

--
-- Indexes for table `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`codimpuesto`);

--
-- Indexes for table `librodiario`
--
ALTER TABLE `librodiario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`codlote`);

--
-- Indexes for table `metaprocesos`
--
ALTER TABLE `metaprocesos`
  ADD PRIMARY KEY (`codproceso`);

--
-- Indexes for table `metaprocesoslinea`
--
ALTER TABLE `metaprocesoslinea`
  ADD PRIMARY KEY (`codrecord`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`codPais`);

--
-- Indexes for table `presulinea`
--
ALTER TABLE `presulinea`
  ADD PRIMARY KEY (`codpresupuesto`,`numlinea`);

--
-- Indexes for table `presulineatmp`
--
ALTER TABLE `presulineatmp`
  ADD PRIMARY KEY (`codpresupuesto`,`numlinea`);

--
-- Indexes for table `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`codpresupuesto`);

--
-- Indexes for table `presupuestostmp`
--
ALTER TABLE `presupuestostmp`
  ADD PRIMARY KEY (`codpresupuesto`);

--
-- Indexes for table `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`codproceso`);

--
-- Indexes for table `proclinea`
--
ALTER TABLE `proclinea`
  ADD PRIMARY KEY (`codproclinea`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`codprovincia`);

--
-- Indexes for table `tabbackup`
--
ALTER TABLE `tabbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipoproceso`
--
ALTER TABLE `tipoproceso`
  ADD PRIMARY KEY (`codtipo`);

--
-- Indexes for table `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`codtrabajador`);

--
-- Indexes for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`codubicacion`);

--
-- Indexes for table `unidadesmedidas`
--
ALTER TABLE `unidadesmedidas`
  ADD PRIMARY KEY (`codunidadmedida`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albaranes`
--
ALTER TABLE `albaranes`
  MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albaranesptmp`
--
ALTER TABLE `albaranesptmp`
  MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albaranestmp`
--
ALTER TABLE `albaranestmp`
  MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `codarticulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `codbatch` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codcliente` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `embalajes`
--
ALTER TABLE `embalajes`
  MODIFY `codembalaje` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `entidades`
--
ALTER TABLE `entidades`
  MODIFY `codentidad` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estaciones`
--
ALTER TABLE `estaciones`
  MODIFY `codestacion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `codestado` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facturasptmp`
--
ALTER TABLE `facturasptmp`
  MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facturastmp`
--
ALTER TABLE `facturastmp`
  MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
  MODIFY `codfamilia` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formapago`
--
ALTER TABLE `formapago`
  MODIFY `codformapago` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `codimpuesto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `librodiario`
--
ALTER TABLE `librodiario`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metaprocesos`
--
ALTER TABLE `metaprocesos`
  MODIFY `codproceso` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `metaprocesoslinea`
--
ALTER TABLE `metaprocesoslinea`
  MODIFY `codrecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `codPais` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `codpresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presupuestostmp`
--
ALTER TABLE `presupuestostmp`
  MODIFY `codpresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proclinea`
--
ALTER TABLE `proclinea`
  MODIFY `codproclinea` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `codproveedor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `codprovincia` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tabbackup`
--
ALTER TABLE `tabbackup`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipoproceso`
--
ALTER TABLE `tipoproceso`
  MODIFY `codtipo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `codtrabajador` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `codubicacion` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `unidadesmedidas`
--
ALTER TABLE `unidadesmedidas`
  MODIFY `codunidadmedida` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
