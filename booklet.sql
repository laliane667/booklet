-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 06 déc. 2022 à 15:11
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `booklet`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `booksId` int(11) NOT NULL,
  `booksName` varchar(256) NOT NULL,
  `booksVersion` varchar(256) NOT NULL,
  `booksVersionTitle` varchar(256) NOT NULL,
  `booksAuthor` varchar(256) NOT NULL,
  `booksCategory` int(11) NOT NULL,
  `booksImgPath` varchar(256) NOT NULL,
  `booksDesc` text,
  `booksPriceId` varchar(256) NOT NULL,
  `booksGrade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`booksId`, `booksName`, `booksVersion`, `booksVersionTitle`, `booksAuthor`, `booksCategory`, `booksImgPath`, `booksDesc`, `booksPriceId`, `booksGrade`) VALUES
(11, 'Harry Potter', 'Tome 2', 'HP et ses petits amis', 'JK Rolling', 6, 'cover568731665637fa4d5239439.13919576.jpeg', 'Harry Potter', '364993661637fa4d523c196.29425423', 3.2);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `catId` int(11) NOT NULL,
  `catName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`catId`, `catName`) VALUES
(6, 'FANTASY');

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

CREATE TABLE `prices` (
  `priceId` varchar(256) NOT NULL,
  `priceValue` float NOT NULL,
  `priceDiscount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`priceId`, `priceValue`, `priceDiscount`) VALUES
('364993661637fa4d523c196.29425423', 20, 0.5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(256) NOT NULL,
  `usersEmail` varchar(256) NOT NULL,
  `usersUid` varchar(256) NOT NULL,
  `usersPwd` varchar(256) NOT NULL,
  `usersPrivilege` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `usersPrivilege`) VALUES
(1, 'Elian Lamouroux', 'elian.lamouroux@gmail.com', 'laliane', '$2y$10$.K7/a8BlhXoRcD5dwIniteKJqk2J7kVEu2BxkMBpg6UrJgewBMeNG', 1),
(2, 'Quentin ', 'elian.gym.95@gmail.com', 'LeQ', '$2y$10$Nqe1ob3ObV8UNoI87.6Kf.bCGHdikAciN3LWKY.z.y4b5iU89A24i', 0),
(3, 'Victor', 'elian.3run@gmail.com', 'Victouille', '$2y$10$Yc8x7UMbXfXz6pMVZO.NieCbq905sSTkDskU3c2PuTd4vLaKLZwVG', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`booksId`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

--
-- Index pour la table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`priceId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `booksId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
