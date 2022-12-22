-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 22 déc. 2022 à 17:59
-- Version du serveur : 8.0.31-0ubuntu0.22.04.1
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdToDoChill`
--

-- --------------------------------------------------------

--
-- Structure de la table `Inscrit`
--

CREATE TABLE `Inscrit` (
  `mail` varchar(40) NOT NULL,
  `mdp` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Inscrit`
--

-- ajout d'un compte admin ayant pour mail "admin" et pour mot de passe "admin"
INSERT INTO `Inscrit` (`mail`, `mdp`, `isAdmin`) VALUES
('admin', '$2y$10$kS0exZw6F2ZJkeBfXzti9OUh1QR.yePlOSxLo/9NRInX33q4z2ndi', 1),

-- --------------------------------------------------------

--
-- Structure de la table `Task`
--

CREATE TABLE `Task` (
  `id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `idTasksList` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Task`
--

-- --------------------------------------------------------

--
-- Structure de la table `TasksList`
--

CREATE TABLE `TasksList` (
  `id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `mailUser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `TasksList`
--


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Inscrit`
--
ALTER TABLE `Inscrit`
  ADD PRIMARY KEY (`mail`);

--
-- Index pour la table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTasksList` (`idTasksList`);

--
-- Index pour la table `TasksList`
--
ALTER TABLE `TasksList`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mailUser` (`mailUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT pour la table `TasksList`
--
ALTER TABLE `TasksList`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Task`
--
ALTER TABLE `Task`
  ADD CONSTRAINT `Task_ibfk_1` FOREIGN KEY (`idTasksList`) REFERENCES `TasksList` (`id`);

--
-- Contraintes pour la table `TasksList`
--
ALTER TABLE `TasksList`
  ADD CONSTRAINT `TasksList_ibfk_1` FOREIGN KEY (`mailUser`) REFERENCES `Inscrit` (`mail`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
