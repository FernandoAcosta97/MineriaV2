-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2024 a las 17:23:02
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
-- Base de datos: `trading`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliados_recurrentes`
--

CREATE TABLE `afiliados_recurrentes` (
  `id` bigint(20) NOT NULL,
  `id_pago_afiliados` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_comprobante` bigint(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `afiliados_recurrentes`
--

INSERT INTO `afiliados_recurrentes` (`id`, `id_pago_afiliados`, `id_usuario`, `id_comprobante`, `fecha`) VALUES
(30, 15, 104, 129, '2024-01-15 22:33:36'),
(31, 15, 127, 130, '2024-01-15 22:33:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos_extras`
--

CREATE TABLE `bonos_extras` (
  `id` bigint(20) NOT NULL,
  `id_pago_extra` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_comprobante` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campanas`
--

CREATE TABLE `campanas` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `retorno` float NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `cupos` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_retorno` date NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campanas`
--

INSERT INTO `campanas` (`id`, `nombre`, `retorno`, `estado`, `tipo`, `cupos`, `fecha_inicio`, `fecha_fin`, `fecha_retorno`, `condicion`) VALUES
(1, 'stake1', 10, 1, 1, 100, '2023-03-09 15:17:00', '2023-04-28 15:17:00', '2023-05-05', 0),
(7, 'publicidad1', 5000, 1, 3, 100, '2023-03-14 11:40:00', '2023-04-27 11:40:00', '2023-05-06', 0),
(9, 'Bono Apalancamiento', 10, 1, 4, 0, '2023-03-14 19:36:00', '2023-04-27 19:36:00', '2023-05-06', 0),
(10, '[{\"afiliados\":\"1\",\"retorno\":\"1000\"},{\"afiliados\":\"2\",\"retorno\":\"2000\"}]', 0, 1, 6, 0, '2023-03-22 19:37:00', '2023-08-31 19:37:00', '2023-05-06', 0),
(11, 'Bono Bienvenida', 5000, 1, 7, 0, '2023-03-13 19:38:00', '2023-04-27 19:38:00', '2023-05-06', 0),
(12, '[{\"inversiones\":\"1\",\"retorno\":\"5000\"},{\"inversiones\":\"2\",\"retorno\":\"10000\"}]', 0, 2, 5, 0, '2023-03-21 19:38:00', '2023-04-28 19:38:00', '2023-05-06', 0),
(13, 'Bono Extra', 1000, 2, 2, 0, '2023-03-21 20:23:00', '2023-04-28 20:23:00', '2023-05-06', 0),
(14, 'Bono Extra', 2000, 2, 2, 0, '2023-03-31 18:59:00', '2023-05-05 18:59:00', '2023-05-12', 0),
(21, 'prueba check win', 23, 1, 1, 232323, '2023-05-17 16:05:00', '2023-06-02 16:05:00', '2023-05-25', 1),
(23, 'prueba check uni', 34, 0, 1, 123, '2023-06-23 09:26:00', '2023-06-24 09:26:00', '2023-06-30', 1),
(24, 'prueba check gd', 23, 1, 1, 1000, '2023-06-21 09:32:00', '2023-06-22 09:32:00', '2023-06-28', 1),
(27, 'Bono Bienvenida', 2000, 0, 7, 0, '2023-07-21 21:56:00', '2023-07-29 21:57:00', '2023-07-27', 0),
(28, 'Bono Extra', 2000, 1, 2, 0, '2023-07-05 16:27:00', '2023-07-29 16:27:00', '2023-07-28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text NOT NULL,
  `ruta_categoria` text NOT NULL,
  `descripcion_categoria` text NOT NULL,
  `icono_categoria` text NOT NULL,
  `color_categoria` text NOT NULL,
  `fecha_categoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id` bigint(20) NOT NULL,
  `id_pago_comision` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id`, `id_pago_comision`, `id_comprobante`, `nivel`) VALUES
(37, 19, 129, 1),
(38, 19, 130, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `id` bigint(20) NOT NULL,
  `foto` text NOT NULL,
  `billetera` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `doc_usuario` bigint(20) NOT NULL,
  `campana` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`id`, `foto`, `billetera`, `fecha`, `estado`, `valor`, `doc_usuario`, `campana`) VALUES
(145, 'vistas/img/comprobantes/3342234/524.jpg', 3, '2024-01-30 23:06:11', 1, 1000000, 3342234, 1),
(146, 'vistas/img/comprobantes/1231231235566/723.jpg', 3, '2024-01-31 02:42:19', 1, 200000, 1231231235566, 1),
(147, '', 1, '2024-01-31 02:45:02', 1, 20000, 1231231235566, 1),
(148, '', 1, '2024-02-08 16:30:18', 1, 100000, 3342234, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_bancarias`
--

CREATE TABLE `cuentas_bancarias` (
  `id` bigint(20) NOT NULL,
  `numero` text DEFAULT NULL,
  `usuario` bigint(20) NOT NULL,
  `tipo_documento` text NOT NULL,
  `titular` bigint(20) NOT NULL,
  `nombre_titular` text NOT NULL,
  `entidad` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 2,
  `tipo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentas_bancarias`
--

INSERT INTO `cuentas_bancarias` (`id`, `numero`, `usuario`, `tipo_documento`, `titular`, `nombre_titular`, `entidad`, `estado`, `tipo`, `fecha`) VALUES
(1, '2312313', 101, 'cedula de ciudadania', 213123, 'nombre titular', 'davivienda', 1, 'ahorros', '2023-03-23 20:18:44'),
(2, '324', 102, 'cedula de ciudadania', 324, 'nombre titular', 'davivienda', 0, 'corriente', '2023-04-13 22:26:27'),
(4, '342', 102, 'cedula de ciudadania', 4324, 'nombre titular', 'bancolombia', 1, 'ahorros', '2023-04-13 22:26:28'),
(5, '9078621', 104, 'cedula de ciudadania', 3345665, 'nombre', 'davivienda', 1, 'ahorros', '2023-04-14 23:36:16'),
(6, '7877656545', 103, 'cedula de ciudadania', 567673, 'nombre', 'Wester Union', 1, 'otro', '2023-04-15 00:07:14'),
(9, '32423423', 106, 'cedula de ciudadania', 234234234, 'nombre titular', 'Wester Union', 0, 'ahorros', '2023-05-17 01:45:30'),
(10, '6546456', 106, 'cedula de ciudadania', 435345, 'nombre titular', 'bbva', 0, 'corriente', '2023-05-16 22:51:28'),
(11, '324234', 106, 'cedula de ciudadania', 324, 'nombre titular', 'banco agrario', 0, 'corriente', '2023-05-25 16:41:21'),
(12, '123123', 106, 'cedula de ciudadania', 123, 'nombre titular', 'itau', 1, 'ahorros', '2023-05-25 16:41:21'),
(13, '168465161', 110, 'cedula de ciudadania', 156161, 'nombre titular', 'itau', 1, 'ahorros', '2023-05-31 15:10:01'),
(14, '213', 123, 'cedula de ciudadania', 3243, 'sdfsdf', 'banco popular', 1, 'ahorros', '2023-06-20 22:01:17'),
(15, '6518919818', 124, 'cedula de ciudadania', 1651691, 'nombre titular', 'banco davivienda sa', 1, 'ahorros', '2023-07-14 15:03:54'),
(16, '345234', 127, 'cedula de ciudadania', 3243, 'nombre titular', 'banco cooperativo coopcentral', 1, 'ahorros', '2023-07-15 21:35:38'),
(17, '213123', 8011, 'cedula de ciudadania', 31231, 'sdas', 'davivienda', 1, 'ahorros', '2024-01-31 02:41:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_comision`
--

CREATE TABLE `niveles_comision` (
  `id` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `porcentaje` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `tipo` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_detalle` int(11) NOT NULL,
  `visualizacion` int(11) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `tipo`, `id_usuario`, `id_detalle`, `visualizacion`, `fecha`) VALUES
(1, 'red', 1, 110, 0, '2023-05-16 15:15:13'),
(2, 'soporte', 1, 1, 1, '2023-05-19 22:55:25'),
(3, 'red', 1, 110, 0, '2023-05-16 18:07:52'),
(4, 'red', 1, 111, 0, '2023-06-01 02:34:45'),
(5, 'soporte', 111, 2, 0, '2023-06-01 04:20:06'),
(6, 'red', 1, 115, 0, '2023-06-01 14:30:30'),
(7, 'red', 1, 116, 0, '2023-06-03 01:32:23'),
(8, 'red', 1, 123, 0, '2023-06-20 22:01:03'),
(9, 'red', 1, 125, 0, '2023-07-11 20:14:26'),
(10, 'red', 1, 124, 0, '2023-07-12 01:29:22'),
(11, 'red', 102, 127, 0, '2023-07-15 21:34:27'),
(12, 'red', 131, 132, 0, '2023-07-20 13:43:16'),
(13, 'red', 131, 132, 0, '2023-07-20 13:52:12'),
(14, 'red', 2, 132, 0, '2023-07-20 13:59:03'),
(15, 'red', 1, 8011, 0, '2024-01-31 02:41:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_afiliados`
--

CREATE TABLE `pagos_afiliados` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `id_cuenta` int(11) NOT NULL DEFAULT 0,
  `afiliados` int(11) NOT NULL,
  `id_campana` bigint(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_afiliados`
--

INSERT INTO `pagos_afiliados` (`id`, `id_usuario`, `valor`, `estado`, `id_cuenta`, `afiliados`, `id_campana`, `fecha`) VALUES
(15, 102, 0, 0, 0, 0, 10, '2024-01-15 22:33:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_bienvenida`
--

CREATE TABLE `pagos_bienvenida` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `estado` int(11) NOT NULL,
  `valor` double NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `id_campana` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_comisiones`
--

CREATE TABLE `pagos_comisiones` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `valor` double NOT NULL,
  `estado` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pagos_comisiones`
--

INSERT INTO `pagos_comisiones` (`id`, `id_usuario`, `valor`, `estado`, `id_cuenta`, `fecha`) VALUES
(19, 102, 0, 0, 0, '2024-01-15 22:33:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_extras`
--

CREATE TABLE `pagos_extras` (
  `id` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `referidos_obtenidos` int(11) NOT NULL DEFAULT 0,
  `valor` double NOT NULL DEFAULT 0,
  `id_cuenta` bigint(20) NOT NULL,
  `id_campana` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_inversiones`
--

CREATE TABLE `pagos_inversiones` (
  `id` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_comprobante` bigint(20) NOT NULL,
  `id_apalancamiento` int(11) DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 0,
  `id_cuenta` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pagos_inversiones`
--

INSERT INTO `pagos_inversiones` (`id`, `id_usuario`, `id_comprobante`, `id_apalancamiento`, `estado`, `id_cuenta`, `fecha`) VALUES
(74, 124, 145, 0, 1, 15, '2024-01-30 23:07:08'),
(75, 8011, 146, 0, 1, 17, '2024-01-31 02:43:17'),
(76, 8011, 147, 0, 1, 17, '2024-01-31 02:52:30'),
(80, 124, 148, 0, 0, 0, '2024-02-08 16:30:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_publicidad`
--

CREATE TABLE `pagos_publicidad` (
  `id` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `valor` double NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 0,
  `id_cuenta` int(11) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_recurrencia`
--

CREATE TABLE `pagos_recurrencia` (
  `id` int(11) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `valor` float NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `id_cuenta` int(11) NOT NULL DEFAULT 0,
  `inversiones` int(11) NOT NULL,
  `id_campana` bigint(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_recurrencia`
--

INSERT INTO `pagos_recurrencia` (`id`, `id_usuario`, `valor`, `estado`, `id_cuenta`, `inversiones`, `id_campana`, `fecha`) VALUES
(21, 106, 5000, 1, 3, 1, 12, '2023-04-20 06:28:17'),
(24, 103, 5000, 1, 6, 1, 12, '2023-04-20 06:28:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_uninivel`
--

CREATE TABLE `pagos_uninivel` (
  `id_pago` int(11) NOT NULL,
  `id_pago_paypal` text DEFAULT NULL,
  `usuario_pago` int(11) NOT NULL,
  `periodo` text NOT NULL,
  `periodo_comision` float NOT NULL,
  `periodo_venta` float NOT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rec_comprobantes`
--

CREATE TABLE `rec_comprobantes` (
  `id` int(11) NOT NULL,
  `id_comprobante` bigint(20) NOT NULL,
  `n_recibo` text NOT NULL,
  `n_cuenta` bigint(20) NOT NULL,
  `n_aprobado` int(11) NOT NULL,
  `n_valor` double NOT NULL,
  `fecha` date NOT NULL,
  `detalles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rec_comprobantes`
--

INSERT INTO `rec_comprobantes` (`id`, `id_comprobante`, `n_recibo`, `n_cuenta`, `n_aprobado`, `n_valor`, `fecha`, `detalles`) VALUES
(5, 128, '031216', 84100002403, 354869, 200000, '2023-03-09', 'La fecha no es de hoy-El número de cuenta no es correcto'),
(6, 129, '134723', 84100002402, 673695, 200000, '2023-03-09', 'La fecha no es de hoy-El número de cuenta no es correcto'),
(7, 130, '031216', 84100002403, 354869, 200000, '2023-03-09', 'La fecha no es de hoy-El número de cuenta no es correcto-El número de recibo ya se encuentra registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rec_comprobantes_publicidad`
--

CREATE TABLE `rec_comprobantes_publicidad` (
  `id` int(11) NOT NULL,
  `id_comprobante` bigint(20) NOT NULL,
  `detalles` text NOT NULL,
  `vistas` int(11) NOT NULL,
  `mi_estado` text NOT NULL,
  `fecha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_binaria`
--

CREATE TABLE `red_binaria` (
  `id_binaria` int(11) NOT NULL,
  `usuario_red` bigint(20) NOT NULL,
  `orden_binaria` int(11) NOT NULL,
  `derrame_binaria` int(11) NOT NULL,
  `patrocinador_red` text DEFAULT NULL,
  `fecha_binaria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `red_binaria`
--

INSERT INTO `red_binaria` (`id_binaria`, `usuario_red`, `orden_binaria`, `derrame_binaria`, `patrocinador_red`, `fecha_binaria`) VALUES
(1, 1, 1, 0, 'admin-trading', '2023-03-23 17:08:34'),
(2, 2, 2, 1, 'admin-trading', '2023-07-20 13:57:26'),
(78, 102, 3, 1, 'admin-trading', '2023-04-20 17:39:14'),
(79, 103, 4, 1, 'admin-trading', '2023-04-20 17:39:14'),
(80, 104, 5, 3, 'pedro-5435', '2023-04-18 16:12:11'),
(81, 106, 6, 1, 'admin-trading', '2023-04-20 17:39:15'),
(84, 110, 7, 1, 'admin-trading', '2023-05-16 15:15:14'),
(85, 110, 8, 1, 'admin-trading', '2023-05-16 18:07:52'),
(86, 111, 9, 1, 'admin-trading', '2023-06-01 02:34:46'),
(87, 115, 10, 1, 'admin-trading', '2023-06-01 14:30:31'),
(88, 116, 11, 1, 'admin-trading', '2023-06-03 01:32:24'),
(89, 123, 12, 1, 'admin-trading', '2023-06-20 22:01:03'),
(90, 125, 13, 1, 'admin-trading', '2023-07-11 20:14:26'),
(91, 124, 14, 1, 'admin-trading', '2023-07-12 01:29:22'),
(92, 127, 15, 3, 'pedro-5435', '2023-07-15 21:34:28'),
(93, 132, 16, 2, 'sin-patrocinador', '2023-07-20 13:59:03'),
(94, 8011, 17, 1, 'admin-mineria', '2024-01-31 02:41:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_uninivel`
--

CREATE TABLE `red_uninivel` (
  `id_uninivel` int(11) NOT NULL,
  `usuario_red` bigint(20) NOT NULL,
  `patrocinador_red` text DEFAULT NULL,
  `fecha_uninivel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `red_uninivel`
--

INSERT INTO `red_uninivel` (`id_uninivel`, `usuario_red`, `patrocinador_red`, `fecha_uninivel`) VALUES
(1, 1, 'admin-trading', '2023-03-23 17:09:48'),
(2, 2, 'sin-patrocinador', '2023-07-20 13:56:40'),
(91, 102, 'admin-trading', '2023-04-20 17:39:14'),
(92, 103, 'admin-trading', '2023-04-20 17:39:15'),
(93, 104, 'pedro-5435', '2023-04-18 16:12:11'),
(95, 106, 'admin-trading', '2023-04-20 17:39:15'),
(96, 110, 'admin-trading', '2023-05-16 15:15:13'),
(97, 110, 'admin-trading', '2023-05-16 18:07:52'),
(98, 111, 'admin-trading', '2023-06-01 02:34:45'),
(99, 115, 'admin-trading', '2023-06-01 14:30:30'),
(100, 116, 'admin-trading', '2023-06-03 01:32:23'),
(101, 123, 'admin-trading', '2023-06-20 22:01:03'),
(102, 125, 'admin-trading', '2023-07-11 20:14:26'),
(103, 124, 'admin-trading', '2023-07-12 01:29:22'),
(104, 127, 'pedro-5435', '2023-07-15 21:34:25'),
(105, 132, 'sin-patrocinador', '2023-07-20 13:43:16'),
(106, 132, 'sin-patrocinador', '2023-07-20 13:52:12'),
(107, 132, 'sin-patrocinador', '2023-07-20 13:59:03'),
(108, 8011, 'admin-mineria', '2024-01-31 02:41:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id` int(11) NOT NULL,
  `usuario` bigint(20) NOT NULL,
  `tipo` int(11) NOT NULL,
  `billetera` int(11) NOT NULL,
  `valor` double NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 2,
  `id_cuenta` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `retiros`
--

INSERT INTO `retiros` (`id`, `usuario`, `tipo`, `billetera`, `valor`, `estado`, `id_cuenta`, `fecha`) VALUES
(19, 124, 2, 0, 100000, 1, 15, '2024-02-08 15:51:17'),
(20, 8011, 2, 0, 20000, 2, 0, '2024-01-31 02:51:55'),
(21, 124, 2, 0, 100000, 2, 0, '2024-02-08 15:50:21'),
(22, 124, 2, 0, 50000, 2, 0, '2024-02-29 02:46:22'),
(23, 124, 2, 0, 50000, 2, 0, '2024-02-29 03:09:32'),
(24, 124, 2, 0, 50000, 2, 0, '2024-03-01 00:09:19'),
(25, 124, 2, 0, 50000, 2, 0, '2024-03-01 16:08:20'),
(26, 124, 2, 0, 20000, 2, 0, '2024-03-01 16:21:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte`
--

CREATE TABLE `soporte` (
  `id_soporte` int(11) NOT NULL,
  `remitente` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  `asunto` text NOT NULL,
  `mensaje` text NOT NULL,
  `adjuntos` text NOT NULL,
  `tipo` text NOT NULL,
  `papelera` text DEFAULT NULL,
  `fecha_soporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `soporte`
--

INSERT INTO `soporte` (`id_soporte`, `remitente`, `receptor`, `asunto`, `mensaje`, `adjuntos`, `tipo`, `papelera`, `fecha_soporte`) VALUES
(1, 110, 1, 'prueba', '<p>sdfsdfdsf</p>', '[]', 'enviado', NULL, '2023-05-16 15:15:29'),
(2, 1, 111, 'prueba', '<p>dsfsdf</p>', '[\"vistas\\/img\\/tickets\\/1\\/257.jpg\"]', 'enviado', NULL, '2023-06-01 04:20:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` bigint(20) NOT NULL,
  `doc_usuario` bigint(20) NOT NULL,
  `perfil` text NOT NULL,
  `usuario` text NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `operando` int(11) NOT NULL DEFAULT 0,
  `ciclo_pago` int(11) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `verificacion` int(11) NOT NULL DEFAULT 1,
  `email_encriptado` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `enlace_afiliado` text DEFAULT NULL,
  `patrocinador` text DEFAULT NULL,
  `pais` text DEFAULT NULL,
  `codigo_pais` text DEFAULT NULL,
  `telefono_movil` text DEFAULT NULL,
  `firma` text DEFAULT NULL,
  `fecha_contrato` date DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `doc_usuario`, `perfil`, `usuario`, `nombre`, `email`, `password`, `estado`, `operando`, `ciclo_pago`, `vencimiento`, `verificacion`, `email_encriptado`, `foto`, `enlace_afiliado`, `patrocinador`, `pais`, `codigo_pais`, `telefono_movil`, `firma`, `fecha_contrato`, `fecha`, `eliminado`) VALUES
(1, 1, 'admin', 'Admin', 'Administrador', 'admin@mineria.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, NULL, 'vistas/img/usuarios/1/434.jpg', 'admin-mineria', NULL, NULL, NULL, NULL, 'firma', '2023-03-01', '2023-03-23 17:08:03', 0),
(2, 2, 'usuario', 'SP', 'Sin Patrocinador', 'sp@mail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '09550cb48cc3ba1a6467376794879e8b', NULL, 'sin-patrocinador', 'admin-trading', NULL, NULL, NULL, 'firma', '2023-07-12', '2023-07-20 13:30:36', 0),
(106, 165416, 'usuario', 'Guillermo-3867', 'Guillermo Galeano', 'guillermo@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, 'a99d8f8cdc755cdb2150c23b8f50f77a', NULL, 'guillermo-5416', 'prueba-4161', 'Israel', 'IL', '+972 (123) 123-1231', NULL, '2023-04-06', '2023-04-07 01:52:30', 0),
(124, 3342234, 'usuario', 'pruebareg-7614', 'pruebareg', 'pruebareg@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, 'e9d3628ed14b63623ac3999a5acafdf3', NULL, 'pruebareg-7614', 'admin-trading', 'Albania', 'AL', '+57 (321) 95-33094', NULL, '2023-07-11', '2023-07-11 20:11:49', 0),
(102, 5345435, 'usuario', 'pedro-1166', 'pedro pablo', 'pedro@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, 'c3b7f393410fe6185ba5d966a213a38f', NULL, 'pedro-5435', 'prueba-4161', 'Colombia', 'CO', '+57 (312) 312-3123', NULL, '2023-03-23', '2023-03-23 19:19:13', 0),
(101, 9844161, 'usuario', 'prueba-8229', 'prueba', 'prueba@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'c81b5136bcd10b4390108c979ed28ee6', NULL, 'prueba-4161', 'admin-trading', 'Colombia', 'CO', '+57 (123) 123-1231', NULL, '2023-03-23', '2023-03-23 19:18:29', 1),
(111, 16160651, 'usuario', 'Manu-9781', 'Manuel', 'manu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '33d3c8bb1a69755eb37f8208068e011f', NULL, 'manu-9781', 'admin-trading', 'Bahrain', 'BH', '+973 (312) 312-3123', NULL, '2023-05-31', '2023-06-01 02:20:49', 0),
(132, 23123123, 'usuario', 'prueba patrocinador-2862', 'prueba patrocinador', 'pruebapat@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '74b95a7e294b4fd08bf2b533fd91d478', NULL, 'prueba patrocinador-2862', 'sin-patrocinador', 'Colombia', 'CO', '+57 (213) 123-1232', NULL, '2023-07-20', '2023-07-20 13:36:23', 0),
(104, 32423423, 'usuario', 'Ford-2146', 'ford', 'ford@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, 'd9d54b4cccdde0e775e467e0dbd0e9bf', NULL, 'ford-3423', 'pedro-5435', 'Colombia', 'CO', '+57 (123) 123-1231', NULL, '2023-03-23', '2023-03-24 02:23:17', 0),
(110, 324234324, 'usuario', 'G20-3659', 'prueba2', 'prueba2@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '489dff475d3a6f73dee71c2361aad42e', NULL, 'g20-3659', 'admin-trading', 'Algeria', 'DZ', '+213 (123) 123-1231', NULL, '2023-05-16', '2023-05-15 03:51:32', 0),
(103, 631561651, 'usuario', 'pepe-2319', 'pepeliano', 'pepe@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, '6b0becddecd5a06042b3f8078c97f2e0', NULL, 'pepe-1651', 'prueba-4161', 'Colombia', 'CO', '+57 (123) 121-2312', NULL, '2023-03-23', '2023-03-23 20:16:23', 0),
(115, 1065599438, 'usuario', 'deyglis-7988', 'Deyglis', 'deyglis@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '776aa1ac69de71df5f6bc611b7aa658f', NULL, 'deyglis-7988', 'admin-trading', 'Colombia', 'CO', '+57 (123) 123-1231', NULL, '2023-06-01', '2023-06-01 14:29:26', 0),
(105, 26992667097, 'usuario', 'Miguel-7097', 'Miguel Torres', 'miguel@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'c952ec83eabde595820603a3ca9d7f54', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-04-01 15:16:30', 0),
(123, 123123123123, 'usuario', 'ppp-1621', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, 'ppp-1621', 'admin-trading', 'Israel', 'IL', '+972 (123) 123-1231', NULL, '2023-06-20', '2023-06-20 22:00:06', 0),
(8009, 123928872838, 'usuario', 'usu2-2838', 'nombre2', 'usu2@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'fd0c2a2ffe25838510265ed458a7b68e', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:32:45', 0),
(118, 145323616316, 'usuario', 'ppp-6316', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-20 21:53:56', 0),
(114, 159515002328, 'usuario', 'Manu-2328', 'Manuel', 'manu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '33d3c8bb1a69755eb37f8208068e011f', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-01 02:26:27', 1),
(8006, 185699938991, 'usuario', 'usu-8991', 'nombre', 'usup@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '0fe2d3114655d15407209d31aacefed6', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:25:00', 0),
(121, 187870078029, 'usuario', 'ppp-8029', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-20 21:55:26', 0),
(8010, 296227570258, 'usuario', 'usu2-0258', 'usu2', 'usu3@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '7c38d323ba3eeb24faef4738ebf733dc', NULL, NULL, 'admin-mineria', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:33:55', 0),
(116, 342423222222, 'usuario', 'prueba desarrollo-5007', 'prueba desarrollo', 'pruebadesarrollo@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '3d8cc04e72e5edf48a647595b0c6f9a4', NULL, 'prueba desarrollo-5007', 'admin-trading', 'El Salvador', 'SV', '+503 (123) 123-1231', NULL, '2023-06-02', '2023-06-03 01:31:41', 0),
(113, 408495750676, 'usuario', 'Manu-0676', 'Manuel', 'manu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '33d3c8bb1a69755eb37f8208068e011f', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-01 02:24:47', 1),
(107, 438338199386, 'usuario', 'G20-9386', 'prrd', 'ja@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'a4eee038cfd91d7295f4fa86287da5ae', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-05-15 03:47:18', 0),
(126, 514431131641, 'usuario', 'Manu-1641', 'Manuel', 'manuel@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '4201ddc9eb0ad45aaeda7542c7c544de', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-07-12 01:23:51', 0),
(8004, 752529273585, 'usuario', 'usup-3585', 'nombrep', 'usu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '8f96e62490ba479f3bc941e7d0518b9d', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:20:51', 0),
(122, 766729498600, 'usuario', 'ppp-8600', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-20 21:58:11', 0),
(117, 808361649925, 'usuario', 'ppp-9925', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-20 21:51:42', 0),
(112, 822571151932, 'usuario', 'Manu-1932', 'Manuel', 'manu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '33d3c8bb1a69755eb37f8208068e011f', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-01 02:24:34', 1),
(8003, 856798479433, 'usuario', 'usup-9433', 'nombrep', 'usu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '8f96e62490ba479f3bc941e7d0518b9d', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:20:37', 0),
(120, 909673290590, 'usuario', 'ppp-0590', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-20 21:54:39', 0),
(8007, 939836248718, 'usuario', 'usu-8718', 'nombre', 'usus@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aueDmpmNWukm1MepfBEfyduubF/v2DBOG', 1, 0, NULL, NULL, 1, 'ecc222bf7d8a35b744dba3e9a460dea1', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:26:44', 0),
(8008, 944030349358, 'usuario', 'usu2-9358', 'nombre2', 'usu2@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'fd0c2a2ffe25838510265ed458a7b68e', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:30:14', 0),
(8005, 968961387912, 'usuario', 'usup-7912', 'nombrep', 'usu@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 1, 0, NULL, NULL, 1, '8f96e62490ba479f3bc941e7d0518b9d', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:22:35', 0),
(8012, 979798398275, 'usuario', 'ds-8275', 'sd', 'sd@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '29b1968a981dec1abfa82eb934ae0295', NULL, NULL, 'admin-mineria', NULL, NULL, NULL, NULL, NULL, '2024-01-31 02:39:27', 0),
(119, 991917055600, 'usuario', 'ppp-5600', 'pedro pablo', 'sova@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '9f4bcddac3a93b0803f4e5a13b47b3d5', NULL, NULL, 'admin-trading', NULL, NULL, NULL, NULL, NULL, '2023-06-20 21:54:36', 0),
(8011, 1231231235566, 'usuario', 'usu4-3328', 'nombre4', 'usu4@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, 'e9a9f45ade4b4cee64d0fd8d8d03d965', NULL, 'usu4-3328', 'admin-mineria', 'Colombia', 'CO', '+57 (123) 123-1231', NULL, '2024-01-30', '2024-01-31 02:36:05', 0),
(127, 4353453453454, 'usuario', 'Jorge-1965', 'Jorge', 'jorge@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, '5565d5bd5a11eabd173c312ae2b04e3f', NULL, 'jorge-1965', 'pedro-5435', 'Brazil', 'BR', '+55 (435) 345-3453', NULL, '2023-07-15', '2023-07-15 21:33:43', 0),
(125, 89498151111000, 'usuario', 'prueba2-3039', 'prueba2', 'pruebareg2@mail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'eece39b32cc95917efee1b2409ee817c', NULL, 'prueba2-3039', 'admin-trading', 'Albania', 'AL', '+355 (312) 312-3123', NULL, NULL, '2023-07-11 20:12:29', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificacion`
--

CREATE TABLE `verificacion` (
  `id` int(11) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `codigo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `verificacion`
--

INSERT INTO `verificacion` (`id`, `id_usuario`, `codigo`, `fecha`) VALUES
(1, 1, '0', '2024-03-01 16:12:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id_video` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `titulo_video` text NOT NULL,
  `descripcion_video` text NOT NULL,
  `medios_video` text NOT NULL,
  `medios_video_mp4` text NOT NULL,
  `imagen_video` text NOT NULL,
  `vista_gratuita` int(11) NOT NULL,
  `fecha_video` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliados_recurrentes`
--
ALTER TABLE `afiliados_recurrentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pago_afiliados` (`id_pago_afiliados`),
  ADD KEY `id_comprobante` (`id_comprobante`);

--
-- Indices de la tabla `bonos_extras`
--
ALTER TABLE `bonos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pago_extra` (`id_pago_extra`),
  ADD KEY `id_comprobante` (`id_comprobante`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `campanas`
--
ALTER TABLE `campanas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `doc_usuario` (`doc_usuario`);

--
-- Indices de la tabla `cuentas_bancarias`
--
ALTER TABLE `cuentas_bancarias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveles_comision`
--
ALTER TABLE `niveles_comision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_afiliados`
--
ALTER TABLE `pagos_afiliados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_bienvenida`
--
ALTER TABLE `pagos_bienvenida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_comisiones`
--
ALTER TABLE `pagos_comisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_extras`
--
ALTER TABLE `pagos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_campana` (`id_campana`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `pagos_inversiones`
--
ALTER TABLE `pagos_inversiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_publicidad`
--
ALTER TABLE `pagos_publicidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_recurrencia`
--
ALTER TABLE `pagos_recurrencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_uninivel`
--
ALTER TABLE `pagos_uninivel`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `rec_comprobantes`
--
ALTER TABLE `rec_comprobantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rec_comprobantes_publicidad`
--
ALTER TABLE `rec_comprobantes_publicidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `red_binaria`
--
ALTER TABLE `red_binaria`
  ADD PRIMARY KEY (`id_binaria`),
  ADD KEY `red_binaria_ibfk_1` (`usuario_red`);

--
-- Indices de la tabla `red_uninivel`
--
ALTER TABLE `red_uninivel`
  ADD PRIMARY KEY (`id_uninivel`),
  ADD KEY `red_uninivel_ibfk_1` (`usuario_red`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD PRIMARY KEY (`id_soporte`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`doc_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `verificacion`
--
ALTER TABLE `verificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliados_recurrentes`
--
ALTER TABLE `afiliados_recurrentes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `bonos_extras`
--
ALTER TABLE `bonos_extras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `campanas`
--
ALTER TABLE `campanas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `cuentas_bancarias`
--
ALTER TABLE `cuentas_bancarias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `niveles_comision`
--
ALTER TABLE `niveles_comision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pagos_afiliados`
--
ALTER TABLE `pagos_afiliados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pagos_bienvenida`
--
ALTER TABLE `pagos_bienvenida`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pagos_comisiones`
--
ALTER TABLE `pagos_comisiones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `pagos_extras`
--
ALTER TABLE `pagos_extras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pagos_inversiones`
--
ALTER TABLE `pagos_inversiones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `pagos_publicidad`
--
ALTER TABLE `pagos_publicidad`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos_recurrencia`
--
ALTER TABLE `pagos_recurrencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pagos_uninivel`
--
ALTER TABLE `pagos_uninivel`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rec_comprobantes`
--
ALTER TABLE `rec_comprobantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rec_comprobantes_publicidad`
--
ALTER TABLE `rec_comprobantes_publicidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `red_binaria`
--
ALTER TABLE `red_binaria`
  MODIFY `id_binaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `red_uninivel`
--
ALTER TABLE `red_uninivel`
  MODIFY `id_uninivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `id_soporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8013;

--
-- AUTO_INCREMENT de la tabla `verificacion`
--
ALTER TABLE `verificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
