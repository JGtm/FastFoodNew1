-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 28 Novembre 2012 à 14:17
-- Version du serveur: 5.1.44
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `pizzeria`
--

-- --------------------------------------------------------

--
-- Structure de la table `Bases`
--

CREATE TABLE IF NOT EXISTS `Bases` (
  `id_base` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_base` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `Composer`
--

INSERT INTO `Composer` (`id_pizza`, `id_ingredient`) VALUES
(1, 1),
(2, 1),
(4, 1),
(6, 1),
(13, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(6, 2),
(11, 2),
(13, 2),
(2, 3),
(2, 4),
(13, 4),
(2, 5),
(13, 5),
(2, 6),
(13, 6),
(2, 7),
(2, 8),
(3, 9),
(3, 10),
(3, 11),
(13, 11),
(3, 12),
(4, 12),
(13, 13),
(11, 14),
(11, 15),
(11, 16),
(11, 17),
(6, 18),
(6, 19),
(13, 21),
(13, 22),
(13, 23);

-- --------------------------------------------------------

--
-- Structure de la table `Comprendre`
--

CREATE TABLE IF NOT EXISTS `Comprendre` (
  `id_commande` int(12) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `quantite` int(2) NOT NULL,
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
  `libelle` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `prix` float DEFAULT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `Ingredients`
--

INSERT INTO `Ingredients` (`id_ingredient`, `libelle`, `prix`) VALUES
(1, 'Sauce tomate', 1),
(2, 'Mozzarella', 1),
(3, 'Epinards', 5),
(4, 'Champignons', 1),
(5, 'Oignons', 1),
(6, 'Olives noires', 1),
(7, 'Tomates', 1),
(8, 'Origan', 1),
(9, 'Sauce barbecue', 1),
(10, 'Double poulet rôti', 3),
(11, 'Boulettes de boeuf épicé', 2.5),
(12, 'Merguez', 1),
(13, 'Jambon', 1),
(14, 'Crème fraîche', 1.5),
(15, 'Lardons fumés', 2),
(16, 'Pommes de terre', 2),
(17, 'Reblochon', 1),
(18, 'Fromage de chêvre', 1.5),
(19, 'Emmental', 1),
(20, 'Fourme Ambert', 2),
(21, 'Saucisson', 1),
(22, 'Pepperoni', 2.5),
(23, 'Poivrons verts', 0.5),
(24, 'Raclette', 1.5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `Pizzas`
--

INSERT INTO `Pizzas` (`id_pizza`, `id_base`) VALUES
(11, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(6, 2),
(13, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Produits`
--

CREATE TABLE IF NOT EXISTS `Produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_produit` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `prix_produit` float DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `id_type_produit` int(11) NOT NULL,
  `id_pizza` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `FK_Produits_id_type_produit` (`id_type_produit`),
  KEY `id_pizza` (`id_pizza`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `Produits`
--

INSERT INTO `Produits` (`id_produit`, `libelle_produit`, `prix_produit`, `description`, `image`, `id_type_produit`, `id_pizza`) VALUES
(22, 'Margherita', 7, NULL, 'images/margherita.jpg', 1, 1),
(23, 'Peppina', 7.5, NULL, 'images/peppina.jpg', 1, 2),
(24, 'La Cannibale', 7.5, NULL, 'images/cannibale.jpg', 1, 3),
(25, 'La Reine', 8, NULL, 'images/reine.jpg', 1, 4),
(27, 'La 4 Fromages', 8, NULL, 'images/4_fromages.jpg', 1, 6),
(32, 'La Savoyarde', 8, NULL, 'images/savoyarde.jpg', 1, 11),
(34, 'Extravaganzza', 8, NULL, 'images/extravaganzza.jpg', 1, 13),
(35, 'Coca', 3, NULL, 'images/coca.jpg', 3, 0),
(36, 'Pepsi', 4, NULL, 'images/pepsi.jpg', 3, 0),
(37, 'Perrier', 2.5, NULL, 'images/perrier.png', 3, NULL),
(38, 'Brownie', 3, NULL, 'images/brownie.jpg', 4, NULL),
(39, 'Cookie', 1, NULL, 'images/cookie.jpg', 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Types_produits`
--

CREATE TABLE IF NOT EXISTS `Types_produits` (
  `id_type_produit` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_produit` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_type_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Types_produits`
--

INSERT INTO `Types_produits` (`id_type_produit`, `libelle_type_produit`) VALUES
(1, 'Pizza'),
(3, 'Boisson'),
(4, 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE IF NOT EXISTS `Utilisateurs` (
  `id_utilisateur` int(12) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `mdp` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `nom` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `prenom` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `code_postal` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `ville` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `telephone` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `qualite` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`id_utilisateur`, `email`, `mdp`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`, `qualite`) VALUES
(1, 'admin@pizza.fr', 'password', 'AD', 'MIN', '1 rue admin', '11111', '0000000000', 'AdminCity', 'SBO'),
(4, 'client@pizza.fr', 'password', 'nomclient', 'prenomClient', '1 rue du client', '11111', '2222222222', 'ClientCity', 'FO'),
(5, 'tintin@free.fr', 'bite', 'Jean', 'Culasec', '1 rue Dlabit', '75001', 'Paris', '0123456788', 'BO');

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
