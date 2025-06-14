-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2025 at 07:19 AM
-- Server version: 10.4.21-MariaDB-log
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MakanApaYa`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `rating` int(11) DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` enum('makanan','minuman','snack') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nama`, `harga`, `rating`, `gambar`, `kategori`) VALUES
(1, 'Nasi Goreng Spesial', 15000, 4, 'img/nasgor.jpg', 'makanan'),
(3, 'Es Teh Manis', 5000, 5, 'img/esteh.jpg', 'minuman'),
(5, 'Keripik Pedas', 7000, 3, 'img/keripik.jpg', 'snack');

-- --------------------------------------------------------

--
-- Table structure for table `locations_log`
--

CREATE TABLE `locations_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations_log`
--

INSERT INTO `locations_log` (`id`, `user_id`, `latitude`, `longitude`, `waktu`) VALUES
(1, 1, -7.7725, 110.3828, '2025-06-13 16:51:06'),
(3, 3, -6.2, 106.816666, '2025-06-13 17:06:35');

--
-- Triggers `locations_log`
--
DELIMITER $$
CREATE TRIGGER `nonaktifkan_review_setelah_keluar_kampus` AFTER INSERT ON `locations_log` FOR EACH ROW BEGIN
  -- Simulasi: jika user keluar area kampus
  IF NEW.latitude IS NOT NULL AND NEW.longitude IS NOT NULL AND 
     (NEW.latitude < -6.9 OR NEW.longitude > 107.7) THEN
     
     UPDATE reviews
     SET rating = NULL, komentar = 'Nonaktif karena user keluar kampus'
     WHERE user_id = NEW.user_id;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `tenant_id`, `nama_menu`, `harga`) VALUES
(1, 1, 'Nasi Ayam Goreng', '15000.00'),
(2, 1, 'Sayur Lodeh', '8000.00'),
(3, 2, 'Mie Ayam Bakso', '12000.00'),
(4, 2, 'Mie Ayam Komplit', '14000.00'),
(5, 3, 'Salad Buah', '10000.00'),
(6, 3, 'Jus Kunyit Asam', '7000.00');

-- --------------------------------------------------------

--
-- Table structure for table `rankings`
--

CREATE TABLE `rankings` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `rata_rating` decimal(3,2) NOT NULL,
  `total_review` int(11) NOT NULL,
  `tipe` enum('harian','mingguan') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rankings`
--

INSERT INTO `rankings` (`id`, `menu_id`, `rata_rating`, `total_review`, `tipe`, `tanggal`) VALUES
(1, 1, '5.00', 1, 'harian', '2025-06-09'),
(3, 3, '3.50', 2, 'harian', '2025-06-09'),
(5, 1, '5.00', 1, 'mingguan', '2025-06-02'),
(7, 3, '4.00', 2, 'mingguan', '2025-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `menu_id`, `rating`, `komentar`, `tanggal`, `created_at`, `aktif`) VALUES
(13, 1, 3, NULL, 'Nonaktif karena user keluar kampus', '2025-06-10 06:02:18', '2025-06-10 06:02:18', 1),
(15, 2, 3, 4, 'Mie-nya pas, tapi kuahnya agak asin.', '2025-06-09 06:58:32', '2025-06-09 07:31:14', 1),
(17, 3, 5, 5, 'Segar dan sehat, cocok buat diet.', '2025-06-09 06:58:32', '2025-06-09 07:31:14', 1),
(19, 1, 3, NULL, 'Nonaktif karena user keluar kampus', '2025-06-09 06:58:32', '2025-06-09 07:31:14', 1),
(21, 2, 2, 5, 'Sayurnya fresh dan gurih!', '2025-06-09 06:58:32', '2025-06-09 07:31:14', 1),
(23, 7, 3, 3, 'enak banget', '2025-06-09 07:37:32', '2025-06-09 07:37:32', 1),
(25, 9, 1, 4, 'enak banget', '2025-06-09 18:42:22', '2025-06-09 18:42:22', 1),
(1000, 1, 1, NULL, 'Nonaktif karena user keluar kampus', '2025-06-09 06:58:32', '2025-06-09 07:31:14', 1),
(1001, 0, 1, 5, 'enak', '2025-06-13 16:21:48', '2025-06-13 16:21:48', 1),
(1002, 0, 2, 5, 'WUENAK POLLL MANTAP WES POKOK E', '2025-06-13 16:34:09', '2025-06-13 16:34:09', 1),
(1003, 0, 1, 5, 'ENAKKKK', '2025-06-13 16:34:43', '2025-06-13 16:34:43', 1),
(1004, 0, 1, 5, 'MANTULL COYYY GA BOONG SUMPAH', '2025-06-13 16:38:11', '2025-06-13 16:38:11', 1),
(1005, 0, 1, 5, 'ENAK COY BESOK SINI LAGI DEH', '2025-06-13 16:41:12', '2025-06-13 16:41:12', 1),
(1006, 0, 5, 4, 'segerrrrrr, tapi ter lalu manis + buat batuk', '2025-06-13 17:11:43', '2025-06-13 17:11:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews_backup`
--

CREATE TABLE `reviews_backup` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews_backup`
--

INSERT INTO `reviews_backup` (`id`, `user_id`, `menu_id`, `rating`, `komentar`, `tanggal`, `created_at`) VALUES
(13, 1, 1, 5, 'Enak banget! Ayamnya empuk.', '2025-06-09 06:58:32', '2025-06-09 07:31:14'),
(15, 2, 3, 4, 'Mie-nya pas, tapi kuahnya agak asin.', '2025-06-09 06:58:32', '2025-06-09 07:31:14'),
(17, 3, 5, 5, 'Segar dan sehat, cocok buat diet.', '2025-06-09 06:58:32', '2025-06-09 07:31:14'),
(19, 1, 3, 3, 'Cukup oke, tapi bisa lebih banyak porsi.', '2025-06-09 06:58:32', '2025-06-09 07:31:14'),
(21, 2, 2, 5, 'Sayurnya fresh dan gurih!', '2025-06-09 06:58:32', '2025-06-09 07:31:14'),
(23, 7, 3, 3, 'enak banget', '2025-06-09 07:37:32', '2025-06-09 07:37:32'),
(25, 9, 1, 4, 'enak banget', '2025-06-09 18:42:22', '2025-06-09 18:42:22'),
(13, 1, 3, 5, 'Lezat dan porsinya pas', '2025-06-10 06:02:18', '2025-06-10 06:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_kantin`
--

CREATE TABLE `tenant_kantin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenant_kantin`
--

INSERT INTO `tenant_kantin` (`id`, `nama`, `deskripsi`, `gambar`) VALUES
(1, 'Kantin Mbok Darmi', 'Menyajikan aneka masakan rumahan khas Jawa dengan cita rasa yang autentik dan harga terjangkau.', 'tenant1.jpg'),
(2, 'Bang Jali', 'Spesialis nasi padang dan gorengan renyah. Cocok buat mahasiswa yang doyan makan pedas!', 'tenant2.jpg'),
(3, 'Kantin Sehat', 'Menawarkan menu sehat seperti salad, buah segar, jus, dan lauk rendah lemak untuk gaya hidup sehat.', 'tenant3.jpg'),
(4, 'Kopi Kantin', 'Tempat nongkrong asik dengan menu kopi kekinian, roti bakar, dan camilan murah meriah.', 'tenant4.jpg'),
(5, 'Warung Nasi Kuning Bu Tatik', 'Nasi kuning dengan lauk komplit dan sambal mantap, jadi favorit anak pagi!', 'tenant5.jpg'),
(6, 'Kantin Korea Oppa Kimchi', 'Menyediakan makanan khas Korea seperti tteokbokki, kimbab, dan ramen halal.', 'tenant6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`) VALUES
(1, 'Intan Nur Laila', 'intan.nur.laila51@gmail.com', 'ailaaa', '$2y$10$FwfSYjMdWwSTOhAscMBo0e0TOf8La4/FIP4vabpcCuRkudKmsqzKO', 'user'),
(2, 'Anindita Tri Mulia', 'anin.nur.laila51@gmail.com', 'mbak Anin', '$2y$10$Fr9ajgECpPyxS.ixAKvrzeUn7/YED39Qc5/3FDFsI9KMJZjPcoPlm', 'user'),
(3, 'Rahayu Indah Lestari', 'Rahayu.indah.lestari@gmail.com', 'Rahayu', '$2y$10$.sr0YQYnaWTAmSQmeZgQmOLo5o6cAkzSyh3F2VG42Kxawab8EewMu', 'user'),
(4, 'Intan Nur Laila', 'lailanurintan.15@gmail.com', 'Intan', '$2y$10$5BJfA/nmYeMcOpIdIUhVouPdCUk5EAHPs21K6GbzxrGuj42fAuYVy', 'user'),
(5, 'lailaa laila ailaa', 'takbir.15@gmail.com', 'muak', '$2y$10$Zx11md8MRmypXwdZRIUEAOMNUBieUBMe1LZtEDmpqDa4UswbUYgxW', 'user'),
(6, 'Anindita Tri Mulia', 'aninnnnn@gmail.com', 'nina', '$2y$10$WQScvVmmWDOhQWfES2sEUu55FdC2..pb2MxJFSCjrZfBZbydkktW6', 'user'),
(7, 'Rahayu Indah Lestari', 'rahaneng@gmail.com', 'ayu', '$2y$10$Jh0wet5lENk8Gu70j5NJmeRCb.c1OYflFdhlO..p1Mn8nApDLFgGS', 'user'),
(8, 'jubaidah', 'jubaidah@gmail.com', 'jubai', '$2y$10$R58K2G0yUYiof2h2bKLy6e2CiZwBVeyyWiu6sWm4VwutYLfV9Mj/e', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users_backup`
--

CREATE TABLE `users_backup` (
  `id` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_backup`
--

INSERT INTO `users_backup` (`id`, `nama`, `email`, `username`, `password`, `role`) VALUES
(1, 'Intan Nur Laila', 'intan.nur.laila51@gmail.com', 'ailaaa', '$2y$10$FwfSYjMdWwSTOhAscMBo0e0TOf8La4/FIP4vabpcCuRkudKmsqzKO', 'user'),
(2, 'Anindita Tri Mulia', 'anin.nur.laila51@gmail.com', 'mbak Anin', '$2y$10$Fr9ajgECpPyxS.ixAKvrzeUn7/YED39Qc5/3FDFsI9KMJZjPcoPlm', 'user'),
(3, 'Rahayu Indah Lestari', 'Rahayu.indah.lestari@gmail.com', 'Rahayu', '$2y$10$.sr0YQYnaWTAmSQmeZgQmOLo5o6cAkzSyh3F2VG42Kxawab8EewMu', 'user'),
(4, 'Intan Nur Laila', 'lailanurintan.15@gmail.com', 'Intan', '$2y$10$5BJfA/nmYeMcOpIdIUhVouPdCUk5EAHPs21K6GbzxrGuj42fAuYVy', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `minggu_ke` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tanggal_vote` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id`, `user_id`, `menu_id`, `minggu_ke`, `tahun`, `tanggal_vote`) VALUES
(1, 5, 1, 24, 2025, '2025-06-14 11:05:03'),
(2, 6, 6, 24, 2025, '2025-06-14 11:08:12'),
(3, 7, 6, 24, 2025, '2025-06-14 11:10:13'),
(4, 8, 6, 24, 2025, '2025-06-14 11:52:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_kantin`
--
ALTER TABLE `tenant_kantin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_voting_per_week` (`user_id`,`minggu_ke`,`tahun`),
  ADD KEY `fk_menu_voting` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `tenant_kantin`
--
ALTER TABLE `tenant_kantin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `fk_menu_voting` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_voting` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
