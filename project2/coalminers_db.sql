-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2026 at 11:45 AM
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
  `eoi_status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `job_ref`, `first_name`, `last_name`, `dob`, `gender`, `street_address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `other_skills`, `eoi_status`) VALUES
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
  `job_location` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `job_salary` varchar(50) NOT NULL,
  `job_reporting_line` varchar(100) NOT NULL,
  `job_responsibilities` text NOT NULL,
  `job_essential_reqs` text NOT NULL,
  `job_preferable_reqs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_reference_number`, `job_title`, `job_location`, `job_description`, `job_salary`, `job_reporting_line`, `job_responsibilities`, `job_essential_reqs`, `job_preferable_reqs`) VALUES
(1, 'FUENLE', 'Fundraising Engagement Lead', 'Melbourne / Regional', 'We\'re looking for an experienced and enthusiastic Fundraising Engagement Lead to bring our greater community together and support our fundraising efforts. You will play an important role in growing our community engagement, co-ordinating fundraising events and building strong relationships with our volunteers, support groups, sponsors and other stakeholders.', '$90,000 - $100,000', 'Head of Fundraising and Partnerships', '- Leading, coordinating and mentoring volunteers at fundraising events to provide positive experiences for everyone involved\n- Identifying and developing revenue streams and sponsorship opportunities\n- Building rapport with our community, sponsors and stakeholders\n- Representing TCM through outside engagement events\n- Maintaining accurate activity records (eg: petty cash, budgets, invoices, attendance)', '1. 3 years of community engagement and event organisation experience\n2. Strong organisational, communication and interpersonal skills\n3. Demonstrated leadership and stakeholder engagement skills\n4. Ability to work collaboratively\n5. Current Victorian Driver\'s licence and willingness to use your own vehicle\n6. Basic IT Skills - Microsoft Office/Google Suite', '- Experience with non-profit organisations\n- Salesforce experience'),
(2, 'USEXDE', 'User Experience Designer', 'Melbourne (Hybrid)', 'We\'re looking for an experienced and insightful User Experience Designer to join our growing team. It\'s a great opportunity for a designer who is passionate about the intersection between human problems and technology and designing solutions that serve our community.', '$90,000 - $110,000', 'Head of Design', '- Conduct user research, usability testing and experience analysis\n- Create UX artefacts such as user experience journeys, wireframes and prototypes\n- Collaborate with product owners and stakeholders to define features, flows to ensure smooth product delivery.', '1. 3 years of proven UX experience + portfolio\n2. Strong expertise in creating wireframes, prototypes, user flows, and journey mapping\n3. Deep understanding of accessibility standards, digital best practices\n4. Ability to engage in cross team collaborations\n5. Strong communication skills', '- Experience working with in the non-profit space or community support industry\n- Genuine expertise in Figma'),
(3, 'GRADEV', 'Graduate Developer', 'Melbourne (HQ)', 'We\'re looking to cultivate new and burgeoning talent. This is a great opportunity for any enthusiastic computer science graduates who love solving problems and are eager to learn. You\'ll receive mentoring and get exposure to modern development practices while you grow your knowledge and skills.', '$80,000 - $90,000', 'Product Owner', '- Help develop applications and digital services - front end and back end\n- Collaborate with other teams to deliver solutions\n- Write clean, maintainable and well documented code\n- Troubleshoot, debug and fix software bugs', '1. Bachelor\'s Degree in Computer Science (or equivalent)\n2. Knowledge of programming languages and frameworks - Javascript, Python, C++, HTML, CSS\n3. Strong understanding of programming principles and developmental tools\n4. Strong work ethic and positive attitude', '- A portfolio showcasing work you\'re proud of\n- Relational database/SQL knowledge');

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
(4, 4, 'Wussten Sie, dass SkyNet ein echtes Unternehmen ist? Es ist ein chinesisches Überwachungsunternehmen', 'Did you know that SkyNet is an actual company? It is a Chinese surveillance company.');

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
