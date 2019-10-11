-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2019 a las 17:43:11
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `condom_system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_10_09_203814_create_tbl_condominio_table', 1),
(2, '2019_10_09_214237_create_tbl_inmueble_table', 1),
(3, '2019_10_09_214815_create_tbl_status_pago_table', 1),
(4, '2019_10_09_221704_create_tbl_gastos_condominio_table', 1),
(5, '2019_10_09_222039_create_tbl_recibo_inmueble_table', 1),
(6, '2019_10_09_222150_create_tbl_pagos_inmueble_table', 1),
(7, '2019_10_09_222212_create_tbl_proveedores_table', 1),
(8, '2019_10_09_222245_create_tbl_tipo_cuenta_table', 1),
(9, '2019_10_09_222327_create_tbl_cuentas_table', 1),
(10, '2019_10_09_222422_create_tbl_usuarios_table', 1),
(11, '2019_10_11_131203_update_tbl_inmueble_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_condominio`
--

CREATE TABLE `tbl_condominio` (
  `id_condominio` int(10) UNSIGNED NOT NULL,
  `nombre_condominio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `porcentaje_reserva` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_condominio`
--

INSERT INTO `tbl_condominio` (`id_condominio`, `nombre_condominio`, `direccion`, `porcentaje_reserva`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Suite 510', '682 Angelita Harbors\nSouth Zacharyton, OK 07798-4655', 11, 0, '2019-10-10 07:11:12', '2019-10-10 07:11:12'),
(2, 'Suite 933', '33232 Purdy Island\nEast Hershelburgh, LA 54923-6601', 6, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(3, 'Apt. 426', '700 Lela Branch Apt. 526\nNew Tatum, SD 57330-2380', 8, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(4, 'Suite 816', '7903 Doyle Walk\nIlianaberg, MA 95180', 8, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(5, 'Apt. 727', '52668 Schiller Drives Suite 882\nLake Dorianland, KY 89393', 7, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(6, 'Apt. 903', '627 Adrien Manor\nCortezhaven, AZ 57343', 15, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(7, 'Suite 318', '4233 Huel Brooks\nEast Zorachester, KY 77432', 8, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(8, 'Apt. 468', '7448 Jennifer Path\nZiemechester, VA 28235', 13, 0, '2019-10-10 07:11:13', '2019-10-10 07:11:13'),
(9, 'Apt. 599', '3886 Leanne Views Apt. 459\nPort Layla, OK 97787', 9, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(10, 'Suite 424', '9709 Harber Place\nImeldaborough, PA 25323', 6, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(11, 'Apt. 857', '50286 Benedict Mountains\nLeannonside, NJ 07989-0930', 9, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(12, 'Apt. 723', '5015 Danial Street\nEast Gennarofurt, HI 19810-6003', 7, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(13, 'Apt. 802', '62084 Tremayne Knoll Suite 350\nGleichnerbury, KS 72524-3900', 9, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(14, 'Apt. 139', '3489 Nella Parkway Suite 263\nTaramouth, SC 43499', 7, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(15, 'Suite 562', '68119 Zieme Lodge Suite 725\nNorth Jonathan, RI 02993-7053', 14, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(16, 'Suite 823', '894 Keanu Station Suite 335\nKathrynefort, AK 15840-3813', 7, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(17, 'Apt. 301', '100 Langosh Throughway Suite 579\nKatharinaport, FL 46807-7740', 15, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(18, 'Apt. 504', '10171 Oliver Forges\nLake Kimberlyport, NC 34322', 7, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(19, 'Suite 335', '11504 Kuphal Trafficway\nHandville, MT 28740-4525', 11, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14'),
(20, 'Apt. 256', '45110 Corwin Tunnel\nGoodwinbury, VT 90418', 7, 0, '2019-10-10 07:11:14', '2019-10-10 07:11:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cuentas`
--

CREATE TABLE `tbl_cuentas` (
  `id_cuenta` int(10) UNSIGNED NOT NULL,
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `id_tipo_cuenta` int(10) UNSIGNED NOT NULL,
  `nro_factura` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` int(11) NOT NULL,
  `pago_abono` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `tipo_nota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_cuentas`
--

INSERT INTO `tbl_cuentas` (`id_cuenta`, `id_proveedor`, `id_tipo_cuenta`, `nro_factura`, `monto`, `pago_abono`, `fecha_pago`, `monto_pagado`, `tipo_nota`, `created_at`, `updated_at`) VALUES
(1, 10, 11, 'BVEXANMAX81', 177646, 79294370, '2006-10-23', 666807323, 'Sequi aut sint illum veniam in itaque.', '2019-10-10 08:38:48', '2019-10-10 08:38:48'),
(2, 18, 2, 'AFLZMDP4', 82483, 26, '1972-06-02', 6, 'Tenetur minima ipsa ab inventore.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(3, 14, 10, 'CMPHVN782Q4', 180710, 61, '1981-12-21', 89406149, 'At minus necessitatibus et similique excepturi.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(4, 20, 15, 'UKNYPPNO', 6, 26, '2002-05-17', 97297, 'Molestiae minima cupiditate dignissimos sit.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(5, 22, 16, 'LOKQFUXQ', 141, 768, '1971-09-18', 8377, 'Doloribus cum sed consequatur sed nemo explicabo.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(6, 10, 10, 'MIXOPBVTBE6', 77322781, 39847, '1982-09-17', 784231, 'Quos sit dignissimos in enim hic.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(7, 10, 2, 'YSGOHMAIOGI', 40920444, 878785364, '1970-06-04', 5201, 'Sint dolor iste magni ab et consequatur dolor.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(8, 26, 6, 'KVBDEZ9Z3D1', 22, 6488533, '2013-01-09', 1061699, 'Aliquam illo facilis deleniti et dicta magni.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(9, 21, 20, 'SZILZQNZDBC', 26, 53088, '2019-02-04', 874595, 'Sed dignissimos officia laboriosam eaque dicta consectetur.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(10, 26, 14, 'LZZQSWJZ4YB', 68299868, 740222, '1975-05-11', 348937, 'Doloribus eum adipisci dolorem at quia et ipsam.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(11, 18, 16, 'EJIULKMN', 44650, 51515, '1994-01-24', 6336149, 'Assumenda repudiandae et fuga doloremque velit provident eos.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(12, 19, 3, 'PJLEWL5D', 863, 4794288, '2017-09-26', 700738, 'Unde nisi sunt voluptatem.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(13, 12, 10, 'NOCHXLVP0FQ', 37895, 5722, '1979-07-25', 1892, 'Dolore aperiam sit accusamus iste enim necessitatibus.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(14, 18, 14, 'ETTBACC195A', 7097336, 814044001, '1993-08-17', 44551, 'Ex vel sint pariatur tempora inventore illum.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(15, 25, 7, 'KTHJNWDUXMM', 281, 4770804, '2002-06-15', 911, 'Et cum sit debitis modi eius quae error nam.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(16, 26, 17, 'QJANPJHYES7', 54082, 6, '1994-09-24', 788, 'Tempore cumque delectus sapiente nobis officiis est.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(17, 11, 9, 'XHOXUAEMLUB', 577, 68121, '2006-12-10', 308, 'Vero nam qui neque quaerat.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(18, 8, 7, 'GIAKUF5R', 9, 34302801, '2007-05-17', 496271307, 'Sint ratione dolor sequi et enim assumenda.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(19, 23, 9, 'DZXNYYPO', 149, 382419, '1982-11-30', 34813, 'Sed aut qui nihil iure odio.', '2019-10-10 08:38:49', '2019-10-10 08:38:49'),
(20, 20, 2, 'HRRSFBZB', 798584, 3, '1971-12-05', 779, 'Beatae ea et eos earum.', '2019-10-10 08:38:50', '2019-10-10 08:38:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gastos_condominio`
--

CREATE TABLE `tbl_gastos_condominio` (
  `id_gasto_condominio` int(10) UNSIGNED NOT NULL,
  `id_condominio` int(10) UNSIGNED NOT NULL,
  `descripcion_gasto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_gasto` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gastos_condominio`
--

INSERT INTO `tbl_gastos_condominio` (`id_gasto_condominio`, `id_condominio`, `descripcion_gasto`, `monto_gasto`, `created_at`, `updated_at`) VALUES
(1, 8, 'Aut doloremque quia quaerat.', 810669, '2019-10-10 08:08:39', '2019-10-10 08:08:39'),
(2, 8, 'Dolore voluptas porro ut esse officiis deleniti possimus.', 325257, '2019-10-10 08:08:39', '2019-10-10 08:08:39'),
(3, 4, 'Et qui quidem dolores quam cum.', 329279, '2019-10-10 08:08:39', '2019-10-10 08:08:39'),
(4, 9, 'Iste impedit quis possimus pariatur.', 62468, '2019-10-10 08:08:39', '2019-10-10 08:08:39'),
(5, 11, 'Cum voluptatem quia ad sit.', 253026, '2019-10-10 08:08:39', '2019-10-10 08:08:39'),
(6, 5, 'Ullam est ut eos cupiditate veritatis quibusdam.', 599172, '2019-10-10 08:08:39', '2019-10-10 08:08:39'),
(7, 18, 'Cumque dolores eaque ipsum.', 983677, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(8, 20, 'Inventore esse enim amet consequatur fuga doloremque sit.', 246656, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(9, 2, 'Eos repellendus ut molestias repudiandae.', 731206, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(10, 9, 'Ratione culpa aut qui aut iste.', 634478, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(11, 1, 'Quisquam modi provident temporibus voluptas.', 932683, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(12, 17, 'Quo laudantium animi praesentium.', 680487, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(13, 9, 'Ex deleniti dolor officia nulla.', 203055, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(14, 2, 'Tempora et esse quibusdam sed aut.', 624137, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(15, 14, 'Veniam odit quod omnis sunt.', 867361, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(16, 6, 'Sunt explicabo quidem perspiciatis debitis adipisci quae.', 603995, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(17, 20, 'Necessitatibus laborum qui odio commodi eum corporis.', 861429, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(18, 17, 'Iure eaque commodi eos id voluptatem aut eius doloremque.', 806544, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(19, 6, 'Magnam rerum dolor illum illo.', 392795, '2019-10-10 08:08:40', '2019-10-10 08:08:40'),
(20, 8, 'Nihil fugiat dolore et dolores vel voluptas.', 91895, '2019-10-10 08:08:40', '2019-10-10 08:08:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inmueble`
--

CREATE TABLE `tbl_inmueble` (
  `id_inmueble` int(10) UNSIGNED NOT NULL,
  `nro_inmueble` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_propietario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alicuota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_condominio` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_inmueble`
--

INSERT INTO `tbl_inmueble` (`id_inmueble`, `nro_inmueble`, `nombre_propietario`, `alicuota`, `created_at`, `updated_at`, `id_condominio`) VALUES
(71, '66r', 'Asa Lind', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(72, '43h', 'Prof. Julian Lubowitz', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(73, '3r', 'Miss Janessa Welch DDS', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(74, '61y', 'Luella Gaylord', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(75, '55g', 'Cayla Volkman', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(76, '43b', 'Ms. Abigayle Borer IV', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(77, '72q', 'Prof. Valentin West V', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(78, '70k', 'Jeramie Koepp', 5, '2019-10-11 17:29:22', '2019-10-11 17:29:22', 1),
(79, '23b', 'Adella Gusikowski', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(80, '84i', 'Nyah Heller IV', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(81, '30w', 'Wava Denesik V', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(82, '27d', 'Krystina Crona', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(83, '60d', 'Elliott Casper', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(84, '89f', 'Suzanne Kiehn', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(85, '39t', 'Afton Wuckert', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(86, '12g', 'Dovie Bahringer', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(87, '61f', 'Prof. Edwin Ullrich', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(88, '92y', 'Candice Blanda', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(89, '95y', 'Cathrine Walker', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1),
(90, '100g', 'Stacey Lehner II', 5, '2019-10-11 17:29:23', '2019-10-11 17:29:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pagos_inmueble`
--

CREATE TABLE `tbl_pagos_inmueble` (
  `id_recibo_inmueble` int(10) UNSIGNED NOT NULL,
  `mes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto_mes` int(11) NOT NULL,
  `monto_pegado` int(11) NOT NULL,
  `id_status_pago` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_pagos_inmueble`
--

INSERT INTO `tbl_pagos_inmueble` (`id_recibo_inmueble`, `mes`, `monto_mes`, `monto_pegado`, `id_status_pago`, `created_at`, `updated_at`) VALUES
(9, 'April', 64586, 11544, 7, '2019-10-11 17:45:33', '2019-10-11 17:45:33'),
(4, 'June', 8826, 36492, 20, '2019-10-11 17:45:33', '2019-10-11 17:45:33'),
(2, 'April', 40216, 90979, 20, '2019-10-11 17:45:33', '2019-10-11 17:45:33'),
(2, 'November', 41671, 61336, 18, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(10, 'January', 82656, 4412, 7, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(6, 'December', 48634, 8388, 17, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(1, 'June', 62682, 30479, 8, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(8, 'April', 16080, 93661, 17, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(17, 'November', 55233, 15470, 20, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(11, 'December', 91933, 78048, 4, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(5, 'January', 31680, 63305, 10, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(3, 'July', 79094, 67007, 3, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(11, 'November', 99428, 19889, 18, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(12, 'April', 78875, 58097, 5, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(11, 'August', 55713, 82913, 7, '2019-10-11 17:45:34', '2019-10-11 17:45:34'),
(11, 'January', 14913, 62288, 7, '2019-10-11 17:45:35', '2019-10-11 17:45:35'),
(17, 'February', 35289, 6302, 11, '2019-10-11 17:45:35', '2019-10-11 17:45:35'),
(7, 'July', 19177, 78244, 2, '2019-10-11 17:45:35', '2019-10-11 17:45:35'),
(12, 'March', 17182, 32784, 1, '2019-10-11 17:45:35', '2019-10-11 17:45:35'),
(7, 'December', 9702, 38914, 20, '2019-10-11 17:45:35', '2019-10-11 17:45:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedores`
--

CREATE TABLE `tbl_proveedores` (
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_proveedores`
--

INSERT INTO `tbl_proveedores` (`id_proveedor`, `nombre`, `direccion`, `telefono`, `activo`, `created_at`, `updated_at`) VALUES
(8, 'Sydnie Beatty', '729 Konopelski Ridges Suite 386\nEstellview, FL 78132-5953', '+1428102271325', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(9, 'Clay Price', '886 Karson Islands Apt. 482\nEast Greenberg, AZ 11612-5368', '+7123020632002', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(10, 'Charity Price', '180 Reyes Alley Suite 497\nLemkemouth, KY 32146', '+7732772005301', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(11, 'Ms. Elfrieda Rippin I', '67887 Wilburn Plains\nPort Hilda, NH 26849-2421', '+1757345457364', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(12, 'Mrs. Heath McKenzie DDS', '4334 Graham Courts Apt. 108\nSchaeferfurt, NV 47614-4057', '+6299477447175', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(13, 'Liza Mitchell', '77835 Ondricka Corner\nDelphafort, OH 46558-3878', '+6499737121439', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(14, 'Ms. Liliane Jast', '159 Malvina Ports\nEast Lupe, TX 81361', '+2074156760520', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(15, 'Lysanne Smitham', '560 Mitchell Pines Apt. 481\nLake Aliceshire, TN 83000-0363', '+2606108949259', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(16, 'Dr. Kip Farrell III', '21896 Dana Brook Suite 344\nViolaport, SD 54685-8271', '+7932126384551', 0, '2019-10-10 07:22:37', '2019-10-10 07:22:37'),
(17, 'Adella Cremin', '33072 Armstrong Mountain\nRolandoview, MI 98541', '+1375955109876', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(18, 'Cade Okuneva', '643 Vivian Lodge Apt. 975\nAdolfoshire, ME 43936-1285', '+1754959554339', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(19, 'Pete Lang', '314 Treutel Lane\nSouth Bailey, MT 24435-4777', '+3737089870166', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(20, 'Jevon McClure', '34389 Elyse Ridge Apt. 976\nWalkershire, TX 05964-4509', '+1819824270009', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(21, 'Warren Hagenes', '5006 McLaughlin Land\nFraneckitown, NC 36796-7990', '+3928370672528', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(22, 'Prof. Webster Homenick', '49841 Taurean Turnpike Apt. 540\nWellingtonport, UT 86864', '+3370077954376', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(23, 'Dr. Mazie Hand', '4882 McKenzie Turnpike\nSouth Drake, WI 34958-1995', '+6284790069664', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(24, 'Warren Rohan IV', '4414 Rosenbaum Field\nWest Jewell, ND 09058-0183', '+3836667229316', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(25, 'Miss Shirley Stokes', '52143 Kerluke Mountain Suite 014\nCasperfort, MO 54925-1051', '+4506603151785', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(26, 'Mckenzie Rutherford', '25438 Rosalind Harbor Apt. 438\nSouth Nelda, IL 50467-3125', '+6732303627222', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38'),
(27, 'Alexzander Johnson', '76502 Jada Radial\nDareside, SC 32889', '+2761058974099', 0, '2019-10-10 07:22:38', '2019-10-10 07:22:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recibo_inmueble`
--

CREATE TABLE `tbl_recibo_inmueble` (
  `id_recibo_inmueble` int(10) UNSIGNED NOT NULL,
  `id_inmueble` int(10) UNSIGNED NOT NULL,
  `mes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` int(11) NOT NULL,
  `id_status_pago` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_recibo_inmueble`
--

INSERT INTO `tbl_recibo_inmueble` (`id_recibo_inmueble`, `id_inmueble`, `mes`, `monto`, `id_status_pago`, `created_at`, `updated_at`) VALUES
(1, 90, 'August', 6224215, 4, '2019-10-11 17:38:13', '2019-10-11 17:38:13'),
(2, 81, 'June', 3, 20, '2019-10-11 17:38:14', '2019-10-11 17:38:14'),
(3, 76, 'April', 8390, 17, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(4, 74, 'July', 76, 2, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(5, 76, 'February', 2, 14, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(6, 79, 'January', 58964, 19, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(7, 76, 'September', 683840645, 10, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(8, 71, 'March', 1923, 14, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(9, 81, 'August', 5, 15, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(10, 80, 'September', 90228451, 12, '2019-10-11 17:38:15', '2019-10-11 17:38:15'),
(11, 80, 'September', 1, 14, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(12, 86, 'October', 1441306, 2, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(13, 81, 'January', 80517, 7, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(14, 72, 'August', 660, 11, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(15, 81, 'August', 69, 7, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(16, 71, 'February', 96214, 15, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(17, 79, 'March', 67346, 4, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(18, 80, 'September', 939451381, 15, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(19, 86, 'July', 41707261, 7, '2019-10-11 17:38:16', '2019-10-11 17:38:16'),
(20, 83, 'November', 36973, 15, '2019-10-11 17:38:16', '2019-10-11 17:38:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_status_pago`
--

CREATE TABLE `tbl_status_pago` (
  `id_status_pago` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_status_pago`
--

INSERT INTO `tbl_status_pago` (`id_status_pago`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Pendiente', '2019-10-10 07:17:43', '2019-10-10 07:17:43'),
(2, 'Cancelado', '2019-10-10 07:17:44', '2019-10-10 07:17:44'),
(3, 'Vencido', '2019-10-10 07:17:44', '2019-10-10 07:17:44'),
(4, 'Pendiente', '2019-10-10 07:17:44', '2019-10-10 07:17:44'),
(5, 'Pendiente', '2019-10-10 07:17:44', '2019-10-10 07:17:44'),
(6, 'Pendiente', '2019-10-10 07:17:45', '2019-10-10 07:17:45'),
(7, 'Pendiente', '2019-10-10 07:17:45', '2019-10-10 07:17:45'),
(8, 'Pendiente', '2019-10-10 07:17:45', '2019-10-10 07:17:45'),
(9, 'Pendiente', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(10, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(11, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(12, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(13, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(14, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(15, 'Pendiente', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(16, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(17, 'Vencido', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(18, 'Cancelado', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(19, 'Pendiente', '2019-10-10 07:17:46', '2019-10-10 07:17:46'),
(20, 'Vencido', '2019-10-10 07:17:46', '2019-10-10 07:17:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cuenta`
--

CREATE TABLE `tbl_tipo_cuenta` (
  `id_tipo_cuenta` int(10) UNSIGNED NOT NULL,
  `cuenta` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_cuenta`
--

INSERT INTO `tbl_tipo_cuenta` (`id_tipo_cuenta`, `cuenta`, `created_at`, `updated_at`) VALUES
(1, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(2, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(3, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(4, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(5, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(6, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(7, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(8, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(9, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(10, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(11, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(12, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(13, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(14, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(15, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(16, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(17, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(18, 'por pagar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(19, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21'),
(20, 'por cobrar', '2019-10-10 07:26:21', '2019-10-10 07:26:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `tipo_usuario` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `tipo_usuario`, `usuario`, `password`, `nombre`, `telefono`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'inquilino', 'tgusikowski', 'ni+p,`eZdTrZ(vkDJhKF', 'Kelvin Farrell', '745.598.4438', 0, '2019-10-10 06:42:57', '2019-10-10 06:42:57'),
(2, 'inquilino', 'durgan.jena', ';I`f<sp}<kFI.$', 'Prof. Garth Veum', '582.808.9392 x83133', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(3, 'inquilino', 'corkery.ethelyn', '#<Yg?=)=p)b*s:o_', 'Lillian Sanford', '+1-749-244-6103', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(4, 'inquilino', 'harvey.fleta', 'yMJjb1+jK!', 'Ruben Kshlerin', '807.898.0035', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(5, 'inquilino', 'mccullough.melody', 'NFu&z]%', 'Phoebe Bergstrom', '236-728-5768', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(6, 'inquilino', 'ludwig51', '-(8`V]c', 'Lesley Flatley', '(640) 366-6877', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(7, 'inquilino', 'maiya45', 'g~p}2q', 'Prof. Bertha Stamm', '206.913.9707 x391', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(8, 'inquilino', 'nyasia45', 'M:lgc:j.j*}+j', 'Julien Jones', '956-485-6474 x3154', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(9, 'inquilino', 'swift.oscar', 'a+9Y|v*', 'Travis Ledner', '323.938.2664', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(10, 'inquilino', 'mante.emelia', '$@16+{^pf', 'Emmy Huel MD', '+1.738.265.3239', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(11, 'inquilino', 'bosco.jerrold', 'u90=bI)a', 'Roberta Douglas', '1-973-536-1785', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(12, 'inquilino', 'shoppe', ';&1hTR&', 'Mr. Carey Bergnaum', '1-958-400-0860 x6891', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(13, 'inquilino', 'cummerata.jasper', 'Z>G:\"Vd<?TUhN', 'Maida Boyle', '1-360-348-5666 x6025', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(14, 'inquilino', 'upton.edyth', 'N%A>LP_N!>)vD', 'Eugene Shanahan', '1-830-776-4385', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(15, 'inquilino', 'heller.josh', '[adRs<D', 'Miss Adeline Mante', '(957) 675-0970 x41028', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(16, 'inquilino', 'ofahey', 'Xz,DCRfo1p}UTdKwa', 'Miss Hailie Konopelski Sr.', '1-587-338-0310 x59364', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(17, 'inquilino', 'arlene97', 'bW0znK#+E^C_', 'Ollie Jacobson', '1-342-419-0040', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(18, 'inquilino', 'abigayle44', 'm!x4|}I>{9dJ\\}w(lwU', 'Miracle Kohler', '865.960.5909 x01305', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(19, 'inquilino', 'henderson69', '3V(&:n1', 'Dr. Miller VonRueden PhD', '(981) 276-8441 x90196', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58'),
(20, 'inquilino', 'einar.marvin', '5%V>wPKUfF[[\\D', 'Keith Zulauf', '220.734.6839', 0, '2019-10-10 06:42:58', '2019-10-10 06:42:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_condominio`
--
ALTER TABLE `tbl_condominio`
  ADD PRIMARY KEY (`id_condominio`);

--
-- Indices de la tabla `tbl_cuentas`
--
ALTER TABLE `tbl_cuentas`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `tbl_cuentas_id_proveedor_foreign` (`id_proveedor`),
  ADD KEY `tbl_cuentas_id_tipo_cuenta_foreign` (`id_tipo_cuenta`);

--
-- Indices de la tabla `tbl_gastos_condominio`
--
ALTER TABLE `tbl_gastos_condominio`
  ADD PRIMARY KEY (`id_gasto_condominio`),
  ADD KEY `tbl_gastos_condominio_id_condominio_foreign` (`id_condominio`);

--
-- Indices de la tabla `tbl_inmueble`
--
ALTER TABLE `tbl_inmueble`
  ADD PRIMARY KEY (`id_inmueble`),
  ADD UNIQUE KEY `tbl_inmueble_nro_inmueble_unique` (`nro_inmueble`),
  ADD KEY `tbl_inmueble_id_condominio_foreign` (`id_condominio`);

--
-- Indices de la tabla `tbl_pagos_inmueble`
--
ALTER TABLE `tbl_pagos_inmueble`
  ADD KEY `tbl_pagos_inmueble_id_recibo_inmueble_foreign` (`id_recibo_inmueble`),
  ADD KEY `tbl_pagos_inmueble_id_status_pago_foreign` (`id_status_pago`);

--
-- Indices de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tbl_recibo_inmueble`
--
ALTER TABLE `tbl_recibo_inmueble`
  ADD PRIMARY KEY (`id_recibo_inmueble`),
  ADD KEY `tbl_recibo_inmueble_id_inmueble_foreign` (`id_inmueble`),
  ADD KEY `tbl_recibo_inmueble_id_status_pago_foreign` (`id_status_pago`);

--
-- Indices de la tabla `tbl_status_pago`
--
ALTER TABLE `tbl_status_pago`
  ADD PRIMARY KEY (`id_status_pago`);

--
-- Indices de la tabla `tbl_tipo_cuenta`
--
ALTER TABLE `tbl_tipo_cuenta`
  ADD PRIMARY KEY (`id_tipo_cuenta`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_condominio`
--
ALTER TABLE `tbl_condominio`
  MODIFY `id_condominio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_cuentas`
--
ALTER TABLE `tbl_cuentas`
  MODIFY `id_cuenta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_gastos_condominio`
--
ALTER TABLE `tbl_gastos_condominio`
  MODIFY `id_gasto_condominio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_inmueble`
--
ALTER TABLE `tbl_inmueble`
  MODIFY `id_inmueble` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `tbl_proveedores`
--
ALTER TABLE `tbl_proveedores`
  MODIFY `id_proveedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbl_recibo_inmueble`
--
ALTER TABLE `tbl_recibo_inmueble`
  MODIFY `id_recibo_inmueble` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_status_pago`
--
ALTER TABLE `tbl_status_pago`
  MODIFY `id_status_pago` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cuenta`
--
ALTER TABLE `tbl_tipo_cuenta`
  MODIFY `id_tipo_cuenta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_cuentas`
--
ALTER TABLE `tbl_cuentas`
  ADD CONSTRAINT `tbl_cuentas_id_proveedor_foreign` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id_proveedor`),
  ADD CONSTRAINT `tbl_cuentas_id_tipo_cuenta_foreign` FOREIGN KEY (`id_tipo_cuenta`) REFERENCES `tbl_tipo_cuenta` (`id_tipo_cuenta`);

--
-- Filtros para la tabla `tbl_gastos_condominio`
--
ALTER TABLE `tbl_gastos_condominio`
  ADD CONSTRAINT `tbl_gastos_condominio_id_condominio_foreign` FOREIGN KEY (`id_condominio`) REFERENCES `tbl_condominio` (`id_condominio`);

--
-- Filtros para la tabla `tbl_inmueble`
--
ALTER TABLE `tbl_inmueble`
  ADD CONSTRAINT `tbl_inmueble_id_condominio_foreign` FOREIGN KEY (`id_condominio`) REFERENCES `tbl_condominio` (`id_condominio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_pagos_inmueble`
--
ALTER TABLE `tbl_pagos_inmueble`
  ADD CONSTRAINT `tbl_pagos_inmueble_id_recibo_inmueble_foreign` FOREIGN KEY (`id_recibo_inmueble`) REFERENCES `tbl_recibo_inmueble` (`id_recibo_inmueble`),
  ADD CONSTRAINT `tbl_pagos_inmueble_id_status_pago_foreign` FOREIGN KEY (`id_status_pago`) REFERENCES `tbl_status_pago` (`id_status_pago`);

--
-- Filtros para la tabla `tbl_recibo_inmueble`
--
ALTER TABLE `tbl_recibo_inmueble`
  ADD CONSTRAINT `tbl_recibo_inmueble_id_inmueble_foreign` FOREIGN KEY (`id_inmueble`) REFERENCES `tbl_inmueble` (`id_inmueble`),
  ADD CONSTRAINT `tbl_recibo_inmueble_id_status_pago_foreign` FOREIGN KEY (`id_status_pago`) REFERENCES `tbl_status_pago` (`id_status_pago`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
