-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 03 mars 2024 à 01:06
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `suivi_vente`
--

-- --------------------------------------------------------

--
-- Structure de la table `enregistrement`
--

CREATE TABLE `enregistrement` (
  `idenreg` int(11) NOT NULL,
  `datenreg` date NOT NULL,
  `descriptionenreg` varchar(255) NOT NULL,
  `typenreg` varchar(20) NOT NULL,
  `montantenreg` decimal(10,2) NOT NULL,
  `categorienreg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enregistrement`
--

INSERT INTO `enregistrement` (`idenreg`, `datenreg`, `descriptionenreg`, `typenreg`, `montantenreg`, `categorienreg`) VALUES
(1, '2024-01-05', 'Livraison ', 'depenses', 1000.00, 'Transport '),
(2, '2024-01-05', 'Achat de banane ', 'depenses', 2500.00, 'Alimentation '),
(3, '2024-02-01', 'Vente de chips', 'recettes', 500.00, 'Alimentaire'),
(4, '2024-02-08', 'banane', 'recettes', 1000.00, 'Alimentation');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enregistrement`
--
ALTER TABLE `enregistrement`
  ADD PRIMARY KEY (`idenreg`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enregistrement`
--
ALTER TABLE `enregistrement`
  MODIFY `idenreg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
