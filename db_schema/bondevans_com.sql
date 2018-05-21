-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: puntoon
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `winner_id` int(11) NOT NULL DEFAULT '0',
  `invite_only` tinyint(1) NOT NULL DEFAULT '0',
  `prize_percent` int(11) NOT NULL DEFAULT '0',
  `closing_entry_date` date NOT NULL,
  `finish_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `TOURNAMENT_idx` (`tournament_id`),
  CONSTRAINT `TOURNAMENT` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competitions`
--

LOCK TABLES `competitions` WRITE;
/*!40000 ALTER TABLE `competitions` DISABLE KEYS */;
INSERT INTO `competitions` VALUES (1,1,'Inkberrow Football Club (Oct 16)',26,1,0,50,'2016-09-30','2016-10-31'),(2,2,'Inkberrow Football Club (Nov 16)',26,1,0,50,'2016-10-31','2016-11-30'),(3,3,'Inkberrow Football Club (Dec 16)',26,1,0,50,'2016-11-30','2016-12-31'),(4,4,'Inkberrow Football Club (Jan 17)',26,1,0,50,'2016-12-31','2016-01-31'),(5,5,'Inkberrow Football Club (Feb 17)',26,1,0,50,'2016-01-31','2016-02-28'),(6,6,'Inkberrow Football Club (Mar 17)',26,1,0,50,'2016-02-28','2016-03-31'),(7,7,'Inkberrow Football Club (Apr 17)',26,1,0,50,'2016-03-31','2016-04-30');
/*!40000 ALTER TABLE `competitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `competition_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `team_1_id` int(11) NOT NULL,
  `team_2_id` int(11) NOT NULL,
  `team_3_id` int(11) NOT NULL,
  `team_4_id` int(11) NOT NULL,
  `team_5_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `tournament_id` int(11) NOT NULL,
  `team_1_goals` int(11) NOT NULL DEFAULT '0',
  `team_2_goals` int(11) NOT NULL DEFAULT '0',
  `team_3_goals` int(11) NOT NULL DEFAULT '0',
  `team_4_goals` int(11) NOT NULL DEFAULT '0',
  `team_5_goals` int(11) NOT NULL DEFAULT '0',
  `total_goals` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `COMPETITION_idx` (`competition_id`),
  KEY `USER_idx` (`user_id`),
  KEY `total_goals_idx` (`total_goals`),
  CONSTRAINT `COMPETITION` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entries`
--

LOCK TABLES `entries` WRITE;
/*!40000 ALTER TABLE `entries` DISABLE KEYS */;
INSERT INTO `entries` VALUES (1,1,5,'Allan Scrafton',10,6,15,7,12,0,1,6,4,2,1,3,16),(2,1,3,'Andrew Higginson',8,13,1,6,20,0,1,4,4,8,4,3,23),(3,1,2,'Andy Forbes',10,16,12,6,14,0,1,6,4,3,4,8,25),(4,1,4,'Ashley Hodges',10,4,14,2,20,0,1,6,11,8,8,3,36),(5,1,6,'Brian Cunningham',9,8,14,2,20,0,1,8,4,8,8,3,31),(6,1,8,'Carl Stenton',15,2,16,19,8,0,1,2,8,4,3,4,21),(7,1,7,'Cindy Bailey',14,3,7,2,8,0,1,8,3,1,8,4,24),(8,1,9,'Dan Bailey',11,10,1,6,18,0,1,1,6,8,4,4,23),(9,1,12,'Dave Johnson',14,5,6,17,19,0,1,8,3,4,4,3,22),(10,1,11,'David Higginson',17,18,8,5,14,0,1,4,4,4,3,8,23),(11,1,10,'Dominic Bradshaw',20,14,19,15,2,0,1,3,8,3,2,8,24),(12,1,13,'Eddie Hobson',2,1,7,6,8,0,1,8,8,1,4,4,25),(13,1,14,'Emily Smithies',10,14,8,9,20,0,1,6,8,4,8,3,29),(14,1,15,'Harry Coughlin',9,10,1,17,6,0,1,8,6,8,4,4,30),(15,1,16,'Jed Bartley',14,7,3,18,12,0,1,8,1,3,4,3,19),(16,1,17,'Jim Forsyth',5,8,19,13,9,0,1,3,4,3,4,8,22),(17,1,19,'Judy Kirk',4,18,7,2,6,0,1,11,4,1,8,4,28),(18,1,18,'Julia Hodges',16,12,11,9,5,0,1,4,3,1,8,3,19),(19,1,22,'Maureen Hobson',13,12,17,10,5,0,1,4,3,4,6,3,20),(20,1,21,'Mike Hird',6,4,5,9,13,0,1,4,11,3,8,4,30),(21,1,20,'Molly Higginson',10,2,20,9,5,0,1,6,8,3,8,3,28),(22,1,23,'Nicky Higginson',11,4,7,14,3,0,1,1,11,1,8,3,24),(23,1,24,'Paul Evans',19,8,3,15,2,0,1,3,4,3,2,8,20),(24,1,25,'Paul Hodges',19,6,8,13,17,0,1,3,4,4,4,4,19),(25,1,26,'Rob Bailey',10,5,20,9,14,0,1,6,3,3,8,8,28),(26,1,27,'Ryan Bailey',11,6,3,18,5,0,1,1,4,3,4,3,15),(27,1,28,'Sharon Cole',19,18,8,14,2,0,1,3,4,4,8,8,27),(28,1,29,'Steve Price',16,14,19,5,17,0,1,4,8,3,3,4,22),(29,1,30,'Tim Cole',4,1,17,5,20,0,1,11,8,4,3,3,29),(30,1,31,'Vanessa Bradshaw',20,7,19,1,14,0,1,3,1,3,8,8,23),(31,1,32,'Will Islip',7,5,3,1,18,0,1,1,3,3,8,4,19),(32,2,5,'Allan Scrafton',10,6,15,7,12,0,2,0,0,0,0,0,0),(33,2,3,'Andrew Higginson',8,13,1,6,20,0,2,0,0,0,0,0,0),(34,2,2,'Andy Forbes',10,16,12,6,14,0,2,0,0,0,0,0,0),(35,2,4,'Ashley Hodges',10,4,14,2,20,0,2,0,0,0,0,0,0),(36,2,6,'Brian Cunningham',9,8,14,2,20,0,2,0,0,0,0,0,0),(37,2,8,'Carl Stenton',15,2,16,19,8,0,2,0,0,0,0,0,0),(38,2,7,'Cindy Bailey',14,3,7,2,8,0,2,0,0,0,0,0,0),(39,2,9,'Dan Bailey',11,10,1,6,18,0,2,0,0,0,0,0,0),(40,2,12,'Dave Johnson',14,5,6,17,19,0,2,0,0,0,0,0,0),(41,2,11,'David Higginson',17,18,8,5,14,0,2,0,0,0,0,0,0),(42,2,10,'Dominic Bradshaw',20,14,19,15,2,0,2,0,0,0,0,0,0),(43,2,13,'Eddie Hobson',2,1,7,6,8,0,2,0,0,0,0,0,0),(44,2,14,'Emily Smithies',10,14,8,9,20,0,2,0,0,0,0,0,0),(45,2,15,'Harry Coughlin',9,10,1,17,6,0,2,0,0,0,0,0,0),(46,2,16,'Jed Bartley',14,7,3,18,12,0,2,0,0,0,0,0,0),(47,2,17,'Jim Forsyth',5,8,19,13,9,0,2,0,0,0,0,0,0),(48,2,19,'Judy Kirk',4,18,7,2,6,0,2,0,0,0,0,0,0),(49,2,18,'Julia Hodges',16,12,11,9,5,0,2,0,0,0,0,0,0),(50,2,22,'Maureen Hobson',13,12,17,10,5,0,2,0,0,0,0,0,0),(51,2,21,'Mike Hird',6,4,5,9,13,0,2,0,0,0,0,0,0),(52,2,20,'Molly Higginson',10,2,20,9,5,0,2,0,0,0,0,0,0),(53,2,23,'Nicky Higginson',11,4,7,14,3,0,2,0,0,0,0,0,0),(54,2,24,'Paul Evans',19,8,3,15,2,0,2,0,0,0,0,0,0),(55,2,25,'Paul Hodges',19,6,8,13,17,0,2,0,0,0,0,0,0),(56,2,26,'Rob Bailey',10,5,20,9,14,0,2,0,0,0,0,0,0),(57,2,27,'Ryan Bailey',11,6,3,18,5,0,2,0,0,0,0,0,0),(58,2,28,'Sharon Cole',19,18,8,14,2,0,2,0,0,0,0,0,0),(59,2,29,'Steve Price',16,14,19,5,17,0,2,0,0,0,0,0,0),(60,2,30,'Tim Cole',4,1,17,5,20,0,2,0,0,0,0,0,0),(61,2,31,'Vanessa Bradshaw',20,7,19,1,14,0,2,0,0,0,0,0,0),(62,2,32,'Will Islip',7,5,3,1,18,0,2,0,0,0,0,0,0),(63,3,5,'Allan Scrafton',10,6,15,7,12,0,3,0,0,0,0,0,0),(64,3,3,'Andrew Higginson',8,13,1,6,20,0,3,0,0,0,0,0,0),(65,3,2,'Andy Forbes',10,16,12,6,14,0,3,0,0,0,0,0,0),(66,3,4,'Ashley Hodges',10,4,14,2,20,0,3,0,0,0,0,0,0),(67,3,6,'Brian Cunningham',9,8,14,2,20,0,3,0,0,0,0,0,0),(68,3,8,'Carl Stenton',15,2,16,19,8,0,3,0,0,0,0,0,0),(69,3,7,'Cindy Bailey',14,3,7,2,8,0,3,0,0,0,0,0,0),(70,3,9,'Dan Bailey',11,10,1,6,18,0,3,0,0,0,0,0,0),(71,3,12,'Dave Johnson',14,5,6,17,19,0,3,0,0,0,0,0,0),(72,3,11,'David Higginson',17,18,8,5,14,0,3,0,0,0,0,0,0),(73,3,10,'Dominic Bradshaw',20,14,19,15,2,0,3,0,0,0,0,0,0),(74,3,13,'Eddie Hobson',2,1,7,6,8,0,3,0,0,0,0,0,0),(75,3,14,'Emily Smithies',10,14,8,9,20,0,3,0,0,0,0,0,0),(76,3,15,'Harry Coughlin',9,10,1,17,6,0,3,0,0,0,0,0,0),(77,3,16,'Jed Bartley',14,7,3,18,12,0,3,0,0,0,0,0,0),(78,3,17,'Jim Forsyth',5,8,19,13,9,0,3,0,0,0,0,0,0),(79,3,19,'Judy Kirk',4,18,7,2,6,0,3,0,0,0,0,0,0),(80,3,18,'Julia Hodges',16,12,11,9,5,0,3,0,0,0,0,0,0),(81,3,22,'Maureen Hobson',13,12,17,10,5,0,3,0,0,0,0,0,0),(82,3,21,'Mike Hird',6,4,5,9,13,0,3,0,0,0,0,0,0),(83,3,20,'Molly Higginson',10,2,20,9,5,0,3,0,0,0,0,0,0),(84,3,23,'Nicky Higginson',11,4,7,14,3,0,3,0,0,0,0,0,0),(85,3,24,'Paul Evans',19,8,3,15,2,0,3,0,0,0,0,0,0),(86,3,25,'Paul Hodges',19,6,8,13,17,0,3,0,0,0,0,0,0),(87,3,26,'Rob Bailey',10,5,20,9,14,0,3,0,0,0,0,0,0),(88,3,27,'Ryan Bailey',11,6,3,18,5,0,3,0,0,0,0,0,0),(89,3,28,'Sharon Cole',19,18,8,14,2,0,3,0,0,0,0,0,0),(90,3,29,'Steve Price',16,14,19,5,17,0,3,0,0,0,0,0,0),(91,3,30,'Tim Cole',4,1,17,5,20,0,3,0,0,0,0,0,0),(92,3,31,'Vanessa Bradshaw',20,7,19,1,14,0,3,0,0,0,0,0,0),(93,3,32,'Will Islip',7,5,3,1,18,0,3,0,0,0,0,0,0),(94,4,5,'Allan Scrafton',10,6,15,7,12,0,4,0,0,0,0,0,0),(95,4,3,'Andrew Higginson',8,13,1,6,20,0,4,0,0,0,0,0,0),(96,4,2,'Andy Forbes',10,16,12,6,14,0,4,0,0,0,0,0,0),(97,4,4,'Ashley Hodges',10,4,14,2,20,0,4,0,0,0,0,0,0),(98,4,6,'Brian Cunningham',9,8,14,2,20,0,4,0,0,0,0,0,0),(99,4,8,'Carl Stenton',15,2,16,19,8,0,4,0,0,0,0,0,0),(100,4,7,'Cindy Bailey',14,3,7,2,8,0,4,0,0,0,0,0,0),(101,4,9,'Dan Bailey',11,10,1,6,18,0,4,0,0,0,0,0,0),(102,4,12,'Dave Johnson',14,5,6,17,19,0,4,0,0,0,0,0,0),(103,4,11,'David Higginson',17,18,8,5,14,0,4,0,0,0,0,0,0),(104,4,10,'Dominic Bradshaw',20,14,19,15,2,0,4,0,0,0,0,0,0),(105,4,13,'Eddie Hobson',2,1,7,6,8,0,4,0,0,0,0,0,0),(106,4,14,'Emily Smithies',10,14,8,9,20,0,4,0,0,0,0,0,0),(107,4,15,'Harry Coughlin',9,10,1,17,6,0,4,0,0,0,0,0,0),(108,4,16,'Jed Bartley',14,7,3,18,12,0,4,0,0,0,0,0,0),(109,4,17,'Jim Forsyth',5,8,19,13,9,0,4,0,0,0,0,0,0),(110,4,19,'Judy Kirk',4,18,7,2,6,0,4,0,0,0,0,0,0),(111,4,18,'Julia Hodges',16,12,11,9,5,0,4,0,0,0,0,0,0),(112,4,22,'Maureen Hobson',13,12,17,10,5,0,4,0,0,0,0,0,0),(113,4,21,'Mike Hird',6,4,5,9,13,0,4,0,0,0,0,0,0),(114,4,20,'Molly Higginson',10,2,20,9,5,0,4,0,0,0,0,0,0),(115,4,23,'Nicky Higginson',11,4,7,14,3,0,4,0,0,0,0,0,0),(116,4,24,'Paul Evans',19,8,3,15,2,0,4,0,0,0,0,0,0),(117,4,25,'Paul Hodges',19,6,8,13,17,0,4,0,0,0,0,0,0),(118,4,26,'Rob Bailey',10,5,20,9,14,0,4,0,0,0,0,0,0),(119,4,27,'Ryan Bailey',11,6,3,18,5,0,4,0,0,0,0,0,0),(120,4,28,'Sharon Cole',19,18,8,14,2,0,4,0,0,0,0,0,0),(121,4,29,'Steve Price',16,14,19,5,17,0,4,0,0,0,0,0,0),(122,4,30,'Tim Cole',4,1,17,5,20,0,4,0,0,0,0,0,0),(123,4,31,'Vanessa Bradshaw',20,7,19,1,14,0,4,0,0,0,0,0,0),(124,4,32,'Will Islip',7,5,3,1,18,0,4,0,0,0,0,0,0),(125,5,5,'Allan Scrafton',10,6,15,7,12,0,5,0,0,0,0,0,0),(126,5,3,'Andrew Higginson',8,13,1,6,20,0,5,0,0,0,0,0,0),(127,5,2,'Andy Forbes',10,16,12,6,14,0,5,0,0,0,0,0,0),(128,5,4,'Ashley Hodges',10,4,14,2,20,0,5,0,0,0,0,0,0),(129,5,6,'Brian Cunningham',9,8,14,2,20,0,5,0,0,0,0,0,0),(130,5,8,'Carl Stenton',15,2,16,19,8,0,5,0,0,0,0,0,0),(131,5,7,'Cindy Bailey',14,3,7,2,8,0,5,0,0,0,0,0,0),(132,5,9,'Dan Bailey',11,10,1,6,18,0,5,0,0,0,0,0,0),(133,5,12,'Dave Johnson',14,5,6,17,19,0,5,0,0,0,0,0,0),(134,5,11,'David Higginson',17,18,8,5,14,0,5,0,0,0,0,0,0),(135,5,10,'Dominic Bradshaw',20,14,19,15,2,0,5,0,0,0,0,0,0),(136,5,13,'Eddie Hobson',2,1,7,6,8,0,5,0,0,0,0,0,0),(137,5,14,'Emily Smithies',10,14,8,9,20,0,5,0,0,0,0,0,0),(138,5,15,'Harry Coughlin',9,10,1,17,6,0,5,0,0,0,0,0,0),(139,5,16,'Jed Bartley',14,7,3,18,12,0,5,0,0,0,0,0,0),(140,5,17,'Jim Forsyth',5,8,19,13,9,0,5,0,0,0,0,0,0),(141,5,19,'Judy Kirk',4,18,7,2,6,0,5,0,0,0,0,0,0),(142,5,18,'Julia Hodges',16,12,11,9,5,0,5,0,0,0,0,0,0),(143,5,22,'Maureen Hobson',13,12,17,10,5,0,5,0,0,0,0,0,0),(144,5,21,'Mike Hird',6,4,5,9,13,0,5,0,0,0,0,0,0),(145,5,20,'Molly Higginson',10,2,20,9,5,0,5,0,0,0,0,0,0),(146,5,23,'Nicky Higginson',11,4,7,14,3,0,5,0,0,0,0,0,0),(147,5,24,'Paul Evans',19,8,3,15,2,0,5,0,0,0,0,0,0),(148,5,25,'Paul Hodges',19,6,8,13,17,0,5,0,0,0,0,0,0),(149,5,26,'Rob Bailey',10,5,20,9,14,0,5,0,0,0,0,0,0),(150,5,27,'Ryan Bailey',11,6,3,18,5,0,5,0,0,0,0,0,0),(151,5,28,'Sharon Cole',19,18,8,14,2,0,5,0,0,0,0,0,0),(152,5,29,'Steve Price',16,14,19,5,17,0,5,0,0,0,0,0,0),(153,5,30,'Tim Cole',4,1,17,5,20,0,5,0,0,0,0,0,0),(154,5,31,'Vanessa Bradshaw',20,7,19,1,14,0,5,0,0,0,0,0,0),(155,5,32,'Will Islip',7,5,3,1,18,0,5,0,0,0,0,0,0),(156,6,5,'Allan Scrafton',10,6,15,7,12,0,6,0,0,0,0,0,0),(157,6,3,'Andrew Higginson',8,13,1,6,20,0,6,0,0,0,0,0,0),(158,6,2,'Andy Forbes',10,16,12,6,14,0,6,0,0,0,0,0,0),(159,6,4,'Ashley Hodges',10,4,14,2,20,0,6,0,0,0,0,0,0),(160,6,6,'Brian Cunningham',9,8,14,2,20,0,6,0,0,0,0,0,0),(161,6,8,'Carl Stenton',15,2,16,19,8,0,6,0,0,0,0,0,0),(162,6,7,'Cindy Bailey',14,3,7,2,8,0,6,0,0,0,0,0,0),(163,6,9,'Dan Bailey',11,10,1,6,18,0,6,0,0,0,0,0,0),(164,6,12,'Dave Johnson',14,5,6,17,19,0,6,0,0,0,0,0,0),(165,6,11,'David Higginson',17,18,8,5,14,0,6,0,0,0,0,0,0),(166,6,10,'Dominic Bradshaw',20,14,19,15,2,0,6,0,0,0,0,0,0),(167,6,13,'Eddie Hobson',2,1,7,6,8,0,6,0,0,0,0,0,0),(168,6,14,'Emily Smithies',10,14,8,9,20,0,6,0,0,0,0,0,0),(169,6,15,'Harry Coughlin',9,10,1,17,6,0,6,0,0,0,0,0,0),(170,6,16,'Jed Bartley',14,7,3,18,12,0,6,0,0,0,0,0,0),(171,6,17,'Jim Forsyth',5,8,19,13,9,0,6,0,0,0,0,0,0),(172,6,19,'Judy Kirk',4,18,7,2,6,0,6,0,0,0,0,0,0),(173,6,18,'Julia Hodges',16,12,11,9,5,0,6,0,0,0,0,0,0),(174,6,22,'Maureen Hobson',13,12,17,10,5,0,6,0,0,0,0,0,0),(175,6,21,'Mike Hird',6,4,5,9,13,0,6,0,0,0,0,0,0),(176,6,20,'Molly Higginson',10,2,20,9,5,0,6,0,0,0,0,0,0),(177,6,23,'Nicky Higginson',11,4,7,14,3,0,6,0,0,0,0,0,0),(178,6,24,'Paul Evans',19,8,3,15,2,0,6,0,0,0,0,0,0),(179,6,25,'Paul Hodges',19,6,8,13,17,0,6,0,0,0,0,0,0),(180,6,26,'Rob Bailey',10,5,20,9,14,0,6,0,0,0,0,0,0),(181,6,27,'Ryan Bailey',11,6,3,18,5,0,6,0,0,0,0,0,0),(182,6,28,'Sharon Cole',19,18,8,14,2,0,6,0,0,0,0,0,0),(183,6,29,'Steve Price',16,14,19,5,17,0,6,0,0,0,0,0,0),(184,6,30,'Tim Cole',4,1,17,5,20,0,6,0,0,0,0,0,0),(185,6,31,'Vanessa Bradshaw',20,7,19,1,14,0,6,0,0,0,0,0,0),(186,6,32,'Will Islip',7,5,3,1,18,0,6,0,0,0,0,0,0),(187,7,5,'Allan Scrafton',10,6,15,7,12,0,7,0,0,0,0,0,0),(188,7,3,'Andrew Higginson',8,13,1,6,20,0,7,0,0,0,0,0,0),(189,7,2,'Andy Forbes',10,16,12,6,14,0,7,0,0,0,0,0,0),(190,7,4,'Ashley Hodges',10,4,14,2,20,0,7,0,0,0,0,0,0),(191,7,6,'Brian Cunningham',9,8,14,2,20,0,7,0,0,0,0,0,0),(192,7,8,'Carl Stenton',15,2,16,19,8,0,7,0,0,0,0,0,0),(193,7,7,'Cindy Bailey',14,3,7,2,8,0,7,0,0,0,0,0,0),(194,7,9,'Dan Bailey',11,10,1,6,18,0,7,0,0,0,0,0,0),(195,7,12,'Dave Johnson',14,5,6,17,19,0,7,0,0,0,0,0,0),(196,7,11,'David Higginson',17,18,8,5,14,0,7,0,0,0,0,0,0),(197,7,10,'Dominic Bradshaw',20,14,19,15,2,0,7,0,0,0,0,0,0),(198,7,13,'Eddie Hobson',2,1,7,6,8,0,7,0,0,0,0,0,0),(199,7,14,'Emily Smithies',10,14,8,9,20,0,7,0,0,0,0,0,0),(200,7,15,'Harry Coughlin',9,10,1,17,6,0,7,0,0,0,0,0,0),(201,7,16,'Jed Bartley',14,7,3,18,12,0,7,0,0,0,0,0,0),(202,7,17,'Jim Forsyth',5,8,19,13,9,0,7,0,0,0,0,0,0),(203,7,19,'Judy Kirk',4,18,7,2,6,0,7,0,0,0,0,0,0),(204,7,18,'Julia Hodges',16,12,11,9,5,0,7,0,0,0,0,0,0),(205,7,22,'Maureen Hobson',13,12,17,10,5,0,7,0,0,0,0,0,0),(206,7,21,'Mike Hird',6,4,5,9,13,0,7,0,0,0,0,0,0),(207,7,20,'Molly Higginson',10,2,20,9,5,0,7,0,0,0,0,0,0),(208,7,23,'Nicky Higginson',11,4,7,14,3,0,7,0,0,0,0,0,0),(209,7,24,'Paul Evans',19,8,3,15,2,0,7,0,0,0,0,0,0),(210,7,25,'Paul Hodges',19,6,8,13,17,0,7,0,0,0,0,0,0),(211,7,26,'Rob Bailey',10,5,20,9,14,0,7,0,0,0,0,0,0),(212,7,27,'Ryan Bailey',11,6,3,18,5,0,7,0,0,0,0,0,0),(213,7,28,'Sharon Cole',19,18,8,14,2,0,7,0,0,0,0,0,0),(214,7,29,'Steve Price',16,14,19,5,17,0,7,0,0,0,0,0,0),(215,7,30,'Tim Cole',4,1,17,5,20,0,7,0,0,0,0,0,0),(216,7,31,'Vanessa Bradshaw',20,7,19,1,14,0,7,0,0,0,0,0,0),(217,7,32,'Will Islip',7,5,3,1,18,0,7,0,0,0,0,0,0);
/*!40000 ALTER TABLE `entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixtures`
--

DROP TABLE IF EXISTS `fixtures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(45) NOT NULL,
  `team_a_id` int(11) NOT NULL,
  `team_a_score` int(11) NOT NULL DEFAULT '0',
  `team_b_score` int(11) NOT NULL DEFAULT '0',
  `team_b_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `txn_code_UNIQUE` (`id`),
  KEY `FIXTURE_TOURNAMENT_idx` (`tournament_id`),
  KEY `date_idx` (`date`),
  CONSTRAINT `FIXTURE_TOURNAMENT` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixtures`
--

LOCK TABLES `fixtures` WRITE;
/*!40000 ALTER TABLE `fixtures` DISABLE KEYS */;
INSERT INTO `fixtures` VALUES (1,1,'2016-10-01 12:30:00','October Fixtures',16,1,2,9,2),(2,1,'2016-10-01 15:00:00','October Fixtures',7,0,2,4,2),(3,1,'2016-10-01 15:00:00','October Fixtures',15,1,1,19,2),(4,1,'2016-10-01 15:00:00','October Fixtures',18,2,2,2,2),(5,1,'2016-10-01 15:00:00','October Fixtures',20,1,1,12,2),(6,1,'2016-10-02 12:00:00','October Fixtures',11,1,1,14,2),(7,1,'2016-10-02 14:15:00','October Fixtures',8,0,0,13,2),(8,1,'2016-10-02 14:15:00','October Fixtures',17,2,0,10,2),(9,1,'2016-10-02 16:30:00','October Fixtures',3,0,1,1,2),(10,1,'2016-10-15 12:30:00','October Fixtures',12,0,1,18,2),(11,1,'2016-10-15 15:00:00','October Fixtures',1,3,2,16,2),(12,1,'2016-10-15 15:00:00','October Fixtures',2,6,1,7,2),(13,1,'2016-10-15 15:00:00','October Fixtures',10,1,1,6,2),(14,1,'2016-10-15 15:00:00','October Fixtures',14,2,0,15,2),(15,1,'2016-10-15 15:00:00','October Fixtures',19,1,1,17,2),(16,1,'2016-10-15 17:30:00','October Fixtures',5,0,1,20,2),(17,1,'2016-10-16 13:30:00','October Fixtures',4,3,0,8,2),(18,1,'2016-10-16 16:00:00','October Fixtures',13,3,1,3,2),(19,1,'2016-10-17 20:00:00','October Fixtures',9,0,0,11,2),(20,1,'2016-10-22 12:30:00','October Fixtures',2,0,0,17,2),(21,1,'2016-10-22 15:00:00','October Fixtures',1,0,0,12,2),(22,1,'2016-10-22 15:00:00','October Fixtures',3,2,1,6,2),(23,1,'2016-10-22 15:00:00','October Fixtures',7,0,2,14,2),(24,1,'2016-10-22 15:00:00','October Fixtures',8,3,1,5,2),(25,1,'2016-10-22 15:00:00','October Fixtures',16,0,0,18,2),(26,1,'2016-10-22 15:00:00','October Fixtures',20,1,0,15,2),(27,1,'2016-10-22 17:30:00','October Fixtures',9,2,1,19,2),(28,1,'2016-10-23 13:30:00','October Fixtures',10,1,1,13,2),(29,1,'2016-10-23 16:00:00','October Fixtures',4,4,0,11,2),(30,1,'2016-10-29 12:30:00','October Fixtures',15,1,4,1,2),(31,1,'2016-10-29 15:00:00','October Fixtures',11,0,0,3,2),(32,1,'2016-10-29 15:00:00','October Fixtures',12,2,0,2,2),(33,1,'2016-10-29 15:00:00','October Fixtures',17,1,1,8,2),(34,1,'2016-10-29 15:00:00','October Fixtures',18,1,0,7,2),(35,1,'2016-10-29 15:00:00','October Fixtures',19,0,4,10,2),(36,1,'2016-10-29 17:30:00','October Fixtures',5,2,4,9,2),(37,1,'2016-10-30 13:30:00','October Fixtures',6,2,0,20,2),(38,1,'2016-10-30 16:00:00','October Fixtures',13,0,2,4,2),(39,1,'2016-10-31 20:00:00','October Fixtures',14,3,1,16,2),(40,2,'2016-11-05 15:00:00','November Fixtures',2,0,0,15,0),(41,2,'2016-11-05 15:00:00','November Fixtures',3,0,0,5,0),(42,2,'2016-11-05 15:00:00','November Fixtures',10,0,0,12,0),(43,2,'2016-11-05 15:00:00','November Fixtures',20,0,0,14,0),(44,2,'2016-11-05 17:30:00','November Fixtures',4,0,0,6,0),(45,2,'2016-11-06 12:00:00','November Fixtures',1,0,0,17,0),(46,2,'2016-11-06 14:15:00','November Fixtures',7,0,0,13,0),(47,2,'2016-11-06 14:15:00','November Fixtures',9,0,0,18,0),(48,2,'2016-11-06 15:00:00','November Fixtures',16,0,0,11,0),(49,2,'2016-11-06 16:30:00','November Fixtures',8,0,0,19,0),(50,2,'2016-11-19 12:30:00','November Fixtures',11,0,0,1,0),(51,2,'2016-11-19 15:00:00','November Fixtures',5,0,0,10,0),(52,2,'2016-11-19 15:00:00','November Fixtures',6,0,0,16,0),(53,2,'2016-11-19 15:00:00','November Fixtures',13,0,0,9,0),(54,2,'2016-11-19 15:00:00','November Fixtures',14,0,0,2,0),(55,2,'2016-11-19 15:00:00','November Fixtures',15,0,0,7,0),(56,2,'2016-11-19 15:00:00','November Fixtures',18,0,0,8,0),(57,2,'2016-11-19 17:30:00','November Fixtures',17,0,0,20,0),(58,2,'2016-11-20 16:00:00','November Fixtures',12,0,0,4,0),(59,2,'2016-11-21 20:00:00','November Fixtures',19,0,0,3,0),(60,2,'2016-11-26 12:30:00','November Fixtures',3,0,0,10,0),(61,2,'2016-11-26 15:00:00','November Fixtures',7,0,0,19,0),(62,2,'2016-11-26 15:00:00','November Fixtures',8,0,0,12,0),(63,2,'2016-11-26 15:00:00','November Fixtures',9,0,0,15,0),(64,2,'2016-11-26 15:00:00','November Fixtures',16,0,0,5,0),(65,2,'2016-11-26 17:30:00','November Fixtures',4,0,0,17,0),(66,2,'2016-11-27 12:00:00','November Fixtures',18,0,0,14,0),(67,2,'2016-11-27 14:15:00','November Fixtures',1,0,0,2,0),(68,2,'2016-11-27 16:30:00','November Fixtures',11,0,0,20,0),(69,2,'2016-11-27 16:30:00','November Fixtures',13,0,0,6,0),(70,3,'2016-12-03 15:00:00','December Fixtures',2,0,0,9,0),(71,3,'2016-12-03 15:00:00','December Fixtures',5,0,0,13,0),(72,3,'2016-12-03 15:00:00','December Fixtures',6,0,0,11,0),(73,3,'2016-12-03 15:00:00','December Fixtures',10,0,0,4,0),(74,3,'2016-12-03 15:00:00','December Fixtures',12,0,0,7,0),(75,3,'2016-12-03 15:00:00','December Fixtures',14,0,0,3,0),(76,3,'2016-12-03 15:00:00','December Fixtures',15,0,0,8,0),(77,3,'2016-12-03 15:00:00','December Fixtures',17,0,0,16,0),(78,3,'2016-12-03 15:00:00','December Fixtures',19,0,0,18,0),(79,3,'2016-12-03 15:00:00','December Fixtures',20,0,0,1,0),(80,3,'2016-12-10 15:00:00','December Fixtures',1,0,0,14,0),(81,3,'2016-12-10 15:00:00','December Fixtures',3,0,0,2,0),(82,3,'2016-12-10 15:00:00','December Fixtures',4,0,0,19,0),(83,3,'2016-12-10 15:00:00','December Fixtures',7,0,0,5,0),(84,3,'2016-12-10 15:00:00','December Fixtures',8,0,0,10,0),(85,3,'2016-12-10 15:00:00','December Fixtures',9,0,0,20,0),(86,3,'2016-12-10 15:00:00','December Fixtures',16,0,0,15,0),(87,3,'2016-12-10 15:00:00','December Fixtures',18,0,0,6,0),(88,3,'2016-12-11 15:00:00','December Fixtures',11,0,0,17,0),(89,3,'2016-12-11 15:00:00','December Fixtures',13,0,0,12,0),(90,3,'2016-12-13 19:45:00','December Fixtures',2,0,0,8,0),(91,3,'2016-12-13 19:45:00','December Fixtures',15,0,0,4,0),(92,3,'2016-12-13 19:45:00','December Fixtures',20,0,0,3,0),(93,3,'2016-12-13 20:00:00','December Fixtures',19,0,0,16,0),(94,3,'2016-12-14 19:45:00','December Fixtures',6,0,0,1,0),(95,3,'2016-12-14 19:45:00','December Fixtures',12,0,0,9,0),(96,3,'2016-12-14 20:00:00','December Fixtures',5,0,0,11,0),(97,3,'2016-12-14 20:00:00','December Fixtures',10,0,0,18,0),(98,3,'2016-12-14 20:00:00','December Fixtures',14,0,0,13,0),(99,3,'2016-12-14 20:00:00','December Fixtures',17,0,0,7,0),(100,3,'2016-12-17 15:00:00','December Fixtures',2,0,0,13,0),(101,3,'2016-12-17 15:00:00','December Fixtures',5,0,0,4,0),(102,3,'2016-12-17 15:00:00','December Fixtures',6,0,0,9,0),(103,3,'2016-12-17 15:00:00','December Fixtures',10,0,0,1,0),(104,3,'2016-12-17 15:00:00','December Fixtures',12,0,0,16,0),(105,3,'2016-12-17 15:00:00','December Fixtures',14,0,0,8,0),(106,3,'2016-12-17 15:00:00','December Fixtures',15,0,0,18,0),(107,3,'2016-12-17 15:00:00','December Fixtures',17,0,0,3,0),(108,3,'2016-12-17 15:00:00','December Fixtures',19,0,0,11,0),(109,3,'2016-12-17 15:00:00','December Fixtures',20,0,0,7,0),(110,3,'2016-12-26 15:00:00','December Fixtures',1,0,0,19,0),(111,3,'2016-12-26 15:00:00','December Fixtures',3,0,0,12,0),(112,3,'2016-12-26 15:00:00','December Fixtures',4,0,0,2,0),(113,3,'2016-12-26 15:00:00','December Fixtures',7,0,0,10,0),(114,3,'2016-12-26 15:00:00','December Fixtures',8,0,0,6,0),(115,3,'2016-12-26 15:00:00','December Fixtures',9,0,0,14,0),(116,3,'2016-12-26 15:00:00','December Fixtures',11,0,0,15,0),(117,3,'2016-12-26 15:00:00','December Fixtures',13,0,0,17,0),(118,3,'2016-12-26 15:00:00','December Fixtures',16,0,0,20,0),(119,3,'2016-12-26 15:00:00','December Fixtures',18,0,0,5,0),(120,3,'2016-12-31 15:00:00','December Fixtures',1,0,0,5,0),(121,3,'2016-12-31 15:00:00','December Fixtures',3,0,0,15,0),(122,3,'2016-12-31 15:00:00','December Fixtures',4,0,0,14,0),(123,3,'2016-12-31 15:00:00','December Fixtures',7,0,0,6,0),(124,3,'2016-12-31 15:00:00','December Fixtures',8,0,0,20,0),(125,3,'2016-12-31 15:00:00','December Fixtures',9,0,0,10,0),(126,3,'2016-12-31 15:00:00','December Fixtures',11,0,0,12,0),(127,3,'2016-12-31 15:00:00','December Fixtures',13,0,0,19,0),(128,3,'2016-12-31 15:00:00','December Fixtures',16,0,0,2,0),(129,3,'2016-12-31 15:00:00','December Fixtures',18,0,0,17,0),(130,4,'2017-01-02 15:00:00','January Fixtures',2,0,0,1,0),(131,4,'2017-01-02 15:00:00','January Fixtures',5,0,0,16,0),(132,4,'2017-01-02 15:00:00','January Fixtures',6,0,0,13,0),(133,4,'2017-01-02 15:00:00','January Fixtures',10,0,0,3,0),(134,4,'2017-01-02 15:00:00','January Fixtures',12,0,0,8,0),(135,4,'2017-01-02 15:00:00','January Fixtures',14,0,0,18,0),(136,4,'2017-01-02 15:00:00','January Fixtures',15,0,0,9,0),(137,4,'2017-01-02 15:00:00','January Fixtures',17,0,0,4,0),(138,4,'2017-01-02 15:00:00','January Fixtures',19,0,0,7,0),(139,4,'2017-01-02 15:00:00','January Fixtures',20,0,0,11,0),(140,4,'2017-01-14 15:00:00','January Fixtures',3,0,0,13,0),(141,4,'2017-01-14 15:00:00','January Fixtures',6,0,0,10,0),(142,4,'2017-01-14 15:00:00','January Fixtures',7,0,0,2,0),(143,4,'2017-01-14 15:00:00','January Fixtures',8,0,0,4,0),(144,4,'2017-01-14 15:00:00','January Fixtures',11,0,0,9,0),(145,4,'2017-01-14 15:00:00','January Fixtures',15,0,0,14,0),(146,4,'2017-01-14 15:00:00','January Fixtures',16,0,0,1,0),(147,4,'2017-01-14 15:00:00','January Fixtures',17,0,0,19,0),(148,4,'2017-01-14 15:00:00','January Fixtures',18,0,0,12,0),(149,4,'2017-01-14 15:00:00','January Fixtures',20,0,0,5,0),(150,4,'2017-01-21 15:00:00','January Fixtures',1,0,0,3,0),(151,4,'2017-01-21 15:00:00','January Fixtures',2,0,0,18,0),(152,4,'2017-01-21 15:00:00','January Fixtures',4,0,0,7,0),(153,4,'2017-01-21 15:00:00','January Fixtures',5,0,0,6,0),(154,4,'2017-01-21 15:00:00','January Fixtures',9,0,0,16,0),(155,4,'2017-01-21 15:00:00','January Fixtures',10,0,0,17,0),(156,4,'2017-01-21 15:00:00','January Fixtures',12,0,0,20,0),(157,4,'2017-01-21 15:00:00','January Fixtures',13,0,0,8,0),(158,4,'2017-01-21 15:00:00','January Fixtures',14,0,0,11,0),(159,4,'2017-01-21 15:00:00','January Fixtures',19,0,0,15,0);
/*!40000 ALTER TABLE `fixtures` ENABLE KEYS */;
UNLOCK TABLES;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (0,'Not started'),(1,'In Progress'),(2,'Full Time'),(10,'Finished');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Arsenal'),(2,'Bournemouth'),(3,'Burnley'),(4,'Chelsea'),(5,'Crystal Palace'),(6,'Everton'),(7,'Hull City'),(8,'Leicester City'),(9,'Liverpool'),(10,'Manchester City'),(11,'Manchester United'),(12,'Middlesbrough'),(13,'Southampton'),(14,'Stoke City'),(15,'Sunderland'),(16,'Swansea City'),(17,'Tottenham Hotspur'),(18,'Watford'),(19,'West Bromwich Albion'),(20,'West Ham United');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams_tournaments`
--

DROP TABLE IF EXISTS `teams_tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams_tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `tournament_team_idx` (`tournament_id`,`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams_tournaments`
--

LOCK TABLES `teams_tournaments` WRITE;
/*!40000 ALTER TABLE `teams_tournaments` DISABLE KEYS */;
INSERT INTO `teams_tournaments` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,1,11),(12,1,12),(13,1,13),(14,1,14),(15,1,15),(16,1,16),(17,1,17),(18,1,18),(19,1,19),(20,1,20),(21,2,1),(22,2,2),(23,2,3),(24,2,4),(25,2,5),(26,2,6),(27,2,7),(28,2,8),(29,2,9),(30,2,10),(31,2,11),(32,2,12),(33,2,13),(34,2,14),(35,2,15),(36,2,16),(37,2,17),(38,2,18),(39,2,19),(40,2,20),(41,3,1),(42,3,2),(43,3,3),(44,3,4),(45,3,5),(46,3,6),(47,3,7),(48,3,8),(49,3,9),(50,3,10),(51,3,11),(52,3,12),(53,3,13),(54,3,14),(55,3,15),(56,3,16),(57,3,17),(58,3,18),(59,3,19),(60,3,20),(61,4,1),(62,4,2),(63,4,3),(64,4,4),(65,4,5),(66,4,6),(67,4,7),(68,4,8),(69,4,9),(70,4,10),(71,4,11),(72,4,12),(73,4,13),(74,4,14),(75,4,15),(76,4,16),(77,4,17),(78,4,18),(79,4,19),(80,4,20),(81,5,1),(82,5,2),(83,5,3),(84,5,4),(85,5,5),(86,5,6),(87,5,7),(88,5,8),(89,5,9),(90,5,10),(91,5,11),(92,5,12),(93,5,13),(94,5,14),(95,5,15),(96,5,16),(97,5,17),(98,5,18),(99,5,19),(100,5,20),(101,6,1),(102,6,2),(103,6,3),(104,6,4),(105,6,5),(106,6,6),(107,6,7),(108,6,8),(109,6,9),(110,6,10),(111,6,11),(112,6,12),(113,6,13),(114,6,14),(115,6,15),(116,6,16),(117,6,17),(118,6,18),(119,6,19),(120,6,20),(121,7,1),(122,7,2),(123,7,3),(124,7,4),(125,7,5),(126,7,6),(127,7,7),(128,7,8),(129,7,9),(130,7,10),(131,7,11),(132,7,12),(133,7,13),(134,7,14),(135,7,15),(136,7,16),(137,7,17),(138,7,18),(139,7,19),(140,7,20);
/*!40000 ALTER TABLE `teams_tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (1,'English Premier League - October 2016'),(2,'English Premier League - November 2016'),(3,'English Premier League - December 2016'),(4,'English Premier League - January 2017'),(5,'English Premier League - February 2017'),(6,'English Premier League - March 2017'),(7,'English Premier League - April 2017');
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'<none>','','none@none.com','punter','',''),(2,'aforbes','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','aforbes@junk.com','punter','Andy','Forbes'),(3,'ahigginson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','ahigginson@junk.com','punter','Andrew','Higginson'),(4,'ahodges','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','ahodges@junk.com','punter','Ashley','Hodges'),(5,'ascrafton','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','ascrafton@junk.com','punter','Allan','Scrafton'),(6,'bcunningham','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','bcunningham@junk.com','punter','Brian','Cunningham'),(7,'cbailey','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','cbailey@junk.com','punter','Cindy','Bailey'),(8,'cstenton','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','cstenton@junk.com','punter','Carl','Stenton'),(9,'dbailey','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','dbailey@junk.com','punter','Dan','Bailey'),(10,'dbradshaw','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','dbradshaw@junk.com','punter','Dominic','Bradshaw'),(11,'dhigginson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','dhigginson@junk.com','punter','David','Higginson'),(12,'djohnson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','djohnson@junk.com','punter','Dave','Johnson'),(13,'ehobson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','ehobson@junk.com','punter','Eddie','Hobson'),(14,'esmithies','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','esmithies@junk.com','punter','Emily','Smithies'),(15,'hcoughlin','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','hcoughlin@junk.com','punter','Harry','Coughlin'),(16,'jbartley','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','jbartley@junk.com','punter','Jed','Bartley'),(17,'jforsyth','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','jforsyth@junk.com','punter','Jim','Forsyth'),(18,'jhodges','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','jhodges@junk.com','punter','Julia','Hodges'),(19,'jkirk','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','jkirk@junk.com','punter','Judy','Kirk'),(20,'mhigginson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','mhigginson@junk.com','punter','Molly','Higginson'),(21,'mhird','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','mhird@junk.com','punter','Mike','Hird'),(22,'mhobson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','mhobson@junk.com','punter','Maureen','Hobson'),(23,'nhigginson','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','nhigginson@junk.com','punter','Nicky','Higginson'),(24,'pevans','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','pevans@gmail.com','punter','Paul','Evans'),(25,'phodges','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','phodges@junk.com','punter','Paul','Hodges'),(26,'robbailey','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','robbailey@junk.com','punter','Rob','Bailey'),(27,'ryanbailey','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','ryanbailey@junk.com','punter','Ryan','Bailey'),(28,'scole','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','scole@junk.com','punter','Sharon','Cole'),(29,'sprice','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','sprice@junk.com','punter','Steve','Price'),(30,'tcole','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','tcole@junk.com','punter','Tim','Cole'),(31,'vbradshaw','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','vbradshaw@junk.com','punter','Vanessa','Bradshaw'),(32,'wislip','d4c50859c4aaf95fde0950f39dd2a5b5b74e22d5','wislip@junk.com','punter','Will','Islip');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-26 21:24:41
