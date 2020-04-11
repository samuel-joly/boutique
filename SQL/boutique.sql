-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 10 avr. 2020 à 21:40
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `boutique`
=======
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2020 at 10:10 AM
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
>>>>>>> master
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boutique`;

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agents`
=======
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
>>>>>>> master
--

INSERT INTO `agents` (`id`, `id_user`) VALUES
(1, '1'),
(2, '2');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
=======
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
>>>>>>> master
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `bought`
--

CREATE TABLE `bought` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int(11) NOT NULL
=======
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
>>>>>>> master
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
=======
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
>>>>>>> master
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'House'),
(5, 'City'),
(3, 'Mansion'),
(4, 'Cottage');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `category_tag`
--

CREATE TABLE `category_tag` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category_tag`
--

INSERT INTO `category_tag` (`id`, `id_category`, `id_product`) VALUES
=======
-- Table structure for table `category-tag`
--

DROP TABLE IF EXISTS `category-tag`;
CREATE TABLE IF NOT EXISTS `category-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category-tag`
--

INSERT INTO `category-tag` (`id`, `id_category`, `id_product`) VALUES
>>>>>>> master
(6, 3, 1),
(5, 5, 1),
(3, 3, 2),
(4, 5, 2),
(7, 1, 3);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `comment` text NOT NULL
=======
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
>>>>>>> master
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
=======
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
>>>>>>> master
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
<<<<<<< HEAD
  `max_quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
=======
  `max_quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
>>>>>>> master
--

INSERT INTO `products` (`id`, `price`, `title`, `description`, `image`, `size`, `location`, `orientation`, `staff`, `cost`, `id_agent`, `max_quantity`) VALUES
(1, 15000000, 'Villa Amanyara', 'Backed by a vast wilderness of protected parkland, home to a colorful array of birds and marine life, the resort looks out over the pristine reefs of Northwest Point Marine National Park, where prime snorkeling is available just yards off of the resort beach.\r\n\r\nAmanyara’s Tranquility Residence is ideal for the traveler looking for rest and relaxation in a peaceful atmosphere. Accommodating up to 8 guests, this superbly designed villa invites guests to indulge in the calm natural surrounds. Floor to ceiling glass sliding doors allows cool breezes to waft through individual pavilion bedrooms, featuring outdoor dining and lounging decks and large overhanging eaves to provide shaded areas to sit quietly or catch up on your favorite novel.', 'Media/Images/Products/1.jpg', 735, 'Amanyara', 'Sud', 6, 40000, 1, 1),
(2, 4000000, 'Walter Building', 'The illustrious Walter Buildings constitute one of the most luxurious properties in Renne. Most are or have been occupied by celebrities. Surveillance cameras protect the outside and the inside. Caretakers keep a very close watch on the premises. Surveillance 24 hours a day controls access to the carpark.\r\nThis 2-storey flat is laid out on the top floors. It was the residence of one of France\'s greatest captains of industry. A lift and stairways provide access to all the floors. This flat is composed of a majestic entrance hall and its reception rooms, a 63 m² lounge, a dining room all on a level with a 30 m² terrace, providing a view of the Eiffel Tower, five bedrooms, a study, three bathrooms, a shower room, five toilets, numerous dressing rooms and cupboards, a second family dining room, a kitchen and a laundry room. The top floor, reached via an interior stairway, comprises a large, 60 m² lounge with a fireplace, a small lounge, a 400 m² hanging garden with a summer kitchen, a toilet and two sheds. With ceilings as high as 3.90 m, the bright, sunny rooms have completely unobstructed and exceptional views of Renne. Two lock-up garages and two cellars. A studio flat spanning approx. 20 m² and a staff bedroom. Works need to be scheduled.', 'Media/Images/Products/2.jpg', 434, 'Renne', 'Sud', 4, 15000, 1, 1),
(3, 5000000, 'Keranklay', '7-room, split-level flat - 225 m² - Terrace and Garden. Rothenfort 16th district - Muette. Split-level flat in 19th century house, at end of private road. Garden floor flat, with house like feel and 229,51 m² living space with 21 m² terrace and 130 m² garden for private use. Spacious 7-room flat with wood panelling. Ground floor: entrance hall, gallery, kitchen-diner, small and large sitting rooms, circular conservatory, large bedroom with shower room and wc, separate guest wc, terrace, on same floor, with access via bedroom, sitting rooms and conservatory. Garden floor, comprising: sitting room, open-plan kitchen, 2 bedrooms, shower room with wc, bathroom with bath tub, macerator, double dressing room, box room, terrace and garden. Parking space complete offer.', 'Media/Images/Products/3.jpg', 230, 'Rothenfort', 'East', 1, 5000, 2, 1);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `ratings`
--

CREATE TABLE `ratings` (
=======
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
>>>>>>> master
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `value` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `id_category`) VALUES
=======
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
>>>>>>> master
(2, 'Rural', 1),
(3, 'Garden', 1),
(4, 'Parcking slots', 1),
(5, 'Bottom floor', 2),
(6, 'Top floor', 2),
(8, 'Sports area', 3),
(9, 'Decorated Garden', 3),
(10, 'Pool', 3),
(12, 'Roof garden', 2),
(13, 'Harvestable Garden', 5),
(14, 'In nature', 4);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `sub_category_tag`
--

CREATE TABLE `sub_category_tag` (
  `id` int(11) NOT NULL,
  `id_sub-category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sub_category_tag`
--

INSERT INTO `sub_category_tag` (`id`, `id_sub-category`, `id_product`) VALUES
=======
-- Table structure for table `sub-category-tag`
--

DROP TABLE IF EXISTS `sub-category-tag`;
CREATE TABLE IF NOT EXISTS `sub-category-tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub-category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub-category-tag`
--

INSERT INTO `sub-category-tag` (`id`, `id_sub-category`, `id_product`) VALUES
>>>>>>> master
(1, 2, 1),
(2, 3, 1),
(3, 4, 2),
(4, 5, 2);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
=======
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
>>>>>>> master
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`) VALUES
(1, 'azefortwo', 'samueljoly0@gmail.com', '0', 'default.jpg'),
(2, 'admien', 'a@a.a', '$2y$10$t9AECZ/p/1qSLJZc7.vPxeJTz9G7tHEJxHRXkh.oSZhN1wnki9ive', 'default.jpg'),
<<<<<<< HEAD
(3, 'plate', 'Samueljoly0@gmail.com', '$2y$10$t2ZYVfdxtxtMY2v7uA3reeQHYWDJjdBRwkc1beDCchQCAUaR8mUiO', 'default.jpg'),
(4, 'amine', 'amine@gmail.com', '$2y$10$SSLPdmRxX/lVk9c4B1ZDDe6p0sxcmTQ58txT/TpAZaNPiu1ssEjEG', 'avatar/default.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bought`
--
ALTER TABLE `bought`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_tag`
--
ALTER TABLE `category_tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sub_category_tag`
--
ALTER TABLE `sub_category_tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bought`
--
ALTER TABLE `bought`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `category_tag`
--
ALTER TABLE `category_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `sub_category_tag`
--
ALTER TABLE `sub_category_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
=======
(3, 'plate', 'Samueljoly0@gmail.com', '$2y$10$t2ZYVfdxtxtMY2v7uA3reeQHYWDJjdBRwkc1beDCchQCAUaR8mUiO', 'default.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
>>>>>>> master
