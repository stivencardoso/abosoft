/*
SQLyog - Free MySQL GUI v5.02
Host - 5.5.5-10.4.6-MariaDB : Database - base1
*********************************************************************
Server version : 5.5.5-10.4.6-MariaDB
*/


create database if not exists `base1`;

USE `base1`;

/*Table structure for table `eventos` */

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `colortexto` varchar(7) DEFAULT NULL,
  `colorfondo` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `eventos` */

insert into `eventos` values 
(1,'Clase de tai-chi','','2019-10-07 01:15:00','2019-10-07 04:45:00','#ffffff','#94ceca'),
(2,'Clase de pilates','','2019-10-07 11:00:00','2019-10-07 11:50:00','#ffffff','#14868c'),
(3,'Clase de tai-chi','','2019-10-08 09:15:00','2019-10-08 10:15:00','#ffffff','#94ceca'),
(4,'Clase de pilates','','2019-10-08 11:00:00','2019-10-08 11:50:00','#ffffff','#14868c'),
(5,'Clase de yoga','','2019-10-08 13:05:00','2019-10-08 14:00:00','#ffffff','#2f416d'),
(6,'Clase de calistenia','','2019-10-08 18:05:00','2019-10-08 19:00:00','#ffffff','#5d1451'),
(7,'Clase de calistenia','','2019-10-09 18:05:00','2019-10-09 19:00:00','#ffffff','#5d1451'),
(8,'Clase de calistenia','','2019-10-10 18:05:00','2019-10-10 19:00:00','#ffffff','#5d1451'),
(9,'Clase de tai-chi','','2019-10-11 09:15:00','2019-10-11 10:15:00','#ffffff','#94ceca'),
(10,'Clase de pilates','','2019-10-11 11:00:00','2019-10-11 11:50:00','#ffffff','#14868c'),
(11,'Almuerzo a la canasta','Trae cada uno su comida','2019-10-07 12:15:00','2019-10-07 13:00:00','#ffffff','#3788d8'),
(12,'Clase de calistenia','','2019-10-07 18:05:00','2019-10-07 19:00:00','#ffffff','#5d1451'),
(13,'Clase de calistenia','','2019-10-11 18:05:00','2019-10-11 19:00:00','#ffffff','#5d1451'),
(14,'Reunión de personal','','2019-10-08 21:00:00','2019-10-08 22:00:00','#ffffff','#3788d8'),
(15,'Desayuno de grupo','','2019-10-10 07:00:00','2019-10-10 08:00:00','#ffffff','#3788d8'),
(16,'Cerrado por desinfección','','2019-10-12 00:05:00','2019-10-12 23:55:00','#ffffff','#3788d8'),
(17,'Día de descanso','','2019-10-13 00:05:00','2019-10-13 23:55:00','#ffffff','#3788d8'),
(18,'Clase de calistenia','','2019-10-15 18:05:00','2019-10-15 19:00:00','#ffffff','#5d1451'),
(20,'Clase de tai-chi','','2019-10-16 09:15:00','2019-10-16 10:15:00','#ffffff','#94ceca');

/*Table structure for table `eventospredefinidos` */

DROP TABLE IF EXISTS `eventospredefinidos`;

CREATE TABLE `eventospredefinidos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `horainicio` time DEFAULT NULL,
  `horafin` time DEFAULT NULL,
  `colortexto` varchar(7) DEFAULT NULL,
  `colorfondo` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `eventospredefinidos` */

insert into `eventospredefinidos` values 
(1,'Clase de tai-chi','09:15:00','10:15:00','#ffffff','#94ceca'),
(2,'Clase de pilates','11:00:00','11:50:00','#ffffff','#14868c'),
(3,'Clase de yoga','13:05:00','14:00:00','#ffffff','#2f416d'),
(4,'Clase de calistenia','18:05:00','19:00:00','#ffffff','#5d1451');
