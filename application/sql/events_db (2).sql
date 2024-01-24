-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 09:16 AM
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
-- Table structure for table `aaddress`
--

CREATE TABLE `aaddress` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(1) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aaddress`
--

INSERT INTO `aaddress` (`id`, `title`, `name`, `type`, `parent_id`) VALUES
(1, 'barangay', 'Ligaya', 1, 2),
(2, 'municipality', 'Sablayan', 2, 3),
(3, 'province', 'Occidental Mindoro', 3, NULL),
(4, 'barangay', 'Burgos', 1, 2);

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
(1, 'admin@gmail.com', '5711aa2253ac62088bf34f79f8ccd82e41bdbcf32e7670772d2a1e1746a9be9b', 'Admin', 0, '2024-01-16 18:45:54', '2024-01-16 18:45:54', NULL, NULL, NULL, NULL, NULL, NULL, '::1'),
(5, 'mark@fakemail.com', '28a9d1ac311fc87b88b094cd50b05abf517134b03d636bbc7ee94401f9952a21', 'mark', 0, '2024-01-16 18:48:03', '2024-01-16 18:48:03', '2024-01-16 18:47:51', NULL, NULL, NULL, NULL, NULL, '::1');

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
(1, 3),
(5, 3);

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
(1, 'Bachelor of Science in Information Technology', '', 'BSIT', '', 1),
(2, 'Bachelor of Science in Criminology', '', 'BSCRIM', 'http://localhost/events/assets/img/logo-65a1db334d15d.png', 1);

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
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course_students`
--

INSERT INTO `course_students` (`id`, `student_id`, `course_id`, `year`, `grade`, `section`, `semester`, `status`) VALUES
(1, 'ID202400001', 1, '1', 4, 'A', 1, 1),
(2, 'ID202400002', 2, '1', 1, 'A', 1, 1),
(3, 'ID202400003', 2, '1', 1, 'A', 1, 1),
(4, 'ID202400004', 2, '1', 1, 'A', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(250) NOT NULL,
  `event_startdate` date NOT NULL,
  `event_enddate` date NOT NULL,
  `event_timestart` time NOT NULL,
  `event_timeend` time NOT NULL,
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
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_startdate`, `event_enddate`, `event_timestart`, `event_timeend`, `no_days`, `late`, `absent`, `amount`, `status`, `date_completed`, `morning_timein`, `morning_timeout`, `afternoon_timein`, `afternoon_timeout`, `attendees_course`, `attendees_year`, `semester`) VALUES
(1, 'helo', '2024-01-15', '2024-01-15', '00:00:00', '00:00:00', 0, 50, 200, 0, 3, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1,2]', '[1,2,3]', 0),
(2, 'Fiesta', '2024-01-15', '2024-01-15', '00:00:00', '00:00:00', 0, 50, 200, 0, 0, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 0),
(3, 'samo', '2024-01-15', '2024-01-16', '00:00:00', '00:00:00', 0, 25, 100, 0, 2, '2024-01-16 10:48:31', '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[3]', 0),
(4, 'Graduation Balls Eye', '2024-01-17', '2024-01-17', '00:00:00', '00:00:00', 0, 25, 100, 0, 0, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1]', '[1]', 0),
(5, '', '2024-01-16', '2024-01-17', '00:00:00', '00:00:00', 0, 25, 100, 0, 1, NULL, '07:30:00', '11:30:00', '13:30:00', '17:30:00', '[1,2]', '[1]', 0);

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
  `timein` datetime NOT NULL,
  `timeout` datetime NOT NULL,
  `event_day` int(2) NOT NULL,
  `time_in_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events_attendance`
--

INSERT INTO `events_attendance` (`id`, `event_id`, `student_id`, `penalty_late`, `penalty_absent`, `date_of_event`, `timein`, `timeout`, `event_day`, `time_in_type`) VALUES
(1, 3, 'ID202400001', 1, 0, '2024-01-16', '2024-01-16 15:26:41', '0000-00-00 00:00:00', 1, 2),
(2, 3, 'ID202400002', 1, 0, '2024-01-16', '2024-01-16 15:27:37', '0000-00-00 00:00:00', 1, 2),
(3, 5, 'ID202400002', 1, 0, '2024-01-16', '2024-01-16 19:01:20', '0000-00-00 00:00:00', 1, 2),
(4, 5, 'ID202400003', 1, 0, '2024-01-16', '2024-01-16 19:03:48', '0000-00-00 00:00:00', 1, 2),
(5, 5, 'ID202400001', 1, 0, '2024-01-16', '2024-01-16 19:03:58', '0000-00-00 00:00:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `events_collection`
--

CREATE TABLE `events_collection` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount_pay` float NOT NULL,
  `penalty_late` float NOT NULL,
  `penalty_absent` float NOT NULL,
  `year` int(11) NOT NULL,
  `date_of_payment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(30) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `subject`, `message`, `status`, `date_created`) VALUES
(6, 'asdasd', 'asdasd@asdasd.com', 'asdasd', 'asdasd', 1, '2021-06-19 10:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(30) NOT NULL,
  `destination_id` varchar(50) NOT NULL,
  `package` tinytext DEFAULT NULL,
  `cost` double NOT NULL,
  `description` text DEFAULT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `destination_id`, `package`, `cost`, `description`, `upload_path`, `status`, `date_created`) VALUES
(2, '[\"Aruyan Falls\"]', 'Package', 10000, '[\"Tourguide\",\"Service Vehicle\"]', NULL, 1, '2024-01-02 15:29:07'),
(5, '[\"Pandurucan Falls\"]', 'Package', 12000, '[\"Tourguide\"]', NULL, 1, '2024-01-02 15:31:24'),
(6, '[\"Aruyan Falls\",\"Pandurucan Falls\"]', 'Package A', 20000, '[\"Tourguide\",\"Service Vehicle\",\"Food\"]', NULL, 1, '2024-01-02 19:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount_paid` int(11) NOT NULL,
  `amount_to_pay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `fileurl` varchar(250) NOT NULL
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
-- Table structure for table `settings_semester`
--

CREATE TABLE `settings_semester` (
  `current_semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `settings_semester`
--

INSERT INTO `settings_semester` (`current_semester`) VALUES
(1);

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
  `status` int(3) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `keywords_2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fName`, `mName`, `lName`, `ext`, `gender`, `contact_no`, `address1`, `profile_photo`, `code`, `dateAdded`, `dateUpdated`, `status`, `keywords`, `keywords_2`) VALUES
(1, 'Harold', '', 'Malakas', '', '', '09094571235', 'malisbong Sablayan', '', 'ID202400001', '', '2024-01-15 06:07:30', 0, '', ''),
(2, 'Harold', '', 'ADVINCULA', '', '', '09094573654', 'malisbong Sablayan', '', 'ID202400002', '', '2024-01-15 11:23:21', 0, '', ''),
(3, 'Harold ', '', 'ADVINCULA', 'Jr', '', '09094573654', 'malisbong Sablayan', '', 'ID202400003', '', '2024-01-15 11:24:09', 0, '', ''),
(4, 'ZENAIDA', '', 'Malakas', '', '', '09094573654', 'malisbong lang', '', 'ID202400004', '', '2024-01-15 13:04:35', 0, '', '');

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

--
-- Structure for view `v_bayad`
--
DROP TABLE IF EXISTS `v_bayad`;

CREATE VIEW `v_bayad`  AS SELECT `events_collection`.`student_id` AS `student_id`, sum(`events_collection`.`amount_pay`) AS `total_na_bayad` FROM `events_collection` GROUP BY `events_collection`.`student_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_events_course`
--
DROP TABLE IF EXISTS `v_events_course`;

CREATE VIEW `v_events_course`  AS SELECT `course_students`.`id` AS `id`, `course_students`.`student_id` AS `student_id`, `course_students`.`course_id` AS `course_id`, `course_students`.`year` AS `year`, `course_students`.`grade` AS `grade`, `course_students`.`section` AS `section`, `course_students`.`status` AS `status`, `events`.`id` AS `event_id`, `events`.`attendees_course` AS `attendees_course`, `events`.`attendees_year` AS `attendees_year` FROM (`course_students` join `events` on(json_contains(`events`.`attendees_course`,`course_students`.`course_id`))) GROUP BY `course_students`.`student_id`, `events`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_penalty`
--
DROP TABLE IF EXISTS `v_penalty`;

CREATE VIEW `v_penalty`  AS SELECT `students`.`code` AS `student_code`, (select `events_attendance`.`event_id` from `events_attendance` where `events_attendance`.`student_id` = `student_code` limit 1) AS `event_id`, (select `events_attendance`.`penalty_late` * `events`.`late` from (`events_attendance` join `events` on(`events`.`id` = `events_attendance`.`event_id`)) where `events_attendance`.`student_id` = `student_code` limit 1) AS `late_fee` FROM `students` ;

-- --------------------------------------------------------

--
-- Structure for view `v_penalty_total`
--
DROP TABLE IF EXISTS `v_penalty_total`;

CREATE VIEW `v_penalty_total`  AS SELECT `v_penalty`.`student_code` AS `student_code`, sum(`v_penalty`.`late_fee`) AS `total_late_penalty` FROM `v_penalty` GROUP BY `v_penalty`.`student_code` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aaddress`
--
ALTER TABLE `aaddress`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_in`
--
ALTER TABLE `time_in`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aaddress`
--
ALTER TABLE `aaddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events_attendance`
--
ALTER TABLE `events_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events_collection`
--
ALTER TABLE `events_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `time_in`
--
ALTER TABLE `time_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
