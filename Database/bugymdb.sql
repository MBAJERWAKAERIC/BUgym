-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 04:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mayuri_fitness`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertData` (IN `in_username` VARCHAR(40), IN `in_gender` VARCHAR(8), IN `in_mobile` VARCHAR(20), IN `in_email` VARCHAR(20), IN `in_dob` VARCHAR(10), IN `in_joining_date` VARCHAR(10), IN `in_userid` VARCHAR(20))  BEGIN
INSERT INTO users(username, gender, mobile, email, dob, joining_date, userid) VALUES(in_username,in_gender,in_mobile,in_email,in_dob,in_joining_date,in_userid);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` varchar(20) NOT NULL,
  `streetName` varchar(40) NOT NULL,
  `state` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `zipcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `contact` text NOT NULL,
  `address` varchar(500) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `fname`, `lname`, `gender`, `dob`, `contact`, `address`, `image`, `created_on`, `group_id`) VALUES
(1, 'mayurik', 'mayuri.infospace@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Mayuri', 'K', 'Female', '1992-05-28', '+919090909090', 'Nashik', 'young-woman-avatar-facial-features-stylish-userpic-flat-cartoon-design-elegant-lady-blue-jacket-close-up-portrait-80474088.jpg', '2018-04-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrolls_to`
--

CREATE TABLE `enrolls_to` (
  `et_id` int(5) NOT NULL,
  `pid` varchar(8) NOT NULL,
  `uid` varchar(20) NOT NULL,
  `paid_date` varchar(15) DEFAULT NULL,
  `expire` varchar(15) DEFAULT NULL,
  `renewal` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `health_status`
--

CREATE TABLE `health_status` (
  `hid` int(5) NOT NULL,
  `calorie` varchar(8) DEFAULT NULL,
  `height` varchar(8) DEFAULT NULL,
  `weight` varchar(8) DEFAULT NULL,
  `fat` varchar(8) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `uid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `action` varchar(40) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `userid`, `action`, `date`) VALUES
(1, '1529336794', 'User Deleted Succesfully', '2021-07-07 16:10:18'),
(2, '1572760056', 'User Deleted Succesfully', '2021-07-07 16:10:18'),
(3, '1622822786', 'User Deleted Succesfully', '2021-07-07 16:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `short_title` varchar(600) NOT NULL,
  `logo` text NOT NULL,
  `footer` text NOT NULL,
  `currency_code` varchar(600) NOT NULL,
  `currency_symbol` varchar(600) NOT NULL,
  `login_logo` text NOT NULL,
  `invoice_logo` text NOT NULL,
  `background_login_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`id`, `title`, `short_title`, `logo`, `footer`, `currency_code`, `currency_symbol`, `login_logo`, `invoice_logo`, `background_login_image`) VALUES
(1, 'Crunch Fitness GMS - Mayuri K.', 'Crunch Fitness', 'admin mayuri Logo.jpg', 'Mayuri K. - Freelancer', 'INR', 'â‚¹', 'admin mayuri Logo.jpg', 'admin mayuri Logo.jpg', 'MfnlsE1r5E.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `pid` varchar(8) NOT NULL,
  `planName` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `validity` varchar(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `active` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `e_id` int(21) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mail_driver_host` varchar(5000) NOT NULL,
  `mail_port` int(50) NOT NULL,
  `mail_username` varchar(50) NOT NULL,
  `mail_password` varchar(30) NOT NULL,
  `mail_encrypt` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_email_config`
--

INSERT INTO `tbl_email_config` (`e_id`, `name`, `mail_driver_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encrypt`) VALUES
(1, 'Sender Name will be here', 'mail.gmail.com', 587, 'ndbahlerao91@gmail.com', '123654123', 'tls');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `tid` int(12) NOT NULL,
  `tname` varchar(45) DEFAULT NULL,
  `day1` varchar(200) DEFAULT NULL,
  `day2` varchar(200) DEFAULT NULL,
  `day3` varchar(200) DEFAULT NULL,
  `day4` varchar(200) DEFAULT NULL,
  `day5` varchar(200) DEFAULT NULL,
  `day6` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`tid`, `tname`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`) VALUES
(2, 'Workout', 'Flat bench barbell press - 4 sets of 8-12 reps\r\nIncline dumbell press - 4 sets of 8-12 reps\r\nIncline dumbell flyers - 3 set of 10 reps\r\nCable crossovers - 3 sets of 15 reps\r\nPush-ups - 4sets', 'Flat bench barbell press - 4 sets of 8-12 reps\r\nIncline dumbell press - 4 sets of 8-12 reps\r\nIncline dumbell flyers - 3 set of 10 reps\r\nCable crossovers - 3 sets of 15 reps\r\nPush-ups - 4sets', 'Barbell squats - 4 sets of 8-10 reps\r\nHeck squats - 4 sets of 10 reps\r\nLeg press machine -3 sets of 10 reps', 'Chin-ups - 4 sets of 10 reps\r\nWide grip lat pull-downs - 4 sets of 12 reps\r\nClose grip lat pull downs - 4 set of 12 reps\r\nDumbbell rows - 4 sets of 8-10 reps', 'Double arm dumbbell curls - 4 sets of 10-12 reps\r\nEZ bar curls - 4 sets of 10-12 reps\r\nPreacher curl machine - 4 sets of 12 reps\r\nTriceps rope machine - 4 sets of 15 reps', '60 minute of steady state cardio..');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `joining_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `deleteUser` BEFORE DELETE ON `users` FOR EACH ROW INSERT INTO logs VALUES(null, OLD.userid, "User Deleted Succesfully", NOW() )
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertUser` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.userid, "Data Inserted Succesfully", NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateUser` AFTER UPDATE ON `users` FOR EACH ROW INSERT INTO logs VALUES(null, NEW.userid, "Data Updated Succesfully", NOW() )
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD KEY `userID` (`id`) USING BTREE;

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolls_to`
--
ALTER TABLE `enrolls_to`
  ADD PRIMARY KEY (`et_id`) USING BTREE,
  ADD KEY `user_ID` (`uid`) USING BTREE,
  ADD KEY `plan_ID_idx` (`pid`) USING BTREE;

--
-- Indexes for table `health_status`
--
ALTER TABLE `health_status`
  ADD PRIMARY KEY (`hid`) USING BTREE,
  ADD KEY `userID_idx` (`uid`) USING BTREE;

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_website`
--
ALTER TABLE `manage_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`pid`) USING BTREE,
  ADD KEY `pid` (`pid`) USING BTREE;

--
-- Indexes for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`tid`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `userid` (`userid`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrolls_to`
--
ALTER TABLE `enrolls_to`
  MODIFY `et_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_status`
--
ALTER TABLE `health_status`
  MODIFY `hid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `e_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `tid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `userID` FOREIGN KEY (`id`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `enrolls_to`
--
ALTER TABLE `enrolls_to`
  ADD CONSTRAINT `plan_ID` FOREIGN KEY (`pid`) REFERENCES `plan` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ID` FOREIGN KEY (`uid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `health_status`
--
ALTER TABLE `health_status`
  ADD CONSTRAINT `uID` FOREIGN KEY (`uid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
