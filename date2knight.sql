-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Host: mysql.owenjohnson.info
-- Generation Time: Sep 07, 2011 at 09:15 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `lovematch`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `box` int(4) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL COMMENT 'md5',
  `gender` tinyint(2) DEFAULT NULL,
  `seeks` tinyint(2) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `bio` text,
  `validated` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `firstname`, `lastname`, `box`, `phone`, `email`, `password`, `gender`, `seeks`, `paid`, `bio`, `validated`) VALUES
(3, 'Owen', 'Johnson', NULL, NULL, 'owen.johnson@wartburg.edu', '44c4b752aa0a5a307171d004950f111f', NULL, NULL, NULL, NULL, NULL),
(6, 'Fake', 'Guy', NULL, NULL, 'fake.guy@wartburg.edu', 'ab86a1e1ef70dff97959067b723c5c24', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `lefttext` text NOT NULL,
  `righttext` text NOT NULL,
  `enable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `text`, `lefttext`, `righttext`, `enable`) VALUES
(1, 'How much do you enjoy playing video games with other people?', 'Sounds boring.', 'I &hearts; LAN parties!', 1),
(2, 'Does a night at home watching movies sound like a good date?', 'Sounds boring.', 'Sounds fun and cozy!', 1),
(3, 'Are you more introverted or extroverted?', 'Introverted', 'Extroverted', 1),
(4, 'How much do you enjoy (or tolerate) smoking?', 'I can''t stand smokers.', 'I blaze 3 packs per day.', 1),
(5, 'Do you enjoy parties that involve alcohol?', 'I prefer dry parties.', 'Liquor me up!', 1),
(6, 'Is a physical relationship important to you?', 'I''m waiting for marriage.', 'Twice on Sundays!', 1),
(7, 'Where do you stand in politics?', 'Way liberal', 'Way conservative', 1),
(8, 'How important is personal hygiene to you?', 'Stinky Green', 'Squeaky Clean!', 1),
(9, 'Do you like to dress up and go out on the town?', 'I''d rather not go outside.', 'Puttin'' on the Ritz.', 1),
(10, 'How much do you enjoy dancing?', 'Three left feet...', 'Let''s take ballroom lessons!', 1),
(11, 'How important is good fashion sense to you?', 'Not so important', 'Very important', 1),
(12, 'Because pop culture demands it...', 'Team Edward', 'Team Jacob', 1),
(13, 'Sudoku puzzles are...', 'Confusing', 'Fun', 1),
(14, 'Hunting animals is...', 'Wrong', 'Fun', 1),
(15, 'What are your feelings on watching a sporting event?', 'Sports are dumb.', 'I''m a sports nerd!', 1),
(16, 'How important to you is having the same religion?', 'I couldn''t care less.', 'It''s a necessity.', 1),
(17, 'Eventually, how many kids do you want to have?', 'Cats only, please.', 'About a dozen kids.', 1),
(18, 'Are you looking more for potential spouses or casual fun?', 'One night stand', 'Lifelong companion', 1),
(19, 'Do you consider yourself more romantic or level-headed?', 'Steadfast stoic', 'Hopeless romantic', 1),
(20, 'Which best describes your sleeping habits?', 'Early to bed, early to rise', 'Stay up, sleep in', 1),
(21, 'Do you consider yourself more playful or serious?', 'Serious', 'Playful', 1),
(22, 'How clean do you like to keep your room?', 'I think that was soup...', 'Spotless!', 1),
(23, 'How willing are you to share your belongings and space?', 'I share nothing.', 'I''ll share everything.', 1),
(24, 'How comfortable are you with physical affection?', 'I have a big bubble.', 'I''m touchy feely.', 1),
(25, 'I play my music...', '...in earbuds.', '...loud enough for the hall.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `username` varchar(50) NOT NULL,
  `token` char(32) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queue`
--


-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE IF NOT EXISTS `response` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned DEFAULT NULL,
  `question_id` int(10) unsigned DEFAULT NULL,
  `answer` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `response`
--


