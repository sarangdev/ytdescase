-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: admin_ytdes
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB-0+deb9u1

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
-- Table structure for table `activatedPromocodes`
--

DROP TABLE IF EXISTS `activatedPromocodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activatedPromocodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Активированные промокоды';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activatedPromocodes`
--

LOCK TABLES `activatedPromocodes` WRITE;
/*!40000 ALTER TABLE `activatedPromocodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `activatedPromocodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buyedcases`
--

DROP TABLE IF EXISTS `buyedcases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyedcases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2554 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyedcases`
--

--
-- Table structure for table `caseitems`
--

DROP TABLE IF EXISTS `caseitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caseitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `img` tinytext NOT NULL,
  `resUrl` text NOT NULL,
  `chance` int(3) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caseitems`
--

LOCK TABLES `caseitems` WRITE;
/*!40000 ALTER TABLE `caseitems` DISABLE KEYS */;
INSERT INTO `caseitems` VALUES (1,1,'Рисованная шапка','/img/items/shapka.png','1',5,750),(2,1,'Рисованная аватарка','/img/items/avatarka.png','1',9,350),(3,1,'Рисованный логотип','/img/items/logo.png','1',6,400),(4,1,'Рисованный макет','/img/items/maket.png','1',2,4000),(5,1,'Стили','/img/items/styles.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',80,1),(6,2,'Пак артера','/img/items/risch.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_Drawpack.download',20,500),(7,2,'Превью в стиле Аида','/img/items/prevyu.png','1',50,170),(8,2,'Стили','/img/items/styles2.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',94,1),(9,2,'Рисованная шапка + аватарка','/img/items/shapkaava.png','1',2,1400),(10,2,'Приватные кисти','/img/items/privkisti.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_PrivateBrushes.download',65,100),(11,3,'GFX пак для фотошопа','/img/items/gfxpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_PSGFXPack.download',65,20),(12,3,'Приватный пак Ютубера','/img/items/ytpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_YTPack.download',10,600),(13,3,'Стили','/img/items/styles.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',97,1),(14,3,'Пак начинающего Ютубера','/img/items/nachpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_YTStarterPack.download',11,559),(15,3,'Пак приватных шрифтов','/img/items/shrifti.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_FontsPack.download',45,200),(16,3,'Пак кистей','/img/items/kisti.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_Brushes.download',40,250),(17,3,'GFX пак для монтажа','/img/items/montage.png','https://yadi.sk/d/WkOj7u7ETCyraQ',2,1000),(18,4,'Пак Аида','/img/items/aidpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_Aid.download',20,999),(19,4,'Пак YTDes','/img/items/ytdespack.png','https://yadi.sk/d/_fTtUTOHU4opuQ',50,250),(20,4,'Пак Tota','/img/items/totapack.png','https://yadi.sk/d/sZcpA-PMUkv2Jg',94,20),(21,4,'Пак Мечты','/img/items/dreamspack.png','https://yadi.sk/d/IxUYK1eC8m1CrA',2,2000),(22,4,'Пак Агеры','/img/items/agerapack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_Agera.download',70,50),(23,5,'Стили','/img/items/styles.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',85,1),(24,5,'Приватные кисти','/img/items/privkisti.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_PrivateBrushes.download',40,100),(25,5,'Пак Tota','/img/items/totapack.png','https://yadi.sk/d/sZcpA-PMUkv2Jg',2,20),(27,6,'Пак Tota','/img/items/totapack.png','https://yadi.sk/d/sZcpA-PMUkv2Jg',80,20),(28,6,'Пак Агеры','/img/items/agerapack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_Agera.download',40,50),(29,6,'Пак Аида','/img/items/aidpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_Aid.download',2,999),(30,6,'Кустик','/img/items/kustik.png','',95,0),(31,7,'Стили','/img/items/styles.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',85,1),(32,7,'GFX Пак для монтажа','/img/items/montage.png','https://yadi.sk/d/WkOj7u7ETCyraQ',8,1000),(33,7,'Рисованная шапка от Эвероши','/img/items/shapka.png','#',20,750),(34,7,'Замшелый Камень','/img/items/zamsh.png','zam',60,100),(35,7,'Рисованная аватарка\n','/img/items/avatarka.png\n','1',9,350),(36,14,'Пак кистей','/img/items/kisti.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_Brushes.download',65,250),(38,14,'Рисованный макет\n','/img/items/maket.png\n','1',10,4000),(39,14,'Пак артера','/img/items/risch.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_Drawpack.download',50,500),(41,9,'Деньги','/img/items/0rub.png','#',90,0),(42,9,'Деньги','/img/items/50rub.png','#',12,50),(43,9,'Деньги','/img/items/5rub.png','#',80,5),(44,9,'Деньги','/img/items/300rub.png','#',4,300),(45,9,'Деньги','/img/items/19rub.png','#',60,19),(46,10,'Кустик','/img/items/kustik.png','#',85,0),(47,10,'Аид','/img/items/aid.png','#',10,250),(48,10,'Стили','/img/items/styles.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',75,1),(49,10,'Неизвестность','/img/items/empty.png','#',85,0),(50,11,'Волшебный сундук','/img/items/magic.png','https://yadi.sk/d/R7U37xUpZKW-Jg',30,9000),(52,11,'Пак начинающего Ютубера','/img/items/nachpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_YTStarterPack.download',50,559),(53,11,'Пак Аида','/img/items/aidpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_Aid.download',70,999),(54,11,'Пак артера','/img/items/risch.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_Drawpack.download',40,500),(55,11,'Шапка + Аватарка от Эвероши','/img/items/shapkaava2.png','#',55,879),(56,11,'Приватный пак','/img/items/privatpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_YTPack.download',60,600),(57,8,'Шапка + приватный пак','/img/items/shapkaplusprivat.png','#',20,899),(59,8,'Пак Аида','/img/items/aidpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_Aid.download',15,999),(60,8,'Стили','/img/items/styles2.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',75,1),(61,8,'GFX пак для монтажа','/img/items/montage.png','https://yadi.sk/d/WkOj7u7ETCyraQ',8,1000),(62,12,'Шапка от Эвероши','/img/items/shapka.png','#',0,750),(63,12,'Приватный пак','/img/items/privatpack.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_YTPack.download',0,600),(64,12,'Пак приватных шрифтов','/img/items/shrifti.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_FontsPack.download',0,200),(65,12,'Стили','/img/items/styles.png','https://apiv1.ytdescase.ru/private/download/62cc4a3a5688853b88e13d1a32f9daeff809aa5b/1/YTDes_Styles1.download',61,1),(68,12,'Деньги','/img/items/50rub.png','#',0,50),(69,12,'Пак для монтажа','/img/items/montage.png','#',0,1000),(70,12,'Аватарка от Эвероши','/img/items/avatarka.png','#',0,350),(71,12,'Кустик','/img/items/kustik.png','#',99,0),(72,13,'Превью','/img/items/prevyu2.png','#',80,50),(73,13,'Шапка','/img/items/shapka2.png','#',45,400),(74,13,'Шапка + Аватарка','/img/items/shapkaava3.png','#',10,999),(75,13,'Приватный текст C4D','/img/items/c4dtxt.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_cinema4dtxt.download',60,159),(76,13,'Кустик','/img/items/kustik.png','#',88,0),(77,1,'Кустик','/img/items/kustik.png','#',91,0),(78,14,'Деньги','/img/items/300rub.png','#',55,300),(79,3,'Кустик','/img/items/kustik.png','#',92,0),(80,15,'Кустик','/img/items/kustik.png','#',90,0),(81,15,'Приватный C4D текст','/img/items/privcd4txt.png','https://apiv1.ytdescase.ru/private/download/ad8798bc01b920e86156214f5641a41dcd2a4845/1/YTDes_cinema4dtxt.download',65,40),(82,15,'Аватарка рисованная','/img/items/ava_ris.png','#',25,259),(83,15,'Шапка PSD','/img/items/psd_shapka.png','https://apiv1.ytdescase.ru/private/download/ad8798bc01b920e86156214f5641a41dcd2a4845/1/YTDes_shapka.download',55,99),(84,15,'Шапка + Приватный Пак','/img/items/shapkaprivat.png','#',7,899),(85,15,'19 рублей','/img/items/19rub.png','#',75,19),(86,16,'Интро','/img/items/intro.png','#',4,600),(87,16,'Кустик','/img/items/kustik.png','#',96,0),(88,16,'Шапка PSD','/img/items/psd_shapka.png','https://apiv1.ytdescase.ru/private/download/ad8798bc01b920e86156214f5641a41dcd2a4845/1/YTDes_shapka2.download',40,99),(89,16,'3D Аватарка','/img/items/ava_3d.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_3D.download',22,199),(90,16,'Пак приватных шрифтов','/img/items/shrifti.png','https://apiv1.ytdescase.ru/private/download/5d49f447f70bc5f0e14ed7e4ae94b5fd5ac05107/1/YTDes_FontsPack.download',10,200),(91,16,'Пак Артера','/img/items/arterpack.png','https://apiv1.ytdescase.ru/private/download/9b42b6dc8fe4bcf0c44e89f52bf214f41ebddce7/1/YTDES_Artpack.download',20,200),(92,16,'Приватный лайтрум','/img/items/privat_layt.png','https://apiv1.ytdescase.ru/private/download/ad8798bc01b920e86156214f5641a41dcd2a4845/1/YTDes_Lightroom.download',55,59),(93,16,'Цветокоррекция','/img/items/TsVETKORR.png','https://apiv1.ytdescase.ru/private/download/ad8798bc01b920e86156214f5641a41dcd2a4845/1/YTDes_Colorcorr.download',45,89),(94,16,'Пак стилей','/img/items/stylepack.png','https://apiv1.ytdescase.ru/private/download/ad8798bc01b920e86156214f5641a41dcd2a4845/1/YTDes_Stylepack.download',80,19),(95,16,'Шапка + Аватарка от Эвероши','/img/items/shapkaava2.png','#',5,899);
/*!40000 ALTER TABLE `caseitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `title` tinytext NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` mediumtext,
  `img` text,
  `cat` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Кейсы';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases`
--

LOCK TABLES `cases` WRITE;
/*!40000 ALTER TABLE `cases` DISABLE KEYS */;
INSERT INTO `cases` VALUES (1,1,'Эвероша Кейс',600,'Такой же классный, как и работы Эвероши!','/img/cases/everosha.png',1),(2,1,'Big Кейс',295,'Этот кейс  реально большой!','/img/cases/bigcase.png',1),(3,1,'Пак Кейс',129,'Паки для твоих крутых работ!','/img/cases/pack.png',1),(4,1,'Кейс Мечты',555,'Получи то, о чём мечтал!','/img/cases/dreamscase.png',1),(5,1,'Кейс Нубика',49,'Название говорит о себе...','/img/cases/noobcase.png',2),(6,1,'Железный кейс',159,'Железный как сталь','/img/cases/ironcase.png',2),(7,1,'Lucky Кейс',400,'Испытай удачу!','/img/cases/luckycase.png',2),(8,1,'Золотой Кейс',499,'Дорого, но со смыслом','/img/cases/goldcase.png',3),(9,1,'Денежный Кейс',99,'Деньги с небес не падают','/img/cases/moneycase.png',3),(10,1,'Бомжик Кейс',29,'Бюджетный вариант','/img/cases/bomjcase.png',3),(11,1,'Кейс Магистра',5000,'Поэксперементируем...?','/img/cases/nonecase.png',3),(12,1,'Бесплатный Кейс',0,'Испытай удачу в пробном режиме','/img/cases/freecase.png',5),(13,1,'Wolfs Case',400,NULL,'/img/cases/personal/wolfs.png',4),(14,1,'Dragon Кейс',2000,'Драконы везде!!','/img/cases/dragon.png',2),(15,1,'Альфа Кейс',79,'Для настоящих альфачей!','/img/cases/alfacase.png',4),(16,1,'Дизайн Кейс',169,NULL,'/img/cases/personal/design_case.png',4);
/*!40000 ALTER TABLE `cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `casewins`
--

DROP TABLE IF EXISTS `casewins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casewins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casewins`
--


--
-- Table structure for table `lastopen`
--

DROP TABLE IF EXISTS `lastopen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lastopen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lastopen`
--

LOCK TABLES `lastopen` WRITE;
/*!40000 ALTER TABLE `lastopen` DISABLE KEYS */;
/*!40000 ALTER TABLE `lastopen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lastwins`
--

DROP TABLE IF EXISTS `lastwins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lastwins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `win` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1900 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lastwins`
--


--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(6) NOT NULL,
  `payAmount` varchar(6) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Платежи';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--



--
-- Table structure for table `promocodes`
--

DROP TABLE IF EXISTS `promocodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE ucs2_bin NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `expire` datetime NOT NULL,
  `amount` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_bin COMMENT='Промокоды';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocodes`
--

LOCK TABLES `promocodes` WRITE;
/*!40000 ALTER TABLE `promocodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `last_ip` text,
  `token` text NOT NULL,
  `lastLogin_date` text,
  `balance` int(11) DEFAULT '0',
  `fname` text,
  `lname` text,
  `regdate` text,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `priv` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COMMENT='Пользователи';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-09 13:11:17
