-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 03:39 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peer`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `account_name`, `account_no`, `bank_name`, `account_type`, `created_at`, `updated_at`) VALUES
(2, '2', 'ss', '2121', 'RTF', 'savi', '2017-02-25 07:48:32', '2017-02-25 07:48:32'),
(12, '3', 'erew', '43242', '34343', 'SAVINGG', '2017-02-25 08:03:51', '2017-02-25 08:03:51'),
(13, '4', 'Bdfsds', '432422352', '3434323523', 'SAVINGG', '2017-02-25 08:03:51', '2017-02-25 08:03:51'),
(16, '6', 'wqrqw', '2352352', 'ITCC', 'SAVINGG', '2017-02-27 08:09:53', '2017-02-27 08:09:53'),
(17, '1', 'AccName', '866969999889', 'ITT', 'SAVINGG', '2017-02-27 09:09:05', '2017-02-27 09:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `help_match`
--

CREATE TABLE `help_match` (
  `help_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `proof` text,
  `receiver_ack` tinyint(1) DEFAULT NULL,
  `sender_ack` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `closed_on` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_match`
--

INSERT INTO `help_match` (`help_id`, `sender_id`, `receiver_id`, `amount`, `proof`, `receiver_ack`, `sender_ack`, `status`, `closed_on`, `created_on`) VALUES
(1, 3, 1, 2500, '1488199680_V_for_Vendetta.jpg', 1, NULL, 2, '2017-02-27 12:50:16', '2017-02-27 18:20:16'),
(2, 4, 1, 2500, '1488132828_img1.jpg', 1, NULL, 2, '2017-02-27 12:31:08', '2017-02-27 18:01:08'),
(3, 1, 2, 2500, '1488201935_img1.jpg', 1, NULL, 2, '2017-02-27 13:25:48', '2017-02-27 18:55:48'),
(4, 3, 2, 2500, '1488201965_img1.jpg', 1, NULL, 2, '2017-02-27 13:26:23', '2017-02-27 18:56:23'),
(5, 2, 1, 2500, NULL, NULL, NULL, 1, NULL, '2017-02-27 19:38:45'),
(6, 6, 1, 2500, NULL, NULL, NULL, 1, NULL, '2017-02-27 19:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `help_members`
--

CREATE TABLE `help_members` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=ReadyToProvide, 2=ReadyToGethelp',
  `onProcess` tinyint(1) NOT NULL DEFAULT '0',
  `eligible_for` tinyint(1) DEFAULT NULL,
  `accept_get` tinyint(1) DEFAULT NULL,
  `accept_get_on` datetime DEFAULT NULL,
  `accept_provide` tinyint(1) DEFAULT NULL,
  `accept_provide_on` datetime DEFAULT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_members`
--

INSERT INTO `help_members` (`id`, `member_id`, `status`, `onProcess`, `eligible_for`, `accept_get`, `accept_get_on`, `accept_provide`, `accept_provide_on`, `last_updated`) VALUES
(2, 1, 2, 1, 2, 1, '2017-02-27 14:11:05', 1, '2017-02-27 12:52:48', '2017-02-27 19:41:05'),
(3, 2, 1, 1, 0, 0, NULL, 1, '2017-02-27 13:28:31', '2017-02-27 19:38:45'),
(10, 3, 2, 0, 2, NULL, NULL, 1, '2017-02-26 10:53:37', '2017-02-27 18:56:23'),
(11, 4, 2, 0, 2, 1, '2017-02-27 12:45:09', 1, '2017-02-26 10:54:10', '2017-02-27 18:15:09'),
(12, 6, 1, 1, NULL, NULL, NULL, 1, '2017-02-27 13:40:06', '2017-02-27 19:38:45'),
(13, 5, 1, 0, NULL, NULL, NULL, 1, '2017-02-27 13:41:13', '2017-02-27 19:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_19_163401_create_useraccount_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phoneno`, `password`, `remail`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'TEst', 'test@gmail.com', '', '$2y$10$Hwp17VbdkExnjKD70WD/RO1b4FVX05Rb/wiY8D4.jzVe3aaLepCW6', NULL, 1, 1, '7rr3ylZsCFKUYCTWmleTZsFZqv8Vd08t5jwZP6sj6Pz9wC8Si8spURaHzeKh', '2017-02-18 05:31:02', '2017-02-18 05:31:02'),
(2, 'test 2', 'Test', 'test1@gmail.com', '2323232323', '$2y$10$1pMhEMmdT9DuHjYOsJlZJutOMHD7ETWYjZ3QhLDgxJHczHBAcFTnC', NULL, 0, 2, '5ERwxKWyURaqZtr0Sg8Fz3joVwLzxQI0sz5EPMA6Q941K2tFBCvdPvAr9Xey', '2017-02-18 06:42:43', '2017-02-18 06:42:43'),
(3, 'test 3', 'tt', 'test2@gmail.com', '7193575738', '$2y$10$VHbe2qe.m.Tgj2TQrpKeE.YiG9BBJEuZWzAr6VqhGXB8pjVuxCy9i', NULL, 0, 1, 'swzOAzV6NCGKBQ87wBNLmUPDW88cqxeAEXB2xcTaa6iKakpLajnEXFJZaBeG', '2017-02-18 07:21:22', '2017-02-18 07:21:22'),
(4, 'Test 4', 'Test user', 'test3@gmail.com', '7193575738', '$2y$10$oggHafk6M6hFU/WQhpMq1.VvFySEEChXAllZiBLQJBM81MxLsNuTW', 'test2@gmail.com', 0, 1, '5tWneD5W6Cmydym0EvmzSy43nllQ1bL1aq61ZVH2eNJl9oscI4E5ez4Bdxcc', '2017-02-18 07:26:59', '2017-02-18 07:26:59'),
(5, 'test 5', 'test 5', 'test5@gkmail.com', '979879879989', '$2y$10$gaVzmfuP/C4Hosjb/as.TOCoZ47qNYKtd.R07TRJq9WHi2o147rwa', 'test1@gmail.com', 0, 1, 'E98ZtbzNdAMEe48DEErIM74uJCqr5kQLhO5tNFqjcLCA8wdOaXm529QMuETV', '2017-02-27 08:02:44', '2017-02-27 08:02:44'),
(6, 'test 6', 'test 6', 'test6@gmail.com', '98678989798', '$2y$10$n/zYiEaudorOc4ZZNAiheePk67N7xDJZlwvJIW5IfgXzTUX83ZsXS', 'test1@gmail.com', 0, 1, 'YcVjkMrl363MGmv9Obbjen73OekL0TTlRKSMVzJMgrfQdGTNs3rPi7U76QNb', '2017-02-27 08:08:28', '2017-02-27 08:08:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `help_match`
--
ALTER TABLE `help_match`
  ADD PRIMARY KEY (`help_id`);

--
-- Indexes for table `help_members`
--
ALTER TABLE `help_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `help_match`
--
ALTER TABLE `help_match`
  MODIFY `help_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `help_members`
--
ALTER TABLE `help_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
