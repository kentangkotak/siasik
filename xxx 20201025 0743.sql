-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.14-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema xxx
--

CREATE DATABASE IF NOT EXISTS xxx;
USE xxx;

--
-- Definition of table `conter`
--

DROP TABLE IF EXISTS `conter`;
CREATE TABLE `conter` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `pihak_ketiga` double(12,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conter`
--

/*!40000 ALTER TABLE `conter` DISABLE KEYS */;
INSERT INTO `conter` (`Id`,`pihak_ketiga`) VALUES 
 (1,1);
/*!40000 ALTER TABLE `conter` ENABLE KEYS */;


--
-- Definition of table `pihak_ketiga`
--

DROP TABLE IF EXISTS `pihak_ketiga`;
CREATE TABLE `pihak_ketiga` (
  `id` bigint(12) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) NOT NULL DEFAULT '',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `telepon` varchar(255) NOT NULL DEFAULT '',
  `npwp` varchar(255) NOT NULL DEFAULT '',
  `norek` varchar(255) NOT NULL DEFAULT '',
  `cp` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pihak_ketiga`
--

/*!40000 ALTER TABLE `pihak_ketiga` DISABLE KEYS */;
INSERT INTO `pihak_ketiga` (`id`,`kode`,`nama`,`alamat`,`telepon`,`npwp`,`norek`,`cp`) VALUES 
 (1,'PK1','ASD','ASD','ASD','ASD','ASD','ASD'),
 (2,'PK1','ASDXXXX','ASD','ASD','ASD','ASD','ASD');
/*!40000 ALTER TABLE `pihak_ketiga` ENABLE KEYS */;


--
-- Definition of table `satuan_barang`
--

DROP TABLE IF EXISTS `satuan_barang`;
CREATE TABLE `satuan_barang` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `satuanBarang` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan_barang`
--

/*!40000 ALTER TABLE `satuan_barang` DISABLE KEYS */;
INSERT INTO `satuan_barang` (`id`,`satuanBarang`) VALUES 
 (2,'ALBUM'),
 (3,'AMPUL'),
 (4,'BENDEL'),
 (5,'BIJI'),
 (6,'BOTOL'),
 (7,'BOX'),
 (8,'BUAH'),
 (9,'BUKU'),
 (10,'BUNGKUS'),
 (11,'DUS'),
 (12,'GALON'),
 (13,'KALI'),
 (14,'KEGIATAN'),
 (15,'KG'),
 (16,'KIT'),
 (17,'KOTAK'),
 (18,'LEMBAR'),
 (19,'LITER'),
 (20,'LUSIN'),
 (21,'METER'),
 (22,'ML'),
 (23,'PACK'),
 (24,'PAKET'),
 (25,'PASANG'),
 (26,'PCS'),
 (27,'RIM'),
 (28,'ROLL'),
 (29,'RUANG'),
 (30,'RUANGAN'),
 (31,'SACHET'),
 (32,'SET'),
 (33,'SLOP'),
 (34,'STEL'),
 (35,'SYRINGE'),
 (36,'TUBE'),
 (37,'UNIT'),
 (38,'VIAL'),
 (40,'COBA');
/*!40000 ALTER TABLE `satuan_barang` ENABLE KEYS */;


--
-- Definition of procedure `master_pihak_ketiga`
--

DROP PROCEDURE IF EXISTS `master_pihak_ketiga`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`admin`@`%` PROCEDURE `master_pihak_ketiga`(OUT nomor INT(10))
BEGIN     
    DECLARE jml INT DEFAULT 0;    
        

    DECLARE cur_query CURSOR FOR select pihak_ketiga from conter;         
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET jml = 1;
         
    OPEN cur_query; 
    WHILE (NOT jml) DO
          FETCH cur_query INTO nomor; 
          IF NOT jml THEN                
             update conter set pihak_ketiga=pihak_ketiga+1;            
          END IF;         
    END WHILE; 

    CLOSE cur_query;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
