-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: emsdb
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `idemployee` int NOT NULL,
  `idmeeting` int NOT NULL,
  `status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`idemployee`,`idmeeting`),
  KEY `idmeeting_fk_idx` (`idmeeting`),
  CONSTRAINT `idemployee_fk_att` FOREIGN KEY (`idemployee`) REFERENCES `employee` (`idemployee`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idmeeting_fk_att` FOREIGN KEY (`idmeeting`) REFERENCES `meeting` (`idmeeting`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,4,'N'),(2,1,'N'),(2,2,'N'),(2,4,'N'),(3,2,'N'),(3,3,'N'),(3,4,'N'),(4,1,'N'),(4,3,'N'),(5,1,'N'),(5,2,'N'),(5,3,'N');
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `idemployee` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `birthday` date NOT NULL,
  `department` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(4000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `idrole` int NOT NULL,
  `picture` varchar(200) NOT NULL,
  PRIMARY KEY (`idemployee`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `idrole_fk_idx` (`idrole`),
  CONSTRAINT `idrole_fk` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Uros','Kozic','2001-06-06','IT','uros@gmail.com','uros123',1,'uros.png'),(2,'Ivan','Sobic','2001-08-09','IT','ivan@gmail.com','ivan123',2,'ivan.png'),(3,'Nikola','Subaric','2001-04-03','HR','nikola@gmail.com','nikola123',2,'nikola.png'),(4,'Boris','Martinovic','2001-05-05','IT','boris@gmail.com','boris123',3,'boris.png'),(5,'John','Doe','1995-07-01','HR','john@gmail.com','john123',3,'john.png');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meeting` (
  `idmeeting` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `timeFrom` datetime NOT NULL,
  `timeTo` datetime NOT NULL,
  `status` enum('H','U') NOT NULL,
  `idemployee` int NOT NULL,
  PRIMARY KEY (`idmeeting`),
  KEY `idemployee_fk_idx` (`idemployee`),
  CONSTRAINT `idemployee_fk` FOREIGN KEY (`idemployee`) REFERENCES `employee` (`idemployee`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting`
--

LOCK TABLES `meeting` WRITE;
/*!40000 ALTER TABLE `meeting` DISABLE KEYS */;
INSERT INTO `meeting` VALUES (1,'Big meeting','2023-06-08 09:30:00','2023-06-08 12:30:00','U',2),(2,'Important meeting','2023-06-29 15:00:00','2023-06-29 15:45:00','U',3),(3,'Meeting with client','2023-06-09 08:00:00','2023-06-09 09:30:00','U',3),(4,'Meeting with managers','2023-06-23 11:00:00','2023-06-23 13:30:00','U',1);
/*!40000 ALTER TABLE `meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `idrole` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin'),(3,'employee'),(2,'manager');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-06 21:35:32
