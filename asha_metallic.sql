-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2019 at 10:40 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asha_metallic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendence`
--

DROP TABLE IF EXISTS `tbl_attendence`;
CREATE TABLE IF NOT EXISTS `tbl_attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `attendence_status` varchar(255) NOT NULL DEFAULT '0',
  `overtime` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendence`
--

INSERT INTO `tbl_attendence` (`id`, `name`, `designation`, `attendence_status`, `overtime`, `date`) VALUES
(1, '', '', '1', 0, '2019-09-25 04:51:02'),
(2, '', '', '1', 0, '2019-09-30 04:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

DROP TABLE IF EXISTS `tbl_bill`;
CREATE TABLE IF NOT EXISTS `tbl_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '0',
  `item_name` varchar(255) NOT NULL,
  `total_item` int(11) NOT NULL DEFAULT '1',
  `item_description` text NOT NULL,
  `total_price` int(11) NOT NULL DEFAULT '0',
  `paid_amount` int(11) NOT NULL DEFAULT '0',
  `bill_no` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_phone` int(11) NOT NULL DEFAULT '0',
  `institute_name` varchar(255) NOT NULL DEFAULT 'Empty',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`id`, `image`, `item_name`, `total_item`, `item_description`, `total_price`, `paid_amount`, `bill_no`, `client_name`, `client_phone`, `institute_name`, `date`) VALUES
(24, 'uploads/bill_img/f52690d65f.jpg', 'Backing crest', 2, 'Backing crest for 6&quot;X8&quot;', 3000, 0, 2, 'Labukhali', 1787377982, 'Labukhali Cantonment', '2019-10-02 11:47:49'),
(25, 'uploads/bill_img/85e3f69a21.jpg', 'SS Car Nameplate', 1, '1 set==2pcs. SS Car nameplate alcobon pasting 20&quot;X5&quot; =&gt;1pcs, 18&quot;x5&quot; =&gt;1pcs', 3500, 0, 1, 'Maj Noor', 1769102416, '65 INF BID', '2019-10-14 10:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

DROP TABLE IF EXISTS `tbl_client`;
CREATE TABLE IF NOT EXISTS `tbl_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`id`, `institute_name`, `owner_name`, `address`, `entry_date`) VALUES
(1, 'AFD', 'Mustafiz', 'Dhaka cantonment', '2019-09-23 13:41:46'),
(2, 'Army Aviation', 'Musaddek', 'Jahangir gate', '2019-09-23 13:41:46'),
(3, '14 Eng Bir', 'Rafiq sir', 'MES, Dhaka Cantonment', '2019-09-23 13:41:46'),
(4, '65 INF BID', 'Maj Noor', 'Ramu, Cox\'s Bazar', '2019-10-14 10:03:24'),
(5, 'Labukhali Cantonment', '.....', 'Potuakhali, Labukhali', '2019-10-14 10:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

DROP TABLE IF EXISTS `tbl_employee`;
CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `salary` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `image`, `designation`, `joining_date`, `salary`) VALUES
(8, 'Ripon', 'uploads/employee_img/dd496a93da.jpg', 'Mechanic helper', '2018-06-01', 11000),
(9, 'Monir', 'uploads/employee_img/370bd188d7.jpg', 'Helper', '2018-06-07', 5000),
(7, 'Badon', 'uploads/employee_img/9dae9bf268.jpg', 'Head Mechanic', '2019-08-19', 15000),
(6, 'Aminul islam peal', 'uploads/employee_img/5f932e5a0f.jpg', 'Manger/ Designer', '2019-01-02', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger`
--

DROP TABLE IF EXISTS `tbl_ledger`;
CREATE TABLE IF NOT EXISTS `tbl_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `amount` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ledger`
--

INSERT INTO `tbl_ledger` (`id`, `date`, `description`, `amount`, `image`) VALUES
(4, '2019-10-02 11:49:42', 'à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;à¦¸à¦¿à¦°à¦¿à¦œ à¦•à¦¾à¦—à¦œ&quot;', 50, 'uploads/office_cost_bill/e72d95a0be.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary`
--

DROP TABLE IF EXISTS `tbl_salary`;
CREATE TABLE IF NOT EXISTS `tbl_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `overtime` varchar(255) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `advance` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_salary`
--

INSERT INTO `tbl_salary` (`id`, `name`, `month`, `year`, `amount`, `overtime`, `paid_date`, `advance`) VALUES
(13, 'Badon', 'Septemer', '2019', 15000, '7', '2019-10-01 06:04:27', 0),
(12, 'Aminul islam peal', 'August', '2019', 12000, '10', '2019-10-01 05:53:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_advanced`
--

DROP TABLE IF EXISTS `tbl_salary_advanced`;
CREATE TABLE IF NOT EXISTS `tbl_salary_advanced` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `taka` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_salary_advanced`
--

INSERT INTO `tbl_salary_advanced` (`id`, `name`, `taka`, `description`, `date`) VALUES
(3, 'Ripon', 3500, 'aaaaaaaaaaaa', '2019-09-25 07:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'Enter your Address',
  `user_rule` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `userpass`, `address`, `user_rule`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Enter your Address', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
