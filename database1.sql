-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Nov 29, 2020 at 08:09 PM
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
-- Database: `T_8d6846c85e8076b85318fd1054480811`
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
  `codalbaran` varchar(20) NOT NULL DEFAULT '0',
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
  `codalbaran` varchar(20) NOT NULL DEFAULT '0',
  `codproveedor` int(5) NOT NULL DEFAULT 0,
  `codfactura` varchar(20) DEFAULT NULL,
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
  `stock` int(10) NOT NULL,
  `codunidadmedida` int(5) NOT NULL,
  `stock_minimo` int(8) NOT NULL,
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

INSERT INTO `articulos` (`codarticulo`, `codfamilia`, `referencia`, `descripcion`, `impuesto`, `codproveedor1`, `codproveedor2`, `descripcion_corta`, `codubicacion`, `stock`, `codunidadmedida`, `stock_minimo`, `codumstock_minimo`, `aviso_minimo`, `datos_producto`, `fecha_alta`, `codembalaje`, `unidades_caja`, `codumunidades_caja`, `precio_ticket`, `modificar_ticket`, `observaciones`, `precio_compra`, `precio_almacen`, `precio_tienda`, `precio_pvp`, `precio_iva`, `codigobarras`, `imagen`, `borrado`) VALUES
(0, 2, 'tapa de empanadas', 'tapas de empanadas de trigo', 7, 0, 0, 'tapas', 1, 1000, 4, 100, 4, '1', 'tapas de empanadas de trigo sin gluten apto celiacos', '2020-07-18', 1, 10, 4, '0', '', '', 0.00, 0.00, 0.00, NULL, 0.00, '8400000000000', 'foto1.jpg', '0');

-- --------------------------------------------------------

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

INSERT INTO `embalajes` (`codembalaje`, `nombre`, `borrado`) VALUES
(1, 'paquete x 10', '0');

-- --------------------------------------------------------

--
-- Table structure for table `entidades`
--

CREATE TABLE `entidades` (
  `codentidad` int(2) NOT NULL,
  `nombreentidad` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidades Bancarias';

--
-- Dumping data for table `entidades`
--

INSERT INTO `entidades` (`codentidad`, `nombreentidad`, `borrado`) VALUES
(0, 'Bank of america', '0'),
(0, 'Banco galicia', '0'),
(0, 'pkao ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `estaciones`
--

CREATE TABLE `estaciones` (
  `codestacion` int(5) NOT NULL,
  `nombre` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
(0, 'initializated'),
(1, 'ended'),
(2, 'dischard'),
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

--
-- Dumping data for table `facturasptmp`
--

INSERT INTO `facturasptmp` (`codfactura`, `fecha`) VALUES
(0, '2020-07-18');

-- --------------------------------------------------------

--
-- Table structure for table `facturastmp`
--

CREATE TABLE `facturastmp` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas a clientes';

--
-- Dumping data for table `facturastmp`
--

INSERT INTO `facturastmp` (`codfactura`, `fecha`) VALUES
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-25'),
(0, '2020-05-26'),
(0, '2020-05-26'),
(0, '2020-05-26'),
(0, '2020-05-26'),
(0, '2020-05-28'),
(0, '2020-07-18'),
(0, '2020-07-18'),
(0, '2020-07-19'),
(0, '2020-07-19'),
(0, '2020-11-18'),
(0, '2020-11-18'),
(0, '2020-11-18'),
(0, '2020-11-18'),
(0, '2020-11-25'),
(0, '2020-11-29');

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
(2, 'Intermediate product', '0'),
(3, 'Final product', '0');

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

INSERT INTO `impuestos` (`codimpuesto`, `nombre`, `valor`, `borrado`) VALUES
(1, 'tax', 7, '0');

-- --------------------------------------------------------

--
-- Table structure for table `internalUsersTable`
--

CREATE TABLE `internalUsersTable` (
  `id_intUser` int(5) NOT NULL,
  `intUser_name` varchar(60) NOT NULL,
  `user_name` varchar(140) NOT NULL,
  `password` varchar(160) NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internalUsersTable`
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
  `cantidad` int(5) NOT NULL,
  `codunidadmedida` int(5) NOT NULL,
  `codstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `metaprocesoslinea`
--

CREATE TABLE `metaprocesoslinea` (
  `codrecord` int(11) NOT NULL,
  `codproceso` int(5) NOT NULL,
  `codlinea` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `codunidadmedida` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
-- Table structure for table `PermitsTable`
--

CREATE TABLE `PermitsTable` (
  `id_permit` int(10) NOT NULL,
  `id_role` int(10) NOT NULL,
  `id_resource` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `procesos` (`codproceso`, `codmproceso`, `bolasoc`, `cantidad`, `codunidadmedida`, `fechai`, `horai`, `horaf`, `fechaf`, `codestacion`, `codtrabajador`, `codstatus`, `borrado`) VALUES
(1, 0, 0, 0, 1, '2019-12-10', '19:12', '', '0000-00-00', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proclinea`
--

CREATE TABLE `proclinea` (
  `codproclinea` int(5) NOT NULL,
  `codproceso` int(5) NOT NULL,
  `codlinea` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `codunidadmedida` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `proveedores` (`codproveedor`, `nombre`, `nif`, `codpais`, `direccion`, `codprovincia`, `localidad`, `codentidad`, `cuentabancaria`, `codpostal`, `telefono`, `movil`, `email`, `web`, `borrado`) VALUES
(0, 'JOrge Mendivelzua', '', 0, 'Av. Siempre viva 32', 105, 'Buenos Aires', 0, '', '1113', '7433616', '15498444423', 'mendi@mail.com', '', '0');

-- --------------------------------------------------------

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
-- Table structure for table `resourcesTable`
--

CREATE TABLE `resourcesTable` (
  `id_resource` int(10) NOT NULL,
  `resourceName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resourcesTable`
--

INSERT INTO `resourcesTable` (`id_resource`, `resourceName`) VALUES
(1, 'interComerciales'),
(2, 'produccion'),
(3, 'ventas'),
(4, 'compras'),
(5, 'contabilidad'),
(6, 'recursosHumanos'),
(7, 'configuracion'),
(8, 'Dashboard'),
(9, 'Settings');

-- --------------------------------------------------------

--
-- Table structure for table `resourcesToRolesTable`
--

CREATE TABLE `resourcesToRolesTable` (
  `id_srtr` int(10) NOT NULL,
  `id_resource` int(10) NOT NULL,
  `id_role` int(11) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resourcesToRolesTable`
--

INSERT INTO `resourcesToRolesTable` (`id_srtr`, `id_resource`, `id_role`, `borrado`) VALUES
(11, 1, 1, 0),
(12, 3, 1, 0),
(13, 2, 1, 0),
(14, 7, 1, 0),
(15, 6, 1, 0),
(16, 5, 1, 0),
(17, 4, 1, 0),
(18, 1, 3, 1),
(19, 2, 3, 0),
(20, 5, 2, 0),
(21, 6, 2, 0),
(22, 3, 3, 1),
(23, 4, 3, 1),
(24, 5, 3, 1),
(25, 6, 3, 1),
(26, 7, 3, 1),
(27, 1, 2, 0),
(28, 2, 2, 1),
(29, 7, 2, 0),
(30, 8, 1, 0),
(31, 9, 1, 0),
(32, 8, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rolesTable`
--

CREATE TABLE `rolesTable` (
  `id_role` int(5) NOT NULL,
  `roleName` varchar(40) NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolesTable`
--

INSERT INTO `rolesTable` (`id_role`, `roleName`, `codstatus`, `borrado`) VALUES
(1, 'admin', 4, 0),
(2, 'accounting', 4, 0),
(3, 'production', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rolesToUsersTable`
--

CREATE TABLE `rolesToUsersTable` (
  `id_rtu` int(10) NOT NULL,
  `id_role` int(10) NOT NULL,
  `id_intUser` int(11) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolesToUsersTable`
--

INSERT INTO `rolesToUsersTable` (`id_rtu`, `id_role`, `id_intUser`, `borrado`) VALUES
(1, 1, 2, 0),
(4, 3, 2, 1),
(5, 2, 2, 1),
(6, 1, 1, 0),
(7, 3, 1, 1),
(8, 1, 4, 1),
(9, 3, 4, 1),
(10, 2, 4, 0),
(11, 2, 1, 1),
(12, 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subresourcesToRolesTable`
--

CREATE TABLE `subresourcesToRolesTable` (
  `id_srtr` int(10) NOT NULL,
  `id_subresource` int(10) NOT NULL,
  `id_role` int(11) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subresourcesToRolesTable`
--

INSERT INTO `subresourcesToRolesTable` (`id_srtr`, `id_subresource`, `id_role`, `borrado`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 0),
(3, 4, 1, 0),
(4, 7, 1, 0),
(5, 9, 1, 0),
(6, 5, 1, 0),
(7, 3, 1, 0),
(8, 6, 1, 0),
(9, 8, 1, 0),
(10, 10, 1, 0),
(11, 11, 1, 0),
(12, 12, 1, 0),
(13, 13, 1, 0),
(14, 14, 1, 0),
(15, 15, 1, 0),
(16, 16, 1, 0),
(17, 17, 1, 0),
(18, 18, 1, 0),
(19, 19, 1, 0),
(20, 20, 1, 0),
(21, 21, 1, 0),
(22, 22, 1, 0),
(23, 23, 1, 0),
(24, 24, 1, 0),
(25, 25, 1, 0),
(26, 26, 1, 0),
(27, 27, 1, 0),
(28, 28, 1, 0),
(29, 29, 1, 0),
(30, 31, 1, 0),
(31, 32, 1, 0),
(32, 30, 1, 0),
(33, 33, 1, 0),
(34, 32, 2, 0),
(35, 31, 2, 0),
(36, 30, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subResourceTable`
--

CREATE TABLE `subResourceTable` (
  `id_sresource` int(5) NOT NULL,
  `id_resource` int(10) NOT NULL,
  `subResourceName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subResourceTable`
--

INSERT INTO `subResourceTable` (`id_sresource`, `id_resource`, `subResourceName`) VALUES
(1, 1, 'proveedores'),
(2, 1, 'clientes'),
(3, 2, 'tiposDeArticulos'),
(4, 2, 'articulos'),
(5, 2, 'metaProcesos'),
(6, 2, 'prcesosDeProduccion'),
(7, 2, 'batchDeProduccion'),
(8, 2, 'lotesDeProduccion'),
(9, 2, 'estacionesDeTrabajo'),
(10, 3, 'ventaMostrador'),
(11, 3, 'facturas'),
(12, 3, 'remitos'),
(13, 3, 'facturarRemitos'),
(14, 3, 'presupuestos'),
(15, 4, 'facturas'),
(16, 4, 'remitos'),
(17, 4, 'facturarRemitos'),
(18, 5, 'cobros'),
(19, 5, 'pagos'),
(20, 5, 'cajaDiaria'),
(21, 5, 'libroDiario'),
(22, 5, 'formasDePago'),
(23, 5, 'impuestos'),
(24, 5, 'entidadesBancarias'),
(25, 6, 'partesDeTrabajo'),
(26, 6, 'empleados'),
(27, 7, 'etiquetas'),
(28, 7, 'ubicaciones'),
(29, 7, 'embalajes'),
(30, 8, 'Copias de Seguridad'),
(31, 8, 'Roles'),
(32, 8, 'Usuarios'),
(33, 9, 'Dashboard');

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

INSERT INTO `ubicaciones` (`codubicacion`, `nombre`, `borrado`) VALUES
(1, 'Planta pricipal', '0');

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
(1, 'Undefined'),
(2, 'gr.'),
(3, 'lbs.'),
(4, 'units'),
(5, 'kg.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `embalajes`
--
ALTER TABLE `embalajes`
  ADD PRIMARY KEY (`codembalaje`);

--
-- Indexes for table `internalUsersTable`
--
ALTER TABLE `internalUsersTable`
  ADD PRIMARY KEY (`id_intUser`);

--
-- Indexes for table `PermitsTable`
--
ALTER TABLE `PermitsTable`
  ADD PRIMARY KEY (`id_permit`);

--
-- Indexes for table `resourcesTable`
--
ALTER TABLE `resourcesTable`
  ADD PRIMARY KEY (`id_resource`);

--
-- Indexes for table `resourcesToRolesTable`
--
ALTER TABLE `resourcesToRolesTable`
  ADD PRIMARY KEY (`id_srtr`);

--
-- Indexes for table `rolesTable`
--
ALTER TABLE `rolesTable`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `rolesToUsersTable`
--
ALTER TABLE `rolesToUsersTable`
  ADD PRIMARY KEY (`id_rtu`);

--
-- Indexes for table `subresourcesToRolesTable`
--
ALTER TABLE `subresourcesToRolesTable`
  ADD PRIMARY KEY (`id_srtr`);

--
-- Indexes for table `subResourceTable`
--
ALTER TABLE `subResourceTable`
  ADD PRIMARY KEY (`id_sresource`);

--
-- Indexes for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`codubicacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `internalUsersTable`
--
ALTER TABLE `internalUsersTable`
  MODIFY `id_intUser` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `PermitsTable`
--
ALTER TABLE `PermitsTable`
  MODIFY `id_permit` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resourcesTable`
--
ALTER TABLE `resourcesTable`
  MODIFY `id_resource` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resourcesToRolesTable`
--
ALTER TABLE `resourcesToRolesTable`
  MODIFY `id_srtr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rolesTable`
--
ALTER TABLE `rolesTable`
  MODIFY `id_role` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rolesToUsersTable`
--
ALTER TABLE `rolesToUsersTable`
  MODIFY `id_rtu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subresourcesToRolesTable`
--
ALTER TABLE `subresourcesToRolesTable`
  MODIFY `id_srtr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `subResourceTable`
--
ALTER TABLE `subResourceTable`
  MODIFY `id_sresource` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;