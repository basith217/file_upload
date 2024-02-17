-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 02:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_upload`
--

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `upload_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `user_id`, `filename`, `upload_timestamp`) VALUES
(1, 1, '65d0afae209be_5-2-perfume-picture.png', '2024-02-17 13:07:58'),
(2, 1, '65d0b041b9d67_5-2-perfume-picture.png', '2024-02-17 13:10:25'),
(3, 1, '65d0b043a798b_5-2-perfume-picture.png', '2024-02-17 13:10:27'),
(4, 1, '65d0b043cee57_5-2-perfume-picture.png', '2024-02-17 13:10:27'),
(5, 1, '65d0b044071d4_5-2-perfume-picture.png', '2024-02-17 13:10:28'),
(6, 1, '65d0b0fc172a7_5-2-perfume-picture.png', '2024-02-17 13:13:32'),
(7, 1, '65d0b15204a5f_5-2-perfume-picture.png', '2024-02-17 13:14:58'),
(8, 1, '65d0b35fbc741_irfan project 002.jpg', '2024-02-17 13:23:43'),
(9, 1, '65d0b3edec7d2_irfan project 002.jpg', '2024-02-17 13:26:05'),
(10, 1, '65d0b5a155f1d_Overviews_in_Construction_Technologies.docx', '2024-02-17 13:33:21'),
(11, 1, '65d0ba193054c_irfan_project_002.jpg', '2024-02-17 13:52:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
