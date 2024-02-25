/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 8.0.31 : Database - autopro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`autopro` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `autopro`;

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Booked',
  `feedback` varchar(100) NOT NULL,
  `rating` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'no rating',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `booking` */

insert  into `booking`(`booking_id`,`uid`,`sid`,`date`,`status`,`feedback`,`rating`) values (1,'1','1','2023-09-20','Delivered','Very Good Service.Highly Recommended','5'),(2,'1','2','2023-09-21','Diagnosed','','no rating'),(3,'1','1','2023-10-10','Booked','','no rating');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`cid`,`name`,`email`,`phone`,`vehicle_model`,`year`,`address`) values (1,'Vineeth','vineethvasanth1812@gmail.com','9895467571','Swift Dezire','2021','Pattumala,Idukki');

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `emp_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `employee` */

insert  into `employee`(`emp_id`,`name`,`email`,`phone`,`address`,`qualification`,`experience`) values (1,'Sreerag','forlccekm@gmail.com','9856454874','Kozhikode','MTech','2');

/*Table structure for table `inventory` */

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `inventory_id` int NOT NULL AUTO_INCREMENT,
  `pdt_id` varchar(100) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `total` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Paid',
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `inventory` */

insert  into `inventory`(`inventory_id`,`pdt_id`,`sid`,`stock`,`total`,`status`) values (1,'2','1','3','2097','Paid');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `reg_id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`login_id`,`reg_id`,`email`,`password`,`usertype`,`status`) values (1,'0','admin@gmail.com','admin','Admin','Approved'),(2,'1','manu@gmail.com','123','Supplier','Approved'),(3,'1','forlccekm@gmail.com','123','Employee','Approved'),(4,'1','vineeth@gmail.com','123','Customer','Approved');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `pdt_id` int NOT NULL AUTO_INCREMENT,
  `sid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  PRIMARY KEY (`pdt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`pdt_id`,`sid`,`name`,`stock`,`price`,`desc`,`image`,`manufacturer`) values (1,'1','PVC Audi Steering Wheel','5','90000','Light weight aluminium steering with excellent grip and padding','product-details-03.jpg','Wanti Traders'),(2,'1','Oil Filter','247','699','Filter designed to remove contaminants from engine oil, transmission oil, lubricating oil, or hydraulic oil.','oil_filter.jpg','Hindustan Hydraulics & Pneumatics.'),(3,'1','7 inch LED Car Video Monitor','150','3499','Woodman Car 7 inch LED Car Video Monitor For Dashboard with USB & Bluetooth & Camera (Black) will give you the fantastic road trip and you can enjoy video as well.','shop-9.jpg','WOODMAN');

/*Table structure for table `requests` */

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `req_id` int NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(100) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `model` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Requested',
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `requests` */

insert  into `requests`(`req_id`,`emp_id`,`name`,`model`,`qty`,`desc`,`date`,`status`) values (3,'1','Tyre','VolksWagon Polo','2','Urgently Needed 2 Fresh Tires','2023-10-10','Approved');

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `labor_cost` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `services` */

insert  into `services`(`service_id`,`emp_id`,`service_name`,`description`,`duration`,`price`,`labor_cost`,`image`) values (1,'1','Car Foam Wash','Car servicing rationally encounter consequences extremely painful. Nor again is the there anyone who loves or pursues take a trivial example, which of us undertakes chooses pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure','1 Hour','2500','250','car-wash.png'),(2,'1','Entire Engine Servicing','Car servicing rationally encounter consequences extremely painful. Nor again is the there anyone who','3 Hour','6000','1250','service-details.jpg');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `licence` varchar(100) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`sid`,`name`,`email`,`phone`,`address`,`licence`) values (1,'Manu','manu@gmail.com','8089222038','Kollam,Kottarakkara','APOL654372');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
