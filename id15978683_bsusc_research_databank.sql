-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2021 at 01:46 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15978683_bsusc_research_databank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(20) NOT NULL,
  `admin_fname` varchar(255) NOT NULL,
  `admin_lname` varchar(255) NOT NULL,
  `admin_mi` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_rpassword` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_fname`, `admin_lname`, `admin_mi`, `admin_username`, `admin_password`, `admin_rpassword`) VALUES
(22, 'Iraj', 'Cruz', 'B', 'admin_iraj', '5f4dcc3b5aa765d61d8327deb882cf99', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 'Jari', 'Cruz', 'B', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `professor_table`
--

CREATE TABLE `professor_table` (
  `professor_id` int(11) NOT NULL,
  `professor_fname` varchar(255) NOT NULL,
  `professor_lname` varchar(255) NOT NULL,
  `professor_mi` varchar(255) NOT NULL,
  `professor_department` varchar(255) NOT NULL,
  `professor_username` varchar(255) NOT NULL,
  `professor_password` varchar(255) NOT NULL,
  `professor_retype_password` varchar(255) NOT NULL,
  `professor_address` varchar(255) NOT NULL,
  `professor_id_front` varchar(255) NOT NULL,
  `professor_id_back` varchar(255) NOT NULL,
  `professor_account_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `researchstudy_table`
--

CREATE TABLE `researchstudy_table` (
  `RS_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Abstract` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Author` varchar(255) NOT NULL,
  `File` varchar(255) NOT NULL,
  `Year` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Keywords` varchar(255) NOT NULL,
  `Adviser` varchar(255) NOT NULL,
  `Views` int(11) NOT NULL DEFAULT 0,
  `Downloads` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `researchstudy_table`
--

INSERT INTO `researchstudy_table` (`RS_ID`, `Title`, `Abstract`, `Author`, `File`, `Year`, `Course`, `Keywords`, `Adviser`, `Views`, `Downloads`) VALUES
(62, 'Mushoku Tensei LN Vol 2', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_2.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 0, 0),
(61, 'Mushoku Tensei LN Vol 1', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_1.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 59, 32),
(63, 'Mushoku Tensei LN Vol 3', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_3.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 0, 0),
(64, 'Mushoku Tensei LN Vol 4', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_4.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 0, 0),
(65, 'Mushoku Tensei LN Vol 5', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_5.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 0, 0),
(66, 'Mushoku Tensei LN Vol 6', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_6.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 1, 0),
(67, 'Mushoku Tensei LN Vol 7', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_7.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 2, 0),
(68, 'Mushoku Tensei LN Vol 8', 'Mushoku Tensei: Isekai Ittara Honki Dasu (無職転生 〜異世界行ったら本気だす〜, literally “Jobless Reincarnation: I Will Seriously Try If I Go To Another World”), is a Japanese web novel series by Rifujin na Magonote[Jp. 1] and is published on internet web novel website Shōsetsuka ni Narō (Shortened to Syosetu) about a jobless, hopeless man who dies in an accident and reincarnates in a fantasy world, this time determined to have a bountiful and earnest life.', 'Rifujin na Magonote', 'Mushoku_Tensei_LN_Vol_8.pdf', '4th year', 'educ', 'Mushoku', 'Magonote', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sample_data`
--

CREATE TABLE `sample_data` (
  `Fname` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Mobilenum` varchar(255) NOT NULL,
  `Comp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `student_id` int(11) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `student_mi` varchar(255) NOT NULL,
  `student_username` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `student_retype_password` varchar(255) NOT NULL,
  `alumnus` varchar(255) NOT NULL DEFAULT 'no',
  `student_year_level` varchar(255) NOT NULL,
  `student_course` varchar(255) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_id_front` varchar(255) NOT NULL,
  `student_id_back` varchar(255) NOT NULL,
  `student_account_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`student_id`, `student_fname`, `student_lname`, `student_mi`, `student_username`, `student_password`, `student_retype_password`, `alumnus`, `student_year_level`, `student_course`, `student_address`, `student_id_front`, `student_id_back`, `student_account_status`) VALUES
(47, 'Jari', 'Cruz', 'B.', 'jari_cruz', '5f4dcc3b5aa765d61d8327deb882cf99', '5f4dcc3b5aa765d61d8327deb882cf99', 'no', '4th year', 'bsit', 'Bulacan', 'Cruz_Jari_B._front_id.jpg', 'Cruz_Jari_B._back_id.jpg', 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `professor_table`
--
ALTER TABLE `professor_table`
  ADD PRIMARY KEY (`professor_id`);

--
-- Indexes for table `researchstudy_table`
--
ALTER TABLE `researchstudy_table`
  ADD PRIMARY KEY (`RS_ID`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `professor_table`
--
ALTER TABLE `professor_table`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `researchstudy_table`
--
ALTER TABLE `researchstudy_table`
  MODIFY `RS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
