-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2016 at 06:59 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stage_shastra`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
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

CREATE TABLE IF NOT EXISTS `actor_facial_attribute` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_facial_attribute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_languages`
--

CREATE TABLE IF NOT EXISTS `actor_languages` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_physical_attribute`
--

CREATE TABLE IF NOT EXISTS `actor_physical_attribute` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_physical_attribute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_projects`
--

CREATE TABLE IF NOT EXISTS `actor_projects` (
  `actor_projects_id` int(11) NOT NULL,
  `actor_id` varchar(16) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actor_skills`
--

CREATE TABLE IF NOT EXISTS `actor_skills` (
  `id` int(11) NOT NULL,
  `fk_actor_id` varchar(15) NOT NULL,
  `fk_skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `beta_actor`
--

CREATE TABLE IF NOT EXISTS `beta_actor` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(45) NOT NULL,
  `timetamp` int(15) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beta_actor`
--

INSERT INTO `beta_actor` (`id`, `name`, `email`, `mobile`, `password`, `timetamp`, `status`, `ip`) VALUES
(3, 'Dilip Kumar', 'dkp_264@yahoo.com', '08979578267', '7e9a28aa0d4a78ecd59641fdcd7cd930', 1461011432, 1, '::1'),
(5, 'Dilip Kumar', 'dkp_264@yahoo.co.in', '08979578267', '7e9a28aa0d4a78ecd59641fdcd7cd930', 1461011809, 1, '::1'),
(6, 'Dilip Kumar', 'dilipkumar.iitr@gmail.com', '08979578267', '7e9a28aa0d4a78ecd59641fdcd7cd930', 1461075523, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `beta_actor_director`
--

CREATE TABLE IF NOT EXISTS `beta_actor_director` (
  `id` int(11) NOT NULL,
  `director_ref` int(11) NOT NULL,
  `actor_ref` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beta_actor_director`
--

INSERT INTO `beta_actor_director` (`id`, `director_ref`, `actor_ref`, `status`) VALUES
(1, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `beta_actor_experience`
--

CREATE TABLE IF NOT EXISTS `beta_actor_experience` (
  `StashActorExperience_id` int(11) NOT NULL,
  `StashActorExperience_actor_ref` int(11) DEFAULT NULL,
  `StashActorExperience_title` varchar(125) DEFAULT NULL,
  `StashActorExperience_blurb` text,
  `StashActorExperience_role` varchar(145) DEFAULT NULL,
  `StashActorExperience_start_time` int(15) DEFAULT NULL,
  `StashActorExperience_end_time` int(15) DEFAULT NULL,
  `StashActorExperience_link` text,
  `StashActorExperience_time` int(15) DEFAULT NULL,
  `StashActorExperience_verify` tinyint(1) DEFAULT NULL,
  `StashActorExperience_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beta_actor_experience`
--

INSERT INTO `beta_actor_experience` (`StashActorExperience_id`, `StashActorExperience_actor_ref`, `StashActorExperience_title`, `StashActorExperience_blurb`, `StashActorExperience_role`, `StashActorExperience_start_time`, `StashActorExperience_end_time`, `StashActorExperience_link`, `StashActorExperience_time`, `StashActorExperience_verify`, `StashActorExperience_status`) VALUES
(1, 3, 'Head and Shoulder', 'This is test Experience...more testing', 'Lead Role', 0, 0, '', 1461011432, 1, 1),
(6, 3, 'Title', 'A little description about the role and the project.', 'Roel', 0, 0, '', 1461050821, 0, 1),
(7, 3, 'Title', 'A little description about the role and the project.', 'Roel', 0, 0, '', 1461050840, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `beta_actor_profile`
--

CREATE TABLE IF NOT EXISTS `beta_actor_profile` (
  `StashActor_id` int(11) NOT NULL,
  `StashActor_actor_ref` int(11) DEFAULT NULL,
  `StashActor_name` varchar(125) DEFAULT NULL,
  `StashActor_email` varchar(125) DEFAULT NULL,
  `StashActor_mobile` varchar(15) DEFAULT NULL,
  `StashActor_whatsapp` varchar(15) DEFAULT NULL,
  `StashActor_dob` int(15) DEFAULT NULL,
  `StashActor_gender` tinyint(1) DEFAULT NULL,
  `StashActor_height` varchar(6) DEFAULT NULL,
  `StashActor_weight` varchar(6) DEFAULT NULL,
  `StashActor_avatar` varchar(45) DEFAULT NULL,
  `StashActor_images` text,
  `StashActor_min_role_age` int(3) DEFAULT NULL,
  `StashActor_max_role_age` int(3) DEFAULT NULL,
  `StashActor_address` text,
  `StashActor_city` varchar(45) DEFAULT NULL,
  `StashActor_state` varchar(45) DEFAULT NULL,
  `StashActor_country` varchar(45) DEFAULT NULL,
  `StashActor_zip` varchar(6) DEFAULT NULL,
  `StashActor_actor_card` tinyint(1) DEFAULT NULL,
  `StashActor_passport` tinyint(1) DEFAULT NULL,
  `StashActor_last_update` int(15) DEFAULT NULL,
  `StashActor_last_ip` varchar(15) DEFAULT NULL,
  `StashActor_skills` text NOT NULL,
  `StashActor_language` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beta_actor_profile`
--

INSERT INTO `beta_actor_profile` (`StashActor_id`, `StashActor_actor_ref`, `StashActor_name`, `StashActor_email`, `StashActor_mobile`, `StashActor_whatsapp`, `StashActor_dob`, `StashActor_gender`, `StashActor_height`, `StashActor_weight`, `StashActor_avatar`, `StashActor_images`, `StashActor_min_role_age`, `StashActor_max_role_age`, `StashActor_address`, `StashActor_city`, `StashActor_state`, `StashActor_country`, `StashActor_zip`, `StashActor_actor_card`, `StashActor_passport`, `StashActor_last_update`, `StashActor_last_ip`, `StashActor_skills`, `StashActor_language`) VALUES
(1, 1, 'Sonu Kumar', NULL, NULL, NULL, 756860400, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'coding, swimming, bike, trecking', ''),
(2, 3, 'Dilip Kumar', 'dkp_264@yahoo.com', '9876543210', '1234567890', 756860400, 1, '174', '72', 'default.png', '', 16, 25, '', '', '', 'India', '', 0, 0, 1461011432, '::1', 'coding, swimming, bike', 'Hindi, English,Bhojpuri'),
(4, 5, 'Dilip Kumar', 'dkp_264@yahoo.co.in', '08979578267', '08979578267', 0, 0, '', '', 'default.png', '', 0, 0, '', '', '', 'India', '', 0, 0, 1461011809, '::1', '', ''),
(5, 6, 'Dilip Kumar', 'dilipkumar.iitr@gmail.com', '08979578267', '08979578267', 0, 1, '', '', 'default.png', '', 0, 0, '', '', '', 'India', '', 0, 0, 1461075523, '::1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `beta_actor_training`
--

CREATE TABLE IF NOT EXISTS `beta_actor_training` (
  `StashActorTraining_id` int(11) NOT NULL,
  `StashActorTraining_actor_ref` int(11) DEFAULT NULL,
  `StashActorTraining_title` varchar(45) DEFAULT NULL,
  `StashActorTraining_course` varchar(45) DEFAULT NULL,
  `StashActorTraining_blurb` text NOT NULL,
  `StashActorTraining_intitute_ref` int(11) DEFAULT NULL,
  `StashActorTraining_trainer` varchar(45) DEFAULT NULL,
  `StashActorTraining_start_time` int(15) DEFAULT NULL,
  `StashActorTraining_end_time` int(15) DEFAULT NULL,
  `StashActorTraining_time` int(15) DEFAULT NULL,
  `StashActorTraining_verify` tinyint(1) DEFAULT NULL,
  `StashActorTraining_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beta_actor_training`
--

INSERT INTO `beta_actor_training` (`StashActorTraining_id`, `StashActorTraining_actor_ref`, `StashActorTraining_title`, `StashActorTraining_course`, `StashActorTraining_blurb`, `StashActorTraining_intitute_ref`, `StashActorTraining_trainer`, `StashActorTraining_start_time`, `StashActorTraining_end_time`, `StashActorTraining_time`, `StashActorTraining_verify`, `StashActorTraining_status`) VALUES
(1, 3, 'Baba Training Institute', 'Basic Acting Course', 'This is test..djfdjbf', 1, '', 2015, 2016, 1461011432, 1, 1),
(2, 3, '', '', '', 0, '', 0, 0, 1461050153, 0, 1),
(3, 3, '', '', '', 0, '', 0, 0, 1461050257, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `beta_invitation_send`
--

CREATE TABLE IF NOT EXISTS `beta_invitation_send` (
  `id` int(11) NOT NULL,
  `director_ref` int(11) NOT NULL,
  `message` text NOT NULL,
  `emails` text NOT NULL,
  `emails_failed` text NOT NULL,
  `mobiles` text NOT NULL,
  `mobile_failed` text NOT NULL,
  `timestamp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE IF NOT EXISTS `director` (
  `director_id` int(11) NOT NULL,
  `director_name` text NOT NULL,
  `director_email` text NOT NULL,
  `director_password` text NOT NULL,
  `director_username` varchar(15) NOT NULL,
  `director_pass_code` text NOT NULL,
  `director_account_state` int(11) NOT NULL,
  `director_joined` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `director_name`, `director_email`, `director_password`, `director_username`, `director_pass_code`, `director_account_state`, `director_joined`) VALUES
(1, 'Dilip Kumar', 'dkp_264@yahoo.com', 'harekrishna', 'dkp_264', '', 1, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `facial_attribute`
--

CREATE TABLE IF NOT EXISTS `facial_attribute` (
  `f_attribute_id` int(11) NOT NULL,
  `facial_attribute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `physical_attribute`
--

CREATE TABLE IF NOT EXISTS `physical_attribute` (
  `p_attribute_id` int(11) NOT NULL,
  `physical_attribute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `director_name` text NOT NULL,
  `director_email` text NOT NULL,
  `director_phone` text NOT NULL,
  `director_contacted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`director_name`, `director_email`, `director_phone`, `director_contacted`) VALUES
('Dilip Kumar', 'dkp_264@yahoo.com', '8979578267', 0),
('Dilip Kumar', 'dkp_264@yahoo.com', '8979578267', 0),
('Dilip Kumar', 'dkp_264@yahoo.com', '8979578267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
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
-- Indexes for table `beta_actor`
--
ALTER TABLE `beta_actor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beta_actor_director`
--
ALTER TABLE `beta_actor_director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beta_actor_experience`
--
ALTER TABLE `beta_actor_experience`
  ADD PRIMARY KEY (`StashActorExperience_id`);

--
-- Indexes for table `beta_actor_profile`
--
ALTER TABLE `beta_actor_profile`
  ADD PRIMARY KEY (`StashActor_id`);

--
-- Indexes for table `beta_actor_training`
--
ALTER TABLE `beta_actor_training`
  ADD PRIMARY KEY (`StashActorTraining_id`);

--
-- Indexes for table `beta_invitation_send`
--
ALTER TABLE `beta_invitation_send`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `beta_actor`
--
ALTER TABLE `beta_actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `beta_actor_director`
--
ALTER TABLE `beta_actor_director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `beta_actor_experience`
--
ALTER TABLE `beta_actor_experience`
  MODIFY `StashActorExperience_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `beta_actor_profile`
--
ALTER TABLE `beta_actor_profile`
  MODIFY `StashActor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `beta_actor_training`
--
ALTER TABLE `beta_actor_training`
  MODIFY `StashActorTraining_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beta_invitation_send`
--
ALTER TABLE `beta_invitation_send`
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
