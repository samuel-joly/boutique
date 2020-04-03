-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2020 at 02:30 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `id_user`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bought`
--

DROP TABLE IF EXISTS `bought`;
CREATE TABLE IF NOT EXISTS `bought` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'House'),
(2, 'In City'),
(3, 'Mansion'),
(4, 'Cottage');

-- --------------------------------------------------------

--
-- Table structure for table `category-tag`
--

DROP TABLE IF EXISTS `category-tag`;
CREATE TABLE IF NOT EXISTS `category-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `size` float NOT NULL,
  `location` varchar(255) NOT NULL,
  `orientation` varchar(255) NOT NULL,
  `staff` int(11) NOT NULL,
  `cost` float NOT NULL,
  `id_agent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `title`, `description`, `image`, `size`, `location`, `orientation`, `staff`, `cost`, `id_agent`) VALUES
(1, 15000000, 'Villa Amanyara', 'Backed by a vast wilderness of protected parkland, home to a colorful array of birds and marine life, the resort looks out over the pristine reefs of Northwest Point Marine National Park, where prime snorkeling is available just yards off of the resort beach.\r\n\r\nAmanyara’s Tranquility Residence is ideal for the traveler looking for rest and relaxation in a peaceful atmosphere. Accommodating up to 8 guests, this superbly designed villa invites guests to indulge in the calm natural surrounds. Floor to ceiling glass sliding doors allows cool breezes to waft through individual pavilion bedrooms, featuring outdoor dining and lounging decks and large overhanging eaves to provide shaded areas to sit quietly or catch up on your favorite novel.', 'Media/Images/Products/1.jpg', 735, 'Amanyara', 'Sud', 6, 40000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `value` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub-category`
--

DROP TABLE IF EXISTS `sub-category`;
CREATE TABLE IF NOT EXISTS `sub-category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub-category`
--

INSERT INTO `sub-category` (`id`, `name`, `id_category`) VALUES
(1, 'City', 1),
(2, 'Rural', 1),
(3, 'Garden', 1),
(4, 'Parcking slots', 1),
(5, 'Bottom floor', 2),
(6, 'Top floor', 2),
(7, 'Pool', 1),
(8, 'Sports area', 3),
(9, 'Decorated Garden', 3),
(10, 'Pool', 3),
(11, 'Parking slot', 2),
(12, 'Roof garden', 2),
(13, 'Harvestable Garden', 4),
(14, 'In nature', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sub-category-tag`
--

DROP TABLE IF EXISTS `sub-category-tag`;
CREATE TABLE IF NOT EXISTS `sub-category-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub-category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`) VALUES
(1, 'azefortwo', 'samueljoly0@gmail.com', '0', 'default.jpg'),
(2, 'admien', 'a@a.a', '$2y$10$t9AECZ/p/1qSLJZc7.vPxeJTz9G7tHEJxHRXkh.oSZhN1wnki9ive', 'default.jpg'),
(3, 'plate', 'Samueljoly0@gmail.com', '$2y$10$t2ZYVfdxtxtMY2v7uA3reeQHYWDJjdBRwkc1beDCchQCAUaR8mUiO', 'default.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
