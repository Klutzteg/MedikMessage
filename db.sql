-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2018 a las 01:59:48
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mp`
--

CREATE TABLE `mp` (
  `id` mediumint(9) NOT NULL,
  `emisor` varchar(30) NOT NULL,
  `receptor` varchar(30) DEFAULT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `leido` enum('yes','no') NOT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `ip` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mp`
--

INSERT INTO `mp` (`id`, `emisor`, `receptor`, `title`, `message`, `leido`, `fecha`, `ip`) VALUES
(1, 'admin', 'admin', 'ASDFASDF', '<p>MensajASDFASDFASDFe</p>', 'yes', '2018-02-22', '::1'),
(2, 'pac', 'admin', 'hola', '<p>que takl</p>', 'yes', '2018-02-22', '::1'),
(3, 'admin', 'pac', 'Funciona', '<p>Q pex</p>', 'yes', '2018-02-22', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `username`
--

CREATE TABLE `username` (
  `id` mediumint(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `ip` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `username`
--

INSERT INTO `username` (`id`, `email`, `username`, `password`, `fecha`, `ip`) VALUES
(1, 'leonavalos4772@gmail.com', 'admin', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', '2018-02-22', '::1'),
(2, 'paciente@gmail.com', 'pac', '55fa2e007f5ff0ab0d965e6bb4aceda90b3c2472', '2018-02-22', '::1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mp`
--
ALTER TABLE `mp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mp`
--
ALTER TABLE `mp`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `username`
--
ALTER TABLE `username`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
