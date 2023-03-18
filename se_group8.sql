-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2023 at 08:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_group8`
--

-- --------------------------------------------------------

--
-- Table structure for table `addaddress`
--

CREATE TABLE `addaddress` (
  `addaddressID` int(100) NOT NULL,
  `postID` int(100) NOT NULL,
  `groupofdogID` int(100) NOT NULL,
  `groupofpostpictureID` int(100) NOT NULL,
  `placeID` int(100) NOT NULL,
  `dogID` int(100) NOT NULL,
  `addaddressDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `checkapprove`
--

CREATE TABLE `checkapprove` (
  `checkapproveID` int(100) NOT NULL,
  `postcostID` int(100) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `checkapproveTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `checkapproveStatusID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `checkapprovestatus`
--

CREATE TABLE `checkapprovestatus` (
  `checkapprovestatusID` int(100) NOT NULL,
  `checkapprovestatusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkapprovestatus`
--

INSERT INTO `checkapprovestatus` (`checkapprovestatusID`, `checkapprovestatusName`) VALUES
(1, 'กำลังรออนุมัติ'),
(2, 'อนุมัติแล้ว'),
(3, 'อนุมัติไม่สำเร็จ');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `districtID` int(100) NOT NULL,
  `districtName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `provinceID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`districtID`, `districtName`, `provinceID`) VALUES
(1, 'จตุจักร', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dog`
--

CREATE TABLE `dog` (
  `dogID` int(100) NOT NULL,
  `dogName` varchar(100) NOT NULL,
  `subdistrictID` int(100) NOT NULL,
  `dogArea` varchar(100) NOT NULL,
  `dogpictureID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dogimg`
--

CREATE TABLE `dogimg` (
  `dogimgID` int(100) NOT NULL,
  `postcostID` int(100) NOT NULL,
  `dogimgPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dogpicture`
--

CREATE TABLE `dogpicture` (
  `dogpictureID` int(100) NOT NULL,
  `dogpicturePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donationID` int(100) NOT NULL,
  `donationSlip` varchar(100) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `donationAmount` int(100) NOT NULL,
  `donationTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `opendonateID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `groupID` int(100) NOT NULL,
  `groupOfDogID` int(100) NOT NULL,
  `dogID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groupofdog`
--

CREATE TABLE `groupofdog` (
  `groupofdogID` int(100) NOT NULL,
  `groupofdogName` varchar(100) NOT NULL,
  `placeID` int(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groupofpostpicture`
--

CREATE TABLE `groupofpostpicture` (
  `groupofpostpictureID` int(100) NOT NULL,
  `groupofpostpicturePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `opendonate`
--

CREATE TABLE `opendonate` (
  `opendonateID` int(100) NOT NULL,
  `postcostID` int(100) NOT NULL,
  `opendonateQRcode` varchar(100) NOT NULL,
  `opendonateSlip` varchar(100) NOT NULL,
  `opendonateStartdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `opendonateStopdate` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `placeID` int(100) NOT NULL,
  `placeName` varchar(100) NOT NULL,
  `subdistrictID` int(100) NOT NULL,
  `region` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postID` int(100) NOT NULL,
  `typetagID` int(100) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `postTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `postofgroupID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postcost`
--

CREATE TABLE `postcost` (
  `postcostID` int(100) NOT NULL,
  `postID` int(100) NOT NULL,
  `postcostContent` varchar(100) NOT NULL,
  `groupofpictureID` int(100) NOT NULL,
  `postcostStartdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postofgroup`
--

CREATE TABLE `postofgroup` (
  `postofgroupID` int(100) NOT NULL,
  `postofgroupContent` varchar(100) NOT NULL,
  `groupofpostpictureID` int(100) NOT NULL,
  `groupofdogID` int(100) NOT NULL,
  `postofgroupTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `provinceID` int(100) NOT NULL,
  `provinceName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`provinceID`, `provinceName`) VALUES
(1, 'กรุงเทพ');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int(100) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `reportstatusID` int(100) NOT NULL,
  `reportTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reportstatus`
--

CREATE TABLE `reportstatus` (
  `reportstatusID` int(100) NOT NULL,
  `reportstatusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportstatus`
--

INSERT INTO `reportstatus` (`reportstatusID`, `reportstatusName`) VALUES
(1, 'รายงานแล้ว'),
(2, 'กำลังรอการตรวจสอบ');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(100) NOT NULL,
  `rolename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `rolename`) VALUES
(1, 'ผู้ใช้ที่ลงทะเบียนแล้ว'),
(2, 'ผู้ดูแลระบบ');

-- --------------------------------------------------------

--
-- Table structure for table `sentreport`
--

CREATE TABLE `sentreport` (
  `sentreportID` int(100) NOT NULL,
  `reportID` int(100) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `sentreportContent` varchar(100) NOT NULL,
  `sentreportTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subdistrict`
--

CREATE TABLE `subdistrict` (
  `subdistrictID` int(100) NOT NULL,
  `subdistrictName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `districtID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subdistrict`
--

INSERT INTO `subdistrict` (`subdistrictID`, `subdistrictName`, `districtID`) VALUES
(1, 'จตุจักร', 1);

-- --------------------------------------------------------

--
-- Table structure for table `treateddog`
--

CREATE TABLE `treateddog` (
  `treateddogID` int(100) NOT NULL,
  `postcostID` int(100) NOT NULL,
  `dogID` int(100) NOT NULL,
  `treateddogstatusID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `treateddogstatus`
--

CREATE TABLE `treateddogstatus` (
  `treateddogstatusID` int(100) NOT NULL,
  `treateddogstatusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treateddogstatus`
--

INSERT INTO `treateddogstatus` (`treateddogstatusID`, `treateddogstatusName`) VALUES
(1, 'ได้รับการบริจาคแล้ว'),
(2, 'ยังไม่ได้รับการบริจาค'),
(3, 'กำลังรอการอนุมัติการบริจาค');

-- --------------------------------------------------------

--
-- Table structure for table `typetag`
--

CREATE TABLE `typetag` (
  `typetagID` int(100) NOT NULL,
  `typetagName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subdistrictID` int(100) NOT NULL,
  `roleID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `phonenumber`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `subdistrictID`, `roleID`) VALUES
(1, 'Sasichar', 'Salabkaew', '0982636676', 'sasicharkanun@gmail.com', NULL, '$2y$10$717uN8qEzXtG09qCubdsjuYCxB8K0xC87uJqrfQoY66RQSA4Ukawm', NULL, '2023-03-17 13:30:33', '2023-03-17 13:30:33', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addaddress`
--
ALTER TABLE `addaddress`
  ADD PRIMARY KEY (`addaddressID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `groupofdogID` (`groupofdogID`),
  ADD KEY `groupofpostpictureID` (`groupofpostpictureID`),
  ADD KEY `placeID` (`placeID`),
  ADD KEY `dogID` (`dogID`);

--
-- Indexes for table `checkapprove`
--
ALTER TABLE `checkapprove`
  ADD PRIMARY KEY (`checkapproveID`),
  ADD KEY `postID` (`postcostID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `checkapproveStatusID` (`checkapproveStatusID`);

--
-- Indexes for table `checkapprovestatus`
--
ALTER TABLE `checkapprovestatus`
  ADD PRIMARY KEY (`checkapprovestatusID`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`districtID`),
  ADD KEY `provinceID` (`provinceID`);

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`dogID`),
  ADD KEY `subdistrictID` (`subdistrictID`),
  ADD KEY `dogpictureID` (`dogpictureID`);

--
-- Indexes for table `dogimg`
--
ALTER TABLE `dogimg`
  ADD PRIMARY KEY (`dogimgID`),
  ADD KEY `postcostID` (`postcostID`);

--
-- Indexes for table `dogpicture`
--
ALTER TABLE `dogpicture`
  ADD PRIMARY KEY (`dogpictureID`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donationID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `opendonateID` (`opendonateID`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `groupOfDogID` (`groupOfDogID`),
  ADD KEY `dogID` (`dogID`);

--
-- Indexes for table `groupofdog`
--
ALTER TABLE `groupofdog`
  ADD PRIMARY KEY (`groupofdogID`),
  ADD UNIQUE KEY `groupofdogName` (`groupofdogName`),
  ADD KEY `placeID` (`placeID`);

--
-- Indexes for table `groupofpostpicture`
--
ALTER TABLE `groupofpostpicture`
  ADD PRIMARY KEY (`groupofpostpictureID`);

--
-- Indexes for table `opendonate`
--
ALTER TABLE `opendonate`
  ADD PRIMARY KEY (`opendonateID`),
  ADD KEY `postcostID` (`postcostID`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`placeID`),
  ADD KEY `subdistrictID` (`subdistrictID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `typetagID` (`typetagID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postofgroupID` (`postofgroupID`);

--
-- Indexes for table `postcost`
--
ALTER TABLE `postcost`
  ADD PRIMARY KEY (`postcostID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `groupofpictureID` (`groupofpictureID`);

--
-- Indexes for table `postofgroup`
--
ALTER TABLE `postofgroup`
  ADD PRIMARY KEY (`postofgroupID`),
  ADD KEY `groupofpostpictureID` (`groupofpostpictureID`),
  ADD KEY `groupofdogID` (`groupofdogID`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `reportstatusID` (`reportstatusID`);

--
-- Indexes for table `reportstatus`
--
ALTER TABLE `reportstatus`
  ADD PRIMARY KEY (`reportstatusID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `sentreport`
--
ALTER TABLE `sentreport`
  ADD PRIMARY KEY (`sentreportID`),
  ADD KEY `reportID` (`reportID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `subdistrict`
--
ALTER TABLE `subdistrict`
  ADD PRIMARY KEY (`subdistrictID`),
  ADD KEY `districtID` (`districtID`);

--
-- Indexes for table `treateddog`
--
ALTER TABLE `treateddog`
  ADD PRIMARY KEY (`treateddogID`),
  ADD KEY `postcostID` (`postcostID`),
  ADD KEY `dogID` (`dogID`),
  ADD KEY `treateddogstatusID` (`treateddogstatusID`);

--
-- Indexes for table `treateddogstatus`
--
ALTER TABLE `treateddogstatus`
  ADD PRIMARY KEY (`treateddogstatusID`);

--
-- Indexes for table `typetag`
--
ALTER TABLE `typetag`
  ADD PRIMARY KEY (`typetagID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `subdistrictID` (`subdistrictID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addaddress`
--
ALTER TABLE `addaddress`
  MODIFY `addaddressID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkapprove`
--
ALTER TABLE `checkapprove`
  MODIFY `checkapproveID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkapprovestatus`
--
ALTER TABLE `checkapprovestatus`
  MODIFY `checkapprovestatusID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `districtID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dog`
--
ALTER TABLE `dog`
  MODIFY `dogID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dogimg`
--
ALTER TABLE `dogimg`
  MODIFY `dogimgID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dogpicture`
--
ALTER TABLE `dogpicture`
  MODIFY `dogpictureID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donationID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `groupID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupofdog`
--
ALTER TABLE `groupofdog`
  MODIFY `groupofdogID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupofpostpicture`
--
ALTER TABLE `groupofpostpicture`
  MODIFY `groupofpostpictureID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opendonate`
--
ALTER TABLE `opendonate`
  MODIFY `opendonateID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `placeID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postcost`
--
ALTER TABLE `postcost`
  MODIFY `postcostID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postofgroup`
--
ALTER TABLE `postofgroup`
  MODIFY `postofgroupID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `provinceID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportstatus`
--
ALTER TABLE `reportstatus`
  MODIFY `reportstatusID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sentreport`
--
ALTER TABLE `sentreport`
  MODIFY `sentreportID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subdistrict`
--
ALTER TABLE `subdistrict`
  MODIFY `subdistrictID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treateddog`
--
ALTER TABLE `treateddog`
  MODIFY `treateddogID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treateddogstatus`
--
ALTER TABLE `treateddogstatus`
  MODIFY `treateddogstatusID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `typetag`
--
ALTER TABLE `typetag`
  MODIFY `typetagID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addaddress`
--
ALTER TABLE `addaddress`
  ADD CONSTRAINT `addaddress_ibfk_1` FOREIGN KEY (`placeID`) REFERENCES `place` (`placeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addaddress_ibfk_2` FOREIGN KEY (`dogID`) REFERENCES `dog` (`dogID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addaddress_ibfk_3` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkapprove`
--
ALTER TABLE `checkapprove`
  ADD CONSTRAINT `checkapprove_ibfk_1` FOREIGN KEY (`postcostID`) REFERENCES `postcost` (`postcostID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkapprove_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkapprove_ibfk_3` FOREIGN KEY (`checkapproveStatusID`) REFERENCES `checkapprovestatus` (`checkapprovestatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`provinceID`) REFERENCES `province` (`provinceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dog`
--
ALTER TABLE `dog`
  ADD CONSTRAINT `dog_ibfk_1` FOREIGN KEY (`dogpictureID`) REFERENCES `dogpicture` (`dogpictureID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dog_ibfk_2` FOREIGN KEY (`subdistrictID`) REFERENCES `subdistrict` (`subdistrictID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dogimg`
--
ALTER TABLE `dogimg`
  ADD CONSTRAINT `dogimg_ibfk_1` FOREIGN KEY (`postcostID`) REFERENCES `postcost` (`postcostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`opendonateID`) REFERENCES `opendonate` (`opendonateID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`groupOfDogID`) REFERENCES `groupofdog` (`groupofdogID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_ibfk_2` FOREIGN KEY (`dogID`) REFERENCES `dog` (`dogID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groupofdog`
--
ALTER TABLE `groupofdog`
  ADD CONSTRAINT `groupofdog_ibfk_1` FOREIGN KEY (`placeID`) REFERENCES `place` (`placeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opendonate`
--
ALTER TABLE `opendonate`
  ADD CONSTRAINT `opendonate_ibfk_1` FOREIGN KEY (`postcostID`) REFERENCES `postcost` (`postcostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`subdistrictID`) REFERENCES `subdistrict` (`subdistrictID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`postofgroupID`) REFERENCES `postofgroup` (`postofgroupID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`typetagID`) REFERENCES `typetag` (`typetagID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postcost`
--
ALTER TABLE `postcost`
  ADD CONSTRAINT `postcost_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postofgroup`
--
ALTER TABLE `postofgroup`
  ADD CONSTRAINT `postofgroup_ibfk_1` FOREIGN KEY (`groupofpostpictureID`) REFERENCES `groupofpostpicture` (`groupofpostpictureID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postofgroup_ibfk_2` FOREIGN KEY (`groupofdogID`) REFERENCES `groupofdog` (`groupofdogID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`reportstatusID`) REFERENCES `reportstatus` (`reportstatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sentreport`
--
ALTER TABLE `sentreport`
  ADD CONSTRAINT `sentreport_ibfk_1` FOREIGN KEY (`reportID`) REFERENCES `report` (`reportID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sentreport_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subdistrict`
--
ALTER TABLE `subdistrict`
  ADD CONSTRAINT `subdistrict_ibfk_1` FOREIGN KEY (`districtID`) REFERENCES `district` (`districtID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treateddog`
--
ALTER TABLE `treateddog`
  ADD CONSTRAINT `treateddog_ibfk_1` FOREIGN KEY (`dogID`) REFERENCES `dog` (`dogID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `treateddog_ibfk_2` FOREIGN KEY (`postcostID`) REFERENCES `postcost` (`postcostID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `treateddog_ibfk_3` FOREIGN KEY (`treateddogstatusID`) REFERENCES `treateddogstatus` (`treateddogstatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`subdistrictID`) REFERENCES `subdistrict` (`subdistrictID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
