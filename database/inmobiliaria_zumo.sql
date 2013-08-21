-- MySQL dump 10.13  Distrib 5.5.31, for Linux (x86_64)
--
-- Host: localhost    Database: inmobiliaria_zumo
-- ------------------------------------------------------
-- Server version	5.5.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  `property_adress_id` varchar(45) DEFAULT NULL,
  `property_location_id` varchar(45) DEFAULT NULL,
  `property_payment_information_id` varchar(45) DEFAULT NULL,
  `property_description_id` varchar(45) DEFAULT NULL,
  `available` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property`
--

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_address`
--

DROP TABLE IF EXISTS `property_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exterior_number` varchar(9) DEFAULT NULL,
  `interior_number` varchar(9) DEFAULT NULL,
  `street` varchar(180) DEFAULT NULL,
  `quarter` varchar(180) DEFAULT NULL,
  `city` varchar(180) DEFAULT NULL,
  `municipality` varchar(180) DEFAULT NULL,
  `state` varchar(180) DEFAULT NULL,
  `country` varchar(180) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_address`
--

LOCK TABLES `property_address` WRITE;
/*!40000 ALTER TABLE `property_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_description`
--

DROP TABLE IF EXISTS `property_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('Departamento') DEFAULT NULL,
  `antiquity` varchar(50) DEFAULT NULL,
  `number_of_rooms` int(11) DEFAULT NULL,
  `number_of_bathrooms` int(11) DEFAULT NULL,
  `number_of_parkings` int(11) DEFAULT NULL,
  `square_meters_of_construction` float DEFAULT NULL,
  `square_meters_of_land` float DEFAULT NULL,
  `extra_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_description`
--

LOCK TABLES `property_description` WRITE;
/*!40000 ALTER TABLE `property_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_extra_area`
--

DROP TABLE IF EXISTS `property_extra_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_extra_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `area_name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_extra_area`
--

LOCK TABLES `property_extra_area` WRITE;
/*!40000 ALTER TABLE `property_extra_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_extra_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_extra_information`
--

DROP TABLE IF EXISTS `property_extra_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_extra_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proeprty_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_extra_information`
--

LOCK TABLES `property_extra_information` WRITE;
/*!40000 ALTER TABLE `property_extra_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_extra_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_image`
--

DROP TABLE IF EXISTS `property_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `imagen` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_image`
--

LOCK TABLES `property_image` WRITE;
/*!40000 ALTER TABLE `property_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_location`
--

DROP TABLE IF EXISTS `property_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitud` varchar(50) DEFAULT NULL,
  `longitud` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_location`
--

LOCK TABLES `property_location` WRITE;
/*!40000 ALTER TABLE `property_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_payment_information`
--

DROP TABLE IF EXISTS `property_payment_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_payment_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rent_price` decimal(11,2) DEFAULT NULL,
  `sale_price` decimal(11,2) DEFAULT NULL,
  `maintenance_price` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_payment_information`
--

LOCK TABLES `property_payment_information` WRITE;
/*!40000 ALTER TABLE `property_payment_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_payment_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_saved_by_user`
--

DROP TABLE IF EXISTS `search_saved_by_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_saved_by_user` (
  `user_id` int(11) NOT NULL,
  `property_id` varchar(45) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_saved_by_user`
--

LOCK TABLES `search_saved_by_user` WRITE;
/*!40000 ALTER TABLE `search_saved_by_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_saved_by_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `active` bit(1) DEFAULT b'1',
  `isAdmin` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-20 23:55:40
