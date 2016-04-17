-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2016 at 06:51 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockticker`
--

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `avatars`;
DROP TABLE IF EXISTS `movements`;
DROP TABLE IF EXISTS `transactions`;
DROP TABLE IF EXISTS `stocks`;
DROP TABLE IF EXISTS `passwords`;
DROP TABLE IF EXISTS `players`;

CREATE TABLE IF NOT EXISTS `stocks` (
  `Code` varchar(4) DEFAULT NULL,
  `Name` varchar(10) DEFAULT NULL,
  `Category` varchar(1) DEFAULT NULL,
  `Value` int(3) DEFAULT 0,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `Player` varchar(20) DEFAULT NULL,
  `Cash` int(4) DEFAULT NULL,
  PRIMARY KEY (`Player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`Player`, `Cash`) VALUES
('admin', 5000),
('player', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE IF NOT EXISTS `passwords` (
  `Player` varchar(20) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` varchar(6) NOT NULL DEFAULT 'Player',
  PRIMARY KEY (`Player`),
  FOREIGN KEY (`Player`)
    REFERENCES `players`(`Player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `passwords` (`Player`, `Password`, `Role`) VALUES
('admin', '$2y$10$/XezEnPTJhJgyZqXFMrf6.iShSkv0aKrR2lRnRT/lmXGVWL0meL4.', 'Admin');
INSERT INTO `passwords` (`Player`, `Password`) VALUES
('player', '$2y$10$oGuvoKZagaatA.ubUfqC8eaKG1soWcjrZn1G8w3WkMcouRkgUKo4S');


-- --------------------------------------------------------

--
-- Table structure for table `movements`
--


CREATE TABLE IF NOT EXISTS `movements` (
  `Datetime` varchar(19) DEFAULT NULL,
  `Code` varchar(4) DEFAULT NULL,
  `Action` varchar(4) DEFAULT NULL,
  `Amount` int(2) DEFAULT 0,
  FOREIGN KEY (`Code`)
    REFERENCES `stocks`(`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--


CREATE TABLE IF NOT EXISTS `transactions` (
  `DateTime` varchar(19) DEFAULT NULL,
  `Player` varchar(20) DEFAULT NULL,
  `Stock` varchar(4) DEFAULT NULL,
  `Trans` varchar(4) DEFAULT NULL,
  `Quantity` int(4) DEFAULT 0,
  FOREIGN KEY (`Player`)
    REFERENCES `players`(`Player`),
  FOREIGN KEY (`Stock`)
    REFERENCES `stocks`(`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--


CREATE TABLE IF NOT EXISTS `avatars` (
  `Player`  varchar(20)    NOT NULL,
  `Path`    varchar(256)  NOT NULL,
  `Image`   varchar(50)   NOT NULL,
  PRIMARY KEY (`Player`), 
  FOREIGN KEY (`Player`)
    REFERENCES `players`(`Player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;