-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 04 jan. 2022 à 17:58
-- Version du serveur :  10.5.12-MariaDB-0+deb11u1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kelghou`
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
CREATE TRIGGER `update_recette_note` AFTER INSERT ON `commentaires` FOR EACH ROW UPDATE recette set Note = (SELECT SUM(Note) / COUNT(*) FROM commentaires WHERE RecetteID = NEW.RecetteID) WHERE RecetteID = NEW.RecetteID
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
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `num` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `fait` tinyint(1) NOT NULL,
  `dateButoir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `num` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `fait` tinyint(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`num`, `libelle`, `fait`, `date`) VALUES
(1, 'hello', 0, '2021-11-23');

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
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`UserID`, `Statut`, `Username`, `Bio`, `Password`, `Email`, `Photo`, `Date`) VALUES
(5, 0, '$P', '$DecU', '$Mdp', '$M', '$adressPhotoProfil', '2022-01-04 16:54:31'),
(6, 0, 'kelghou', 'admin', '9d752daa3fb4df29837088e1e5a1acf74932e074', 'khalilelghoul01@gmail.com', 'default', '2022-01-04 16:55:17'),
(7, 0, 'Martin_Riandee', 'Utilisateur', 'd3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa', 'martin.riandee@gmail.com', 'default', '2022-01-04 17:02:00'),
(8, 0, 'test', 'test', '9d752daa3fb4df29837088e1e5a1acf74932e074', 'test@test.com', 'images/users/test/logo-UnivPSaclay-foncé.jpg', '2022-01-04 17:46:28'),
(9, 0, 'martineztg', 'je la ferme', 'bc9dc9257d3f5161617d3516545eb2ab19de8449', 'martinez@ftg.fr', 'images/users/martineztg/maxresdefault.jpg', '2022-01-04 17:51:50');

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

-- --------------------------------------------------------

--
-- Structure de la table `Voiture`
--

CREATE TABLE `Voiture` (
  `immatriculation` varchar(8) CHARACTER SET utf8 NOT NULL,
  `marque` varchar(25) CHARACTER SET utf8 NOT NULL,
  `couleur` varchar(12) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Voiture`
--

INSERT INTO `Voiture` (`immatriculation`, `marque`, `couleur`) VALUES
('111AA45', 'Peugeot', 'Violet'),
('2473RF45', 'Porsche', 'bleu'),
('467EF63', 'Maserati', 'Jaune'),
('DONALD01', 'Corvette', 'noir');

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
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`num`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`num`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`UserID`) USING BTREE,
  ADD UNIQUE KEY `UserID_unique_key` (`UserID`);

--
-- Index pour la table `Voiture`
--
ALTER TABLE `Voiture`
  ADD PRIMARY KEY (`immatriculation`);

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
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
