-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 05:24 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `ad_id` int(11) NOT NULL,
  `ad_username` varchar(100) NOT NULL,
  `ad_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`ad_id`, `ad_username`, `ad_password`) VALUES
(1, 'admin@hostel.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `at_id` int(11) NOT NULL,
  `ha_id` int(11) NOT NULL,
  `at_date` date NOT NULL,
  `at_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`at_id`, `ha_id`, `at_date`, `at_status`) VALUES
(1, 1, '2020-12-21', 'present'),
(2, 2, '2020-12-21', 'absent'),
(3, 1, '2020-12-27', 'absent'),
(4, 2, '2020-12-27', 'absent'),
(5, 1, '2020-12-23', 'absent'),
(6, 2, '2020-12-23', 'absent'),
(15, 1, '2021-01-09', 'present'),
(16, 3, '2021-01-09', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `ho_id` int(11) NOT NULL,
  `ho_name` varchar(75) NOT NULL,
  `ho_institution` varchar(75) NOT NULL,
  `ho_address` text,
  `ho_mobilenumber` varchar(12) NOT NULL,
  `ho_landline` varchar(12) NOT NULL,
  `ho_emailid` varchar(75) NOT NULL,
  `ho_verificationstatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`ho_id`, `ho_name`, `ho_institution`, `ho_address`, `ho_mobilenumber`, `ho_landline`, `ho_emailid`, `ho_verificationstatus`) VALUES
(1, 'Jyothi Mens Hostel', 'Jyothi Engineering College', 'Cheuthiruthi PO, Thrissur', '9747057905', '', 'jyothi@hostelapp.com', 'verificationsuccess'),
(2, 'Jazz Solutions', 'Jazz Solutions', 'Poothole', '9747057905', '0487 2632215', 'jazz@gmail.com', 'verificationsuccess');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_admission_register`
--

CREATE TABLE `hostel_admission_register` (
  `ha_id` int(11) NOT NULL,
  `ho_id` int(11) NOT NULL,
  `rb_id` int(11) NOT NULL,
  `ha_name` varchar(75) NOT NULL,
  `ha_dob` date NOT NULL,
  `ha_gender` varchar(10) NOT NULL,
  `ha_admissionnumber` varchar(20) NOT NULL,
  `ha_emailid` varchar(75) NOT NULL,
  `ha_mobilenumber` varchar(12) NOT NULL,
  `ha_guardian` varchar(75) NOT NULL,
  `ha_guardianrelation` varchar(25) NOT NULL,
  `ha_giardianemailid` varchar(75) NOT NULL,
  `ha_guardianmobilenumber` varchar(12) NOT NULL,
  `ha_permenanetaddress` text,
  `ha_temeroryaddress` text,
  `ha_admissiondate` date DEFAULT NULL,
  `ha_vacatedate` date DEFAULT NULL,
  `ha_status` varchar(15) NOT NULL,
  `ha_notes` text,
  `ha_outreason` text,
  `ha_image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_admission_register`
--

INSERT INTO `hostel_admission_register` (`ha_id`, `ho_id`, `rb_id`, `ha_name`, `ha_dob`, `ha_gender`, `ha_admissionnumber`, `ha_emailid`, `ha_mobilenumber`, `ha_guardian`, `ha_guardianrelation`, `ha_giardianemailid`, `ha_guardianmobilenumber`, `ha_permenanetaddress`, `ha_temeroryaddress`, `ha_admissiondate`, `ha_vacatedate`, `ha_status`, `ha_notes`, `ha_outreason`, `ha_image`) VALUES
(1, 1, 4, 'Rajasekar Pottekkat', '1986-05-24', 'male', '12345', '229rajeev@gmail.com', '9747057905', 'Mahadevab', 'Father', 'mahadevan@gmail.com', '995885561', 'permenent address', 'temperory address', '2020-10-10', NULL, 'in', 'good character', '', NULL),
(2, 1, 2, 'Melvin E Assisi', '1987-05-24', 'male', '12432', '229rajeev@gmail.com', '9747057902', 'Assisi  E O', 'Father', 'assisi@gmail.com', '995885571', 'a', 'b', '2020-10-10', '2021-01-09', 'vacate', 'eetet', NULL, 'WhatsApp Image 2020-08-22 at 3.18.04 PM.jpeg'),
(3, 1, 5, 'Sanjeev Gunarathnam', '1995-01-01', 'Male', '123456', 'sanju@gmail.com', '9956612341', 'Gunarathnam', 'Father', 'gunarthnam@gmail.com', '1234', 'permenent address', 'temperory address', '2021-01-09', NULL, 'in', 'good', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hostel_alerts`
--

CREATE TABLE `hostel_alerts` (
  `al_id` int(11) NOT NULL,
  `ho_id` int(11) NOT NULL,
  `al_type` varchar(25) NOT NULL,
  `al_date` datetime NOT NULL,
  `al_message` text,
  `al_recivertype` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_alerts`
--

INSERT INTO `hostel_alerts` (`al_id`, `ho_id`, `al_type`, `al_date`, `al_message`, `al_recivertype`) VALUES
(1, 1, 'Prayer Time', '2020-10-30 15:58:02', 'message', 'Student'),
(2, 1, 'Prayer Time', '2020-10-30 16:11:00', 'message', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_bill_calculator`
--

CREATE TABLE `hostel_bill_calculator` (
  `hb_id` int(11) NOT NULL,
  `ho_id` int(11) NOT NULL,
  `hb_month` date DEFAULT NULL,
  `hb_perdaymessfees` decimal(18,2) DEFAULT NULL,
  `hb_totalstudents` int(11) DEFAULT NULL,
  `hb_totalmessfees` decimal(18,2) DEFAULT NULL,
  `hb_totalrent` decimal(18,2) DEFAULT NULL,
  `hb_totalcollection` decimal(18,2) DEFAULT NULL,
  `hb_duedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_bill_calculator`
--

INSERT INTO `hostel_bill_calculator` (`hb_id`, `ho_id`, `hb_month`, `hb_perdaymessfees`, `hb_totalstudents`, `hb_totalmessfees`, `hb_totalrent`, `hb_totalcollection`, `hb_duedate`) VALUES
(7, 1, '2020-12-01', '65.00', 2, '0.00', '2400.00', '2400.00', '2021-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_bil_details`
--

CREATE TABLE `hostel_bil_details` (
  `hd_id` int(11) NOT NULL,
  `hb_id` int(11) NOT NULL,
  `ha_id` int(11) NOT NULL,
  `hd_totalattendance` int(11) DEFAULT NULL,
  `hd_totalmessfees` decimal(18,2) DEFAULT NULL,
  `hd_roomrent` decimal(18,2) DEFAULT NULL,
  `hd_totalfees` decimal(18,2) DEFAULT NULL,
  `hd_paymentdate` date DEFAULT NULL,
  `hd_paymentmethod` varchar(12) DEFAULT NULL,
  `hd_status` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_bil_details`
--

INSERT INTO `hostel_bil_details` (`hd_id`, `hb_id`, `ha_id`, `hd_totalattendance`, `hd_totalmessfees`, `hd_roomrent`, `hd_totalfees`, `hd_paymentdate`, `hd_paymentmethod`, `hd_status`) VALUES
(11, 7, 1, 0, '0.00', '1200.00', '1200.00', '2021-01-04', 'online', 'paid'),
(12, 7, 2, 0, '0.00', '1200.00', '1200.00', NULL, NULL, 'not paid');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_feedbacks`
--

CREATE TABLE `hostel_feedbacks` (
  `hf_id` int(11) NOT NULL,
  `ha_id` int(11) NOT NULL,
  `hf_messageby` varchar(10) NOT NULL,
  `hf_title` text NOT NULL,
  `hf_message` text NOT NULL,
  `hf_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_feedbacks`
--

INSERT INTO `hostel_feedbacks` (`hf_id`, `ha_id`, `hf_messageby`, `hf_title`, `hf_message`, `hf_date`) VALUES
(1, 1, 'parent', 'title', 'message', '2020-12-06'),
(2, 2, 'student', 'title', 'message', '2020-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_rooms`
--

CREATE TABLE `hostel_rooms` (
  `hr_id` int(11) NOT NULL,
  `ho_id` int(11) NOT NULL,
  `hr_roomnumber` varchar(25) NOT NULL,
  `hr_totalaccomadation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_rooms`
--

INSERT INTO `hostel_rooms` (`hr_id`, `ho_id`, `hr_roomnumber`, `hr_totalaccomadation`) VALUES
(1, 1, '229', 2),
(2, 1, '228', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `lg_id` int(11) NOT NULL,
  `lg_type` varchar(20) NOT NULL,
  `lg_refferalid` int(11) NOT NULL,
  `lg_emailid` varchar(75) NOT NULL,
  `lg_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`lg_id`, `lg_type`, `lg_refferalid`, `lg_emailid`, `lg_password`) VALUES
(1, 'hostel', 1, 'jyothi@hostelapp.com', '12345'),
(2, 'parent', 1, 'mahadevan@gmail.com', '12345'),
(3, 'hostel', 2, 'jazz@gmail.com', '12345'),
(4, 'student', 3, 'sanju@gmail.com', '0v86ot'),
(5, 'parent', 3, 'gunarthnam@gmail.com', 'ypj8m5');

-- --------------------------------------------------------

--
-- Table structure for table `room_beds`
--

CREATE TABLE `room_beds` (
  `rb_id` int(11) NOT NULL,
  `ho_id` int(11) NOT NULL,
  `hr_id` int(11) NOT NULL,
  `rb_number` varchar(25) NOT NULL,
  `ha_id` int(11) NOT NULL,
  `rb_rent` decimal(18,2) NOT NULL,
  `rb_status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_beds`
--

INSERT INTO `room_beds` (`rb_id`, `ho_id`, `hr_id`, `rb_number`, `ha_id`, `rb_rent`, `rb_status`) VALUES
(2, 1, 1, '229/001', 2, '1200.00', 'close'),
(4, 1, 1, '229/002', 1, '1200.00', 'close'),
(5, 1, 2, '100', 3, '2000.00', 'close');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`at_id`),
  ADD KEY `ha_id` (`ha_id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`ho_id`);

--
-- Indexes for table `hostel_admission_register`
--
ALTER TABLE `hostel_admission_register`
  ADD PRIMARY KEY (`ha_id`),
  ADD KEY `ho_id` (`ho_id`),
  ADD KEY `rb_id` (`rb_id`);

--
-- Indexes for table `hostel_alerts`
--
ALTER TABLE `hostel_alerts`
  ADD PRIMARY KEY (`al_id`),
  ADD KEY `ho_id` (`ho_id`);

--
-- Indexes for table `hostel_bill_calculator`
--
ALTER TABLE `hostel_bill_calculator`
  ADD PRIMARY KEY (`hb_id`),
  ADD KEY `ho_id` (`ho_id`);

--
-- Indexes for table `hostel_bil_details`
--
ALTER TABLE `hostel_bil_details`
  ADD PRIMARY KEY (`hd_id`);

--
-- Indexes for table `hostel_feedbacks`
--
ALTER TABLE `hostel_feedbacks`
  ADD PRIMARY KEY (`hf_id`),
  ADD KEY `ha_id` (`ha_id`);

--
-- Indexes for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  ADD PRIMARY KEY (`hr_id`),
  ADD KEY `ho_id` (`ho_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`lg_id`);

--
-- Indexes for table `room_beds`
--
ALTER TABLE `room_beds`
  ADD PRIMARY KEY (`rb_id`),
  ADD KEY `ho_id` (`ho_id`),
  ADD KEY `hr_id` (`hr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `ho_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hostel_admission_register`
--
ALTER TABLE `hostel_admission_register`
  MODIFY `ha_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hostel_alerts`
--
ALTER TABLE `hostel_alerts`
  MODIFY `al_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hostel_bill_calculator`
--
ALTER TABLE `hostel_bill_calculator`
  MODIFY `hb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hostel_bil_details`
--
ALTER TABLE `hostel_bil_details`
  MODIFY `hd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hostel_feedbacks`
--
ALTER TABLE `hostel_feedbacks`
  MODIFY `hf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `lg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_beds`
--
ALTER TABLE `room_beds`
  MODIFY `rb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`ha_id`) REFERENCES `hostel_admission_register` (`ha_id`);

--
-- Constraints for table `hostel_admission_register`
--
ALTER TABLE `hostel_admission_register`
  ADD CONSTRAINT `hostel_admission_register_ibfk_1` FOREIGN KEY (`ho_id`) REFERENCES `hostels` (`ho_id`),
  ADD CONSTRAINT `hostel_admission_register_ibfk_2` FOREIGN KEY (`rb_id`) REFERENCES `room_beds` (`rb_id`);

--
-- Constraints for table `hostel_alerts`
--
ALTER TABLE `hostel_alerts`
  ADD CONSTRAINT `hostel_alerts_ibfk_1` FOREIGN KEY (`ho_id`) REFERENCES `hostels` (`ho_id`);

--
-- Constraints for table `hostel_bill_calculator`
--
ALTER TABLE `hostel_bill_calculator`
  ADD CONSTRAINT `hostel_bill_calculator_ibfk_1` FOREIGN KEY (`ho_id`) REFERENCES `hostels` (`ho_id`);

--
-- Constraints for table `hostel_feedbacks`
--
ALTER TABLE `hostel_feedbacks`
  ADD CONSTRAINT `hostel_feedbacks_ibfk_1` FOREIGN KEY (`ha_id`) REFERENCES `hostel_admission_register` (`ha_id`);

--
-- Constraints for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  ADD CONSTRAINT `hostel_rooms_ibfk_1` FOREIGN KEY (`ho_id`) REFERENCES `hostels` (`ho_id`);

--
-- Constraints for table `room_beds`
--
ALTER TABLE `room_beds`
  ADD CONSTRAINT `room_beds_ibfk_1` FOREIGN KEY (`ho_id`) REFERENCES `hostels` (`ho_id`),
  ADD CONSTRAINT `room_beds_ibfk_2` FOREIGN KEY (`hr_id`) REFERENCES `hostel_rooms` (`hr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
