-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 04:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsoms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `announcement_desc` text DEFAULT NULL,
  `photo` varchar(70) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`announcement_id`, `title`, `organization_id`, `announcement_desc`, `photo`, `date_inserted`) VALUES
(1, 'BLOODLETTING!', 29, 'Get ready to roll up your sleeves and save lives! We\'re thrilled to announce the upcoming Bloodletting Event at ASSCAT. Join us on August 30,2023 from 8 am at School grounds to make a significant impact on our community\'s health. Your generous donation can make a difference and help those in need.\n\nParticipate in this life-saving event and experience the joy of giving back. Don\'t miss the chance to show your support and solidarity. Mark your calendars, spread the word, and let\'s make this bloodletting event a resounding success together. Your donation could be the lifeline someone desperately needs. See you there! 💪🩸', 'f3ccdd27d2000e3f9255a7e3e2c48800.jpg', '2023-08-10 23:09:47'),
(5, '🎓 Save the Date: Graduation Ball - A Night of Elegance and Celebration! 🎉', 29, 'It\'s time to put on your finest attire and celebrate your remarkable journey at ASSCAT\'s highly anticipated Graduation Ball! Join us on October 29 at Amaris for an unforgettable evening of glamour, music, and heartfelt reminiscences. This is your chance to dance the night away and bid farewell to your fellow graduates.\n\nThe Graduation Ball promises to be a night of elegance and joy, where you can create lasting memories with your classmates before embarking on new adventures. Delicious cuisine, enchanting music, and a captivating ambiance await you. Formal attire is a must, so prepare to dazzle in your best outfits.\n\nStay tuned for ticket details and additional information as we approach the date. Get ready to celebrate your achievements in style at the Graduation Ball – a night you won\'t want to miss! 🎉🕺💃', '182845aceb39c9e413e28fd549058cf8.jpeg', '2023-08-19 16:06:23'),
(7, '🏆 Calling All Athletes! 🏆', 29, 'From soccer to basketball, volleyball to track and field, our Intramurals Event will feature a variety of sports to cater to all interests. Gather your teammates, practice those skills, and prepare to give it your all. This event isn\'t just about winning; it\'s about fostering teamwork, sportsmanship, and creating unforgettable memories. Mark your calendars and be part of this exciting celebration of sportsmanship and camaraderie. Stay tuned for more details on schedules and registration. Let\'s make this Intramurals Event at ASSCAT one for the books! 🏅🎉', '156005c5baf40ff51a327f1c34f2975b.jpg', '2023-08-21 21:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `event_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `event_desc` text DEFAULT NULL,
  `expenses` double DEFAULT NULL,
  `photo` varchar(70) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `last_event_date` datetime DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL COMMENT '0 = inactive 1=active',
  `date_inserted` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`event_id`, `organization_id`, `event_desc`, `expenses`, `photo`, `event_date`, `last_event_date`, `type`, `isActive`, `date_inserted`) VALUES
(18, 29, 'Blood Letting', 20000, NULL, '2023-08-10 00:00:00', '2023-08-12 00:00:00', NULL, 1, '2023-10-01 13:34:23'),
(19, 30, 'Tactical', 10000, NULL, '2023-10-04 00:00:00', '2023-10-07 00:00:00', NULL, 1, '2023-10-01 13:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization`
--

CREATE TABLE `tbl_organization` (
  `organization_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `org_name` varchar(70) DEFAULT NULL,
  `org_desc` varchar(500) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(60) DEFAULT NULL,
  `intent_letter` varchar(255) DEFAULT NULL,
  `request_letter` varchar(255) DEFAULT NULL,
  `form_membership` varchar(255) DEFAULT NULL,
  `CBL` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = pending 1= accepted 2 = reject',
  `remarks_reject` varchar(255) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_organization`
--

INSERT INTO `tbl_organization` (`organization_id`, `user_id`, `org_name`, `org_desc`, `address`, `email`, `number`, `intent_letter`, `request_letter`, `form_membership`, `CBL`, `type`, `isActive`, `status`, `remarks_reject`, `date_inserted`) VALUES
(29, 1, 'BSIT Organization', NULL, 'Purok 6, Barangay 4, San Francisco Agusan del Sur', 'ronaldbesinga287@gmail.com', '090928377123', '90536b8efaa87c602ac48302e967ded0.pdf', NULL, NULL, NULL, 'Student Organization', 1, 1, 'Accredited', '2023-10-01 13:26:27'),
(30, 5, 'BSCRIM Organization', NULL, 'Barangay 4, San Francisco Agusan del Sur', 'ronaldbesinga287@gmail.com', '09090697390', '90536b8efaa87c602ac48302e967ded0.pdf', NULL, NULL, NULL, 'Student Organization', 1, 1, 'Accredited', '2023-10-01 13:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = pending payment 1 = paid 2 = sactioned 3 = sanction Paid',
  `sanction_remarks` varchar(255) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `date_receipt` datetime DEFAULT NULL COMMENT 'last 6 digits is the receipt number',
  `qr_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `event_id`, `student_id`, `fee`, `status`, `sanction_remarks`, `date_inserted`, `date_receipt`, `qr_image`) VALUES
(128, 19, 10, 100, 1, NULL, '2023-10-01 13:54:37', '2023-10-01 13:57:19', '005_file_d22e40276ac0a2e09c745d0e247965dd.png'),
(129, 19, 10, 50, 3, 'Not attending the event', '2023-10-01 13:59:36', '2023-10-01 14:00:39', '005_file_e5a6946aeccac218acdd006c605848c5.png'),
(130, 19, 11, 75, 3, 'afafawdaw', '2023-10-01 14:04:29', '2023-10-01 14:04:41', '005_file_e98002ab38ca88f2ca5e461cc99c5d2b.png'),
(131, 19, 10, 60, 2, 'awdawdawd', '2023-10-01 14:05:42', NULL, NULL),
(132, 18, 8, 50, 0, NULL, '2023-10-11 21:42:53', NULL, NULL),
(133, 18, 12, 50, 1, NULL, '2023-10-11 21:42:53', '2023-10-11 21:43:29', '005_file_97ee025be9736b8a8d6068a5322b4391.png'),
(134, 18, 13, 50, 0, NULL, '2023-10-11 21:42:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `year_level` tinyint(4) NOT NULL COMMENT '1 = 1st Year 2= 2nd Year 3 = 3rd Year 4= 4th Year',
  `email` varchar(70) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`student_id`, `username`, `password`, `fname`, `lname`, `gender`, `year_level`, `email`, `course_id`, `organization_id`, `isActive`) VALUES
(8, '41912071', '1c0cd77850a98a1e29029c8f874dc788', 'Ronald', 'Besinga', 1, 4, 'best.ronald287@gmail.com', NULL, 29, 1),
(10, '41912143', 'cea75d540a0a50626632ae5270d3d820', 'Aldrin', 'Eyana', 1, 4, 'ronaldbesinga287@gmail.com', NULL, 30, 1),
(11, '41122', '56a09a83344113cb847c81a3306809d5', 'Ronald', 'Besinga', 1, 2, 'rbesinga@sfxc.edu.ph', NULL, 30, 1),
(12, '41912712', '498a2531c21c6c18ce12421c1d4c2d05', 'Aldrin', 'Eyana', 1, 4, 'elardinr@gmail.com', NULL, 29, 1),
(13, '4191272', 'd459ef3fb1a7caab62dacc3b1ba032dc', 'haha', 'haha', 1, 2, 'jawhwh@gmail.coim', NULL, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0 =female 1= male',
  `email` varchar(255) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL COMMENT '0 = inactive 1= active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `fname`, `lname`, `gender`, `email`, `user_type_id`, `organization_id`, `isActive`) VALUES
(1, 'admin1', '202cb962ac59075b964b07152d234b70', 'Roanald', 'Alaska', 1, 'ronaldbesinga287@gmail.com', 2, NULL, 1),
(2, 'osa', '202cb962ac59075b964b07152d234b70', 'osa', 'osaka', 1, 'osaka@gmail.com', 1, NULL, 1),
(5, 'admin2', '202cb962ac59075b964b07152d234b70', 'Ronald', 'Besinga', 1, 'ronaldbesinga287@gmail.com', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_types`
--

CREATE TABLE `tbl_user_types` (
  `user_type_id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_types`
--

INSERT INTO `tbl_user_types` (`user_type_id`, `name`) VALUES
(1, 'OSA'),
(2, 'Admin Organization');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
