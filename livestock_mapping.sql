-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 03:14 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `livestock_mapping`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE IF NOT EXISTS `animal` (
  `animal_id` varchar(20) NOT NULL DEFAULT '0',
  `animal_name` varchar(20) NOT NULL,
  `lltemp` decimal(5,2) DEFAULT NULL,
  `ultemp` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `lltemp`, `ultemp`) VALUES
('AN001', 'Beef catle', '15.00', '32.00'),
('AN002', 'Dairy cow', '10.00', '25.00'),
('AN003', 'Sheep', '21.00', '31.00'),
('AN004', 'Goat', '10.00', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(1, 'Best 3', 'pointpriority.png'),
(2, 'Other', 'point.png');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE IF NOT EXISTS `criteria` (
  `no` varchar(10) NOT NULL,
  `criteria_name` varchar(20) NOT NULL,
  `type` int(10) NOT NULL,
  `type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`no`, `criteria_name`, `type`, `type_name`) VALUES
('C1', 'waterid', 1, 'benefit'),
('C2', 'fodderid', 1, 'benefit'),
('C3', 'mobid', 1, 'benefit'),
('C4', 'altitude', 1, 'benefit'),
('C5', 'humidity', 1, 'benefit'),
('C6', 'temperature', 2, 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `foddercondition`
--

CREATE TABLE IF NOT EXISTS `foddercondition` (
  `ID` varchar(100) NOT NULL,
  `fodder1` int(5) NOT NULL,
  `fodder2` int(5) NOT NULL,
  `fodder3` int(5) NOT NULL,
  `fodder4` int(5) NOT NULL,
  `foddersum` int(5) NOT NULL,
  `foddervalue` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foddercondition`
--

INSERT INTO `foddercondition` (`ID`, `fodder1`, `fodder2`, `fodder3`, `fodder4`, `foddersum`, `foddervalue`) VALUES
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
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `loc_id` varchar(100) NOT NULL,
  `loc_name` varchar(35) NOT NULL,
  `loc_district` varchar(100) NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `waterid` decimal(5,2) DEFAULT NULL,
  `fodderid` decimal(5,2) DEFAULT NULL,
  `mobid` decimal(5,2) DEFAULT NULL,
  `altitude` decimal(5,2) NOT NULL,
  `humidity` decimal(5,2) NOT NULL,
  `temperature` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `loc_name`, `loc_district`, `longitude`, `latitude`, `waterid`, `fodderid`, `mobid`, `altitude`, `humidity`, `temperature`) VALUES
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
-- Table structure for table `mobcondition`
--

CREATE TABLE IF NOT EXISTS `mobcondition` (
  `ID` varchar(100) NOT NULL,
  `mob1` int(5) NOT NULL,
  `mob2` int(5) NOT NULL,
  `mob3` int(5) NOT NULL,
  `mob4` int(5) NOT NULL,
  `mobsum` int(5) NOT NULL,
  `mobvalue` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobcondition`
--

INSERT INTO `mobcondition` (`ID`, `mob1`, `mob2`, `mob3`, `mob4`, `mobsum`, `mobvalue`) VALUES
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
-- Table structure for table `tempresult`
--

CREATE TABLE IF NOT EXISTS `tempresult` (
  `loc_id` varchar(100) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `loc_district` varchar(100) NOT NULL,
  `categoryid` int(11) NOT NULL DEFAULT '2',
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `sum` double(7,2) DEFAULT NULL,
  `C1` double(7,2) DEFAULT NULL,
  `C2` double(7,2) DEFAULT NULL,
  `C3` double(7,2) DEFAULT NULL,
  `C4` double(7,2) DEFAULT NULL,
  `C5` double(7,2) DEFAULT NULL,
  `C6` double(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tempselect`
--

CREATE TABLE IF NOT EXISTS `tempselect` (
  `loc_id` varchar(100) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `loc_district` varchar(100) NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `C1` decimal(5,2) DEFAULT NULL,
  `C2` decimal(5,2) DEFAULT NULL,
  `C3` decimal(5,2) DEFAULT NULL,
  `C4` decimal(5,2) DEFAULT NULL,
  `C5` decimal(5,2) DEFAULT NULL,
  `C6` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `status`, `password`) VALUES
('admin', 'Admin Aurelia', 'admin', 'shakugan');

-- --------------------------------------------------------

--
-- Table structure for table `watercondition`
--

CREATE TABLE IF NOT EXISTS `watercondition` (
  `ID` varchar(100) NOT NULL,
  `water1` int(5) NOT NULL,
  `water2` int(5) NOT NULL,
  `water3` int(5) NOT NULL,
  `water4` int(5) NOT NULL,
  `watersum` int(5) NOT NULL,
  `watervalue` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watercondition`
--

INSERT INTO `watercondition` (`ID`, `water1`, `water2`, `water3`, `water4`, `watersum`, `watervalue`) VALUES
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
-- Indexes for table `animal`
--
ALTER TABLE `animal`
 ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
 ADD PRIMARY KEY (`no`);

--
-- Indexes for table `foddercondition`
--
ALTER TABLE `foddercondition`
 ADD PRIMARY KEY (`ID`), ADD KEY `foddersum` (`foddersum`), ADD KEY `foddersum_2` (`foddersum`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `mobcondition`
--
ALTER TABLE `mobcondition`
 ADD PRIMARY KEY (`ID`), ADD KEY `mobsum` (`mobsum`), ADD KEY `mobsum_2` (`mobsum`);

--
-- Indexes for table `tempresult`
--
ALTER TABLE `tempresult`
 ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `tempselect`
--
ALTER TABLE `tempselect`
 ADD PRIMARY KEY (`loc_id`), ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `watercondition`
--
ALTER TABLE `watercondition`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`), ADD KEY `watersum` (`watersum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tempresult`
--
ALTER TABLE `tempresult`
ADD CONSTRAINT `tempresult_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempselect`
--
ALTER TABLE `tempselect`
ADD CONSTRAINT `tempselect_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
