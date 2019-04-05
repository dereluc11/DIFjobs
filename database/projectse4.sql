-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2018 at 10:00 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectse4`
--
CREATE DATABASE IF NOT EXISTS `projectse4` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projectse4`;

-- --------------------------------------------------------

--
-- Table structure for table `bedrijf`
--

CREATE TABLE `bedrijf` (
  `ID` int(4) NOT NULL,
  `naamBedrijf` varchar(100) NOT NULL,
  `websiteUrl` varchar(100) DEFAULT NULL,
  `tel_nummer` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bedrijf`
--

INSERT INTO `bedrijf` (`ID`, `naamBedrijf`, `websiteUrl`, `tel_nummer`) VALUES
(3, 'test', 'test.nl', '06123456789');

-- --------------------------------------------------------

--
-- Table structure for table `gebruiker`
--

CREATE TABLE `gebruiker` (
  `ID` int(4) NOT NULL,
  `Naam` varchar(150) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `AVGcheck` tinyint(1) NOT NULL,
  `verifiedCode` varchar(10) DEFAULT NULL,
  `veriefied` tinyint(1) NOT NULL,
  `Is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gebruiker`
--

INSERT INTO `gebruiker` (`ID`, `Naam`, `Wachtwoord`, `Email`, `AVGcheck`, `verifiedCode`, `veriefied`, `Is_admin`) VALUES
(1, 'admin', '$2y$10$bb0ZAI3nSbV26j1cg6PrAukzf/dpjdehEjRjzYZQb/uUdOGUQ9np6', 'admin@test.nl', 1, NULL, 1, 1),
(2, 'student', '$2y$10$i.jXWpAL1TvlGbouVKX4x.sTOVaykNysbq1hjoSEKY4wTtfWsdEkq', 'student@test.nl', 1, NULL, 1, 0),
(3, 'bedrijf', '$2y$10$MSZeBo6QclUcyN5SyMEnU.4qVgo4PdMIh0ZJuPhf1inYrlW8Nes.2', 'bedrijf@test.nl', 1, NULL, 1, 0),
(4, 'particulier', '$2y$10$.uCKDWzwsTAGwW3Re7eaLeTGUh6uQKbQchOVNR1NWVtaJn1z4orce', 'particulier@test.nl', 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `label_vacature`
--

CREATE TABLE `label_vacature` (
  `V_titel` varchar(255) NOT NULL,
  `V_datum` datetime NOT NULL,
  `V_gebruikerID` int(4) NOT NULL,
  `LID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `particulier`
--

CREATE TABLE `particulier` (
  `ID` int(4) NOT NULL,
  `tel_nummer` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `particulier`
--

INSERT INTO `particulier` (`ID`, `tel_nummer`) VALUES
(4, '06123456789');

-- --------------------------------------------------------

--
-- Table structure for table `reactie`
--

CREATE TABLE `reactie` (
  `SgebruikerID` int(4) NOT NULL,
  `Vtitel` varchar(255) NOT NULL,
  `Vdatum` datetime NOT NULL,
  `VgebruikerID` int(4) NOT NULL,
  `datum` datetime NOT NULL,
  `bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reactie`
--

INSERT INTO `reactie` (`SgebruikerID`, `Vtitel`, `Vdatum`, `VgebruikerID`, `datum`, `bericht`) VALUES
(2, 'programmeur voor kleine website', '2018-06-14 09:44:23', 3, '2018-06-14 09:52:27', 'ik wil wel helpen');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(4) NOT NULL,
  `Specialisatie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Specialisatie`) VALUES
(1, 'programmeur'),
(2, 'programmeur');

-- --------------------------------------------------------

--
-- Table structure for table `vacature`
--

CREATE TABLE `vacature` (
  `Titel` varchar(255) NOT NULL,
  `Datum` datetime NOT NULL,
  `Beschrijving` text NOT NULL,
  `Functie` varchar(50) NOT NULL,
  `Locatie` varchar(70) NOT NULL,
  `gebruikerID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacature`
--

INSERT INTO `vacature` (`Titel`, `Datum`, `Beschrijving`, `Functie`, `Locatie`, `gebruikerID`) VALUES
('programmeur voor kleine website', '2018-06-14 09:44:23', 'programmeur voor kleine website', 'webdeveloper', 'DIF', 3);

-- --------------------------------------------------------

--
-- Table structure for table `v_label`
--

CREATE TABLE `v_label` (
  `ID` int(2) NOT NULL,
  `Trefwoord` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_label`
--

INSERT INTO `v_label` (`ID`, `Trefwoord`) VALUES
(1, 'webdeveloper'),
(2, 'c# programmeur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bedrijf`
--
ALTER TABLE `bedrijf`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `label_vacature`
--
ALTER TABLE `label_vacature`
  ADD PRIMARY KEY (`V_titel`,`V_datum`,`V_gebruikerID`,`LID`),
  ADD KEY `label` (`LID`);

--
-- Indexes for table `particulier`
--
ALTER TABLE `particulier`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reactie`
--
ALTER TABLE `reactie`
  ADD PRIMARY KEY (`SgebruikerID`,`Vtitel`,`Vdatum`,`VgebruikerID`,`datum`),
  ADD KEY `vacatureReactie` (`Vtitel`,`Vdatum`,`VgebruikerID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vacature`
--
ALTER TABLE `vacature`
  ADD PRIMARY KEY (`Titel`,`Datum`,`gebruikerID`),
  ADD KEY `gebruikerID` (`gebruikerID`);

--
-- Indexes for table `v_label`
--
ALTER TABLE `v_label`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `v_label`
--
ALTER TABLE `v_label`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bedrijf`
--
ALTER TABLE `bedrijf`
  ADD CONSTRAINT `bedrijf_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `gebruiker` (`ID`);

--
-- Constraints for table `label_vacature`
--
ALTER TABLE `label_vacature`
  ADD CONSTRAINT `label` FOREIGN KEY (`LID`) REFERENCES `v_label` (`ID`),
  ADD CONSTRAINT `vacature` FOREIGN KEY (`V_titel`,`V_datum`,`V_gebruikerID`) REFERENCES `vacature` (`Titel`, `Datum`, `gebruikerID`);

--
-- Constraints for table `particulier`
--
ALTER TABLE `particulier`
  ADD CONSTRAINT `particulier_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `gebruiker` (`ID`);

--
-- Constraints for table `reactie`
--
ALTER TABLE `reactie`
  ADD CONSTRAINT `gebruikerReactie` FOREIGN KEY (`SgebruikerID`) REFERENCES `gebruiker` (`ID`),
  ADD CONSTRAINT `vacatureReactie` FOREIGN KEY (`Vtitel`,`Vdatum`,`VgebruikerID`) REFERENCES `vacature` (`Titel`, `Datum`, `gebruikerID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `gebruiker` (`ID`);

--
-- Constraints for table `vacature`
--
ALTER TABLE `vacature`
  ADD CONSTRAINT `vacature_ibfk_1` FOREIGN KEY (`gebruikerID`) REFERENCES `gebruiker` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
