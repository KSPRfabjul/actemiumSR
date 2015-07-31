-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 31 Juillet 2015 à 11:14
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
-- Vider la table avant d'insérer `accueil`
--

TRUNCATE TABLE `accueil`;
--
-- Contenu de la table `accueil`
--

INSERT INTO `accueil` (`id`, `value`, `date`) VALUES
(1, '<p>Bonjour, bienvenue dans la soci&eacute;t&eacute; <strong><span style="color: #014188;">ACTEMIUM</span> Saint-R&eacute;my</strong>.</p>', '2015-05-20');

-- --------------------------------------------------------

--
-- Structure de la table `affaire`
--

DROP TABLE IF EXISTS `affaire`;
CREATE TABLE `affaire` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chef_projet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `affaire`
--

TRUNCATE TABLE `affaire`;
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
-- Vider la table avant d'insérer `boite_idee`
--

TRUNCATE TABLE `boite_idee`;
--
-- Contenu de la table `boite_idee`
--

INSERT INTO `boite_idee` (`id`, `message`, `date`) VALUES
(1, '<p>Test boite a id&eacute;es</p>', '0000-00-00'),
(2, '<p>test boite</p>', '2015-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `categorie`
--

TRUNCATE TABLE `categorie`;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `date`
--

TRUNCATE TABLE `date`;
--
-- Contenu de la table `date`
--

INSERT INTO `date` (`id`, `date`, `id_visiteur`, `raison`) VALUES
(3, '2015-05-20', 9, 'test 9'),
(4, '2015-05-20', 9, 'test 10'),
(5, '2015-07-28', 12, 'Je suis une raison pour tester l''application'),
(6, '2015-07-28', 13, 'Raison de la visite numéro deux');

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
-- Vider la table avant d'insérer `disponibilite`
--

TRUNCATE TABLE `disponibilite`;
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
-- Vider la table avant d'insérer `emprunt`
--

TRUNCATE TABLE `emprunt`;
--
-- Contenu de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `date`, `id_outil`, `id_salarie`) VALUES
(2, '2015-05-22', 1, 1),
(3, '2015-06-10', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fichier_matrice`
--

DROP TABLE IF EXISTS `fichier_matrice`;
CREATE TABLE `fichier_matrice` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_sscat` int(11) NOT NULL,
  `date` date NOT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `fichier_matrice`
--

TRUNCATE TABLE `fichier_matrice`;
-- --------------------------------------------------------

--
-- Structure de la table `fichier_technique`
--

DROP TABLE IF EXISTS `fichier_technique`;
CREATE TABLE `fichier_technique` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fabricant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `fichier_technique`
--

TRUNCATE TABLE `fichier_technique`;
-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `news`
--

TRUNCATE TABLE `news`;
--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `message`, `date`) VALUES
(1, '<p>Test news 1</p>', '2015-07-01'),
(2, '<p>Test news 2</p>', '2015-07-02'),
(3, '<p>Test news 3</p>', '2015-07-03'),
(4, '<p>Test news 4</p>', '2015-07-04'),
(5, '<p>Test news 5</p>', '2015-07-05'),
(6, '<p>Test news 6</p>', '2015-07-06');

-- --------------------------------------------------------

--
-- Structure de la table `nomenclature`
--

DROP TABLE IF EXISTS `nomenclature`;
CREATE TABLE `nomenclature` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_affaire` int(11) NOT NULL,
  `date` date NOT NULL,
  `version` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `nomenclature`
--

TRUNCATE TABLE `nomenclature`;
--
-- Contenu de la table `nomenclature`
--

INSERT INTO `nomenclature` (`id`, `nom`, `extension`, `id_affaire`, `date`, `version`) VALUES
(14, 'Test', '.pdf', 4, '2015-07-31', '1');

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
-- Vider la table avant d'insérer `outil`
--

TRUNCATE TABLE `outil`;
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
-- Vider la table avant d'insérer `salarie`
--

TRUNCATE TABLE `salarie`;
--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id`, `identifiant`, `mdp`, `nom`, `prenom`, `mail`, `disponibilite`, `id_status`) VALUES
(1, 'jfabre', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Fabre', 'Julien', 'j.fabre19@gmail.com', '1', 2),
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 'admin', '2', 2),
(6, 'aduplissy', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Duplissy', 'Aurore', 'aurore.duplissy@actemium.com', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sscat`
--

DROP TABLE IF EXISTS `sscat`;
CREATE TABLE `sscat` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `sscat`
--

TRUNCATE TABLE `sscat`;
--
-- Contenu de la table `sscat`
--

INSERT INTO `sscat` (`id`, `nom`, `id_cat`) VALUES
(46, 'test', 10),
(47, 'vide 1', 10),
(48, 'vide 2', 10),
(50, 'Sous', 12),
(51, 'sous 1', 15),
(52, 'sous 2', 15),
(53, 'sous 2', 15),
(54, 'sous 4', 15),
(55, 'Première catégorie', 16),
(56, 'Seconde catégorie', 16),
(57, 'Troisième catégorie', 16),
(58, 'Première catégorie', 17),
(59, 'Deuxième catégorie', 17),
(60, 'Troisième catégorie', 17),
(61, 'Première catégorie renomée', 18),
(62, 'Deuxième catégorie', 18),
(64, 'Sous cat', 19),
(65, 'Sous cat 2', 19),
(66, 'SS CAT 1', 20);

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
-- Vider la table avant d'insérer `status`
--

TRUNCATE TABLE `status`;
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
-- Vider la table avant d'insérer `visite_future`
--

TRUNCATE TABLE `visite_future`;
--
-- Contenu de la table `visite_future`
--

INSERT INTO `visite_future` (`id`, `date`, `personnes`, `societe`, `raison`, `viennoiserie`, `restaurant`, `nb_personne`, `id_createur`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `visiteur`
--

TRUNCATE TABLE `visiteur`;
--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `entreprise`, `mail`, `telephone`) VALUES
(9, 'Fabre', 'Julien', 'corail', 'j@g.com', '0644306164'),
(12, 'Test', 'Final', 'Entreprise', 'mail@gmail.com', '0644306164'),
(13, 'Test', 'Final', 'Deuxieme', 'j.fabre19@gmail.com', '0644306164');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `accueil`
--
ALTER TABLE `accueil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `affaire`
--
ALTER TABLE `affaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boite_idee`
--
ALTER TABLE `boite_idee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
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
-- Index pour la table `fichier_matrice`
--
ALTER TABLE `fichier_matrice`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichier_technique`
--
ALTER TABLE `fichier_technique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nomenclature`
--
ALTER TABLE `nomenclature`
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
-- Index pour la table `sscat`
--
ALTER TABLE `sscat`
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
-- AUTO_INCREMENT pour la table `affaire`
--
ALTER TABLE `affaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `boite_idee`
--
ALTER TABLE `boite_idee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `date`
--
ALTER TABLE `date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
-- AUTO_INCREMENT pour la table `fichier_matrice`
--
ALTER TABLE `fichier_matrice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `fichier_technique`
--
ALTER TABLE `fichier_technique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `nomenclature`
--
ALTER TABLE `nomenclature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
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
-- AUTO_INCREMENT pour la table `sscat`
--
ALTER TABLE `sscat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;