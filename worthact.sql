-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2017 at 07:00 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worthact`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `cat_id` int(255) NOT NULL,
  `req_type` int(255) NOT NULL COMMENT '1: Needy 2: Action',
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `phone` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `ad_actions` text,
  `action_desc` varchar(1000) DEFAULT NULL,
  `img` longtext,
  `video` longtext,
  `tags` longtext,
  `date` longtext NOT NULL,
  `time` int(20) NOT NULL,
  `likes` int(255) DEFAULT '0',
  `dislikes` int(255) NOT NULL DEFAULT '0',
  `country_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ads_upgrade`
--

CREATE TABLE `ads_upgrade` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `ad_ids` varchar(1000) NOT NULL,
  `count` int(255) NOT NULL,
  `status` int(255) DEFAULT NULL COMMENT '1: Sent'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adv_blocks`
--

CREATE TABLE `adv_blocks` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `page` varchar(1000) NOT NULL,
  `viewport` varchar(255) NOT NULL,
  `price` varchar(1000) NOT NULL,
  `width` varchar(1000) NOT NULL,
  `height` varchar(100) NOT NULL,
  `position` int(255) NOT NULL COMMENT '0: Left 1: Timeline 2: Right'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adv_blocks_booked`
--

CREATE TABLE `adv_blocks_booked` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `block_id` int(255) NOT NULL,
  `block_name` varchar(1000) NOT NULL,
  `page` varchar(1000) NOT NULL,
  `viewport` varchar(1000) NOT NULL,
  `heading` varchar(1000) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `action_text` varchar(1000) DEFAULT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `availability_timestamp` varchar(1000) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `video` varchar(1000) DEFAULT NULL,
  `slider` varchar(1000) DEFAULT NULL,
  `days` varchar(1000) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `approve` int(255) DEFAULT NULL COMMENT '0: No 1: Approved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_category`
--

CREATE TABLE `ad_category` (
  `id` int(11) NOT NULL,
  `category` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `tags` longtext,
  `file` longtext,
  `date` longtext NOT NULL,
  `time` longtext NOT NULL,
  `privacy` int(255) NOT NULL COMMENT '0: Public 1: Friends 2: User',
  `likes` int(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `type` longtext NOT NULL,
  `type_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `is_child` int(11) DEFAULT '0' COMMENT '0: No 1: Yes',
  `comment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(255) DEFAULT '0',
  `time` longtext NOT NULL,
  `date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `id` int(11) NOT NULL,
  `user_one` int(255) NOT NULL,
  `user_two` int(255) NOT NULL,
  `status` int(255) NOT NULL COMMENT '0: Pending 1: Friend 2: Blocked 3: Following',
  `blocked_by` int(255) DEFAULT NULL,
  `date` longtext NOT NULL,
  `time` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `connection_email`
--

CREATE TABLE `connection_email` (
  `id` int(11) NOT NULL,
  `user_one` int(255) NOT NULL,
  `user_two` int(255) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `csr`
--

CREATE TABLE `csr` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` int(255) NOT NULL COMMENT '0: Review 1: Process 2: 3BL',
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `csr_submission`
--

CREATE TABLE `csr_submission` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `q1` int(255) NOT NULL COMMENT '0: No 1: Yes',
  `q2` int(255) NOT NULL COMMENT '0: No 1: Yes',
  `q3` int(255) NOT NULL COMMENT '0: No 1: Yes',
  `q4` int(255) NOT NULL COMMENT '0: No 1: Yes',
  `q5` int(255) NOT NULL COMMENT '0: No 1: Yes',
  `files` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL,
  `email` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `tags` longtext NOT NULL,
  `banner` longtext,
  `date` longtext NOT NULL,
  `time` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_content`
--

CREATE TABLE `group_content` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `group_id` int(255) NOT NULL,
  `content_type` longtext NOT NULL,
  `title` longtext,
  `description` longtext,
  `tags` longtext,
  `file` longtext,
  `map` longtext,
  `time` longtext NOT NULL,
  `date` longtext NOT NULL,
  `likes` int(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `group_id` int(255) NOT NULL,
  `status` int(255) NOT NULL COMMENT '0: Pending 1: Approved 2: Invited',
  `invited` int(255) DEFAULT NULL COMMENT '0: No 1: Yes',
  `time` longtext NOT NULL,
  `date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `email_id` varchar(1000) NOT NULL,
  `time` longtext NOT NULL,
  `date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_cat_id` int(11) NOT NULL,
  `exp_level` char(30) NOT NULL,
  `employment_type` char(30) NOT NULL,
  `job_title` varchar(150) NOT NULL,
  `job_desc` longtext NOT NULL,
  `job_skills` longtext,
  `job_contact` varchar(20) DEFAULT NULL,
  `job_email` varchar(30) DEFAULT NULL,
  `job_website` varchar(30) DEFAULT NULL,
  `job_img` longtext NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` int(20) NOT NULL,
  `job_country` char(10) NOT NULL,
  `expiry_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_applied`
--

CREATE TABLE `job_applied` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1: Shortlisted',
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` int(11) NOT NULL,
  `job_cat_name` char(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_cv`
--

CREATE TABLE `job_cv` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_post` varchar(1000) DEFAULT NULL,
  `current_company` varchar(1000) DEFAULT NULL,
  `current_location` varchar(1000) DEFAULT NULL,
  `category` varchar(1000) DEFAULT NULL,
  `experience` varchar(1000) DEFAULT NULL,
  `skills` varchar(1000) DEFAULT NULL,
  `job_title` varchar(1000) DEFAULT NULL,
  `level` varchar(1000) DEFAULT NULL,
  `target_country` varchar(1000) DEFAULT NULL,
  `objective` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `monthly_salary` varchar(1000) DEFAULT NULL,
  `last_salary` varchar(1000) DEFAULT NULL,
  `notice` varchar(1000) DEFAULT NULL,
  `age` varchar(1000) DEFAULT NULL,
  `nationality` varchar(1000) DEFAULT NULL,
  `residence_country` varchar(1000) DEFAULT NULL,
  `visa` varchar(1000) DEFAULT NULL,
  `marital` varchar(1000) DEFAULT NULL,
  `dependents` varchar(1000) DEFAULT NULL,
  `licence_country` varchar(1000) DEFAULT NULL,
  `cv` varchar(1000) DEFAULT NULL,
  `propic` varchar(1000) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_cv_education`
--

CREATE TABLE `job_cv_education` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `collage` varchar(1000) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `completion` varchar(1000) NOT NULL,
  `grade` varchar(1000) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_cv_experience`
--

CREATE TABLE `job_cv_experience` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `company` varchar(1000) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `category` varchar(1000) NOT NULL,
  `level` varchar(1000) NOT NULL,
  `responsibilities` varchar(1000) NOT NULL,
  `start` varchar(1000) NOT NULL,
  `end` varchar(1000) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_email`
--

CREATE TABLE `job_email` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_levels`
--

CREATE TABLE `job_levels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(30) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` int(11) NOT NULL,
  `jobtype_name` varchar(30) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `type_id` int(255) NOT NULL,
  `status` int(255) NOT NULL COMMENT '1: Like 2: Dislike',
  `type` longtext NOT NULL,
  `time` longtext NOT NULL,
  `date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `type` int(255) NOT NULL COMMENT '0: General 1: Friends'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer_referral_code`
--

CREATE TABLE `offer_referral_code` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `ref_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer_users`
--

CREATE TABLE `offer_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(1000) NOT NULL,
  `offer_wow` varchar(255) DEFAULT NULL,
  `offer_green` varchar(255) DEFAULT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `user_one` int(255) NOT NULL,
  `user_two` int(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `org_info`
--

CREATE TABLE `org_info` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` longtext NOT NULL,
  `address` longtext,
  `city` longtext,
  `state` longtext,
  `country` longtext NOT NULL,
  `tel` longtext,
  `fax` longtext,
  `website` longtext,
  `about` longtext,
  `job` int(255) DEFAULT '0' COMMENT '0: No 1: Yes',
  `count` int(255) DEFAULT NULL,
  `wall` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` int(255) NOT NULL,
  `txn_id` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments_ccave`
--

CREATE TABLE `payments_ccave` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(20) NOT NULL,
  `billing_email` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments_payu`
--

CREATE TABLE `payments_payu` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `product_info` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `phone` longtext NOT NULL COMMENT '0: Public 1: Friends 2: User',
  `email` longtext NOT NULL COMMENT '0: Public 1: Friends 2: User',
  `address` varchar(255) DEFAULT NULL COMMENT '0: Public 1: Friends 2: User',
  `dob` varchar(255) DEFAULT NULL COMMENT '0: Public 1: Friends 2: User',
  `social` varchar(255) DEFAULT NULL COMMENT '0: Public 1: Friends 2: User',
  `connection` varchar(255) DEFAULT NULL COMMENT '0: Public 1: Friends 2: User',
  `connection_deny` varchar(255) NOT NULL COMMENT '0: No 1: Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `user_id` varchar(1000) NOT NULL,
  `reference_id` varchar(1000) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `id` int(11) NOT NULL,
  `type` int(255) NOT NULL COMMENT '0: Profile Comp 1: Active Free Upgrade 2: Inactive Free 3: Inactive Pre 4: Invitation 5: Flag',
  `time` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seso`
--

CREATE TABLE `seso` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `school` varchar(1000) DEFAULT NULL,
  `class` int(255) DEFAULT NULL,
  `age` int(255) DEFAULT NULL,
  `contact` varchar(1000) DEFAULT NULL,
  `essay_topic` int(255) DEFAULT NULL,
  `drawing_topic` int(255) DEFAULT NULL,
  `essay_title` varchar(1000) DEFAULT NULL,
  `drawing_title` varchar(1000) DEFAULT NULL,
  `essay_content` longtext,
  `drawing_content` longtext,
  `essay_tags` varchar(1000) DEFAULT NULL,
  `drawing_tags` varchar(1000) DEFAULT NULL,
  `essay_banner` varchar(1000) DEFAULT NULL,
  `sketch` varchar(1000) DEFAULT NULL,
  `essay_date` varchar(1000) NOT NULL,
  `drawing_date` varchar(1000) DEFAULT NULL,
  `essay_time` varchar(1000) NOT NULL,
  `drawing_time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `facebook` longtext,
  `linkedin` longtext,
  `twitter` longtext,
  `google_plus` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support_types`
--

CREATE TABLE `support_types` (
  `id` int(11) NOT NULL,
  `support_title` varchar(50) NOT NULL,
  `support_desc` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thoughts`
--

CREATE TABLE `thoughts` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `author` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `content_type` longtext NOT NULL,
  `blog_id` int(255) DEFAULT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `action_id` int(255) DEFAULT NULL,
  `title` longtext,
  `share_title` longtext,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tags` longtext,
  `file` longtext,
  `map` longtext,
  `time` longtext NOT NULL,
  `date` longtext NOT NULL,
  `likes` int(255) DEFAULT '0',
  `privacy` int(255) DEFAULT '0' COMMENT '0: Public 1: Friends 2: User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `action_id` int(255) NOT NULL,
  `action_desc` text,
  `status` int(11) DEFAULT NULL COMMENT '0: Accepted 1: Completed',
  `timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(1000) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_level` int(255) DEFAULT NULL COMMENT '0: Free 1: Paid',
  `type_id` int(11) NOT NULL COMMENT '1: Individuals 2: Associations/Organizations/NGO 3: Company/Corporates',
  `newsletter` tinyint(1) DEFAULT NULL,
  `propic` longtext,
  `status_key` longtext,
  `pwd_key` longtext,
  `is_active` int(11) NOT NULL COMMENT '0: Not active 1: Active 2: Disabled',
  `email_valid` int(255) DEFAULT NULL,
  `is_complete` varchar(255) NOT NULL,
  `reference` varchar(1000) DEFAULT NULL,
  `device_token` longtext,
  `time` longtext NOT NULL,
  `date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `firstname` longtext NOT NULL,
  `lastname` longtext NOT NULL,
  `profession` longtext,
  `address` longtext,
  `city` longtext,
  `state` longtext,
  `country` longtext NOT NULL,
  `about` longtext,
  `hobbies` longtext,
  `gender` int(255) NOT NULL COMMENT '1: Male 2: Female',
  `mobile` varchar(1000) DEFAULT NULL,
  `birthday` varchar(50) DEFAULT NULL,
  `job` int(255) DEFAULT '0' COMMENT '0: No 1: Yes',
  `count` int(255) DEFAULT NULL,
  `wall` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `last_active_date` varchar(255) NOT NULL,
  `last_active_time` varchar(255) NOT NULL,
  `last_active_place` varchar(255) NOT NULL,
  `device` varchar(1000) DEFAULT NULL,
  `active_days` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_selected_category`
--

CREATE TABLE `user_selected_category` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `cat_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads_upgrade`
--
ALTER TABLE `ads_upgrade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adv_blocks`
--
ALTER TABLE `adv_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adv_blocks_booked`
--
ALTER TABLE `adv_blocks_booked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_category`
--
ALTER TABLE `ad_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connection_email`
--
ALTER TABLE `connection_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csr`
--
ALTER TABLE `csr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csr_submission`
--
ALTER TABLE `csr_submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_content`
--
ALTER TABLE `group_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applied`
--
ALTER TABLE `job_applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_cv`
--
ALTER TABLE `job_cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_cv_education`
--
ALTER TABLE `job_cv_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_cv_experience`
--
ALTER TABLE `job_cv_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_email`
--
ALTER TABLE `job_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_levels`
--
ALTER TABLE `job_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_referral_code`
--
ALTER TABLE `offer_referral_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_users`
--
ALTER TABLE `offer_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `org_info`
--
ALTER TABLE `org_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payments_ccave`
--
ALTER TABLE `payments_ccave`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payments_payu`
--
ALTER TABLE `payments_payu`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seso`
--
ALTER TABLE `seso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_types`
--
ALTER TABLE `support_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thoughts`
--
ALTER TABLE `thoughts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_selected_category`
--
ALTER TABLE `user_selected_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ads_upgrade`
--
ALTER TABLE `ads_upgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adv_blocks`
--
ALTER TABLE `adv_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;
--
-- AUTO_INCREMENT for table `adv_blocks_booked`
--
ALTER TABLE `adv_blocks_booked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ad_category`
--
ALTER TABLE `ad_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `connection_email`
--
ALTER TABLE `connection_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `csr`
--
ALTER TABLE `csr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `csr_submission`
--
ALTER TABLE `csr_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `group_content`
--
ALTER TABLE `group_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_applied`
--
ALTER TABLE `job_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `job_cv`
--
ALTER TABLE `job_cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_cv_education`
--
ALTER TABLE `job_cv_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_cv_experience`
--
ALTER TABLE `job_cv_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_email`
--
ALTER TABLE `job_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_levels`
--
ALTER TABLE `job_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `offer_referral_code`
--
ALTER TABLE `offer_referral_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `offer_users`
--
ALTER TABLE `offer_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `org_info`
--
ALTER TABLE `org_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payments_ccave`
--
ALTER TABLE `payments_ccave`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payments_payu`
--
ALTER TABLE `payments_payu`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `seso`
--
ALTER TABLE `seso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `support_types`
--
ALTER TABLE `support_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `thoughts`
--
ALTER TABLE `thoughts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_selected_category`
--
ALTER TABLE `user_selected_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
