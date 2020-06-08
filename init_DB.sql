-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `elearn`;

SET NAMES utf8mb4;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `failed_jobs`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `migrations`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `oauth_access_tokens`;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0dd0a5ad45eaf962ef61e9f24b301f175efe1aa1e8a33ada70cb799bddd32c75837284bf31d0ee9e',	15,	1,	'MyApp',	'[]',	0,	'2020-05-30 11:13:43',	'2020-05-30 11:13:43',	'2021-05-30 11:13:43'),
('3e03e410b6398d5804d6c562145832c2896cb26f61fb71a53dac6d5b7baedddc932c3d47734f58b9',	7,	1,	'MyApp',	'[]',	0,	'2020-05-25 19:59:04',	'2020-05-25 19:59:04',	'2021-05-25 19:59:04'),
('91f61d56f93e843195dbeb96d810cd8517ccba4ca9f098e5fa8200bd795aeab00ec6a4521d2d1b6a',	15,	1,	'MyApp',	'[]',	0,	'2020-05-30 11:15:45',	'2020-05-30 11:15:45',	'2021-05-30 11:15:45'),
('9b1de37adf76091900b012bebcbefe39fcb6665f7d6dec6473deee29f440c554bad6b8d9b659d402',	15,	1,	'MyApp',	'[]',	0,	'2020-05-30 11:58:40',	'2020-05-30 11:58:40',	'2021-05-30 11:58:40'),
('b7304ab6fe38ea17295454d59e27e52e984db3c8ddd1a88d04e1485de3eafe558cfa399aa41a6c2e',	15,	1,	'MyApp',	'[]',	0,	'2020-05-30 11:47:41',	'2020-05-30 11:47:41',	'2021-05-30 11:47:41'),
('cd33ade0174444087f38dd5af1d2e54cc12b33ae57b5e504f5baf66c2b7d3eb7ccbf32502293fa95',	7,	1,	'MyApp',	'[]',	0,	'2020-05-25 20:21:30',	'2020-05-25 20:21:30',	'2021-05-25 20:21:30'),
('ce056004b6274fe7bfca0752c63fcd858686789fb6d146b04e5120b0d1f5ff267db231d854fba4e1',	15,	1,	'MyApp',	'[]',	0,	'2020-05-30 11:27:50',	'2020-05-30 11:27:50',	'2021-05-30 11:27:50');

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `oauth_auth_codes`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `oauth_clients`;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'eLearning_Platform Personal Access Client',	'opwAIEIOLcEHIgeiWDbUvPz4w6CvXGWWjPCcbhYf',	NULL,	'http://localhost',	1,	0,	0,	'2020-05-25 19:11:32',	'2020-05-25 19:11:32'),
(2,	NULL,	'eLearning_Platform Password Grant Client',	'rc0BFsbYpBJ0G3oR3HbqG8Ja9sSeKnHWXUNqEMYf',	'users',	'http://localhost',	0,	1,	0,	'2020-05-25 19:11:32',	'2020-05-25 19:11:32');

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `oauth_personal_access_clients`;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2020-05-25 19:11:32',	'2020-05-25 19:11:32');

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `oauth_refresh_tokens`;

CREATE TABLE `tbl_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_admin`;
INSERT INTO `tbl_admin` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(3,	'eLearn',	'System',	'developer@schooltimes.ca',	'7007488735',	'',	'2020-05-25 18:30:00',	'2020-05-13 18:17:52');

CREATE TABLE `tbl_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_classes`;
INSERT INTO `tbl_classes` (`id`, `class_name`, `section_name`) VALUES
(1,	'1',	'A'),
(2,	'1',	'B'),
(3,	'1',	'C'),
(4,	'1',	'D'),
(5,	'1',	'E'),
(6,	'2',	'A'),
(7,	'2',	'B'),
(8,	'2',	'C'),
(9,	'2',	'D'),
(10,	'2',	'E'),
(11,	'3',	'A'),
(12,	'3',	'B'),
(13,	'3',	'C'),
(14,	'3',	'D'),
(15,	'3',	'E'),
(16,	'4',	'A'),
(17,	'4',	'B'),
(18,	'4',	'C'),
(19,	'4',	'D'),
(20,	'4',	'E'),
(21,	'5',	'A'),
(22,	'5',	'B'),
(23,	'5',	'C'),
(24,	'5',	'D'),
(25,	'5',	'E'),
(26,	'6',	'A'),
(27,	'6',	'B'),
(28,	'6',	'C'),
(29,	'6',	'D'),
(30,	'6',	'E'),
(31,	'7',	'A'),
(32,	'7',	'B'),
(33,	'7',	'C'),
(34,	'7',	'D'),
(35,	'7',	'E'),
(36,	'8',	'A'),
(37,	'8',	'B'),
(38,	'8',	'C'),
(39,	'8',	'D'),
(40,	'8',	'E'),
(41,	'9',	'A'),
(42,	'9',	'B'),
(43,	'9',	'C'),
(44,	'9',	'D'),
(45,	'9',	'E'),
(46,	'10',	'A'),
(47,	'10',	'B'),
(48,	'10',	'C'),
(49,	'10',	'D'),
(50,	'10',	'E'),
(51,	'11',	'A'),
(52,	'11',	'B'),
(53,	'11',	'C'),
(54,	'11',	'D'),
(55,	'11',	'E'),
(56,	'12',	'A'),
(57,	'12',	'B'),
(58,	'12',	'C'),
(59,	'12',	'D'),
(60,	'12',	'E');

CREATE TABLE `tbl_classwork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `g_live_link` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_class_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classwork_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Assignment/Material/Queestion',
  `topic_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_points` int(3) DEFAULT NULL,
  `g_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_action` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'assign/ask/post',
  `g_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `g_due_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `g_class_id` (`class_id`,`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_classwork`;
INSERT INTO `tbl_classwork` (`id`, `class_id`, `g_live_link`, `g_class_id`, `classwork_type`, `topic_id`, `g_points`, `g_status`, `g_action`, `g_title`, `g_due_date`, `created_at`, `updated_at`, `teacher_id`, `subject_id`) VALUES
(1,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA3MTU5MzYxNjgw/details',	'106889340884',	'ASSIGNMENT',	'1',	NULL,	NULL,	NULL,	'English Grammar 1',	NULL,	'2020-05-29 10:47:18',	'2020-05-29 10:47:18',	12,	1),
(2,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA3MTU2ODExMzEz/details',	'106889340884',	'ASSIGNMENT',	'2',	NULL,	NULL,	NULL,	'English Grammar 2',	NULL,	'2020-05-29 11:26:37',	'2020-05-29 11:26:37',	12,	1),
(3,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA3NTM2NDU3MTA4/details',	'106889340884',	'ASSIGNMENT',	'3',	NULL,	NULL,	NULL,	'English Grammar 3',	NULL,	'2020-05-31 06:49:32',	'2020-05-31 06:49:32',	12,	1),
(4,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA3NTM4ODgyMzY1/details',	'106889340884',	'ASSIGNMENT',	'4',	NULL,	NULL,	NULL,	'English Grammar 4',	NULL,	'2020-05-31 07:35:40',	'2020-05-31 07:35:40',	12,	1),
(5,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA3NTM4MTgyNzEy/details',	'106889340884',	'ASSIGNMENT',	'5',	NULL,	NULL,	NULL,	'English Grammar 5',	NULL,	'2020-05-31 07:36:15',	'2020-05-31 07:36:15',	12,	1),
(6,	13,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy/a/MTA4MDM3NjMxNzY4/details',	'106889035642',	'ASSIGNMENT',	'6',	NULL,	NULL,	NULL,	'History Assignment 1',	NULL,	'2020-06-02 05:03:34',	'2020-06-02 05:03:34',	16,	12),
(7,	13,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy/a/MTA4MDM3Nzk0NDQ2/details',	'106889035642',	'ASSIGNMENT',	'7',	NULL,	NULL,	NULL,	'History Assignment 2',	NULL,	'2020-06-02 05:09:42',	'2020-06-02 05:09:42',	16,	12),
(8,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4MDQ2MzcyMjMz/details',	'106889340884',	'ASSIGNMENT',	'8',	NULL,	NULL,	NULL,	'jhghj',	NULL,	'2020-06-02 06:22:57',	'2020-06-02 06:22:57',	12,	1),
(9,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4MDI4MzMyNTUy/details',	'106889340884',	'ASSIGNMENT',	'9',	NULL,	NULL,	NULL,	'vzc',	NULL,	'2020-06-02 06:23:25',	'2020-06-02 06:23:25',	12,	1),
(10,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4MDUxNjM2OTEy/details',	'106889340884',	'ASSIGNMENT',	'10',	NULL,	NULL,	NULL,	'fasdf',	NULL,	'2020-06-02 06:25:55',	'2020-06-02 06:25:55',	12,	1),
(11,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4MTM0OTgxMjIz/details',	'106889340884',	'ASSIGNMENT',	'11',	NULL,	NULL,	NULL,	'Assignment for English',	NULL,	'2020-06-02 10:44:25',	'2020-06-02 10:44:25',	12,	1),
(12,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4NTAyODY5Mjk0/details',	'106889340884',	'ASSIGNMENT',	'12',	NULL,	NULL,	NULL,	'English Grammar 6',	NULL,	'2020-06-03 05:44:48',	'2020-06-03 05:44:48',	12,	1),
(13,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4NTQzNjgzMjk2/details',	'106889340884',	'ASSIGNMENT',	'13',	NULL,	NULL,	NULL,	'English Grammar 7',	NULL,	'2020-06-03 09:46:45',	'2020-06-03 09:46:45',	12,	1),
(14,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4NTcxMTU2NDI0/details',	'106889340884',	'ASSIGNMENT',	'14',	NULL,	NULL,	NULL,	'English Grammar 8',	NULL,	'2020-06-03 11:45:45',	'2020-06-03 11:45:45',	12,	1),
(15,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4ODQ1NDE5NTUw/details',	'106889340884',	'ASSIGNMENT',	'15',	NULL,	NULL,	NULL,	'English Grammar 11',	NULL,	'2020-06-04 07:09:02',	'2020-06-04 07:09:02',	12,	1),
(16,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4ODY4MTAzOTE2/details',	'106889340884',	'ASSIGNMENT',	'16',	NULL,	NULL,	NULL,	'English Grammar 13',	NULL,	'2020-06-04 09:46:44',	'2020-06-04 09:46:44',	12,	1),
(17,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA4OTc1MTYxMDQ0/details',	'106889340884',	'ASSIGNMENT',	'17',	NULL,	NULL,	NULL,	'English Grammar 15',	NULL,	'2020-06-04 16:59:36',	'2020-06-04 16:59:36',	12,	1),
(18,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA5MTEwNjA4NzYw/details',	'106889340884',	'ASSIGNMENT',	'18',	NULL,	NULL,	NULL,	'English Grammar 20',	NULL,	'2020-06-05 05:49:47',	'2020-06-05 05:49:47',	12,	1),
(19,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA5MTIzNDk0MTAy/details',	'106889340884',	'ASSIGNMENT',	'19',	NULL,	NULL,	NULL,	'English Grammar 30',	NULL,	'2020-06-05 05:58:25',	'2020-06-05 05:58:25',	12,	1),
(20,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA5MTQ2MjYzMzQ2/details',	'106889340884',	'ASSIGNMENT',	'20',	NULL,	NULL,	NULL,	'English Grammar 31',	NULL,	'2020-06-05 08:38:50',	'2020-06-05 08:38:50',	12,	1),
(21,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA5MTk0MzIyODY3/details',	'106889340884',	'ASSIGNMENT',	'21',	NULL,	NULL,	NULL,	'English Grammar 123',	NULL,	'2020-06-05 13:44:42',	'2020-06-05 13:44:42',	12,	1),
(22,	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0/a/MTA5MzM5ODY3Mzkx/details',	'106889340884',	'ASSIGNMENT',	'22',	NULL,	NULL,	NULL,	'English Grammar 132',	NULL,	'2020-06-06 03:49:06',	'2020-06-06 03:49:06',	12,	1);

CREATE TABLE `tbl_classwork_dateclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateclass_id` int(11) NOT NULL,
  `classwork_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_classwork_dateclass`;
INSERT INTO `tbl_classwork_dateclass` (`id`, `dateclass_id`, `classwork_id`) VALUES
(1,	11,	2),
(2,	35,	6),
(3,	31,	8),
(4,	31,	9),
(5,	31,	10),
(6,	31,	11),
(7,	42,	12),
(8,	42,	13),
(9,	42,	14),
(10,	57,	15),
(11,	57,	16),
(12,	57,	17),
(13,	68,	17),
(14,	68,	18),
(15,	68,	19),
(16,	68,	20),
(17,	68,	21),
(18,	80,	22);

CREATE TABLE `tbl_class_timings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT '0',
  `teacher_id` int(11) NOT NULL,
  `class_day` char(10) NOT NULL,
  `from_timing` time NOT NULL,
  `to_timing` time NOT NULL,
  `is_lunch` tinyint(1) DEFAULT '0' COMMENT '0=>not lunch, 1=>lunch',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

TRUNCATE `tbl_class_timings`;
INSERT INTO `tbl_class_timings` (`id`, `class_id`, `subject_id`, `teacher_id`, `class_day`, `from_timing`, `to_timing`, `is_lunch`, `created_at`, `updated_at`) VALUES
(1,	7,	2,	11,	'Monday',	'09:00:00',	'09:40:00',	0,	'2020-05-28 18:01:22',	'2020-05-28 18:01:22'),
(2,	8,	6,	11,	'Tuesday',	'09:00:00',	'09:40:00',	0,	'2020-05-28 18:01:25',	'2020-05-28 18:01:25'),
(3,	7,	2,	11,	'Wednesday',	'09:00:00',	'09:40:00',	0,	'2020-05-28 18:01:25',	'2020-05-28 18:01:25'),
(4,	8,	6,	11,	'Thursday',	'09:00:00',	'09:40:00',	0,	'2020-05-28 18:01:25',	'2020-05-28 18:01:25'),
(5,	7,	2,	11,	'Friday',	'09:00:00',	'09:40:00',	0,	'2020-05-28 18:01:25',	'2020-05-28 18:01:25'),
(6,	8,	6,	11,	'Saturday',	'09:00:00',	'09:40:00',	0,	'2020-05-28 18:01:25',	'2020-05-28 18:01:25'),
(7,	9,	1,	12,	'Monday',	'09:40:00',	'10:20:00',	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28'),
(8,	9,	1,	12,	'Tuesday',	'09:40:00',	'10:20:00',	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28'),
(9,	9,	1,	12,	'Wednesday',	'09:40:00',	'10:20:00',	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28'),
(10,	9,	1,	12,	'Thursday',	'09:40:00',	'10:20:00',	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28'),
(11,	9,	1,	12,	'Friday',	'09:40:00',	'10:20:00',	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28'),
(12,	9,	1,	12,	'Saturday',	'09:40:00',	'10:20:00',	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28'),
(13,	10,	3,	13,	'Monday',	'10:20:00',	'11:00:00',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(14,	10,	3,	13,	'Tuesday',	'10:20:00',	'11:00:00',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(15,	10,	3,	13,	'Wednesday',	'10:20:00',	'11:00:00',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(16,	10,	3,	13,	'Thursday',	'10:20:00',	'11:00:00',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(17,	10,	3,	13,	'Friday',	'10:20:00',	'11:00:00',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(18,	10,	3,	13,	'Saturday',	'10:20:00',	'11:00:00',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(19,	11,	9,	14,	'Monday',	'11:00:00',	'11:40:00',	0,	'2020-05-28 18:01:35',	'2020-05-28 18:01:35'),
(20,	12,	11,	15,	'Tuesday',	'11:00:00',	'11:40:00',	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(21,	11,	9,	14,	'Wednesday',	'11:00:00',	'11:40:00',	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(22,	12,	11,	15,	'Thursday',	'11:00:00',	'11:40:00',	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(23,	11,	9,	14,	'Friday',	'11:00:00',	'11:40:00',	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(24,	12,	11,	15,	'Saturday',	'11:00:00',	'11:40:00',	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(25,	12,	11,	0,	'Monday',	'11:40:00',	'12:20:00',	1,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(26,	12,	11,	0,	'Tuesday',	'11:40:00',	'12:20:00',	1,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(27,	12,	11,	0,	'Wednesday',	'11:40:00',	'12:20:00',	1,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(28,	12,	11,	0,	'Thursday',	'11:40:00',	'12:20:00',	1,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(29,	12,	11,	0,	'Friday',	'11:40:00',	'12:20:00',	1,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(30,	12,	11,	0,	'Saturday',	'11:40:00',	'12:20:00',	1,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38'),
(31,	13,	12,	16,	'Monday',	'12:20:00',	'13:00:00',	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42'),
(32,	13,	12,	16,	'Tuesday',	'12:20:00',	'13:00:00',	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42'),
(33,	13,	12,	16,	'Wednesday',	'12:20:00',	'13:00:00',	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42'),
(34,	13,	12,	16,	'Thursday',	'12:20:00',	'13:00:00',	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42'),
(35,	13,	12,	16,	'Friday',	'12:20:00',	'13:00:00',	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42'),
(36,	13,	12,	16,	'Saturday',	'12:20:00',	'13:00:00',	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42'),
(37,	14,	15,	17,	'Monday',	'13:00:00',	'13:40:00',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(38,	14,	15,	17,	'Tuesday',	'13:00:00',	'13:40:00',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(39,	14,	15,	17,	'Wednesday',	'13:00:00',	'13:40:00',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(40,	14,	15,	17,	'Thursday',	'13:00:00',	'13:40:00',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(41,	14,	15,	17,	'Friday',	'13:00:00',	'13:40:00',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(42,	14,	15,	17,	'Saturday',	'13:00:00',	'13:40:00',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(43,	15,	8,	18,	'Monday',	'13:40:00',	'14:20:00',	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49'),
(44,	15,	8,	18,	'Tuesday',	'13:40:00',	'14:20:00',	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49'),
(45,	15,	8,	18,	'Wednesday',	'13:40:00',	'14:20:00',	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49'),
(46,	15,	8,	18,	'Thursday',	'13:40:00',	'14:20:00',	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49'),
(47,	15,	8,	18,	'Friday',	'13:40:00',	'14:20:00',	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49'),
(48,	15,	8,	18,	'Saturday',	'13:40:00',	'14:20:00',	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49'),
(49,	16,	7,	19,	'Monday',	'14:20:00',	'15:00:00',	0,	'2020-05-28 18:01:52',	'2020-05-28 18:01:52'),
(50,	17,	14,	19,	'Tuesday',	'14:20:00',	'15:00:00',	0,	'2020-05-28 18:01:55',	'2020-05-28 18:01:55'),
(51,	16,	7,	19,	'Wednesday',	'14:20:00',	'15:00:00',	0,	'2020-05-28 18:01:55',	'2020-05-28 18:01:55'),
(52,	17,	14,	19,	'Thursday',	'14:20:00',	'15:00:00',	0,	'2020-05-28 18:01:55',	'2020-05-28 18:01:55'),
(53,	16,	7,	19,	'Friday',	'14:20:00',	'15:00:00',	0,	'2020-05-28 18:01:55',	'2020-05-28 18:01:55'),
(54,	17,	14,	19,	'Saturday',	'14:20:00',	'15:00:00',	0,	'2020-05-28 18:01:55',	'2020-05-28 18:01:55');

CREATE TABLE `tbl_cmslinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` int(11) DEFAULT NULL,
  `topic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assignment_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_cmslinks`;
INSERT INTO `tbl_cmslinks` (`id`, `class`, `subject`, `topic`, `link`, `assignment_link`) VALUES
(6,	'10',	1,	'A Tale of Two Birds',	'https://cms.schooltimes.ca/topic/c6-eng-psb-1-summary/',	'https://cms.schooltimes.ca/topic/c6-eng-psb-1-summary/'),
(7,	'10',	1,	'The Friendly Mongoose',	'https://cms.schooltimes.ca/lessons/c6-eng-psb-2-chapter-2-the-friendly-mongoose/',	'https://cms.schooltimes.ca/lessons/c6-eng-psb-2-chapter-2-the-friendly-mongoose/');

CREATE TABLE `tbl_dateclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `from_timing` time NOT NULL,
  `to_timing` time NOT NULL,
  `class_date` date NOT NULL,
  `timetable_id` int(11) DEFAULT NULL,
  `live_link` varchar(255) DEFAULT NULL,
  `ass_live_url` varchar(255) DEFAULT NULL,
  `quiz_link` varchar(255) DEFAULT NULL,
  `is_past` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Upcoming 1=> Past',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_student_msg` varchar(255) DEFAULT NULL,
  `class_description` varchar(255) DEFAULT NULL,
  `g_meet_url` varchar(255) DEFAULT NULL,
  `recording_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

TRUNCATE `tbl_dateclass`;
INSERT INTO `tbl_dateclass` (`id`, `class_id`, `subject_id`, `teacher_id`, `topic_id`, `from_timing`, `to_timing`, `class_date`, `timetable_id`, `live_link`, `ass_live_url`, `quiz_link`, `is_past`, `created_at`, `updated_at`, `class_student_msg`, `class_description`, `g_meet_url`, `recording_url`) VALUES
(1,	8,	6,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-05-28',	4,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:25',	'2020-05-28 18:01:25',	NULL,	NULL,	NULL,	NULL),
(2,	9,	1,	12,	NULL,	'09:40:00',	'10:20:00',	'2020-05-28',	10,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:28',	'2020-05-28 18:01:28',	NULL,	NULL,	NULL,	NULL),
(3,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-05-28',	16,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31',	NULL,	NULL,	NULL,	NULL),
(4,	12,	11,	15,	NULL,	'11:00:00',	'11:40:00',	'2020-05-28',	22,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38',	NULL,	NULL,	NULL,	NULL),
(5,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-05-28',	28,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:38',	'2020-05-28 18:01:38',	NULL,	NULL,	NULL,	NULL),
(6,	13,	12,	16,	NULL,	'12:20:00',	'13:00:00',	'2020-05-28',	34,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:42',	'2020-05-28 18:01:42',	NULL,	NULL,	NULL,	NULL),
(7,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-05-28',	40,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45',	NULL,	NULL,	NULL,	NULL),
(8,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-05-28',	46,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:49',	'2020-05-28 18:01:49',	NULL,	NULL,	NULL,	NULL),
(9,	17,	14,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-05-28',	52,	'',	NULL,	NULL,	0,	'2020-05-28 18:01:55',	'2020-05-28 18:01:55',	NULL,	NULL,	NULL,	NULL),
(10,	7,	2,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-05-29',	5,	'https://classroom.google.com/c/MTA2ODg4OTkwOTky',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(11,	9,	1,	12,	5,	'09:40:00',	'10:20:00',	'2020-05-29',	11,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 12:08:17',	NULL,	'Grammar chapter 1',	NULL,	NULL),
(12,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-05-29',	17,	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(13,	11,	9,	14,	NULL,	'11:00:00',	'11:40:00',	'2020-05-29',	23,	'https://classroom.google.com/c/MTA2ODg5MzM5NTE3',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(14,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-05-29',	29,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(15,	13,	12,	16,	NULL,	'12:20:00',	'13:00:00',	'2020-05-29',	35,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(16,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-05-29',	41,	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(17,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-05-29',	47,	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(18,	16,	7,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-05-29',	53,	'https://classroom.google.com/c/MTA2ODg5MDY3MDUw',	NULL,	NULL,	0,	'2020-05-29 10:26:56',	'2020-05-29 10:26:56',	NULL,	NULL,	NULL,	NULL),
(19,	9,	1,	12,	NULL,	'14:00:00',	'15:00:00',	'2020-05-29',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-05-29 11:31:07',	'2020-05-29 11:31:07',	'This is the extra class considering exam.',	NULL,	NULL,	NULL),
(20,	12,	11,	15,	NULL,	'10:20:00',	'11:00:00',	'2020-05-30',	NULL,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-05-30 11:52:53',	'2020-05-30 11:52:53',	'Thsi is new class',	NULL,	NULL,	NULL),
(21,	7,	2,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-06-01',	1,	'https://classroom.google.com/c/MTA2ODg4OTkwOTky',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(22,	9,	1,	12,	NULL,	'09:40:00',	'10:20:00',	'2020-06-01',	7,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(23,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-06-01',	13,	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(24,	11,	9,	14,	NULL,	'11:00:00',	'11:40:00',	'2020-06-01',	19,	'https://classroom.google.com/c/MTA2ODg5MzM5NTE3',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(25,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-06-01',	25,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(26,	13,	12,	16,	NULL,	'12:20:00',	'13:00:00',	'2020-06-01',	31,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(27,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-06-01',	37,	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(28,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-06-01',	43,	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(29,	16,	7,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-06-01',	49,	'https://classroom.google.com/c/MTA2ODg5MDY3MDUw',	NULL,	NULL,	0,	'2020-06-01 17:39:01',	'2020-06-01 17:39:01',	NULL,	NULL,	NULL,	NULL),
(30,	8,	6,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-06-02',	2,	'https://classroom.google.com/c/MTA2ODg5NDI4NTAx',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(31,	9,	1,	12,	5,	'09:40:00',	'10:20:00',	'2020-06-02',	8,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 10:49:24',	NULL,	'Note : Taught chapter 3',	NULL,	NULL),
(32,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-06-02',	14,	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(33,	12,	11,	15,	NULL,	'11:00:00',	'11:40:00',	'2020-06-02',	20,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(34,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-06-02',	26,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(35,	13,	12,	16,	6,	'12:20:00',	'13:00:00',	'2020-06-02',	32,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 05:03:34',	NULL,	'I will teach chapter 3 today',	NULL,	NULL),
(36,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-06-02',	38,	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(37,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-06-02',	44,	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(38,	17,	14,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-06-02',	50,	'https://classroom.google.com/c/MTA2ODg5NDA1OTgx',	NULL,	NULL,	0,	'2020-06-02 03:20:17',	'2020-06-02 03:20:17',	NULL,	NULL,	NULL,	NULL),
(39,	13,	12,	16,	NULL,	'13:00:00',	'14:00:00',	'2020-06-03',	NULL,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-02 05:07:53',	'2020-06-02 05:07:53',	'This is extra class considering upcoming exams.',	NULL,	NULL,	NULL),
(40,	13,	12,	16,	NULL,	'14:00:00',	'15:00:00',	'2020-06-02',	NULL,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-02 05:08:25',	'2020-06-02 05:08:25',	'This is a sample class',	NULL,	NULL,	NULL),
(41,	9,	1,	12,	5,	'17:00:00',	'18:00:00',	'2020-06-02',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-02 10:53:32',	'2020-06-02 10:54:25',	'Extra class',	NULL,	NULL,	NULL),
(42,	9,	1,	12,	14,	'11:00:00',	'11:40:00',	'2020-06-03',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-03 05:11:38',	'2020-06-03 11:45:45',	'Sample Class',	'I am teaching chapter 3 topic 2. Pending topic 10',	NULL,	NULL),
(43,	9,	1,	12,	NULL,	'13:00:00',	'14:00:00',	'2020-06-03',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-03 05:12:38',	'2020-06-03 05:12:38',	'Demo class',	NULL,	NULL,	NULL),
(44,	9,	1,	12,	NULL,	'16:00:00',	'17:00:00',	'2020-06-03',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-03 05:50:18',	'2020-06-03 05:50:18',	'Considering upcoming exams..',	NULL,	NULL,	NULL),
(45,	9,	1,	12,	NULL,	'17:00:00',	'18:00:00',	'2020-06-03',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-03 09:45:44',	'2020-06-03 09:45:44',	'Extra class',	NULL,	NULL,	NULL),
(46,	9,	1,	12,	NULL,	'18:00:00',	'19:00:00',	'2020-06-03',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-03 11:49:12',	'2020-06-03 11:49:12',	'Extra Class',	NULL,	NULL,	NULL),
(47,	7,	2,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-06-03',	3,	'https://classroom.google.com/c/MTA2ODg4OTkwOTky',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(48,	9,	1,	12,	NULL,	'09:40:00',	'10:20:00',	'2020-06-03',	9,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(49,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-06-03',	15,	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(50,	11,	9,	14,	NULL,	'11:00:00',	'11:40:00',	'2020-06-03',	21,	'https://classroom.google.com/c/MTA2ODg5MzM5NTE3',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(51,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-06-03',	27,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(52,	13,	12,	16,	NULL,	'12:20:00',	'13:00:00',	'2020-06-03',	33,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(53,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-06-03',	39,	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(54,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-06-03',	45,	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(55,	16,	7,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-06-03',	51,	'https://classroom.google.com/c/MTA2ODg5MDY3MDUw',	NULL,	NULL,	0,	'2020-06-03 12:02:27',	'2020-06-03 12:02:27',	NULL,	NULL,	NULL,	NULL),
(56,	8,	6,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-06-04',	4,	'https://classroom.google.com/c/MTA2ODg5NDI4NTAx',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(57,	9,	1,	12,	7,	'09:40:00',	'10:20:00',	'2020-06-04',	10,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 17:12:38',	NULL,	'Chapter 4 - topic 1 , pending topic 2, pending ..',	NULL,	NULL),
(58,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-06-04',	16,	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(59,	12,	11,	15,	NULL,	'11:00:00',	'11:40:00',	'2020-06-04',	22,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(60,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-06-04',	28,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(61,	13,	12,	16,	NULL,	'12:20:00',	'13:00:00',	'2020-06-04',	34,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(62,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-06-04',	40,	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(63,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-06-04',	46,	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(64,	17,	14,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-06-04',	52,	'https://classroom.google.com/c/MTA2ODg5NDA1OTgx',	NULL,	NULL,	0,	'2020-06-04 05:32:28',	'2020-06-04 05:32:28',	NULL,	NULL,	NULL,	NULL),
(65,	9,	1,	12,	6,	'19:00:00',	'20:00:00',	'2020-06-04',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-04 07:06:00',	'2020-06-04 17:19:54',	'Extra class considering exam.',	'I am gonna teach chapter 5 today in this class. I missed topic 3, will teach later...',	NULL,	NULL),
(66,	9,	1,	12,	NULL,	'20:00:00',	'21:00:00',	'2020-06-04',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-04 09:54:05',	'2020-06-04 09:54:29',	'This is the extra class considering exam..',	'This is the extra class I will take',	NULL,	NULL),
(67,	7,	2,	11,	NULL,	'09:00:00',	'09:40:00',	'2020-06-05',	5,	'https://classroom.google.com/c/MTA2ODg4OTkwOTky',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(68,	9,	1,	12,	21,	'09:40:00',	'10:20:00',	'2020-06-05',	11,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 13:44:42',	'This class is cancelled',	'I taught chapter 3, left topic 2..',	NULL,	NULL),
(69,	10,	3,	13,	NULL,	'10:20:00',	'11:00:00',	'2020-06-05',	17,	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(70,	11,	9,	14,	NULL,	'11:00:00',	'11:40:00',	'2020-06-05',	23,	'https://classroom.google.com/c/MTA2ODg5MzM5NTE3',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(71,	12,	11,	0,	NULL,	'11:40:00',	'12:20:00',	'2020-06-05',	29,	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(72,	13,	12,	16,	NULL,	'12:20:00',	'13:00:00',	'2020-06-05',	35,	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(73,	14,	15,	17,	NULL,	'13:00:00',	'13:40:00',	'2020-06-05',	41,	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(74,	15,	8,	18,	NULL,	'13:40:00',	'14:20:00',	'2020-06-05',	47,	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(75,	16,	7,	19,	NULL,	'14:20:00',	'15:00:00',	'2020-06-05',	53,	'https://classroom.google.com/c/MTA2ODg5MDY3MDUw',	NULL,	NULL,	0,	'2020-06-05 04:56:28',	'2020-06-05 04:56:28',	NULL,	NULL,	NULL,	NULL),
(76,	9,	1,	12,	NULL,	'20:00:00',	'21:00:00',	'2020-06-05',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-05 13:47:10',	'2020-06-05 13:47:10',	'This is extra class',	NULL,	NULL,	NULL),
(77,	9,	1,	12,	NULL,	'17:00:00',	'18:00:00',	'2020-06-05',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-06 02:04:20',	'2020-06-06 02:04:20',	'erhfgh',	NULL,	NULL,	NULL),
(78,	9,	1,	12,	NULL,	'12:00:00',	'13:00:00',	'2020-06-05',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-06 02:04:46',	'2020-06-06 02:04:46',	'4therth',	NULL,	NULL,	NULL),
(79,	9,	1,	12,	NULL,	'19:00:00',	'20:00:00',	'2020-06-05',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-06 02:05:13',	'2020-06-06 02:05:13',	'rwtgt',	NULL,	NULL,	NULL),
(80,	9,	1,	12,	22,	'10:00:00',	'11:00:00',	'2020-06-06',	NULL,	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	NULL,	NULL,	0,	'2020-06-06 03:37:36',	'2020-06-06 03:52:28',	'Class',	'I am teaching chapter 3 topic 5. I missed topic 4, will cover in next class.',	NULL,	NULL);

CREATE TABLE `tbl_invite_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `g_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_responce` text COLLATE utf8mb4_unicode_ci,
  `is_accept` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_invite_teacher`;
INSERT INTO `tbl_invite_teacher` (`id`, `class_id`, `teacher_id`, `subject_id`, `g_code`, `g_responce`, `is_accept`, `created_at`, `updated_at`) VALUES
(1,	7,	11,	2,	'',	'',	1,	'2020-06-05 05:03:33',	'2020-06-05 05:03:33'),
(2,	8,	11,	6,	'',	'',	1,	'2020-06-05 05:03:37',	'2020-06-05 05:03:37'),
(3,	9,	12,	1,	'',	'',	1,	'2020-05-29 04:35:52',	'2020-05-29 10:05:52'),
(4,	10,	13,	3,	'MTA2ODg5NTUwMzcyfDEwNjkxNDYxNDc3NzIyOTcwMTczM1pa',	'',	0,	'2020-05-28 18:01:31',	'2020-05-28 18:01:31'),
(5,	11,	14,	9,	'MTA2ODg5MzM5NTE3fDEwNjkzMzk1OTA5NTIxMjI1OTU4Mlpa',	'',	0,	'2020-05-28 18:01:35',	'2020-05-28 18:01:35'),
(6,	12,	15,	11,	'',	'',	1,	'2020-05-28 13:59:23',	'2020-05-28 19:29:23'),
(7,	13,	16,	12,	'',	'',	1,	'2020-06-02 04:54:48',	'2020-06-02 04:54:48'),
(8,	14,	17,	15,	'MTA2ODU3MjgyNTQwfDEwMjYzNTI3MjUwNTEwOTgzNTYzNlpa',	'',	0,	'2020-05-28 18:01:45',	'2020-05-28 18:01:45'),
(9,	15,	18,	8,	'MTA2ODg5NzYzNjA3fDExNTUyMjk4ODk4MjQzNDI5ODM1MFpa',	'',	0,	'2020-05-28 18:01:48',	'2020-05-28 18:01:48'),
(10,	16,	19,	7,	'MTA2ODg5MDY3MDUwfDEwODkwNDY3Mjg1OTAxNDAzNzgzN1pa',	'',	0,	'2020-05-28 18:01:52',	'2020-05-28 18:01:52'),
(11,	17,	19,	14,	'MTA2ODg5NDA1OTgxfDEwODkwNDY3Mjg1OTAxNDAzNzgzN1pa',	'',	0,	'2020-05-28 18:01:54',	'2020-05-28 18:01:54');

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'folder name (in public folder)',
  `permission` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'de' COMMENT 'F=file,D=display, E=edit, N=null,',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_settings`;
INSERT INTO `tbl_settings` (`id`, `item`, `value`, `folder`, `permission`) VALUES
(10,	'domain',	'schooltimes.ca',	NULL,	'D'),
(11,	'year',	'2020',	NULL,	'DE'),
(12,	'mailfrom',	'noreply@schooltimes.ca',	NULL,	'D'),
(13,	'schoolname',	'DPS Bhopal',	NULL,	'DE'),
(14,	'schoollogo',	'http://lms.schooltimes.ca/public/images/Delhi-Public-School-Kolar-Road-Bhopal.png',	'images',	'DF'),
(15,	'schooladdress',	'DPS Bhopal',	NULL,	'DEN');

CREATE TABLE `tbl_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(5) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_students`;
INSERT INTO `tbl_students` (`id`, `name`, `class_id`, `email`, `phone`, `notify`) VALUES
(6,	'Aman',	46,	'raiaman15@gmail.com',	'1234567890',	'yes'),
(7,	'Demo Student',	46,	'demostudent@montbit.tech',	'1234567890',	'yes'),
(8,	'Chitra Soni',	46,	'angelina.swiftuser@gmail.com',	'1234567890',	'yes');

CREATE TABLE `tbl_student_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` int(11) NOT NULL,
  `section_name` char(5) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `g_class_id` varchar(100) NOT NULL,
  `g_link` varchar(255) NOT NULL,
  `g_response` text NOT NULL,
  `student_numbers` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

TRUNCATE `tbl_student_classes`;
INSERT INTO `tbl_student_classes` (`id`, `class_name`, `section_name`, `subject_id`, `g_class_id`, `g_link`, `g_response`, `student_numbers`, `created_at`, `updated_at`, `created_by`) VALUES
(7,	10,	'A',	2,	'106888990992',	'https://classroom.google.com/c/MTA2ODg4OTkwOTky',	'{\n  \"id\": \"106888990992\",\n  \"name\": \"10 Physics\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:25:57.759Z\",\n  \"updateTime\": \"2020-05-28T12:25:56.902Z\",\n  \"enrollmentCode\": \"fewbqc4\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg4OTkwOTky\",\n  \"teacherGroupEmail\": \"10_Physics_A_teachers_083318a4@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Physics_A_caf2f468@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfjROcmdQaUs2UWh4RGIxbUhXT3lUenpUSWNhV094S0EycC1henlFbkQ3Mms\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:56:01',	'2020-05-28 17:56:01',	NULL),
(8,	10,	'A',	6,	'106889428501',	'https://classroom.google.com/c/MTA2ODg5NDI4NTAx',	'{\n  \"id\": \"106889428501\",\n  \"name\": \"10 Chemistry\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:26:13.656Z\",\n  \"updateTime\": \"2020-05-28T12:26:12.707Z\",\n  \"enrollmentCode\": \"ywkyywk\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5NDI4NTAx\",\n  \"teacherGroupEmail\": \"10_Chemistry_A_teachers_3c13368b@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Chemistry_A_fcb25c3b@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfjJTbndvUjhxRUlaSm0ySnVtbmxJMXFPcnBKSjV4X0Z2c2w1dFBMZ2owOG8\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:56:17',	'2020-05-28 17:56:17',	NULL),
(9,	10,	'A',	1,	'106889340884',	'https://classroom.google.com/c/MTA2ODg5MzQwODg0',	'{\n  \"id\": \"106889340884\",\n  \"name\": \"10 English\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:26:32.874Z\",\n  \"updateTime\": \"2020-05-28T12:26:31.884Z\",\n  \"enrollmentCode\": \"bxhufiy\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5MzQwODg0\",\n  \"teacherGroupEmail\": \"10_English_A_teachers_32b617df@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_English_A_070fc81b@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfkwxejlEalpCTVdZWHd3Q1prUUVtejZuRGNRT0wzVHFDWDJzbjRrM1NVN00\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:56:36',	'2020-05-28 17:56:36',	NULL),
(10,	10,	'A',	3,	'106889550372',	'https://classroom.google.com/c/MTA2ODg5NTUwMzcy',	'{\n  \"id\": \"106889550372\",\n  \"name\": \"10 Geography\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:26:48.112Z\",\n  \"updateTime\": \"2020-05-28T12:26:47.148Z\",\n  \"enrollmentCode\": \"3s5hqku\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5NTUwMzcy\",\n  \"teacherGroupEmail\": \"10_Geography_A_teachers_967fdf8b@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Geography_A_4ee2586c@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfkUycV9zbTQ3ekdSaUpCS05QcjU3eFBhWDY1S2RZYkgwQWhXbW1HRkFoU28\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:56:51',	'2020-05-28 17:56:51',	NULL),
(11,	10,	'A',	9,	'106889339517',	'https://classroom.google.com/c/MTA2ODg5MzM5NTE3',	'{\n  \"id\": \"106889339517\",\n  \"name\": \"10 Science\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:27:11.684Z\",\n  \"updateTime\": \"2020-05-28T12:27:10.636Z\",\n  \"enrollmentCode\": \"tcaqmc2\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5MzM5NTE3\",\n  \"teacherGroupEmail\": \"10_Science_A_teachers_df11bcf4@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Science_A_c65206f1@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfm5YVzg3UUU4WXhBdWpOMERuYVczSVROaW9fOGVwaUpHVmpYZnhNVDNDRTA\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:57:15',	'2020-05-28 17:57:15',	NULL),
(12,	10,	'A',	11,	'106889691602',	'https://classroom.google.com/c/MTA2ODg5NjkxNjAy',	'{\n  \"id\": \"106889691602\",\n  \"name\": \"10 PT\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:27:25.429Z\",\n  \"updateTime\": \"2020-05-28T12:27:24.552Z\",\n  \"enrollmentCode\": \"4lf6z5e\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5NjkxNjAy\",\n  \"teacherGroupEmail\": \"10_PT_A_teachers_8745acc1@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_PT_A_c95d778e@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDflR3VWhvVnkxSDN4ekpjbjFtVTF4aFN3YW5nNElyd0tZUWkySnB0TlVPTzQ\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:57:28',	'2020-05-28 17:57:28',	NULL),
(13,	10,	'A',	12,	'106889035642',	'https://classroom.google.com/c/MTA2ODg5MDM1NjQy',	'{\n  \"id\": \"106889035642\",\n  \"name\": \"10 History\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:27:48.938Z\",\n  \"updateTime\": \"2020-05-28T12:27:47.829Z\",\n  \"enrollmentCode\": \"tph3v7f\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5MDM1NjQy\",\n  \"teacherGroupEmail\": \"10_History_A_teachers_21fce4d9@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_History_A_3e7eaae5@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfjhDTmJqZFI4cWFzYUxpRjdTMElSaVBZeWRiUkVTNS1sbTIzamgyV1pmMzQ\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:57:52',	'2020-05-28 17:57:52',	NULL),
(14,	10,	'A',	15,	'106857282540',	'https://classroom.google.com/c/MTA2ODU3MjgyNTQw',	'{\n  \"id\": \"106857282540\",\n  \"name\": \"10 Hindi\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:28:04.172Z\",\n  \"updateTime\": \"2020-05-28T12:28:03.318Z\",\n  \"enrollmentCode\": \"k6ce6lp\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODU3MjgyNTQw\",\n  \"teacherGroupEmail\": \"10_Hindi_A_teachers_7c9fb07c@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Hindi_A_127f23a9@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfkxDaVlWSHhuOWJhR1NpMnFHa0hnbE82NWV3TWpibklsNnRUZy1lX3JfRG8\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:58:07',	'2020-05-28 17:58:07',	NULL),
(15,	10,	'A',	8,	'106889763607',	'https://classroom.google.com/c/MTA2ODg5NzYzNjA3',	'{\n  \"id\": \"106889763607\",\n  \"name\": \"10 Maths\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:28:19.285Z\",\n  \"updateTime\": \"2020-05-28T12:28:18.411Z\",\n  \"enrollmentCode\": \"akvayf6\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5NzYzNjA3\",\n  \"teacherGroupEmail\": \"10_Maths_A_teachers_0bd516eb@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Maths_A_24f35fee@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfnFQMDE2emdzTkNDa0hCaXh2eEV2WTZMX09sSXVudWtteERwV0RVQlJ6VFU\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:58:22',	'2020-05-28 17:58:22',	NULL),
(16,	10,	'A',	7,	'106889067050',	'https://classroom.google.com/c/MTA2ODg5MDY3MDUw',	'{\n  \"id\": \"106889067050\",\n  \"name\": \"10 Games\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:28:35.291Z\",\n  \"updateTime\": \"2020-05-28T12:28:34.239Z\",\n  \"enrollmentCode\": \"zkreued\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5MDY3MDUw\",\n  \"teacherGroupEmail\": \"10_Games_A_teachers_708f88e5@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Games_A_627c6ad6@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfnd0dFFoaGpKNExGdmxFRW5VeDM3UWNobmY2eE93dy1JeFRMN25KVndhVFk\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:58:38',	'2020-05-28 17:58:38',	NULL),
(17,	10,	'A',	14,	'106889405981',	'https://classroom.google.com/c/MTA2ODg5NDA1OTgx',	'{\n  \"id\": \"106889405981\",\n  \"name\": \"10 Yoga\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-05-28T12:28:50.933Z\",\n  \"updateTime\": \"2020-05-28T12:28:49.978Z\",\n  \"enrollmentCode\": \"nxhl5hq\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA2ODg5NDA1OTgx\",\n  \"teacherGroupEmail\": \"10_Yoga_A_teachers_811fa6cc@schooltimes.ca\",\n  \"courseGroupEmail\": \"10_Yoga_A_63c99de4@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDfjVzTmYySW9QalNrWm5TSVVfNlBXdnpXREFfZTR3UHh3U2NXMFFseXJjSnc\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-05-28 17:58:54',	'2020-05-28 17:58:54',	NULL),
(18,	11,	'A',	2,	'108979418827',	'https://classroom.google.com/c/MTA4OTc5NDE4ODI3',	'{\n  \"id\": \"108979418827\",\n  \"name\": \"11 Physics\",\n  \"section\": \"A\",\n  \"ownerId\": \"107006297583859314153\",\n  \"creationTime\": \"2020-06-04T16:44:45.496Z\",\n  \"updateTime\": \"2020-06-04T16:44:44.606Z\",\n  \"enrollmentCode\": \"kzjzbps\",\n  \"courseState\": \"ACTIVE\",\n  \"alternateLink\": \"https://classroom.google.com/c/MTA4OTc5NDE4ODI3\",\n  \"teacherGroupEmail\": \"11_Physics_A_teachers_61115f8b@schooltimes.ca\",\n  \"courseGroupEmail\": \"11_Physics_A_ceb47f6a@schooltimes.ca\",\n  \"teacherFolder\": {\n    \"id\": \"0B1PJCsTHXLeDflhfaU9XNzdoRWRQVkYzNDd4eXJrcnR5d1U3UGxCY0JHRWRjdmhsczRnQXM\"\n  },\n  \"guardiansEnabled\": false\n}\n',	NULL,	'2020-06-04 16:44:49',	'2020-06-04 16:44:49',	NULL);

CREATE TABLE `tbl_student_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

TRUNCATE `tbl_student_subjects`;
INSERT INTO `tbl_student_subjects` (`id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1,	'English',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(2,	'Physics',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(3,	'Geography',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(4,	'Meditation',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(5,	'Lunch',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(6,	'Chemistry',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(7,	'Games',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(8,	'Maths',	'2020-04-28 10:13:22',	'2020-04-28 10:13:22'),
(9,	'Science',	'2020-04-28 10:14:31',	'2020-04-28 10:14:31'),
(10,	'Social Science',	'2020-04-28 10:14:31',	'2020-04-28 10:14:31'),
(11,	'PT',	'2020-04-28 10:14:31',	'2020-04-28 10:14:31'),
(12,	'History',	'2020-04-28 10:14:31',	'2020-04-28 10:14:31'),
(13,	'P.ed',	'2020-04-28 10:14:31',	'2020-04-28 10:14:31'),
(14,	'Yoga',	'2020-05-14 21:18:42',	'2020-05-14 21:18:42'),
(15,	'Hindi',	'2020-05-14 21:18:47',	'2020-05-14 21:18:47');

CREATE TABLE `tbl_support_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `help_type` smallint(2) NOT NULL COMMENT '1=>Generic, 2=>Specific Class',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `class_join_link` text,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '1=>Pending, 2=>In Progress, 3=>Closed',
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

TRUNCATE `tbl_support_help`;
INSERT INTO `tbl_support_help` (`id`, `teacher_id`, `help_type`, `description`, `class_join_link`, `class_id`, `subject_id`, `status`, `read_status`, `created_at`, `updated_at`) VALUES
(1,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-02 04:48:54',	'2020-06-02 04:48:54'),
(2,	12,	1,	'This is another help ticket',	NULL,	NULL,	NULL,	3,	1,	'2020-06-02 04:48:52',	'2020-06-02 04:48:52'),
(3,	16,	2,	NULL,	'https://meet.google.com/hyi-vtjc-smx',	13,	12,	3,	1,	'2020-06-02 10:27:31',	'2020-06-02 10:27:31'),
(4,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-04 06:02:42',	'2020-06-04 06:02:42'),
(5,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-04 06:02:43',	'2020-06-04 06:02:43'),
(6,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-04 06:02:41',	'2020-06-04 06:02:41'),
(7,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:46',	'2020-06-06 03:16:46'),
(8,	12,	1,	'I need help regarding...',	NULL,	NULL,	NULL,	3,	1,	'2020-06-06 03:16:45',	'2020-06-06 03:16:45'),
(9,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:41',	'2020-06-06 03:16:41'),
(10,	12,	1,	'Custom help..\nI need help',	NULL,	NULL,	NULL,	3,	1,	'2020-06-06 03:16:40',	'2020-06-06 03:16:40'),
(11,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:39',	'2020-06-06 03:16:39'),
(12,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:36',	'2020-06-06 03:16:36'),
(13,	12,	1,	'My PC is showing some error message. Please help',	NULL,	NULL,	NULL,	3,	1,	'2020-06-06 03:16:34',	'2020-06-06 03:16:34'),
(14,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:32',	'2020-06-06 03:16:32'),
(15,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:30',	'2020-06-06 03:16:30'),
(16,	12,	1,	'How to give assignment..',	NULL,	NULL,	NULL,	3,	1,	'2020-06-06 03:16:28',	'2020-06-06 03:16:28'),
(17,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:26',	'2020-06-06 03:16:26'),
(18,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	3,	1,	'2020-06-06 03:16:25',	'2020-06-06 03:16:25'),
(19,	12,	2,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	9,	1,	1,	1,	'2020-06-06 03:51:12',	'2020-06-06 03:51:12');

CREATE TABLE `tbl_techers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_pin` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_customer_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_response` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_meet_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_meet_datetime` datetime DEFAULT NULL,
  `hasToken` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_techers`;
INSERT INTO `tbl_techers` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `pincode`, `login_pin`, `g_user_id`, `g_customer_id`, `g_response`, `created_at`, `updated_at`, `deleted_at`, `photo`, `g_meet_url`, `g_meet_datetime`, `hasToken`) VALUES
(11,	'Kalpana Sharma',	'kalpana.sharma@schooltimes.ca',	'1000000001',	NULL,	NULL,	NULL,	NULL,	NULL,	'102984611866894009700',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"102984611866894009700\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/To8s1BkG1cH0gIc0H_0aNo6WA8s\\\"\",\n  \"primaryEmail\": \"kalpana.sharma@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Kalpana Sharma\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Kalpana Sharma\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:03.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:04',	'2020-05-28 18:04:57',	NULL,	NULL,	'https://meet.google.com/sor-iyip-kxk',	'2018-05-20 18:04:57',	NULL),
(12,	'Mayank Agarwal',	'mayank.agarwal@schooltimes.ca',	'1000000002',	NULL,	NULL,	NULL,	NULL,	NULL,	'114294579778068704244',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"114294579778068704244\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/FCLCPdbfU2sR5zgbRtskCU0Thxk\\\"\",\n  \"primaryEmail\": \"mayank.agarwal@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Mayank Agarwal\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Mayank Agarwal\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:04.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:05',	'2020-05-28 18:06:14',	NULL,	NULL,	'https://meet.google.com/bcf-mmro-ybc',	'2018-05-20 18:06:14',	NULL),
(13,	'Paras Rawat',	'paras.rawat@schooltimes.ca',	'1000000003',	NULL,	NULL,	NULL,	NULL,	NULL,	'106914614777229701733',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"106914614777229701733\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/dlV-rOtSt1LOu8zGi0uRXBq-szw\\\"\",\n  \"primaryEmail\": \"paras.rawat@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Paras Rawat\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Paras Rawat\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:06.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:07',	'2020-05-28 18:06:44',	NULL,	NULL,	'https://meet.google.com/ews-obuo-qxi',	'2018-05-20 18:06:44',	NULL),
(14,	'Mansi Singh',	'mansi.singh@schooltimes.ca',	'1000000004',	NULL,	NULL,	NULL,	NULL,	NULL,	'106933959095212259582',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"106933959095212259582\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/ATrbq8J1xyhVcmYot4QKGX49Qlg\\\"\",\n  \"primaryEmail\": \"mansi.singh@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Mansi Singh\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Mansi Singh\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:07.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:08',	'2020-05-28 18:05:47',	NULL,	NULL,	'https://meet.google.com/tkz-rgwy-rmn',	'2018-05-20 18:05:47',	NULL),
(15,	'Aman Rai',	'aman.rai@schooltimes.ca',	'1000000005',	NULL,	NULL,	NULL,	NULL,	NULL,	'101804326768083085902',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"101804326768083085902\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/Qfx1VF12XreVgxJMMLr_rW63RB0\\\"\",\n  \"primaryEmail\": \"aman.rai@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Aman Rai\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Aman Rai\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:09.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:09',	'2020-05-30 11:58:40',	NULL,	NULL,	'https://meet.google.com/nzg-fwha-jcd',	'2018-05-20 18:03:07',	'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWIxZGUzN2FkZjc2MDkxOTAwYjAxMmJlYmNiZWZlMzlmY2I2NjY1ZjdkNmRlYzY0NzNkZWVlMjlmNDQwYzU1NGJhZDZiOGQ5YjY1OWQ0MDIiLCJpYXQiOjE1OTA4MjAxMjAsIm5iZiI6MTU5MDgyMDEyMCwiZXhwIjoxNjIyMzU2MTIwLCJzdWIiOiIxNSIsInNjb3BlcyI6W119.CQOWjrXvj4lK3k4VF6374wSNA6CpbfmldQEmYO0dUD4SA7BuoIfVObl4GRE2Iu3jqFOwZwEruhV_Yj0iyWVNmjYoBuEzkP8_8KkhLjp9umivdNlrqbTB1q8c8sdQBZbahzR84Jn7_aeWVNmTH_oxXlhBILss4cZrwRI4ueSSaTVawdJ9T-OCyaSfsE8RZBx2YC3A9RPp8fctGruEPqi_qp7FTM3S6zLMK_Ouk7LCZPLBfrQhuSPxpvZ7Gbfp53GWNI07VlkqlDeEYZodZP5G_FUJd1jD9NiyYh0eR2XLeG5nBXLTt5FoviecsMkBwrmaCEllFmC04Q-FwIpTQUHZmBCyocE0bWE12vlW2S6hUr2IFP4taPey8dTwSkAHVi5LG2VsGxS95MEulyqJpkb4ZjNYU_vPInM8YNr0wizOlY0AESWPCFg9SO-gmDgnGmmRvNcGDbhO-rc8PBeeOsrI2-ZIZraPvc7ytAdW-j5ToSIRVB6gAxszBQYKd_3kzJi6q2tsvpUSeFHDNooKyhB8-hv1kgNjIWadJrNZQuVTT_Y8PaQVgkcv--qds81UoTsaQfyTjYpPS4Ddinh-v11f-1aQAqFSY2ya_20ivpKLVcg99CImJSTgYOUAp9fiPelXLFMqE3qVffSbguMLrlxh8MmgvD4v28kXIjm9FJKjsf4'),
(16,	'Inder Singh',	'inder.singh@schooltimes.ca',	'1000000006',	NULL,	NULL,	NULL,	NULL,	NULL,	'106299913580690519904',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"106299913580690519904\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/DYzUKVC563If7S410FKFZrJMRKw\\\"\",\n  \"primaryEmail\": \"inder.singh@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Inder Singh\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Inder Singh\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:10.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:11',	'2020-05-28 18:04:34',	NULL,	NULL,	'https://meet.google.com/hyi-vtjc-smx',	'2018-05-20 18:04:34',	NULL),
(17,	'Amitabh Bhattacharya',	'amitabh.bhattacharya@schooltimes.ca',	'1000000007',	NULL,	NULL,	NULL,	NULL,	NULL,	'102635272505109835636',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"102635272505109835636\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/fsu5mktPmJpNqQ_LFM1d8C8BEQU\\\"\",\n  \"primaryEmail\": \"amitabh.bhattacharya@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Amitabh Bhattacharya\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Amitabh Bhattacharya\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:12.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:12',	'2020-05-28 18:03:42',	NULL,	NULL,	'https://meet.google.com/pmc-rose-ugz',	'2018-05-20 18:03:42',	NULL),
(18,	'Kartik Jana',	'kartik.jana@schooltimes.ca',	'1000000008',	NULL,	NULL,	NULL,	NULL,	NULL,	'115522988982434298350',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"115522988982434298350\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/uOzP08jlc2fxibGRa51nu-A3RbA\\\"\",\n  \"primaryEmail\": \"kartik.jana@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Kartik Jana\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Kartik Jana\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:13.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:14',	'2020-05-28 18:05:21',	NULL,	NULL,	'https://meet.google.com/oan-pvjk-kbw',	'2018-05-20 18:05:21',	NULL),
(19,	'Amod Rai',	'amod.rai@schooltimes.ca',	'1000000009',	NULL,	NULL,	NULL,	NULL,	NULL,	'108904672859014037837',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"108904672859014037837\",\n  \"etag\": \"\\\"X0UKJVagtcnBZ6purFZX_GkNaNawDeZYhPi9eVX3-74/TiBor2WZ2HAV31qO824echypEHM\\\"\",\n  \"primaryEmail\": \"amod.rai@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Amod Rai\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Amod Rai\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-28T12:23:14.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-05-28 17:53:15',	'2020-05-28 18:04:05',	NULL,	NULL,	'https://meet.google.com/ekg-evnw-smc',	'2018-05-20 18:04:05',	NULL),
(21,	'Teacher test',	'yourname@schooltimes.ca',	'1231231234',	NULL,	NULL,	NULL,	NULL,	NULL,	'107804542847143567851',	'C02u39nnd',	'{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"107804542847143567851\",\n  \"etag\": \"\\\"72EAMGD2sPd-b5bHRHGOJnvjt22gPNAZB5SFZN2hSBU/kHBFWnpyLu8BmiXAu3KM-tMNR3g\\\"\",\n  \"primaryEmail\": \"yourname@schooltimes.ca\",\n  \"name\": {\n    \"givenName\": \"Teacher test\",\n    \"familyName\": \"Teacher\",\n    \"fullName\": \"Teacher test\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-06-06T10:51:03.000Z\",\n  \"customerId\": \"C02u39nnd\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"developer@schooltimes.ca\"\n}\n',	'2020-06-06 10:51:03',	'2020-06-06 10:51:03',	NULL,	NULL,	NULL,	NULL,	NULL);

CREATE TABLE `tbl_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topicname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `g_topic_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `tbl_topics`;
INSERT INTO `tbl_topics` (`id`, `topicname`, `class_id`, `g_topic_id`, `created_at`, `updated_at`) VALUES
(1,	'English Grammar 1',	9,	'107158584066',	'2020-05-29 10:47:16',	'2020-05-29 10:47:16'),
(2,	'English Grammar 2',	9,	'107109047010',	'2020-05-29 11:26:34',	'2020-05-29 11:26:34'),
(3,	'English Grammar 3',	9,	'107534416201',	'2020-05-31 06:49:30',	'2020-05-31 06:49:30'),
(4,	'English Grammar 4',	9,	'107538620538',	'2020-05-31 07:35:38',	'2020-05-31 07:35:38'),
(5,	'English Grammar 5',	9,	'107538517842',	'2020-05-31 07:36:13',	'2020-05-31 07:36:13'),
(6,	'History Assignment 1',	13,	'108038321900',	'2020-06-02 05:03:31',	'2020-06-02 05:03:31'),
(7,	'History Assignment 2',	13,	'108040030809',	'2020-06-02 05:09:39',	'2020-06-02 05:09:39'),
(8,	'ngfn',	9,	'108051444484',	'2020-06-02 06:22:54',	'2020-06-02 06:22:54'),
(9,	'ng',	9,	'108031951670',	'2020-06-02 06:23:22',	'2020-06-02 06:23:22'),
(10,	'fas',	9,	'108051808488',	'2020-06-02 06:25:53',	'2020-06-02 06:25:53'),
(11,	'Assignment for English',	9,	'108136184959',	'2020-06-02 10:44:22',	'2020-06-02 10:44:22'),
(12,	'English Grammar 6',	9,	'108502196202',	'2020-06-03 05:44:45',	'2020-06-03 05:44:45'),
(13,	'English Grammar 7',	9,	'108543812365',	'2020-06-03 09:46:42',	'2020-06-03 09:46:42'),
(14,	'English Grammar 8',	9,	'108571440257',	'2020-06-03 11:45:43',	'2020-06-03 11:45:43'),
(15,	'English Grammar 11',	9,	'108845334885',	'2020-06-04 07:08:59',	'2020-06-04 07:08:59'),
(16,	'English Grammar 13',	9,	'108870764809',	'2020-06-04 09:46:39',	'2020-06-04 09:46:39'),
(17,	'English Grammar 15',	9,	'108973453386',	'2020-06-04 16:59:33',	'2020-06-04 16:59:33'),
(18,	'English Grammar 20',	9,	'109123231342',	'2020-06-05 05:49:44',	'2020-06-05 05:49:44'),
(19,	'English Grammar 30',	9,	'109101529112',	'2020-06-05 05:58:23',	'2020-06-05 05:58:23'),
(20,	'English Grammar 31',	9,	'109146318449',	'2020-06-05 08:38:47',	'2020-06-05 08:38:47'),
(21,	'English Grammar 123',	9,	'109188734319',	'2020-06-05 13:44:40',	'2020-06-05 13:44:40'),
(22,	'English Grammar 132',	9,	'109335156179',	'2020-06-06 03:49:03',	'2020-06-06 03:49:03');

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `users`;

-- 2020-06-06 11:18:01
