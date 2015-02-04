# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.61)
# Database: teste
# Generation Time: 2015-01-21 21:27:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table rel_movies_actors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rel_movies_actors`;

CREATE TABLE `rel_movies_actors` (
  `movie_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table tab_actors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tab_actors`;

CREATE TABLE `tab_actors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `foto_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table tab_directors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tab_directors`;

CREATE TABLE `tab_directors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tab_directors` WRITE;
/*!40000 ALTER TABLE `tab_directors` DISABLE KEYS */;

INSERT INTO `tab_directors` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Quentin Tarantino','2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(2,'Steven Spielberg','2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(3,'Robert Zemeckis','2013-10-08 18:09:27','2013-10-08 18:09:27');

/*!40000 ALTER TABLE `tab_directors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tab_movies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tab_movies`;

CREATE TABLE `tab_movies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tab_movies` WRITE;
/*!40000 ALTER TABLE `tab_movies` DISABLE KEYS */;

INSERT INTO `tab_movies` (`id`, `name`, `year`, `director_id`, `created_at`, `updated_at`)
VALUES
	(1,'Kill Bill',2004,1,'2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(2,'Pulp Fiction',1994,1,'2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(3,'Inglorious Bastards',2009,1,'2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(4,'Jurassic Park',1993,2,'2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(5,'E.T.',1982,2,'2013-10-08 18:09:27','2013-10-08 18:09:27'),
	(6,'Back to the Future',1985,3,'2013-10-08 18:09:27','2013-10-08 18:09:27');

/*!40000 ALTER TABLE `tab_movies` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
