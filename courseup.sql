-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 08:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courseup`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL COMMENT 'FK to Course Id',
  `learner_id` int(11) NOT NULL COMMENT 'FK to Learner Id',
  `tutor_id` int(11) NOT NULL COMMENT 'FK to Tutor Id',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`id`, `course_id`, `learner_id`, `tutor_id`, `applied_at`) VALUES
(2, 1, 4, 12, '2023-04-23 13:14:06'),
(3, 7, 4, 12, '2023-04-27 13:29:40'),
(4, 2, 0, 1, '2023-04-30 08:33:47'),
(5, 1, 4, 12, '2023-04-30 08:36:15'),
(6, 7, 5, 9, '2023-04-30 08:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Web Development'),
(2, 'Business Analysis'),
(3, 'Android Development'),
(4, 'Personality Development'),
(5, 'Marketing'),
(6, 'Data Analysis & Science');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'FK to Category.id',
  `tutor_id` int(11) NOT NULL COMMENT 'FK to Tutor.id',
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `category_id`, `tutor_id`, `name`, `description`, `price`, `image`, `active`) VALUES
(1, 4, 12, 'jhjhj', 'bnbn', 'Rs. 8787', '../thumbnail/Data Flow Diagram1.png', 1),
(2, 4, 1, 'jhjhj', 'bnbn', 'Rs. 8787', 'screencapture-pmms-gtu-ac-in-Student-StudentActivity-TeamProfile-2022-06-30-19_37_15.png', 1),
(3, 4, 1, 'jhjhj', 'bnbn', 'Rs. 8787', 'screencapture-pmms-gtu-ac-in-Student-StudentActivity-TeamProfile-2022-06-30-19_37_15.png', 1),
(4, 4, 1, 'jhjhj', 'bnbn', 'Rs. 8787', 'screencapture-pmms-gtu-ac-in-Student-StudentActivity-TeamProfile-2022-06-30-19_37_15.png', 1),
(5, 4, 1, 'jhjhj', 'bnbn', 'Rs. 8787', 'screencapture-pmms-gtu-ac-in-Student-StudentActivity-TeamProfile-2022-06-30-19_37_15.png', 1),
(6, 3, 9, 'TEST2', 'NBNBN', 'Rs. 9898989', '../thumbnail/Data Flow Diagram1.png', 1),
(7, 1, 12, 'hhhhhh', 'nbhnj', 'Rs. 9999', '../thumbnail/Data Flow Diagram1.png', 0),
(8, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(9, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(10, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(11, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(12, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(13, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(14, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(15, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(16, 1, 9, 'TEST', 'nbhnj', 'Rs. 9999999999999', '../thumbnail/Data Flow Diagram1.png', 1),
(17, 4, 9, 'test', 'ffgfg', 'Rs. 888', '../thumbnail/Screenshot (552).png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL COMMENT 'FK to course.id',
  `learner_id` int(11) NOT NULL COMMENT 'FK to learner.id',
  `review` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `course_id`, `learner_id`, `review`) VALUES
(1, 1, 4, 'Very good');

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

CREATE TABLE `learner` (
  `id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL COMMENT 'FK to User.id',
  `name` varchar(50) NOT NULL,
  `contact_no` varchar(17) DEFAULT NULL,
  `interest` text DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`id`, `usr_id`, `name`, `contact_no`, `interest`, `image`) VALUES
(1, 0, 'Helly Prajapati', '(+91) 888888888', 'jQuery', 'profile_pic/Mine-Icon.jpg'),
(2, 0, 'Helly Prajapati', '(+91) 706919211', 'Array', 'profile_pic/Northen.jpg'),
(3, 0, 'Helly Prajapati', '(+91) 706919211', '[\"jQuery\",\"WordPress\"]', 'profile_pic/Mine-Icon.jpg'),
(4, 43, 'Helly Prajapati', '(+91) 706919211', '[\"Design\",\"HTML5\",\"jQuery\"]', 'profile_pic/Letterhead.png'),
(5, 43, 'Helly Prajapati', '(+91) 9428025116', '[\"HTML5\",\"Bootstrap\"]', 'profile_pic/Certi.png');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL COMMENT 'FK to Course.id',
  `name` varchar(50) NOT NULL,
  `duration` varchar(5) NOT NULL,
  `content` text NOT NULL,
  `documents` text NOT NULL,
  `reference` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `name`, `duration`, `content`, `documents`, `reference`) VALUES
(18, 1, 'bnbn', '23:00', '<p>Some applications need to handle all data on the client side, sending it to the server using their specific methods. This is what usually happens in&nbsp;<a href=\"https://ckeditor.com/docs/ckeditor4/latest/guide/dev_inline.html\">inline editing</a>&nbsp;&mdash; with the possibility to&nbsp;<a href=\"https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR.html#method-inline\">create</a>&nbsp;and&nbsp;<a href=\"https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-destroy\">destroy</a>&nbsp;CKEditor 4 instances dynamically, CKEditor 4 is a perfect match for Ajax applications. If this is the case, it is enough to use the JavaScript API mettrieve the editor instance data.</p>', '', 'nbnb'),
(19, 2, 'nbnb', '', '', '', 'nb'),
(20, 6, '1', '23:00', '', '', 'https://stackoverflow.com/questions/14090129/input-type-file-not-getting-image'),
(21, 7, '1', '01:00', '', '', 'kjkmjk,'),
(22, 17, 'hjhjh', '01:00', '<p>Some applications need to handle all data on the client side, sending it to the server using their specific methods. This is what usually happens in&nbsp;<a href=\"https://ckeditor.com/docs/ckeditor4/latest/guide/dev_inline.html\">inline editing</a>&nbsp;&mdash; with the possibility to&nbsp;<a href=\"https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR.html#method-inline\">create</a>&nbsp;and&nbsp;<a href=\"https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-destroy\">destroy</a>&nbsp;CKEditor 4 instances dynamically, CKEditor 4 is a perfect match for Ajax applications. If this is the case, it is enough to use the JavaScript API methods to easily retrieve the editor instance data.</p>\r\n', '', 'jhjh'),
(23, 17, 'hghfhh', '00:00', '', '', 'vhv'),
(24, 17, 'hgh', '09:08', '<p>ghghghghghg</p>\r\n', '', '76676767676');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL COMMENT 'FK to Learner Id',
  `usr_email` text NOT NULL,
  `course_id` int(11) NOT NULL COMMENT 'FK to Course Id',
  `amount` int(16) NOT NULL,
  `status` enum('success','failure','','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `usr_id`, `usr_email`, `course_id`, `amount`, `status`, `created_at`) VALUES
(3, 4, 'hbprajapati54@gmail.com', 1, 8787, 'success', '2023-04-23 13:14:06'),
(4, 4, 'hbprajapati54@gmail.com', 1, 8787, 'success', '2023-04-23 13:29:40'),
(5, 0, 'hbprajapati54@gmail.com', 2, 8787, 'success', '2023-04-30 08:33:47'),
(6, 4, 'hbprajapati54@gmail.com', 1, 8787, 'success', '2023-04-30 08:36:15'),
(7, 4, 'hbprajapati54@gmail.com', 7, 9999, 'success', '2023-04-30 08:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL COMMENT 'FK to user.id',
  `name` varchar(50) NOT NULL,
  `contact_no` varchar(17) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`id`, `usr_id`, `name`, `contact_no`, `about`, `image`) VALUES
(12, 43, 'Helly Prajapati', '(+91) 7069192119', 'kjkmk', 'profile_pic/Use Case Diagram.png'),
(13, 36, 'Helly Prajapati', '(+91) 706919211', 'ghghghgh', 'profile_pic/Roll No Format.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `token` varchar(20) NOT NULL,
  `selector` enum('learner','tutor','','') NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `token`, `selector`, `active`) VALUES
(36, 'helly@gmail.com', 'ceb6c970658f31504a901b89dcd3e461', '9cecaaae9faabbfe435a', 'tutor', 1),
(37, 'helly2@gmail.com', 'ceb6c970658f31504a901b89dcd3e461', 'e90c3366bda1afcd9d8c', 'learner', 1),
(43, 'hbprajapati54@gmail.com', '', '', 'tutor', 1),
(45, 'xyz@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'cabe1cda8d0bc4f96f94', 'learner', 1),
(46, 'hellyprajapati@gmail.com', '25d55ad283aa400af464c76d713c07ad', '65031a4b182996434f62', 'tutor', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learner`
--
ALTER TABLE `learner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applied`
--
ALTER TABLE `applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `learner`
--
ALTER TABLE `learner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
