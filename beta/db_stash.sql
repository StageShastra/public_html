-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2016 at 03:39 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stash`
--

-- --------------------------------------------------------

--
-- Table structure for table `stash-actor`
--

CREATE TABLE IF NOT EXISTS `stash-actor` (
  `StashActor_id` int(11) NOT NULL,
  `StashActor_actor_id_ref` int(11) DEFAULT NULL,
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
  `StashActor_last_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-actor`
--

INSERT INTO `stash-actor` (`StashActor_id`, `StashActor_actor_id_ref`, `StashActor_name`, `StashActor_email`, `StashActor_mobile`, `StashActor_whatsapp`, `StashActor_dob`, `StashActor_gender`, `StashActor_height`, `StashActor_weight`, `StashActor_avatar`, `StashActor_images`, `StashActor_min_role_age`, `StashActor_max_role_age`, `StashActor_address`, `StashActor_city`, `StashActor_state`, `StashActor_country`, `StashActor_zip`, `StashActor_actor_card`, `StashActor_passport`, `StashActor_last_update`, `StashActor_last_ip`) VALUES
(1, 2, 'Sonu Kumar', 'sonukues@iitr.ac.in', '8979578267', '9876543210', 756844200, 1, '0', '0', 'default.png', '{}', 0, 0, '', '', '', '', '', 0, 0, 1462896408, '::1'),
(2, 3, 'StaSh Developer', 'developer@stageshastra.com', '9874123650', '9874123650', 1115935200, 1, '173', '72', 'default.png', '["02c16308e7be72cf292669fbc6f34078.JPG","38357686d741b7c40972fef160076f38.JPG","5509b119bbc45c2c8eb510527d60bbc8.JPG"]', 18, 30, '', '', '', '', '', 0, 0, 1463000227, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `stash-actor-experience`
--

CREATE TABLE IF NOT EXISTS `stash-actor-experience` (
  `StashActorExperience_id` int(11) NOT NULL,
  `StashActorExperience_actor_id_ref` int(11) DEFAULT NULL,
  `StashActorExperience_title` varchar(125) DEFAULT NULL,
  `StashActorExperience_blurb` text,
  `StashActorExperience_role` varchar(145) DEFAULT NULL,
  `StashActorExperience_link` text,
  `StashActorExperience_time` int(15) DEFAULT NULL,
  `StashActorExperience_verify` tinyint(1) DEFAULT NULL,
  `StashActorExperience_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-actor-experience`
--

INSERT INTO `stash-actor-experience` (`StashActorExperience_id`, `StashActorExperience_actor_id_ref`, `StashActorExperience_title`, `StashActorExperience_blurb`, `StashActorExperience_role`, `StashActorExperience_link`, `StashActorExperience_time`, `StashActorExperience_verify`, `StashActorExperience_status`) VALUES
(1, 3, 'HomeBazaar Ad.', 'This is test Experience. and Update Test..\n', 'Rahul', 'https://youtu.be/_qIRtFE6aIc', 1463142521, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stash-actor-language`
--

CREATE TABLE IF NOT EXISTS `stash-actor-language` (
  `StashActorLanguage_id` int(11) NOT NULL,
  `StashActorLanguage_actor_id_ref` int(11) DEFAULT NULL,
  `StashActorLanguage_language_id_ref` int(11) DEFAULT NULL,
  `StashActorLanguage_time` int(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-actor-language`
--

INSERT INTO `stash-actor-language` (`StashActorLanguage_id`, `StashActorLanguage_actor_id_ref`, `StashActorLanguage_language_id_ref`, `StashActorLanguage_time`) VALUES
(1, 3, 1, NULL),
(2, 3, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stash-actor-skill`
--

CREATE TABLE IF NOT EXISTS `stash-actor-skill` (
  `StashActorSkill_id` int(11) NOT NULL,
  `StashActorSkill_actor_id_ref` int(11) DEFAULT NULL,
  `StashActorSkill_skill_id_ref` int(11) DEFAULT NULL,
  `StashActorSkill_time` int(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-actor-skill`
--

INSERT INTO `stash-actor-skill` (`StashActorSkill_id`, `StashActorSkill_actor_id_ref`, `StashActorSkill_skill_id_ref`, `StashActorSkill_time`) VALUES
(1, 3, 1, NULL),
(2, 3, 2, 1463140386),
(3, 3, 3, 1463140386);

-- --------------------------------------------------------

--
-- Table structure for table `stash-actor-training`
--

CREATE TABLE IF NOT EXISTS `stash-actor-training` (
  `StashActorTraining_id` int(11) NOT NULL,
  `StashActorTraining_actor_id_ref` int(11) DEFAULT NULL,
  `StashActorTraining_title` varchar(45) DEFAULT NULL,
  `StashActorTraining_course` varchar(45) DEFAULT NULL,
  `StashActorTraining_intitute_id_ref` int(11) DEFAULT NULL,
  `StashActorTraining_trainer` varchar(45) DEFAULT NULL,
  `StashActorTraining_blurb` text NOT NULL,
  `StashActorTraining_start_time` int(15) DEFAULT NULL,
  `StashActorTraining_end_time` int(15) DEFAULT NULL,
  `StashActorTraining_time` int(15) DEFAULT NULL,
  `StashActorTraining_verify` tinyint(1) DEFAULT NULL,
  `StashActorTraining_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-actor-training`
--

INSERT INTO `stash-actor-training` (`StashActorTraining_id`, `StashActorTraining_actor_id_ref`, `StashActorTraining_title`, `StashActorTraining_course`, `StashActorTraining_intitute_id_ref`, `StashActorTraining_trainer`, `StashActorTraining_blurb`, `StashActorTraining_start_time`, `StashActorTraining_end_time`, `StashActorTraining_time`, `StashActorTraining_verify`, `StashActorTraining_status`) VALUES
(1, 3, 'StageShastra School', 'Diploma in Actong', NULL, NULL, 'this is test Description...', 2013, 2015, 1463145655, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stash-blocklist`
--

CREATE TABLE IF NOT EXISTS `stash-blocklist` (
  `StashBlockList_id` int(11) NOT NULL,
  `StashBlockList_director_id_ref` int(11) DEFAULT NULL,
  `StashBlockList_actor_id_ref` int(11) DEFAULT NULL,
  `StashBlockList_time` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-custom-1`
--

CREATE TABLE IF NOT EXISTS `stash-custom-1` (
  `StashCustom1_id` int(11) NOT NULL,
  `StashCustom1_actor_id_ref` int(11) DEFAULT NULL,
  `StashCustom1_director_id_ref` int(11) DEFAULT NULL,
  `StashCustom1_field_name` varchar(45) DEFAULT NULL,
  `StashCustom1_field_data` varchar(45) DEFAULT NULL,
  `StashCustom1_time` int(15) NOT NULL,
  `StashCustom1_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-custom-2`
--

CREATE TABLE IF NOT EXISTS `stash-custom-2` (
  `StashCustom2_id` int(11) NOT NULL,
  `StashCustom2_actor_id_ref` int(11) DEFAULT NULL,
  `StashCustom2_director_id_ref` int(11) DEFAULT NULL,
  `StashCustom2_field_name` varchar(45) DEFAULT NULL,
  `StashCustom2_field_data` varchar(45) DEFAULT NULL,
  `StashCustom2_time` int(15) NOT NULL,
  `StashCustom2_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-custom-3`
--

CREATE TABLE IF NOT EXISTS `stash-custom-3` (
  `StashCustom3_id` int(11) NOT NULL,
  `StashCustom3_actor_id_ref` int(11) DEFAULT NULL,
  `StashCustom3_director_id_ref` int(11) DEFAULT NULL,
  `StashCustom3_field_name` varchar(45) DEFAULT NULL,
  `StashCustom3_field_data` varchar(45) DEFAULT NULL,
  `StashCustom3_time` int(15) NOT NULL,
  `StashCustom3_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-director`
--

CREATE TABLE IF NOT EXISTS `stash-director` (
  `StashDirector_id` int(11) NOT NULL,
  `StashDirector_director_id_ref` int(11) DEFAULT NULL,
  `StashDirector_name` varchar(45) DEFAULT NULL,
  `StashDirector_email` varchar(125) DEFAULT NULL,
  `StashDirector_mobile` varchar(15) DEFAULT NULL,
  `StashDirector_avatar` varchar(45) DEFAULT NULL,
  `StashDirector_last_update` int(15) DEFAULT NULL,
  `StashDirector_last_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-director`
--

INSERT INTO `stash-director` (`StashDirector_id`, `StashDirector_director_id_ref`, `StashDirector_name`, `StashDirector_email`, `StashDirector_mobile`, `StashDirector_avatar`, `StashDirector_last_update`, `StashDirector_last_ip`) VALUES
(1, 1, 'Dilip Kumar', 'dkp_264@yahoo.com', '08979578267', 'default.png', 1462896013, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `stash-director-actor-link`
--

CREATE TABLE IF NOT EXISTS `stash-director-actor-link` (
  `StashDirectorActorLink_id` int(11) NOT NULL,
  `StashDirectorActorLink_director_id_ref` int(11) DEFAULT NULL,
  `StashDirectorActorLink_actor_id_ref` int(11) DEFAULT NULL,
  `StashDirectorActorLink_rate` tinyint(1) DEFAULT NULL,
  `StashDirectorActorLink_status` tinyint(1) DEFAULT NULL,
  `StashDirectorActorLink_time` int(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-director-actor-link`
--

INSERT INTO `stash-director-actor-link` (`StashDirectorActorLink_id`, `StashDirectorActorLink_director_id_ref`, `StashDirectorActorLink_actor_id_ref`, `StashDirectorActorLink_rate`, `StashDirectorActorLink_status`, `StashDirectorActorLink_time`) VALUES
(1, 1, 2, 5, 1, 1462990549),
(2, 1, 3, 5, 1, 1462990560);

-- --------------------------------------------------------

--
-- Table structure for table `stash-email`
--

CREATE TABLE IF NOT EXISTS `stash-email` (
  `StashEMail_id` int(11) NOT NULL,
  `StashEMail_send_by` int(11) DEFAULT NULL,
  `StashEMail_to` text,
  `StashEMail_subject` varchar(125) DEFAULT NULL,
  `StashEMail_message` text,
  `StashEMail_time` int(15) DEFAULT NULL,
  `StashEMail_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-email-invitation`
--

CREATE TABLE IF NOT EXISTS `stash-email-invitation` (
  `StashEmailInvite_id` int(11) NOT NULL,
  `StashEmailInvite_director_id_ref` int(11) NOT NULL,
  `StashEmailInvite_emails` text NOT NULL,
  `StashEmailInvite_message` text NOT NULL,
  `StashEmailInvite_project_id_ref` int(11) NOT NULL,
  `StashEmailInvite_time` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-forgot-password`
--

CREATE TABLE IF NOT EXISTS `stash-forgot-password` (
  `StashForgotPassword_id` int(11) NOT NULL,
  `StashForgotPassword_user_id_ref` int(11) NOT NULL,
  `StashForgotPassword_code` int(6) NOT NULL,
  `StashForgotPassword_req_time` int(15) NOT NULL,
  `StashForgotPassword_used_time` int(15) NOT NULL,
  `StashForgotPassword_status` tinyint(1) NOT NULL,
  `StashForgotPassword_ip` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-forgot-password`
--

INSERT INTO `stash-forgot-password` (`StashForgotPassword_id`, `StashForgotPassword_user_id_ref`, `StashForgotPassword_code`, `StashForgotPassword_req_time`, `StashForgotPassword_used_time`, `StashForgotPassword_status`, `StashForgotPassword_ip`) VALUES
(1, 1, 157270, 1462947798, 1462992073, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `stash-languages`
--

CREATE TABLE IF NOT EXISTS `stash-languages` (
  `StashLanguages_id` int(11) NOT NULL,
  `StashLanguages_title` varchar(45) DEFAULT NULL,
  `StashLanguages_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-languages`
--

INSERT INTO `stash-languages` (`StashLanguages_id`, `StashLanguages_title`, `StashLanguages_status`) VALUES
(1, 'Hindi', 1),
(2, 'English', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stash-logins`
--

CREATE TABLE IF NOT EXISTS `stash-logins` (
  `StashLogins_id` int(11) NOT NULL,
  `StashLogins_user_id_ref` int(11) DEFAULT NULL,
  `StashLogins_time` int(15) DEFAULT NULL,
  `StashLogins_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-logins`
--

INSERT INTO `stash-logins` (`StashLogins_id`, `StashLogins_user_id_ref`, `StashLogins_time`, `StashLogins_ip`) VALUES
(1, 1, 1462896127, NULL),
(2, 1, 1462896264, NULL),
(3, 1, 1462896289, '::1'),
(4, 2, 1462896430, '::1'),
(5, 1, 1462896949, '::1'),
(6, 2, 1462976163, '::1'),
(7, 2, 1462992014, '::1'),
(8, 1, 1462992091, '::1'),
(9, 1, 1462995683, '::1'),
(10, 1, 1463000242, '::1'),
(11, 1, 1463000540, '::1'),
(12, 1, 1463032036, '::1'),
(13, 1, 1463052407, '::1'),
(14, 1, 1463066287, '::1'),
(15, 1, 1463079951, '::1'),
(16, 3, 1463130638, '::1'),
(17, 1, 1463146229, '::1'),
(18, 1, 1463146238, '::1'),
(19, 1, 1463146310, '::1'),
(20, 3, 1463147376, '::1'),
(21, 1, 1463147560, '::1'),
(22, 1, 1463148454, '::1'),
(23, 3, 1463151247, '::1'),
(24, 3, 1463203683, '::1'),
(25, 1, 1463210770, '::1'),
(26, 1, 1463211818, '::1'),
(27, 1, 1463212491, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `stash-project`
--

CREATE TABLE IF NOT EXISTS `stash-project` (
  `StashProject_id` int(11) NOT NULL,
  `StashProject_director_id_ref` int(11) NOT NULL,
  `StashProject_name` varchar(125) NOT NULL,
  `StashProject_date` int(15) NOT NULL,
  `StashProject_tag` varchar(125) NOT NULL,
  `StashProject_time` int(15) NOT NULL,
  `StashProject_status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-project`
--

INSERT INTO `stash-project` (`StashProject_id`, `StashProject_director_id_ref`, `StashProject_name`, `StashProject_date`, `StashProject_tag`, `StashProject_time`, `StashProject_status`) VALUES
(1, 1, 'Castiko Invitaion', 1463176800, 'Castiko Invitaion_2016-05-14', 1463227287, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stash-skills`
--

CREATE TABLE IF NOT EXISTS `stash-skills` (
  `StashSkills_id` int(11) NOT NULL,
  `StashSkills_title` varchar(45) DEFAULT NULL,
  `StashSkills_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-skills`
--

INSERT INTO `stash-skills` (`StashSkills_id`, `StashSkills_title`, `StashSkills_status`) VALUES
(1, 'dancing', 1),
(2, 'singing', 1),
(3, 'coding', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stash-sms`
--

CREATE TABLE IF NOT EXISTS `stash-sms` (
  `StashSMS_id` int(11) NOT NULL,
  `StashSMS_send_by` int(11) DEFAULT NULL,
  `StashSMS_send_to` text,
  `StashSMS_message` text,
  `StashSMS_time` int(15) DEFAULT NULL,
  `StashSMS_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-sms-invitation`
--

CREATE TABLE IF NOT EXISTS `stash-sms-invitation` (
  `StashSMSInvite_id` int(11) NOT NULL,
  `StashSMSInvite_director_id_ref` int(11) NOT NULL,
  `StashSMSInvite_mobiles` text NOT NULL,
  `StashSMSInvite_message` text NOT NULL,
  `StashSMSInvite_project_id_ref` int(11) NOT NULL,
  `StashSMSInvite_time` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-training-institutes`
--

CREATE TABLE IF NOT EXISTS `stash-training-institutes` (
  `StashTrainingInstitutes_id` int(11) NOT NULL,
  `StashTrainingInstitutes_name` text,
  `StashTrainingInstitutes_address` text,
  `StashTrainingInstitutes_city` varchar(45) DEFAULT NULL,
  `StashTrainingInstitutes_state` varchar(45) DEFAULT NULL,
  `StashTrainingInstitutes_country` varchar(45) DEFAULT NULL,
  `StashTrainingInstitutes_zip` varchar(6) DEFAULT NULL,
  `StashTrainingInstitutes_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stash-users`
--

CREATE TABLE IF NOT EXISTS `stash-users` (
  `StashUsers_id` int(11) NOT NULL,
  `StashUsers_username` varchar(45) DEFAULT NULL,
  `StashUsers_name` varchar(45) DEFAULT NULL,
  `StashUsers_email` varchar(125) DEFAULT NULL,
  `StashUsers_mobile` varchar(15) DEFAULT NULL,
  `StashUsers_password` varchar(145) DEFAULT NULL,
  `StashUsers_type` enum('director','actor') DEFAULT NULL,
  `StashUsers_time` int(15) DEFAULT NULL,
  `StashUsers_status` tinyint(1) DEFAULT NULL,
  `StashUsers_ip` varchar(15) DEFAULT NULL,
  `StashUsers_header` tinytext
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stash-users`
--

INSERT INTO `stash-users` (`StashUsers_id`, `StashUsers_username`, `StashUsers_name`, `StashUsers_email`, `StashUsers_mobile`, `StashUsers_password`, `StashUsers_type`, `StashUsers_time`, `StashUsers_status`, `StashUsers_ip`, `StashUsers_header`) VALUES
(1, 'dkp_264', 'Dilip Kumar', 'dkp_264@yahoo.com', '08979578267', '684086cae8fc315e12cee7c11b398eccdd310e4a4da1266c066c013a7ef84e4741bdb7cd0a182578c3e1a5f146341b6d4162369b30e3dbe1d8fd6b103fe4db40', 'director', 1462896013, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36'),
(2, 'sonukues', 'Sonu Kumar', 'sonukues@iitr.ac.in', '9876543210', '684086cae8fc315e12cee7c11b398eccdd310e4a4da1266c066c013a7ef84e4741bdb7cd0a182578c3e1a5f146341b6d4162369b30e3dbe1d8fd6b103fe4db40', 'actor', 1462896408, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36'),
(3, 'developer', 'StaSh Developer', 'developer@stageshastra.com', '9874123650', 'c1a5ced97ee8bd08683924bc2ab9e5e11f2d23d40bd3914639959630f6a053923125160669af5d4a25b3d1f48a61a0752ab85ef10cc70e31ea073fbc58736b7d', 'actor', 1463000227, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `stast-actor-project`
--

CREATE TABLE IF NOT EXISTS `stast-actor-project` (
  `StashActorProject_id` int(11) NOT NULL,
  `StashActorProject_actor_id_ref` int(11) NOT NULL,
  `StashActorProject_project_id_ref` int(11) NOT NULL,
  `StashActorProject_time` int(15) NOT NULL,
  `StashActorProject_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stash-actor`
--
ALTER TABLE `stash-actor`
  ADD PRIMARY KEY (`StashActor_id`);

--
-- Indexes for table `stash-actor-experience`
--
ALTER TABLE `stash-actor-experience`
  ADD PRIMARY KEY (`StashActorExperience_id`);

--
-- Indexes for table `stash-actor-language`
--
ALTER TABLE `stash-actor-language`
  ADD PRIMARY KEY (`StashActorLanguage_id`);

--
-- Indexes for table `stash-actor-skill`
--
ALTER TABLE `stash-actor-skill`
  ADD PRIMARY KEY (`StashActorSkill_id`);

--
-- Indexes for table `stash-actor-training`
--
ALTER TABLE `stash-actor-training`
  ADD PRIMARY KEY (`StashActorTraining_id`);

--
-- Indexes for table `stash-blocklist`
--
ALTER TABLE `stash-blocklist`
  ADD PRIMARY KEY (`StashBlockList_id`);

--
-- Indexes for table `stash-custom-1`
--
ALTER TABLE `stash-custom-1`
  ADD PRIMARY KEY (`StashCustom1_id`);

--
-- Indexes for table `stash-custom-2`
--
ALTER TABLE `stash-custom-2`
  ADD PRIMARY KEY (`StashCustom2_id`);

--
-- Indexes for table `stash-custom-3`
--
ALTER TABLE `stash-custom-3`
  ADD PRIMARY KEY (`StashCustom3_id`);

--
-- Indexes for table `stash-director`
--
ALTER TABLE `stash-director`
  ADD PRIMARY KEY (`StashDirector_id`);

--
-- Indexes for table `stash-director-actor-link`
--
ALTER TABLE `stash-director-actor-link`
  ADD PRIMARY KEY (`StashDirectorActorLink_id`);

--
-- Indexes for table `stash-email`
--
ALTER TABLE `stash-email`
  ADD PRIMARY KEY (`StashEMail_id`);

--
-- Indexes for table `stash-email-invitation`
--
ALTER TABLE `stash-email-invitation`
  ADD PRIMARY KEY (`StashEmailInvite_id`);

--
-- Indexes for table `stash-forgot-password`
--
ALTER TABLE `stash-forgot-password`
  ADD PRIMARY KEY (`StashForgotPassword_id`);

--
-- Indexes for table `stash-languages`
--
ALTER TABLE `stash-languages`
  ADD PRIMARY KEY (`StashLanguages_id`);

--
-- Indexes for table `stash-logins`
--
ALTER TABLE `stash-logins`
  ADD PRIMARY KEY (`StashLogins_id`);

--
-- Indexes for table `stash-project`
--
ALTER TABLE `stash-project`
  ADD PRIMARY KEY (`StashProject_id`);

--
-- Indexes for table `stash-skills`
--
ALTER TABLE `stash-skills`
  ADD PRIMARY KEY (`StashSkills_id`);

--
-- Indexes for table `stash-sms`
--
ALTER TABLE `stash-sms`
  ADD PRIMARY KEY (`StashSMS_id`);

--
-- Indexes for table `stash-sms-invitation`
--
ALTER TABLE `stash-sms-invitation`
  ADD PRIMARY KEY (`StashSMSInvite_id`);

--
-- Indexes for table `stash-training-institutes`
--
ALTER TABLE `stash-training-institutes`
  ADD PRIMARY KEY (`StashTrainingInstitutes_id`);

--
-- Indexes for table `stash-users`
--
ALTER TABLE `stash-users`
  ADD PRIMARY KEY (`StashUsers_id`);

--
-- Indexes for table `stast-actor-project`
--
ALTER TABLE `stast-actor-project`
  ADD PRIMARY KEY (`StashActorProject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stash-actor`
--
ALTER TABLE `stash-actor`
  MODIFY `StashActor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stash-actor-experience`
--
ALTER TABLE `stash-actor-experience`
  MODIFY `StashActorExperience_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stash-actor-language`
--
ALTER TABLE `stash-actor-language`
  MODIFY `StashActorLanguage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stash-actor-skill`
--
ALTER TABLE `stash-actor-skill`
  MODIFY `StashActorSkill_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stash-actor-training`
--
ALTER TABLE `stash-actor-training`
  MODIFY `StashActorTraining_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stash-blocklist`
--
ALTER TABLE `stash-blocklist`
  MODIFY `StashBlockList_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-custom-1`
--
ALTER TABLE `stash-custom-1`
  MODIFY `StashCustom1_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-custom-2`
--
ALTER TABLE `stash-custom-2`
  MODIFY `StashCustom2_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-custom-3`
--
ALTER TABLE `stash-custom-3`
  MODIFY `StashCustom3_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-director`
--
ALTER TABLE `stash-director`
  MODIFY `StashDirector_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stash-director-actor-link`
--
ALTER TABLE `stash-director-actor-link`
  MODIFY `StashDirectorActorLink_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stash-email`
--
ALTER TABLE `stash-email`
  MODIFY `StashEMail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-email-invitation`
--
ALTER TABLE `stash-email-invitation`
  MODIFY `StashEmailInvite_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-forgot-password`
--
ALTER TABLE `stash-forgot-password`
  MODIFY `StashForgotPassword_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stash-languages`
--
ALTER TABLE `stash-languages`
  MODIFY `StashLanguages_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stash-logins`
--
ALTER TABLE `stash-logins`
  MODIFY `StashLogins_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `stash-project`
--
ALTER TABLE `stash-project`
  MODIFY `StashProject_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stash-skills`
--
ALTER TABLE `stash-skills`
  MODIFY `StashSkills_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stash-sms`
--
ALTER TABLE `stash-sms`
  MODIFY `StashSMS_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-sms-invitation`
--
ALTER TABLE `stash-sms-invitation`
  MODIFY `StashSMSInvite_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-training-institutes`
--
ALTER TABLE `stash-training-institutes`
  MODIFY `StashTrainingInstitutes_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stash-users`
--
ALTER TABLE `stash-users`
  MODIFY `StashUsers_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stast-actor-project`
--
ALTER TABLE `stast-actor-project`
  MODIFY `StashActorProject_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
