-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 20 Janvier 2016 à 10:49
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `demapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `modele` varchar(20) NOT NULL,
  `prix` float NOT NULL,
  `etat` varchar(8) NOT NULL,
  `telephone` int(11) NOT NULL,
  `commentaire` tinytext NOT NULL,
  `date_annonce` date NOT NULL,
  `id_membre` int(11) NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `avatar`, `marque`, `modele`, `prix`, `etat`, `telephone`, `commentaire`, `date_annonce`, `id_membre`) VALUES
(1, '', 'Nokia', 'Lumia 735', 278, 'Neuf', 753750536, 'Moins cher et parfait pour les selfies', '2015-12-31', 1),
(2, '', 'Microsoft', 'Lumia 950', 600, 'Neuf', 655555555, 'L''ensemble du système est très fluide et agréable à utiliser, et l''écosystème Windows m''a agréablement surpris par sa réactivité et par les fonctionnalités avancées proposées.', '2015-12-31', 2),
(3, '', 'Samsung', 'Galaxy S6', 200, 'Occasion', 655555555, 'super cool', '2015-12-31', 2),
(5, '', 'xPeria', 'M4', 100, 'Occasion', 753750536, 'Très Pratique !', '2016-01-01', 1),
(6, '', 'samsung', 'galaxy note', 100, 'Occasion', 766666666, 'Vous ne trouverez jamais mieux', '2016-01-03', 3),
(7, '', 'Sony Ericsons', 'tactile', 509, 'Neuf', 753750536, 'cool', '2016-01-03', 1),
(8, '', 'Motorola', 'v3i', 47, 'Occasion', 633333333, 'un vieux portable', '2016-01-04', 4);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_message` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `discussions`
--

INSERT INTO `discussions` (`ID`, `pseudo`, `message`, `date_message`) VALUES
(1, 'deen94', 'mon premier message dans mon forum', '0000-00-00 00:00:00'),
(2, 'roman', 'et voila mon second message', '0000-00-00 00:00:00'),
(3, 'maxim', 'et voilà mon troisieme message', '0000-00-00 00:00:00'),
(4, 'oscar', 'et voici mon quatrième message', '0000-00-00 00:00:00'),
(5, 'renegat', 'merci !', '0000-00-00 00:00:00'),
(15, 'adjibade', 'le fils du Roi', '0000-00-00 00:00:00'),
(16, 'le mexicain', '<strong>Papi papi Papi oulo. Papi papi papi biyami biyami', '0000-00-00 00:00:00'),
(17, 'adjibade', 'mon petit fils', '0000-00-00 00:00:00'),
(18, 'Dinos', 'Je viens du Bénin ! Je suis en troisième année de <strong>Bachelor</strong>', '0000-00-00 00:00:00'),
(19, 'Dinos', 'C''est toujours moi !', '0000-00-00 00:00:00'),
(20, 'Dinos', 'Un nouvel essai', '0000-00-00 00:00:00'),
(21, 'Dinos', 'Encore un nouvel essai !', '0000-00-00 00:00:00'),
(22, 'Dinos', 'Encore un nouvel essai !', '0000-00-00 00:00:00'),
(23, 'Dinos', 'Encore un nouvel essai !', '0000-00-00 00:00:00'),
(24, 'Zebre', 'Bonne nuit à tous !', '0000-00-00 00:00:00'),
(25, 'Zebre', 'Bonne nuit à tous !', '0000-00-00 00:00:00'),
(26, 'Zebre', 'Bonne nuit à tous !', '0000-00-00 00:00:00'),
(27, 'liono', 'oui oui !! bonne nuit à toi !', '0000-00-00 00:00:00'),
(28, 'Keleanor', 'BONJOUR', '0000-00-00 00:00:00'),
(29, 'deen', 'salut', '0000-00-00 00:00:00'),
(30, 'deen', '<strong>fhgjgjgj</strong>', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(10) NOT NULL AUTO_INCREMENT,
  `nom_membre` varchar(20) NOT NULL,
  `prenom_membre` varchar(30) NOT NULL,
  `pseudo_membre` varchar(32) NOT NULL,
  `adresse_mail` varchar(128) NOT NULL,
  `mot_de_passe` char(40) NOT NULL,
  `telephone` int(11) NOT NULL,
  `hash_validation` char(32) NOT NULL,
  `date_inscription` date NOT NULL,
  PRIMARY KEY (`id_membre`),
  UNIQUE KEY `nom_utilisateur` (`pseudo_membre`),
  UNIQUE KEY `adresse_mail` (`adresse_mail`),
  KEY `nom_utilisateur_2` (`pseudo_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `nom_membre`, `prenom_membre`, `pseudo_membre`, `adresse_mail`, `mot_de_passe`, `telephone`, `hash_validation`, `date_inscription`) VALUES
(1, 'Adjibadé', 'Mouyi-Deen', 'deen94', 'mouyideen@yahoo.fr', 'deenladen94', 753750536, '', '2015-12-29'),
(2, '', '', 'yesirath99', 'yesirath99@yahoo.fr', 'yesirath99', 655555555, '', '2015-12-29'),
(3, '', '', 'romeo_olaniyi', 'romeo92@gmail.com', 'romeo92', 766666666, '', '2015-12-30'),
(4, '', '', 'marcos56', 'marcos56@gmail.com', 'marcos56', 633333333, '', '2015-12-30'),
(5, '', '', 'hsmouadh', 'hsmouadh@gmail.com', 'hsmouadh', 640654471, '', '2015-12-31'),
(6, 'Lemaire', 'Julie', 'lemaire-julie', 'lemaire-julie@hotmail.fr', 'lemaire-julie', 646690259, '', '2015-12-31'),
(7, 'Duvieu', 'Thomas', 'thomasduvieu', 'thomasduvieu@gmail.com 	', 'thomasduvieu', 626346323, '', '2015-12-31'),
(8, 'Silagadze', 'Roman', 'roman', 'noobek@live.fr', 'noobek', 611945519, '', '2015-12-31'),
(9, 'Vivekananthan', 'Alain', 'alain', 'Alain.vivekananthan@hotmail.fr', 'vivekananthan', 608494969, '', '2016-01-01'),
(10, 'Castain', 'Amélie', 'amelie.castain', 'amelie.castain@gmail.com', 'amelie.castain', 608485168, '', '2016-01-02'),
(11, 'Collery', 'Adrien', 'adrien.collery', 'adrien.collery@gmail.com', 'adrien.collery', 615187484, '', '2016-01-02'),
(12, 'Maujean', 'Hector', 'hectormaujean', 'hectormaujean@gmail.com', 'hectormaujean', 608091342, '', '2016-01-03'),
(13, 'Clément', 'Pierre', 'pierre.clementh', 'pierre.clementh@gmail.com', 'pierre.clementh', 635443458, '', '2016-01-03'),
(14, 'Koussonda', 'Kèfil', 'kouskefil', 'kouskefil@gmail.com', 'kouskefil', 788888888, '', '2016-01-03'),
(15, 'Noroc', 'Dinu-Marius', 'dinu.marius.noroc', 'dinu.marius.noroc@gmail.com', 'dinu.marius.noroc', 644255719, '', '2016-01-04'),
(16, 'Mosbahi', 'Safouen', 'mosbahi.safouen', 'mosbahi.safouen@gmail.com', 'mosbahi.safouen', 623552241, '', '2016-01-09'),
(17, 'Delongeas', 'Théo', 'delongeas.theo', 'lasgnes@gmail.com', 'lasgnes', 686453132, '', '2016-01-10'),
(28, 'Mamadou', 'Ali', 'mali', 'mali@gmail.com', 'mali', 785506036, '', '0000-00-00'),
(29, 'Maga', 'Hubert', 'mahub', 'mahub@gmail.com', 'mahub', 746442121, '', '0000-00-00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `membre_annonce` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
