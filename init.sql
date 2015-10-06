-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Serwer OS:                    debian-linux-gnu
-- HeidiSQL Wersja:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Zrzut struktury tabela ark.players
DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `ServerID` int(11) NOT NULL,
  `PlayerName` varchar(255) COLLATE utf8_bin NOT NULL,
  `PlayTime` decimal(12,4) DEFAULT NULL,
  `isOnline` tinyint(4) DEFAULT '1',
  `AddDate` timestamp NULL DEFAULT NULL,
  `ModDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ServerID`,`PlayerName`),
  KEY `ServerID` (`ServerID`),
  KEY `PlayerName` (`PlayerName`),
  KEY `isOnline` (`isOnline`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Data exporting was unselected.


-- Zrzut struktury tabela ark.servers
DROP TABLE IF EXISTS `servers`;
CREATE TABLE IF NOT EXISTS `servers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `queryport` int(11) DEFAULT '27015',
  `gameport` int(11) DEFAULT '7777',
  `gametype` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `host` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ServerName` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ServerVersion` decimal(7,1) DEFAULT NULL,
  `ServerType` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `ServerPlayers` tinyint(4) DEFAULT NULL,
  `ServerRealPlayers` tinyint(4) DEFAULT NULL,
  `ServerMaxPlayers` tinyint(4) DEFAULT NULL,
  `isOnline` tinyint(4) DEFAULT '0',
  `isActive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `host` (`host`),
  KEY `isOnline` (`isOnline`),
  KEY `isActive` (`isActive`),
  KEY `ServerType` (`ServerType`),
  KEY `ServerVersion` (`ServerVersion`),
  KEY `gametype` (`gametype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
