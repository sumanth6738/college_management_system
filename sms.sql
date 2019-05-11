-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 07:53 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `no_of_classes` int(11) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `t_id`, `s_id`, `class`, `no_of_classes`, `percentage`) VALUES
(22, 36, 40, 5, 22, 55),
(23, 37, 42, 2, 35, 88),
(24, 38, 45, 6, 35, 88),
(25, 38, 46, 6, 36, 90);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookid` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `srn` int(11) NOT NULL,
  `college` varchar(30) NOT NULL,
  `id` int(15) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `phone_no` bigint(11) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `cost` varchar(11) NOT NULL,
  `payment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventad`
--

CREATE TABLE `eventad` (
  `name` varchar(30) NOT NULL,
  `id` int(15) NOT NULL,
  `event1` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `department` varchar(30) NOT NULL,
  `venue` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `day` int(5) NOT NULL,
  `cost` int(5) NOT NULL,
  `par` int(11) NOT NULL,
  `expiry` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventad`
--

INSERT INTO `eventad` (`name`, `id`, `event1`, `description`, `department`, `venue`, `date`, `day`, `cost`, `par`, `expiry`) VALUES
('Ruby on Rails', 132, 'Workshop', 'RailsBridge workshops are a free and fun way to get started or level up with Rails, Ruby, and other web technologies. Our events focus on increasing diversity in tech, so that people of all backgrounds can feel welcome and comfortable in our industry.', 'BCA', 'MCA Seminar hall', '2017-04-20', 1, 150, 100, '2017/04/21'),
('web app', 133, 'Conference', 'defefefefkjkh ,jnkjhkfj ,khkf ', 'MBA', 'MCA Seminar hall', '2018-04-21', 1, 600, 29, '2018/04/24'),
('andriod ', 134, 'Workshop', 'hgkjdagkchdjk jbjhhjkhn.jkda', 'MCA', 'class room', '2018-04-27', 1, 300, 60, '2018/04/26');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `mark_id` int(11) NOT NULL,
  `T_id` int(11) NOT NULL,
  `S_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `maths` int(3) NOT NULL,
  `science` int(3) NOT NULL,
  `english` int(3) NOT NULL,
  `social` int(3) NOT NULL,
  `physical` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`mark_id`, `T_id`, `S_id`, `class`, `marks`, `grade`, `maths`, `science`, `english`, `social`, `physical`) VALUES
(27, 36, 40, 5, 264, 'C', 60, 56, 22, 56, 70),
(28, 37, 42, 2, 315, 'B', 60, 50, 70, 45, 90),
(29, 38, 45, 6, 354, 'B', 60, 84, 90, 60, 60);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `PID` int(11) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `parent_password` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `student_dob` date NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_father` varchar(255) NOT NULL,
  `student_mother` varchar(255) NOT NULL,
  `student_gaurdian` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `student_ph_no` bigint(10) NOT NULL,
  `user_role` varchar(10) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `username`, `class`, `student_dob`, `student_address`, `student_father`, `student_mother`, `student_gaurdian`, `student_email`, `student_password`, `student_ph_no`, `user_role`) VALUES
(40, 'Sumanth', 5, '1996-11-18', 'bangalore', 'ABCD', 'XYZ', '', 'Sumi@gmail.com', '$2y$11$PfGVB5uWucyQpD6KqqXgL.G1f4kAeNLGNMZhoJ6AomaoEZTCuofP2', 8123420187, 'student'),
(41, 'Shreyas', 5, '1995-12-26', 'Thyagarajnagar', 'Narayan', 'Leela', '', 'shreyasnarayan5@gmail.com', '$2y$11$KEPBCmRErXDVKlXE4CW5g.MFL8ahMy46DiuZ8lKar8EyY2EAoF.JO', 9741493253, 'student'),
(43, 'NAVEEN', 2, '2023-04-18', 'bangalore', 'abc', 'xyz', '', 'naveen@gmail.com', '', 7795444213, 'student'),
(45, 'sumi', 6, '1999-11-18', 'bangalore', 'abc', 'xyz', '', 'sumi6738d@gmail.com', '$2y$11$VijJ8u2ILJCLETJJFTuN..nR0OMDtMbktBgSot1ZTQLhRaXchAoga', 8123420196, 'student'),
(46, 'vybhav', 6, '1993-06-11', 'bangalore', 'abc', 'xyz', '', 'vybhav1@gmail.com', '$2y$11$Rpv84RCrfDjuytv3kPvRlewuyX8Yh9DORS.qzB/L6EyhQWtdB58AG', 8123420188, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `teacher_dob` date NOT NULL,
  `teacher_phno` bigint(14) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `teacher_password` varchar(255) NOT NULL,
  `user_role` varchar(11) NOT NULL DEFAULT 'teacher',
  `designation` varchar(255) NOT NULL,
  `specialized_subject` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `username`, `class`, `teacher_dob`, `teacher_phno`, `teacher_email`, `teacher_password`, `user_role`, `designation`, `specialized_subject`) VALUES
(36, 'Rahul', 5, '2013-06-05', 8123420187, 'Rahul@gmail.com', '$2y$11$a5HPAl0EKkQH4qSgxtg9h.xAYA.wdyQtHS3ZJjCpQ8eZC3Z8skySe', 'teacher', 'MCA', 'Maths'),
(37, 'sumanth', 2, '2014-06-11', 9449067244, 'sumi6738@gmail.com', '$2y$11$DTk6.xn6PzQUOjQWnTEOh.DC1WyvJgN01H89cZ2kQl1MOaQeChUeK', 'teacher', 'bsc', 'cs'),
(38, 'shreyas', 6, '2014-06-12', 9449435351, 'shreyasn1@gmail.com', '$2y$11$3C7f5Yvlt6EWByzkDgLgpOtDf.6ojjB9syGBUdjICucP78RaxIOdu', 'teacher', 'BSC', 'science'),
(39, 'suraj', 3, '2016-03-12', 8123420123, 'suraj1@gmail.com', '$2y$11$fHjI5adCBFh/IXcF/xS8w.yPgUxCdQ.Jg931FOrutyzsKqPgnHcKC', 'teacher', 'BSC', 'science');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings27'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(7, 'Singam', 'bbkjbj', 'asuduusaii', 'oouksdho', 'hhhjhwd@123', '', 'subscriber', ''),
(10, 'Dirk', '$2y$12$EMonD3HB3doi0DYK3qhBceHqTSR/bHf8MceS0ptG8mxb9PCYM.IVa', 'Warde', 'R', 'ted@gmail.com', '', 'subscriber', ''),
(12, 'DADA', '$2y$12$.oHTqBjNEIBnCeRGomEQMebnVJLol2vVL5GRF0pdfHxudWWwOwTXS', 'Faddoos', 'Suusiee', 'Dann@321', '', 'subscriber', ''),
(13, 'Danny', '321', 'Dhanush', 'Sunku', 'dan@gmail.com', '', 'admin', ''),
(20, 'DODO', '$2y$12$uQOwnfDvOvUukjUOFF502.9Xgzx94/HR4DdXL9GMe3I65OoiZc.Lm', 'Dart', 'zxc', 'dodo@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystring27'),
(24, 'Remos', '$2y$12$PR7O9qqTsaEy1UNVEttEbu2j6TM8yQmRT8cmCxUxfc3H1hqbt7qLe', 'Remo', 'Nino', 'remos@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings27'),
(25, 'Loki', '$2y$12$uXskOsnBiv9RH1fgPpdmt.aqNi5MpwALTjyKXqkTje5wNZhRZPX4W', 'Rakesh', 'L', 'loki@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings27'),
(29, 'Dargo', '$2y$12$3YPHcNBgUENtdY8WbSMosuz0fzyWXaq.rRy4RI9tuIdty7J7l.IzS', 'Dhanush', 'ss', 'bludvist@22', '', 'student', '$2y$10$iusesomecrazystrings27'),
(46, 'DhanushSunku', '$2y$12$F7dL1VYAIgimlzKIHEI4oelf.Tj8FRQWYSeu2UI8YpKozKrca1vcq', '', '', 'dhanushsunku27@gmail.com', '', 'parent', '$2y$10$iusesomecrazystrings27'),
(47, 'Rakesh', '$2y$12$sNxOgoVtjtsdiaSmyD2TeuUdw0TaRrC4oSQHm6ePVZYS9igu/222O', 'Raki', 'R ', 'rakesh@gmail.com', '', 'parent', '$2y$10$iusesomecrazystrings27'),
(49, 'ganeshkrishna', '$2y$11$RKstimj7jjEWanZ6zBIPneSFwOBEahsawBEtqdVyx/yiwOIv2bwsS', '', '', 'ganeshkrishna31@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings27'),
(51, 'dany', '$2y$11$OLx.Wif3Q/HQlVKC.7C2juawsSXzfkWJS0/H3ou8brdomLq2TqRaK', '', '', 'dany@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventad`
--
ALTER TABLE `eventad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_email` (`student_email`),
  ADD UNIQUE KEY `student_ph_no` (`student_ph_no`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_password` (`teacher_password`),
  ADD UNIQUE KEY `teacher_email` (`teacher_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `eventad`
--
ALTER TABLE `eventad`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
