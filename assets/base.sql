/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.14 : Database - gis
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bizlookup` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bizlookup`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`username`,`password`,`type`) values (1,'admin','admin','admin');

/*Table structure for table `allowed` */

DROP TABLE IF EXISTS `allowed`;

CREATE TABLE `allowed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head` longtext,
  `title` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `allowed` */

insert  into `allowed`(`id`,`head`,`title`) values (1,'[\"name\",\"date\",\"status\",\"location_address\"]','[\"Name\",\"Date\",\"Status\",\"Full Address\"]');

/*Table structure for table `barangay` */

DROP TABLE IF EXISTS `barangay`;

CREATE TABLE `barangay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `barangay` */

insert  into `barangay`(`id`,`name`) values (1,'Bonfal East'),(2,'Bonfal Proper'),(3,'Bonfal West'),(4,'Buenavista'),(5,'Busilac'),(6,'Casat'),(20,'La Torre North'),(7,'Magapuy'),(8,'Magsaysay'),(9,'Masoc'),(10,'Paitan'),(11,'Don Domingo Maddela'),(12,'Don Tomas Maddela'),(13,'District III'),(14,'District IV'),(15,'Bansing'),(16,'Cabuaan'),(17,'Don Mariano Marcos'),(18,'Ipil-Cuneg'),(19,'La Torre South'),(21,'Luyang'),(22,'Salvacion'),(23,'San Nicholas'),(24,'Santa Rosa'),(25,'Vista Alegre');

/*Table structure for table `business` */

DROP TABLE IF EXISTS `business`;

CREATE TABLE `business` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `bin` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `incentives` tinyint(1) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `barangay_clearance` tinyint(1) DEFAULT '0',
  `tax_clearance` tinyint(1) DEFAULT '0',
  `dti_registration` tinyint(1) DEFAULT '0',
  `sanitary_clearance` tinyint(1) DEFAULT '0',
  `fire_clearance` tinyint(1) DEFAULT '0',
  `building_permit` tinyint(1) DEFAULT '0',
  `zoning_clearance` tinyint(1) DEFAULT '0',
  `contract_lease` tinyint(1) DEFAULT '0',
  `pic_clearance` tinyint(1) DEFAULT '0',
  `menro_cert` tinyint(1) DEFAULT '0',
  `building_id` int(11) DEFAULT NULL,
  `business_area` double DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `remarks` longtext,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `business` */

/*Table structure for table `business_address` */

DROP TABLE IF EXISTS `business_address`;

CREATE TABLE `business_address` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `pin` int(11) DEFAULT NULL,
  `bldg_no` int(11) DEFAULT NULL,
  `building_name` varchar(60) DEFAULT NULL,
  `unit_no` int(11) DEFAULT NULL,
  `street` varchar(60) DEFAULT NULL,
  `barangay` varchar(60) DEFAULT NULL,
  `subdivision` varchar(60) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `province` varchar(60) DEFAULT NULL,
  `tel_no` bigint(20) DEFAULT NULL,
  `email_address` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `business_address` */

/*Table structure for table `business_logs` */

DROP TABLE IF EXISTS `business_logs`;

CREATE TABLE `business_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `bid` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=660 DEFAULT CHARSET=latin1;

/*Data for the table `business_logs` */

/*Table structure for table `business_owner` */

DROP TABLE IF EXISTS `business_owner`;

CREATE TABLE `business_owner` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `middle_name` varchar(60) DEFAULT NULL,
  `house_no` int(11) DEFAULT NULL,
  `building_name` varchar(60) DEFAULT NULL,
  `unit_no` int(11) DEFAULT NULL,
  `street` varchar(60) DEFAULT NULL,
  `barangay` varchar(60) DEFAULT NULL,
  `subdivision` varchar(60) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `province` varchar(60) DEFAULT NULL,
  `tel_no` bigint(20) DEFAULT NULL,
  `email_address` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `business_owner` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`description`) values (1,'Manufacturer',NULL),(2,'Retailer',NULL),(3,'Contractor',NULL),(4,'Services',NULL),(5,'Real Estate',NULL),(6,'Lessor Financial',NULL),(7,'Amusement',NULL),(8,'Learning Institute',NULL),(9,'Wholesaler',NULL);

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `pin` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `owner` varchar(45) DEFAULT NULL,
  `x` double DEFAULT '0',
  `y` double DEFAULT '0',
  `imgpath` varchar(100) DEFAULT NULL,
  `address` longtext,
  PRIMARY KEY (`pin`)
) ENGINE=MyISAM AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

/*Table structure for table `location_logs` */

DROP TABLE IF EXISTS `location_logs`;

CREATE TABLE `location_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lid` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

/*Data for the table `location_logs` */

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `coordinate` longtext,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `region` */

/*Table structure for table `settings_logs` */

DROP TABLE IF EXISTS `settings_logs`;

CREATE TABLE `settings_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sid` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `settings_logs` */

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  `isDefault` tinyint(1) DEFAULT '0',
  `isRetired` tinyint(1) DEFAULT '0',
  `isApprove` tinyint(1) DEFAULT '0',
  `isCondition` tinyint(1) DEFAULT '0',
  `conditions` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `status` */

insert  into `status`(`id`,`name`,`description`,`isDefault`,`isRetired`,`isApprove`,`isCondition`,`conditions`,`color`) values (2,'Registered',NULL,0,0,1,0,'0000000000','#50C878'),(3,'Waiting','Pending but requirements are completed',0,0,0,1,'1111111111','#395FFF'),(4,'Pending',NULL,1,0,0,0,'0000000000','#DBFE87'),(5,'Removed',NULL,0,1,0,0,'0000000000','#FF6961');

/*Table structure for table `theme` */

DROP TABLE IF EXISTS `theme`;

CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `bgfirst` varchar(45) DEFAULT NULL,
  `bgsecond` varchar(45) DEFAULT NULL,
  `cfirst` varchar(45) DEFAULT NULL,
  `csecond` varchar(45) DEFAULT NULL,
  `bfirst` varchar(45) DEFAULT NULL,
  `beffect` varchar(45) DEFAULT NULL,
  `isSelected` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `theme` */

insert  into `theme`(`id`,`name`,`bgfirst`,`bgsecond`,`cfirst`,`csecond`,`bfirst`,`beffect`,`isSelected`) values (1,'Theme 1','#363636','#48494B','#D9D9D9','#FFFFFF','#00FFFF','#2F2F2F',0),(2,'Theme 2','#ffffff','#ededed','#000000','#000000','#0056c7','#8f8f8f',1);

/*Table structure for table `types` */

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `types` */

insert  into `types`(`id`,`name`,`description`) values (1,'Single',NULL),(2,'Partnership',NULL),(3,'Corporation',NULL),(4,'Cooperative',NULL);

/* Trigger structure for table `business` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_bin` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_bin` BEFORE INSERT ON `business` FOR EACH ROW BEGIN
	#call sp_pin_count(new.building_id, @co);
	SET new.bin = (SELECT CONCAT(new.building_id,"-",COUNT(*) + 1,"") FROM business WHERE building_id = new.building_id LIMIT 1);
    END */$$


DELIMITER ;

/* Trigger structure for table `business` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_logs_add` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_logs_add` AFTER INSERT ON `business` FOR EACH ROW BEGIN
	insert into business_logs (bid, action) values (new.number, "Add New Business");
    END */$$


DELIMITER ;

/* Trigger structure for table `business` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_bin_edit` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_bin_edit` BEFORE UPDATE ON `business` FOR EACH ROW BEGIN
	SET new.bin = (SELECT concat(new.building_id,"-",COUNT(*) + 1,"") FROM business WHERE building_id = new.building_id LIMIT 1);
    END */$$


DELIMITER ;

/* Trigger structure for table `business` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_logs_edit` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_logs_edit` AFTER UPDATE ON `business` FOR EACH ROW BEGIN
	INSERT INTO business_logs (bid, ACTION) VALUES (new.number, "Edit Business");
    END */$$


DELIMITER ;

/* Trigger structure for table `business_address` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_logs_add_address` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_logs_add_address` AFTER INSERT ON `business_address` FOR EACH ROW BEGIN
	
	INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE address = new.building_id), "Add Business Address");
    END */$$


DELIMITER ;

/* Trigger structure for table `business_address` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_logs_edit_address` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_logs_edit_address` AFTER UPDATE ON `business_address` FOR EACH ROW BEGIN
	INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE address = new.building_id), "Edit Business Address");
    END */$$


DELIMITER ;

/* Trigger structure for table `business_owner` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_logs_add_owner` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_logs_add_owner` AFTER INSERT ON `business_owner` FOR EACH ROW BEGIN
	INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE owner_id = new.owner_id), "Add Business Owner");
    END */$$


DELIMITER ;

/* Trigger structure for table `business_owner` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_business_logs_edit_owner` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_business_logs_edit_owner` AFTER UPDATE ON `business_owner` FOR EACH ROW BEGIN
	INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE owner_id = new.owner_id), "Add Business Owner");
    END */$$


DELIMITER ;

/* Trigger structure for table `categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_settings_logs_add_categories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_settings_logs_add_categories` AFTER INSERT ON `categories` FOR EACH ROW BEGIN
	INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, "Add Category");
    END */$$


DELIMITER ;

/* Trigger structure for table `categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_settings_logs_edit_categories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_settings_logs_edit_categories` AFTER UPDATE ON `categories` FOR EACH ROW BEGIN
	INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, "Edit Category");
    END */$$


DELIMITER ;

/* Trigger structure for table `location` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_location_logs_add` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_location_logs_add` AFTER INSERT ON `location` FOR EACH ROW BEGIN
	INSERT INTO location_logs (lid, ACTION) VALUES (new.pin, "Add Location");
    END */$$


DELIMITER ;

/* Trigger structure for table `location` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_location_logs_edit` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_location_logs_edit` AFTER UPDATE ON `location` FOR EACH ROW BEGIN
	INSERT INTO location_logs (lid, ACTION) VALUES (new.pin, "Edit Location");
    END */$$


DELIMITER ;

/* Trigger structure for table `types` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_settings_logs_add_types` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_settings_logs_add_types` AFTER INSERT ON `types` FOR EACH ROW BEGIN
	INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, "Add Type");
    END */$$


DELIMITER ;

/* Trigger structure for table `types` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trigger_settings_logs_edit_types` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trigger_settings_logs_edit_types` AFTER UPDATE ON `types` FOR EACH ROW BEGIN
	INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, "Edit Type");
    END */$$


DELIMITER ;

/* Procedure structure for procedure `sp_business_data` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_business_data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_business_data`(in bid int(11))
BEGIN
	SELECT * FROM business AS a
	INNER JOIN business_address AS b ON a.address = b.building_id
	INNER JOIN business_owner AS c ON a.`owner_id` = c.`owner_id`
	INNER JOIN location AS d ON a.`building_id` = d.`pin` where a.number = bid;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_pin_count` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_pin_count` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_pin_count`(in pin int)
BEGIN
	SELECT COUNT(*) FROM business WHERE building_id = pin;
    END */$$
DELIMITER ;

/*Table structure for table `view_business_details` */

DROP TABLE IF EXISTS `view_business_details`;

/*!50001 DROP VIEW IF EXISTS `view_business_details` */;
/*!50001 DROP TABLE IF EXISTS `view_business_details` */;

/*!50001 CREATE TABLE  `view_business_details`(
 `number` int(11) ,
 `bin` varchar(45) ,
 `name` varchar(45) ,
 `owner` varchar(100) ,
 `owner_id` int(11) ,
 `address` int(11) ,
 `incentives` tinyint(1) ,
 `type` varchar(45) ,
 `status` varchar(45) ,
 `category` varchar(45) ,
 `date` date ,
 `barangay_clearance` tinyint(1) ,
 `tax_clearance` tinyint(1) ,
 `dti_registration` tinyint(1) ,
 `sanitary_clearance` tinyint(1) ,
 `fire_clearance` tinyint(1) ,
 `building_permit` tinyint(1) ,
 `zoning_clearance` tinyint(1) ,
 `contract_lease` tinyint(1) ,
 `pic_clearance` tinyint(1) ,
 `menro_cert` tinyint(1) ,
 `building_id` int(11) ,
 `business_area` double ,
 `location_address` longtext ,
 `bldg_no` int(11) ,
 `building_name` varchar(60) ,
 `unit_no` int(11) ,
 `street` varchar(60) ,
 `barangay` varchar(60) ,
 `subdivision` varchar(60) ,
 `city` varchar(60) ,
 `province` varchar(60) ,
 `tel_no` bigint(20) ,
 `email_address` varchar(60) 
)*/;

/*Table structure for table `view_category_count` */

DROP TABLE IF EXISTS `view_category_count`;

/*!50001 DROP VIEW IF EXISTS `view_category_count` */;
/*!50001 DROP TABLE IF EXISTS `view_category_count` */;

/*!50001 CREATE TABLE  `view_category_count`(
 `category` varchar(45) ,
 `count` bigint(21) 
)*/;

/*Table structure for table `view_date_barangay_count` */

DROP TABLE IF EXISTS `view_date_barangay_count`;

/*!50001 DROP VIEW IF EXISTS `view_date_barangay_count` */;
/*!50001 DROP TABLE IF EXISTS `view_date_barangay_count` */;

/*!50001 CREATE TABLE  `view_date_barangay_count`(
 `date` date ,
 `year` int(4) ,
 `month` int(2) ,
 `day` int(2) ,
 `count` bigint(21) ,
 `barangay` varchar(60) 
)*/;

/*Table structure for table `view_location_count` */

DROP TABLE IF EXISTS `view_location_count`;

/*!50001 DROP VIEW IF EXISTS `view_location_count` */;
/*!50001 DROP TABLE IF EXISTS `view_location_count` */;

/*!50001 CREATE TABLE  `view_location_count`(
 `name` varchar(45) ,
 `business` varchar(45) ,
 `count` bigint(21) 
)*/;

/*Table structure for table `view_pin_count` */

DROP TABLE IF EXISTS `view_pin_count`;

/*!50001 DROP VIEW IF EXISTS `view_pin_count` */;
/*!50001 DROP TABLE IF EXISTS `view_pin_count` */;

/*!50001 CREATE TABLE  `view_pin_count`(
 `building_id` int(11) ,
 `COUNT` bigint(21) 
)*/;

/*Table structure for table `view_status_count` */

DROP TABLE IF EXISTS `view_status_count`;

/*!50001 DROP VIEW IF EXISTS `view_status_count` */;
/*!50001 DROP TABLE IF EXISTS `view_status_count` */;

/*!50001 CREATE TABLE  `view_status_count`(
 `status` varchar(45) ,
 `count` bigint(21) ,
 `color` varchar(45) 
)*/;

/*Table structure for table `view_year_count` */

DROP TABLE IF EXISTS `view_year_count`;

/*!50001 DROP VIEW IF EXISTS `view_year_count` */;
/*!50001 DROP TABLE IF EXISTS `view_year_count` */;

/*!50001 CREATE TABLE  `view_year_count`(
 `year` int(4) ,
 `count` bigint(21) 
)*/;

/*View structure for view view_business_details */

/*!50001 DROP TABLE IF EXISTS `view_business_details` */;
/*!50001 DROP VIEW IF EXISTS `view_business_details` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_business_details` AS (select `a`.`number` AS `number`,`a`.`bin` AS `bin`,`a`.`name` AS `name`,`a`.`owner` AS `owner`,`a`.`owner_id` AS `owner_id`,`a`.`address` AS `address`,`a`.`incentives` AS `incentives`,`a`.`type` AS `type`,`a`.`status` AS `status`,`a`.`category` AS `category`,`a`.`date` AS `date`,`a`.`barangay_clearance` AS `barangay_clearance`,`a`.`tax_clearance` AS `tax_clearance`,`a`.`dti_registration` AS `dti_registration`,`a`.`sanitary_clearance` AS `sanitary_clearance`,`a`.`fire_clearance` AS `fire_clearance`,`a`.`building_permit` AS `building_permit`,`a`.`zoning_clearance` AS `zoning_clearance`,`a`.`contract_lease` AS `contract_lease`,`a`.`pic_clearance` AS `pic_clearance`,`a`.`menro_cert` AS `menro_cert`,`a`.`building_id` AS `building_id`,`a`.`business_area` AS `business_area`,`d`.`address` AS `location_address`,`b`.`bldg_no` AS `bldg_no`,`b`.`building_name` AS `building_name`,`b`.`unit_no` AS `unit_no`,`b`.`street` AS `street`,`b`.`barangay` AS `barangay`,`b`.`subdivision` AS `subdivision`,`b`.`city` AS `city`,`b`.`province` AS `province`,`b`.`tel_no` AS `tel_no`,`b`.`email_address` AS `email_address` from (((`business` `a` join `business_address` `b` on((`a`.`address` = `b`.`building_id`))) join `business_owner` `c` on((`a`.`owner_id` = `c`.`owner_id`))) join `location` `d` on((`a`.`building_id` = `d`.`pin`)))) */;

/*View structure for view view_category_count */

/*!50001 DROP TABLE IF EXISTS `view_category_count` */;
/*!50001 DROP VIEW IF EXISTS `view_category_count` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_category_count` AS (select `business`.`category` AS `category`,count(`business`.`category`) AS `count` from `business` group by `business`.`category`) */;

/*View structure for view view_date_barangay_count */

/*!50001 DROP TABLE IF EXISTS `view_date_barangay_count` */;
/*!50001 DROP VIEW IF EXISTS `view_date_barangay_count` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_date_barangay_count` AS (select `a`.`date` AS `date`,year(`a`.`date`) AS `year`,month(`a`.`date`) AS `month`,dayofmonth(`a`.`date`) AS `day`,count(`a`.`number`) AS `count`,`b`.`barangay` AS `barangay` from (`business` `a` join `business_address` `b` on((`b`.`pin` = `a`.`building_id`))) group by `b`.`barangay`,`a`.`date`) */;

/*View structure for view view_location_count */

/*!50001 DROP TABLE IF EXISTS `view_location_count` */;
/*!50001 DROP VIEW IF EXISTS `view_location_count` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_location_count` AS (select `a`.`name` AS `name`,`b`.`name` AS `business`,count(`a`.`name`) AS `count` from (`location` `a` left join `business` `b` on((`a`.`pin` = `b`.`building_id`))) group by `a`.`name`) */;

/*View structure for view view_pin_count */

/*!50001 DROP TABLE IF EXISTS `view_pin_count` */;
/*!50001 DROP VIEW IF EXISTS `view_pin_count` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pin_count` AS (select `business`.`building_id` AS `building_id`,count(0) AS `COUNT` from `business` group by `business`.`building_id`) */;

/*View structure for view view_status_count */

/*!50001 DROP TABLE IF EXISTS `view_status_count` */;
/*!50001 DROP VIEW IF EXISTS `view_status_count` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_status_count` AS (select `a`.`name` AS `status`,count(`b`.`status`) AS `count`,`a`.`color` AS `color` from (`status` `a` left join `business` `b` on((`a`.`name` = `b`.`status`))) group by `a`.`name` order by `a`.`id`) */;

/*View structure for view view_year_count */

/*!50001 DROP TABLE IF EXISTS `view_year_count` */;
/*!50001 DROP VIEW IF EXISTS `view_year_count` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_year_count` AS (select year(`business`.`date`) AS `year`,count(`business`.`date`) AS `count` from `business` group by year(`business`.`date`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
