/*
SQLyog Professional
MySQL - 10.4.22-MariaDB : Database - glbku_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`glbku_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `glbku_db`;

/*Table structure for table `angsuran` */

DROP TABLE IF EXISTS `angsuran`;

CREATE TABLE `angsuran` (
  `angsuran_id` varchar(14) NOT NULL,
  `hutang_id` varchar(14) DEFAULT NULL,
  `angsuran_periode` varchar(30) DEFAULT NULL,
  `angsuran_nilai_pembiayaan` varchar(30) DEFAULT NULL,
  `angsuran_no_tagihan` varchar(40) DEFAULT NULL,
  `angsuran_kategori` varchar(40) DEFAULT NULL,
  `angsuran_tgl` date DEFAULT NULL,
  `angsuran_user_input` varchar(14) DEFAULT NULL,
  `angsuran_tgl_input` date DEFAULT NULL,
  PRIMARY KEY (`angsuran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `angsuran` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` varchar(14) NOT NULL,
  `customer_nama` varchar(225) DEFAULT NULL,
  `customer_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `customer` */

/*Table structure for table `hutang` */

DROP TABLE IF EXISTS `hutang`;

CREATE TABLE `hutang` (
  `hutang_id` varchar(14) NOT NULL,
  `project_id` varchar(14) DEFAULT NULL,
  `hutang_nama` varchar(225) DEFAULT NULL,
  `hutang_nilai` varchar(30) DEFAULT NULL,
  `hutang_cicilan` varchar(30) DEFAULT NULL,
  `hutang_no_tagihan` varchar(50) DEFAULT NULL,
  `hutang_tgl_start` date DEFAULT NULL,
  `hutang_tgl_finish` date DEFAULT NULL,
  `hutang_jenis` varchar(30) DEFAULT NULL,
  `hutang_kategori` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`hutang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `hutang` */

/*Table structure for table `katbiaya` */

DROP TABLE IF EXISTS `katbiaya`;

CREATE TABLE `katbiaya` (
  `katbiaya_id` varchar(14) NOT NULL,
  `katbiaya_nama` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`katbiaya_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `katbiaya` */

/*Table structure for table `pembiayaan` */

DROP TABLE IF EXISTS `pembiayaan`;

CREATE TABLE `pembiayaan` (
  `pembiayaan_id` varchar(14) NOT NULL,
  `katbiaya_id` varchar(14) DEFAULT NULL,
  `project_id` varchar(14) DEFAULT NULL,
  `user_id` varchar(14) DEFAULT NULL,
  `pembiayaan_beban_biaya` varchar(60) DEFAULT NULL,
  `pembiayaan_tgl` date DEFAULT NULL,
  `pembiayaan_nilai_realisasi` varchar(30) DEFAULT NULL,
  `pembiayaan_ket` text DEFAULT NULL,
  `pembiayaan_tgl_input` date DEFAULT NULL,
  PRIMARY KEY (`pembiayaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembiayaan` */

/*Table structure for table `pendapatan` */

DROP TABLE IF EXISTS `pendapatan`;

CREATE TABLE `pendapatan` (
  `pendapatan_id` varchar(14) NOT NULL,
  `project_id` varchar(14) DEFAULT NULL,
  `pendapatan_periode` varchar(60) DEFAULT NULL,
  `pendapatan_tgl_penagihan` date DEFAULT NULL,
  `pendapatan_tgl_tempo` date DEFAULT NULL,
  `pendapatan_jml_tagihan` varchar(30) DEFAULT NULL,
  `pendapatan_ket` text DEFAULT NULL,
  `pendapatan_jml_bayar` varchar(30) DEFAULT NULL,
  `pendapatan_tgl_bayar` date DEFAULT NULL,
  PRIMARY KEY (`pendapatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pendapatan` */

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `project_id` varchar(14) NOT NULL,
  `customer_id` varchar(14) DEFAULT NULL,
  `project_nama` varchar(225) DEFAULT NULL,
  `project_layanan` varchar(50) DEFAULT NULL,
  `project_kontrak_nilai` varchar(30) DEFAULT NULL,
  `project_kontrak_start` date DEFAULT NULL,
  `project_kontrak_end` date DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `project` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` varchar(60) NOT NULL,
  `user_nama` varchar(35) DEFAULT NULL,
  `user_nmlengkap` varchar(30) DEFAULT NULL,
  `user_password` varchar(35) DEFAULT NULL,
  `user_level` varchar(2) DEFAULT NULL,
  `user_divisi` varchar(60) DEFAULT NULL,
  `user_foto` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_nama`,`user_nmlengkap`,`user_password`,`user_level`,`user_divisi`,`user_foto`) values 
('USR-0001','admin','Administrator','df6f5ecea3a179c254df64ade120060c','1','SE','user.png');

/*Table structure for table `vendor` */

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
  `vendor_id` varchar(14) NOT NULL,
  `vendor_nama` varchar(225) DEFAULT NULL,
  `vendor_telp` varchar(40) DEFAULT NULL,
  `vendor_cp` varchar(40) DEFAULT NULL,
  `vendor_top` varchar(40) DEFAULT NULL,
  `vendor_delivery` varchar(60) DEFAULT NULL,
  `vendor_alamat` text DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vendor` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
