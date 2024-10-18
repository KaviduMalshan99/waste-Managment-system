-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 08:06 PM
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
-- Database: `waste_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `waste_pickups`
--

CREATE TABLE `waste_pickups` (
  `pickup_id` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `waste_type` varchar(50) NOT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `actual_weight` decimal(10,2) DEFAULT NULL,
  `collected` tinyint(1) DEFAULT 0,
  `weight` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `waste_pickups`
--

INSERT INTO `waste_pickups` (`pickup_id`, `first_name`, `last_name`, `company_name`, `address`, `post_code`, `description`, `email`, `subject`, `pickup_date`, `pickup_time`, `latitude`, `longitude`, `waste_type`, `qr_code_path`, `actual_weight`, `collected`, `weight`) VALUES
('pickup_671146fb010096.54868660', 'vihan', 'gamaka', '', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', '', 'Gamakavihan2002@gmail.com', '', '2024-10-18', '10:48:00', 0.00000000, 0.00000000, '1', NULL, NULL, 1, 666.00),
('pickup_67114729a23328.83774598', 'vihan', 'gamaka', 'jhji', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', 'rfewre', 'Gamakavihan2002@gmail.com', 'ewrew', '2024-10-18', '10:48:00', 6.93401746, 79.89484563, '2', NULL, NULL, 1, 66.00),
('pickup_67114746173f15.44795375', 'vihan', 'gamaka', 'ewe', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', 'ewew', 'Gamakavihan2002@gmail.com', 'weweewe', '2024-10-23', '22:59:00', 6.88323380, 79.88694921, '2', NULL, NULL, 1, 10.00),
('pickup_6711475767f5e4.29903722', 'vihan', 'gamaka', 'ewew', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', 'ewew', 'Gamakavihan2002@gmail.com', 'wewe', '2024-10-23', '10:53:00', 6.91765822, 79.86806646, '1', NULL, NULL, 1, 56.00),
('pickup_67114936ac58a8.88472108', 'vihan', 'gamaka', 'jhji', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', 'rfewre', 'Gamakavihan2002@gmail.com', 'ewrew', '2024-10-18', '10:48:00', 6.93401746, 79.88832250, '1', NULL, NULL, 0, 0.00),
('pickup_67114e38bd43f5.89303322', 'vihan', 'gamaka', 'gggggggg', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', 'gggggggggggg', 'Gamakavihan2002@gmail.com', 'gggg', '2024-10-29', '11:22:00', 6.91765822, 79.87012639, '1', NULL, NULL, 1, 77.00),
('pickup_67115bfb5bfdd5.84785073', 'vihan', 'gamaka', 'jhji', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', '', 'Gamakavihan2002@gmail.com', '', '2024-10-24', '12:18:00', 6.91855821, 79.85828176, '2', NULL, NULL, 1, 25.00),
('pickup_67117f886a04d6.93111602', 'vihan', 'gamaka', '', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', '', 'Gamakavihan2002@gmail.com', '', '2024-10-23', '14:49:00', 6.88039762, 79.88696830, '1', NULL, NULL, 1, 49.00),
('pickup_6711a118566156.40260184', 'vihan', 'gamaka', '', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', '', 'Gamakavihan2002@gmail.com', '', '2024-10-24', '05:18:00', 6.91476121, 79.89261403, '2', NULL, NULL, 0, NULL),
('pickup_6712a163dc9fe6.60632144', 'vihan', 'gamaka', '', '24/3,wijayaba mawatha,nawala road,nugegoda', '10250', '', 'Gamakavihan2002@gmail.com', '', '2024-10-19', '12:18:00', 6.91724600, 79.86465561, '2', NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `waste_pickups`
--
ALTER TABLE `waste_pickups`
  ADD PRIMARY KEY (`pickup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
