-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 05:57 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
('AN001', 'Beef catle', '15.00', '32.00'),
('AN002', 'Dairy cow', '10.00', '25.00'),
('AN003', 'Sheep', '21.00', '31.00'),
('AN004', 'Goat', '10.00', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `img` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_criteria`
--

CREATE TABLE `tb_criteria` (
  `cri_id` varchar(10) NOT NULL,
  `criteria_name` varchar(20) NOT NULL,
  `type` int(10) NOT NULL,
  `type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_criteria`
--

INSERT INTO `tb_criteria` (`cri_id`, `criteria_name`, `type`, `type_name`) VALUES
('C1', 'water_id', 1, 'benefit'),
('C2', 'fodder_id', 1, 'benefit'),
('C3', 'mobility_id', 1, 'benefit'),
('C4', 'loc_altitude', 1, 'benefit'),
('C5', 'loc_humidity', 1, 'benefit'),
('C6', 'loc_temp', 2, 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fodderdata`
--

CREATE TABLE `tb_fodderdata` (
  `fodder_id` varchar(20) NOT NULL,
  `value_1` int(5) DEFAULT NULL,
  `value_2` int(5) DEFAULT NULL,
  `value_3` int(5) DEFAULT NULL,
  `value_4` int(5) DEFAULT NULL,
  `value_total` int(5) DEFAULT NULL,
  `fodder_value` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fodderdata`
--

INSERT INTO `tb_fodderdata` (`fodder_id`, `value_1`, `value_2`, `value_3`, `value_4`, `value_total`, `fodder_value`) VALUES
('LO001', 1, 1, 1, 1, 4, 'very good'),
('LO002', 1, 1, 1, 1, 4, 'very good'),
('LO003', 0, 1, 1, 1, 3, 'good'),
('LO004', 1, 1, 0, 1, 3, 'good'),
('LO005', 1, 1, 0, 0, 2, 'average'),
('LO006', 1, 1, 1, 1, 4, 'very good'),
('LO007', 1, 1, 0, 1, 3, 'good'),
('LO008', 1, 1, 1, 1, 4, 'very good'),
('LO009', 1, 1, 1, 0, 3, 'good'),
('LO010', 1, 0, 1, 0, 2, 'average'),
('LO011', 0, 1, 1, 1, 3, 'good'),
('LO012', 1, 1, 1, 0, 3, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `tb_locationdata`
--

CREATE TABLE `tb_locationdata` (
  `loc_id` varchar(20) NOT NULL,
  `loc_name` varchar(35) DEFAULT NULL,
  `loc_district` varchar(100) DEFAULT NULL,
  `loc_longitude` text NOT NULL,
  `loc_latitude` text NOT NULL,
  `water_id` varchar(20) DEFAULT NULL,
  `fodder_id` varchar(20) DEFAULT NULL,
  `mobility_id` varchar(20) DEFAULT NULL,
  `loc_altitude` decimal(5,2) DEFAULT NULL,
  `loc_humidity` decimal(5,2) DEFAULT NULL,
  `loc_temp` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_locationdata`
--

INSERT INTO `tb_locationdata` (`loc_id`, `loc_name`, `loc_district`, `loc_longitude`, `loc_latitude`, `water_id`, `fodder_id`, `mobility_id`, `loc_altitude`, `loc_humidity`, `loc_temp`) VALUES
('LO001', 'Depok', 'Bantul', '110.2965559', '-8.0092722', '2.00', '4.00', '4.00', '28.80', '49.50', '35.60'),
('LO002', 'Jetis', 'Bantul', '110.3735387', '-7.9021438', '3.00', '4.00', '4.00', '70.10', '33.00', '37.80'),
('LO003', 'Piyungan', 'Bantul', '110.4818811', '-7.8348856', '3.00', '3.00', '2.00', '120.28', '45.00', '36.50'),
('LO004', 'Playen', 'Gunung_Kidul', '110.5509500', '-7.9404329', '2.00', '3.00', '2.00', '207.82', '69.00', '28.90'),
('LO005', 'Pathuk', 'Gunung_Kidul', '110.5362193', '-7.8776562', '3.00', '2.00', '3.00', '185.37', '68.00', '30.00'),
('LO006', 'Pakem', 'Sleman', '110.4237670', '-7.6229514', '4.00', '4.00', '3.00', '650.75', '69.00', '28.00'),
('LO007', 'Ngepring', 'Sleman', '110.4112415', '-7.6136160', '4.00', '3.00', '4.00', '686.54', '60.00', '28.00'),
('LO008', 'Klepu', 'Sleman', '110.2559989', '-7.7453769', '3.00', '4.00', '4.00', '162.72', '48.00', '32.00'),
('LO009', 'Banjararum', 'Kulon_Progo', '110.2498808', '-7.7811758', '4.00', '3.00', '4.00', '141.00', '45.00', '32.00'),
('LO010', 'Sentolo', 'Kulon_Progo', '110.2113234', '-7.8714025', '3.00', '2.00', '2.00', '152.97', '26.00', '33.00'),
('LO011', 'Purwoharjo', 'Kulon_Progo', '110.2028620', '-7.7077546', '4.00', '3.00', '2.00', '521.41', '49.00', '30.00'),
('LO012', 'Temon', 'Kulon_Progo', '110.0244408', '-7.8936617', '2.00', '3.00', '1.00', '57.04', '57.40', '33.50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobilitydata`
--

CREATE TABLE `tb_mobilitydata` (
  `mobility_id` varchar(20) NOT NULL,
  `value_1` int(5) DEFAULT NULL,
  `value_2` int(5) DEFAULT NULL,
  `value_3` int(5) DEFAULT NULL,
  `value_4` int(5) DEFAULT NULL,
  `value_total` int(5) DEFAULT NULL,
  `mobility_value` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mobilitydata`
--

INSERT INTO `tb_mobilitydata` (`mobility_id`, `value_1`, `value_2`, `value_3`, `value_4`, `value_total`, `mobility_value`) VALUES
('LO001', 1, 1, 1, 1, 4, 'very good'),
('LO002', 1, 1, 1, 1, 4, 'very good'),
('LO003', 0, 1, 0, 1, 2, 'average'),
('LO004', 1, 1, 0, 0, 2, 'average'),
('LO005', 1, 1, 1, 0, 3, 'good'),
('LO006', 1, 0, 1, 1, 3, 'good'),
('LO007', 1, 1, 1, 1, 4, 'very good'),
('LO008', 1, 1, 1, 1, 4, 'very good'),
('LO009', 1, 1, 1, 1, 4, 'very good'),
('LO010', 1, 0, 0, 1, 2, 'average'),
('LO011', 1, 0, 1, 0, 2, 'average'),
('LO012', 0, 1, 0, 0, 1, 'bad');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempresult`
--

CREATE TABLE `tb_tempresult` (
  `loc_id` varchar(20) NOT NULL,
  `loc_name` varchar(35) NOT NULL,
  `loc_district` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `loc_longitude` text NOT NULL,
  `loc_latitude` text NOT NULL,
  `loc_status` varchar(25) NOT NULL,
  `saw_sum` double(7,2) NOT NULL,
  `C1` double(7,2) DEFAULT NULL,
  `C2` double(7,2) DEFAULT NULL,
  `C3` double(7,2) DEFAULT NULL,
  `C4` double(7,2) DEFAULT NULL,
  `C5` double(7,2) DEFAULT NULL,
  `C6` double(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempselected`
--

CREATE TABLE `tb_tempselected` (
  `loc_id` varchar(20) NOT NULL,
  `loc_name` varchar(35) NOT NULL,
  `loc_district` varchar(100) NOT NULL,
  `loc_longitude` text NOT NULL,
  `loc_latitude` text NOT NULL,
  `C1` decimal(5,2) DEFAULT NULL,
  `C2` decimal(5,2) DEFAULT NULL,
  `C3` decimal(5,2) DEFAULT NULL,
  `C4` decimal(5,2) DEFAULT NULL,
  `C5` decimal(5,2) DEFAULT NULL,
  `C6` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tempselected`
--

INSERT INTO `tb_tempselected` (`loc_id`, `loc_name`, `loc_district`, `loc_longitude`, `loc_latitude`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`) VALUES
('LO001', 'Depok', 'Bantul', '110.2965559', '-8.0092722', '2.00', '4.00', '4.00', '28.80', '49.50', '35.60'),
('LO002', 'Jetis', 'Bantul', '110.3735387', '-7.9021438', '3.00', '4.00', '4.00', '70.10', '33.00', '37.80'),
('LO003', 'Piyungan', 'Bantul', '110.4818811', '-7.8348856', '3.00', '3.00', '2.00', '120.28', '45.00', '36.50'),
('LO004', 'Playen', 'Gunung_Kidul', '110.5509500', '-7.9404329', '2.00', '3.00', '2.00', '207.82', '69.00', '28.90'),
('LO005', 'Pathuk', 'Gunung_Kidul', '110.5362193', '-7.8776562', '3.00', '2.00', '3.00', '185.37', '68.00', '30.00'),
('LO006', 'Pakem', 'Sleman', '110.4237670', '-7.6229514', '4.00', '4.00', '3.00', '650.75', '69.00', '28.00');

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_waterdata`
--

CREATE TABLE `tb_waterdata` (
  `water_id` varchar(20) NOT NULL,
  `value_1` int(5) DEFAULT NULL,
  `value_2` int(5) DEFAULT NULL,
  `value_3` int(5) DEFAULT NULL,
  `value_4` int(5) DEFAULT NULL,
  `value_total` int(5) DEFAULT NULL,
  `water_value` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_waterdata`
--

INSERT INTO `tb_waterdata` (`water_id`, `value_1`, `value_2`, `value_3`, `value_4`, `value_total`, `water_value`) VALUES
('LO001', 1, 0, 0, 1, 2, 'average'),
('LO002', 1, 1, 0, 1, 3, 'good'),
('LO003', 1, 1, 0, 1, 3, 'good'),
('LO004', 0, 1, 1, 0, 2, 'average'),
('LO005', 1, 1, 1, 0, 3, 'good'),
('LO006', 1, 1, 1, 1, 4, 'very good'),
('LO007', 1, 1, 1, 1, 4, 'very good'),
('LO008', 0, 1, 1, 1, 3, 'good'),
('LO009', 1, 1, 1, 1, 4, 'very good'),
('LO010', 0, 1, 1, 1, 3, 'good'),
('LO011', 1, 1, 1, 1, 4, 'very good'),
('LO012', 1, 0, 0, 1, 2, 'average');

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
  ADD PRIMARY KEY (`loc_id`);

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
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
