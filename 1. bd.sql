/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - forodb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`forodb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `forodb`;

/*Table structure for table `administrador` */

DROP TABLE IF EXISTS `administrador`;

CREATE TABLE `administrador` (
  `idadmin` int(1) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `administrador` */

insert  into `administrador`(`idadmin`,`nombre`,`apellidos`,`usuario`,`password`) values (1,'Julio Eduardo','Perez Ake','AdminTec','0be61ea7ab321ebffc699a3dab493c9c');

/*Table structure for table `alumnos` */

DROP TABLE IF EXISTS `alumnos`;

CREATE TABLE `alumnos` (
  `idalumno` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `matricula` int(4) NOT NULL,
  `edad` int(2) NOT NULL,
  `sexo` char(1) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `semestre` int(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`idalumno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `alumnos` */

insert  into `alumnos`(`idalumno`,`nombre`,`apellidos`,`matricula`,`edad`,`sexo`,`carrera`,`semestre`,`email`) values (1,'Juan Mario','Lopez',5991,23,'H','Ingeniería en Sistemas Computacionales',3,'maria@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
