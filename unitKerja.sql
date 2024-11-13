-- MySQL dump 10.13  Distrib 5.7.39, for osx10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: pamong
-- ------------------------------------------------------
-- Server version	5.7.42

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
-- Table structure for table `instansi`
--

DROP TABLE IF EXISTS `instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instansi` (
  `kode` varchar(5) NOT NULL,
  `nama_instansi` varchar(300) NOT NULL,
  `sasaran` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `puskesmas` varchar(50) NOT NULL,
  `puskesmas2` text NOT NULL,
  `kader1` varchar(30) NOT NULL,
  `kader2` varchar(30) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `users` varchar(20) NOT NULL,
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `no` int(10) DEFAULT NULL,
  PRIMARY KEY (`kode`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansi`
--

LOCK TABLES `instansi` WRITE;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` VALUES ('ID001','Puskesmas Pasir Mulya',20,'','','PS017','Puskesmas Pasir Mulya','Budi','Adi','#FFA7F2','PS017',0,0),('ID002','Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',43,'','','PS001','','','','#A52A2A','PS001',0,1),('ID003','Badan Keuangan dan Aset Daerah',44,'','','PS023','Puskesmas Tanah Sareal','','','#D2691E','PS023',0,2),('ID004','Sekretariat Daerah',182,'','','PS003','Puskesmas Bogor Tengah','','','#DAA520','PS003',0,3),('ID005','Dinas Perumahan dan Permukiman',102,'','','PS021','Puskesmas Sempur','','','#FFD700','PS021',0,4),('ID006','Kecamatan Bogor Timur',63,'','','PS004','Puskesmas Bogor Timur,Puskesmas Pulo Armyn','','','#FFFF00','PS004',0,5),('ID008','Dinas Pariwisata dan Kebudayaan',34,'','','PS005','Puskesmas Bogor Utara','','','#FF4500','PS005',0,7),('ID009','Kecamatan Bogor Utara',83,'','','PS005','Puskesmas Bogor Utara,Puskesmas Tegal Gundil,Puskesmas Warung Jambu','','','#FFA07A','PS005',0,8),('ID010','Inspektorat Daerah',52,'','','PS006','Puskesmas Bondongan','','','#FF7F50','PS006',0,9),('ID011','Kejaksaan Negeri Kota Bogor',65,'','','PS003','Puskesmas Bogor Tengah','','','#FF6347','PS003',0,10),('ID012','Dinas Ketahanan Pangan dan Pertanian',77,'','','PS007','Puskesmas Cipaku','','','#DC143C','PS007',0,11),('ID013','Dinas Lingkungan Hidup',305,'','','PS008','Puskesmas Gang Aut','','','#FF0000','PS008',0,12),('ID014','Dinas Arsip dan Perpustakaan',35,'','','PS009','Puskesmas Gang Kelor','','','#ADFF2F','PS009',0,13),('ID015','Puskesmas Gang Kelor',20,'','','PS009','Puskesmas Gang Kelor','','','#00FFF3','PS009',0,14),('ID016','Dinas Pekerjaan Umum dan Penataan Ruang',116,'','','PS010','Puskesmas Kayu Manis','','','#32CD32','PS010',0,15),('ID017','Badan Penanggulangan Bencana Daerah',18,'','','PS010','Puskesmas Kayu Manis','','','#228B22','PS010',0,16),('ID018','Kecamatan Tanah Sareal',107,'','','PS011','Puskesmas Kayu Manis,Puskesmas Kedung Badak,Puskesmas Mekarwangi,Puskesmas Pondok Rumput,Puskesmas Tanah Sareal','','','#006400','PS011',0,17),('ID019','Sekretariat DPRD',61,'','','PS011','','','','#808000','PS011',0,18),('ID020','Dinas Pemadam Kebakaran dan Penyelamatan',72,'','','PS012','Puskesmas Lawang Gintung','','','#7FFFD4','PS012',0,19),('ID021','Dinas Pemberdayaan Perempuan dan Perlindungan Anak',32,'','','PS014','Puskesmas Merdeka','','','#00FFFF','PS014',0,20),('ID022','Dinas Sosial',43,'','','PS014','Puskesmas Merdeka','','','#B0C4DE','PS014',0,21),('ID023','Dinas Tenaga Kerja',36,'','','PS009','Puskesmas Gang Kelor','','','#87CEFA','PS009',0,22),('ID024','Kecamatan Bogor Selatan',138,'','','PS015','Puskesmas Bogor Selatan,Puskesmas Bondongan,Puskesmas Cipaku,Puskesmas Lawang Gintung,Puskesmas Mulyaharja','','','#20B2AA','PS015',0,23),('ID025','Kecamatan Bogor Barat',160,'','','PS017','Puskesmas Gang Kelor,Puskesmas Pancasan,Puskesmas Pasir Mulya,Puskesmas Semplak,Puskesmas Sindang Barang','','','#6495ED','PS017',0,24),('ID026','Badan Kesatuan Bangsa dan Politik',28,'','','PS011','Puskesmas Kedung Badak','','','#00BFFF','PS011',0,25),('ID027','Dinas Pengendalian Penduduk dan Keluarga Berencana',27,'','','PS018','','','','#1E90FF','PS018',0,26),('ID028','Dinas Perindustrian dan Perdagangan',58,'','','PS018','','','','#483D8B','PS018',0,27),('ID029','Dinas Perhubungan',237,'','','PS019','Puskesmas Pulo Armyn','','','#191970','PS019',0,28),('ID030','Satpol PP (Pemadam Kebakaran Semplak)',18,'','','PS020','','','','#4B0082','PS020',0,29),('ID031','Kecamatan Bogor Tengah',100,'','','PS021','Puskesmas Belong,Puskesmas Bogor Tengah,Puskesmas Gang Aut,Puskesmas Merdeka,Puskesmas Sempur','','','#8B008B','PS021',0,30),('ID032','Badan Perencanaan dan Pembangunan Daerah',44,'','','PS002','Puskesmas Bogor Selatan','','','#9400D3','PS002',0,31),('ID033','Badan Pendapatan Daerah',86,'','','PS023','Puskesmas Tanah Sareal','','','#FF69B4','PS023',0,32),('ID034','Dinas Kesehatan',105,'','','PS023','Puskesmas Tanah Sareal','','','#EE82EE','PS023',0,33),('ID035','Dinas Pemuda dan Olahraga',48,'','','PS018','','','','#BC8F8F','PS018',0,34),('ID036','Dinas Kependudukan dan Pencatatan Sipil',52,'','','PS024','Puskesmas Tegal Gundil','','','#FFC0CB','PS024',0,35),('ID037','Satuan Polisi Pamong Praja',274,'','','PS024','Puskesmas Tegal Gundil','','','#FFE4E1','PS024',0,36),('ID038','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',55,'','','PS025','Puskesmas Warung Jambu','','','#FFFACD','PS025',0,37),('ID039','Dinas Pendidikan',130,'','','PS013','Puskesmas Mekarwangi','','','#C0C0C0','PS013',0,38),('ID040','Dinas Koperasi, Usaha Kecil dan Menengah, Perdagangan dan Perindustrian',28,'','','PS025','Puskesmas Warung Jambu','','','#778899','PS025',0,39),('ID041','Guru',2860,'','','PS026','Puskesmas Belong,Puskesmas Bogor Selatan,Puskesmas Bogor Tengah,Puskesmas Bogor Timur,Puskesmas Bogor Utara,Puskesmas Bondongan,Puskesmas Cipaku,Puskesmas Gang Aut,Puskesmas Gang Kelor,Puskesmas Kayu Manis,Puskesmas Kedung Badak,Puskesmas Lawang Gintung,Puskesmas Mekarwangi,Puskesmas Merdeka,Puskesmas Mulyaharja,Puskesmas Pancasan,Puskesmas Pasir Mulya,Puskesmas Pondok Rumput,Puskesmas Pulo Armyn,Puskesmas Semplak,Puskesmas Sempur,Puskesmas Sindang Barang,Puskesmas Tanah Sareal,Puskesmas Tegal Gundil,Puskesmas Warung Jambu','','','#9C4463','PS026',0,40),('ID042','Puskesmas Belong',20,'','','PS001','Puskesmas Belong','','','#FFEAA7','PS001',0,41),('ID043','Puskesmas Sindang Barang',20,'','','PS022','Puskesmas Sindang Barang','','','#13796F','PS022',0,42),('ID044','Puskesmas Bogor Tengah',20,'','','PS003','','','','#791313','PS003',0,43),('ID045','Puskesmas Bogor Timur',20,'','','PS004','Puskesmas Bogor Timur','','','#000000','PS004',0,44),('ID046','Puskesmas Pulo Armyn',20,'','','PS019','Puskesmas Pulo Armyn','','','#000000','PS019',0,45),('ID047','Puskesmas Bogor Utara',20,'','','PS005','Puskesmas Bogor Utara','','','#000000','PS005',0,46),('ID048','Puskesmas Warung Jambu',20,'','','PS025','Puskesmas Warung Jambu','','','#000000','PS025',0,47),('ID049','Puskesmas Tegal Gundil',20,'','','PS024','Puskesmas Tegal Gundil','','','#000000','PS024',0,48),('ID050','Puskesmas Semplak',20,'','','PS020','Puskesmas Semplak','','','#000000','PS020',0,49),('ID051','Puskesmas Tanah Sareal',20,'','','PS023','Puskesmas Tanah Sareal','','','#000000','PS023',0,50),('ID052','Puskesmas Pondok Rumput',20,'','','PS018','Puskesmas Pondok Rumput','','','#000000','PS018',0,51),('ID054','Puskesmas Kayu Manis',20,'','','PS010','Puskesmas Tanah Sareal','','','#000000','PS010',0,53),('ID055','Puskesmas Pancasan',20,'','','PS016','Puskesmas Pancasan','','','#000000','PS016',0,54),('ID056','Puskesmas Sempur',20,'','','PS021','','','','#000000','PS021',0,55),('ID057','Puskesmas Merdeka',20,'','','PS014','Puskesmas Merdeka','','','#000000','PS014',0,56),('ID058','Puskesmas Mulyaharja',20,'','','PS015','Puskesmas Mulyaharja','','','#000000','PS015',0,57),('ID059','Puskesmas Lawang Gintung',20,'','','PS012','Puskesmas Lawang Gintung','','','#133579','PS012',0,58),('ID060','Puskesmas Bondongan',20,'','','PS006','Puskesmas Bondongan','','','#13796F','PS006',0,59),('ID061','Puskesmas Cipaku',20,'','','PS007','Puskesmas Cipaku','','','#000000','PS007',0,60),('ID062','Puskesmas Gang Aut',20,'','','PS008','Puskesmas Gang Aut','','','#000000','PS008',0,61),('ID063','Dinas Komunikasi dan Informatika',30,'','','PS017','Puskesmas Pasir Mulya','','','#EF0808','PS017',0,62),('ID064','Puskesmas Bogor Selatan',20,'','','PS002','Puskesmas Bogor Selatan','','','#B81818','PS002',0,63),('ID065','Puskesmas Kedung Badak',30,'','','PS011','Puskesmas Kedung Badak','','','#6CDFA9','PS011',0,64),('ID066','RSUD',91,'','','PS009','','','','#9E5E5E','PS009',0,65),('ID067','Puskesmas Mekarwangi',20,'','','PS013','','','','#6F1313','PS013',0,66),('ID069','Laboratorium Kesehatan Daerah',10,'','','PS026','Labkesda','','','#DAA520','PS026',0,68);
/*!40000 ALTER TABLE `instansi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-13 10:21:46
