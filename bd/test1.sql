CREATE DATABASE  IF NOT EXISTS `u230756120_test_yamaha_co` /*!40100 DEFAULT CHARACTER SET utf8mb4 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `u230756120_test_yamaha_co`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: u230756120_test_yamaha_co
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `beneficios`
--

DROP TABLE IF EXISTS `beneficios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beneficios` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `beneficio` char(100) DEFAULT NULL,
  `url_beneficio` text,
  `type` tinyint DEFAULT NULL COMMENT '1-> normal\n2->opcional',
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_beneficio` (`beneficio`) /*!80000 INVISIBLE */,
  KEY `indx_type` (`type`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficios`
--

LOCK TABLES `beneficios` WRITE;
/*!40000 ALTER TABLE `beneficios` DISABLE KEYS */;
INSERT INTO `beneficios` VALUES (1,'3 Servicios gratuitos en mano obra','otros/incluye/mano_obra.png',1,1,0,NULL,NULL),(2,'Kit de Herramientas','otros/incluye/herramientas.png',1,1,0,NULL,NULL),(3,'Manual de Propietario','otros/incluye/manual.png',1,1,0,NULL,NULL),(4,'Manual de Garantía','otros/incluye/garantia.png',1,1,0,NULL,NULL),(5,'Trámite de placa y tarjeta','otros/incluye/tramite-placa.png',2,1,0,NULL,NULL),(6,'Casco','otros/incluye/cascos.png',2,1,0,NULL,NULL),(7,'SOAT','otros/incluye/soat.png',2,1,0,NULL,NULL),(8,'Otros Gift','otros/incluye/otros.png',2,1,0,NULL,NULL);
/*!40000 ALTER TABLE `beneficios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint NOT NULL,
  `categoria` char(100) DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_categoria` (`categoria`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `tipo_documento_id` int NOT NULL,
  `documento` char(25) DEFAULT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clientes_tipo_documentos_idx` (`tipo_documento_id`),
  KEY `indx_documento` (`documento`) /*!80000 INVISIBLE */,
  KEY `indx_celular` (`celular`),
  KEY `indx_correo` (`correo`),
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`),
  CONSTRAINT `fk_clientes_tipo_documentos` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Cristian Chavez',NULL,1,'47331640','944129804','cristian@mail.com',1,0,'2024-06-30 05:34:52','2024-06-30 05:34:52'),(2,'Hector Chauca',NULL,1,'08315297','958258145','hector@mail.com',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_cambio` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES (1,3.75,NULL,'2024-06-30 14:34:10');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizacions`
--

DROP TABLE IF EXISTS `cotizacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cotizacions` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `numero` char(100) DEFAULT NULL,
  `modelo` char(50) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `color` char(100) DEFAULT NULL,
  `cliente_id` bigint NOT NULL,
  `pdf_url` text,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `precio_usd` double DEFAULT NULL,
  `descuento_usd` double DEFAULT NULL,
  `precio_final_usd` double DEFAULT NULL,
  `precio_final_pen` double DEFAULT NULL,
  `personal_id` bigint NOT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_cambio` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cotizacions_clientes1_idx` (`cliente_id`),
  KEY `indx_numero` (`numero`),
  KEY `indx_modelo` (`modelo`) /*!80000 INVISIBLE */,
  KEY `indx_year` (`year`) /*!80000 INVISIBLE */,
  KEY `indx_color` (`color`) /*!80000 INVISIBLE */,
  KEY `fk_cotizacions_personals1_idx` (`personal_id`),
  KEY `indx_fecha` (`fecha`) /*!80000 INVISIBLE */,
  KEY `indx_hora` (`hora`) /*!80000 INVISIBLE */,
  KEY `indx_fecha_fin` (`fecha_fin`),
  KEY `indx_precio_usd` (`precio_usd`) /*!80000 INVISIBLE */,
  KEY `indx_descuento_usd` (`descuento_usd`) /*!80000 INVISIBLE */,
  KEY `indx_precio_final_usd` (`precio_final_usd`),
  KEY `indx_precio_final_pen` (`precio_final_pen`),
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`),
  CONSTRAINT `fk_cotizacions_clientes1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `fk_cotizacions_personals1` FOREIGN KEY (`personal_id`) REFERENCES `personals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacions`
--

LOCK TABLES `cotizacions` WRITE;
/*!40000 ALTER TABLE `cotizacions` DISABLE KEYS */;
INSERT INTO `cotizacions` VALUES (5,'00000001','Cygnus Ray ZR',2024,'Midnight Black',1,'','2024-07-01','12:51:45',NULL,2229,160,2069,7758.75,1,1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',3.71),(6,'00000002','Cygnus Ray ZR',2024,'Matt Light Blue',1,'','2024-07-01','17:08:31',NULL,2229,180,2049,7683.75,1,1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',3.75),(7,'00000003','Cygnus Ray ZR',2024,'Matt Light Blue',1,'','2024-07-01','17:12:02',NULL,2229,200,2029,7608.75,1,1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',3.75),(8,'00000004','Cygnus Ray ZR',2024,'Midnight Black',2,'','2024-07-01','20:05:44',NULL,2229,285,1944,7290,1,1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',3.75);
/*!40000 ALTER TABLE `cotizacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_cotizacions`
--

DROP TABLE IF EXISTS `data_cotizacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_cotizacions` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `codigo` char(50) DEFAULT NULL,
  `modelo` char(100) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `color_fabrica` char(150) DEFAULT NULL,
  `color_comercial` char(150) DEFAULT NULL,
  `nombre_producto` char(200) DEFAULT NULL,
  `linea_negocio` char(10) DEFAULT NULL,
  `claim` char(100) DEFAULT NULL,
  `descripcion` text,
  `color1` char(100) DEFAULT NULL,
  `color2` char(100) DEFAULT NULL,
  `color3` char(100) DEFAULT NULL,
  `beneficio1` char(200) DEFAULT NULL,
  `beneficio2` char(200) DEFAULT NULL,
  `beneficio3` char(200) DEFAULT NULL,
  `beneficio4` char(200) DEFAULT NULL,
  `tipo_motor` char(250) DEFAULT NULL,
  `cilindrada` char(50) DEFAULT NULL,
  `potencia_max` char(50) DEFAULT NULL,
  `torque_max` char(50) DEFAULT NULL,
  `sistema_arrranque` char(100) DEFAULT NULL,
  `sistema_transmision` char(200) DEFAULT NULL,
  `suministro_combustible` char(200) DEFAULT NULL,
  `capacidad_combustible` char(50) DEFAULT NULL,
  `altura_asiento` char(50) DEFAULT NULL,
  `peso_total` char(50) DEFAULT NULL,
  `suspension_delantera` char(100) DEFAULT NULL,
  `suspencion_trasera` char(100) DEFAULT NULL,
  `freno_delantero` char(100) DEFAULT NULL,
  `freno_trasero` char(100) DEFAULT NULL,
  `neumatico_delantero` char(100) DEFAULT NULL,
  `numatico_trasero` char(100) DEFAULT NULL,
  `precio_usd` double DEFAULT NULL,
  `categoria` char(200) DEFAULT NULL,
  `subcategoria` char(200) DEFAULT NULL,
  `cotizacion_id` bigint NOT NULL,
  `maestro_modelo_id` bigint DEFAULT NULL,
  `url_logo` text,
  `url_moto_principal` text,
  `url_color1` text,
  `url_color2` text,
  `url_color3` text,
  `url_beneficio1` text,
  `url_beneficio2` text,
  `url_beneficio3` text,
  `url_beneficio4` text,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_codigo` (`codigo`) /*!80000 INVISIBLE */,
  KEY `indx_modelo` (`modelo`) /*!80000 INVISIBLE */,
  KEY `indx_year` (`year`),
  KEY `indx_color_fab` (`color_fabrica`) /*!80000 INVISIBLE */,
  KEY `indx_color_com` (`color_comercial`) /*!80000 INVISIBLE */,
  KEY `indx_nombre` (`nombre_producto`) /*!80000 INVISIBLE */,
  KEY `indx_linea` (`linea_negocio`) /*!80000 INVISIBLE */,
  KEY `indx_claim` (`claim`) /*!80000 INVISIBLE */,
  KEY `indx_color1` (`color1`) /*!80000 INVISIBLE */,
  KEY `indx_color2` (`color2`) /*!80000 INVISIBLE */,
  KEY `indx_color3` (`color3`) /*!80000 INVISIBLE */,
  KEY `indx_tipo_motor` (`tipo_motor`),
  KEY `indx_cilindrada` (`cilindrada`) /*!80000 INVISIBLE */,
  KEY `indx_potencia` (`potencia_max`) /*!80000 INVISIBLE */,
  KEY `indx_torque` (`torque_max`) /*!80000 INVISIBLE */,
  KEY `indx_arranque` (`sistema_arrranque`) /*!80000 INVISIBLE */,
  KEY `indx_transmision` (`sistema_transmision`) /*!80000 INVISIBLE */,
  KEY `indx_combustible` (`suministro_combustible`) /*!80000 INVISIBLE */,
  KEY `indx_combustible_capacidad` (`capacidad_combustible`) /*!80000 INVISIBLE */,
  KEY `indx_altura_asiento` (`altura_asiento`) /*!80000 INVISIBLE */,
  KEY `indx_peso_total` (`peso_total`) /*!80000 INVISIBLE */,
  KEY `indx_suspencion_delantera` (`suspension_delantera`) /*!80000 INVISIBLE */,
  KEY `indx_suspension_trasera` (`suspencion_trasera`) /*!80000 INVISIBLE */,
  KEY `indx_freno_delantero` (`freno_delantero`) /*!80000 INVISIBLE */,
  KEY `indx_freno_trasero` (`freno_trasero`) /*!80000 INVISIBLE */,
  KEY `indx_neumatico1` (`neumatico_delantero`) /*!80000 INVISIBLE */,
  KEY `indx_neumatico2` (`numatico_trasero`) /*!80000 INVISIBLE */,
  KEY `indx_precio_usd` (`precio_usd`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`),
  KEY `indx_categoria` (`categoria`) /*!80000 INVISIBLE */,
  KEY `indx_subcategoria` (`subcategoria`),
  KEY `fk_data_cotizacions_cotizacions1_idx` (`cotizacion_id`),
  CONSTRAINT `fk_data_cotizacions_cotizacions1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_cotizacions`
--

LOCK TABLES `data_cotizacions` WRITE;
/*!40000 ALTER TABLE `data_cotizacions` DISABLE KEYS */;
INSERT INTO `data_cotizacions` VALUES (5,'BKY500010B05','Cygnus Ray ZR',2024,'NEG','Midnight Black','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',2069,'SCOOTER','SCOOTER',5,22,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010B05.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45'),(6,'BKY500010F16','Cygnus Ray ZR',2024,'AZU_MAT','Matt Light Blue','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',2049,'SCOOTER','SCOOTER',6,23,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010F16.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31'),(7,'BKY500010F16','Cygnus Ray ZR',2024,'AZU_MAT','Matt Light Blue','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',2029,'SCOOTER','SCOOTER',7,23,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010F16.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02'),(8,'BKY500010B05','Cygnus Ray ZR',2024,'NEG','Midnight Black','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',1944,'SCOOTER','SCOOTER',8,22,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010B05.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44');
/*!40000 ALTER TABLE `data_cotizacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garantias`
--

DROP TABLE IF EXISTS `garantias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `garantias` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `garantia` char(200) DEFAULT NULL,
  `url_imagen` text,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_garantia` (`garantia`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garantias`
--

LOCK TABLES `garantias` WRITE;
/*!40000 ALTER TABLE `garantias` DISABLE KEYS */;
INSERT INTO `garantias` VALUES (1,'Garantía de 3 meses','otros/incluye/3-m-garantia.png',1,0,NULL,NULL),(2,'Garantía de 2 años o 20,000 KM (Lo que ocurra primero)','otros/incluye/2-garantia.png',1,0,NULL,NULL),(3,'Garantía de 4 años o 40,000 KM (Lo que ocurra primero)','otros/incluye/4-garantia.png',1,0,NULL,NULL);
/*!40000 ALTER TABLE `garantias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `includes`
--

DROP TABLE IF EXISTS `includes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `includes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` char(100) DEFAULT NULL,
  `urlimage` text,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cotizacion_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_includes_cotizacions1_idx` (`cotizacion_id`),
  KEY `indx_nombre` (`nombre`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`),
  CONSTRAINT `fk_includes_cotizacions1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `includes`
--

LOCK TABLES `includes` WRITE;
/*!40000 ALTER TABLE `includes` DISABLE KEYS */;
INSERT INTO `includes` VALUES (5,'Garantía de 4 años o 40,000 KM (Lo que ocurra primero)','otros/incluye/4-garantia.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(6,'3 Servicios gratuitos en mano obra','otros/incluye/mano_obra.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(7,'Kit de Herramientas','otros/incluye/herramientas.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(8,'Manual de Propietario','otros/incluye/manual.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(9,'Manual de Garantía','otros/incluye/garantia.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(10,'Trámite de placa y tarjeta','otros/incluye/tramite-placa.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(11,'Otros Gift','otros/incluye/otros.png',1,0,'2024-07-01 17:51:45','2024-07-01 17:51:45',5),(12,'Garantía de 4 años o 40,000 KM (Lo que ocurra primero)','otros/incluye/4-garantia.png',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',6),(13,'3 Servicios gratuitos en mano obra','otros/incluye/mano_obra.png',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',6),(14,'Kit de Herramientas','otros/incluye/herramientas.png',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',6),(15,'Manual de Propietario','otros/incluye/manual.png',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',6),(16,'Manual de Garantía','otros/incluye/garantia.png',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',6),(17,'SOAT','otros/incluye/soat.png',1,0,'2024-07-01 22:08:31','2024-07-01 22:08:31',6),(18,'Garantía de 4 años o 40,000 KM (Lo que ocurra primero)','otros/incluye/4-garantia.png',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',7),(19,'3 Servicios gratuitos en mano obra','otros/incluye/mano_obra.png',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',7),(20,'Kit de Herramientas','otros/incluye/herramientas.png',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',7),(21,'Manual de Propietario','otros/incluye/manual.png',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',7),(22,'Manual de Garantía','otros/incluye/garantia.png',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',7),(23,'Otros Gift','otros/incluye/otros.png',1,0,'2024-07-01 22:12:02','2024-07-01 22:12:02',7),(24,'Garantía de 4 años o 40,000 KM (Lo que ocurra primero)','otros/incluye/4-garantia.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(25,'3 Servicios gratuitos en mano obra','otros/incluye/mano_obra.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(26,'Kit de Herramientas','otros/incluye/herramientas.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(27,'Manual de Propietario','otros/incluye/manual.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(28,'Manual de Garantía','otros/incluye/garantia.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(29,'Trámite de placa y tarjeta','otros/incluye/tramite-placa.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(30,'Casco','otros/incluye/cascos.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(31,'SOAT','otros/incluye/soat.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8),(32,'Otros Gift','otros/incluye/otros.png',1,0,'2024-07-02 01:05:44','2024-07-02 01:05:44',8);
/*!40000 ALTER TABLE `includes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maestro_beneficios`
--

DROP TABLE IF EXISTS `maestro_beneficios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maestro_beneficios` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `codigo` char(50) DEFAULT NULL,
  `modelo` char(50) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `color_fabrica` char(100) DEFAULT NULL,
  `color_comercial` char(100) DEFAULT NULL,
  `nombre_producto` char(200) DEFAULT NULL,
  `linea_negocio` char(10) DEFAULT NULL,
  `garantia_id` bigint DEFAULT NULL,
  `beneficio1_id` bigint DEFAULT NULL,
  `beneficio1_status` tinyint DEFAULT NULL,
  `beneficio2_id` bigint DEFAULT NULL,
  `beneficio2_status` tinyint DEFAULT NULL,
  `beneficio3_id` bigint DEFAULT NULL,
  `beneficio3_status` tinyint DEFAULT NULL,
  `beneficio4_id` bigint DEFAULT NULL,
  `beneficio4_status` tinyint DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_codigo` (`codigo`) /*!80000 INVISIBLE */,
  KEY `indx_modelo` (`modelo`),
  KEY `indx_year` (`year`) /*!80000 INVISIBLE */,
  KEY `indx_color1` (`color_fabrica`),
  KEY `indx_color2` (`color_comercial`) /*!80000 INVISIBLE */,
  KEY `indx_nombre` (`nombre_producto`) /*!80000 INVISIBLE */,
  KEY `indx_linea` (`linea_negocio`) /*!80000 INVISIBLE */,
  KEY `indx_beneficio1` (`beneficio1_id`) /*!80000 INVISIBLE */,
  KEY `indx_beneficio1s` (`beneficio1_status`),
  KEY `indx_beneficio2` (`beneficio2_id`) /*!80000 INVISIBLE */,
  KEY `indx_beneficio2s` (`beneficio2_status`),
  KEY `indx_beneficio3` (`beneficio3_id`) /*!80000 INVISIBLE */,
  KEY `indx_beneficio3s` (`beneficio3_status`) /*!80000 INVISIBLE */,
  KEY `indx_beneficio4` (`beneficio4_id`) /*!80000 INVISIBLE */,
  KEY `indx_beneficio4s` (`beneficio4_status`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maestro_beneficios`
--

LOCK TABLES `maestro_beneficios` WRITE;
/*!40000 ALTER TABLE `maestro_beneficios` DISABLE KEYS */;
INSERT INTO `maestro_beneficios` VALUES (1,'BX5800010A06','XTZ125',2024,'AZU','Competition Blue','MOTOCICLETA XTZ125E XTZ125','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(2,'BX5800010B01','XTZ125',2024,'BLA','Cross White','MOTOCICLETA XTZ125E XTZ125','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(3,'BX5800010C05','XTZ125',2024,'NEG','Cross Black','MOTOCICLETA XTZ125E XTZ125','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(4,'B0L800010B01','XTZ150',2024,'BLA','Cross White','MOTOCICLETA XTZ150-2 XTZ150','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(5,'B0L800010C06','XTZ150',2024,'AZU','Competition Blue','MOTOCICLETA XTZ150-2 XTZ150','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(6,'B0L800010A05','XTZ150',2024,'NEG','Cross Black','MOTOCICLETA XTZ150-2 XTZ150','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(7,'B8L400010A06','XTZ250 ABS',2024,'AZU','Competition Blue','MOTOCICLETA XTZ250 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(8,'B8L400010B07','XTZ250 ABS',2024,'ROJ','Red Fire','MOTOCICLETA XTZ250 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(9,'BCW500010A06','YZF-R15 ABS',2023,'AZU','Racing Blue','MOTOCICLETA YZF155-A YZF-R15 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(10,'BCW500010B05','YZF-R15 ABS',2023,'NEG','Midnight Black','MOTOCICLETA YZF155-A YZF-R15 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(11,'BCW600010A06','YZF-R15 ABS',2024,'AZU','Racing Blue','MOTOCICLETA YZF155-A YZF-R15 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(12,'BCW600010B05','YZF-R15 ABS',2024,'NEG','Midnight Black','MOTOCICLETA YZF155-A YZF-R15 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(13,'BVJE00010A06','YZF-R3',2024,'AZU','Racing Blue','MOTOCICLETA YZF320-A YZF-R3','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(14,'BVJE00010B05','YZF-R3',2024,'NEG','Midnight Black','MOTOCICLETA YZF320-A YZF-R3','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(15,'BVA100010A06','YZF-R7',2023,'AZU','Racing Blue','MOTOCICLETA YZF690 YZF-R7','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(16,'BMPF00010A06','YZF-R1',2024,'AZU','Racing Blue','MOTOCICLETA YZF1000 YZF-R1','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(17,'BVWB00010B31','TÉNÉRÉ 700',2024,'GRI_OSC','Competition Blue','MOTOCICLETA XTZ690 TENERE 700','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(18,'BVWB00010A06','TÉNÉRÉ 700',2024,'AZU','Competition Blue','MOTOCICLETA XTZ690 TENERE 700','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(19,'BAP200010B07','TRACER 9 GT',2021,'ROJ','Red Line','MOTOCICLETA MTT890D TRACER 9 GT','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(20,'BAP200010C41','TRACER 9 GT',2021,'GRI_OSC','Tech Kamo','MOTOCICLETA MTT890D TRACER 9 GT','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(21,'BKY500010A07','Cygnus Ray ZR',2024,'ROJ','Matt Light Red','MOTOCICLETA LCG125 CYGNUS RAYZR','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(22,'BKY500010B05','Cygnus Ray ZR',2024,'NEG','Midnight Black','MOTOCICLETA LCG125 CYGNUS RAYZR','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(23,'BKY500010F16','Cygnus Ray ZR',2024,'AZU_MAT','Matt Light Blue','MOTOCICLETA LCG125 CYGNUS RAYZR','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(24,'BGRK00010B07','CRYPTON',2024,'ROJ','Magma Red','MOTOCICLETA T110C T110 CRYPTON','MC',2,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(25,'BGRK00010D39','CRYPTON',2024,'GRI_NEG','Dark Silver','MOTOCICLETA T110C T110 CRYPTON','MC',2,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(26,'B6YH00010E31','NMAX CONNECTED',2024,'GRI','Pastel Dark Gray','MOTOCICLETA GPD155-A NMAX CONNECTED','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(27,'B6YM00010E31','NMAX CONNECTED',2024,'GRI','Pastel Dark Gray','MOTOCICLETA GPD155-A NMAX CONNECTED','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(28,'BH8800010A05','YBR-Z',2023,'NEG','Midnight Black','MOTOCICLETA YB125ZR YBR-Z','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(29,'BH8800010C06','YBR-Z',2023,'AZU','Metal Skyblue','MOTOCICLETA YB125ZR YBR-Z','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(30,'BH8800010E07','YBR-Z',2023,'ROJ','Red Scarlet','MOTOCICLETA YB125ZR YBR-Z','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(31,'BH8900010C06','YBR-Z',2024,'AZU','Metal Skyblue','MOTOCICLETA YB125ZR YBR-Z','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(32,'BH8900010E07','YBR-Z',2024,'ROJ','Red Scarlet','MOTOCICLETA YB125ZR YBR-Z','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(33,'BH8900010A05','YBR-Z',2024,'NEG','Midnight Black','MOTOCICLETA YB125ZR YBR-Z','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(34,'BGB400010C05','FZS 3.0',2023,'NEG','Midnight Black','MOTOCICLETA FZN150 FZS 3.0','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(35,'BGB400010D06','FZS 3.0',2023,'AZU','Racing Blue','MOTOCICLETA FZN150 FZS 3.0','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(36,'BGB500010B16','FZS 3.0 ABS',2023,'AZU_MAT','Matt Dark Blue','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(37,'BGB600010A05','FZS 3.0 ABS',2023,'NEG','Metallic Black','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(38,'BGB600010C08','FZS 3.0 ABS',2023,'GRI','Pastel Dark Gray','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(39,'BGB900010A07','FZS 3.0 ABS',2024,'ROJ','Matt Light Red','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(40,'BGB900010B16','FZS 3.0 ABS',2024,'AZU_MAT','Matt Dark Blue','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(41,'BGBA00010C31','FZS 3.0 ABS',2024,'GRI','Pastel Dark Gray','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(42,'BSX100010A15','FZ-X CONNECTED',2023,'NEG_MAT','Matt Black','MOTOCICLETA YC150 FZ-X Connected','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(43,'BSX200010A06','FZ-X CONNECTED',2023,'AZU','Vintage Blue','MOTOCICLETA YC150 FZ-X Connected','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(44,'BSX300010A15','FZ-X CONNECTED',2024,'NEG_MAT','Matt Black','MOTOCICLETA YC150 FZ-X CONNECTED','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(45,'BSX300010C16','FZ-X CONNECTED',2024,'AZU_MAT','Matt Blue','MOTOCICLETA YC150 FZ-X CONNECTED','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(46,'B8H800010B15','FZ25 ABS',2024,'NEG_MAT','Matt-Black','MOTOCICLETA FZN250-A FZ25 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(47,'B8H800010C16','FZ25 ABS',2024,'AZU_MAT','Midnight Matt Blue','MOTOCICLETA FZN250-A FZ25 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(48,'B8H800010A05','FZ25 ABS',2024,'NEG_TUR','Midnight Black','MOTOCICLETA FZN250-A FZ25 ABS','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(49,'2XPA00010B05','YB125 CHACARERA',2024,'NEG','Midnight Black','MOTOCICLETA YB125','MC',2,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(50,'2XPA00010E07','YB125 CHACARERA',2024,'ROJ','Red Ruby','MOTOCICLETA YB125','MC',2,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(51,'BFL300010A06','MT-15',2023,'AZU','Icon Blue','MOTOCICLETA MTN155  MT-15','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(52,'BFL300010C31','MT-15',2023,'GRI_OSC','Tech Black','MOTOCICLETA MTN155  MT-15','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(53,'B5WG00010A06','MT-03 ABS',2023,'AZU','Icon Blue','MOTOCICLETA MTN320-A MT-03','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(54,'B5WG00010B31','MT-03 ABS',2023,'GRI','Storm Fluo','MOTOCICLETA MTN320-A MT-03','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(55,'B5WG00010C33','MT-03 ABS',2023,'GRI_OSC','Tech Black','MOTOCICLETA MTN320-A MT-03','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(56,'BTK600010B31','MT-07 ABS',2023,'GRI','Storm Fluo','MOTOCICLETA MTN690 MT-07','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(57,'BTK600010C41','MT-07 ABS',2023,'GRI_OSC','Tech Black','MOTOCICLETA MTN690 MT-07','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(58,'BTK600010A06','MT-07 ABS',2023,'AZU','Icon Blue','MOTOCICLETA MTN690 MT-07','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(59,'BTKJ00010B31','MT-07 ABS',2024,'GRI','Storm Fluo','MOTOCICLETA MTN690 MT-07','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(60,'B7NX00010A06','MT-09 ABS',2024,'AZU','Icon Blue','MOTOCICLETA MTN890 MT-09','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(61,'B7NX00010B31','MT-09 ABS',2024,'GRI','Storm Fluo','MOTOCICLETA MTN890 MT-09','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(62,'B7NX00010C41','MT-09 ABS',2024,'GRI_OSC','Tech Black','MOTOCICLETA MTN890 MT-09','MC',2,1,0,2,1,3,1,4,1,1,0,NULL,NULL),(63,'BSL300010A06','PW50',2023,'AZU','Competition Blue','MOTOCICLETA PW50','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(64,'BR8M00010A06','YZ65',2023,'AZU','Competition Blue','MOTOCICLETA YZ65','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(65,'B0GG00010A06','YZ85LW',2023,'AZU','Competition Blue','MOTOCICLETA YZ85LW','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(66,'B4XA00010A06','YZ125',2023,'AZU','Competition Blue','MOTOCICLETA YZ125','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(67,'BSB200010A06','YZ250F',2024,'AZU','Competition Blue','MOTOCICLETA YZ250F','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(68,'BHR200010A06','YZ450F',2023,'AZU','Competition Blue','MOTOCICLETA YZ450F','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(69,'B3ME00010A06','WR 155R',2024,'AZU','Competition Blue','MOTOCICLETA WR155R','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(70,'B3ME00010B05','WR 155R',2024,'NEG','Cross Black','MOTOCICLETA WR155R','MC',3,1,1,2,1,3,1,4,1,1,0,NULL,NULL),(71,'BAKJ00010A06','WR250F',2023,'AZU','Competition Blue','MOTOCICLETA WR250F','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(72,'BDBC00010A06','WR450F',2023,'AZU','Competition Blue','MOTOCICLETA WR450F','MC',0,1,0,2,1,3,1,4,0,1,0,NULL,NULL),(73,'','Kodiak 450 4W',2024,'AZU','Competition Blue','CUATRIMOTO YFM450FWB KODIAK 450','ATV',1,1,0,2,1,3,1,4,0,1,0,NULL,NULL);
/*!40000 ALTER TABLE `maestro_beneficios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maestro_modelos`
--

DROP TABLE IF EXISTS `maestro_modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maestro_modelos` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `codigo` char(50) DEFAULT NULL,
  `modelo` char(100) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `categoria` char(200) DEFAULT NULL,
  `subcategoria` char(200) DEFAULT NULL,
  `color_fabrica` char(150) DEFAULT NULL,
  `color_comercial` char(150) DEFAULT NULL,
  `nombre_producto` char(200) DEFAULT NULL,
  `linea_negocio` char(10) DEFAULT NULL,
  `claim` char(100) DEFAULT NULL,
  `descripcion` text,
  `color1` char(100) DEFAULT NULL,
  `color2` char(100) DEFAULT NULL,
  `color3` char(100) DEFAULT NULL,
  `beneficio1` char(200) DEFAULT NULL,
  `beneficio2` char(200) DEFAULT NULL,
  `beneficio3` char(200) DEFAULT NULL,
  `beneficio4` char(200) DEFAULT NULL,
  `tipo_motor` char(250) DEFAULT NULL,
  `cilindrada` char(50) DEFAULT NULL,
  `potencia_max` char(50) DEFAULT NULL,
  `torque_max` char(50) DEFAULT NULL,
  `sistema_arrranque` char(100) DEFAULT NULL,
  `sistema_transmision` char(200) DEFAULT NULL,
  `suministro_combustible` char(200) DEFAULT NULL,
  `capacidad_combustible` char(50) DEFAULT NULL,
  `altura_asiento` char(50) DEFAULT NULL,
  `peso_total` char(50) DEFAULT NULL,
  `suspension_delantera` char(100) DEFAULT NULL,
  `suspencion_trasera` char(100) DEFAULT NULL,
  `freno_delantero` char(100) DEFAULT NULL,
  `freno_trasero` char(100) DEFAULT NULL,
  `neumatico_delantero` char(100) DEFAULT NULL,
  `numatico_trasero` char(100) DEFAULT NULL,
  `precio_usd` double DEFAULT NULL,
  `descuento_usd` double DEFAULT NULL,
  `precio_final_usd` double DEFAULT NULL,
  `url_logo` text,
  `url_moto_principal` text,
  `url_color1` text,
  `url_color2` text,
  `url_color3` text,
  `url_beneficio1` text,
  `url_beneficio2` text,
  `url_beneficio3` text,
  `url_beneficio4` text,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_categoria` (`categoria`),
  KEY `indx_subcategoria` (`subcategoria`),
  KEY `indx_codigo` (`codigo`) /*!80000 INVISIBLE */,
  KEY `indx_modelo` (`modelo`) /*!80000 INVISIBLE */,
  KEY `indx_year` (`year`),
  KEY `indx_color_fab` (`color_fabrica`) /*!80000 INVISIBLE */,
  KEY `indx_color_com` (`color_comercial`) /*!80000 INVISIBLE */,
  KEY `indx_nombre` (`nombre_producto`) /*!80000 INVISIBLE */,
  KEY `indx_linea` (`linea_negocio`) /*!80000 INVISIBLE */,
  KEY `indx_claim` (`claim`) /*!80000 INVISIBLE */,
  KEY `indx_color1` (`color1`) /*!80000 INVISIBLE */,
  KEY `indx_color2` (`color2`) /*!80000 INVISIBLE */,
  KEY `indx_color3` (`color3`) /*!80000 INVISIBLE */,
  KEY `indx_tipo_motor` (`tipo_motor`),
  KEY `indx_cilindrada` (`cilindrada`) /*!80000 INVISIBLE */,
  KEY `indx_potencia` (`potencia_max`) /*!80000 INVISIBLE */,
  KEY `indx_torque` (`torque_max`) /*!80000 INVISIBLE */,
  KEY `indx_arranque` (`sistema_arrranque`) /*!80000 INVISIBLE */,
  KEY `indx_transmision` (`sistema_transmision`) /*!80000 INVISIBLE */,
  KEY `indx_combustible` (`suministro_combustible`) /*!80000 INVISIBLE */,
  KEY `indx_combustible_capacidad` (`capacidad_combustible`) /*!80000 INVISIBLE */,
  KEY `indx_altura_asiento` (`altura_asiento`) /*!80000 INVISIBLE */,
  KEY `indx_peso_total` (`peso_total`) /*!80000 INVISIBLE */,
  KEY `indx_suspencion_delantera` (`suspension_delantera`) /*!80000 INVISIBLE */,
  KEY `indx_suspension_trasera` (`suspencion_trasera`) /*!80000 INVISIBLE */,
  KEY `indx_freno_delantero` (`freno_delantero`) /*!80000 INVISIBLE */,
  KEY `indx_freno_trasero` (`freno_trasero`) /*!80000 INVISIBLE */,
  KEY `indx_neumatico1` (`neumatico_delantero`) /*!80000 INVISIBLE */,
  KEY `indx_neumatico2` (`numatico_trasero`) /*!80000 INVISIBLE */,
  KEY `indx_precio_usd` (`precio_usd`) /*!80000 INVISIBLE */,
  KEY `indx_descuento_usd` (`descuento_usd`) /*!80000 INVISIBLE */,
  KEY `indx_precio_final_usd` (`precio_final_usd`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maestro_modelos`
--

LOCK TABLES `maestro_modelos` WRITE;
/*!40000 ALTER TABLE `maestro_modelos` DISABLE KEYS */;
INSERT INTO `maestro_modelos` VALUES (1,'BX5800010A06','XTZ125',2024,'TODO TERRENO','ON-OFF 0-149','AZU','Competition Blue','MOTOCICLETA XTZ125E XTZ125','MC','Supera tus límites','Su diseño, resistencia y maniobrabilidad convierten a la XTZ125 en una gran opción para usarla en todo tipo de caminos. Preparada para movilizarte ágilmente por la ciudad como para recorrer con mayor confort los terrenos difíciles, gracias a su suspensión trasera monocross. A la vez sus gráficos y colores le dan una apariencia más deportiva.','Competition Blue','Cross Black','Cross White','Diseño estilo motocross','Motor eficiente y de buen rendimiento','Freno de disco delantero equipado de serie, sumado a la suspensión monoshock trasera, brinda estabilidad y control','Aro delantero 21 Aro posterior 18','4 tiempos SOHC, enfriado por aire, monocilíndrico','124 cc','10 HP a 7,500 rpm','9.90 N-m a 5500 rpm','Eléctrico y patada','5 velocidades, engrane constante, cadena','Carburador ','11 Litros','840 mm','118 kg','Horquilla telescópica','Basculante (Monocross)','Disco','Tambor','80/90-R21','110/80-R18',2599,0,2599,'','','','','','','','','',1,0,NULL,NULL),(2,'BX5800010B01','XTZ125',2024,'TODO TERRENO','ON-OFF 0-149','BLA','Cross White','MOTOCICLETA XTZ125E XTZ125','MC','Supera tus límites','Su diseño, resistencia y maniobrabilidad convierten a la XTZ125 en una gran opción para usarla en todo tipo de caminos. Preparada para movilizarte ágilmente por la ciudad como para recorrer con mayor confort los terrenos difíciles, gracias a su suspensión trasera monocross. A la vez sus gráficos y colores le dan una apariencia más deportiva.','Competition Blue','Cross Black','Cross White','Diseño estilo motocross','Motor eficiente y de buen rendimiento','Freno de disco delantero equipado de serie, sumado a la suspensión monoshock trasera, brinda estabilidad y control','Aro delantero 21 Aro posterior 18','4 tiempos SOHC, enfriado por aire, monocilíndrico','124 cc','10 HP a 7,500 rpm','9.90 N-m a 5500 rpm','Eléctrico y patada','5 velocidades, engrane constante, cadena','Carburador ','11 Litros','840 mm','118 kg','Horquilla telescópica','Basculante (Monocross)','Disco','Tambor','80/90-R21','110/80-R18',2599,0,2599,'','','','','','','','','',1,0,NULL,NULL),(3,'BX5800010C05','XTZ125',2024,'TODO TERRENO','ON-OFF 0-149','NEG','Cross Black','MOTOCICLETA XTZ125E XTZ125','MC','Supera tus límites','Su diseño, resistencia y maniobrabilidad convierten a la XTZ125 en una gran opción para usarla en todo tipo de caminos. Preparada para movilizarte ágilmente por la ciudad como para recorrer con mayor confort los terrenos difíciles, gracias a su suspensión trasera monocross. A la vez sus gráficos y colores le dan una apariencia más deportiva.','Competition Blue','Cross Black','Cross White','Diseño estilo motocross','Motor eficiente y de buen rendimiento','Freno de disco delantero equipado de serie, sumado a la suspensión monoshock trasera, brinda estabilidad y control','Aro delantero 21 Aro posterior 18','4 tiempos SOHC, enfriado por aire, monocilíndrico','124 cc','10 HP a 7,500 rpm','9.90 N-m a 5500 rpm','Eléctrico y patada','5 velocidades, engrane constante, cadena','Carburador ','11 Litros','840 mm','118 kg','Horquilla telescópica','Basculante (Monocross)','Disco','Tambor','80/90-R21','110/80-R18',2599,0,2599,'','','','','','','','','',1,0,NULL,NULL),(4,'B0L800010B01','XTZ150',2024,'TODO TERRENO','ON-OFF 150-200','BLA','Cross White','MOTOCICLETA XTZ150-2 XTZ150','MC','Todo terreno, todos los días','La XTZ150 brinda un gran desempeño y alto rendimiento, la toma de aire y el escape de los gases fueron optimizados para reducir las pérdidas de potencia especialmente en bajas y medias revoluciones, lo que le da una buena respuesta al tacto del acelerador y una excelente capacidad de ascenso y resistencia. La suspensión de la XTZ150 ofrece un confort inigualable al absorber mejor los impactos generados al transitar por superficies irregulares. Y por si fuera poco, la nueva XTZ150 cumple con la regulación Euro 3, ayudando a la reducción de emisiones, haciéndola más amigable con el medio ambiente.','Competition Blue','Cross Black','Cross White','Diseño y comodidad','Panel led multi-informativo indicador de velocidades','Potente y eficiente motor alimentado con inyección electrónica','Capacidad de tanque 12 L','4 tiempos SOHC, enfriado por aire monocilíndrico','149 cc','12.4 HP a 7,500 rpm','13.1N-m a 6000 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica','12 Litros','835 mm','131 kg','Horquilla telescópica','Basculante (Monocross) con bieletas','Disco','Tambor','90/90-R19','110/90-R17',3399,200,3199,'','','','','','','','','',1,0,NULL,NULL),(5,'B0L800010C06','XTZ150',2024,'TODO TERRENO','ON-OFF 150-200','AZU','Competition Blue','MOTOCICLETA XTZ150-2 XTZ150','MC','Todo terreno, todos los días','La XTZ150 brinda un gran desempeño y alto rendimiento, la toma de aire y el escape de los gases fueron optimizados para reducir las pérdidas de potencia especialmente en bajas y medias revoluciones, lo que le da una buena respuesta al tacto del acelerador y una excelente capacidad de ascenso y resistencia. La suspensión de la XTZ150 ofrece un confort inigualable al absorber mejor los impactos generados al transitar por superficies irregulares. Y por si fuera poco, la nueva XTZ150 cumple con la regulación Euro 3, ayudando a la reducción de emisiones, haciéndola más amigable con el medio ambiente.','Competition Blue','Cross Black','Cross White','Diseño y comodidad','Panel led multi-informativo indicador de velocidades','Potente y eficiente motor alimentado con inyección electrónica','Capacidad de tanque 12 L','4 tiempos SOHC, enfriado por aire monocilíndrico','149 cc','12.4 HP a 7,500 rpm','13.1N-m a 6000 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica','12 Litros','835 mm','131 kg','Horquilla telescópica','Basculante (Monocross) con bieletas','Disco','Tambor','90/90-R19','110/90-R17',3399,200,3199,'','','','','','','','','',1,0,NULL,NULL),(6,'B0L800010A05','XTZ150',2024,'TODO TERRENO','ON-OFF 150-200','NEG','Cross Black','MOTOCICLETA XTZ150-2 XTZ150','MC','Todo terreno, todos los días','La XTZ150 brinda un gran desempeño y alto rendimiento, la toma de aire y el escape de los gases fueron optimizados para reducir las pérdidas de potencia especialmente en bajas y medias revoluciones, lo que le da una buena respuesta al tacto del acelerador y una excelente capacidad de ascenso y resistencia. La suspensión de la XTZ150 ofrece un confort inigualable al absorber mejor los impactos generados al transitar por superficies irregulares. Y por si fuera poco, la nueva XTZ150 cumple con la regulación Euro 3, ayudando a la reducción de emisiones, haciéndola más amigable con el medio ambiente.','Competition Blue','Cross Black','Cross White','Diseño y comodidad','Panel led multi-informativo indicador de velocidades','Potente y eficiente motor alimentado con inyección electrónica','Capacidad de tanque 12 L','4 tiempos SOHC, enfriado por aire monocilíndrico','149 cc','12.4 HP a 7,500 rpm','13.1N-m a 6000 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica','12 Litros','835 mm','131 kg','Horquilla telescópica','Basculante (Monocross) con bieletas','Disco','Tambor','90/90-R19','110/90-R17',3399,200,3199,'','','','','','','','','',1,0,NULL,NULL),(7,'B8L400010A06','XTZ250 ABS',2024,'TODO TERRENO','ON-OFF MIDDLE 201-500','AZU','Competition Blue','MOTOCICLETA XTZ250 ABS','MC','Poder off road','XTZ250, la nueva todo terreno, ágil y cómoda, perfecta para todo tipo de terreno: sea en el asfalto, la tierra o los desafios del día a día de los caminos. Aspecto más robusto y agresivo. Estilo: ´Rider, comfort & fun´. Inspirada en un manejo dinámico que aporta agilidad y ligereza.','Red fire','Competition Blue','','Diseño de aspecto robusto y agresivo con estilo deportivo','Comodidad para la aventura','Freno abs delantero','Panel led multi-informativo','4 tiempos SOHC, refrigerado por aire','249 cc','20.4 HP a 8,000 rpm','20.5 Nm a 6500 rpm','Eléctrico','5 Velocidades, Engranaje constante ,Cadena','Inyección de Combustible','14 Litros','875 mm','152 kg','Horquilla  telescópica','Basculante con bieletas - Monocross','Disco  + ABS','Disco','80/90-R21','120/80-R18',6499,0,6499,'','','','','','','','','',1,0,NULL,NULL),(8,'B8L400010B07','XTZ250 ABS',2024,'TODO TERRENO','ON-OFF MIDDLE 201-500','ROJ','Red Fire','MOTOCICLETA XTZ250 ABS','MC','Poder off road','XTZ250, la nueva todo terreno, ágil y cómoda, perfecta para todo tipo de terreno: sea en el asfalto, la tierra o los desafios del día a día de los caminos. Aspecto más robusto y agresivo. Estilo: ´Rider, comfort & fun´. Inspirada en un manejo dinámico que aporta agilidad y ligereza.','Red fire','Competition Blue','','Diseño de aspecto robusto y agresivo con estilo deportivo','Comodidad para la aventura','Freno abs delantero','Panel led multi-informativo','4 tiempos SOHC, refrigerado por aire','249 cc','20.4 HP a 8,000 rpm','20.5 Nm a 6500 rpm','Eléctrico','5 Velocidades, Engranaje constante ,Cadena','Inyección de Combustible','14 Litros','875 mm','152 kg','Horquilla  telescópica','Basculante con bieletas - Monocross','Disco  + ABS','Disco','80/90-R21','120/80-R18',6499,0,6499,'','','','','','','','','',1,0,NULL,NULL),(9,'BCW500010A06','YZF-R15 ABS',2023,'STREET','STREET 150-200','AZU','Racing Blue','MOTOCICLETA YZF155-A YZF-R15 ABS','MC','Conecta tu ADN Racing','La nueva R15 ABS es la cuarta generación de la legendaria R15 que comparte el mismo ADN con la súper deportiva YZF-R1. La R15 ABS viene con un motor VVA de 155cc equipado con un sistema de control de tracción, único en su segmento. Además que cuenta con la aplicación Y-Connect que te permitirá disfrutar de una experiencia más completa, con toda la información de tu vehículo desde tu celular.','Racing Blue','Midnight Black','','Sistema y-connect','Sistema de control de tracción','Nuevo tablero lcd','Frenos ABS','4 tiempos, SOHC, refrigerado por líquido, 1 cilindro','155 cc','18.1 HP a 10,000 rpm','14.2 Nm a 7,500 RPM','Eléctrico','Mecánica, 6 velocidades, A&S Clutch','Inyección Electrónica, TCS, VVA','11 Litros','815 mm','140 kg','Horquilla telescópica invertida | Recorrido: 130mm','Basculante (suspensión de unión) | Trayectoria:97mm','Freno hidráulico de disco | 282 mm | ABS','Freno hidráulico monodisco | 220 mm | ABS','100/80-R17','140/70-R17',4699,300,4399,'','','','','','','','','',1,0,NULL,NULL),(10,'BCW500010B05','YZF-R15 ABS',2023,'STREET','STREET 150-200','NEG','Midnight Black','MOTOCICLETA YZF155-A YZF-R15 ABS','MC','Conecta tu ADN Racing','La nueva R15 ABS es la cuarta generación de la legendaria R15 que comparte el mismo ADN con la súper deportiva YZF-R1. La R15 ABS viene con un motor VVA de 155cc equipado con un sistema de control de tracción, único en su segmento. Además que cuenta con la aplicación Y-Connect que te permitirá disfrutar de una experiencia más completa, con toda la información de tu vehículo desde tu celular.','Racing Blue','Midnight Black','','Sistema y-connect','Sistema de control de tracción','Nuevo tablero lcd','Frenos ABS','4 tiempos, SOHC, refrigerado por líquido, 1 cilindro','155 cc','18.1 HP a 10,000 rpm','14.2 Nm a 7,500 RPM','Eléctrico','Mecánica, 6 velocidades, A&S Clutch','Inyección Electrónica, TCS, VVA','11 Litros','815 mm','140 kg','Horquilla telescópica invertida | Recorrido: 130mm','Basculante (suspensión de unión) | Trayectoria:97mm','Freno hidráulico de disco | 282 mm | ABS','Freno hidráulico monodisco | 220 mm | ABS','100/80-R17','140/70-R17',4699,300,4399,'','','','','','','','','',1,0,NULL,NULL),(11,'BCW600010A06','YZF-R15 ABS',2024,'STREET','STREET 150-200','AZU','Racing Blue','MOTOCICLETA YZF155-A YZF-R15 ABS','MC','Conecta tu ADN Racing','La nueva R15 ABS es la cuarta generación de la legendaria R15 que comparte el mismo ADN con la súper deportiva YZF-R1. La R15 ABS viene con un motor VVA de 155cc equipado con un sistema de control de tracción, único en su segmento. Además que cuenta con la aplicación Y-Connect que te permitirá disfrutar de una experiencia más completa, con toda la información de tu vehículo desde tu celular.','Racing Blue','Midnight Black','','Sistema y-connect','Sistema de control de tracción','Nuevo tablero lcd','Frenos ABS','4 tiempos, SOHC, refrigerado por líquido, 1 cilindro','155 cc','18.1 HP a 10,000 rpm','14.2 Nm a 7,500 RPM','Eléctrico','Mecánica, 6 velocidades, A&S Clutch','Inyección Electrónica, TCS, VVA','11 Litros','815 mm','140 kg','Horquilla telescópica invertida | Recorrido: 130mm','Basculante (suspensión de unión) | Trayectoria:97mm','Freno hidráulico de disco | 282 mm | ABS','Freno hidráulico monodisco | 220 mm | ABS','100/80-R17','140/70-R17',4999,0,4999,'','','','','','','','','',1,0,NULL,NULL),(12,'BCW600010B05','YZF-R15 ABS',2024,'STREET','STREET 150-200','NEG','Midnight Black','MOTOCICLETA YZF155-A YZF-R15 ABS','MC','Conecta tu ADN Racing','La nueva R15 ABS es la cuarta generación de la legendaria R15 que comparte el mismo ADN con la súper deportiva YZF-R1. La R15 ABS viene con un motor VVA de 155cc equipado con un sistema de control de tracción, único en su segmento. Además que cuenta con la aplicación Y-Connect que te permitirá disfrutar de una experiencia más completa, con toda la información de tu vehículo desde tu celular.','Racing Blue','Midnight Black','','Sistema y-connect','Sistema de control de tracción','Nuevo tablero lcd','Frenos ABS','4 tiempos, SOHC, refrigerado por líquido, 1 cilindro','155 cc','18.1 HP a 10,000 rpm','14.2 Nm a 7,500 RPM','Eléctrico','Mecánica, 6 velocidades, A&S Clutch','Inyección Electrónica, TCS, VVA','11 Litros','815 mm','140 kg','Horquilla telescópica invertida | Recorrido: 130mm','Basculante (suspensión de unión) | Trayectoria:97mm','Freno hidráulico de disco | 282 mm | ABS','Freno hidráulico monodisco | 220 mm | ABS','100/80-R17','140/70-R17',4999,0,4999,'','','','','','','','','',1,0,NULL,NULL),(13,'BVJE00010A06','YZF-R3',2024,'STREET','STREET MIDDLE 201-500','AZU','Racing Blue','MOTOCICLETA YZF320-A YZF-R3','MC','ADN de competencia','La nueva e increíble YZF-R3 te hará llevar el ADN Racing por todas partes. Esta imponente moto deportiva de 320cc full estética, tecnología y avanzado rendimiento te brinda las mejores respuestas en las situaciones más exigentes del día a día. Diseño inspirado en la YZR-M1 de Moto GP, 8 KM/H más rápido que el modelo anterior.','Racing Blue','Midnight Black','','Barras invertidas KYB de 37mm','Diseño aerodinámico y súper deportivo','Panel de instrumento multifunción','Frenos de disco delantero y trasero con ABS','4 T, 2 Cilindros  DOHC, 4  valvulas por cilindro, enfirado por liquido','320 cc ','41.4 HP a 10,750 rpm','29.6 Nm A 9,000 rpm','Eléctrico','6 Velocidades, Engranaje constante, cadena','Inyección de Combustible','14 Litros','780 mm','169 kg','Horquillas telescópicas invertidas de 43 mm de diámetro KYB','Monocross /Basculante KYB','Disco +ABS','Disco +ABS','110/70-R17','140/70-R17',7499,200,7299,'','','','','','','','','',1,0,NULL,NULL),(14,'BVJE00010B05','YZF-R3',2024,'STREET','STREET MIDDLE 201-500','NEG','Midnight Black','MOTOCICLETA YZF320-A YZF-R3','MC','ADN de competencia','La nueva e increíble YZF-R3 te hará llevar el ADN Racing por todas partes. Esta imponente moto deportiva de 320cc full estética, tecnología y avanzado rendimiento te brinda las mejores respuestas en las situaciones más exigentes del día a día. Diseño inspirado en la YZR-M1 de Moto GP, 8 KM/H más rápido que el modelo anterior.','Racing Blue','Midnight Black','','Barras invertidas KYB de 37mm','Diseño aerodinámico y súper deportivo','Panel de instrumento multifunción','Frenos de disco delantero y trasero con ABS','4 T, 2 Cilindros  DOHC, 4  valvulas por cilindro, enfirado por liquido','320 cc ','41.4 HP a 10,750 rpm','29.6 Nm A 9,000 rpm','Eléctrico','6 Velocidades, Engranaje constante, cadena','Inyección de Combustible','14 Litros','780 mm','169 kg','Horquillas telescópicas invertidas de 43 mm de diámetro KYB','Monocross /Basculante KYB','Disco +ABS','Disco +ABS','110/70-R17','140/70-R17',7499,200,7299,'','','','','','','','','',1,0,NULL,NULL),(15,'BVA100010A06','YZF-R7',2023,'BIG BIKES','BIG BIKES','AZU','Racing Blue','MOTOCICLETA YZF690 YZF-R7','MC','Donde el R World se encuentra con el tuyo','Una superdeportiva de nueva generación con el estilo legendario de Yamaha que combina un avanzado motor CP2 con un chasis ultradelgado y ligero para proporcionar un rendimiento de torque tanto en la pista como en la calle. La nueva YZF - R7 está destinada a aquellos que buscan un diseño puramente Supersport con un excitante rendimiento para su día a día.','Racing Blue','Midnight Black','','Chasis ultra ligero','Potente motor cp2 de 689 cc','Suspensión deportiva','Embrague antirrebote asistido','4T, 2 CILINDROS, DOHC, REFRIGERADA POR LÍQUIDO','689 cc','72.4 HP a 8,750 RPM','67NM A 6,500 RPM','Eléctrico','Mecánica, 6 velocidades','Inyección de Combustible','13 Litros','835 mm','188 kg','Horquilla telescópica invertida','Basculante (suspensión de unión)','Freno hidráulico de doble disco | 298 mm | ABS','Freno hidráulico monodisco | 245 mm | ABS','120/70-R17','180/55-R17',13999,500,13499,'','','','','','','','','',1,0,NULL,NULL),(16,'BMPF00010A06','YZF-R1',2024,'BIG BIKES','BIG BIKES','AZU','Racing Blue','MOTOCICLETA YZF1000 YZF-R1','MC','Rebasa cualquier límite','Una Súper Deportiva inspirada en la tecnología y cualidades de la YZR-M1, motocicleta que brilla en el MotoGP. Todo el poder de esta máquina es transferida a la destreza y habilidad que muestran los pilotos que la prueban. ','Racing Blue','Midnight Black','','Motor de 998 cc de alta eficiencia EU5','Pantallas de instrumentos tft con ebm y bc','Carrocería aerodinámica estilo m1','Horquilla delantera KYB de 43 mm','4 tiempos, Refrigerado por líquido, 4 cilindros, DOHC, 4 válvulas','998 cc','197.2 HP a 13,500 RPM','113.3 NM A 11,500 RPM','Eléctrico','Mecánica, 6 velocidades','Inyección de Combustible','17 Litros','855 mm','201 kg','Horquila telescópica invertida de 120 mm','Suspensión tipo eslabón, brazo oscilante','Doble disco hidráulico | 320 mm | ABS','Un disco de freno hidráulico | 220 mm | ABS','120/70 ZR17M/C','190/55 ZR17M/C',25490,0,25490,'','','','','','','','','',1,0,NULL,NULL),(17,'BVWB00010B31','TÉNÉRÉ 700',2024,'BIG BIKES','BIG BIKES','GRI_OSC','Competition Blue','MOTOCICLETA XTZ690 TENERE 700','MC','NEXT HORIZON','Equipado con un motor CP2 de 689cc de doble árbol de levas y un chasis completamente nuevo, la Ténéré 700 está diseñada para ofrecer el mejor manejo y agilidad en el off road, combinados con un rendimiento de larga distancia en la carretera, lo que la hace extremadamente capaz en cualquier territorio.','Cross Black','Competition Blue','','Tres modos de ABS configurable mendiante el panel','Pantalla TFT de 5 pulgadas con conectividad para smartphones','Frontal agresivo de tipo rally con cuatro faros led','Motor CP2 de cuatro tiempos de 689 cc con gran torque y homologación EU5','4T, 2 CILINDROS, DOHC, REFRIGERADA POR LÍQUIDO','689 cc','72.4 HP a 9,000 RPM','68NM A 6,500 RPM','Eléctrico','Mecánica, 6 velocidades','Inyección de Combustible','16 Litros','875 mm','204 kg','Horquilla telescópica invertida','Basculante (suspensión de unión)','Freno hidráulico de doble disco + ABS | 282 mm','Freno hidráulico monodisco + ABS | 245 mm','90/90-R21','150/70-R18',15999,0,15999,'','','','','','','','','',1,0,NULL,NULL),(18,'BVWB00010A06','TÉNÉRÉ 700',2024,'BIG BIKES','BIG BIKES','AZU','Competition Blue','MOTOCICLETA XTZ690 TENERE 700','MC','NEXT HORIZON','Equipado con un motor CP2 de 689cc de doble árbol de levas y un chasis completamente nuevo, la Ténéré 700 está diseñada para ofrecer el mejor manejo y agilidad en el off road, combinados con un rendimiento de larga distancia en la carretera, lo que la hace extremadamente capaz en cualquier territorio.','Cross Black','Competition Blue','','Tres modos de ABS configurable mendiante el panel','Pantalla TFT de 5 pulgadas con conectividad para smartphones','Frontal agresivo de tipo rally con cuatro faros led','Motor CP2 de cuatro tiempos de 689 cc con gran torque y homologación EU5','4T, 2 CILINDROS, DOHC, REFRIGERADA POR LÍQUIDO','689 cc','72.4 HP a 9,000 RPM','68NM A 6,500 RPM','Eléctrico','Mecánica, 6 velocidades','Inyección de Combustible','16 Litros','875 mm','204 kg','Horquilla telescópica invertida','Basculante (suspensión de unión)','Freno hidráulico de doble disco + ABS | 282 mm','Freno hidráulico monodisco + ABS | 245 mm','90/90-R21','150/70-R18',15999,0,15999,'','','','','','','','','',1,0,NULL,NULL),(19,'BAP200010B07','TRACER 9 GT',2021,'BIG BIKES','BIG BIKES','ROJ','Red Line','MOTOCICLETA MTT890D TRACER 9 GT','MC','ROADS OF LIFE','Disfruta la sensación de libertad que te brinda su motor de 889 cc, 3 cilindros, refrigeración líquida, DOHC. Equipado con un nuevo sistema de cambio rápido (QSS). Además de una suspensión controlada electrónicamente KYB que ofrecerá una conducción más suave y segura, la nueva Tracer 9 GT está diseñada para proporcionarte los niveles más altos de comodidad en tus viajes.','Red Line','Tech Kamo','','Motor CP3 de 890 cc','Suspensión electrónica kyb','Tablero de doble pantalla 3.5”','Asiento principal con ajuste de dos niveles','4 TIEMPOS, DOHC, REFRIGERADA POR LÍQUIDO, 3 CILINDROS','890 cc','119 HP a 10,000 RPM','93NM A 7,000 RPM','Eléctrico','Mecánica, 6 velocidades','Inyección de Combustible','19 Litros','810 mm | 825 mm','220 kg','Horquilla telescópica invertida','Basculante (suspensión de unión)','Freno hidráulico de doble disco | 298 mm | ABS','Freno hidráulico monodisco | 245 mm | abs','120/70-R17','180/55-R17',17999,0,17999,'','','','','','','','','',1,0,NULL,NULL),(20,'BAP200010C41','TRACER 9 GT',2021,'BIG BIKES','BIG BIKES','GRI_OSC','Tech Kamo','MOTOCICLETA MTT890D TRACER 9 GT','MC','ROADS OF LIFE','Disfruta la sensación de libertad que te brinda su motor de 889 cc, 3 cilindros, refrigeración líquida, DOHC. Equipado con un nuevo sistema de cambio rápido (QSS). Además de una suspensión controlada electrónicamente KYB que ofrecerá una conducción más suave y segura, la nueva Tracer 9 GT está diseñada para proporcionarte los niveles más altos de comodidad en tus viajes.','Red Line','Tech Kamo','','Motor CP3 de 890 cc','Suspensión electrónica kyb','Tablero de doble pantalla 3.5”','Asiento principal con ajuste de dos niveles','4 TIEMPOS, DOHC, REFRIGERADA POR LÍQUIDO, 3 CILINDROS','890 cc','119 HP a 10,000 RPM','93NM A 7,000 RPM','Eléctrico','Mecánica, 6 velocidades','Inyección de Combustible','19 Litros','810 mm | 825 mm','220 kg','Horquilla telescópica invertida','Basculante (suspensión de unión)','Freno hidráulico de doble disco | 298 mm | ABS','Freno hidráulico monodisco | 245 mm | abs','120/70-R17','180/55-R17',17999,0,17999,'','','','','','','','','',1,0,NULL,NULL),(21,'BKY500010A07','Cygnus Ray ZR',2024,'SCOOTER','SCOOTER','ROJ','Matt Light Red','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',2229,150,2079,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010A07.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,NULL,NULL),(22,'BKY500010B05','Cygnus Ray ZR',2024,'SCOOTER','SCOOTER','NEG','Midnight Black','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',2229,150,2079,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010B05.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,NULL,NULL),(23,'BKY500010F16','Cygnus Ray ZR',2024,'SCOOTER','SCOOTER','AZU_MAT','Matt Light Blue','MOTOCICLETA LCG125 CYGNUS RAYZR','MC','ATRÉVETE A SER DISTINTO','Con un diseño deportivo, urbano y dinámico la nueva CYGNUS RayZR expresa actitud por donde la veas. Disfruta la sensación de libertad que te brinda su motor de 4 tiempos, SOHC de 2 válvulas de 125 cc “BLUE CORE”, con transmisión continua variable y un peso ultra ligero de apenas 99 kilogramos, además ahorra como nunca lo imaginaste gracias al sistema Start&Stop que tiene incorporado. Además cuentas con una excelente capacidad de carga de 21 litros debajo del asiento.','Matt Light Blue','Matt Light Red','Midnight Black','Motor 125 cc con sistema blue core','Sistema start & stop','Sistema de frenado UBS','Tablero digital','Refrigerado por aire, 4 tiempos SOHC, 2 válvulas','125 cc','8 HP a 6,500 rpm','9.7 N-m a 5000 rpm','Eléctrico y patada','Automático CVT','Inyección electrónica, BlueCore','5.2 Litros','760 mm','113 kg','Horquillas telescópicas','Mono amortiguador trasero','Disco','Tambor','90/90-R12','110/90-R10',2229,150,2079,'CYGNUS_RAY_ZR/Logo/logocygnus_ray_zr.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/moto/BKY500010F16.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo1.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo2.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/estilo/estilo3.png','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio1.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio2.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio3.jpg','CYGNUS_RAY_ZR/cygnus_ray_zr_2024/beneficios/beneficio4.jpg',1,0,NULL,NULL),(24,'BGRK00010B07','CRYPTON',2024,'UNDERBONE','UB','ROJ','Magma Red','MOTOCICLETA T110C T110 CRYPTON','MC','Va contigo a donde quieras','Esta pequeña moto de grandes atributos está diseñada para ir contigo a donde vayas. Sumamente versátil y con estilo moderno, desde el cuadro de instrumentos hasta el carenado. Con frenos de disco y aros de aluminio, la crypton da la hora. Además su faro extra luminoso con cubierta de cristal cincelado permite una mayor visibilidad, haciendo de esta moto la mejor opción en su categoría.','Magma Red','Dark Silver','','Motor 110 cc','Freno hidraulico disco frontal','Suspensión telescópica frontal y basculante doble trasera','Panel analógico','4 tiempos SOHC, enfriado por aire, monocilíndrico','110 cc','6.8 HP a 8000 rpm','7.95 N-m','CDI','Eléctrico y pedal','Carburador','4.2 Litros','770 mm','103 kg','Horquillas telescópicas','Doble amortiguador basculante trasero','Disco','Tambor','70/90 R17','80/90 R17',1699,0,1699,'','','','','','','','','',1,0,NULL,NULL),(25,'BGRK00010D39','CRYPTON',2024,'UNDERBONE','UB','GRI_NEG','Dark Silver','MOTOCICLETA T110C T110 CRYPTON','MC','Va contigo a donde quieras','Esta pequeña moto de grandes atributos está diseñada para ir contigo a donde vayas. Sumamente versátil y con estilo moderno, desde el cuadro de instrumentos hasta el carenado. Con frenos de disco y aros de aluminio, la crypton da la hora. Además su faro extra luminoso con cubierta de cristal cincelado permite una mayor visibilidad, haciendo de esta moto la mejor opción en su categoría.','Magma Red','Dark Silver','','Motor 110 cc','Freno hidraulico disco frontal','Suspensión telescópica frontal y basculante doble trasera','Panel analógico','4 tiempos SOHC, enfriado por aire, monocilíndrico','110 cc','6.8 HP a 8000 rpm','7.95 N-m','CDI','Eléctrico y pedal','Carburador','4.2 Litros','770 mm','103 kg','Horquillas telescópicas','Doble amortiguador basculante trasero','Disco','Tambor','70/90 R17','80/90 R17',1699,0,1699,'','','','','','','','','',1,0,NULL,NULL),(26,'B6YH00010E31','NMAX CONNECTED',2024,'SCOOTER','SCOOTER','GRI','Pastel Dark Gray','MOTOCICLETA GPD155-A NMAX CONNECTED','MC','N MOTIVOS PARA TENERLA','Con un diseño sofisticado, elegante y urbano la nueva NMAX Connected promete atraparte con todos los atributos que posee. Su sistema Y-Connect te permitirá estar en contacto directo con tu vehículo en todo momento gracias a la conexión que tiene con el celular del usuario. Su diseño prestigioso, toma de energía de 12V original integrado, key Smart, iluminación total LED, frenos ABS y su amplio maletero de 23 litros hacen que tenga “N” motivos para escogerla.','Matt grey','Matt blue','Pastel Dark Gray','Sistema Y-CONNECT','Sistema start & stop','Frenos ABS','Smart key','Refrigerado por líquido, 4 tiempos, 4 válvulas, SOHC, VVA','155 cc','15.15 HP a 8,000 rpm','13.9 N-m a 6500 rpm','Eléctrico','Automático CVT','Inyección electrónica, BlueCore','7.1 Litros','765 mm','127 kg','Horquillas telescópicas','Doble amortiguador lateral','Disco + ABS','Disco + ABS','110/70-R13','130/70-R13',4399,200,4199,'','','','','','','','','',1,0,NULL,NULL),(27,'B6YM00010E31','NMAX CONNECTED',2024,'SCOOTER','SCOOTER','GRI','Pastel Dark Gray','MOTOCICLETA GPD155-A NMAX CONNECTED','MC','N MOTIVOS PARA TENERLA','Con un diseño sofisticado, elegante y urbano la nueva NMAX Connected promete atraparte con todos los atributos que posee. Su sistema Y-Connect te permitirá estar en contacto directo con tu vehículo en todo momento gracias a la conexión que tiene con el celular del usuario. Su diseño prestigioso, toma de energía de 12V original integrado, key Smart, iluminación total LED, frenos ABS y su amplio maletero de 23 litros hacen que tenga “N” motivos para escogerla.','Matt grey','Matt blue','Pastel Dark Gray','Sistema Y-CONNECT','Sistema start & stop','Frenos ABS','Smart key','Refrigerado por líquido, 4 tiempos, 4 válvulas, SOHC, VVA','155 cc','15.15 HP a 8,000 rpm','13.9 N-m a 6500 rpm','Eléctrico','Automático CVT','Inyección electrónica, BlueCore','7.1 Litros','765 mm','127 kg','Horquillas telescópicas','Doble amortiguador lateral','Disco + ABS','Disco + ABS','110/70-R13','130/70-R13',4399,200,4199,'','','','','','','','','',1,0,NULL,NULL),(28,'BH8800010A05','YBR-Z',2023,'STREET','STREET 0-149','NEG','Midnight Black','MOTOCICLETA YB125ZR YBR-Z','MC','Ahorro y eficiencia en dos ruedas','Este modelo ofrece la calidad y confiabilidad de la familia YBR con líneas de diseño deportivas. Un modelo que por sus prestaciones es ideal para el uso diario, gracias a su confort de marcha y a su bajo consumo. Cuenta con freno de disco delantero, arranque eléctrico, tablero con indicador de marchas y asiento de doble nivel para mayor comodidad','Metal Skyblue','Red Scarlet','Midnight Black','Motor 125 cc','Tablero con indicador de velocidades','Tanque de 13L','Freno de disco','4 tiempos , SOHC, refrigerado por aire, monocilíndrico','124 cc','9.9 HP a 7,800 rpm','9.5 Nm a 6500 rpm','Eléctrico','Transmisión Mecánica 5 Velocidades','Carburador','13 Litros','780 mm','121 kg','Horquillas telescópicas','Amortiguadores laterales regulables','Disco','Tambor','80/80-R18','90/90-R18',1649,300,1349,'','','','','','','','','',1,0,NULL,NULL),(29,'BH8800010C06','YBR-Z',2023,'STREET','STREET 0-149','AZU','Metal Skyblue','MOTOCICLETA YB125ZR YBR-Z','MC','Ahorro y eficiencia en dos ruedas','Este modelo ofrece la calidad y confiabilidad de la familia YBR con líneas de diseño deportivas. Un modelo que por sus prestaciones es ideal para el uso diario, gracias a su confort de marcha y a su bajo consumo. Cuenta con freno de disco delantero, arranque eléctrico, tablero con indicador de marchas y asiento de doble nivel para mayor comodidad','Metal Skyblue','Red Scarlet','Midnight Black','Motor 125 cc','Tablero con indicador de velocidades','Tanque de 13L','Freno de disco','4 tiempos , SOHC, refrigerado por aire, monocilíndrico','124 cc','9.9 HP a 7,800 rpm','9.5 Nm a 6500 rpm','Eléctrico','Transmisión Mecánica 5 Velocidades','Carburador','13 Litros','780 mm','121 kg','Horquillas telescópicas','Amortiguadores laterales regulables','Disco','Tambor','80/80-R18','90/90-R18',1649,300,1349,'','','','','','','','','',1,0,NULL,NULL),(30,'BH8800010E07','YBR-Z',2023,'STREET','STREET 0-149','ROJ','Red Scarlet','MOTOCICLETA YB125ZR YBR-Z','MC','Ahorro y eficiencia en dos ruedas','Este modelo ofrece la calidad y confiabilidad de la familia YBR con líneas de diseño deportivas. Un modelo que por sus prestaciones es ideal para el uso diario, gracias a su confort de marcha y a su bajo consumo. Cuenta con freno de disco delantero, arranque eléctrico, tablero con indicador de marchas y asiento de doble nivel para mayor comodidad','Metal Skyblue','Red Scarlet','Midnight Black','Motor 125 cc','Tablero con indicador de velocidades','Tanque de 13L','Freno de disco','4 tiempos , SOHC, refrigerado por aire, monocilíndrico','124 cc','9.9 HP a 7,800 rpm','9.5 Nm a 6500 rpm','Eléctrico','Transmisión Mecánica 5 Velocidades','Carburador','13 Litros','780 mm','121 kg','Horquillas telescópicas','Amortiguadores laterales regulables','Disco','Tambor','80/80-R18','90/90-R18',1649,300,1349,'','','','','','','','','',1,0,NULL,NULL),(31,'BH8900010C06','YBR-Z',2024,'STREET','STREET 0-149','AZU','Metal Skyblue','MOTOCICLETA YB125ZR YBR-Z','MC','Ahorro y eficiencia en dos ruedas','Este modelo ofrece la calidad y confiabilidad de la familia YBR con líneas de diseño deportivas. Un modelo que por sus prestaciones es ideal para el uso diario, gracias a su confort de marcha y a su bajo consumo. Cuenta con freno de disco delantero, arranque eléctrico, tablero con indicador de marchas y asiento de doble nivel para mayor comodidad','Metal Skyblue','Red Scarlet','Midnight Black','Motor 125 cc','Tablero con indicador de velocidades','Tanque de 13L','Freno de disco','4 tiempos , SOHC, refrigerado por aire, monocilíndrico','124 cc','9.9 HP a 7,800 rpm','9.5 Nm a 6500 rpm','Eléctrico','Transmisión Mecánica 5 Velocidades','Carburador','13 Litros','780 mm','121 kg','Horquillas telescópicas','Amortiguadores laterales regulables','Disco','Tambor','80/80-R18','90/90-R18',1799,150,1649,'','','','','','','','','',1,0,NULL,NULL),(32,'BH8900010E07','YBR-Z',2024,'STREET','STREET 0-149','ROJ','Red Scarlet','MOTOCICLETA YB125ZR YBR-Z','MC','Ahorro y eficiencia en dos ruedas','Este modelo ofrece la calidad y confiabilidad de la familia YBR con líneas de diseño deportivas. Un modelo que por sus prestaciones es ideal para el uso diario, gracias a su confort de marcha y a su bajo consumo. Cuenta con freno de disco delantero, arranque eléctrico, tablero con indicador de marchas y asiento de doble nivel para mayor comodidad','Metal Skyblue','Red Scarlet','Midnight Black','Motor 125 cc','Tablero con indicador de velocidades','Tanque de 13L','Freno de disco','4 tiempos , SOHC, refrigerado por aire, monocilíndrico','124 cc','9.9 HP a 7,800 rpm','9.5 Nm a 6500 rpm','Eléctrico','Transmisión Mecánica 5 Velocidades','Carburador','13 Litros','780 mm','121 kg','Horquillas telescópicas','Amortiguadores laterales regulables','Disco','Tambor','80/80-R18','90/90-R18',1799,150,1649,'','','','','','','','','',1,0,NULL,NULL),(33,'BH8900010A05','YBR-Z',2024,'STREET','STREET 0-149','NEG','Midnight Black','MOTOCICLETA YB125ZR YBR-Z','MC','Ahorro y eficiencia en dos ruedas','Este modelo ofrece la calidad y confiabilidad de la familia YBR con líneas de diseño deportivas. Un modelo que por sus prestaciones es ideal para el uso diario, gracias a su confort de marcha y a su bajo consumo. Cuenta con freno de disco delantero, arranque eléctrico, tablero con indicador de marchas y asiento de doble nivel para mayor comodidad','Metal Skyblue','Red Scarlet','Midnight Black','Motor 125 cc','Tablero con indicador de velocidades','Tanque de 13L','Freno de disco','4 tiempos , SOHC, refrigerado por aire, monocilíndrico','124 cc','9.9 HP a 7,800 rpm','9.5 Nm a 6500 rpm','Eléctrico','Transmisión Mecánica 5 Velocidades','Carburador','13 Litros','780 mm','121 kg','Horquillas telescópicas','Amortiguadores laterales regulables','Disco','Tambor','80/80-R18','90/90-R18',1799,150,1649,'','','','','','','','','',1,0,NULL,NULL),(34,'BGB400010C05','FZS 3.0',2023,'STREET','STREET 150-200','NEG','Midnight Black','MOTOCICLETA FZN150 FZS 3.0','MC','LA VERDADERA STREET FIGHTER','Yamaha presenta la nueva FZS 3.0: nueva versión, nuevos colores, nuevos detalles de diseño pero la misma calidad y solidez de su versión Deluxe, la FZS 3.0 ABS. Su imponente tanque cuenta ahora con detalles color mate, dándole un look más refinado. Además cuenta con un eficiente motor 149 cc con sistema Blue Core, inyección electrónica, pantalla LCD, frenos de disco y más. Definitivamente, la nueva FZS 3.0 es una moto de entrada más que perfecta.','Midnight Black','Racing Blue','','Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.3 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2799,100,2699,'','','','','','','','','',1,0,NULL,NULL),(35,'BGB400010D06','FZS 3.0',2023,'STREET','STREET 150-200','AZU','Racing Blue','MOTOCICLETA FZN150 FZS 3.0','MC','LA VERDADERA STREET FIGHTER','Yamaha presenta la nueva FZS 3.0: nueva versión, nuevos colores, nuevos detalles de diseño pero la misma calidad y solidez de su versión Deluxe, la FZS 3.0 ABS. Su imponente tanque cuenta ahora con detalles color mate, dándole un look más refinado. Además cuenta con un eficiente motor 149 cc con sistema Blue Core, inyección electrónica, pantalla LCD, frenos de disco y más. Definitivamente, la nueva FZS 3.0 es una moto de entrada más que perfecta.','Midnight Black','Racing Blue','','Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.3 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2799,100,2699,'','','','','','','','','',1,0,NULL,NULL),(36,'BGB500010B16','FZS 3.0 ABS',2023,'STREET','STREET 150-200','AZU_MAT','Matt Dark Blue','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC','ABSOLUTA EVOLUCIÓN','La nueva FZS 3.0 ABS llega con una nueva propuesta de diseño más musculosa e imponente, nuestro “Street Figther” ha evolucionado y lo denota con su diseño de nueva generación. Sus acabados cromados y brillantes resaltan una imagen exclusiva y de primera calidad que exaltan la presencia de la motocicleta en las calles.','Pastel Dark Gray','Matt Dark Blue','Metallic Black','Freno frontal ABS Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.6 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2899,200,2699,'','','','','','','','','',1,0,NULL,NULL),(37,'BGB600010A05','FZS 3.0 ABS',2023,'STREET','STREET 150-200','NEG','Metallic Black','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC','ABSOLUTA EVOLUCIÓN','La nueva FZS 3.0 ABS llega con una nueva propuesta de diseño más musculosa e imponente, nuestro “Street Figther” ha evolucionado y lo denota con su diseño de nueva generación. Sus acabados cromados y brillantes resaltan una imagen exclusiva y de primera calidad que exaltan la presencia de la motocicleta en las calles.','Pastel Dark Gray','Matt Dark Blue','Metallic Black','Freno frontal ABS Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.6 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2899,200,2699,'','','','','','','','','',1,0,NULL,NULL),(38,'BGB600010C08','FZS 3.0 ABS',2023,'STREET','STREET 150-200','GRI','Pastel Dark Gray','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC','ABSOLUTA EVOLUCIÓN','La nueva FZS 3.0 ABS llega con una nueva propuesta de diseño más musculosa e imponente, nuestro “Street Figther” ha evolucionado y lo denota con su diseño de nueva generación. Sus acabados cromados y brillantes resaltan una imagen exclusiva y de primera calidad que exaltan la presencia de la motocicleta en las calles.','Pastel Dark Gray','Matt Dark Blue','Metallic Black','Freno frontal ABS Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.6 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2899,200,2699,'','','','','','','','','',1,0,NULL,NULL),(39,'BGB900010A07','FZS 3.0 ABS',2024,'STREET','STREET 150-200','ROJ','Matt Light Red','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC','ABSOLUTA EVOLUCIÓN','La nueva FZS 3.0 ABS llega con una nueva propuesta de diseño más musculosa e imponente, nuestro “Street Figther” ha evolucionado y lo denota con su diseño de nueva generación. Sus acabados cromados y brillantes resaltan una imagen exclusiva y de primera calidad que exaltan la presencia de la motocicleta en las calles.','Matt Light Red','Matt Dark Blue','Pastel Dark Gray','Freno frontal ABS Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.6 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2899,200,2699,'','','','','','','','','',1,0,NULL,NULL),(40,'BGB900010B16','FZS 3.0 ABS',2024,'STREET','STREET 150-200','AZU_MAT','Matt Dark Blue','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC','ABSOLUTA EVOLUCIÓN','La nueva FZS 3.0 ABS llega con una nueva propuesta de diseño más musculosa e imponente, nuestro “Street Figther” ha evolucionado y lo denota con su diseño de nueva generación. Sus acabados cromados y brillantes resaltan una imagen exclusiva y de primera calidad que exaltan la presencia de la motocicleta en las calles.','Matt Light Red','Matt Dark Blue','Pastel Dark Gray','Freno frontal ABS Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.6 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2899,200,2699,'','','','','','','','','',1,0,NULL,NULL),(41,'BGBA00010C31','FZS 3.0 ABS',2024,'STREET','STREET 150-200','GRI','Pastel Dark Gray','MOTOCICLETA FZN150D-A FZS 3.0 ABS','MC','ABSOLUTA EVOLUCIÓN','La nueva FZS 3.0 ABS llega con una nueva propuesta de diseño más musculosa e imponente, nuestro “Street Figther” ha evolucionado y lo denota con su diseño de nueva generación. Sus acabados cromados y brillantes resaltan una imagen exclusiva y de primera calidad que exaltan la presencia de la motocicleta en las calles.','Matt Light Red','Matt Dark Blue','Pastel Dark Gray','Freno frontal ABS Freno de disco trasero','Diseño robusto y musculoso','Tablero LCD','Luz principal led','4 tiempos , SOHC, refrigerado por aire, 2 válvulas','149 cc','12.2 HP a 7,250 rpm','13.6 Nm a 5500 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','13 Litros','795 mm','132 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2899,200,2699,'','','','','','','','','',1,0,NULL,NULL),(42,'BSX100010A15','FZ-X CONNECTED',2023,'STREET','STREET 150-200','NEG_MAT','Matt Black','MOTOCICLETA YC150 FZ-X Connected','MC','BE DIFFERENT','La nueva Yamaha FZ-X Connected es una motocicleta street de estilo Neo-Retro, inspirada en las motocicletas scrambler clásicas. Este nuevo modelo trae novedades que representan el equilibrio perfecto entre estilo y funcionalidad; presente y pasado; tecnología y respeto por lo clásico. Cuenta con tecnología enfocada a mejorar la experiencia de conducción del usuario como su pantalla LCD y el moderno sistema Y Connect, la app de Yamaha que te conecta con tu moto.','Vintage Blue','Matt Black','','Diseño Neo Retro','Sistema Y Connect y Pantalla LCD','Faro redondo LED','Freno ABS','4 tiempos, SOHC, refrigerado por aire, 1 cilindro','149 cc','12.2 HP a 7,250 RPM','13.3 Nm a 5,500 RPM','Eléctrico','Mecánica, 5 velocidades','Inyección Electrónica | Bluecore Yamaha','10 Litros, 1.5L (reserva)','815 mm','139 kg','Horquilla telescópica convencional','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2849,500,2349,'','','','','','','','','',1,0,NULL,NULL),(43,'BSX200010A06','FZ-X CONNECTED',2023,'STREET','STREET 150-200','AZU','Vintage Blue','MOTOCICLETA YC150 FZ-X Connected','MC','BE DIFFERENT','La nueva Yamaha FZ-X Connected es una motocicleta street de estilo Neo-Retro, inspirada en las motocicletas scrambler clásicas. Este nuevo modelo trae novedades que representan el equilibrio perfecto entre estilo y funcionalidad; presente y pasado; tecnología y respeto por lo clásico. Cuenta con tecnología enfocada a mejorar la experiencia de conducción del usuario como su pantalla LCD y el moderno sistema Y Connect, la app de Yamaha que te conecta con tu moto.','Vintage Blue','Matt Black','','Diseño Neo Retro','Sistema Y Connect y Pantalla LCD','Faro redondo LED','Freno ABS','4 tiempos, SOHC, refrigerado por aire, 1 cilindro','149 cc','12.2 HP a 7,250 RPM','13.3 Nm a 5,500 RPM','Eléctrico','Mecánica, 5 velocidades','Inyección Electrónica | Bluecore Yamaha','10 Litros, 1.5L (reserva)','815 mm','139 kg','Horquilla telescópica convencional','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',2849,500,2349,'','','','','','','','','',1,0,NULL,NULL),(44,'BSX300010A15','FZ-X CONNECTED',2024,'STREET','STREET 150-200','NEG_MAT','Matt Black','MOTOCICLETA YC150 FZ-X CONNECTED','MC','BE DIFFERENT','La nueva Yamaha FZ-X Connected es una motocicleta street de estilo Neo-Retro, inspirada en las motocicletas scrambler clásicas. Este nuevo modelo trae novedades que representan el equilibrio perfecto entre estilo y funcionalidad; presente y pasado; tecnología y respeto por lo clásico. Cuenta con tecnología enfocada a mejorar la experiencia de conducción del usuario como su pantalla LCD y el moderno sistema Y Connect, la app de Yamaha que te conecta con tu moto.','Matt Blue','Matt Black','','Diseño Neo Retro','Sistema Y Connect y Pantalla LCD','Faro redondo LED','Freno ABS','4 tiempos, SOHC, refrigerado por aire, 1 cilindro','149 cc','12.2 HP a 7,250 RPM','13.3 Nm a 5,500 RPM','Eléctrico','Mecánica, 5 velocidades','Inyección Electrónica | Bluecore Yamaha','10 Litros, 1.5L (reserva)','815 mm','139 kg','Horquilla telescópica convencional','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',3249,200,3049,'','','','','','','','','',1,0,NULL,NULL),(45,'BSX300010C16','FZ-X CONNECTED',2024,'STREET','STREET 150-200','AZU_MAT','Matt Blue','MOTOCICLETA YC150 FZ-X CONNECTED','MC','BE DIFFERENT','La nueva Yamaha FZ-X Connected es una motocicleta street de estilo Neo-Retro, inspirada en las motocicletas scrambler clásicas. Este nuevo modelo trae novedades que representan el equilibrio perfecto entre estilo y funcionalidad; presente y pasado; tecnología y respeto por lo clásico. Cuenta con tecnología enfocada a mejorar la experiencia de conducción del usuario como su pantalla LCD y el moderno sistema Y Connect, la app de Yamaha que te conecta con tu moto.','Matt Blue','Matt Black','','Diseño Neo Retro','Sistema Y Connect y Pantalla LCD','Faro redondo LED','Freno ABS','4 tiempos, SOHC, refrigerado por aire, 1 cilindro','149 cc','12.2 HP a 7,250 RPM','13.3 Nm a 5,500 RPM','Eléctrico','Mecánica, 5 velocidades','Inyección Electrónica | Bluecore Yamaha','10 Litros, 1.5L (reserva)','815 mm','139 kg','Horquilla telescópica convencional','Amortiguador central monoshock','Disco + ABS','Disco','100/80-R17','140/60-R17',3249,200,3049,'','','','','','','','','',1,0,NULL,NULL),(46,'B8H800010B15','FZ25 ABS',2024,'STREET','STREER MIDDLE 201-500','NEG_MAT','Matt-Black','MOTOCICLETA FZN250-A FZ25 ABS','MC','PODER EN LAS CALLES','La más potente de la serie FZ. La nueva FZ25 combina diseño y un óptimo rendimiento. Tiene un motor de 4 tiempos - Monocilindrico - Distribución de válvulas SOHC, Enfriado por aire y aceite. Además, está diseñada bajo el concepto Blue Core, que proporciona gran rendimiento y eficiencia de consumo de combustible. Posee freno a disco en ambas ruedas. Su chasis tipo diamante junto con la suspensión y su escape hacen que sea un modelo maniobrable, equilibrado y ágil.','Matt Black','Midnight Matt Blue','Midnight Black','Motor 249 cc con sistema blue core','Inyección electrónica','Panel digital','Mayor seguridad en el frenado','4 tiempos, Monocilindrico, SOHC, Enfriado por aire y aceite','249 cc','20.65 HP a 8,000 rpm','20 N-m A 6,000 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','14 Litros','795 mm','146 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco + ABS','100/80-R17','140/70-R17',4199,0,4199,'','','','','','','','','',1,0,NULL,NULL),(47,'B8H800010C16','FZ25 ABS',2024,'STREET','STREER MIDDLE 201-500','AZU_MAT','Midnight Matt Blue','MOTOCICLETA FZN250-A FZ25 ABS','MC','PODER EN LAS CALLES','La más potente de la serie FZ. La nueva FZ25 combina diseño y un óptimo rendimiento. Tiene un motor de 4 tiempos - Monocilindrico - Distribución de válvulas SOHC, Enfriado por aire y aceite. Además, está diseñada bajo el concepto Blue Core, que proporciona gran rendimiento y eficiencia de consumo de combustible. Posee freno a disco en ambas ruedas. Su chasis tipo diamante junto con la suspensión y su escape hacen que sea un modelo maniobrable, equilibrado y ágil.','Matt Black','Midnight Matt Blue','Midnight Black','Motor 249 cc con sistema blue core','Inyección electrónica','Panel digital','Mayor seguridad en el frenado','4 tiempos, Monocilindrico, SOHC, Enfriado por aire y aceite','249 cc','20.65 HP a 8,000 rpm','20 N-m A 6,000 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','14 Litros','795 mm','146 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco + ABS','100/80-R17','140/70-R17',4199,0,4199,'','','','','','','','','',1,0,NULL,NULL),(48,'B8H800010A05','FZ25 ABS',2024,'STREET','STREER MIDDLE 201-500','NEG_TUR','Midnight Black','MOTOCICLETA FZN250-A FZ25 ABS','MC','PODER EN LAS CALLES','La más potente de la serie FZ. La nueva FZ25 combina diseño y un óptimo rendimiento. Tiene un motor de 4 tiempos - Monocilindrico - Distribución de válvulas SOHC, Enfriado por aire y aceite. Además, está diseñada bajo el concepto Blue Core, que proporciona gran rendimiento y eficiencia de consumo de combustible. Posee freno a disco en ambas ruedas. Su chasis tipo diamante junto con la suspensión y su escape hacen que sea un modelo maniobrable, equilibrado y ágil.','Matt Black','Midnight Matt Blue','Midnight Black','Motor 249 cc con sistema blue core','Inyección electrónica','Panel digital','Mayor seguridad en el frenado','4 tiempos, Monocilindrico, SOHC, Enfriado por aire y aceite','249 cc','20.65 HP a 8,000 rpm','20 N-m A 6,000 rpm','Eléctrico','5 velocidades, engrane constante, cadena','Inyección electrónica - Blue Core','14 Litros','795 mm','146 kg','Horquillas telescópicas','Amortiguador central monoshock','Disco + ABS','Disco + ABS','100/80-R17','140/70-R17',4199,0,4199,'','','','','','','','','',1,0,NULL,NULL),(49,'2XPA00010B05','YB125 CHACARERA',2024,'STREET','STREET 0-149','NEG','Midnight Black','MOTOCICLETA YB125','MC','El aliado para tu progreso','Por sus características, diseño clásico y su kit chacarero esta moto es ideal para trabajar en todo tipo de ruta, pero también para desplazarse con total comodidad. Sus cinco velocidades y la mejor relación peso-potencia hacen que este modelo demuestre agilidad y gran desempeño. Además cuenta con una parrilla delantera, permitiendo explotar su capacidad en todo momento del trabajo.','Red Ruby','Midnight Black','','Motor 124 cc','Freno tambor delantero y posterior','Doble amortiguador trasero','Kit chacarero opcional','4 tiempos SOHC, enfriado por aire, monocilíndrico','124 cc','10.06 HP a 7,800 rpm','9.90 N-m','Eléctrico y patada','5 velocidades, engrane constante, cadena','Carburador','10 Litros','770 mm','118 kg','Horquillas telescópicas','Doble amortiguador lateral','Tambor','Tambor','80/80-R18','90/90-R18',1849,0,1849,'','','','','','','','','',1,0,NULL,NULL),(50,'2XPA00010E07','YB125 CHACARERA',2024,'STREET','STREET 0-149','ROJ','Red Ruby','MOTOCICLETA YB125','MC','El aliado para tu progreso','Por sus características, diseño clásico y su kit chacarero esta moto es ideal para trabajar en todo tipo de ruta, pero también para desplazarse con total comodidad. Sus cinco velocidades y la mejor relación peso-potencia hacen que este modelo demuestre agilidad y gran desempeño. Además cuenta con una parrilla delantera, permitiendo explotar su capacidad en todo momento del trabajo.','Red Ruby','Midnight Black','','Motor 124 cc','Freno tambor delantero y posterior','Doble amortiguador trasero','Kit chacarero opcional','4 tiempos SOHC, enfriado por aire, monocilíndrico','124 cc','10.06 HP a 7,800 rpm','9.90 N-m','Eléctrico y patada','5 velocidades, engrane constante, cadena','Carburador','10 Litros','770 mm','118 kg','Horquillas telescópicas','Doble amortiguador lateral','Tambor','Tambor','80/80-R18','90/90-R18',1849,0,1849,'','','','','','','','','',1,0,NULL,NULL),(51,'BFL300010A06','MT-15',2023,'STREET','STREET 150-200','AZU','Icon Blue','MOTOCICLETA MTN155  MT-15','MC','Descubre tu lado oscuro','Yamaha trae al Perú la nueva MT-15, un modelo hyper-naked de baja cilindrada perteneciente a una familia premium, la conocida serie MT (MT-03, MT-07, MT-09, MT-10). La MT-15 alcanza el equilibrio ideal entre tres factores esenciales: aceleración ágil, manejo ágil y diseño avanzado. Su rendimiento corresponde a un modelo digno de la serie MT.','Icon Blue','Tech Black','','Motor 155 cc con pistón de aluminio forjado y cilindro diasil','Diseño minimalista y elegante','Panel LCD','Frenos de disco','4T, SOHC de cuatro válvulas con VVA, refrigerado por líquido','155cc','19.3 Hp  / 10,000 rpm','14.7 N-m','Eléctrico','6 Velocidades, engranaje constante, cadena','Inyección de Combustible','10 Litros','810 mm','145 kg','Horquillas telescópicas invertidas','Amortiguador central Link','Disco','Disco','110/70-R17','140/70-R17',4549,200,4349,'','','','','','','','','',1,0,NULL,NULL),(52,'BFL300010C31','MT-15',2023,'STREET','STREET 150-200','GRI_OSC','Tech Black','MOTOCICLETA MTN155  MT-15','MC','Descubre tu lado oscuro','Yamaha trae al Perú la nueva MT-15, un modelo hyper-naked de baja cilindrada perteneciente a una familia premium, la conocida serie MT (MT-03, MT-07, MT-09, MT-10). La MT-15 alcanza el equilibrio ideal entre tres factores esenciales: aceleración ágil, manejo ágil y diseño avanzado. Su rendimiento corresponde a un modelo digno de la serie MT.','Icon Blue','Tech Black','','Motor 155 cc con pistón de aluminio forjado y cilindro diasil','Diseño minimalista y elegante','Panel LCD','Frenos de disco','4T, SOHC de cuatro válvulas con VVA, refrigerado por líquido','155cc','19.3 Hp  / 10,000 rpm','14.7 N-m','Eléctrico','6 Velocidades, engranaje constante, cadena','Inyección de Combustible','10 Litros','810 mm','145 kg','Horquillas telescópicas invertidas','Amortiguador central Link','Disco','Disco','110/70-R17','140/70-R17',4549,200,4349,'','','','','','','','','',1,0,NULL,NULL),(53,'B5WG00010A06','MT-03 ABS',2023,'STREET','STREER MIDDLE 201-500','AZU','Icon Blue','MOTOCICLETA MTN320-A MT-03','MC','Dark Lightning','Las motocicletas Hyper Naked de Yamaha han sido creadas para emocionar. Con su estilo robusto y sus adrenalínicas prestaciones, los populares modelos MT han robado el corazón y la razón de muchos moteros a nivel mundial. Y ahora presentamos la MT-03, con grandes prestaciones y una presencia imponente para los usuarios más exigentes de Perú.','Storm Fluo','Icon Blue','Tech Black','Motor 321 cc con refrigeración líquida','Chasis tubular tipo diamante','Iluminación led con diseño único','Panel LCD invertido','Bicilíndrico de refrigeración líquida, 4-tiempos, DOHC, 4 válvulas','321 cc','41.4 HP a 10,750 rpm','29.6Nm a 9000RPM','Eléctrico','6 velocidades','Inyección electrónica','14 Litros','780 mm','168 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','110/70-R17','140/70-R17',7099,400,6699,'','','','','','','','','',1,0,NULL,NULL),(54,'B5WG00010B31','MT-03 ABS',2023,'STREET','STREER MIDDLE 201-500','GRI','Storm Fluo','MOTOCICLETA MTN320-A MT-03','MC','Dark Lightning','Las motocicletas Hyper Naked de Yamaha han sido creadas para emocionar. Con su estilo robusto y sus adrenalínicas prestaciones, los populares modelos MT han robado el corazón y la razón de muchos moteros a nivel mundial. Y ahora presentamos la MT-03, con grandes prestaciones y una presencia imponente para los usuarios más exigentes de Perú.','Storm Fluo','Icon Blue','Tech Black','Motor 321 cc con refrigeración líquida','Chasis tubular tipo diamante','Iluminación led con diseño único','Panel LCD invertido','Bicilíndrico de refrigeración líquida, 4-tiempos, DOHC, 4 válvulas','321 cc','41.4 HP a 10,750 rpm','29.6Nm a 9000RPM','Eléctrico','6 velocidades','Inyección electrónica','14 Litros','780 mm','168 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','110/70-R17','140/70-R17',7099,400,6699,'','','','','','','','','',1,0,NULL,NULL),(55,'B5WG00010C33','MT-03 ABS',2023,'STREET','STREER MIDDLE 201-500','GRI_OSC','Tech Black','MOTOCICLETA MTN320-A MT-03','MC','Dark Lightning','Las motocicletas Hyper Naked de Yamaha han sido creadas para emocionar. Con su estilo robusto y sus adrenalínicas prestaciones, los populares modelos MT han robado el corazón y la razón de muchos moteros a nivel mundial. Y ahora presentamos la MT-03, con grandes prestaciones y una presencia imponente para los usuarios más exigentes de Perú.','Storm Fluo','Icon Blue','Tech Black','Motor 321 cc con refrigeración líquida','Chasis tubular tipo diamante','Iluminación led con diseño único','Panel LCD invertido','Bicilíndrico de refrigeración líquida, 4-tiempos, DOHC, 4 válvulas','321 cc','41.4 HP a 10,750 rpm','29.6Nm a 9000RPM','Eléctrico','6 velocidades','Inyección electrónica','14 Litros','780 mm','168 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','110/70-R17','140/70-R17',7099,400,6699,'','','','','','','','','',1,0,NULL,NULL),(56,'BTK600010B31','MT-07 ABS',2023,'BIG BIKES','OTHERS','GRI','Storm Fluo','MOTOCICLETA MTN690 MT-07','MC','Revela tu lado más oscuro','Esta motocicleta llega para encontrar esa oscuridad que llevas dentro. Como es característico de la familia MT, esta motocicleta llega con un robusto y compacto diseño, prestaciones de última tecnología y un motor de alto desempeño. Totalmente lista para más que satisfacer las exigencias de los motociclistas en el Perú.','Storm Fluo','Icon Blue','Tech Black','Motor CP2 EU5 bicilíndrico de 690 cc','Diseño minimalista y elegante','Iluminación totalmente led con diseño único','Panel LCD invertido','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','689 cc','72.4 HP a 8,750 rpm','67 N-m a 6500 rpm','Eléctrico','Constante, 6 velocidades','Inyección electrónica','14 Litros','805 mm','184 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','120/70-R17','180/55-R17',12499,500,11999,'','','','','','','','','',1,0,NULL,NULL),(57,'BTK600010C41','MT-07 ABS',2023,'BIG BIKES','OTHERS','GRI_OSC','Tech Black','MOTOCICLETA MTN690 MT-07','MC','Revela tu lado más oscuro','Esta motocicleta llega para encontrar esa oscuridad que llevas dentro. Como es característico de la familia MT, esta motocicleta llega con un robusto y compacto diseño, prestaciones de última tecnología y un motor de alto desempeño. Totalmente lista para más que satisfacer las exigencias de los motociclistas en el Perú.','Storm Fluo','Icon Blue','Tech Black','Motor CP2 EU5 bicilíndrico de 690 cc','Diseño minimalista y elegante','Iluminación totalmente led con diseño único','Panel LCD invertido','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','689 cc','72.4 HP a 8,750 rpm','67 N-m a 6500 rpm','Eléctrico','Constante, 6 velocidades','Inyección electrónica','14 Litros','805 mm','184 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','120/70-R17','180/55-R17',12499,500,11999,'','','','','','','','','',1,0,NULL,NULL),(58,'BTK600010A06','MT-07 ABS',2023,'BIG BIKES','OTHERS','AZU','Icon Blue','MOTOCICLETA MTN690 MT-07','MC','Revela tu lado más oscuro','Esta motocicleta llega para encontrar esa oscuridad que llevas dentro. Como es característico de la familia MT, esta motocicleta llega con un robusto y compacto diseño, prestaciones de última tecnología y un motor de alto desempeño. Totalmente lista para más que satisfacer las exigencias de los motociclistas en el Perú.','Icon Blue','','','Motor CP2 EU5 bicilíndrico de 690 cc','Diseño minimalista y elegante','Iluminación totalmente led con diseño único','Panel LCD invertido','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','689 cc','72.4 HP a 8,750 rpm','67 N-m a 6500 rpm','Eléctrico','Constante, 6 velocidades','Inyección electrónica','14 Litros','805 mm','184 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','120/70-R17','180/55-R17',12499,500,11999,'','','','','','','','','',1,0,NULL,NULL),(59,'BTKJ00010B31','MT-07 ABS',2024,'BIG BIKES','OTHERS','GRI','Storm Fluo','MOTOCICLETA MTN690 MT-07','MC','Revela tu lado más oscuro','Esta motocicleta llega para encontrar esa oscuridad que llevas dentro. Como es característico de la familia MT, esta motocicleta llega con un robusto y compacto diseño, prestaciones de última tecnología y un motor de alto desempeño. Totalmente lista para más que satisfacer las exigencias de los motociclistas en el Perú.','Storm Fluo','Icon Blue','Tech Black','Motor CP2 EU5 bicilíndrico de 690 cc','Diseño minimalista y elegante','Iluminación totalmente led con diseño único','Panel LCD invertido','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','689 cc','72.4 HP a 8,750 rpm','67 N-m a 6500 rpm','Eléctrico','Constante, 6 velocidades','Inyección electrónica','14 Litros','805 mm','184 kg','Horquillas telescópicas invertidas','Basculante','Disco + ABS','Disco + ABS','120/70-R17','180/55-R17',12999,0,12999,'','','','','','','','','',1,0,NULL,NULL),(60,'B7NX00010A06','MT-09 ABS',2024,'BIG BIKES','OTHERS','AZU','Icon Blue','MOTOCICLETA MTN890 MT-09','MC','Guerrero nocturno','La revolucionaria de un icono, aquella de la cual se originan todas las demás motocicletas de la familia MT. Definitivamente es un vehículo para aquellos que exigen lo mejor, pues su diseño, basado en ser un instrumento para los sentidos, deja atónito a cualquiera. Ahora más ligera y con mejores prestaciones viene a conquistar ese lado oscuro que solo una MT de Yamaha puede ofrecer.','Storm Fluo','Tech Black','','Motor CP2 EU5 tricilíndrico de 889 cc','Diseño minimalista y elegante','Pantalla TFT a todo color de 3,5\"','IMU de 6 ejes con control de tracción de 3 modos para mayor control del vehículo','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','889 cc','78.0 x 62.1 mm','119 HP a 10,000 rpm','93.0 N-m a 7,000 rpm','Constante, 6 velocidades','Inyección electrónica','14 Litros','825 mm','189 kg','Horquillas telescópicas invertidas','Basculante','Disco doble hidráulico + ABS/UBS','Disco doble hidráulico + ABS/UBS','120/70-R17','180/55-R17',15499,0,15499,'','','','','','','','','',1,0,NULL,NULL),(61,'B7NX00010B31','MT-09 ABS',2024,'BIG BIKES','OTHERS','GRI','Storm Fluo','MOTOCICLETA MTN890 MT-09','MC','Guerrero nocturno','La revolucionaria de un icono, aquella de la cual se originan todas las demás motocicletas de la familia MT. Definitivamente es un vehículo para aquellos que exigen lo mejor, pues su diseño, basado en ser un instrumento para los sentidos, deja atónito a cualquiera. Ahora más ligera y con mejores prestaciones viene a conquistar ese lado oscuro que solo una MT de Yamaha puede ofrecer.','Storm Fluo','Tech Black','','Motor CP2 EU5 tricilíndrico de 889 cc','Diseño minimalista y elegante','Pantalla TFT a todo color de 3,5\"','IMU de 6 ejes con control de tracción de 3 modos para mayor control del vehículo','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','889 cc','78.0 x 62.1 mm','119 HP a 10,000 rpm','93.0 N-m a 7,000 rpm','Constante, 6 velocidades','Inyección electrónica','14 Litros','825 mm','189 kg','Horquillas telescópicas invertidas','Basculante','Disco doble hidráulico + ABS/UBS','Disco doble hidráulico + ABS/UBS','120/70-R17','180/55-R17',15499,0,15499,'','','','','','','','','',1,0,NULL,NULL),(62,'B7NX00010C41','MT-09 ABS',2024,'BIG BIKES','OTHERS','GRI_OSC','Tech Black','MOTOCICLETA MTN890 MT-09','MC','Guerrero nocturno','La revolucionaria de un icono, aquella de la cual se originan todas las demás motocicletas de la familia MT. Definitivamente es un vehículo para aquellos que exigen lo mejor, pues su diseño, basado en ser un instrumento para los sentidos, deja atónito a cualquiera. Ahora más ligera y con mejores prestaciones viene a conquistar ese lado oscuro que solo una MT de Yamaha puede ofrecer.','Storm Fluo','Tech Black','','Motor CP2 EU5 tricilíndrico de 889 cc','Diseño minimalista y elegante','Pantalla TFT a todo color de 3,5\"','IMU de 6 ejes con control de tracción de 3 modos para mayor control del vehículo','Refrigeración Liquida, 4 tiempos, DOHC, 4 válvulas','889 cc','78.0 x 62.1 mm','119 HP a 10,000 rpm','93.0 N-m a 7,000 rpm','Constante, 6 velocidades','Inyección electrónica','14 Litros','825 mm','189 kg','Horquillas telescópicas invertidas','Basculante','Disco doble hidráulico + ABS/UBS','Disco doble hidráulico + ABS/UBS','120/70-R17','180/55-R17',15499,0,15499,'','','','','','','','','',1,0,NULL,NULL),(63,'BSL300010A06','PW50',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA PW50','MC','El perfecto primer paso','Aquí es donde comienza todo. La PW50 es la mejor opción para que los pequeños entren en el mundo del motocross y, en general, de las motocicletas. Esta moto es totalmente automática, solo necesitas acelerar. Su motor 2 tiempos de 50cc brinda la diversión y potencia necesaria para que el niño aprenda sin ningún temor, además su asiento súper bajo le genera mayor confianza al manejarla. Para tranquilidad de los padres, el acelerador cuenta con un regulador que permite restringir la potencia máxima de la unidad. De esta manera, se puede ir aumentando la potencia máxima conforme aumente las habilidades del niño.','Competition Blue','','','Motor ligero de 49 cc monocilíndrico refrigerado por aire, que permite una mayor agilidad de la motocicleta','Frenos de tambor ideales para aplicaciones off road','Transmisión automática ideal para aprender a manejar','Horquilla delantera  de 60mm de recorrido','2 tiempos, monocilíndrico, refrigerado por aire','49 CC','','','Kickstarter','Embrague automático centrífugo','Carburador','2.0 Litros','475 mm','41 kg','Horquilla delantera','Basculante','Tambor','Tambor','2.5 - 10  4PR','2.5 - 10  4PR',2999,0,2999,'','','','','','','','','',1,0,NULL,NULL),(64,'BR8M00010A06','YZ65',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA YZ65','MC','Los sueños de Motocross empiezan aquí','Con una especificación basada en las carreras e inspirada en la emblemática YZ450F, el nuevo modelo de moto de motocross YZ65 dirigido a los más jóvenes y es la opción perfecta para cualquier piloto que quiera empezar a competir. Con un motor y un chasis completamente nuevos, esta moto de 2 tiempos de alta tecnología ofrece una potencia fácil de utilizar y una gran estabilidad para mejorar la confianza del piloto. Equipada con una impresionante carrocería inspirada en el modelo YZ450F, elegantes aros azules de Yamaha y una posición de conducción ergonómica, es la elección perfecta para los futuros campeones.','Competition Blue','','','Motor de 65cc monicilíndrico refrigerado por liquido, que permite una mayor agilidad de la motocicleta','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Chasis de cuna semidoble de acero y sub chasis de aluminio para una conducción mas ligera','2 tiempos, refrigerado por líquido','65 CC','','','Kickstarter','6 velocidad, engraneja constante','Carburador','3.5 Litros','754 mm','61 kg','Horquilla delantera','Basculante','DISCO','DISCO','60/100-14 30M','80/100-12 41M',6699,0,6699,'','','','','','','','','',1,0,NULL,NULL),(65,'B0GG00010A06','YZ85LW',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA YZ85LW','MC','Ve a lo grande','Yamaha se ha caracterizado durante muchos años por brindarles a los amantes del motocross las mejores máquinas para concluir exitosamente los más exigentes circuitos de este deporte extremo. La YZ85 ha sido parte del inicio de muchos grandes pilotos del motocross, quienes obtuvieron la confianza necesaria en el fiable motor de 2 tiempos y el chasis ligero lo que proporciona una potencia adecuada y un fácil manejo en cada entrenamiento. La nueva YZ85 es la opción perfecta para los pilotos del mañana.','Competition Blue','','','Motor de 65cc monicilíndrico refrigerado por liquido, que permite una mayor agilidad de la motocicleta','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Chasis de cuna semidoble de acero para una conducción mas ligera','2 tiempos, refrigerado por líquido','85 cc','','','Kickstarter','6 velocidad, engraneja constante','Carburador','5 Litros','884 mm','75 kg','Horquilla delantera','Basculante','DISCO','DISCO','70/100 - 19 42M','90/100 - 16 52M',7299,0,7299,'','','','','','','','','',1,0,NULL,NULL),(66,'B4XA00010A06','YZ125',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA YZ125','MC','TWO‑STROKE EVOLUTION','La YZ 125 viene con un motor sumamente explosivo y un chasis de aluminio ultra sensible. Este ligero 125cc de 2 tiempos es un ganador en la competencia de más alto nivel. Esta moto cuenta con un sistema de suspensión delantera y trasera que garantiza manejo súper ágil y porsupuesto, curvas rápidas. Y cada detalle tan bien pensado le dan un look como recién salido de fábrica. Ahora, lo único que falta para que todo esté listo ... eres tú.','Competition Blue','','','Motor carburado de 2 tiemposrefrigerado por líquido, que permite una mayor agilidad de la motocicleta','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Chasis de cuna semidoble de acero para una conducción mas ligera','2 tiempos, enfriado por líquido, monocilíndrico','125cc','','','Kickstarter','Velocidad 6, engrane constante, cadena','Carburador','6.8 Litros','980 mm','94 Kg','Horquilla telescópica','Basculante (suspensión de unión)','Freno hidráulico monodisco 270mm','Freno hidráulico monodisco 245mm','80/100-21 51M','100/90-19 57M',9499,0,9499,'','','','','','','','','',1,0,NULL,NULL),(67,'BSB200010A06','YZ250F',2024,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA YZ250F','MC','Domina la pista','Pocas motos pueden igualarse a una Yamaha YZ250F; sus características aseguran potencia y agilidad, una combinación clave para alcanzar el triunfo en los circuitos de motocross de cualquier parte del mundo. Equipada para el éxito, esta moto inyectada te brinda una experiencia off-road realmente extrema al sobrevolar el circuito.','Competition Blue','','','Motor de 250cc, 4 tiempos monocilíndrico con inyección electrónica y refrigerado por líquido, desarrolla un mejor performance en competencia','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Aplicación Power Tunner para ajustar configuraciones de la motocicleta atrevés de la app','4 tiempos, DOHC, enfriado por líquido, monocilíndrico','250cc','','','Eléctrico','Velocidad 5, engrane constante, cadena','Mikuni® fuel injection, 44mm','6.2 Litros','980 mm','106 Kg','Horquilla telescópica','Basculante (suspensión de unión)','Freno hidráulico monodisco 270mm','Freno hidráulico monodisco 240mm','80/100-21 51M','100/90-19 57M',11999,0,11999,'','','','','','','','','',1,0,NULL,NULL),(68,'BHR200010A06','YZ450F',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA YZ450F','MC','Más ligera, más delgada, más rápida','Diseñada para los apasionados del off road y las experiencias extremas, la YZ450F es una máquina potente que marca la diferencia gracias a su aceleración ganadora. Una conducción más ligera se sumará a tu rendimiento en carrera gracias a su equilibrio peso/potencia.','Competition Blue','','','Motor de 450cc, 4 tiempos monocilíndrico con inyección electrónica y refrigerado por líquido, desarrolla un mejor performance en competencia','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Aplicación Power Tunner para ajustar configuraciones de la motocicleta atrevés de la app','4 tiempos, DOHC, enfriado por líquido, monocilíndrico','450cc','','','Eléctrico','Velocidad 5, engrane constante, cadena','Mikuni® fuel injection, 44mm','6.2 Litros','980 mm','112 Kg','Horquilla telescópica','Basculante (suspensión de unión)','Freno hidráulico monodisco 270mm','Freno hidráulico monodisco 240mm','80/100-21 51M','110/90-19 62M',13499,0,13499,'','','','','','','','','',1,0,NULL,NULL),(69,'B3ME00010A06','WR 155R',2024,'TODO TERRENO','','AZU','Competition Blue','MOTOCICLETA WR155R','MC','Otro nivel de moto','La WR 155R, la todo terreno con mejor relación peso potencia de la categoría que te permitirá llevar esa sensación de adrenalina a otro nivel con su potente motor de 16.7HP, torque de 14.3 N-m, inyección electrónica, tecnología VVA y refrigeración líquida. Lo mejor del enduro en una todo terreno Yamaha.','Cross Black','Competition Blue','','Potente motor de 4T de 155cc, refrigerado por líquido, transmisión de 6 velocidades, inyección electrónica y 16.7HP que proporciona otro nivel de experiencia de manejo.','Incopora discos de frenos tanto en la rueda delantera como rueda posterior para una mayor precisión y confianza de frenado.','Panel de instrumentos digital para una mejor facilidad de lectura','Diseño deportivo heredado de la linea WR, con peso ligero para una conducción que facilita una excelente maniobrabilidad en cualquier terreno.','Refrigerado por líquido, 4 tiempos, SOHC, 4 válvulas, VVA','155 cc','16.7HP a 10,000 rpm','14.3N-m a 6,500 rpm','Electrico','6 velocidades','Inyección de Combustible','8.1 Litros','880 mm','134 kg','Horquilla telescópica','Monoamortiguador con bieletas','Disco','Disco','2.75-R21','4.10-R18',4299,0,4299,'','','','','','','','','',1,0,NULL,NULL),(70,'B3ME00010B05','WR 155R',2024,'TODO TERRENO','','NEG','Cross Black','MOTOCICLETA WR155R','MC','Otro nivel de moto','La WR 155R, la todo terreno con mejor relación peso potencia de la categoría que te permitirá llevar esa sensación de adrenalina a otro nivel con su potente motor de 16.7HP, torque de 14.3 N-m, inyección electrónica, tecnología VVA y refrigeración líquida. Lo mejor del enduro en una todo terreno Yamaha.','Cross Black','Competition Blue','','Potente motor de 4T de 155cc, refrigerado por líquido, transmisión de 6 velocidades, inyección electrónica y 16.7HP que proporciona otro nivel de experiencia de manejo.','Incopora discos de frenos tanto en la rueda delantera como rueda posterior para una mayor precisión y confianza de frenado.','Panel de instrumentos digital para una mejor facilidad de lectura','Diseño deportivo heredado de la linea WR, con peso ligero para una conducción que facilita una excelente maniobrabilidad en cualquier terreno.','Refrigerado por líquido, 4 tiempos, SOHC, 4 válvulas, VVA','155 cc','16.7HP a 10,000 rpm','14.3N-m a 6,500 rpm','Electrico','6 velocidades','Inyección de Combustible','8.1 Litros','880 mm','134 kg','Horquilla telescópica','Monoamortiguador con bieletas','Disco','Disco','2.75-R21','4.10-R18',4299,0,4299,'','','','','','','','','',1,0,NULL,NULL),(71,'BAKJ00010A06','WR250F',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA WR250F','MC','PLAY FAST','Este modelo posee personalidad y un estilo contundente. Su motor con diseño innovador, derivado de la exitosa YZ250F, le permite marcar un antes y un después en motos de enduro. Adicionalmente, el diseño del chasis y equipamiento ofrecen una conducción ligera y respuesta óptima en todo tipo de terrenos y maniobras. La versión 2018 actualiza su imagen y se acerca a la estética de competición de la familia YZ.','Competition Blue','','','Motor de 250cc, 4 tiempos monocilíndrico con inyección electrónica y refrigerado por líquido, desarrolla un mejor performance en competencia','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Aplicación Power Tunner para ajustar configuraciones de la motocicleta atrevés de la app','4 tiempos, DOHC, enfriado por líquido','250 cc','','','Eléctrico','6 velocidades, engrane constante, cadena','Inyección de Combustible','8.1 Litros','955 mm','115 Kg','Horquilla telescópica','Basculante (suspensión de unión)','Freno hidráulico monodisco 270mm','Freno hidráulico monodisco 245mm','90/90-21 54M','130/90-18 M/C 69M M+S',11999,0,11999,'','','','','','','','','',1,0,NULL,NULL),(72,'BDBC00010A06','WR450F',2023,'OFF ROAD','MOTOS DE COMPENTENCIA','AZU','Competition Blue','MOTOCICLETA WR450F','MC','BORN TO RIDE','Potencia y resistencia se unieron para crear la WR450F, una Yamaha especialmente equipada para que los pilotos de enduro experimenten adrenalina pura al superar competencias en toda clase de terreno alrededor del mundo. Su diseño y tecnología permiten que a pesar de su increíble fuerza, sea una moto de fácil conducción, ideal para atravesar los caminos más desafiantes con el mayor confort.','Competition Blue','','','Motor de 450cc, 4 tiempos monocilíndrico con inyección electrónica y refrigerado por líquido, desarrolla un mejor performance en competencia','Freno de disco en ambas ruedas, que permite un frenado más preciso','Horquilla invertida KYB - Regulable para un mejor performance en competencia','Aplicación Power Tunner para ajustar configuraciones de la motocicleta atrevés de la app','4 tiempos, DOHC, enfriado por líquido','250 cc','','','Eléctrico','6 velocidades, engrane constante, cadena','Inyección de Combustible','8.1 Litros','955 mm','119 kg','Horquilla telescópica','Basculante','Disco','Disco','90/90-21 54M M+S','130/90-18 69M M+S',13499,0,13499,'','','','','','','','','',1,0,NULL,NULL),(73,'','Kodiak 450 4W',2024,'','UTILITARIA','AZU','Competition Blue','CUATRIMOTO YFM450FWB KODIAK 450','ATV','ELIGE TU AVENTURA X2 O X4','Tecnología fácil de usar, excelente durabilidad y toda la fiabilidad de Yamaha permiten a la Kodiak 450 acometer los trabajos más duros en condiciones de terreno extremas. Gracias a su sistema de transmisión On Command, puedes alternar sin complicaciones entre 2WD y 4WD con solo pulsar un botón. Y la transmisión automática Ultramatic hace todas las tareas más relajantes y agradables. ¡En términos de comodidad y utilidad, no hay nada que se le pueda comparar! El poderoso Kodiak 450 es el compañero perfecto para cualquier trabajo duro en tareas específicas.','','Competition Blue','','','Motor monicilíndrico de 421cc refrigerado líquido','Ultramatic con reversa / 4WD que permite alternar la tracción 4x4 y 4x2','Encendido eléctrico que facilita el inicio de la partida','Depósito de combustible de 14 L brinda mayor autonomía','SOHC de 2 válvulas, refrigerado por líquido','421cc','','','Eléctrico','Ultramatic con reversa / 4WD','Inyección electrónica','14 L','','','','','','','',12499,0,12499,'','','','','','','','','',1,0,NULL,NULL);
/*!40000 ALTER TABLE `maestro_modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personals`
--

DROP TABLE IF EXISTS `personals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personals` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nombres` char(150) DEFAULT NULL,
  `apellidos` char(150) DEFAULT NULL,
  `celular` char(25) DEFAULT NULL,
  `correo` char(25) DEFAULT NULL,
  `tipo_documento_id` int NOT NULL,
  `documento` char(25) DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empresa` char(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personals_tipo_documentos1_idx` (`tipo_documento_id`),
  KEY `fk_personals_users1_idx` (`user_id`),
  KEY `indx_nombres` (`nombres`) /*!80000 INVISIBLE */,
  KEY `indx_apellidos` (`apellidos`) /*!80000 INVISIBLE */,
  KEY `indx_celular` (`celular`) /*!80000 INVISIBLE */,
  KEY `indx_correo` (`correo`) /*!80000 INVISIBLE */,
  KEY `indx_documento` (`documento`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`),
  KEY `indx_empresa` (`empresa`),
  CONSTRAINT `fk_personals_tipo_documentos1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`),
  CONSTRAINT `fk_personals_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personals`
--

LOCK TABLES `personals` WRITE;
/*!40000 ALTER TABLE `personals` DISABLE KEYS */;
INSERT INTO `personals` VALUES (1,1,'Cristian','Chavez','944129804','cristian_7_70@hotmail.com',1,'47331640',1,0,NULL,NULL,'YAMAHA'),(3,4,'Juan','Chauca','958258365','juan@mail.com',1,'25826985',1,0,'2024-06-30 15:57:06','2024-06-30 16:01:34','Empresa1');
/*!40000 ALTER TABLE `personals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('IWrpSJhIpkRPWCtINQccEbefFYe5u4eEemWeHbuZ',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZUI3RFhKM0NIZ3RVNXNxaUVHNEM4Q0RNQkdpOFFYdU1UNEhGc0R3WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9jb3RpemFjaW9ueWFtYWhhLnRlc3QvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJFpXZHE0eDE1aU1tYVFhSjF1bHNUek9YU3dUdHo1SVk1S1RMb1A5V2NxL2ozYmJTNlpzV1VHIjt9',1719882376),('pgIqtmh0alL8vzjFUghSslfcHlWGgMtRxYC3PNky',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVzh6MURTN29IcTFicXpNT0NBV1Y3MUZZRWM5Z2hjalBqZ1VncGFzUCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovL2NvdGl6YWNpb255YW1haGEudGVzdC9hZG1pbi9jb3RpemFjaW9uZXMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovL2NvdGl6YWNpb255YW1haGEudGVzdC9hZG1pbi9jb3RpemFjaW9uZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1719871679);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategorias` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `categoria_id` bigint NOT NULL,
  `subcategoria` char(100) DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategorias_categorias1_idx` (`categoria_id`),
  KEY `indx_subcategoria` (`subcategoria`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`),
  CONSTRAINT `fk_subcategorias_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documentos`
--

DROP TABLE IF EXISTS `tipo_documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_documentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `sigla` char(50) DEFAULT NULL,
  `digitos` int DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_tipo` (`nombre`) /*!80000 INVISIBLE */,
  KEY `indx_key` (`sigla`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documentos`
--

LOCK TABLES `tipo_documentos` WRITE;
/*!40000 ALTER TABLE `tipo_documentos` DISABLE KEYS */;
INSERT INTO `tipo_documentos` VALUES (1,'Documento Nacional de Identidad','DNI',8,1,0,NULL,NULL),(2,'Carné de Extranjería','Carné de Extranjería',20,1,0,NULL,NULL),(3,'Registro Unico de Contribuyente','RUC',11,1,0,NULL,NULL),(4,'Pasaporte','Pasaporte',20,1,0,NULL,NULL),(5,'Otros tipos de documento','Otros tipos de documento',20,1,0,NULL,NULL),(6,'Cédula diplomática de identidad','Cédula diplomática de identidad',20,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tipo_documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_users`
--

DROP TABLE IF EXISTS `tipo_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_nombre` (`nombre`) /*!80000 INVISIBLE */,
  KEY `indx_descripcion` (`descripcion`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`) /*!80000 INVISIBLE */
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_users`
--

LOCK TABLES `tipo_users` WRITE;
/*!40000 ALTER TABLE `tipo_users` DISABLE KEYS */;
INSERT INTO `tipo_users` VALUES (1,'Administrador','sa',1,0),(2,'Cotizador','Personal User Cotizador',1,0);
/*!40000 ALTER TABLE `tipo_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_user_id` int DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  `borrado` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `indx_name` (`name`) /*!80000 INVISIBLE */,
  KEY `indx_password` (`password`) /*!80000 INVISIBLE */,
  KEY `indx_remember_token` (`remember_token`) /*!80000 INVISIBLE */,
  KEY `indx_current_team_id` (`current_team_id`) /*!80000 INVISIBLE */,
  KEY `indx_tipo_user_id` (`tipo_user_id`) /*!80000 INVISIBLE */,
  KEY `indx_activo` (`activo`) /*!80000 INVISIBLE */,
  KEY `indx_borrado` (`borrado`) /*!80000 INVISIBLE */
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','director_mail@hotmail.com',NULL,'$2y$10$ZWdq4x15iMmaQaJ1ulsTzOXSwTtz5IY5KTLoP9Wcq/j3bbS6ZsWUG',NULL,NULL,NULL,NULL,NULL,'perfil_25-05-2023-23-24-49.jpg','2022-06-28 04:09:08','2024-06-30 16:16:22',1,1,0),(4,'JChauca1','juan@mail.com',NULL,'$2y$10$RlTxguvtcaZwrzgVcAKkDe7H91Z2bImEUMwvRBweZMJ5FsUR7xX4O',NULL,NULL,NULL,NULL,NULL,'user_image.png','2024-06-30 15:57:06','2024-06-30 16:01:34',2,1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'u230756120_test_yamaha_co'
--

--
-- Dumping routines for database 'u230756120_test_yamaha_co'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-01 20:07:33
