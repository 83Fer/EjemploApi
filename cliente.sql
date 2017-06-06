-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2017 a las 23:07:14
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_lab4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nomApell` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `fecIngreso` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nomApell`, `telefono`, `email`, `sexo`, `fecIngreso`, `foto`, `direccion`, `localidad`) VALUES
(1, 'Jose Odolfo', '123-123123', 'jose@gmail.com', 'Masculino', '2017-06-01', '111111.jpg', 'Lavalle 122', 'Bernal'),
(2, 'Romina Gonzales', '1231-12312', 'romi@gmail.com', 'Femenino', '2017-06-04', '222222.jpg', 'Avellaneda 123', 'Wilde'),
(4, 'Juan Toledo', '12313-3231', 'juan@gmail.com', 'Masculino', '0000-00-00', '333333.jpg', 'San Martin 222', 'Villa Urquiza'),
(6, 'Sebastian Rojas', '12313-3231', 'sebaRo@gmail.com', 'Masculino', '2016-10-20', '777777.jpg', 'Mexico 11', 'Flores'),
(7, 'Agustina Garcia', '12313-3231', 'agus@gmail.com', 'Femenino', '2016-07-12', '888888.jpg', 'Uruguay 3234', 'Almagro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
