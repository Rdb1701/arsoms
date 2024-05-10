-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 09, 2024 at 02:03 PM
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
-- Table structure for table `tbl_accomplishment`
--

CREATE TABLE `tbl_accomplishment` (
  `accomplishment_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `accomplishment_file` varchar(500) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accomplishment`
--

INSERT INTO `tbl_accomplishment` (`accomplishment_id`, `organization_id`, `accomplishment_file`, `date_inserted`) VALUES
(24, 29, 'Depth First Search Algorithm.mp4', '2023-10-23 00:16:40'),
(26, 29, '1.jpg', '2023-10-23 01:45:29'),
(28, 31, 'JavaScript Data Structures & Algorithms + LEETCODE Exercises _ Udemy - Google Chrome 2023-10-12 14-19-11.mp4', '2023-10-23 22:35:51'),
(29, 31, 'Crim-1.jpg', '2023-10-23 22:37:31');

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
(1, 'BLOODLETTING!', 29, '<p><span style=\"color: #ff0000;\">Get ready to roll up your sleeves and save lives! We\'re thrilled to announce the upcoming Bloodletting Event at ASSCAT. Join us on August 30,2023 from 8 am at School grounds to make a significant impact on our community\'s health. Your generous donation can make a difference and help those in need. Participate in this life-saving event and experience the joy of giving back. Don\'t miss the chance to show your support and solidarity. Mark your calendars, spread the word, and let\'s make this bloodletting event a resounding success together. Your donation could be the lifeline someone desperately needs. See you there! 💪🩸</span></p>\n<p>&nbsp;</p>', 'f3ccdd27d2000e3f9255a7e3e2c48800.jpg', '2023-08-10 23:09:47'),
(5, '🎓 Save the Date: Graduation Ball - A Night of Elegance and Celebration! 🎉', 29, 'It\'s time to put on your finest attire and celebrate your remarkable journey at ASSCAT\'s highly anticipated Graduation Ball! Join us on October 29 at Amaris for an unforgettable evening of glamour, music, and heartfelt reminiscences. This is your chance to dance the night away and bid farewell to your fellow graduates.\n\nThe Graduation Ball promises to be a night of elegance and joy, where you can create lasting memories with your classmates before embarking on new adventures. Delicious cuisine, enchanting music, and a captivating ambiance await you. Formal attire is a must, so prepare to dazzle in your best outfits.\n\nStay tuned for ticket details and additional information as we approach the date. Get ready to celebrate your achievements in style at the Graduation Ball – a night you won\'t want to miss! 🎉🕺💃', '182845aceb39c9e413e28fd549058cf8.jpeg', '2023-08-19 16:06:23'),
(7, '🏆 Calling All Athletes! 🏆', 29, 'From soccer to basketball, volleyball to track and field, our Intramurals Event will feature a variety of sports to cater to all interests. Gather your teammates, practice those skills, and prepare to give it your all. This event isn\'t just about winning; it\'s about fostering teamwork, sportsmanship, and creating unforgettable memories. Mark your calendars and be part of this exciting celebration of sportsmanship and camaraderie. Stay tuned for more details on schedules and registration. Let\'s make this Intramurals Event at ASSCAT one for the books! 🏅🎉', '156005c5baf40ff51a327f1c34f2975b.jpg', '2023-08-21 21:19:54'),
(9, 'Save the Date: CrimDay 2023 is Just Around the Corner!', 31, 'We\'re thrilled to announce that CrimDay 2023 is fast approaching! Get ready for a day of inspiration, knowledge sharing, and collaboration as we come together to explore the latest trends and advancements in our field.\n\nWhat to Expect:\n\nKeynote Speakers: Renowned experts in the field will provide insights into the latest developments in\n\nInteractive Workshops: Engage in hands-on sessions to deepen your understanding of \nNetworking Opportunities: Connect with peers, share experiences, and build valuable relationships.\n\nPanel Discussions: Join in on thought-provoking conversations about the future of \nExhibition Area: Explore cutting-edge products, services, and technologies shaping the future of our industry.', 'b97aa6ea38576c7f0a29bcab98389811.jpg', '2023-10-23 23:10:15');

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
(18, 29, 'Blood Letting', 25000, NULL, '2023-08-10 00:00:00', '2023-08-12 00:00:00', NULL, 1, '2024-05-09 16:41:08'),
(19, 30, 'Tactical', 10000, NULL, '2023-10-04 00:00:00', '2023-10-07 00:00:00', NULL, 1, '2023-10-01 13:53:53'),
(20, 29, 'DAYDAY', 10000, NULL, '2023-10-25 00:00:00', '2023-10-26 00:00:00', NULL, 1, '2023-10-24 00:10:39'),
(21, 29, 'NIGHTNIGHT', 50000, NULL, '2023-10-26 00:00:00', '2023-10-27 00:00:00', NULL, 1, '2023-10-24 00:48:00'),
(22, 31, 'CRIM DAY', 50000, NULL, '2023-11-23 00:00:00', '2023-11-25 00:00:00', NULL, 1, '2023-11-04 19:05:31');

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
  `logo` varchar(255) DEFAULT NULL,
  `intent_letter` varchar(255) DEFAULT NULL,
  `request_letter` varchar(255) DEFAULT NULL,
  `form_membership` varchar(255) DEFAULT NULL,
  `CBL` varchar(255) DEFAULT NULL,
  `list_activities` varchar(255) DEFAULT NULL,
  `roster` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = pending 1= accepted 2 = reject, 3 = expire 4 = reacredit',
  `remarks_reject` varchar(500) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_organization`
--

INSERT INTO `tbl_organization` (`organization_id`, `user_id`, `org_name`, `org_desc`, `address`, `email`, `number`, `logo`, `intent_letter`, `request_letter`, `form_membership`, `CBL`, `list_activities`, `roster`, `type`, `isActive`, `status`, `remarks_reject`, `date_inserted`) VALUES
(29, 1, 'BSIT Organization', NULL, 'Purok 6, Barangay 4, San Francisco Agusan del Sur', 'ronaldbesinga287@gmail.com', '090928377123', '5195e3d1521a77cb2ce36cfecd17f3f6.png', '90536b8efaa87c602ac48302e967ded0.pdf', NULL, NULL, NULL, '65faea05bbcf15b188f4c87be13999cd.docx', 'a6635efe62dda4b89e3ba99389dae332.docx', 'Student Organization', 1, 3, 'expire', '2023-10-01 13:26:27'),
(31, 10, 'BSCRIM Organization', NULL, 'Alegria, San Francisco Agusan del Sur', 'best.ronald287@gmail.com', '09090697390', '74ceca47901f9dbd89126da625542a14.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'Student Organization', 1, 1, 'Accredited', '2023-10-23 21:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization_officers`
--

CREATE TABLE `tbl_organization_officers` (
  `officer_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_organization_officers`
--

INSERT INTO `tbl_organization_officers` (`officer_id`, `organization_id`, `name`, `role`, `date_inserted`) VALUES
(23, 29, 'Ronald Beesinga', 'President', '2023-10-22 10:48:07'),
(24, 29, 'Ronalds Besingas', 'Vice President', '2023-10-22 10:48:07'),
(25, 31, 'Ronald Besinga', 'President', '2023-10-23 16:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization_profile`
--

CREATE TABLE `tbl_organization_profile` (
  `profile_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `goals` text DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_organization_profile`
--

INSERT INTO `tbl_organization_profile` (`profile_id`, `organization_id`, `description`, `mission`, `vision`, `goals`, `date_inserted`) VALUES
(12, 29, '\"The Sustainable Business and Innovation Trust (SBIT) organization is committed to fostering sustainable business practices and driving innovation to create a better, more environmentally responsible future.\"', '<p>Creating a mission statement depends on the specific goals and values of your organization. To provide a meaningful mission statement, I\'ll need more information about your organization\'s purpose, values, and objectives. Please provide some key details about your organization, and I\'ll be happy to assist you in crafting a mission statement tailored to your needs.</p>\n<ol>\n<li>hahaha</li>\n<li>ahaha</li>\n<li>hahaha</li>\n<li>ahahah</li>\n<li>ahaha</li>\n</ol>', '<p>Creating a mission statement depends on the specific goals and values of your organization. To provide a meaningful mission statement, I\'ll need more information about your organization\'s purpose, values, and objectives. Please provide some key details about your organization, and I\'ll be happy to assist you in crafting a mission statement tailored to your needs.</p>\n<ol>\n<li>hahaha</li>\n<li>ahaha</li>\n<li>hahaha</li>\n<li>ahahah</li>\n<li>ahaha</li>\n</ol>', '<p>Creating a mission statement depends on the specific goals and values of your organization. To provide a meaningful mission statement, I\'ll need more information about your organization\'s purpose, values, and objectives. Please provide some key details about your organization, and I\'ll be happy to assist you in crafting a mission statement tailored to your needs.</p>\n<ol>\n<li>hahaha</li>\n<li>ahaha</li>\n<li>hahaha</li>\n<li>ahahah</li>\n<li>ahaha</li>\n</ol>', '2023-10-22 10:48:07'),
(13, 31, 'Is a dynamic and innovative organization committed to making a positive impact through its dedicated efforts and initiatives. We strive to bring about positive change and progress in various fields, working tirelessly to achieve our mission and vision. Our passion for excellence and dedication to our goals drive us to create a brighter future for all.\"', 'Creating a mission statement depends on the specific goals and values of your organization. To provide a meaningful mission statement, I\'ll need more information about your organization\'s purpose, values, and objectives. Please provide some key details about your organization, and I\'ll be happy to assist you in crafting a mission statement tailored to your needs.', 'Our vision is to be a leading force for positive change, driving innovation, and making a lasting impact in our field. We aspire to inspire, empower, and create a brighter future for our community and the world at large. Through dedication, excellence, and a commitment to our core values, we aim to be at the forefront of progress and a beacon of hope for those we serve.\"', 'Our mission is to be a leading force for positive change, driving innovation, and making a lasting impact in our field. We aspire to inspire, empower, and create a brighter future for our community and the world at large. Through dedication, excellence, and a commitment to our core values, we aim to be at the forefront of progress and a beacon of hope for those we serve.\"', '2023-10-23 16:06:27');

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
  `due_date` varchar(50) NOT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `date_receipt` datetime DEFAULT NULL COMMENT 'last 6 digits is the receipt number',
  `qr_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `event_id`, `student_id`, `fee`, `status`, `sanction_remarks`, `due_date`, `date_inserted`, `date_receipt`, `qr_image`) VALUES
(128, 19, 10, 100, 1, NULL, '', '2023-10-01 13:54:37', '2023-10-01 13:57:19', '005_file_d22e40276ac0a2e09c745d0e247965dd.png'),
(129, 19, 10, 50, 3, 'Not attending the event', '', '2023-10-01 13:59:36', '2023-10-01 14:00:39', '005_file_e5a6946aeccac218acdd006c605848c5.png'),
(130, 19, 11, 75, 3, 'afafawdaw', '', '2023-10-01 14:04:29', '2023-10-01 14:04:41', '005_file_e98002ab38ca88f2ca5e461cc99c5d2b.png'),
(191, 22, 98, 100, 1, 'Tshirt Payment', '', '2023-11-04 19:05:52', '2023-11-04 19:06:22', '005_file_399f52a97f11f8b8ff3216751274cb3d.png'),
(192, 22, 99, 100, 0, 'Tshirt Payment', '', '2023-11-04 19:05:52', NULL, NULL),
(193, 22, 100, 100, 0, 'Tshirt Payment', '', '2023-11-04 19:05:52', NULL, NULL),
(201, 20, 99, 1001, 1, 'no purpose', '', '2023-12-31 02:09:09', '2024-03-02 15:56:56', '005_file_9ba702eca13796616fdfef3ca707767d.png'),
(203, 20, 101, 1001, 1, 'no purpose', '', '2023-12-31 02:09:09', '2023-12-31 02:14:30', '005_file_ee305fd76ad0e5b993909ba3fd0fca19.png'),
(206, 20, 98, 100, 1, '6262', '2024-05-14', '2024-05-08 22:55:42', '2024-05-09 15:48:31', '005_file_6021c2ca4b38aad10c8fd3875e078186.png'),
(210, 20, 102, 100, 1, '6262', '2024-05-14', '2024-05-08 22:55:42', '2024-05-09 15:48:33', '005_file_8a7e1f83bb202d57ce3c410163ecde81.png'),
(223, 21, 98, 12, 2, 'wadwad', '', '2024-05-09 15:38:41', NULL, NULL),
(229, 20, 100, 12, 2, 'awd', '', '2024-05-09 15:42:36', NULL, NULL),
(231, 18, 98, 5000, 0, 'hhahaha', '2024-05-17', '2024-05-09 16:40:42', NULL, NULL),
(232, 18, 99, 5000, 1, 'hhahaha', '2024-05-17', '2024-05-09 16:40:42', '2024-05-09 16:42:41', '005_file_af22a3d4fac81a8ea89e6bf8ac22b34c.png'),
(233, 18, 100, 5000, 0, 'hhahaha', '2024-05-17', '2024-05-09 16:40:42', NULL, NULL),
(234, 18, 101, 5000, 1, 'hhahaha', '2024-05-17', '2024-05-09 16:40:42', '2024-05-09 16:42:35', '005_file_575389aa4f7bed1cac41d9a40c44e358.png'),
(235, 18, 102, 5000, 0, 'hhahaha', '2024-05-17', '2024-05-09 16:40:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports_profile`
--

CREATE TABLE `tbl_reports_profile` (
  `report_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `reports_file` varchar(500) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reports_profile`
--

INSERT INTO `tbl_reports_profile` (`report_id`, `organization_id`, `reports_file`, `date_inserted`) VALUES
(16, 29, 'member.xlsx', '2023-10-22 10:48:07'),
(17, 29, 'Assurance & Security.xls', '2023-10-22 10:48:07'),
(18, 31, 'HPM.docx', '2023-10-23 16:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resolution`
--

CREATE TABLE `tbl_resolution` (
  `resolution_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resolution`
--

INSERT INTO `tbl_resolution` (`resolution_id`, `event_id`, `filename`, `date_inserted`) VALUES
(1, 20, 'Face Paint Sample.docx', '2024-05-09 03:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanction_services`
--

CREATE TABLE `tbl_sanction_services` (
  `service_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `service` varchar(500) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sanction_services`
--

INSERT INTO `tbl_sanction_services` (`service_id`, `event_id`, `student_id`, `service`, `remarks`, `status`, `date_inserted`) VALUES
(1, 18, 98, 'Community Service', 'awdawd', 1, '2024-05-09 11:26:40'),
(3, 18, 99, 'awaw', 'asdawd', 0, '2024-05-09 11:38:29'),
(4, 21, 99, 'wadawd', 'awdawd', 0, '2024-05-09 11:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
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
(98, '41912144', '0d5961ce3c91287ddab1cd72e8525ae8', 'Shane Claire', 'Fernandez', 'Female', 4, 'shane@gmail.com', NULL, 29, 1),
(99, '41912071', '202cb962ac59075b964b07152d234b70', 'Ronald', 'Besinga', 'Male', 4, 'ronaldbesinga287@gmail.com', NULL, NULL, 1),
(100, '41912143', 'cea75d540a0a50626632ae5270d3d820', 'Renato', 'Angulo', 'Male', 4, 'renato@gmail.com', NULL, NULL, 1),
(101, '41912122', '096d2eaa3e0c0f13470aa4a200db1e51', 'King', 'James', 'Male', 4, 'king@gmail.com', NULL, 29, 1),
(102, '2342523', 'df427af84b7e8b06e38c411e9d0af632', 'ss', 'sefsef', 'Male', 4, 'rawr@gmail.com', NULL, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students_exists`
--

CREATE TABLE `tbl_students_exists` (
  `exists_id` int(11) NOT NULL,
  `student_id_number` varchar(30) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students_exists`
--

INSERT INTO `tbl_students_exists` (`exists_id`, `student_id_number`, `organization_id`, `date_inserted`) VALUES
(10, '41912144', 29, '2023-11-04 11:08:34'),
(11, '41912071', 29, '2023-11-04 11:08:34'),
(12, '41912143', 29, '2023-11-04 11:09:28'),
(13, '41912144', 31, '2023-11-04 11:09:55'),
(14, '41912071', 31, '2023-11-04 11:09:55'),
(15, '41912143', 31, '2023-11-04 11:09:55'),
(17, '41912122', 29, '2023-11-04 12:49:22'),
(18, '2342523', 29, '2024-01-26 20:23:31');

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
  `admin_org_id` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL COMMENT '0 = inactive 1= active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `fname`, `lname`, `gender`, `email`, `user_type_id`, `admin_org_id`, `isActive`) VALUES
(1, 'admin1', '202cb962ac59075b964b07152d234b70', 'Roanald', 'Alaska', 1, 'ronaldbesinga287@gmail.com', 2, NULL, 1),
(2, 'osa', '202cb962ac59075b964b07152d234b70', 'osa', 'osaka', 1, 'osaka@gmail.com', 1, NULL, 1),
(9, 'officer1', '202cb962ac59075b964b07152d234b70', 'hahaha', 'hehehe', 0, 'hahaheheh@gmail.com', 3, 1, 1),
(10, 'admin3', '202cb962ac59075b964b07152d234b70', 'Ronald', 'Besinga', 1, 'best.ronald287@gmail.com', 2, NULL, 1),
(11, 'officer2', '5cea39c4f5c604f237baebc9e440ae5f', 'aha', 'HAHA', 0, 'QD@gmail.com', 3, 1, 1);

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
(2, 'Admin Organization'),
(3, 'officer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accomplishment`
--
ALTER TABLE `tbl_accomplishment`
  ADD PRIMARY KEY (`accomplishment_id`);

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
-- Indexes for table `tbl_organization_officers`
--
ALTER TABLE `tbl_organization_officers`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indexes for table `tbl_organization_profile`
--
ALTER TABLE `tbl_organization_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_reports_profile`
--
ALTER TABLE `tbl_reports_profile`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tbl_resolution`
--
ALTER TABLE `tbl_resolution`
  ADD PRIMARY KEY (`resolution_id`);

--
-- Indexes for table `tbl_sanction_services`
--
ALTER TABLE `tbl_sanction_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_students_exists`
--
ALTER TABLE `tbl_students_exists`
  ADD PRIMARY KEY (`exists_id`);

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
-- AUTO_INCREMENT for table `tbl_accomplishment`
--
ALTER TABLE `tbl_accomplishment`
  MODIFY `accomplishment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_organization_officers`
--
ALTER TABLE `tbl_organization_officers`
  MODIFY `officer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_organization_profile`
--
ALTER TABLE `tbl_organization_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `tbl_reports_profile`
--
ALTER TABLE `tbl_reports_profile`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_resolution`
--
ALTER TABLE `tbl_resolution`
  MODIFY `resolution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sanction_services`
--
ALTER TABLE `tbl_sanction_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_students_exists`
--
ALTER TABLE `tbl_students_exists`
  MODIFY `exists_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
