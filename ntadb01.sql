-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 07:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntadb01`
--

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `img_name` varchar(255) NOT NULL,
  `img_data` longblob NOT NULL,
  `img_year` int(11) NOT NULL,
  `img_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `year`, `active`) VALUES
(1, 'approved', 2017, 0),
(22, 'approved', 2016, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `total_users` int(3) NOT NULL,
  `bdc_users` int(3) NOT NULL,
  `bc_users` int(3) NOT NULL,
  `bo_users` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `total_users`, `bdc_users`, `bc_users`, `bo_users`) VALUES
(1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userPwd` varchar(100) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userId`, `userName`, `userPwd`, `userType`, `fullname`, `email`) VALUES
(1, 'Morty', '$2y$10$iiAZVEttBFiijA8zy0E.LuFQW5NhBq7tXgc2k1doUUuwQe2LEp4l6', 'bdc', '', ''),
(2, 'BCmember1', '$2y$10$itU/v8v.6gUHcoEoX7P.p.J53TeRLTZFFTL403qjjM9/UgF3gR2ti', 'bc', '', ''),
(3, 'BOuser', '$2y$10$itU/v8v.6gUHcoEoX7P.p.J53TeRLTZFFTL403qjjM9/UgF3gR2ti', 'bo', '', ''),
(4, 'BDCmember', '$2y$10$itU/v8v.6gUHcoEoX7P.p.J53TeRLTZFFTL403qjjM9/UgF3gR2ti', 'bdc', '', ''),
(10, 'sdfsdfs', '$2y$10$JNVoVmYim3QjhhG.VwDMkOSCHXivZS7wNYZufhm7LnS0WGf7re23S', 'Choose...', 'sfsdfs', 'sdfsd@gg.co'),
(11, 'samuel', '$2y$10$b5mIy5ayr8JO.rD4ErXomOnfu4EDGaUriE6VbzZsBQH2m7/4SqtC.', 'bdc', 'Samuel L Jackson', 'vezeveer@gmail.com'),
(12, 'd', '$2y$10$p2P0wXN/wpTv/b3GnQnoxuU68Ifwxq4PiIybTrekHti6xTXa13o2u', 'bdc', 'we', 'vezeveer@gmail.com'),
(13, '', '$2y$10$cOEDwx2UsuEqm7IKPlY2M.to4gNhTRm4ck6InH40KcAioI1mglE8i', '', '', ''),
(14, '', '$2y$10$a5emsrOdkzAMeDNdsYONpeFVzigW5/kev7aVWKbnX3xqpWEK0LFh2', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `year_2016`
--

CREATE TABLE `year_2016` (
  `id` int(6) NOT NULL,
  `project` varchar(100) NOT NULL,
  `aipRefCode` varchar(20) NOT NULL,
  `activityDesc` varchar(50) NOT NULL,
  `impOffice` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `expectedOutput` varchar(50) NOT NULL,
  `fundingServices` decimal(10,0) NOT NULL,
  `personalServices` decimal(10,0) NOT NULL,
  `maint` decimal(10,0) NOT NULL,
  `capitalOutlay` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year_2016`
--

INSERT INTO `year_2016` (`id`, `project`, `aipRefCode`, `activityDesc`, `impOffice`, `startDate`, `endDate`, `expectedOutput`, `fundingServices`, `personalServices`, `maint`, `capitalOutlay`, `total`) VALUES
(1, 'General Private Services Sector', '1000-1', 'Administrative Legislative Program', 'Committee on Peace & Order', '2016-01-01', '2016-12-31', '-', '0', '0', '0', '0', '0'),
(2, 'General Private Services Sector', '1000-1-1', 'Peace & Order', 'Committee on Peace & Order', '2016-01-01', '2016-12-31', '4 Tanods', '20', '0', '0', '0', '0'),
(3, 'Social Services Sector', '3000-100', 'Educational & Sports Development Program', 'Committee on Education & Sports', '2016-05-01', '2016-12-31', '10 Persons', '10', '0', '0', '15000', '15000'),
(4, 'General Private Services Sector', '1000-1-2', 'Training & Seminars', 'Committee on Peace & Order', '2016-01-01', '2016-12-31', '4 Tanods', '20', '0', '0', '1500', '1500'),
(5, 'General Private Services Sector', '1000-1-3', 'Brgy. Tanod Incentives', 'Committee on Peace & Order', '2016-01-01', '2016-12-31', 'Accessories Provided', '20', '0', '0', '19600', '19600'),
(6, 'General Private Services Sector', '1000-1-4', 'Tanod Accessories', 'Committee on Peace & Order', '2016-01-01', '2016-12-31', 'Accessories Provided', '20', '0', '0', '3843', '3843'),
(7, 'Social Services Sector', '3000-100-1', 'Sports Uniform', 'Committee on Education & Sports', '2016-04-01', '2016-12-31', '10 Persons', '10', '0', '0', '5000', '5000'),
(8, 'Social Services Sector', '3000-100-1-2', 'Sports Equipment', 'Committee on Education & Sports', '2016-04-01', '2016-12-31', '-', '10', '0', '0', '27067', '27067'),
(9, 'Social Services Sector', '3000-100-1-3', 'Cleanliness & Beautification', 'Committee on Education & Sports', '2016-04-01', '2016-12-31', 'Decoration Provided', '10', '0', '0', '5000', '5000'),
(10, 'Social Services Sector', '3000-1-4', 'Educational ALS SK Election (SKOLARBOS)', 'Committee on Education & Sports', '2016-10-01', '2016-10-31', 'Fare Provided', '10', '0', '0', '10000', '10000'),
(11, 'General Private Services Sector', '1000', 'General Public Services Sector', 'Brgy. Council', '2016-01-01', '2016-12-06', '-', '0', '572820', '112007', '0', '617054'),
(12, 'Health and Sanitation', '3000-200', '', '', '0000-00-00', '0000-00-00', '', '0', '0', '0', '0', '0'),
(13, 'Health and Sanitation', '3000-200-1', 'Garantisadong Pambata', 'Committee on Health', '2016-03-01', '2016-10-31', '20 Children', '20', '0', '0', '1000', '1000'),
(14, 'Health and Sanitation', '3000-200-1-1', 'Mass Immunization', 'Committee on Health', '2016-03-01', '2016-12-31', '20 Children', '20', '0', '0', '1000', '1000'),
(15, 'Health and Sanitation', '3000-200-1-2', 'Training and Seminars', 'Committee on Health', '2016-01-01', '2016-12-31', '1 BHW & BNS', '20', '0', '0', '1500', '1500'),
(16, 'Health and Sanitation', '3000-200-1-3', 'Purchase of Med. & First Aid Kit', 'Committee on Health', '2016-01-01', '2016-12-31', 'Medicines and Kit Provided', '20', '0', '0', '1500', '1500'),
(17, 'Health and Sanitation', '3000-200-1-4', 'Solid Waste Management', 'Committee on Health', '2016-01-01', '2016-12-06', 'Maintained', '20', '0', '0', '10000', '10000'),
(18, 'Health and Sanitation', '3000-200-1-5', 'BHW BNS Incentives ', 'Committee on Health', '2016-01-06', '2016-12-06', '1 BHS & BNS', '20', '0', '0', '13200', '13200'),
(19, 'HOUSING and COMM DEVt', '3000-400', '', '', '0000-00-00', '0000-00-00', '', '0', '0', '0', '0', '0'),
(20, 'HOUSING and COMM DEVt', '3000-400-1', 'Infrastructure', '-', '2016-01-06', '2016-12-06', '-', '0', '0', '0', '0', '0'),
(21, 'HOUSING and COMM DEVt', '3000-400-1-1', 'Maintenance of Brgy. Hall', 'Committee on Infrastructure', '2016-01-01', '2016-12-06', 'Maintained', '20', '0', '0', '55000', '55000'),
(22, 'HOUSING and COMM DEVt', '3000-400-1-2', 'Drainage Repair', 'Committee on Infrastructure', '2016-01-06', '2023-12-06', '30 meters', '20', '0', '0', '10000', '10000'),
(23, 'HOUSING and COMM DEVt', '3000-400-1-3', 'Maintenance of Street Lights', 'Committee on Infrastructure', '2016-01-06', '2016-12-06', '15 St. Light Posts, 15 Bulbs', '20', '0', '0', '40000', '40000');

-- --------------------------------------------------------

--
-- Table structure for table `year_2017`
--

CREATE TABLE `year_2017` (
  `id` int(6) NOT NULL,
  `project` varchar(100) NOT NULL,
  `aipRefCode` varchar(20) NOT NULL,
  `activityDesc` varchar(50) NOT NULL,
  `impOffice` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `expectedOutput` varchar(50) NOT NULL,
  `fundingServices` decimal(10,0) NOT NULL,
  `personalServices` decimal(10,0) NOT NULL,
  `maint` decimal(10,0) NOT NULL,
  `capitalOutlay` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year_2017`
--

INSERT INTO `year_2017` (`id`, `project`, `aipRefCode`, `activityDesc`, `impOffice`, `startDate`, `endDate`, `expectedOutput`, `fundingServices`, `personalServices`, `maint`, `capitalOutlay`, `total`) VALUES
(16, 'Beans Project 88', '121212', 'Yayy', 'Nowhere', '2019-01-04', '0000-00-00', 'Idk', '778', '77', '345', '0', '4563'),
(24, 'Local Project-StuDoc', '564', 'asd', 'sdfd', '2023-01-04', '2023-01-28', 'sdsf', '343', '23432', '34343', '4343', '234234'),
(25, 'Local-Project--7', 'sdfsd', 'dsdfsdf', 'sdfsdf', '2023-01-06', '2023-01-13', 'sdf', '32423423', '423423', '423423', '4234234', '234242'),
(26, 'Local-Project--7', '234ewr', '2wrwe', 'r23423', '2023-01-13', '2023-01-28', 'wer23', '423423423', '4324234', '342342', '34234', '3424234'),
(27, 'Local-Project--7', '33333', '', '', '0000-00-00', '0000-00-00', '', '0', '0', '0', '0', '0'),
(30, 'Local Project-3a', '', '', '', '0000-00-00', '0000-00-00', '', '0', '0', '0', '0', '0'),
(31, 'Beans Project 88', '9999', 'sgsdf', 'sdfsdfsd', '2023-01-14', '2023-01-21', 'sdfsd', '3432', '234', '24234', '4', '3423'),
(32, 'Beans Project 88', '111132', 'sadfsd', 'sdfsdfsd', '2023-01-20', '2023-01-28', 'sdfsdf', '343', '334', '234234', '234234', '2342342'),
(39, 'Lava-Project', '', '', '', '0000-00-00', '0000-00-00', '', '0', '0', '0', '0', '0'),
(40, 'Beans Project 88', '22457-678-34', 'sdfsdfsdf', 'fssdfsdf', '2023-01-26', '2023-02-11', 'sdfsdf', '34343', '4343', '435454', '324234', '4323'),
(41, 'Beans Project 88', '234', '234523wertw523524sdfwt2454srfwt4t4tr34ertgert34t34', '23423sdt452423423423423', '0000-00-00', '4234-02-03', '23423rsdf23423rfsdar23 352drf 23423erf ef234ewerwe', '9999999999', '9999999999', '9999999999', '9999999999', '9999999999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`img_name`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `year_2016`
--
ALTER TABLE `year_2016`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year_2017`
--
ALTER TABLE `year_2017`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `year_2016`
--
ALTER TABLE `year_2016`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `year_2017`
--
ALTER TABLE `year_2017`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
