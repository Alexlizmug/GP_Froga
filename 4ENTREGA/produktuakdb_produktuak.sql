-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: produktuakdb
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `produktuak`
--

DROP TABLE IF EXISTS `produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktuak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(255) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `prezioa` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktuak`
--

LOCK TABLES `produktuak` WRITE;
/*!40000 ALTER TABLE `produktuak` DISABLE KEYS */;
INSERT INTO `produktuak` VALUES (2,'Platanoak','Fruituak',1.20),(3,'Madariak','Fruituak',1.80),(4,'Laranja','Fruituak',2.00),(5,'Marrubiak','Fruituak',2.50),(6,'Oilasko bularra','Haragia',5.00),(7,'Txerri-solomoa','Haragia',7.50),(8,'Arkumea','Haragia',12.00),(9,'Txuleta','Haragia',15.00),(10,'Hanburgesa','Haragia',3.00),(11,'Esnea','Esnekiak',1.00),(12,'Gazta','Esnekiak',2.80),(13,'Jogurtak','Esnekiak',0.90),(14,'Gurina','Esnekiak',1.50),(15,'Krema','Esnekiak',2.00),(16,'Arrautzak','Beste',1.20),(17,'Irina','Beste',0.80),(18,'Azukrea','Beste',0.60),(19,'Gatza','Beste',0.50),(20,'Oliba olioa','Beste',4.00),(21,'Ura','Edariak',0.50),(22,'Zukua','Edariak',1.50),(23,'Kafea','Edariak',3.00),(24,'Te','Edariak',2.50),(25,'Garagardoa','Edariak',1.80),(26,'Ardoa','Edariak',8.00),(27,'Txokolatea','Gozoak',2.00),(28,'Gailetak','Gozoak',1.20),(29,'Izozkiak','Gozoak',2.50),(30,'Gominolak','Gozoak',1.00),(31,'Sgarra','Janaria',1.50);
/*!40000 ALTER TABLE `produktuak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-30 18:35:58
