-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2023 a las 02:09:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos_extras`
--

CREATE TABLE `bonos_extras` (
  `id` bigint(20) NOT NULL,
  `id_pago_extra` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `id_campana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campanas`
--

CREATE TABLE `campanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text NOT NULL,
  `retorno` float NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `cupos` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_retorno` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campanas`
--

INSERT INTO `campanas` (`id`, `nombre`, `retorno`, `estado`, `tipo`, `cupos`, `fecha_inicio`, `fecha_fin`, `fecha_retorno`) VALUES
(8, 'stake', 10, 1, 1, 100, '2023-03-01 17:20:00', '2023-03-31 17:20:00', '2023-04-03'),
(9, 'Bono Extra', 5000, 1, 2, 0, '2023-03-01 18:10:00', '2023-03-31 18:10:00', '2023-04-03'),
(10, '[{\"inversiones\":\"1\",\"retorno\":\"1000\"}]', 0, 1, 5, 0, '2023-03-01 18:10:00', '2023-03-31 18:10:00', '2023-04-03'),
(11, 'Bono Bienvenida', 8000, 1, 7, 0, '2023-03-01 18:11:00', '2023-03-31 18:11:00', '2023-04-03'),
(12, 'Bono Apalancamiento', 10, 1, 4, 0, '2023-03-01 18:11:00', '2023-03-31 18:11:00', '2023-04-03');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `doc_usuario` bigint(20) NOT NULL,
  `campana` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`id`, `foto`, `fecha`, `estado`, `valor`, `doc_usuario`, `campana`) VALUES
(1, 'vistas/img/comprobantes/32707/390.png', '2023-03-20 22:44:40', 1, 100000, 32707, 8),
(2, 'vistas/img/comprobantes/32707/640.png', '2023-03-20 22:44:41', 1, 50000, 32707, 8);

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
(2, '34234234', 96, 'cedula de ciudadania', 324233, 'nombre titular', 'davivienda', 1, 'ahorros', '2023-03-20 22:41:45'),
(3, '312321', 94, 'cedula de ciudadania', 2131232, 'nombre', 'bancolombia', 1, 'ahorros', '2023-03-20 23:30:48');

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
(7, 'red', 1, 93, 0, '2023-03-20 20:38:33'),
(8, 'red', 93, 94, 0, '2023-03-20 20:53:33'),
(9, 'red', 93, 95, 0, '2023-03-20 20:55:25'),
(10, 'red', 93, 96, 0, '2023-03-20 20:55:51'),
(11, 'red', 93, 97, 0, '2023-03-20 20:56:16'),
(12, 'red', 93, 98, 0, '2023-03-20 20:58:39'),
(13, 'red', 96, 99, 0, '2023-03-20 21:01:03'),
(14, 'red', 1, 100, 0, '2023-03-20 21:24:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_afiliados`
--

CREATE TABLE `pagos_afiliados` (
  `id` int(11) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `id_cuenta` int(11) NOT NULL DEFAULT 0,
  `afiliados` int(11) NOT NULL,
  `id_campana` bigint(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_cuenta` int(11) NOT NULL,
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
(1, 96, 1, 0, 1, 2, '2023-03-20 22:45:00'),
(2, 96, 2, 0, 0, 0, '2023-03-20 22:44:41');

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
-- Estructura de tabla para la tabla `red_binaria`
--

CREATE TABLE `red_binaria` (
  `id_binaria` int(11) NOT NULL,
  `usuario_red` int(11) NOT NULL,
  `orden_binaria` int(11) NOT NULL,
  `derrame_binaria` int(11) NOT NULL,
  `patrocinador_red` text DEFAULT NULL,
  `fecha_binaria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `red_binaria`
--

INSERT INTO `red_binaria` (`id_binaria`, `usuario_red`, `orden_binaria`, `derrame_binaria`, `patrocinador_red`, `fecha_binaria`) VALUES
(1, 1, 1, 0, 'admin-trading', '2023-03-20 00:53:00'),
(69, 94, 3, 1, 'admin-trading', '2023-03-20 21:53:20'),
(70, 95, 4, 1, 'admin-trading', '2023-03-20 22:46:29'),
(72, 97, 6, 1, 'admin-trading', '2023-03-20 21:53:20'),
(73, 98, 7, 1, 'admin-trading', '2023-03-20 21:53:20'),
(74, 99, 8, 1, 'admin-trading', '2023-03-20 22:46:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_uninivel`
--

CREATE TABLE `red_uninivel` (
  `id_uninivel` int(11) NOT NULL,
  `usuario_red` int(11) NOT NULL,
  `patrocinador_red` text DEFAULT NULL,
  `fecha_uninivel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `red_uninivel`
--

INSERT INTO `red_uninivel` (`id_uninivel`, `usuario_red`, `patrocinador_red`, `fecha_uninivel`) VALUES
(1, 1, 'admin-trading', '2022-11-16 03:31:13'),
(82, 94, 'admin-trading', '2023-03-20 21:53:20'),
(83, 95, 'admin-trading', '2023-03-20 22:46:30'),
(85, 97, 'admin-trading', '2023-03-20 21:53:20'),
(86, 98, 'admin-trading', '2023-03-20 21:53:20'),
(87, 99, 'admin-trading', '2023-03-20 22:46:30');

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
(3, 1, 91, 'prueba', '<p>fdsfdf</p>', '[\"vistas\\/img\\/tickets\\/1\\/822.png\",\"vistas\\/img\\/tickets\\/1\\/898.png\"]', 'enviado', NULL, '2023-03-20 02:27:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
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
(1, 1, 'admin', 'Administrador', 'Administrador', 'admin@trading.com', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 1, 0, NULL, '2019-10-07', 1, NULL, 'vistas/img/usuarios/1/434.jpg', 'admin-trading', NULL, NULL, NULL, '+57 (321)85749', 'firma', '2023-01-01', '2019-09-27 19:13:02', 0),
(96, 32707, 'usuario', 'Ford-', 'Fernando Guzman Perez', 'fernando@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 1, NULL, NULL, 1, '5c9da67f026979f60685dc07efc1be3c', NULL, 'ford-2707', 'admin-trading', 'Israel', 'IL', '+972 (123) 123-1231', NULL, '2023-03-20', '2023-03-20 20:55:51', 1),
(97, 90532, 'usuario', 'pedro-', 'pedro pablo', 'pedro@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'c3b7f393410fe6185ba5d966a213a38f', NULL, 'pedro-0532', 'admin-trading', 'Colombia', 'CO', '+57 (123) 123-1231', NULL, '2023-03-20', '2023-03-20 20:56:16', 0),
(95, 324111, 'usuario', 'G20-', 'German Hernandez', 'g20@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '71afdcdc3be4a849f1bb28592ddd7829', NULL, 'g20-4111', 'admin-trading', 'Israel', 'IL', '+972 (312) 312-3123', NULL, '2023-03-20', '2023-03-20 20:55:24', 0),
(99, 3243083, 'usuario', 'kkk-2184', 'jjj', 'kk@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '089997d94e3b73aac3839d9543dd0ca2', NULL, 'kkk-3083', 'admin-trading', 'Israel', 'IL', '+972 (123) 123-1231', NULL, '2023-03-20', '2023-03-20 21:01:02', 0),
(94, 35435345, 'usuario', 'prueba-', 'prueba', 'prueba@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, 'c81b5136bcd10b4390108c979ed28ee6', NULL, 'prueba-5345', 'admin-trading', 'Israel', 'IL', '+972 (312) 312-3123', NULL, '2023-03-20', '2023-03-20 20:53:32', 0),
(98, 90324324, 'usuario', 'prueba2-', 'prueba dos', 'prueba2@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '489dff475d3a6f73dee71c2361aad42e', NULL, 'prueba2-4324', 'admin-trading', 'Israel', 'IL', '+972 (312) 312-3123', NULL, '2023-03-20', '2023-03-20 20:58:39', 0),
(100, 345032452, 'usuario', 'pepe-3947', 'pepe', 'pepe@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, 0, NULL, NULL, 1, '6b0becddecd5a06042b3f8078c97f2e0', NULL, 'pepe-2452', 'admin-trading', 'Albania', 'AL', '+355 (123) 131-2312', NULL, '2023-03-20', '2023-03-20 21:24:11', 1);

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bonos_extras`
--
ALTER TABLE `bonos_extras`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bonos_extras`
--
ALTER TABLE `bonos_extras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campanas`
--
ALTER TABLE `campanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuentas_bancarias`
--
ALTER TABLE `cuentas_bancarias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `niveles_comision`
--
ALTER TABLE `niveles_comision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pagos_afiliados`
--
ALTER TABLE `pagos_afiliados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_bienvenida`
--
ALTER TABLE `pagos_bienvenida`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos_comisiones`
--
ALTER TABLE `pagos_comisiones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_extras`
--
ALTER TABLE `pagos_extras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_inversiones`
--
ALTER TABLE `pagos_inversiones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagos_publicidad`
--
ALTER TABLE `pagos_publicidad`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_recurrencia`
--
ALTER TABLE `pagos_recurrencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `pagos_uninivel`
--
ALTER TABLE `pagos_uninivel`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `red_binaria`
--
ALTER TABLE `red_binaria`
  MODIFY `id_binaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `red_uninivel`
--
ALTER TABLE `red_uninivel`
  MODIFY `id_uninivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `id_soporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD CONSTRAINT `comprobantes_ibfk_1` FOREIGN KEY (`doc_usuario`) REFERENCES `usuarios` (`doc_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
