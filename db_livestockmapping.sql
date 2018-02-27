-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 01:12 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_livestockmapping`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_animaldata`
--

CREATE TABLE `tb_animaldata` (
  `animal_id` varchar(20) NOT NULL,
  `animal_name` varchar(20) NOT NULL,
  `lower_temp` decimal(5,2) DEFAULT NULL,
  `upper_temp` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_animaldata`
--

INSERT INTO `tb_animaldata` (`animal_id`, `animal_name`, `lower_temp`, `upper_temp`) VALUES
('AN001', 'Sapi', '15.00', '27.00'),
('AN002', 'Sapi perah', '5.00', '15.00'),
('AN003', 'Kambing', '21.00', '31.00'),
('AN004', 'Domba', '10.00', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_criteria`
--

CREATE TABLE `tb_criteria` (
  `cri_id` varchar(20) NOT NULL,
  `cri_name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `weight` decimal(10,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_criteria`
--

INSERT INTO `tb_criteria` (`cri_id`, `cri_name`, `type`, `weight`) VALUES
('CR001', 'water', 'benefit', '0.08300'),
('CR002', 'fodder', 'benefit', '0.08300'),
('CR003', 'mobility', 'benefit', '0.08300'),
('CR004', 'altitude', 'benefit', '0.25000'),
('CR005', 'humidity', 'benefit', '0.25000'),
('CR006', 'temperature', 'cost', '0.25000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fodderdata`
--

CREATE TABLE `tb_fodderdata` (
  `fodder_id` varchar(100) NOT NULL,
  `value_1` int(5) NOT NULL,
  `value_2` int(5) NOT NULL,
  `value_3` int(5) NOT NULL,
  `value_4` int(5) NOT NULL,
  `value_total` int(5) NOT NULL,
  `fodder_value` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fodderdata`
--

INSERT INTO `tb_fodderdata` (`fodder_id`, `value_1`, `value_2`, `value_3`, `value_4`, `value_total`, `fodder_value`) VALUES
('LO001', 1, 1, 1, 1, 4, 'very good'),
('LO002', 1, 1, 1, 1, 4, 'very good'),
('LO003', 0, 1, 1, 1, 3, 'good'),
('LO004', 1, 0, 1, 1, 3, 'good'),
('LO005', 1, 0, 1, 1, 3, 'good'),
('LO006', 1, 1, 1, 1, 4, 'very good'),
('LO007', 1, 1, 1, 1, 4, 'very good'),
('LO008', 1, 1, 1, 1, 4, 'very good');

-- --------------------------------------------------------

--
-- Table structure for table `tb_locationdata`
--

CREATE TABLE `tb_locationdata` (
  `loc_id` varchar(100) NOT NULL,
  `loc_name` varchar(35) NOT NULL,
  `loc_district` varchar(100) NOT NULL,
  `water_id` varchar(100) DEFAULT NULL,
  `fodder_id` varchar(100) DEFAULT NULL,
  `mobility_id` varchar(100) DEFAULT NULL,
  `loc_altitude` decimal(5,2) NOT NULL,
  `loc_humidity` decimal(5,2) NOT NULL,
  `loc_temp` decimal(5,2) NOT NULL,
  `loc_latitude` varchar(20) NOT NULL,
  `loc_longitude` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_locationdata`
--

INSERT INTO `tb_locationdata` (`loc_id`, `loc_name`, `loc_district`, `water_id`, `fodder_id`, `mobility_id`, `loc_altitude`, `loc_humidity`, `loc_temp`, `loc_latitude`, `loc_longitude`) VALUES
('LO001', 'Depok', 'Bantul', 'LO001', 'LO001', 'LO001', '28.80', '49.50', '35.60', '-80092722', '1102965559'),
('LO002', 'Jetis', 'Bantul', 'LO002', 'LO002', 'LO002', '70.10', '33.00', '37.80', '-79021438', '1103735387'),
('LO003', 'Piyungan', 'Bantul', 'LO003', 'LO003', 'LO003', '120.28', '45.00', '36.50', '-78348856', '1104818811'),
('LO004', 'Playen', 'Gunung Kidul', 'LO004', 'LO004', 'LO004', '207.82', '69.00', '28.90', '-79404329', '1105509500'),
('LO005', 'Pathuk', 'Gunung Kidul', 'LO005', 'LO005', 'LO005', '185.37', '68.00', '30.00', '-78776562', '1105362193'),
('LO006', 'Pakem', 'Sleman', 'LO006', 'LO006', 'LO006', '650.75', '69.00', '28.00', '-76229514', '1104237670'),
('LO007', 'Ngepring', 'Sleman', 'LO007', 'LO007', 'LO007', '686.54', '60.00', '28.00', '-76136160', '1104112415'),
('LO008', 'Klepu', 'Sleman', 'LO008', 'LO008', 'LO008', '162.72', '48.00', '32.00', '-77453769', '1102559989');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobilitydata`
--

CREATE TABLE `tb_mobilitydata` (
  `mobility_id` varchar(100) NOT NULL,
  `value_1` int(5) NOT NULL,
  `value_2` int(5) NOT NULL,
  `value_3` int(5) NOT NULL,
  `value_4` int(5) NOT NULL,
  `value_total` int(5) NOT NULL,
  `mobility_value` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mobilitydata`
--

INSERT INTO `tb_mobilitydata` (`mobility_id`, `value_1`, `value_2`, `value_3`, `value_4`, `value_total`, `mobility_value`) VALUES
('LO001', 1, 1, 1, 1, 4, 'very good'),
('LO002', 1, 1, 1, 1, 4, 'very good'),
('LO003', 0, 0, 1, 1, 2, 'average'),
('LO004', 1, 1, 1, 0, 3, 'good'),
('LO005', 1, 1, 1, 0, 3, 'good'),
('LO006', 1, 1, 1, 1, 4, 'very good'),
('LO007', 1, 1, 1, 1, 4, 'very good'),
('LO008', 1, 1, 1, 1, 4, 'very good');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempresult`
--

CREATE TABLE `tb_tempresult` (
  `loc_id` varchar(20) NOT NULL,
  `loc_name` varchar(35) NOT NULL,
  `loc_district` varchar(50) NOT NULL,
  `loc_status` varchar(20) NOT NULL,
  `C1` decimal(5,2) DEFAULT NULL,
  `C2` decimal(5,2) DEFAULT NULL,
  `C3` decimal(5,2) DEFAULT NULL,
  `C4` decimal(5,2) DEFAULT NULL,
  `C5` decimal(5,2) DEFAULT NULL,
  `C6` decimal(5,2) DEFAULT NULL,
  `saw_sum` decimal(5,2) DEFAULT NULL,
  `loc_latitude` decimal(10,7) DEFAULT NULL,
  `loc_longitude` decimal(10,7) DEFAULT NULL,
  `loc_category` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempselected`
--

CREATE TABLE `tb_tempselected` (
  `loc_id` varchar(20) NOT NULL,
  `loc_name` varchar(35) NOT NULL,
  `loc_district` varchar(100) NOT NULL,
  `C1` decimal(5,2) DEFAULT NULL,
  `C2` decimal(5,2) DEFAULT NULL,
  `C3` decimal(5,2) DEFAULT NULL,
  `C4` decimal(5,2) DEFAULT NULL,
  `C5` decimal(5,2) DEFAULT NULL,
  `C6` decimal(5,2) DEFAULT NULL,
  `loc_latitude` decimal(10,7) DEFAULT NULL,
  `loc_longitude` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_userdata`
--

CREATE TABLE `tb_userdata` (
  `user_id` int(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id` varchar(32) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL,
  `role` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_userdata`
--

INSERT INTO `tb_userdata` (`user_id`, `username`, `full_name`, `student_id`, `email`, `password`, `hash`, `active`, `role`) VALUES
(2, 'aureliadsp', 'Aurelia Dyah', '0976', 'aureliadsp@gmail.com', 'f79ec22cca0aea459367828af827ea45', 'be83ab3ecd0db773eb2dc1b0a17836a1', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_waterdata`
--

CREATE TABLE `tb_waterdata` (
  `water_id` varchar(100) NOT NULL,
  `value_1` int(5) NOT NULL,
  `value_2` int(5) NOT NULL,
  `value_3` int(5) NOT NULL,
  `value_4` int(5) NOT NULL,
  `value_total` int(5) NOT NULL,
  `water_value` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_waterdata`
--

INSERT INTO `tb_waterdata` (`water_id`, `value_1`, `value_2`, `value_3`, `value_4`, `value_total`, `water_value`) VALUES
('LO001', 1, 0, 0, 1, 2, 'average'),
('LO002', 1, 0, 1, 1, 3, 'good'),
('LO003', 1, 0, 1, 1, 3, 'good'),
('LO004', 0, 1, 1, 0, 2, 'average'),
('LO005', 0, 1, 1, 0, 2, 'average'),
('LO006', 1, 1, 1, 1, 4, 'very good'),
('LO007', 1, 1, 1, 1, 4, 'very good'),
('LO008', 0, 1, 1, 1, 3, 'good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_animaldata`
--
ALTER TABLE `tb_animaldata`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `tb_criteria`
--
ALTER TABLE `tb_criteria`
  ADD PRIMARY KEY (`cri_id`);

--
-- Indexes for table `tb_fodderdata`
--
ALTER TABLE `tb_fodderdata`
  ADD PRIMARY KEY (`fodder_id`);

--
-- Indexes for table `tb_locationdata`
--
ALTER TABLE `tb_locationdata`
  ADD PRIMARY KEY (`loc_id`),
  ADD KEY `water_id` (`water_id`),
  ADD KEY `fodder_id` (`fodder_id`),
  ADD KEY `mobility_id` (`mobility_id`);

--
-- Indexes for table `tb_mobilitydata`
--
ALTER TABLE `tb_mobilitydata`
  ADD PRIMARY KEY (`mobility_id`);

--
-- Indexes for table `tb_tempresult`
--
ALTER TABLE `tb_tempresult`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `tb_tempselected`
--
ALTER TABLE `tb_tempselected`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `tb_userdata`
--
ALTER TABLE `tb_userdata`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tb_waterdata`
--
ALTER TABLE `tb_waterdata`
  ADD PRIMARY KEY (`water_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_userdata`
--
ALTER TABLE `tb_userdata`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
