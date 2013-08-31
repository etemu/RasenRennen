-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: dd10004
-- Erstellungszeit: 05. Aug 2013 um 18:05
-- Server Version: 5.1.66-nmm3-log
-- PHP-Version: 5.3.18-nmm1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `d016d337`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `battles`
--

CREATE TABLE IF NOT EXISTS `battles` (
  `LaufID` int(11) NOT NULL AUTO_INCREMENT,
  `BattleID` int(11) NOT NULL,
  `StrtNr` int(11) NOT NULL,
  `Dummy1` int(11) NOT NULL,
  `Dummy2` int(11) NOT NULL,
  PRIMARY KEY (`LaufID`),
  KEY `LaufID` (`LaufID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Battlelaufe' AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rennen_1`
--

CREATE TABLE IF NOT EXISTS `rennen_1` (
  `Lauf_ID` int(3) NOT NULL AUTO_INCREMENT,
  `idRennen` int(3) NOT NULL,
  `StartNr` int(3) NOT NULL,
  `Laufzeit` bigint(20) DEFAULT NULL,
  `onTrack` tinyint(1) DEFAULT NULL,
  `Dummy2` int(3) DEFAULT NULL,
  PRIMARY KEY (`idRennen`,`StartNr`,`Lauf_ID`),
  UNIQUE KEY `Lauf_ID` (`Lauf_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Daten für Tabelle `rennen_1`
--

INSERT INTO `rennen_1` (`Lauf_ID`, `idRennen`, `StartNr`, `Laufzeit`, `onTrack`, `Dummy2`) VALUES
(52, 3, 1, 199402, 0, 0),
(53, 3, 2, 122669, 0, 0),
(54, 3, 3, 173496, 0, 0),
(55, 3, 4, 158511, 0, 0),
(56, 3, 5, 212816, 0, 0),
(57, 3, 6, 136399, 0, 0),
(58, 3, 7, 182490, 0, 0),
(59, 3, 8, 184673, 0, 0),
(60, 3, 9, 203873, 0, 0),
(61, 3, 10, 227626, 0, 0),
(62, 3, 11, 216479, 0, 0),
(63, 3, 12, 177122, 0, 0),
(64, 3, 13, 131023, 0, 0),
(65, 3, 14, 169490, 0, 0),
(66, 3, 15, 150564, 0, 0),
(67, 3, 16, 227007, 0, 0),
(68, 3, 17, 151417, 0, 0),
(69, 3, 18, 178722, 0, 0),
(70, 3, 19, 209993, 0, 0),
(71, 3, 20, 212252, 0, 0),
(72, 3, 21, 230325, 0, 0),
(73, 3, 22, 182373, 0, 0),
(74, 3, 23, 125006, 0, 0),
(75, 3, 24, 187972, 0, 0),
(76, 3, 25, 124874, 0, 0),
(77, 3, 26, 121633, 0, 0),
(78, 3, 27, 214369, 0, 0),
(79, 3, 28, 150893, 0, 0),
(80, 3, 29, 165813, 0, 0),
(81, 3, 30, 141500, 0, 0),
(82, 3, 31, 171328, 0, 0),
(83, 3, 32, 216490, 0, 0),
(84, 3, 33, 201076, 0, 0),
(85, 3, 34, 175096, 0, 0),
(86, 3, 35, 145737, 0, 0),
(87, 3, 36, 147608, 0, 0),
(88, 3, 37, 124918, 0, 0),
(89, 3, 38, 171295, 0, 0),
(90, 3, 39, 136098, 0, 0),
(91, 3, 40, 233335, 0, 0),
(92, 3, 41, 196300, 0, 0),
(93, 3, 42, 234500, 0, 0),
(94, 3, 43, 125277, 0, 0),
(95, 3, 44, 176843, 0, 0),
(96, 3, 45, 130378, 0, 0),
(97, 3, 46, 125255, 0, 0),
(98, 3, 47, 213651, 0, 0),
(99, 3, 48, 150970, 0, 0),
(100, 3, 49, 206737, 0, 0),
(101, 3, 50, 150483, 0, 0),
(1, 4, 1, 173899, 0, 0),
(2, 4, 2, 232922, 0, 0),
(3, 4, 3, 231178, 0, 0),
(4, 4, 4, 171149, 0, 0),
(5, 4, 5, 184852, 0, 0),
(6, 4, 6, 229406, 0, 0),
(7, 4, 7, 179235, 0, 0),
(8, 4, 8, 197831, 0, 0),
(9, 4, 9, 122186, 0, 0),
(10, 4, 10, 155489, 0, 0),
(11, 4, 11, 136029, 0, 0),
(12, 4, 12, 194396, 0, 0),
(13, 4, 13, 195300, 0, 0),
(14, 4, 14, 156687, 0, 0),
(15, 4, 15, 163846, 0, 0),
(16, 4, 16, 217577, 0, 0),
(17, 4, 17, 163282, 0, 0),
(18, 4, 18, 147927, 0, 0),
(19, 4, 19, 121384, 0, 0),
(20, 4, 20, 140789, 0, 0),
(21, 4, 21, 197329, 0, 0),
(22, 4, 22, 181201, 0, 0),
(23, 4, 23, 135860, 0, 0),
(24, 4, 24, 232834, 0, 0),
(25, 4, 25, 239719, 0, 0),
(26, 4, 26, 163729, 0, 0),
(27, 4, 27, 143481, 0, 0),
(28, 4, 28, 211476, 0, 0),
(29, 4, 29, 217965, 0, 0),
(30, 4, 30, 130444, 0, 0),
(31, 4, 31, 167003, 0, 0),
(32, 4, 32, 165754, 0, 0),
(33, 4, 33, 172991, 0, 0),
(34, 4, 34, 174510, 0, 0),
(35, 4, 35, 179187, 0, 0),
(36, 4, 36, 200673, 0, 0),
(37, 4, 37, 140006, 0, 0),
(38, 4, 38, 159642, 0, 0),
(39, 4, 39, 140815, 0, 0),
(40, 4, 40, 158067, 0, 0),
(41, 4, 41, 160895, 0, 0),
(42, 4, 42, 237975, 0, 0),
(43, 4, 43, 142112, 0, 0),
(44, 4, 44, 227414, 0, 0),
(45, 4, 45, 146832, 0, 0),
(46, 4, 46, 137223, 0, 0),
(47, 4, 47, 156240, 0, 0),
(48, 4, 48, 200285, 0, 0),
(49, 4, 49, 209872, 0, 0),
(50, 4, 50, 160887, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teilnehmer`
--

CREATE TABLE IF NOT EXISTS `teilnehmer` (
  `StartNr` int(1) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Vorname` varchar(20) NOT NULL,
  `Geburtsdatum` date NOT NULL,
  `Geschlecht` char(1) NOT NULL,
  `Team` varchar(20) NOT NULL,
  `Ort` varchar(20) NOT NULL,
  `KAT` varchar(10) NOT NULL,
  PRIMARY KEY (`StartNr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `teilnehmer`
--

INSERT INTO `teilnehmer` (`StartNr`, `Name`, `Vorname`, `Geburtsdatum`, `Geschlecht`, `Team`, `Ort`, `KAT`) VALUES
(1, 'N1', 'V1', '0000-00-00', '', 'frOErider', '', 'Men'),
(2, 'N2', 'V2', '0000-00-00', '', 'frOErider', '', 'Men'),
(3, 'N3', 'V3', '0000-00-00', '', 'frOErider', '', 'U17'),
(4, 'N4', 'V4', '0000-00-00', '', 'frOErider', '', 'Men'),
(5, 'N5', 'V5', '0000-00-00', '', 'frOErider', '', 'Men'),
(6, 'N6', 'V6', '0000-00-00', '', 'frOErider', '', 'Men'),
(7, 'N7', 'V7', '0000-00-00', '', 'frOErider', '', 'Men'),
(8, 'N8', 'V8', '0000-00-00', '', 'frOErider', '', 'U17'),
(9, 'N9', 'V9', '0000-00-00', '', 'frOErider', '', 'Men'),
(10, 'N10', 'V10', '0000-00-00', '', 'frOErider', '', 'Men'),
(11, 'N11', 'V11', '0000-00-00', '', 'frOErider', '', 'Men'),
(12, 'N12', 'V12', '0000-00-00', '', 'frOErider', '', 'Men'),
(13, 'N13', 'V13', '0000-00-00', '', 'frOErider', '', 'Men'),
(14, 'N14', 'V14', '0000-00-00', '', 'frOErider', '', 'Men'),
(15, 'N15', 'V15', '0000-00-00', '', 'frOErider', '', 'Men'),
(16, 'N16', 'V16', '0000-00-00', '', 'frOErider', '', 'U11'),
(17, 'N17', 'V17', '0000-00-00', '', 'frOErider', '', 'Men'),
(18, 'N18', 'V18', '0000-00-00', '', 'frOErider', '', 'Men'),
(19, 'N19', 'V19', '0000-00-00', '', 'frOErider', '', 'Men'),
(20, 'N20', 'V20', '0000-00-00', '', 'frOErider', '', 'Men'),
(21, 'N21', 'V21', '0000-00-00', '', 'frOErider', '', 'U11'),
(22, 'N22', 'V22', '0000-00-00', '', 'frOErider', '', 'Men'),
(23, 'N23', 'V23', '0000-00-00', '', 'frOErider', '', 'Men'),
(24, 'N24', 'V24', '0000-00-00', '', 'frOErider', '', 'Men'),
(25, 'N25', 'V25', '0000-00-00', '', 'frOErider', '', 'Men'),
(26, 'N26', 'V26', '0000-00-00', '', 'frOErider', '', 'Men'),
(27, 'N27', 'V27', '0000-00-00', '', 'frOErider', '', 'U11'),
(28, 'N28', 'V28', '0000-00-00', '', 'frOErider', '', 'Men'),
(29, 'N29', 'V29', '0000-00-00', '', 'frOErider', '', 'Men'),
(30, 'N30', 'V30', '0000-00-00', '', 'frOErider', '', 'Men'),
(31, 'N31', 'V31', '0000-00-00', '', 'frOErider', '', 'Men'),
(32, 'N32', 'V32', '0000-00-00', '', 'frOErider', '', 'Men'),
(33, 'N33', 'V33', '0000-00-00', '', 'frOErider', '', 'U17'),
(34, 'N34', 'V34', '0000-00-00', '', 'frOErider', '', 'Men'),
(35, 'N35', 'V35', '0000-00-00', '', 'frOErider', '', 'Women'),
(36, 'N36', 'V36', '0000-00-00', '', 'frOErider', '', 'Women'),
(37, 'N37', 'V37', '0000-00-00', '', 'frOErider', '', 'Women'),
(38, 'N38', 'V38', '0000-00-00', '', 'frOErider', '', 'Women'),
(39, 'N39', 'V39', '0000-00-00', '', 'frOErider', '', 'Women'),
(40, 'N40', 'V40', '0000-00-00', '', 'frOErider', '', 'Women'),
(41, 'N41', 'V41', '0000-00-00', '', 'frOErider', '', 'U17'),
(42, 'N42', 'V42', '0000-00-00', '', 'frOErider', '', 'Women'),
(43, 'N43', 'V43', '0000-00-00', '', 'frOErider', '', 'Women'),
(44, 'N44', 'V44', '0000-00-00', '', 'frOErider', '', 'Women'),
(45, 'N45', 'V45', '0000-00-00', '', 'frOErider', '', 'Women'),
(46, 'N46', 'V46', '0000-00-00', '', 'frOErider', '', 'Women'),
(47, 'N47', 'V47', '0000-00-00', '', 'frOErider', '', 'Women'),
(48, 'N48', 'V48', '0000-00-00', '', 'frOErider', '', 'Women'),
(49, 'N49', 'V49', '0000-00-00', '', 'frOErider', '', 'U17'),
(50, 'N50', 'V50', '0000-00-00', '', 'frOErider', '', 'Women');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
