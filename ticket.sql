/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `instansi` (
  `kode` varchar(5) NOT NULL,
  `nama_instansi` varchar(300) NOT NULL,
  `sasaran` int NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `puskesmas` varchar(50) NOT NULL,
  `puskesmas2` text NOT NULL,
  `kader1` varchar(30) NOT NULL,
  `kader2` varchar(30) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `users` varchar(20) NOT NULL,
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `no` int DEFAULT NULL,
  PRIMARY KEY (`kode`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

CREATE TABLE `jenis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_pengaduan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pelapors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npelapor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pengaduan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelapor_id` bigint NOT NULL,
  `naplikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laporan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint NOT NULL,
  `jenis_id` bigint NOT NULL,
  `file_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `status` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@gmail.com|127.0.0.1', 'i:3;', 1731390972);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@gmail.com|127.0.0.1:timer', 'i:1731390972;', 1731390972);






INSERT INTO `instansi` (`kode`, `nama_instansi`, `sasaran`, `alamat`, `kontak`, `puskesmas`, `puskesmas2`, `kader1`, `kader2`, `warna`, `users`, `delete`, `no`) VALUES
('ID001', 'Puskesmas Pasir Mulya', 20, '', '', 'PS017', 'Puskesmas Pasir Mulya', 'Budi', 'Adi', '#FFA7F2', 'PS017', 0, 0);
INSERT INTO `instansi` (`kode`, `nama_instansi`, `sasaran`, `alamat`, `kontak`, `puskesmas`, `puskesmas2`, `kader1`, `kader2`, `warna`, `users`, `delete`, `no`) VALUES
('ID002', 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 43, '', '', 'PS001', '', '', '', '#A52A2A', 'PS001', 0, 1);
INSERT INTO `instansi` (`kode`, `nama_instansi`, `sasaran`, `alamat`, `kontak`, `puskesmas`, `puskesmas2`, `kader1`, `kader2`, `warna`, `users`, `delete`, `no`) VALUES
('ID003', 'Badan Keuangan dan Aset Daerah', 44, '', '', 'PS023', 'Puskesmas Tanah Sareal', '', '', '#D2691E', 'PS023', 0, 2);
INSERT INTO `instansi` (`kode`, `nama_instansi`, `sasaran`, `alamat`, `kontak`, `puskesmas`, `puskesmas2`, `kader1`, `kader2`, `warna`, `users`, `delete`, `no`) VALUES
('ID004', 'Sekretariat Daerah', 182, '', '', 'PS003', 'Puskesmas Bogor Tengah', '', '', '#DAA520', 'PS003', 0, 3),
('ID005', 'Dinas Perumahan dan Permukiman', 102, '', '', 'PS021', 'Puskesmas Sempur', '', '', '#FFD700', 'PS021', 0, 4),
('ID006', 'Kecamatan Bogor Timur', 63, '', '', 'PS004', 'Puskesmas Bogor Timur,Puskesmas Pulo Armyn', '', '', '#FFFF00', 'PS004', 0, 5),
('ID008', 'Dinas Pariwisata dan Kebudayaan', 34, '', '', 'PS005', 'Puskesmas Bogor Utara', '', '', '#FF4500', 'PS005', 0, 7),
('ID009', 'Kecamatan Bogor Utara', 83, '', '', 'PS005', 'Puskesmas Bogor Utara,Puskesmas Tegal Gundil,Puskesmas Warung Jambu', '', '', '#FFA07A', 'PS005', 0, 8),
('ID010', 'Inspektorat Daerah', 52, '', '', 'PS006', 'Puskesmas Bondongan', '', '', '#FF7F50', 'PS006', 0, 9),
('ID011', 'Kejaksaan Negeri Kota Bogor', 65, '', '', 'PS003', 'Puskesmas Bogor Tengah', '', '', '#FF6347', 'PS003', 0, 10),
('ID012', 'Dinas Ketahanan Pangan dan Pertanian', 77, '', '', 'PS007', 'Puskesmas Cipaku', '', '', '#DC143C', 'PS007', 0, 11),
('ID013', 'Dinas Lingkungan Hidup', 305, '', '', 'PS008', 'Puskesmas Gang Aut', '', '', '#FF0000', 'PS008', 0, 12),
('ID014', 'Dinas Arsip dan Perpustakaan', 35, '', '', 'PS009', 'Puskesmas Gang Kelor', '', '', '#ADFF2F', 'PS009', 0, 13),
('ID015', 'Puskesmas Gang Kelor', 20, '', '', 'PS009', 'Puskesmas Gang Kelor', '', '', '#00FFF3', 'PS009', 0, 14),
('ID016', 'Dinas Pekerjaan Umum dan Penataan Ruang', 116, '', '', 'PS010', 'Puskesmas Kayu Manis', '', '', '#32CD32', 'PS010', 0, 15),
('ID017', 'Badan Penanggulangan Bencana Daerah', 18, '', '', 'PS010', 'Puskesmas Kayu Manis', '', '', '#228B22', 'PS010', 0, 16),
('ID018', 'Kecamatan Tanah Sareal', 107, '', '', 'PS011', 'Puskesmas Kayu Manis,Puskesmas Kedung Badak,Puskesmas Mekarwangi,Puskesmas Pondok Rumput,Puskesmas Tanah Sareal', '', '', '#006400', 'PS011', 0, 17),
('ID019', 'Sekretariat DPRD', 61, '', '', 'PS011', '', '', '', '#808000', 'PS011', 0, 18),
('ID020', 'Dinas Pemadam Kebakaran dan Penyelamatan', 72, '', '', 'PS012', 'Puskesmas Lawang Gintung', '', '', '#7FFFD4', 'PS012', 0, 19),
('ID021', 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak', 32, '', '', 'PS014', 'Puskesmas Merdeka', '', '', '#00FFFF', 'PS014', 0, 20),
('ID022', 'Dinas Sosial', 43, '', '', 'PS014', 'Puskesmas Merdeka', '', '', '#B0C4DE', 'PS014', 0, 21),
('ID023', 'Dinas Tenaga Kerja', 36, '', '', 'PS009', 'Puskesmas Gang Kelor', '', '', '#87CEFA', 'PS009', 0, 22),
('ID024', 'Kecamatan Bogor Selatan', 138, '', '', 'PS015', 'Puskesmas Bogor Selatan,Puskesmas Bondongan,Puskesmas Cipaku,Puskesmas Lawang Gintung,Puskesmas Mulyaharja', '', '', '#20B2AA', 'PS015', 0, 23),
('ID025', 'Kecamatan Bogor Barat', 160, '', '', 'PS017', 'Puskesmas Gang Kelor,Puskesmas Pancasan,Puskesmas Pasir Mulya,Puskesmas Semplak,Puskesmas Sindang Barang', '', '', '#6495ED', 'PS017', 0, 24),
('ID026', 'Badan Kesatuan Bangsa dan Politik', 28, '', '', 'PS011', 'Puskesmas Kedung Badak', '', '', '#00BFFF', 'PS011', 0, 25),
('ID027', 'Dinas Pengendalian Penduduk dan Keluarga Berencana', 27, '', '', 'PS018', '', '', '', '#1E90FF', 'PS018', 0, 26),
('ID028', 'Dinas Perindustrian dan Perdagangan', 58, '', '', 'PS018', '', '', '', '#483D8B', 'PS018', 0, 27),
('ID029', 'Dinas Perhubungan', 237, '', '', 'PS019', 'Puskesmas Pulo Armyn', '', '', '#191970', 'PS019', 0, 28),
('ID030', 'Satpol PP (Pemadam Kebakaran Semplak)', 18, '', '', 'PS020', '', '', '', '#4B0082', 'PS020', 0, 29),
('ID031', 'Kecamatan Bogor Tengah', 100, '', '', 'PS021', 'Puskesmas Belong,Puskesmas Bogor Tengah,Puskesmas Gang Aut,Puskesmas Merdeka,Puskesmas Sempur', '', '', '#8B008B', 'PS021', 0, 30),
('ID032', 'Badan Perencanaan dan Pembangunan Daerah', 44, '', '', 'PS002', 'Puskesmas Bogor Selatan', '', '', '#9400D3', 'PS002', 0, 31),
('ID033', 'Badan Pendapatan Daerah', 86, '', '', 'PS023', 'Puskesmas Tanah Sareal', '', '', '#FF69B4', 'PS023', 0, 32),
('ID034', 'Dinas Kesehatan', 105, '', '', 'PS023', 'Puskesmas Tanah Sareal', '', '', '#EE82EE', 'PS023', 0, 33),
('ID035', 'Dinas Pemuda dan Olahraga', 48, '', '', 'PS018', '', '', '', '#BC8F8F', 'PS018', 0, 34),
('ID036', 'Dinas Kependudukan dan Pencatatan Sipil', 52, '', '', 'PS024', 'Puskesmas Tegal Gundil', '', '', '#FFC0CB', 'PS024', 0, 35),
('ID037', 'Satuan Polisi Pamong Praja', 274, '', '', 'PS024', 'Puskesmas Tegal Gundil', '', '', '#FFE4E1', 'PS024', 0, 36),
('ID038', 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 55, '', '', 'PS025', 'Puskesmas Warung Jambu', '', '', '#FFFACD', 'PS025', 0, 37),
('ID039', 'Dinas Pendidikan', 130, '', '', 'PS013', 'Puskesmas Mekarwangi', '', '', '#C0C0C0', 'PS013', 0, 38),
('ID040', 'Dinas Koperasi, Usaha Kecil dan Menengah, Perdagangan dan Perindustrian', 28, '', '', 'PS025', 'Puskesmas Warung Jambu', '', '', '#778899', 'PS025', 0, 39),
('ID041', 'Guru', 2860, '', '', 'PS026', 'Puskesmas Belong,Puskesmas Bogor Selatan,Puskesmas Bogor Tengah,Puskesmas Bogor Timur,Puskesmas Bogor Utara,Puskesmas Bondongan,Puskesmas Cipaku,Puskesmas Gang Aut,Puskesmas Gang Kelor,Puskesmas Kayu Manis,Puskesmas Kedung Badak,Puskesmas Lawang Gintung,Puskesmas Mekarwangi,Puskesmas Merdeka,Puskesmas Mulyaharja,Puskesmas Pancasan,Puskesmas Pasir Mulya,Puskesmas Pondok Rumput,Puskesmas Pulo Armyn,Puskesmas Semplak,Puskesmas Sempur,Puskesmas Sindang Barang,Puskesmas Tanah Sareal,Puskesmas Tegal Gundil,Puskesmas Warung Jambu', '', '', '#9C4463', 'PS026', 0, 40),
('ID042', 'Puskesmas Belong', 20, '', '', 'PS001', 'Puskesmas Belong', '', '', '#FFEAA7', 'PS001', 0, 41),
('ID043', 'Puskesmas Sindang Barang', 20, '', '', 'PS022', 'Puskesmas Sindang Barang', '', '', '#13796F', 'PS022', 0, 42),
('ID044', 'Puskesmas Bogor Tengah', 20, '', '', 'PS003', '', '', '', '#791313', 'PS003', 0, 43),
('ID045', 'Puskesmas Bogor Timur', 20, '', '', 'PS004', 'Puskesmas Bogor Timur', '', '', '#000000', 'PS004', 0, 44),
('ID046', 'Puskesmas Pulo Armyn', 20, '', '', 'PS019', 'Puskesmas Pulo Armyn', '', '', '#000000', 'PS019', 0, 45),
('ID047', 'Puskesmas Bogor Utara', 20, '', '', 'PS005', 'Puskesmas Bogor Utara', '', '', '#000000', 'PS005', 0, 46),
('ID048', 'Puskesmas Warung Jambu', 20, '', '', 'PS025', 'Puskesmas Warung Jambu', '', '', '#000000', 'PS025', 0, 47),
('ID049', 'Puskesmas Tegal Gundil', 20, '', '', 'PS024', 'Puskesmas Tegal Gundil', '', '', '#000000', 'PS024', 0, 48),
('ID050', 'Puskesmas Semplak', 20, '', '', 'PS020', 'Puskesmas Semplak', '', '', '#000000', 'PS020', 0, 49),
('ID051', 'Puskesmas Tanah Sareal', 20, '', '', 'PS023', 'Puskesmas Tanah Sareal', '', '', '#000000', 'PS023', 0, 50),
('ID052', 'Puskesmas Pondok Rumput', 20, '', '', 'PS018', 'Puskesmas Pondok Rumput', '', '', '#000000', 'PS018', 0, 51),
('ID054', 'Puskesmas Kayu Manis', 20, '', '', 'PS010', 'Puskesmas Tanah Sareal', '', '', '#000000', 'PS010', 0, 53),
('ID055', 'Puskesmas Pancasan', 20, '', '', 'PS016', 'Puskesmas Pancasan', '', '', '#000000', 'PS016', 0, 54),
('ID056', 'Puskesmas Sempur', 20, '', '', 'PS021', '', '', '', '#000000', 'PS021', 0, 55),
('ID057', 'Puskesmas Merdeka', 20, '', '', 'PS014', 'Puskesmas Merdeka', '', '', '#000000', 'PS014', 0, 56),
('ID058', 'Puskesmas Mulyaharja', 20, '', '', 'PS015', 'Puskesmas Mulyaharja', '', '', '#000000', 'PS015', 0, 57),
('ID059', 'Puskesmas Lawang Gintung', 20, '', '', 'PS012', 'Puskesmas Lawang Gintung', '', '', '#133579', 'PS012', 0, 58),
('ID060', 'Puskesmas Bondongan', 20, '', '', 'PS006', 'Puskesmas Bondongan', '', '', '#13796F', 'PS006', 0, 59),
('ID061', 'Puskesmas Cipaku', 20, '', '', 'PS007', 'Puskesmas Cipaku', '', '', '#000000', 'PS007', 0, 60),
('ID062', 'Puskesmas Gang Aut', 20, '', '', 'PS008', 'Puskesmas Gang Aut', '', '', '#000000', 'PS008', 0, 61),
('ID063', 'Dinas Komunikasi dan Informatika', 30, '', '', 'PS017', 'Puskesmas Pasir Mulya', '', '', '#EF0808', 'PS017', 0, 62),
('ID064', 'Puskesmas Bogor Selatan', 20, '', '', 'PS002', 'Puskesmas Bogor Selatan', '', '', '#B81818', 'PS002', 0, 63),
('ID065', 'Puskesmas Kedung Badak', 30, '', '', 'PS011', 'Puskesmas Kedung Badak', '', '', '#6CDFA9', 'PS011', 0, 64),
('ID066', 'RSUD', 91, '', '', 'PS009', '', '', '', '#9E5E5E', 'PS009', 0, 65),
('ID067', 'Puskesmas Mekarwangi', 20, '', '', 'PS013', '', '', '', '#6F1313', 'PS013', 0, 66),
('ID069', 'Laboratorium Kesehatan Daerah', 10, '', '', 'PS026', 'Labkesda', '', '', '#DAA520', 'PS026', 0, 68);

INSERT INTO `jenis` (`id`, `jenis_pengaduan`, `created_at`, `updated_at`) VALUES
(1, 'Organisasi Perangkat Daerah (OPD)', '2024-10-24 02:31:36', '2024-11-06 07:22:56');
INSERT INTO `jenis` (`id`, `jenis_pengaduan`, `created_at`, `updated_at`) VALUES
(2, 'Bogor Single Window (BSW)', '2024-10-24 02:31:41', '2024-10-24 02:31:41');
INSERT INTO `jenis` (`id`, `jenis_pengaduan`, `created_at`, `updated_at`) VALUES
(3, 'Email Resmi Pemkot', '2024-10-24 02:31:46', '2024-10-24 02:31:46');
INSERT INTO `jenis` (`id`, `jenis_pengaduan`, `created_at`, `updated_at`) VALUES
(4, 'Website Profil Perangkat Daerah', '2024-10-24 02:31:53', '2024-10-24 02:31:53');





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_09_09_060644_create_pelapors_table', 1),
(5, '2024_09_17_014142_create_tables_pengaduan', 1),
(6, '2024_09_26_020402_create_jenis_table', 1),
(7, '2024_10_08_011136_create_status_table', 1);



INSERT INTO `pelapors` (`id`, `email`, `nohp`, `npelapor`, `instansi_id`, `created_at`, `updated_at`) VALUES
(24, 'dinkes@gmail.com', '08932632', 'Rama', 'ID012', '2024-11-08 06:52:38', '2024-11-08 06:52:38');
INSERT INTO `pelapors` (`id`, `email`, `nohp`, `npelapor`, `instansi_id`, `created_at`, `updated_at`) VALUES
(25, 'razka@gmail.com', '0892383287', 'Razka', 'ID009', '2024-11-08 06:57:25', '2024-11-08 06:57:25');
INSERT INTO `pelapors` (`id`, `email`, `nohp`, `npelapor`, `instansi_id`, `created_at`, `updated_at`) VALUES
(26, 'udin@gmail.com', '086373728273', 'UdinJaenuidin', 'ID012', '2024-11-08 07:00:55', '2024-11-08 07:00:55');
INSERT INTO `pelapors` (`id`, `email`, `nohp`, `npelapor`, `instansi_id`, `created_at`, `updated_at`) VALUES
(27, 'pendik@gmail.com', '08932632', 'popo', 'ID015', '2024-11-08 07:09:55', '2024-11-08 07:09:55'),
(28, 'udin@gmail.com', '08932632', 'Rama', 'ID017', '2024-11-08 07:10:46', '2024-11-08 07:10:46'),
(29, 'asep@gmail.com', '087673728192', 'Asep Saefulleah', 'ID015', '2024-11-08 07:21:22', '2024-11-08 07:21:22'),
(30, 'asep@gmail.com', 'popoponekj', 'Asep Saefulleah', 'ID015', '2024-11-08 07:21:38', '2024-11-08 07:21:38');

INSERT INTO `pengaduan` (`id`, `pelapor_id`, `naplikasi`, `laporan`, `status_id`, `jenis_id`, `file_foto`, `kode`, `created_at`, `updated_at`, `keterangan`, `user_id`) VALUES
(24, 24, 'Dinas-kesehatan.kotabogor', 'erorr', 5, 3, '08112024R9D819kxjL.jpg', 'KDE-007', '2024-11-08 06:52:38', '2024-11-08 06:52:38', NULL, NULL);
INSERT INTO `pengaduan` (`id`, `pelapor_id`, `naplikasi`, `laporan`, `status_id`, `jenis_id`, `file_foto`, `kode`, `created_at`, `updated_at`, `keterangan`, `user_id`) VALUES
(25, 25, 'Dinas-kesehatan.kotabogor', 'laporan untuk halaman admin yang error', 5, 4, '08112024IWB484jHJP.jpg', 'KDE-002', '2024-11-08 06:57:25', '2024-11-08 06:57:25', NULL, NULL);
INSERT INTO `pengaduan` (`id`, `pelapor_id`, `naplikasi`, `laporan`, `status_id`, `jenis_id`, `file_foto`, `kode`, `created_at`, `updated_at`, `keterangan`, `user_id`) VALUES
(26, 26, 'Dinas-kesehatan.kotabogor', 'error halaman', 5, 2, '08112024bVYZ2Jqxro.jpg', 'KDE-003', '2024-11-08 07:00:55', '2024-11-08 07:00:55', NULL, NULL);
INSERT INTO `pengaduan` (`id`, `pelapor_id`, `naplikasi`, `laporan`, `status_id`, `jenis_id`, `file_foto`, `kode`, `created_at`, `updated_at`, `keterangan`, `user_id`) VALUES
(27, 27, 'Aplikasi 1', 'eroeroroe', 5, 4, '0811202459yYpstpMa.png', 'KDE-004', '2024-11-08 07:09:55', '2024-11-08 07:09:55', NULL, NULL),
(28, 28, 'aplikasih3', 'eroeoro', 5, 2, '08112024y7jPidymJY.pdf', 'KDE-005', '2024-11-08 07:10:46', '2024-11-08 07:10:46', NULL, NULL),
(29, 29, 'Dinas-kesehatan.kotabogor', '090909ererer', 5, 2, '081120241N15dAzGtR.jpg', 'KDE-006', '2024-11-08 07:21:22', '2024-11-12 06:48:26', 'Laporan anda di proses oleh petugas', NULL),
(30, 30, 'Dinas-kesehatan.kotabogor', '090909ererer', 5, 2, '08112024heSCuwhaZ9.jpg', 'KDE-007', '2024-11-08 07:21:38', '2024-11-08 07:21:38', NULL, NULL);

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BkDa6fNZpEBgNHj0boygV0WHKamRtE5ka3LSVHrK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTVVuTDNLcGM4VGdIcFJtTkVOa2lxQXBabzkzcnJoQ0tDZDFqdmZoNiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1731400859);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('po1RmJYk1ClueAJ99YLMLqYy4dSkngeGdIJRDjeo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVlFKeUt6SkdNU3VrWnc4MVVwaEg5Q01ZMklobzhrU3NTakJ3S2xTQyI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO319', 1731460993);


INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'DiKonfirmasi', '2024-10-24 02:32:12', '2024-10-24 02:32:12');
INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'DiProses', '2024-10-24 02:32:23', '2024-10-24 02:32:23');
INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'DiTolak', '2024-10-24 02:32:41', '2024-10-24 02:32:41');
INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Selesai', '2024-10-24 02:32:59', '2024-10-24 02:32:59'),
(5, 'Menunggu Konfirmasi', '2024-10-24 02:37:30', '2024-10-24 02:37:30');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mrazka', 'admin123@gmail.com', NULL, '$2y$12$Anc4IomtkBa/ajhXIzvGOuJs5fsT.5alORLhvGtZdzQWPy6myxUcW', NULL, '2024-10-24 02:31:26', '2024-11-06 04:19:45');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'adi', 'adim@gmail.com', NULL, '$2y$12$Je.GqB3AMOuxdE6ItWvul.Ehi1QPxfw5s1VUvpduwMtf3lkSd.2gy', NULL, '2024-11-05 03:48:34', '2024-11-05 03:48:34');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;