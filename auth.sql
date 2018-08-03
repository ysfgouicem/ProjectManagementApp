-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 03 août 2018 à 09:21
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `auth`
--

-- --------------------------------------------------------

--
-- Structure de la table `lifecycle`
--

CREATE TABLE `lifecycle` (
  `id` int(11) NOT NULL,
  `sales` tinyint(1) NOT NULL,
  `development` tinyint(1) NOT NULL,
  `testing` tinyint(1) NOT NULL,
  `release` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `name` varchar(25) NOT NULL,
  `nature` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `global_status` varchar(10) NOT NULL,
  `project_leader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`name`, `nature`, `description`, `status`, `global_status`, `project_leader`) VALUES
('Atom', 'issue reporting', 'boston update', 'open', 'on hold', 1),
('Bloomberg', 'fix integration', '', 'closed', 'closed', 1),
('Citi', 'algo update', 'all regions', 'closed', 'closed', 1),
('Goldman_sachs', 'fix integration', 'this is a test description  5 regions', 'open', 'active', 2),
('ITG', 'algo update', 'all regions 5 days ', 'open', 'active', 1),
('jefferies', 'algo update', 'all regions 5 days', 'open ', 'active', 1),
('liquidnet', 'fix integration', '', 'closed', 'closed', 1),
('macquarie', 'interface tweak', 'this is a description ', 'open', 'active', 2),
('MorganStanley', 'navbar widget issue', 'waiting for  region ', 'open', 'active', 1),
('Redburn', 'algo update', 'this is a description', 'open', 'active', 2),
('Scotiabank', 'missing feature ', 'data binding feature missing !!! (EU)', 'open', 'active', 1),
('SIG', 'algo update', 'all regions', 'closed', 'closed', 1),
('Societe_generale', 'algo update', 'waiting for EMEA region ', 'open', 'active', 1),
('Stifel', 'adding a feature', 'need a login feature (EU)', 'open', 'active', 2),
('Thomasweisel', 'database tweak', 'this is a description', 'open', 'active', 1),
('TrueEX', 'fix integration', 'scope needed', 'new', 'active', 2),
('UBS', 'algo update', 'all regions 5 days', 'open', 'active', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_role` tinyint(4) NOT NULL DEFAULT '1',
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  `user_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lifecycle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_email`, `user_password`, `user_role`, `user_status`, `user_created`, `lifecycle_id`) VALUES
(1, 'test@testing.com', '0859614c973701aafe47e4f6b8f750a5', 1, 1, '2018-07-18 09:42:36', 0),
(2, 'scott@linedata.com', 'ee28472ca2930159a386b2633e81b85b', 2, 2, '2018-07-19 15:47:56', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lifecycle`
--
ALTER TABLE `lifecycle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD UNIQUE KEY `unique` (`name`),
  ADD KEY `project_leader` (`project_leader`),
  ADD KEY `status` (`status`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lifecycle_id` (`lifecycle_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lifecycle`
--
ALTER TABLE `lifecycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lifecycle`
--
ALTER TABLE `lifecycle`
  ADD CONSTRAINT `lifecycle_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`lifecycle_id`);

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`project_leader`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id`) REFERENCES `project` (`project_leader`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
