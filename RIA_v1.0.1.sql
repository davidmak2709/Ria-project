-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: RIA
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `dogadaj`
--

DROP TABLE IF EXISTS `dogadaj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dogadaj` (
  `id_Dogadaj` int(11) NOT NULL AUTO_INCREMENT,
  `vrijeme` date NOT NULL,
  `opis` varchar(1024) COLLATE cp1250_croatian_ci NOT NULL,
  `id_Klub` int(11) NOT NULL,
  `naziv` varchar(32) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `rezervacija` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Dogadaj`),
  KEY `id_Klub` (`id_Klub`),
  CONSTRAINT `dogadaj_ibfk_1` FOREIGN KEY (`id_Klub`) REFERENCES `klub` (`id_Klub`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dogadaj`
--

LOCK TABLES `dogadaj` WRITE;
/*!40000 ALTER TABLE `dogadaj` DISABLE KEYS */;
INSERT INTO `dogadaj` VALUES (1,'2017-01-01','docek nove godine',123456789,NULL,NULL),(2,'2017-01-28','zadnja subota prvog mjeseca',123456787,NULL,NULL),(3,'2017-01-13','party za petak 13.',123456788,NULL,NULL),(4,'2023-01-20','dhskhdl',123456789,NULL,NULL),(5,'2022-02-20','daj proradi',123456789,'molimte',0),(6,'2022-02-20','radi',123456789,'tgtg',0);
/*!40000 ALTER TABLE `dogadaj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klub`
--

DROP TABLE IF EXISTS `klub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `klub` (
  `id_Klub` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) COLLATE cp1250_croatian_ci NOT NULL,
  `adresa` varchar(50) COLLATE cp1250_croatian_ci NOT NULL,
  `ocjena` float NOT NULL,
  `id_Vlasnik` int(11) NOT NULL,
  `id_Muzika` int(11) DEFAULT NULL,
  `telefon` varchar(13) COLLATE cp1250_croatian_ci NOT NULL DEFAULT '0',
  `opis` text COLLATE cp1250_croatian_ci,
  PRIMARY KEY (`id_Klub`),
  KEY `id_Vlasnik` (`id_Vlasnik`),
  KEY `id_Muzika` (`id_Muzika`),
  CONSTRAINT `Klub_ibfk_1` FOREIGN KEY (`id_Muzika`) REFERENCES `muzika` (`id_Muzika`),
  CONSTRAINT `Klub_ibfk_2` FOREIGN KEY (`id_Vlasnik`) REFERENCES `vlasnik` (`id_Vlasnik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123456835 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klub`
--

LOCK TABLES `klub` WRITE;
/*!40000 ALTER TABLE `klub` DISABLE KEYS */;
INSERT INTO `klub` VALUES (123456784,'Bačva pub','Dolac 8',4,987654321,1,'0','Polivalentni caffe bar/club prilagođen modernom vremenu. Preko dana usmjeren na kave, a navečer se pretvara u klub. Takva je i ponuda – od širokog spektra kava i čajeva, preko zdravih sokova, do najboljih hrvatskih i stranih vina i piva.'),(123456785,'Modesto','Đure Šporera 8',4,987654325,4,'0','Caffe bar „Modesto\" stvoren je i uređen vođen idejom stvaranja lokala koji odiše prijateljskom atmosferom gdje se ljudi znaju i mogu opustiti i zabaviti te istovremeno zaobići riječke okvire „šminke\" i „plastičnosti\" te umjetno stvorene dobre atmosfere po principu ekstremno skupog uređenja!'),(123456786,'Rakhia Bar','Andrije Medulića 5',1.5,987654324,5,'0','Kod nas se može na čašicu, a može i na metar-dva. :)'),(123456787,'Club Boa','Ante Starčevića 8',4,987654323,5,'0','Klub smješten u samom centru grada koji nudi opuštenu zabavu uz DJ-e, gdje svatko može naći svojih 5 minuta dobre glazbe. Preko dana ugodno mjesto za ispijanje kave koje se u toplijim danima širi i na dvije terase'),(123456788,'Karolina caffe and night bar','Gat Karoline Riječke',5,987654322,6,'0','Caffe smješten tik uz more, s velikom terasom s koje možete po danu ispraćati i dočekivati brodove u riječkoj luci, a na večer slijedi zabava uz plesnu glazbu'),(123456789,'Mystique Club','Riva 6, Rijeka',3,987654321,6,'0','Najbolji klub za zabavu preko noći i uživanje u pogledu i kavi preko dana'),(123456797,'Nina','Adamicev gat',0,987654325,1,'0','Nakon kratke pauze i preuređenja, uz novo osoblje i rukovdstvo, Nina boat club otvara svoja vrata 24.04.2015. Sa odličnim programom i novim pravcima plovidbe. Smješten u samom centru grada na Adamićevom Gatu. Preuređeno i iskorišteno do zadnjeg detalja.'),(123456798,'Crkva','Ružićeva 22',0,987654325,1,'051 267 589','Crkva je jedinstveno i čarobno mjesto u Rijeci, smješteno na kraju Ružićeve ulice, pored Rječine, neposredno prije ulaza u Harteru. Crkva je također zajednica slobodnomislećih ljudi. Crkva je posvećena elektroničkoj glazbenoj kulturi u svim svojim varijacijama pokreta, oblika i zvukova. '),(123456799,'King`s Caffe pub','Frana Kurelca 3a',0,987654325,1,'051 267 588','Nezaboravno'),(123456800,'Insomnia Club and Lounge Bar','Riva 14',0,987654325,1,'051 267 587','Takoder nezaboravno'),(123456801,'The Beertija','Slavka Krautzeka 12',0,987654325,1,'051 267 586','Uživajte u izboru preko 220 vrsti piva u hladu naših terasa uz odličnu glazbu i nasmijano osoblje'),(123456802,'Champagne Bar Pommery','Trg Republike 2',0,987654325,1,'051 267 585','Odlicno'),(123456803,'Caffe bar Corto Maltese','Riječki lukobran 1',0,987654325,1,'051 267 584','Super'),(123456804,'Garcon Bar','Koblerov trg bb',0,987654325,1,'051 267 583',''),(123456805,'Moj klub','Korzo 1',987654000,987654334,NULL,'051 123456','A'),(123456806,'Moj klub 1','Korzo 1',0,987654335,NULL,'051 123456','Ma nesto najbolje'),(123456807,'Moj klub 1','Korzo 1',0,987654337,NULL,'051 123456','Ma nesto najbolje'),(123456808,'Moj klub 1','Korzo 1',0,987654338,NULL,'051 123456','Ma nesto najbolje'),(123456809,'Moj klub 1','Korzo 1',0,987654339,NULL,'051 123456','Ma nesto najbolje'),(123456810,'Moj klub 1','Korzo 1',0,987654340,NULL,'051 123456','Ma nesto najbolje'),(123456811,'Moj klub 3','Korzo 1',0,987654341,NULL,'051 123456','jbt'),(123456812,'Moj klub 3','Korzo 1',0,987654342,NULL,'051 123456','jbt'),(123456813,'Moj klub 3','Korzo 1',0,987654343,NULL,'051 123456','jbt'),(123456814,'Moj klub 3','Korzo 1',0,987654344,NULL,'051 123456','jbt'),(123456815,'Moj klub 3','Korzo 1',0,987654345,NULL,'051 123456','jbt'),(123456816,'Moj klub 3','Korzo 1',0,987654346,NULL,'051 123456','jbt'),(123456817,'Moj klub 3','Korzo 1',0,987654347,NULL,'051 123456','jbt'),(123456818,'Moj klub 3','Korzo 1',0,987654348,NULL,'051 123456','jbt'),(123456819,'a','a',0,987654360,NULL,'a','a'),(123456820,'a','a',0,987654361,NULL,'a','a'),(123456821,'a','a',0,987654362,NULL,'a','a'),(123456822,'a','a',0,987654363,NULL,'a','a'),(123456823,'a','a',0,987654364,NULL,'a','a'),(123456824,'a','a',0,987654365,NULL,'a','a'),(123456825,'a','a',0,987654366,NULL,'a','a'),(123456826,'a','a',0,987654367,NULL,'a','a'),(123456827,'a','a',0,987654368,NULL,'a','a'),(123456828,'a','a',0,987654369,NULL,'a','a'),(123456829,'a','a',0,987654370,NULL,'a','a'),(123456830,'a','a',0,987654371,NULL,'a','a'),(123456831,'a','a',0,987654372,NULL,'a','a'),(123456832,'a','a',0,987654373,NULL,'a','a'),(123456833,'a','a',0,987654374,NULL,'a','a'),(123456834,'a','a',0,987654375,NULL,'465','aaaa');
/*!40000 ALTER TABLE `klub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentar` (
  `id_Komentar` int(11) NOT NULL AUTO_INCREMENT,
  `vrijeme` date NOT NULL,
  `sadrzaj` varchar(1024) COLLATE cp1250_croatian_ci NOT NULL,
  `id_Klub` int(11) NOT NULL,
  `id_Korisnik` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL,
  PRIMARY KEY (`id_Komentar`),
  KEY `id_Korisnik` (`id_Korisnik`),
  KEY `id_Klub` (`id_Klub`),
  CONSTRAINT `Komentar_ibfk_1` FOREIGN KEY (`id_Klub`) REFERENCES `klub` (`id_Klub`) ON DELETE CASCADE,
  CONSTRAINT `Komentar_ibfk_2` FOREIGN KEY (`id_Korisnik`) REFERENCES `korisnik` (`id_Korisnik`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentar`
--

LOCK TABLES `komentar` WRITE;
/*!40000 ALTER TABLE `komentar` DISABLE KEYS */;
INSERT INTO `komentar` VALUES (1,'2016-12-30','najbolji klub u gradu',123456789,1,0),(2,'2017-01-05','testing',123456784,1,2),(3,'2017-01-05','testing drugi put',123456784,1,-1),(4,'2017-01-29','testing treci put',123456784,3,1),(5,'2017-01-29','cetvrti',123456784,1,0),(6,'2017-12-12','odlicna stranica',123456784,3,0);
/*!40000 ALTER TABLE `komentar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `id_Korisnik` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(256) COLLATE cp1250_croatian_ci DEFAULT NULL,
  `email` varchar(30) COLLATE cp1250_croatian_ci NOT NULL,
  `ime` varchar(256) COLLATE cp1250_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`id_Korisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'admin','korisnik@gmail.com','Filip'),(2,'root','lol@gmail.com','lolich'),(3,'tn','tn@gmail.com','toni'),(4,'12345','dmakovac@gmail.com','David'),(80,'$2y$08$UbBLOcVtHO9MrAcVJdqXDuKSgP3j4fNjRnurjUmKVu6LUL5L67S/S','davidmakovac95@gmail.com','David Makovac'),(81,'$2y$08$SsAHYfUnJbf0EMCndFLiI.DN9bbNaZgnPhQd15m04WXATbe23FISu','negulic17@gmail.com','Toni Negulic'),(82,'$2y$08$lQNTFPwuChbvDzslcllhtuTp1L3pGYL/dsGq.Jh9iHqIsFoVZYyIy','a','marko a');
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muzika`
--

DROP TABLE IF EXISTS `muzika`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `muzika` (
  `id_Muzika` int(11) NOT NULL AUTO_INCREMENT,
  `zanr` varchar(30) COLLATE cp1250_croatian_ci NOT NULL,
  `broj obožavatelja` int(11) NOT NULL,
  PRIMARY KEY (`id_Muzika`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muzika`
--

LOCK TABLES `muzika` WRITE;
/*!40000 ALTER TABLE `muzika` DISABLE KEYS */;
INSERT INTO `muzika` VALUES (1,'Rock',1),(2,'Jazz',0),(4,'Classic',1),(5,'Pop',0),(6,'Techno',0),(7,'Hip-hop',0),(8,'Funk',0),(9,'Narodna',0),(10,'Domace',0);
/*!40000 ALTER TABLE `muzika` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocjena_klub`
--

DROP TABLE IF EXISTS `ocjena_klub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocjena_klub` (
  `id_Klub` int(11) NOT NULL,
  `id_Korisnik` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL,
  PRIMARY KEY (`id_Klub`,`id_Korisnik`),
  KEY `id_Klub` (`id_Klub`),
  KEY `id_Korisnik` (`id_Korisnik`),
  CONSTRAINT `ocjena_klub_ibfk_1` FOREIGN KEY (`id_Klub`) REFERENCES `klub` (`id_Klub`) ON DELETE CASCADE,
  CONSTRAINT `ocjena_klub_ibfk_2` FOREIGN KEY (`id_Korisnik`) REFERENCES `korisnik` (`id_Korisnik`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocjena_klub`
--

LOCK TABLES `ocjena_klub` WRITE;
/*!40000 ALTER TABLE `ocjena_klub` DISABLE KEYS */;
INSERT INTO `ocjena_klub` VALUES (123456784,1,4),(123456784,2,3),(123456784,3,5);
/*!40000 ALTER TABLE `ocjena_klub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocjena_komentar`
--

DROP TABLE IF EXISTS `ocjena_komentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocjena_komentar` (
  `id_Korisnik` int(11) NOT NULL,
  `id_Komentar` int(11) NOT NULL,
  `ocjena` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_Korisnik`,`id_Komentar`),
  KEY `id_Korisnik` (`id_Korisnik`),
  KEY `id_Komentar` (`id_Komentar`),
  CONSTRAINT `ocjena_komentar_ibfk_1` FOREIGN KEY (`id_Korisnik`) REFERENCES `korisnik` (`id_Korisnik`) ON DELETE CASCADE,
  CONSTRAINT `ocjena_komentar_ibfk_2` FOREIGN KEY (`id_Komentar`) REFERENCES `komentar` (`id_Komentar`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocjena_komentar`
--

LOCK TABLES `ocjena_komentar` WRITE;
/*!40000 ALTER TABLE `ocjena_komentar` DISABLE KEYS */;
INSERT INTO `ocjena_komentar` VALUES (1,2,1),(1,3,0),(1,4,1),(2,2,1),(2,3,-1);
/*!40000 ALTER TABLE `ocjena_komentar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pretplata`
--

DROP TABLE IF EXISTS `pretplata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pretplata` (
  `id_Korisnik` int(11) NOT NULL,
  `id_Klub` int(11) NOT NULL,
  `notifikacije` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_Korisnik`,`id_Klub`),
  KEY `id_Klub` (`id_Klub`),
  KEY `id_Korisnik` (`id_Korisnik`),
  CONSTRAINT `Pretplata_ibfk_1` FOREIGN KEY (`id_Korisnik`) REFERENCES `korisnik` (`id_Korisnik`) ON DELETE CASCADE,
  CONSTRAINT `Pretplata_ibfk_2` FOREIGN KEY (`id_Klub`) REFERENCES `klub` (`id_Klub`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pretplata`
--

LOCK TABLES `pretplata` WRITE;
/*!40000 ALTER TABLE `pretplata` DISABLE KEYS */;
/*!40000 ALTER TABLE `pretplata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rezervacija`
--

DROP TABLE IF EXISTS `rezervacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rezervacija` (
  `id_Korisnik` int(11) NOT NULL,
  `id_Dogadaj` int(11) NOT NULL,
  PRIMARY KEY (`id_Dogadaj`,`id_Korisnik`),
  KEY `id_Korisnik` (`id_Korisnik`),
  KEY `id_Dogadaj` (`id_Dogadaj`),
  CONSTRAINT `Rezervacija_ibfk_1` FOREIGN KEY (`id_Korisnik`) REFERENCES `korisnik` (`id_Korisnik`) ON DELETE CASCADE,
  CONSTRAINT `Rezevacija_ibfk_2` FOREIGN KEY (`id_Dogadaj`) REFERENCES `dogadaj` (`id_Dogadaj`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rezervacija`
--

LOCK TABLES `rezervacija` WRITE;
/*!40000 ALTER TABLE `rezervacija` DISABLE KEYS */;
INSERT INTO `rezervacija` VALUES (1,1),(2,1),(2,2),(3,1);
/*!40000 ALTER TABLE `rezervacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vlasnik`
--

DROP TABLE IF EXISTS `vlasnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vlasnik` (
  `id_Vlasnik` int(11) NOT NULL AUTO_INCREMENT,
  `id_korisnik` int(11) NOT NULL,
  PRIMARY KEY (`id_Vlasnik`),
  KEY `id_korisnik` (`id_korisnik`),
  KEY `id_korisnik_2` (`id_korisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=987654376 DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vlasnik`
--

LOCK TABLES `vlasnik` WRITE;
/*!40000 ALTER TABLE `vlasnik` DISABLE KEYS */;
INSERT INTO `vlasnik` VALUES (987654321,0),(987654322,0),(987654323,0),(987654324,0),(987654325,0),(987654326,21),(987654327,22),(987654328,23),(987654329,24),(987654330,25),(987654331,26),(987654332,27),(987654333,28),(987654334,29),(987654335,30),(987654336,31),(987654337,32),(987654338,33),(987654339,34),(987654340,35),(987654341,36),(987654342,37),(987654343,38),(987654344,39),(987654345,40),(987654346,41),(987654347,42),(987654348,43),(987654349,45),(987654350,46),(987654351,47),(987654352,48),(987654353,49),(987654354,50),(987654355,54),(987654356,55),(987654357,58),(987654358,59),(987654359,60),(987654360,61),(987654361,62),(987654362,63),(987654363,64),(987654364,65),(987654365,66),(987654366,67),(987654367,68),(987654368,70),(987654369,71),(987654370,72),(987654371,73),(987654372,74),(987654373,75),(987654374,76),(987654375,81);
/*!40000 ALTER TABLE `vlasnik` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-09 13:01:49
