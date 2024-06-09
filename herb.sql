-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2018 at 06:08 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `herb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `u_id` int(3) NOT NULL,
  `u_fullname` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`u_id`, `u_fullname`, `u_email`, `u_pass`) VALUES
(2, 'Admin', 'admin@mail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `ds_id` int(4) NOT NULL,
  `ds_name` varchar(255) NOT NULL,
  `ds_first_que` int(5) NOT NULL,
  `ds_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`ds_id`, `ds_name`, `ds_first_que`, `ds_detail`) VALUES
(7, 'อาการ : ปวดที่ต้นคอและบ่า', 0, 'มีอาการปวดเกร็งจนอาจหันคอ ก้ม หรือเงยไม่ได้ก็มี...ที่อาการเบาหน่อยก็อาจจะแค่ปวดคอ บ่า ไหล่ และบริเวณสะบักหลัง'),
(8, 'อาการ : ปวดหลัง', 0, 'มีอาการปวดตึงกล้ามเนื้อตั้งแต่คอ บ่า จนถึงไหล่ และร้าวลงไปที่แขน จนเป็นเหตุให้ยกแขนไม่ขึ้น เนื่องจากว่ามีพังผืดมาเกาะที่บริเวณสะบักและหัวไหล่นั่นเอง\r\n\r\n'),
(9, 'อาการ : ยกแขนไม่ขึ้น', 0, 'เกิดจากการที่เรานั่งทำงานติดต่อกันนานๆ หรืองานที่ต้องยืนนานๆ การยกของหนักเป็นประจำหรือการออกกำลังกายหักโหมเกินไปก็เป็นสาเหตุให้ปวดหลังได้เช่นกัน'),
(10, 'อาการ : ปวดตึงที่ขา', 0, 'เกิดจากการนั่ง เดิน หรือยืนนานๆ จนทำให้ปวดตึงกล้ามเนื้อและเส้นเอ็นทั่วทั้งขา'),
(11, 'อาการ : ปวดศีรษะ', 0, 'เกิดความเครียดสะสมโดยไม่รู้ตัว จนทำให้เกิดอาการปวดศีรษะได้');

-- --------------------------------------------------------

--
-- Table structure for table `herbs`
--

CREATE TABLE `herbs` (
  `h_id` int(5) NOT NULL,
  `h_name` varchar(255) NOT NULL,
  `h_nickname` varchar(255) NOT NULL,
  `h_benefit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `herbs`
--

INSERT INTO `herbs` (`h_id`, `h_name`, `h_nickname`, `h_benefit`) VALUES
(3, 'name', 'nickname', 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `st_id` int(4) NOT NULL,
  `st_title` text NOT NULL,
  `st_n` int(4) NOT NULL,
  `st_y` int(4) NOT NULL,
  `st_isAns` tinyint(1) NOT NULL,
  `ds_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`st_id`, `st_title`, `st_n`, `st_y`, `st_isAns`, `ds_id`) VALUES
(10, 'ปวดตามข้อเข่า/ข้อนิ้วมือ หรือข้ออื่นๆร่วมด้วย', 9, 8, 0, 3),
(11, 'พบในคนอายุมากกว่า 60 ปี', 9, 10, 0, 3),
(13, 'ปวดหลังนานเกิน 3 เดือนในคนอายุน้อยกว่า30ปี หรือปวดหลัง หลังแข็นก่อนตื่นนอน ตอนเช้าและทุเลาหลังบริการร่างกาย เป็นนานเกิน 3 เดือน', 11, 12, 0, 3),
(14, 'ปวดกล้ามเนื่อหลีง -ยาแก้ปวด -ยาคล้ายกล้ามเนื้อ -...', 0, 0, 1, 3),
(15, 'ปวดมากเวลายกของหนัก หลังเล่นกีฬา นั่งนานๆ ยืนนานๆ ใส่รองเท้าส้นสูง หรือ เวลาตื่นนอน (นอนที่นอนนุ่นไป)', 13, 14, 0, 3),
(16, 'สาเหตุจากน้ำหนักมาก -ยาแก้ปวด -พยายามสดน้ำหนัก', 0, 0, 1, 3),
(17, 'รูปร่างอ้วน', 15, 16, 0, 3),
(18, 'สาเหตุจากการตั้งครรภ์ -ไม่ต้องทำอะไร', 0, 0, 1, 3),
(19, 'ตั้งครรภ์นานกว่า 4 เดือน', 17, 18, 0, 3),
(20, 'ปวดตรงกลางหลังส่วนล่าง (บริเวณกระเบนเหน็บ)', 13, 19, 0, 3),
(21, 'ปวดท้อง ท้องเดิน ดีซ่าน หรือ ขัดเบา', 20, 0, 0, 3),
(22, 'นิ่วไต +ภายใน 1 สัปดาห์', 0, 0, 1, 3),
(23, 'ปัสสาวะขุ่นแดง หรือเป็นเม็ดทราย', 21, 22, 0, 3),
(24, 'หมอนรองกระดูกสันหลังเคลื่อน/ข้อกระดูกสันหลับตีบ/รากประสาทถูกกด +ภายใน 1 สัปดาห์', 0, 0, 1, 3),
(25, 'ปวดร้าว เสียวๆแปลบๆ หรือรู้สึกชาลงมาตามด้านหลังของขา', 23, 24, 0, 3),
(26, '-ยาแก้ปวด -ยาคลายกล้ามเนื่อ +ถ้าไม่ดีขึ้นใน1 สัปดาห์ หรือปัสสาวะแดง/ปวดร้าวลงชา', 0, 0, 1, 3),
(27, 'ไขสันหลังได้รับบาดเจ็บ + ด่วน', 0, 0, 1, 3),
(28, 'แขนขาชา หรือ เป็นอัมพาต', 26, 27, 0, 3),
(29, 'อาการเกิดหลังได้รับบาดเจ็บ', 25, 28, 0, 3),
(30, 'รักษาตามอาการ (พักผ่อน เช็ดตัว) +ถ้ามีไขเกิน 4 วัน...', 0, 0, 1, 3),
(31, 'ไข้หวัดใหญ่ -... +...', 0, 0, 1, 3),
(32, 'ปวดเมื่อยตามตัวมาก หรือ มีน้ำมูกไหล', 30, 31, 0, 3),
(33, '+ภายใน 3 วัน เพื่อตรวจสาเหตุ', 0, 0, 1, 3),
(34, 'มีไข้เกิน 7 วัน', 32, 33, 0, 3),
(35, 'กรวยไตอักเสบเฉียบพลัน -ช้นสูตรเพิ่มเติม... +ถ้าไม่ดีขึ้นใน 3 วัน ...', 0, 0, 1, 3),
(36, 'เคาะเจ็บที่สี่ข้าง และ ปัสสาวะขุ่น', 34, 35, 0, 3),
(37, 'ปวดท้องร่วมกับมีไข้', 0, 0, 1, 3),
(38, 'ปวดท้องรุนแรง', 36, 37, 0, 3),
(39, 'มีไข้', 29, 38, 0, 3),
(40, '+ภายใน 1 สัปดาห์ อาจเป็น มะเร็งตับอ่อน/มะเร็งกระดูกสันหลัง', 0, 0, 1, 3),
(41, 'น้ำหนักลดฮวบ', 39, 40, 0, 3),
(42, '*ด่วน อาจเป็นกล้ามเนื้อหัวใจตาย (96) /ภาวะเลือดเชาะ...', 0, 0, 1, 3),
(43, 'ปวดหลังส่วนบนรุนแรง เจ็บหน้าอกรุนแรง หรือปวดท้องรุนแรงเกิดขึ้นฉับพลัน มีภาวะช็อก หรือ เป็นอัมพาตเฉียบพลัน', 41, 42, 0, 3),
(44, 'คุณอาจเป็นโรคออฟฟิตซินโดรม', 0, 0, 1, 2),
(45, 'ปวดหัวหรือปวดตา ?', 0, 0, 0, 5),
(46, 'ปวดหัวหรือปวดตา', 0, 0, 0, 5),
(47, 'ปวดหัวหรือปวดตา', 0, 0, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `t_id` int(11) NOT NULL,
  `t_1` varchar(255) NOT NULL,
  `t_2` varchar(255) NOT NULL,
  `t_3` varchar(255) NOT NULL,
  `t_4` varchar(255) NOT NULL,
  `t_5` varchar(255) NOT NULL,
  `t_6` varchar(255) NOT NULL,
  `t_7` varchar(255) NOT NULL,
  `t_8` varchar(255) NOT NULL,
  `t_9` varchar(255) NOT NULL,
  `t_10` varchar(255) NOT NULL,
  `t_11` varchar(255) NOT NULL,
  `q_12` varchar(255) NOT NULL,
  `q_13` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`t_id`, `t_1`, `t_2`, `t_3`, `t_4`, `t_5`, `t_6`, `t_7`, `t_8`, `t_9`, `t_10`, `t_11`, `q_12`, `q_13`) VALUES
(1, 'หญิง', 'ข้าราชการ', '15,000 - 19,999', 'คอมพิวเตอร์ PC', 'ไม่มีที่วางแขน', '3 - 4 ชั่วโมง', 'สูงกว่าระดับสายตา', 'นั่งแล้วเท้าแตะพื้นเล็กน้อย', 'นั่งห้อยขา', 'วางแขนบนคีย์บอร์ด', 'ไม่มี (ข้ามไปตอบข้อ 15)', 'ไม่ค่อยสำคัญ', 'สนใจ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`ds_id`);

--
-- Indexes for table `herbs`
--
ALTER TABLE `herbs`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `u_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `ds_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `herbs`
--
ALTER TABLE `herbs`
  MODIFY `h_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `st_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
