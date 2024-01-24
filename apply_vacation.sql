-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 02:33 PM
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
-- Table structure for table `apply_vacation`
--

CREATE TABLE `apply_vacation` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `emp_name` varchar(120) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'apply',
  `vac_strt_date` varchar(255) NOT NULL,
  `return_date` varchar(255) NOT NULL,
  `joining_date` varchar(255) NOT NULL,
  `last_vac_date` varchar(255) NOT NULL,
  `next_vac_date` varchar(255) NOT NULL,
  `vac_type` varchar(100) DEFAULT NULL,
  `fly_type` varchar(100) DEFAULT NULL,
  `review` varchar(10) NOT NULL DEFAULT 'A',
  `vacdays` int(50) NOT NULL,
  `replacement_per` varchar(255) NOT NULL,
  `ticket_pay` varchar(255) NOT NULL,
  `permit_fee` varchar(100) NOT NULL,
  `empgid` varchar(150) NOT NULL,
  `hr_note` varchar(255) NOT NULL,
  `gm_note` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_vacation`
--

INSERT INTO `apply_vacation` (`id`, `emp_id`, `emp_name`, `dept`, `status`, `vac_strt_date`, `return_date`, `joining_date`, `last_vac_date`, `next_vac_date`, `vac_type`, `fly_type`, `review`, `vacdays`, `replacement_per`, `ticket_pay`, `permit_fee`, `empgid`, `hr_note`, `gm_note`, `created_at`) VALUES
(2, '1075', 'Kuttiman Pettikal', 'Maintenance', 'approve', '15/04/2019', '15/05/2019', '01/10/2002', '18/07/2016', '15/04/2020', 'annual', '', 'C', 0, 'Mohammed Syed Hussain', '2100', '200', '20', '', '', '2019-04-16 11:12:56'),
(9, '4519', 'Yousuf Salem Dosh Al Harithy', 'Production ', 'approve', '20/04/2019', '20/05/2019', '09/02/2017', '', '20/04/2020', 'annual', '', 'C', 0, 'Ahmed Hussain Ahmed Habtour', '', '', '64', '', '', '2019-04-30 07:55:28'),
(8, '4453', 'Noura Saleh Bashinini', 'Production ', 'approve', '20/04/2019', '20/05/2019', '24/04/2018', '', '20/04/2020', 'annual', '', 'C', 0, 'Maha Ahmed Al Khasami', '', '', '78', '', '', '2019-04-30 07:50:01'),
(10, '4455', 'Awatif Saad Al Amri', 'Production ', 'approve', '27/04/2019', '27/05/2019', '06/05/2018', '', '27/04/2020', 'annual', '', 'C', 0, 'Huda Saad Al Amri', '', '', '80', '', '', '2019-04-30 07:56:32'),
(11, '1064', 'Mohammed Imtiaz Idris ', 'POS', 'approve', '06/05/2019', '04/06/2019', '13/10/2002', '', '06/05/2021', 'annual', '', 'C', 0, 'Omer Faruk', '2100', '300', '17', '', '', '2019-05-02 11:07:58'),
(12, '1168', 'Air Ahmed Hussain', 'POS', 'approve', '06/05/2019', '05/07/2019', '23/09/2005', '', '06/05/2021', 'annual', '', 'C', 0, 'Deni Rohyaman', '2100', '300', '36', '', '', '2019-05-02 11:12:09'),
(13, '1198', 'Abul kasim Ismail', 'POS', 'approve', '06/05/2019', '05/07/2019', '02/04/2007', '', '06/05/2021', 'annual', '', 'C', 0, 'Mohammed Jamaluddin', '2100', '300', '39', '', '', '2019-05-02 11:14:56'),
(14, '1101', 'Shaheen Ahmed Mannan', 'POS', 'approve', '06/05/2019', '05/07/2019', '05/04/2003', '', '06/05/2021', 'annual', '', 'C', 0, 'M.Hassan Khursheed', '2100', '300', '25', '', '', '2019-05-02 11:24:53'),
(15, '1133', 'Zulfu Miah Siraj Miah', 'POS', 'approve', '06/05/2019', '05/07/2019', '04/05/2004', '', '05/07/2021', 'annual', '', 'C', 0, 'Mamoon Babar Ali', '2100', '300', '31', '', '', '2019-05-02 11:29:03'),
(16, '1117', 'Mujib ul haq', 'POS', 'approve', '06/05/2019', '05/07/2019', '15/12/2003', '', '08/05/2021', 'annual', '', 'C', 0, 'Md. Rabiul Islam', '2600', '300', '29', '', '', '2019-05-02 11:31:04'),
(17, '4415', 'Fatimah Kamiran Disumimba', 'POS', 'approve', '07/05/2019', '06/07/2019', '28/09/2013', '', '07/05/2021', 'annual', '', 'C', 0, 'Shabbir Ahmed Mannan', '2950', '300', '68', '', '', '2019-05-02 11:34:01'),
(18, '4416', 'Rosaline Aguilar Cabayao', 'POS', 'approve', '07/05/2019', '06/07/2019', '28/09/2013', '', '01/05/2021', 'annual', '', 'C', 0, 'Anwar Hussain', '2950', '300', '69', '', '', '2019-05-02 11:35:10'),
(19, '1088', 'Mujeeb Rehman Koziyan', 'POS', 'approve', '06/05/2019', '05/07/2019', '05/01/2003', '', '05/05/2021', 'annual', '', 'C', 0, 'Aslam Umar Kutty ', '2250', '300', '23', '', '', '2019-05-02 11:37:27'),
(20, '4435', 'Nahlah Ali Attiyah Al Harbi', 'POS', 'approve', '06/05/2019', '05/06/2019', '18/03/2015', '', '24/04/2020', 'annual', '', 'C', 0, 'Mazin Tafazzul', '', '', '125', '', '', '2019-05-05 08:33:52'),
(21, '4425', 'Wijdan Mohammed Ayedh Al Salmi', 'POS', 'approve', '06/05/2019', '05/06/2019', '18/08/2014', '', '24/04/2020', 'annual', '', 'C', 0, 'Atabur Rahman Taib', '', '', '71', '', '', '2019-05-05 08:36:37'),
(22, '4448', 'Rahaf Al Jedani', 'POS', 'approve', '06/05/2019', '05/06/2019', '06/12/2017', '', '24/04/2020', 'annual', '', 'C', 0, 'Haris Vadekkepurath', '', '', '72', '', '', '2019-05-05 08:57:53'),
(23, '4403', 'Hatoon Ehab Yousuf Jan', 'POS', 'approve', '06/05/2019', '05/06/2019', '21/02/2013', '', '24/04/2020', 'annual', '', 'C', 0, 'Abul Kasim Abdul Kader', '', '', '67', '', '', '2019-05-05 08:59:33'),
(24, '4420', 'Tihani Mohammed Sultan Al Qarni', 'POS', 'approve', '06/05/2019', '05/06/2019', '22/12/2013', '', '24/04/2020', 'annual', '', 'C', 0, 'Jahangir Hussain', '', '', '70', '', '', '2019-05-05 09:00:59'),
(25, '4456', 'Roua Hadi Hassan Muallim', 'POS', 'approve', '06/05/2019', '05/06/2019', '10/10/2018', '', '24/04/2020', 'annual', '', 'C', 0, 'Ramjan Maih', '', '', '74', '', '', '2019-05-05 09:02:58'),
(26, '1003', 'Abul Bashar Abdul Matin', 'Sales Department', 'approve', '03/06/2019', '08/07/2019', '06/03/2000', '', '30/05/2021', 'annual', '', 'C', 0, 'Yasser Halaby', '2200', '200', '2', '', '', '2019-05-22 09:32:20'),
(44, '4522', 'Ahmed Hussain Ahmed Habtour', 'Production ', 'approve', '16/06/2019', '15/07/2019', '19/09/2017', '', '16/06/2020', 'annual', '', 'A', 0, 'Siddiq Kallingal', '', '', '65', 'He return back from his vacation', '', '2019-06-13 08:23:24'),
(48, '1402', 'Nurul Islam Abdul Hakim', 'Transportation', 'approve', '26/06/2019', '', '24/06/2013', '01/07/2017', '23/06/2021', 'Encashed', '', 'C', 0, '', '', '', '55', 'he need the salary of the vacation ', '', '2019-06-20 09:22:59'),
(47, '1024', 'Yousuf Abul Fayaz', 'Maintenance', 'approve', '01/07/2019', '', '07/06/2002', '', '01/07/2020', 'Encashed', '', 'C', 0, '', '', '', '11', '', '', '2019-06-19 08:27:47'),
(49, '1400', 'Mohammed Syed Hussain', 'Maintenance', 'approve', '01/10/2019', '', '01/05/2013', '', '01/07/2021', 'Encashed', '', 'C', 0, '', '', '', '54', '', '', '2019-06-25 10:18:36'),
(50, '1119', 'Abul Kashem Amin', 'POS', 'approve', '15/07/2019', '13/09/2019', '21/12/2003', '', '31/08/2021', 'annual', '', 'C', 0, 'Abdul Rahim', '2400', '200', '30', '', '', '2019-07-02 06:30:14'),
(51, '1178', 'Salem Noor Hussain', 'Maintenance', 'approve', '10/12/2019', '', '25/11/2007', '', '10/12/2022', 'Encashed', '', 'C', 0, '', '', '', '37', '', '', '2019-08-01 09:25:58'),
(57, '1113', 'Nur ul Huda Zain al Abidin', 'POS', 'approve', '02/10/2019', '04/12/2019', '05/06/2003', '', '01/10/2021', 'annual', '', 'A', 0, 'Aslam Umar Kutty ', '2500', '300', '27', '', '', '2019-09-10 11:18:56'),
(53, '29', 'Abdul Malik Shahul', 'Purchase', 'approve', '19/09/2019', '27/10/2019', '03/06/2006', '', '19/09/2020', 'annual', '', 'C', 0, 'Mohammed Khairuddin', '2700', '200', '85', '', '', '2019-08-25 09:26:05'),
(113, '4403', 'Hatoon Ehab Yousuf Jan', 'POS', 'approve', '01/09/2020', '30/09/2020', '21/02/2013', '06/05/2019', '01/09/2021', 'Local Vacation', '', 'C', 0, 'Nahlah Ali Attiyah Al Harbi', '', '', '67', '', '', '2020-08-30 11:08:22'),
(59, '4517', 'Othman Ahmed Bashanum', 'POS', 'approve', '01/11/2019', '01/12/2019', '12/10/2016', '01/11/2018', '01/11/2020', '', '', 'C', 0, 'Azam Esam Mohammed Daly', '', '', '63', '', '', '2019-10-06 08:19:42'),
(60, '1021', 'Basheer Vellaran', 'POS', 'approve', '01/11/2019', '01/12/2019', '08/05/2002', '18/10/2018', '01/11/2020', 'annual', '', 'C', 0, 'Sajjad Hussain ', '2297', '200', '8', '', '', '2019-10-06 08:23:26'),
(61, '1359', 'Saepollah Sudin Yani', 'POS', 'approve', '21/10/2019', '20/12/2019', '01/04/2013', '14/06/2015', '25/10/2021', 'annual', '', 'C', 0, 'Ajger Ali Mohammed', '2650', '300', '51', '', '', '2019-10-21 08:40:06'),
(62, '1252', 'Mohammed Ibrahim Khalil', 'POS', 'approve', '25/11/2019', '23/01/2020', '07/11/2008', '31/07/2017', '25/11/2022', 'annual', '', 'C', 0, 'Abul kasim Ismail', '2696', '300', '45', '', '', '2019-11-06 09:28:29'),
(63, '1116', 'Shabbir Ahmed Mannan', 'POS', 'not_approve', '08/12/2019', '05/02/2020', '', '', '', 'annual', '', 'C', 0, 'Nur ul Huda Zain al Abidin', '', '', '5', 'Rejected from HR', '', '2019-11-06 10:28:31'),
(72, '1405', 'Abdullah Fazlur Rahim', 'Transportation', 'approve', '30/12/2019', '26/02/2020', '21/07/2013', '30/09/2017', '30/12/2022', 'annual', '', 'C', 0, 'Azhar Ali Jamali', '2000', '300', '57', '', '', '2019-11-24 12:49:52'),
(65, '1411', 'Ishak Abdulmatloob', 'Warehouse', 'approve', '30/11/2019', '29/01/2020', '05/01/2014', '01/09/2017', '30/11/2022', 'Encashed', '', 'C', 0, '', '', '', '60', 'vacation encashment ', '', '2019-11-20 06:53:38'),
(73, '4620', 'Sultan Yassin Ahmed Al Delame', 'HRD and Housing', 'approve', '15/12/2019', '11/01/2020', '20/08/2015', '02/12/2018', '02/12/2020', 'annual', '', 'C', 0, 'Abeer Hassan Al Gamdi', '', '', '93', '', '', '2019-11-27 09:13:15'),
(76, '147', 'Abdul Razak Al Fadl', 'Public Relation', 'approve', '04/12/2019', '', '01/09/2016', '04/12/2018', '04/12/2020', 'Encashed', '', 'C', 0, '', '', '', '95', '', '', '2019-12-05 08:52:07'),
(84, '1020', 'Subair Kappen', 'Warehouse', 'approve', '02/01/2020', '01/02/2020', '30/04/2002', '16/01/2019', '02/01/2021', 'annual', '', 'A', 0, 'Shafar Ajim Azeemullah', '2371', '200', '7', '', '', '2019-12-15 13:33:28'),
(81, '148', 'Mohammed Al Khayyat', 'Purchase', 'approve', '17/12/2019', '17/12/2019', '05/02/2017', '03/02/2019', '02/02/2020', 'Encashed', '', 'C', 0, 'Abdul Malik Shahul', '', '', '96', 'encashment 8 days only', '', '2019-12-15 11:52:54'),
(82, '120', 'Hatim Shafi Felemban', 'Sales Department', 'approve', '15/12/2019', '', '15/02/2015', '25/06/2018', '25/06/2020', 'Encashed', '', 'C', 0, '', '', '', '92', '', '', '2019-12-15 12:08:29'),
(83, '1402', 'Nurul Islam Abdul Hakim', 'Transportation', 'approve', '20/12/2019', '', '24/06/2013', '01/07/2017', '01/07/2021', 'Encashed', '', 'C', 0, '', '', '', '55', '', '', '2019-12-15 12:33:46'),
(85, '1412', 'Abdul HaiAbdul Matloob', 'Warehouse', 'approve', '20/12/2019', '', '05/01/2014', '06/05/2017', '20/12/2021', 'Encashed', '', 'C', 0, '', '', '', '61', '', '', '2019-12-19 07:35:48'),
(86, '1024', 'Yousuf Abul Fayaz', 'Maintenance', 'approve', '25/12/2019', '', '07/06/2002', '18/07/2018', '25/12/2020', 'Encashed', '', 'C', 0, '', '', '', '11', '', '', '2019-12-25 11:16:58'),
(87, '1011', 'Deni Rohyaman', 'POS', 'approve', '25/12/2019', '', '01/02/2001', '10/09/2017', '25/12/2021', 'Encashed', '', 'C', 0, '', '', '', '6', '', '', '2019-12-25 11:18:20'),
(88, '1070', 'Saif ur Rahman M. Asar', 'POS', 'approve', '25/12/2019', '', '24/10/2002', '15/05/2015', '25/12/2021', 'Encashed', '', 'C', 0, '', '', '', '19', '', '', '2019-12-25 11:19:28'),
(89, '4523', 'Abdulhameed Essam Dali', 'POS', 'approve', '25/12/2019', '', '22/10/2018', '22/10/2018', '25/12/2020', 'Encashed', '', 'C', 0, '', '', '', '66', '', '', '2019-12-25 11:20:26'),
(90, '1098', 'Mohammed Jamaluddin', 'POS', 'not_approve', '23/01/2020', '23/03/2020', '', '', '23/01/2022', 'annual', '', 'C', 0, 'Saepollah Sudin Yani', '', '', '24', 'Rejected from HR', '', '2019-12-29 12:13:21'),
(127, '42', 'Sajjad Hussain ', 'POS', 'approve', '03/12/2020', '', '03/12/2007', '15/12/2019', '03/12/2021', 'Encashed', '', 'C', 0, '', '', '', '86', 'encashment year 2020', '', '2021-01-03 11:22:03'),
(128, '1055', 'Atabur Rahman Taib', 'POS', 'approve', '26/05/2019', '', '08/10/2002', '26/05/2017', '26/05/2021', 'Encashed', '', 'C', 0, '', '', '', '14', 'vacation year 2019 enchashment ', '', '2021-01-03 11:32:03'),
(93, '1248', 'Mohammed Ikhlaq A. Rouf', 'Production ', 'approve', '02/02/2020', '01/04/2020', '05/11/2008', '01/02/2018', '02/02/2022', 'annual', '', 'C', 0, 'Yousuf Yakub Ali', '2476', '300', '43', '', '', '2020-01-08 06:51:15'),
(94, '1146', 'Anwar Hussain', 'POS', 'approve', '20/02/2020', '20/04/2020', '08/08/2004', '16/05/2018', '20/02/2022', 'annual', '', 'C', 0, 'Nur ul Huda Zain al Abidin', '2378', '300', '33', '', '', '2020-02-04 07:44:32'),
(95, '1114', 'Mukhtar Hussain', 'Warehouse', 'approve', '01/03/2020', '20/04/2020', '26/07/2003', '01/07/2018', '01/03/2022', 'annual', 'fly', 'C', 0, 'Mohammed Khalid', '2249', '300', '28', '', '', '2020-02-04 09:57:57'),
(96, '1178', 'Salem Noor Hussain', 'Maintenance', 'approve', '10/02/2020', '31/03/2020', '25/11/2007', '03/02/2018', '10/02/2022', '', '', 'C', 0, 'Abdul Rahman Hassan Matloob', '', '', '37', '', '', '2020-02-06 08:05:20'),
(97, '1098', 'Mohammed Jamaluddin', 'POS', 'approve', '20/02/2020', '20/04/2020', '17/03/2003', '24/07/2017', '20/02/2022', 'annual', '', 'C', 0, 'Abul Kashem Amin', '2300', '300', '24', '', '', '2020-02-06 08:10:23'),
(111, '1026', 'Saleem Irshadullah', 'Production ', 'approve', '01/09/2020', '20/10/2020', '12/06/2002', '01/04/2018', '01/04/2022', 'Local Vacation', '', 'C', 0, 'Mohammed Ikhlaq A. Rouf', '', '', '12', '', '', '2020-08-19 06:56:35'),
(99, '1026', 'Saleem Irshadullah', 'Production ', 'not_approve', '01/04/2020', '20/05/2020', '12/06/2002', '01/04/2018', '01/04/2022', '', '', 'C', 0, 'Mohammed Ikhlaq A. Rouf', '', '', '12', '', 'corona issue', '2020-03-22 08:06:22'),
(101, '4525', 'Azam Esam Mohammed Daly', 'POS', 'not_approve', '01/07/2020', '31/07/2020', '', '', '01/07/2021', '', '', 'C', 0, 'Zulfu Miah Siraj Miah', '', '', '221', 'Rejected from HR', '', '2020-07-05 07:53:12'),
(102, '4403', 'Hatoon Ehab Yousuf Jan', 'POS', 'not_approve', '01/07/2020', '31/07/2020', '', '', '01/07/2021', '', '', 'C', 0, 'Rosaline Aguilar Cabayao', '', '', '67', 'Rejected from HR', '', '2020-07-05 07:54:34'),
(103, '4435', 'Nahlah Ali Attiyah Al Harbi', 'POS', 'not_approve', '01/07/2020', '31/07/2020', '', '', '01/07/2021', '', '', 'C', 0, 'Fatimah Kamiran Disumimba', '', '', '125', 'Rejected from HR', '', '2020-07-05 08:01:54'),
(104, '4523', 'Abdulhameed Essam Dali', 'POS', 'not_approve', '01/07/2020', '31/07/2020', '', '', '01/07/2021', '', '', 'C', 0, 'Rezaul Karim', '', '', '66', 'Rejected from HR', '', '2020-07-05 08:18:38'),
(105, '4517', 'Othman Ahmed Bashanum', 'POS', 'not_approve', '01/07/2020', '31/07/2020', '', '', '01/07/2021', '', '', 'C', 0, 'Faruque Ahmed Md. Giashuddin', '', '', '63', 'Rejected from HR', '', '2020-07-05 08:31:19'),
(106, '82', 'Yasser Halaby', 'Sales Department', 'approve', '01/07/2020', '', '30/04/2012', '01/06/2018', '01/07/2022', 'Encashed', '', 'C', 0, '', '', '', '89', 'incash ', '', '2020-07-06 07:55:00'),
(107, '0157', 'Abeer Hassan Al Gamdi', 'HRD and Housing', 'approve', '18/03/2020', '26/03/2020', '08/09/2019', '', '18/03/2021', 'Local Vacation', '', 'C', 0, 'Abeer Hassan Al Gamdi', '', '', '225', '', '', '2020-07-12 10:33:18'),
(108, '148', 'Mohammed Al Khayyat', 'Purchase', 'approve', '01/02/2020', '01/03/2020', '05/02/2017', '17/12/2019', '01/02/2021', 'Local Vacation', '', 'C', 0, 'Mohammed Khairuddin', '', '', '96', '', '', '2020-07-12 10:45:24'),
(109, '147', 'Abdul Razak Al Fadl', 'Public Relation', 'approve', '01/09/2020', '', '01/09/2016', '04/12/2019', '01/09/2021', 'Encashed', '', 'C', 0, '', '', '', '95', '', '', '2020-08-18 08:25:49'),
(110, '0156', 'Daniah Mohammed Sadeeq Abushoshah', 'HRD and Housing', 'approve', '01/09/2020', '', '01/09/2019', '01/09/2019', '01/09/2021', 'Encashed', '', 'C', 0, '', '', '', '224', '', '', '2020-08-18 09:26:08'),
(112, '152', 'Anees Afzal', 'IT', 'approve', '30/09/2020', '', '30/09/2018', '25/12/2019', '30/09/2021', 'Encashed', '', 'C', 0, '', '', '', '98', '', '', '2020-08-19 07:26:42'),
(114, '4435', 'Nahlah Ali Attiyah Al Harbi', 'POS', 'approve', '01/10/2020', '31/10/2020', '18/03/2015', '06/05/2019', '01/10/2021', 'Local Vacation', '', 'C', 0, 'Hatoon Ehab Yousuf Jan', '', '', '125', 'start vacation 04/10/2020', '', '2020-09-22 08:19:34'),
(115, '4517', 'Othman Ahmed Bashanum', 'POS', 'not_approve', '01/10/2020', '31/10/2020', '', '', '01/10/2021', 'Local Vacation', '', 'C', 0, 'Azam Esam Mohammed Daly', '', '', '63', 'Rejected from HR', '', '2020-09-22 08:21:44'),
(116, '0157', 'Abeer Hassan Al Gamdi', 'HRD and Housing', 'approve', '01/10/2020', '30/10/2020', '08/09/2019', '08/09/2019', '08/09/2021', 'Local Vacation', '', 'C', 0, 'Daniah Mohammed Sadeeq Abushoshah', '', '', '225', '', '', '2020-10-13 12:10:24'),
(119, '1021', 'Basheer Vellaran', 'POS', 'approve', '01/12/2020', '31/12/2020', '08/05/2002', '31/10/2019', '01/12/2021', 'Fly', 'annual', 'C', 0, 'Sajjad Hussain ', '2460', '300', '8', '', '', '2020-11-09 08:32:27'),
(118, '4525', 'Azam Esam Mohammed Daly', 'POS', 'approve', '01/11/2020', '30/11/2020', '24/07/2019', '24/07/2019', '01/07/2021', 'Local Vacation', '', 'C', 0, 'Othman Ahmed Bashanum', '', '', '221', 'annual vacation year 2020', '', '2020-11-02 08:25:41'),
(120, '4523', 'Abdulhameed Essam Dali', 'POS', 'approve', '15/11/2020', '15/12/2020', '22/10/2018', '25/12/2019', '15/11/2021', 'Local Vacation', '', 'C', 0, 'Anwar Hussain', '', '', '66', 'ANNUAL VACATION ', '', '2020-11-09 08:35:53'),
(121, '149', 'Mohammed Sameer Halwani', 'Inspection', 'approve', '01/12/2020', '31/12/2020', '28/05/2017', '28/05/2019', '01/12/2021', 'Local Vacation', '', 'C', 0, 'Mohd. Washimuddin', '', '', '97', '', '', '2020-11-17 08:17:40'),
(122, '120', 'Hatim Shafi Felemban', 'Sales Department', 'approve', '15/12/2020', '14/01/2021', '15/02/2015', '15/12/2019', '15/12/2021', 'Local Vacation', '', 'C', 0, 'Hatim Shafi Felemban', '', '', '92', '', '', '2020-11-26 10:03:20'),
(123, '4519', 'Yousuf Salem Dosh Al Harithy', 'Production ', 'approve', '13/12/2020', '12/01/2021', '09/02/2017', '20/04/2019', '13/12/2021', 'Local Vacation', '', 'C', 0, 'Yousuf Yakub Ali', '', '', '64', '', '', '2020-11-30 08:19:41'),
(124, '4632', 'Omran Talal Saqati', 'POS', 'approve', '01/12/2020', '31/12/2020', '03/12/2019', '', '01/12/2021', 'Local Vacation', '', 'C', 0, 'Azam Esam Mohammed Daly', '', '', '228', '', '', '2020-12-06 08:48:20'),
(125, '4517', 'Othman Ahmed Bashanum', 'POS', 'approve', '07/12/2020', '06/01/2021', '12/10/2016', '01/11/2019', '07/12/2021', 'Local Vacation', '', 'C', 0, 'Rezaul Karim', '', '', '63', '', '', '2020-12-06 09:13:38'),
(126, '4620', 'Sultan Yassin Ahmed Al Delame', 'HRD and Housing', 'approve', '15/12/2020', '14/01/2021', '20/08/2015', '15/12/2019', '15/12/2021', 'Local Vacation', '', 'C', 0, 'Daniah Mohammed Sadeeq Abushoshah', '', '', '93', '', '', '2020-12-14 13:13:02'),
(129, '1024', 'Yousuf Abul Fayaz', 'Maintenance', 'approve', '31/07/2020', '', '07/06/2002', '25/12/2019', '31/07/2021', 'Encashed', '', 'C', 0, '', '', '', '11', '', '', '2021-01-03 11:38:33'),
(130, '1075', 'Kuttiman Pettikal', 'Maintenance', 'approve', '01/04/2020', '', '01/10/2002', '15/04/2019', '01/04/2021', 'Encashed', '', 'C', 0, '', '', '', '20', 'encashment year 2020 ', '', '2021-01-03 11:39:14'),
(131, '18', 'Rasheed Mambrathodi', 'Finance', 'approve', '02/03/2020', '', '02/03/2003', '01/10/2019', '19/09/2021', 'Encashed', '', 'C', 0, '', '', '', '84', 'year 2020 he will take encashment because corona ', '', '2021-01-03 11:44:45'),
(132, '1038', 'Siddiq Kallingal', 'Production ', 'approve', '31/12/2020', '', '02/03/2001', '02/02/2019', '31/12/2021', 'Encashed', '', 'C', 0, '', '', '', '13', 'encashment year 2020 ', '', '2021-01-04 13:16:22'),
(133, '1403', 'Yousuf Yakub Ali', 'Production ', 'not_approve', '30/01/2021', '30/03/2021', '', '', '28/03/2023', 'Fly', 'annual', 'C', 0, 'Mohammed Ikhlaq A. Rouf', '', '', '56', 'Rejected from HR', '', '2021-01-12 07:43:41'),
(134, '1403', 'Yousuf Yakub Ali', 'Production ', 'approve', '30/01/2021', '30/03/2021', '07/07/2013', '12/01/2019', '30/01/2023', 'Fly', 'annual', 'C', 0, 'Mohammed Ikhlaq A. Rouf', '2500', '300', '56', '', '', '2021-01-12 07:46:44'),
(135, '1116', 'Shabbir Ahmed Mannan', 'POS', 'approve', '25/01/2021', '26/03/2021', '09/12/2000', '08/01/2019', '08/01/2022', 'Fly', 'annual', 'C', 0, 'Atabur Rahman Taib', '2500', '300', '5', '', '', '2021-01-17 06:50:32'),
(136, '1163', 'Nur Mohammed Mofiz', 'POS', 'approve', '25/01/2021', '26/03/2021', '02/11/2004', '01/01/2018', '25/01/2023', 'Fly', 'annual', 'C', 0, 'Ujjal Miah Shahlam', '2500', '300', '35', '', '', '2021-01-17 06:57:47'),
(137, '1323', 'Abdul Rahman Hassan Matloob', 'Maintenance', 'approve', '15/01/2021', '15/02/2021', '25/10/2010', '01/02/2019', '15/01/2023', 'Local Vacation', '', 'C', 0, 'Salem Noor Hussain', '', '', '47', '', '', '2021-01-17 06:59:52'),
(138, '1077', 'Mohd. Washimuddin', 'Inspection', 'not_approve', '10/02/2021', '11/04/2021', '', '', '10/02/2023', 'Fly', 'annual', 'C', 0, 'Mohammed Sameer Halwani', '', '', '21', 'Rejected from HR', '', '2021-02-02 11:48:34'),
(139, '0156', 'Daniah Mohammed Sadeeq Abushoshah', 'HR and Housing', 'approve', '08/03/2021', '14/03/2021', '01/09/2019', '01/09/2020', '01/09/2022', 'Local Vacation', '', 'C', 0, 'ALaa Taha Abu Alola ', '', '', '224', '', '', '2021-03-01 13:04:10'),
(140, '4403', 'Hatoon Ehab Yousuf Jan', 'POS', 'approve', '13/04/2021', '12/05/2021', '21/02/2013', '01/09/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Jahangir Hussain', '', '', '67', '', '', '2021-04-11 06:07:32'),
(141, '4435', 'Nahlah Ali Attiyah Al Harbi', 'POS', 'approve', '13/04/2021', '13/05/2021', '18/03/2015', '01/10/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Jahangir Hussain', '', '', '125', '', '', '2021-04-11 06:12:30'),
(142, '4517', 'Othman Ahmed Bashanum', 'POS', 'approve', '13/04/2021', '13/05/2021', '12/10/2016', '07/12/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Rezaul Karim', '', '', '63', '', '', '2021-04-12 09:31:29'),
(143, '4523', 'Abdulhameed Essam Dali', 'POS', 'approve', '13/04/2021', '13/05/2021', '22/10/2018', '15/11/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'M.Momen Mian', '', '', '66', '', '', '2021-04-12 09:33:26'),
(144, '4525', 'Azam Esam Mohammed Daly', 'POS', 'approve', '13/04/2021', '13/05/2021', '24/07/2019', '01/10/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Jahangir Hussain', '', '', '221', '', '', '2021-04-12 09:35:59'),
(145, '4632', 'Omran Talal Saqati', 'POS', 'approve', '13/04/2021', '13/05/2021', '03/12/2019', '01/12/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Mohammed Ibrahim Khalil', '', '', '228', '', '', '2021-04-12 09:39:09'),
(146, '4637', 'Ammar Shaker', 'POS', 'approve', '13/04/2021', '13/05/2021', '02/09/2020', '01/12/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Faruque Ahmed Md. Giashuddin', '', '', '237', '', '', '2021-04-12 09:40:25'),
(147, '4638', 'MEHAD SAMI ABDULHAMEED BAKHASH ', 'POS', 'approve', '13/04/2021', '13/05/2021', '12/10/2020', '12/10/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Mazin Tafazzul', '', '', '239', '', '', '2021-04-12 12:12:23'),
(148, '4643', 'MOHAMMED FAHAD AL MULLA', 'POS', 'approve', '13/04/2021', '13/05/2021', '08/12/2020', '08/12/2020', '13/04/2022', 'Local Vacation', '', 'C', 0, 'Nawaf Fahad Mohammed Al Mulla ', '', '', '241', '', '', '2021-04-13 08:13:42'),
(149, '1007', 'Abdul Jamal Devakana', 'Administration', 'not_approve', '14/04/2021', '13/06/2021', '09/12/2000', '01/05/2018', '14/04/2023', 'Fly', 'annual', 'C', 0, 'Abdul Jamal Devakana', '1170', '300', '4', '', 'employee cancee vacation ', '2021-04-13 09:50:28'),
(150, '1400', 'Mohammed Syed Hussain', 'Maintenance', 'approve', '01/05/2021', '', '01/05/2013', '09/01/2019', '01/06/2023', 'Encashed', '', 'C', 0, '', '', '', '54', 'encashment because no replacement ', '', '2021-05-25 06:14:11'),
(151, '152', 'Anees Afzal', 'IT', 'approve', '09/06/2021', '', '30/09/2018', '30/09/2020', '09/06/2022', 'Encashed', '', 'C', 30, '', '', '', '98', 'encashment 2021', '', '2021-06-09 09:22:02'),
(152, '1351', 'Haris Vadekkepurath', 'POS', 'approve', '01/07/2021', '30/08/2021', '25/06/2011', '11/04/2018', '01/07/2023', 'Fly', 'annual', 'A', 60, 'Deni Rohyaman', '1600', '300', '49', '???????? 31/07/2020 ???? ?????? ????? ', '', '2021-06-16 11:41:49'),
(153, '1217', 'Md. Jashimuddin', 'POS', 'approve', '01/07/2021', '30/08/2021', '15/09/2007', '30/11/2018', '31/07/2022', 'Fly', 'annual', 'A', 60, 'Moynal Hossain', '1600', '300', '40', 'should be take vacation on 31/07/2021', '', '2021-06-16 11:44:10'),
(154, '1402', 'Nurul Islam Abdul Hakim', 'Transportation', 'approve', '01/07/2021', '', '24/06/2013', '20/12/2019', '01/07/2023', 'Encashed', '', 'C', 60, '', '', '', '55', 'encashment annual vacation 2021 ', '', '2021-06-29 06:37:43'),
(155, '1412', 'Abdul HaiAbdul Matloob', 'Warehouse', 'approve', '01/07/2021', '', '05/01/2014', '20/12/2019', '01/07/2023', 'Encashed', '', 'C', 60, '', '', '', '61', ' encashment vacation 2021', '', '2021-06-29 07:55:12'),
(156, '1038', 'Siddiq Kallingal', 'Production ', 'not_approve', '18/07/2021', '17/08/2021', '', '', '18/07/2022', 'Fly', 'annual', 'C', 30, 'Saleem Irshadullah', '', '', '13', 'Rejected from HR', '', '2021-06-29 09:15:14'),
(157, '1007', 'Abdul Jamal Devakana', 'Administration', 'approve', '30/06/2021', '29/08/2021', '09/12/2000', '01/05/2018', '30/06/2023', 'Fly', 'annual', 'C', 60, 'Abdul Jamal Devakana', '1600', '400', '4', '', '', '2021-06-30 13:09:17'),
(165, '1023', 'Aslam Umar Kutty ', 'POS', 'approve', '15/09/2021', '14/11/2021', '15/05/2002', '03/04/2019', '15/09/2023', 'Fly', 'annual', 'A', 60, 'Munir Kursila Kandy', '2374', '300', '10', '', '', '2021-08-30 11:03:14'),
(159, '1038', 'Siddiq Kallingal', 'Production ', 'approve', '21/08/2021', '20/09/2021', '02/03/2001', '31/12/2020', '21/08/2022', 'Fly', 'annual', 'C', 30, 'Saleem Irshadullah', '2485', '200', '13', '', '', '2021-08-01 10:38:22'),
(160, '4639', 'ALaa Taha Abu Alola ', 'HR and Housing', 'approve', '04/08/2021', '08/08/2021', '08/11/2020', '08/11/2020', '04/08/2022', 'Local Vacation', '', 'C', 4, 'Daniah Mohammed Sadeeq Abushoshah', '', '', '238', '', '', '2021-08-02 12:59:54'),
(161, '1077', 'Mohd. Washimuddin', 'Inspection', 'approve', '16/08/2021', '15/10/2021', '24/11/2002', '07/01/2019', '16/08/2023', 'Fly', 'annual', 'C', 60, 'Mohammed Sameer Halwani', '3200', '300', '21', '', '', '2021-08-04 06:20:07'),
(162, '0156', 'Daniah Mohammed Sadeeq Abushoshah', 'HR and Housing', 'approve', '15/08/2021', '22/08/2021', '01/09/2019', '01/09/2020', '01/09/2022', 'Local Vacation', '', 'C', 7, 'ALaa Taha Abu Alola ', '', '', '224', '', '', '2021-08-10 09:57:41'),
(164, '141', 'Mohammed Khairuddin', 'Warehouse', 'not_approve', '15/10/2021', '25/11/2021', '22/11/2015', '01/06/2019', '15/10/2023', 'Fly', 'annual', 'C', 41, 'Ishak Abdulmatloob', '2500', '300', '94', '', 'date not correct ', '2021-08-28 15:40:47'),
(166, '1067', 'Alamgir Gulam Rasoul', 'POS', 'approve', '01/04/2020', '', '15/10/2002', '18/05/2018', '01/04/2022', 'Encashed', '', 'C', 60, '', '', '', '18', '', '', '2021-09-08 11:47:58'),
(167, '4416', 'Rosaline Aguilar Cabayao', 'POS', 'approve', '01/04/2021', '', '28/09/2013', '07/05/2019', '01/04/2023', 'Encashed', '', 'C', 60, '', '', '', '69', 'encashment year 2021', '', '2021-09-08 11:50:08'),
(168, '1112', 'Mohd. Refon Miah', 'POS', 'apply', '01/11/2020', '', '', '', '01/11/2022', 'Encashed', '', 'A', 60, '', '', '', '26', '', '', '2021-09-08 12:09:11'),
(169, '4636', 'Ebtihal Adnan Sait ', 'Purchase', 'approve', '12/09/2021', '19/09/2021', '02/09/2020', '', '12/09/2022', 'Local Vacation', '', 'C', 7, 'HAMSAH FOUAD KURDI', '', '', '236', '', '', '2021-09-09 08:34:04'),
(171, '42', 'Sajjad Hussain ', 'POS', 'approve', '24/10/2021', '23/11/2021', '03/12/2007', '03/12/2020', '24/10/2022', 'Fly', 'annual', 'A', 30, 'Basheer Vellaran', '1950', '300', '86', '', '', '2021-09-14 12:24:37'),
(172, '141', 'Mohammed Khairuddin', 'Warehouse', 'approve', '20/10/2021', '19/12/2021', '22/11/2015', '01/06/2019', '20/10/2023', 'Fly', 'annual', 'A', 60, 'Ishak Abdulmatloob', '2140', '300', '94', '', '', '2021-09-14 16:50:35'),
(173, '82', 'Yasser Halaby', 'Sales', 'approve', '09/10/2021', '26/10/2021', '30/04/2012', '01/07/2020', '04/10/2023', 'Fly', 'emergency', 'A', 0, 'Yasser Halaby', '', '', '89', 'deduct from vacation balance  year 2022', '', '2021-09-21 06:14:10'),
(174, '147', 'Abdul Razak Al Fadl', 'Public Relation', 'approve', '01/09/2021', '', '01/02/2020', '01/09/2020', '01/09/2022', 'Encashed', '', 'C', 30, '', '', '', '95', 'he request by email encashment ', '', '2021-09-27 05:58:40'),
(175, '49', 'Abdul Wahab A. Ghafoor', 'Inspection', 'apply', '17/10/2021', '31/10/2021', '', '', '17/10/2023', 'Fly', 'annual', 'A', 14, 'Mohd. Washimuddin', '', '', '88', '', '', '2021-10-17 07:19:01');

--
-- Triggers `apply_vacation`
--
DELIMITER $$
CREATE TRIGGER `a_d_apply_vac_dep` AFTER DELETE ON `apply_vacation` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'apply_vac_dep';						SET @pk_d = CONCAT('<id>',OLD.`id`,'</id>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						IF @rs = 1 THEN 						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						END IF; 						IF @rs > 1 THEN 						UPDATE `history_store` SET `timemark` = @time_mark, `record_state` = 3, `pk_date_src` = `pk_date_dest` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						END IF; 						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_apply_vac_dep` AFTER INSERT ON `apply_vacation` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'cvb'; 						SET @tbl_name = 'apply_vac_dep'; 						SET @pk_d = CONCAT('<id>',NEW.`id`,'</id>'); 						SET @rec_state = 1;						UPDATE `history_store` SET `pk_date_dest` = `pk_date_src` WHERE `table_name` = @tbl_name AND `pk_date_dest` = @pk_d AND (`record_state` = 2 OR `record_state` = 1); 						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_dest` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_apply_vac_dep` AFTER UPDATE ON `apply_vacation` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'apply_vac_dep';						SET @pk_d_old = CONCAT('<id>',OLD.`id`,'</id>');						SET @pk_d = CONCAT('<id>',NEW.`id`,'</id>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_vacation`
--
ALTER TABLE `apply_vacation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_vacation`
--
ALTER TABLE `apply_vacation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
