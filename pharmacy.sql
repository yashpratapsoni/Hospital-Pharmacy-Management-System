-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 08:00 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` tinyint(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cashier_id` tinyint(5) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashier_id`, `first_name`, `last_name`, `staff_id`, `postal_address`, `phone`, `email`, `username`, `password`, `date`) VALUES
(4, 'munene', 'ewdsc', '67hhtf', '45 nhyfg', '65424579', 'will@henry.com', 'gty', 'gett5', '2013-11-23 12:54:49'),
(5, 'Sam', 'Osoro', 'Pharmacy/C', '76 nairobi', '09865468', 'samwel@pharmacy.com', 'samm', '1234', '2013-11-25 20:20:44'),
(6, 'sam', 'wagura', 'ph98', '4468', '0712143658', 'simowagura9@gmail.co', 'sam', 'sam', '2018-05-24 16:29:58'),
(7, 'ian', 'hombres', 'cs04', '145 maseno', '0719553317', '1anhombres@gmail.com', 'ian1', 'ian1', '2018-06-03 02:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(255) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `tot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `id` int(11) NOT NULL,
  `drug_id` varchar(255) NOT NULL,
  `intial_cost` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drugtype`
--

CREATE TABLE `drugtype` (
  `id` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugtype`
--

INSERT INTO `drugtype` (`id`, `description`, `category`) VALUES
(1, 'Tablets', 'Painkiller'),
(2, 'Syrup', 'Malaria'),
(3, 'Tubes/bottles', 'Reproductive'),
(4, 'Others', 'Stomach relief');

-- --------------------------------------------------------

--
-- Table structure for table `ids`
--

CREATE TABLE `ids` (
  `userid` int(255) NOT NULL,
  `ids` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ids`
--

INSERT INTO `ids` (`userid`, `ids`, `invoice_id`) VALUES
(1, '1901093', '10'),
(2, '1901093', '10'),
(3, '1901093', '10');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(255) NOT NULL,
  `invoice_id` int(255) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `served_by` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Unpaid',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_id`, `customer_name`, `served_by`, `status`, `date`) VALUES
(1, 10, 'simon wagura gatu', '2342', 'Pending', '2018-07-26 06:29:42'),
(2, 10, 'simon wagura gatu', '2342', 'Pending', '2018-07-26 06:30:59'),
(3, 10, 'simon wagura gatu', '2342', 'Pending', '2018-07-26 06:31:18');

--
-- Triggers `invoice`
--
DELIMITER $$
CREATE TRIGGER `tarehe` AFTER INSERT ON `invoice` FOR EACH ROW BEGIN
     SET @date=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(5) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `cost` int(5) DEFAULT NULL,
  `quantity` int(5) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice`, `drug`, `cost`, `quantity`, `day`, `month`, `year`) VALUES
(1, '10', '5', 10, 21, '26', 'July', '2018'),
(2, '10', '5', 10, 21, '26', 'July', '2018'),
(3, '10', '9', 12, 10, '26', 'July', '2018'),
(4, '10', '5', 10, 21, '26', 'July', '2018'),
(5, '10', '9', 12, 10, '26', 'July', '2018'),
(6, '10', '32', 22, 4, '26', 'July', '2018');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_id` tinyint(5) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `first_name`, `last_name`, `staff_id`, `postal_address`, `phone`, `email`, `username`, `password`, `date`) VALUES
(1, 'Samwelo', 'Osorot', 'sam/pharm', '456 Kabu', '0789653417', 'osorot@gmail.com', 'samoso', '12345', '2013-12-10 14:09:03'),
(2, 'sam', 'wagura', 'ad02', '322 nyeri', '0712143658', 'simowagura254@gmail.', 'sam', 'sam', '2018-06-03 02:47:16'),
(3, 'kris', 'kombe', '5676', '122 nyeri', '0705798345', 'kk@gmail.com', '123', '123', '2018-06-19 13:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `paymenttypes`
--

CREATE TABLE `paymenttypes` (
  `id` tinyint(5) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymenttypes`
--

INSERT INTO `paymenttypes` (`id`, `Name`) VALUES
(1, 'Cash'),
(2, 'Credit card'),
(3, 'Mobile Money'),
(4, 'Cheque'),
(5, '');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `pharmacist_id` tinyint(5) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`pharmacist_id`, `first_name`, `last_name`, `staff_id`, `postal_address`, `phone`, `email`, `username`, `password`, `date`) VALUES
(6, 'Gerald1', 'Wangai', 'ph54', '07665', '0705798345', 'gwangai@gmail.com', 'gerald', '123', '2018-05-24 16:26:59'),
(7, 'paulo', 'wamocha', '290', '2342', '0712143658', 'simowagura9@gmail.co', '123', '123', '2018-05-25 09:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(5) NOT NULL,
  `prescription_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `prescription_id`, `customer_id`, `customer_name`, `invoice_id`, `phone`, `date`) VALUES
(1, '999', 1901093, 'simon wagura gatu', '10', '0728441045', '2018-07-26 06:29:41');

--
-- Triggers `prescription`
--
DELIMITER $$
CREATE TRIGGER `taree` AFTER INSERT ON `prescription` FOR EACH ROW BEGIN
SET@date=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

CREATE TABLE `prescription_details` (
  `id` int(5) NOT NULL,
  `pres_id` int(5) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `strength` varchar(15) NOT NULL,
  `dose` varchar(15) NOT NULL,
  `quantity` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`id`, `pres_id`, `drug_name`, `strength`, `dose`, `quantity`) VALUES
(1, 999, '5', '10 mg', '1x3', '21'),
(2, 999, '5', '10 mg', '1x3', '21'),
(3, 999, '9', '5 mg', '1x2', '10'),
(4, 999, '5', '10 mg', '1x3', '21'),
(5, 999, '9', '5 mg', '1x2', '10'),
(6, 999, '5', '10 mg', '1x3', '21'),
(7, 999, '9', '5 mg', '1x2', '10'),
(8, 999, '32', '100mg', '1x2 ', '4'),
(9, 999, '5', '10 mg', '1x3', '21'),
(10, 999, '9', '5 mg', '1x2', '10'),
(11, 999, '32', '100mg', '1x2 ', '4'),
(12, 999, '5', '10 mg', '1x3', '21'),
(13, 999, '9', '5 mg', '1x2', '10'),
(14, 999, '32', '100mg', '1x2 ', '4');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `reciptNo` int(10) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `total` int(10) NOT NULL,
  `payType` varchar(10) NOT NULL,
  `serialno` varchar(10) DEFAULT NULL,
  `served_by` varchar(15) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`reciptNo`, `customer_id`, `total`, `payType`, `serialno`, `served_by`, `date`) VALUES
(1, '1901093', 88, 'Cash', '10002', 'sam', 'Thursday, July 26 2018, 08:32:10 AM');

--
-- Triggers `receipts`
--
DELIMITER $$
CREATE TRIGGER `siku` AFTER INSERT ON `receipts` FOR EACH ROW BEGIN
     SET @date=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `userid` int(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`userid`, `invoice`, `drug`, `cost`, `quantity`, `day`, `month`, `year`) VALUES
(1, '10', '5', '10', '21', '26', 'July', '2018'),
(2, '10', '9', '12', '10', '26', 'July', '2018'),
(3, '10', '32', '22', '4', '26', 'July', '2018');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` tinyint(5) NOT NULL,
  `drug_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `strength` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_supplied` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `drug_name`, `category`, `description`, `company`, `supplier`, `strength`, `quantity`, `cost`, `status`, `date_supplied`) VALUES
(5, 'Piriton', 'Tablets', 'Painkiller', 'SB', 'SB', '10 mg', 59, 10, 'enough', '2013-11-30'),
(6, 'Dual Cotexin', 'Tablets', 'Malaria', 'GX', 'Clinix', '30 mg', 110, 120, 'enough', '2013-11-30'),
(7, 'Naproxen', 'Tablets', 'Reproductive', 'Family Health', 'Stopes', '15 mg', 201, 50, 'enough', '2013-11-30'),
(9, 'Actal', 'Tablets', 'Stomach Reliev', 'GX', 'Clinix', '5 mg', 79, 12, 'enough', '2013-12-06'),
(28, 'Clostrine', 'Tubes/bottles', 'Reproductive', 'clostrine', 'Beta health care', '100 mg', 143, 70, 'enough', '2018-06-04'),
(29, 'cetrix', 'Tablets', 'Painkiller', 'Beta health care', 'Beta health care', '200mg', 88, 10, 'enough', '2018-06-07'),
(32, 'celastemine', 'Tablets', 'Painkiller', 'Beta health care', 'Beta health care', '100mg', 85, 30, 'enough', '2018-06-19'),
(33, 'grrytttf', 'Tablets', 'Painkiller', 'Beta health care', 'Beta health care', '200mg', 101, 12, 'enough', '2018-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `tempo`
--

CREATE TABLE `tempo` (
  `userid` int(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `strength` varchar(255) NOT NULL,
  `dose` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tempprescri`
--

CREATE TABLE `tempprescri` (
  `userid` int(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `drug_name` varchar(30) NOT NULL,
  `strength` varchar(30) NOT NULL,
  `dose` varchar(30) NOT NULL,
  `quantity` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempprescri`
--

INSERT INTO `tempprescri` (`userid`, `customer_id`, `customer_name`, `phone`, `drug_name`, `strength`, `dose`, `quantity`) VALUES
(1, '1901093', 'simon wagura gatu', '0728441045', 'Piriton', '10 mg', '1x3', '21'),
(2, '1901093', 'simon wagura gatu', '0728441045', 'Actal', '5 mg', '1x2', '10'),
(3, '1901093', 'simon wagura gatu', '0728441045', 'celastemine', '100mg', '1x2 ', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugtype`
--
ALTER TABLE `drugtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ids`
--
ALTER TABLE `ids`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `paymenttypes`
--
ALTER TABLE `paymenttypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`pharmacist_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_details`
--
ALTER TABLE `prescription_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`reciptNo`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tempo`
--
ALTER TABLE `tempo`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tempprescri`
--
ALTER TABLE `tempprescri`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cashier_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drugtype`
--
ALTER TABLE `drugtype`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ids`
--
ALTER TABLE `ids`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymenttypes`
--
ALTER TABLE `paymenttypes`
  MODIFY `id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `pharmacist_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescription_details`
--
ALTER TABLE `prescription_details`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `reciptNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tempo`
--
ALTER TABLE `tempo`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tempprescri`
--
ALTER TABLE `tempprescri`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
