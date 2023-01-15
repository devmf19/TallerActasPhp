-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2023 a las 02:30:15
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `actas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `issue` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `in_charge` int(11) NOT NULL,
  `order_of_day` text NOT NULL,
  `facts_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assistants`
--

CREATE TABLE `assistants` (
  `id` int(11) NOT NULL,
  `acta_id` int(11) NOT NULL,
  `assistant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commitment`
--

CREATE TABLE `commitment` (
  `id` int(11) NOT NULL,
  `acta_id` int(11) NOT NULL,
  `in_charge` int(11) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `tipoid` int(11) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'informes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastname`, `tipoid`, `role`) VALUES
(1003, 'admin', 'admin', 'Francisco', 'Martinez', 1, 'informes'),
(1004, 'admin', 'admin', 'Francisco', 'Martinez', 1, 'informes'),
(1005, 'admin', 'admin', 'Francisco', 'Martinez', 1, 'informes'),
(1006, 'admin', 'admin', 'Francisco', 'Martinez', 1, 'informes'),
(1007, 'admin', 'admin', 'Francisco', 'Martinez', 1, 'informes');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indices de la tabla `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acta_id` (`acta_id`),
  ADD KEY `assistant_id` (`assistant_id`);

--
-- Indices de la tabla `commitment`
--
ALTER TABLE `commitment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acta_id` (`acta_id`),
  ADD KEY `in_charge` (`in_charge`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta`
--
ALTER TABLE `acta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `commitment`
--
ALTER TABLE `commitment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acta`
--
ALTER TABLE `acta`
  ADD CONSTRAINT `acta_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_ibfk_1` FOREIGN KEY (`acta_id`) REFERENCES `acta` (`id`),
  ADD CONSTRAINT `assistants_ibfk_2` FOREIGN KEY (`assistant_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `commitment`
--
ALTER TABLE `commitment`
  ADD CONSTRAINT `commitment_ibfk_1` FOREIGN KEY (`acta_id`) REFERENCES `acta` (`id`),
  ADD CONSTRAINT `commitment_ibfk_2` FOREIGN KEY (`in_charge`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
