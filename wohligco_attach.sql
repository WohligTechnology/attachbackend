-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2016 at 09:17 AM
-- Server version: 5.6.21
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wohligco_attach`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `attach_userfollow`
--

CREATE TABLE IF NOT EXISTS `attach_userfollow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `userfollowed` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `attach_userfollow`
--

INSERT INTO `attach_userfollow` (`id`, `user`, `userfollowed`, `timestamp`, `creationdate`, `modificationdate`) VALUES
(11, 17, 13, '2015-08-06 12:04:52', '2015-08-06 12:04:52', '2015-08-06 12:04:52'),
(14, 17, 15, '2015-08-06 12:28:11', '2015-08-06 12:28:11', '2015-08-06 12:28:11'),
(15, 17, 20, '2015-08-06 12:28:51', '2015-08-06 12:28:51', '2015-08-06 12:28:51'),
(17, 20, 17, '2015-08-06 13:03:37', '2015-08-06 13:03:37', '2015-08-06 13:03:37'),
(18, 21, 17, '2015-08-06 13:11:59', '2015-08-06 13:11:59', '2015-08-06 13:11:59'),
(19, 21, 14, '2015-08-06 13:13:07', '2015-08-06 13:13:07', '2015-08-06 13:13:07'),
(20, 25, 17, '2015-08-07 05:43:30', '2015-08-07 05:43:30', '2015-08-07 05:43:30'),
(21, 19, 17, '2015-08-07 07:22:52', '2015-08-07 07:22:52', '2015-08-07 07:22:52'),
(22, 19, 14, '2015-08-07 07:28:32', '2015-08-07 07:28:32', '2015-08-07 07:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `attach_userpoll`
--

CREATE TABLE IF NOT EXISTS `attach_userpoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `shouldhavecomment` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modificationdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shouldhaveoption` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `attach_userpoll`
--

INSERT INTO `attach_userpoll` (`id`, `timestamp`, `content`, `image`, `title`, `video`, `user`, `status`, `shouldhavecomment`, `creationdate`, `modificationdate`, `shouldhaveoption`) VALUES
(1, '2015-08-06 07:49:17', 'edit content', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, '2015-08-03 01:10:11', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, '2015-08-03 01:10:27', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, '2015-08-03 01:11:09', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, '2015-08-03 01:11:32', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, '2015-08-03 01:12:07', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, '2015-08-03 01:12:39', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, '2015-08-03 01:13:11', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, '2015-08-03 01:13:38', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, '2015-08-03 01:14:10', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(11, '2015-08-03 01:14:36', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, '2015-08-03 01:16:17', 'my comtent', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, '2015-08-03 21:00:37', 'my comtent test', '', '', '', 5, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, '2015-08-03 01:17:22', 'my comtent', '', '', '', 13, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, '2015-08-04 11:21:08', 'my comtent', '', '', '', 17, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, '2015-08-04 11:39:28', 'my comtent', '', '', '', 8, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(17, '2015-08-04 12:06:18', 'demo', '', '', '', 14, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(18, '2015-08-04 12:07:14', 'demo', '', '', '', 14, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(19, '2015-08-04 12:12:24', 'my comtent', '', '', '', 14, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(20, '2015-08-04 12:21:04', 'New image text', '', '', '', 14, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(21, '2015-08-05 05:15:29', 'Hello new day', '', '', '', 18, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(22, '2015-08-05 05:19:27', 'hola', '', '', '', 18, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(23, '2015-08-05 08:27:25', 'first post', '', '', '', 26, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(24, '2015-08-05 11:22:12', 'First Attach', '', '', '', 20, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(25, '2015-08-06 12:51:31', 'mypost', '', '', '', 17, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(26, '2015-08-06 13:12:43', 'Attach', '', '', '', 21, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(27, '2015-08-07 07:37:32', 'This is my first attach.', '', '', '', 21, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(28, '2015-08-07 07:37:32', 'This is my first attach.', '', '', '', 21, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attach_userpollcomment`
--

CREATE TABLE IF NOT EXISTS `attach_userpollcomment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `userpoll` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attach_userpollfavourites`
--

CREATE TABLE IF NOT EXISTS `attach_userpollfavourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `userpoll` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificationdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `attach_userpollfavourites`
--

INSERT INTO `attach_userpollfavourites` (`id`, `timestamp`, `user`, `userpoll`, `creationdate`, `modificationdate`) VALUES
(20, '2015-08-06 12:56:13', 17, 24, '2015-08-06 12:56:13', '2015-08-06 12:56:13'),
(21, '2015-08-07 09:09:51', 25, 25, '2015-08-07 09:09:51', '2015-08-07 09:09:51'),
(22, '2015-08-07 09:13:23', 25, 15, '2015-08-07 09:13:23', '2015-08-07 09:13:23'),
(23, '2015-08-07 09:35:16', 25, 15, '2015-08-07 09:35:16', '2015-08-07 09:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `attach_userpolloption`
--

CREATE TABLE IF NOT EXISTS `attach_userpolloption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `order` int(11) NOT NULL,
  `userpoll` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificationdate` timestamp NULL DEFAULT NULL,
  `shouldhaveoption` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `attach_userpolloption`
--

INSERT INTO `attach_userpolloption` (`id`, `timestamp`, `image`, `text`, `order`, `userpoll`, `creationdate`, `modificationdate`, `shouldhaveoption`) VALUES
(1, '2015-08-03 01:17:22', '', 'dsfa', 0, 1, '2015-08-03 01:17:22', NULL, 0),
(2, '2015-08-03 01:17:22', '', 'This is a poll', 0, 13, '2015-08-03 01:17:22', NULL, 0),
(3, '2015-08-03 01:17:22', '', 'This is a second poll', 0, 13, '2015-08-03 01:17:22', NULL, 0),
(4, '2015-08-04 11:21:08', '', 'dsfa', 0, 4, '2015-08-04 11:21:08', NULL, 0),
(5, '2015-08-04 11:21:08', '', 'dsfa', 0, 4, '2015-08-04 11:21:08', NULL, 0),
(6, '2015-08-04 11:39:28', '', 'dsfa', 0, 6, '2015-08-04 11:39:28', NULL, 0),
(7, '2015-08-04 11:39:28', '', 'dsfa', 0, 6, '2015-08-04 11:39:28', NULL, 0),
(8, '2015-08-04 12:06:18', '', 'kgk', 0, 17, '2015-08-04 12:06:18', NULL, 0),
(9, '2015-08-04 12:07:14', '', 'yes', 0, 18, '2015-08-04 12:07:14', NULL, 0),
(10, '2015-08-04 12:07:14', '', 'no', 0, 9, '2015-08-04 12:07:14', NULL, 0),
(11, '2015-08-04 12:12:24', '', 'dsfa', 0, 8, '2015-08-04 12:12:24', NULL, 0),
(12, '2015-08-04 12:12:24', '', 'dsfa', 0, 11, '2015-08-04 12:12:24', NULL, 0),
(13, '2015-08-04 12:21:04', '', 'dsfa', 0, 20, '2015-08-04 12:21:04', NULL, 0),
(14, '2015-08-04 12:21:04', '', 'dsfa', 0, 20, '2015-08-04 12:21:04', NULL, 0),
(15, '2015-08-05 05:15:29', '', 'yes', 0, 21, '2015-08-05 05:15:29', NULL, 0),
(16, '2015-08-05 05:15:29', '', 'no', 0, 21, '2015-08-05 05:15:29', NULL, 0),
(17, '2015-08-05 05:19:27', '', 'yes', 0, 22, '2015-08-05 05:19:27', NULL, 0),
(18, '2015-08-05 05:19:27', '', 'no', 0, 22, '2015-08-05 05:19:27', NULL, 0),
(19, '2015-08-05 08:27:25', '', 'yes', 0, 23, '2015-08-05 08:27:25', NULL, 0),
(20, '2015-08-05 08:27:25', '', 'no', 0, 23, '2015-08-05 08:27:25', NULL, 0),
(21, '2015-08-05 11:22:12', '', 'True', 0, 24, '2015-08-05 11:22:12', NULL, 0),
(22, '2015-08-05 11:22:12', '', 'False', 0, 24, '2015-08-05 11:22:12', NULL, 0),
(23, '2015-08-06 12:51:31', '', 'yes baby', 0, 25, '2015-08-06 12:51:31', NULL, 0),
(24, '2015-08-06 13:12:43', '', 'Yes', 0, 26, '2015-08-06 13:12:43', NULL, 0),
(25, '2015-08-06 13:12:43', '', 'No', 0, 26, '2015-08-06 13:12:43', NULL, 0),
(26, '2015-08-06 13:12:43', '', 'Maybe', 0, 26, '2015-08-06 13:12:43', NULL, 0),
(27, '2015-08-07 07:37:32', '', 'Yes', 0, 28, '2015-08-07 07:37:32', NULL, 0),
(28, '2015-08-07 07:37:32', '', 'Yes', 0, 27, '2015-08-07 07:37:32', NULL, 0),
(29, '2015-08-07 07:37:32', '', 'No', 0, 28, '2015-08-07 07:37:32', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attach_userpollresponse`
--

CREATE TABLE IF NOT EXISTS `attach_userpollresponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userpolloption` int(11) NOT NULL,
  `userpoll` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modificationdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `attach_userpollresponse`
--

INSERT INTO `attach_userpollresponse` (`id`, `timestamp`, `userpolloption`, `userpoll`, `user`, `creationdate`, `modificationdate`) VALUES
(1, '2015-08-05 11:54:32', 19, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '2015-08-05 11:54:46', 19, 23, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '2015-08-05 13:19:35', 19, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '2015-08-05 13:35:26', 21, 24, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '2015-08-05 13:44:17', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '2015-08-05 13:44:44', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '2015-08-05 13:44:53', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '2015-08-05 13:45:00', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '2015-08-05 13:45:03', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '2015-08-05 13:46:04', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '2015-08-05 13:46:08', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '2015-08-05 13:46:10', 20, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '2015-08-05 13:46:13', 19, 23, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '2015-08-06 04:51:01', 22, 24, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '2015-08-06 05:00:20', 21, 24, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '2015-08-06 05:29:21', 21, 24, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '2015-08-06 05:29:25', 21, 24, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '2015-08-06 05:33:15', 22, 24, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '2015-08-06 05:49:02', 22, 24, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '2015-08-06 07:51:32', 21, 24, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '2015-08-06 07:51:40', 21, 24, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '2015-08-06 10:17:37', 21, 24, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '2015-08-06 13:14:44', 24, 26, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '2015-08-07 07:37:45', 27, 28, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, '2015-08-07 07:38:02', 29, 28, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, '2015-08-07 07:38:10', 29, 28, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, '2015-08-07 07:38:15', 27, 28, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, '2015-08-07 07:38:18', 27, 28, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, '2015-08-07 07:38:23', 27, 28, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, '2015-08-07 09:45:41', 23, 25, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, '2015-08-07 09:45:42', 23, 25, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE IF NOT EXISTS `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`id`, `type`, `value`, `timestamp`) VALUES
(1, 'Facebook', NULL, '2015-08-05 06:27:02'),
(2, 'Facebook', NULL, '2015-08-05 07:19:45'),
(3, 'Facebook', 'SUCCESS', '2015-08-05 07:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(2, 'User Follow', '', '', 'site/viewuserfollow', 1, 0, 1, 2, 'icon-dashboard'),
(3, 'User Polls', '', '', 'site/viewuserpoll', 1, 0, 1, 3, 'icon-dashboard'),
(4, 'User Poll Option', '', '', 'site/viewuserpolloption', 1, 0, 1, 0, 'icon-dashboard'),
(5, 'User Poll Response', '', '', 'site/viewuserpollresponse', 1, 0, 1, 4, 'icon-dashboard'),
(6, 'User Poll Favourites', '', '', 'site/viewuserpollfavourites', 1, 0, 1, 5, 'icon-dashboard'),
(7, 'User Poll Comment', '', '', 'site/viewuserpollcomment', 1, 0, 1, 6, 'icon-dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active'),
(3, 'Waiting'),
(4, 'Active Waiting'),
(5, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` int(11) NOT NULL,
  `json` text NOT NULL,
  `dob` date NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `street` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `google` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `facebook`, `twitter`, `creationdate`, `modificationdate`, `street`, `address`, `city`, `state`, `pincode`, `country`, `google`, `description`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(4, 'pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, 'pratik', '1', 1, '', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(5, 'wohlig123', 'wohlig123', 'wohlig1@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(6, 'wohlig1', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 1, '2014-10-17 06:22:29', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(9, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@email.com', 2, '2014-12-03 11:06:19', 3, '', '', '123', 1, 'demojson', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(13, 'aaa', 'a208e5837519309129fa466b0c68396b', 'aaa3@email.com', 3, '2014-12-04 06:55:42', 3, NULL, '', '1', 2, 'userjson', '0000-00-00', '', '', '2015-07-31 13:00:41', '2015-07-31 13:00:41', '', '', '', '', 0, '', 0, NULL),
(14, 'Pooja Thakare', '', '', 3, '2015-08-03 23:24:00', 1, 'https://graph.facebook.com/438221693016058/picture?width=150&height=150', '', '438221693016058', 0, '', '0000-00-00', '438221693016058', '', '2015-08-03 23:24:00', '2015-08-03 23:24:00', '', ',', '', '', 0, '', 0, NULL),
(15, 'Dhaval Gala', '', '', 3, '2015-08-04 11:53:20', 1, 'https://graph.facebook.com/916542011751012/picture?width=150&height=150', '', '916542011751012', 0, '', '0000-00-00', '916542011751012', '', '2015-08-04 11:53:20', '2015-08-04 11:53:20', '', ',', '', '', 0, '', 0, NULL),
(16, 'Pooja Thakare', '', 'pooja.wohlig@gmail.com', 3, '2015-08-04 12:35:49', 1, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '103402210128529539675', 0, '', '0000-00-00', '', '', '2015-08-04 12:35:49', '2015-08-04 12:35:49', '', ',', '', '', 0, '', 2147483647, NULL),
(17, 'sony181', '', '', 3, '2015-08-04 12:51:57', 1, 'http://pbs.twimg.com/profile_images/625994292280999936/uWjnMHKJ_normal.jpg', '', '170283202', 0, '', '0000-00-00', '', '170283202', '2015-08-04 12:51:57', '2015-08-04 12:51:57', '', ',Kalyan Dombivali, Maharashtra', '', '', 0, '', 0, NULL),
(19, 'Dhaval Gala', '', 'dhavalwohlig@gmail.com', 3, '2015-08-05 05:25:21', 1, 'https://lh5.googleusercontent.com/-XpnZx6dcp2M/AAAAAAAAAAI/AAAAAAAAABM/jPz-R7kUZPg/photo.jpg', '', '105578617147285044793', 0, '', '0000-00-00', '', '', '2015-08-05 05:25:21', '2015-08-05 05:25:21', '', ',', '', '', 0, '', 2147483647, NULL),
(20, 'dhavalgala59', '', '', 3, '2015-08-05 05:25:44', 1, 'http://pbs.twimg.com/profile_images/615918841441353728/aCgWDELS_normal.jpg', '', '119307769', 0, '', '0000-00-00', '', '119307769', '2015-08-05 05:25:44', '2015-08-05 05:25:44', '', ',Mumbai', '', '', 0, '', 0, NULL),
(21, 'Dhaval Gala', '', '', 3, '2015-08-05 05:26:43', 1, 'https://igcdn-photos-b-a.akamaihd.net/hphotos-ak-xfp1/t51.2885-19/11049183_403558949816473_1946831034_a.jpg', '', '999244606', 0, '', '0000-00-00', '', '', '2015-08-05 05:26:43', '2015-08-05 05:26:43', '', ',', '', '', 0, '', 0, NULL),
(22, 'Pooja Thakare', '', '', 3, '2015-08-05 06:12:37', 1, 'https://instagramimages-a.akamaihd.net/profiles/anonymousUser.jpg', '', '1971117302', 0, '', '0000-00-00', '', '', '2015-08-05 06:12:37', '2015-08-05 06:12:37', '', ',', '', '', 0, '', 0, NULL),
(23, 'Jagruti Patil', '', '', 3, '2015-08-05 06:12:46', 1, 'https://graph.facebook.com/974106229318936/picture?width=150&height=150', '', '974106229318936', 0, '', '0000-00-00', '974106229318936', '', '2015-08-05 06:12:46', '2015-08-05 06:12:46', '', ',', '', '', 0, '', 0, NULL),
(24, 'Vignesh', '', '', 3, '2015-08-05 07:08:28', 1, 'http://abs.twimg.com/sticky/default_profile_images/default_profile_3_normal.png', '', '3299138160', 0, '', '0000-00-00', '', '3299138160', '2015-08-05 07:08:28', '2015-08-05 07:08:28', '', ',', '', '', 0, '', 0, ''),
(25, 'Jagruti Patil', '', 'jagruti@wohlig.com', 3, '2015-08-05 08:22:37', 1, 'https://lh4.googleusercontent.com/-4CwQtZIpAOA/AAAAAAAAAAI/AAAAAAAAACE/MtYl0fUkHqU/photo.jpg', '', '114607895078261661460', 0, '', '0000-00-00', '', '', '2015-08-05 08:22:37', '2015-08-05 08:22:37', '', ',', '', '', 0, '', 2147483647, ''),
(26, 'Jagruti Patil', '', '', 3, '2015-08-05 08:25:06', 1, 'https://igcdn-photos-f-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/s150x150/11261279_886231928090877_1120886912_a.jpg', 'patiljagruti181', '2019919923', 0, '', '0000-00-00', '', '', '2015-08-05 08:25:06', '2015-08-05 08:25:06', '', ',', '', '', 0, '', 0, ''),
(27, 'Pooja Thakare', '', '', 3, '2015-08-07 05:24:42', 1, 'http://abs.twimg.com/sticky/default_profile_images/default_profile_1_normal.png', '', '3104340877', 0, '', '0000-00-00', '', '3104340877', '2015-08-07 05:24:42', '2015-08-07 05:24:42', '', ',', '', '', 0, '', 0, ''),
(28, 'Mahesh Maurya', '', '', 3, '2015-08-07 06:37:41', 1, 'https://graph.facebook.com/859624200790333/picture?width=150&height=150', '', '859624200790333', 0, '', '0000-00-00', '859624200790333', '', '2015-08-07 06:37:41', '2015-08-07 06:37:41', '', ',', '', '', 0, '', 0, ''),
(29, 'Mahesh Maurya', '', 'mahesh@wohlig.com', 3, '2015-08-07 06:38:43', 1, 'https://lh6.googleusercontent.com/-tfyK-rdOtCg/AAAAAAAAAAI/AAAAAAAAAtA/1ut49ptsakQ/photo.jpg', '', '101948379873071254430', 0, '', '0000-00-00', '', '', '2015-08-07 06:38:43', '2015-08-07 06:38:43', '', ',', '', '', 0, '', 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `userpollimages`
--

CREATE TABLE IF NOT EXISTS `userpollimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
