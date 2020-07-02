-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2020 at 08:41 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `member_id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone_pay_no` varchar(15) DEFAULT NULL,
  `google_pay_no` varchar(15) DEFAULT NULL,
  `paytm_no` varchar(15) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `acc_no` varchar(20) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `sponcer` varchar(20) NOT NULL,
  `joining_date` date NOT NULL,
  `level` int(100) NOT NULL,
  `sponcer_info` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donation_reciept`
--

CREATE TABLE `donation_reciept` (
  `id` int(11) NOT NULL,
  `send_donation_id` int(50) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `amount` int(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'not approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `get_donation`
--

CREATE TABLE `get_donation` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `get_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `amount` int(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'notapproved',
  `provide_id` varchar(50) DEFAULT NULL,
  `get_help_no` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `growth`
--

CREATE TABLE `growth` (
  `id` int(11) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `provide_amount` int(50) NOT NULL,
  `growth_amount` int(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone_pay_no` varchar(15) DEFAULT NULL,
  `google_pay_no` varchar(15) DEFAULT NULL,
  `paytm_no` varchar(15) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `acc_no` varchar(20) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `sponcer` varchar(20) NOT NULL,
  `joining_date` date NOT NULL,
  `level` int(100) NOT NULL,
  `sponcer_info` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `message`, `date`) VALUES
(3, 'Welcome', 'Welcome to MiniBank!', '2020-05-31 01:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `pack`
--

CREATE TABLE `pack` (
  `id` int(11) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pin_report`
--

CREATE TABLE `pin_report` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `received_from` varchar(50) NOT NULL,
  `received_from_name` varchar(50) NOT NULL,
  `noofpins` int(11) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `provide_help`
--

CREATE TABLE `provide_help` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `complete` varchar(20) NOT NULL DEFAULT 'false',
  `provide_help_no` varchar(50) NOT NULL,
  `sponcer_name` varchar(200) DEFAULT NULL,
  `sponcer_id` varchar(200) DEFAULT NULL,
  `amount` int(20) NOT NULL,
  `date` datetime NOT NULL,
  `approved_datetime` datetime DEFAULT NULL,
  `first` int(11) NOT NULL DEFAULT '0',
  `provide_count` int(11) NOT NULL DEFAULT '1',
  `get_count` int(11) NOT NULL DEFAULT '2',
  `growth` varchar(50) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `provide_request`
--

CREATE TABLE `provide_request` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `provide_help_no` varchar(50) NOT NULL,
  `sponcer_name` varchar(200) NOT NULL,
  `sponcer_id` varchar(200) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` datetime NOT NULL,
  `first` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pin_amount` int(50) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `id` int(11) NOT NULL,
  `get_id` varchar(100) NOT NULL,
  `get_name` varchar(100) NOT NULL,
  `get_phone` varchar(10) NOT NULL,
  `send_id` varchar(100) NOT NULL,
  `send_name` varchar(100) NOT NULL,
  `send_phone` varchar(10) NOT NULL,
  `provide_id` int(50) NOT NULL,
  `get_help_no` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `send_donation`
--

CREATE TABLE `send_donation` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `send_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `amount` int(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'notapproved',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_pin`
--

CREATE TABLE `transfer_pin` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `transfer_to` varchar(50) NOT NULL,
  `transfer_to_name` varchar(50) NOT NULL,
  `used_id` varchar(50) NOT NULL DEFAULT 'unused',
  `used_name` varchar(50) NOT NULL DEFAULT 'unused',
  `used_date` date DEFAULT NULL,
  `pin` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usedpins`
--

CREATE TABLE `usedpins` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `register` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `money` int(200) NOT NULL,
  `growth` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `working_wallet`
--

CREATE TABLE `working_wallet` (
  `id` int(11) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `credit` int(50) NOT NULL DEFAULT '0',
  `debit` int(50) NOT NULL DEFAULT '0',
  `narration` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `donation_reciept`
--
ALTER TABLE `donation_reciept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_donation`
--
ALTER TABLE `get_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `growth`
--
ALTER TABLE `growth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_report`
--
ALTER TABLE `pin_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provide_help`
--
ALTER TABLE `provide_help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provide_request`
--
ALTER TABLE `provide_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_donation`
--
ALTER TABLE `send_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_pin`
--
ALTER TABLE `transfer_pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usedpins`
--
ALTER TABLE `usedpins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_wallet`
--
ALTER TABLE `working_wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donation_reciept`
--
ALTER TABLE `donation_reciept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `get_donation`
--
ALTER TABLE `get_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `growth`
--
ALTER TABLE `growth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pack`
--
ALTER TABLE `pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pin_report`
--
ALTER TABLE `pin_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provide_help`
--
ALTER TABLE `provide_help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provide_request`
--
ALTER TABLE `provide_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_donation`
--
ALTER TABLE `send_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_pin`
--
ALTER TABLE `transfer_pin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usedpins`
--
ALTER TABLE `usedpins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_wallet`
--
ALTER TABLE `working_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
