/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - hotel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hotel` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `hotel`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `primer_apellido` varchar(150) DEFAULT NULL,
  `segundo_apellido` varchar(150) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE,
  KEY `fk_id_usuario` (`id_usuario`) USING BTREE,
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `clientes` */

insert  into `clientes`(`id_cliente`,`id_usuario`,`nombre`,`primer_apellido`,`segundo_apellido`,`fecha_registro`) values 
(1,2,'JUAN','PEREZ','SANCHEZ','2020-11-29'),
(2,3,'PEDRO','HERNANDEZ','GARCIA','2020-11-29'),
(3,4,'MARIA','GOMEZ','HERNANDEZ','2020-11-29');

/*Table structure for table `edificios` */

DROP TABLE IF EXISTS `edificios`;

CREATE TABLE `edificios` (
  `id_edificio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_edificio` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_edificio`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `edificios` */

insert  into `edificios`(`id_edificio`,`nombre_edificio`) values 
(1,'Sierra'),
(2,'Alaska');

/*Table structure for table `estatus_habitacion` */

DROP TABLE IF EXISTS `estatus_habitacion`;

CREATE TABLE `estatus_habitacion` (
  `id_estatus_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estatus_habitacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_estatus_habitacion`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `estatus_habitacion` */

insert  into `estatus_habitacion`(`id_estatus_habitacion`,`descripcion_estatus_habitacion`) values 
(1,'Activa'),
(2,'Reservada'),
(3,'Ocupada'),
(4,'Baja'),
(5,'Mantenimiento');

/*Table structure for table `estatus_reservacion` */

DROP TABLE IF EXISTS `estatus_reservacion`;

CREATE TABLE `estatus_reservacion` (
  `id_estatus_reservacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estatus_reservacion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_estatus_reservacion`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `estatus_reservacion` */

insert  into `estatus_reservacion`(`id_estatus_reservacion`,`descripcion_estatus_reservacion`) values 
(1,'Activa'),
(2,'Cerrada'),
(3,'Cancelada');

/*Table structure for table `habitaciones` */

DROP TABLE IF EXISTS `habitaciones`;

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_edificio` int(11) DEFAULT NULL,
  `nivel_piso` varchar(3) DEFAULT NULL,
  `numero_habitacion` varchar(10) DEFAULT NULL,
  `id_tipo_habitacion` int(11) DEFAULT NULL,
  `id_vista` int(11) DEFAULT NULL,
  `id_estatus_habitacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_habitacion`) USING BTREE,
  KEY `fk_id_tipo_habitacion` (`id_tipo_habitacion`) USING BTREE,
  KEY `fk_id_edificio` (`id_edificio`) USING BTREE,
  KEY `fk_id_vista` (`id_vista`) USING BTREE,
  KEY `fk_id_estatus_habitacion` (`id_estatus_habitacion`) USING BTREE,
  CONSTRAINT `fk_id_edificio` FOREIGN KEY (`id_edificio`) REFERENCES `edificios` (`id_edificio`),
  CONSTRAINT `fk_id_estatus_habitacion` FOREIGN KEY (`id_estatus_habitacion`) REFERENCES `estatus_habitacion` (`id_estatus_habitacion`),
  CONSTRAINT `fk_id_tipo_habitacion` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipos_habitacion` (`id_tipo_habitacion`),
  CONSTRAINT `fk_id_vista` FOREIGN KEY (`id_vista`) REFERENCES `vistas` (`id_vista`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `habitaciones` */

insert  into `habitaciones`(`id_habitacion`,`id_edificio`,`nivel_piso`,`numero_habitacion`,`id_tipo_habitacion`,`id_vista`,`id_estatus_habitacion`) values 
(1,1,'PB','001',1,1,2),
(2,1,'1','101',1,1,1),
(4,1,'2','201',1,1,1);

/*Table structure for table `pantallas` */

DROP TABLE IF EXISTS `pantallas`;

CREATE TABLE `pantallas` (
  `id_pantalla` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_pantalla` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_pantalla`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `pantallas` */

/*Table structure for table `rel_rol_pantalla` */

DROP TABLE IF EXISTS `rel_rol_pantalla`;

CREATE TABLE `rel_rol_pantalla` (
  `id_rel_rol_pantalla` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `id_pantalla` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rel_rol_pantalla`) USING BTREE,
  KEY `fk_idrol` (`id_rol`) USING BTREE,
  KEY `fk_idpantalla` (`id_pantalla`) USING BTREE,
  CONSTRAINT `fk_idpantalla` FOREIGN KEY (`id_pantalla`) REFERENCES `pantallas` (`id_pantalla`),
  CONSTRAINT `fk_idrol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `rel_rol_pantalla` */

/*Table structure for table `reservacion` */

DROP TABLE IF EXISTS `reservacion`;

CREATE TABLE `reservacion` (
  `id_reservacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `fecha_reservacion` date DEFAULT NULL,
  `id_estatus_reservacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reservacion`) USING BTREE,
  KEY `fk_id_cliente` (`id_cliente`) USING BTREE,
  KEY `fk_id_habitacion` (`id_habitacion`) USING BTREE,
  KEY `fk_id_estatus_reservacion` (`id_estatus_reservacion`) USING BTREE,
  CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_id_estatus_reservacion` FOREIGN KEY (`id_estatus_reservacion`) REFERENCES `estatus_reservacion` (`id_estatus_reservacion`),
  CONSTRAINT `fk_id_habitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `reservacion` */

insert  into `reservacion`(`id_reservacion`,`id_cliente`,`id_habitacion`,`fecha_inicio`,`fecha_fin`,`monto`,`fecha_reservacion`,`id_estatus_reservacion`) values 
(1,1,1,'2020-11-01','2020-11-05',1000,'2020-11-30',1),
(2,2,2,'2020-12-31','2021-01-07',1500,'2020-12-01',1);

/*Table structure for table `reservacion_detalle` */

DROP TABLE IF EXISTS `reservacion_detalle`;

CREATE TABLE `reservacion_detalle` (
  `id_reservacion_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_reservacion_huesped` int(11) DEFAULT NULL,
  `fecha_check_in` datetime DEFAULT NULL,
  `fecha_check_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reservacion_detalle`) USING BTREE,
  KEY `fk_id_reservacion_huesped` (`id_reservacion_huesped`),
  CONSTRAINT `fk_id_reservacion_huesped` FOREIGN KEY (`id_reservacion_huesped`) REFERENCES `reservacion_huespedes` (`id_reservacion_huesped`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `reservacion_detalle` */

insert  into `reservacion_detalle`(`id_reservacion_detalle`,`id_reservacion_huesped`,`fecha_check_in`,`fecha_check_out`) values 
(1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
(2,2,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `reservacion_huespedes` */

DROP TABLE IF EXISTS `reservacion_huespedes`;

CREATE TABLE `reservacion_huespedes` (
  `id_reservacion_huesped` int(11) NOT NULL AUTO_INCREMENT,
  `id_reservacion` int(11) DEFAULT NULL,
  `nombre_huesped` varchar(500) DEFAULT NULL,
  `edad_huesped` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reservacion_huesped`) USING BTREE,
  KEY `fk_id_reservacion` (`id_reservacion`),
  CONSTRAINT `fk_id_reservacion` FOREIGN KEY (`id_reservacion`) REFERENCES `reservacion` (`id_reservacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `reservacion_huespedes` */

insert  into `reservacion_huespedes`(`id_reservacion_huesped`,`id_reservacion`,`nombre_huesped`,`edad_huesped`) values 
(1,1,'ana velazquez',25),
(2,1,'fidel diaz',29);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rol` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rol`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `roles` */

insert  into `roles`(`id_rol`,`descripcion_rol`) values 
(1,'ADMINISTRADOR'),
(2,'SUBADMINISTRADOR'),
(3,'CLIENTE');

/*Table structure for table `tipos_habitacion` */

DROP TABLE IF EXISTS `tipos_habitacion`;

CREATE TABLE `tipos_habitacion` (
  `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_habitacion` varchar(150) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `capacidad_ninos` int(11) DEFAULT NULL,
  `capacidad_adultos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_habitacion`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `tipos_habitacion` */

insert  into `tipos_habitacion`(`id_tipo_habitacion`,`descripcion_tipo_habitacion`,`precio`,`capacidad_ninos`,`capacidad_adultos`) values 
(1,'Oro',1000,5,5),
(2,'Diamante',600,3,5),
(3,'Plata',700,4,7),
(4,'Platino',800,5,9);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  KEY `fk_id_rol` (`id_rol`) USING BTREE,
  CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_usuario`,`id_rol`,`username`,`password`) values 
(2,3,'ana','123'),
(3,3,'pedro','123'),
(4,3,'maria','123'),
(5,3,'',''),
(6,3,'',''),
(7,3,'',''),
(8,3,'',''),
(9,3,'sdfd','sfdsf'),
(10,3,'kjhkjhkjh','hkjjhj'),
(11,3,'ggg','gg'),
(12,3,'kkk','kkk'),
(13,3,'kkk','kkk'),
(14,3,'sfdfff','fff'),
(15,3,'ppp','pp'),
(16,3,'ppp','pp'),
(17,3,'sdfdsf','dsfdsfsd');

/*Table structure for table `vistas` */

DROP TABLE IF EXISTS `vistas`;

CREATE TABLE `vistas` (
  `id_vista` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_vista` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_vista`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `vistas` */

insert  into `vistas`(`id_vista`,`descripcion_vista`) values 
(1,'Jardin'),
(2,'Playa');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
