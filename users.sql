-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 23-09-2021 a las 21:53:29
-- Versión del servidor: 5.7.32
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaalumnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `imagen` varchar(64) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `contraseña` varchar(64) NOT NULL,
  `tipo_usuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_usuario`, `nombre`, `imagen`, `correo`, `contraseña`, `tipo_usuario`) VALUES
(10, 'Gilberto Pérez Garrido', 'https://', 'betho6990@gmail.com', 'abc', 0),
(21, 'Israel Solís Ahuactzin', 'https://bit.ly/3zx63Rm', 'israel.flash@hotmail.com', 'abc', 1),
(22, 'Luis Alberto Zacarías Martínez', 'https://bit.ly/3nYuJAk', 'secarmesi@gmail.com', 'abc', 1),
(23, 'Marcos David García Marquez', 'https://bit.ly/3u3DNVn', 'abs14@outlook.es', 'abc', 1),
(25, 'Francisco Rodriguez Baeza', 'https://bit.ly/3nYBMcf', 'secarmesi1@gmail.com', 'abc', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
