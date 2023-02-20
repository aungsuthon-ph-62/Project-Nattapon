-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2023 at 02:14 PM
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
(22, 7596308051, 5),
(23, 7596308051, 6),
(24, 5767355627, 5);

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
(32, 7596308051, 'กรุงเทพมหานคร'),
(33, 7596308051, 'พระนครศรีอยุธยา'),
(34, 5767355627, 'กรุงเทพมหานคร');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` bigint(20) NOT NULL,
  `post_ref` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_by` bigint(20) NOT NULL,
  `comment_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_ref`, `parent_id`, `comment`, `comment_by`, `comment_at`) VALUES
(114, 28, 0, 'dawdwadwadwadawdwadwadwadadwadaw', 14, '2023-02-19 15:25:08'),
(115, 29, 0, 'test', 14, '2023-02-20 16:39:21'),
(116, 29, 0, 'test 23456789', 14, '2023-02-20 16:40:01'),
(117, 29, 0, 'test1231231', 14, '2023-02-20 19:37:35'),
(118, 28, 0, 'dwadwadwadwa', 14, '2023-02-20 19:42:45'),
(119, 28, 0, 'dwadwfaefmemfkadkfkaefmKmfkookefkoefoeowfSfes', 14, '2023-02-20 19:42:52');

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
  `post_view` text DEFAULT NULL,
  `post_rating` bigint(20) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_edit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_tbl`
--

INSERT INTO `post_tbl` (`id`, `post_unid`, `post_topic`, `post_banner`, `post_address`, `provinces_ref`, `faculty_ref`, `post_content`, `post_by`, `post_view`, `post_rating`, `post_date`, `post_edit`) VALUES
(28, 'POST_FPCDE643JX', 'บริษัท แอดเพย์', 'money-63f0d6547528f.png', '627/8 ซอย 9 ตำบล ขามใหญ่ อำเภอเมืองอุบลราชธานี อุบลราชธานี 34000', 7596308051, 7596308051, '<p>dwadawdadadwadadwadawd</p>', 1, NULL, NULL, '2023-02-18', NULL),
(29, 'POST_36UHAXVRMG', 'Honda Thailand', 'honda_civic_type_R_002-63f25ae4ede3e.jpg', 'Honda Thailand', 5767355627, 5767355627, '<p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">เป็นการเฉลิมฉลองครบรอบ&nbsp;30&nbsp;ปีของรถตระกูล TYPE-R นับตั้งแต่เปิดตัวเอ็น NSX TYPE-R ในปี&nbsp;1992&nbsp;สำหรับรถรุ่นCivic TYPE-R ที่เริ่มเปิดตัวครั้งแรกในปี&nbsp;1997&nbsp;ก็นับเป็นเวลาครบ&nbsp;25&nbsp;ปีพอดี ในขณะที่ฮอนด้าเพิ่งจะฉลองครบรอบ&nbsp;50&nbsp;ปีของรถตระกูลCivic นี้ไปเมื่อวันที่&nbsp;12 กรกฎาคม 2022 ที่ผ่านมา</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">และที่สำคัญฮอนด้า Civic TYPE-R รหัสตัวถัง FL5 คันนี้จะเป็นรถตระกูล TYPE-R ที่ใช้เครื่องยนต์สันดาปภายในรุ่นสุดท้ายก่อนที่จะหันไปพ่วงระบบขับเคลื่อนด้วยไฟฟ้าในรูปแบบ e:HEV หรือ EV ในรุ่นต่อๆไป</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">แต่ทว่าการเปิดตัวอย่างเป็นทางการครั้งนี้ทางฮอนด้าเองก็ยังไม่เผยรายละเอียดเรื่องข้อมูลเชิงเทคนิค ไม่ว่าจะเป็นตัวเลขแรงม้าแรงบิดของเครื่องยนต์ หรือข้อมูลเรื่องช่วงล่าง ระบบส่งกำลัง เพียงแต่โชว์จุดเด่นและปล่อยภาพภายนอกภายในรอบคันให้เห็นกันเสียก่อนที่จะมีการวางจำหน่ายอย่างเป็นทางการในเดือนกันยายน</p><p style=\"margin-right: auto; margin-bottom: 26px; margin-left: auto; font-family: Kanit; overflow-wrap: break-word; font-size: 17px; color: rgb(34, 34, 34); line-height: 1.5 !important;\"><img class=\"alignnone size-full wp-image-187580\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-05.jpg\" alt=\"\" width=\"900\" height=\"476\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-05.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-05-300x159.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-05-768x406.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</span><img loading=\"lazy\" class=\"alignnone size-full wp-image-187581\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-06.jpg\" alt=\"\" width=\"900\" height=\"504\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-06.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-06-300x168.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-06-768x430.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</span><img loading=\"lazy\" class=\"alignnone size-full wp-image-187582\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-07.jpg\" alt=\"\" width=\"900\" height=\"526\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-07.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-07-300x175.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-07-768x449.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"></span></p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">หากพิจารณาเส้นสายภายนอกโดยเฉพาะด้านหน้า ที่ส่งต่องานออกแบบสายคลีนมาจาก Civic Hatchback เจนเนอเรชั่นที่&nbsp;11&nbsp;ซึ่งน่าเสียดายสำหรับประเทศไทยนั้นไม่ได้มีโอกาสสัมผัสฮอนด้า Civic Hatchback อีกต่อไป โดยความลงตัวของรุ่นนี้เห็นได้จากด้านท้ายมาในแนวรถ Fastback ท้ายลาด ซึ่งในรุ่น TYPE-R ได้มีการเปลี่ยนชิ้นส่วนตัวถังภายนอกเพื่อรองรับล้อและยางที่มีขนาดกว้างขึ้นกว่ารุ่นปกติ</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">สปอยเลอร์หลังทรง GT-Wing ทำจากวัสดุคาร์บอนไฟเบอร์น้ำหนักเบา ทำให้ตัวรถมีความดุดันแบบกำลังดี ซึ่งฮอนด้าได้รับแรงบันดาลใจจากสปอยเลอร์หลังของ&nbsp;S2000&nbsp;รุ่นสุดท้าย&nbsp;Type-S&nbsp;ปี&nbsp;2007</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">ช่องรับลมทุกช่องสามารถใช้งานได้จริง เพื่อปรับสมดุลของกระแสลมที่ไหลผ่านตัวรถทั้งคัน</p><p style=\"margin-right: auto; margin-bottom: 26px; margin-left: auto; font-family: Kanit; overflow-wrap: break-word; font-size: 17px; color: rgb(34, 34, 34); line-height: 1.5 !important;\"><img loading=\"lazy\" class=\"alignnone size-full wp-image-187584\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-04.jpg\" alt=\"\" width=\"900\" height=\"636\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-04.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-04-300x212.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Civic-Type-R-FL5-04-768x543.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</span><img loading=\"lazy\" class=\"alignnone size-full wp-image-187570\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_02-1.jpg\" alt=\"\" width=\"900\" height=\"674\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_02-1.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_02-1-300x225.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_02-1-768x575.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><img loading=\"lazy\" class=\"alignnone size-full wp-image-187536\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_03.jpg\" alt=\"\" width=\"900\" height=\"600\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_03.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_03-300x200.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_03-768x512.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</span><img loading=\"lazy\" class=\"alignnone size-full wp-image-187537\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_04.jpg\" alt=\"\" width=\"900\" height=\"600\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_04.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_04-300x200.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_04-768x512.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</span><img loading=\"lazy\" class=\"alignnone size-full wp-image-187538\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_05.jpg\" alt=\"\" width=\"900\" height=\"600\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_05.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_05-300x200.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Ext_EU-JDM_05-768x512.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"></span></p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">&nbsp;</p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\">ล้ออัลลอยเปลี่ยนจากขนาด 20 นิ้ว เป็น 19 นิ้ว สีดำด้าน รัดด้วยยาง Michelin Pilot Sport 4S ขนาด 265/30 ZR19 ซึ่งวิศวกรเคลมว่าล้อขนาด 19 นิ้ว จะหายางสมรรถนะสูงได้ง่ายกว่า และเป็นการลดน้ำหนัก Unsprung weight ไปในตัว</p><p style=\"margin-right: auto; margin-bottom: 26px; margin-left: auto; font-family: Kanit; overflow-wrap: break-word; font-size: 17px; color: rgb(34, 34, 34); line-height: 1.5 !important;\"><img loading=\"lazy\" class=\"alignnone size-full wp-image-187540\" src=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Int_JDM.jpg\" alt=\"\" width=\"900\" height=\"403\" srcset=\"https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Int_JDM.jpg 900w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Int_JDM-300x134.jpg 300w, https://www.headlightmag.com/hlmwp/wp-content/uploads/2022/07/Honda-Civic-TYPE-R_Int_JDM-768x344.jpg 768w\" sizes=\"(max-width: 900px) 100vw, 900px\" style=\"height: auto; max-width: 100%; border: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"></span></p><p style=\"overflow-wrap: break-word; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; width: 600px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; background-color: rgb(223, 223, 223);\"><span style=\"color: rgb(153, 153, 153);\"><em>(ภายในเวอร์ชั่นญี่ปุ่น)</em></span></p>', 1, NULL, NULL, '2023-02-20', NULL);

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
(14, 'อังศุธร', 'โพธิ์สุ', '2131321421412321312', 'test@test.com', '$2y$10$eFhCvmMt2qrm9LWKchqh6uER8AYaSW91cVYJ4qlxN3Aklhaf488ja', 'worker-63e29b2a0a071.png', 'Member', '2023-02-07 00:00:00');

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
  MODIFY `cf_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category_provinces`
--
ALTER TABLE `category_provinces`
  MODIFY `cp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_tbl`
--
ALTER TABLE `post_tbl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
