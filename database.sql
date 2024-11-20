-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: enlaces
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `pk_categoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(25) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pk_categoria`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'PHP','LENGUAJE'),(2,'TOOLS','OTROS'),(3,'CSS','LENGUAJE'),(4,'JS','LENGUAJE'),(5,'JOB','OTROS'),(6,'GIT','OTROS'),(7,'AUTO','OTROS'),(8,'MAIL','OTROS'),(9,'ISO','OTROS'),(10,'BOOTSTRAP','FRAMEWORK'),(11,'ELECTRON','FRAMEWORK'),(12,'MSG','OTROS'),(13,'HTTP','OTROS'),(14,'RETOS','OTROS'),(15,'CURSOS','OTROS'),(16,'PYTHON','LENGUAJE'),(17,'API','OTROS'),(18,'ASTRO','FRAMEWORK');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vinculos`
--

DROP TABLE IF EXISTS `vinculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vinculos` (
  `pk_vinculo` int NOT NULL AUTO_INCREMENT,
  `enlace` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `fk_categoria` int DEFAULT NULL,
  PRIMARY KEY (`pk_vinculo`),
  KEY `fk_vinculos_categorias` (`fk_categoria`),
  CONSTRAINT `fk_vinculos_categorias` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria` (`pk_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vinculos`
--

LOCK TABLES `vinculos` WRITE;
/*!40000 ALTER TABLE `vinculos` DISABLE KEYS */;
INSERT INTO `vinculos` VALUES (1,'https://www.youtube.com/watch?v=qvp2RQEfiDI&t=1s','Debug en PHP',1),(2,'https://www.terabox.com/spanish','Terabox',2),(3,'https://7-zip.org/','7Zip',2),(4,'http://koala-app.com/','Koala',3),(5,'https://sass-lang.com/','SASS',3),(6,'https://lesscss.org/','LESS',3),(7,'https://popper.js.org/docs/v2/','Popper',4),(8,'https://www.npmjs.com/','npm Librerías JS',4),(9,'https://getcomposer.org/','Composer',1),(10,'https://packagist.org/','Librerías PHP',1),(11,'https://aulab.es/guias','Guía PHP',1),(12,'https://codersfree.com/courses-status/aprende-php-y-mysql-desde-cero/herencia-en-php','PHP 8 + MySQL 8 (desde cero)',1),(13,'https://codersfree.com/cursos/aprende-laravel-avanzado','Curso LARAVEL Avanzado (10 US$ - comprar)',1),(14,'https://jairogarciarincon.com/clase/programacion-orientada-a-objetos-en-php/herencia-extension-y-polimorfismo','POO en PHP',1),(15,'https://www.fundaciongoodjob.org/','Fundación Good Job',5),(16,'https://www.sourcetreeapp.com/','A free Git client for Windows and Mac',6),(17,'https://academy.make.com/','Make. No-code workflow automation',7),(18,'https://www.thunderbird.net/es-ES/','Gestor de Correo Electrónico',8),(19,'https://www.guerrillamail.com/es/','Guerrilla Mail',8),(20,'https://tuta.com/es','Tuta Nota',8),(21,'https://proton.me/es-es/mail','Proton Mail',8),(22,'https://www.ultraiso.com/','Ultra ISO',9),(23,'https://ng-gentelella.readthedocs.io/en/latest/','Gentelella: Free to use Bootstrap admin template',10),(24,'https://cdnjs.com/libraries/gentelella','Gentelella',10),(25,'https://nextcloud.com/es/','NextCloud',2),(26,'https://element.io/','Element (cliente)',2),(27,'https://www.electronjs.org/es/','Electron',11),(28,'https://signal.org/es/','Signal',12),(29,'https://httpd.apache.org/docs/trunk/es/howto/htaccess.html','Tutorial del Servidor Apache',13),(30,'https://edabit.com/','Edabit',14),(31,'https://grow.google/','GROW GOOGLE',15),(32,'https://midu.link/','Enlaces MiDuDev',15),(33,'https://www.frontendpractice.com/','FrontEnd Practice',14),(34,'https://www.youtube.com/watch?v=BcGAPkjt_IE&list=PLUofhDIg_38rCmybY4E_bmGvUHaSw7-oc','Tutorial PHP Básico',1),(35,'https://es.python.org/aprende-python/','Aprende Python (vínculos)',16),(36,'https://devdocs.io/','DEV DOCS APIS',17),(37,'https://www.patterns.dev/','Patrones',4),(38,'https://github.com/eltictacdicta/consolelogphp/blob/master/README.md','console.log en PHP',1),(39,'https://kinsta.com/es/blog/astro-js/','Astro framework CMS',18),(40,'https://picocss.com/','Pico Semantic CSS Framework',3),(41,'https://zeabur.com/','Deploy PHP',1);
/*!40000 ALTER TABLE `vinculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_enlaces`
--

DROP TABLE IF EXISTS `vista_enlaces`;
/*!50001 DROP VIEW IF EXISTS `vista_enlaces`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_enlaces` AS SELECT 
 1 AS `id_vinculo`,
 1 AS `titulo`,
 1 AS `url`,
 1 AS `categoria_id`,
 1 AS `nombre_categoria`,
 1 AS `tipo_categoria`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vista_enlaces`
--

/*!50001 DROP VIEW IF EXISTS `vista_enlaces`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_enlaces` AS select `v`.`pk_vinculo` AS `id_vinculo`,`v`.`titulo` AS `titulo`,`v`.`enlace` AS `url`,`v`.`fk_categoria` AS `categoria_id`,`c`.`categoria` AS `nombre_categoria`,`c`.`tipo` AS `tipo_categoria` from (`vinculos` `v` left join `categoria` `c` on((`v`.`fk_categoria` = `c`.`pk_categoria`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-19 18:11:08
