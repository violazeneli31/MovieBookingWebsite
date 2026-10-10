-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2026 at 11:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_movie`
--

CREATE TABLE `add_movie` (
  `id` int(25) NOT NULL,
  `movie_name` varchar(100) NOT NULL,
  `directer` varchar(100) NOT NULL,
  `release_date` varchar(100) NOT NULL,
  `categroy` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `you_tube_link` varchar(250) NOT NULL,
  `show` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `decription` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_movie`
--

INSERT INTO `add_movie` (`id`, `movie_name`, `directer`, `release_date`, `categroy`, `language`, `you_tube_link`, `show`, `action`, `decription`, `image`, `status`) VALUES
(31, 'Zootopia', 'Byron Howard & Rich Moore', '2016-03-04', 'Animation, Adventure, Comedy', 'English', 'https://www.youtube.com/embed/yCOPJi0Urq4', '', 'upcoming', 'In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.', 'zootopia.jpg', 1),
(32, 'Tangled', 'Nathan Greno & Byron Howard', '2010-11-24', 'Animation, Musical, Fantasy', 'English', 'https://www.youtube.com/embed/ycoY201RTRo', '21:00', 'running', 'Rapunzel, a spirited girl with magical hair, escapes from her tower with the help of a thief and discovers the world and her true identity.', 'tangled.jpeg', 1),
(33, 'Toy Story', 'John Lasseter', '1995-11-22', 'Animation, Comedy, Family', 'English', 'https://www.youtube.com/embed/v-PjgYDrg70', '15:30', 'running', 'Woody, Buzz Lightyear, and other toys come to life when humans aren\'t around in this iconic Pixar classic.', 'toystory.jpeg', 1),
(34, 'Horton Hears a Who!', 'Jimmy Hayward & Steve Martino', '2008-03-14', 'Animation, Comedy, Family', 'English', 'https://www.youtube.com/embed/0c57WC9Vc30', '', 'upcoming', 'Horton the elephant discovers a microscopic community living on a speck of dust and goes on a mission to protect it.', 'horton.jpeg', 1),
(35, 'The Bad Guys', 'Pierre Perifel', '2022-04-22', 'Animation, Action, Comedy', 'English', 'https://www.youtube.com/embed/m8Xt0yXaDPU', '18:00', 'running', 'After years of pulling heists, a gang of criminal animals tries to turn good—but their plan doesn’t go exactly as expected.', 'badguys.jpeg', 1),
(36, 'Meet the Robinsons', 'Stephen J. Anderson', '2007-03-30', 'Animation, Sci-Fi, Comedy', 'Albanian', 'https://www.youtube.com/embed/S396-fnLldk', '14:30', 'running', 'Lewis, a young inventor, travels to the future where he meets a quirky family that helps him discover the meaning of family and innovation.', 'robinsons.jpeg', 1),
(37, 'Aladdin', 'Ron Clements & John Musker', '1992-11-25', 'Animation, Musical, Fantasy', 'Albanian', 'https://www.youtube.com/embed/eTjHiQKJUDY', '', 'upcoming', 'A street-smart young man finds a magical lamp with a genie inside who helps him win the heart of Princess Jasmine.', 'aladin.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `movie` varchar(100) NOT NULL,
  `show_time` varchar(100) NOT NULL,
  `seat` varchar(100) NOT NULL,
  `totalseat` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `booking_date` varchar(100) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(25) NOT NULL,
  `ex_date` varchar(100) NOT NULL,
  `cvv` int(5) NOT NULL,
  `custemer_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `uid`, `movie`, `show_time`, `seat`, `totalseat`, `price`, `payment_date`, `booking_date`, `card_name`, `card_number`, `ex_date`, `cvv`, `custemer_id`) VALUES
(9, 2, 'The Bad Guys', '18:00', 'I10,I11', '2', '200', 'Fri-05-25 ', 'Sat-05-25 ', 'Mateo', '123', '2027-12-31', 123, 336676767),
(10, 2, 'Meet the Robinsons', '14:30', 'G8,F7,F8', '3', '400', 'Fri-05-25 ', 'Sat-05-25 ', 'Mateo', '123', '2027-12-31', 123, 1533797304),
(11, 1, 'The Bad Guys', '18:00', 'F8,F9,F12', '3', '450', 'Fri-05-25 ', 'Sat-05-25 ', 'viola', '123', '2030-03-31', 123, 865252001),
(12, 1, 'Tangled', '21:00', 'C7,C8', '2', '300', 'Fri-05-25 ', 'Sat-05-25 ', 'viola', '123', '2030-03-31', 123, 1247437294),
(13, 1, 'The Bad Guys', '18:00', 'I8,I9,F10', '3', '350', 'Fri-05-25 ', 'Sat-05-25 ', 'viola', '123', '2030-03-31', 123, 1232457899),
(14, 4, 'Tangled', '21:00', 'C10,C11', '2', '300', 'Fri-05-25 ', 'Sat-05-25 ', 'bela', '123', '2026-06-01', 123, 2085092183);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `massage` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `massage`) VALUES
(65, 'bela', 'bzeneli@gmail.com', 'viola je shume e mire :)))'),
(64, 'Mateo', 'mzeneli@gmail.com', 'viola you did a great job with your theatre!!!!!'),
(63, 'viola', 'vzeneli23@epoka.edu.al', 'Best theatre ever :))))');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `mobile`, `city`, `pass`, `img`, `created_at`) VALUES
(1, 'viola', 'vzeneli23@epoka.edu.al', 684812020, 'tirane', '$2y$10$unsHePjTKsefhYfZIehow.NXFA8YrzeHj3NOc5tQPT5O7L8ueR5Ai', 'v.png', '2025-05-29 08:37:52'),
(2, 'mateo', 'mzeneli@gmail.com', 687771020, 'tirane', '$2y$10$Hjn/hOK.eB7sT3KM7G49fuPc3xnpjtVcLR0zj/MjZniCD19vK0Rlm', 'm.jpg', '2025-05-29 08:54:27'),
(4, 'bela', 'bzeneli@gmail.com', 674341020, 'lushnje', '$2y$10$TesJ52XYJDejj.d7Xn26O.7IFvln/Qdvs7X0vkIlb2CmAMRxVk5eW', '', '2025-05-30 15:09:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_movie`
--
ALTER TABLE `add_movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_movie`
--
ALTER TABLE `add_movie`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
