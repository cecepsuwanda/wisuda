/*
SQLyog Community v12.2.6 (64 bit)
MySQL - 5.7.11-log : Database - wisuda
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_berita` */

DROP TABLE IF EXISTS `tb_berita`;

CREATE TABLE `tb_berita` (
  `id_berita` varchar(20) NOT NULL,
  `isi_berita` varchar(200) DEFAULT NULL,
  `tgl_post` datetime DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tb_fak` */

DROP TABLE IF EXISTS `tb_fak`;

CREATE TABLE `tb_fak` (
  `id_fak` varchar(40) NOT NULL,
  `nm_fak` varchar(50) DEFAULT NULL,
  `urut_fak` int(11) DEFAULT '1',
  PRIMARY KEY (`id_fak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tb_log_user` */

DROP TABLE IF EXISTS `tb_log_user`;

CREATE TABLE `tb_log_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lg_time` datetime NOT NULL,
  `out_time` datetime DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3910 DEFAULT CHARSET=utf8;

/*Table structure for table `tb_log_wisudawan` */

DROP TABLE IF EXISTS `tb_log_wisudawan`;

CREATE TABLE `tb_log_wisudawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lg_time` datetime NOT NULL,
  `out_time` datetime DEFAULT NULL,
  `id_wisuda` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3905 DEFAULT CHARSET=utf8;

/*Table structure for table `tb_msg` */

DROP TABLE IF EXISTS `tb_msg`;

CREATE TABLE `tb_msg` (
  `id_msg` varchar(100) NOT NULL,
  `from` varchar(100) NOT NULL,
  `idx_from` int(1) NOT NULL,
  `to` varchar(100) NOT NULL,
  `idx_to` int(1) NOT NULL,
  `isi_msg` varchar(200) DEFAULT NULL,
  `tgl_msg` datetime DEFAULT NULL,
  `is_replay` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_msg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tb_priode` */

DROP TABLE IF EXISTS `tb_priode`;

CREATE TABLE `tb_priode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `awal` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `wisuda` date DEFAULT NULL,
  `aktif` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `tb_prodi` */

DROP TABLE IF EXISTS `tb_prodi`;

CREATE TABLE `tb_prodi` (
  `id_prodi` varchar(40) NOT NULL,
  `nm_prodi` varchar(50) NOT NULL,
  `fak_prodi` varchar(8) NOT NULL,
  `urut_prodi` int(11) DEFAULT '1',
  PRIMARY KEY (`id_prodi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user_name` varchar(10) NOT NULL,
  `user_pass` varchar(40) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tb_wisudawan` */

DROP TABLE IF EXISTS `tb_wisudawan`;

CREATE TABLE `tb_wisudawan` (
  `id_wisuda` varchar(20) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tmpt_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` int(1) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `angkatan` int(4) NOT NULL,
  `id_prodi` varchar(40) NOT NULL,
  `jdl_skripsi` varchar(255) DEFAULT NULL,
  `tgl_lls` date DEFAULT NULL,
  `ipk` float DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `tgl_byr` date DEFAULT NULL,
  `kwitansi` varchar(100) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user_name` varchar(32) DEFAULT NULL,
  `user_pass` varchar(32) DEFAULT NULL,
  `ver` int(1) DEFAULT '0',
  `tgl_ver` datetime DEFAULT NULL,
  `admin_name` varchar(10) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_wisuda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
