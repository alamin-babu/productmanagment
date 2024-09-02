-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: product
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
-- Table structure for table `products_list`
--

DROP TABLE IF EXISTS `products_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_list`
--

LOCK TABLES `products_list` WRITE;
/*!40000 ALTER TABLE `products_list` DISABLE KEYS */;
INSERT INTO `products_list` VALUES (11,'Sony WH-1000XM4',349.99,'Noise-canceling wireless headphones with exceptional sound quality and long battery life.','2024-08-31 06:21:16','alamin'),(12,'Apple MacBook Pro 16',2399.99,'Powerful laptop with Apple M1 Pro chip, 32GB RAM, and 1TB SSD.','2024-08-31 06:21:16','alamin'),(13,'HP Envy 13',899.99,'Alamin Compact and stylish laptop with Intel Core i5, 8GB RAM, and 256GB SSD.','2024-08-31 06:21:16','alamin'),(14,'Dell XPS 15dvgfg',5.00,'ubknown','2024-09-01 04:28:40','alamin'),(15,'Aasdfdasf',1.00,'sdff','2024-09-01 04:33:42','alamin'),(16,'asfasf',23423.00,'sadfasf','2024-09-01 04:35:55','alamin'),(17,'erw',32.00,'asfaf','2024-09-01 04:36:28','alamin'),(18,'rretew',43.00,'sdff','2024-09-01 04:38:24','alamin'),(19,'eafasdf',23.00,'safdaf','2024-09-01 04:39:58','alamin'),(24,'edsfgbn',4.00,'df','2024-09-01 17:27:17','alamin'),(25,'fdsf',3.00,'dcxz','2024-09-01 17:31:49','alamin'),(26,'a3r',1.00,'sdf','2024-09-01 17:32:28','alamin'),(27,'aaaa',234.00,'sdff','2024-09-01 17:32:52','alamin'),(28,'sdfsdf',324.00,'zxcxc','2024-09-01 17:33:15','alamin');
/*!40000 ALTER TABLE `products_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-02 10:32:30
