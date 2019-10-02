-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2019 at 10:37 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpapis`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Technology', '2019-10-02 01:37:07'),
(2, 'Gaming', '2019-10-02 01:37:07'),
(3, 'Audio', '2019-10-02 01:37:07'),
(4, 'Books', '2019-10-02 01:37:07'),
(5, 'Entertainment', '2019-10-02 01:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `body`, `author`, `created_at`) VALUES
(1, 1, 'Post One', 'This is post one body.', 'Abhishek', '2019-10-02 01:39:27'),
(2, 2, 'Post Two', 'This is post two body.', 'Sidit', '2019-10-02 01:39:27'),
(3, 3, 'Post Three', 'This is post two body.', 'Rahul', '2019-10-02 01:39:27'),
(4, 4, 'Post Four', 'This is post four body.', 'Shivam', '2019-10-02 01:43:44'),
(5, 5, 'Post Five', 'This is post five body.', 'Rohit', '2019-10-02 01:43:44'),
(6, 3, 'Post Six', 'This is post six body.', 'Madhur', '2019-10-02 01:43:44'),
(7, 2, 'Post Seven', 'This is post seven body.', 'Sidit', '2019-10-02 01:43:44'),
(8, 2, ':title', ':body', ':author', '2019-10-03 03:47:17'),
(9, 2, 'Post Nine', 'This is the body of post nine.', 'Abhishek', '2019-10-03 03:50:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
