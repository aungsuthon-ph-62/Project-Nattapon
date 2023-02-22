-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2023 at 02:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_faculty`
--

CREATE TABLE `category_faculty` (
  `cf_id` bigint(20) NOT NULL,
  `cf_postref` bigint(20) NOT NULL,
  `cf_name` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_faculty`
--

INSERT INTO `category_faculty` (`cf_id`, `cf_postref`, `cf_name`) VALUES
(25, 5152946604, 5),
(26, 5152946604, 6),
(28, 9927559699, 5);

-- --------------------------------------------------------

--
-- Table structure for table `category_provinces`
--

CREATE TABLE `category_provinces` (
  `cp_id` bigint(20) NOT NULL,
  `cp_postref` bigint(20) NOT NULL,
  `cp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_provinces`
--

INSERT INTO `category_provinces` (`cp_id`, `cp_postref`, `cp_name`) VALUES
(35, 5152946604, 'กรุงเทพมหานคร'),
(36, 5152946604, 'อุบลราชธานี'),
(38, 9927559699, 'อุบลราชธานี');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` bigint(20) NOT NULL,
  `post_ref` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_rating` bigint(20) NOT NULL,
  `comment_by` bigint(20) NOT NULL,
  `comment_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_ref`, `parent_id`, `comment`, `user_rating`, `comment_by`, `comment_at`) VALUES
(146, 30, 0, '', 0, 14, '2023-02-21 16:33:57'),
(147, 30, 0, '', 0, 14, '2023-02-21 16:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` bigint(20) NOT NULL,
  `faculty_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_name`) VALUES
(1, 'วิทยาศาสตร์'),
(5, 'เทคโนโลยีสารสนเทศ'),
(6, 'วิทยาการคอมพิวเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `post_tbl`
--

CREATE TABLE `post_tbl` (
  `id` bigint(20) NOT NULL,
  `post_unid` varchar(255) NOT NULL,
  `post_topic` varchar(255) NOT NULL,
  `post_banner` varchar(255) NOT NULL,
  `post_address` varchar(255) NOT NULL,
  `provinces_ref` bigint(20) NOT NULL,
  `faculty_ref` bigint(20) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_by` bigint(20) NOT NULL,
  `post_view` bigint(20) NOT NULL,
  `post_rating` bigint(20) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_edit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_tbl`
--

INSERT INTO `post_tbl` (`id`, `post_unid`, `post_topic`, `post_banner`, `post_address`, `provinces_ref`, `faculty_ref`, `post_content`, `post_by`, `post_view`, `post_rating`, `post_date`, `post_edit`) VALUES
(30, 'POST_TOBCUSZNEK', 'บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด', 'unnamed-63f3fa4e9c637.jpg', '627/8 ซอย 9 ตำบล ขามใหญ่ อำเภอเมืองอุบลราชธานี อุบลราชธานี 34000', 5152946604, 5152946604, '<h2 style=\"font-family: kanit; font-weight: 600; line-height: 1.1; color: rgb(78, 78, 78); margin-bottom: 20px; font-size: 36px; padding-top: 30px; text-align: center;\">เราจะก้าวไปพร้อมกัน</h2><p><img src=\"https://www.addpay.co.th/images/addpay.jpg\" class=\"img-responsive img-rounded center-block\" alt=\"\" style=\"border: 0px; display: block; height: auto; max-width: 100%; border-radius: 6px; margin-right: auto; margin-left: auto; color: rgb(78, 78, 78); font-family: kanit; font-size: 14px; text-align: center;\"></p>', 1, 291, NULL, '2023-02-21', NULL),
(32, 'POST_AEQL6N7UKR', 'บริษัท อีวานเดอร์ จำกัด', 'maxresdefault (1)-63f3fb16d5735.jpg', 'ตำบล ขามใหญ่ อำเภอเมืองอุบลราชธานี อุบลราชธานี 34000', 9927559699, 9927559699, 'test', 1, 6, NULL, '2023-02-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `post_ref` bigint(20) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `post_ref`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(19, 30, 'Aungsuthon Phosu', 5, 'test\n', 1676969521);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `std_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img_user` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `std_no`, `email`, `pass`, `img_user`, `status`, `reg_date`) VALUES
(1, 'Aungsuthon', 'Phosu', '62114340410', 'aungsuthon.ph.62@ubu.ac.th', '$2y$10$T1dNq9w.WKww4Nb90c8iPuGDdkI15V7.oT.sKkbYKTcIQbRhtqXp6', 'Aungsuthon-63ef3cc1e7a60.jpg', 'Admin', '2023-02-06 23:10:16'),
(14, 'อังศุธร', 'โพธิ์สุ', '62114340410', 'test@test.com', '$2y$10$oMTp0IaF9JOcj4.27NtTiOhpxJXK1beDAV.CHRpgrUnRozyNUMHU2', 'hq5MAPUc_400x400-63f3b1e38869f.jpg', 'Member', '2023-02-07 00:00:00'),
(15, 'test', 'test', 'test123@test.com', 'test123@test.com', '$2y$12$H2hpA62PM9yo9rv2R762y.tcdL.ElXuGU/G3IorxTwhcjCUaeevvS', '', 'Member', '2023-02-21 02:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `view_counter`
--

CREATE TABLE `view_counter` (
  `id` bigint(20) NOT NULL,
  `ip_address` text NOT NULL,
  `visit_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_faculty`
--
ALTER TABLE `category_faculty`
  ADD PRIMARY KEY (`cf_id`),
  ADD KEY `facRef` (`cf_name`),
  ADD KEY `postRef` (`cf_postref`);

--
-- Indexes for table `category_provinces`
--
ALTER TABLE `category_provinces`
  ADD PRIMARY KEY (`cp_id`),
  ADD KEY `postRef` (`cp_postref`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `postRef` (`post_ref`),
  ADD KEY `commentBy` (`comment_by`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tbl`
--
ALTER TABLE `post_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_ref` (`provinces_ref`),
  ADD KEY `faculty_ref` (`faculty_ref`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `view_counter`
--
ALTER TABLE `view_counter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_faculty`
--
ALTER TABLE `category_faculty`
  MODIFY `cf_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `category_provinces`
--
ALTER TABLE `category_provinces`
  MODIFY `cp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_tbl`
--
ALTER TABLE `post_tbl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `view_counter`
--
ALTER TABLE `view_counter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_faculty`
--
ALTER TABLE `category_faculty`
  ADD CONSTRAINT `category_faculty_ibfk_3` FOREIGN KEY (`cf_name`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `category_faculty_ibfk_4` FOREIGN KEY (`cf_postref`) REFERENCES `post_tbl` (`faculty_ref`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_provinces`
--
ALTER TABLE `category_provinces`
  ADD CONSTRAINT `category_provinces_ibfk_1` FOREIGN KEY (`cp_postref`) REFERENCES `post_tbl` (`provinces_ref`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_ref`) REFERENCES `post_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comment_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tbl`
--
ALTER TABLE `post_tbl`
  ADD CONSTRAINT `post_tbl_ibfk_1` FOREIGN KEY (`post_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
