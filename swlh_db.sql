-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 05:05 AM
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
-- Database: `swlh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `computers`
--

CREATE TABLE `computers` (
  `id` int(11) NOT NULL,
  `name` char(255) NOT NULL,
  `ram` char(30) NOT NULL,
  `cpu` char(30) NOT NULL,
  `vga` char(30) NOT NULL,
  `monitor` char(30) NOT NULL,
  `note` char(255) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `computers`
--

INSERT INTO `computers` (`id`, `name`, `ram`, `cpu`, `vga`, `monitor`, `note`, `availability`, `room_id`, `created_at`, `updated_at`) VALUES
(2, 'dell vostro', '4gb', 'intel core i5', '1050ti 4g', '24inch', 'máy đẹp', 1, 12, '2024-06-24 16:13:59', '2024-06-25 08:16:38'),
(3, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 0, 12, '2024-06-24 16:13:59', '2024-06-24 16:13:59'),
(10, 'dell vostro', '4gb', 'intel core i5', 'ti1050', '24inch', 'không có', 1, 12, '2024-06-24 17:18:31', '2024-06-24 17:18:31'),
(14, 'máy 1', '4gb', '2GHz', '1050ti 4g', '24inch', 'không có', 1, 16, '2024-06-25 09:50:55', '2024-06-25 09:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `from_time` datetime NOT NULL,
  `to_time` datetime NOT NULL,
  `approved` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` char(255) NOT NULL,
  `position` char(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 0,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `position`, `description`, `availability`, `owner_id`) VALUES
(12, 'phòng 101', 'thư viện', 'phải, nó ở thư viện.\r\ndưới tầng 1 toang lắm.', 1, 11),
(14, 'phòng 909', 'nhà A4', 'phòng bay lắc', 1, 11),
(15, 'phòng chờ', 'nhà A3', 'phòng mát', 1, 11),
(16, 'phòng 101', '65 xuân phương', 'phòng net\r\n5k 1 giờ', 1, 12),
(17, 'phòng 102', 'nhà B3', 'phải, nó ở nhà B3', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` char(60) NOT NULL,
  `hashed_password` char(60) NOT NULL,
  `birth` date DEFAULT '0001-01-01',
  `full_name` char(60) DEFAULT NULL,
  `email` char(60) DEFAULT NULL,
  `position` char(60) DEFAULT NULL,
  `gender` char(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` char(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `hashed_password`, `birth`, `full_name`, `email`, `position`, `gender`, `created_at`, `updated_at`, `token`) VALUES
(11, 'buihaidang', '$2y$10$iCeFxYd/bdBOmjArNIzvLObSjFvfcmQ0uHWsUdxV1bxYdPEo.WiS6', '2003-01-07', 'Bùi Hải Đăng', 'buihaidangvn@gmail.com', 'Sinh Viên', 'male', '2024-06-24 14:25:18', '2024-06-25 08:22:32', ''),
(12, 'nguyenchibao', '$2y$10$6qZ/d8cjbxC3cWHeQnTyHOrGs4BgVTUTFf/LhN2x6PRcrur.sU3F.', '2003-01-01', 'Nguyễn Chí Bảo', 'nguyenchibao@gmail.com', 'Sinh Viên', 'male', '2024-06-25 08:28:13', '2024-06-25 09:59:53', '7ebd6b42edb2e65ac7ff00bcde9329830088bde9888d49fe382dd1587634');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `computers`
--
ALTER TABLE `computers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`room_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rooms_owner_id` (`owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `computers`
--
ALTER TABLE `computers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `computers`
--
ALTER TABLE `computers`
  ADD CONSTRAINT `computers_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `computers_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
