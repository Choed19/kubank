-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 08:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kubank`
--

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE `statement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('Deposit','Withdraw') NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statement`
--

INSERT INTO `statement` (`id`, `user_id`, `created_at`, `status`, `value`) VALUES
(1, 1, '2023-03-01 00:24:36', '', '1200.00'),
(2, 1, '2023-03-01 00:48:20', 'Withdraw', '1200.00'),
(3, 1, '2023-03-01 00:48:54', '', '500.00'),
(4, 1, '2023-03-01 00:50:11', '', '500.00'),
(5, 1, '2023-03-01 00:50:30', '', '500.00'),
(6, 1, '2023-03-01 00:54:35', 'Withdraw', '421900.00'),
(7, 1, '2023-03-01 00:56:18', 'Withdraw', '10000.00'),
(8, 1, '2023-03-01 00:57:09', 'Withdraw', '100000.00'),
(9, 1, '2023-03-01 00:59:19', 'Withdraw', '900.00'),
(10, 1, '2023-03-01 01:01:52', 'Withdraw', '100.00'),
(11, 1, '2023-03-01 01:02:37', 'Withdraw', '20000.00'),
(12, 1, '2023-03-01 01:09:11', 'Deposit', '600.00'),
(13, 1, '2023-03-01 01:15:53', 'Deposit', '18200.00'),
(14, 1, '2023-03-01 01:20:26', 'Withdraw', '311000.00'),
(15, 1, '2023-03-01 01:26:39', 'Deposit', '500.00'),
(16, 1, '2023-03-01 01:29:24', 'Deposit', '10000.00'),
(17, 1, '2023-03-01 04:55:32', 'Deposit', '99999999.99'),
(18, 1, '2023-03-01 04:56:33', 'Withdraw', '99999999.99'),
(19, 1, '2023-03-01 05:18:21', 'Withdraw', '10000.00'),
(20, 1, '2023-03-01 05:19:24', 'Withdraw', '10000.00'),
(21, 1, '2023-03-01 05:24:34', 'Withdraw', '19000.00'),
(22, 1, '2023-03-01 05:25:03', 'Withdraw', '50000.00'),
(23, 1, '2023-03-01 05:25:13', 'Withdraw', '120000.00'),
(24, 1, '2023-03-01 06:34:09', 'Withdraw', '5.00'),
(25, 1, '2023-03-01 14:20:52', 'Withdraw', '12000.00'),
(26, 1, '2023-03-01 14:20:56', 'Withdraw', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `users` varchar(25) NOT NULL,
  `deposit` int(25) DEFAULT NULL,
  `withdraw` int(25) DEFAULT NULL,
  `amount` int(25) NOT NULL,
  `balance` int(25) NOT NULL,
  `search` varchar(25) NOT NULL,
  `show` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users`, `deposit`, `withdraw`, `amount`, `balance`, `search`, `show`, `username`, `password`) VALUES
(1, '', NULL, NULL, 0, 1199271, '', '', 'Choedchai', '0101'),
(2, '', NULL, NULL, 0, 1000, '', '', 'Janjira', '0202'),
(3, '', NULL, NULL, 0, 99600, '', '', 'Rahumyai', '0303'),
(4, '', NULL, NULL, 0, 0, '', '', 'Ankana', '0404'),
(5, '', NULL, NULL, 0, 0, '', '', 'Fahlung', '0505'),
(6, '', NULL, NULL, 0, 0, '', '', 'Kumtoto', '0606');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `statement`
--
ALTER TABLE `statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `statement`
--
ALTER TABLE `statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
