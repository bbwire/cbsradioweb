-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2017 at 06:54 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sap`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `prog_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `side` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presenters`
--

CREATE TABLE `presenters` (
  `presenter_id` int(11) NOT NULL,
  `presenter_name` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `presenters`
--

INSERT INTO `presenters` (`presenter_id`, `presenter_name`, `dob`, `phone`, `email`) VALUES
(2, 'Mike Mako', '2006-10-19', '0706741084', 'bbwire2@gmail.com'),
(3, 'Anatoli Kiri', '2017-02-08', '0709876543', 'anat@gmail.com'),
(4, 'Mako Varati', '2017-02-07', '0789876544', 'vara@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `prog_id` int(11) NOT NULL,
  `prog_title` varchar(100) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `presenter_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `mon` varchar(10) NOT NULL,
  `tue` varchar(10) NOT NULL,
  `wed` varchar(10) NOT NULL,
  `thur` varchar(10) NOT NULL,
  `fri` varchar(10) NOT NULL,
  `sat` varchar(10) NOT NULL,
  `sun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `siteTitle` varchar(250) NOT NULL,
  `siteSlogan` text NOT NULL,
  `systemEmail` varchar(50) NOT NULL,
  `systemPhone` varchar(30) NOT NULL,
  `latestVersion` varchar(20) NOT NULL,
  `footerText` text NOT NULL,
  `siteLogo` text NOT NULL,
  `lastUpdated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteTitle`, `siteSlogan`, `systemEmail`, `systemPhone`, `latestVersion`, `footerText`, `siteLogo`, `lastUpdated`) VALUES
(1, 'School Manager', 'The Best', 'bbwire73@yahoo.com', '+256706741084', '0.1', 'Â© 2017 School Manager&trade;. All Rights Reserved', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `website` varchar(40) NOT NULL,
  `banner_url` text NOT NULL,
  `logo_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `studio_contact`
--

CREATE TABLE `studio_contact` (
  `studio_id` int(11) NOT NULL,
  `whatsapp_line` varchar(20) NOT NULL,
  `message_line` varchar(20) NOT NULL,
  `call_line` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `prog_id` int(11) NOT NULL,
  `topic_title` varchar(40) NOT NULL,
  `topic_description` text NOT NULL,
  `topic_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `activated` int(1) NOT NULL DEFAULT '1',
  `birthday` varchar(20) NOT NULL DEFAULT '0',
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `phoneNo` varchar(250) DEFAULT NULL,
  `photo` varchar(250) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `email`, `password`, `fname`, `lname`, `role`, `activated`, `birthday`, `gender`, `address`, `phoneNo`, `photo`) VALUES
(3, 'walter', 'walterok@gmail.com', '841d93525b9f0960ceaf38f4fdf22e2e', 'Walter', 'Okello', 'admin', 1, '1999-01-18', 'Male', 'Apac', '706525830', ''),
(2, 'petrine', 'sifudu@gmail.com', 'c4333de80bc6c0df105d2f64a063fd45', 'Sifudu', 'Peter', 'finance', 1, '1999-02-04', 'Male', 'Lira', '+256706525830', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `presenters`
--
ALTER TABLE `presenters`
  ADD PRIMARY KEY (`presenter_id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`prog_id`),
  ADD KEY `sponsor_id` (`sponsor_id`),
  ADD KEY `presenter_id` (`presenter_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`sponsor_id`);

--
-- Indexes for table `studio_contact`
--
ALTER TABLE `studio_contact`
  ADD PRIMARY KEY (`studio_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `id` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presenters`
--
ALTER TABLE `presenters`
  MODIFY `presenter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `prog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studio_contact`
--
ALTER TABLE `studio_contact`
  MODIFY `studio_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
