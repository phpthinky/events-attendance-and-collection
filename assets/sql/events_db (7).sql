-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 08:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Public', 'Public Access Group'),
(3, 'Default', 'Default Access Group');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(404, '::1', '2024-01-03 01:28:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_perm_to_user`
--

INSERT INTO `aauth_perm_to_user` (`perm_id`, `user_id`) VALUES
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`) VALUES
(1, 'admin@gmail.com', 'ec225039f1cb0c48ad528709e8e0184991e637d96db175f094b6b2037ec1a3c2', 'Admin', 0, '2024-02-17 14:46:27', '2024-02-17 14:46:27', NULL, NULL, NULL, NULL, NULL, NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_settings`
--

CREATE TABLE `collection_settings` (
  `id` int(11) NOT NULL,
  `late_penalty` float NOT NULL,
  `absent_penalty` float NOT NULL,
  `late_penalty_minutes` int(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collection_settings`
--

INSERT INTO `collection_settings` (`id`, `late_penalty`, `absent_penalty`, `late_penalty_minutes`, `status`) VALUES
(2, 25, 100, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `course_sub_title` varchar(25) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_title`, `description`, `course_sub_title`, `logo`, `status`) VALUES
(1, 'Bachelor of Science in Criminology', '', 'BSCRIM', 'http://localhost/events/assets/img/user.png', 1),
(2, 'Bachelor of Science in Information Technology', '', 'BSIT', 'http://localhost/events/assets/img/user.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_students`
--

CREATE TABLE `course_students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `grade` int(1) NOT NULL,
  `section` varchar(1) NOT NULL,
  `semester` int(11) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course_students`
--

INSERT INTO `course_students` (`id`, `student_id`, `course_id`, `year`, `grade`, `section`, `semester`, `status`, `year_id`) VALUES
(1, 'ID202400001', 1, '2', 1, 'A', 2, 1, 1),
(2, 'ID202400002', 1, '1', 1, 'A', 2, 1, 1),
(3, 'ID202400003', 1, '', 2, 'B', 2, 1, 1),
(4, 'ID202400004', 2, '', 2, 'B', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(250) NOT NULL,
  `event_startdate` date NOT NULL,
  `event_enddate` date NOT NULL,
  `no_days` int(11) NOT NULL,
  `late` float NOT NULL,
  `absent` float NOT NULL,
  `amount` float NOT NULL,
  `status` int(1) NOT NULL,
  `date_completed` timestamp NULL DEFAULT NULL,
  `morning_timein` time DEFAULT NULL,
  `morning_timeout` time DEFAULT NULL,
  `afternoon_timein` time DEFAULT NULL,
  `afternoon_timeout` time DEFAULT NULL,
  `attendees_course` varchar(150) NOT NULL,
  `attendees_year` varchar(50) NOT NULL,
  `semester` int(1) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_startdate`, `event_enddate`, `no_days`, `late`, `absent`, `amount`, `status`, `date_completed`, `morning_timein`, `morning_timeout`, `afternoon_timein`, `afternoon_timeout`, `attendees_course`, `attendees_year`, `semester`, `year_id`) VALUES
(1, 'Fiesta', '2024-01-30', '2024-01-30', 1, 25, 100, 0, 2, '2024-01-30 05:54:46', '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 2, 1),
(2, 'Fiesta 2', '2024-01-31', '2024-01-31', 1, 25, 100, 0, 2, '2024-01-30 06:33:04', '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 2, 1),
(3, 'Sam sam', '2024-01-30', '2024-01-30', 1, 25, 100, 0, 2, '2024-01-30 06:40:30', '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 2, 1),
(4, 'Luya', '2024-01-31', '2024-01-31', 1, 25, 100, 0, 2, '2024-01-31 06:30:36', '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 2, 1),
(5, 'BSIT LANG', '2024-02-01', '2024-02-01', 1, 25, 100, 0, 2, '2024-01-31 17:45:46', '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[2]', '[1,2]', 2, 1),
(6, 'fsdfsdf', '2024-02-02', '2024-02-02', 1, 25, 100, 0, 0, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1,2]', '[1,2]', 2, 1),
(7, 'sample lang', '2024-02-17', '2024-02-17', 1, 25, 100, 0, 1, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 2, 1),
(8, 'sample lang', '2024-02-20', '2024-02-20', 2, 25, 100, 0, 0, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events_absent`
--

CREATE TABLE `events_absent` (
  `absent_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `penalty` int(11) NOT NULL,
  `date_of_event` date NOT NULL,
  `payment_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events_absent`
--

INSERT INTO `events_absent` (`absent_id`, `event_id`, `student_id`, `penalty`, `date_of_event`, `payment_status`) VALUES
(1, 3, 'ID202400001', 100, '2024-01-30', 1),
(2, 4, 'ID202400001', 100, '2024-01-31', 1),
(3, 4, 'ID202400002', 100, '2024-01-31', 0),
(4, 5, 'ID202400004', 100, '2024-02-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events_attendance`
--

CREATE TABLE `events_attendance` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `penalty_late` int(1) NOT NULL DEFAULT 0,
  `penalty_absent` int(1) NOT NULL DEFAULT 0,
  `date_of_event` date NOT NULL,
  `timein` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL,
  `event_day` int(2) NOT NULL,
  `time_in_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events_collection`
--

CREATE TABLE `events_collection` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `amount_pay` float NOT NULL,
  `penalty_late` float NOT NULL,
  `penalty_absent` float NOT NULL,
  `year` int(11) NOT NULL,
  `date_of_payment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `semester` int(1) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events_collection`
--

INSERT INTO `events_collection` (`id`, `event_id`, `student_id`, `amount_pay`, `penalty_late`, `penalty_absent`, `year`, `date_of_payment`, `semester`, `year_id`) VALUES
(2, 3, 'ID202400001', 100, 0, 100, 0, '2024-01-31 02:43:42', 2, 1),
(3, 3, 'ID202400001', 25, 25, 0, 0, '2024-01-31 02:43:42', 1, 1),
(4, 4, 'ID202400001', 100, 0, 100, 0, '2024-01-31 17:43:29', 2, 1),
(5, 5, 'ID202400004', 100, 0, 100, 0, '2024-01-31 17:46:23', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events_late`
--

CREATE TABLE `events_late` (
  `late_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `penalty` int(11) NOT NULL,
  `date_of_event` date NOT NULL,
  `payment_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate_review`
--

CREATE TABLE `rate_review` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate_review`
--

INSERT INTO `rate_review` (`id`, `user_id`, `package_id`, `rate`, `review`, `date_created`) VALUES
(3, 5, 8, 5, '<p>Sample</p>', '2021-06-19 11:53:16'),
(4, 5, 8, 3, '&lt;p&gt;Sample feedback only&lt;/p&gt;', '2021-06-19 13:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `settings_schoolyear`
--

CREATE TABLE `settings_schoolyear` (
  `id` int(11) NOT NULL,
  `start_year` varchar(20) NOT NULL,
  `end_year` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `settings_schoolyear`
--

INSERT INTO `settings_schoolyear` (`id`, `start_year`, `end_year`, `status`, `is_deleted`) VALUES
(1, '2024-01-01', '2024-05-25', 1, NULL),
(2, '2024-01-01', '2024-03-01', 2, NULL),
(3, '2024-02-09', '2024-03-22', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings_semester`
--

CREATE TABLE `settings_semester` (
  `current_semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `settings_semester`
--

INSERT INTO `settings_semester` (`current_semester`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `mName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `ext` varchar(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `profile_photo` varchar(250) NOT NULL,
  `code` varchar(25) NOT NULL,
  `dateAdded` varchar(20) NOT NULL,
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp(),
  `keywords` varchar(255) NOT NULL,
  `keywords_2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fName`, `mName`, `lName`, `ext`, `gender`, `contact_no`, `address1`, `profile_photo`, `code`, `dateAdded`, `dateUpdated`, `keywords`, `keywords_2`) VALUES
(1, 'Harold', '', 'ADVINCULA', '', '', '09261461680', 'malisbong lang', '', 'ID202400001', '', '2024-01-30 05:52:46', '', ''),
(2, 'XIAN', '', 'Lang', '', '', '09094571235', 'Malisbong, Sablayan, Occidental Mindoro', '', 'ID202400002', '', '2024-01-30 05:54:35', '', ''),
(3, 'test', 'k', 'lang', '', '', '09094573650', 'Malisbong, Sablayan, Occidental Mindoro', '', 'ID202400003', '', '2024-01-31 08:06:49', '', ''),
(4, 'Luz', 'M', 'Mo', '', '', '09094571235', 'Bugros, Sablayan, Occidental Mindoro', '', 'ID202400004', '', '2024-01-31 17:45:01', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students_enrolled`
--

CREATE TABLE `students_enrolled` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Sablayan Tourism'),
(6, 'short_name', 'MyTourGuide'),
(11, 'logo', 'uploads/1623978900_masskara.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1624082100_The_Ruins_in_Talisay,_Negros_Occidental_at_Dusk.jpg'),
(15, 'about_us', '<h1 class=\"mb-3\">We Provide Best Tour Packages In Your Budget</h1>\r\n                        <p>Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo</p>'),
(16, 'about_us_cover', 'http://www.sablayantourism.com/templates/travel_home/img/about.jpg'),
(18, 'about_us_thumbs', 'http://www.sablayantourism.com/templates/travel_home/img/about-1.jpg'),
(19, 'about_us_thumbs', 'http://www.sablayantourism.com/templates/travel_home/img/about-2.jpg');

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Structure for view `v_bayad`
--
DROP TABLE IF EXISTS `v_bayad`;

CREATE  VIEW `v_bayad`  AS SELECT `events_collection`.`student_id` AS `student_id`, sum(`events_collection`.`amount_pay`) AS `total_na_bayad` FROM `events_collection` GROUP BY `events_collection`.`student_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_bayad_by_course`
--
DROP TABLE IF EXISTS `v_bayad_by_course`;

CREATE  VIEW `v_bayad_by_course`  AS SELECT `events_collection`.`student_id` AS `student_id`, `course_students`.`course_id` AS `course_id`, `events_collection`.`year_id` AS `year_id`, `events_collection`.`semester` AS `semester`, sum(`events_collection`.`amount_pay`) AS `total_payment` FROM (`events_collection` join `course_students` on(`course_students`.`student_id` = `events_collection`.`student_id`)) GROUP BY `events_collection`.`student_id`, `events_collection`.`year_id`, `events_collection`.`semester` ;

-- --------------------------------------------------------

--
-- Structure for view `v_penalty_late`
--
DROP TABLE IF EXISTS `v_penalty_late`;

CREATE  VIEW `v_penalty_late`  AS SELECT `students`.`code` AS `student_id`, (select `events_attendance`.`event_id` from `events_attendance` where `events_attendance`.`student_id` = `students`.`code` limit 1) AS `event_id`, (select `events_attendance`.`penalty_late` * `events`.`late` from (`events_attendance` join `events` on(`events`.`id` = `events_attendance`.`event_id`)) where `events_attendance`.`student_id` = `students`.`code` limit 1) AS `late_fee` FROM `students` ;

-- --------------------------------------------------------

--
-- Structure for view `v_penalty_total`
--
DROP TABLE IF EXISTS `v_penalty_total`;

CREATE  VIEW `v_penalty_total`  AS SELECT `course_students`.`id` AS `id`, `course_students`.`student_id` AS `student_id`, `course_students`.`course_id` AS `course_id`, `course_students`.`year` AS `year`, `course_students`.`grade` AS `grade`, `course_students`.`section` AS `section`, `course_students`.`semester` AS `semester`, `course_students`.`status` AS `status`, `events_late`.`penalty` AS `late`, `events_absent`.`penalty` AS `absent` FROM ((`course_students` left join `events_late` on(`events_late`.`student_id` = `course_students`.`student_id`)) left join `events_absent` on(`events_absent`.`student_id` = `course_students`.`student_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `collection_settings`
--
ALTER TABLE `collection_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_students`
--
ALTER TABLE `course_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_absent`
--
ALTER TABLE `events_absent`
  ADD PRIMARY KEY (`absent_id`);

--
-- Indexes for table `events_attendance`
--
ALTER TABLE `events_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_collection`
--
ALTER TABLE `events_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_late`
--
ALTER TABLE `events_late`
  ADD PRIMARY KEY (`late_id`);

--
-- Indexes for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_schoolyear`
--
ALTER TABLE `settings_schoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_enrolled`
--
ALTER TABLE `students_enrolled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_settings`
--
ALTER TABLE `collection_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_students`
--
ALTER TABLE `course_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events_absent`
--
ALTER TABLE `events_absent`
  MODIFY `absent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events_attendance`
--
ALTER TABLE `events_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events_collection`
--
ALTER TABLE `events_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events_late`
--
ALTER TABLE `events_late`
  MODIFY `late_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings_schoolyear`
--
ALTER TABLE `settings_schoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_enrolled`
--
ALTER TABLE `students_enrolled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
