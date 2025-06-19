-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 08:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eofficedocument`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `modifiedBy` varchar(255) NOT NULL,
  `deletedBy` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `isDeleted`, `createdBy`, `modifiedBy`, `deletedBy`, `created_at`, `updated_at`) VALUES
(1, 'Procurement', 'Procurement', 0, '1', '', NULL, '2024-08-12 23:49:11', '2024-08-12 23:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `communications`
--

CREATE TABLE `communications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `communication` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communications`
--

INSERT INTO `communications` (`id`, `communication`, `created_at`, `updated_at`) VALUES
(1, 'Acknowledgement', '2024-08-12 23:53:53', '2024-08-12 23:53:53'),
(2, 'Bill', '2024-08-12 23:53:59', '2024-08-12 23:53:59'),
(3, 'Circular', '2024-08-12 23:54:06', '2024-08-12 23:54:06'),
(4, 'Document', '2024-08-12 23:54:19', '2024-08-12 23:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ministry_department` bigint(20) UNSIGNED DEFAULT NULL,
  `state` bigint(20) UNSIGNED DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `organitation` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `name`, `ministry_department`, `state`, `designation`, `organitation`, `email`, `address`, `pin_code`, `phone_number`, `country`, `city`, `created_at`, `updated_at`) VALUES
(8, 'Ashis Jenamani', 3, 17, 'MD', 'Zenprateck', 'ashis@mail.com', 'Plot No-29', '751016', '09861071739', '105', 'Bhubaneswar', '2025-04-01 07:34:14', '2025-04-01 07:34:14'),
(9, 'Debendra Sahoo', 2, 17, 'Test', 'Org', 'admin@mail.com', 'Plot No-325', '751003', '09861071739', '105', 'Bhubaneswar', '2025-04-11 06:05:35', '2025-04-11 06:05:35'),
(11, 'Chanda Goodwin', 2, 4, 'Ex repellendus Eum', 'Newman Cannon Inc', 'fuza@mailinator.com', 'Quia laborum dolor v', 'Quasi odit', '+1 (844) 698-76', '105', 'Illo provident inci', '2025-04-15 05:33:41', '2025-04-15 05:33:41'),
(12, 'gulzar', 2, 17, 'General Developer', 'SRDC', 'debendraster@gmail.com', 'Bhubaneswar', '969663', '6677654567', '105', 'Dhenkanal', '2025-04-15 06:02:44', '2025-04-15 06:02:44'),
(13, 'Kelsey Pope', 2, 37, 'Nihil officiis dolor', 'Lang Vaughn Traders', 'xybekila@mailinator.com', 'Neque consequatur d', 'Et hic con', '+1 (751) 876-32', '165', 'Optio consequatur u', '2025-04-15 06:23:08', '2025-04-15 06:23:08'),
(14, 'Chloe Hubbard', 2, 22, 'Ut dolore dolor assu', 'Russo and Patel Co', 'canegaheze@mailinator.com', 'Qui expedita nostrum', 'Porro aute', '+1 (662) 165-36', '105', 'Et culpa ducimus d', '2025-04-15 06:26:15', '2025-04-15 06:26:15'),
(15, 'Guy Munoz', 2, 11, 'Dolore quam ipsam so', 'Farmer and Saunders Trading', 'cunybovapu@mailinator.com', 'Vel laborum minim co', 'Provident ', '+1 (524) 786-36', '165', 'Enim elit corporis', '2025-04-15 23:52:38', '2025-04-15 23:52:38'),
(16, 'Randall Stuart', 2, 13, 'Magna laboris nihil', 'Stewart and Sargent Associates', 'worubymawu@mailinator.com', 'Voluptate nisi natus', 'Aliquam el', '+1 (107) 769-16', '165', 'Et ullam sint repudi', '2025-04-16 00:35:06', '2025-04-16 00:35:06'),
(17, 'Regan Townsend', 3, 6, 'Sed quae quo quaerat', 'Rodgers Reilly Co', 'zasyd@mailinator.com', 'Rerum veniam repreh', 'Ea adipisi', '+1 (853) 752-84', '165', 'Est animi nostrud o', '2025-04-16 00:35:48', '2025-04-16 00:35:48'),
(18, 'Tamekah Mccullough', 2, 9, 'Non deserunt aliquid', 'Cobb and Rivas Traders', 'pegol@mailinator.com', 'Optio consequatur', 'Aut accusa', '+1 (756) 122-18', '165', 'Fuga Officia dolor', '2025-04-16 00:36:16', '2025-04-16 00:36:16'),
(19, 'Gareth Mcbride', 4, 2, 'Dolor ut explicabo', 'Whitley Hopper Plc', 'pyxeqovej@mailinator.com', 'Eum et minim ea odio', 'Irure sint', '+1 (326) 337-39', '105', 'Nostrum sint natus a', '2025-04-16 00:38:17', '2025-04-16 00:38:17'),
(20, 'Serena Anthony', 4, 20, 'Beatae et dolore ips', 'Mathews and Watson Co', 'sajozucyj@mailinator.com', 'Quia consequat Exce', 'Perspiciat', '+1 (157) 339-22', '105', 'Fugiat eum magni ad', '2025-04-16 01:02:06', '2025-04-16 01:02:06'),
(21, 'Neil Patel', 3, 32, 'Elit dolores odio l', 'Britt Burks Inc', 'rogoqyr@mailinator.com', 'Ut incididunt dolore', 'Eligendi p', '+1 (778) 449-40', '165', 'Commodo earum omnis', '2025-04-16 01:09:01', '2025-04-16 01:09:01'),
(22, 'Constance Pratt', 3, 19, 'Ipsam incidunt volu', 'Stuart and Rosa Co', 'xyzyjyce@mailinator.com', 'Tempore vel ea nost', 'Laudantium', '+1 (711) 676-54', '105', 'Vitae et repudiandae', '2025-04-16 01:18:58', '2025-04-16 01:18:58'),
(23, 'Belle Randall', 4, 17, 'Ipsa illum ducimus', 'Farrell Combs Plc', 'vuwecove@mailinator.com', 'Voluptatum vitae rem', 'Sapiente e', '+1 (757) 284-79', '105', 'Sint reprehenderit', '2025-04-16 02:18:10', '2025-04-16 02:18:10'),
(24, 'Ariel Hall', 2, 16, 'Vel cillum modi ea u', 'Schultz Mays Plc', 'zacic@mailinator.com', 'Excepturi nesciunt', 'Quaerat cu', '+1 (254) 125-26', '105', 'Dolore unde quibusda', '2025-04-16 03:08:00', '2025-04-16 03:08:00'),
(25, 'Sk Kahinoor', 4, 17, 'General Manager', 'Health Ministry', 'admin@example.com', 'Bhubaneswar', '751075', '7658954789', '105', 'Dhenkanal', '2025-04-16 03:49:49', '2025-04-16 03:49:49'),
(26, 'Gannon Mckenzie', 2, 35, 'Enim qui neque volup', 'Rodriguez and Henry LLC', 'ragu@mailinator.com', 'Est temporibus qui a', 'Labore asp', '+1 (585) 239-60', '105', 'Et vitae facilis ad', '2025-04-16 03:57:38', '2025-04-16 03:57:38'),
(27, 'Mary Navarro', 2, 10, 'Sequi voluptatem nul', 'Mcdonald Thornton LLC', 'mixow@mailinator.com', 'Velit voluptas esse', 'Exercitati', '+1 (394) 307-74', '105', 'Asperiores eu sit d', '2025-04-16 03:59:50', '2025-04-16 03:59:50'),
(28, 'Allen Fuller', 4, 10, 'Dolores in aperiam n', 'Mendez Vasquez Inc', 'wipukavezi@mailinator.com', 'Sed libero ut eligen', 'Ea excepte', '+1 (434) 352-46', '105', 'Lorem odit dolor pla', '2025-04-16 04:10:50', '2025-04-16 04:10:50'),
(29, 'Jonas Lester', 4, 9, 'Ut expedita dolore q', 'Combs Romero Associates', 'kypyxyxi@mailinator.com', 'In voluptatem ipsa', 'Consequatu', '+1 (991) 787-13', '165', 'Nesciunt nulla et d', '2025-04-16 04:27:41', '2025-04-16 04:27:41'),
(30, 'Ainsley Crane', 2, 10, 'Illo do soluta ut to', 'Macdonald and Howe Inc', 'zedakoj@mailinator.com', 'Fugiat enim dolore', 'Labore ali', '+1 (792) 294-15', '105', 'Proident facere ven', '2025-04-16 04:30:04', '2025-04-16 04:30:04'),
(31, 'Aaron Bentley', 3, 31, 'Sint elit molestias', 'Bentley and Gallagher Associates', 'qapoten@mailinator.com', 'Officia asperiores v', 'Quia elit ', '+1 (629) 706-82', '105', 'Distinctio Id ipsa', '2025-04-17 01:44:39', '2025-04-17 01:44:39'),
(32, 'Walter Ward', 2, 23, 'Excepteur voluptate', 'Blanchard and Gaines Inc', 'sodogiren@mailinator.com', 'Laborum Provident', 'Doloremque', '+1 (503) 846-80', '165', 'Aut dolor obcaecati', '2025-04-17 05:33:55', '2025-04-17 05:33:55'),
(33, 'Buckminster Whitaker', 2, 17, 'Quod quia sed nisi c', 'Alston and Fernandez Associates', 'bucozovy@mailinator.com', 'Explicabo Sunt fuga', 'Voluptatum', '+1 (688) 452-17', '105', 'Non eu quo vero offi', '2025-04-17 06:30:52', '2025-04-17 06:30:52'),
(34, 'Joel Cleveland', 2, 29, 'Tenetur velit nulla', 'Duncan and Garner Associates', 'gynucorysu@mailinator.com', 'Quasi voluptatem ame', 'Rem minima', '+1 (724) 599-79', '105', 'Id a quos aute sunt', '2025-04-17 06:31:18', '2025-04-17 06:31:18'),
(35, 'Rashmita', 3, 23, 'manager', 'Fields Brock Traders', 'polijovy@mailinator.com', 'Accusantium et aliqu', 'Necessitat', '+1 (391) 153-70', '165', 'Aspernatur magnam es', '2025-04-29 04:45:13', '2025-04-29 04:45:13'),
(36, 'Jacob Barr', 4, 37, 'Beatae dicta illo re', 'Santos and Wynn Associates', 'tirumezu@mailinator.com', 'Aut culpa ea cupida', 'Aliquid pa', '+1 (976) 409-13', '165', 'Perferendis sed omni', '2025-04-30 03:41:48', '2025-04-30 03:41:48'),
(37, 'Reagan Pickett', 2, 10, 'Cupidatat harum sunt', 'Townsend King Inc', 'kahokyfuf@mailinator.com', 'Quasi beatae maxime', 'Laboriosam', '+1 (214) 855-33', '165', 'Proident dolores de', '2025-04-30 04:17:13', '2025-04-30 04:17:13'),
(38, 'Hilda Maldonado', 4, 16, 'Proident labore eni', 'Melendez Peck LLC', 'rugiruh@mailinator.com', 'Ex obcaecati sapient', 'Magni sunt', '+1 (421) 883-95', '105', 'Quidem ullamco ipsum', '2025-04-30 04:23:18', '2025-04-30 04:23:18'),
(39, 'Jayme Manning', 3, 14, 'Minima suscipit repu', 'Grimes Guy Associates', 'soqolykyk@mailinator.com', 'Vel ut consequatur a', 'Molestiae ', '+1 (518) 671-72', '165', 'Impedit est offici', '2025-04-30 04:24:28', '2025-04-30 04:24:28'),
(40, 'Liberty Mcknight', 4, 34, 'Aut excepturi asperi', 'Peters Owens LLC', 'dozytuf@mailinator.com', 'Voluptatibus et est', 'Culpa cons', '+1 (276) 129-42', '165', 'Nisi harum labore re', '2025-05-01 00:15:13', '2025-05-01 00:15:13'),
(41, 'Jenette Ramsey', 4, 20, 'Fuga Elit nisi est', 'Frazier and Tran Inc', 'sikekoqupo@mailinator.com', 'Eius inventore iusto', 'Facere lau', '+1 (202) 855-43', '105', 'Qui distinctio Ulla', '2025-05-01 00:19:18', '2025-05-01 00:19:18'),
(42, 'Jonah Hendrix', 3, 28, 'Blanditiis nisi repe', 'Campos Underwood Trading', 'pukovytac@mailinator.com', 'Non nesciunt irure', 'Amet dolor', '+1 (459) 918-73', '165', 'Omnis voluptate plac', '2025-05-01 01:28:20', '2025-05-01 01:28:20'),
(43, 'Brittany Ochoa', 4, 35, 'Et voluptas quo iust', 'Brooks and Guerra Associates', 'pygorave@mailinator.com', 'Ex ipsa officiis so', 'Ad sequi l', '+1 (187) 604-96', '165', 'Similique dolorem ut', '2025-05-01 01:57:00', '2025-05-01 01:57:00'),
(44, 'Armand Pugh', 3, 17, 'Sit quod excepturi i', 'Morrison Campbell Trading', 'qijyrywox@mailinator.com', 'Rem eius veniam ab', 'Obcaecati ', '+1 (437) 909-37', '105', 'Voluptas quaerat vel', '2025-05-01 04:06:55', '2025-05-01 04:06:55'),
(45, 'Tamekah David', 2, 2, 'Esse consectetur qu', 'Mcknight and Rowe Traders', 'tiduqigo@mailinator.com', 'Explicabo Labore of', 'Voluptatem', '+1 (228) 312-31', '105', 'Error quibusdam qui', '2025-05-01 04:22:52', '2025-05-01 04:22:52'),
(46, 'Kyra Vinson', 3, 7, 'Molestiae ut suscipi', 'Riddle Thompson Co', 'wodis@mailinator.com', 'Vel sapiente ex magn', 'Vel est al', '+1 (596) 287-69', '165', 'Tenetur eu ut aut ip', '2025-05-01 06:50:59', '2025-05-01 06:50:59'),
(47, 'Claudia Hodges', 3, 11, 'Nostrum maiores sunt', 'Benton and Spence LLC', 'jepos@mailinator.com', 'Facilis omnis debiti', 'Fuga Qui u', '+1 (312) 616-46', '105', 'Eos cum voluptas qu', '2025-05-02 05:09:31', '2025-05-02 05:09:31'),
(48, 'Chancellor Dunlap', 4, 4, 'Tempora laboriosam', 'Greene Santos Traders', 'mifasityq@mailinator.com', 'Autem voluptas verit', 'Officiis i', '+1 (631) 527-14', '165', 'Sint qui consequatu', '2025-05-02 05:11:51', '2025-05-02 05:11:51'),
(49, 'Signe Briggs', 3, 3, 'Culpa earum magni of', 'Kane and Harding Inc', 'xajovelujy@mailinator.com', 'Harum laborum enim p', 'Facilis ni', '+1 (375) 897-95', '165', 'Dolor sunt minim nob', '2025-05-02 05:24:16', '2025-05-02 05:24:16'),
(50, 'Barbara Walters', 4, 5, 'Autem quia ullamco n', 'Tyler Padilla Traders', 'samy@mailinator.com', 'Suscipit consequat', 'Deserunt q', '+1 (636) 362-29', '165', 'Optio est exercita', '2025-05-02 05:28:08', '2025-05-02 05:28:08'),
(51, 'Phoebe Chaney', 3, 18, 'Hic fugit eaque do', 'Clemons and Bolton Plc', 'venice@mailinator.com', 'Delectus consectetu', 'Labore qui', '+1 (266) 604-54', '105', 'Molestias pariatur', '2025-05-02 05:33:46', '2025-05-02 05:33:46'),
(52, 'Gwendolyn Hawkins', 2, 30, 'Velit quis facere ea', 'Bowen and Hopper Co', 'qidynygo@mailinator.com', 'Sapiente sunt cillu', 'Eos enim v', '+1 (226) 249-49', '105', 'Ullamco eos molliti', '2025-05-03 00:20:46', '2025-05-03 00:20:46'),
(53, 'Stacy Horne', 2, 15, 'Explicabo Cum fugia', 'Freeman Chan Inc', 'qynafemipi@mailinator.com', 'Enim modi ipsum sin', 'Est odio m', '+1 (761) 106-16', '165', 'In est sit qui non', '2025-05-03 00:55:11', '2025-05-03 00:55:11'),
(54, 'Virginia Odom', 3, 3, 'Voluptatem dolore re', 'Velazquez and Rasmussen Plc', 'fysiruzuf@mailinator.com', 'Irure laborum vel pr', 'Dolor expe', '+1 (377) 781-87', '105', 'Cupidatat quisquam u', '2025-05-03 01:20:33', '2025-05-03 01:20:33'),
(55, 'Keiko Sanders', 3, 18, 'Quia eum est culpa', 'Dunlap Harris Co', 'riryfazofy@mailinator.com', 'Nostrum sit fugit', 'Officiis m', '+1 (402) 963-31', '105', 'Excepteur tenetur al', '2025-05-03 01:21:20', '2025-05-03 01:21:20'),
(56, 'Kyra Turner', 2, 9, 'Exercitationem ducim', 'Combs Fitzpatrick Plc', 'gobymojyho@mailinator.com', 'Neque quidem rerum i', 'Unde labor', '+1 (798) 904-88', '165', 'Ratione cum aut quo', '2025-05-05 00:23:40', '2025-05-05 00:23:40'),
(57, 'Amity Turner', 3, 27, 'Ex et commodo do qui', 'Decker and Potter Inc', 'rehav@mailinator.com', 'Neque qui porro cons', 'Non in off', '+1 (123) 349-40', '105', 'Aut aperiam illum e', '2025-05-05 00:47:11', '2025-05-05 00:47:11'),
(58, 'Lois Waters', 3, 33, 'Unde ea doloribus nu', 'Mcmillan and Lindsay Plc', 'vilekabypy@mailinator.com', 'Dolor aspernatur non', 'Beatae ali', '+1 (107) 152-24', '165', 'Laborum Consequat', '2025-05-05 00:49:59', '2025-05-05 00:49:59'),
(59, 'Keely Morton', 3, 14, 'Nisi aperiam nemo ex', 'Rhodes Harmon LLC', 'pydim@mailinator.com', 'Perferendis sint dol', 'Rem tenetu', '+1 (942) 234-65', '105', 'Ea sint sunt incidi', '2025-05-05 01:10:43', '2025-05-05 01:10:43'),
(60, 'Gareth Cox', 4, 16, 'Sit est in temporibu', 'Fisher Briggs Traders', 'mejyte@mailinator.com', 'Voluptatem dolores a', 'Laborum Qu', '+1 (523) 458-35', '165', 'Et perspiciatis et', '2025-05-08 01:46:55', '2025-05-08 01:46:55'),
(61, 'Roanna Villarreal', 3, 23, 'Error ea deserunt ad', 'Buck Mcintosh LLC', 'qexibe@mailinator.com', 'Esse ipsa voluptas', 'Laboris vo', '+1 (412) 337-99', '105', 'Optio voluptates ut', '2025-05-29 00:18:16', '2025-05-29 00:18:16'),
(62, 'Castor Richmond', 3, 11, 'Qui quis amet persp', 'Adkins and Carrillo Associates', 'hyfynogote@mailinator.com', 'Vel sint esse vel e', 'Rerum aut ', '+1 (829) 433-12', '165', 'Impedit aut et quae', '2025-06-04 15:56:18', '2025-06-04 15:56:18'),
(63, 'Carly Herring', 3, 32, 'Odit animi et odit', 'Zamora Wynn Traders', 'pylypoma@mailinator.com', 'Laboriosam velit co', 'Ea aut inv', '+1 (708) 484-62', '165', 'Rerum tempore omnis', '2025-06-04 15:57:14', '2025-06-04 15:57:14'),
(64, 'Jillian Bryan', 2, 27, 'Qui dignissimos nemo', 'Huffman and Singleton Associates', 'jidosi@mailinator.com', 'Dolore aspernatur id', 'Quasi dolo', '+1 (309) 532-64', '105', 'Obcaecati voluptatem', '2025-06-04 16:33:43', '2025-06-04 16:33:43'),
(65, 'Ria Deleon', 3, 31, 'Explicabo Explicabo', 'Small Davis LLC', 'rylalojes@mailinator.com', 'Labore nisi excepteu', 'Dolorem in', '+1 (461) 144-71', '105', 'Quia eaque id eiusmo', '2025-06-04 19:03:35', '2025-06-04 19:03:35'),
(66, 'Medge Rutledge', 2, 32, 'Cumque sit dolores', 'Hayes English Co', 'dyfuj@mailinator.com', 'Molestiae eum et sed', 'Ut in eum ', '+1 (222) 897-64', '165', 'Vitae enim dolore do', '2025-06-10 05:21:26', '2025-06-10 05:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `correspondences`
--

CREATE TABLE `correspondences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `receipt_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `notes_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `modifyBy` int(11) NOT NULL,
  `deletedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `correspondences`
--

INSERT INTO `correspondences` (`id`, `file_id`, `receipt_id`, `doc_id`, `notes_id`, `created_at`, `updated_at`, `createdBy`, `modifyBy`, `deletedBy`) VALUES
(1, 3, 5, NULL, NULL, '2025-06-18 05:28:02', '2025-06-18 05:28:02', 2, 0, 0),
(2, 3, NULL, 9, NULL, '2025-06-18 05:28:18', '2025-06-18 05:28:18', 2, 0, 0),
(3, 3, NULL, NULL, 16, '2025-06-18 05:29:00', '2025-06-18 05:29:00', 2, 0, 0),
(4, 4, 5, NULL, NULL, '2025-06-18 23:48:03', '2025-06-18 23:48:03', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` char(2) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`) VALUES
(105, 'IN', 'India'),
(165, 'OT', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `deliverymodes`
--

CREATE TABLE `deliverymodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverymodes`
--

INSERT INTO `deliverymodes` (`id`, `mode`, `created_at`, `updated_at`) VALUES
(1, 'Speed Post', '2024-08-12 23:50:53', '2024-08-12 23:50:53'),
(2, 'Courier', '2024-08-12 23:51:08', '2024-08-12 23:51:08'),
(3, 'By Hand', '2024-08-12 23:51:17', '2024-08-12 23:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Accounts', '2024-08-12 23:49:35', '2024-08-12 23:49:35'),
(2, 'General Administration', '2024-09-24 00:39:21', '2024-09-24 00:39:21'),
(3, 'Health & Family Welfare', '2024-09-24 00:39:36', '2024-09-24 00:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dtype` varchar(100) NOT NULL,
  `document_name` varchar(250) DEFAULT NULL,
  `meta_title` varchar(250) DEFAULT NULL,
  `uploadmetatitle` varchar(250) DEFAULT NULL,
  `documentpath` char(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `createdBy` varchar(255) NOT NULL,
  `modifyBy` varchar(255) NOT NULL,
  `deletedBy` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `dtype`, `document_name`, `meta_title`, `uploadmetatitle`, `documentpath`, `description`, `comments`, `createdBy`, `modifyBy`, `deletedBy`, `deleted_at`, `created_at`, `updated_at`, `doc_id`, `status`) VALUES
(9, 'create', 'A voluptate omnis of', 'Ab voluptatem illo', NULL, 'documents//A voluptate omnis of.pdf', ',l,,l,l', NULL, '2', '', '', '', '2025-06-11 04:10:36', '2025-06-11 04:10:36', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `metatags` varchar(255) NOT NULL,
  `fileno` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` varchar(255) NOT NULL,
  `subcategory_id` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `section_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deletedBy` tinyint(1) DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `file_type`, `metatags`, `fileno`, `description`, `category_id`, `subcategory_id`, `department_id`, `section_id`, `created_at`, `updated_at`, `createdBy`, `modifiedBy`, `deletedBy`, `status`, `deleted_at`) VALUES
(1, 'Sk File', 'Electronic', 'E fil for invest', 'file095647', 'invest inquiry for generate efile accordingly', '1', '1', '2', '3', '2025-06-18 05:07:57', '2025-06-18 05:07:57', 2, NULL, 1, 1, '2025-06-18 10:37:57'),
(2, 'Paula Romero', 'Electronic', 'Nisi eos dolor et co', 'Dolor porro harum se', 'Natus commodi volupt', '1', '1', '2', '3', '2025-06-18 05:13:27', '2025-06-18 05:13:27', 2, NULL, 1, 1, '2025-06-18 10:43:27'),
(3, 'Ahmed Rocha', 'Electronic', 'Nisi autem rem adipi', 'Quia amet eum simil', 'Aliquip dolores exce', '1', '1', '2', '3', '2025-06-18 05:25:13', '2025-06-18 05:25:13', 2, NULL, 1, 1, '2025-06-18 10:55:13'),
(4, 'Myra Valdez', 'Electronic', 'Et suscipit expedita', 'Quod irure mollitia', 'Voluptas rerum sint', '1', '1', '1', '1', '2025-06-18 23:39:10', '2025-06-18 23:39:10', 2, NULL, 1, 1, '2025-06-19 05:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `fileshares`
--

CREATE TABLE `fileshares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL,
  `gnotes_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `notifyby` varchar(255) DEFAULT NULL,
  `share_file_status` tinyint(4) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `recever_id` int(11) DEFAULT NULL,
  `duedate` varchar(255) DEFAULT NULL,
  `actiontype` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=Shared,\r\n1=revert,\r\n2=forward,\r\n3=The status will set, when the reverted file is corrected and send\r\n ',
  `read_status` int(10) DEFAULT 0,
  `createdBy` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fileshares`
--

INSERT INTO `fileshares` (`id`, `file_id`, `gnotes_id`, `department_id`, `section_id`, `sender_id`, `notifyby`, `share_file_status`, `remarks`, `recever_id`, `duedate`, `actiontype`, `priority`, `comments`, `status`, `read_status`, `createdBy`, `created_at`, `updated_at`) VALUES
(19, 11, 13, 2, 3, 2, 'email', 1, 'dfvbfbvf', 11, '2025-05-03', 'view', 'Medium', NULL, 0, 1, '2', '2025-05-03 05:34:33', '2025-05-03 05:34:46'),
(20, 11, 13, 2, 3, 11, NULL, NULL, 'czxb', 2, '2025-05-03', 'view', 'Medium', NULL, 2, 1, '11', '2025-05-03 05:35:45', '2025-05-03 05:36:06'),
(21, 11, 13, 2, 3, 2, NULL, NULL, 'czxb', 11, '2025-05-03', 'view', 'Medium', 'vcn bgn', 1, 0, '2', '2025-05-03 05:36:18', '2025-05-03 05:36:18'),
(22, 13, 15, 2, 3, 2, 'sms', 1, 'Doloremque esse illo', 11, '2009-12-22', 'view', 'High', NULL, 0, 1, '2', '2025-06-11 04:12:11', '2025-06-11 04:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `login_securities`
--

CREATE TABLE `login_securities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `google2fa_enable` tinyint(1) NOT NULL DEFAULT 0,
  `google2fa_secret` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_securities`
--

INSERT INTO `login_securities` (`id`, `user_id`, `google2fa_enable`, `google2fa_secret`, `created_at`, `updated_at`) VALUES
(1, 2, 0, '6JRLUGQCDWCJ3LOJ', '2025-03-30 19:04:19', '2025-03-30 19:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_19_054241_create_permission_tables', 1),
(5, '2021_06_21_083551_create_moduals_table', 1),
(6, '2021_06_22_094023_create_settings_table', 1),
(7, '2021_07_02_154516_create_login_securities_table', 1),
(8, '2022_05_23_172500_create_plants_table', 1),
(9, '2024_05_04_114239_category', 1),
(10, '2024_05_04_120405_subcategory', 1),
(11, '2024_05_07_055510_department', 1),
(12, '2024_05_08_110714_document', 2),
(13, '2024_05_09_054534_section', 3),
(14, '2024_05_09_091620_documents', 4),
(15, '2024_05_13_091335_document', 5),
(16, '2024_05_17_052518_add_column_name_to_document', 6),
(17, '2024_06_06_054854_share', 7),
(18, '2024_07_03_063538_deliverymode', 8),
(19, '2024_07_03_063951_vip', 9),
(20, '2024_07_03_064052_sender_type', 10),
(21, '2024_07_04_073208_communication', 11),
(22, '2024_07_04_102746_receipt', 12),
(23, '2024_07_09_073148_receiptshare', 13),
(24, '2024_07_10_051245_notes', 14),
(25, '2024_07_10_103035_yellownotes', 15),
(26, '2024_07_11_111026_correspondence', 16),
(27, '2024_07_12_111710_fileshare', 17),
(28, '2024_07_24_093836_template', 18),
(29, '2024_08_13_064244_ministry', 19),
(30, '2024_05_09_091620_file', 4),
(31, '2024_06_05_071352_add_department_id_to_users_table', 4),
(32, '2024_09_11_052911_create_t_o_d_o_lists_table ', 20),
(33, '2024_09_11_052911_create_t_o_d_o_lists_table', 21),
(34, '2024_09_18_050835_create_personal_notes_table', 22),
(38, '2024_09_21_053227_create_notices_table', 23),
(39, '2024_09_23_052655_create_notice_documents_table', 23),
(40, '2024_09_24_070140_add_status_to_users_table', 24),
(43, '2024_11_05_153112_create_contact_details_table', 25),
(44, '2024_11_14_110339_add_ocr_text_to_receipts_table', 26),
(45, '2024_12_02_163427_add_phone_to_users_table', 27),
(46, '2024_12_06_144555_add_computer_number_to_receipts_table', 28),
(47, '2025_01_10_181856_add_send_back_to_receipt_share_table', 29),
(48, '2025_01_13_150118_add_file_type_to_files_table', 30),
(49, '2025_04_24_054342_create_receipt_folders_table', 31),
(54, '2025_04_28_100719_add_cc_remark_due_date', 32),
(55, '2025_04_30_070358_add_read_status_to_receiptshares_table', 33),
(56, '2025_05_01_061834_add_pull_back_remark_in_receiptshares_table', 34),
(57, '2025_05_02_063346_add_is_pulled_back_to_receiptshares_table', 35),
(58, '2025_05_05_065939_create_movements_table', 36),
(59, '2025_06_10_113414_add_read_at_to_receiptshares_table', 37);

-- --------------------------------------------------------

--
-- Table structure for table `ministries`
--

CREATE TABLE `ministries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ministryname` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ministries`
--

INSERT INTO `ministries` (`id`, `ministryname`, `created_at`, `updated_at`) VALUES
(2, 'Ministry Of Agriculture', '2024-08-13 01:46:45', '2024-08-13 01:46:45'),
(3, 'Ministri Of Department', '2024-08-13 01:47:02', '2024-08-13 01:47:02'),
(4, 'Ministriy Of association', '2024-08-13 01:48:12', '2024-08-13 01:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `moduals`
--

CREATE TABLE `moduals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moduals`
--

INSERT INTO `moduals` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(2, 'role', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(3, 'module', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(4, 'setting', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(5, 'crud', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(6, 'langauge', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(7, 'permission', '2024-05-08 04:54:09', '2024-05-08 04:54:09'),
(8, 'inbox', '2024-07-08 02:58:45', '2024-07-08 02:58:45'),
(9, 'department', '2024-07-08 03:00:00', '2024-07-08 03:00:00'),
(10, 'section', '2024-07-08 03:00:16', '2024-07-08 03:00:16'),
(11, 'category', '2024-07-08 03:00:29', '2024-07-08 03:00:29'),
(12, 'subcategory', '2024-07-08 03:01:42', '2024-07-08 03:01:42'),
(13, 'file', '2024-07-08 03:01:58', '2024-07-08 03:01:58'),
(14, 'document', '2024-07-08 03:02:31', '2024-07-08 03:02:31'),
(15, 'receipt', '2024-07-09 06:41:27', '2024-07-09 06:41:27'),
(16, 'notes', '2024-07-19 00:34:46', '2024-07-19 00:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

CREATE TABLE `movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receipt_id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` enum('SENT','PULLBACK','received','viewed','SENTcc') NOT NULL,
  `remark` text DEFAULT NULL,
  `action_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movements`
--

INSERT INTO `movements` (`id`, `receipt_id`, `from_user_id`, `to_user_id`, `action`, `remark`, `action_at`, `created_at`, `updated_at`) VALUES
(3, 5, 2, 3, 'PULLBACK', 'mistak', '2025-06-10 11:07:27', '2025-06-10 05:37:27', '2025-06-10 05:37:27'),
(4, 5, 2, 1, 'PULLBACK', 'fghbfgmjh', '2025-06-10 11:08:49', '2025-06-10 05:38:49', '2025-06-10 05:38:49'),
(5, 5, 2, 4, 'PULLBACK', 'dbfgbngb', '2025-06-10 11:09:35', '2025-06-10 05:39:35', '2025-06-10 05:39:35'),
(6, 5, 2, 3, 'PULLBACK', 'dvfrgb', '2025-06-10 11:10:39', '2025-06-10 05:40:39', '2025-06-10 05:40:39'),
(7, 5, 2, 3, 'PULLBACK', 'hfgjnh', '2025-06-10 11:14:32', '2025-06-10 05:44:32', '2025-06-10 05:44:32'),
(8, 7, 2, 11, 'PULLBACK', '51616515', '2025-06-12 10:33:14', '2025-06-12 05:03:14', '2025-06-12 05:03:14'),
(9, 7, 2, 3, 'PULLBACK', '25252', '2025-06-12 10:34:22', '2025-06-12 05:04:22', '2025-06-12 05:04:22'),
(10, 7, 2, 4, 'PULLBACK', 'njnj', '2025-06-12 10:35:02', '2025-06-12 05:05:02', '2025-06-12 05:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `share_notes_status` tinyint(4) DEFAULT NULL,
  `approval_notes_status` tinyint(4) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `approvedby` int(11) NOT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) NOT NULL,
  `deletedBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `file_id`, `description`, `share_notes_status`, `approval_notes_status`, `createdBy`, `approvedby`, `approved_date`, `modifyBy`, `deletedBy`, `created_at`, `updated_at`) VALUES
(13, 11, '<p>dfdddv</p>', 1, 0, 2, 0, NULL, 0, 0, '2025-05-03 05:33:52', '2025-05-03 05:35:45'),
(14, 12, '<p>fgn bdgmjmgn</p>', NULL, 0, 2, 0, NULL, 0, 0, '2025-05-06 05:42:42', '2025-05-06 05:42:42'),
(15, 13, '<p>llllllll</p>', 1, 1, 2, 11, '2025-06-11 04:13:26', 0, 0, '2025-06-11 04:07:16', '2025-06-11 04:13:26'),
(16, 3, '<p>dsfvgdeg</p>', NULL, 0, 2, 0, NULL, 0, 0, '2025-06-18 05:28:53', '2025-06-18 05:28:53'),
(17, 4, '<p>dfbgfdbg hi hgfhng</p>', NULL, 0, 2, 0, NULL, 0, 0, '2025-06-18 23:46:15', '2025-06-19 00:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `file_type` int(11) NOT NULL COMMENT '0=>text,1=>document',
  `date` date NOT NULL,
  `description` varchar(300) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `user_id`, `title`, `meta_title`, `file_type`, `date`, `description`, `created_at`, `updated_at`) VALUES
(11, 1, 'This is a test notice', 'this-is-a-test-notice', 0, '2025-04-01', 'This is a test noticeThis is a test noticeThis is a test noticeThis is a test notice', '2025-04-01 06:53:58', '2025-04-01 06:53:58'),
(12, 1, 'This is a test notice 2', 'this-is-a-test-notice', 1, '2025-04-01', 'This is a test noticeThis is a test noticeThis is a test noticeThis is a test notice', '2025-04-01 06:54:27', '2025-04-01 06:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `notice_documents`
--

CREATE TABLE `notice_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice_id` bigint(20) UNSIGNED NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `meta_name` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notice_documents`
--

INSERT INTO `notice_documents` (`id`, `notice_id`, `document_name`, `meta_name`, `file_path`, `created_at`, `updated_at`) VALUES
(4, 12, 'hh.pdf', '', 'documents/upload/hh.pdf', '2025-04-01 06:54:27', '2025-04-01 06:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage-permission', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(2, 'create-permission', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(3, 'edit-permission', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(4, 'delete-permission', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(5, 'manage-role', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(6, 'create-role', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(7, 'edit-role', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(8, 'delete-role', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(9, 'show-role', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(10, 'manage-user', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(11, 'create-user', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(12, 'edit-user', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(13, 'delete-user', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(14, 'show-user', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(15, 'manage-module', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(16, 'create-module', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(17, 'delete-module', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(18, 'show-module', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(19, 'edit-module', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(20, 'manage-setting', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(21, 'manage-crud', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(22, 'manage-langauge', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(23, 'create-langauge', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(24, 'delete-langauge', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(25, 'show-langauge', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(26, 'edit-langauge', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(27, 'index', 'web', '2024-07-08 01:57:01', '2024-07-08 01:57:01'),
(28, 'manage-inbox', 'web', NULL, NULL),
(29, 'create-inbox', 'web', NULL, NULL),
(30, 'delete-inbox', 'web', NULL, NULL),
(31, 'show-inbox', 'web', NULL, NULL),
(32, 'edit-inbox', 'web', NULL, NULL),
(33, 'manage-department', 'web', NULL, NULL),
(34, 'create-department', 'web', NULL, NULL),
(35, 'delete-department', 'web', NULL, NULL),
(36, 'show-department', 'web', NULL, NULL),
(37, 'edit-department', 'web', NULL, NULL),
(38, 'manage-section', 'web', NULL, NULL),
(39, 'create-section', 'web', NULL, NULL),
(40, 'delete-section', 'web', NULL, NULL),
(41, 'show-section', 'web', NULL, NULL),
(42, 'edit-section', 'web', NULL, NULL),
(43, 'manage-category', 'web', NULL, NULL),
(44, 'create-category', 'web', NULL, NULL),
(45, 'delete-category', 'web', NULL, NULL),
(46, 'show-category', 'web', NULL, NULL),
(47, 'edit-category', 'web', NULL, NULL),
(48, 'manage-subcategory', 'web', NULL, NULL),
(49, 'create-subcategory', 'web', NULL, NULL),
(50, 'delete-subcategory', 'web', NULL, NULL),
(51, 'show-subcategory', 'web', NULL, NULL),
(52, 'edit-subcategory', 'web', NULL, NULL),
(53, 'manage-file', 'web', NULL, NULL),
(54, 'create-file', 'web', NULL, NULL),
(55, 'delete-file', 'web', NULL, NULL),
(56, 'show-file', 'web', NULL, NULL),
(57, 'edit-file', 'web', NULL, NULL),
(58, 'manage-document', 'web', NULL, NULL),
(59, 'create-document', 'web', NULL, NULL),
(60, 'delete-document', 'web', NULL, NULL),
(61, 'show-document', 'web', NULL, NULL),
(62, 'edit-document', 'web', NULL, NULL),
(63, 'manage-receipt', 'web', NULL, NULL),
(64, 'create-receipt', 'web', NULL, NULL),
(65, 'delete-receipt', 'web', NULL, NULL),
(66, 'show-receipt', 'web', NULL, NULL),
(67, 'edit-receipt', 'web', NULL, NULL),
(68, 'manage-notes', 'web', NULL, NULL),
(69, 'create-notes', 'web', NULL, NULL),
(70, 'delete-notes', 'web', NULL, NULL),
(71, 'show-notes', 'web', NULL, NULL),
(72, 'edit-notes', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_notes`
--

CREATE TABLE `personal_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=> task is not done, 1=>Task done',
  `share_status` int(11) NOT NULL COMMENT '0=> note is not share, 1=>shared',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_notes`
--

INSERT INTO `personal_notes` (`id`, `user_id`, `title`, `description`, `status`, `share_status`, `created_at`, `updated_at`) VALUES
(6, 2, 'Demo to be given tomorrow', 'Demo to be given tomorrowDemo to be given tomorrowDemo to be given tomorrowDemo to be given tomorrowDemo to be given tomorrow', 0, 0, '2025-04-01 07:06:39', '2025-04-01 07:06:39'),
(7, 2, 'Voluptas qui volupta', 'Et dolorem voluptate', 0, 0, '2025-04-16 04:53:26', '2025-04-16 04:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `name` varchar(255) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `computer_number` varchar(255) DEFAULT NULL,
  `receipt_status` varchar(255) DEFAULT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `ocr_text` text DEFAULT NULL,
  `dairy_date` varchar(255) DEFAULT NULL,
  `form_of_communication` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `receved_date` varchar(255) DEFAULT NULL,
  `letter_date` varchar(255) DEFAULT NULL,
  `letter_ref_no` varchar(255) DEFAULT NULL,
  `delivery_mode` varchar(255) DEFAULT NULL,
  `mode_number` varchar(255) DEFAULT NULL,
  `sender_type` varchar(255) DEFAULT NULL,
  `vip` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ministry_department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `organitation` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modifyby` int(11) DEFAULT NULL,
  `deletedby` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `computer_number`, `receipt_status`, `receipt_file`, `ocr_text`, `dairy_date`, `form_of_communication`, `language`, `receved_date`, `letter_date`, `letter_ref_no`, `delivery_mode`, `mode_number`, `sender_type`, `vip`, `name`, `ministry_department`, `designation`, `organitation`, `email`, `address`, `pin_code`, `phone_number`, `country`, `state`, `city`, `category`, `subcategory`, `subject`, `remarks`, `createdBy`, `modifyby`, `deletedby`, `created_at`, `updated_at`) VALUES
(5, '1007', 'Electronics', '1749552686_WhatsApp.pdf', 'Download WhatsApp for Windows\nMake calls, share your screen and get a faster experience when you\ndownload the Windows app.\nteps to log in\nLog in with phone numbe\nDon\'t have a WhatsApp account?Get started\nYour personal messages are end-to-end encrypted\nStay logged in on this browser\nDownload\nOpen WhatsApp  on your phone\nOn Android tap Menu  · On iPhone tap Settings   \nTap Linked devices, then Link device\nScan the QR code to confirm\n04/06/2025, 00:50	WhatsApp\nhttps://web.whatsapp.com	1/1', '2025-06-10', '3', 'Odia', '2013-03-20', '2007-11-16', 'DAK-1749552677-5919', '1', '151', '1', '1', 'Medge Rutledge', '2', 'Cumque sit dolores', 'Hayes English Co', 'dyfuj@mailinator.com', 'Molestiae eum et sed', 'Ut in eum unde conse', '+1 (222) 897-6445', '165', '32', 'Vitae enim dolore do', '1', '1', 'Incididunt distincti', 'Et sunt officia iur', 2, NULL, NULL, '2025-06-10 05:21:26', '2025-06-10 05:21:26'),
(6, '1008', 'Physical', NULL, NULL, '2025-06-11', '1', 'Odia', '1992-11-08', '2008-09-14', 'DAK-1749556324-8491', '2', '645', '3', '1', 'deb', '2', 'Beatae qui voluptatu', 'Dillon Slater Traders', 'qane@mailinator.com', 'Sapiente optio qui', 'Occaecat aut amet q', '+1 (656) 384-1659', '165', '22', 'Ad iste omnis quibus', '1', '1', 'Facilis rem architec', 'Possimus pariatur', 2, 2, NULL, '2025-06-10 06:22:10', '2025-06-11 01:30:08'),
(7, '1010', 'Electronics', '1750139999_WhatsApp.pdf', 'Download WhatsApp for Windows\nMake calls, share your screen and get a faster experience when you\ndownload the Windows app.\nteps to log in\nLog in with phone numbe\nDon\'t have a WhatsApp account?Get started\nYour personal messages are end-to-end encrypted\nStay logged in on this browser\nDownload\nOpen WhatsApp  on your phone\nOn Android tap Menu  · On iPhone tap Settings   \nTap Linked devices, then Link device\nScan the QR code to confirm\n04/06/2025, 00:50	WhatsApp\nhttps://web.whatsapp.com	1/1', '2025-06-12', '4', 'English', '1990-12-25', '1987-07-23', 'DAK-1749720049-1627', '1', '507', '2', '1', 'Hadley Foley', '2', 'Est ut et harum exce', 'Gould and Mcmahon Inc', 'nyfe@mailinator.com', 'Nobis et eveniet es', 'Sint non consectetu', '+1 (663) 293-6583', '165', '16', 'Dolorem enim quaerat', '1', '1', 'Eiusmod aut ut vel e hjbdvjkd n djnvjdfnvdfljvbn df vfkjnv mdfkv f  jdfnvdfkjv dfv fk', 'Sit modi assumenda', 2, 2, NULL, '2025-06-12 03:51:01', '2025-06-17 00:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `receiptshares`
--

CREATE TABLE `receiptshares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receipt_id` varchar(255) DEFAULT NULL,
  `sender_id` varchar(255) DEFAULT NULL,
  `department_id` varchar(255) DEFAULT NULL,
  `section_id` varchar(255) DEFAULT NULL,
  `recever_id` varchar(255) DEFAULT NULL,
  `share_type` enum('To','Cc') DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `is_pulled_back` tinyint(1) NOT NULL DEFAULT 0,
  `pull_back_remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `send_back` int(11) DEFAULT 0 COMMENT '1=>Send Back,2=>Normal Share'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receiptshares`
--

INSERT INTO `receiptshares` (`id`, `receipt_id`, `sender_id`, `department_id`, `section_id`, `recever_id`, `share_type`, `remark`, `due_date`, `action`, `priority`, `is_read`, `read_at`, `is_pulled_back`, `pull_back_remark`, `created_at`, `updated_at`, `send_back`) VALUES
(16, '5', '2', NULL, NULL, '11', 'To', 'hello', '2025-06-10', 'Please CAll', 2, 1, NULL, 0, NULL, '2025-06-10 05:36:25', '2025-06-10 05:37:10', 0),
(17, '5', '2', NULL, NULL, '3', 'Cc', 'hello', '2025-06-10', 'Please CAll', 2, 1, NULL, 1, 'mistak', '2025-06-10 05:36:25', '2025-06-10 05:42:15', 0),
(18, '5', '2', NULL, NULL, '1', 'To', 'gbdfnhg', '2025-06-10', 'Please Discuss', 2, 0, NULL, 1, 'fghbfgmjh', '2025-06-10 05:38:04', '2025-06-10 05:38:49', 0),
(19, '5', '2', NULL, NULL, '4', 'To', 'bsgnjuy,', '2025-06-10', 'Please Discuss', 1, 0, NULL, 1, 'dbfgbngb', '2025-06-10 05:39:19', '2025-06-10 05:39:35', 0),
(20, '5', '2', NULL, NULL, '3', 'To', 'dgrhrg', '2025-06-10', 'Please Examine', 2, 0, NULL, 1, 'dvfrgb', '2025-06-10 05:40:31', '2025-06-10 05:40:39', 0),
(21, '5', '2', NULL, NULL, '3', 'To', 'dvfsrn', '2025-06-10', 'Please Discuss', 2, 0, NULL, 1, 'hfgjnh', '2025-06-10 05:42:01', '2025-06-10 05:44:32', 0),
(22, '5', '2', NULL, NULL, '3', 'To', 'ghghj', '2025-06-10', 'Please Examine', 2, 1, '2025-06-10 06:06:54', 0, NULL, '2025-06-10 05:44:56', '2025-06-10 06:06:54', 0),
(23, '7', '2', NULL, NULL, '11', 'To', '456511', '2025-06-12', 'Please Examine Putup', 3, 0, NULL, 1, '51616515', '2025-06-12 05:02:46', '2025-06-12 05:03:14', 0),
(24, '7', '2', NULL, NULL, '3', 'To', 'Architecto quam impedit aut qui in blanditiis nihil unde veritatis adipisci esse nulla ut molestias nostrum et', '1991-05-01', 'Please Discuss', 2, 0, NULL, 1, '25252', '2025-06-12 05:04:09', '2025-06-12 05:04:22', 0),
(25, '7', '2', NULL, NULL, '4', 'To', '4121', '2025-06-12', 'Please Discuss', 2, 0, NULL, 1, 'njnj', '2025-06-12 05:04:49', '2025-06-12 05:05:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_folders`
--

CREATE TABLE `receipt_folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(2, 'user', 'web', '2024-05-08 04:54:08', '2024-05-08 04:54:08'),
(4, 'dairy', 'web', '2024-07-17 23:52:46', '2024-07-17 23:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(53, 2),
(53, 4),
(54, 2),
(54, 4),
(55, 2),
(55, 4),
(56, 2),
(56, 4),
(57, 2),
(57, 4),
(58, 2),
(58, 4),
(59, 2),
(59, 4),
(60, 2),
(60, 4),
(61, 2),
(61, 4),
(62, 2),
(62, 4),
(63, 2),
(63, 4),
(64, 2),
(64, 4),
(65, 2),
(65, 4),
(66, 2),
(66, 4),
(67, 2),
(67, 4),
(68, 2),
(68, 4),
(69, 2),
(69, 4),
(70, 2),
(70, 4),
(71, 2),
(71, 4),
(72, 2),
(72, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Account Executive', '1', '2024-08-12 23:49:50', '2024-08-12 23:49:50'),
(2, 'Section Officer', '1', '2024-08-12 23:50:26', '2024-08-12 23:50:26'),
(3, 'Prosecution Section', '2', '2024-09-24 00:49:08', '2024-09-24 00:49:08'),
(4, 'Protocol & Reservation Section', '3', '2024-09-24 00:49:20', '2024-09-24 00:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `sendertypes`
--

CREATE TABLE `sendertypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sendertype` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sendertypes`
--

INSERT INTO `sendertypes` (`id`, `sendertype`, `created_at`, `updated_at`) VALUES
(1, 'Private', '2024-08-12 23:51:41', '2024-08-12 23:51:41'),
(2, 'Public', '2024-08-12 23:51:48', '2024-08-12 23:51:48'),
(3, 'Other Department', '2024-08-12 23:51:58', '2024-08-12 23:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'MMHAPU', 1, NULL, NULL),
(2, 'dark_logo', 'C:\\xampp\\tmp\\phpE6A.tmp', 1, NULL, NULL),
(6, 'light_logo', 'C:\\xampp\\tmp\\php6EE5.tmp', 1, NULL, NULL),
(8, 'favicon', 'C:\\xampp\\tmp\\php6EF6.tmp', 1, NULL, NULL),
(11, 'x', '115', 1, NULL, NULL),
(12, 'y', '47', 1, NULL, NULL),
(26, 'authentication', 'deactivate', 1, '2024-10-23 00:21:18', '2024-10-23 00:21:18'),
(27, 'timezone', '', 1, '2024-10-23 00:21:18', '2024-10-23 00:21:18'),
(28, 'site_date_format', 'd-m-Y', 1, '2024-10-23 00:21:18', '2024-10-23 00:21:18'),
(29, 'default_language', 'en', 1, '2024-10-23 00:21:18', '2024-10-23 00:21:18'),
(30, 'dark_mode', '', 1, '2024-10-23 00:21:18', '2024-10-23 00:21:18'),
(31, 'color', '', 1, '2024-10-23 00:21:18', '2024-10-23 00:21:18'),
(109, 'facebook_url', 'https://www.facebook.com/llbean', 1, NULL, NULL),
(110, 'linkedin_url', 'https://www.linkedin.com/in/jyotiranjan-sahoo-j7609942076/', 1, NULL, NULL),
(111, 'twitter_url', 'MMHAPU', 1, NULL, NULL),
(142, 'organization_name', 'MAULANA MAZHARUL HAQUE ARABIC & PERSIAN UNIVERSITY', 1, NULL, NULL),
(143, 'authority', 'A State University established by an Act of Bihar State Universities', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(255) DEFAULT NULL,
  `senderId` int(255) NOT NULL,
  `department_id` int(255) NOT NULL,
  `section_id` int(11) NOT NULL,
  `priority` varchar(250) DEFAULT NULL,
  `duedate` varchar(250) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `receverid` int(11) NOT NULL,
  `modifiedBy` varchar(255) NOT NULL,
  `deletedBy` varchar(255) NOT NULL,
  `deleted_at` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `sharetype` varchar(225) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `revert_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'ANDHRA PRADESH', 105),
(2, 'ASSAM', 105),
(3, 'ARUNACHAL PRADESH', 105),
(4, 'BIHAR', 105),
(5, 'GUJRAT', 105),
(6, 'HARYANA', 105),
(7, 'HIMACHAL PRADESH', 105),
(8, 'JAMMU & KASHMIR', 105),
(9, 'KARNATAKA', 105),
(10, 'KERALA', 105),
(11, 'MADHYA PRADESH', 105),
(12, 'MAHARASHTRA', 105),
(13, 'MANIPUR', 105),
(14, 'MEGHALAYA', 105),
(15, 'MIZORAM', 105),
(16, 'NAGALAND', 105),
(17, 'ORISSA', 105),
(18, 'PUNJAB', 105),
(19, 'RAJASTHAN', 105),
(20, 'SIKKIM', 105),
(21, 'TAMIL NADU', 105),
(22, 'TRIPURA', 105),
(23, 'UTTAR PRADESH', 105),
(24, 'WEST BENGAL', 105),
(25, 'DELHI', 105),
(26, 'GOA', 105),
(27, 'PONDICHERY', 105),
(28, 'LAKSHDWEEP', 105),
(29, 'DAMAN & DIU', 105),
(30, 'DADRA & NAGAR', 105),
(31, 'CHANDIGARH', 105),
(32, 'ANDAMAN & NICOBAR', 105),
(33, 'UTTARAKHAND', 105),
(34, 'JHARKHAND', 105),
(35, 'CHHATTISGARH', 105),
(37, 'Telangana', 105);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Purchase Order', NULL, '1', '2024-08-12 23:49:23', '2024-08-12 23:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `category_id`, `subcategory_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Purchase Order Letter', 'D', '2024-08-12 23:56:22', '2024-08-12 23:56:22'),
(2, 1, 1, 'tyty', 'tytyrtyryt', '2024-08-14 02:06:44', '2024-08-14 02:06:44'),
(3, 1, 1, 'retrt', 'rtrtrtrtrt', '2024-08-14 03:54:39', '2024-08-14 03:54:39'),
(4, 1, 1, 'yuyuyuyu', 'abcd', '2024-08-14 03:56:00', '2024-08-14 03:56:00'),
(5, 1, 1, 'oio', 'azews&nbsp; &nbsp; &nbsp;&nbsp;', '2024-08-14 04:03:45', '2024-08-14 04:03:45'),
(6, 1, 1, 'ff', 'frtgrfygryg', '2024-08-14 04:05:12', '2024-08-14 04:05:12'),
(7, 1, 1, 'erffgtrtg', 'tytryrtytytytyty', '2024-08-14 04:11:54', '2024-08-14 04:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `t_o_d_o_lists`
--

CREATE TABLE `t_o_d_o_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=> task is not done, 1=>Task done',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_o_d_o_lists`
--

INSERT INTO `t_o_d_o_lists` (`id`, `user_id`, `title`, `description`, `date`, `status`, `created_at`, `updated_at`) VALUES
(8, 2, 'Send file to Accounts', 'Testing the update', '2024-03-09 14:11:00', 1, '2024-09-12 01:26:20', '2024-09-18 04:32:56'),
(10, 2, 'Et dolorem aliquam t', 'Asperiores ut est qu', '1992-04-17 20:45:00', 1, '2024-09-24 23:36:23', '2024-11-02 07:40:29'),
(12, 2, 'E office Demo', 'E office demo to client', '2025-04-02 10:23:00', 1, '2025-04-01 04:52:19', '2025-04-01 04:52:24'),
(13, 2, 'Demo To be given Tomorrow', 'Demo To be given TomorrowDemo To be given TomorrowDemo To be given TomorrowDemo To be given Tomorrow', '2025-04-02 12:36:00', 1, '2025-04-01 07:06:01', '2025-04-01 07:07:18'),
(14, 2, 'Est ut fuga Ratione', 'Ex magna non ex modi', '2002-02-07 06:11:00', 1, '2025-04-16 04:53:43', '2025-04-16 04:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=>offline,1=>online,2=>busy,3=>tea break,4=>lunch break'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `department_id`, `section_id`, `email_verified_at`, `password`, `type`, `lang`, `created_by`, `avatar`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Super Admin', 'admin@example.com', '9874521458', 2, 3, NULL, '$2y$10$Q/6FZZfDBEyClvU3uWQoFeKszCWC0W8CaSMISQiMPz6fKsMJ2.4DK', 'admin', 'en', 0, 'avatar-2.jpg', NULL, '2024-05-08 04:54:09', '2025-04-01 06:40:18', 1),
(2, 'Jyotiranjan Sahoo', 'jyotiranjan@gmail.com', '7858965421', 2, 3, NULL, '$2y$10$Q/6FZZfDBEyClvU3uWQoFeKszCWC0W8CaSMISQiMPz6fKsMJ2.4DK', 'admin', 'en', 1, 'rb_63011_1732082701.png', NULL, '2024-07-08 01:43:57', '2025-04-19 04:30:52', 1),
(3, 'Uttam kumar mohanta', 'uttamkumarmohanta43@gmail.com', '4785478547', 1, 1, NULL, '$2y$10$Q/6FZZfDBEyClvU3uWQoFeKszCWC0W8CaSMISQiMPz6fKsMJ2.4DK', 'user', 'en', 1, 'avatar-3.jpg', NULL, '2024-07-08 02:55:54', '2025-06-10 03:49:43', 1),
(4, 'Narayan Narayan', 'narayan@gmail.com', '9874512456', 2, 3, NULL, '$2y$10$7SaorZHlOf96CkGfmnWLgeLI.qdnDd7jdJsrUMalDFoM6PcOXuYG2', 'user', '', 1, 'avatar-4.jpg', NULL, '2024-09-24 00:50:06', '2024-09-24 00:50:06', 0),
(5, 'Satyam Rotray', 'satyam@gmail.com', '9875410254', 2, 3, NULL, '$2y$10$3cWhTBDXihaeD2t4lBGW0.cuOWY69fl06WSFitQAGf7etwIyp6sA2', 'user', '', 1, 'avatar-5.jpg', NULL, '2024-09-24 00:50:56', '2025-04-01 07:25:34', 1),
(9, 'Ashiqur Rahman', 'ashiqur@gmail.com', '8547963254', 2, 3, NULL, '$2y$10$8DDThur0mfrPJJkWQ0U80eCjvuQE8LLefcW7D5JYBTMWaVUiv9Y3K', 'user', '', 1, 'michael-dam-mEZ3PoFGs_k-unsplash.jpg', NULL, '2024-10-25 10:56:00', '2024-10-25 10:56:00', 0),
(10, 'J sahoo', 'jj@gmail.com', '9878675676', 3, 4, NULL, '$2y$10$pVd61ksTEStT/xrBExjg4e72nsB19pIVahSuhT4v0.K.RLr10fNam', 'user', '', 1, 'Screenshot (6).png', NULL, '2024-12-02 11:08:22', '2024-12-02 11:08:22', 0),
(11, 'Sk Gulzar', 'skkahinoor23@gmail.com', '7854870443', 2, 3, NULL, '$2y$10$XdlYiEDCTR5WDh84mydXNOoACfTGB7nUIAtOZqFlQAmiMdCu66wce', 'admin', 'en', 1, NULL, NULL, NULL, '2025-04-22 23:45:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vips`
--

CREATE TABLE `vips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vips`
--

INSERT INTO `vips` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Governor Office', '2024-08-12 23:51:32', '2024-08-12 23:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `yellownotes`
--

CREATE TABLE `yellownotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yellownotes`
--

INSERT INTO `yellownotes` (`id`, `file_id`, `description`, `createdBy`, `modifyBy`, `deletedBy`, `created_at`, `updated_at`) VALUES
(1, 13, '<p>gthgtghth</p>', 2, NULL, NULL, '2025-06-11 05:59:36', '2025-06-11 05:59:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communications`
--
ALTER TABLE `communications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_details_email_unique` (`email`),
  ADD KEY `contact_details_ministry_department_foreign` (`ministry_department`);

--
-- Indexes for table `correspondences`
--
ALTER TABLE `correspondences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverymodes`
--
ALTER TABLE `deliverymodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileshares`
--
ALTER TABLE `fileshares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_securities`
--
ALTER TABLE `login_securities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ministries`
--
ALTER TABLE `ministries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `moduals`
--
ALTER TABLE `moduals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movements_receipt_id_foreign` (`receipt_id`),
  ADD KEY `movements_from_user_id_foreign` (`from_user_id`),
  ADD KEY `movements_to_user_id_foreign` (`to_user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_user_id_foreign` (`user_id`);

--
-- Indexes for table `notice_documents`
--
ALTER TABLE `notice_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_documents_notice_id_foreign` (`notice_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_notes`
--
ALTER TABLE `personal_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiptshares`
--
ALTER TABLE `receiptshares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_folders`
--
ALTER TABLE `receipt_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_folders_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sendertypes`
--
ALTER TABLE `sendertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_created_by_unique` (`name`,`created_by`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_o_d_o_lists`
--
ALTER TABLE `t_o_d_o_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_o_d_o_lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vips`
--
ALTER TABLE `vips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yellownotes`
--
ALTER TABLE `yellownotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `communications`
--
ALTER TABLE `communications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `correspondences`
--
ALTER TABLE `correspondences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `deliverymodes`
--
ALTER TABLE `deliverymodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fileshares`
--
ALTER TABLE `fileshares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login_securities`
--
ALTER TABLE `login_securities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `ministries`
--
ALTER TABLE `ministries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `moduals`
--
ALTER TABLE `moduals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `movements`
--
ALTER TABLE `movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notice_documents`
--
ALTER TABLE `notice_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `personal_notes`
--
ALTER TABLE `personal_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receiptshares`
--
ALTER TABLE `receiptshares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `receipt_folders`
--
ALTER TABLE `receipt_folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sendertypes`
--
ALTER TABLE `sendertypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_o_d_o_lists`
--
ALTER TABLE `t_o_d_o_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vips`
--
ALTER TABLE `vips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `yellownotes`
--
ALTER TABLE `yellownotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_ministry_department_foreign` FOREIGN KEY (`ministry_department`) REFERENCES `ministries` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `movements`
--
ALTER TABLE `movements`
  ADD CONSTRAINT `movements_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `movements_receipt_id_foreign` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movements_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notice_documents`
--
ALTER TABLE `notice_documents`
  ADD CONSTRAINT `notice_documents_notice_id_foreign` FOREIGN KEY (`notice_id`) REFERENCES `notices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_notes`
--
ALTER TABLE `personal_notes`
  ADD CONSTRAINT `personal_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receipt_folders`
--
ALTER TABLE `receipt_folders`
  ADD CONSTRAINT `receipt_folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `t_o_d_o_lists`
--
ALTER TABLE `t_o_d_o_lists`
  ADD CONSTRAINT `t_o_d_o_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
