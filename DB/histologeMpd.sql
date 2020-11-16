
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



-- --------------------------------------------------------

--
-- Structure de la table `HAdresse_`
--

CREATE TABLE `HAdresse_` (
  `idAdresse` int(11) NOT NULL,
  `numeroRue` int(11) DEFAULT NULL,
  `compNumRue` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `etage` int(11) DEFAULT NULL,
  `numLog` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `nomRue` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `codepostal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HContact_P`
--

CREATE TABLE `HContact_P` (
  `idHContact_P` int(11) NOT NULL,
  `NomContact` varchar(45) DEFAULT NULL,
  `PrenomContact` varchar(45) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `courrielContact` varchar(255) DEFAULT NULL,
  `telContact` varchar(45) DEFAULT NULL,
  `prioContact` varchar(45) DEFAULT NULL,
  `idHPartenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HCritere2`
--

CREATE TABLE `HCritere2` (
  `idCritere` int(11) NOT NULL,
  `libCritere` varchar(1000) NOT NULL,
  `descCritere` mediumtext,
  `dtCreaCritere` datetime DEFAULT NULL,
  `dtModifCritere` datetime DEFAULT NULL,
  `poidsCritere` int(11) DEFAULT NULL,
  `idSituation_pb` int(11) NOT NULL,
  `danger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HCriticite`
--

CREATE TABLE `HCriticite` (
  `idCriticite` int(11) NOT NULL,
  `libCriticite` varchar(5000) NOT NULL,
  `ordreCriticite` int(11) NOT NULL,
  `idCritere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HDescription`
--

CREATE TABLE `HDescription` (
  `idDescription` int(11) NOT NULL,
  `libDesc` mediumtext CHARACTER SET latin1,
  `dtCreaDesc` datetime DEFAULT NULL,
  `dtModifDesc` datetime DEFAULT NULL,
  `idSignalement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HDroits_BO`
--

CREATE TABLE `HDroits_BO` (
  `idDroit` int(11) NOT NULL,
  `libDroit` varchar(255) COLLATE utf8_bin NOT NULL,
  `valueDroit` varchar(255) COLLATE utf8_bin NOT NULL,
  `dtCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HHoneyPot`
--

CREATE TABLE `HHoneyPot` (
  `idHoney` int(11) NOT NULL,
  `HoneyValues` varchar(5000) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HistoriqueResetMdp`
--

CREATE TABLE `HistoriqueResetMdp` (
  `idHistorique` int(11) NOT NULL,
  `dateReset` datetime DEFAULT NULL,
  `idUtilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HPartenaire`
--

CREATE TABLE `HPartenaire` (
  `idHPartenaire` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `libPartenaire` varchar(255) DEFAULT NULL,
  `descPartenaire` longtext,
  `dtCreaPartenaire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HPart_HDroit`
--

CREATE TABLE `HPart_HDroit` (
  `idPartenaire` int(11) NOT NULL,
  `idDroit` int(11) NOT NULL,
  `accesDroit` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HPhoto`
--

CREATE TABLE `HPhoto` (
  `idphoto` int(11) NOT NULL,
  `titreFichier` varchar(800) CHARACTER SET latin1 DEFAULT NULL,
  `dtCreaFichier` datetime DEFAULT NULL,
  `idSignalement` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HRdvVisit`
--

CREATE TABLE `HRdvVisit` (
  `idVisit` int(11) NOT NULL,
  `idSignalement` varchar(50) COLLATE utf8_bin NOT NULL,
  `dateVisit` varchar(50) COLLATE utf8_bin NOT NULL,
  `heureVisit` int(11) NOT NULL,
  `creaVisit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etatVisit` int(11) NOT NULL,
  `userBoVisit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HReponse`
--

CREATE TABLE `HReponse` (
  `idHReponse` int(11) NOT NULL,
  `typeRep` varchar(45) DEFAULT NULL,
  `libRep` longtext,
  `dtRep` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HSignalement_`
--

CREATE TABLE `HSignalement_` (
  `idSignalement` varchar(25) NOT NULL,
  `refSign` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `nomSign` varchar(255) NOT NULL,
  `prenomSign` varchar(255) DEFAULT NULL,
  `courriel` varchar(255) NOT NULL,
  `dtCreaSignalement` datetime DEFAULT NULL,
  `dtModifSignalement` datetime DEFAULT NULL,
  `idAdresse` int(11) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `description` longtext,
  `proprio_info` varchar(1) DEFAULT NULL,
  `modeInfoProprio` varchar(250) NOT NULL,
  `dtInfoProprio` varchar(12) NOT NULL,
  `anne_construct` datetime DEFAULT NULL,
  `infoNrj` varchar(25) NOT NULL,
  `logSoc` varchar(10) NOT NULL,
  `cgu` varchar(3) NOT NULL,
  `ar` int(11) NOT NULL DEFAULT '0',
  `etat` int(11) NOT NULL DEFAULT '0',
  `etatPart` int(11) NOT NULL DEFAULT '0',
  `geolocalisation` varchar(255) DEFAULT NULL,
  `OccupantsAdultes` int(11) NOT NULL,
  `OccupantsEnfants` int(11) NOT NULL,
  `Notation` int(11) NOT NULL DEFAULT '0',
  `dtPriseEnCharge` datetime NOT NULL,
  `suiviPar` varchar(255) DEFAULT NULL,
  `surface` int(11) DEFAULT NULL,
  `envoiMail` int(11) NOT NULL,
  `nbreRelances` int(11) NOT NULL,
  `dateRelance` date NOT NULL,
  `relanceKey` varchar(50) NOT NULL,
  `ddeVisitDist` int(11) NOT NULL DEFAULT '0',
  `dtCreaDdeVisit` datetime NOT NULL,
  `idUserBoVisit` int(11) NOT NULL,
  `cotationAuto` float DEFAULT NULL,
  `cotationSituations` float NOT NULL,
  `cotationCorrigee` float NOT NULL,
  `danger` int(11) NOT NULL,
  `isCAF` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HSignalement_HCritere`
--

CREATE TABLE `HSignalement_HCritere` (
  `idSignalement` varchar(25) NOT NULL,
  `idCritere` int(11) NOT NULL,
  `idCriticite` int(11) NOT NULL,
  `dtCrea` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HSignalement_T`
--

CREATE TABLE `HSignalement_T` (
  `idSignalement` varchar(25) NOT NULL,
  `idHPartenaire` int(11) NOT NULL,
  `idHReponse` int(11) DEFAULT NULL,
  `dtRelance` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HSign_HPart`
--

CREATE TABLE `HSign_HPart` (
  `idSignalement` varchar(30) NOT NULL,
  `idUserBO` int(11) NOT NULL,
  `dtAlert` datetime NOT NULL,
  `etat` int(11) NOT NULL,
  `dtRelance` datetime NOT NULL,
  `affect` int(11) NOT NULL DEFAULT '1',
  `dtAffect` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `affectBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HSituation_pb2`
--

CREATE TABLE `HSituation_pb2` (
  `idSituation_pb` int(11) NOT NULL,
  `libSituation` varchar(255) NOT NULL,
  `libSituationJS` varchar(255) NOT NULL,
  `libMenu` varchar(256) NOT NULL,
  `dtModif` date DEFAULT NULL,
  `actif` int(11) NOT NULL,
  `questSituation` varchar(255) NOT NULL,
  `ordrePresentation` int(3) NOT NULL,
  `libSituationCt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HSuivi`
--

CREATE TABLE `HSuivi` (
  `idSuivi` int(11) NOT NULL,
  `idSignalement` varchar(30) NOT NULL,
  `user` varchar(255) NOT NULL,
  `idPartenaire` int(11) NOT NULL,
  `dtSuivi` datetime NOT NULL,
  `ipSuivi` varchar(25) NOT NULL,
  `descSuivi` text NOT NULL,
  `avisUser` varchar(5) NOT NULL,
  `dtRelance` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Htrace`
--

CREATE TABLE `Htrace` (
  `idTrace` int(11) NOT NULL,
  `idSession` varchar(45) NOT NULL,
  `step` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `stepDate` datetime NOT NULL,
  `navigateur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `HTraceMail`
--

CREATE TABLE `HTraceMail` (
  `idTraceMail` int(11) NOT NULL,
  `sourceEnvoi` varchar(500) COLLATE utf8_bin NOT NULL,
  `destinataire` varchar(500) COLLATE utf8_bin NOT NULL,
  `cause` varchar(500) COLLATE utf8_bin NOT NULL,
  `dateEnvoi` datetime NOT NULL,
  `idValue` varchar(250) COLLATE utf8_bin NOT NULL,
  `expediteur` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HTraceSql`
--

CREATE TABLE `HTraceSql` (
  `idSql` int(11) NOT NULL,
  `sqlSend` varchar(2500) COLLATE utf8_bin NOT NULL,
  `fonction` varchar(2500) COLLATE utf8_bin NOT NULL,
  `dtCall` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HTraceUser`
--

CREATE TABLE `HTraceUser` (
  `idTraceUser` int(11) NOT NULL,
  `user` text COLLATE utf8_bin NOT NULL,
  `actionUser` text COLLATE utf8_bin NOT NULL,
  `dtAction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `HUsers_BO`
--

CREATE TABLE `HUsers_BO` (
  `id_userbo` int(11) NOT NULL,
  `nom_bo` varchar(250) NOT NULL,
  `prenom_bo` varchar(250) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  `login_bo` varchar(250) NOT NULL,
  `pws_bo` varchar(40) NOT NULL,
  `etatCompte` int(11) NOT NULL,
  `destSign` int(11) NOT NULL DEFAULT '0',
  `idPartenaire` int(11) NOT NULL,
  `showNews` int(11) NOT NULL DEFAULT '0',
  `envoiRapport` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `clef` int(11) DEFAULT NULL,
  `debutReset` datetime DEFAULT NULL,
  `finReset` datetime DEFAULT NULL,
  `Motif` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `HAdresse_`
--
ALTER TABLE `HAdresse_`
  ADD PRIMARY KEY (`idAdresse`);

--
-- Index pour la table `HContact_P`
--
ALTER TABLE `HContact_P`
  ADD PRIMARY KEY (`idHContact_P`,`idHPartenaire`),
  ADD KEY `fk_HContact_P_HPartenaire1_idx` (`idHPartenaire`);

--
-- Index pour la table `HCritere2`
--
ALTER TABLE `HCritere2`
  ADD PRIMARY KEY (`idCritere`,`idSituation_pb`),
  ADD KEY `fk_HCritere_HSituation_pb1_idx` (`idSituation_pb`);

--
-- Index pour la table `HCriticite`
--
ALTER TABLE `HCriticite`
  ADD PRIMARY KEY (`idCriticite`),
  ADD KEY `frg_key1` (`idCritere`);

--
-- Index pour la table `HDescription`
--
ALTER TABLE `HDescription`
  ADD PRIMARY KEY (`idDescription`,`idSignalement`),
  ADD KEY `fk_Description_Signalement1_idx` (`idSignalement`);

--
-- Index pour la table `HDroits_BO`
--
ALTER TABLE `HDroits_BO`
  ADD PRIMARY KEY (`idDroit`);

--
-- Index pour la table `HHoneyPot`
--
ALTER TABLE `HHoneyPot`
  ADD PRIMARY KEY (`idHoney`);

--
-- Index pour la table `HistoriqueResetMdp`
--
ALTER TABLE `HistoriqueResetMdp`
  ADD PRIMARY KEY (`idHistorique`);

--
-- Index pour la table `HPartenaire`
--
ALTER TABLE `HPartenaire`
  ADD PRIMARY KEY (`idHPartenaire`);

--
-- Index pour la table `HPart_HDroit`
--
ALTER TABLE `HPart_HDroit`
  ADD UNIQUE KEY `indDrt` (`idPartenaire`,`idDroit`);

--
-- Index pour la table `HPhoto`
--
ALTER TABLE `HPhoto`
  ADD PRIMARY KEY (`idphoto`,`idSignalement`),
  ADD KEY `fk_photo_Signalement1_idx` (`idSignalement`);

--
-- Index pour la table `HRdvVisit`
--
ALTER TABLE `HRdvVisit`
  ADD PRIMARY KEY (`idVisit`);

--
-- Index pour la table `HReponse`
--
ALTER TABLE `HReponse`
  ADD PRIMARY KEY (`idHReponse`);

--
-- Index pour la table `HSignalement_`
--
ALTER TABLE `HSignalement_`
  ADD PRIMARY KEY (`idSignalement`) USING BTREE;

--
-- Index pour la table `HSignalement_HCritere`
--
ALTER TABLE `HSignalement_HCritere`
  ADD PRIMARY KEY (`idSignalement`,`idCritere`);

--
-- Index pour la table `HSignalement_T`
--
ALTER TABLE `HSignalement_T`
  ADD PRIMARY KEY (`idSignalement`,`idHPartenaire`),
  ADD KEY `fk_HSignalement_has_HPartenaire_HPartenaire1_idx` (`idHPartenaire`),
  ADD KEY `fk_HSignalement_has_HPartenaire_HSignalement1_idx` (`idSignalement`);

--
-- Index pour la table `HSign_HPart`
--
ALTER TABLE `HSign_HPart`
  ADD KEY `idSignalement` (`idSignalement`,`idUserBO`);

--
-- Index pour la table `HSituation_pb2`
--
ALTER TABLE `HSituation_pb2`
  ADD PRIMARY KEY (`idSituation_pb`);

--
-- Index pour la table `HSuivi`
--
ALTER TABLE `HSuivi`
  ADD PRIMARY KEY (`idSuivi`);

--
-- Index pour la table `Htrace`
--
ALTER TABLE `Htrace`
  ADD PRIMARY KEY (`idTrace`);

--
-- Index pour la table `HTraceMail`
--
ALTER TABLE `HTraceMail`
  ADD PRIMARY KEY (`idTraceMail`);

--
-- Index pour la table `HTraceSql`
--
ALTER TABLE `HTraceSql`
  ADD PRIMARY KEY (`idSql`);

--
-- Index pour la table `HTraceUser`
--
ALTER TABLE `HTraceUser`
  ADD PRIMARY KEY (`idTraceUser`);

--
-- Index pour la table `HUsers_BO`
--
ALTER TABLE `HUsers_BO`
  ADD PRIMARY KEY (`id_userbo`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `HAdresse_`
--
ALTER TABLE `HAdresse_`
  MODIFY `idAdresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HContact_P`
--
ALTER TABLE `HContact_P`
  MODIFY `idHContact_P` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HCritere2`
--
ALTER TABLE `HCritere2`
  MODIFY `idCritere` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HCriticite`
--
ALTER TABLE `HCriticite`
  MODIFY `idCriticite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HDescription`
--
ALTER TABLE `HDescription`
  MODIFY `idDescription` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HDroits_BO`
--
ALTER TABLE `HDroits_BO`
  MODIFY `idDroit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HHoneyPot`
--
ALTER TABLE `HHoneyPot`
  MODIFY `idHoney` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HistoriqueResetMdp`
--
ALTER TABLE `HistoriqueResetMdp`
  MODIFY `idHistorique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HPartenaire`
--
ALTER TABLE `HPartenaire`
  MODIFY `idHPartenaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HPhoto`
--
ALTER TABLE `HPhoto`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HRdvVisit`
--
ALTER TABLE `HRdvVisit`
  MODIFY `idVisit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HReponse`
--
ALTER TABLE `HReponse`
  MODIFY `idHReponse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HSituation_pb2`
--
ALTER TABLE `HSituation_pb2`
  MODIFY `idSituation_pb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HSuivi`
--
ALTER TABLE `HSuivi`
  MODIFY `idSuivi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Htrace`
--
ALTER TABLE `Htrace`
  MODIFY `idTrace` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HTraceMail`
--
ALTER TABLE `HTraceMail`
  MODIFY `idTraceMail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HTraceSql`
--
ALTER TABLE `HTraceSql`
  MODIFY `idSql` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HTraceUser`
--
ALTER TABLE `HTraceUser`
  MODIFY `idTraceUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `HUsers_BO`
--
ALTER TABLE `HUsers_BO`
  MODIFY `id_userbo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `HContact_P`
--
ALTER TABLE `HContact_P`
  ADD CONSTRAINT `fk_HContact_P_HPartenaire1` FOREIGN KEY (`idHPartenaire`) REFERENCES `HPartenaire` (`idHPartenaire`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `HCritere2`
--
ALTER TABLE `HCritere2`
  ADD CONSTRAINT `fk_HCritere_HSituation_pb1` FOREIGN KEY (`idSituation_pb`) REFERENCES `HSituation_pb2` (`idSituation_pb`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `HCriticite`
--
ALTER TABLE `HCriticite`
  ADD CONSTRAINT `frg_key1` FOREIGN KEY (`idCritere`) REFERENCES `HCritere2` (`idCritere`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
