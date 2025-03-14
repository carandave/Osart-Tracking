-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 15, 2022 at 04:25 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osart`
--

-- --------------------------------------------------------

--
-- Table structure for table `incident_list`
--

CREATE TABLE `incident_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incident_list`
--

INSERT INTO `incident_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Traffic Accident', 'This Incident is for Traffic Accident', 1, 1, '2022-04-26 09:54:35', '2022-08-13 23:08:56'),
(2, 'Worker Injury', 'Worker injury incident', 1, 0, '2022-04-26 09:57:41', '2022-08-13 23:09:06'),
(3, 'Vehicle', 'Vehicle Incident', 1, 1, '2022-04-26 09:58:13', '2022-08-13 23:08:59'),
(4, 'Fire', 'This is for Fire Incident.', 1, 1, '2022-04-26 09:58:33', '2022-08-13 23:08:54'),
(5, 'test', 'test123', 0, 1, '2022-04-26 09:58:45', '2022-04-26 09:58:50'),
(6, 'tes', 'asdasd', 1, 1, '2022-04-26 09:59:17', '2022-04-26 10:11:08'),
(7, 'Environmental incident', 'Environmental incident', 1, 0, '2022-08-13 23:09:20', '2022-08-13 23:09:20'),
(8, 'Property damage incident', 'Property damage incident', 1, 0, '2022-08-13 23:09:37', '2022-08-13 23:09:37'),
(9, 'Vehicle incident', 'Vehicle incident', 1, 0, '2022-08-13 23:09:45', '2022-08-13 23:09:45'),
(10, 'Fire incident', 'Fire incident', 1, 0, '2022-08-13 23:09:52', '2022-08-13 23:09:52'),
(11, 'Traffic incident', 'Traffic incident', 1, 0, '2022-08-13 23:10:03', '2022-08-13 23:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `report_list`
--

CREATE TABLE `report_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) DEFAULT NULL,
  `incident_id` int(30) NOT NULL,
  `report_datetime` datetime NOT NULL,
  `remarks` text NOT NULL,
  `location` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending,\r\n1 = Done',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_list`
--

INSERT INTO `report_list` (`id`, `user_id`, `incident_id`, `report_datetime`, `remarks`, `location`, `status`, `date_created`, `date_updated`) VALUES
(3, 1, 2, '2022-04-26 13:37:00', 'Urgent Please', 'Mandaluyong City', 1, '2022-04-26 13:40:26', '2022-08-13 23:24:10'),
(5, 3, 10, '2022-08-15 10:16:00', 'Urgent', 'Ortigas Avenue', 1, '2022-08-15 10:17:29', '2022-08-15 10:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `report_teams`
--

CREATE TABLE `report_teams` (
  `report_id` int(30) NOT NULL,
  `team_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_teams`
--

INSERT INTO `report_teams` (`report_id`, `team_id`) VALUES
(3, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `respondent_type_list`
--

CREATE TABLE `respondent_type_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `respondent_type_list`
--

INSERT INTO `respondent_type_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Jaro', 1, 0, '2022-04-26 10:14:23', '2022-08-13 23:03:32'),
(2, 'Fire Fighters', 1, 1, '2022-04-26 10:15:45', '2022-08-13 23:02:35'),
(3, 'Traffic Enforcers', 1, 1, '2022-04-26 10:16:07', '2022-08-13 23:02:41'),
(4, 'Paramedic', 1, 1, '2022-04-26 10:16:21', '2022-08-13 23:02:38'),
(5, 'LGU Fire Station', 1, 0, '2022-08-15 10:13:51', '2022-08-15 10:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'OSART Tracking System'),
(6, 'short_name', 'OSART Tracking System'),
(11, 'logo', 'uploads/logo.png?v=1650937184'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1650937518');

-- --------------------------------------------------------

--
-- Table structure for table `team_list`
--

CREATE TABLE `team_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `team_leader` text NOT NULL,
  `respondent_type` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_list`
--

INSERT INTO `team_list` (`id`, `code`, `team_leader`, `respondent_type`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '1001', 'Mark Williams', 1, 1, 0, '2022-04-26 10:39:00', '2022-04-26 10:39:00'),
(2, '1002', 'John Smith', 1, 1, 1, '2022-04-26 10:39:11', '2022-08-13 23:01:52'),
(3, 'F-1001', 'George Wilson', 2, 1, 1, '2022-04-26 10:42:25', '2022-08-13 23:01:55'),
(4, 'F-1002', 'Sample Leader', 2, 1, 1, '2022-04-26 10:43:06', '2022-08-13 23:01:57'),
(5, 'P-1001', 'Test 101', 4, 1, 1, '2022-04-26 10:43:31', '2022-08-13 23:02:02'),
(6, 'P-1002', 'Test 103', 4, 1, 1, '2022-04-26 10:43:49', '2022-08-13 23:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'OSART', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-08-13 22:57:02'),
(3, 'John', 'Smith', 'responder1', '7ca8ac186938084358bef2616feb3d0a', 'uploads/avatars/3.png?v=1650527149', NULL, 2, '2022-04-21 15:45:49', '2022-08-13 23:40:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident_list`
--
ALTER TABLE `incident_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_list`
--
ALTER TABLE `report_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `incident_id` (`incident_id`);

--
-- Indexes for table `report_teams`
--
ALTER TABLE `report_teams`
  ADD KEY `report_id` (`report_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `respondent_type_list`
--
ALTER TABLE `respondent_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_list`
--
ALTER TABLE `team_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respondent_type` (`respondent_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident_list`
--
ALTER TABLE `incident_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report_list`
--
ALTER TABLE `report_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `respondent_type_list`
--
ALTER TABLE `respondent_type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `team_list`
--
ALTER TABLE `team_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `report_list`
--
ALTER TABLE `report_list`
  ADD CONSTRAINT `incident_id_fk_rl` FOREIGN KEY (`incident_id`) REFERENCES `incident_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id_fk_rl` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `report_teams`
--
ALTER TABLE `report_teams`
  ADD CONSTRAINT `report_id_fk_rt` FOREIGN KEY (`report_id`) REFERENCES `report_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_id_fk_rt` FOREIGN KEY (`team_id`) REFERENCES `team_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `team_list`
--
ALTER TABLE `team_list`
  ADD CONSTRAINT `respondent_type_fk_tl` FOREIGN KEY (`respondent_type`) REFERENCES `respondent_type_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
