-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2020 at 12:39 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `user_id`) VALUES
(2, 'Javascript', 1),
(8, 'Python', 1),
(15, 'HTML', 3),
(17, 'C#', 4),
(23, 'Bootstrap 4.1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(31, 107, 'Dusko', 'tet@example.com', 'qweweweqweqwe', 'approved', '2020-10-28'),
(32, 107, 'Elon', 'elonmuskkkok@pasokd.com', '123123123', 'approved', '2020-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category`, `user_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(107, 2, 1, 'CSS', '', 'Elon', '2020-07-24', 'Dropshipping-It-Radionica-768x320.jpg', '<p>CSS POSTa asdasda sad</p>', 'CSS,Javascript, Cource, Class', 0, 'published', 355, 0),
(108, 8, 3, 'CSS', '', 'Elon', '2020-07-25', 'Dropshipping-It-Radionica-768x320.jpg', '<p>CSS POSTa asdasda sad</p>', 'CSS,Javascript, Cource, Class', 0, 'published', 27, 0),
(109, 17, 1, 'Python', '', 'Elon', '2020-10-28', 'cms_image_placeholder3.png', '<p>SD ASdSAD a asdddad ssd</p>', 'PHP, programming, language', 0, 'published', 10, 0),
(110, 8, 1, 'Python', '', 'Elon', '2020-10-28', 'cms_image_placeholder3.png', '<p>SD ASdSAD a asdddad ssd</p>', 'PHP, programming, language', 0, 'draft', 1, 0),
(111, 17, 4, 'CSS', '', 'Dusko', '2020-10-27', 'cms_image_placeholder2.png', '<p>CSS POSTa asdasda sad</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'CSS,Javascript, Cource, Class', 0, 'published', 12, 0),
(112, 17, 3, 'CSS', '', 'Dusko', '2020-08-07', 'cms_image_placeholder2.png', '<p>CSS POSTa asdasda sad</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 'CSS,Javascript, Cource, Class', 0, 'published', 1, 0),
(113, 8, 1, 'Python', '', 'Elon', '2020-10-16', 'starry_sky_silhouette_northern_lights_127556_3840x2160.jpg', '<p>SD ASdSAD a asdddad ssd</p>', 'PHP, programming, language', 0, 'published', 77, 0),
(114, 2, 4, 'Senior PHP developer', '', 'Dusko', '2020-10-16', '', '<p>asdasdadad</p>', 'asdasdd', 0, 'published', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$mojasifraimabas22slova',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(1, 'Elon', '$2y$12$GEUjfU3W/QjI.bAiKc7WeOSilLxaLMwsGA6wELD7FcGc2bP02U7EG', 'Elon', 'Musk', 'duskoprophp@gmail.com', '', 'admin', '', ''),
(3, 'Dusko', '$1$ZWhlzcm9$.QQzuNw1Y0vesKX2Mroco0', 'Dusko', 'Stagod', 'dupro28@gmail.com', '', 'subscriber', '', ''),
(4, 'Duskoo', '$2y$12$lXf0GD6sByxw2xj0R.SvXuV9SmSmbdrk8o59kNBpYtpHFPvHoYCgq', 'Duskoo', 'Proko', 'aspodiaspko@gmail.com', '', 'subscriber', '', ''),
(5, 'Elonn', '$2y$12$wQLWntI4co/5VXSg1Dqhyeg0QNnMV7NHwIGHPgd3uFxeE09R4GuXK', 'Elon', 'Musk', 'aspfokasdopf@gmail.com', '', 'admin', '', ''),
(32, 'qwer', '$2y$12$GvHu9PTltU15WGw02cS7C.Z8Gl3Y4hsN61nIKnb4//oxJO06S.jNa', '', '', 'aspdok@gmail.com', '', 'subscriber', '$2y$10$mojasifraimabas22slova', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(2, '4dmt75s5v5fdk16nf300srvf2l', 1595197290),
(3, 'l5iena9s3sos4ed9e6ui1sr2cg', 1595193404),
(4, 'e9eam7a2jsag6h1h66pf8jlo0h', 1595193442),
(5, 'legfedvtdgfbavor3bno79kt6p', 1595194337),
(6, 'osrqagpt8khvntnmu5m562p966', 1595196978),
(7, 'f6bfvvbi1l2r23jkg6rgpavlot', 1595197175),
(8, 'alsjt9l56bdrmhbc6ee4h4tofr', 1595325861),
(9, 'mpru3uc1a2qss6irrm753fktla', 1595357353),
(10, '1tfc7q4k5qsa7khm0b468ef7qs', 1595374528),
(11, 'vcg4go93g62b5hjmfi7uvlq6v0', 1595413815),
(12, 'vtq6artg59u95jur4g2tm11mou', 1595455994),
(13, '93f32i2j2aeg29j3b584bf39gf', 1595546544),
(14, '5suq3ude54v9stl87uh24sbl3j', 1595614617),
(15, 'gst7douhcnoi092d2b8go9ltan', 1595634895),
(16, '84pv2n0mllg30d3e6lvr2gr3uu', 1595708931),
(17, 'lgf62c4da63jfh4r2mtnglcbi2', 1595809768),
(18, '9k9oagphbcpc71umpg6uknk18n', 1595842068),
(19, 'plr4lo704uchj3mugmnn658toi', 1595847832),
(20, '9bs62112mjl3innm0m7s14l10s', 1595871829),
(21, 'unhfsm67lklharhoinr19moe5n', 1595895037),
(22, '8vd34t07v4oa34k3qnmdbhqnn0', 1595896331),
(23, 'q9rqshppp9eq73u17vhqm91fb9', 1595978443),
(24, 'ln37749hjoqhf0g4qe3jrocpi9', 1596498586),
(25, '5ulrc5pqneoq84d8b1qk7lri48', 1596760810),
(26, 'n2u6iqideqjjkvc7dramfu455p', 1596838010),
(27, 'fr9verqc083immk6l2pt56dgp0', 1600437293),
(28, 'i7er7gdp4eshlepbqapdj1sbko', 1602801160),
(29, 'uvcm76hkcjldk7m5i2adunc5jh', 1602803692),
(30, 'jkq860atshduga5o8jtbgi4fhh', 1602886768),
(31, 'sm913e2808ab928843229bisch', 1603804818),
(32, 'vap3m7ugasnu4kt82tmq4ggf37', 1603830408),
(33, 'r40672greomdhaduqa02l92102', 1603841773),
(34, '57e12ie07vuhdeq4c34e6u07r8', 1603886253);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
