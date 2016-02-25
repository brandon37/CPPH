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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomCliente` varchar(60) NOT NULL,
  `status` enum('Activo','Incactivo') NOT NULL DEFAULT 'Activo',
  `idsector` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `fk_clientes_sector1_idx` (`idsector`),
  CONSTRAINT `fk_clientes_sector1` FOREIGN KEY (`idsector`) REFERENCES `sector` (`idsector`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `numFactura` varchar(45) NOT NULL,
  `estado` enum('Pagado','No Pagado') NOT NULL DEFAULT 'No Pagado',
  `idordenCompras` int(11) NOT NULL,
  PRIMARY KEY (`idfactura`),
  KEY `fk_facturas_ordenCompras1_idx` (`idordenCompras`),
  CONSTRAINT `fk_facturas_ordenCompras1` FOREIGN KEY (`idordenCompras`) REFERENCES `ordenCompras` (`idordenCompras`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenCompras`
--

DROP TABLE IF EXISTS `ordenCompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenCompras` (
  `idordenCompras` int(11) NOT NULL,
  `concepto` text NOT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `fCreacion` varchar(45) NOT NULL,
  `fTerm` varchar(45) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  PRIMARY KEY (`idordenCompras`),
  KEY `fk_ordenCompras_proyectos1_idx` (`idproyecto`),
  CONSTRAINT `fk_ordenCompras_proyectos1` FOREIGN KEY (`idproyecto`) REFERENCES `proyectos` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenCompras`
--

LOCK TABLES `ordenCompras` WRITE;
/*!40000 ALTER TABLE `ordenCompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenCompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectos` (
  `idproyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nomProyecto` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `fCreacion` varchar(45) DEFAULT NULL,
  `fTerm` varchar(45) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  PRIMARY KEY (`idproyecto`),
  KEY `fk_proyectos_clientes_idx` (`idCliente`),
  CONSTRAINT `fk_proyectos_clientes` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sector` (
  `idsector` int(11) NOT NULL AUTO_INCREMENT,
  `tipoSector` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idsector`)
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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `tipo` enum('Admin','General') NOT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','brandon@hydralab.mx','21232f297a57a5a743894a0e4a801fc3','Admin'),(2,'user1','user1@hydralab.mx','202cb962ac59075b964b07152d234b70','General'),(3,'user2','user2@hydralab.mx','202cb962ac59075b964b07152d234b70','General');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-22 18:10:17
