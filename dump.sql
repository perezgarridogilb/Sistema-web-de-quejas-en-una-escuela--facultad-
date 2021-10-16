-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sistemaalumnos
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_report` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_fk_id_report` (`id_report`),
  CONSTRAINT `images_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`),
  CONSTRAINT `not_empty_image` CHECK (trim(`image`) <> '')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,10,'Nueva queja 1','Contenido de queja 1','2021-10-11','2021-10-11'),(2,26,'asfsaf','asfsadf','2021-10-11','2021-10-11'),(3,26,'sfsaf','safsdf','2021-10-11','2021-10-11'),(4,26,'sfsaf','safsdf','2021-10-11','2021-10-11'),(5,26,'safsdf','asfsdf','2021-10-11','2021-10-11'),(6,26,'NUeva queja del agua','El agua....\r\n','2021-10-12','2021-10-12'),(7,26,'NUeva queja del agua','El agua....\r\n','2021-10-12','2021-10-12'),(8,26,'Reporte de calificacion','Contenido del reporte\r\n','2021-10-15','2021-10-15');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `imagen` varchar(64) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `contraseña` varchar(64) NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `unique_email` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'Gilberto Pérez Garrido','https://','betho6990@gmail.com','abc',0),(21,'Israel Solís Ahuactzin','https://bit.ly/3zx63Rm','israel.flash@hotmail.com','abc',1),(22,'Luis Alberto Zacarías Martínez','https://bit.ly/3nYuJAk','secarmesi@gmail.com','abc',1),(23,'Marcos David García Marquez','https://bit.ly/3u3DNVn','abs14@outlook.es','abc',1),(25,'Francisco Rodriguez Baeza','https://bit.ly/3nYBMcf','secarmesi1@gmail.com','abc',1),(26,'Test1','','test1@hotmail.com','test1',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-15 10:54:54
