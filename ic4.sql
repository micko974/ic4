-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 07 Avril 2013 à 11:21
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ic4`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `idAtt` int(11) NOT NULL AUTO_INCREMENT,
  `idDev` int(11) NOT NULL,
  `IPAddress` varchar(255) NOT NULL,
  `MACAddress` varchar(255) NOT NULL,
  `Capacite` varchar(255) NOT NULL,
  `MemDispo` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`idAtt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `idDev` int(11) NOT NULL AUTO_INCREMENT,
  `typeDev` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `hostname` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idDev`),
  UNIQUE KEY `id` (`idDev`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
