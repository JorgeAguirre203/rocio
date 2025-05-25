-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: servinow_jorge
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.04.1

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
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'edgar','1234'),(2,'edgar@gmail.com','1234');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'edgar','rodriguez','briseno','lalo','labro460@gmail.com','6682433048','$2y$10$M8/D.RtFekq1wzxOVeOVsuE9LG310bOh2DU/gRcu7AjH/a.WLN9SC','electricidad','uploads/usuarios/6825213279142.jpg','uploads/usuarios/6825213279351.jpg','uploads/usuarios/6825213279448.jpg',1,'2025-05-14 23:03:14'),(2,'edgar','rodriguez','camacho','lalo','labro@gmail.com','6682433048','$2y$10$7ny/u4wjCFCRAEnHx6dEfOn3Uzzj4Nu172vhB/JxYQ.CnBZMSU/qm','albanileria','uploads/usuarios/682522d26c05e.jpg','uploads/usuarios/682522d26c1d6.jpg','uploads/usuarios/682522d26c2c9.jpg',1,'2025-05-14 23:10:10'),(3,'jorge','aguirre','robles','jorgeluis','jorge@gmail.com','6682433048','$2y$10$LAFkDCFwaqVMRJUBzNY7H.ZuVaYIWrRKDml9QQXE.tAVXSvosNj2q','plomeria','uploads/usuarios/6827e2c7296d9.jpg','uploads/usuarios/6827e2c72985a.jpg','uploads/usuarios/6827e2c72994f.jpg',1,'2025-05-17 01:13:43'),(4,'juan','perez','pito','pito','perez@gmail.com','6682433048','$2y$10$FiKl52lW2tC1y6HGD1N6XeZ86ePoxhsGikQvXnHo9JfSNHlmUxsVK','plomeria','uploads/usuarios/6827e9f1406b3.jpg','uploads/usuarios/6827e9f1409be.jpg','uploads/usuarios/6827e9f140a8c.jpg',1,'2025-05-17 01:44:17'),(5,'edrick','camacho','robles','el dick','edrick@gmail.com','6682433080','$2y$10$ejlCN5ae2gvqd38W4xyTreWlG4x5bBG1Y13cFlfmY7uHOaEOVAAyG','carpinteria','uploads/usuarios/682d49b3361ef.jpeg','uploads/usuarios/682d49b3362ed.jpg','uploads/usuarios/682d49b33637b.jpg',1,'2025-05-21 03:34:11'),(6,'pablo','carreon','solis','black','pablo@gmail.com','6682433080','$2y$10$lGV3/bnXt00uUTtHlmFlTejL9kedcxZzXUbjJsp4xBnPSl9ahd2Re','electricidad','','','',1,'2025-05-25 00:09:50'),(7,'pablo','carreon','solis','black','cachorrita@gmail.com','6682433080','$2y$10$ULEM5Zxf07LpnpsjrXtCSubc5b0sFgAWJwG0Df.tRxs8XpBviIYDO','electricidad','uploads/usuarios/7/perfil/683260c9c552a.jpeg','uploads/usuarios/7/ine_frente/683260c9c56c6.jpg','uploads/usuarios/7/ine_reverso/683260c9c59a6.jpg',1,'2025-05-25 00:14:01'),(8,'herman','salinas','degortari','matador','herman@gmail.com','6684454840','$2y$10$..Ilyug8QMX8Vq7q0f6nVOh3txcWBb6sI4r4hqeNnNPezOeBwr35G','carpinteria','uploads/usuarios/8/perfil/6832657938aa7.jpeg','uploads/usuarios/8/ine_frente/6832657938c06.jpg','uploads/usuarios/8/ine_reverso/6832657938cf7.jpeg',1,'2025-05-25 00:34:01'),(9,'jorgito','choix','fuerte','ovejasimp','simp@gmail.com','6682433085','$2y$10$Ix1FlWTn0tgw3kWPLKFEgu8x.n4s1Zwguy3Z5lwHDpHDcYMoQqqiq','albanileria','uploads/usuarios/9/perfil/683268bb9e5fc.jpeg','uploads/usuarios/9/ine_frente/683268bb9e92d.jpg','uploads/usuarios/9/ine_reverso/683268bb9ea25.jpeg',1,'2025-05-25 00:47:55'),(10,'gabriel','rodriguez','briseno','alex','alex@gmail.com','6682434040','$2y$10$6im.eZdSmHLdg4tymr0Jau1HKdGD9UyJ/dY8BM3DeHyV4KIKXONye','albanileria','uploads/usuarios/10/perfil/683272d06bb6b.jpeg','uploads/usuarios/10/ine_frente/683272d06be1e.jpg','uploads/usuarios/10/ine_reverso/683272d06bf47.jpg',1,'2025-05-25 01:30:56');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuarios2`
--

LOCK TABLES `usuarios2` WRITE;
/*!40000 ALTER TABLE `usuarios2` DISABLE KEYS */;
INSERT INTO `usuarios2` VALUES (1,'wsdf',NULL,'345','sdf@gmail.com','$2y$10$eVAMxA3OSDNfdTpeBuE/DO328iug8tqKPu71iUkPiZZhGyPIcIbTu'),(2,'ugyhj',NULL,'4567u','mainkindred923@gmail.com','$2y$10$cUX9fzDRbtAnmNZu4DRLYOxpCOg63V.Qtzd1RozExz6vuiKjk7ZL2'),(3,'jorgiluismr',NULL,'6682410890','mainkindred824@gmail.com','$2y$10$s.7nf.LlOfow5lMTpKlgQ.awkTfswsaD56dEzsajt0ziWG7khCBPW'),(4,'edgar',NULL,'6682433048','labro460@gmail.com','$2y$10$pfjYmjgPFQI0J/.jOONlh.i4cXgofYVcst5dNCyrAPK15sauCyA.a'),(6,'edgar',NULL,'6682433049','labro440@gmail.com','$2y$10$fA3A3VbXUPikAdHUadEH4Ouyd2Cwud8MBmZx8il.0tAAEJA4pLiyq'),(8,'eduardo','eduardo','6682433050','eduardo@gmail.com','$2y$10$sTgtMRcOkK2V6.2/ITPVyucvBh1NmUbjPFW8LZjuJe/7vam/vBZcW'),(10,'labro','labro','6682433047','caca@gmail.com','$2y$10$oe3Tw1WYSHFB1KA0ygBVKOLnqhQCQqaqfyJi/YvQEzhOfPbsLGbnq'),(11,'lalo rodriguez briseno','edgar','6682433060','labro490@gmail.com','$2y$10$pviFqoRllDy8Hu/z1zsH1.tK9AAq9tCBIeycfhyOqayOm19VKc3Aa'),(13,'eduardo rodriguez briseno','labro','6682433070','lalo460@gmail.com','$2y$10$Z99xidGUypBqf0HU0Izk0OxgVK10YZKAwkysqTyJVyrxmlfVciXJm'),(14,'edgar','lalo','6682433090','edu@gmail.com','$2y$10$tgn7ZbemJXmBd7/duUjS/.O/2zLcnMhuyG4B8RNyhguL30ppIxCRG');
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

-- Dump completed on 2025-05-24 18:55:43
