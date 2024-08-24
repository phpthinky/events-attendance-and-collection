#
# TABLE STRUCTURE FOR: aauth_group_to_group
#

DROP TABLE IF EXISTS `aauth_group_to_group`;

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: aauth_groups
#

DROP TABLE IF EXISTS `aauth_groups`;

CREATE TABLE `aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES (1, 'Admin', 'Super Admin Group');
INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES (2, 'Public', 'Public Access Group');
INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES (3, 'Default', 'Default Access Group');


#
# TABLE STRUCTURE FOR: aauth_login_attempts
#

DROP TABLE IF EXISTS `aauth_login_attempts`;

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=579 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES (404, '::1', '2024-01-03 01:28:33', 1);
INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES (518, '2a06:1700:3:19::1', '2024-03-23 02:29:04', 1);
INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES (524, '216.247.85.30', '2024-03-24 20:01:14', 4);
INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES (525, '2001:fd8:544:b421:e233:52c2:2fdc:ffb0', '2024-03-24 20:02:45', 2);
INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES (529, '2605:6400:10:8a2:de49:ffd1:46f5:99a2', '2024-03-25 01:42:07', 1);
INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES (559, '2600:3c02::f03c:94ff:fef4:5043', '2024-03-28 22:38:43', 1);


#
# TABLE STRUCTURE FOR: aauth_perm_to_group
#

DROP TABLE IF EXISTS `aauth_perm_to_group`;

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: aauth_perm_to_user
#

DROP TABLE IF EXISTS `aauth_perm_to_user`;

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `aauth_perm_to_user` (`perm_id`, `user_id`) VALUES (1, 4);
INSERT INTO `aauth_perm_to_user` (`perm_id`, `user_id`) VALUES (2, 5);


#
# TABLE STRUCTURE FOR: aauth_perms
#

DROP TABLE IF EXISTS `aauth_perms`;

CREATE TABLE `aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES (1, 'Attendance Officer', 'The one who has permission to check the attendance of the students');
INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES (2, 'Collection Officer', 'The one who has permission to collect payment from the students');


#
# TABLE STRUCTURE FOR: aauth_pms
#

DROP TABLE IF EXISTS `aauth_pms`;

CREATE TABLE `aauth_pms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: aauth_user_to_group
#

DROP TABLE IF EXISTS `aauth_user_to_group`;

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES (1, 1);
INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES (1, 3);


#
# TABLE STRUCTURE FOR: aauth_user_variables
#

DROP TABLE IF EXISTS `aauth_user_variables`;

CREATE TABLE `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: aauth_users
#

DROP TABLE IF EXISTS `aauth_users`;

CREATE TABLE `aauth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `ip_address` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`) VALUES (1, 'admin@gmail.com', 'ec225039f1cb0c48ad528709e8e0184991e637d96db175f094b6b2037ec1a3c2', 'Admin', 0, '2024-04-07 10:44:37', '2024-04-07 10:44:37', NULL, NULL, NULL, NULL, NULL, NULL, '1.37.88.251');


#
# TABLE STRUCTURE FOR: collection_settings
#

DROP TABLE IF EXISTS `collection_settings`;

CREATE TABLE `collection_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `late_penalty` float NOT NULL,
  `absent_penalty` float NOT NULL,
  `late_penalty_minutes` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `collection_settings` (`id`, `late_penalty`, `absent_penalty`, `late_penalty_minutes`, `status`) VALUES (2, '15', '30', 60, 1);


#
# TABLE STRUCTURE FOR: course
#

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `course_sub_title` varchar(25) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `course` (`id`, `course_title`, `description`, `course_sub_title`, `logo`, `status`, `is_deleted`) VALUES (1, 'Bachelor of Science in Information Technology', '', 'BSIT', 'https://supremestudentgovernment.com/assets/img/logo/logo-660010d86871e.jpg', 1, NULL);
INSERT INTO `course` (`id`, `course_title`, `description`, `course_sub_title`, `logo`, `status`, `is_deleted`) VALUES (2, 'Bachelor of Science in Criminology', '', 'BSCRIM', 'https://supremestudentgovernment.com/assets/img/logo/logo-660010920cde7.jpg', 1, NULL);
INSERT INTO `course` (`id`, `course_title`, `description`, `course_sub_title`, `logo`, `status`, `is_deleted`) VALUES (3, 'Bachelor of Science in Tourism Management ', '', 'BSTM', 'https://supremestudentgovernment.com/assets/img/logo/logo-66001062a0efe.jpg', 1, NULL);
INSERT INTO `course` (`id`, `course_title`, `description`, `course_sub_title`, `logo`, `status`, `is_deleted`) VALUES (4, 'Bachelor of  Secondary Education', '', 'BSED', 'https://supremestudentgovernment.com/assets/img/logo/logo-660012c2a6a2a.png', 1, NULL);


#
# TABLE STRUCTURE FOR: course_students
#

DROP TABLE IF EXISTS `course_students`;

CREATE TABLE `course_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `grade` int(1) NOT NULL,
  `section` varchar(1) NOT NULL,
  `semester` int(11) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1,
  `year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: events
#

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `year_id` int(11) NOT NULL,
  `has_afternoon` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: events_absent
#

DROP TABLE IF EXISTS `events_absent`;

CREATE TABLE `events_absent` (
  `absent_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `penalty` int(11) NOT NULL,
  `date_of_event` date NOT NULL,
  `payment_status` int(1) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`absent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: events_attendance
#

DROP TABLE IF EXISTS `events_attendance`;

CREATE TABLE `events_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `penalty_late` int(1) NOT NULL DEFAULT 0,
  `penalty_absent` int(1) NOT NULL DEFAULT 0,
  `date_of_event` date NOT NULL,
  `timein` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL,
  `pm_in` timestamp NULL DEFAULT NULL,
  `pm_out` timestamp NULL DEFAULT NULL,
  `event_day` int(2) NOT NULL,
  `time_in_type` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: events_collection
#

DROP TABLE IF EXISTS `events_collection`;

CREATE TABLE `events_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `amount_pay` float NOT NULL,
  `penalty_late` float NOT NULL,
  `penalty_absent` float NOT NULL,
  `year` int(11) NOT NULL,
  `date_of_payment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `semester` int(1) NOT NULL,
  `year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: events_late
#

DROP TABLE IF EXISTS `events_late`;

CREATE TABLE `events_late` (
  `late_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `penalty` int(11) NOT NULL,
  `date_of_event` date NOT NULL,
  `payment_status` int(1) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`late_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: settings_schoolyear
#

DROP TABLE IF EXISTS `settings_schoolyear`;

CREATE TABLE `settings_schoolyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_year` varchar(20) NOT NULL,
  `end_year` varchar(20) NOT NULL,
  `semester` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: settings_semester
#

DROP TABLE IF EXISTS `settings_semester`;

CREATE TABLE `settings_semester` (
  `current_semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `settings_semester` (`current_semester`) VALUES (2);


#
# TABLE STRUCTURE FOR: settings_site
#

DROP TABLE IF EXISTS `settings_site`;

CREATE TABLE `settings_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `settings_site` (`id`, `title`, `value`, `type`) VALUES (11, 'site_title', '', NULL);


#
# TABLE STRUCTURE FOR: students
#

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `keywords_2` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: students_enrolled
#

DROP TABLE IF EXISTS `students_enrolled`;

CREATE TABLE `students_enrolled` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `year_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# TABLE STRUCTURE FOR: system_info
#

DROP TABLE IF EXISTS `system_info`;

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (1, 'name', 'Sablayan Tourism');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (6, 'short_name', 'MyTourGuide');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (11, 'logo', 'uploads/1623978900_masskara.png');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (13, 'user_avatar', 'uploads/user_avatar.jpg');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (14, 'cover', 'uploads/1624082100_The_Ruins_in_Talisay,_Negros_Occidental_at_Dusk.jpg');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (15, 'about_us', '<h1 class=\"mb-3\">We Provide Best Tour Packages In Your Budget</h1>\r\n                        <p>Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo</p>');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (16, 'about_us_cover', 'http://www.sablayantourism.com/templates/travel_home/img/about.jpg');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (18, 'about_us_thumbs', 'http://www.sablayantourism.com/templates/travel_home/img/about-1.jpg');
INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES (19, 'about_us_thumbs', 'http://www.sablayantourism.com/templates/travel_home/img/about-2.jpg');


