-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

DROP DATABASE IF EXISTS `battleShip`;
CREATE DATABASE `battleShip` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `battleShip`;

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player1` int(11) NOT NULL,
  `player2` int(11) NOT NULL,
  `player1_hits` int(11) NOT NULL,
  `player2_hits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player1` (`player1`),
  KEY `player2` (`player2`),
  CONSTRAINT `game_ibfk_1` FOREIGN KEY (`player1`) REFERENCES `user` (`id`),
  CONSTRAINT `game_ibfk_2` FOREIGN KEY (`player2`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2017-06-22 20:45:59
