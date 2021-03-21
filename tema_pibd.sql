-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2021 at 08:02 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tema_pibd`
--

-- --------------------------------------------------------

--
-- Table structure for table `angajati`
--

CREATE TABLE `angajati` (
  `idangajat` bigint NOT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `prenume` varchar(45) DEFAULT NULL,
  `functie` varchar(45) DEFAULT NULL,
  `experienta` int DEFAULT NULL,
  `salariu` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `angajati`
--

INSERT INTO `angajati` (`idangajat`, `nume`, `prenume`, `functie`, `experienta`, `salariu`) VALUES
(19, 'Popescu', 'Ion', 'manager', 5, 2000),
(20, 'Ionescu', 'Dorel', 'Economist', 8, 900),
(25, 'nume', 'prenume', 'fct', 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `reviewuri`
--

CREATE TABLE `reviewuri` (
  `idreview` bigint NOT NULL,
  `rating` int DEFAULT NULL,
  `comentariu` text,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviewuri`
--

INSERT INTO `reviewuri` (`idreview`, `rating`, `comentariu`, `data`) VALUES
(9, 6, 'A facut treaba buna !!!', '2021-02-08'),
(10, 4, 'Trebuie sa acorde mai multa atentie la detalii.', '2020-01-10'),
(14, 3, 'comentariu 3', '2021-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `sarcini`
--

CREATE TABLE `sarcini` (
  `idsarcina` bigint NOT NULL,
  `idangajat` bigint DEFAULT NULL,
  `idreview` bigint DEFAULT NULL,
  `sarcina` text,
  `dificultate` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sarcini`
--

INSERT INTO `sarcini` (`idsarcina`, `idangajat`, `idreview`, `sarcina`, `dificultate`) VALUES
(6, 20, 10, 'sa se ocupe de economii !!!', 'greu'),
(7, 19, 9, 'gestioneasa afacerea', 'ridicata'),
(10, 19, 9, 'test', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajati`
--
ALTER TABLE `angajati`
  ADD PRIMARY KEY (`idangajat`);

--
-- Indexes for table `reviewuri`
--
ALTER TABLE `reviewuri`
  ADD PRIMARY KEY (`idreview`);

--
-- Indexes for table `sarcini`
--
ALTER TABLE `sarcini`
  ADD PRIMARY KEY (`idsarcina`),
  ADD KEY `fk_1_idx` (`idangajat`),
  ADD KEY `fk_2_idx` (`idreview`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajati`
--
ALTER TABLE `angajati`
  MODIFY `idangajat` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reviewuri`
--
ALTER TABLE `reviewuri`
  MODIFY `idreview` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sarcini`
--
ALTER TABLE `sarcini`
  MODIFY `idsarcina` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sarcini`
--
ALTER TABLE `sarcini`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`idangajat`) REFERENCES `angajati` (`idangajat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`idreview`) REFERENCES `reviewuri` (`idreview`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
