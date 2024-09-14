-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 12:51 PM
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_children` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_of_income` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_income` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `educational_attainment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `firstname`, `middlename`, `lastname`, `nickname`, `address`, `religion`, `birthdate`, `birthplace`, `gender`, `mobile_no`, `email_address`, `occupation`, `civil_status`, `spouse`, `spouse_occupation`, `no_children`, `mothers_name`, `fathers_name`, `company`, `company_phone_no`, `company_address`, `source_of_income`, `monthly_income`, `educational_attainment`, `contact_person`, `contact_person_no`, `contact_person_address`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'LORLIE', 'ROQUE', 'ALEJO', 'LHIE', '3A TEACHERS ST MEERYHOMES SUBD. SAUYO QC', 'ROMAN CATHOLIC', '1979-02-26', 'CALOOCAN CITY', 'female', '09274068542', 'lorliealejo26@gmail.com', 'BUSINESS WOMAN', 'widowed', NULL, NULL, '2', 'LILIA T. BORCENA', 'LORETO S. ROQUE', 'SJDM LIVESTOCK AND ABATTOIR CORP', '-', 'LIANA RD CSJDM BULACAN', 'SALARY', '50000', 'college', 'BERNARD JASON ORTIZ', '09185858426', '43 J P RIZAL ST STA LUCIA QC', 'regular', 1, 1, NULL, '2024-08-17 04:14:50', '2024-08-17 04:16:26'),
(2, 'JAS', 'ESPANAR', 'SORBITO', 'JAS', '23R GREENBELT PARKPLACE C. APALNCA ST MAKATI CITY', 'CHRISTIAN', '1988-10-23', 'BACOLOD CITY', 'male', '09085385909', 'jassorbito@gmail.com', 'FREELANCE', 'single', NULL, NULL, '0', 'LERMA B. ESPANAR', 'NILO G. SORBITO', 'N/A', 'N/A', 'MAKATI CITY', 'MIXED', '40000', 'college', 'JEAN MARIE OSORIO', '09989905297', 'MAKATI CITY', 'regular', 1, 1, NULL, '2024-08-17 04:25:35', '2024-08-17 04:25:35'),
(3, 'LOLITO', 'BORCENA', 'ROQUE', 'TOLITS', 'B12 L5 HOMELAND SUBD BRGY SAUYO QC', 'ROMAN CATHOLIC', '1984-04-11', 'QUEZON CITY', 'male', '09088195764', 'N/A', 'BUSINESS MAN', 'married', 'REVI-J B. ROQUE', 'BUSINESS WOMAN', '3', 'LILIA T. BORCENA', 'LORETO S. ROQUE', 'NA', '09088195764', 'COMMONWEALTH MARKET QUEZON CITY', 'BUSINESS', '50000', 'college', 'REVI-J B. ROQUE', '09171030056', 'B12 L5 HOMELAND SUBD BRGY SAUYO QC', 'regular', 1, 1, NULL, '2024-08-17 04:32:46', '2024-08-17 04:32:46'),
(4, 'LUISITO', 'BORCENA', 'ROQUE', 'LOUIE', 'BLK 12 L4 HOMELAND SUBD. SAUYO QC', 'ROMAN CATHOLIC', '1986-11-10', 'MANILA', 'male', '09062669994', 'NA', 'BUSINESS MAN', 'married', 'AYESHI MOLY ROQUE', NULL, '3', 'LILIA T. ROQUE', 'LORETO S. ROQUE', 'SJDM LIVESTOCK AND ABATTOIR CORP', '02-8452-2957', 'LIANA RD CSJDM BULACAN', 'BUSINESS', '50000', 'college', 'AYESHI MOLY ROQUE', '09269969994', 'BLK 12 L4 HOMELAND SUBD. SAUYO QC', 'regular', 1, 1, NULL, '2024-08-17 04:45:04', '2024-08-17 04:45:04'),
(5, 'HARVIE YVES', 'ROQUE', 'ALEJO', 'HARVIE', '3A TEACHERS ST MERRYHOMES SUBD. SAUYO QC', 'ROMAN CATHOLIC', '1998-05-06', 'QUEZON CITY', 'male', '09274102384', 'HARVIEALEJO6@GMAIL.COM', 'REAL ESTATE SALESPERSON', 'single', NULL, NULL, '0', 'LORLIE B. ROQUE', 'ALVIN M. ALEJO', 'AVIDA LAND CORP', 'NA', '909 40TH ST NIORTH BONIFACIO TRIANGLE BGC TAGUIG CITY', 'SALARY', '50000', 'college', 'LORLIE R. ALEJO', '09274068542', '3A TEACHERS ST MERRYHOMES SUBD SAUYO QC', 'regular', 1, 1, NULL, '2024-08-17 04:49:24', '2024-08-17 04:49:24'),
(6, 'AYESHI MOLLY', 'BERNARDINO', 'ROQUE', 'CHANG', 'B12 L4 HOMELAND SUBD SAUYO QC', 'ROMAN CATHOLIC', '1993-08-21', 'PARANAQUE CITY', 'female', '09269969994', 'N/A', 'BUSINESS WOMAN', 'married', 'LUISITO ROQUE', 'BUSINESS MAN', '3', 'DOLORES BERNARDINO', 'TETSUYA KANAKAMI', 'SJDM LIVESTOCK AND ABATTOIR CORP', '02-8452-2951', 'LIANA RD CSJDM BULACAN', 'MIX', '30000', 'college', 'LUISITO ROQUE', '09062669994', 'BLK 12 L4 HOMELAND SUBD SAUYO QC', 'regular', 1, 1, NULL, '2024-08-17 04:54:06', '2024-08-17 04:54:06'),
(7, 'MYLENE', 'RIVAS', 'NACULANGGA', 'MYE', '220 E SINAGTALA ST BATASAN HILLS QC', 'BORN AGAIN CHRISTIAN', '1997-04-03', 'MANILA', 'female', '09995307722', 'mylenerivasnaculangga@gmail.com', 'BUSINESS WOMAN', 'single', NULL, NULL, NULL, 'MELINDA S. RIVAS', 'FEDERITO N. NACULANGGA', 'NENE AND MELINDA\'S MEATSHOP', 'N/A', 'M26 B11-B12 COMMONWEALTH MARKET, COMMONWEALTH AVE QC', 'BUSINESS', '150000', 'college', 'BONNIE S. MABACQUIAO', '09995307722', '220 E SINAGTALA ST BATASAN HILLS QC', 'regular', 1, 1, NULL, '2024-08-17 04:58:31', '2024-08-17 04:58:31'),
(8, 'REVI-J', 'BARIUAD', 'ROQUE', 'REVI', 'B12 L5 HOMELAND SUBD BRGY SAUYO NOVALICHES QC', 'ROMAN CATHOLIC', '1982-05-25', 'TUGUEGARAO, CAGAYAN', 'female', '09171030056', 'revij08@yahoo.com', 'BUSINESS WOMAN', 'married', 'LOLITO B. ROQUE', NULL, NULL, 'REMEDIOS  L. BARIUAD', 'VICENTE D. BARIUAD', 'N/A', 'N/A', 'COMMONWEALTH MARKET QUEZON CITY', 'BUSINESS', '50000', 'college', 'LOLITO B. ROQUE', '09088195764', 'B12 L5 HOMELAND SUBD. BRGY SAUYO NOVALICHES QC', 'regular', 1, 1, NULL, '2024-08-17 05:08:16', '2024-08-17 05:08:16'),
(9, 'ALLAN', 'CINCO', 'ALLAREY', 'ALLAN', '73 VISAYAS AVE STA LUCIA NOVALICHES QC', 'ROMAN CATHOLIC', '1996-08-06', 'MANILA CITY', 'male', '09207194352', 'N/A', 'ACCOUNTANT', 'single', NULL, NULL, NULL, 'YOLANDA D. CINCO', 'ALFONSO C. ALLAREY', 'SUN LIFE', 'N/A', 'BGC, TAGUIG CITY', 'SALARY', '0', 'college', 'YOLANDA D. CINCO', '09511704939', '73 VISAYAS AVE STA LUCIA NOVALICHES QC', 'regular', 1, 1, NULL, '2024-08-17 05:18:20', '2024-08-17 05:18:20'),
(10, 'JEAN MARIE', 'DELA PLANA', 'OSORIO', 'JEANIE', '23R GREENBELT PARKPLACE C. PALANCA ST MAKATI CITY', 'CHRISTIAN', '1986-03-08', 'QUEZON CITY', 'female', '09989905297', 'JEANIEOSORIO08@GMAIL.COM', 'HR OFFICER', 'single', NULL, NULL, NULL, 'MARICON L. DELA PLANA', 'NOEL R. OSORIO', 'BDO UNIBANK, INC', 'N/A', 'BDO CORP CENTER ORTIGAS', 'SALARY', '0', 'masters', 'JAS E. SORBITO', '09085385909', '23R GREENBELT PARKPLACE C. PALANCA ST MAKATI CITY', 'regular', 1, 1, NULL, '2024-08-17 05:23:01', '2024-08-17 05:23:01'),
(11, 'JEVALYN', 'BAARILAD', 'CASTILLEJOS', 'JEVA', '4D PAYTON ST  EAST FAIRVIEW PARK QC', 'ROMAN CATHOLIC', '1984-10-26', 'ISABELA', 'female', '092173372251', 'JBARILAD@YAHOO.COM', 'ENGINEER', 'married', 'NOEL JOSEPH CASTILLEJOS', NULL, '2', 'EVANGELINE M. RAMOS', 'ROBERTO BARILAD', 'SMART COMMUINICATIONS INC.', '0', 'AYALA AVE. COR MAKATI', 'SALARY', '0', 'college', 'NOEL JOSEPH CASTILLEJOS', '09199730029', 'FAIRVIEW QC', 'regular', 1, 1, NULL, '2024-08-22 20:54:05', '2024-08-22 20:54:05'),
(12, 'NOEL', 'MENDOZA', 'BULAN', 'NOEL', '47 A MABINI ST STA LUCIA NOVE QC', 'ROMAN CATHOLIC', '1995-04-15', 'MANILA', 'male', '09163987610', '-', 'TEACHER', 'single', NULL, NULL, NULL, 'PRECILLA P MENDOZA', 'NICOMEDES C BULAN', 'SAN GABRIEL ELEMENTARY SCHOOL', '0', 'BONIFACIO ST STA LUCIA NOVALICHES QC', 'SALARY', '0', 'college', 'ALLAN REY ALLAREY', '09207194352', '43 VISAYAS AVE STA LUCIA NOVALICHES QC', 'regular', 1, 1, NULL, '2024-08-22 20:57:27', '2024-08-22 20:57:27'),
(13, 'BERNARD JASON', 'ESCOTO', 'ORTIZ', 'BJ', '43 J P RIZAL ST STA LUCIA NOVALICHES QC', 'ROMAN CATHOLIC', '1995-04-27', 'MANILA', 'male', '09185858426', 'bernardortiz85@gmail.com', 'N/A', 'single', NULL, NULL, NULL, 'ROSITA M ESCOTO', 'BERNARD ORTIZ JR', 'N/A', 'N/A', 'N/A', 'N/A', '0', 'college', 'LORLIE R. ALEJO', '09274068542', '3A TEACHERS ST MERRYHOMES SUBD SAUYO QC', 'regular', 1, 1, NULL, '2024-08-22 21:03:49', '2024-08-22 21:03:49'),
(14, 'DIETHER', 'ROQUE', 'ALEJO', 'BANGGGY', '3A TEACHERS ST MERRYHOMES SUBD. SAUYO QC', 'ROMAN CATHOLIC', '2000-04-11', 'QUEZON CITY', 'male', '09182948464', 'alejodiet@gmail.com', 'N/A', 'single', NULL, NULL, NULL, 'LORLIE B. ROQUE', 'ALVIN M. ALEJO', 'N/A', 'N/A', 'N/A', 'ALLOWANCE', '0', 'college', 'LORLIE R. ALEJO', '09289180356', '3A TEACHERS ST MERRYHOMES SUBD SAUYO QC', 'regular', 1, 1, NULL, '2024-08-22 21:07:25', '2024-08-22 21:07:25'),
(15, 'JETRO', 'TAMAYO', 'HILARIO', 'JETERS', 'L18 CELIA ST BRGY PANGINAY BALAGTAS BULACAN', 'BORN AGAIN CHRISTIAN', '1986-09-05', 'MALOLOS, BULACAN', 'male', '09274041824', 'JETERS77R26@GMAIL.COM', 'BUSINESS MAN', 'single', NULL, NULL, NULL, 'OFELIA G TAMAYO', 'VIRGILIA E HILARIO', 'DANIEL GRAPHIC DESIGN SERVICES', '044-903-7663', '121 POBLACION GUIGUINTO BULACAN', 'BUSINESS', '0', 'college', 'ROWENA P CATINDIG', '09166640611', 'L18 CELIA ST BRGY PANGINAY BALAGTAS BULACAN', 'regular', 1, 1, NULL, '2024-08-22 21:12:16', '2024-08-22 21:12:16'),
(16, 'ANGELO', 'BORDONES', 'SATO', 'ANGE', '24 SUDIPEN ST NEW HAVEN VILL. NOVA. QC', 'ROMAN CATHOLIC', '1979-09-25', 'MANILA', 'male', '09667335333', 'N/A', 'SELF-EMPLOYED', 'single', NULL, NULL, '3', 'ANGELINA B BORDONES', 'ROMEO P SATO', 'N/A', 'N/A', 'N/A', 'N/A', '0', 'college', 'SAMZONEE SOLIMAN', '09688900423', 'N/A', 'regular', 1, 1, NULL, '2024-08-22 21:19:07', '2024-08-22 21:19:07'),
(17, 'ERIC', 'CORTEZ', 'TOLENTINO', 'ERIC', 'B87 L26 EASTWOOD RESIDENCE PHASE 3 RR', 'ROMAN CATHOLIC', '1989-04-06', 'CLRH, SAN FERNANDO PAMPANGA', 'male', '09279423572', 'ericcorteztolentino@gmail.com', 'IT', 'married', 'LIANA CRIS LYN TOLENTINO', 'N/A', NULL, 'ROISTA GUTIEREZ', 'ERNESTO TOLENTINO', 'E-PLDT', '09992270205', 'NICANOR REYES BRGY BELAIR MAKATI CITY', 'SALARY', '25000', 'college', 'LIANA CRIS LYN TOLENTINO', '09338218825', 'B87 L26 EASTWOOD RESIDENCE PHASE 3 RR', 'regular', 1, 1, NULL, '2024-08-22 21:29:06', '2024-08-22 21:29:06'),
(18, 'DOLORES', 'CRUZ', 'BERNARDINO', 'DOLLY', 'B6 L13 MT KANLAON RD, MONTEVISTA HEIGHTS SUBD., BRGY DOLORES TAYTAY RIZAL', 'ROMAN CATHOLIC', '1969-02-27', 'TAYTAY RIZAL', 'female', '09186214591', 'DOLLYCRUZBERN227@GMAIL.COM', 'MUNICIPAL EMPLOYEE', 'single', NULL, NULL, NULL, 'LUCITA C CRUZ', 'RAMOS P BERNARDINO', 'N/A', 'N/A', 'CAINTA, RIZAL', 'N/A', '0', 'college', 'AYESHI MOLY ROQUE', '09269969994', 'B12 L5 HOMELAND SUBD BRGY SAUYO QC', 'regular', 1, 1, NULL, '2024-08-22 21:33:34', '2024-08-22 21:33:34'),
(19, 'AL VINCENT', 'N/A', 'BARIUAD', 'VINCE', 'B12 L5 HOMELAND SUBD BRGY SAUYO QC', 'ROMAN CATHOLIC', '2000-06-20', 'TUMAVINI, ISABELA', 'male', '09454271003', 'vncbariuad@gmail.com', 'STUDENT', 'single', NULL, NULL, NULL, 'REVI-J BARIUAD', 'LEVY LESLEY LUENA', 'N/A', 'N/A', 'N/A', 'ALLOWANCE', '0', 'college', 'REVI-J B. ROQUE', '09171030056', 'B12 L5 HOMELAND SUBD BRGY SAUYO QC', 'regular', 1, 1, NULL, '2024-08-22 21:42:23', '2024-08-22 21:42:23'),
(20, 'BONNIE', 'SERVANIA', 'MABACQUIA', 'NONOY', '220-E SINAGTALA ST BATASAN HILLS QC', 'BORN AGAIN CHRISTIAN', '1996-03-29', 'SABANG, SIBUNAG GUIMARAS', 'male', '09205337636', 'MABACQUIABONNIE18@GMAIL.COM', 'BUSINESS MAN', 'single', NULL, NULL, NULL, 'NELLY S CABASAN', 'BERNABE G MABACQUIAO', 'NENE AND MELINDA\'S MEATSHOP', '09205337636', 'COMMONWEALTH MARKET QUEZON CITY', 'BUSINESS', '30000', 'highschool', 'MYLENE NACULANGGA', '09995307722', '220-E SINAGTALA ST BATASAN HILLS QC', 'regular', 1, 1, NULL, '2024-08-22 21:47:06', '2024-08-22 21:47:06'),
(21, 'NOEL JOSEPH', 'MERIEL', 'CASTILLEJOS', 'JR', '40 PAXTON ST EAST FAIRVIEW PARK QC', 'ROMAN CATHOLIC', '1984-09-30', 'QUEZON CITY', 'male', '09199730029', 'CORLIOGNEOGC@YAHOO.COM', 'FREELANCE', 'married', 'JEVALYNNE CASTILLEJOS', NULL, NULL, 'GEMMA DORRIS F MERIEL', 'NOEL CASTILLEJOS', 'HOME INSTEAD', 'N/A', 'N/A', 'N/A', '0', 'college', 'JENALYNNE CASTILLEJOS', '09473372251', 'FAIRVIEW QC', 'regular', 1, 1, NULL, '2024-08-22 22:05:20', '2024-08-22 22:05:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
