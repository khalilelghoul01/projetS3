-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 jan. 2022 à 03:45
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `CategorieID` int(11) NOT NULL,
  `NomCategorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`CategorieID`, `NomCategorie`) VALUES
(1, 'Viandes'),
(2, 'Végetarien'),
(3, 'Poisson'),
(4, 'Desserts'),
(5, 'Entrées'),
(6, 'Boissons');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `CommentaireID` int(11) NOT NULL,
  `Corp` text NOT NULL,
  `RecetteID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Note` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déclencheurs `commentaires`
--
DELIMITER $$
CREATE TRIGGER `update_recette_note` AFTER INSERT ON `commentaires` FOR EACH ROW UPDATE recette set Note = (SELECT SUM(Note) / COUNT(*) FROM commentaires WHERE UserID = NEW.UserID) WHERE RecetteID = NEW.RecetteID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `IngredientID` int(11) NOT NULL,
  `NomIngredient` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `RecetteID` int(11) NOT NULL,
  `Titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `UserID` int(11) NOT NULL,
  `Etapes` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `Thumbnail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Duree` int(4) NOT NULL,
  `Niveau_Difficulte` int(1) NOT NULL,
  `NB_Personnes` int(11) NOT NULL,
  `Categorie` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Note` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `UserID` int(11) NOT NULL,
  `Statut` int(1) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Bio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Photo` varchar(1000) DEFAULT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déclencheurs `utilisateur`
--
DELIMITER $$
CREATE TRIGGER `on_user_delete_commentaire` AFTER DELETE ON `utilisateur` FOR EACH ROW DELETE FROM commentaires where UserID = UserID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_user_delete_recette` AFTER DELETE ON `utilisateur` FOR EACH ROW DELETE FROM recette where UserID = UserID
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`CategorieID`),
  ADD UNIQUE KEY `unique` (`CategorieID`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`CommentaireID`),
  ADD UNIQUE KEY `Commentaire_unique_key` (`CommentaireID`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`IngredientID`),
  ADD UNIQUE KEY `unique_ingredient` (`IngredientID`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`RecetteID`),
  ADD UNIQUE KEY `RecetteID_unique_key` (`RecetteID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`UserID`) USING BTREE,
  ADD UNIQUE KEY `UserID_unique_key` (`UserID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `CategorieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `CommentaireID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `IngredientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `RecetteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
