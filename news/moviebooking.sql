-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 05:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviebooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(17) NOT NULL,
  `cpassword` varchar(17) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `cpassword`, `phone`) VALUES
(1, 'admin', 'admin12@gmail.com', 'admin', '', '9749341363'),
(2, 'bipin', 'sainjubipin24746@gmail.com', '12121212', '', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `seat_id` int(11) NOT NULL,
  `total_price` varchar(11) NOT NULL DEFAULT '0',
  `booking_date` date NOT NULL DEFAULT current_timestamp(),
  `booking_time` time NOT NULL DEFAULT current_timestamp(),
  `fname` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `movie_id`, `show_date`, `show_time`, `seat_id`, `total_price`, `booking_date`, `booking_time`, `fname`, `email`) VALUES
(7, 58, '2023-08-05', '01:40:00', 1, '33', '2023-08-05', '19:18:52', 'Bipin', 'bipinsainju24746@gmail.com'),
(8, 58, '2023-08-05', '01:40:00', 3, '33', '2023-08-05', '19:18:52', 'Bipin', 'bipinsainju24746@gmail.com'),
(9, 58, '2023-08-05', '01:40:00', 7, '33', '2023-08-05', '19:18:52', 'Bipin', 'bipinsainju24746@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `coming_soon`
--

CREATE TABLE `coming_soon` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reldate` date NOT NULL,
  `trailer` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `genres` varchar(255) NOT NULL,
  `director` varchar(100) NOT NULL,
  `cast` text NOT NULL,
  `language` varchar(50) NOT NULL,
  `industry` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coming_soon`
--

INSERT INTO `coming_soon` (`id`, `name`, `reldate`, `trailer`, `image`, `genres`, `director`, `cast`, `language`, `industry`) VALUES
(3, 'qw qww', '2023-08-12', '', 'application software.jpg', 'asd', 'hero', 'q', 'english', 'Bollywood'),
(4, 'Last Name', '2023-08-19', '', '245105196_231794978842981_2833975674910363695_n.jpg', 'asd', 'marvel', 'qw', 'english', 'Bollywood'),
(5, 'New Movie', '2023-08-13', '', '244751569_2946864365643339_6249855058722978539_n.jpg', 'asd', 'hero', 'ads', 'english', 'Bollywood'),
(6, 'New Movie', '2023-08-13', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/kd7Hu5j6VVY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '244751569_2946864365643339_6249855058722978539_n.jpg', 'asd', 'hero', 'ads', 'english', 'Bollywood'),
(7, 'New Movie', '2023-08-13', 'https://youtu.be/eM8Mjuq4MwQ', '244751569_2946864365643339_6249855058722978539_n.jpg', '1', 'hero', 'ads', 'english', 'Bollywood'),
(8, 'Mobile No.', '2023-08-18', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/4G5ScpHkuLA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 's-l1600.jpg', 'welcom', 'hero', 'qweqweqwe', 'english', 'Bollywood');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `industry` varchar(20) NOT NULL,
  `language` varchar(20) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `reldate` varchar(20) NOT NULL,
  `director` varchar(30) NOT NULL,
  `actor` varchar(30) NOT NULL,
  `description` varchar(225) NOT NULL,
  `price` varchar(225) NOT NULL,
  `image` varchar(225) NOT NULL,
  `fdate` date NOT NULL,
  `sdate` date NOT NULL,
  `tdate` date NOT NULL DEFAULT '2023-01-01',
  `fshow` time NOT NULL,
  `sshow` time NOT NULL,
  `tshow` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `name`, `genre`, `industry`, `language`, `duration`, `reldate`, `director`, `actor`, `description`, `price`, `image`, `fdate`, `sdate`, `tdate`, `fshow`, `sshow`, `tshow`) VALUES
(51, 'Avengers', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'aven', 'heros', '', '200', 's-l1600.jpg', '2023-07-30', '2023-07-28', '2023-02-03', '06:00:00', '05:00:00', '06:00:00'),
(52, 'AntMan And the Wasp', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'ant', 'antman', '', '500', 'system software.jpg', '2023-07-21', '0000-00-00', '2023-01-01', '12:00:00', '00:00:00', '00:00:00'),
(53, 'Avenger EndGame', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'marvel', 'avengers', '', '300', 'Screenshot (5302).png', '2023-07-21', '2023-07-22', '2023-01-01', '02:00:00', '00:00:00', '00:00:00'),
(54, 'Avenger EndGame', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'villian', 'hero', '', '100', 'Screenshot (6398).png', '2023-07-27', '2023-07-22', '2023-01-01', '01:01:00', '00:00:00', '00:00:00'),
(55, 'bipin', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'ant', 'heros', '', '32', 'Screenshot (880).png', '2023-07-23', '2023-07-24', '2023-01-01', '05:04:00', '00:00:00', '00:00:00'),
(56, 'gamer', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'aven', 'avengers', '', '23', '', '2023-07-20', '2023-07-23', '2023-01-01', '02:02:00', '00:00:00', '00:00:00'),
(57, 'Last Name', '1', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'aven', 'hero', '', '234', 'Screenshot (6409).png', '2023-07-27', '2023-07-29', '2023-01-01', '01:03:00', '00:00:00', '00:00:00'),
(58, 'New Movie', '1', 'Bollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'villian', 'hero', '', '11', 'Screenshot (5314).png', '2023-08-01', '2023-08-03', '2023-08-05', '23:40:00', '10:40:00', '01:40:00'),
(59, 'Bipin Sainju Shrestha', 'comedy', 'hollywood', 'english', '2hrs 34min 7sec', '24/07/2022', 'villian', 'avengers', '', '23', '246005566_2911087375781953_3401195559941103366_n.jpg', '2023-08-27', '2023-09-01', '0000-00-00', '01:01:00', '02:02:00', '03:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `u_id`, `otp`, `timestamp`) VALUES
(1, 7, 315995, '2023-07-15 17:37:49'),
(2, 8, 911830, '2023-07-15 17:43:59'),
(3, 9, 840395, '2023-07-15 17:48:31'),
(4, 10, 691443, '2023-07-21 10:39:34'),
(5, 11, 119269, '2023-07-30 13:42:53'),
(6, 12, 341871, '2023-08-05 05:52:24'),
(7, 13, 292863, '2023-08-05 06:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `cpassword` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `fname`, `lname`, `email`, `password`, `cpassword`, `phone`) VALUES
(1, 'user', '', 'user12@gmail.com', 'user', 'user', '9886346099'),
(2, 'User1', '', 'user1@gmail.com', 'user1', '', '98525215652'),
(6, 'Bipin', 'Sainju Shrestha', 'sainjubipin24746@gmail.com', '1111', '', '9860922423'),
(7, 'Bipin', 'Sainju Shrestha', 'sainjubipin24746@gmail.com', '121212', '', '9860922423'),
(11, 'Bipin', 'Sainju Shrestha', 'sainjubipin24746@gmail.com', '1212', '', '9860922423'),
(12, 'Bipin', 'Sainju Shrestha', 'bipinsainju24746@gmail.com', '121212', '', '9860922423'),
(13, 'Bipin', 'Sainju Shrestha', 'sainjubipin247460@gmail.com', '121212', '', '9860922423');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coming_soon`
--
ALTER TABLE `coming_soon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coming_soon`
--
ALTER TABLE `coming_soon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
