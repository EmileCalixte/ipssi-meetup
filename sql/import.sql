-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  mar. 03 sep. 2019 à 14:29
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
  `creator_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meetup`
--

INSERT INTO `meetup` (`id`, `title`, `description`, `creator_id`) VALUES
(1, 'PHP conference', 'A conference about PHP', 2),
(2, 'JS conference', 'A conference about Javascript', 3),
(3, 'Ruby conference', 'A conference about ruby and ruby on rails', 4);

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
  `register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password_hash`, `firstname`, `lastname`, `register_date`) VALUES
(1, 'calixte.emile@gmail.com', '$2y$10$rtvqadu/3cirawcONjhh4OXauAW2QcoP6dmfNRXCOrQDm3RGuPbwu', 'Emile', 'Calixte', '2019-09-02 09:10:13'),
(2, 'demo1@example.com', '$2y$13$YzH0mQT.X4DDqpGyjjRmku00uWDLC7cGtLKz3I4i1Jz2ZGhmHg8Pq', 'Demo1', 'User1', '2019-09-03 10:30:19'),
(3, 'demo2@example.com', '$2y$13$bDfNz6xv7djmTDbA5wHIUOrGcCGN24Q25JEKIpv8F57gq7NAAGVxa', 'Demo2', 'User2', '2019-09-03 10:30:56'),
(4, 'demo3@example.com', '$2y$13$bejzreZWBKRKWa9U92luUeYZ5gwe4U.PRdxVLPEn0lyuqXYYQHze.', 'Demo3', 'User3', '2019-09-03 10:31:18');

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
(1, 1, 2, 9),
(2, 2, 2, 3),
(3, 1, 3, 5),
(4, 2, 3, 9),
(5, 1, 4, 7),
(6, 2, 4, 8);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
