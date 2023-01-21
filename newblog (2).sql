-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 03:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(6) UNSIGNED NOT NULL,
  `catname` varchar(20) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`, `description`) VALUES
(1, 'Horror', 'It is horror'),
(2, 'Tech', 'This is tech'),
(3, 'Sports', 'This is sports'),
(4, 'Philosophy', 'This is Philosophy');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_posted` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `user_id`, `content`, `date_posted`) VALUES
(0, 10, 2, 'now', '11th Aug 2022 10:06:01am'),
(0, 10, 2, 'try again', '11th Aug, 2022 - 10:06:51am'),
(0, 8, 2, 'first comment', '11th Aug, 2022 - 10:31:14am'),
(0, 4, 1, 'first comment on this article', '11th Aug, 2022 - 10:33:49am'),
(0, 10, 1, 'hello world', '11th Aug, 2022 - 12:41:53pm'),
(0, 10, 1, 'lets make', '11th Aug, 2022 - 12:42:01pm'),
(0, 10, 1, 'total of five comments', '11th Aug, 2022 - 12:42:11pm'),
(0, 8, 1, 'new comment', '12th Aug, 2022 - 04:03:38am'),
(0, 8, 1, 'new comment', '12th Aug, 2022 - 04:04:03am'),
(0, 8, 1, 'commenting as admin', '12th Aug, 2022 - 06:41:58am'),
(0, 8, 2, 'commenting as fahim', '12th Aug, 2022 - 06:42:27am'),
(0, 0, 2, 'hello', '29th Aug, 2022 - 04:50:25pm'),
(0, 0, 2, 'hello', '29th Aug, 2022 - 04:50:39pm'),
(0, 0, 2, 'hello', '29th Aug, 2022 - 04:57:25pm'),
(0, 23, 2, 'hello', '29th Aug, 2022 - 04:58:37pm'),
(0, 30, 2, 'hello\r\n', '29th Aug, 2022 - 06:31:12pm'),
(0, 10, 2, 'hello world\r\n', '30th Aug, 2022 - 07:04:14pm'),
(0, 29, 2, 'Intersting Algorithm', '1st Sep, 2022 - 11:17:31pm'),
(0, 26, 2, 'Scary!!', '1st Sep, 2022 - 11:24:59pm'),
(0, 26, 2, 'Hello', '1st Sep, 2022 - 11:25:07pm'),
(0, 26, 2, 'Chris Brown', '1st Sep, 2022 - 11:25:20pm'),
(0, 30, 2, 'under the influence', '6th Sep, 2022 - 01:28:50am');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `userid`, `postid`) VALUES
(17, 2, 30),
(22, 4, 31);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `post_cat` int(50) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `link` varchar(500) NOT NULL,
  `likes` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `slug`, `post_cat`, `posted_by`, `img`, `link`, `likes`, `date`) VALUES
(1, 'Cristiano Ronaldo Returns to Manchester United', '<img class=\"w3-image\" src=\"https://assets.manutd.com/AssetPicker/images/0/0/15/128/1016013/CR_Home_21630596121972_large.jpg\" alt=\"\"><p>\r\n\r\nManchester United is delighted to confirm the signing of Cristiano Ronaldo on a two-year contract with the option to extend for a further year, subject to international clearance.\r\n\r\n\r\nCristiano, a five-time Ballon D’or winner, has so far won over 30 major trophies during his career, including five UEFA Champions League titles, four FIFA Club World Cups, seven league titles in England, Spain and Italy, and the UEFA European Championship for his native Portugal. Cristiano is the first player to have won league titles in England, Spain and Italy. He was also the highest goalscorer in last season’s Serie A and won the golden boot at this year’s European Championship. In his first spell for Manchester United, he scored 118 goals in 292 games.</p><p>Cristiano Ronaldo said:\r\n\r\n“Manchester United is a club that has always had a special place in my heart, and I have been overwhelmed by all the messages I have received since the announcement on Friday. I cannot wait to play at Old Trafford in front of a full stadium and see all the fans again. I\'m looking forward to joining up with the team after the international games, and I hope we have a very successful season ahead.”</p><p>Ole Gunnar Solskjaer said:\r\n\r\n“You run out of words to describe Cristiano. He is not only a marvellous player, but also a great human being. To have the desire and the ability to play at the top level for such a long period requires a very special person. I have no doubt that he will continue to impress us all and his experience will be so vital for the younger players in the squad. Ronaldo’s return demonstrates the unique appeal of this club and I am absolutely delighted he is coming home to where it all started.” </p>  ', 'cristiano-ronaldo-returns-to-manchester-united', 3, 'Admin', '', '', 0, '2022-08-16 17:04:10'),
(2, 'Leo Messi signs for Paris Saint-Germain', 'Paris Saint-Germain is delighted to announce the signing of Leo Messi on a two-year contract with an option of a third year.\r\n\r\nThe six-time Ballon d’Or winner is justifiably considered a legend of the game and a true inspiration for those of all ages inside and outside football.</strong></p><p>The signing of Leo reinforces Paris Saint-Germain’s aspirations as well as providing the club’s loyal fans with not only an exceptionally talented squad, but also moments of incredible football in the coming years.</p><p>Leo Messi said: “I am excited to begin a new chapter of my career at Paris Saint-Germain. Everything about the club matches my football ambitions. I know how talented the squad and the coaching staff are here. I am determined to help build something special for the club and the fans, and I am looking forward to stepping out onto the pitch at the Parc des Princes.”</p><p>Nasser Al-Khelaifi, Chairman and CEO of Paris Saint-Germain said: “I am delighted that Lionel Messi has chosen to join Paris Saint-Germain and we are proud to welcome him and his family to Paris. He has made no secret of his desire to continue competing at the very highest level and winning trophies, and naturally our ambition as a club is to do the same. The addition of Leo to our world class squad continues a very strategic and successful transfer window for the club. Led by our outstanding coach and his staff, I look forward to the team making history together for our fans all around the world.” ', 'leo-messi-signs-for-paris-saint-germain', 3, 'Admin', 'messi.jpg', '', 0, '2022-09-09 13:51:16'),
(3, 'Apple Introduces iPhone 13 and iPhone 13 Mini', '<p style=\"text-align: center; \"><img src=\"https://www.apple.com/newsroom/images/product/iphone/geo/Apple_iphone13_hero_geo_09142021_inline.jpg.large.jpg\" alt=\"\"><strong><br></strong></p><p><strong>CUPERTINO, CALIFORNIA</strong> Apple today introduced iPhone 13 and iPhone 13 mini, the next generation of the world’s best smartphone, featuring a beautiful design with sleek flat edges in five gorgeous new colours. Both models feature major innovations, including the most advanced dual-camera system ever on iPhone — with a new Wide camera with bigger pixels and sensor-shift optical image stabilisation (OIS) offering improvements in low-light photos and videos, a new way to personalise the camera with Photographic Styles, and Cinematic mode, which brings a new dimension to video storytelling. iPhone 13 and iPhone 13 mini also boast super-fast performance and power efficiency with A15 Bionic, longer battery life, a brighter Super Retina XDR display that brings content to life, incredible durability with the Ceramic Shield front cover, double the entry-level storage at 128GB, an industry-leading IP68 rating for water resistance, and an advanced 5G experience.</p>', 'apple-introduces-iphone-13-and-iphone-13-mini', 2, 'Admin', '', '', 0, '2021-08-14 05:26:05'),
(4, 'Apple Reveals Apple Watch Series 7', '<img src=\"https://www.apple.com/newsroom/images/product/watch/standard/Apple_watch-series7_hero_09142021_big.jpg.large.jpg\" alt=\"\"><p><strong>\r\nCUPERTINO, CALIFORNIA</strong> Apple today announced Apple Watch Series 7, featuring a reengineered Always-On Retina display with significantly more screen area and thinner borders, making it the largest and most advanced display ever. The narrower borders allow the display to maximise screen area, while minimally changing the dimensions of the watch itself. The design of Apple Watch Series 7 is refined with softer, more rounded corners, and the display has a unique refractive edge that makes full-screen watch faces and apps appear to seamlessly connect with the curvature of the case. Apple Watch Series 7 also features a user interface optimised for the larger display, offering greater readability and ease of use, plus two unique watch faces — Contour and Modular Duo — designed specifically for the new device. With the improvements to the display, users benefit from the same all-day 18-hour battery life,1 now complemented by 33 percent faster charging.</p>', 'apple-reveals-apple-watch-series-7', 2, 'Admin', '', '', 0, '2018-04-18 05:26:11'),
(8, 'MY AIM IN LIFE', '<p style=\"text-align: center;\"><img src=\"https://1.bp.blogspot.com/-nAiuXy8D9u0/XbkMkE_7N4I/AAAAAAAAVKU/h_zxI7mBGHkXO1DF5JElssTOXOcasUAAQCLcBGAsYHQ/w640/My-Aim-In-Life-essay.jpg\" alt=\"aimlife\" style=\"color: rgb(75, 79, 88);\"><br></p><p><span style=\"color: rgb(75, 79, 88); font-family: \" source=\"\" sans=\"\" pro\",=\"\" sans-serif;=\"\" font-size:=\"\" 17px;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">An aim is a goal or objective to achieve in life. In order to succeed in life, one must have a goal. My aim in life is to be a teacher. Teaching is a noble and responsible profession. I have come to know that the ever-increasing misery and distress, are due to the ignorance and illiteracy of the people of our country. So I have decided to spread education among the masses as much as possible within my humble power. As a teacher, I shall try my best to impart man-making education. Some say that money is the honey of life. But I do not agree with them. Rather, I think that morality is the most important thing in life. I want to be a lovable and respectable person as a teacher in the future.</span></p>                    ', 'my-aim-in-life', 0, 'fahim', '', '', 0, '2022-06-25 10:00:19'),
(10, 'The Theory of Knowledge', '<p style=\"text-align: center;\"><img src=\"data:image/jpeg;base64,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\" alt=\"TOK\"></p><p style=\"text-align: center; \"><span style=\"color: rgb(102, 102, 102); font-family: Arial, sans-serif; font-size: 18px; background-color: rgb(238, 238, 255);\">The question how knowledge should be defined is perhaps the most important and difficult of the three with which we shall deal. This may seem surprising: at first sight it might be thought that knowledge might be defined as belief which is in agreement with the facts. The trouble is that no one knows what a belief is, no one knows what a fact is, and no one knows what sort of agreement between them would make a belief true. Let us begin with belief.</span></p>       ', 'the-theory-of-knowledge', 4, 'fahim', '', '', 0, '2022-08-30 17:01:16'),
(22, 'desperado', '<p><strong>montecarlo   </strong></p>', 'desperado', 0, 'fahim', 'Crimson Night(Red Sun) (2).jpg', '', 0, '2022-08-22 23:09:50'),
(26, 'king of castle', 'hello world, 123', 'king-of-castle', 1, 'fahim', '', '', 0, '2022-08-25 16:50:08'),
(29, 'sutherland hodgeman', 'This is an algorithm', 'sutherland-hodgeman', 2, 'dalailama', '', 'https://www.youtube.com/embed/NobLtrXvh0Q', 0, '2022-08-28 20:49:14'),
(30, 'Gangsta\'s paradise', '<p>Tommy Boy Records is a legendary Hip Hop &amp; Electronic record label founded in New York City in 1981. The label is credited with launching the careers of notable legends Queen Latifah, House of Pain, Coolio and Naughty By Nature.<br></p>', 'gangstas-paradise', 0, 'fahim', '', 'https://www.youtube.com/embed/fPO76Jlnz6c', 0, '2022-08-28 16:40:00'),
(31, 'sports post', 'a sports related post', 'sports-post', 3, 'dalailama', '', '', 0, '2022-09-09 06:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `author_mail` varchar(60) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sub_mail` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `author_id`, `author_name`, `author_mail`, `sub_id`, `sub_name`, `sub_mail`) VALUES
(19, 2, 'fahim', 'fahim99033@gmail.com', 4, 'dalailama', 'rd@yahoomail.com'),
(20, 4, 'dalailama', 'rd@yahoomail.com', 2, 'fahim', 'fahim99033@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `dp` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `gender`, `age`, `address`, `dp`, `date`) VALUES
(1, 'Admin', '123456', 'admin@example.org', '', 0, '', '', '2022-09-03 04:40:21'),
(2, 'fahim', '1234', 'fahim99033@gmail.com', 'Male', 22, 'mirpur', 'images.jfif', '2022-09-05 23:21:31'),
(4, 'dalailama', '123456', 'rd@yahoomail.com', 'Male', 100, 'Himalaya', 'Dalailama1_20121014_4639.jpg', '2022-09-03 04:40:21'),
(13, 'dos', '123456', 'sadsad', '', 0, '', '', '2022-09-03 04:40:21'),
(7, 'desperado  ', '123456', 'redhat@linux.com', '', 0, '', '', '2022-09-03 04:40:21'),
(14, 'des', '123456', 'hello@gmail.com', '', 0, '', '', '2022-09-03 04:40:21'),
(15, 'eurythmics', '123456', 'eurythmics@ymail.com', '', 0, '', '', '2022-09-03 04:40:21'),
(18, 'robin', '123456', 'robin@gmail.com', '', 0, '', '', '2022-09-03 04:40:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`page_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
