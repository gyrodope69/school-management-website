-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 09:50 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_erp_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `resource` varchar(255) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='announcement information';

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `title`, `descr`, `resource`, `created_on`, `active`) VALUES
(1, 'webinar on internet of things', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. voluptatum ducimus voluptates voluptas?', 'https://docs.emmet.io/abbreviations/lorem-ipsum/', '2022-07-07', 1),
(2, 'talk by director', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. voluptatum ducimus voluptates voluptas?', 'https://docs.emmet.io/abbreviations/lorem-ipsum/', '2022-07-07', 1),
(3, 'yoga day parade at 5 pm', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. voluptatum ducimus voluptates voluptas?', 'https://docs.emmet.io/abbreviations/lorem-ipsum/', '2022-07-07', 1),
(4, 'talk by dr. ramanujan', 'lorem ipsum dolor sit amet consectetur, adipisicing elit. hic, ratione voluptatibus! repellendus aliquam modi incidunt esse placeat deserunt dolorum quae!', 'https://www.ramanujan.com', '2022-07-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  `absent` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='attendance of students as per class and subjects';

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`student_id`, `class_id`, `subject_id`, `present`, `absent`, `total`) VALUES
(1, 1, 1, 3, 2, 5),
(2, 1, 1, 2, 3, 5),
(3, 1, 1, 3, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `standard` varchar(255) NOT NULL,
  `subject_ids` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `total_amount` int(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='subjects in each class';

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `course_id`, `description`, `amount`) VALUES
(43, 1, 'tution', 2000),
(44, 1, 'library', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `mid_term_1` int(11) NOT NULL,
  `mid_term_2` int(11) NOT NULL,
  `end_term` int(11) NOT NULL,
  `other` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`student_id`, `class_id`, `subject_id`, `mid_term_1`, `mid_term_2`, `end_term`, `other`) VALUES
(1, 1, 1, 14, 15, 0, 0),
(2, 1, 1, 16, 20, 0, 0),
(3, 1, 1, 20, 24, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous`
--

CREATE TABLE `miscellaneous` (
  `miscellaneous_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `doj` date NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='details of miscellaneous users';

--
-- Dumping data for table `miscellaneous`
--

INSERT INTO `miscellaneous` (`miscellaneous_id`, `name`, `email`, `password`, `category`, `gender`, `phone`, `address`, `doj`, `active`) VALUES
(1, 'swaraj kumar', 'admin.org@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', NULL, NULL, NULL, '0000-00-00', 1),
(2, 'samvedna gupta', 'accountant.org@gmail.com', '4cd5edcd9aa8e3aed333a5dccda30a3b4a7eeeb7', 'accountant', NULL, NULL, NULL, '0000-00-00', 1),
(3, 'navadeep chaudhary', 'navadeep.org@gmail.com', NULL, 'driver', 'male', '8002046457', 'churu, rajasthan', '2022-07-08', 1),
(5, 'muskan chaudhary', 'muskan.org@gmail.com', NULL, 'driver', 'female', '9923457382', 'bihar', '2022-07-08', 1),
(6, 'ganesh chaudhary', 'ganesh.org@gmail.com', NULL, 'driver', 'other', '9955072347', 'bihar', '2022-07-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `ef_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `start` varchar(255) NOT NULL,
  `finish` varchar(255) NOT NULL,
  `fair` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `start`, `finish`, `fair`, `active`) VALUES
(1, 'campus', 'gokuldham', 30, 1),
(2, 'campus', 'goregaon east chauk', 40, 1),
(3, 'campus', 'marawari gali', 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='student details';

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `password`, `class_id`, `phone`, `gender`, `dob`, `created_at`, `address`, `active`) VALUES
(1, 'amaya chaudhary', 'amaya.org@gmail.com', '570a8eee40de7053bc03b927095e4982e17683fe', 1, '8002046451', 'female', '2022-07-07', '2022-07-07', 'noida', 1),
(2, 'priti chaudhary', 'priti.org@gmail.com', '9333b742e133f2bdf85e0e2726a7d82aaece80f8', 1, '8002046457', 'female', '2022-07-07', '2022-07-07', 'west bengal', 1),
(3, 'shudhanshu chaudhary', 'shudhanshu.org@gmail.com', 'fc4fb9b307256bf883a888ec830d68b389f751e1', 1, '8002046457', 'male', '2022-07-07', '2022-07-07', 'bihar', 1),
(4, 'happy chaudhary', 'happy.org@gmail.com', '3978d009748ef54ad6ef7bf851bd55491b1fe6bb', 2, '8002046457', 'male', '2022-07-07', '2022-07-07', 'bihar', 1),
(5, 'chandan maurya', 'chandan.org@gmail.com', '5b09eece4a5b11d5d0125c0f7eca424d593874ed', 2, '8002046457', 'male', '2022-07-07', '2022-07-07', 'mumbai', 1),
(6, 'rahul chaudhary', 'rahul.org@gmail.com', '8b2357213c6def665b79c46ac43e562ce5e10eef', 2, '8002046457', 'male', '2022-07-07', '2022-07-07', 'west bengal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_ef_list`
--

CREATE TABLE `student_ef_list` (
  `id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `ef_no` varchar(200) NOT NULL,
  `course_id` int(30) NOT NULL,
  `total_fee` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `month` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `credit` int(1) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='subjects information';

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `title`, `descr`, `code`, `credit`, `teacher_id`, `created_on`, `active`) VALUES
(1, 'machine learning', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'ML1', 2, 1, '2022-07-07', 1),
(2, 'cloud computing', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'CC1', 4, 2, '2022-07-07', 1),
(3, 'cryptography and network security', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'CNS1', 4, 3, '2022-07-07', 1),
(4, 'image processing', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'IP1', 4, 4, '2022-07-07', 1),
(5, 'advanced machine learning', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'ML2', 4, 1, '2022-07-07', 1),
(6, 'advanced cryptography and network security', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'CNS2', 4, 3, '2022-07-07', 1),
(7, 'advanced cloud computng', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'CC2', 1, 2, '2022-07-07', 1),
(8, 'advanced image processing', 'lorem ipsum dolor sit amet, consectetur adipisicing elit. eligendi non quis exercitationem culpa nesciunt nihil.', 'IP2', 4, 4, '2022-07-07', 1),
(9, 'cyber security', 'lorem ipsum dolor sit amet consectetur, adipisicing elit. hic, ratione voluptatibus! repellendus aliquam modi incidunt esse placeat deserunt dolorum quae!', 'CS3', 4, 5, '2022-07-08', 1),
(10, 'advanced cyber security', 'lorem ipsum dolor sit amet consectetur, adipisicing elit. hic, ratione voluptatibus! repellendus aliquam modi incidunt esse placeat deserunt dolorum quae!', 'CS4', 2, 5, '2022-07-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `syllabuses`
--

CREATE TABLE `syllabuses` (
  `syllabus_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabuses`
--

INSERT INTO `syllabuses` (`syllabus_id`, `class_id`, `file`, `active`) VALUES
(1, 1, 'standard-one.pdf', 1),
(2, 2, 'standard-two.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `doj` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='teachers details';

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `email`, `password`, `designation`, `phone`, `gender`, `doj`, `address`, `active`) VALUES
(1, 'pratyay kuila', 'pratyay.org@gmail.com', '97026e649d3a629d10dee8cbb592a492d0de9862', 'hod', '8002046411', 'male', '2022-07-07', 'west bengal', 1),
(2, 'anand mishra', 'anand.org@gmail.com', 'b973f774bfeab53233b4f347be114e9ca7b2d00f', 'professor', '8002046457', 'male', '2022-07-07', 'uttar pradesh', 1),
(3, 'sangram ray', 'sangram.org@gmail.com', '162d49ca8e94c2d87fe6d3c74fe4556f332b3cf1', 'professor', '8002046457', 'male', '2022-07-07', 'west bengal', 1),
(4, 'gopa bhaumik', 'gopa.org@gmail.com', 'edf26b399dbd957091aadca3868b1031793a9cd4', 'incoming hod', '8002046457', 'female', '2022-07-07', 'delhi', 0),
(5, 'ranjan basak', 'ranjan.org@gmail.com', '6303bec5a6070e70827a95d15977c407ceb400a8', 'advisor', '8002046457', 'male', '2022-07-08', 'west bengal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `timetable_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`timetable_id`, `class_id`, `file`, `active`) VALUES
(1, 1, 'standard-one.pdf', 1),
(2, 2, 'standard-two.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_type`, `vehicle_number`, `active`) VALUES
(1, 'van', 'UP1231', 1),
(2, 'bus', 'BH1729', 1),
(3, 'bus', 'BH1728', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles_schedule`
--

CREATE TABLE `vehicles_schedule` (
  `schedule_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `arrival` time NOT NULL,
  `departure` time NOT NULL,
  `route_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles_schedule`
--

INSERT INTO `vehicles_schedule` (`schedule_id`, `vehicle_id`, `day`, `arrival`, `departure`, `route_id`, `driver_id`, `active`) VALUES
(1, 1, 'saturday', '10:00:00', '09:30:00', 1, 5, 1),
(2, 1, 'saturday', '15:30:00', '15:00:00', 1, 5, 1),
(3, 2, 'monday', '08:40:00', '08:30:00', 2, 3, 1),
(4, 2, 'monday', '08:43:00', '07:41:00', 2, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  ADD PRIMARY KEY (`miscellaneous_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_ef_list`
--
ALTER TABLE `student_ef_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `syllabuses`
--
ALTER TABLE `syllabuses`
  ADD PRIMARY KEY (`syllabus_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`timetable_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicles_schedule`
--
ALTER TABLE `vehicles_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  MODIFY `miscellaneous_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_ef_list`
--
ALTER TABLE `student_ef_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `syllabuses`
--
ALTER TABLE `syllabuses`
  MODIFY `syllabus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles_schedule`
--
ALTER TABLE `vehicles_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
