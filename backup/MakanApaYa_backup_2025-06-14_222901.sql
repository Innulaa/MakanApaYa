-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: MakanApaYa
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `rating` int DEFAULT '0',
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` enum('makanan','minuman','snack') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Nasi Goreng Spesial',15000,4,'img/nasgor.jpg','makanan'),(3,'Es Teh Manis',5000,5,'img/esteh.jpg','minuman'),(5,'Keripik Pedas',7000,3,'img/keripik.jpg','snack');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations_log`
--

DROP TABLE IF EXISTS `locations_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations_log` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations_log`
--

LOCK TABLES `locations_log` WRITE;
/*!40000 ALTER TABLE `locations_log` DISABLE KEYS */;
INSERT INTO `locations_log` VALUES (1,1,-7.7725,110.3828,'2025-06-13 16:51:06'),(3,3,-6.2,106.816666,'2025-06-13 17:06:35');
/*!40000 ALTER TABLE `locations_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `nonaktifkan_review_setelah_keluar_kampus` AFTER INSERT ON `locations_log` FOR EACH ROW BEGIN
  -- Simulasi: jika user keluar area kampus
  IF NEW.latitude IS NOT NULL AND NEW.longitude IS NOT NULL AND 
     (NEW.latitude < -6.9 OR NEW.longitude > 107.7) THEN
     
     UPDATE reviews
     SET rating = NULL, komentar = 'Nonaktif karena user keluar kampus'
     WHERE user_id = NEW.user_id;
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int NOT NULL,
  `tenant_id` int NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,1,'Nasi Ayam Goreng',15000.00),(2,1,'Sayur Lodeh',8000.00),(3,2,'Mie Ayam Bakso',12000.00),(4,2,'Mie Ayam Komplit',14000.00),(5,3,'Salad Buah',10000.00),(6,3,'Jus Kunyit Asam',7000.00);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rankings`
--

DROP TABLE IF EXISTS `rankings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rankings` (
  `id` int NOT NULL,
  `menu_id` int NOT NULL,
  `rata_rating` decimal(3,2) NOT NULL,
  `total_review` int NOT NULL,
  `tipe` enum('harian','mingguan') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rankings`
--

LOCK TABLES `rankings` WRITE;
/*!40000 ALTER TABLE `rankings` DISABLE KEYS */;
INSERT INTO `rankings` VALUES (1,1,5.00,1,'harian','2025-06-09'),(3,3,3.50,2,'harian','2025-06-09'),(5,1,5.00,1,'mingguan','2025-06-02'),(7,3,4.00,2,'mingguan','2025-06-02');
/*!40000 ALTER TABLE `rankings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `komentar` text,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `aktif` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (13,1,3,NULL,'Nonaktif karena user keluar kampus','2025-06-10 06:02:18','2025-06-10 06:02:18',1),(15,2,3,4,'Mie-nya pas, tapi kuahnya agak asin.','2025-06-09 06:58:32','2025-06-09 07:31:14',1),(17,3,5,5,'Segar dan sehat, cocok buat diet.','2025-06-09 06:58:32','2025-06-09 07:31:14',1),(19,1,3,NULL,'Nonaktif karena user keluar kampus','2025-06-09 06:58:32','2025-06-09 07:31:14',1),(21,2,2,5,'Sayurnya fresh dan gurih!','2025-06-09 06:58:32','2025-06-09 07:31:14',1),(23,7,3,3,'enak banget','2025-06-09 07:37:32','2025-06-09 07:37:32',1),(25,9,1,4,'enak banget','2025-06-09 18:42:22','2025-06-09 18:42:22',1),(1000,1,1,NULL,'Nonaktif karena user keluar kampus','2025-06-09 06:58:32','2025-06-09 07:31:14',1),(1001,0,1,5,'enak','2025-06-13 16:21:48','2025-06-13 16:21:48',1),(1002,0,2,5,'WUENAK POLLL MANTAP WES POKOK E','2025-06-13 16:34:09','2025-06-13 16:34:09',1),(1003,0,1,5,'ENAKKKK','2025-06-13 16:34:43','2025-06-13 16:34:43',1),(1004,0,1,5,'MANTULL COYYY GA BOONG SUMPAH','2025-06-13 16:38:11','2025-06-13 16:38:11',1),(1005,0,1,5,'ENAK COY BESOK SINI LAGI DEH','2025-06-13 16:41:12','2025-06-13 16:41:12',1),(1006,0,5,4,'segerrrrrr, tapi ter lalu manis + buat batuk','2025-06-13 17:11:43','2025-06-13 17:11:43',1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews_backup`
--

DROP TABLE IF EXISTS `reviews_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews_backup` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `komentar` text,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews_backup`
--

LOCK TABLES `reviews_backup` WRITE;
/*!40000 ALTER TABLE `reviews_backup` DISABLE KEYS */;
INSERT INTO `reviews_backup` VALUES (13,1,1,5,'Enak banget! Ayamnya empuk.','2025-06-09 06:58:32','2025-06-09 07:31:14'),(15,2,3,4,'Mie-nya pas, tapi kuahnya agak asin.','2025-06-09 06:58:32','2025-06-09 07:31:14'),(17,3,5,5,'Segar dan sehat, cocok buat diet.','2025-06-09 06:58:32','2025-06-09 07:31:14'),(19,1,3,3,'Cukup oke, tapi bisa lebih banyak porsi.','2025-06-09 06:58:32','2025-06-09 07:31:14'),(21,2,2,5,'Sayurnya fresh dan gurih!','2025-06-09 06:58:32','2025-06-09 07:31:14'),(23,7,3,3,'enak banget','2025-06-09 07:37:32','2025-06-09 07:37:32'),(25,9,1,4,'enak banget','2025-06-09 18:42:22','2025-06-09 18:42:22'),(13,1,3,5,'Lezat dan porsinya pas','2025-06-10 06:02:18','2025-06-10 06:02:18');
/*!40000 ALTER TABLE `reviews_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenant_kantin`
--

DROP TABLE IF EXISTS `tenant_kantin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenant_kantin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenant_kantin`
--

LOCK TABLES `tenant_kantin` WRITE;
/*!40000 ALTER TABLE `tenant_kantin` DISABLE KEYS */;
INSERT INTO `tenant_kantin` VALUES (1,'Kantin Mbok Darmi','Menyajikan aneka masakan rumahan khas Jawa dengan cita rasa yang autentik dan harga terjangkau.','tenant1.jpg'),(2,'Bang Jali','Spesialis nasi padang dan gorengan renyah. Cocok buat mahasiswa yang doyan makan pedas!','tenant2.jpg'),(3,'Kantin Sehat','Menawarkan menu sehat seperti salad, buah segar, jus, dan lauk rendah lemak untuk gaya hidup sehat.','tenant3.jpg'),(4,'Kopi Kantin','Tempat nongkrong asik dengan menu kopi kekinian, roti bakar, dan camilan murah meriah.','tenant4.jpg'),(5,'Warung Nasi Kuning Bu Tatik','Nasi kuning dengan lauk komplit dan sambal mantap, jadi favorit anak pagi!','tenant5.jpg'),(6,'Kantin Korea Oppa Kimchi','Menyediakan makanan khas Korea seperti tteokbokki, kimbab, dan ramen halal.','tenant6.jpg');
/*!40000 ALTER TABLE `tenant_kantin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Intan Nur Laila','intan.nur.laila51@gmail.com','ailaaa','$2y$10$FwfSYjMdWwSTOhAscMBo0e0TOf8La4/FIP4vabpcCuRkudKmsqzKO','user'),(2,'Anindita Tri Mulia','anin.nur.laila51@gmail.com','mbak Anin','$2y$10$Fr9ajgECpPyxS.ixAKvrzeUn7/YED39Qc5/3FDFsI9KMJZjPcoPlm','user'),(3,'Rahayu Indah Lestari','Rahayu.indah.lestari@gmail.com','Rahayu','$2y$10$.sr0YQYnaWTAmSQmeZgQmOLo5o6cAkzSyh3F2VG42Kxawab8EewMu','user'),(4,'Intan Nur Laila','lailanurintan.15@gmail.com','Intan','$2y$10$5BJfA/nmYeMcOpIdIUhVouPdCUk5EAHPs21K6GbzxrGuj42fAuYVy','user'),(5,'lailaa laila ailaa','takbir.15@gmail.com','muak','$2y$10$Zx11md8MRmypXwdZRIUEAOMNUBieUBMe1LZtEDmpqDa4UswbUYgxW','user'),(6,'Anindita Tri Mulia','aninnnnn@gmail.com','nina','$2y$10$WQScvVmmWDOhQWfES2sEUu55FdC2..pb2MxJFSCjrZfBZbydkktW6','user'),(7,'Rahayu Indah Lestari','rahaneng@gmail.com','ayu','$2y$10$Jh0wet5lENk8Gu70j5NJmeRCb.c1OYflFdhlO..p1Mn8nApDLFgGS','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_backup`
--

DROP TABLE IF EXISTS `users_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_backup` (
  `id` int NOT NULL DEFAULT '0',
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_backup`
--

LOCK TABLES `users_backup` WRITE;
/*!40000 ALTER TABLE `users_backup` DISABLE KEYS */;
INSERT INTO `users_backup` VALUES (1,'Intan Nur Laila','intan.nur.laila51@gmail.com','ailaaa','$2y$10$FwfSYjMdWwSTOhAscMBo0e0TOf8La4/FIP4vabpcCuRkudKmsqzKO','user'),(2,'Anindita Tri Mulia','anin.nur.laila51@gmail.com','mbak Anin','$2y$10$Fr9ajgECpPyxS.ixAKvrzeUn7/YED39Qc5/3FDFsI9KMJZjPcoPlm','user'),(3,'Rahayu Indah Lestari','Rahayu.indah.lestari@gmail.com','Rahayu','$2y$10$.sr0YQYnaWTAmSQmeZgQmOLo5o6cAkzSyh3F2VG42Kxawab8EewMu','user'),(4,'Intan Nur Laila','lailanurintan.15@gmail.com','Intan','$2y$10$5BJfA/nmYeMcOpIdIUhVouPdCUk5EAHPs21K6GbzxrGuj42fAuYVy','user');
/*!40000 ALTER TABLE `users_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting`
--

DROP TABLE IF EXISTS `voting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `minggu_ke` int NOT NULL,
  `tahun` int NOT NULL,
  `tanggal_vote` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_voting_per_week` (`user_id`,`minggu_ke`,`tahun`),
  KEY `fk_menu_voting` (`menu_id`),
  CONSTRAINT `fk_menu_voting` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_voting` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting`
--

LOCK TABLES `voting` WRITE;
/*!40000 ALTER TABLE `voting` DISABLE KEYS */;
INSERT INTO `voting` VALUES (1,5,1,24,2025,'2025-06-14 11:05:03'),(2,6,6,24,2025,'2025-06-14 11:08:12'),(3,7,6,24,2025,'2025-06-14 11:10:13');
/*!40000 ALTER TABLE `voting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-14 22:29:01
