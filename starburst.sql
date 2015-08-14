-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Server version: 5.0.81
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DBName`
--

-- --------------------------------------------------------

--
-- Table structure for table `starburst_logs`
--

CREATE TABLE IF NOT EXISTS `starburst_logs` (
  `user` varchar(50) NOT NULL,
  `postid` int(5) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `action` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `starburst_posts`
--

CREATE TABLE IF NOT EXISTS `starburst_posts` (
  `id` int(5) NOT NULL auto_increment,
  `date` varchar(50) NOT NULL default '',
  `author` varchar(50) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `topic` varchar(255) NOT NULL default '',
  `parent` int(5) NOT NULL default '0',
  `body` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10165 ;

INSERT INTO `starburst_posts` (`id`, `date`, `author`, `subject`, `topic`, `parent`, `body`) VALUES
(10001, 'Monday 09:06', 'Professor', 'Discussion Prompt', '1', 0, 'Please discuss this week topic.');

-- --------------------------------------------------------

--
-- Table structure for table `starburst_users`
--

CREATE TABLE IF NOT EXISTS `starburst_users` (
  `id` int(3) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `topic` int(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

INSERT INTO `starburst_users` (`id`, `username`, `password`, `topic`) VALUES
(11, 'admin', 'admin', 1);

