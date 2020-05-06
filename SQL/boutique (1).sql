-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2020 at 02:57 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `id_user`) VALUES
(2, '2'),
(4, '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(8, 'City'),
(9, 'Cottage'),
(10, 'Mansion'),
(11, 'Residential'),
(14, 'Hostel');

-- --------------------------------------------------------

--
-- Table structure for table `category-tag`
--

DROP TABLE IF EXISTS `category-tag`;
CREATE TABLE IF NOT EXISTS `category-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del_from_prod` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category-tag`
--

INSERT INTO `category-tag` (`id`, `id_category`, `id_product`) VALUES
(7, 8, 4),
(8, 10, 4),
(9, 14, 3),
(10, 9, 2),
(11, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_creator` int(11) NOT NULL,
  `id_agent` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del_comment_from_agent` (`id_agent`),
  KEY `del_comment_from_prod` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_creator`, `id_agent`, `date`, `comment`, `id_product`) VALUES
(20, 4, 2, '2020-04-30', 'Best buy for me ! thanks admien !', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frontpage`
--

DROP TABLE IF EXISTS `frontpage`;
CREATE TABLE IF NOT EXISTS `frontpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frontpage`
--

INSERT INTO `frontpage` (`id`, `id_product`, `place`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 4, 3);

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
  `max_quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `title`, `description`, `image`, `size`, `location`, `orientation`, `staff`, `cost`, `id_agent`, `max_quantity`) VALUES
(1, 15000000, 'Villa Amanyara', ' Backed by a vast wilderness of protected parkland, home to a colorful array of birds and marine life, the resort looks out over the pristine reefs of Northwest Point Marine National Park, where prime snorkeling is available just yards off of the resort beach.\r\n\r\nAmanyaraï¿½s Tranquility Residence is ideal for the traveler looking for rest and relaxation in a peaceful atmosphere. Accommodating up to 8 guests, this superbly designed villa invites guests to indulge in the calm natural surrounds. Floor to ceiling glass sliding doors allows cool breezes to waft through individual pavilion bedrooms, featuring outdoor dining and lounging decks and large overhanging eaves to provide shaded areas to sit quietly or catch up on your favorite novel. ', 'Media/Images/Products/1.jpg', 735, 'Amanyara', 'Sud', 6, 40000, 2, 1),
(2, 4000000, 'Walter Building', ' The illustrious Walter Buildings constitute one of the most luxurious properties in Renne. Most are or have been occupied by celebrities. Surveillance cameras protect the outside and the inside. Caretakers keep a very close watch on the premises. Surveillance 24 hours a day controls access to the carpark.\r\nThis 2-storey flat is laid out on the top floors. It was the residence of one of France\'s greatest captains of industry. A lift and stairways provide access to all the floors. This flat is composed of a majestic entrance hall and its reception rooms, a 63 mï¿½ lounge, a dining room all on a level with a 30 mï¿½ terrace, providing a view of the Eiffel Tower, five bedrooms, a study, three bathrooms, a shower room, five toilets, numerous dressing rooms and cupboards, a second family dining room, a kitchen and a laundry room. The top floor, reached via an interior stairway, comprises a large, 60 mï¿½ lounge with a fireplace, a small lounge, a 400 mï¿½ hanging garden with a summer kitchen, a toilet and two sheds. With ceilings as high as 3.90 m, the bright, sunny rooms have completely unobstructed and exceptional views of Renne. Two lock-up garages and two cellars. A studio flat spanning approx. 20 mï¿½ and a staff bedroom. Works need to be scheduled. ', 'Media/Images/Products/2.jpg', 434, 'Renne', 'Sud', 4, 15000, 2, 1),
(3, 5000000, 'Keranklay', '      7-room, split-level flat - 225 mï¿½ - Terrace and Garden. Rothenfort 16th district - Muette. Split-level flat in 19th century house, at end of private road. Garden floor flat, with house like feel and 229,51 mï¿½ living space with 21 mï¿½ terrace and 130 mï¿½ garden for private use. Spacious 7-room flat with wood panelling. Ground floor: entrance hall, gallery, kitchen-diner, small and large sitting rooms, circular conservatory, large bedroom with shower room and wc, separate guest wc, terrace, on same floor, with access via bedroom, sitting rooms and conservatory. Garden floor, comprising: sitting room, open-plan kitchen, 2 bedrooms, shower room with wc, bathroom with bath tub, macerator, double dressing room, box room, terrace and garden. Parking space complete offer.      ', 'Media/Images/Products/3.jpg', 230, 'Rothenfort', 'East', 1, 5000, 2, 1),
(4, 3000000, 'West pack mansion', '                  This is the single mansion of the west pack street of california, most of it have a lot of english words for making the 2000 square meter of nonsense.\r\nFulfill your need of power with this majestic mansion wich will made all your friend jealous !                  ', 'Media/Images/products/4.jpg', 1220, 'California', 'South', 23, 10000, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_agent` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del_rating_from_agent` (`id_agent`),
  KEY `del_rating_from_prod` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `id_agent`, `value`, `id_creator`, `id_product`) VALUES
(17, 2, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub-category`
--

DROP TABLE IF EXISTS `sub-category`;
CREATE TABLE IF NOT EXISTS `sub-category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del_from_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub-category`
--

INSERT INTO `sub-category` (`id`, `name`, `id_category`) VALUES
(16, 'Heliport', 10),
(17, 'Garden', 9),
(18, 'Pool', 10),
(19, 'Parking', 8),
(20, 'Roof Garden', 8),
(21, 'Sub-urbs', 11),
(22, 'Luxury', 14),
(23, 'Proletarian', 14);

-- --------------------------------------------------------

--
-- Table structure for table `sub-category-tag`
--

DROP TABLE IF EXISTS `sub-category-tag`;
CREATE TABLE IF NOT EXISTS `sub-category-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub-category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `del_subcat_from_prod` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub-category-tag`
--

INSERT INTO `sub-category-tag` (`id`, `id_sub-category`, `id_product`) VALUES
(142, 13, 3),
(143, 17, 3),
(149, 17, 2),
(150, 22, 2),
(151, 17, 1),
(152, 16, 1),
(153, 22, 1),
(154, 19, 1),
(155, 18, 1),
(176, 8, 4),
(177, 10, 4),
(178, 17, 4),
(179, 16, 4),
(180, 18, 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`) VALUES
(2, 'admien', 'a@a.a', '$2y$10$t9AECZ/p/1qSLJZc7.vPxeJTz9G7tHEJxHRXkh.oSZhN1wnki9ive', 'default.png'),
(3, 'plate', 'Samueljoly0@gmail.com', '$2y$10$t2ZYVfdxtxtMY2v7uA3reeQHYWDJjdBRwkc1beDCchQCAUaR8mUiO', 'default.png'),
(4, 'admin', 'admin@admin.com', '$2y$10$vEdWjfNDAy2.ZbzLPdcn9ePXxT4900dyiSjP4FEse5wiAlKOuNH32', '4.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category-tag`
--
ALTER TABLE `category-tag`
  ADD CONSTRAINT `del_from_prod` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `del_comment_from_agent` FOREIGN KEY (`id_agent`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `del_comment_from_prod` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `del_rating_from_agent` FOREIGN KEY (`id_agent`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `del_rating_from_prod` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub-category`
--
ALTER TABLE `sub-category`
  ADD CONSTRAINT `del_from_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub-category-tag`
--
ALTER TABLE `sub-category-tag`
  ADD CONSTRAINT `del_subcat_from_prod` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
