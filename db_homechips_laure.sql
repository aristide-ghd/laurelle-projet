-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 18 déc. 2024 à 12:30
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_homechips_laure`
--

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

CREATE TABLE `depenses` (
  `idDepense` int(11) NOT NULL,
  `MontantDepense` varchar(20) NOT NULL,
  `DateDepense` date NOT NULL,
  `DescriptionDepense` varchar(255) NOT NULL,
  `idModePaiement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`idDepense`, `MontantDepense`, `DateDepense`, `DescriptionDepense`, `idModePaiement`) VALUES
(1, '2000 USD', '2024-08-21', 'Achat de banan', 2),
(2, '5600 USD', '2024-08-31', 'vuvuvu', 2),
(3, '3000 CFA', '2024-09-17', 'daccord', 4),
(4, '1000 CFA', '2024-10-31', 'bien', 5);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `email_business` varchar(50) NOT NULL,
  `nom_entreprise` varchar(50) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `idFournisseur` int(11) NOT NULL,
  `NomFournisseur` varchar(30) NOT NULL,
  `AdresseFournisseur` varchar(255) NOT NULL,
  `CoordonneesFournisseur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`idFournisseur`, `NomFournisseur`, `AdresseFournisseur`, `CoordonneesFournisseur`) VALUES
(1, 'Akaba', 'Tori', 'akaba@gmail.com'),
(2, 'John Doe', 'Ganvié', '+229 97 97 97 97'),
(3, 'Bio', 'Calavi', '+229 96 96 96 96'),
(4, 'Guera', 'Cotonou', '+229 56 56 56 56');

-- --------------------------------------------------------

--
-- Structure de la table `modepaiement`
--

CREATE TABLE `modepaiement` (
  `idModePaiement` int(11) NOT NULL,
  `NomModePaiement` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `modepaiement`
--

INSERT INTO `modepaiement` (`idModePaiement`, `NomModePaiement`) VALUES
(2, 'Mobile Money MTN'),
(3, 'Espèces'),
(4, 'Mobile Money Moov'),
(5, 'Carte UBA'),
(6, 'Carte EcoBank'),
(7, 'Carte BOA'),
(8, 'Par tranche');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `idProduit` int(11) NOT NULL,
  `NomProduit` varchar(20) NOT NULL,
  `DescriptionProduit` varchar(255) NOT NULL,
  `PrixVente` varchar(20) NOT NULL,
  `CoutUnitaire` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `NomProduit`, `DescriptionProduit`, `PrixVente`, `CoutUnitaire`) VALUES
(3, 'Patate douce', 'Aliment', '1200 USD', '700 USD'),
(4, 'Sardine', 'Aliment', '500 CFA', '400 CFA'),
(5, 'Cube', 'Aliment', '25 CFA', '15 CFA'),
(6, 'Spaghetti', 'Blé', '400 CFA', '350 CFA'),
(7, 'Salade', 'Légumes', '300 CFA', '150 CFA'),
(8, 'Pommade', 'Soins et beauté', '1500 EUR', '1000 EUR'),
(9, 'casquettes', 'habillement ', '2000 USD', '2000 USD'),
(10, 'Plastique', 'Objet', '1500 EUR', '1000 EUR'),
(11, 'coco', 'Aliment', '2000 USD', '1000 USD'),
(12, 'kghiyg', 'ljkibijk ', '100 EUR', '2000 EUR'),
(13, 'Fourré', 'Aliment', '2000 CFA', '1000 CFA');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `idRecette` int(11) NOT NULL,
  `MontantRecette` varchar(20) NOT NULL,
  `DateRecette` date NOT NULL,
  `DescriptionRecette` varchar(255) NOT NULL,
  `idModePaiement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`idRecette`, `MontantRecette`, `DateRecette`, `DescriptionRecette`, `idModePaiement`) VALUES
(2, '2000 EUR', '2024-08-31', 'Vente d´huile', 2),
(3, '600 USD', '2024-08-21', 'ggggg', 3),
(4, '2000 CFA', '2024-09-17', 'bien', 2),
(5, '1000 EUR', '2024-10-31', 'ok', 7);

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `idVente` int(11) NOT NULL,
  `DateVente` date NOT NULL,
  `QuantiteVendue` int(11) NOT NULL,
  `MontantTotal` varchar(20) NOT NULL,
  `idProduit` int(11) DEFAULT NULL,
  `idModePaiement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`idVente`, `DateVente`, `QuantiteVendue`, `MontantTotal`, `idProduit`, `idModePaiement`) VALUES
(1, '2024-09-17', 5, '5000 CFA', 4, 3),
(2, '2024-09-17', 3, '15000 CFA', 8, 2),
(3, '2024-10-31', 3, '1500 USD', 9, 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`idDepense`),
  ADD KEY `idModePaiement` (`idModePaiement`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`idFournisseur`);

--
-- Index pour la table `modepaiement`
--
ALTER TABLE `modepaiement`
  ADD PRIMARY KEY (`idModePaiement`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`idRecette`),
  ADD KEY `idModePaiement` (`idModePaiement`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`idVente`),
  ADD KEY `idProduit` (`idProduit`),
  ADD KEY `idModePaiement` (`idModePaiement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `idDepense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `idFournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `modepaiement`
--
ALTER TABLE `modepaiement`
  MODIFY `idModePaiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `idRecette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `idVente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD CONSTRAINT `depenses_ibfk_1` FOREIGN KEY (`idModePaiement`) REFERENCES `modepaiement` (`idModePaiement`) ON DELETE SET NULL;

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`idModePaiement`) REFERENCES `modepaiement` (`idModePaiement`) ON DELETE SET NULL;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`) ON DELETE SET NULL,
  ADD CONSTRAINT `ventes_ibfk_2` FOREIGN KEY (`idModePaiement`) REFERENCES `modepaiement` (`idModePaiement`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
