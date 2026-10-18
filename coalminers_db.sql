-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2026 at 01:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coalminers_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `contribution_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `contribution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`contribution_id`, `member_id`, `project_id`, `contribution`) VALUES
(1, 1, 1, 'Initial creation of pages'),
(2, 1, 1, 'Navigation & Footer'),
(3, 1, 1, 'Job Listings page'),
(4, 1, 1, 'Assignment Submission'),
(5, 1, 2, 'Task 1: Reuse common UI with PHP includes'),
(6, 1, 2, 'Task 2: Database Settings'),
(7, 1, 2, 'Task 7: Create About tables and update'),
(8, 1, 2, 'Presentation Management'),
(9, 2, 1, 'Apply page and form'),
(10, 2, 1, 'CSS Styling'),
(11, 2, 2, 'Task 5: Jobs table and jobs.php'),
(12, 2, 2, 'Task 6: Login Page for manage.php'),
(13, 2, 2, 'Task 6: Authentication'),
(14, 3, 1, 'About Us page'),
(15, 3, 2, 'Task 3: Expression of Interest table'),
(16, 3, 2, 'Task 4: Add validated records - process_eoi.php'),
(17, 4, 1, 'Home page'),
(18, 4, 1, 'Company Logo'),
(19, 4, 1, 'Company Slogan'),
(20, 4, 2, 'Task 6: HR Manager Queries - manage.php');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_ref` varchar(6) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `job_ref`, `first_name`, `last_name`, `dob`, `gender`, `street_address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `other_skills`, `status`) VALUES
(1, 'GRADEV', 'Alex', 'Nguyen', '2001-05-14', 'male', '12 Smith Street', 'Hawthorn', 'VIC', '3122', 'alex@example.com', '0412345678', 'Smart, Computing, Teamwork', 'Python and SQL', 'New'),
(2, 'USEXDE', 'Priya', 'Sharma', '1995-09-02', 'female', '8 George Road', 'Parramatta', 'NSW', '2150', 'priya@example.com', '0498765432', 'Adaptable, Computing', 'Figma', 'Current'),
(3, 'FUENLE', 'Sam', 'Taylor', '1988-01-23', 'other', '45 Queen Street', 'Brisbane', 'QLD', '4000', 'sam@example.com', '0400111222', 'Leadership, Driving', '', 'Final');

-- --------------------------------------------------------

--
-- Table structure for table `fun_facts`
--

CREATE TABLE `fun_facts` (
  `fact_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `fact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fun_facts`
--

INSERT INTO `fun_facts` (`fact_id`, `member_id`, `fact`) VALUES
(1, 1, 'My favourite TV show is Survivor.'),
(2, 2, 'I enjoy playing chess.'),
(3, 3, 'I can speak 5 languages.'),
(4, 4, 'I like watching robot fighting, especially those leagues in China.');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_reference_number` varchar(7) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` varchar(1000) NOT NULL,
  `job_salary` int(7) NOT NULL,
  `job_requirements` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'Chloe', NULL, 'Young'),
(2, 'Ryan', NULL, 'Fu'),
(3, 'Koktriv', NULL, 'Phu'),
(4, 'Minh', 'Hieu', 'Pham');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`) VALUES
(1, 'Assignment 1'),
(2, 'Assignment 2');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `quote_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `translation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`quote_id`, `member_id`, `quote`, `translation`) VALUES
(1, 1, '花开花落自有时，缘起缘灭无穷尽', 'Just as flowers bloom and wilt, there is no end to fates entwining and unwinding.'),
(2, 2, '千里之行，始於足下', 'A journey of a thousand steps starts beneath one\'s feet.'),
(3, 3, 'កុំចាក់អង្ករ យកអង្កាម', 'Don\'t pour out the rice and keep the husk.'),
(4, 3, 'Wussten Sie, dass SkyNet ein echtes Unternehmen ist? Es ist ein chinesisches Überwachungsunternehmen', 'Did you know that SkyNet is an actual company? It is a Chinese surveillance company.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`) VALUES
('sigma', 'Ph0nk Hub'),
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`contribution_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `fun_facts`
--
ALTER TABLE `fun_facts`
  ADD PRIMARY KEY (`fact_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`quote_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fun_facts`
--
ALTER TABLE `fun_facts`
  MODIFY `fact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `contributions_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `fun_facts`
--
ALTER TABLE `fun_facts`
  ADD CONSTRAINT `fun_facts_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Constraints for table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `quote_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;