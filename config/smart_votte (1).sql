-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 12:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_votte`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candidate_id` int(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` varchar(16) NOT NULL,
  `nid` varchar(16) NOT NULL,
  `party` varchar(100) NOT NULL,
  `post` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` enum('inactive','active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidate_id`, `first_name`, `last_name`, `dob`, `nid`, `party`, `post`, `image`, `status`) VALUES
(1, 'Philemon', 'SHIKAMUSENGE', '2024-06-12', '1200080137900043', '234556', 1, 'WIN_20240530_07_51_00_Pro.jpg', 'inactive'),
(2, 'NIYIKIZA', 'LILIANE', '2024-06-04', '1200080137900043', 'FPR', 1, 'IMG-20221219-WA0005.jpg', 'inactive'),
(3, 'NIYOKWIZERWA', 'FABRICE', '2024-06-13', '1200080137900043', 'GREEN', 1, 'FB_IMG_16636119644160178.jpg', 'inactive'),
(4, 'John', 'Doe', '2024-06-13', '1200080137900043', 'TES', 2, 'FB_IMG_16608567289331560.jpg', 'inactive'),
(5, 'KWIZERA', 'ELisa', '2001-06-15', '1200080137900043', 'FPR', 3, 'IMG-20230310-WA0048.jpg', 'inactive'),
(6, 'NAKIRUTIMANA', 'Sabin', '2007-06-27', '1200080137900043', 'FPR', 4, 'IMG-20230428-WA0014.jpg', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `date` varchar(25) NOT NULL,
  `status` enum('onhold','ready','closed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `Description`, `date`, `status`) VALUES
(1, 'Minister in charge of finance', 'Make sure that you were able to retrieve the data from the database, by counting the number of records', '15-12-2024', 'closed'),
(2, 'president', 'asfcvbi;o;', '15-07-2024', 'ready'),
(3, 'HR', 'Human resources Management post', '15-07-2024', 'ready'),
(4, 'MINISTER OF Management', 'Hello Manege', '15-07-2024', 'onhold');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `post` enum('votter','admin') NOT NULL,
  `account_Id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `post`, `account_Id`, `status`) VALUES
(1, 'shikamusenge@test.com', '$2y$10$pf4NMMr6U6olff9iM/wqJ.j3W1yB5sOWBrt3f9AlEFTwfP/k3vV46', 'votter', 1, '1'),
(2, 'shikamusenge@test.com', '123', 'votter', 5, ''),
(3, 'uwacu@test.com', '$2y$10$luwjgodXV5wBkkmtnOjDYOPuWFbO7ZKv1N1Ekg0xy9rRp/tmWzKQy', 'votter', 7, ''),
(4, 'admin@test.com', '$2y$10$4OFqxvgSxY7b1hX1f9shbeCA8SS0Ltq8CyWtrGtWO5MqFstHvIAGu', 'admin', 0, '1'),
(5, 'voter@test.com', '$2y$10$goLvYJK.MSo6upZ6SsELj.iGqfEsswLfYv/a0TZ7sfgMBxU/V6ZXi', 'votter', 8, ''),
(6, 'sabin@test.com', '$2y$10$7zrXX3LtYnZbCuForydhW.5BzQ5z8nRL0J5HuN44p3wwKNpjiNJT.', 'votter', 9, '1');

-- --------------------------------------------------------

--
-- Table structure for table `votter`
--

CREATE TABLE `votter` (
  `votter_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `nid` varchar(16) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `status` enum('rejected','waiting','approved') NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votter`
--

INSERT INTO `votter` (`votter_id`, `first_name`, `last_name`, `dob`, `nid`, `phoneNumber`, `status`) VALUES
(1, 'Muhizi', 'Gadi', '15/12/2000', '1200085666564745', '078354563364', 'approved'),
(2, 'John', 'Doe', '15/12/2000', '1200085666564745', '078354563364', 'rejected'),
(3, 'Philemon', 'SHIKAMUSENGE', '2024-06-13', '1200080137900043', '0784589448', 'waiting'),
(4, 'Philemon', 'SHIKAMUSENGE', '2024-06-13', '1200080137900043', '0784589448', 'waiting'),
(5, 'Philemon', 'SHIKAMUSENGE', '2024-06-13', '1200080137900043', '0784589448', 'waiting'),
(6, 'UWACU', 'Zawadi', '2024-06-28', '1200470137900044', '0784589448', 'waiting'),
(7, 'UWACU', 'Zawadi', '2024-06-28', '1200470137900044', '0784589448', 'waiting'),
(8, 'votter', 'test', '2000-06-17', '1200470137900044', '0784589448', 'waiting'),
(9, 'NAKIRUTIMANA', 'Sabin', '2024-06-28', '1200470137900044', '0784589448', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `vottes`
--

CREATE TABLE `vottes` (
  `vts_id` int(11) NOT NULL,
  `votter` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `candidate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vottes`
--

INSERT INTO `vottes` (`vts_id`, `votter`, `post`, `candidate`) VALUES
(1, 1, 1, 1),
(2, 7, 1, 2),
(3, 9, 2, 4),
(4, 9, 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidate_id`),
  ADD KEY `post` (`post`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `account_Id` (`account_Id`);

--
-- Indexes for table `votter`
--
ALTER TABLE `votter`
  ADD PRIMARY KEY (`votter_id`);

--
-- Indexes for table `vottes`
--
ALTER TABLE `vottes`
  ADD PRIMARY KEY (`vts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidate_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votter`
--
ALTER TABLE `votter`
  MODIFY `votter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vottes`
--
ALTER TABLE `vottes`
  MODIFY `vts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
