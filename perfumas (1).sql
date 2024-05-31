-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 07:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perfumas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(50) NOT NULL,
  `a_email` varchar(50) NOT NULL,
  `a_password` varchar(255) NOT NULL,
  `a_phone_num` int(9) NOT NULL,
  `a_address` text NOT NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_email`, `a_password`, `a_phone_num`, `a_address`, `super_admin`) VALUES
(3, 'Moa\'ath Al-Maswri', 'moaath@11.m', '$2y$10$aj1F8VboXEvbuqUkjBB78.6YZuDgHGtWeyJ2fj4zLzdjMUIRdUzTu', 773509770, 'hadah', 1),
(6, 'MR.MAS', 'mrmas@11.m', '$2y$10$7lRVOQ6wuvlyCyNwFjTWXuTVVwZxBceznEHUAiOUj7VnwRI.yt/Lm', 788, 'shamlan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `c_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `active`, `c_date`) VALUES
(1, 'men', 1, '2024-01-22'),
(2, 'women', 1, '2024-01-22'),
(3, 'both', 1, '2024-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `perfume`
--

CREATE TABLE `perfume` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_cat_id` int(1) NOT NULL,
  `p_price` decimal(10,0) NOT NULL,
  `p_qua` int(11) NOT NULL,
  `p_img` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `p_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `perfume`
--

INSERT INTO `perfume` (`p_id`, `p_name`, `p_cat_id`, `p_price`, `p_qua`, `p_img`, `available`, `p_date`) VALUES
(3, 'er', 1, 21212, 2309, '2 (4).jpg', 1, '2024-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `s_id` int(10) UNSIGNED NOT NULL,
  `su_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `s_price` decimal(10,0) NOT NULL,
  `s_qua` int(11) NOT NULL,
  `s_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`s_id`, `su_id`, `sp_id`, `s_price`, `s_qua`, `s_date`) VALUES
(2, 2, 3, 21212, 1, '2024-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_pay_num` int(10) NOT NULL,
  `u_phone_num` int(9) NOT NULL,
  `u_address` text NOT NULL,
  `u_date` date NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_email`, `u_password`, `u_pay_num`, `u_phone_num`, `u_address`, `u_date`, `active`) VALUES
(2, 'mas', 'mas@11.m', '$2y$10$OPmVtUfd95UUXbvHPYQSy.6lENC4PoQv7j0ai6IJH5Oh8A7YY2V72', 111, 777, 'hada', '2024-01-31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `u_email` (`a_email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_name` (`c_name`);

--
-- Indexes for table `perfume`
--
ALTER TABLE `perfume`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_name` (`p_name`),
  ADD UNIQUE KEY `p_img` (`p_img`),
  ADD UNIQUE KEY `p_img_2` (`p_img`),
  ADD UNIQUE KEY `p_img_3` (`p_img`),
  ADD KEY `p_cat_id` (`p_cat_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `usere` (`su_id`),
  ADD KEY `perfume` (`sp_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perfume`
--
ALTER TABLE `perfume`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `s_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perfume`
--
ALTER TABLE `perfume`
  ADD CONSTRAINT `perfume_ibfk_1` FOREIGN KEY (`p_cat_id`) REFERENCES `category` (`c_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `perfume` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
