-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 08 Juillet 2013 à 21:29
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `publication`
--
CREATE DATABASE `publication` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `publication`;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uti_id` int(11) DEFAULT NULL,
  `datecommande` date DEFAULT NULL,
  `reduction` int(11) DEFAULT NULL,
  `user` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6EEAA67D3951DF75` (`uti_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `uti_id`, `datecommande`, `reduction`, `user`) VALUES
(12, 12, '2013-06-05', 25, 'najib'),
(17, 13, '2013-06-05', 60, 'najib'),
(18, 14, '2013-06-05', 40, 'najib'),
(19, 15, '2013-06-10', 25, 'admin'),
(20, 16, '2013-06-05', 75, 'latifa'),
(21, 17, '2013-06-05', 70, 'latifa'),
(22, 18, '2013-06-05', 30, 'latifa'),
(23, 19, '2013-06-05', 60, 'latifa'),
(24, 20, '2013-06-05', 50, 'latifa'),
(25, 21, '2013-06-05', 45, 'latifa'),
(26, 22, '2013-06-05', 55, 'admin'),
(27, 23, '2013-06-06', 100, 'hamid'),
(28, 24, '2013-06-06', 50, 'admin'),
(29, 25, '2013-06-09', 100, 'latifa'),
(30, 26, '2013-06-16', 100, 'admin'),
(31, 27, '2013-06-19', 50, 'latifa'),
(32, 28, '2013-06-24', 25, 'admin'),
(33, 29, '2013-06-24', 100, 'admin'),
(34, 30, '2013-06-26', 25, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `detailscommande`
--

CREATE TABLE IF NOT EXISTS `detailscommande` (
  `qtecommande` int(11) DEFAULT NULL,
  `commande_id` int(11) NOT NULL,
  `ouvrage_id` int(11) NOT NULL,
  PRIMARY KEY (`commande_id`,`ouvrage_id`),
  KEY `IDX_FCF13E1182EA2E54` (`commande_id`),
  KEY `IDX_FCF13E1115D884B5` (`ouvrage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `detailscommande`
--

INSERT INTO `detailscommande` (`qtecommande`, `commande_id`, `ouvrage_id`) VALUES
(6, 12, 106),
(2, 12, 108),
(2, 17, 108),
(4, 18, 107),
(6, 18, 109),
(2, 19, 112),
(2, 19, 115),
(2, 20, 108),
(2, 21, 107),
(2, 21, 109),
(2, 22, 108),
(2, 22, 109),
(12, 23, 116),
(1, 24, 107),
(3, 24, 110),
(4, 24, 111),
(14, 24, 117),
(2, 25, 108),
(3, 25, 111),
(4, 25, 112),
(2, 26, 115),
(2, 27, 113),
(2, 27, 116),
(2, 28, 113),
(2, 28, 116),
(2, 29, 106),
(3, 30, 113),
(2, 30, 116),
(3, 31, 113),
(2, 31, 122),
(1, 32, 113),
(4, 32, 120),
(1, 33, 113),
(2, 33, 116),
(1, 34, 113),
(2, 34, 120);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id` int(11) DEFAULT NULL,
  `datefacture` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `com_id` (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`id`, `com_id`, `datefacture`) VALUES
(12, 12, '2013-06-05 03:31:07'),
(13, 17, '2013-06-05 03:44:54'),
(14, 18, '2013-06-05 03:45:51'),
(15, 19, '2013-06-05 03:45:51'),
(16, 20, '2013-06-05 09:07:31'),
(17, 21, '2013-06-05 09:19:06'),
(18, 22, '2013-06-05 09:21:08'),
(19, 23, '2013-06-05 09:28:51'),
(20, 24, '2013-06-05 09:45:57'),
(21, 25, '2013-06-05 09:53:47'),
(22, 26, '2013-06-05 14:57:11'),
(23, 27, '2013-06-06 03:16:49'),
(24, 28, '2013-06-06 19:43:39'),
(25, 29, '2013-06-09 23:51:20'),
(26, 30, '2013-06-16 11:23:27'),
(27, 31, '2013-06-19 09:18:40'),
(28, 32, '2013-06-24 10:14:21'),
(29, 33, '2013-06-24 23:55:50'),
(30, 34, '2013-06-26 13:53:16');

-- --------------------------------------------------------

--
-- Structure de la table `flshr_user`
--

CREATE TABLE IF NOT EXISTS `flshr_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B317D80A92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_B317D80AA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `flshr_user`
--

INSERT INTO `flshr_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(4, 'admin', 'admin', 'admin@gmail.Com', 'admin@gmail.com', 1, 'ejzbpviizrk800sgcgkcgo0cggoc4k8', 'HgTnRl/qfOqphHUfd9IrYje7fB2OuulCklbPZudWObkQ8ip6dIncz9iPngG9fh/+JwnrdudEGTwU+CKffKG7Zg==', '2013-06-27 09:59:05', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL),
(5, 'latifa', 'latifa', 'latifa@gmail.com', 'latifa@gmail.com', 1, 'j5rkzk4iglc04s8sw4w008okc4404cc', 'O3Vz9OqYssAeYmrN//11BGczsMxTIlUSWXLVDIeVM6qmImGem4Ih95pQdBp7kJyNrAl5g9XgknhAjSmpk14aIw==', '2013-06-27 09:48:05', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(6, 'hamid', 'hamid', 'hamid@gmail.com', 'hamid@gmail.com', 1, '9mn6tm9gbx0c0g0s88gs0gc4wsgg004', '1fJoiTukpMND1u/3eQEuaNciMCNFO4nVkZ2ecIu5EyjfBuDabDU2fYO5ctrhZ/WHOEq/8jVupd6Jz2skNsXtMQ==', '2013-06-06 03:15:16', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE IF NOT EXISTS `ouvrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(1024) DEFAULT NULL,
  `auteur` varchar(1024) DEFAULT NULL,
  `editeur` varchar(1024) DEFAULT NULL,
  `serie` varchar(1024) DEFAULT NULL,
  `impression` varchar(254) DEFAULT NULL,
  `depot_legal` varchar(1024) DEFAULT NULL,
  `isbn` varchar(254) DEFAULT NULL,
  `issn` varchar(254) DEFAULT NULL,
  `edition` varchar(254) DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `qutestocke` int(11) DEFAULT NULL,
  `photo` varchar(254) DEFAULT NULL,
  `descrption` varchar(1024) DEFAULT NULL,
  `dateentree` date DEFAULT NULL,
  `etat` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

--
-- Contenu de la table `ouvrage`
--

INSERT INTO `ouvrage` (`id`, `titre`, `auteur`, `editeur`, `serie`, `impression`, `depot_legal`, `isbn`, `issn`, `edition`, `prix`, `qutestocke`, `photo`, `descrption`, `dateentree`, `etat`) VALUES
(106, 'الفهرس العام لمجلة افاق', 'محمد يحيى', 'test', '13', 'bibliothéque nationnale', 'test', '1234', '12345', 'test', '202', 10, 'mohammed.png', 'test', '2008-01-18', 'stock'),
(107, 'مجتمع المواطنة ودول المؤسسات', 'كمال عبداللطيف', 'test', '54', 'bibliothéque nationnale', '123', '1233', '12345', 'test', '400', 5, 'test.png', 'test', '2008-01-01', 'stock'),
(108, 'من ايناون الى استانبول', 'عبد الاحد السبتي،عبد الرحيم بنحادة', 'test', '1234AAQ', 'ATN casa', '123', '123', '12345', 'test', '595', 2, 'aa.png', 'test', '2017-01-01', 'stock'),
(109, 'الرباط او الاوقات المغربية', 'الاخوان جون و جيروم طارو', 'test', '1234AAQ', 'bibliothéque nationnale', '12AQQ', '1234', '12345', 'test', '500', 2, 'aa.png', 'test', '2012-01-01', 'stock'),
(110, 'LA LANGUE BERBERE', 'ANDRE BASSET', 'test', '12', 'ATN casa', '123', '1234', '1233', 'test', '450', 3, 'aa.png', 'test', '2008-11-01', 'stock'),
(111, 'RABAT OU LES HEURES MAROCAINES', 'JERAUME ET JEAN THARAUD', 'Faculté des lettres et sciences humaines', '17', 'ATN casa', '12', '345', '356', 'test', '700', 2, 'aa.png', 'test', '2010-01-01', 'stock'),
(112, 'LA PETITE HISTOIRE DU RABAT', 'JACQUES CAILLE', 'bibliotheque nationale', '14', 'ATN casa', '123', '1234', '12345', 'test', '350', 9, 'aa.png', 'test', '2008-08-01', 'stock'),
(113, 'CONTES BERBERES DU MAROC', 'EMILELAOUST', 'bibliotheque nationale', '13', 'ATN casa', '12', '345', '12345', 'test', '700', 10, 'aa.png', 'test', '2014-01-01', 'stock'),
(114, 'RABAT ET SA REGION', 'TOME 2', 'bibliotheque nationale', '16', 'ATN casa', '12AQQ', '1234', '12345', 'test', '900', 10, 'aa.png', 'test', '2011-08-01', 'archive'),
(115, 'RABAT ET SA REGION', 'TOME 1', 'bibliotheque nationale', '15', 'ATN casa', '123', '123WAQ', '343', 'test', '500', 10, 'aa.png', 'test', '2015-01-01', 'stock'),
(116, 'REGION DES DOUKKALA', 'TOME 2', 'bibliotheque nationale', '1234AAQ', 'ATN casa', '123', '1234', '12345', 'test', '400', 10, 'aa.png', 'test', '2011-09-01', 'stock'),
(117, 'REGION DES DOUKKALA', 'TOME 1 LES DOUKKALA', 'bibliotheque nationale', '18', 'ATN casa', '12', '1234', '12345', 'test', '1000', 6, 'aa.png', 'test', '2008-01-01', 'stock'),
(118, 'قراءة في مدونات الشرق القديم و اعمال الاستاذ شحلان', 'الاستاذ شحلان', 'bibliotheque nationale', '169', 'ATN casa', '12', '1233', '12345', 'test', '600', 12, 'aa.png', 'test', '2008-09-01', 'archive'),
(119, 'VILLE ET ENVIRONNEMENT DURABLE EN AFRIQUE ET AU MOYEN-ORIENT', '??', 'Taoufik Agoumy et Mohammed Refass', '171', 'ATN casa', '123', '1234', '12345', 'test', '400', 12, 'aa.png', 'test', '2011-01-01', 'archive'),
(120, 'مدينة الرباط في القرن التاسع عشر(1818،1912', 'عبد العزيز الخمليشي', 'bibliotheque nationale', '66', 'ATN casa', '12', '1234', '12345', 'test', '780', 28, 'aa.png', 'test', '2008-01-01', 'stock'),
(121, 'السلطة العلمية و السلطة السياسيةة', 'حسن حفيظي علوي', 'bibliotheque nationale', '1234AAQ', 'ATN casa', '12AQQ', '1233', '12345', 'test', '345', 12, 'aa.png', 'test', '2008-10-01', 'stock'),
(122, 'المجاهد السلاوي محمد بن احمد العياشي', 'عبد اللطيف الشادلي', 'bibliotheque nationale', '1234AAQ', 'ATN casa', '123', '1234', '12345', 'test', '500', 10, 'aa.png', 'test', '2008-01-01', 'stock'),
(123, 'من الشاي الى الاتاي العادة و التاريخ', 'عبد الاحد السبتي،عبد الرحمان الخساسي', 'bibliotheque nationale', '1234AAQ', 'ATN casa', '12AQQ', '1234', '12345', 'test', '400', 12, 'aa.png', 'test', '2008-01-01', 'stock'),
(125, 'programmation C', 'TOME 2', 'Faculté des lettres et sciences humaines', '1234AAQ', 'ATN casa', '123', '1234', NULL, NULL, '3', 2, 'Hydrangeas.jpg', NULL, NULL, 'archive'),
(126, 'te', 'rze', 'Faculté des lettres et sciences humaines', 'zerz', 'rezer', NULL, NULL, NULL, NULL, '3', 2, NULL, NULL, NULL, 'archive'),
(127, 'aa', 'zz', 'Faculté des lettres et sciences humaines', 'zzz', 'zz', 'rr', 'rr', 'dd', 'dff', '2', 3, 'nijo.png', 'fs', '2015-08-13', 'stock');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeutilisateur` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cin` varchar(20) DEFAULT NULL,
  `cne` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `typeutilisateur`, `email`, `cin`, `cne`) VALUES
(12, 'Etudiant interne', 'najib@hotmai.com', NULL, NULL),
(13, 'Professeur interne', 'najib@hotmai.fr', NULL, NULL),
(14, 'Etudiant interne', 'najib@hotmai.com', NULL, NULL),
(15, 'Etudiant interne', 'najib@hotmai.com', NULL, NULL),
(16, 'Etudiant interne', 'reda@hotmai.fr', NULL, NULL),
(17, 'Professeur interne', 'najib@hotmai.com', NULL, NULL),
(18, 'Professeur interne', 'reda@hotmai.fr', NULL, NULL),
(19, 'Professeur interne', 'test@gmail.com', NULL, NULL),
(20, 'Etudiant interne', 'reda@hotmai.fr', NULL, 'AZDFDGF'),
(21, 'Professeur interne', 'reda@hotmai.fr', NULL, NULL),
(22, 'Professeur interne', 'najib@hotmai.com', NULL, NULL),
(23, 'Professeur interne', 'najib@hotmai.com', NULL, NULL),
(24, 'Professeur interne', 'najib@hotmai.com', NULL, NULL),
(25, 'Professeur interne', 'najib@hotmai.com', NULL, NULL),
(26, 'Professeur interne', 'najib@hotmai.co', NULL, NULL),
(27, 'Professeur interne', 'najib@hotmai.COM', NULL, NULL),
(28, 'Professeur interne', 'najib@hotmai.com', NULL, NULL),
(29, 'Etablissement', 'najib@hotmai.com', NULL, NULL),
(30, 'Professeur interne', 'najib@hotmai.com', NULL, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commander` FOREIGN KEY (`uti_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `detailscommande`
--
ALTER TABLE `detailscommande`
  ADD CONSTRAINT `FK_FCF13E1115D884B5` FOREIGN KEY (`ouvrage_id`) REFERENCES `ouvrage` (`id`),
  ADD CONSTRAINT `FK_FCF13E1182EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`com_id`) REFERENCES `commande` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
