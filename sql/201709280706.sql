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
/*Table structure for table `tb_fak` */

DROP TABLE IF EXISTS `tb_fak`;

CREATE TABLE `tb_fak` (
  `id_fak` varchar(40) NOT NULL,
  `nm_fak` varchar(50) DEFAULT NULL,
  `urut_fak` int(11) DEFAULT '1',
  PRIMARY KEY (`id_fak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_fak` */

insert  into `tb_fak`(`id_fak`,`nm_fak`,`urut_fak`) values 
('FAPERTA','Pertanian',1),
('FE','Ekonomi',3),
('FIKES','Ilmu Kesehatan',7),
('FISIP','Ilmu Sosial dan Ilmu Politik',5),
('FKIP','Keguruan Dan Ilmu Pendidikan',2),
('FMIPA','Matematika dan Ilmu Pengetahuan Alam',6),
('FTI','Teknologi Informasi',4);

/*Table structure for table `tb_prodi` */

DROP TABLE IF EXISTS `tb_prodi`;

CREATE TABLE `tb_prodi` (
  `id_prodi` varchar(40) NOT NULL,
  `nm_prodi` varchar(50) NOT NULL,
  `fak_prodi` varchar(8) NOT NULL,
  `urut_prodi` int(11) DEFAULT '1',
  PRIMARY KEY (`id_prodi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tb_prodi` */

insert  into `tb_prodi`(`id_prodi`,`nm_prodi`,`fak_prodi`,`urut_prodi`) values 
('54201','Agribisnis','FAPERTA',1),
('54211','Agroteknologi','FAPERTA',2),
('62201','Akuntansi','FE',8),
('87202','Pendidikan Geografi','FKIP',4),
('55201','Teknik Informatika','FTI',10),
('88201','Pendidikan Bahasa Indonesia','FKIP',6),
('88203','Pendidikan Bahasa Inggris','FKIP',5),
('65201','Ilmu Pemerintahan','FISIP',9),
('87220','Pendidikan Ilmu Pengetahuan Sosial','FKIP',7),
('14201','Keperawatan','FIKES',13),
('44201','Matematika','FMIPA',12),
('57201','Sistem Informasi','FTI',11),
('41221','Teknologi Pangan','FAPERTA',3);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user_name` varchar(10) NOT NULL,
  `user_pass` varchar(40) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user_name`,`user_pass`,`tgl_input`) values 
('admin','827ccb0eea8a706c4c34a16891f84e7b','2017-09-27 07:19:58');

/*Table structure for table `tb_wisudawan` */

DROP TABLE IF EXISTS `tb_wisudawan`;

CREATE TABLE `tb_wisudawan` (
  `ktp` varchar(20) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `tmpt_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` int(1) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `nim` varchar(10) NOT NULL,
  `angkatan` int(4) DEFAULT NULL,
  `id_prodi` varchar(40) DEFAULT NULL,
  `jdl_skripsi` varchar(255) DEFAULT NULL,
  `tgl_lls` date DEFAULT NULL,
  `ipk` float DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `kwitansi` varchar(100) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(100) DEFAULT NULL,
  `ver` int(1) DEFAULT NULL,
  `tgl_ver` datetime DEFAULT NULL,
  `admin_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_wisudawan` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
