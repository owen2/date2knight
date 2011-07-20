-- MySQL dump 10.11
--
-- Host: localhost    Database: lovematch
-- ------------------------------------------------------
-- Server version	5.0.91-log

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `lefttext` text NOT NULL,
  `righttext` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'How much do you enjoy playing video games with other people?','Sounds boring.','I &hearts; LAN parties!'),(2,'Does a night at home watching movies sound like a good date?','Sounds boring.','Sounds fun and cozy!'),(3,'Are you more introverted or extroverted?','Introverted','Extroverted'),(4,'How much do you enjoy (or tolerate) smoking?','I can\'t stand smokers.','I blaze 3 packs per day.'),(5,'Do you enjoy parties that involve alcohol?','I prefer dry parties.','Liquor me up!'),(6,'Is a physical relationship important to you?','I\'m waiting for marriage.','Twice on Sundays!'),(7,'Where do you stand in politics?','Way liberal','Way conservative'),(8,'How important is personal hygiene to you?','Stinky Green','Squeaky Clean!'),(9,'Do you like to dress up and go out on the town?','I\'d rather not go outside.','Puttin\' on the Ritz.'),(10,'How much do you enjoy dancing?','Three left feet...','Let\'s take ballroom lessons!'),(11,'How important is good fashion sense to you?','Not so important','Very important'),(12,'Because pop culture demands it...','Team Edward','Team Jacob'),(13,'Sudoku puzzles are...','Confusing','Fun'),(14,'Hunting animals is...','Wrong','Fun'),(15,'What are your feelings on watching a sporting event?','Sports are dumb.','I\'m a sports nerd!'),(16,'How important to you is having the same religion?','I couldn\'t care less.','It\'s a necessity.'),(17,'Eventually, how many kids do you want to have?','Cats only, please.','About a dozen kids.'),(18,'Are you looking more for potential spouses or casual fun?','One night stand','Lifelong companion'),(19,'Do you consider yourself more romantic or level-headed?','Steadfast stoic','Hopeless romantic'),(20,'Which best describes your sleeping habits?','Early to bed, early to rise','Stay up, sleep in'),(21,'Do you consider yourself more playful or serious?','Serious','Playful'),(22,'How clean do you like to keep your room?','I think that was soup...','Spotless!'),(23,'How willing are you to share your belongings and space?','I share nothing.','I\'ll share everything.'),(24,'How comfortable are you with physical affection?','I have a big bubble.','I\'m touchy feely.'),(25,'I play my music...','...in earbuds.','...loud enough for the hall.');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
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
  PRIMARY KEY  (`username`)
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
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` text NOT NULL,
  `box` int(4) default NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `gender` varchar(1) NOT NULL,
  `seeksmale` tinyint(1) NOT NULL,
  `seeksfemale` tinyint(1) NOT NULL,
  `paid` varchar(4) NOT NULL,
  `1` tinyint(4) NOT NULL,
  `2` tinyint(4) NOT NULL,
  `3` tinyint(4) NOT NULL,
  `4` tinyint(4) NOT NULL,
  `5` tinyint(4) NOT NULL,
  `6` tinyint(4) NOT NULL,
  `7` tinyint(4) NOT NULL,
  `8` tinyint(4) NOT NULL,
  `9` tinyint(4) NOT NULL,
  `10` tinyint(4) NOT NULL,
  `11` tinyint(4) NOT NULL,
  `12` tinyint(4) NOT NULL,
  `13` tinyint(4) NOT NULL,
  `14` tinyint(4) NOT NULL,
  `15` tinyint(4) NOT NULL,
  `16` tinyint(4) NOT NULL,
  `17` tinyint(4) NOT NULL,
  `18` tinyint(4) NOT NULL,
  `19` tinyint(4) NOT NULL,
  `20` tinyint(4) NOT NULL,
  `21` tinyint(4) NOT NULL,
  `22` tinyint(4) NOT NULL,
  `23` tinyint(4) NOT NULL,
  `24` tinyint(4) NOT NULL,
  `25` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-07-16 12:14:31
