-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 07:33 PM
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
-- Database: `crycry`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `AllocationID` int(11) NOT NULL,
  `ApplicationID` int(11) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `AllocationDate` datetime DEFAULT NULL,
  `moveoutdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`AllocationID`, `ApplicationID`, `RoomID`, `AllocationDate`, `moveoutdate`) VALUES
(32, 15, 16, '2023-10-17 18:52:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `RoomTypeID` int(11) DEFAULT NULL,
  `ResidenceName` enum('Moroka','Hannentjie','Rathaga') NOT NULL,
  `DisabilityCriteria` enum('Yes','No') DEFAULT NULL,
  `YearOfStudy` int(11) DEFAULT NULL,
  `ApplicationDate` datetime DEFAULT NULL,
  `ResidenceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`ApplicationID`, `StudentID`, `RoomTypeID`, `ResidenceName`, `DisabilityCriteria`, `YearOfStudy`, `ApplicationDate`, `ResidenceID`) VALUES
(15, 19120436, 1, 'Moroka', 'Yes', 3, '2023-10-17 11:24:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `ManagerID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`ManagerID`, `username`, `password`) VALUES
(1, 'Admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `residencedetails`
--

CREATE TABLE `residencedetails` (
  `ResidenceDetailID` int(11) NOT NULL,
  `ResidenceID` int(11) DEFAULT NULL,
  `RoomTypeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residences`
--

CREATE TABLE `residences` (
  `ResidenceID` int(11) NOT NULL,
  `ResidenceName` varchar(255) NOT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `ManagerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residences`
--

INSERT INTO `residences` (`ResidenceID`, `ResidenceName`, `Capacity`, `Description`, `ManagerID`) VALUES
(1, 'Moroka', 250, '50 single rooms, 200 sharing rooms', 1),
(2, 'Hannentjie', 500, '150 single rooms for postgraduates, 100 for student leaders and 50 for special criterias', 1),
(3, 'Rathaga', 150, 'The smallest residences with only single rooms, Self-Catering residence', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(255) DEFAULT NULL,
  `ResidenceID` int(11) DEFAULT NULL,
  `Occupied` enum('Yes','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomNumber`, `ResidenceID`, `Occupied`) VALUES
(16, 'Room001', 1, 'Yes'),
(17, 'Room002', 1, 'No'),
(18, 'Room003', 1, 'No'),
(19, 'Room004', 1, 'No'),
(20, 'Room005', 1, 'No'),
(21, 'Room006', 1, 'No'),
(22, 'Room007', 1, 'No'),
(23, 'Room008', 1, 'No'),
(24, 'Room009', 1, 'No'),
(25, 'Room010', 1, 'No'),
(26, 'Room011', 1, 'No'),
(27, 'Room012', 1, 'No'),
(28, 'Room013', 1, 'No'),
(29, 'Room014', 1, 'No'),
(30, 'Room015', 1, 'No'),
(31, 'Room016', 1, 'No'),
(32, 'Room017', 1, 'No'),
(33, 'Room018', 1, 'No'),
(34, 'Room019', 1, 'No'),
(35, 'Room020', 1, 'No'),
(36, 'Room021', 1, 'No'),
(37, 'Room022', 1, 'No'),
(38, 'Room023', 1, 'No'),
(39, 'Room024', 1, 'No'),
(40, 'Room025', 1, 'No'),
(41, 'Room026', 1, 'No'),
(42, 'Room027', 1, 'No'),
(43, 'Room028', 1, 'No'),
(44, 'Room029', 1, 'No'),
(45, 'Room030', 1, 'No'),
(46, 'Room031', 1, 'No'),
(47, 'Room032', 1, 'No'),
(48, 'Room033', 1, 'No'),
(49, 'Room034', 1, 'No'),
(50, 'Room035', 1, 'No'),
(51, 'Room036', 1, 'No'),
(52, 'Room037', 1, 'No'),
(53, 'Room038', 1, 'No'),
(54, 'Room039', 1, 'No'),
(55, 'Room040', 1, 'No'),
(56, 'Room041', 1, 'No'),
(57, 'Room042', 1, 'No'),
(58, 'Room043', 1, 'No'),
(59, 'Room044', 1, 'No'),
(60, 'Room045', 1, 'No'),
(61, 'Room046', 1, 'No'),
(62, 'Room047', 1, 'No'),
(63, 'Room048', 1, 'No'),
(64, 'Room049', 1, 'No'),
(65, 'Room050', 1, 'No'),
(79, 'Room001', 2, 'No'),
(80, 'Room002', 2, 'No'),
(81, 'Room003', 2, 'No'),
(82, 'Room004', 2, 'No'),
(83, 'Room005', 2, 'No'),
(84, 'Room006', 2, 'No'),
(85, 'Room007', 2, 'No'),
(86, 'Room008', 2, 'No'),
(87, 'Room009', 2, 'No'),
(88, 'Room010', 2, 'No'),
(89, 'Room011', 2, 'No'),
(90, 'Room012', 2, 'No'),
(91, 'Room013', 2, 'No'),
(92, 'Room014', 2, 'No'),
(93, 'Room015', 2, 'No'),
(94, 'Room016', 2, 'No'),
(95, 'Room017', 2, 'No'),
(96, 'Room018', 2, 'No'),
(97, 'Room019', 2, 'No'),
(98, 'Room020', 2, 'No'),
(99, 'Room021', 2, 'No'),
(100, 'Room022', 2, 'No'),
(101, 'Room023', 2, 'No'),
(102, 'Room024', 2, 'No'),
(103, 'Room025', 2, 'No'),
(104, 'Room026', 2, 'No'),
(105, 'Room027', 2, 'No'),
(106, 'Room028', 2, 'No'),
(107, 'Room029', 2, 'No'),
(108, 'Room030', 2, 'No'),
(109, 'Room031', 2, 'No'),
(110, 'Room032', 2, 'No'),
(111, 'Room033', 2, 'No'),
(112, 'Room034', 2, 'No'),
(113, 'Room035', 2, 'No'),
(114, 'Room036', 2, 'No'),
(115, 'Room037', 2, 'No'),
(116, 'Room038', 2, 'No'),
(117, 'Room039', 2, 'No'),
(118, 'Room040', 2, 'No'),
(119, 'Room041', 2, 'No'),
(120, 'Room042', 2, 'No'),
(121, 'Room043', 2, 'No'),
(122, 'Room044', 2, 'No'),
(123, 'Room045', 2, 'No'),
(124, 'Room046', 2, 'No'),
(125, 'Room047', 2, 'No'),
(126, 'Room048', 2, 'No'),
(127, 'Room049', 2, 'No'),
(128, 'Room050', 2, 'No'),
(142, 'Room001', 3, 'No'),
(143, 'Room002', 3, 'No'),
(144, 'Room003', 3, 'No'),
(145, 'Room004', 3, 'No'),
(146, 'Room005', 3, 'No'),
(147, 'Room006', 3, 'No'),
(148, 'Room007', 3, 'No'),
(149, 'Room008', 3, 'No'),
(150, 'Room009', 3, 'No'),
(151, 'Room010', 3, 'No'),
(152, 'Room011', 3, 'No'),
(153, 'Room012', 3, 'No'),
(154, 'Room013', 3, 'No'),
(155, 'Room014', 3, 'No'),
(156, 'Room015', 3, 'No'),
(157, 'Room016', 3, 'No'),
(158, 'Room017', 3, 'No'),
(159, 'Room018', 3, 'No'),
(160, 'Room019', 3, 'No'),
(161, 'Room020', 3, 'No'),
(162, 'Room021', 3, 'No'),
(163, 'Room022', 3, 'No'),
(164, 'Room023', 3, 'No'),
(165, 'Room024', 3, 'No'),
(166, 'Room025', 3, 'No'),
(167, 'Room026', 3, 'No'),
(168, 'Room027', 3, 'No'),
(169, 'Room028', 3, 'No'),
(170, 'Room029', 3, 'No'),
(171, 'Room030', 3, 'No'),
(172, 'Room031', 3, 'No'),
(173, 'Room032', 3, 'No'),
(174, 'Room033', 3, 'No'),
(175, 'Room034', 3, 'No'),
(176, 'Room035', 3, 'No'),
(177, 'Room036', 3, 'No'),
(178, 'Room037', 3, 'No'),
(179, 'Room038', 3, 'No'),
(180, 'Room039', 3, 'No'),
(181, 'Room040', 3, 'No'),
(182, 'Room041', 3, 'No'),
(183, 'Room042', 3, 'No'),
(184, 'Room043', 3, 'No'),
(185, 'Room044', 3, 'No'),
(186, 'Room045', 3, 'No'),
(187, 'Room046', 3, 'No'),
(188, 'Room047', 3, 'No'),
(189, 'Room048', 3, 'No'),
(190, 'Room049', 3, 'No'),
(191, 'Room050', 3, 'No'),
(205, 'Room001', 1, 'No'),
(206, 'Room002', 1, 'No'),
(207, 'Room003', 1, 'No'),
(208, 'Room004', 1, 'No'),
(209, 'Room005', 1, 'No'),
(210, 'Room006', 1, 'No'),
(211, 'Room007', 1, 'No'),
(212, 'Room008', 1, 'No'),
(213, 'Room009', 1, 'No'),
(214, 'Room010', 1, 'No'),
(215, 'Room011', 1, 'No'),
(216, 'Room012', 1, 'No'),
(217, 'Room013', 1, 'No'),
(218, 'Room014', 1, 'No'),
(219, 'Room015', 1, 'No'),
(220, 'Room016', 1, 'No'),
(221, 'Room017', 1, 'No'),
(222, 'Room018', 1, 'No'),
(223, 'Room019', 1, 'No'),
(224, 'Room020', 1, 'No'),
(225, 'Room021', 1, 'No'),
(226, 'Room022', 1, 'No'),
(227, 'Room023', 1, 'No'),
(228, 'Room024', 1, 'No'),
(229, 'Room025', 1, 'No'),
(230, 'Room026', 1, 'No'),
(231, 'Room027', 1, 'No'),
(232, 'Room028', 1, 'No'),
(233, 'Room029', 1, 'No'),
(234, 'Room030', 1, 'No'),
(235, 'Room031', 1, 'No'),
(236, 'Room032', 1, 'No'),
(237, 'Room033', 1, 'No'),
(238, 'Room034', 1, 'No'),
(239, 'Room035', 1, 'No'),
(240, 'Room036', 1, 'No'),
(241, 'Room037', 1, 'No'),
(242, 'Room038', 1, 'No'),
(243, 'Room039', 1, 'No'),
(244, 'Room040', 1, 'No'),
(245, 'Room041', 1, 'No'),
(246, 'Room042', 1, 'No'),
(247, 'Room043', 1, 'No'),
(248, 'Room044', 1, 'No'),
(249, 'Room045', 1, 'No'),
(250, 'Room046', 1, 'No'),
(251, 'Room047', 1, 'No'),
(252, 'Room048', 1, 'No'),
(253, 'Room049', 1, 'No'),
(254, 'Room050', 1, 'No'),
(268, 'Room001', 2, 'No'),
(269, 'Room002', 2, 'No'),
(270, 'Room003', 2, 'No'),
(271, 'Room004', 2, 'No'),
(272, 'Room005', 2, 'No'),
(273, 'Room006', 2, 'No'),
(274, 'Room007', 2, 'No'),
(275, 'Room008', 2, 'No'),
(276, 'Room009', 2, 'No'),
(277, 'Room010', 2, 'No'),
(278, 'Room011', 2, 'No'),
(279, 'Room012', 2, 'No'),
(280, 'Room013', 2, 'No'),
(281, 'Room014', 2, 'No'),
(282, 'Room015', 2, 'No'),
(283, 'Room016', 2, 'No'),
(284, 'Room017', 2, 'No'),
(285, 'Room018', 2, 'No'),
(286, 'Room019', 2, 'No'),
(287, 'Room020', 2, 'No'),
(288, 'Room021', 2, 'No'),
(289, 'Room022', 2, 'No'),
(290, 'Room023', 2, 'No'),
(291, 'Room024', 2, 'No'),
(292, 'Room025', 2, 'No'),
(293, 'Room026', 2, 'No'),
(294, 'Room027', 2, 'No'),
(295, 'Room028', 2, 'No'),
(296, 'Room029', 2, 'No'),
(297, 'Room030', 2, 'No'),
(298, 'Room031', 2, 'No'),
(299, 'Room032', 2, 'No'),
(300, 'Room033', 2, 'No'),
(301, 'Room034', 2, 'No'),
(302, 'Room035', 2, 'No'),
(303, 'Room036', 2, 'No'),
(304, 'Room037', 2, 'No'),
(305, 'Room038', 2, 'No'),
(306, 'Room039', 2, 'No'),
(307, 'Room040', 2, 'No'),
(308, 'Room041', 2, 'No'),
(309, 'Room042', 2, 'No'),
(310, 'Room043', 2, 'No'),
(311, 'Room044', 2, 'No'),
(312, 'Room045', 2, 'No'),
(313, 'Room046', 2, 'No'),
(314, 'Room047', 2, 'No'),
(315, 'Room048', 2, 'No'),
(316, 'Room049', 2, 'No'),
(317, 'Room050', 2, 'No'),
(331, 'Room001', 3, 'No'),
(332, 'Room002', 3, 'No'),
(333, 'Room003', 3, 'No'),
(334, 'Room004', 3, 'No'),
(335, 'Room005', 3, 'No'),
(336, 'Room006', 3, 'No'),
(337, 'Room007', 3, 'No'),
(338, 'Room008', 3, 'No'),
(339, 'Room009', 3, 'No'),
(340, 'Room010', 3, 'No'),
(341, 'Room011', 3, 'No'),
(342, 'Room012', 3, 'No'),
(343, 'Room013', 3, 'No'),
(344, 'Room014', 3, 'No'),
(345, 'Room015', 3, 'No'),
(346, 'Room016', 3, 'No'),
(347, 'Room017', 3, 'No'),
(348, 'Room018', 3, 'No'),
(349, 'Room019', 3, 'No'),
(350, 'Room020', 3, 'No'),
(351, 'Room021', 3, 'No'),
(352, 'Room022', 3, 'No'),
(353, 'Room023', 3, 'No'),
(354, 'Room024', 3, 'No'),
(355, 'Room025', 3, 'No'),
(356, 'Room026', 3, 'No'),
(357, 'Room027', 3, 'No'),
(358, 'Room028', 3, 'No'),
(359, 'Room029', 3, 'No'),
(360, 'Room030', 3, 'No'),
(361, 'Room031', 3, 'No'),
(362, 'Room032', 3, 'No'),
(363, 'Room033', 3, 'No'),
(364, 'Room034', 3, 'No'),
(365, 'Room035', 3, 'No'),
(366, 'Room036', 3, 'No'),
(367, 'Room037', 3, 'No'),
(368, 'Room038', 3, 'No'),
(369, 'Room039', 3, 'No'),
(370, 'Room040', 3, 'No'),
(371, 'Room041', 3, 'No'),
(372, 'Room042', 3, 'No'),
(373, 'Room043', 3, 'No'),
(374, 'Room044', 3, 'No'),
(375, 'Room045', 3, 'No'),
(376, 'Room046', 3, 'No'),
(377, 'Room047', 3, 'No'),
(378, 'Room048', 3, 'No'),
(379, 'Room049', 3, 'No'),
(380, 'Room050', 3, 'No'),
(394, 'Room001', 2, 'No'),
(395, 'Room002', 2, 'No'),
(396, 'Room003', 2, 'No'),
(397, 'Room004', 2, 'No'),
(398, 'Room005', 2, 'No'),
(399, 'Room006', 2, 'No'),
(400, 'Room007', 2, 'No'),
(401, 'Room008', 2, 'No'),
(402, 'Room009', 2, 'No'),
(403, 'Room010', 2, 'No'),
(404, 'Room011', 2, 'No'),
(405, 'Room012', 2, 'No'),
(406, 'Room013', 2, 'No'),
(407, 'Room014', 2, 'No'),
(408, 'Room015', 2, 'No'),
(409, 'Room016', 2, 'No'),
(410, 'Room017', 2, 'No'),
(411, 'Room018', 2, 'No'),
(412, 'Room019', 2, 'No'),
(413, 'Room020', 2, 'No'),
(414, 'Room021', 2, 'No'),
(415, 'Room022', 2, 'No'),
(416, 'Room023', 2, 'No'),
(417, 'Room024', 2, 'No'),
(418, 'Room025', 2, 'No'),
(419, 'Room026', 2, 'No'),
(420, 'Room027', 2, 'No'),
(421, 'Room028', 2, 'No'),
(422, 'Room029', 2, 'No'),
(423, 'Room030', 2, 'No'),
(424, 'Room031', 2, 'No'),
(425, 'Room032', 2, 'No'),
(426, 'Room033', 2, 'No'),
(427, 'Room034', 2, 'No'),
(428, 'Room035', 2, 'No'),
(429, 'Room036', 2, 'No'),
(430, 'Room037', 2, 'No'),
(431, 'Room038', 2, 'No'),
(432, 'Room039', 2, 'No'),
(433, 'Room040', 2, 'No'),
(434, 'Room041', 2, 'No'),
(435, 'Room042', 2, 'No'),
(436, 'Room043', 2, 'No'),
(437, 'Room044', 2, 'No'),
(438, 'Room045', 2, 'No'),
(439, 'Room046', 2, 'No'),
(440, 'Room047', 2, 'No'),
(441, 'Room048', 2, 'No'),
(442, 'Room049', 2, 'No'),
(443, 'Room050', 2, 'No'),
(457, 'Room001', 3, 'No'),
(458, 'Room002', 3, 'No'),
(459, 'Room003', 3, 'No'),
(460, 'Room004', 3, 'No'),
(461, 'Room005', 3, 'No'),
(462, 'Room006', 3, 'No'),
(463, 'Room007', 3, 'No'),
(464, 'Room008', 3, 'No'),
(465, 'Room009', 3, 'No'),
(466, 'Room010', 3, 'No'),
(467, 'Room011', 3, 'No'),
(468, 'Room012', 3, 'No'),
(469, 'Room013', 3, 'No'),
(470, 'Room014', 3, 'No'),
(471, 'Room015', 3, 'No'),
(472, 'Room016', 3, 'No'),
(473, 'Room017', 3, 'No'),
(474, 'Room018', 3, 'No'),
(475, 'Room019', 3, 'No'),
(476, 'Room020', 3, 'No'),
(477, 'Room021', 3, 'No'),
(478, 'Room022', 3, 'No'),
(479, 'Room023', 3, 'No'),
(480, 'Room024', 3, 'No'),
(481, 'Room025', 3, 'No'),
(482, 'Room026', 3, 'No'),
(483, 'Room027', 3, 'No'),
(484, 'Room028', 3, 'No'),
(485, 'Room029', 3, 'No'),
(486, 'Room030', 3, 'No'),
(487, 'Room031', 3, 'No'),
(488, 'Room032', 3, 'No'),
(489, 'Room033', 3, 'No'),
(490, 'Room034', 3, 'No'),
(491, 'Room035', 3, 'No'),
(492, 'Room036', 3, 'No'),
(493, 'Room037', 3, 'No'),
(494, 'Room038', 3, 'No'),
(495, 'Room039', 3, 'No'),
(496, 'Room040', 3, 'No'),
(497, 'Room041', 3, 'No'),
(498, 'Room042', 3, 'No'),
(499, 'Room043', 3, 'No'),
(500, 'Room044', 3, 'No'),
(501, 'Room045', 3, 'No'),
(502, 'Room046', 3, 'No'),
(503, 'Room047', 3, 'No'),
(504, 'Room048', 3, 'No'),
(505, 'Room049', 3, 'No'),
(506, 'Room050', 3, 'No'),
(520, 'Room001', 2, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeID` int(11) NOT NULL,
  `RoomType` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`RoomTypeID`, `RoomType`, `Description`) VALUES
(1, 'Golden Studio', 'Price range from 7k-10k'),
(2, 'Single Bachelor', 'Price 4-5k, supports disabled'),
(3, 'Single Bachelorette', 'Female Rooms, supports disabled'),
(4, 'Sharing', 'Price 3k-4k, supports disabled');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusID` int(11) NOT NULL,
  `ApplicationStatus` varchar(255) DEFAULT NULL,
  `ApplicationID` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusID`, `ApplicationStatus`, `ApplicationID`, `Date`) VALUES
(5, 'Approved', 15, '2023-10-17 18:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `NationalID` varchar(255) DEFAULT NULL,
  `EmergencyContact` varchar(255) DEFAULT NULL,
  `CurrentAddress` text DEFAULT NULL,
  `AcademicProgram` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Gender`, `DateOfBirth`, `Email`, `Phone`, `NationalID`, `EmergencyContact`, `CurrentAddress`, `AcademicProgram`, `username`) VALUES
(19120436, 'Solomon', 'Makuwa', 'Male', '1999-03-02', 'user@yahoo', '0765329997', '9903025777083', '0765329997', 'P.o Box Limpopo', 'ICT', 'user123');

-- --------------------------------------------------------

--
-- Table structure for table `systemconfig`
--

CREATE TABLE `systemconfig` (
  `ApplicationDeadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemconfig`
--

INSERT INTO `systemconfig` (`ApplicationDeadline`) VALUES
('2024-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('user123', '123', 'user@yahoo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
  ADD PRIMARY KEY (`AllocationID`),
  ADD KEY `ApplicationID` (`ApplicationID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD UNIQUE KEY `RoomTypeID` (`RoomTypeID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `ResidenceID` (`ResidenceID`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`ManagerID`);

--
-- Indexes for table `residencedetails`
--
ALTER TABLE `residencedetails`
  ADD PRIMARY KEY (`ResidenceDetailID`),
  ADD KEY `residencedetails_ibfk_1` (`ResidenceID`),
  ADD KEY `residencedetails_ibfk_2` (`RoomTypeID`);

--
-- Indexes for table `residences`
--
ALTER TABLE `residences`
  ADD PRIMARY KEY (`ResidenceID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `rooms_ibfk_1` (`ResidenceID`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`RoomTypeID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusID`),
  ADD UNIQUE KEY `ApplicationID` (`ApplicationID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocations`
--
ALTER TABLE `allocations`
  MODIFY `AllocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ManagerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `residencedetails`
--
ALTER TABLE `residencedetails`
  MODIFY `ResidenceDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residences`
--
ALTER TABLE `residences`
  MODIFY `ResidenceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=521;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202211186;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocations`
--
ALTER TABLE `allocations`
  ADD CONSTRAINT `allocations_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`),
  ADD CONSTRAINT `allocations_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`ResidenceID`) REFERENCES `residences` (`ResidenceID`),
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtypes` (`RoomTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `residencedetails`
--
ALTER TABLE `residencedetails`
  ADD CONSTRAINT `residencedetails_ibfk_1` FOREIGN KEY (`ResidenceID`) REFERENCES `residences` (`ResidenceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `residencedetails_ibfk_2` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtypes` (`RoomTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`ResidenceID`) REFERENCES `residences` (`ResidenceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
