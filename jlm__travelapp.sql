-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2017 at 11:18 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jlm__travelapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_classes`
--

CREATE TABLE `acl_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_entries`
--

CREATE TABLE `acl_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `object_identity_id` int(10) UNSIGNED DEFAULT NULL,
  `security_identity_id` int(10) UNSIGNED NOT NULL,
  `field_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ace_order` smallint(5) UNSIGNED NOT NULL,
  `mask` int(11) NOT NULL,
  `granting` tinyint(1) NOT NULL,
  `granting_strategy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `audit_success` tinyint(1) NOT NULL,
  `audit_failure` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_object_identities`
--

CREATE TABLE `acl_object_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_object_identity_id` int(10) UNSIGNED DEFAULT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `object_identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entries_inheriting` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_object_identity_ancestors`
--

CREATE TABLE `acl_object_identity_ancestors` (
  `object_identity_id` int(10) UNSIGNED NOT NULL,
  `ancestor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_security_identities`
--

CREATE TABLE `acl_security_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fos_user_group`
--

CREATE TABLE `fos_user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fos_user_group`
--

INSERT INTO `fos_user_group` (`id`, `name`, `roles`) VALUES
(1, 'Travel Agent', 'a:1:{i:0;s:17:"ROLE_SONATA_ADMIN";}');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user_user`
--

CREATE TABLE `fos_user_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_code` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_date` datetime DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT NULL,
  `telephone_number` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fos_user_user`
--

INSERT INTO `fos_user_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`, `access_code`, `activated_date`, `profile_picture_id`, `telephone_number`) VALUES
(1, 'admin', 'admin', 'jerick.duguran@gmail.com', 'jerick.duguran@gmail.com', 1, '39zwypgj33wg8csk4so8goksgg00wg8', '3QwTU8ZgoKiELXX2PGRqD+5N6n+LOneE4EDNDdlynMOQU1GjeYRNcj9pTiFKa8U1bXMTqqvYtppJNQ3wvUhV0A==', '2016-04-16 00:24:45', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '2016-02-19 12:01:50', '2016-04-16 00:24:45', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'travelagent1', 'travelagent1', 'travelagent1@traveelapp.com', 'travelagent1@traveelapp.com', 1, 'lofh5zzghdwkg0sswsgggws8gk8ogs4', 'EblCfZjMJUJZ4brkEk1R09Gp5S6FmeATtZDkv+oYMPvbOHgDqjr1bmj+/Q3X/MdyEVS5FtQbTVG9fqZvvi5L1Q==', '2016-02-20 20:12:51', 0, 0, NULL, NULL, NULL, 'a:9:{i:0;s:17:"ROLE_SONATA_ADMIN";i:1;s:10:"ROLE_ADMIN";i:2;s:24:"ROLE_APP_ADMIN_FLIGHT_ID";i:3;s:34:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_ID";i:4;s:33:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_ID";i:5;s:26:"ROLE_APP_ADMIN_TRAVELER_ID";i:6;s:16:"ROLE_SUPER_ADMIN";i:7;s:6:"SONATA";i:8;s:0:"";}', 0, NULL, '2016-02-20 09:11:32', '2016-02-26 22:04:40', '1987-01-23 00:00:00', 'John', 'Lapus', NULL, NULL, 'm', 'en_PH', 'Asia/Manila', '09178947300', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, '21455974726', NULL, 2, '9124-4215'),
(3, 'travelagent2', 'travelagent2', 'travelagent2@yahoo.com', 'travelagent2@yahoo.com', 1, 'lj5t5hd0o5cw8gw8o0owgsgooc0k4w4', '9c4t80GQqbdZPRog+y/c/TSmeguc8v94MP7RoJlVeWxA9mec2vzS3Eymd8mnvgaRAoigJMjTVWEEt9lQLAffCg==', NULL, 0, 0, NULL, NULL, NULL, 'a:4:{i:0;s:24:"ROLE_APP_ADMIN_FLIGHT_ID";i:1;s:34:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_ID";i:2;s:33:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_ID";i:3;s:26:"ROLE_APP_ADMIN_TRAVELER_ID";}', 0, NULL, '2016-02-20 21:26:50', '2016-02-26 22:05:01', '2016-02-18 00:00:00', 'Angelo', 'Palmones', NULL, NULL, 'm', NULL, NULL, '098812312312321', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, '1455974810', NULL, 4, '551-24122'),
(4, 'jerick', 'jerick', 'test@yahoo.com', 'test@yahoo.com', 1, 'ci2un83uvlwkw88cs44ksko0w84gsw0', 'dItrZR79lO5ivPT5vY3Ge0tJ441NvWB7ARHONTTpZOclHEMJUxS3PDYqLLoyIrj70/jN9jNDvu65N4qycoA4SQ==', '2016-02-28 21:51:12', 0, 0, NULL, NULL, NULL, 'a:41:{i:0;s:26:"ROLE_APP_ADMIN_FLIGHT_EDIT";i:1;s:26:"ROLE_APP_ADMIN_FLIGHT_LIST";i:2;s:28:"ROLE_APP_ADMIN_FLIGHT_CREATE";i:3;s:26:"ROLE_APP_ADMIN_FLIGHT_VIEW";i:4;s:28:"ROLE_APP_ADMIN_FLIGHT_DELETE";i:5;s:28:"ROLE_APP_ADMIN_FLIGHT_EXPORT";i:6;s:30:"ROLE_APP_ADMIN_FLIGHT_OPERATOR";i:7;s:28:"ROLE_APP_ADMIN_FLIGHT_MASTER";i:8;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_EDIT";i:9;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_LIST";i:10;s:38:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_CREATE";i:11;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_VIEW";i:12;s:38:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_DELETE";i:13;s:38:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_EXPORT";i:14;s:40:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_OPERATOR";i:15;s:38:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_MASTER";i:16;s:37:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_EDIT";i:17;s:37:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_LIST";i:18;s:39:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_CREATE";i:19;s:37:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_VIEW";i:20;s:39:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_DELETE";i:21;s:39:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_EXPORT";i:22;s:41:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_OPERATOR";i:23;s:39:"ROLE_APP_ADMIN_FLIGHT_CONNECTING_MASTER";i:24;s:35:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_EDIT";i:25;s:35:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_LIST";i:26;s:37:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_CREATE";i:27;s:35:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_VIEW";i:28;s:37:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_DELETE";i:29;s:37:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_EXPORT";i:30;s:39:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_OPERATOR";i:31;s:37:"ROLE_APP_ADMIN_FLIGHT_TRAVELER_MASTER";i:32;s:28:"ROLE_APP_ADMIN_TRAVELER_EDIT";i:33;s:28:"ROLE_APP_ADMIN_TRAVELER_LIST";i:34;s:30:"ROLE_APP_ADMIN_TRAVELER_CREATE";i:35;s:28:"ROLE_APP_ADMIN_TRAVELER_VIEW";i:36;s:30:"ROLE_APP_ADMIN_TRAVELER_DELETE";i:37;s:30:"ROLE_APP_ADMIN_TRAVELER_EXPORT";i:38;s:32:"ROLE_APP_ADMIN_TRAVELER_OPERATOR";i:39;s:30:"ROLE_APP_ADMIN_TRAVELER_MASTER";i:40;s:17:"ROLE_SONATA_ADMIN";}', 0, NULL, '2016-02-28 19:57:21', '2016-02-28 21:51:12', '2016-02-17 00:00:00', 'Jericks', 'Dugurans', NULL, NULL, 'm', NULL, NULL, '091247211232', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, '1456660640', NULL, NULL, '0912512312332213'),
(5, 'manny', 'manny', 'manny@yahoo.com', 'manny@yahoo.com', 1, '9yp6clgg2igw48s44sk0sgsoosow8sg', 'wwZKdK0FROPte3K6SRzyVoACpg+NpDoW0T0vOg1zJXuIyTSPZBl6sggkz7Zjrb3Wt5Nhr/bB+TCE197JLjZuww==', NULL, 0, 0, NULL, NULL, NULL, 'a:12:{i:0;s:26:"ROLE_APP_ADMIN_FLIGHT_EDIT";i:1;s:26:"ROLE_APP_ADMIN_FLIGHT_LIST";i:2;s:28:"ROLE_APP_ADMIN_FLIGHT_CREATE";i:3;s:26:"ROLE_APP_ADMIN_FLIGHT_VIEW";i:4;s:28:"ROLE_APP_ADMIN_FLIGHT_DELETE";i:5;s:28:"ROLE_APP_ADMIN_FLIGHT_EXPORT";i:6;s:30:"ROLE_APP_ADMIN_FLIGHT_OPERATOR";i:7;s:28:"ROLE_APP_ADMIN_FLIGHT_MASTER";i:8;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_EDIT";i:9;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_LIST";i:10;s:38:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_CREATE";i:11;s:17:"ROLE_SONATA_ADMIN";}', 0, NULL, '2016-02-28 22:25:44', '2016-02-28 22:25:44', '2016-02-17 00:00:00', 'Manny', 'Pacquiao', NULL, NULL, 'm', NULL, NULL, '097676568', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, '1456669544', NULL, NULL, '09124213'),
(6, 'hehe', 'hehe', 'hehe@yahoo.com', 'hehe@yahoo.com', 1, '4fayguw1lv6s40gkww4wkk4sckssw4g', 'a6VkBR7lzFzJ6gpdSkji4a8+8/syurvRrzZUpyQXEQsnZq3B+VveVaHbxNLtx1TWrjzIIG25EsbCV5fw8mvPlA==', NULL, 0, 0, NULL, NULL, NULL, 'a:7:{i:0;s:26:"ROLE_APP_ADMIN_FLIGHT_VIEW";i:1;s:28:"ROLE_APP_ADMIN_FLIGHT_DELETE";i:2;s:28:"ROLE_APP_ADMIN_FLIGHT_EXPORT";i:3;s:30:"ROLE_APP_ADMIN_FLIGHT_OPERATOR";i:4;s:28:"ROLE_APP_ADMIN_FLIGHT_MASTER";i:5;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_EDIT";i:6;s:36:"ROLE_APP_ADMIN_FLIGHT_ITINERARY_LIST";}', 0, NULL, '2016-02-28 22:26:55', '2016-02-28 22:26:55', '2016-02-24 00:00:00', 'tes', 'serserser', NULL, NULL, 'm', NULL, NULL, '123123123', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, '1456669615', NULL, NULL, '123213');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user_user_group`
--

CREATE TABLE `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jlm__flight`
--

CREATE TABLE `jlm__flight` (
  `id` int(11) NOT NULL,
  `origin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `origin_departure_schedule` datetime DEFAULT NULL,
  `destination_arrival_schedule` datetime DEFAULT NULL,
  `destination_departure_schedule` datetime DEFAULT NULL,
  `origin_arrival_schedule` datetime DEFAULT NULL,
  `origin_departure_calendar_note` longtext COLLATE utf8_unicode_ci,
  `destination_departure_calendar_note` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `travel_agent_id` int(11) DEFAULT NULL,
  `origin_timezone` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `destination_timezone` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__flight`
--

INSERT INTO `jlm__flight` (`id`, `origin`, `destination`, `origin_departure_schedule`, `destination_arrival_schedule`, `destination_departure_schedule`, `origin_arrival_schedule`, `origin_departure_calendar_note`, `destination_departure_calendar_note`, `created_at`, `updated_at`, `title`, `travel_agent_id`, `origin_timezone`, `destination_timezone`) VALUES
(1, 'Manila', 'Bangkok', '2016-02-19 16:32:38', '2016-02-03 16:32:35', '2016-02-19 16:32:39', '2016-04-20 16:32:43', 'test', 'test', '2016-02-20 16:33:21', '2016-02-25 15:22:18', 'Manila to Bangkok', 2, 'Asia/Manila', 'Asia/Tokyo'),
(2, 'Manila City', 'Naguya Japan', '2016-02-21 00:23:16', '2016-02-25 00:23:24', '2016-02-29 07:23:30', '2016-02-29 00:23:35', 'You have more time to check sir', 'Opps let go!', '2016-02-21 00:23:19', '2016-02-21 00:24:03', 'Manila City to Naguya Japan', 2, '', ''),
(3, 'Manila', 'Cebu', '2016-02-29 21:38:02', '2016-03-10 21:38:07', '2016-03-09 21:30:12', '2016-03-31 21:38:17', 'test', 'testst', '2016-02-28 21:38:35', '2016-02-28 21:50:53', 'Manila to Cebu', 4, 'Asia/Manila', 'Asia/Manila'),
(4, 'Manila', 'Davao', '2016-03-14 21:53:36', '2016-04-13 21:53:46', '2016-03-30 21:53:51', '2016-04-20 21:53:55', 'werrwer', 'werwe', '2016-02-28 21:54:11', '2016-02-28 21:54:11', 'Manila to Davao', 4, 'Atlantic/Faroe', 'Pacific/Wallis');

-- --------------------------------------------------------

--
-- Table structure for table `jlm__flight_connecting`
--

CREATE TABLE `jlm__flight_connecting` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `destination` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_schedule` datetime NOT NULL,
  `calendar_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__flight_connecting`
--

INSERT INTO `jlm__flight_connecting` (`id`, `flight_id`, `destination`, `arrival_schedule`, `calendar_note`, `created_at`, `updated_at`, `type`, `timezone`) VALUES
(1, 1, 'Taiwan', '2016-02-28 05:29:24', 'Daan pa ng Taiwan', '2016-02-26 22:29:50', '2016-04-05 22:28:15', 'TO', 'America/Godthab'),
(2, 1, 'Bangkok', '2016-02-26 17:55:31', 'Test eresr', '2016-02-26 21:55:37', '2016-02-26 23:55:38', 'TO', 'America/Godthab');

-- --------------------------------------------------------

--
-- Table structure for table `jlm__flight_itinerary`
--

CREATE TABLE `jlm__flight_itinerary` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule` datetime NOT NULL,
  `activity` longtext COLLATE utf8_unicode_ci,
  `calendar_note` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `timezone` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__flight_itinerary`
--

INSERT INTO `jlm__flight_itinerary` (`id`, `flight_id`, `title`, `schedule`, `activity`, `calendar_note`, `created_at`, `updated_at`, `timezone`) VALUES
(1, 1, 'Pickup at Hotel', '2016-02-20 09:11:49', 'Pick data here', 'please proceed', '2016-02-20 17:12:17', '2016-04-05 22:28:10', 'Asia/Kashgar');

-- --------------------------------------------------------

--
-- Table structure for table `jlm__flight_traveler`
--

CREATE TABLE `jlm__flight_traveler` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `traveler_id` int(11) DEFAULT NULL,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__flight_traveler`
--

INSERT INTO `jlm__flight_traveler` (`id`, `flight_id`, `traveler_id`, `code`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '121455968845', '2016-02-20 19:47:25', '2016-02-20 19:47:25'),
(3, 1, 1, '111455968874', '2016-02-20 19:47:54', '2016-02-20 19:47:54'),
(4, 2, 1, '11455985482', '2016-02-21 00:24:42', '2016-02-21 00:24:42'),
(5, 2, 2, '21455985491', '2016-02-21 00:24:51', '2016-02-21 00:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `jlm__promo`
--

CREATE TABLE `jlm__promo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `promo_main_image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__promo`
--

INSERT INTO `jlm__promo` (`id`, `title`, `enabled`, `created_at`, `updated_at`, `promo_main_image_id`) VALUES
(1, 'First Promo', 1, '2016-03-15 01:26:09', '2016-03-15 01:26:09', 7);

-- --------------------------------------------------------

--
-- Table structure for table `jlm__promo_support`
--

CREATE TABLE `jlm__promo_support` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `promo_sub_image_id` int(11) DEFAULT NULL,
  `promo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__promo_support`
--

INSERT INTO `jlm__promo_support` (`id`, `title`, `enabled`, `created_at`, `updated_at`, `promo_sub_image_id`, `promo_id`) VALUES
(1, 'Child Promo', 1, '2016-03-15 01:32:34', '2016-03-15 01:32:34', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jlm__rate`
--

CREATE TABLE `jlm__rate` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) DEFAULT NULL,
  `rating_date` datetime DEFAULT NULL,
  `hotel` double DEFAULT NULL,
  `food` double DEFAULT NULL,
  `tour` double DEFAULT NULL,
  `travelEscort` double DEFAULT NULL,
  `tourGuide` double DEFAULT NULL,
  `localGuide` double DEFAULT NULL,
  `tourBus` double DEFAULT NULL,
  `service` double DEFAULT NULL,
  `travelerName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__rate`
--

INSERT INTO `jlm__rate` (`id`, `travel_id`, `rating_date`, `hotel`, `food`, `tour`, `travelEscort`, `tourGuide`, `localGuide`, `tourBus`, `service`, `travelerName`, `created_at`, `updated_at`, `comment`) VALUES
(1, 1, '2016-04-13 05:50:35', 1, 2, 3, 4, 5, 6, 7, 8, 'Mary Aann Altar', '2016-04-13 23:23:58', '2016-04-16 00:30:56', 'test'),
(2, 1, '2016-04-15 00:00:00', 5, 2, 3, 4, 5, 6, 5, 4, 'Mary Ann Altar', '2016-04-14 00:17:10', '2016-04-14 00:17:10', NULL),
(3, 1, '2016-04-15 00:00:00', 5, 2, 3, 4, 5, 6, 5, 4, 'Mary Ann Altar', '2016-04-14 00:17:32', '2016-04-14 00:17:32', NULL),
(4, 1, '2016-04-15 00:00:00', 1, 2, 3, 4, 5, 6, 5, 4, 'Mary Ann Altar', '2016-04-16 00:34:54', '2016-04-16 00:34:54', 'Hello There best');

-- --------------------------------------------------------

--
-- Table structure for table `jlm__traveler`
--

CREATE TABLE `jlm__traveler` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `travel_agent_id` int(11) DEFAULT NULL,
  `contact_number` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone_number` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jlm__traveler`
--

INSERT INTO `jlm__traveler` (`id`, `first_name`, `last_name`, `gender`, `birthdate`, `created_at`, `updated_at`, `travel_agent_id`, `contact_number`, `email`, `telephone_number`, `profile_picture_id`) VALUES
(1, 'Mary Ann', 'Altar', 'FEMALE', '1987-03-22', '2016-02-20 19:09:52', '2016-02-26 22:10:38', 2, '0912314123', 'meann@yahoo.com', '897215123123', 6),
(2, 'Ferdinand', 'Magellan', 'MALE', '2016-02-19', '2016-02-20 19:38:35', '2016-02-26 22:07:29', 2, '0965214213', 'ferdie@yahoo.com', '978212152', 5);

-- --------------------------------------------------------

--
-- Table structure for table `media__gallery`
--

CREATE TABLE `media__gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media__gallery_media`
--

CREATE TABLE `media__gallery_media` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media__media`
--

CREATE TABLE `media__media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media__media`
--

INSERT INTO `media__media` (`id`, `name`, `description`, `enabled`, `provider_name`, `provider_status`, `provider_reference`, `provider_metadata`, `width`, `height`, `length`, `content_type`, `content_size`, `copyright`, `author_name`, `context`, `cdn_is_flushable`, `cdn_flush_at`, `cdn_status`, `updated_at`, `created_at`) VALUES
(1, 'Wedding-Invitation-Card-Template.jpg', NULL, 0, 'sonata.media.provider.image', 1, '3859552467281d856a967f6e6104bdf1d79c9be1.jpeg', '{"filename":"Wedding-Invitation-Card-Template.jpg"}', 643, 460, NULL, 'image/jpeg', 84773, NULL, NULL, 'profile', NULL, NULL, NULL, '2016-02-25 17:31:48', '2016-02-25 17:31:48'),
(2, 'Wedding-Invitation-Card-Template.jpg', NULL, 0, 'sonata.media.provider.image', 1, '765822a6d69f9a0584ea5a6138009326ea748cee.jpeg', '{"filename":"Wedding-Invitation-Card-Template.jpg"}', 643, 460, NULL, 'image/jpeg', 84773, NULL, NULL, 'profile', NULL, NULL, NULL, '2016-02-25 17:33:44', '2016-02-25 17:33:44'),
(3, 'wed_lavendar_cherryblsms_blog.jpg', NULL, 0, 'sonata.media.provider.image', 1, '14ec9cfa99a63ca09e5b8dd89197e5f92253f398.jpeg', '{"filename":"wed_lavendar_cherryblsms_blog.jpg"}', 1350, 900, NULL, 'image/jpeg', 948206, NULL, NULL, 'profile', NULL, NULL, NULL, '2016-02-25 17:34:22', '2016-02-25 17:34:22'),
(4, 'download (1).jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e53ba29dd3e6fb856c07527e5c47a5a92fcbc8a2.jpeg', '{"filename":"download (1).jpg"}', 220, 229, NULL, 'image/jpeg', 4652, NULL, NULL, 'profile', NULL, NULL, NULL, '2016-02-26 22:04:53', '2016-02-26 22:04:53'),
(5, 'Shawn_Tok_Profile.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e2e47a405653c34955b3208d807e0a7949634dc6.jpeg', '{"filename":"Shawn_Tok_Profile.jpg"}', 400, 400, NULL, 'image/jpeg', 37867, NULL, NULL, 'profile', NULL, NULL, NULL, '2016-02-26 22:05:30', '2016-02-26 22:05:30'),
(6, 'adam-parker-large.jpg', NULL, 0, 'sonata.media.provider.image', 1, '812654e7f18b520914c2865d937e9b1834220c62.jpeg', '{"filename":"adam-parker-large.jpg"}', 877, 877, NULL, 'image/jpeg', 295246, NULL, NULL, 'profile', NULL, NULL, NULL, '2016-02-26 22:10:35', '2016-02-26 22:10:35'),
(7, 'audit.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'be40ee3ac4c3c74415abead704a588a60e3d6761.jpeg', '{"filename":"audit.jpg"}', 300, 120, NULL, 'image/jpeg', 27911, NULL, NULL, 'promo_main_image', NULL, NULL, NULL, '2016-03-15 01:25:59', '2016-03-15 01:25:59'),
(8, 'banner_choose.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2cb02fa62c49f9a301a260bc9d70c4f09058976e.jpeg', '{"filename":"banner_choose.jpg"}', 981, 252, NULL, 'image/jpeg', 85667, NULL, NULL, 'promo_sub_image', NULL, NULL, NULL, '2016-03-15 01:32:27', '2016-03-15 01:32:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_classes`
--
ALTER TABLE `acl_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_69DD750638A36066` (`class_type`);

--
-- Indexes for table `acl_entries`
--
ALTER TABLE `acl_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4` (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
  ADD KEY `IDX_46C8B806EA000B103D9AB4A6DF9183C9` (`class_id`,`object_identity_id`,`security_identity_id`),
  ADD KEY `IDX_46C8B806EA000B10` (`class_id`),
  ADD KEY `IDX_46C8B8063D9AB4A6` (`object_identity_id`),
  ADD KEY `IDX_46C8B806DF9183C9` (`security_identity_id`);

--
-- Indexes for table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9407E5494B12AD6EA000B10` (`object_identifier`,`class_id`),
  ADD KEY `IDX_9407E54977FA751A` (`parent_object_identity_id`);

--
-- Indexes for table `acl_object_identity_ancestors`
--
ALTER TABLE `acl_object_identity_ancestors`
  ADD PRIMARY KEY (`object_identity_id`,`ancestor_id`),
  ADD KEY `IDX_825DE2993D9AB4A6` (`object_identity_id`),
  ADD KEY `IDX_825DE299C671CEA1` (`ancestor_id`);

--
-- Indexes for table `acl_security_identities`
--
ALTER TABLE `acl_security_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8835EE78772E836AF85E0677` (`identifier`,`username`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos_user_group`
--
ALTER TABLE `fos_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_583D1F3E5E237E06` (`name`);

--
-- Indexes for table `fos_user_user`
--
ALTER TABLE `fos_user_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C560D76192FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_C560D761A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_C560D76181CC569E` (`access_code`),
  ADD KEY `IDX_C560D761292E8AE2` (`profile_picture_id`);

--
-- Indexes for table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `IDX_B3C77447A76ED395` (`user_id`),
  ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- Indexes for table `jlm__flight`
--
ALTER TABLE `jlm__flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9505C2C45E65124E` (`travel_agent_id`);

--
-- Indexes for table `jlm__flight_connecting`
--
ALTER TABLE `jlm__flight_connecting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6AB6744F91F478C5` (`flight_id`);

--
-- Indexes for table `jlm__flight_itinerary`
--
ALTER TABLE `jlm__flight_itinerary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A0CB4B0191F478C5` (`flight_id`);

--
-- Indexes for table `jlm__flight_traveler`
--
ALTER TABLE `jlm__flight_traveler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_84BA0D2F77153098` (`code`),
  ADD KEY `IDX_84BA0D2F91F478C5` (`flight_id`),
  ADD KEY `IDX_84BA0D2F59BBE8A3` (`traveler_id`);

--
-- Indexes for table `jlm__promo`
--
ALTER TABLE `jlm__promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8A82758F67CCB718` (`promo_main_image_id`);

--
-- Indexes for table `jlm__promo_support`
--
ALTER TABLE `jlm__promo_support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_68297FC21F0C0C23` (`promo_sub_image_id`),
  ADD KEY `IDX_68297FC2D0C07AFF` (`promo_id`);

--
-- Indexes for table `jlm__rate`
--
ALTER TABLE `jlm__rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FB528558ECAB15B3` (`travel_id`);

--
-- Indexes for table `jlm__traveler`
--
ALTER TABLE `jlm__traveler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65577E515E65124E` (`travel_agent_id`),
  ADD KEY `IDX_65577E51292E8AE2` (`profile_picture_id`);

--
-- Indexes for table `media__gallery`
--
ALTER TABLE `media__gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  ADD KEY `IDX_80D4C541EA9FDD75` (`media_id`);

--
-- Indexes for table `media__media`
--
ALTER TABLE `media__media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl_classes`
--
ALTER TABLE `acl_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_entries`
--
ALTER TABLE `acl_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_security_identities`
--
ALTER TABLE `acl_security_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fos_user_group`
--
ALTER TABLE `fos_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fos_user_user`
--
ALTER TABLE `fos_user_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jlm__flight`
--
ALTER TABLE `jlm__flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jlm__flight_connecting`
--
ALTER TABLE `jlm__flight_connecting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jlm__flight_itinerary`
--
ALTER TABLE `jlm__flight_itinerary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jlm__flight_traveler`
--
ALTER TABLE `jlm__flight_traveler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jlm__promo`
--
ALTER TABLE `jlm__promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jlm__promo_support`
--
ALTER TABLE `jlm__promo_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jlm__rate`
--
ALTER TABLE `jlm__rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jlm__traveler`
--
ALTER TABLE `jlm__traveler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `media__gallery`
--
ALTER TABLE `media__gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media__media`
--
ALTER TABLE `media__media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_entries`
--
ALTER TABLE `acl_entries`
  ADD CONSTRAINT `FK_46C8B8063D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_46C8B806DF9183C9` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_46C8B806EA000B10` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acl_object_identities`
--
ALTER TABLE `acl_object_identities`
  ADD CONSTRAINT `FK_9407E54977FA751A` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`);

--
-- Constraints for table `acl_object_identity_ancestors`
--
ALTER TABLE `acl_object_identity_ancestors`
  ADD CONSTRAINT `FK_825DE2993D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_825DE299C671CEA1` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fos_user_user`
--
ALTER TABLE `fos_user_user`
  ADD CONSTRAINT `FK_C560D761292E8AE2` FOREIGN KEY (`profile_picture_id`) REFERENCES `media__media` (`id`);

--
-- Constraints for table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_user_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jlm__flight`
--
ALTER TABLE `jlm__flight`
  ADD CONSTRAINT `FK_9505C2C45E65124E` FOREIGN KEY (`travel_agent_id`) REFERENCES `fos_user_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jlm__flight_connecting`
--
ALTER TABLE `jlm__flight_connecting`
  ADD CONSTRAINT `FK_6AB6744F91F478C5` FOREIGN KEY (`flight_id`) REFERENCES `jlm__flight` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jlm__flight_itinerary`
--
ALTER TABLE `jlm__flight_itinerary`
  ADD CONSTRAINT `FK_A0CB4B0191F478C5` FOREIGN KEY (`flight_id`) REFERENCES `jlm__flight` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jlm__flight_traveler`
--
ALTER TABLE `jlm__flight_traveler`
  ADD CONSTRAINT `FK_84BA0D2F59BBE8A3` FOREIGN KEY (`traveler_id`) REFERENCES `jlm__traveler` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_84BA0D2F91F478C5` FOREIGN KEY (`flight_id`) REFERENCES `jlm__flight` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jlm__promo`
--
ALTER TABLE `jlm__promo`
  ADD CONSTRAINT `FK_8A82758F67CCB718` FOREIGN KEY (`promo_main_image_id`) REFERENCES `media__media` (`id`);

--
-- Constraints for table `jlm__promo_support`
--
ALTER TABLE `jlm__promo_support`
  ADD CONSTRAINT `FK_68297FC21F0C0C23` FOREIGN KEY (`promo_sub_image_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_68297FC2D0C07AFF` FOREIGN KEY (`promo_id`) REFERENCES `jlm__promo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jlm__rate`
--
ALTER TABLE `jlm__rate`
  ADD CONSTRAINT `FK_FB528558ECAB15B3` FOREIGN KEY (`travel_id`) REFERENCES `jlm__traveler` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jlm__traveler`
--
ALTER TABLE `jlm__traveler`
  ADD CONSTRAINT `FK_65577E51292E8AE2` FOREIGN KEY (`profile_picture_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_65577E515E65124E` FOREIGN KEY (`travel_agent_id`) REFERENCES `fos_user_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`),
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
