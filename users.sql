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
  `id_usuario` int(11) PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `imagen` varchar(64) NOT NULL,
  `correo` varchar(64) NOT NULL UNIQUE,
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


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE users ADD CONSTRAINT unique_email UNIQUE (correo);

CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`id_user`),
  CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_usuario`),
  CONSTRAINT `not_empty_title` CHECK (trim(`title`) <> ''),
  CONSTRAINT `not_empty_content` CHECK (trim(`content`) <> '')
);


CREATE TABLE `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_report` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  PRIMARY KEY (`id`),
  KEY `responses_fk_id_report` (`id_report`),
  KEY `responses_fk_id_user` (`id_user`),
  CONSTRAINT `responses_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`),
  CONSTRAINT `responses_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_usuario`),
  CONSTRAINT `not_empty_content` CHECK (trim(`content`) <> '')
);

CREATE TABLE `images` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_report` INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  CONSTRAINT `images_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`),
  CONSTRAINT `not_empty_image` CHECK(trim(`image`) <> '')
); 

-- Procedimiento almacenado para eliminar el reporte

CREATE PROCEDURE delete_report(id_report INTEGER)
    UPDATE SET is_deleted=true WHERE id=id_report;


-- Trigger que elimina las imagenes relacionadas con un reporte antes de eliminarlo

DELIMITER //
CREATE TRIGGER before_delete_report
BEFORE DELETE ON reports
FOR EACH row
BEGIN
DELETE FROM images WHERE id_report = old.id;
END;