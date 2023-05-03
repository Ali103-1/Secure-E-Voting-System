-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 12:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elec`
--

-- --------------------------------------------------------

--
-- Table structure for table `condidate`
--

CREATE TABLE `condidate` (
  `id` int(11) NOT NULL,
  `election` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `descr` longtext NOT NULL,
  `condidate_name` varchar(255) NOT NULL,
  `total_votes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `condidate`
--

INSERT INTO `condidate` (`id`, `election`, `image`, `descr`, `condidate_name`, `total_votes`) VALUES
(2, 2, '', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used a2', 'morau faddol', 1),
(3, 3, '', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used a2', 'johim flje', 2),
(4, 3, '23192_16468_81284_pexels-photo-7582898.jpeg', 'DEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STOREDEGITAL STORE', 'DEGITAL STORE', 6);

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `repons` longtext NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`id`, `fname`, `title`, `email`, `content`, `repons`, `created`) VALUES
(17, 'fdsf sdf', '', 'hello', 'Details\r\nsdfsdf', '', '2023-04-08'),
(18, 'fdsf sdf', '', 'hello', 'Details\r\nsdfsdf', 'Reply to the message here', '2023-04-08'),
(19, 'dfd', '', 'test@gmail.com', 'Details\r\nfd', '', '2023-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `descr` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_votes` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`id`, `name`, `image`, `descr`, `start_date`, `end_date`, `total_votes`, `admin_id`) VALUES
(2, 'celection name2', '', 'celection name2celection name2celection name2celection name2celection name2celection name2celection name2celection name2celection name2celection name2celection name2', '2023-04-06', '2023-04-17', 5, 0),
(3, 'election name 3', '', 'election name 3election name 3election name 3election name 3election name 3election name 3election name 3election name 3election name 3election name 3election name 3election name 3election name 3vv', '2023-04-05', '2023-04-21', 13, 5),
(4, 'niayaro balr', '71813_28149_68637_69345_8422_logo.png', 'niayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrniayaro balrv', '2023-04-14', '2023-05-01', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `qst` varchar(5000) NOT NULL,
  `ans` varchar(5000) NOT NULL,
  `qst_en` varchar(255) NOT NULL,
  `ans_en` varchar(255) NOT NULL,
  `m` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `qst`, `ans`, `qst_en`, `ans_en`, `m`) VALUES
(18, 'here put the question', 'here put the answer here put the answerhere put the answerhere put the answer', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `fname`, `email`, `title`, `message`, `created`) VALUES
(7, 'حمحم99999', 'fdfdfdf', 'df', 'fdfsf', '2023-01-14'),
(8, 'مردا يل ث', 'info@email.com', '', 'تفاصيل عن الاستفسارf\r\ndsf sdf sdf', '2023-02-25'),
(9, 'مردا يل ث', 'info@email.com', '', 'تفاصيل عن الاستفسارf\r\ndsf sdf sdf', '2023-02-25'),
(10, 'مردا يل ث', 'info@email.com', '', 'تفاصيل عن الاستفسارf\r\ndsf sdf sdf', '2023-02-25'),
(11, 'ds', 'sterk@gmail.com', '', 'تفاصيل عن الاستفسار\r\nsdf', '2023-02-25'),
(12, 'ds', 'sterk@gmail.com', '', 'تفاصيل عن الاستفسار\r\nsdf', '2023-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `fname`, `content`, `status`, `created`) VALUES
(4, 0, 'اسامة كلي', 'تفاصيل عن الاستفسارتفاصيل عن الاستفسارتفاصيل عن الاستفسارتفاصيل عن الاستفسارتفاصيل عن الاستفسار\r\n', 1, '2023-02-26 15:15:02'),
(5, 0, 'fdsf sdf', 'Details\r\nsdfsdf', 1, '2023-04-08 01:09:33'),
(6, 0, 'fdsf sdf', 'Details\r\nsdfsdf', 1, '2023-04-08 01:09:34'),
(7, 0, 'dfd', 'Details\r\nfd', 1, '2023-04-08 21:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `aboutus` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aboutus_e` longtext NOT NULL,
  `aboutus_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `favicon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_paragraph` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `h_image2` varchar(255) NOT NULL,
  `h_title2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_paragraph2` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_image3` varchar(255) NOT NULL,
  `h_title3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_paragraph3` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `projects` int(11) NOT NULL DEFAULT 0,
  `units` int(11) NOT NULL DEFAULT 0,
  `fb` varchar(255) NOT NULL,
  `snap` varchar(255) NOT NULL,
  `inst` varchar(255) NOT NULL,
  `twi` varchar(255) NOT NULL,
  `whats` varchar(255) NOT NULL,
  `tik` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` longtext NOT NULL,
  `video` varchar(255) NOT NULL,
  `sv` int(11) NOT NULL DEFAULT 0,
  `privacy` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `h_image4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `aboutus`, `aboutus_e`, `aboutus_img`, `logo`, `favicon`, `h_image`, `h_title`, `h_paragraph`, `h_image2`, `h_title2`, `h_paragraph2`, `h_image3`, `h_title3`, `h_paragraph3`, `projects`, `units`, `fb`, `snap`, `inst`, `twi`, `whats`, `tik`, `phone`, `email`, `location`, `video`, `sv`, `privacy`, `h_image4`) VALUES
(1, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningfu ', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a type', '15766_2.gif', '11275_84406_favicon.png', '84406_favicon.png', '69285_pexels-field-engineer-442150.jpg', 'هنا عبارة ترحيبية1', 'هنا في فقرة الهيدر يتم التعديل عليها من خلال لوحة التحكم الخاصة بالموقع و بالضبط في صفحة  محتوى شركة', '34408_pexels-mikhail-nilov-7989234.jpg', 'هنا عبارة ترحيبية او وصف لشركة او الموقع 2', 'هنا في فقرة الهيدر يتم التعديل عليها من خلال لوحة التحكم الخاصة بالموقع و بالضبط في صفحة  محتوى الصفحات و بعد الدخول يتم ملئء البيانات حسب الشركة كنبذة عن الشركة', '40716_pexels-lee-campbell-89724.jpg', 'هنا عبارة ترحيبية او وصف لشركة او الموقع 3', 'هنا في فقرة الهيدر يتم التعديل عليها من خلال لوحة التحكم الخاصة بالموقع و بالضبط في صفحة  محتوى الصفحات و بعد الدخول يتم ملئء البيانات حسب الشركة كنبذة عن الشركة', 1, 1, 'www.facebook.com', '2gfdg', 'www.instagram.comd', 'www.twiiter.comd', '0122062676', 'dsds3', '', 'sterk@gmail.com', '', '56150_vd.mp4', 0, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. <a href=\"https://en.wikipedia.org/wiki/Lorem_ipsum\">Wikipedia</a> v</p>\r\n', '20510_17003_16094_14156_bgg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(50) NOT NULL,
  `age` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `adress` varchar(2555) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `image`, `password`, `phone`, `age`, `type`, `adress`, `created`) VALUES
(5, 'admin', '', '68881_er.jpeg', 'd033e22ae348aeb5660fc2140aec35850c4da997', '564640', '22', 2, '', '2021-02-28'),
(33, 'mustapha', '', '', '12dea96fec20593566ab75692c9949596833adc9', '', '', 1, '', '2023-02-26'),
(34, 'dssdds', '', '', '12dea96fec20593566ab75692c9949596833adc9', '', '', 1, '', '2023-02-26'),
(35, 'user2', '', '30085_8081_81284_pexels-photo-7582898.jpeg', '12dea96fec20593566ab75692c9949596833adc9', '656', '87', 1, 'dsf sdfl sdjfl sdkjf sd2', '2023-04-07'),
(36, 'usnermae', 'test2@gmail.com', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '897987987', '18', 0, '', '2023-04-12'),
(37, 'usnermae', 'test2@gmail.com', '', '12dea96fec20593566ab75692c9949596833adc9', '897987987', '18', 0, '', '2023-04-12'),
(38, 'username', 'user@gmail.com', '', '12dea96fec20593566ab75692c9949596833adc9', '000575', '13', 0, 'hvc fdkljg ldkfgj df', '2023-04-12'),
(39, 'usnermae', 'user@gmail.com', '', '12dea96fec20593566ab75692c9949596833adc9', '897987987', '18', 0, '', '2023-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `election` int(11) NOT NULL,
  `condidate` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `user`, `election`, `condidate`, `created`) VALUES
(16, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 2, 2, '2023-04-08'),
(17, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 2, 3, '2023-04-08'),
(18, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 3, 3, '2023-04-08'),
(23, '38', 3, 4, '2023-04-12'),
(24, '38', 3, 4, '2023-04-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `condidate`
--
ALTER TABLE `condidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condidate`
--
ALTER TABLE `condidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
