-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 12 Juin 2015 à 08:09
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `actemium`
--
DROP DATABASE `actemium`;
CREATE DATABASE IF NOT EXISTS `actemium` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `actemium`;

-- --------------------------------------------------------

--
-- Structure de la table `accueil`
--

DROP TABLE IF EXISTS `accueil`;
CREATE TABLE `accueil` (
  `id` int(11) NOT NULL,
  `value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `accueil`
--

INSERT INTO `accueil` (`id`, `value`, `date`) VALUES
(1, '<p>Bonjour, bienvenue dans la soci&eacute;t&eacute; <strong><span style="color: #014188;">ACTEMIUM</span> Saint-R&eacute;my</strong>.</p>', '2015-05-20');

-- --------------------------------------------------------

--
-- Structure de la table `boite_idee`
--

DROP TABLE IF EXISTS `boite_idee`;
CREATE TABLE `boite_idee` (
  `id` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `boite_idee`
--

INSERT INTO `boite_idee` (`id`, `message`, `date`) VALUES
(1, '<p>Test boite a id&eacute;es</p>', '0000-00-00'),
(2, '<p>test boite</p>', '2015-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `date`
--

DROP TABLE IF EXISTS `date`;
CREATE TABLE `date` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_visiteur` int(11) NOT NULL,
  `raison` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `date`
--

INSERT INTO `date` (`id`, `date`, `id_visiteur`, `raison`) VALUES
(3, '2015-05-20', 9, 'test 9'),
(4, '2015-05-20', 9, 'test 10'),
(5, '2015-05-22', 10, 'test 1'),
(6, '2015-05-26', 11, 'test'),
(7, '2015-05-27', 12, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `disponibilite`
--

DROP TABLE IF EXISTS `disponibilite`;
CREATE TABLE `disponibilite` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `disponibilite`
--

INSERT INTO `disponibilite` (`id`, `nom`) VALUES
(1, 'Disponible'),
(2, 'Indisponible');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE `emprunt` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_outil` int(11) NOT NULL,
  `id_salarie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `date`, `id_outil`, `id_salarie`) VALUES
(2, '2015-05-22', 1, 1),
(3, '2015-06-10', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `outil`
--

DROP TABLE IF EXISTS `outil`;
CREATE TABLE `outil` (
  `id` int(11) NOT NULL,
  `nom` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `outil`
--

INSERT INTO `outil` (`id`, `nom`) VALUES
(1, 'Cable USB 3m'),
(2, 'Console SIEMENS'),
(3, 'Cable ethernet');

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

DROP TABLE IF EXISTS `salarie`;
CREATE TABLE `salarie` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `disponibilite` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id`, `identifiant`, `mdp`, `nom`, `prenom`, `mail`, `disponibilite`, `id_status`) VALUES
(1, 'jfabre', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Fabre', 'Julien', 'j.fabre19@gmail.com', '1', 2),
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 'admin', '2', 2),
(5, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Test', 'Normal', 'test@tets.com', '2', 1),
(6, 'aduplissy', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Duplissy', 'Aurore', 'aurore.duplissy@actemium.com', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Neutre'),
(2, 'Administrateur'),
(3, 'Essais'),
(4, 'Magasin');

-- --------------------------------------------------------

--
-- Structure de la table `visite_future`
--

DROP TABLE IF EXISTS `visite_future`;
CREATE TABLE `visite_future` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `personnes` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `societe` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `raison` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `viennoiserie` tinyint(1) NOT NULL,
  `restaurant` tinyint(1) NOT NULL,
  `nb_personne` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `visite_future`
--

INSERT INTO `visite_future` (`id`, `date`, `personnes`, `societe`, `raison`, `viennoiserie`, `restaurant`, `nb_personne`, `id_createur`) VALUES
(1, '2015-05-27', 'Julien Fabre; Test Test', 'test', 'Test programmation', 0, 0, 8, 1),
(2, '2015-05-29', 'test test', 'test', 'test visite 6', 1, 1, 4, 1),
(3, '2015-05-15', 'test test', 'test', 'test visite 7', 1, 1, 3, 1),
(5, '2015-05-16', 'test', 'test', 'testvisite 6', 1, 1, 4, 1),
(6, '2015-05-05', 'Julien', 'test', 'test', 1, 0, 0, 1),
(7, '2015-05-06', 'test', 'test', 'test', 0, 0, 0, 1),
(8, '2015-05-06', 'test', 'test', 'test', 1, 1, 0, 1),
(9, '2015-05-30', '<p>test visite</p>', 'test', '<p>test visite</p>', 1, 1, 2, 4),
(10, '2015-05-28', '<p>Test</p>', 'test', '<p>etsstes</p>', 1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE `visiteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `entreprise` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `entreprise`, `mail`, `telephone`) VALUES
(9, 'Fabre', 'Julien', 'corail', 'j@g.com', '0644306164'),
(10, 'Test', 'Test', 'test', 'test@test.com', '0123456789'),
(11, 'TEST', 'Test', 'corail', 'test@test.com', '0123456789'),
(12, 'Ts', 'ts', 'tst', 'tst@ui', '0123456789');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `accueil`
--
ALTER TABLE `accueil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boite_idee`
--
ALTER TABLE `boite_idee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `outil`
--
ALTER TABLE `outil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visite_future`
--
ALTER TABLE `visite_future`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `accueil`
--
ALTER TABLE `accueil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `boite_idee`
--
ALTER TABLE `boite_idee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `date`
--
ALTER TABLE `date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `outil`
--
ALTER TABLE `outil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `visite_future`
--
ALTER TABLE `visite_future`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;