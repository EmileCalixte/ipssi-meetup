-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  ven. 06 sep. 2019 à 14:21
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `yiiweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `meetup`
--

CREATE TABLE `meetup` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meetup`
--

INSERT INTO `meetup` (`id`, `title`, `description`, `creator_id`) VALUES
(1, 'PHP conference', 'A conference about PHP', 2),
(2, 'JS conference', 'A conference about Javascript', 3),
(3, 'Ruby conference', 'A conference about ruby and ruby on rails', 4),
(4, 'Java talks', 'Let\'s talk about Java', 3),
(5, 'Next Windows version', 'Speculations about the next features of the OS', 7),
(6, 'Next MacOS version', 'Speculations about the next features of the OS', 8),
(7, 'Docker pro-tips', 'Pro-tips about Docker', 6),
(8, 'Introduction to Travis', 'Some base knowledge about Travis', 2),
(9, 'PHPStorm features', 'Let\'s discuss about some PHPStorm features', 9),
(10, 'Introduction to Docker', 'Basic knowledge about Docker', 5),
(11, 'Introduction to Heroku', 'Basic knowledge about Heroku', 3),
(12, 'PHP 8 discussion', 'Let\'s talk about PHP 8', 3),
(13, 'C++ talks', 'Let\'s talk about C++', 5),
(14, 'Powershell pro-tips', 'Some expert tips about Powershell', 4),
(15, 'Javascript and Internet Explorer', 'A beautiful love story', 11);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `is_admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password_hash`, `firstname`, `lastname`, `register_date`, `is_admin`) VALUES
(2, 'demo1@example.com', '$2y$13$YzH0mQT.X4DDqpGyjjRmku00uWDLC7cGtLKz3I4i1Jz2ZGhmHg8Pq', 'Demo1', 'User1', '2019-09-03 10:30:19', b'0'),
(3, 'demo2@example.com', '$2y$13$bDfNz6xv7djmTDbA5wHIUOrGcCGN24Q25JEKIpv8F57gq7NAAGVxa', 'Demo2', 'User2', '2019-09-03 10:30:56', b'0'),
(4, 'demo3@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo3', 'User3', '2019-09-03 10:31:18', b'0'),
(5, 'demo4@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo4', 'User4', '2019-09-03 10:31:19', b'0'),
(6, 'demo5@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo5', 'User5', '2019-09-03 10:31:20', b'0'),
(7, 'demo6@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo6', 'User6', '2019-09-03 10:31:54', b'0'),
(8, 'demo7@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo7', 'User7', '2019-09-03 10:32:21', b'0'),
(9, 'demo8@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo8', 'User8', '2019-09-03 10:32:44', b'0'),
(10, 'demo9@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo9', 'User9', '2019-09-03 10:32:59', b'0'),
(11, 'demo10@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo10', 'User10', '2019-09-03 10:33:14', b'0'),
(13, 'demo11@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo11', 'User11', '2019-09-03 10:33:57', b'0'),
(14, 'admin@example.com', '$2y$13$oXgcSqPxBmSbxPrUGI.teuk1jHuvccLclEwO.WrqznHWpiAHS6Ryy', 'Demo', 'Admin', '2019-09-06 13:36:49', b'1');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `meetup_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `value` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `meetup_id`, `voter_id`, `value`) VALUES
(1, 1, 2, 4),
(2, 2, 2, 1),
(3, 1, 3, 2),
(4, 2, 3, 4),
(5, 1, 4, 3),
(6, 2, 4, 4),
(9, 13, 2, 2),
(10, 7, 2, 5),
(11, 10, 2, 2),
(12, 11, 2, 3),
(13, 8, 2, 3),
(14, 4, 2, 4),
(15, 15, 2, 5),
(16, 6, 2, 3),
(17, 5, 2, 5),
(18, 12, 2, 5),
(19, 9, 2, 2),
(20, 14, 2, 3),
(21, 3, 2, 4),
(22, 7, 3, 3),
(23, 11, 3, 1),
(24, 4, 3, 1),
(25, 5, 3, 4),
(26, 9, 3, 2),
(27, 3, 3, 2),
(28, 12, 4, 5),
(29, 13, 4, 5),
(30, 4, 4, 5),
(31, 5, 4, 1),
(32, 9, 4, 4),
(33, 1, 5, 5),
(34, 13, 5, 3),
(35, 10, 5, 3),
(36, 2, 5, 3),
(37, 9, 5, 2),
(38, 14, 5, 1),
(39, 4, 5, 4),
(40, 6, 5, 5),
(41, 12, 6, 5),
(42, 15, 6, 4),
(43, 3, 6, 4),
(44, 1, 6, 5),
(45, 5, 6, 4),
(46, 4, 6, 1),
(47, 14, 6, 5),
(48, 8, 6, 4),
(49, 13, 7, 5),
(50, 10, 7, 5),
(51, 4, 7, 5),
(52, 15, 7, 2),
(53, 12, 7, 4),
(54, 9, 7, 5),
(55, 1, 7, 4),
(56, 5, 7, 3),
(57, 6, 7, 5),
(58, 7, 8, 1),
(59, 2, 8, 5),
(60, 1, 8, 4),
(61, 14, 8, 5),
(62, 15, 8, 4),
(63, 12, 9, 4),
(64, 1, 9, 4),
(65, 5, 9, 5),
(66, 13, 9, 3),
(67, 3, 9, 1),
(68, 4, 9, 1),
(69, 11, 9, 3),
(70, 12, 11, 5),
(71, 5, 11, 3),
(72, 9, 11, 1),
(73, 1, 11, 4),
(74, 10, 11, 4),
(75, 7, 11, 5),
(76, 14, 11, 1),
(77, 12, 13, 4),
(78, 1, 13, 5),
(79, 5, 13, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `meetup`
--
ALTER TABLE `meetup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetup_creator_id` (`creator_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meetup_id_2` (`meetup_id`,`voter_id`),
  ADD KEY `meetup_id` (`meetup_id`),
  ADD KEY `voter_id` (`voter_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `meetup`
--
ALTER TABLE `meetup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `meetup`
--
ALTER TABLE `meetup`
  ADD CONSTRAINT `meetup_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_meetup_id` FOREIGN KEY (`meetup_id`) REFERENCES `meetup` (`id`),
  ADD CONSTRAINT `vote_voter_id` FOREIGN KEY (`voter_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
