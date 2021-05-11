-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 10:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betanime_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `pass_user` varchar(16) NOT NULL,
  `pangkat` varchar(5) NOT NULL DEFAULT 'user',
  `status_user` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id_user`, `nama_user`, `email_user`, `pass_user`, `pangkat`, `status_user`) VALUES
(1, 'Admin', 'admin@betanime.com', 'admin', 'admin', 1),
(2, 'User', 'user@betanime.com', 'user', 'user', 1),
(11, 'Stikom Ambon', 'stikom@ambon.id', 'stikom', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video_tbl`
--

CREATE TABLE `video_tbl` (
  `id_video` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `sinopsis` text NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `thumb_video` varchar(50) NOT NULL,
  `nama_video` varchar(50) NOT NULL,
  `status_video` tinyint(1) NOT NULL DEFAULT 0,
  `id_user` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `video_tbl`
--
ALTER TABLE `video_tbl`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `video_tbl`
--
ALTER TABLE `video_tbl`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
