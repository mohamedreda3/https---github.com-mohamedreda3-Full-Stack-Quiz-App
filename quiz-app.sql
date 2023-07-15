-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 06:53 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`) VALUES
(1, 'mmoh33650@gmail.com', '01212745939', 'Mohammed Reda');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer1` varchar(30) NOT NULL,
  `answer2` varchar(30) NOT NULL,
  `answer3` varchar(30) NOT NULL,
  `answer4` varchar(30) NOT NULL,
  `answer5` varchar(30) NOT NULL,
  `answer6` varchar(30) NOT NULL,
  `questionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `completed_quiz`
--

CREATE TABLE `completed_quiz` (
  `quizid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `quizdegree` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question` text NOT NULL,
  `correctanswer` varchar(30) NOT NULL,
  `questionid` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `answers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question`, `correctanswer`, `questionid`, `quizid`, `answers`) VALUES
('asdasd?', 'sad', 21, 15, 'a:2:{i:0;s:3:\"sad\";i:1;s:3:\"sad\";}'),
('asdasd?', 'sad', 22, 15, 'a:2:{i:0;s:3:\"sad\";i:1;s:3:\"sad\";}'),
('axsa', 'asxa', 23, 15, 'a:3:{i:0;s:4:\"asxa\";i:1;s:5:\"asxaa\";i:2;s:8:\"asdasxaa\";}');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quizName` varchar(30) NOT NULL,
  `subjectId` int(11) NOT NULL,
  `quizId` int(11) NOT NULL,
  `degree` float NOT NULL,
  `quiztime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quizName`, `subjectId`, `quizId`, `degree`, `quiztime`) VALUES
('quiz1', 10, 14, 40, 5),
('Quiz5', 9, 15, 30, 10);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `email`, `password`, `phonenumber`, `address`, `username`, `gender`) VALUES
(1, 'mmoh33650@gmail.com', '01212745939', '01275821135', '1st giza', 'Mohamed Reda', 'Male'),
(5, 'mmoh33652@gmail.com', 'admin', '01275821135', 'Cairo', 'Mohamed Yousef', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `studentteacherpanel`
--

CREATE TABLE `studentteacherpanel` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `teacheremail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentteacherpanel`
--

INSERT INTO `studentteacherpanel` (`id`, `email`, `password`, `phonenumber`, `address`, `username`, `gender`, `teacheremail`) VALUES
(6, 'mmoh33652@gmail.com', 'admin', '213123', 'Cairo', 'ewre', 'Male', 'mmoh33651@gmail.com'),
(7, 'mmoh33650@gmail.com', 'admin', '01212745939', 'dfa', 'Mohamed Reda', 'Male', 'mmoh33650@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectName` varchar(30) NOT NULL,
  `subjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectName`, `subjectId`) VALUES
('ADV. OS', 9),
('Math3', 11),
('Software Engineering', 10);

-- --------------------------------------------------------

--
-- Table structure for table `subject_student`
--

CREATE TABLE `subject_student` (
  `subjectid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_student`
--

INSERT INTO `subject_student` (`subjectid`, `email`) VALUES
(9, 'mmoh33652@gmail.com'),
(10, 'mmoh33650@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teacher`
--

CREATE TABLE `subject_teacher` (
  `subjectid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_teacher`
--

INSERT INTO `subject_teacher` (`subjectid`, `email`) VALUES
(9, 'mmoh33651@gmail.com'),
(10, 'mmoh33650@gmail.com'),
(11, 'mmoh33651@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `email`, `password`, `username`, `phonenumber`, `address`, `gender`) VALUES
(1, 'mmoh33650@gmail.com', '01212745939', 'Mohamed Reda', '01212745939', '1st giza', 'Male'),
(3, 'mmoh33651@gmail.com', 'admin', 'Mohamed Youssry', '01212745939', 'GIza', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD KEY `aswers_question_pk` (`questionId`);

--
-- Indexes for table `completed_quiz`
--
ALTER TABLE `completed_quiz`
  ADD PRIMARY KEY (`quizid`,`email`),
  ADD KEY `student_id_pk` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionid`),
  ADD KEY `quizz_question_pk` (`quizid`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quizId`),
  ADD UNIQUE KEY `quizName` (`quizName`,`subjectId`),
  ADD KEY `quiz-subject-pk` (`subjectId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `studentteacherpanel`
--
ALTER TABLE `studentteacherpanel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_stu_tech` (`teacheremail`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectId`),
  ADD UNIQUE KEY `subjectName` (`subjectName`);

--
-- Indexes for table `subject_student`
--
ALTER TABLE `subject_student`
  ADD PRIMARY KEY (`subjectid`,`email`),
  ADD KEY `student_email_pk` (`email`);

--
-- Indexes for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD PRIMARY KEY (`subjectid`,`email`),
  ADD KEY `techer_email_pk` (`email`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quizId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studentteacherpanel`
--
ALTER TABLE `studentteacherpanel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `aswers_question_pk` FOREIGN KEY (`questionId`) REFERENCES `questions` (`questionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `completed_quiz`
--
ALTER TABLE `completed_quiz`
  ADD CONSTRAINT `quiz_id_pk` FOREIGN KEY (`quizid`) REFERENCES `quizzes` (`quizId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id_pk` FOREIGN KEY (`email`) REFERENCES `students` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `quizz_question_pk` FOREIGN KEY (`quizid`) REFERENCES `quizzes` (`quizId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quiz-subject-pk` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentteacherpanel`
--
ALTER TABLE `studentteacherpanel`
  ADD CONSTRAINT `email_stu_tech` FOREIGN KEY (`teacheremail`) REFERENCES `teachers` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_student`
--
ALTER TABLE `subject_student`
  ADD CONSTRAINT `student_email_pk` FOREIGN KEY (`email`) REFERENCES `students` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subject_pk` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD CONSTRAINT `subject_id_pk` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `techer_email_pk` FOREIGN KEY (`email`) REFERENCES `teachers` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
