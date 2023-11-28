-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 12:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_dataware`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `ProductOwnerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `ProjectName`, `ProductOwnerID`) VALUES
(1, 'DATA', 1),
(2, 'database analytique', 3),
(3, 'Wordpress', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projectteams`
--

CREATE TABLE `projectteams` (
  `ProjectID` int(11) NOT NULL,
  `TeamID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectteams`
--

INSERT INTO `projectteams` (`ProjectID`, `TeamID`) VALUES
(1, 2),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `teammembers` (
  `TeamID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teammembers`
--

INSERT INTO `teammembers` (`TeamID`, `UserID`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `TeamID` int(11) NOT NULL,
  `TeamName` varchar(100) NOT NULL,
  `ScrumMasterID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`TeamID`, `TeamName`, `ScrumMasterID`) VALUES
(1, 'Nighthclawres', 1),
(2, 'SA3ADA', 7),
(3, 'team loda', 1),
(4, 'team loda', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_User` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Tel` varchar(50) DEFAULT NULL,
  `PasswordU` varchar(255) NOT NULL,
  `UserRole` varchar(20) NOT NULL DEFAULT 'User',
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_User`, `Nom`, `Prenom`, `Email`, `Tel`, `PasswordU`, `UserRole`, `Image`) VALUES
(1, 'Talemsi', 'abdellah', 'mohamadtalemsi@gmail.com', '0625084897', '$2y$10$KS8C7k35b6I8PAT7AfxsZeVviu/Vun/Qj5DChkvJvSlkqQuIbn/Di', 'scrum_master', NULL),
(2, 'loulida', 'zakaria', 'zakarialoulida@gmail.com', '0625084898', '$2y$10$PyYMo7dI6l6uXKkBsq3yl./SGiFUYg2EIXwhsJbz7hodezjDWGt2K', 'product_owner', NULL),
(3, 'imad', 'din', 'imadin@gmail.com', '06250848854', '$2y$10$pOhK0BTA9bUAAtNto7FAL.R8kNGwOoHARQ6eUG51PkQQEktNwmhLG', 'product_owner', NULL),
(7, 'ZAKARIA', 'Houass', 'zakhouassi@gmail.com', '0256452478', '$2y$10$NGsT/KG2JcEYb5iAwmwa.u1npcInQSrDYh/Z8BMavGgTFtdJfhpju', 'scrum_master', NULL),
(8, 'hiba', 'lhbiba', 'hibalhbiba@gmail.com', '0212054585', '$2y$10$zNGAl5Bp6b35u6BgQnG/8u3wzaYg3Insm0CNlAfN2uvEPAgP2OTDO', 'product_owner', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`),
  ADD KEY `ProductOwnerID` (`ProductOwnerID`);

--
-- Indexes for table `projectteams`
--
ALTER TABLE `projectteams`
  ADD PRIMARY KEY (`ProjectID`,`TeamID`),
  ADD KEY `TeamID` (`TeamID`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD PRIMARY KEY (`TeamID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`TeamID`),
  ADD KEY `ScrumMasterID` (`ScrumMasterID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `TeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`ProductOwnerID`) REFERENCES `users` (`ID_User`);

--
-- Constraints for table `projectteams`
--
ALTER TABLE `projectteams`
  ADD CONSTRAINT `projectteams_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `projectteams_ibfk_2` FOREIGN KEY (`TeamID`) REFERENCES `teams` (`TeamID`);

--
-- Constraints for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD CONSTRAINT `teammembers_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `teams` (`TeamID`),
  ADD CONSTRAINT `teammembers_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID_User`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`ScrumMasterID`) REFERENCES `users` (`ID_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
