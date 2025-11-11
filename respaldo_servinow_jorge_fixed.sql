-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: servinow_jorge
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'edgar','1234'),(2,'edgar@gmail.com','1234');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_afiliado` int NOT NULL,
  `estrellas` int NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_afiliado` (`id_afiliado`),
  CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE,
  CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`id_afiliado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `calificaciones_chk_1` CHECK ((`estrellas` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificaciones`
--

LOCK TABLES `calificaciones` WRITE;
/*!40000 ALTER TABLE `calificaciones` DISABLE KEYS */;
INSERT INTO `calificaciones` VALUES (1,14,10,5,'2025-05-30 11:32:06'),(2,14,10,4,'2025-05-30 12:15:25'),(3,14,10,4,'2025-05-30 12:36:18'),(4,14,10,2,'2025-05-30 12:48:55'),(5,14,10,1,'2025-05-30 12:51:07'),(6,14,10,5,'2025-05-30 12:52:38'),(7,14,10,4,'2025-05-30 12:55:33'),(8,14,8,5,'2025-05-30 14:03:17'),(9,17,4,5,'2025-05-30 15:04:14'),(11,14,10,5,'2025-06-06 21:13:13'),(12,14,10,4,'2025-06-06 21:23:27'),(13,14,10,4,'2025-06-07 23:25:34'),(14,14,8,5,'2025-06-07 23:51:20'),(15,14,6,4,'2025-06-08 00:21:28'),(16,14,3,2,'2025-06-08 00:24:55'),(17,14,17,2,'2025-06-08 01:54:26'),(18,14,17,4,'2025-06-08 03:06:55'),(19,14,17,4,'2025-06-08 03:17:47'),(20,14,17,3,'2025-06-08 03:28:05'),(21,14,17,4,'2025-06-08 03:46:34'),(22,20,19,4,'2025-06-08 06:00:09'),(23,21,4,1,'2025-06-08 07:00:12'),(24,14,19,1,'2025-06-11 20:54:12'),(25,22,8,5,'2025-06-11 21:05:55'),(26,23,21,2,'2025-06-11 22:17:45'),(27,23,17,5,'2025-06-11 22:23:22'),(28,14,17,5,'2025-06-11 23:08:38'),(29,14,17,5,'2025-06-11 23:12:13'),(30,14,17,5,'2025-06-12 03:33:18'),(31,14,25,5,'2025-06-14 00:42:24'),(32,16,4,4,'2025-10-30 01:16:09'),(33,10,4,4,'2025-11-02 22:21:25'),(34,10,4,3,'2025-11-02 22:59:31'),(35,10,4,2,'2025-11-02 23:09:19'),(36,10,4,3,'2025-11-02 23:15:25'),(37,10,4,3,'2025-11-02 23:18:18'),(38,14,4,3,'2025-11-08 05:01:07'),(39,14,3,3,'2025-11-08 23:17:42');
/*!40000 ALTER TABLE `calificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrataciones`
--

DROP TABLE IF EXISTS `contrataciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrataciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_peticion` int DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `id_afiliado` int NOT NULL,
  `id_servicio` int DEFAULT NULL,
  `tipo_cobro` enum('fijo','por_hora') DEFAULT 'fijo',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','aceptada','rechazada','completada') DEFAULT 'pendiente',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_afiliado` (`id_afiliado`),
  KEY `id_servicio` (`id_servicio`),
  CONSTRAINT `contrataciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contrataciones_ibfk_2` FOREIGN KEY (`id_afiliado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contrataciones_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrataciones`
--

LOCK TABLES `contrataciones` WRITE;
/*!40000 ALTER TABLE `contrataciones` DISABLE KEYS */;
INSERT INTO `contrataciones` VALUES (14,NULL,10,3,5,NULL,'2025-10-28 15:17:50','pendiente'),(15,NULL,10,3,5,NULL,'2025-10-28 15:18:00','pendiente'),(16,NULL,10,25,8,NULL,'2025-10-28 15:18:15','pendiente'),(17,NULL,10,19,1,'fijo','2025-10-28 17:45:14','pendiente'),(18,NULL,10,4,2,'fijo','2025-10-29 18:02:10','pendiente'),(19,NULL,16,4,5,'fijo','2025-10-29 18:21:10','pendiente'),(20,NULL,16,3,4,'fijo','2025-10-29 18:21:24','pendiente'),(21,NULL,10,19,1,'fijo','2025-10-29 18:26:49','pendiente'),(22,NULL,10,19,2,'fijo','2025-10-29 18:26:49','pendiente'),(23,NULL,10,17,16,'fijo','2025-10-29 18:27:36','pendiente'),(24,NULL,10,17,17,'fijo','2025-10-29 18:27:36','pendiente'),(25,NULL,10,20,14,'fijo','2025-10-29 18:28:42','pendiente'),(26,NULL,10,20,15,'fijo','2025-10-29 18:28:42','pendiente'),(27,NULL,10,3,4,'fijo','2025-10-29 18:29:08','pendiente'),(28,NULL,10,3,5,'fijo','2025-10-29 18:29:08','pendiente'),(29,NULL,14,4,NULL,'por_hora','2025-10-29 18:40:33','pendiente'),(30,NULL,14,4,NULL,'por_hora','2025-10-29 18:50:49','pendiente'),(31,NULL,14,3,NULL,'por_hora','2025-10-29 18:57:51','pendiente'),(32,NULL,14,4,NULL,'por_hora','2025-10-29 18:57:55','pendiente'),(33,NULL,14,4,5,'fijo','2025-10-29 19:05:53','pendiente'),(34,NULL,14,4,4,'fijo','2025-10-29 19:06:42','pendiente'),(35,NULL,14,4,5,'fijo','2025-10-29 19:06:42','pendiente'),(36,NULL,14,4,4,'fijo','2025-10-29 19:08:44','pendiente'),(37,NULL,14,4,5,'fijo','2025-10-29 19:08:44','pendiente'),(38,NULL,16,17,17,'fijo','2025-10-29 19:11:26','pendiente'),(39,NULL,16,17,19,'fijo','2025-10-29 19:11:26','pendiente'),(40,NULL,16,8,14,'fijo','2025-10-29 19:12:40','pendiente'),(41,NULL,16,8,15,'fijo','2025-10-29 19:12:40','pendiente'),(42,NULL,25,4,4,'fijo','2025-10-29 19:20:04','pendiente'),(43,NULL,25,4,5,'fijo','2025-10-29 19:20:04','pendiente'),(44,NULL,25,4,2,'fijo','2025-10-29 19:38:36','pendiente'),(45,NULL,25,4,4,'fijo','2025-10-29 19:38:36','pendiente'),(46,NULL,25,4,5,'fijo','2025-10-29 19:38:36','pendiente'),(47,NULL,25,7,9,'fijo','2025-10-29 19:42:42','pendiente'),(48,NULL,25,7,10,'fijo','2025-10-29 19:42:42','pendiente'),(49,NULL,25,4,5,'fijo','2025-10-29 20:00:23','pendiente'),(50,NULL,10,10,4,'fijo','2025-10-29 20:05:13','pendiente'),(51,NULL,10,10,5,'fijo','2025-10-29 20:05:13','pendiente'),(52,NULL,10,10,1,'fijo','2025-10-29 20:07:30','pendiente'),(53,NULL,10,10,2,'fijo','2025-10-29 20:07:30','pendiente'),(54,NULL,25,4,2,'fijo','2025-10-29 20:23:15','pendiente'),(55,NULL,25,4,5,'fijo','2025-10-29 20:23:15','pendiente'),(56,NULL,10,4,NULL,'por_hora','2025-10-29 20:24:39','pendiente'),(57,77,25,6,9,'fijo','2025-10-29 20:48:39','pendiente'),(58,77,25,6,10,'fijo','2025-10-29 20:48:39','pendiente'),(59,78,10,6,NULL,'por_hora','2025-10-29 20:49:52','pendiente'),(60,79,10,4,2,'fijo','2025-10-29 21:12:24','pendiente'),(61,79,10,4,4,'fijo','2025-10-29 21:12:24','pendiente'),(62,79,10,4,5,'fijo','2025-10-29 21:12:24','pendiente'),(63,80,10,4,4,'fijo','2025-10-29 21:28:50','pendiente'),(64,80,10,4,5,'fijo','2025-10-29 21:28:50','pendiente'),(65,81,10,4,NULL,'por_hora','2025-10-29 21:30:21','pendiente'),(66,82,10,4,4,'fijo','2025-11-02 14:58:47','pendiente'),(67,82,10,4,5,'fijo','2025-11-02 14:58:47','pendiente'),(68,83,10,4,2,'fijo','2025-11-02 15:19:11','pendiente'),(69,83,10,4,3,'fijo','2025-11-02 15:19:11','pendiente'),(70,83,10,4,5,'fijo','2025-11-02 15:19:11','pendiente'),(71,84,10,4,NULL,'por_hora','2025-11-02 15:21:48','pendiente'),(72,85,10,4,NULL,'por_hora','2025-11-02 15:23:56','pendiente'),(73,86,10,4,NULL,'por_hora','2025-11-02 15:53:29','pendiente'),(74,87,10,4,NULL,'por_hora','2025-11-02 15:58:14','pendiente'),(75,88,10,4,4,'fijo','2025-11-02 16:07:09','pendiente'),(76,88,10,4,5,'fijo','2025-11-02 16:07:09','pendiente'),(77,89,10,4,NULL,'por_hora','2025-11-02 16:07:16','pendiente'),(78,90,10,4,2,'fijo','2025-11-02 16:12:57','pendiente'),(79,90,10,4,5,'fijo','2025-11-02 16:12:57','pendiente'),(80,91,10,4,NULL,'por_hora','2025-11-02 16:13:05','pendiente'),(81,92,10,4,NULL,'por_hora','2025-11-03 13:10:16','pendiente'),(82,93,10,4,NULL,'por_hora','2025-11-03 13:16:01','pendiente'),(83,94,10,4,NULL,'por_hora','2025-11-03 13:49:21','pendiente'),(84,95,14,4,4,'fijo','2025-11-03 16:05:36','pendiente'),(85,95,14,4,5,'fijo','2025-11-03 16:05:36','pendiente'),(86,96,14,4,NULL,'por_hora','2025-11-04 12:02:37','pendiente'),(87,97,14,3,NULL,'por_hora','2025-11-04 12:31:37','pendiente'),(88,98,14,4,4,'fijo','2025-11-04 12:32:59','pendiente'),(89,99,14,4,NULL,'por_hora','2025-11-05 07:22:04','pendiente'),(90,100,14,4,NULL,'por_hora','2025-11-07 20:38:04','pendiente'),(91,101,14,4,NULL,'por_hora','2025-11-07 20:42:16','pendiente'),(92,102,14,4,NULL,'por_hora','2025-11-07 20:45:05','pendiente'),(93,103,10,4,NULL,'por_hora','2025-11-07 20:48:11','pendiente'),(94,104,14,4,NULL,'por_hora','2025-11-07 20:50:58','pendiente'),(95,105,14,4,NULL,'por_hora','2025-11-07 20:56:10','pendiente'),(96,106,14,3,NULL,'por_hora','2025-11-07 20:57:23','pendiente'),(97,107,14,3,1,'fijo','2025-11-07 20:59:59','pendiente'),(98,107,14,3,2,'fijo','2025-11-07 20:59:59','pendiente'),(99,107,14,3,3,'fijo','2025-11-07 20:59:59','pendiente'),(100,108,14,4,3,'fijo','2025-11-07 21:02:18','pendiente'),(101,108,14,4,4,'fijo','2025-11-07 21:02:18','pendiente'),(102,108,14,4,5,'fijo','2025-11-07 21:02:18','pendiente'),(103,109,14,4,NULL,'por_hora','2025-11-07 21:21:22','pendiente'),(104,110,14,4,NULL,'por_hora','2025-11-07 21:32:10','pendiente'),(105,111,14,4,NULL,'por_hora','2025-11-07 21:58:25','pendiente'),(106,112,14,3,1,'fijo','2025-11-08 16:09:07','pendiente'),(107,112,14,3,2,'fijo','2025-11-08 16:09:07','pendiente');
/*!40000 ALTER TABLE `contrataciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizaciones`
--

DROP TABLE IF EXISTS `cotizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cotizaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_afiliado` int NOT NULL,
  `id_peticion` int DEFAULT NULL,
  `servicio` enum('plomeria','electricidad','carpinteria','albanileria') NOT NULL,
  `horas` decimal(10,2) NOT NULL,
  `detalles` text,
  `precio_hora` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','aceptada','rechazada','completada') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_afiliado` (`id_afiliado`),
  CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`id_afiliado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones`
--

LOCK TABLES `cotizaciones` WRITE;
/*!40000 ALTER TABLE `cotizaciones` DISABLE KEYS */;
INSERT INTO `cotizaciones` VALUES (12,14,10,NULL,'plomeria',2.00,'se le descompuso el lavamanos',200.00,400.00,'2025-05-30 09:19:01','aceptada'),(13,14,10,NULL,'plomeria',1.50,'le cheque la coladera',300.00,450.00,'2025-05-30 10:48:02','aceptada'),(14,13,10,NULL,'plomeria',2.30,'le revise la manguera del agua',50.00,115.00,'2025-05-30 10:48:34','pendiente'),(15,14,10,NULL,'plomeria',2.40,'le arregle el piso',90.00,216.00,'2025-05-30 10:49:01','aceptada'),(16,14,10,NULL,'plomeria',1.20,'fue rapidito',20.40,24.48,'2025-05-30 11:31:06','aceptada'),(17,14,10,NULL,'plomeria',2.30,'se le descompuso el labamaos\r\n',100.00,230.00,'2025-05-30 12:14:11','aceptada'),(18,14,10,NULL,'plomeria',2.50,'se le descompuso la taza del bano',1.12,2.80,'2025-05-30 12:34:28','aceptada'),(19,14,10,NULL,'plomeria',2.40,'se demoro mas',203.00,487.20,'2025-05-30 12:40:07','aceptada'),(20,14,10,NULL,'plomeria',2.50,'nose',400.00,1000.00,'2025-05-30 12:50:39','aceptada'),(21,14,10,NULL,'plomeria',2.50,'algo',200.00,500.00,'2025-05-30 12:52:02','aceptada'),(22,14,10,NULL,'plomeria',2.60,'algo',40.20,104.52,'2025-05-30 12:54:15','aceptada'),(23,14,8,NULL,'plomeria',2.00,'le se le frego el lavamanos',120.00,240.00,'2025-05-30 14:01:18','aceptada'),(24,17,4,NULL,'plomeria',3.00,'se le descompuso el lavamanos',230.00,690.00,'2025-05-30 15:02:11','aceptada'),(26,14,10,NULL,'plomeria',2.30,'se le descompuso el bano',200.00,460.00,'2025-06-06 21:11:04','aceptada'),(27,14,10,NULL,'plomeria',2.30,'se le descompuso el lavamanos',230.00,529.00,'2025-06-06 21:11:31','aceptada'),(29,16,10,NULL,'plomeria',2.00,'awerwer',120.00,240.00,'2025-06-07 22:09:30','pendiente'),(30,14,10,NULL,'plomeria',3.00,'qweqweqwe',120.00,360.00,'2025-06-07 22:52:22','pendiente'),(31,14,10,NULL,'plomeria',2.00,'1weqweqwe',123.00,246.00,'2025-06-07 23:13:04','pendiente'),(32,14,10,NULL,'plomeria',2.00,'qwwrqwrqweqweqwe',123.00,246.00,'2025-06-07 23:22:37','pendiente'),(33,14,10,NULL,'plomeria',2.00,'nose',120.00,240.00,'2025-06-07 23:31:41','pendiente'),(34,14,8,NULL,'plomeria',1.00,'nose',130.00,130.00,'2025-06-07 23:37:31','pendiente'),(35,14,6,NULL,'plomeria',2.00,'hola',124.00,248.00,'2025-06-08 00:20:59','pendiente'),(36,14,3,NULL,'plomeria',2.20,'buena',23.00,50.60,'2025-06-08 00:24:19','pendiente'),(37,14,10,NULL,'plomeria',2.20,'hora',123.00,270.60,'2025-06-08 00:50:30','pendiente'),(38,14,17,NULL,'plomeria',2.20,'se le frego el lavamanos\r\n',12.00,26.40,'2025-06-08 01:53:48','pendiente'),(39,14,17,NULL,'plomeria',2.30,'se le frego el lavaplatos',125.00,287.50,'2025-06-08 02:55:31','pendiente'),(40,14,17,NULL,'plomeria',2.00,'me meti a la alcantarilla',200.00,400.00,'2025-06-08 03:16:47','pendiente'),(41,14,17,NULL,'plomeria',2.50,'no lo se',450.00,1125.00,'2025-06-08 03:26:58','pendiente'),(42,14,17,NULL,'plomeria',3.00,'hola',20.00,60.00,'2025-06-08 03:29:59','pendiente'),(43,20,19,NULL,'plomeria',2.00,'se le frego la tuberia',120.00,240.00,'2025-06-08 05:58:03','pendiente'),(44,21,4,NULL,'plomeria',5.00,'adadas dasd dsad asdas das',200.00,1000.00,'2025-06-08 06:57:48','pendiente'),(45,14,19,NULL,'plomeria',2.00,'se le descompuso el lavamanos',120.00,240.00,'2025-06-11 20:52:19','pendiente'),(46,20,17,NULL,'plomeria',3.00,'se le descompuso ',120.00,360.00,'2025-06-11 21:01:33','pendiente'),(47,22,17,NULL,'plomeria',2.00,'wqeqweq',125.00,250.00,'2025-06-11 21:03:05','pendiente'),(48,22,8,NULL,'plomeria',2.00,'resxdfdf',120.00,240.00,'2025-06-11 21:05:02','pendiente'),(49,23,21,NULL,'carpinteria',35.10,'di un diplomado de carpinteria',80.00,2808.00,'2025-06-11 22:12:34','pendiente'),(50,23,17,NULL,'carpinteria',3.50,'Todo ok',80.00,280.00,'2025-06-11 22:20:27','pendiente'),(51,14,17,NULL,'plomeria',2.00,'aeerwe',120.00,240.00,'2025-06-11 22:57:43','pendiente'),(52,14,17,NULL,'plomeria',2.00,'123123',12.00,24.00,'2025-06-11 23:09:06','pendiente'),(53,14,17,NULL,'albanileria',2.00,'aweafeeae',120.00,240.00,'2025-06-12 00:39:18','pendiente'),(54,14,17,NULL,'albanileria',2.00,'se le averio el lavamanos',1.50,3.00,'2025-06-12 03:44:46','pendiente'),(55,14,25,NULL,'electricidad',5.00,'Dio mucho guerra la sra',200.00,1000.00,'2025-06-14 00:40:00','pendiente'),(56,24,25,NULL,'electricidad',1.00,'Me asolie',250.00,250.00,'2025-06-14 00:40:24','pendiente'),(57,16,4,NULL,'plomeria',2.40,'se hizo nada',100.00,240.00,'2025-10-30 01:05:15','pendiente'),(58,16,4,NULL,'plomeria',2.50,'efadfasdfsdf',150.00,375.00,'2025-10-30 01:05:37','pendiente'),(59,10,4,NULL,'plomeria',3.40,'adfsdf\r\n\r\n',100.00,340.00,'2025-10-30 01:14:27','pendiente'),(60,10,4,NULL,'plomeria',0.00,NULL,0.00,0.00,'2025-10-30 04:23:58','pendiente'),(61,10,4,NULL,'plomeria',0.00,NULL,0.00,0.00,'2025-10-30 04:29:45','pendiente'),(62,10,4,NULL,'plomeria',0.00,NULL,0.00,0.00,'2025-11-02 21:59:50','pendiente'),(63,10,4,NULL,'plomeria',0.00,NULL,0.00,1172.97,'2025-11-02 22:19:40','pendiente'),(64,10,4,NULL,'plomeria',2.50,'otro tipo de servicio',150.00,375.00,'2025-11-02 22:22:30','pendiente'),(65,10,4,NULL,'plomeria',2.00,'dededadfasdf',150.00,300.00,'2025-11-02 22:24:27','pendiente'),(66,10,4,NULL,'plomeria',2.00,'efadfasdf',150.00,300.00,'2025-11-02 22:53:57','pendiente'),(67,10,4,NULL,'plomeria',3.00,'asdfasdf',150.00,450.00,'2025-11-02 22:58:59','pendiente'),(68,10,4,NULL,'plomeria',0.00,NULL,0.00,802.97,'2025-11-02 23:08:14','pendiente'),(69,10,4,NULL,'plomeria',3.20,'ddsffsf',150.00,480.00,'2025-11-02 23:08:23','pendiente'),(70,10,4,NULL,'plomeria',0.00,NULL,0.00,822.97,'2025-11-02 23:13:31','completada'),(71,10,4,NULL,'plomeria',2.00,'',150.00,300.00,'2025-11-02 23:13:52','pendiente'),(72,10,4,NULL,'plomeria',1.00,'sepa que es',150.00,150.00,'2025-11-03 20:10:54','pendiente'),(73,10,4,NULL,'plomeria',2.00,'eeededed',150.00,402.97,'2025-11-03 20:16:37','pendiente'),(74,10,4,94,'plomeria',3.00,'dsfsafdasdf',150.00,552.97,'2025-11-03 20:49:41','pendiente'),(75,14,4,98,'plomeria',0.00,NULL,0.00,252.29,'2025-11-04 19:41:14','pendiente'),(76,14,4,99,'plomeria',2.00,'pidio otra cosa',150.00,352.29,'2025-11-08 03:41:33','pendiente'),(77,14,4,101,'plomeria',2.00,'asfasdf',150.00,352.29,'2025-11-08 03:48:47','pendiente'),(78,14,4,102,'plomeria',2.00,'2',150.00,352.29,'2025-11-08 03:52:57','pendiente'),(79,10,4,103,'plomeria',2.00,'este fue el ultimo',150.00,402.97,'2025-11-08 04:16:42','pendiente'),(80,14,4,104,'plomeria',2.00,'haber si funciona',150.00,352.29,'2025-11-08 04:21:57','pendiente'),(81,14,4,108,'plomeria',0.00,NULL,0.00,1102.29,'2025-11-08 04:24:13','pendiente'),(82,14,4,96,'plomeria',2.00,'ultimo\r\n',150.00,352.29,'2025-11-08 04:32:52','pendiente'),(83,14,4,105,'plomeria',3.00,'xd\r\n',150.00,502.29,'2025-11-08 04:33:06','pendiente'),(84,14,4,109,'plomeria',1.00,'e',150.00,202.29,'2025-11-08 04:58:57','pendiente'),(85,10,4,92,'plomeria',2.00,'ededede',150.00,402.97,'2025-11-08 05:11:50','pendiente'),(86,14,3,112,'plomeria',0.00,NULL,0.00,400.00,'2025-11-08 23:09:29','pendiente');
/*!40000 ALTER TABLE `cotizaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especialidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
INSERT INTO `especialidades` VALUES (4,'albanileria'),(3,'carpinteria'),(2,'electricidad'),(1,'plomeria');
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensajes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `remitente_id` int NOT NULL,
  `receptor_id` int NOT NULL,
  `mensaje` text NOT NULL,
  `remitente_es_afiliado` tinyint(1) NOT NULL COMMENT '1 si el remitente es afiliado (usuarios), 0 si es cliente (usuarios2)',
  `fecha_envio` datetime DEFAULT CURRENT_TIMESTAMP,
  `leido` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES (1,4,10,'hols',1,'2025-11-03 14:38:42',0),(2,4,10,'hola que se le ofrece?',1,'2025-11-03 14:38:52',0),(3,10,4,'quiero un servicio bien mamalon',0,'2025-11-03 14:40:57',0),(4,14,4,'hola',0,'2025-11-03 14:43:26',1),(5,10,4,'hola juan perez',0,'2025-11-03 14:47:58',0),(6,4,10,'holis',1,'2025-11-03 14:51:05',0),(7,4,10,'no es mucho',1,'2025-11-03 14:59:24',0),(8,10,4,'cobra bien carro',0,'2025-11-03 15:00:09',0),(9,10,4,'mlp',0,'2025-11-03 15:00:26',0),(10,4,10,'viejo codo',1,'2025-11-03 15:00:33',0),(11,4,14,'holis',1,'2025-11-04 12:03:17',1),(12,14,3,'Me interesa su servicio',0,'2025-11-04 12:28:33',0),(13,14,4,'necesito que me ayude senor',0,'2025-11-04 12:37:38',1),(14,4,14,'ok',1,'2025-11-04 12:37:46',1),(15,14,4,'holaaaaaa',0,'2025-11-09 13:22:54',1),(16,4,14,'en que puedo ayudarte',1,'2025-11-09 13:23:25',1),(17,14,4,'no lo se tu dime',0,'2025-11-09 13:25:13',1),(18,14,4,'holaaaa',0,'2025-11-09 13:28:18',1),(19,4,14,'en que puedo ayudarte?',1,'2025-11-09 13:29:02',1),(20,14,4,'holaaaaa',0,'2025-11-09 13:32:12',1),(21,4,14,'en que puedo ayudarte?',1,'2025-11-09 13:32:35',1),(22,14,4,'holaaaaa',0,'2025-11-09 13:35:22',1),(23,4,14,'en que puedo ayudarte?',1,'2025-11-09 13:35:48',1),(24,14,4,'hola',0,'2025-11-09 13:38:24',1),(25,4,14,'en que peudo ayudarrte?',1,'2025-11-09 13:38:45',1),(26,14,7,'holaaa',0,'2025-11-09 13:54:33',0),(27,14,4,'holaaaaaaaaaaaa',0,'2025-11-09 14:06:11',0),(28,14,8,'holaaa',0,'2025-11-09 14:09:42',0),(29,14,4,'holaaa',0,'2025-11-09 14:09:59',0),(30,3,14,'Disculpe la demora en mi respuesta. Estoy atendiendo otros trabajos en este momento. Le responder+¬ en los pr+¦ximos 10-15 minutos. Gracias por su paciencia.',1,'2025-11-09 14:10:25',0),(31,7,14,'Disculpe la demora en mi respuesta. Estoy atendiendo otros trabajos en este momento. Le responder+¬ en los pr+¦ximos 10-15 minutos. Gracias por su paciencia.',1,'2025-11-09 14:10:25',0),(32,4,14,'Disculpe la demora en mi respuesta. Estoy atendiendo otros trabajos en este momento. Le responder+¬ en los pr+¦ximos 10-15 minutos. Gracias por su paciencia.',1,'2025-11-09 14:10:25',1),(33,8,14,'Disculpe la demora en mi respuesta. Estoy atendiendo otros trabajos en este momento. Le responder+¬ en los pr+¦ximos 10-15 minutos. Gracias por su paciencia.',1,'2025-11-09 14:10:25',1);
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `leida` tinyint(1) DEFAULT '0',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_peticion` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_notif` (`id_usuario`),
  CONSTRAINT `fk_usuario_notif` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (8,20,'El afiliado (meredith rodriguez) ha rechazado tu peticion.',0,'2025-06-08 05:47:07',NULL),(9,20,'Has pagado el servicio del afiliado (meredith rodriguez).',0,'2025-06-08 05:57:29',NULL),(10,20,'El afiliado (carlos estrada) ya cotiz?? tu servicio. <a href=\'pago.php?id_cotizacion=46\'>Procede al pago</a>.',0,'2025-06-08 06:11:28',NULL),(11,20,'El afiliado (pablo carreon) acept?? el trabajo.',0,'2025-06-08 06:15:11',NULL),(12,14,'Has contratado a este afiliado (pablo carreon), esperando a que el afiliado le cotice.',0,'2025-06-08 06:25:26',NULL),(13,21,'Has contratado a este afiliado (carlos estrada), esperando a que el afiliado le cotice.',0,'2025-06-08 06:47:17',NULL),(14,21,'Has pagado el servicio del afiliado (juan perez).',0,'2025-06-08 06:48:27',NULL),(15,14,'Has pagado el servicio del afiliado (meredith rodriguez).',0,'2025-06-11 20:49:33',NULL),(17,22,'Has contratado a este afiliado (Luis Lopez), esperando a que el afiliado le cotice.',0,'2025-06-11 21:03:26',NULL),(18,22,'Has pagado el servicio del afiliado (herman salinas).',0,'2025-06-11 21:04:23',NULL),(19,23,'Has pagado el servicio del afiliado (Pancho Perea).',0,'2025-06-11 22:02:47',NULL),(20,23,'Has pagado el servicio del afiliado (carlos estrada).',0,'2025-06-11 22:18:25',NULL),(21,14,'Has pagado el servicio del afiliado (carlos estrada).',0,'2025-06-11 22:55:50',NULL),(22,14,'Has pagado el servicio del afiliado (carlos estrada).',0,'2025-06-11 23:08:43',NULL),(23,14,'Has pagado el servicio del afiliado (carlos estrada).',0,'2025-06-12 00:32:27',NULL),(24,14,'Has pagado el servicio del afiliado (Soy Pancho Electricista Jom).',0,'2025-06-12 01:56:52',NULL),(25,24,'El afiliado (Soy Pancho Electricista Jom) ya cotiz?? tu servicio. <a href=\'pago.php?id_cotizacion=56\'>Procede al pago</a>.',0,'2025-06-14 00:35:32',NULL),(26,14,'Has pagado el servicio del afiliado (Soy Pancho Electricista Jom).',0,'2025-06-14 00:37:46',NULL),(27,16,'Has contratado a este afiliado (jorge aguirre), esperando a que el afiliado le cotice.',0,'2025-06-14 00:57:53',NULL),(28,16,'Has pagado el servicio del afiliado (juan perez).',0,'2025-06-14 00:59:11',NULL),(29,16,'Has contratado a este afiliado (pablo carreon), esperando a que el afiliado le cotice.',0,'2025-06-14 00:59:49',NULL),(30,10,'El afiliado (pablo carreon) acept?? el trabajo.',0,'2025-06-14 01:36:59',NULL),(31,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-10-27 21:26:12',NULL),(33,10,'El afiliado (jorge aguirre) acept?? el trabajo.',0,'2025-10-28 22:17:50',NULL),(34,10,'El afiliado (jorge aguirre) acept?? el trabajo.',0,'2025-10-28 22:18:00',NULL),(35,10,'Has contratado a este afiliado (Soy Pancho Electricista Jom), esperando a que el afiliado le cotice.',0,'2025-10-28 22:18:15',NULL),(36,10,'Has contratado a este afiliado (meredith rodriguez), esperando a que el afiliado le cotice.',0,'2025-10-29 00:45:15',NULL),(37,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-10-30 01:02:10',NULL),(38,16,'Has contratado a este afiliado (juan perez), esperando a que el afiliado le cotice.',0,'2025-10-30 01:21:10',NULL),(39,16,'Has contratado a este afiliado (jorge aguirre), esperando a que el afiliado le cotice.',0,'2025-10-30 01:21:24',NULL),(40,10,'Has contratado a este afiliado (meredith rodriguez), esperando a que el afiliado le cotice.',0,'2025-10-30 01:26:49',NULL),(41,10,'Has contratado a este afiliado (carlos estrada), esperando a que el afiliado le cotice.',0,'2025-10-30 01:27:36',NULL),(42,10,'Has contratado a este afiliado (Luis Lopez), esperando a que el afiliado le cotice.',0,'2025-10-30 01:28:42',NULL),(43,10,'Has contratado a este afiliado (jorge aguirre), esperando a que el afiliado le cotice.',0,'2025-10-30 01:29:08',NULL),(44,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-10-30 01:40:33',NULL),(45,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-10-30 01:50:49',NULL),(46,14,'Has solicitado cotizaci??n por hora a este afiliado (jorge aguirre).',0,'2025-10-30 01:57:51',NULL),(47,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-10-30 01:57:55',NULL),(48,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-10-30 02:05:53',NULL),(49,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-10-30 02:06:42',NULL),(50,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-10-30 02:08:44',NULL),(51,16,'Has contratado a este afiliado (carlos estrada), esperando a que el afiliado le cotice.',0,'2025-10-30 02:11:26',NULL),(52,16,'Has contratado a este afiliado (herman salinas), esperando a que el afiliado le cotice.',0,'2025-10-30 02:12:40',NULL),(53,25,'Has contratado a este afiliado (juan perez), esperando a que el afiliado le cotice.',0,'2025-10-30 02:20:04',NULL),(54,25,'Has contratado a este afiliado (juan perez), esperando a que el afiliado le cotice.',0,'2025-10-30 02:38:36',NULL),(55,25,'El afiliado (pablo carreon) acept?? el trabajo.',0,'2025-10-30 02:42:42',NULL),(56,25,'Has contratado a este afiliado (juan perez), esperando a que el afiliado le cotice.',0,'2025-10-30 03:00:23',NULL),(57,10,'Has contratado a este afiliado (gabriel alejandro rodriguez), esperando a que el afiliado le cotice.',0,'2025-10-30 03:05:13',NULL),(58,10,'Has contratado a este afiliado (gabriel alejandro rodriguez), esperando a que el afiliado le cotice.',0,'2025-10-30 03:07:30',NULL),(59,25,'Has contratado a este afiliado (juan perez), esperando a que el afiliado le cotice.',0,'2025-10-30 03:23:15',NULL),(60,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-10-30 03:24:39',NULL),(61,25,'El afiliado (pablo carreon) acept?? el trabajo.',0,'2025-10-30 03:48:39',NULL),(62,10,'Has solicitado cotizaci??n por hora a este afiliado (pablo carreon).',0,'2025-10-30 03:49:52',NULL),(63,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-10-30 04:12:24',NULL),(64,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-10-30 04:28:50',NULL),(65,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-10-30 04:30:21',NULL),(66,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-02 21:58:47',NULL),(67,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-02 22:19:11',NULL),(72,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-02 23:07:09',NULL),(73,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-02 23:07:16',NULL),(74,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-02 23:12:57',90),(75,10,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-02 23:13:05',91),(76,10,'El afiliado (juan perez) ya cotiz?? tu servicio. <a href=\'pago.php?id_cotizacion=72\'>Procede al pago</a>.',0,'2025-11-03 20:10:16',92),(77,10,'El afiliado (juan perez) ya cotiz?? tu servicio. <a href=\'pago.php?id_cotizacion=73\'>Procede al pago</a>.',0,'2025-11-03 20:16:01',93),(78,10,'El afiliado (juan perez) ya cotiz?? tu servicio. <a href=\'pago.php?id_cotizacion=74\'>Procede al pago</a>.',0,'2025-11-03 20:49:21',94),(79,14,'El afiliado (juan perez) acept?? el trabajo.',0,'2025-11-03 23:05:36',95),(80,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=82\'>Procede al pago</a>.',0,'2025-11-04 19:02:37',96),(81,14,'Has solicitado cotizaci??n por hora a este afiliado (jorge aguirre).',0,'2025-11-04 19:31:37',97),(82,14,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-04 19:32:59',98),(83,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=76\'>Procede al pago</a>.',0,'2025-11-05 14:22:04',99),(85,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=77\'>Procede al pago</a>.',0,'2025-11-08 03:42:16',101),(86,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=78\'>Procede al pago</a>.',0,'2025-11-08 03:45:05',102),(87,10,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=79\'>Procede al pago</a>.',0,'2025-11-08 03:48:11',103),(88,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=80\'>Procede al pago</a>.',0,'2025-11-08 03:50:58',104),(89,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=83\'>Procede al pago</a>.',0,'2025-11-08 03:56:10',105),(90,14,'El afiliado (jorge aguirre) acept+¦ el trabajo.',0,'2025-11-08 03:57:23',106),(91,14,'El afiliado (jorge aguirre) acept+¦ el trabajo.',0,'2025-11-08 03:59:59',107),(92,14,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=81\'>Procede al pago</a>.',0,'2025-11-08 04:02:18',108),(93,14,'El afiliado (juan perez) acept+¦ el trabajo.',0,'2025-11-08 04:21:22',109),(94,14,'Has solicitado cotizaci+¦n por hora a este afiliado (juan perez).',0,'2025-11-08 04:32:10',110),(95,14,'Has solicitado cotizaci+¦n por hora a este afiliado (juan perez).',0,'2025-11-08 04:58:25',111),(96,14,'Has pagado el servicio del afiliado (juan perez).',0,'2025-11-08 04:58:57',109),(97,10,'El afiliado (juan perez) ya cotiz+¦ tu servicio. <a href=\'pago.php?id_cotizacion=85\'>Procede al pago</a>.',0,'2025-11-08 05:11:50',92),(98,14,'El afiliado (jorge aguirre) acept+¦ el trabajo.',0,'2025-11-08 23:09:07',112),(99,14,'Has pagado el servicio del afiliado (jorge aguirre).',0,'2025-11-08 23:09:29',112),(100,4,'Tienes un nuevo mensaje de edgar edu',0,'2025-11-09 20:28:18',NULL),(102,4,'Tienes un nuevo mensaje de edgar edu',0,'2025-11-09 20:32:12',NULL),(105,4,'Mensaje enviado a edgar edu',0,'2025-11-09 20:32:35',NULL);
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int NOT NULL,
  `id_orden` varchar(50) NOT NULL,
  `metodo_pago` enum('paypal','efectivo','tarjeta') NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','completado','fallido') NOT NULL,
  `detalle_pago` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cotizacion` (`id_cotizacion`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,12,'EFECTIVO_1748601849527','efectivo',400.00,'completado','lo hizo very good','2025-05-30 10:44:09'),(2,13,'EFECTIVO_1748602218762','efectivo',450.00,'completado','tiene mucho cuidado','2025-05-30 10:50:18'),(3,15,'EFECTIVO_1748604358552','efectivo',216.00,'completado','lo hizo muy bien','2025-05-30 11:25:58'),(4,16,'EFECTIVO_1748604706361','efectivo',24.48,'completado','lo hizo muy bien es limpio para trabajar','2025-05-30 11:31:46'),(5,17,'EFECTIVO_1748607322729','efectivo',230.00,'completado','lo hizo muy bien','2025-05-30 12:15:22'),(6,18,'EFECTIVO_1748608574969','efectivo',2.80,'completado','lo arreglo muy bien la ropa un poco mugrosa','2025-05-30 12:36:14'),(7,19,'EFECTIVO_1748608838757','efectivo',487.20,'completado','ma que un comentario es una opinion','2025-05-30 12:40:38'),(8,20,'EFECTIVO_1748609460299','efectivo',1000.00,'completado','no lo se','2025-05-30 12:51:00'),(9,21,'EFECTIVO_1748609554544','efectivo',500.00,'completado','something','2025-05-30 12:52:34'),(10,22,'EFECTIVO_1748609722371','efectivo',104.52,'completado','algo','2025-05-30 12:55:22'),(11,23,'EFECTIVO_1748613793392','efectivo',240.00,'completado','lo hizo muy bien','2025-05-30 14:03:13'),(12,24,'EFECTIVO_1748617446233','efectivo',690.00,'completado','lo hiso bien','2025-05-30 15:04:06'),(14,26,'EFECTIVO_1749244384287','efectivo',460.00,'completado','lo hizo muy bien','2025-06-06 21:13:04'),(15,27,'EFECTIVO_1749245001234','efectivo',529.00,'completado','hola','2025-06-06 21:23:21'),(16,32,'EFECTIVO_1749338731852','efectivo',246.00,'completado','lo hizo muy bien','2025-06-07 23:25:31'),(17,34,'EFECTIVO_1749340278755','efectivo',130.00,'completado','lo hizo bien','2025-06-07 23:51:18'),(18,35,'EFECTIVO_1749342085388','efectivo',248.00,'completado','hola','2025-06-08 00:21:25'),(19,36,'EFECTIVO_1749342293913','efectivo',50.60,'completado','esta bien','2025-06-08 00:24:53'),(20,38,'EFECTIVO_1749347661699','efectivo',26.40,'completado','trabajo muy bien','2025-06-08 01:54:21'),(25,42,'0JD587858R516824P','paypal',60.00,'completado','{\"paypal\":{\"id\":\"0JD587858R516824P\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"60.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"60.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"60.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"3SW34091W3810281L\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"60.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-08T18:18:38Z\",\"update_time\":\"2025-06-08T18:18:38Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-08T18:18:32Z\",\"update_time\":\"2025-06-08T18:18:38Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/0JD587858R516824P\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"lo hizo very good\"}','2025-06-08 03:46:29'),(26,43,'88B56375C2199463K','paypal',240.00,'completado','{\"paypal\":{\"id\":\"88B56375C2199463K\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"5Y092830FR909352A\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-09T19:45:41Z\",\"update_time\":\"2025-06-09T19:45:41Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-09T19:45:36Z\",\"update_time\":\"2025-06-09T19:45:41Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/88B56375C2199463K\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"lo hizo muy bien\"}','2025-06-08 06:00:00'),(27,44,'05M95958KD3537522','paypal',1000.00,'completado','{\"paypal\":{\"id\":\"05M95958KD3537522\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"5VP16122XX8107816\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-10T01:14:23Z\",\"update_time\":\"2025-06-10T01:14:23Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-10T01:14:17Z\",\"update_time\":\"2025-06-10T01:14:23Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/05M95958KD3537522\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"lo hizo bien\"}','2025-06-08 06:59:56'),(28,45,'41A67755S40278632','paypal',240.00,'completado','{\"paypal\":{\"id\":\"41A67755S40278632\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"3HC26548687554329\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-11T20:54:06Z\",\"update_time\":\"2025-06-11T20:54:06Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-11T20:54:00Z\",\"update_time\":\"2025-06-11T20:54:06Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/41A67755S40278632\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"no se lavo las manos\"}','2025-06-11 20:54:06'),(29,48,'3DM72011GR9128241','paypal',240.00,'completado','{\"paypal\":{\"id\":\"3DM72011GR9128241\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"78808358R2517482S\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-11T21:05:46Z\",\"update_time\":\"2025-06-11T21:05:46Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-11T21:05:39Z\",\"update_time\":\"2025-06-11T21:05:46Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/3DM72011GR9128241\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"a las 10 am y en efectivo\"}','2025-06-11 21:05:47'),(30,49,'8KJ0464375466323R','paypal',2808.00,'completado','{\"paypal\":{\"id\":\"8KJ0464375466323R\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"2808.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"2808.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de carpinteria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de carpinteria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"2808.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"9H185957GL326145L\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"2808.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-12T00:49:44Z\",\"update_time\":\"2025-06-12T00:49:44Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-12T00:49:35Z\",\"update_time\":\"2025-06-12T00:49:44Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/8KJ0464375466323R\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"Este como los demas formularios esta poco validado\"}','2025-06-11 22:15:55'),(31,50,'EFECTIVO_1749680512142','efectivo',280.00,'completado','.','2025-06-11 22:21:52'),(32,51,'EFECTIVO_1749682701681','efectivo',240.00,'completado','123123','2025-06-11 22:58:21'),(33,52,'EFECTIVO_1749683364538','efectivo',24.00,'completado','qweqwe','2025-06-11 23:09:24'),(34,53,'21K374110K9360641','paypal',240.00,'completado','{\"paypal\":{\"id\":\"21K374110K9360641\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de albanileria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de albanileria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"47230805V9618821E\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-13T22:07:32Z\",\"update_time\":\"2025-06-13T22:07:32Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-13T22:07:24Z\",\"update_time\":\"2025-06-13T22:07:32Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/21K374110K9360641\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"lo hizo muy bien\"}','2025-06-12 03:32:16'),(35,55,'7D212442RY3567209','paypal',1000.00,'completado','{\"paypal\":{\"id\":\"7D212442RY3567209\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de electricidad\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de electricidad\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"5NY3287139814200S\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"1000.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-06-14T00:48:54Z\",\"update_time\":\"2025-06-14T00:48:54Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-06-14T00:48:21Z\",\"update_time\":\"2025-06-14T00:48:54Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7D212442RY3567209\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"Excelente trabajo\"}','2025-06-14 00:42:06'),(36,57,'9P633590VJ3168740','paypal',240.00,'completado','{\"paypal\":{\"id\":\"9P633590VJ3168740\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"4ME93801EN1369439\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"240.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-10-30T01:19:06Z\",\"update_time\":\"2025-10-30T01:19:06Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-10-30T01:18:32Z\",\"update_time\":\"2025-10-30T01:19:06Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/9P633590VJ3168740\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"lo hizo muy bien\"}','2025-10-30 01:15:57'),(37,63,'8E913487LK141892U','paypal',1172.97,'completado','{\"paypal\":{\"id\":\"8E913487LK141892U\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"1172.97\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"1172.97\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"1172.97\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"2LR67315F9704215X\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"1172.97\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-11-03T00:21:38Z\",\"update_time\":\"2025-11-03T00:21:38Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-11-03T00:20:58Z\",\"update_time\":\"2025-11-03T00:21:38Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/8E913487LK141892U\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"lo hizo muy bien\"}','2025-11-02 22:21:20'),(38,67,'EFECTIVO_1762124367542','efectivo',450.00,'completado','adsfasdf','2025-11-02 22:59:27'),(39,68,'32X73686850577828','paypal',802.97,'completado','{\"paypal\":{\"id\":\"32X73686850577828\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"802.97\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"802.97\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"802.97\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"3LF328001B4316925\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"802.97\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-11-03T01:05:50Z\",\"update_time\":\"2025-11-03T01:05:50Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-11-03T01:05:26Z\",\"update_time\":\"2025-11-03T01:05:50Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/32X73686850577828\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"fasdfsadf\"}','2025-11-02 23:09:12'),(41,71,'9MT79173R3608493T','paypal',300.00,'completado','{\"paypal\":{\"id\":\"9MT79173R3608493T\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"300.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"300.00\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"300.00\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"5MY57590TJ6951130\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"300.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-11-03T01:11:30Z\",\"update_time\":\"2025-11-03T01:11:30Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-11-03T01:11:22Z\",\"update_time\":\"2025-11-03T01:11:30Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/9MT79173R3608493T\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"xasfasdas\"}','2025-11-02 23:15:21'),(43,70,'EFECTIVO_1762125496381','efectivo',822.97,'completado','asdfasd','2025-11-02 23:18:16'),(47,75,'21S186143H8292131','paypal',252.29,'completado','{\"paypal\":{\"id\":\"21S186143H8292131\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"252.29\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"252.29\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"252.29\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"6YP43682AK3637144\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"252.29\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-11-06T02:19:51Z\",\"update_time\":\"2025-11-06T02:19:51Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-11-06T02:17:19Z\",\"update_time\":\"2025-11-06T02:19:51Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/21S186143H8292131\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"sdadwewf\"}','2025-11-05 14:19:36'),(48,75,'4XD88142TH7585238','paypal',252.29,'completado','{\"paypal\":{\"id\":\"4XD88142TH7585238\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"252.29\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"252.29\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"252.29\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"3RJ36893F5255091B\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"252.29\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-11-06T02:21:00Z\",\"update_time\":\"2025-11-06T02:21:00Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-11-06T02:20:13Z\",\"update_time\":\"2025-11-06T02:21:00Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/4XD88142TH7585238\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"sfsdf\"}','2025-11-05 14:20:45'),(49,84,'131658025N480501N','paypal',202.29,'completado','{\"paypal\":{\"id\":\"131658025N480501N\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"202.29\",\"breakdown\":{\"item_total\":{\"currency_code\":\"MXN\",\"value\":\"202.29\"},\"shipping\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"handling\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"insurance\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"shipping_discount\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"sb-89yxt43280692@business.example.com\",\"merchant_id\":\"JPJGGBHMK479U\"},\"description\":\"Servicio de plomeria\",\"soft_descriptor\":\"PAYPAL *TEST STORE\",\"items\":[{\"name\":\"Servicio de plomeria\",\"unit_amount\":{\"currency_code\":\"MXN\",\"value\":\"202.29\"},\"tax\":{\"currency_code\":\"MXN\",\"value\":\"0.00\"},\"quantity\":\"1\"}],\"payments\":{\"captures\":[{\"id\":\"9JB891862J022403C\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"MXN\",\"value\":\"202.29\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2025-11-08T05:01:01Z\",\"update_time\":\"2025-11-08T05:01:01Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-fo3sq43254160@personal.example.com\",\"payer_id\":\"DQJ35ESGKHSGS\",\"address\":{\"country_code\":\"MX\"}},\"create_time\":\"2025-11-08T05:00:31Z\",\"update_time\":\"2025-11-08T05:01:01Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/131658025N480501N\",\"rel\":\"self\",\"method\":\"GET\"}]},\"comentario\":\"sfsdfsdf\"}','2025-11-08 05:01:02'),(53,86,'EFECTIVO_1762643856354','efectivo',400.00,'completado','sdsdf','2025-11-08 23:17:36');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peticiones`
--

DROP TABLE IF EXISTS `peticiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peticiones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_afiliado` int NOT NULL,
  `id_cotizacion` int DEFAULT NULL,
  `estado` enum('pendiente','aceptada','rechazada') NOT NULL DEFAULT 'pendiente',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_afiliado` (`id_afiliado`),
  KEY `fk_peticion_cotizacion` (`id_cotizacion`),
  CONSTRAINT `fk_peticion_cotizacion` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `peticiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peticiones_ibfk_2` FOREIGN KEY (`id_afiliado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peticiones`
--

LOCK TABLES `peticiones` WRITE;
/*!40000 ALTER TABLE `peticiones` DISABLE KEYS */;
INSERT INTO `peticiones` VALUES (1,14,10,13,'aceptada','2025-05-29 20:18:33'),(5,13,10,14,'aceptada','2025-05-29 21:40:15'),(6,14,10,15,'aceptada','2025-05-29 21:51:58'),(7,14,10,16,'aceptada','2025-05-29 22:33:06'),(8,14,10,18,'aceptada','2025-05-29 23:18:21'),(10,14,8,23,'aceptada','2025-05-29 23:36:46'),(12,14,10,17,'aceptada','2025-05-30 05:13:04'),(13,14,10,19,'aceptada','2025-05-30 05:39:39'),(14,14,10,20,'aceptada','2025-05-30 05:50:19'),(15,14,10,21,'aceptada','2025-05-30 05:51:37'),(16,14,10,22,'aceptada','2025-05-30 05:53:56'),(17,14,10,27,'aceptada','2025-05-30 07:09:04'),(18,16,10,29,'aceptada','2025-05-30 07:30:42'),(19,17,4,24,'aceptada','2025-05-30 07:59:13'),(21,17,10,NULL,'pendiente','2025-05-30 08:00:38'),(28,14,10,30,'aceptada','2025-06-07 15:37:13'),(29,14,10,31,'aceptada','2025-06-07 15:58:52'),(30,14,10,32,'aceptada','2025-06-07 16:20:14'),(31,14,10,33,'aceptada','2025-06-07 16:27:39'),(32,14,7,NULL,'pendiente','2025-06-07 16:28:27'),(34,14,8,34,'aceptada','2025-06-07 16:36:38'),(35,14,10,37,'aceptada','2025-06-07 16:51:54'),(37,14,3,36,'aceptada','2025-06-07 17:18:56'),(38,14,4,NULL,'rechazada','2025-06-07 17:19:25'),(39,14,6,35,'aceptada','2025-06-07 17:19:35'),(40,14,3,NULL,'rechazada','2025-06-07 17:46:06'),(41,14,8,NULL,'aceptada','2025-06-07 17:48:17'),(42,14,6,NULL,'aceptada','2025-06-07 17:48:50'),(43,14,10,NULL,'aceptada','2025-06-07 17:51:50'),(44,14,10,NULL,'pendiente','2025-06-07 18:36:49'),(45,14,17,38,'aceptada','2025-06-07 18:47:46'),(46,14,17,39,'aceptada','2025-06-07 19:54:41'),(47,14,17,40,'aceptada','2025-06-07 20:16:12'),(48,14,17,41,'aceptada','2025-06-07 20:26:35'),(49,14,17,42,'aceptada','2025-06-07 20:29:42'),(50,14,17,NULL,'rechazada','2025-06-07 20:58:31'),(51,14,19,NULL,'rechazada','2025-06-07 22:07:31'),(52,20,19,NULL,'rechazada','2025-06-07 22:47:07'),(53,20,19,43,'aceptada','2025-06-07 22:57:29'),(54,20,17,46,'aceptada','2025-06-07 23:11:28'),(55,20,6,NULL,'aceptada','2025-06-07 23:15:11'),(56,14,6,NULL,'pendiente','2025-06-07 23:25:26'),(57,21,17,NULL,'pendiente','2025-06-07 23:47:17'),(58,21,4,44,'aceptada','2025-06-07 23:48:27'),(59,14,19,45,'aceptada','2025-06-11 13:49:33'),(60,22,17,47,'aceptada','2025-06-11 14:00:16'),(61,22,20,NULL,'pendiente','2025-06-11 14:03:26'),(62,22,8,48,'aceptada','2025-06-11 14:04:23'),(63,23,21,49,'aceptada','2025-06-11 15:02:47'),(64,23,17,50,'aceptada','2025-06-11 15:18:25'),(65,14,17,51,'aceptada','2025-06-11 15:55:50'),(66,14,17,52,'aceptada','2025-06-11 16:08:43'),(67,14,17,53,'aceptada','2025-06-11 17:32:27'),(68,14,17,54,'aceptada','2025-06-11 18:56:52'),(69,24,25,56,'aceptada','2025-06-13 17:35:32'),(70,14,25,55,'aceptada','2025-06-13 17:37:46'),(71,16,3,NULL,'pendiente','2025-06-13 17:57:53'),(72,16,4,58,'aceptada','2025-06-13 17:59:11'),(73,16,6,NULL,'pendiente','2025-06-13 17:59:49'),(74,10,6,NULL,'pendiente','2025-06-13 18:36:59'),(75,10,4,59,'aceptada','2025-10-27 14:26:12'),(76,10,3,NULL,'aceptada','2025-10-28 12:21:07'),(77,25,6,NULL,'aceptada','2025-10-29 20:48:39'),(78,10,6,NULL,'aceptada','2025-10-29 20:49:52'),(79,10,4,60,'aceptada','2025-10-29 21:12:24'),(80,10,4,61,'aceptada','2025-10-29 21:28:50'),(81,10,4,NULL,'aceptada','2025-10-29 21:30:21'),(82,10,4,62,'aceptada','2025-11-02 14:58:47'),(83,10,4,63,'aceptada','2025-11-02 15:19:11'),(84,10,4,64,'aceptada','2025-11-02 15:21:48'),(85,10,4,65,'aceptada','2025-11-02 15:23:56'),(86,10,4,66,'aceptada','2025-11-02 15:53:29'),(87,10,4,67,'aceptada','2025-11-02 15:58:14'),(88,10,4,68,'aceptada','2025-11-02 16:07:09'),(89,10,4,69,'aceptada','2025-11-02 16:07:16'),(90,10,4,70,'aceptada','2025-11-02 16:12:57'),(91,10,4,71,'aceptada','2025-11-02 16:13:05'),(92,10,4,85,'aceptada','2025-11-03 13:10:16'),(93,10,4,73,'aceptada','2025-11-03 13:16:01'),(94,10,4,74,'aceptada','2025-11-03 13:49:21'),(95,14,4,NULL,'aceptada','2025-11-03 16:05:36'),(96,14,4,82,'aceptada','2025-11-04 12:02:37'),(97,14,3,NULL,'aceptada','2025-11-04 12:31:37'),(98,14,4,75,'aceptada','2025-11-04 12:32:59'),(99,14,4,76,'aceptada','2025-11-05 07:22:04'),(100,14,4,NULL,'aceptada','2025-11-07 20:38:04'),(101,14,4,77,'aceptada','2025-11-07 20:42:16'),(102,14,4,78,'aceptada','2025-11-07 20:45:05'),(103,10,4,79,'aceptada','2025-11-07 20:48:11'),(104,14,4,80,'aceptada','2025-11-07 20:50:58'),(105,14,4,83,'aceptada','2025-11-07 20:56:10'),(106,14,3,NULL,'pendiente','2025-11-07 20:57:23'),(107,14,3,NULL,'aceptada','2025-11-07 20:59:59'),(108,14,4,81,'aceptada','2025-11-07 21:02:18'),(109,14,4,84,'aceptada','2025-11-07 21:21:22'),(110,14,4,NULL,'pendiente','2025-11-07 21:32:10'),(111,14,4,NULL,'pendiente','2025-11-07 21:58:25'),(112,14,3,86,'aceptada','2025-11-08 16:09:07');
/*!40000 ALTER TABLE `peticiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precios_hora`
--

DROP TABLE IF EXISTS `precios_hora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `precios_hora` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_especialidad` int NOT NULL,
  `precio_hora` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_especialidad` (`id_especialidad`),
  CONSTRAINT `precios_hora_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precios_hora`
--

LOCK TABLES `precios_hora` WRITE;
/*!40000 ALTER TABLE `precios_hora` DISABLE KEYS */;
INSERT INTO `precios_hora` VALUES (1,1,150.00),(2,2,180.00),(3,3,160.00),(4,4,140.00);
/*!40000 ALTER TABLE `precios_hora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razones_eliminacion_afiliados`
--

DROP TABLE IF EXISTS `razones_eliminacion_afiliados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `razones_eliminacion_afiliados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `razon` text NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `razones_eliminacion_afiliados_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razones_eliminacion_afiliados`
--

LOCK TABLES `razones_eliminacion_afiliados` WRITE;
/*!40000 ALTER TABLE `razones_eliminacion_afiliados` DISABLE KEYS */;
/*!40000 ALTER TABLE `razones_eliminacion_afiliados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razones_eliminacion_clientes`
--

DROP TABLE IF EXISTS `razones_eliminacion_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `razones_eliminacion_clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `razon` text NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `razones_eliminacion_clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios2` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razones_eliminacion_clientes`
--

LOCK TABLES `razones_eliminacion_clientes` WRITE;
/*!40000 ALTER TABLE `razones_eliminacion_clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `razones_eliminacion_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_especialidad` int NOT NULL,
  `nombre_servicio` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_especialidad` (`id_especialidad`),
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,1,'Reparaci+¦n de fuga de agua','Fuga menor en tuber+¡a o llave',180.00),(2,1,'Destapar lavabo o fregadero','Con herramientas manuales',220.00),(3,1,'Instalaci+¦n de sanitario','Incluye sellado y prueba',350.00),(4,1,'Cambio de mezcladora o llave','Mano de obra incluida',200.00),(5,1,'Instalaci+¦n de calentador de gas','Solo mano de obra',500.00),(6,2,'Cambio de apagador o contacto','Material no incluido',150.00),(7,2,'Instalaci+¦n de foco o l??mpara','Mano de obra b+ísica',180.00),(8,2,'Revisi+¦n de corto circuito','Diagn+¦stico b+ísico',200.00),(9,2,'Instalaci+¦n de ventilador de techo','Montaje completo',300.00),(10,2,'Cableado de un cuarto','Hasta 4 contactos y 2 apagadores',600.00),(11,3,'Reparaci+¦n de puerta','Ajuste o cambio de bisagras',250.00),(12,3,'Instalaci+¦n de cerradura','Mano de obra incluida',180.00),(13,3,'Armado de mueble','Mueble de tama+¦o mediano',300.00),(14,3,'Lijado y barnizado de puerta','Acabado b+ísico',400.00),(15,3,'Reparaci+¦n de cajonera','Ajuste o reemplazo de correderas',200.00),(16,4,'Reparaci+¦n de muro con grietas','Hasta 1 m??',250.00),(17,4,'Colocaci+¦n de azulejo','Por m??',280.00),(18,4,'Resanar y pintar pared','Hasta 3 m??',300.00),(19,4,'Colado de firme peque+¦o','Hasta 2 m??',400.00),(20,4,'Instalaci+¦n de block','Por m??',300.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `especialidad` enum('albanileria','plomeria','carpinteria','electricidad') NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `ine_frente` varchar(255) NOT NULL,
  `ine_reverso` varchar(255) NOT NULL,
  `verificado` tinyint(1) DEFAULT '0',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `calle` varchar(100) DEFAULT NULL,
  `numero_casa` varchar(20) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `indicaciones` text,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'jorge','aguirre','robles','jorgeluis','jorge@gmail.com','6682433048','$2y$10$LAFkDCFwaqVMRJUBzNY7H.ZuVaYIWrRKDml9QQXE.tAVXSvosNj2q','plomeria','uploads/usuarios/3/perfil/perfil_6844d9fc57706.png','uploads/usuarios/6827e2c72985a.jpg','uploads/usuarios/6827e2c72994f.jpg',1,'2025-05-17 01:13:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'juan','perez','pito','pito','perez@gmail.com','6682433048','$2y$10$FiKl52lW2tC1y6HGD1N6XeZ86ePoxhsGikQvXnHo9JfSNHlmUxsVK','plomeria','uploads/usuarios/4/perfil/perfil_690165c3da7f4.jpeg','uploads/usuarios/6827e9f1409be.jpg','uploads/usuarios/6827e9f140a8c.jpg',1,'2025-05-17 01:44:17','Fuentes','0','81223','Sinaloa','Ahome','Fac Ingenieria mochis',25.81299460,-108.97545040),(6,'pablo','carreon','solis','black','pablo@gmail.com','6682433080','$2y$10$lGV3/bnXt00uUTtHlmFlTejL9kedcxZzXUbjJsp4xBnPSl9ahd2Re','electricidad','','','',1,'2025-05-25 00:09:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'pablo','carreon','solis','black','cachorrita@gmail.com','6682433080','$2y$10$ULEM5Zxf07LpnpsjrXtCSubc5b0sFgAWJwG0Df.tRxs8XpBviIYDO','electricidad','uploads/usuarios/7/perfil/683260c9c552a.jpeg','uploads/usuarios/7/ine_frente/683260c9c56c6.jpg','uploads/usuarios/7/ine_reverso/683260c9c59a6.jpg',1,'2025-05-25 00:14:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'herman','salinas','eolias','matador','herman@gmail.com','6684454840','$2y$10$..Ilyug8QMX8Vq7q0f6nVOh3txcWBb6sI4r4hqeNnNPezOeBwr35G','carpinteria','uploads/usuarios/8/perfil/perfil_6839527112b1e.jpeg','uploads/usuarios/8/ine_frente/6832657938c06.jpg','uploads/usuarios/8/ine_reverso/6832657938cf7.jpeg',1,'2025-05-25 00:34:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'gabriel alejandro','rodriguez','briseno','lalo','alex@gmail.com','6682434040','$2y$10$6im.eZdSmHLdg4tymr0Jau1HKdGD9UyJ/dY8BM3DeHyV4KIKXONye','plomeria','uploads/usuarios/10/perfil/perfil_68393725979e9.jpeg','uploads/usuarios/10/ine_frente/683272d06be1e.jpg','uploads/usuarios/10/ine_reverso/683272d06bf47.jpg',1,'2025-05-25 01:30:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'carlos','estrada','avalos','carlitos','carlos@gmail.com','123456782','$2y$10$oYUBtEDTT/4cmBaoHdeYf.vrfdqNxYE3zXjKFFvL6WQ0hQJUWPmdy','albanileria','uploads/usuarios/17/perfil/6844dc074aa4f.png','uploads/usuarios/17/ine_frente/6844dc074aaff.png','uploads/usuarios/17/ine_reverso/6844dc074ab3f.png',1,'2025-06-08 00:40:39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'meredith','rodriguez','briseno','mere16','mere12@gmail.com','6682433021','$2y$10$8ecDkUncSr8gDfxUl1O0MeY.JfQdS5kdU43bMprj/quSeriNk0YpC','plomeria','uploads/usuarios/19/perfil/68451a2987e8d.png','uploads/usuarios/19/ine_frente/68451a2987f34.png','uploads/usuarios/19/ine_reverso/68451a2987f6e.png',1,'2025-06-08 05:05:45',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'Luis','Lopez','Soto','luis','luis@hotmail.com','6688151415','$2y$10$PSbrCgsSgzmPxPoS12A1Je2RGNZdd6if20efwO8EFRbAPMCAkYAYu','carpinteria','uploads/usuarios/20/perfil/684536e348848.png','uploads/usuarios/20/ine_frente/684536e3488df.png','uploads/usuarios/20/ine_reverso/684536e34893a.png',1,'2025-06-08 07:08:19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'Pancho','Perea','Perez','pancho_pe','pancho_pe@gmail.com','6681040506','$2y$10$BmJE2VlInv1ji4rGO96i5OJsOplhhETaArTbRNPWHc26R3KniueZa','carpinteria','uploads/usuarios/21/perfil/6849f90b96316.png','uploads/usuarios/21/ine_frente/6849f90b97368.png','uploads/usuarios/21/ine_reverso/6849f90b9740b.png',1,'2025-06-11 21:45:47',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'edgar','rodriguez','briseno','labro460','ro@gmail.com','6682433025','$2y$10$y4B3h4q76hStoNVBEc1veuqvRCCW2G4lmazpz.sl3qlh4WHe9MU8a','carpinteria','uploads/usuarios/22/perfil/684a1955422f3.jpeg','uploads/usuarios/22/ine_frente/684a195542729.jpeg','uploads/usuarios/22/ine_reverso/684a195542d6a.jpg',0,'2025-06-12 00:03:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'edgar','rodriguez','brise','edgar120','ro12@gmail.com','668243325','$2y$10$hw9UMt911PiMhBsJg0NgeeeofxF4x8up/uzmrEb9T/UlbbPtl5Cem','plomeria','uploads/usuarios/23/perfil/684a19ea89e7c.jpeg','uploads/usuarios/23/ine_frente/684a19ea89fe2.jpeg','uploads/usuarios/23/ine_reverso/684a19ea8a139.jpeg',0,'2025-06-12 00:06:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'Panchito','Contreras','','Panchito','correopancho@gmail.com','6681050607','$2y$10$ckqMnW7lmTGph53FGxPZu.zd6nr3S1Q66gjcpUfB5zOG9BFis7PUW','electricidad','','','',1,'2025-06-14 00:16:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'Soy Pancho Electricista','Jom','Dipot','P_','panchoJom@gmail.com','6681124578','$2y$10$8hbVKsM8nuTyw0Z3NxCMeenk/R49Z4EZelxQDo5vi1FvwSBeS84Gq','electricidad','uploads/usuarios/25/perfil/684cc366c6d25.jpg','uploads/usuarios/25/ine_frente/684cc366c6dcc.jpg','uploads/usuarios/25/ine_reverso/684cc366c6e15.jpeg',1,'2025-06-14 00:33:42',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios2`
--

DROP TABLE IF EXISTS `usuarios2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numero_casa` varchar(20) DEFAULT NULL,
  `codigo_postal` varchar(5) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `indicaciones` text,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios2`
--

LOCK TABLES `usuarios2` WRITE;
/*!40000 ALTER TABLE `usuarios2` DISABLE KEYS */;
INSERT INTO `usuarios2` VALUES (1,'wsdf',NULL,'345','sdf@gmail.com','$2y$10$eVAMxA3OSDNfdTpeBuE/DO328iug8tqKPu71iUkPiZZhGyPIcIbTu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'ugyhj',NULL,'4567u','mainkindred923@gmail.com','$2y$10$cUX9fzDRbtAnmNZu4DRLYOxpCOg63V.Qtzd1RozExz6vuiKjk7ZL2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'jorgiluismr',NULL,'6682410890','mainkindred824@gmail.com','$2y$10$s.7nf.LlOfow5lMTpKlgQ.awkTfswsaD56dEzsajt0ziWG7khCBPW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'edgar',NULL,'6682433048','labro460@gmail.com','$2y$10$pfjYmjgPFQI0J/.jOONlh.i4cXgofYVcst5dNCyrAPK15sauCyA.a',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'edgar',NULL,'6682433049','labro440@gmail.com','$2y$10$fA3A3VbXUPikAdHUadEH4Ouyd2Cwud8MBmZx8il.0tAAEJA4pLiyq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'eduardo','eduardo','6682433050','eduardo@gmail.com','$2y$10$sTgtMRcOkK2V6.2/ITPVyucvBh1NmUbjPFW8LZjuJe/7vam/vBZcW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'labro','labro12','6682433047','caca@gmail.com','$2y$10$oe3Tw1WYSHFB1KA0ygBVKOLnqhQCQqaqfyJi/YvQEzhOfPbsLGbnq','brasiles','1221','81285','Sinaloa','Ahome','en una casa azul',25.76704590,-108.98178940),(11,'lalo rodriguez briseno','edgar','6682433060','labro490@gmail.com','$2y$10$pviFqoRllDy8Hu/z1zsH1.tK9AAq9tCBIeycfhyOqayOm19VKc3Aa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'eduardo rodriguez briseno','labro','6682433070','lalo460@gmail.com','$2y$10$Z99xidGUypBqf0HU0Izk0OxgVK10YZKAwkysqTyJVyrxmlfVciXJm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'edgar edu','lalo','6682433090','edu@gmail.com','$2y$10$tgn7ZbemJXmBd7/duUjS/.O/2zLcnMhuyG4B8RNyhguL30ppIxCRG','jazmin','81249','81250','Sinaloa','Ahome','mi casa esta en un corola blanco',25.81775040,-109.00102770),(15,'Cliente Diana','LaDianaCam','1234567890','dianacamacho@uas.edu.mx','$2y$10$B09AKAbdPldwjQlywRDRPuU/0mv8sb70PGCRJW0JwU7uUPaRncGsO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'jorge','buki','6682433077','buki12@gmail.com','$2y$10$nXTVR4oob.3l.CmedNxAlOWd8Vc.VlhPr7eBvpiMEIGMfNZRGMhvK','jazmin','168','81249','sinaloa','ahome','en una casa con un pino enfrente',25.81775040,-109.00102770),(17,'meredith','deni12','66819295','denissebriseno@214','$2y$10$1uTrwrgNhcutgc/k2308e.RIU3IXfzOGAxj7DJ0/yXpRHP7PGRBtq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'edrick','drick','6682434040','edrick@gmail.com','$2y$10$g8oLhOZ8ZxugQMkQMKNbxeWOdHTEAsJk9SJi9jOQFoTO10ROJjgQW','jazmin','1608','8129','sinaloa','ahome','esta un versa blanco afuera de la casa',25.79464490,-109.01579730),(19,'Rocio','rocio','6688121212','rocio@mail.com','$2y$10$TCwE.CohMQ7yJaw3amEKwu.Wr4AF7nW1f1NzRpbAm8.jMEz7B0fAu','leyva','5','81200','dsadsa','fdsfsd','fdsfds',NULL,NULL),(20,'pedro','pedro12','668243098','perro@gmail.com','$2y$10$KhLudA8nowW1b8KSSFIvJuFiECYfzTkzP0UAbey4R8yA86yAa/Cri','jazmin','1608','81249','sinaloa','ahome','toque la puerta',25.81775040,-109.00102770),(21,'Rocio Becerra','rocio2','6688151515','rocio2@gmail.com','$2y$10$seqUJqAP17Nwb20/ynBwie9oMwmQv7Mh36n9p2EGdCI/8Fg4vcD4u','leyva','5','81200','Sinaloa','Ahome','casa con puerta y ventanas, sobre una calle',25.79508840,-108.99102010),(22,'pedrito solin','sola ester','6668345678','raguairvvazquez@gmail.com','$2y$10$tW.SM2LomlpzPS.b7QaG4.8aIOaxlMLhTw8yNjoU8WCq2KZ5xS3ue','pamplona','567','81249','sinaloa','ahome','casa con porton azul y pino verde',NULL,NULL),(23,'Diana Camacho','D_camacho','6681030405','diana90@gmail.com','$2y$10$y7gw978mA.ZOaDEHdPdP1ugYrMBAlb06C5XujIcAjRXf8lA87AqNK','morelos','1','81360','sinaloa','ahome','afuera de una tahoe dorada',25.77754190,-108.96771980),(24,'Pancho Dos','ElPancho2','6681010203','pancho02@gmail.com','$2y$10$Cp3F55GknV2oT9UxL7k.0epDcy0ngU2n5Yhb4QKyJBmpXcL27wHiG','Morelos','42','81200','Sinaloa','Ahome','Hay un vocho blanco afuera',NULL,NULL),(25,'edgar','julio','66824333333','123@gmail.com','$2y$10$MsyTKNdOZ7Y7ccVvgEfzueViu2ogd1b4BRFOSqwzsldQ1RpSFSwWC','jazmin','1608','81249','Sinaloa','Ahome','en una casa verde',NULL,NULL),(26,'edgar','gilberto','6682438080','algo@gmail.com','1234','jazmin','1608','81249','sinaloa','ahome','en una casa amarilla',NULL,NULL),(27,'algo','algo','6682433041','algo12@gmail.com','$2y$10$0kpt.NgHo5RIay82E/XWxeDZyaEesl638R.JzoMHQdv7ymigJQY8C',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuarios2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-09 14:24:26
