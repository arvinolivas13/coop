-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 02:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `san_roque`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_beneficiaries`
--

CREATE TABLE `member_beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_beneficiaries`
--

INSERT INTO `member_beneficiaries` (`id`, `member_id`, `name`, `age`, `relationship`, `created_at`, `updated_at`) VALUES
(1, 1, 'HARVIE YVES R. ALEJO', '26', 'SON', '2024-08-17 04:14:50', '2024-08-17 04:14:50'),
(2, 3, 'JOAQUIN IVAN B. ROQUE', '15', 'SON', '2024-08-17 04:32:46', '2024-08-17 04:32:46'),
(3, 4, 'LUCILLE AKIRA ROQUE', '8', 'DAUGHTER', '2024-08-17 04:45:04', '2024-08-17 04:45:04'),
(4, 4, 'LUCAS ARKIN ROQUE', '5', 'SON', '2024-08-17 04:45:04', '2024-08-17 04:45:04'),
(5, 5, 'LORLIE R. ALEJO', '45', 'MOTHER', '2024-08-17 04:49:24', '2024-08-17 04:49:24'),
(6, 6, 'LUCILLE AKIRA ROQUE', '8', 'DAUGHTER', '2024-08-17 04:54:06', '2024-08-17 04:54:06'),
(7, 6, 'LUCAS ARKIN ROQUE', '5', 'SON', '2024-08-17 04:54:06', '2024-08-17 04:54:06'),
(8, 2, 'JEAN MARIE OSORIO', '38', 'COMMON-LAW PARTNER', '2024-08-17 05:09:27', '2024-08-17 05:09:27'),
(9, 1, 'DIETHER R. ALEJO', '24', 'SON', '2024-08-17 05:10:00', '2024-08-17 05:10:00'),
(10, 3, 'ANYA JADE B. ROQUE', '10', 'DAUGHTER', '2024-08-17 05:10:28', '2024-08-17 05:10:28'),
(11, 4, 'LUNA AKISHA ROQUE', '2', 'DAUGHTER', '2024-08-17 05:10:57', '2024-08-17 05:10:57'),
(12, 5, 'DIETHER R. ALEJO', '24', 'BROTHER', '2024-08-17 05:11:21', '2024-08-17 05:11:21'),
(13, 6, 'LUNA AKISHA ROQUE', '2', 'DAUGHTER', '2024-08-17 05:11:47', '2024-08-17 05:11:47'),
(14, 7, 'BONNIE S. MABACQUIAO', '28', 'FIANCE', '2024-08-17 05:12:18', '2024-08-17 05:12:18'),
(15, 8, 'SEBASTIAN IVER B. ROQUE', '5', 'SON', '2024-08-17 05:12:53', '2024-08-17 05:12:53'),
(16, 9, 'YOLANDA D. CINCO', '52', 'MOTHER', '2024-08-17 05:18:21', '2024-08-17 05:18:21'),
(17, 10, 'JEORGE MICHAEL OSORIO', '31', 'BROTHER', '2024-08-17 05:23:01', '2024-08-17 05:23:01'),
(18, 10, 'JOHN PAUL OSORIO', '32', 'BROTHER', '2024-08-17 05:23:01', '2024-08-17 05:23:01'),
(19, 11, 'NOEL JOSEPH CASTILLEJOS', '39', 'HUSBAND', '2024-08-22 20:54:05', '2024-08-22 20:54:05'),
(20, 11, 'IC EVANGELINE BARILAD', '22', 'DAUGHTER', '2024-08-22 20:54:05', '2024-08-22 20:54:05'),
(21, 11, 'VITO CASTILLEJOS', '2', 'SON', '2024-08-22 20:54:05', '2024-08-22 20:54:05'),
(22, 13, 'CHINLAND GRACE ORTIZ', '27', 'SISTER', '2024-08-22 21:03:49', '2024-08-22 21:03:49'),
(23, 13, 'DHAN ALBERT ESCOTO', '37', 'BROTHER', '2024-08-22 21:03:49', '2024-08-22 21:03:49'),
(24, 13, 'MAZE BAUTISTA', '4', 'NIECE', '2024-08-22 21:03:49', '2024-08-22 21:03:49'),
(25, 14, 'LORLIE R. ALEJO', '45', 'MOTHER', '2024-08-22 21:07:25', '2024-08-22 21:07:25'),
(26, 14, 'HARVIE R. ALEJO', '26', 'BROTHER', '2024-08-22 21:07:25', '2024-08-22 21:07:25'),
(27, 15, 'ROWENA P CATINDIG', '39', 'COMMON-LAW PARTNER', '2024-08-22 21:12:16', '2024-08-22 21:12:16'),
(28, 15, 'JETRO II C HILARIO', '11', 'SON', '2024-08-22 21:12:16', '2024-08-22 21:12:16'),
(29, 15, 'DANIEL ROWEN C HILARIO', '5', 'SON', '2024-08-22 21:12:16', '2024-08-22 21:12:16'),
(30, 16, 'HIRO SATO', '24', 'SON', '2024-08-22 21:19:07', '2024-08-22 21:19:07'),
(31, 16, 'YUKI SATO', '19', 'SON', '2024-08-22 21:19:07', '2024-08-22 21:19:07'),
(32, 16, 'AKIO SATO', '13', 'SON', '2024-08-22 21:19:07', '2024-08-22 21:19:07'),
(33, 17, 'LIANA CRIS LYN TOLENTINO', '36', 'WIFE', '2024-08-22 21:29:06', '2024-08-22 21:29:06'),
(34, 17, 'ROSITA TOLENTINO', '61', 'MOTHER', '2024-08-22 21:29:06', '2024-08-22 21:29:06'),
(35, 18, 'AYESHI MOLLY B ROQUE', '30', 'DAUGHTER', '2024-08-22 21:33:34', '2024-08-22 21:33:34'),
(36, 20, 'BERNARBE MABACQUIA', '59', 'FATHER', '2024-08-22 21:47:06', '2024-08-22 21:47:06'),
(37, 20, 'NELLY MABACQUIA', '55', 'MOTHER', '2024-08-22 21:47:06', '2024-08-22 21:47:06'),
(38, 21, 'JEVALYNNE CASTILLEJOS', '39', 'WIFE', '2024-08-22 22:05:20', '2024-08-22 22:05:20'),
(39, 21, 'IC EVANGELINE BARIUAD', '22', 'DAUGHTER', '2024-08-22 22:05:20', '2024-08-22 22:05:20'),
(40, 21, 'VITO CASTILLEJOS', '2', 'SON', '2024-08-22 22:05:20', '2024-08-22 22:05:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
