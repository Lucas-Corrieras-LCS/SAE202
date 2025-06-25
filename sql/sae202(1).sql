-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 25 juin 2025 à 06:44
-- Version du serveur : 10.11.11-MariaDB-0+deb12u1
-- Version de PHP : 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae202`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contenu` longtext NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_approved` tinyint(1) NOT NULL,
  `note` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `user_id`, `contenu`, `created_at`, `is_approved`, `note`) VALUES
(11, 1, '⭐️⭐️⭐️', '2025-06-23 21:29:37', 1, 3),
(12, 1, '🪬', '2025-06-23 21:29:48', 1, 5),
(13, 1, '👁️', '2025-06-23 21:29:51', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `expediteur_id` int(11) NOT NULL,
  `destinataire_id` int(11) NOT NULL,
  `contenu` longtext NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `is_verified`, `prenom`, `nom`, `telephone`, `age`, `is_admin`) VALUES
(1, 'lucascorrieras06@gmail.com', '$2y$13$47InJN4dB7DSPFDxBPFVOOLwALOcnAOBdDEIzmAYm5Ex8XGwc/1Nq', 0, 'Lucas', 'Corrieras', '0618053948', 19, 1),
(2, 'lucas.corrieras@etudiant.univ-reims.fr', '$2y$13$3nx4Wq..CBkORYszY6nhPefkMkrdql26hNhzs8TVyPe1WxljrFokS', 0, 'LucasUser', 'CorrierasUser', '0346592493', 19, 0),
(9, 'lou@gmail.com', '$2y$10$s70yNy70nxfo2r1Oui8P.u6XrqESl0xaOeTJIlzstA74p5sVOqvHq', 0, 'Lou', 'Calmes', '0346534567', 19, 0),
(10, 'rafael@ouriri.fr', '$2y$10$f30q4vStwfwf6ke3msSQ0uYH8BLzNcMWPx6FwzdSjbyegnPFI7yNG', 0, 'Rafael', 'Ouriri', '112', 40, 0),
(13, 'etan.laurent@etudiant.univ-reims.fr', '$2y$10$MQcaG.YQ2oiTZCnl2tcf.OsXIab7lmytxWlphodpVD90Fd44ZVbIy', 0, 'Etan', 'LAURENT', '0683610362', 56, 0),
(15, 'test@gmail.com', '$2y$10$7BesMz3Yj./xoYvmXSWMSeuVnxGY45IOVNReytj4VozxINl3zeHIC', 0, 'test', 'Test', '0000000000', 11, 0),
(16, 'Prof@mmi-troyes.fr', '$2y$10$euIU9BjjrQfWykeyxu.w3e6VAzeiKSPCsNa.UMBgckGZglK6o1doS', 0, 'Prof', 'Prof', '0000000000', 1, 1),
(18, 'tsyma13@gmail.com', '$2y$10$FRnpMBtZi.lWf0dpkrjI2e8i0N214uP2cUS14V6qkY7oEnPT.iv4O', 0, 'Mathis', 'Lemarié', '0640922785', 45, 0),
(19, 'kln@gmail.com', '$2y$10$8WRXCItjg0jrymXujePZyOhxzB0kBdnqKvVKbRGUVGFjCMWCYmeMO', 0, 'Kyllian', 'Edzoutsa', '0767167881', 18, 0),
(20, 'laurenehenriot@gmail.com', '$2y$10$cYUbsfh8eLBu5lYQmOzGPe1H2VX1G9fYcy3orF3Bx6AV/uMW5E.za', 0, 'Laurene', 'Henriot', '0769647379', 19, 0),
(21, 'chocohafsa@gmail.com', '$2y$10$ZS8IOxrxnCtixLf4RtbyYOv0YlV8OuE3fB1cV87Chi03aCp8n1j5.', 0, 'hafsa', 'senini', '0755325568', 20, 0),
(22, 'jeremyhorde5@icloud.com', '$2y$10$7csZ32CeaDvRYPtfQQJ/be6kluBMlwbS4naMeglnuSHYwgmHVC2Sm', 0, 'Jérémy', 'Hordé', '123', 22, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BCA76ED395` (`user_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307F10335F61` (`expediteur_id`),
  ADD KEY `IDX_B6BD307FA4F84F6E` (`destinataire_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307F10335F61` FOREIGN KEY (`expediteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FA4F84F6E` FOREIGN KEY (`destinataire_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
