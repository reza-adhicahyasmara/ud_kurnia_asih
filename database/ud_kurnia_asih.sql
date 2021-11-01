/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.21-MariaDB : Database - ud_kurnia_asih
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ud_kurnia_asih` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ud_kurnia_asih`;

/*Table structure for table `t_bahan_baku` */

DROP TABLE IF EXISTS `t_bahan_baku`;

CREATE TABLE `t_bahan_baku` (
  `kode_bb` varchar(10) NOT NULL,
  `id_supplier` varchar(50) DEFAULT NULL,
  `kode_satuan` int(10) DEFAULT NULL,
  `kode_kategori` int(10) DEFAULT NULL,
  `nama_bb` varchar(50) DEFAULT NULL,
  `harga_bb` float DEFAULT NULL,
  `stok_gudang_pab_bb` float DEFAULT NULL,
  `stok_limit_pab_bb` float DEFAULT NULL,
  `stok_gudang_sup_bb` float DEFAULT NULL,
  `stok_limit_sup_bb` float DEFAULT NULL,
  PRIMARY KEY (`kode_bb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_bahan_baku` */

insert  into `t_bahan_baku`(`kode_bb`,`id_supplier`,`kode_satuan`,`kode_kategori`,`nama_bb`,`harga_bb`,`stok_gudang_pab_bb`,`stok_limit_pab_bb`,`stok_gudang_sup_bb`,`stok_limit_sup_bb`) values 
('BB1','supplier1',8,3,'Bawang Merah',30000,11119.8,1000,-8000,200),
('BB2','supplier1',8,3,'Bawang Putih',16000,6102,1000,21000,100);

/*Table structure for table `t_bank` */

DROP TABLE IF EXISTS `t_bank`;

CREATE TABLE `t_bank` (
  `kode_bank` varchar(5) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_bank` */

insert  into `t_bank`(`kode_bank`,`nama_bank`) values 
('008','BANK MANDIRI'),
('009','BANK NEGARA INDONESIA'),
('011','BANK DANAMON INDONESIA'),
('013','BANK PERMATA'),
('014','BANK CENTRAL ASIA'),
('016','BANK MAYBANK  INDONESIA'),
('019','PAN INDONESIA BANK'),
('022','BANK CIMB NIAGA'),
('023','BANK UOB INDONESIA'),
('028','BANK OCBC NISP'),
('031','CITIBANK N.A.'),
('032','JP MORGAN CHASE BANK NA'),
('033','BANK OF AMERICA N.A'),
('036','BANK CHINA CONSTRUCTION BANK INDONESIA'),
('037','BANK ARTHA GRAHA INTERNASIONAL'),
('040','BANGKOK BANK PCL'),
('042','MUFG BANK LTD'),
('046','BANK DBS INDONESIA'),
('047','BANK RESONA PERDANIA'),
('048','BANK MIZUHO INDONESIA'),
('050','STANDARD CHARTERED BANK'),
('054','BANK CAPITAL INDONESIA'),
('057','BANK BNP PARIBAS INDONESIA'),
('061','BANK ANZ INDONESIA'),
('067','DEUTSCHE BANK AG'),
('069','BANK OF CHINA (HONG KONG) LIMITED'),
('076','BANK BUMI ARTA'),
('087','BANK HSBC INDONESIA'),
('095','BANK JTRUST INDONESIA'),
('097','BANK MAYAPADA INTERNATIONAL'),
('110','BPD JAWA BARAT DAN BANTEN'),
('111','BPD DKI'),
('112','BPD DAERAH ISTIMEWA YOGYAKARTA'),
('113','BPD JAWA TENGAH'),
('114','BPD JAWA TIMUR'),
('115','BPD JAMBI'),
('116','BANK ACEH SYARIAH'),
('117','BPD SUMATERA UTARA'),
('118','BPD SUMATERA BARAT'),
('119','BPD RIAU KEPRI'),
('120','BPD SUMATERA SELATAN DAN BANGKA BELITUNG'),
('121','BPD LAMPUNG'),
('122','BPD KALIMANTAN SELATAN'),
('123','BPD KALIMANTAN BARAT'),
('124','BPD KALIMANTAN TIMUR DAN KALIMANTAN UTARA'),
('125','BPD KALIMANTAN TENGAH'),
('126','BPD SULAWESI SELATAN DAN SULAWESI BARAT'),
('127','BPD SULAWESI UTARA DAN  GORONTALO'),
('128','BANK NTB SYARIAH'),
('129','BPD BALI'),
('130','BPD NUSA TENGGARA TIMUR'),
('131','BPD MALUKU DAN MALUKU UTARA'),
('132','BPD PAPUA'),
('133','BPD BENGKULU'),
('134','BPD SULAWESI TENGAH'),
('135','BPD SULAWESI TENGGARA'),
('137','BPD BANTEN'),
('146','BANK OF INDIA INDONESIA'),
('147','BANK MUAMALAT INDONESIA'),
('151','BANK MESTIKA DHARMA'),
('152','BANK SHINHAN INDONESIA'),
('153','BANK SINARMAS'),
('157','BANK MASPION INDONESIA'),
('161','BANK GANESHA'),
('164','BANK ICBC INDONESIA'),
('167','BANK QNB INDONESIA'),
('200','BANK TABUNGAN NEGARA'),
('212','BANK WOORI SAUDARA INDONESIA 1906'),
('213','BANK BTPN'),
('405','BANK VICTORIA SYARIAH'),
('425','BANK JABAR BANTEN SYARIAH'),
('426','BANK MEGA'),
('441','BANK KB BUKOPIN'),
('451','BANK SYARIAH Indonesia'),
('459','BANK BISNIS INTERNASIONAL'),
('472','BANK JASA JAKARTA'),
('484','BANK KEB HANA INDONESIA'),
('485','BANK MNC INTERNASIONAL'),
('490','BANK NEO COMMERCE'),
('494','BANK RAKYAT INDONESIA AGRONIAGA'),
('498','BANK SBI INDONESIA'),
('501','BANK DIGITAL BCA'),
('503','BANK NATIONALNOBU'),
('506','BANK MEGA SYARIAH'),
('513','BANK INA PERDANA'),
('517','BANK PANIN DUBAI SYARIAH'),
('520','PRIMA MASTER BANK'),
('521','BANK KB BUKOPIN SYARIAH'),
('523','BANK SAHABAT SAMPOERNA'),
('526','BANK OKE INDONESIA'),
('531','BANK AMAR INDONESIA'),
('535','BANK SEABANK INDONESIA'),
('536','BANK BCA SYARIAH'),
('542','BANK JAGO'),
('547','BANK BTPN SYARIAH'),
('548','BANK MULTIARTA SENTOSA'),
('553','BANK MAYORA'),
('555','BANK INDEX SELINDO'),
('562','BANK FAMA INTERNASIONAL'),
('564','BANK MANDIRI TASPEN'),
('566','BANK VICTORIA INTERNATIONAL'),
('567','ALLO BANK Indonesia'),
('945','BANK IBK INDONESIA'),
('947','BANK ALADIN SYARIAH'),
('949','BANK CTBC INDONESIA'),
('950','BANK COMMONWEALTH'),
('﻿002','BANK RAKYAT INDONESIA');

/*Table structure for table `t_bb_keluar` */

DROP TABLE IF EXISTS `t_bb_keluar`;

CREATE TABLE `t_bb_keluar` (
  `kode_bb_keluar` varchar(50) NOT NULL,
  `kode_bb` varchar(10) DEFAULT NULL,
  `jumlah_bb_keluar` float DEFAULT NULL,
  `tanggal_bb_keluar` datetime DEFAULT NULL,
  `keterangan_bb_keluar` text DEFAULT NULL,
  PRIMARY KEY (`kode_bb_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_bb_keluar` */

insert  into `t_bb_keluar`(`kode_bb_keluar`,`kode_bb`,`jumlah_bb_keluar`,`tanggal_bb_keluar`,`keterangan_bb_keluar`) values 
('BBOUT-BB1-20211103010437','BB1',200,'2021-11-03 01:04:37','dfdf'),
('BBOUT-BB1-20211104010449','BB1',50,'2021-11-04 01:04:49','sdfd'),
('BBOUT-BB1-20211223010610','BB1',565,'2021-12-23 01:06:10','tryyt'),
('BBOUT-BB1-20220205010621','BB1',45,'2022-02-05 01:06:21','ertre');

/*Table structure for table `t_customer` */

DROP TABLE IF EXISTS `t_customer`;

CREATE TABLE `t_customer` (
  `id_customer` varchar(50) NOT NULL,
  `nama_customer` varchar(50) DEFAULT NULL,
  `pic_customer` varchar(30) DEFAULT NULL,
  `kontak_customer` varchar(15) DEFAULT NULL,
  `alamat_customer` text DEFAULT NULL,
  `username_customer` varchar(50) DEFAULT NULL,
  `password_customer` varchar(50) DEFAULT NULL,
  `foto_customer` varchar(255) DEFAULT NULL,
  `ongkir_customer` float DEFAULT NULL,
  `berat_ongkir_customer` float DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_customer` */

insert  into `t_customer`(`id_customer`,`nama_customer`,`pic_customer`,`kontak_customer`,`alamat_customer`,`username_customer`,`password_customer`,`foto_customer`,`ongkir_customer`,`berat_ongkir_customer`) values 
('customer1','PT. Indofood','Linda','022989328231','Cikarang Bekasi Jawa Barat Indonesia','customer1','customer1','240491470_5003607496321969_5280599523436956808_n.jpg',500000,5000),
('fec59ec8091b2276c1c248d9fabf3cea20211027','PT. Wings','Marcell','023244343434','Karawang Jawa Barat','customer2','customer2','240491470_5003607496321969_5280599523436956808_n1.jpg',400000,5000);

/*Table structure for table `t_ipemesanan_bb` */

DROP TABLE IF EXISTS `t_ipemesanan_bb`;

CREATE TABLE `t_ipemesanan_bb` (
  `kode_ipemesanan_bb` int(10) NOT NULL AUTO_INCREMENT,
  `kode_pemesanan_bb` varchar(50) DEFAULT NULL,
  `id_supplier` varchar(50) DEFAULT NULL,
  `kode_bb` varchar(10) DEFAULT NULL,
  `tanggal_masuk_ipemesanan_bb` datetime DEFAULT NULL,
  `tanggal_kadaluwarsa_ipemesanan_bb` date DEFAULT NULL,
  `jumlah_ipemesanan_bb` float DEFAULT NULL,
  `harga_ipemesanan_bb` float DEFAULT NULL,
  `subtotal_ipemesanan_bb` float DEFAULT NULL,
  `status_ipemesanan_bb` int(10) DEFAULT NULL COMMENT '1: cart, 2: after checkout, 3: sent, 4: accepted, 5: retur, 6: done',
  `keterangan_retur_ipemesanan_bb` text DEFAULT NULL,
  `jumlah_retur_ipemesanan_bb` float DEFAULT NULL,
  PRIMARY KEY (`kode_ipemesanan_bb`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_ipemesanan_bb` */

insert  into `t_ipemesanan_bb`(`kode_ipemesanan_bb`,`kode_pemesanan_bb`,`id_supplier`,`kode_bb`,`tanggal_masuk_ipemesanan_bb`,`tanggal_kadaluwarsa_ipemesanan_bb`,`jumlah_ipemesanan_bb`,`harga_ipemesanan_bb`,`subtotal_ipemesanan_bb`,`status_ipemesanan_bb`,`keterangan_retur_ipemesanan_bb`,`jumlah_retur_ipemesanan_bb`) values 
(2,'INV-20211029201005-supplier1','supplier1','BB1','2021-11-01 17:11:57','2021-10-30',6000,30000,180000000,6,'adsdsdas',34),
(3,'INV-20211029201005-supplier1','supplier1','BB2','2021-11-01 17:11:57','2021-10-30',3000,16000,48000000,6,'',0);

/*Table structure for table `t_ipemesanan_produk` */

DROP TABLE IF EXISTS `t_ipemesanan_produk`;

CREATE TABLE `t_ipemesanan_produk` (
  `kode_ipemesanan_produk` int(10) NOT NULL AUTO_INCREMENT,
  `kode_pemesanan_produk` varchar(50) DEFAULT NULL,
  `id_customer` varchar(50) DEFAULT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `tanggal_masuk_ipemesanan_produk` datetime DEFAULT NULL,
  `tanggal_kadaluwarsa_ipemesanan_produk` date DEFAULT NULL,
  `jumlah_ipemesanan_produk` float DEFAULT NULL,
  `harga_ipemesanan_produk` float DEFAULT NULL,
  `subtotal_ipemesanan_produk` float DEFAULT NULL,
  `status_ipemesanan_produk` int(10) DEFAULT NULL,
  `keterangan_retur_ipemesanan_produk` text DEFAULT NULL,
  `jumlah_retur_ipemesanan_produk` float DEFAULT NULL,
  PRIMARY KEY (`kode_ipemesanan_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_ipemesanan_produk` */

insert  into `t_ipemesanan_produk`(`kode_ipemesanan_produk`,`kode_pemesanan_produk`,`id_customer`,`kode_produk`,`tanggal_masuk_ipemesanan_produk`,`tanggal_kadaluwarsa_ipemesanan_produk`,`jumlah_ipemesanan_produk`,`harga_ipemesanan_produk`,`subtotal_ipemesanan_produk`,`status_ipemesanan_produk`,`keterangan_retur_ipemesanan_produk`,`jumlah_retur_ipemesanan_produk`) values 
(3,'INV-20211031161029-customer1','customer1','PRO1','2021-10-31 20:10:23','2021-11-30',500,23000,11500000,6,'',0),
(5,NULL,'customer1','PRO1',NULL,NULL,100,23000,2300000,1,NULL,NULL);

/*Table structure for table `t_iretur_bb` */

DROP TABLE IF EXISTS `t_iretur_bb`;

CREATE TABLE `t_iretur_bb` (
  `kode_iretur_bb` int(10) NOT NULL AUTO_INCREMENT,
  `kode_retur_bb` varchar(50) DEFAULT NULL,
  `id_supplier` varchar(50) DEFAULT NULL,
  `kode_bb` varchar(10) DEFAULT NULL,
  `jumlah_iretur_bb` float DEFAULT NULL,
  `keterangan_iretur_bb` text DEFAULT NULL,
  `keterangan_batal_iretur_bb` text DEFAULT NULL,
  `gambar_iretur_bb` varchar(255) DEFAULT NULL,
  `status_iretur_bb` int(10) DEFAULT NULL COMMENT '1: input, 2: proses, 3: terima, 4: batal',
  PRIMARY KEY (`kode_iretur_bb`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_iretur_bb` */

insert  into `t_iretur_bb`(`kode_iretur_bb`,`kode_retur_bb`,`id_supplier`,`kode_bb`,`jumlah_iretur_bb`,`keterangan_iretur_bb`,`keterangan_batal_iretur_bb`,`gambar_iretur_bb`,`status_iretur_bb`) values 
(2,'RETBB-20211030221044-supplier1','supplier1','BB1',23,'sfdfdfd','gitu lah','240491470_5003607496321969_5280599523436956808_n.jpg',4),
(3,'RETBB-20211030221044-supplier1','supplier1','BB2',43,'erere','','jeniper-sirup1.png',3),
(4,'RETBB-20211031101002-supplier1','supplier1','BB1',100,'ini nih rusak','','240491470_5003607496321969_5280599523436956808_n1.jpg',3),
(6,'RETBB-20211031101002-supplier1','supplier1','BB2',30,'gitu lah','G kenapa kenapa','240491470_5003607496321969_5280599523436956808_n2.jpg',4),
(8,'RETBB-20211031101030-supplier1','supplier1','BB1',5979,'dfdfdf','','240491470_5003607496321969_5280599523436956808_n3.jpg',3);

/*Table structure for table `t_iretur_produk` */

DROP TABLE IF EXISTS `t_iretur_produk`;

CREATE TABLE `t_iretur_produk` (
  `kode_iretur_produk` int(10) NOT NULL AUTO_INCREMENT,
  `kode_retur_produk` varchar(50) DEFAULT NULL,
  `id_customer` varchar(50) DEFAULT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `jumlah_iretur_produk` float DEFAULT NULL,
  `keterangan_iretur_produk` text DEFAULT NULL,
  `keterangan_batal_iretur_produk` text DEFAULT NULL,
  `gambar_iretur_produk` varchar(255) DEFAULT NULL,
  `status_iretur_produk` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_iretur_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_iretur_produk` */

insert  into `t_iretur_produk`(`kode_iretur_produk`,`kode_retur_produk`,`id_customer`,`kode_produk`,`jumlah_iretur_produk`,`keterangan_iretur_produk`,`keterangan_batal_iretur_produk`,`gambar_iretur_produk`,`status_iretur_produk`) values 
(7,'RETPRO-20211101091146-customer1','customer1','PRO1',23,'sdf','','green-large-home1.png',3),
(8,'RETPRO-20211101091146-customer1','customer1','PRO2',2,'we','fadasdsad','jeniper-sirup4.png',4);

/*Table structure for table `t_karyawan` */

DROP TABLE IF EXISTS `t_karyawan`;

CREATE TABLE `t_karyawan` (
  `nik_karyawan` varchar(10) NOT NULL,
  `level_karyawan` varchar(10) DEFAULT NULL,
  `nama_karyawan` varchar(30) DEFAULT NULL,
  `alamat_karyawan` text DEFAULT NULL,
  `kontak_karyawan` varbinary(15) DEFAULT NULL,
  `username_karyawan` varchar(50) DEFAULT NULL,
  `password_karyawan` varchar(50) DEFAULT NULL,
  `foto_karyawan` text DEFAULT NULL,
  PRIMARY KEY (`nik_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_karyawan` */

insert  into `t_karyawan`(`nik_karyawan`,`level_karyawan`,`nama_karyawan`,`alamat_karyawan`,`kontak_karyawan`,`username_karyawan`,`password_karyawan`,`foto_karyawan`) values 
('11111','Admin','Namanya Admin','Kuningan 	','081111111111','admin','admin','240491470_5003607496321969_5280599523436956808_n.jpg'),
('22222','Pimpinan','Namanya Pimpinan','Kuningan','082222222222','pimpinan','pimpinan',''),
('33333','Gudang','Namanya Gudang','Kuningan','083333333333','gudang','gudang',NULL);

/*Table structure for table `t_kategori` */

DROP TABLE IF EXISTS `t_kategori`;

CREATE TABLE `t_kategori` (
  `kode_kategori` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_kategori` */

insert  into `t_kategori`(`kode_kategori`,`nama_kategori`) values 
(1,'Minyak Goreng'),
(2,'Bumbu'),
(3,'Bawang'),
(4,'Gas');

/*Table structure for table `t_pemesanan_bb` */

DROP TABLE IF EXISTS `t_pemesanan_bb`;

CREATE TABLE `t_pemesanan_bb` (
  `kode_pemesanan_bb` varchar(50) NOT NULL,
  `id_supplier` varchar(50) DEFAULT NULL,
  `kode_rekening` int(10) DEFAULT NULL,
  `tanggal_pemesanan_bb` datetime DEFAULT NULL,
  `tanggal_terima_pemesanan_bb` datetime DEFAULT NULL,
  `bukti_pby_pemesanan_bb` varchar(255) DEFAULT NULL,
  `total_pby_pemesanan_bb` float DEFAULT NULL,
  `status_pby_pemesanan_bb` int(10) DEFAULT NULL,
  `keterangan_batal_pemesanan_bb` text DEFAULT NULL,
  `status_pemesanan_bb` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_pemesanan_bb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_pemesanan_bb` */

insert  into `t_pemesanan_bb`(`kode_pemesanan_bb`,`id_supplier`,`kode_rekening`,`tanggal_pemesanan_bb`,`tanggal_terima_pemesanan_bb`,`bukti_pby_pemesanan_bb`,`total_pby_pemesanan_bb`,`status_pby_pemesanan_bb`,`keterangan_batal_pemesanan_bb`,`status_pemesanan_bb`) values 
('INV-20211029201005-supplier1','supplier1',3,'2021-10-29 20:10:05','2021-11-01 17:11:57','240491470_5003607496321969_5280599523436956808_n.jpg',228400000,3,NULL,5);

/*Table structure for table `t_pemesanan_produk` */

DROP TABLE IF EXISTS `t_pemesanan_produk`;

CREATE TABLE `t_pemesanan_produk` (
  `kode_pemesanan_produk` varchar(50) NOT NULL,
  `id_customer` varchar(50) DEFAULT NULL,
  `kode_rekening` int(10) DEFAULT NULL,
  `tanggal_pemesanan_produk` datetime DEFAULT NULL,
  `tanggal_terima_pemesanan_produk` datetime DEFAULT NULL,
  `bukti_pby_pemesanan_produk` varchar(255) DEFAULT NULL,
  `total_pby_pemesanan_produk` float DEFAULT NULL,
  `status_pby_pemesanan_produk` int(10) DEFAULT NULL,
  `keterangan_batal_pemesanan_produk` text DEFAULT NULL,
  `status_pemesanan_produk` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_pemesanan_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_pemesanan_produk` */

insert  into `t_pemesanan_produk`(`kode_pemesanan_produk`,`id_customer`,`kode_rekening`,`tanggal_pemesanan_produk`,`tanggal_terima_pemesanan_produk`,`bukti_pby_pemesanan_produk`,`total_pby_pemesanan_produk`,`status_pby_pemesanan_produk`,`keterangan_batal_pemesanan_produk`,`status_pemesanan_produk`) values 
('INV-20211031161029-customer1','customer1',7,'2021-10-31 16:10:29','2021-10-31 20:10:23','240491470_5003607496321969_5280599523436956808_n1.jpg',12000000,3,NULL,5);

/*Table structure for table `t_penyesuaian_bb` */

DROP TABLE IF EXISTS `t_penyesuaian_bb`;

CREATE TABLE `t_penyesuaian_bb` (
  `kode_penyesuaian_bb` varchar(50) NOT NULL,
  `kode_bb` varchar(10) DEFAULT NULL,
  `jumlah_penyesuaian_bb` float DEFAULT NULL,
  `tanggal_penyesuaian_bb` datetime DEFAULT NULL,
  `keterangan_penyesuaian_bb` text DEFAULT NULL,
  `gambar_penyesuaian_bb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_penyesuaian_bb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_penyesuaian_bb` */

insert  into `t_penyesuaian_bb`(`kode_penyesuaian_bb`,`kode_bb`,`jumlah_penyesuaian_bb`,`tanggal_penyesuaian_bb`,`keterangan_penyesuaian_bb`,`gambar_penyesuaian_bb`) values 
('PSBB-BB1-20211030040726','BB1',-20.23,'2021-10-30 04:07:26','asdsd','');

/*Table structure for table `t_penyesuaian_produk` */

DROP TABLE IF EXISTS `t_penyesuaian_produk`;

CREATE TABLE `t_penyesuaian_produk` (
  `kode_penyesuaian_produk` varchar(50) NOT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `jumlah_penyesuaian_produk` float DEFAULT NULL,
  `tanggal_penyesuaian_produk` datetime DEFAULT NULL,
  `keterangan_penyesuaian_produk` text DEFAULT NULL,
  `gambar_penyesuaian_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_penyesuaian_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_penyesuaian_produk` */

/*Table structure for table `t_produk` */

DROP TABLE IF EXISTS `t_produk`;

CREATE TABLE `t_produk` (
  `kode_produk` varchar(10) NOT NULL,
  `kode_satuan` int(10) DEFAULT NULL,
  `kode_kategori` int(10) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga_produk` float DEFAULT NULL,
  `stok_gudang_produk` float DEFAULT NULL,
  `stok_limit_produk` float DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_produk` */

insert  into `t_produk`(`kode_produk`,`kode_satuan`,`kode_kategori`,`nama_produk`,`harga_produk`,`stok_gudang_produk`,`stok_limit_produk`,`gambar_produk`) values 
('PRO1',8,3,'Bawang Goreng',23000,49945,1000,NULL),
('PRO2',8,3,'test',30000,0,30,NULL);

/*Table structure for table `t_produk_masuk` */

DROP TABLE IF EXISTS `t_produk_masuk`;

CREATE TABLE `t_produk_masuk` (
  `kode_produk_masuk` varchar(50) NOT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `jumlah_produk_masuk` float DEFAULT NULL,
  `tanggal_produk_masuk` datetime DEFAULT NULL,
  `keterangan_produk_masuk` text DEFAULT NULL,
  PRIMARY KEY (`kode_produk_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_produk_masuk` */

insert  into `t_produk_masuk`(`kode_produk_masuk`,`kode_produk`,`jumlah_produk_masuk`,`tanggal_produk_masuk`,`keterangan_produk_masuk`) values 
('PRK-PRO1-20211031010718','PRO1',4000,'2021-10-31 01:07:18','trt'),
('PRK-PRO1-20211031021635','PRO1',1000,'2021-10-31 02:16:35',''),
('PRK-PRO1-20220101010726','PRO1',45445,'2021-12-01 01:07:26','trtre');

/*Table structure for table `t_proposal` */

DROP TABLE IF EXISTS `t_proposal`;

CREATE TABLE `t_proposal` (
  `kode_proposal` int(10) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) DEFAULT NULL,
  `tanggal_proposal` datetime DEFAULT NULL,
  `judul_proposal` varchar(100) DEFAULT NULL,
  `berkas_proposal` varchar(255) DEFAULT NULL,
  `status_proposal` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_proposal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_proposal` */

/*Table structure for table `t_rekening` */

DROP TABLE IF EXISTS `t_rekening`;

CREATE TABLE `t_rekening` (
  `kode_rekening` int(10) NOT NULL AUTO_INCREMENT,
  `kode_bank` varchar(5) DEFAULT NULL,
  `id` varchar(50) DEFAULT NULL,
  `an_rekening` varchar(50) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_rekening`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_rekening` */

insert  into `t_rekening`(`kode_rekening`,`kode_bank`,`id`,`an_rekening`,`no_rekening`) values 
(2,'040',NULL,'UD Kurnia Asih','22222222222'),
(3,'014','supplier1','Supplier 1','40234830481'),
(4,NULL,'customer1',NULL,NULL),
(5,'008','customer1','Customer 1','4023943894'),
(7,'﻿002',NULL,'UD Kurnia Asih','23456788765656');

/*Table structure for table `t_retur_bb` */

DROP TABLE IF EXISTS `t_retur_bb`;

CREATE TABLE `t_retur_bb` (
  `kode_retur_bb` varchar(50) NOT NULL,
  `id_supplier` varchar(50) DEFAULT NULL,
  `tanggal_retur_bb` datetime DEFAULT NULL,
  `status_retur_bb` int(10) DEFAULT NULL COMMENT '1: proses, 2: dikirim, 3:batal, 4:tolak',
  PRIMARY KEY (`kode_retur_bb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_retur_bb` */

insert  into `t_retur_bb`(`kode_retur_bb`,`id_supplier`,`tanggal_retur_bb`,`status_retur_bb`) values 
('RETBB-20211030221044-supplier1','supplier1','2021-10-30 22:10:44',3),
('RETBB-20211031101002-supplier1','supplier1','2021-10-31 10:10:02',3),
('RETBB-20211031101030-supplier1','supplier1','2021-10-31 10:10:30',3);

/*Table structure for table `t_retur_produk` */

DROP TABLE IF EXISTS `t_retur_produk`;

CREATE TABLE `t_retur_produk` (
  `kode_retur_produk` varchar(50) NOT NULL,
  `id_customer` varchar(50) DEFAULT NULL,
  `tanggal_retur_produk` datetime DEFAULT NULL,
  `status_retur_produk` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode_retur_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_retur_produk` */

insert  into `t_retur_produk`(`kode_retur_produk`,`id_customer`,`tanggal_retur_produk`,`status_retur_produk`) values 
('RETPRO-20211101091146-customer1','customer1','2021-11-01 09:11:46',3);

/*Table structure for table `t_satuan` */

DROP TABLE IF EXISTS `t_satuan`;

CREATE TABLE `t_satuan` (
  `kode_satuan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_satuan` */

insert  into `t_satuan`(`kode_satuan`,`nama_satuan`) values 
(2,'Liter'),
(8,'Kg');

/*Table structure for table `t_supplier` */

DROP TABLE IF EXISTS `t_supplier`;

CREATE TABLE `t_supplier` (
  `id_supplier` varchar(50) NOT NULL,
  `nama_supplier` varchar(50) DEFAULT NULL,
  `pic_supplier` varchar(30) DEFAULT NULL,
  `kontak_supplier` varchar(15) DEFAULT NULL,
  `alamat_supplier` text DEFAULT NULL,
  `username_supplier` varchar(50) DEFAULT NULL,
  `password_supplier` varchar(50) DEFAULT NULL,
  `foto_supplier` varchar(255) DEFAULT NULL,
  `ongkir_supplier` float DEFAULT NULL,
  `berat_ongkir_supplier` float DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `t_supplier` */

insert  into `t_supplier`(`id_supplier`,`nama_supplier`,`pic_supplier`,`kontak_supplier`,`alamat_supplier`,`username_supplier`,`password_supplier`,`foto_supplier`,`ongkir_supplier`,`berat_ongkir_supplier`) values 
('4d30db6ec650e866aee95bf07e5eee5620211027','Supplier2','Cecep','02318743893','Cirebon Jawa Barat','supplier2','supplier2','jeniper-sirup.png',NULL,NULL),
('supplier1','Supplier 1','Andri Boy','023288888881','Kuningan Jawa Barat','supplier1','supplier1','green-large-home.png',200000,6000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
