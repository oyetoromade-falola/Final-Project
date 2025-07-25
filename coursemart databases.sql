-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql207.byetcluster.com
-- Generation Time: Jul 18, 2025 at 02:56 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39288139_coursemart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 5, 123, 1, '2025-06-25 15:00:37'),
(2, 2, 123, 1, '2025-06-25 18:14:06'),
(3, 3, 123, 1, '2025-06-25 18:54:46'),
(4, 6, 123, 1, '2025-06-25 21:05:00'),
(5, 7, 123, 1, '2025-06-26 09:22:23'),
(6, 9, 123, 1, '2025-06-26 10:15:39'),
(7, 1, 123, 1, '2025-06-27 10:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT 'Guest',
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `username`, `message`, `timestamp`) VALUES
(1, 'Guest', 'this work is an improvement to the learning space', '2025-07-18 10:38:03'),
(2, 'Guest', 'thank for contributing to the body of knowledge', '2025-07-18 10:38:49'),
(3, '<?= htmlspecialchars($username) ?>', 'it great adding this live chat new feature', '2025-07-18 10:59:04'),
(4, '<?= htmlspecialchars($username) ?>', 'it great adding this live chat new feature', '2025-07-18 10:59:09'),
(5, '<?= htmlspecialchars($username) ?>', 'it great adding this live chat new feature', '2025-07-18 10:59:09'),
(6, 'Guest', 'hi testing', '2025-07-18 11:20:34'),
(7, 'Guest', 'hola', '2025-07-18 11:21:25'),
(8, 'Guest', 'hi', '2025-07-18 11:33:06'),
(9, 'Guest', 'when i toggle the theme for the chat the color is contrasting', '2025-07-18 11:36:14'),
(10, 'Guest', 'Hello', '2025-07-18 11:55:43'),
(11, 'Guest', 'Hello', '2025-07-18 11:55:49'),
(12, 'Guest', 'Hello', '2025-07-18 11:55:54'),
(13, 'Guest', 'Hello', '2025-07-18 11:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `data_id` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `image`, `department`, `data_id`) VALUES
(1, 'Microsoft Excel', 'img/excel.webp', 'ICT & Computer Science', '123'),
(2, 'Data Analytics', 'img/data.webp', 'ICT & Computer Science', '123'),
(3, 'Web Development', 'img/webdev.webp', 'ICT & Computer Science', '123'),
(4, 'Cyber Security (Basics)', 'img/cyber1.webp', 'ICT & Computer Science', '123'),
(5, 'Data Structures & Algorithms', 'img/Data Structures & Algorithm1.webp', 'ICT & Computer Science', '123'),
(6, 'Software Engineering', 'img/Software Engineering.webp', 'ICT & Computer Science', '123'),
(7, 'Cybersecurity Fundamentals', 'img/Cybersecurity Fundamentals.webp', 'ICT & Computer Science', NULL),
(8, 'Cloud Computing', 'img/Cloud Computing.webp', 'ICT & Computer Science', '123'),
(9, 'Mobile App Development', 'img/Mobile App Development.webp', 'ICT & Computer Science', '123'),
(10, 'Database Systems (MySQL, Oracle)', 'img/Database Systems (MySQL, Oracle).webp', 'ICT & Computer Science', '123'),
(11, 'Linux for Beginners', 'img/Linux for Beginners.webp', 'ICT & Computer Science', '123'),
(12, 'Microsoft Excel for Data Analysis', 'img/Microsoft Excel for Data Analysis.webp', 'ICT & Computer Science', '123'),
(13, 'JavaScript Full Stack Bootcamp', 'img/JavaScript Full Stack Bootcamp.webp', 'ICT & Computer Science', '123'),
(14, 'UI/UX Design Principles', 'img/ux.webp', 'ICT & Computer Science', '123'),
(15, 'Digital Marketing & SEO', 'img/Digital Marketing & SEO.webp', 'ICT & Computer Science', '123'),
(16, 'Artificial Intelligence (AI) & Machine Learning', 'img/Artificial Intelligence (AI) & Machine Learning.webp', 'ICT & Computer Science', '123'),
(17, 'Fish Breeding & Hatchery', 'img/fish-breeding.webp', 'Marine & Fisheries Technology', '123'),
(18, 'Fish Feed Production', 'img/fish-feed.webp', 'Marine & Fisheries Technology', '123'),
(19, 'Motorman', 'img/motorman.webp', 'Marine & Fisheries Technology', '123'),
(20, 'Fitter (Machinist)', 'img/fitter.webp', 'Marine & Fisheries Technology', '123'),
(21, 'Oceanography', 'img/Oceanography.webp', 'Marine & Fisheries Technology', '123'),
(22, 'Marine Biology', 'img/Marine Biology.webp', 'Marine & Fisheries Technology', '123'),
(23, 'Fisheries Economics', 'img/Fisheries Economics.webp', 'Marine & Fisheries Technology', '123'),
(24, 'Aquatic Animal Health', 'img/Aquatic Animal Health.webp', 'Marine & Fisheries Technology', '123'),
(25, 'Fish Nutrition & Feeding', 'img/Fish Nutrition & Feeding.webp', 'Marine & Fisheries Technology', '123'),
(26, 'Vessel Navigation', 'img/Vessel Navigation.webp', 'Marine & Fisheries Technology', '123'),
(27, 'Maritime Safety and Law', 'img/Maritime Safety and Law.webp', 'Marine & Fisheries Technology', '123'),
(28, 'Marine Pollution Management', 'img/Marine Pollution Management.webp', 'Marine & Fisheries Technology', '123'),
(29, 'Coastal Zone Management', 'img/Coastal Zone Management.webp', 'Marine & Fisheries Technology', '123'),
(30, 'Efficient Deck Hand', 'img/nautical.webp', 'Nautical Science', '123'),
(31, 'Shipping & Port Management', 'img/business.webp', 'Marine Transport & Business', '123'),
(32, 'Water Quality Management', 'img/water.webp', 'Hydrology & Water Resources', '123'),
(33, 'Laptop', 'img/laptop.webp', 'Student Essentials', '123'),
(34, 'Scientific Calculator', 'img/calculator.webp', 'Student Essentials', '123'),
(35, 'Academic planners', 'img/Academic planners.webp', 'Student Essentials', '123'),
(36, 'Notebook (40 Leaves)', 'img/notebook.webp', 'Student Essentials', '123'),
(37, 'Practical logbooks', 'img/Practical logbooks.webp', 'Student Essentials', '123'),
(38, 'Ballpoint Pen (Blue)', 'img/pen.webp', 'Student Essentials', '123'),
(39, 'USB Flash Drive (16GB)', 'img/flashdrive.webp', 'Student Essentials', '123'),
(40, 'Mathematical Drawing Set', 'img/drawingset.webp', 'Student Essentials', '123'),
(41, 'Student Backpack', 'img/backpack.webp', 'Student Essentials', '123'),
(42, 'MTN 4G LTE Modem', 'img/modem.webp', 'Student Essentials', '123'),
(43, 'White Laboratory Coat', 'img/labcoat.webp', 'Student Essentials', '123'),
(44, 'FCFMT ID Card Holder', 'img/FCFMT ID Card Holder.webp', 'Student Essentials', '123'),
(45, 'Student lab manuals', 'img/Student lab manuals.webp', 'Student Essentials', '123'),
(46, 'Drawing boards', 'img/Drawing boards.webp', 'Student Essentials', '123'),
(47, 'Rechargeable study lamps', 'img/Rechargeable study lamps.webp', 'Student Essentials', '123'),
(48, 'Mini whiteboards & markers', 'img/Mini whiteboards & markers.webp', 'Student Essentials', '123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(1, 7, 0, 1, '0.00', '2025-06-26 05:34:27'),
(2, 7, 0, 1, '0.00', '2025-06-26 05:34:27'),
(3, 7, 0, 1, '0.00', '2025-06-26 05:34:27'),
(4, 7, 0, 1, '0.00', '2025-06-26 05:34:27'),
(5, 7, 0, 1, '0.00', '2025-06-26 05:34:27'),
(6, 7, 0, 1, '0.00', '2025-06-26 05:34:27'),
(7, 1, 0, 1, '1000.00', '2025-06-27 07:00:01'),
(8, 1, 0, 1, '1000.00', '2025-06-27 07:00:01'),
(9, 3, 0, 1, '1000.00', '2025-06-27 09:21:51'),
(10, 3, 0, 1, '1000.00', '2025-06-27 09:21:51'),
(11, 3, 0, 1, '1000.00', '2025-06-27 09:21:51'),
(12, 11, 0, 1, '1000.00', '2025-07-08 08:49:32'),
(13, 11, 0, 1, '1000.00', '2025-07-08 08:49:32'),
(14, 11, 0, 1, '1000.00', '2025-07-08 08:49:32'),
(15, 11, 0, 1, '1000.00', '2025-07-08 08:49:32'),
(16, 17, 0, 1, '200000.00', '2025-07-16 13:19:34'),
(17, 17, 0, 1, '1000.00', '2025-07-16 13:19:34'),
(18, 17, 0, 1, '200000.00', '2025-07-16 13:19:36'),
(19, 17, 0, 1, '1000.00', '2025-07-16 13:19:36'),
(20, 1, 0, 1, '150000.00', '2025-07-17 15:24:12'),
(21, 1, 0, 1, '3000.00', '2025-07-17 15:24:12'),
(22, 1, 0, 1, '150000.00', '2025-07-17 15:27:00'),
(23, 1, 0, 1, '200000.00', '2025-07-17 15:37:26'),
(24, 1, 0, 1, '150000.00', '2025-07-17 15:43:53'),
(25, 1, 0, 1, '200000.00', '2025-07-17 15:45:55'),
(26, 1, 0, 1, '150000.00', '2025-07-17 15:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'course',
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.webp',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `times_ordered` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `department`, `message`, `created_at`) VALUES
(1, 'oyetoromade falola', 'ict', 'i really like this website but it would have been better with course rating', '2025-06-25 18:43:21'),
(2, 'okeke vivian', 'Computer Science', 'First, welcome page review(view course, there is a need for a brief intro on what the course is about.\r\n\r\nsecondly, course section needs to be able to cart when courses are selected.\r\n\r\nthirdly, recommendation section need more professional courses to be added.\r\n\r\nLastly, the wallet page. no deduction of fee after payment', '2025-06-26 09:50:59'),
(3, 'Alimi Mubaraq Eyitayo', 'ICT/ Computer science Department', 'Coursemart platform is an interesting and friendly user interface platform, which provides me with easy access to the course of my interest and other related courses. This is amazing!', '2025-06-27 21:18:51'),
(4, '-SHITTU -USMAN OLATUNJI', 'ICT Department', 'I find this interface very helpful, and it will boost my Academy performance,i love it and is a sure plug to me.thanks to COURSEMART FCFMT.', '2025-07-01 13:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('student','admin') NOT NULL DEFAULT 'student',
  `department` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`, `role`, `department`) VALUES
(1, 'Falola Oyetoromade Regina', 'falolaoyetoromade@gmail.com', '$2y$10$Yg5dI8nYofkPnqcwwolBGuScGpmBO4dbnLEL6v8DB0pv7zGPwfsBS', '2025-06-21 20:39:30', 'student', NULL),
(2, 'adunni falola', 'falolaadunni@gmail.com', '$2y$10$QKF1edSKO.T31WPbBeWY5Oj1LY2fVgbigDG7LIhDd7V11fH6IeFZm', '2025-06-21 21:02:49', 'student', NULL),
(3, 'falola festus', 'falolafestus@gmail.com', '$2y$10$NU1O61TxBaxaYnb8e5ZfX.jXvVOz4cWEQItdkEO83z3WgzlIiXGK2', '2025-06-22 09:39:30', 'student', NULL),
(4, 'Adeniyi Daniel Olamilekan', 'Adeniyidaniel@gmail.com', '$2y$10$LmaQTqDTj05UXJe/z4YK1usW1NHilyePwB2q0mbCVHD3MA3CrMbqe', '2025-06-24 21:29:33', 'student', NULL),
(5, 'Ambrose Godsuccess', 'Ambrosegodsuccess@gmail.com', '$2y$10$3T7lyHCjEvjr8PC/.DoHKuxbv40vo/2Pe7Rq8mstOk1dPyvrixBRC', '2025-06-24 23:25:42', 'student', NULL),
(6, 'Sam Ogbo', 'Samogbo4real@gmail.com', '$2y$10$qjUkLcK1f7eTjBML1Ki7yepiguNrRtoflPnl0QJp9A5AWpKlbQF7u', '2025-06-25 21:03:09', 'student', NULL),
(7, 'okeke vivian', 'vivian.okeke@fcfmt.edu.ng', '$2y$10$wAx24TEBXUx5MZk3zwll4OXUr6VDuFjvyOHXQigzZjJNLpzKwjR3W', '2025-06-26 09:21:11', 'student', NULL),
(8, 'Precious Uwakwe', 'uwakweprecious859@gmail.com', '$2y$10$lUAOKSxCysCoePSZOkvuFeMovj/dMbrNmeAgmHnVmjWMeL2iYSPXy', '2025-06-26 10:07:13', 'student', NULL),
(9, 'Falola Regina', 'falolaregina@gmail.com', '$2y$10$HO1Amz/TBrZFJS1hM3/I7ObG15YEMhNQceAU.uKYZIWJWQYQ0m0Tq', '2025-06-26 10:14:20', 'student', NULL),
(10, 'Alimi Mubaraq Eyitayo', 'mtech30dos@gmail.com', '$2y$10$1Eo9VLuu7DfhryW4W8n1YO9UFENhfIGl2WUgfKUIoPszDM7cmU2Gu', '2025-06-27 20:32:03', 'student', NULL),
(11, 'vivian christopher', 'vivokeke65@gmail.com', '$2y$10$Djp6SlL1JaGC.rvWV4HCl.TtBaRjQ/7hudrFLrqD.3PYPTtLKY2cq', '2025-07-08 12:47:16', 'student', NULL),
(12, 'falola regina', 'reginafal@gmail.com', '$2y$10$jHwgUjA2XaUb5vt.2/pkpef31F6FN./b8JM2qcpqrGItqlvp2XR2u', '2025-07-10 11:31:59', 'student', NULL),
(13, 'ade', 'adeiye@gmail.com', '$2y$10$eeHXiTLGtBgMh6Uwi5QR.u2dZDwIiM2JfGaAcK3udgixeU4d1Pp8m', '2025-07-11 09:18:34', 'student', NULL),
(15, 'Admin User', 'admin@gmail.com', '$2y$10$8621p1GZ4aPDo6R3qp8b.eumg2Xuf04Ejhm8g5QP8GmRG5z1LhUgi', '2025-07-11 10:11:39', 'admin', NULL),
(16, 'daniel', 'daniel@gmail.com', '$2y$10$XiMwj.6sf5Kh.X/44.9Wq.1KnIZN9Fj/vt94.1GI.494yrw7Ua/i2', '2025-07-14 11:08:32', 'student', NULL),
(17, 'Sandra Okorie', 'talk2sample@gmail.com', '$2y$10$oW6Fr2nB2w2uXImKVtdpVOQR5ElOsWcNzwUS/jU5mV7gHtbysO2EW', '2025-07-16 16:36:59', 'student', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `activity`, `created_at`) VALUES
(1, 3, 'User logged in', '2025-06-22 09:39:41'),
(2, 3, 'User logged in', '2025-06-23 10:27:08'),
(3, 3, 'User logged in', '2025-06-24 13:38:35'),
(4, 3, 'User logged in', '2025-06-24 20:58:27'),
(5, 3, 'User logged in', '2025-06-24 20:58:35'),
(6, 3, 'User logged in', '2025-06-24 21:17:47'),
(7, 3, 'User logged in', '2025-06-24 21:29:49'),
(8, 4, 'User logged in', '2025-06-24 21:30:28'),
(9, 4, 'User logged in', '2025-06-24 21:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` decimal(10,2) DEFAULT 0.00,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
