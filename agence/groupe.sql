-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 24 fév. 2023 à 13:14
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `groupe`
--

-- --------------------------------------------------------

--
-- Structure de la table `announce`
--

CREATE TABLE `announce` (
  `numero_annouce` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `description` varchar(700) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  `categorie` varchar(50) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `numero_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `announce`
--

INSERT INTO `announce` (`numero_annouce`, `titre`, `description`, `prix`, `date_publication`, `date_modification`, `categorie`, `Type`, `code_postal`, `Ville`, `numero_client`) VALUES
(3, 'dar lilbay3', 'alksajsdoah ihsoihcois scbosbc socibsoibc scbsoibc', 300, '2023-02-19', NULL, 'location', 'villa', 90010, 'rabat', 1),
(6, 'dar lilbay3', 'alksajsdoah ihsoihcois scbosbc socibsoibc scbsoibc', 300, '2023-02-19', NULL, 'location', 'villa', 90010, 'rabat', 1),
(7, 'Villa for sale66', 'Tom B. Erichsen Tom B. Erichsen Tom B. Erichsen Tom B. Erichsen Tom B. Erichsen', 230, '2023-02-20', NULL, 'vente', 'maison', 90010, 'tangier', 1),
(11, 'hadira kabira', 'Tom B. Erichsen Tom B. Erichsen Tom B. Erichsen Tom B. Erichsen Tom B. Erichsen', 20000, '2023-02-23', NULL, 'location', 'terrain', 90020, 'meknes', 1),
(12, 'villa saghira', 'alksajsdoah ihsoihcois scbosbc socibsoibc scbsoibc', 30500, '2023-02-17', NULL, 'location', 'villa', 90010, 'tangier', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `numero_client` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse_email` varchar(500) DEFAULT NULL,
  `mot_passe` varchar(50) DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numero_client`, `nom`, `prenom`, `adresse_email`, `mot_passe`, `telephone`) VALUES
(1, 'adam', 'moali', 'adamloali@example.com', 'moali123', 154879645);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `image` varchar(3000) NOT NULL,
  `check_image` tinyint(1) NOT NULL,
  `numero_annouce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`numero_annouce`),
  ADD KEY `numero_client` (`numero_client`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numero_client`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD KEY `numero_annouce` (`numero_annouce`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `announce`
--
ALTER TABLE `announce`
  MODIFY `numero_annouce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `numero_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `announce`
--
ALTER TABLE `announce`
  ADD CONSTRAINT `announce_ibfk_1` FOREIGN KEY (`numero_client`) REFERENCES `client` (`numero_client`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`numero_annouce`) REFERENCES `announce` (`numero_annouce`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
