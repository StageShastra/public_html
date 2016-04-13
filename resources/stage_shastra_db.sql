-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2016 at 01:05 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stage_shastra`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actor_id` varchar(14) CHARACTER SET latin1 NOT NULL,
  `actor_username` varchar(15) CHARACTER SET latin1 NOT NULL,
  `actor_password` text CHARACTER SET latin1 NOT NULL,
  `actor_passcode` text CHARACTER SET latin1 NOT NULL,
  `actor_name` text CHARACTER SET latin1 NOT NULL,
  `actor_sex` text CHARACTER SET latin1 NOT NULL,
  `actor_dob` date NOT NULL,
  `actor_age_range_min` int(11) NOT NULL,
  `actor_age_range_max` int(11) NOT NULL,
  `actor_height` int(11) NOT NULL,
  `actor_weight` int(11) NOT NULL,
  `actor_email` text CHARACTER SET latin1 NOT NULL,
  `actor_contact_number` text NOT NULL,
  `actor_whatsapp_number` int(11) NOT NULL,
  `actor_address` text CHARACTER SET latin1 NOT NULL,
  `actor_class` text CHARACTER SET latin1 NOT NULL,
  `actor_profile_photo` text CHARACTER SET latin1 NOT NULL,
  `actor_blacklist` tinyint(1) NOT NULL,
  `actor_card` tinyint(1) NOT NULL,
  `actor_passport` text CHARACTER SET latin1 NOT NULL,
  `actor_physical-attribute` text CHARACTER SET latin1 NOT NULL,
  `actor_facial-attribute` text CHARACTER SET latin1 NOT NULL,
  `actor_language` text CHARACTER SET latin1 NOT NULL,
  `actor_skills` text CHARACTER SET latin1 NOT NULL,
  `actor_experience` text CHARACTER SET latin1 NOT NULL,
  `actor_training` text CHARACTER SET latin1 NOT NULL,
  `actor_age` int(11) NOT NULL,
  `actor_range` text CHARACTER SET latin1 NOT NULL,
  `actor_projects` text CHARACTER SET latin1 NOT NULL,
  `actor_images` int(11) NOT NULL,
  `director_id` text CHARACTER SET latin1 NOT NULL,
  `actor_audition` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `actor_facial_attribute`
--

CREATE TABLE `actor_facial_attribute` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_facial_attribute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_languages`
--

CREATE TABLE `actor_languages` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_physical_attribute`
--

CREATE TABLE `actor_physical_attribute` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_physical_attribute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_projects`
--

CREATE TABLE `actor_projects` (
  `actor_projects_id` int(11) NOT NULL,
  `actor_id` varchar(16) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_skills`
--

CREATE TABLE `actor_skills` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `director_id` int(11) NOT NULL,
  `director_name` text NOT NULL,
  `director_email` text NOT NULL,
  `director_password` text NOT NULL,
  `director_username` varchar(15) NOT NULL,
  `director_pass_code` text NOT NULL,
  `director_account_state` int(11) NOT NULL,
  `director_joined` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facial_attribute`
--

CREATE TABLE `facial_attribute` (
  `f_attribute_id` int(11) NOT NULL,
  `facial_attribute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `physical_attribute`
--

CREATE TABLE `physical_attribute` (
  `p_attribute_id` int(11) NOT NULL,
  `physical_attribute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `director_name` text NOT NULL,
  `director_email` text NOT NULL,
  `director_phone` text NOT NULL,
  `director_contacted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`),
  ADD UNIQUE KEY `actor_username` (`actor_username`);

--
-- Indexes for table `actor_facial_attribute`
--
ALTER TABLE `actor_facial_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actor_id` (`fk_actor_id`),
  ADD KEY `fk_facial_attribute` (`fk_facial_attribute`);

--
-- Indexes for table `actor_languages`
--
ALTER TABLE `actor_languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actor_id` (`fk_actor_id`),
  ADD KEY `fk_language_id` (`fk_language_id`);

--
-- Indexes for table `actor_physical_attribute`
--
ALTER TABLE `actor_physical_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actor_id` (`fk_actor_id`),
  ADD KEY `fk_physical_attribute` (`fk_physical_attribute`);

--
-- Indexes for table `actor_projects`
--
ALTER TABLE `actor_projects`
  ADD PRIMARY KEY (`actor_projects_id`),
  ADD KEY `fk_actor_id` (`actor_id`),
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `actor_skills`
--
ALTER TABLE `actor_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actor_id` (`fk_actor_id`),
  ADD KEY `fk_skill_id` (`fk_skill_id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`director_id`),
  ADD UNIQUE KEY `director_username` (`director_username`);

--
-- Indexes for table `facial_attribute`
--
ALTER TABLE `facial_attribute`
  ADD PRIMARY KEY (`f_attribute_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `physical_attribute`
--
ALTER TABLE `physical_attribute`
  ADD PRIMARY KEY (`p_attribute_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`),
  ADD UNIQUE KEY `skill_name` (`skill_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor_facial_attribute`
--
ALTER TABLE `actor_facial_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actor_languages`
--
ALTER TABLE `actor_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actor_physical_attribute`
--
ALTER TABLE `actor_physical_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actor_projects`
--
ALTER TABLE `actor_projects`
  MODIFY `actor_projects_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actor_skills`
--
ALTER TABLE `actor_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facial_attribute`
--
ALTER TABLE `facial_attribute`
  MODIFY `f_attribute_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `physical_attribute`
--
ALTER TABLE `physical_attribute`
  MODIFY `p_attribute_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor_facial_attribute`
--
ALTER TABLE `actor_facial_attribute`
  ADD CONSTRAINT `actor_facial_attribute_ibfk_1` FOREIGN KEY (`fk_actor_id`) REFERENCES `actor` (`actor_id`),
  ADD CONSTRAINT `actor_facial_attribute_ibfk_2` FOREIGN KEY (`fk_facial_attribute`) REFERENCES `facial_attribute` (`f_attribute_id`);

--
-- Constraints for table `actor_languages`
--
ALTER TABLE `actor_languages`
  ADD CONSTRAINT `actor_languages_ibfk_1` FOREIGN KEY (`fk_actor_id`) REFERENCES `actor` (`actor_id`),
  ADD CONSTRAINT `actor_languages_ibfk_2` FOREIGN KEY (`fk_language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `actor_physical_attribute`
--
ALTER TABLE `actor_physical_attribute`
  ADD CONSTRAINT `actor_physical_attribute_ibfk_1` FOREIGN KEY (`fk_actor_id`) REFERENCES `actor` (`actor_id`),
  ADD CONSTRAINT `actor_physical_attribute_ibfk_2` FOREIGN KEY (`fk_physical_attribute`) REFERENCES `physical_attribute` (`p_attribute_id`);

--
-- Constraints for table `actor_projects`
--
ALTER TABLE `actor_projects`
  ADD CONSTRAINT `actor_projects_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `actor_skills`
--
ALTER TABLE `actor_skills`
  ADD CONSTRAINT `actor_skills_ibfk_1` FOREIGN KEY (`fk_actor_id`) REFERENCES `actor` (`actor_id`),
  ADD CONSTRAINT `actor_skills_ibfk_2` FOREIGN KEY (`fk_skill_id`) REFERENCES `skills` (`skill_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
