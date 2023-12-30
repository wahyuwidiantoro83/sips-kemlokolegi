-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 10:20 AM
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
-- Database: `sips`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Admin'),
(2, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 6),
(2, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 23),
(2, 26),
(2, 27);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-02-26 06:03:54', 1),
(2, '::1', 'budianto', NULL, '2023-03-02 06:42:56', 0),
(3, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 06:43:21', 1),
(4, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 06:49:56', 1),
(5, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 07:25:48', 1),
(6, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 08:11:35', 1),
(7, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 12:06:56', 1),
(8, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 12:14:51', 1),
(9, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-02 14:26:44', 1),
(10, '::1', 'Budianto83@gmail.com', 3, '2023-03-03 01:35:15', 1),
(11, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-03 02:48:08', 1),
(12, '::1', 'Budianto83@gmail.com', 3, '2023-03-03 03:07:44', 1),
(13, '::1', 'Budianto83@gmail.com', 3, '2023-03-03 03:08:45', 1),
(14, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-03 03:09:20', 1),
(15, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-04 06:09:00', 1),
(16, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-05 06:03:45', 1),
(17, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-05 08:15:17', 1),
(18, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-05 08:19:49', 1),
(19, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-05 14:00:14', 1),
(20, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-05 16:17:46', 1),
(21, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-06 01:25:57', 1),
(22, '::1', 'Budianto83@gmail.com', 3, '2023-03-06 01:28:04', 1),
(23, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-06 04:57:16', 1),
(24, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-06 08:50:13', 1),
(25, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-07 01:49:31', 1),
(26, '::1', 'Budianto83@gmail.com', 3, '2023-03-07 01:51:24', 1),
(27, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-07 01:51:44', 1),
(28, '::1', 'Budianto83@gmail.com', 3, '2023-03-07 07:20:28', 1),
(29, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-07 07:22:24', 1),
(30, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-16 13:53:09', 1),
(31, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-16 14:44:11', 1),
(32, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-17 01:24:35', 1),
(33, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-18 06:08:22', 1),
(34, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-18 06:11:29', 1),
(35, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-18 06:14:18', 1),
(36, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-18 07:30:05', 1),
(37, '::1', 'irma', NULL, '2023-03-19 02:03:08', 0),
(38, '::1', 'hinata@norton.com', 11, '2023-03-19 02:03:18', 1),
(39, '::1', 'hinata@norton.com', 11, '2023-03-19 02:27:49', 1),
(40, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-19 02:28:06', 1),
(41, '::1', '123456789032', NULL, '2023-03-19 06:23:31', 0),
(42, '::1', '123456789032', NULL, '2023-03-19 06:23:42', 0),
(43, '::1', '123456789032', NULL, '2023-03-19 06:32:29', 0),
(44, '::1', 'Budianto83@gmail.com', 3, '2023-03-19 06:32:30', 1),
(45, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-19 06:32:48', 1),
(46, '::1', 'whhyu@gmail.com', NULL, '2023-03-19 06:34:31', 0),
(47, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-19 06:35:41', 1),
(48, '::1', 'budianto89@yahoo.com', NULL, '2023-03-19 06:37:12', 0),
(49, '::1', 'budianto89@yahoo.com', NULL, '2023-03-19 06:37:20', 0),
(50, '::1', 'wahyu', NULL, '2023-03-19 14:15:06', 0),
(51, '::1', 'wahyu', NULL, '2023-03-19 14:15:17', 0),
(52, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-19 14:17:31', 1),
(53, '::1', '123456789032', 17, '2023-03-19 14:37:19', 0),
(54, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-19 14:39:06', 1),
(55, '::1', 'budianto00@gmail.com', 18, '2023-03-19 14:40:32', 1),
(56, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-19 14:40:42', 1),
(57, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-20 14:47:23', 1),
(58, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-21 05:03:45', 1),
(59, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-22 09:57:21', 1),
(60, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-23 04:23:34', 1),
(61, '::1', 'hayati@gmail.com', 22, '2023-03-23 08:44:11', 1),
(62, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-23 08:44:23', 1),
(63, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-24 19:08:37', 1),
(64, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-25 03:07:21', 1),
(65, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-25 06:04:34', 1),
(66, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-25 15:59:31', 1),
(67, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-26 03:56:33', 1),
(68, '::1', 'irma@gmail.com', 4, '2023-03-26 05:32:33', 1),
(69, '::1', 'wahyuwidiantoro83@gmail.com', 2, '2023-03-26 05:32:42', 1),
(70, '::1', 'wahyu', NULL, '2023-03-26 07:00:09', 0),
(71, '::1', 'wahyu', NULL, '2023-03-26 07:00:13', 0),
(72, '::1', 'wahyu', NULL, '2023-03-26 07:00:21', 0),
(73, '::1', 'budianto', NULL, '2023-03-26 07:00:22', 0),
(74, '::1', 'wahyu', 23, '2023-03-26 07:03:35', 0),
(75, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-26 07:04:15', 1),
(76, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-26 09:40:56', 1),
(77, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-26 09:49:07', 1),
(78, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-26 09:52:42', 1),
(79, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-26 10:04:59', 1),
(80, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-26 10:06:23', 1),
(81, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-28 05:03:19', 1),
(82, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-29 06:59:32', 1),
(83, '::1', 'wahyuwahyu@gmail.com', 23, '2023-03-30 07:40:05', 1),
(84, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-02 02:38:38', 1),
(85, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-03 08:20:51', 1),
(86, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 05:58:11', 1),
(87, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 09:51:24', 1),
(88, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 09:55:57', 1),
(89, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-05 09:57:32', 1),
(90, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 09:58:16', 1),
(91, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-05 09:58:27', 1),
(92, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 09:58:47', 1),
(93, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 12:13:28', 1),
(94, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 12:34:44', 1),
(95, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 15:06:36', 1),
(96, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-05 17:50:21', 1),
(97, '::1', 'wahyuwidiantoro83@gmail.com', NULL, '2023-04-05 17:50:35', 0),
(98, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-05 17:50:39', 1),
(99, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-06 01:01:59', 1),
(100, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-06 01:02:14', 1),
(101, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-06 03:53:54', 1),
(102, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-06 03:54:08', 1),
(103, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-06 03:56:48', 1),
(104, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-06 05:37:44', 1),
(105, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-06 06:41:02', 1),
(106, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-06 14:29:24', 1),
(107, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-06 14:29:36', 1),
(108, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-07 03:26:47', 1),
(109, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-07 09:24:56', 1),
(110, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-07 17:41:20', 1),
(111, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-08 04:41:25', 1),
(112, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-08 06:02:05', 1),
(113, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-08 06:02:41', 1),
(114, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-09 15:45:48', 1),
(115, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-09 17:14:08', 1),
(116, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-09 17:59:50', 1),
(117, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-09 18:50:32', 1),
(118, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 01:27:57', 1),
(119, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-10 01:30:13', 1),
(120, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 01:33:07', 1),
(121, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-10 07:39:31', 1),
(122, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 07:53:11', 1),
(123, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 08:22:42', 1),
(124, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-10 08:23:01', 1),
(125, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 08:25:13', 1),
(126, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-10 09:15:12', 1),
(127, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 09:15:46', 1),
(128, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 11:54:44', 1),
(129, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-10 11:55:09', 1),
(130, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-10 11:59:13', 1),
(131, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-11 03:20:58', 1),
(132, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-11 03:22:25', 1),
(133, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-13 04:52:07', 1),
(134, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-13 18:18:17', 1),
(135, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-14 02:52:29', 1),
(136, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-14 09:36:14', 1),
(137, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-14 14:39:29', 1),
(138, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-14 14:39:30', 1),
(139, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-15 02:44:31', 1),
(140, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-15 08:24:05', 1),
(141, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-16 06:06:41', 1),
(142, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-16 08:15:23', 1),
(143, '::1', 'wahyuwidiantoro82@gmail,com', NULL, '2023-04-16 08:30:02', 0),
(144, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-16 08:30:18', 1),
(145, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-16 08:30:35', 1),
(146, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-17 03:03:38', 1),
(147, '::1', 'wahyuwidiantoro82@gmail,com', NULL, '2023-04-17 05:43:20', 0),
(148, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-17 05:43:32', 1),
(149, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-17 10:14:16', 1),
(150, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-17 10:14:28', 1),
(151, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-18 04:43:37', 1),
(152, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-18 05:35:28', 1),
(153, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-18 06:52:49', 1),
(154, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-18 06:53:50', 1),
(155, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-18 07:05:13', 1),
(156, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-18 09:20:02', 1),
(157, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-18 16:21:56', 1),
(158, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-18 16:22:12', 1),
(159, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-19 07:03:50', 1),
(160, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-19 07:58:40', 1),
(161, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-19 09:53:39', 1),
(162, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-19 09:56:36', 1),
(163, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-20 03:28:59', 1),
(164, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-20 04:36:38', 1),
(165, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-20 04:39:59', 1),
(166, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-21 02:37:54', 1),
(167, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-21 03:00:16', 1),
(168, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-29 06:41:31', 1),
(169, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-04-29 09:23:55', 1),
(170, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-30 04:37:12', 1),
(171, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-30 07:24:56', 1),
(172, '::1', 'wahyuwahyu@gmail.com', 23, '2023-04-30 17:52:55', 1),
(173, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-03 05:53:34', 1),
(174, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-03 11:29:21', 1),
(175, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-03 13:52:47', 1),
(176, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-03 14:04:10', 1),
(177, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-03 16:26:24', 1),
(178, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-04 16:36:58', 1),
(179, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-05 17:29:28', 1),
(180, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-06 07:15:30', 1),
(181, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-07 07:37:40', 1),
(182, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-07 09:32:46', 1),
(183, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-08 02:55:35', 1),
(184, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-08 03:20:30', 1),
(185, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-09 01:53:50', 1),
(186, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-10 06:42:31', 1),
(187, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-10 06:42:57', 1),
(188, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-13 17:54:54', 1),
(189, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-13 17:59:47', 1),
(190, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-14 02:32:47', 1),
(191, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-14 02:50:59', 1),
(192, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-14 05:35:15', 1),
(193, '::1', 'wahyu', NULL, '2023-05-14 07:06:26', 0),
(194, '::1', 'budianto', NULL, '2023-05-14 07:06:32', 0),
(195, '::1', 'wahyu', NULL, '2023-05-14 07:06:41', 0),
(196, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-14 07:07:25', 1),
(197, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-14 07:37:44', 1),
(198, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-14 07:44:51', 1),
(199, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-14 09:02:38', 1),
(200, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 02:58:09', 1),
(201, '::1', 'wahyuwidiantoro82@gmail.com', NULL, '2023-05-18 03:06:40', 0),
(202, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-18 03:06:47', 1),
(203, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 03:07:04', 1),
(204, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 03:12:42', 1),
(205, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 06:08:44', 1),
(206, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-18 08:03:49', 1),
(207, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 08:04:09', 1),
(208, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 08:27:28', 1),
(209, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-18 10:43:57', 1),
(210, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-18 14:34:58', 1),
(211, '::1', 'wahyuwidiantoro82@gmail.com', 26, '2023-05-26 12:03:26', 1),
(212, '::1', 'wahyu', NULL, '2023-05-26 12:04:33', 0),
(213, '::1', 'wahyuwahyu@gmail.com', 23, '2023-05-26 12:04:39', 1),
(214, '::1', 'wahyu', NULL, '2023-06-18 16:37:15', 0),
(215, '::1', 'wahyu', NULL, '2023-06-18 16:37:23', 0),
(216, '::1', 'admin', NULL, '2023-06-18 16:37:33', 0),
(217, '::1', 'wahyu', NULL, '2023-06-18 16:37:50', 0),
(218, '::1', 'wahyuwahyu@gmail.com', 23, '2023-06-18 16:38:22', 1),
(219, '::1', 'wahyu', NULL, '2023-07-10 05:35:32', 0),
(220, '::1', 'wahyu', NULL, '2023-07-10 05:35:41', 0),
(221, '::1', '1234567891234567', NULL, '2023-07-10 05:35:51', 0),
(222, '::1', 'wahyu', NULL, '2023-07-10 05:36:08', 0),
(223, '::1', 'wahyuwahyu@gmail.com', 23, '2023-07-10 05:36:47', 1),
(224, '::1', '123456789', NULL, '2023-07-10 17:16:23', 0),
(225, '::1', 'wahyuwahyu@gmail.com', 23, '2023-07-10 17:16:35', 1),
(226, '::1', 'wahyuwahyu@gmail.com', 23, '2023-07-11 07:39:01', 1),
(227, '::1', 'wahyuwahyu@gmail.com', 23, '2023-07-11 07:58:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-permohonan', 'Mengelola Permohonan'),
(2, 'manage-user', 'Mengelola User'),
(3, 'manage-surat', 'Mengelola jenis surat'),
(4, 'create-permohonan', 'Membuat Permohonan'),
(5, 'read-history', 'Melihat history permohonan'),
(6, 'manage-profile', 'Mengelola profil');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1677386578, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nomor`
--

CREATE TABLE `nomor` (
  `id` int(20) NOT NULL,
  `no_instansi` int(20) NOT NULL,
  `no_referensi` varchar(50) NOT NULL,
  `tahun` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nomor`
--

INSERT INTO `nomor` (`id`, `no_instansi`, `no_referensi`, `tahun`) VALUES
(1, 140, '411.502.105', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `perangkat`
--

CREATE TABLE `perangkat` (
  `id` int(10) NOT NULL,
  `kades` varchar(100) DEFAULT NULL,
  `babinsa` varchar(100) DEFAULT NULL,
  `nrp_babinsa` varchar(30) DEFAULT NULL,
  `bhabinkamtibmas` varchar(100) DEFAULT NULL,
  `nrp_bhabin` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perangkat`
--

INSERT INTO `perangkat` (`id`, `kades`, `babinsa`, `nrp_babinsa`, `bhabinkamtibmas`, `nrp_bhabin`) VALUES
(1, 'JANUAR ARIEF GUNAWAN, S.Pd', 'SERTU SADI', '31930725700773', 'AIPDA HERU PAMBUDI', '84050521');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE `permohonan` (
  `id` int(10) NOT NULL,
  `no_srt` int(20) DEFAULT NULL,
  `no_instansi` varchar(20) DEFAULT NULL,
  `no_ref` varchar(20) DEFAULT NULL,
  `tahun_srt` varchar(20) DEFAULT NULL,
  `id_surat` int(10) DEFAULT NULL,
  `nama_surat_lain` varchar(200) DEFAULT NULL,
  `nik_pemohon` varchar(30) DEFAULT NULL,
  `nama_pemohon` varchar(100) DEFAULT NULL,
  `ttl_pemohon` varchar(50) DEFAULT NULL,
  `jk_pemohon` varchar(20) DEFAULT NULL,
  `status_pemohon` varchar(50) DEFAULT NULL,
  `kerja_pemohon` varchar(50) DEFAULT NULL,
  `telp_pemohon` varchar(20) DEFAULT NULL,
  `alamat_pemohon` varchar(200) DEFAULT NULL,
  `nik_dimohon` varchar(20) DEFAULT NULL,
  `nama_dimohon` varchar(100) DEFAULT NULL,
  `ttl_dimohon` varchar(50) DEFAULT NULL,
  `jk_dimohon` varchar(30) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `alamat_dimohon` varchar(200) DEFAULT NULL,
  `tglacara` varchar(100) DEFAULT NULL,
  `waktuacara` varchar(100) DEFAULT NULL,
  `penghasilan` int(20) DEFAULT NULL,
  `nama_usaha` varchar(50) DEFAULT NULL,
  `alamat_usaha` varchar(200) DEFAULT NULL,
  `domisili` varchar(200) DEFAULT NULL,
  `keperluan` varchar(300) DEFAULT NULL,
  `dokumen` varchar(300) DEFAULT NULL,
  `scan_surat` varchar(200) DEFAULT NULL,
  `status_verif` varchar(50) NOT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `tgl_verif` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`id`, `no_srt`, `no_instansi`, `no_ref`, `tahun_srt`, `id_surat`, `nama_surat_lain`, `nik_pemohon`, `nama_pemohon`, `ttl_pemohon`, `jk_pemohon`, `status_pemohon`, `kerja_pemohon`, `telp_pemohon`, `alamat_pemohon`, `nik_dimohon`, `nama_dimohon`, `ttl_dimohon`, `jk_dimohon`, `pendidikan`, `kelas`, `alamat_dimohon`, `tglacara`, `waktuacara`, `penghasilan`, `nama_usaha`, `alamat_usaha`, `domisili`, `keperluan`, `dokumen`, `scan_surat`, `status_verif`, `tgl_pengajuan`, `tgl_verif`) VALUES
(84, NULL, NULL, NULL, NULL, 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak ada', '1687106338_38839d59f770d75e8d93.png,1687106338_b631fc7d70e93698a4c9.jpg', NULL, 'Ditolak', '2023-06-18', '2023-06-18'),
(85, 1, '140', '411.502.105', '2023', 2, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2500000, NULL, NULL, NULL, 'Pengajuan beasiswa', '1687106361_02e8ea1eadaf4759567a.png,1687106361_57da9d2973df338ffaeb.jpg', '1687106430_2a08555213974b3b5b66.jpg', 'Disetujui', '2023-06-18', '2023-06-18'),
(86, 2, '140', '411.502.105', '2023', 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mengurus beasiswa', '1687106568_a30bac0fdfabb1c1320b.png,1687106568_84c4dfdcf92f09f57a85.jpg', '1687106629_a5eef80355199e6e9656.jpg', 'Disetujui', '2023-06-18', '2023-06-18'),
(87, 3, '140', '411.502.105', '2023', 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mengajukan beasiswa', '1687107287_195da9a513d9f4cdada3.png,1687107287_fa3e9431e06a82d3108d.jpg', '1687107308_900d817d2b769cee481c.jpg', 'Disetujui', '2023-06-18', '2023-06-18'),
(88, 4, '140', '411.502.105', '2023', 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mengurus sekolah', '1687107390_d2cd610ac64e1ef57fae.png,1687107390_6e195b4f14d8d9613215.jpg', '1687107405_d8ef53d225ffaa392c0a.jpg', 'Disetujui', '2023-06-18', '2023-06-18'),
(89, 5, '140', '411.502.105', '2023', 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tes', '1687107675_5480be9f3e8ba14eaac3.jpg', '1687107690_b778d491e75bd48c846e.jpg', 'Disetujui', '2023-06-18', '2023-06-18'),
(90, NULL, NULL, NULL, NULL, 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tidak ada', '1687107734_b6c749ee7956ccd87819.jpg', NULL, 'Ditolak', '2023-06-18', '2023-06-18'),
(91, NULL, NULL, NULL, NULL, 2, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, NULL, NULL, NULL, 'tidak ada', '1687107789_1d23e7fa2c10fcb969cf.jpg', NULL, 'Ditolak', '2023-06-18', '2023-06-18'),
(92, NULL, NULL, NULL, NULL, 1, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'boleh', '1687107965_a48cc1e5f80f4d0acf6f.jpg', NULL, 'Ditolak', '2023-06-18', '2023-07-10'),
(93, 6, '140', '411.502.105', '2023', 8, 'Surat Keterangan Tanah BRI', '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tidak ada', '1688972029_c87573a212595aaae29f.jpg', '1689011474_46cee8827aeb761e7a6c.jpg', 'Disetujui', '2023-07-10', '2023-07-10'),
(94, 7, '140', '411.502.105', '2023', 9, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Membuat KTP', '1689010890_0ef9f092d011ac43c7bb.jpg', NULL, 'Disetujui', '2023-07-10', '2023-07-10'),
(95, NULL, NULL, NULL, NULL, 9, NULL, '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk, 13-03-2023', 'Laki-laki', 'Belum Kawin', 'Wiraswasta', '6282229427833', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bagus', '1689011670_65983d8aab308534b1d6.jpg', NULL, 'Ditolak', '2023-07-10', '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(10) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `nama_surat` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(250) DEFAULT NULL,
  `status` int(5) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `id_surat`, `nama_surat`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SKTM (Umum)', 'SKTM (Umum) adalah surat resmi yang dibutuhkan untuk memperoleh bantuan sosial seperti  bantuan kesehatan, dan program bantuan lainnya.', 1, '2023-04-05', '2023-05-09'),
(4, 2, 'Surat Keterangan Penghasilan', 'Surat keterangan yang dikeluarkan oleh pemerintah desa untuk menunjukkan besarnya penghasilan seorang warga desa', 1, '2023-04-05', '2023-04-19'),
(5, 3, 'SKTM (Untuk Beasiswa)', 'Surat Keterangan Tidak Mampu untuk keperluan pengajuan beasiswa dll. Pemohon yaitu orang tua/wali dengan mencantumkan nama yang dimohonkan.', 1, '2023-05-01', '2023-04-19'),
(6, 4, 'Surat Keterangan Ijin Hiburan', 'Surat ijin untuk mengadakan hiburan atau hajatan di Desa Kemlokolegi', 1, '2023-05-01', '2023-05-09'),
(7, 5, 'Surat Keterangan Usaha', 'Surat yang dikeluarkan untuk memberikan pengakuan terhadap keberadaan dan aktivitas usaha yang dilakukan oleh penduduk di wilayah Desa Kemlokolegi', 1, '2023-05-04', NULL),
(9, 6, 'Surat Keterangan Berkelakuan Baik', 'Surat keterangan yang menyatakan bahwa seseorang yang bersangkutan memiliki catatan perilaku yang baik dan tidak pernah terlibat dalam tindakan kriminal di wilayah desa tersebut.', 1, '2023-05-05', '2023-05-07'),
(10, 8, 'Surat Lainnya', 'Menambahkan data permohonan surat lainnya/khusus yang tidak ada pada menu', 1, '2023-05-06', NULL),
(11, 7, 'Surat Keterangan Domisili', 'Surat keterangan tentang alamat domisili seseorang atau suatu badan usaha, dan digunakan sebagai persyaratan administratif dalam berbagai keperluan seperti pembuatan akta notaris, pembukaan rekening bank, dan sebagainya.', 1, '2023-05-07', NULL),
(12, 9, 'Surat Pengantar KTP', 'Surat pengantar KTP desa adalah dokumen resmi yang dikeluarkan oleh Desa Kemlokolegi untuk memberikan rekomendasi atau persetujuan terhadap pengajuan atau permohonan KTP.', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `tgllhr` date DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `kawin` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `nama`, `tempat`, `tgllhr`, `jk`, `alamat`, `telp`, `agama`, `kawin`, `pekerjaan`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 'wahyuwahyu@gmail.com', '123456789', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$faKaDMCSLBKQZOLqsnpJt..j3OheXBSmT9TBIhenboVdUtSB6M6G.', NULL, NULL, NULL, NULL, '', NULL, 1, 0, NULL, '2023-05-18 08:04:37', NULL),
(26, 'wahyuwidiantoro82@gmail.com', '3514453665433456', 'Wahyu Widiantoro', 'Nganjuk', '2023-03-13', 'L', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', '6282229427833', 'Islam', 'Belum Kawin', 'Wiraswasta', '$2y$10$oyiGwTZhoFMIPYmseBQUkeY.rVNwNFlqrtiCy7SY1EgJiZH2.Tt0i', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-03-26 09:16:07', '2023-05-09 01:58:56', NULL),
(27, 'Budi@mail.com', '3586697545899876', 'Budi Wirawan', 'Nganjuk', '2023-01-11', 'L', 'Dsn. Pandanarum, RT 2/RW 5, Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk', '6282229427833', 'Islam', 'Kawin', 'Wiraswasta', '$2y$10$ObnohpANeWHOf9eamxKXmOUoVRtawYiQCeelmXKR92VAaof4o8i6S', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-03 11:48:07', '2023-05-08 03:34:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor`
--
ALTER TABLE `nomor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_referensi` (`no_referensi`);

--
-- Indexes for table `perangkat`
--
ALTER TABLE `perangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_srt` (`no_srt`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_surat_2` (`id_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_3` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nomor`
--
ALTER TABLE `nomor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perangkat`
--
ALTER TABLE `perangkat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD CONSTRAINT `permohonan_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
