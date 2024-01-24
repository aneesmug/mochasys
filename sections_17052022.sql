-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 10:25 AM
-- Server version: 5.5.39
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mochasysdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `location_owner` varchar(255) CHARACTER SET utf8 NOT NULL,
  `camera_in` int(11) NOT NULL,
  `camera_out` int(11) NOT NULL,
  `b_license_exp` varchar(25) NOT NULL,
  `b_license_no` varchar(50) NOT NULL,
  `location_dist` varchar(100) CHARACTER SET utf8 NOT NULL,
  `bulding_base` varchar(255) NOT NULL,
  `bulding_size` varchar(255) NOT NULL,
  `t_bulding_size` varchar(50) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `location_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `municipality` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sub_municipality` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `dept`, `location_owner`, `camera_in`, `camera_out`, `b_license_exp`, `b_license_no`, `location_dist`, `bulding_base`, `bulding_size`, `t_bulding_size`, `latitude`, `longitude`, `location_name`, `municipality`, `sub_municipality`, `status`, `created_at`, `updated_at`) VALUES
(1, 'JM 01', 'POS', 'no name', 1, 2, '26/11/1442', 'no', 'no', 'Cement', '4*3', 'no', '21.593371', '39.105903', 'Corniche near fun time', 'Municipality', 'sub municipality', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'JM 03', 'POS', '', 0, 0, '', '0', '', 'Cement ', '4*3', '', '21.708562', '39.102249', 'Abhor', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'JM 06', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.55263', '39.234111', 'Haramain Road - Sahal Gas Station', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'JM 08', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.505991', '39.165139', 'United Hospital (Naft Station)', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'JM 10', 'POS', 'no name', 0, 0, '27/11/1442', '0', 'no', 'Wooden Walls', '0', '0', '21.53923', '39.2245', 'Dallah Tower', 'no', 'no', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'JM 11', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.561107', '39.231614', 'Al Jadayal Makkah Road', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'JM 12', 'POS', '', 0, 0, '', '0', '', 'Matel', '4*3', '', '21.756142', '39.122473', 'Sawary - Abhor', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'JM 14', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'Madina Road-Hera Bridge', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'JM 15', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.558392', '39.116174', 'Bawazer - Cornich', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'JM 16', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.567007', '39.14282', 'Haqbani - Sultan Street', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'JM 17', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.586834', '39.163761', 'Sederi- Sary Bridge', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'JM 18', 'POS', '', 0, 0, '', '0', '', 'Matel', '5*2', '', '21.648708', '39.110724', 'Glob Circle-King Road', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'JM 19', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.60985', '39.136969', 'Hera Avenue', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'JM 20', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '6*4', '', '21.793729', '39.12515', 'Al Otabi - Reheli', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'JM 22', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.54839', '39.236876', 'Sulaimania-Naft Station', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'JM 23', 'POS', '', 0, 0, '', '0', '', 'Matel (U Shape)', '3*2', '', '21.717829', '39.1099', 'Sharm Obhor', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'JM 24', 'POS', '', 0, 0, '', '0', '', 'Matel', '3*2', '', '21.635688', '39.102792', 'Technology Center Cornich', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'JM 26', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.463877', '39.224093', 'Madayen Fahed', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'JM 28', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '3*2', '', '21.572448', '39.210352', 'Arbaheen - Albaik', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'JM 29', 'POS', '', 0, 0, '', '0', '', 'Cement ', '8*6', '', '21.51898', '39.182322', 'Hyatt Center Madinah Road', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'JM 31', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'Eye Hospital', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'JM 32', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.415135', '39.336417', 'Mizan Petrole Station', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'JM 33', 'POS', '', 0, 0, '', '0', '', 'Matel (U Shape)', '3*2', '', '21.500958', '39.23941', 'KA University', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'JM 34', 'POS', '', 0, 0, '', '0', '', 'Matel (U Shape)', '3*2', '', '21.531204', '39.187111', 'Naft - Palastine', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'JM 38', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.801966', '39.118199', 'Rehely', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'JM 39', 'POS', '', 0, 0, '', '0', '', 'Matel', '3*2', '', '21.654643', '39.102097', 'Lulu Al Jeddah', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'MM 01', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '5*2', '', '21.396215', '39.792846', 'Khalidiya', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'MM 02', 'POS', '', 0, 0, '', '0', '', 'Cement', '4*3', '', '21.355646', '40.115055', 'Sasco Taif Road', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'MM 03', 'POS', '', 0, 0, '', '0', '', 'Matel', '3*2', '', '21.435475', '39.830659', 'Maala', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'MM 05', 'POS', 'SASCO Gas Stations', 1, 2, '19/08/1444', '3909439689', 'حي الحمراء وأم الجود', 'Cement', '4*3', '18', '21.39088', '39.706469', ' طريق مكة - جدة السريع', ' أمانة العاصمة المقدسة', ' بلدية العمرة الفرعية', 'A', '0000-00-00 00:00:00', '2021-11-14 12:24:15'),
(31, 'YM 01', 'POS', '', 0, 0, '', '0', '', 'Cement', '4*3', '', '24.007932', '38.234016', 'Al Buhyra Royal Commission', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'YM 02', 'POS', '', 0, 0, '', '0', '', 'Cement', '4*3', '', '24.022831', '38.139939', 'Yanbu Cornich Area 1', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'YM 03', 'POS', '', 0, 0, '', '0', '', 'Cement', '4*3', '', '21.708562', '39.102249', 'Yanbu Cornich Area 2', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'YUM 01', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'Yanbu Industriel College', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'JMUM 01', 'POS', '', 0, 0, '', '0', '', 'Wooden Walls', '0', '', '21.498767', '39.231034', 'KAU Research center King Fahed', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'JMUM 02', 'POS', '', 0, 0, '', '0', '', 'Wooden Walls', '0', '', '21.495538', '39.235973', 'KAU Male Dental Hosp.', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'JMUM 03', 'POS', '', 0, 0, '', '0', '', 'Wooden Walls', '0', '', '21.498786', '39.231177', 'KAU Environment Design', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'JMUM 04', 'POS', '', 0, 0, '', '0', '', 'Wooden Walls', '0', '', '7186', '2820', 'KAU Library', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'JMUM 05', 'POS', '', 0, 0, '', '0', '', 'Matel', '3*2', '', '2749285', '6420', 'University Asfan', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'JMUF 01', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'University - Female Dental', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'JMUF 03', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'University - Female Multaz', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'JMUBTF 01', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'CBA Sari Street', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'JMUBT 01', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'CBA  Language Center (Dahban)', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'JMUBT 02 ', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'CBA College - Food Court', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'JMUBT 03', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'CBA Engeneering College', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Store Coffee', 'Warehouse', '', 0, 0, '', '0', '', '', '', '', '', '', 'Al Rajhi', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Store Sugar', 'Warehouse', '', 0, 0, '', '0', '', '', '', '', '', '', 'Al Amlak', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Store Riyadh', 'Warehouse', '', 0, 0, '', '0', '', '', '', '', '', '', 'Wholesales', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Store Madina', 'Warehouse', '', 0, 0, '', '0', '', '', '', '', '', '', 'Wholesales', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Store Makkah', 'Warehouse', '', 0, 0, '', '0', '', '', '', '', '', '', 'Wholesale', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Sugar Factory', 'Production', '', 0, 0, '', '0', '', '', '', '', '', '', 'Modorn', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Coffee Factory', 'Production', '', 0, 0, '', '0', '', '', '', '', '', '', 'Modorn', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Head Office', 'Head Office', '', 0, 0, '', '0', '', '', '', '', '', '', 'Ameer Sultan Street', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Maintenance', 'Maintenance', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'JM 21', 'POS', '', 0, 0, '', '0', '', 'IBSF Cabnit', '3*2', '', '21.58921', '39.131126', 'Near Al-Shati Markeet', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Administration', 'Administration', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Head Office', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Finance', 'Finance', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'HR and Housing', 'HR and Housing', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Public Relation', 'Public Relation', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Sales', 'Sales', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Inspection', 'Inspection', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Purchase', 'Purchase', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'IT', 'IT', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Production', 'Production', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Transportation', 'Transportation', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Management', 'Management', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'General', 'General', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'JM 02', 'POS', '', 0, 0, '', '0', '', 'SARIAH Cabnit', '3*2', '', '21.751272', '39.091682', 'St. Abduljabar Alaa Sheraa Dist, Jeddah', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Operations', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', '', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'MM 04', 'POS', '', 0, 0, '', '0', '', 'Cement', '6*4', '', '21.427558', '39.856056', 'Makkah Sheesha', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'YM 04', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'Yunbo', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'YUM 02', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'Yonbu', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'YUM 03', 'POS', '', 0, 0, '', '0', '', '', '', '', '', '', 'Yunbo', '', '', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'JM 04', 'POS', '', 0, 0, '', '0', '', 'SARIAH Cabnit', '4*3', '', '0', '0', 'Asfan Road (Sasco Gas Station)\r\n', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'JM 05', 'POS', '', 0, 0, '', '0', '', 'Wooden Walls', '3*2', '', '21.76876449584961', '39.0996208190918', 'King Abdullah Medical Complex', '', '', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Triggers `sections`
--
DELIMITER $$
CREATE TRIGGER `a_d_section` AFTER DELETE ON `sections` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'section';						SET @pk_d = CONCAT('<id>',OLD.`id`,'</id>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						IF @rs = 1 THEN 						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						END IF; 						IF @rs > 1 THEN 						UPDATE `history_store` SET `timemark` = @time_mark, `record_state` = 3, `pk_date_src` = `pk_date_dest` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						END IF; 						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_section` AFTER INSERT ON `sections` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'cvb'; 						SET @tbl_name = 'section'; 						SET @pk_d = CONCAT('<id>',NEW.`id`,'</id>'); 						SET @rec_state = 1;						UPDATE `history_store` SET `pk_date_dest` = `pk_date_src` WHERE `table_name` = @tbl_name AND `pk_date_dest` = @pk_d AND (`record_state` = 2 OR `record_state` = 1); 						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_dest` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_section` AFTER UPDATE ON `sections` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'section';						SET @pk_d_old = CONCAT('<id>',OLD.`id`,'</id>');						SET @pk_d = CONCAT('<id>',NEW.`id`,'</id>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
