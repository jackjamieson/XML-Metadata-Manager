-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2015 at 05:19 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xml_info_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `xml`
--

CREATE TABLE IF NOT EXISTS `xml` (
`xml_id` int(11) NOT NULL,
  `Path` varchar(1000) DEFAULT NULL,
  `CollectionID` varchar(100) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `AlternateTitle` varchar(255) DEFAULT NULL,
  `Abstract` varchar(255) DEFAULT NULL,
  `DataType` varchar(100) DEFAULT NULL,
  `Supplemental` varchar(255) DEFAULT NULL,
  `Coordinates` varchar(255) DEFAULT NULL,
  `AlternateGeometry` varchar(255) DEFAULT NULL,
  `OnlineResource` varchar(255) DEFAULT NULL,
  `BrowseGraphic` varchar(255) DEFAULT NULL,
  `CollectionDate` date DEFAULT NULL,
  `DatasetReference` date DEFAULT NULL,
  `VerticalExtent` varchar(255) DEFAULT NULL,
  `UploadDate` date DEFAULT NULL,
  `Owner` varchar(100) DEFAULT NULL,
  `zipID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xml`
--
ALTER TABLE `xml`
 ADD PRIMARY KEY (`xml_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xml`
--
ALTER TABLE `xml`
MODIFY `xml_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=184;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
