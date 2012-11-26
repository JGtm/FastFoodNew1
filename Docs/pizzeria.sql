-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 26 Novembre 2012 à 10:21
-- Version du serveur: 5.1.44
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pizzeria`
--

-- --------------------------------------------------------

--
-- Structure de la table `Bases`
--

CREATE TABLE IF NOT EXISTS `Bases` (
  `id_base` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_base` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_base`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Bases`
--

INSERT INTO `Bases` (`id_base`, `libelle_base`) VALUES
(1, 'Crème'),
(2, 'Tomate');

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE IF NOT EXISTS `Commandes` (
  `id_commande` int(12) NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `produits` varchar(255) DEFAULT NULL,
  `id_utilisateur` int(12) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `FK_Commandes_id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Commandes`
--


-- --------------------------------------------------------

--
-- Structure de la table `Composer`
--

CREATE TABLE IF NOT EXISTS `Composer` (
  `id_pizza` int(11) NOT NULL AUTO_INCREMENT,
  `id_ingredient` int(12) NOT NULL,
  PRIMARY KEY (`id_pizza`,`id_ingredient`),
  KEY `FK_Composer_id_ingredient` (`id_ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Composer`
--

INSERT INTO `Composer` (`id_pizza`, `id_ingredient`) VALUES
(0, 1),
(0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Comprendre`
--

CREATE TABLE IF NOT EXISTS `Comprendre` (
  `id_commande` int(12) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`,`id_produit`),
  KEY `FK_Comprendre_id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Comprendre`
--


-- --------------------------------------------------------

--
-- Structure de la table `Ingredients`
--

CREATE TABLE IF NOT EXISTS `Ingredients` (
  `id_ingredient` int(12) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Ingredients`
--

INSERT INTO `Ingredients` (`id_ingredient`, `libelle`, `prix`) VALUES
(1, 'jambon blanc', 2),
(2, 'Mozzarella', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Pizzas`
--

CREATE TABLE IF NOT EXISTS `Pizzas` (
  `id_pizza` int(11) NOT NULL AUTO_INCREMENT,
  `id_base` int(11) NOT NULL,
  PRIMARY KEY (`id_pizza`),
  KEY `FK_Pizzas_id_base` (`id_base`),
  KEY `id_pizza` (`id_pizza`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `Pizzas`
--

INSERT INTO `Pizzas` (`id_pizza`, `id_base`) VALUES
(0, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(36, 1),
(37, 1),
(38, 1),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Produits`
--

CREATE TABLE IF NOT EXISTS `Produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_produit` varchar(45) DEFAULT NULL,
  `prix_produit` float DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_type_produit` int(11) NOT NULL,
  `id_pizza` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  UNIQUE KEY `id_produit_2` (`id_produit`),
  KEY `FK_Produits_id_type_produit` (`id_type_produit`),
  KEY `id_pizza` (`id_pizza`),
  KEY `id_pizza_2` (`id_pizza`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `Produits`
--

INSERT INTO `Produits` (`id_produit`, `libelle_produit`, `prix_produit`, `description`, `image`, `id_type_produit`, `id_pizza`) VALUES
(1, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(2, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(3, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(4, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(5, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(6, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(7, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(8, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(9, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(10, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(11, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(12, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(13, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(14, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(15, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(16, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(17, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(18, 'salut', 0, 'ezfzef', 'zerzer', 1, 0),
(19, 'zerzez', 2, 'zrzeger', 'zerzer', 1, 0),
(20, 'zerzez', 2, 'zrzeger', 'zerzer', 1, 0),
(21, 'zerzez', 2, 'zrzeger', 'zerzer', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Types_produits`
--

CREATE TABLE IF NOT EXISTS `Types_produits` (
  `id_type_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_produit` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_type_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Types_produits`
--

INSERT INTO `Types_produits` (`id_type_produit`, `libelle_type_produit`) VALUES
(1, 'Pizza'),
(3, 'Boisson');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE IF NOT EXISTS `Utilisateurs` (
  `id_utilisateur` int(12) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `mdp` varchar(45) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `code_postal` varchar(45) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `qualite` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`id_utilisateur`, `email`, `mdp`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`, `qualite`) VALUES
(1, 'admin@pizza.fr', 'password', 'AD', 'MIN', '1 rue admin', '11111', '0000000000', 'AdminCity', 'SBO'),
(4, 'client@pizza.fr', 'password', 'nomclient', 'prenomClient', '1 rue du client', '11111', '2222222222', 'ClientCity', 'FO');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD CONSTRAINT `FK_Commandes_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `Composer`
--
ALTER TABLE `Composer`
  ADD CONSTRAINT `FK_Composer_id_ingredient` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id_ingredient`),
  ADD CONSTRAINT `FK_Composer_id_pizza` FOREIGN KEY (`id_pizza`) REFERENCES `pizzas` (`id_pizza`);

--
-- Contraintes pour la table `Comprendre`
--
ALTER TABLE `Comprendre`
  ADD CONSTRAINT `FK_Comprendre_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`),
  ADD CONSTRAINT `FK_Comprendre_id_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);
