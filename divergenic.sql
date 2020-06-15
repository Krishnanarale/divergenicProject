-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2020 at 10:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `divergenic`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminUser`
--

CREATE TABLE `adminUser` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminUser`
--

INSERT INTO `adminUser` (`id`, `name`, `email`, `password`, `type`, `created_at`) VALUES
(1, 'Super Admin', 'admin@mail.com', 'admin', 1, '2020-06-13 14:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `hobbie` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`id`, `userId`, `hobbie`, `created_at`) VALUES
(1, 1, 'Watching', '2020-06-14 07:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `subHobbies`
--

CREATE TABLE `subHobbies` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `hobbieId` int(11) NOT NULL,
  `subHobbie` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subHobbies`
--

INSERT INTO `subHobbies` (`id`, `userId`, `hobbieId`, `subHobbie`, `created_at`) VALUES
(1, 1, 1, 'Cricket', '2020-06-14 07:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Demo User', 'demo@mail.com', 'demo', '2020-06-14 07:35:12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_Hobbies`
-- (See below for the actual view)
--
CREATE TABLE `vw_Hobbies` (
`id` int(11)
,`user` varchar(255)
,`hobbie` varchar(255)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_SubHobbies`
-- (See below for the actual view)
--
CREATE TABLE `vw_SubHobbies` (
`id` int(11)
,`userId` int(11)
,`hobbieId` varchar(255)
,`subHobbie` varchar(255)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_subHobbies`
-- (See below for the actual view)
--
CREATE TABLE `vw_subHobbies` (
`id` int(11)
,`userId` varchar(255)
,`hobbieId` varchar(255)
,`subHobbie` varchar(255)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `vw_Hobbies`
--
DROP TABLE IF EXISTS `vw_Hobbies`;

CREATE VIEW `vw_Hobbies`  AS  select `hobbies`.`id` AS `id`,`users`.`name` AS `user`,`hobbies`.`hobbie` AS `hobbie`,`hobbies`.`created_at` AS `created_at` from (`hobbies` join `users` on(`hobbies`.`userId` = `users`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_SubHobbies`
--
DROP TABLE IF EXISTS `vw_SubHobbies`;

CREATE VIEW `vw_SubHobbies`  AS  select `subHobbies`.`id` AS `id`,`subHobbies`.`userId` AS `userId`,`hobbies`.`hobbie` AS `hobbieId`,`subHobbies`.`subHobbie` AS `subHobbie`,`subHobbies`.`created_at` AS `created_at` from (`subHobbies` join `hobbies` on(`subHobbies`.`hobbieId` = `hobbies`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_subHobbies`
--
DROP TABLE IF EXISTS `vw_subHobbies`;

CREATE VIEW `vw_subHobbies`  AS  select `subHobbies`.`id` AS `id`,`users`.`name` AS `userId`,`hobbies`.`hobbie` AS `hobbieId`,`subHobbies`.`subHobbie` AS `subHobbie`,`subHobbies`.`created_at` AS `created_at` from ((`subHobbies` join `hobbies` on(`subHobbies`.`hobbieId` = `hobbies`.`id`)) join `users` on(`subHobbies`.`userId` = `users`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminUser`
--
ALTER TABLE `adminUser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subHobbies`
--
ALTER TABLE `subHobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminUser`
--
ALTER TABLE `adminUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subHobbies`
--
ALTER TABLE `subHobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
