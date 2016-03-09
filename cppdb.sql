-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: cppdb
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nameClient` varchar(60) NOT NULL,
  `status` enum('Activo','Incactivo') NOT NULL DEFAULT 'Activo',
  `idSector` int(11) NOT NULL,
  PRIMARY KEY (`idClient`),
  KEY `fk_clientes_sector1_idx` (`idSector`),
  CONSTRAINT `fk_clientes_sector1` FOREIGN KEY (`idSector`) REFERENCES `sector` (`idSector`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departament`
--

DROP TABLE IF EXISTS `departament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departament` (
  `idDepartament` int(11) NOT NULL AUTO_INCREMENT,
  `nameDepartament` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDepartament`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departament`
--

LOCK TABLES `departament` WRITE;
/*!40000 ALTER TABLE `departament` DISABLE KEYS */;
/*!40000 ALTER TABLE `departament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `idInvoice` int(11) NOT NULL AUTO_INCREMENT,
  `noinvoice` varchar(45) NOT NULL,
  `status` enum('Pagado','No Pagado') NOT NULL DEFAULT 'No Pagado',
  PRIMARY KEY (`idInvoice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderShopping`
--

DROP TABLE IF EXISTS `orderShopping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderShopping` (
  `idOrderShopping` int(11) NOT NULL,
  `concept` text NOT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `dateCreation` varchar(45) NOT NULL,
  `dateTermination` varchar(45) NOT NULL,
  `idproyect` int(11) NOT NULL,
  `idInvoice` int(11) NOT NULL,
  PRIMARY KEY (`idOrderShopping`),
  KEY `fk_ordenCompras_proyectos1_idx` (`idproyect`),
  KEY `fk_ordenCompras_invoice1_idx` (`idInvoice`),
  CONSTRAINT `fk_ordenCompras_invoice1` FOREIGN KEY (`idInvoice`) REFERENCES `invoice` (`idInvoice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ordenCompras_proyectos1` FOREIGN KEY (`idproyect`) REFERENCES `proyects` (`idProyect`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderShopping`
--

LOCK TABLES `orderShopping` WRITE;
/*!40000 ALTER TABLE `orderShopping` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderShopping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyects`
--

DROP TABLE IF EXISTS `proyects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyects` (
  `idProyect` int(11) NOT NULL AUTO_INCREMENT,
  `nameProyect` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `dateCreation` varchar(45) DEFAULT NULL,
  `dateTermination` varchar(45) DEFAULT NULL,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idProyect`),
  KEY `fk_proyectos_clientes_idx` (`idClient`),
  CONSTRAINT `fk_proyectos_clientes` FOREIGN KEY (`idClient`) REFERENCES `clients` (`idClient`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyects`
--

LOCK TABLES `proyects` WRITE;
/*!40000 ALTER TABLE `proyects` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyects_has_departament`
--

DROP TABLE IF EXISTS `proyects_has_departament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyects_has_departament` (
  `idProyect` int(11) NOT NULL AUTO_INCREMENT,
  `idDepartament` int(11) NOT NULL,
  PRIMARY KEY (`idProyect`,`idDepartament`),
  KEY `fk_proyects_has_departament_departament1_idx` (`idDepartament`),
  KEY `fk_proyects_has_departament_proyects1_idx` (`idProyect`),
  CONSTRAINT `fk_proyects_has_departament_departament1` FOREIGN KEY (`idDepartament`) REFERENCES `departament` (`idDepartament`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyects_has_departament_proyects1` FOREIGN KEY (`idProyect`) REFERENCES `proyects` (`idProyect`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyects_has_departament`
--

LOCK TABLES `proyects_has_departament` WRITE;
/*!40000 ALTER TABLE `proyects_has_departament` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyects_has_departament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyects_has_departament1`
--

DROP TABLE IF EXISTS `proyects_has_departament1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyects_has_departament1` (
  `idProyect` int(11) NOT NULL,
  `idDepartament` int(11) NOT NULL,
  PRIMARY KEY (`idProyect`,`idDepartament`),
  KEY `fk_proyects_has_departament1_departament1_idx` (`idDepartament`),
  KEY `fk_proyects_has_departament1_proyects1_idx` (`idProyect`),
  CONSTRAINT `fk_proyects_has_departament1_departament1` FOREIGN KEY (`idDepartament`) REFERENCES `departament` (`idDepartament`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyects_has_departament1_proyects1` FOREIGN KEY (`idProyect`) REFERENCES `proyects` (`idProyect`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyects_has_departament1`
--

LOCK TABLES `proyects_has_departament1` WRITE;
/*!40000 ALTER TABLE `proyects_has_departament1` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyects_has_departament1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sector` (
  `idSector` int(11) NOT NULL AUTO_INCREMENT,
  `typeSector` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idSector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sector`
--

LOCK TABLES `sector` WRITE;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nameUser` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `type` enum('Admin','General') NOT NULL DEFAULT 'General',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'','','d41d8cd98f00b204e9800998ecf8427e','Admin'),(3,'user1','user1@hydralab.mx','b58c50e209762c24adb9f29daffe249c','General'),(4,'user2','user2@hydralab.mx','15c6d98082895abf1c20c0358aff2a67','General');
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

-- Dump completed on 2016-03-08 15:30:24
