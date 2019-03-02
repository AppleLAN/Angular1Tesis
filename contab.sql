-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 16, 2018 at 09:56 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contab`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fantasyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigoProvincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `cuit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `epib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excento` tinyint(1) NOT NULL,
  `responsableMonotributo` tinyint(1) NOT NULL,
  `responsableInscripto` tinyint(1) NOT NULL,
  `ivaInscripto` tinyint(1) NOT NULL,
  `condicionDeVenta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `limiteDeCredito` double(8,2) NOT NULL,
  `numeroDeInscripcionesIB` int(11) NOT NULL,
  `cuentasGenerales` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percepcionDeGanancia` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_id`, `name`, `fantasyName`, `email`, `place`, `codigoPostal`, `codigoProvincia`, `address`, `telephone`, `cuit`, `web`, `iib`, `pib`, `epib`, `excento`, `responsableMonotributo`, `responsableInscripto`, `ivaInscripto`, `condicionDeVenta`, `limiteDeCredito`, `numeroDeInscripcionesIB`, `cuentasGenerales`, `percepcionDeGanancia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'client1', 'client1', 'client1', 'client1', 'client1', '1162', 'client1', 2000000000, 'client12222', 'client12222', 'client12222', 'client12222', 'client12222', 1, 0, 127, 1, 0.00, 'client12222', 0.00, 0, 'client12222', 0, '2017-09-29', '2018-02-12', NULL),
(2, 2, 'client2', 'client2', 'client2', 'client2', 'client2', '', 'client2', 0, 'client22222', 'client2', 'client2', 'client2', 'client2', 0, 0, 0, 0, 0.00, 'client2', 0.00, 0, 'client2', 0, '2017-11-14', '2017-11-14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fantasyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigoProvincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `cuit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `epib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excento` tinyint(1) NOT NULL,
  `responsableMonotributo` tinyint(1) NOT NULL,
  `responsableInscripto` tinyint(1) NOT NULL,
  `ivaInscripto` tinyint(1) NOT NULL,
  `condicionDeVenta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `limiteDeCredito` double(8,2) NOT NULL,
  `numeroDeInscripcionesIB` int(11) NOT NULL,
  `cuentasGenerales` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percepcionDeGanancia` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `fantasyName`, `email`, `place`, `codigoPostal`, `codigoProvincia`, `address`, `telephone`, `cuit`, `web`, `iib`, `pib`, `epib`, `excento`, `responsableMonotributo`, `responsableInscripto`, `ivaInscripto`, `condicionDeVenta`, `limiteDeCredito`, `numeroDeInscripcionesIB`, `cuentasGenerales`, `percepcionDeGanancia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'client1', 'client2', 'client2', 'client2', 'client2', '', 'client2', 1231231311, 'client22222', 'client2', 'client2', 'client2', 'client2', 0, 0, 0, 0, 0.00, 'client2', 0.00, 0, 'client2', 0, '2017-09-09', '2017-11-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_05_15_213844_create_users_table', 1),
('2017_05_15_213856_create_client_table', 1),
('2017_05_15_213856_create_provider_table', 1),
('2017_06_14_214627_create_companies_table', 1),
('2017_07_07_220035_create_user_roles_table', 1),
('2017_07_07_220048_create_roles_table', 1),
('2017_09_05_224132_create_products_table', 1),
('2017_09_05_224152_create_movements_table', 1),
('2017_09_05_225324_create_categories_table', 1),
('2017_10_03_023604_create_order_table', 2),
('2017_10_03_023723_create_order_detail_table', 2),
('2017_09_29_033710_create_sales_table', 3),
('2017_09_29_034442_create_sales_detail_table', 3),
('2018_02_12_200843_afip_sale_cae', 4);

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

CREATE TABLE IF NOT EXISTS `movements` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `type` enum('in','out') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `price` int(11) NOT NULL,
  `tax` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movements`
--

INSERT INTO `movements` (`id`, `product_id`, `company_id`, `order_id`, `sale_id`, `quantity`, `type`, `created_at`, `updated_at`, `deleted_at`, `price`, `tax`) VALUES
(6, 15, 2, NULL, 10, 1, 'out', '2017-11-14', '2017-11-14', NULL, 30, 0),
(7, 16, 2, NULL, 11, 1, 'out', '2017-11-14', '2017-11-14', NULL, 10, 0),
(8, 15, 2, 1, NULL, 1, 'in', '2017-11-24', '2017-11-24', NULL, 30, 0),
(9, 15, 2, 1, NULL, 1, 'in', '2017-11-24', '2017-11-24', NULL, 30, 0),
(10, 15, 2, 1, NULL, 1, 'in', '2017-11-24', '2017-11-24', NULL, 30, 0),
(11, 15, 2, 1, NULL, 1, 'in', '2017-11-24', '2017-11-24', NULL, 30, 0),
(12, 17, 2, 2, NULL, 20, 'in', '2018-02-12', '2018-02-12', NULL, 30, 0),
(13, 15, 2, NULL, 12, 5, 'out', '2018-02-12', '2018-02-12', NULL, 30, 0),
(14, 15, 2, 4, NULL, 3, 'in', '2018-02-12', '2018-02-12', NULL, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `provider_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('C','R') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'C',
  `letter` enum('A','B','C','M','E','X') COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_cuit` bigint(20) unsigned DEFAULT NULL,
  `provider_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` double(8,2) NOT NULL DEFAULT '0.00',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `taxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `company_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `provider_id`, `user_id`, `status`, `letter`, `provider_name`, `provider_cuit`, `provider_address`, `subtotal`, `discount`, `taxes`, `total`, `company_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'R', '', 'proveedor2', 0, 'proveedor2', 30.00, 0.00, '0', 30.00, 2, '2017-11-24 15:41:21', '2017-11-24 15:39:26', '2017-11-24 15:41:21'),
(2, 1, 4, 'R', '', 'a@gmail.com', 0, 'a2@gmail.com', 600.00, 0.00, '0', 600.00, 2, NULL, '2018-01-25 02:16:30', '2018-02-12 19:19:02'),
(3, 2, 4, 'C', '', 'proveedor2', 0, 'proveedor2', 600.00, 0.00, '0', 600.00, 2, NULL, '2018-01-25 02:16:30', '2018-01-25 02:16:30'),
(4, 2, 4, 'R', '', 'proveedor2', 0, 'proveedor2', 90.00, 0.00, '0', 90.00, 2, NULL, '2018-02-12 23:03:42', '2018-02-12 23:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `price` double(8,2) NOT NULL,
  `tax` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `tax`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'del segundo provider', 1.00, 30.00, 0, '2017-11-24 15:41:21', '2017-11-24 15:39:26', '2017-11-24 15:41:21'),
(2, 2, 17, 'a@gmail provider', 20.00, 30.00, 0, NULL, '2018-01-25 02:16:30', '2018-01-25 02:16:30'),
(3, 3, 16, 'del primer provider', 10.00, 10.00, 0, NULL, '2018-01-25 02:16:30', '2018-01-25 02:16:30'),
(4, 3, 15, 'del segundo provider', 10.00, 30.00, 0, NULL, '2018-01-25 02:16:30', '2018-01-25 02:16:30'),
(5, 4, 15, 'del segundo provider', 3.00, 30.00, 0, NULL, '2018-02-12 23:03:42', '2018-02-12 23:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `provider_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `provider_id`, `name`, `code`, `description`, `cost_price`, `sale_price`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 1, 1, 'del primer provider 1', '30', 'del primer provider', '20', '30', '30', '2017-10-19', '2017-11-01', NULL),
(15, 2, 2, 'del segundo provider', '30', 'del segundo provider', '30', '30', '30', '2017-10-19', '2018-02-12', NULL),
(16, 2, 2, 'del primer provider', '30', 'del primer provider', '10', '30', '30', '2017-10-19', '2017-10-19', NULL),
(17, 2, 1, 'a@gmail provider', '30', 'del segundo provider', '30', '30', '30', '2017-11-03', '2017-11-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fantasyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigoPostal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigoProvincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `cuit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `epib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excento` tinyint(1) NOT NULL,
  `responsableMonotributo` tinyint(1) NOT NULL,
  `responsableInscripto` tinyint(1) NOT NULL,
  `ivaInscripto` tinyint(1) NOT NULL,
  `condicionDeVenta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `limiteDeCredito` double(8,2) NOT NULL,
  `numeroDeInscripcionesIB` int(11) NOT NULL,
  `cuentasGenerales` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percepcionDeGanancia` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `company_id`, `name`, `fantasyName`, `email`, `place`, `codigoPostal`, `codigoProvincia`, `address`, `telephone`, `cuit`, `web`, `iib`, `pib`, `epib`, `excento`, `responsableMonotributo`, `responsableInscripto`, `ivaInscripto`, `condicionDeVenta`, `limiteDeCredito`, `numeroDeInscripcionesIB`, `cuentasGenerales`, `percepcionDeGanancia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'a@gmail.com', 'a2@gmail.com', 'a2@gmail.com', 'a2@gmail.com', 'a2@gmail.com', 'stockStorage', 'a2@gmail.com', 1111111111, 'a2@gmail.co', 'a2@gmail.com', 'a2@gmail.com', 'a2@gmail.com', 'a2@gmail.com', 0, 0, 0, 0, 0.00, 'a2@gmail.com', 0.00, 0, 'a2@gmail.com', 0, '2017-09-09', '2018-01-24', NULL),
(2, 2, 'proveedor2', 'proveedor2', 'proveedor2', 'proveedor2', 'proveedor2', '7600', 'proveedor2', 2147483647, 'proveedor22', 'proveedor2', 'proveedor2', 'proveedor2', 'proveedor2', 0, 0, 127, 1, 0.00, 'proveedor2', 0.00, 0, 'proveedor2', 0, '2017-10-19', '2018-02-12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMIN', '2017-09-09', '2017-09-09', NULL),
(2, 'NORMAL_USER', '2017-09-09', '2017-09-09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type` enum('FC','NC','ND') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'FC',
  `letter` enum('A','B','C') COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_cuit` bigint(20) unsigned DEFAULT NULL,
  `client_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `subtotal` double(8,2) NOT NULL DEFAULT '0.00',
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `perceptions` double(8,2) NOT NULL DEFAULT '0.00',
  `taxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '{}',
  `response` text COLLATE utf8_unicode_ci,
  `warehouse_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `payments` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `cae_data` varchar(800) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `company_id`, `client_id`, `user_id`, `type`, `letter`, `client_name`, `client_cuit`, `client_address`, `pos`, `number`, `discount`, `subtotal`, `total`, `perceptions`, `taxes`, `response`, `warehouse_id`, `date`, `deleted_at`, `created_at`, `updated_at`, `status`, `payments`, `notes`, `cae_data`) VALUES
(10, 2, 1, 4, 'FC', 'C', 'client1', 0, 'client1', '0', '0', 0.00, 0.00, 30.00, 0.00, '{}', NULL, NULL, '2017-11-14', NULL, '2017-11-14 03:00:00', '2018-02-12 23:48:17', 'C', 'Cuenta corriente', '0', '{"FeCabResp":{"Cuit":20366017314,"PtoVta":1,"CbteTipo":3,"FchProceso":"20180212174817","CantReg":1,"Resultado":"A","Reproceso":"N"},"FeDetResp":{"FECAEDetResponse":{"Concepto":3,"DocTipo":80,"DocNro":20354108209,"CbteDesde":8,"CbteHasta":8,"CbteFch":"20180212","Resultado":"A","Observaciones":{"Obs":{"Code":10063,"Msg":"Factura individual, DocTipo: 80, DocNro 20354108209 no se encuentra inscripto en condicion ACTIVA en el impuesto (IVA)."}},"CAE":"68074636092589","CAEFchVto":"20180222"}}}'),
(11, 2, 2, 4, 'FC', 'C', 'client2', 0, 'client2', '0', '0', 0.00, 0.00, 30.00, 0.00, '{}', NULL, NULL, '2017-11-14', NULL, '2017-11-14 03:00:00', '2017-11-14 21:12:56', 'C', 'Cuenta corriente', '0', ''),
(12, 2, 1, 4, 'FC', 'B', 'client1', 0, 'client1', '0', '0', 0.00, 0.00, 150.00, 0.00, '{}', NULL, NULL, '2018-02-12', NULL, '2018-02-12 03:00:00', '2018-02-12 23:57:03', 'F', 'Cuenta corriente', '0', '{"FeCabResp":{"Cuit":20366017314,"PtoVta":1,"CbteTipo":3,"FchProceso":"20180212175703","CantReg":1,"Resultado":"A","Reproceso":"N"},"FeDetResp":{"FECAEDetResponse":{"Concepto":3,"DocTipo":80,"DocNro":20354108209,"CbteDesde":9,"CbteHasta":9,"CbteFch":"20180212","Resultado":"A","Observaciones":{"Obs":{"Code":10063,"Msg":"Factura individual, DocTipo: 80, DocNro 20354108209 no se encuentra inscripto en condicion ACTIVA en el impuesto (IVA)."}},"CAE":"68074636093331","CAEFchVto":"20180222"}}}');

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE IF NOT EXISTS `sales_detail` (
  `id` int(10) unsigned NOT NULL,
  `sale_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `price` double(8,2) NOT NULL,
  `tax` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`id`, `sale_id`, `product_id`, `product_name`, `quantity`, `price`, `tax`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 10, 15, 'del segundo provider', 18.00, 30.00, 0, NULL, '2017-11-14 21:12:56', '2017-11-14 21:12:56'),
(6, 11, 16, 'del primer provider', 1.00, 10.00, 0, NULL, '2017-11-14 21:12:56', '2017-11-14 21:12:56'),
(7, 12, 15, 'del segundo provider', 5.00, 30.00, 0, NULL, '2018-02-12 19:19:56', '2018-02-12 19:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales` tinyint(1) NOT NULL,
  `providers` tinyint(1) NOT NULL,
  `stock` tinyint(1) NOT NULL,
  `clients` tinyint(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `username`, `name`, `lastname`, `email`, `password`, `birthday`, `address`, `sales`, `providers`, `stock`, `clients`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 2, 'a@gmail.com', 'Alan', 'Buscaglia', 'a@gmail.com', '$2y$10$Oye1TIdPdzj7xcTiUleTFuzSJAEqoJkx6riU003QZ/XkuJx6Gk8fq', '1992-03-17', 'Leandro N. Alem 5077', 1, 1, 1, 1, '2017-09-09', '2017-11-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 4, 1, '2017-09-09', '2017-09-09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_company_id_foreign` (`company_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fantasyName` (`name`);

--
-- Indexes for table `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movements_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `movements`
--
ALTER TABLE `movements`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `movements`
--
ALTER TABLE `movements`
  ADD CONSTRAINT `movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
