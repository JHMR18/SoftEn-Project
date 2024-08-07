-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 08:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g3`
--

-- --------------------------------------------------------

--
-- Table structure for table `scans`
--

CREATE TABLE `scans` (
  `scanID` int(11) NOT NULL,
  `studentID` varchar(20) DEFAULT NULL,
  `scanDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attendanceStatus` enum('absent','present') DEFAULT 'absent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scans`
--

INSERT INTO `scans` (`scanID`, `studentID`, `scanDate`, `attendanceStatus`) VALUES
(251, 'A2021-000003', '2024-01-30 04:15:55', 'present'),
(252, 'A2021-000050', '2024-01-30 04:17:32', 'present'),
(253, 'A2021-000001', '2024-01-30 04:15:55', 'present'),
(263, 'A2021-000050', '2024-02-04 02:16:32', 'present'),
(264, 'A2021-000084', '2024-02-06 03:39:16', 'present'),
(271, 'A2021-000001', '2024-02-09 01:49:17', 'present'),
(273, 'A2021-000050', '2024-02-12 06:19:52', 'present'),
(274, 'A2021-000084', '2024-02-12 06:25:35', 'present'),
(276, 'A2021-000001', '2024-02-13 02:31:17', 'present'),
(277, 'A2021-000003', '2024-02-13 02:31:17', 'present'),
(278, 'A2021-000001', '2024-02-15 04:59:25', 'present'),
(279, 'A2021-000002', '2024-02-15 05:15:10', 'present'),
(280, 'A2021-000006', '2024-02-15 05:15:10', 'present'),
(281, 'A2021-000003', '2024-02-15 05:15:10', 'present'),
(282, 'A2021-000007', '2024-02-15 05:15:10', 'present'),
(283, 'A2021-000012', '2024-02-15 05:15:10', 'present'),
(284, 'A2021-000049', '2024-02-15 05:15:10', 'present'),
(285, 'A2021-000050', '2024-02-15 05:15:10', 'present'),
(286, 'A2021-000075', '2024-02-15 05:15:10', 'present'),
(287, 'A2021-000078', '2024-02-15 05:15:10', 'present'),
(288, 'A2021-000082', '2024-02-15 05:15:10', 'present'),
(289, 'A2021-000084', '2024-02-15 05:15:10', 'present'),
(290, 'A2021-000092', '2024-02-15 05:15:10', 'present'),
(291, 'A2021-000099', '2024-02-15 05:15:10', 'present'),
(298, 'A2021-000049', '2024-02-16 01:18:03', 'present'),
(299, 'A2021-000050', '2024-02-16 01:18:03', 'present'),
(300, 'A2021-000075', '2024-02-16 01:18:03', 'present'),
(301, 'A2021-000078', '2024-02-16 03:36:06', 'present'),
(302, 'A2021-000082', '2024-02-16 03:36:06', 'present'),
(303, 'A2021-000084', '2024-02-16 03:36:06', 'present'),
(304, 'A2021-000001', '2024-02-16 03:36:06', 'present'),
(305, 'A2021-000002', '2024-02-16 03:36:06', 'present'),
(306, 'A2021-000001', '2024-02-21 00:43:49', 'present'),
(307, 'A2021-000002', '2024-02-21 00:43:49', 'present'),
(308, 'A2021-000003', '2024-02-21 00:43:49', 'present'),
(310, 'A2021-000007', '2024-02-21 00:43:49', 'present'),
(311, 'A2021-000012', '2024-02-21 00:43:49', 'present'),
(312, 'A2021-000050', '2024-02-21 00:45:43', 'present'),
(317, 'A2021-000007', '2024-02-22 00:41:13', 'present'),
(318, 'A2021-000012', '2024-02-22 00:41:13', 'present'),
(319, 'A2021-000049', '2024-02-22 00:41:13', 'present'),
(321, 'A2021-000075', '2024-02-22 00:41:13', 'present'),
(322, 'A2021-000078', '2024-02-22 00:41:13', 'present'),
(323, 'A2021-000082', '2024-02-22 00:41:13', 'present'),
(324, 'A2021-000084', '2024-02-22 00:41:13', 'present'),
(327, 'A2021-000092', '2024-02-22 04:23:05', 'present'),
(328, 'A2021-000001', '2024-02-22 04:38:34', 'present'),
(329, 'A2021-000050', '2024-02-22 05:08:16', 'present'),
(330, 'A2021-000002', '2024-02-22 04:47:37', 'present'),
(331, 'A2021-000001', '2024-04-01 05:20:25', 'present'),
(332, 'A2021-000002', '2024-04-01 05:20:25', 'present'),
(333, 'A2021-000003', '2024-04-01 05:20:25', 'present'),
(334, 'A2021-000006', '2024-04-01 05:20:25', 'present'),
(335, 'A2021-000007', '2024-04-01 05:20:25', 'present'),
(336, 'A2021-000012', '2024-04-01 05:20:25', 'present'),
(337, 'A2021-000050', '2024-04-25 12:43:54', 'present'),
(341, 'A2021-000050', '2024-04-26 11:58:03', 'present'),
(342, 'A2021-000001', '2024-04-26 11:57:26', 'present'),
(343, 'A2021-000002', '2024-04-26 11:57:26', 'present'),
(344, 'A2021-000003', '2024-04-26 11:57:26', 'present'),
(345, 'A2021-000006', '2024-04-26 11:57:26', 'present'),
(346, 'A2021-000007', '2024-04-26 11:57:26', 'present'),
(347, 'A2021-000012', '2024-04-26 11:57:26', 'present'),
(348, 'A2021-000049', '2024-04-26 11:57:26', 'present'),
(349, 'A2021-000075', '2024-04-26 11:57:26', 'present'),
(350, 'A2021-000078', '2024-04-26 11:57:26', 'present'),
(351, 'A2021-000082', '2024-04-26 11:57:26', 'present'),
(356, 'A2021-000678', '2024-04-30 11:35:51', 'present'),
(365, 'A2021-000050', '2024-04-30 11:55:09', 'present'),
(366, 'A2021-000050', '2024-05-01 13:00:50', 'present'),
(367, 'A2021-000050', '2024-05-03 07:41:03', 'present'),
(368, 'A2021-000180', '2024-05-03 08:02:32', 'present'),
(369, 'A2021-000123', '2024-05-03 08:02:48', 'present'),
(370, 'A2021-000221', '2024-05-03 08:03:22', 'present'),
(371, 'A2021-000082', '2024-05-03 08:03:41', 'present'),
(372, 'A2021-000205', '2024-05-03 08:06:11', 'present'),
(373, 'A2021-000075', '2024-05-03 08:06:59', 'present'),
(376, 'A2021-000001', '2024-05-13 06:09:38', 'present'),
(377, 'A2021-000122', '2024-05-13 06:22:23', 'present'),
(378, 'A2021-000003', '2024-05-13 06:29:45', 'present'),
(379, 'A2021-000002', '2024-05-13 11:22:17', 'present'),
(380, 'A2021-000006', '2024-05-13 11:22:17', 'present'),
(381, 'A2021-000007', '2024-05-13 11:22:17', 'present'),
(383, 'A2021-000050', '2024-05-13 11:33:25', 'present'),
(384, 'A2021-000050', '2024-05-14 04:26:29', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` varchar(20) NOT NULL,
  `course` varchar(50) DEFAULT NULL,
  `academicYear` int(11) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `course`, `academicYear`, `section`, `firstName`, `middleName`, `lastName`) VALUES
('A2021-000001', 'BSCS', 3, 'A', 'Jeraldine', 'C.', 'Sabio'),
('A2021-000002', 'BSCS', 3, 'A', 'Mary', 'O.', 'Padin'),
('A2021-000003', 'BSCS', 3, 'A', 'Denver', 'R.', 'Cabuyao'),
('A2021-000006', 'BSCS', 3, 'A', 'Julious', 'G.', 'Lacorte'),
('A2021-000007', 'BSCS', 3, 'A', 'John', 'E.', 'Arceta'),
('A2021-000012', 'BSCS', 3, 'A', 'Angelo', 'M.', 'Tabernilla'),
('A2021-000049', 'BSCS', 3, 'A', 'Coleen', 'A.', 'Baldon'),
('A2021-000050', 'BSCS', 3, 'A', 'Jhomer', 'M.', 'Opulencia'),
('A2021-000075', 'BSCS', 3, 'A', 'Mark', 'F.', 'Mangubat'),
('A2021-000078', 'BSCS', 3, 'A', 'Christine', 'C.', 'Balanguit'),
('A2021-000082', 'BSCS', 3, 'A', 'Raymond', 'M.', 'Ramos'),
('A2021-000084', 'BSCS', 3, 'A', 'Javie', 'J.', 'Lazo'),
('A2021-000092', 'BSCS', 3, 'A', 'Alexandreate', 'A.', 'Naynes'),
('A2021-000109', 'BSCS', 3, 'A', 'Marinella', 'Lacorte', ''),
('A2021-000113', 'BSCS', 3, 'A', 'Derish', 'M.', 'Pechera'),
('A2021-000116', 'BSCS', 3, 'A', 'Shiela', 'L.', 'Cueto'),
('A2021-000119', 'BSCS', 3, 'A', 'Christa', 'R.', 'Ferrera'),
('A2021-000121', 'BSCS', 3, 'A', 'John', 'Delas', 'Alas'),
('A2021-000122', 'BSCS', 3, 'A', 'Gellian', 'O.', 'Baasis'),
('A2021-000123', 'BSCS', 3, 'A', 'Rjoven', 'Buerano', ''),
('A2021-000179', 'BSCS', 3, 'A', 'Almira', 'J.', 'Romana'),
('A2021-000180', 'BSCS', 3, 'A', 'Myke', 'S.', 'Ebora'),
('A2021-000205', 'BSCS', 3, 'A', 'Alyssa', 'A.', 'Sumilang'),
('A2021-000221', 'BSCS', 3, 'A', 'Mary', 'O.', 'Villamayor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('teacher','admin') NOT NULL,
  `course` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `course`) VALUES
(11, 'teacher1', '41c8949aa55b8cb5dbec662f34b62df3', 'teacher', 'BSCS'),
(16, 'admin2', '$2y$10$ttRitm1R0tmqBEMYMVWtj.VQRAKt5trYvrhb7MqAXOMFlvP3qdOji', 'admin', ''),
(17, 'jhomer', '$2y$10$KLFdvyJcsJ44eYx1evzPZeVtDU2xZpYq3FEDnify9SWMZNIapiYFO', 'teacher', 'BSCS'),
(18, 'teacher2', '$2y$10$N4/HBZYsk33MEDWqrJpJfew18ZW/99TOs1zBbxiSYGxcxA8/IxrmC', 'teacher', 'BSCS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scans`
--
ALTER TABLE `scans`
  ADD PRIMARY KEY (`scanID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scans`
--
ALTER TABLE `scans`
  MODIFY `scanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
