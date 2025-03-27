-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2025 at 02:29 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameslist_root`
--

-- --------------------------------------------------------

--
-- Table structure for table `console`
--

CREATE TABLE `console` (
  `console_id` int NOT NULL,
  `maker_id` int NOT NULL,
  `region` text NOT NULL,
  `name` text NOT NULL,
  `release_date` int NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `dev_id` int NOT NULL,
  `name` text NOT NULL,
  `website` text NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `format`
--

CREATE TABLE `format` (
  `format_id` int NOT NULL,
  `format` text NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int NOT NULL,
  `pub_id` int NOT NULL,
  `format_id` int NOT NULL,
  `dev_id` int NOT NULL,
  `region` text NOT NULL,
  `title` text NOT NULL,
  `age_rating` text NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maker`
--

CREATE TABLE `maker` (
  `maker_id` int NOT NULL,
  `name` text NOT NULL,
  `website` text NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE `owns` (
  `owns_id` int NOT NULL,
  `console_id` int NOT NULL,
  `purchase_date` int NOT NULL,
  `player_id` int NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `player_id` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date_added` int NOT NULL,
  `active` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plays`
--

CREATE TABLE `plays` (
  `plays_id` int NOT NULL,
  `player_id` int NOT NULL,
  `playson_id` int NOT NULL,
  `purchase_date` int NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playson`
--

CREATE TABLE `playson` (
  `playson_id` int NOT NULL,
  `game_id` int NOT NULL,
  `console_id` int NOT NULL,
  `release_date` int NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `pub_id` int NOT NULL,
  `name` text NOT NULL,
  `website` text NOT NULL,
  `date_added` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`console_id`),
  ADD KEY `maker_id` (`maker_id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`dev_id`);

--
-- Indexes for table `format`
--
ALTER TABLE `format`
  ADD PRIMARY KEY (`format_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `pub_id` (`pub_id`,`format_id`,`dev_id`),
  ADD KEY `format_id` (`format_id`),
  ADD KEY `dev_id` (`dev_id`);

--
-- Indexes for table `maker`
--
ALTER TABLE `maker`
  ADD PRIMARY KEY (`maker_id`);

--
-- Indexes for table `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`owns_id`),
  ADD KEY `console_id` (`console_id`,`player_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `plays`
--
ALTER TABLE `plays`
  ADD PRIMARY KEY (`plays_id`),
  ADD KEY `player_id` (`player_id`,`playson_id`),
  ADD KEY `playson_id` (`playson_id`);

--
-- Indexes for table `playson`
--
ALTER TABLE `playson`
  ADD PRIMARY KEY (`playson_id`),
  ADD KEY `game_id` (`game_id`,`console_id`),
  ADD KEY `console_id` (`console_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`pub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `console`
--
ALTER TABLE `console`
  MODIFY `console_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `dev_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `format`
--
ALTER TABLE `format`
  MODIFY `format_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maker`
--
ALTER TABLE `maker`
  MODIFY `maker_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owns`
--
ALTER TABLE `owns`
  MODIFY `owns_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `player_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plays`
--
ALTER TABLE `plays`
  MODIFY `plays_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playson`
--
ALTER TABLE `playson`
  MODIFY `playson_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `pub_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `console`
--
ALTER TABLE `console`
  ADD CONSTRAINT `console_ibfk_1` FOREIGN KEY (`maker_id`) REFERENCES `maker` (`maker_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`format_id`) REFERENCES `format` (`format_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`pub_id`) REFERENCES `publisher` (`pub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`dev_id`) REFERENCES `developer` (`dev_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`console_id`) REFERENCES `console` (`console_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plays`
--
ALTER TABLE `plays`
  ADD CONSTRAINT `plays_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plays_ibfk_2` FOREIGN KEY (`playson_id`) REFERENCES `playson` (`playson_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playson`
--
ALTER TABLE `playson`
  ADD CONSTRAINT `playson_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playson_ibfk_2` FOREIGN KEY (`console_id`) REFERENCES `console` (`console_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
