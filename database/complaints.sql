-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 05:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaints`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` varchar(20) NOT NULL,
  `area_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_name`) VALUES
('1', 'شمال المدينة'),
('2', 'شرق المدينة'),
('3', 'غرب المدينة'),
('4', 'جنوب المدينة');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` varchar(20) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
('8', 'اخرى'),
('3', 'خدمات الصحية'),
('2', 'خدمات الصرف الصحي'),
('5', 'خدمات الطرق'),
('7', 'خدمات الكهرباء'),
('6', 'خدمات المواصلات'),
('4', 'خدمات المياه'),
('1', 'خدمات النظافة');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` varchar(20) NOT NULL,
  `complaint_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `comment_text` text NOT NULL,
  `commentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'قيد الانتظار' COMMENT 'حالة الشكوى ',
  `submission_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'تاريخ تقديم الشكوى',
  `resolution_date` date NOT NULL COMMENT 'تاريخ حل الشكوى بحالة حلها',
  `type` varchar(10) NOT NULL COMMENT 'عامة أو خاصة',
  `area_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `user_id`, `description`, `category_id`, `status`, `submission_date`, `resolution_date`, `type`, `area_id`) VALUES
('dFD7UngyoSeut52XjNBw', 'UXhj6wehBI0oHDmRtmN5', 'Velit consectetur o', '4', 'قيد الانتظار', '2024-12-23', '0000-00-00', 'public', '4'),
('Dx3rPC6fnPhbmJamltCA', 'UXhj6wehBI0oHDmRtmN5', 'Aliquam molestiae mo', '5', 'مرفوضة', '2024-12-23', '0000-00-00', 'public', '2'),
('fcCWWgElptW15EPLFrfq', 'UXhj6wehBI0oHDmRtmN5', 'hgokdmfvponeiuojbpawnpfmnpeaojrbp[n[sinb', '7', 'قيد الانتظار', '2024-12-23', '0000-00-00', 'public', '2'),
('GZYuadgGdgU2tzxWmzgG', 'UXhj6wehBI0oHDmRtmN5', 'Porro ratione vel qu', '1', 'مرفوضة', '2024-12-23', '0000-00-00', 'private', '3'),
('jbRhQNVBdT5iLKlIrTO8', 'UXhj6wehBI0oHDmRtmN5', 'Sit consequatur ad n', '5', 'قيد الانتظار', '2024-12-23', '0000-00-00', 'private', '3'),
('PXefV2bhgUoWPSTjEB2G', 'UXhj6wehBI0oHDmRtmN5', 'Ut quasi quo quia si', '5', 'منتهية', '2024-12-23', '0000-00-00', 'private', '3'),
('Vu6a9zyeJEFZiz5Rb6tu', 'chO1dBPVhPJwjH9WJ3EY', 'Expedita voluptatem', '8', 'قيد الانتظار', '2024-12-26', '0000-00-00', 'خاصة', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'user',
  `fullname` varchar(30) NOT NULL,
  `national_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `fullname`, `national_id`) VALUES
('6OaP3I16o0a2ksl3UuSx', 'karamma3rouf@gmail.com', '$2y$10$KvOUTjcvGtHh19D2HVteBu3uWud8aHGkDqIa1ZlfltT9jKRSbYzqm', 'user', '', '0'),
('7BSr2mfaf4hd54AMIIGu', 'karam@gmail.com', '$2y$10$IfnxBbTM3dLZ8oeLLQl7quYMALs/QUzcnLF2/eO4sl4CPw7QaD/0G', 'user', '', '0'),
('chO1dBPVhPJwjH9WJ3EY', 'sonyzaquq@mailinator.com', '$2y$10$WR1gQpeybDHv5AlWUKAgw.zyTWbReNwyFItpXaGn.e4rOopMu8OMe', 'user', 'Amery Burke', '+1 (643) 9'),
('fjorQNciv2PdG3mEATMW', 'wazav@mailinator.com', '$2y$10$rR8hNR7V6OWx86Up6vBCV.mvhgHEXE7Pe3QpplDhOgpSefXE016O.', 'user', 'Noel Young', 'Sit natus '),
('oWicO6A2fOJPRMUO8TuB', 'kk@gmail.com', '$2y$10$q80trjIWeJmJDm69YcnqSeUa0CJQuHA9EkQQ9.jWVuFq/byFJ0PKy', 'admin', '', '0'),
('UXhj6wehBI0oHDmRtmN5', 'k@g.c', '$2y$10$NDcZ1vw/89nM2ZWOhWCBU.bjCemyeqbmxAXxt3Aqb19oKuaujDL5G', 'user', 'karam', '11223344');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
