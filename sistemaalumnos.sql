-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2021 a las 02:46:49
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPreviusKeys` (IN `id_user` INTEGER, IN `name` VARCHAR(64), IN `password` VARCHAR(64))  BEGIN
insert into previuskeys(id_user, name, password) values (id_user, name, password);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_report` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `previuskeys`
--

CREATE TABLE `previuskeys` (
  `id_password` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `previuskeys`
--

INSERT INTO `previuskeys` (`id_password`, `id_user`, `name`, `password`) VALUES
(25, 29, 'user1', 'abd'),
(26, 29, 'user1', 'abd'),
(27, 29, 'user1', 'abd'),
(28, 29, 'user1', 'abc'),
(29, 29, 'user1', 'abc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `id_user`, `title`, `content`, `created_at`, `modified_at`) VALUES
(2, 10, 'Sin clase', 'El profesor no viene toda la semana', '2021-11-14', '2021-11-21'),
(4, 21, 'Mi profesor es vulgar', 'El profesor es muy vulgar a la hora de revisar debido a que agrede verbalmente cuando tenemos algunos errores', '2021-10-21', '2021-11-07'),
(5, 25, 'La profesora de Programación I me acosa', 'La profesora de Programación I con NRC: 7214 hizo un grupo de WhatsApp y me envía mensajes por la noche diciéndome que sueña conmigo', '2021-10-21', '2021-11-07'),
(6, 22, 'Agua', 'Los bebederos de la facultad llevan una semana sin agua', '2021-10-21', '2021-10-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `id_report` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `mail` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usertype` int(1) NOT NULL,
  `activate` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `image`, `mail`, `password`, `usertype`, `activate`, `token`, `token_password`, `password_request`) VALUES
(10, 'Gilberto Pérez Garrido', 'https://', 'betho6990@gmail.com', 'abc', 0, 1, '', '', 0),
(21, 'Israel Solís Ahuactzin', 'https://bit.ly/3zx63Rm', 'israel.flash@hotmail.com', 'abc', 1, 1, '', NULL, 0),
(22, 'Luis Alberto Zacarías Martínez', 'https://bit.ly/3nYuJAk', 'secarmesi@gmail.com', 'abc', 1, 1, '', NULL, 0),
(23, 'Marcos David García Marquez', 'https://bit.ly/3u3DNVn', 'abs14@outlook.es', 'abd', 1, 1, '', NULL, 0),
(25, 'Francisco Rodríguez Baeza', 'https://bit.ly/3nYBMcf', 'secarmesi14@gmail.com', 'abc', 1, 1, '', NULL, 0),
(29, 'user1', NULL, 'gilberto.perezgarrido@viep.com.mx', 'abd', 0, 1, '98e0a272e1d5636344d4d489f29b6765', '', 0);

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `passwordUpdate` BEFORE UPDATE ON `users` FOR EACH ROW begin
call insertPreviusKeys(old.id_user, old.name, old.password);
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_fk_id_report` (`id_report`);

--
-- Indices de la tabla `previuskeys`
--
ALTER TABLE `previuskeys`
  ADD PRIMARY KEY (`id_password`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indices de la tabla `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_fk_id_report` (`id_report`),
  ADD KEY `responses_fk_id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `correo` (`mail`),
  ADD UNIQUE KEY `unique_email` (`mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `previuskeys`
--
ALTER TABLE `previuskeys`
  MODIFY `id_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`);

--
-- Filtros para la tabla `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`),
  ADD CONSTRAINT `responses_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
