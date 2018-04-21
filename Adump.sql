/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 5.7.21 : Database - agenda
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`agenda` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `agenda`;

/*Table structure for table `pessoa` */

DROP TABLE IF EXISTS `pessoa`;

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Data for the table `pessoa` */

insert  into `pessoa`(`id`,`nome`,`apelido`,`email`) values 
(37,'sdsd','add','ada'),
(38,'sdsd','adddd','ada'),
(39,'qqwq','wqe','wqew'),
(40,'qqwq','wqe2','wqew'),
(41,'qqwq','naofunca','wqew'),
(42,'qqwq','naofunca2','wqew'),
(43,'23','dd','dsa'),
(44,'tche','the','sad'),
(45,'tche','thes','sad'),
(46,'sc','sc','sc'),
(47,'sc','sc','sc2');

/*Table structure for table `telefones` */

DROP TABLE IF EXISTS `telefones`;

CREATE TABLE `telefones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) DEFAULT NULL,
  `pessoa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pk_pessoa_telefone` (`pessoa`),
  CONSTRAINT `pk_pessoa_telefone` FOREIGN KEY (`pessoa`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Data for the table `telefones` */

insert  into `telefones`(`id`,`numero`,`pessoa`) values 
(38,'adaf',37),
(39,'adaf',38),
(40,'wdsaf',39),
(41,'wdsaf',40),
(42,'wdsaf',41),
(43,'wdsaf',42),
(44,'adasd',43),
(45,'adas',44),
(46,'adas',45),
(47,'sc',46),
(48,'sc',47);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
