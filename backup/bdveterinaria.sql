-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2023 a las 19:16:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdveterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Perro', '2023-10-11 01:05:56', '2023-10-11 01:05:56'),
(2, 'Gato', '2023-10-11 01:06:54', '2023-10-11 01:06:54'),
(3, 'Conejo', '2023-10-11 01:06:54', '2023-10-11 01:06:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `tip_doc` int(11) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `direccion` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT 0,
  `usu_registro` int(11) DEFAULT NULL,
  `usu_ult_mod` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `tip_doc`, `documento`, `telefono`, `direccion`, `email`, `estado`, `usu_registro`, `usu_ult_mod`, `created_at`, `updated_at`) VALUES
(1, 'Maggi Carol', 'Green', 1, '1111111', '947511255', 'Av. Las Flores', 'maggi@gmail.com', 3, 1, 1, '2023-10-11 03:50:25', '2023-10-11 03:55:42'),
(2, 'Juan', 'Rojas', 1, '44444444', '947511255', 'Av. Las Palmeras', 'juan@gmail.com', 1, 1, 1, '2023-10-11 03:51:29', '2023-10-11 03:51:29'),
(3, 'Juan', 'Perez', 1, '55555555', '947511255', 'Av. Las Palmeras', 'juan@gmail.com', 0, 1, 1, '2023-10-11 04:02:34', '2023-10-11 04:02:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `jornada` varchar(250) NOT NULL,
  `turno` int(11) NOT NULL,
  `horas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `animal_id` int(10) UNSIGNED NOT NULL,
  `raza_id` int(10) UNSIGNED NOT NULL,
  `fec_nac` date DEFAULT NULL,
  `sexo` int(11) NOT NULL,
  `color` varchar(250) NOT NULL,
  `altura` double(8,2) NOT NULL,
  `peso` double(8,2) NOT NULL,
  `estirilizado` int(11) NOT NULL,
  `vacunas` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `usu_registro` int(11) DEFAULT NULL,
  `usu_ult_mod` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id`, `nombre`, `cliente_id`, `animal_id`, `raza_id`, `fec_nac`, `sexo`, `color`, `altura`, `peso`, `estirilizado`, `vacunas`, `estado`, `usu_registro`, `usu_ult_mod`, `created_at`, `updated_at`) VALUES
(1, 'Benito', 1, 2, 1, '2022-09-13', 1, 'negro y blanco', 15.00, 2.50, 0, 1, 1, 1, 1, '2023-10-11 01:12:09', '2023-10-11 01:12:09'),
(2, 'Kala', 2, 1, 2, '2022-09-13', 1, 'blanco', 60.00, 15.50, 1, 0, 1, 1, 1, '2023-10-11 01:12:09', '2023-10-11 01:12:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(40, '2014_10_12_000000_create_users_table', 1),
(41, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(42, '2014_10_12_100000_create_password_resets_table', 1),
(43, '2019_08_19_000000_create_failed_jobs_table', 1),
(44, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(46, '2023_10_05_220851_create_horarios_table', 1),
(47, '2023_10_05_220910_create_veterinarios_table', 1),
(49, '2023_10_09_221052_create_clientes_table', 1),
(50, '2023_10_09_230557_create_animales_table', 1),
(51, '2023_10_09_230608_create_razas_table', 1),
(52, '2023_10_09_230630_create_mascotas_table', 1),
(53, '2023_10_10_193739_create_roles_table', 2),
(54, '2023_10_11_152106_add_campos_to_users_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

CREATE TABLE `razas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `animal_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`id`, `nombre`, `animal_id`, `created_at`, `updated_at`) VALUES
(1, 'Siameses', 2, '2023-10-11 01:09:47', '2023-10-11 01:09:47'),
(2, 'Pequines', 1, '2023-10-11 01:09:47', '2023-10-11 01:09:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `modulos` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `usu_registro` int(11) DEFAULT NULL,
  `usu_ult_mod` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `modulos`, `estado`, `usu_registro`, `usu_ult_mod`, `created_at`, `updated_at`) VALUES
(1, 'administrador', 'todos', 1, NULL, NULL, '2023-10-11 21:18:18', '2023-10-11 21:18:18'),
(2, 'veterinario', 'modulos_veterinario', 1, NULL, NULL, '2023-10-11 21:18:18', '2023-10-11 21:18:18'),
(3, 'recepcionista', 'modulos_recepcionista', 1, NULL, NULL, '2023-10-11 21:18:18', '2023-10-11 21:18:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `usu_registro` int(11) DEFAULT NULL,
  `usu_ult_mod` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellido`, `estado`, `rol_id`, `usu_registro`, `usu_ult_mod`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'docVet', 'Ruiz Caro', 0, 2, NULL, NULL, 'vetRuizCaro@gmail.com', NULL, '$2y$10$PanJ0SHeANnFrNbEcikK.OU4ouXYxznzQBY/lO8wZyM4bADTSYhc.', NULL, '2023-10-11 21:57:47', '2023-10-12 22:11:18'),
(3, 'admin', 'admin', 0, 1, NULL, NULL, 'admin@gmail.com', NULL, '$2y$10$QfwQBfD47UJphRlsEf9Oxe1mnP9bW5X0fzdYkuXGnB02AsaeTG3Ni', NULL, '2023-10-11 21:59:41', '2023-10-11 21:59:41'),
(4, 'usuario01', 'prueba', 0, 3, NULL, NULL, 'upuebra01@gmail.com', NULL, '$2y$10$zlbcs1JPhWUWvWNT9Q5rg.ldYeJgV.RfHpq7E8KwSK6v9.JC8zceC', NULL, '2023-10-11 23:27:27', '2023-10-12 03:15:29'),
(5, 'usuario02', 'prueba', 0, 3, NULL, NULL, 'uPrueba02@gmail.com', NULL, '$2y$10$jvE./gKXuWPVpvPXcetsouTD1oUdiwhdJPqH5W3HDIe32BeScU2t6', NULL, '2023-10-12 03:33:43', '2023-10-12 21:48:43'),
(6, 'usuario03', 'prueba', 0, 3, NULL, NULL, 'uPrueba03@gmail.com', NULL, '$2y$10$HYZyjgsqTQkitJbpgRF2SOidKvcCbOhcvBMMA4VIbtV6bluJGA7.i', NULL, '2023-10-12 21:37:44', '2023-10-12 22:11:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinarios`
--

CREATE TABLE `veterinarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `fec_nac` timestamp NULL DEFAULT NULL,
  `tip_doc` int(11) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `num_telefono` varchar(20) NOT NULL,
  `especialidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `horario_id` int(10) UNSIGNED NOT NULL,
  `usu_registro` int(11) DEFAULT NULL,
  `usu_ult_mod` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mascotas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `mascotas_animal_id_foreign` (`animal_id`),
  ADD KEY `mascotas_raza_id_foreign` (`raza_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `razas_animal_id_foreign` (`animal_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_rol_id_foreign` (`rol_id`);

--
-- Indices de la tabla `veterinarios`
--
ALTER TABLE `veterinarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `veterinarios_horario_id_foreign` (`horario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `veterinarios`
--
ALTER TABLE `veterinarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `animales` (`id`),
  ADD CONSTRAINT `mascotas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `mascotas_raza_id_foreign` FOREIGN KEY (`raza_id`) REFERENCES `razas` (`id`);

--
-- Filtros para la tabla `razas`
--
ALTER TABLE `razas`
  ADD CONSTRAINT `razas_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `animales` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `veterinarios`
--
ALTER TABLE `veterinarios`
  ADD CONSTRAINT `veterinarios_horario_id_foreign` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
