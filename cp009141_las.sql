-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2023 at 09:41 AM
-- Server version: 5.6.51
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp009141_las`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_db`
--

CREATE TABLE `tbl_bank_db` (
  `bk_id` int(11) NOT NULL,
  `bk_code` varchar(255) NOT NULL,
  `bk_name` varchar(255) NOT NULL,
  `bk_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bank_db`
--

INSERT INTO `tbl_bank_db` (`bk_id`, `bk_code`, `bk_name`, `bk_img`) VALUES
(1, 'BBL', 'ธนาคารกรุงเทพ จำกัด (มหาชน) - BBL', 'BBL.png'),
(2, 'KTB', 'ธนาคารกรุงไทย จำกัด (มหาชน) - KTB', 'KTB.png'),
(3, 'BAY', 'ธนาคารกรุงศรีอยุธยา จำกัด (มหาชน) - BAY', 'BAY.png'),
(4, 'KBANK', 'ธนาคารกสิกรไทย จำกัด (มหาชน) - KBANK', 'KBANK.png'),
(5, 'TTB', 'ธนาคารทหารไทยธนชาต จำกัด (มหาชน) - TTB', 'TTB.png'),
(6, 'SCB', 'ธนาคารไทยพาณิชย์ จำกัด (มหาชน) - SCB', 'SCB.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_db`
--

CREATE TABLE `tbl_member_db` (
  `mb_id` int(11) NOT NULL,
  `mb_url` varchar(255) NOT NULL,
  `mb_id_card_number` varchar(255) NOT NULL,
  `mb_phone` varchar(255) NOT NULL,
  `mb_firstname` varchar(255) NOT NULL,
  `mb_lastname` varchar(255) NOT NULL,
  `mb_level` varchar(255) NOT NULL,
  `mb_url_token` varchar(255) NOT NULL,
  `mb_account_number` varchar(255) NOT NULL,
  `mb_interest` float NOT NULL,
  `bk_code` varchar(255) NOT NULL,
  `mb_citizen_id_file` varchar(255) NOT NULL,
  `mb_book_bank_file` varchar(255) NOT NULL,
  `mb_timeinsert` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member_db`
--

INSERT INTO `tbl_member_db` (`mb_id`, `mb_url`, `mb_id_card_number`, `mb_phone`, `mb_firstname`, `mb_lastname`, `mb_level`, `mb_url_token`, `mb_account_number`, `mb_interest`, `bk_code`, `mb_citizen_id_file`, `mb_book_bank_file`, `mb_timeinsert`) VALUES
(1, '9uDVG7UESG', 'c663bd388ec9e6ea5c64658c96d28d6e', '40433343a063d26054a3169b42b5957f', 'ศักดา', 'สุขขวํญ', 'admin', '', '', 0, '', '', '', '27 พฤศจิกายน 2565'),
(2, 'FMyuOmd49r', 'fafff40a7abde33c8b6b57e464c49ebd', '75b2776fd8790abd4e4cadadbc44f6c2', 'กนิษฐา', 'ศิริวัฒน์', 'creditor', '', '2200000001', 2, 'BBL', '125253568920221127-233828-20221127-233828.pdf', '125253568920221127-233828-20221127-233828.pdf', '27 พฤศจิกายน 2565'),
(3, 'gltDJ26BBG', 'effb9e98e8ba6eed5a703739987fa56e', 'd3c0d12d4cf6fe0581ca044a89892aed', 'ศิริพรรณ', 'ศรีนวล', 'creditor', '', '2200000002', 2, 'KTB', '169682523220221127-233928-20221127-233928.pdf', '169682523220221127-233928-20221127-233928.pdf', '27 พฤศจิกายน 2565'),
(4, 'L9jWLLO19O', '84ed0645087a6cc2edc7bd8495916dc3', '191ce54390305db8ea477625b4d544db', 'พรประภา', 'กำจัดภัย', 'creditor', '', '2200000003', 2, 'BAY', '132262920221127-234009-20221127-234009.pdf', '132262920221127-234009-20221127-234009.pdf', '27 พฤศจิกายน 2565'),
(5, '0qcQeBsRgx', '12c8b0cdad8eb0570a20d790b47a3d1f', '55585606731d8de280c61c29adcc2ff4', 'บัวชมพู', 'รัตนา', 'creditor', '', '2200000004', 2, 'KBANK', '208070603720221127-234053-20221127-234053.pdf', '208070603720221127-234053-20221127-234053.pdf', '27 พฤศจิกายน 2565'),
(6, 'qGTA9UHABG', '3645450116d01ba93d7c83190c6ca54d', 'fc9bdfb86bae5c322bae5acd78760935', 'พจนีย์', 'สังขประดิษฐ์', 'creditor', '', '2200000005', 2, 'SCB', '114797122720221127-234212-20221127-234212.pdf', '114797122720221127-234212-20221127-234212.pdf', '27 พฤศจิกายน 2565'),
(17, 'MA4KcuUaoB', '7a48932b26f04fccb55f0409ba3451fc', '0b5de470bdace90bd6cfb2541eb79f99', 'รจนา', 'จันทร์', 'debtor', 'FMyuOmd49r', '5555555555', 0, 'KTB', '184585421520230129-155427-20230129-155427.PNG', '184585421520230129-155427-20230129-155427.JPG', '29 มกราคม 2566'),
(18, 'd7Mdl6Uyn7', 'bc177a7a9c7df69c248647b4dfc6fd84', '0ff5247ca8a0dd247b3ed7428922b7ef', 'พลอย', 'ชมพู', 'debtor', '', '6666666666', 0, 'KBANK', '202675605220230201-003826-20230201-003826.pdf', '202675605220230201-003826-20230201-003826.pdf', '01 กุมภาพันธ์ 2566'),
(19, 'usMhYVhr0P', '4c6af51d1438b1459b691dfabf5680db', '039d858f824ed0149e632f5272b11660', 'สุชาวดี', 'เกษเจริญ', 'creditor', '', '9385744561', 1.8, 'BBL', '7493997820230201-152349-20230201-152349.pdf', '7493997820230201-152349-20230201-152349.pdf', '01 กุมภาพันธ์ 2566'),
(20, 'oaDKDbmiPo', 'bfb8778b0755a185c56a976a43e60098', 'eed9d5e2556c89411cdcdc8e0c5109bd', 'สายไหม', 'เกดเจริญ', 'debtor', 'usMhYVhr0P', '9875486217', 0, 'KTB', '150228089420230201-152527-20230201-152527.pdf', '150228089420230201-152527-20230201-152527.pdf', '01 กุมภาพันธ์ 2566'),
(21, 'YgEnP9uahD', '3be533b32e864bcd3acd43e919b6bec0', 'ca94235d7e3f532531a04f8c5fbdeaab', 'นพมาศ', 'แตงมณี', 'debtor', 'FMyuOmd49r', '3110000001', 0, 'BBL', '91139959020230201-200111-20230201-200111.pdf', '91139959020230201-200111-20230201-200111.pdf', '01 กุมภาพันธ์ 2566'),
(22, 'qHLg0cN9L0', '8ba1cff26617f5c501a1b6a3fbb2fc3d', 'ee4e8251b1192283a3677de8ff8c9c6e', 'จาริยา', 'รัชตาธิวัฒน์', 'debtor', 'FMyuOmd49r', '3110000002', 0, 'KTB', '144026872420230201-200331-20230201-200331.pdf', '144026872420230201-200331-20230201-200331.pdf', '01 กุมภาพันธ์ 2566'),
(23, 'efXsNhNWFC', '7b7fd4d3c23a42f4ca73cf4f98238b59', '88d6a81ed276e76b575ca8a930aeb0a2', 'จารุนันท์', 'พันธ์งามตา', 'debtor', 'FMyuOmd49r', '3110000003', 0, 'BAY', '165544510420230201-200750-20230201-200750.pdf', '165544510420230201-200750-20230201-200750.pdf', '01 กุมภาพันธ์ 2566'),
(24, 'q34ZYJM26y', 'c1631a8906f744284178f2139003d895', '22f306ff89cbf8fd0542554e88f8fc61', 'จิตราพร', 'ทองคง', 'debtor', 'FMyuOmd49r', '3110000004', 0, 'KBANK', '57741065420230201-202328-20230201-202328.pdf', '57741065420230201-202328-20230201-202328.pdf', '01 กุมภาพันธ์ 2566'),
(25, '4BepaOcxRd', '94364b4e5f2623a29ce86889ea755fa3', 'fc0583d209be0643810ca02ecec2df3e', 'ณภัทร', 'เครือทิวา', 'debtor', 'FMyuOmd49r', '3110000005', 0, 'TTB', '202643402820230201-202447-20230201-202447.pdf', '202643402820230201-202447-20230201-202447.pdf', '01 กุมภาพันธ์ 2566'),
(26, 'rO91XYdYCW', 'dc335212e975f5df2607b7de59035d52', '9509b6957db761f85aa916343071a3bc', 'ณัฏฐา', 'สุภาสนันท์', 'debtor', 'FMyuOmd49r', '3110000006', 0, 'SCB', '13618685020230201-202552-20230201-202552.pdf', '13618685020230201-202552-20230201-202552.pdf', '01 กุมภาพันธ์ 2566'),
(29, '6RjV4eGFDz', '8a8bb7cd343aa2ad99b7d762030857a2', '8a8bb7cd343aa2ad99b7d762030857a2', 'a1', 'a1', 'creditor', '', 'a1', 2, 'BBL', '113695970020230208-211959-20230208-211959.pdf', '113695970020230208-211959-20230208-211959.pdf', '08 กุมภาพันธ์ 2566'),
(30, 'YBObt6NeRk', 'edbab45572c72a5d9440b40bcc0500c0', 'edbab45572c72a5d9440b40bcc0500c0', 'b1', 'b1', 'debtor', '6RjV4eGFDz', 'b1', 0, 'KTB', '174483883320230208-212042-20230208-212042.pdf', '174483883320230208-212042-20230208-212042.pdf', '08 กุมภาพันธ์ 2566'),
(31, 'mjw4kRlQaj', 'b337a694f24d3564930bc296b808e293', '7a42cbaf27571f4dccdcb58c63c31066', 'เกศแก้ว', 'ทองเรือง', 'debtor', '', '3110000007', 0, 'BBL', '132328563820230214-220506-20230214-220506.pdf', '132328563820230214-220506-20230214-220506.pdf', '14 กุมภาพันธ์ 2566'),
(32, 'TO58pQvnc7', '250cf8b51c773f3f8dc8b4be867a9a02', '250cf8b51c773f3f8dc8b4be867a9a02', 'dsd', 'fdsf', 'debtor', '', '5660', 0, 'KBANK', '32002968820230502-183006-20230502-183006.jpg', '32002968820230502-183006-20230502-183006.jpg', '02 พฤษภาคม 2566');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_db`
--

CREATE TABLE `tbl_report_db` (
  `rp_id` int(11) NOT NULL,
  `rp_url` varchar(255) NOT NULL,
  `mb_url` varchar(255) NOT NULL,
  `mb_token` varchar(255) NOT NULL,
  `rp_loan_amount` float NOT NULL,
  `rp_list_name` varchar(255) NOT NULL,
  `rp_list_date` varchar(255) NOT NULL,
  `rp_number_1` float NOT NULL,
  `rp_number_2` float NOT NULL,
  `rp_number_3` float NOT NULL,
  `rp_cash_img` varchar(255) NOT NULL,
  `rp_status` varchar(255) NOT NULL,
  `rp_time_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_report_db`
--

INSERT INTO `tbl_report_db` (`rp_id`, `rp_url`, `mb_url`, `mb_token`, `rp_loan_amount`, `rp_list_name`, `rp_list_date`, `rp_number_1`, `rp_number_2`, `rp_number_3`, `rp_cash_img`, `rp_status`, `rp_time_add`) VALUES
(1, 'KpcDUFpvmq', 'MA4KcuUaoB', 'MA4KcuUaoB', 2000, '', '', 0, 0, 0, '30088007720230131-180512-20230131-180512.JPG', 'active_loan', '31 มกราคม 2566'),
(3, 'qG016QWOsx', 'MA4KcuUaoB', 'MA4KcuUaoB', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 1 ประจำเดือน มกราคม ปี 2566', '1-15 มกราคม 2566', 500, 0, 500, '33345877920230131-224548-20230131-224548.JPG', 'active', '31 มกราคม 2566'),
(4, 'J5BT5q61Ad', 'MA4KcuUaoB', 'MA4KcuUaoB', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 2 ประจำเดือน กุมภาพันธ์ ปี 2566', '1-15 กุมภาพันธ์ 2566', 500, 0, 500, '189481534520230131-230154-20230131-230154.JPG', 'active', '31 มกราคม 2566'),
(5, 'futIBVrGMi', 'MA4KcuUaoB', 'MA4KcuUaoB', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 3 ประจำเดือน มีนาคม ปี 2566', '1-15 มีนาคม 2566', 500, 0, 500, '137645581020230131-232219-20230131-232219.JPG', 'pending', '31 มกราคม 2566'),
(6, 'hv8PdCxUHr', 'MA4KcuUaoB', 'MA4KcuUaoB', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 5 ประจำเดือน เมษายน ปี 2566', '1-15 เมษายน 2566', 0, 10, 500, '', 'pending', '31 มกราคม 2566'),
(12, 'O1FrTm5sdr', 'YgEnP9uahD', 'YgEnP9uahD', 8000, '', '', 0, 0, 0, '56023703020230201-215838-20230201-215838.JPG', 'active_loan', '01 กุมภาพันธ์ 2566'),
(13, 'rQ6xxH6N3h', 'qHLg0cN9L0', 'qHLg0cN9L0', 6000, '', '', 0, 0, 0, '214599041120230201-215910-20230201-215910.JPG', 'active_loan', '01 กุมภาพันธ์ 2566'),
(14, 'gkHmU4jZe6', 'efXsNhNWFC', 'efXsNhNWFC', 12000, '', '', 0, 0, 0, '31192467020230201-220614-20230201-220614.JPG', 'active_loan', '01 กุมภาพันธ์ 2566'),
(15, 'jij8EWDYT0', 'q34ZYJM26y', 'q34ZYJM26y', 4000, '', '', 0, 0, 0, '', 'pending_loan', '01 กุมภาพันธ์ 2566'),
(16, 's7QV6fqMTx', '4BepaOcxRd', '4BepaOcxRd', 3000, '', '', 0, 0, 0, '', 'pending_loan', '01 กุมภาพันธ์ 2566'),
(17, 'QmoZCtrl7d', 'rO91XYdYCW', 'rO91XYdYCW', 9000, '', '', 0, 0, 0, '74691712720230205-180533-20230205-180533.JPG', 'active_loan', '05 กุมภาพันธ์ 2566'),
(18, '4z2qvKjGb7', 'efXsNhNWFC', 'efXsNhNWFC', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 1 ประจำเดือน มกราคม ปี 2566', '1-15 มกราคม 2566', 2000, 0, 2000, '35481454920230201-221453-20230201-221453.JPG', 'active', '01 กุมภาพันธ์ 2566'),
(19, 'k2vdX4K4Z8', 'efXsNhNWFC', 'efXsNhNWFC', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 2 ประจำเดือน กุมภาพันธ์ ปี 2566', '1-15 กุมภาพันธ์ 2566', 2000, 0, 2000, '75990119220230202-163755-20230202-163755.JPG', 'active', '02 กุมภาพันธ์ 2566'),
(20, 'QGZ7Acfw2c', 'efXsNhNWFC', 'efXsNhNWFC', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 3 ประจำเดือน มีนาคม ปี 2566', '1-15 มีนาคม 2566', 2040, 40, 2000, '75439084620230725-110128-20230725-110128.jpg', 'pending', '25 กรกฏาคม 2566'),
(21, '5ISiQpJzXr', 'rO91XYdYCW', 'rO91XYdYCW', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 1 ประจำเดือน มกราคม ปี 2566', '1-15 มกราคม 2566', 2000, 0, 2000, '124772721020230206-002421-20230206-002421.JPG', 'active', '06 กุมภาพันธ์ 2566'),
(22, 'V9MwMasuFG', 'rO91XYdYCW', 'rO91XYdYCW', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 2 ประจำเดือน กุมภาพันธ์ ปี 2566', '1-15 กุมภาพันธ์ 2566', 2000, 0, 2000, '6353873120230206-002814-20230206-002814.JPG', 'pending', '06 กุมภาพันธ์ 2566'),
(23, 'CcN1L4dzwO', 'rO91XYdYCW', 'rO91XYdYCW', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 3 ประจำเดือน มีนาคม ปี 2566', '1-15 มีนาคม 2566', 0, 0, 2000, '', 'pending', '05 กุมภาพันธ์ 2566'),
(24, 'Y1TFtLbg5F', 'efXsNhNWFC', 'efXsNhNWFC', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 4 ประจำเดือน เมษายน ปี 2566', '1-15 เมษายน 2566', 0, 0, 2000, '', 'pending', '06 กุมภาพันธ์ 2566'),
(25, 'xSx6D0uC6a', 'efXsNhNWFC', 'efXsNhNWFC', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 5 ประจำเดือน พฤษภาคม ปี 2566', '1-15 พฤษภาคม 2566', 0, 0, 2000, '', 'pending', '08 กุมภาพันธ์ 2566'),
(26, 'bKXE20HM8i', 'YBObt6NeRk', 'YBObt6NeRk', 2500, '', '', 0, 0, 0, '146467677820230208-212213-20230208-212213.JPG', 'active_loan', '08 กุมภาพันธ์ 2566'),
(27, 'ZsOF2qo0jx', 'YBObt6NeRk', 'YBObt6NeRk', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 1 ประจำเดือน มกราคม ปี 2566', '1-15 มกราคม 2566', 2000, 0, 2000, '153861238920230208-212335-20230208-212335.JPG', 'active', '08 กุมภาพันธ์ 2566'),
(28, 'vuHDFqrnro', 'YBObt6NeRk', 'YBObt6NeRk', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 2 ประจำเดือน กุมภาพันธ์ ปี 2566', '1-15 กุมภาพันธ์ 2566', 510, 10, 500, '194712988020230208-212450-20230208-212450.JPG', 'active', '08 กุมภาพันธ์ 2566'),
(29, 'zPjEWMPRcZ', 'efXsNhNWFC', 'efXsNhNWFC', 0, 'แจ้งชำระเงินกู้ยืม งวดที่ 6 ประจำเดือน มิถุนายน ปี 2566', '1-15 มิถุนายน 2566', 0, 0, 2000, '', 'pending', '23 พฤษภาคม 2566');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_db`
--

CREATE TABLE `tbl_setting_db` (
  `st_id` int(11) NOT NULL,
  `st_website_address` varchar(255) NOT NULL,
  `st_website_title` varchar(255) NOT NULL,
  `st_btn_level_1` varchar(255) NOT NULL,
  `st_btn_level_2` varchar(255) NOT NULL,
  `st_website_description` varchar(255) NOT NULL,
  `st_version` varchar(255) NOT NULL,
  `st_description_version` text NOT NULL,
  `st_terms_of_service` text NOT NULL,
  `st_privacy_policy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_setting_db`
--

INSERT INTO `tbl_setting_db` (`st_id`, `st_website_address`, `st_website_title`, `st_btn_level_1`, `st_btn_level_2`, `st_website_description`, `st_version`, `st_description_version`, `st_terms_of_service`, `st_privacy_policy`) VALUES
(1, 'https://www.dbtlearning.com/las/', 'การทำธุรกรรมการเงินอิเล็กทรอนิกส์ - Electronic Money Transactions', '1', '1', 'โครงงาน นวัตกรรมดิจิทัล การทำธุรกรรมการเงินอิเล็กทรอนิกส์ (Electronic Money Transactions)', 'v1.2.15', '- สร้างและพัฒนาระบบ<br>\r\n- เพิ่มเติมระบบให้สมบูรณ์มากขึ้น<br>\r\n- เพิ่มฟังก์ชั่นการทำงาน<br>\r\n- แก้ไขข้อผิดพลาดของระบบ<br>\r\n- เพิ่มเอฟเฟคเกร็ดหิมะ เพื่อความสวยงาม', '1) โดย “ผู้กู้ยืมเงิน” จะชำระเงินคืนให้แก่ “ผู้ให้กู้ยืม” ทุกเดือน เดือนละ 2,000.00 บาท<br>\r\n2) โดย “ผู้ให้กู้ยืม” จะไม่คิดดอกเบี้ย ใด ๆ ทั้งสิ้น หาก “ผู้กู้ยืมเงิน” ทำตามข้อตกลง<br>\r\n3) การคิดดอกเบี้ย เงินต้น 2,000 รวม ดอกเบี้ย ร้อยละ 2 (ตัวอย่างอัตราดอกเบี้ย ขึ้นอยู่กับเจ้าหนี้แต่คนจะกำหนด) ต่อเดือน เท่ากับ 2,040.00 (ตัวอย่างผลลัภธ์) บาท<br>\r\n4) โดย \"ผู้กู้ยืมเงิน\" จะต้องมีอายุ 18 ปีขึ้นไป ถึงจะกู้ยืมเงินได้<br>\r\n5) อัตราดอกเบี้ยสูงสุดที่ \"ผู้ให้กู้ยืม\" กำหนดได้คือ ไม่เกิน 10% ต่อเดือน', 'ประกาศ!  อัพเดทระบบความปลอดภัย  ของเว็บไซต์ https://www.dbtlearning.com/las/<br><br>\r\n1)  ป้องกันการกดดูซอร์สโค้ดของหน้าเว็บ  (Ctrl + U)<br>\r\n2)  ป้องกันการเปิดเครื่องมือผู้พัฒนา  DevTool  (F12)<br>\r\n3)  ป้องกันการกดบันทึกหน้าเว็บ  (Ctrl + S)<br>\r\n4)  ป้องกันการกดรีเฟรชหน้าเว็บ  (F5)<br>\r\n5)  ป้องกันการคลิกขวา<br>\r\n6)  ป้องกันการบันทึกรูปภาพ<br><br>\r\nทั้งนี้เราอัพเดทระบบความปลอดภัยอยู่เสมอ  เพื่อผู้ใช้จะได้ใช้งานได้อย่างปลอดภัย\r\n<br><br>\r\n--  ทีมงาน LAS TEAM.  --');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank_db`
--
ALTER TABLE `tbl_bank_db`
  ADD PRIMARY KEY (`bk_id`);

--
-- Indexes for table `tbl_member_db`
--
ALTER TABLE `tbl_member_db`
  ADD PRIMARY KEY (`mb_id`);

--
-- Indexes for table `tbl_report_db`
--
ALTER TABLE `tbl_report_db`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `tbl_setting_db`
--
ALTER TABLE `tbl_setting_db`
  ADD PRIMARY KEY (`st_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank_db`
--
ALTER TABLE `tbl_bank_db`
  MODIFY `bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_member_db`
--
ALTER TABLE `tbl_member_db`
  MODIFY `mb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_report_db`
--
ALTER TABLE `tbl_report_db`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_setting_db`
--
ALTER TABLE `tbl_setting_db`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
