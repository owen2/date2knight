-- MySQL dump 10.13  Distrib 5.1.53, for pc-linux-gnu (x86_64)
--
-- Host: localhost    Database: lovematch
-- ------------------------------------------------------
-- Server version	5.1.53-log

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
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `box` int(4) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` tinyint(2) DEFAULT NULL,
  `seeks` tinyint(2) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `bio` text,
  `validated` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `lefttext` text NOT NULL,
  `righttext` text NOT NULL,
  `enable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'How much do you enjoy playing video games with other people?','Sounds boring.','I &hearts; LAN parties!',1),(2,'Does a night at home watching movies sound like a good date?','Sounds boring.','Sounds fun and cozy!',1),(3,'Are you more introverted or extroverted?','Introverted','Extroverted',1),(4,'How much do you enjoy (or tolerate) smoking?','I can\'t stand smokers.','I blaze 3 packs per day.',1),(5,'Do you enjoy parties that involve alcohol?','I prefer dry parties.','Liquor me up!',1),(6,'Is a physical relationship important to you?','I\'m waiting for marriage.','Twice on Sundays!',1),(7,'Where do you stand in politics?','Way liberal','Way conservative',1),(8,'How important is personal hygiene to you?','Stinky Green','Squeaky Clean!',1),(9,'Do you like to dress up and go out on the town?','I\'d rather not go outside.','Puttin\' on the Ritz.',1),(10,'How much do you enjoy dancing?','Three left feet...','Let\'s take ballroom lessons!',1),(11,'How important is good fashion sense to you?','Not so important','Very important',1),(12,'Because pop culture demands it...','Team Edward','Team Jacob',1),(13,'Sudoku puzzles are...','Confusing','Fun',1),(14,'Hunting animals is...','Wrong','Fun',1),(15,'What are your feelings on watching a sporting event?','Sports are dumb.','I\'m a sports nerd!',1),(16,'How important to you is having the same religion?','I couldn\'t care less.','It\'s a necessity.',1),(17,'Eventually, how many kids do you want to have?','Cats only, please.','About a dozen kids.',1),(18,'Are you looking more for potential spouses or casual fun?','One night stand','Lifelong companion',1),(19,'Do you consider yourself more romantic or level-headed?','Steadfast stoic','Hopeless romantic',1),(20,'Which best describes your sleeping habits?','Early to bed, early to rise','Stay up, sleep in',1),(21,'Do you consider yourself more playful or serious?','Serious','Playful',1),(22,'How clean do you like to keep your room?','I think that was soup...','Spotless!',1),(23,'How willing are you to share your belongings and space?','I share nothing.','I\'ll share everything.',1),(24,'How comfortable are you with physical affection?','I have a big bubble.','I\'m touchy feely.',1),(25,'I play my music...','...in earbuds.','...loud enough for the hall.',1);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `queue`
--

DROP TABLE IF EXISTS `queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queue` (
  `username` varchar(50) NOT NULL,
  `token` char(32) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queue`
--

LOCK TABLES `queue` WRITE;
/*!40000 ALTER TABLE `queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `response`
--

DROP TABLE IF EXISTS `response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `response` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned DEFAULT NULL,
  `question_id` int(10) unsigned DEFAULT NULL,
  `answer` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `response`
--

LOCK TABLES `response` WRITE;
/*!40000 ALTER TABLE `response` DISABLE KEYS */;
/*!40000 ALTER TABLE `response` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-10  9:28:26
