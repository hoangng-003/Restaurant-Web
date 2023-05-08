-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 09:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_rest`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getDishFeedbackRating` (`d_id_` INT) RETURNS DOUBLE  begin
	DECLARE result double DEFAULT 0;
    DECLARE result_ceiling double DEFAULT 0;
    DECLARE result_offset double DEFAULT 0;
    
    SELECT ROUND(SUM(rating_value)/SUM(if(rating_value = 0, 0, 1)), 2) into result
    FROM `dishes_feedbacks`
    WHERE d_id = d_id_;
    set result_ceiling = ceiling(result);
    set result_offset = result_ceiling - result;
    set result = CASE
    	when result_offset <= 0.25 then result_ceiling
        when result_offset <= 0.75 then result_ceiling - 0.5
        else result_ceiling-1
    end;
    return result;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getDishReviewCount` (`d_id_` INT) RETURNS INT(11)  BEGIN
	DECLARE	result INT DEFAULT 0;
    SELECT COUNT(*) INTO result
    FROM dishes_feedbacks
    WHERE d_id=d_id_;
    return result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getMinDishPrice` (`rs_id_` INT) RETURNS DOUBLE  BEGIN
	DECLARE result double DEFAULT 0;
    SELECT min(d.price) into result
    FROM dishes d
    WHERE d.rs_id = rs_id_;
    return result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getRestFeedbackRating` (`rs_id_` INT) RETURNS DOUBLE  BEGIN
	DECLARE result double DEFAULT 0;
    DECLARE result_ceiling double DEFAULT 0;
    DECLARE result_offset double DEFAULT 0;
    
    SELECT ROUND(SUM(df.rating_value)/SUM(if(df.rating_value = 0, 0, 1)), 2) into result
    FROM dishes d
	JOIN dishes_feedbacks df on df.d_id = d.d_id
    WHERE d.rs_id = rs_id_;
    set result_ceiling = ceiling(result);
    set result_offset = result_ceiling - result;
    set result = CASE
    	when result_offset <= 0.25 then result_ceiling
        when result_offset <= 0.75 then result_ceiling - 0.5
        else result_ceiling-1
    end;
    return result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getRestReviewCount` (`rs_id_` INT) RETURNS DOUBLE  BEGIN
	DECLARE result double DEFAULT 0;
    
    SELECT count(*) into result
    FROM dishes d
	JOIN dishes_feedbacks df on df.d_id = d.d_id
    WHERE d.rs_id = rs_id_;
    return result;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', '', '2023-05-07 13:34:33'),
(8, 'abc888', '6d0361d5777656072438f6e314a852bc', 'abc@gmail.com', 'QX5ZMN', '2023-05-07 13:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(24, 57, 'Crispy fried mushroom', 'Indulge in the crunch without the compromise: Crispy, Delicious, Vegan!', '5.00', '6457bbdc8957b.jpg'),
(25, 57, 'Spring roll with orange sauce', 'Crispy rolls, zesty dip: Spring into flavor with us!', '7.50', '6457bd27027ac.jpg'),
(26, 57, 'Soul of the spring', 'A tantalizing twist on tradition: Taste the season with our Tomato Peach Salad!', '10.00', '6457c4309036d.jpg'),
(27, 57, 'Tomato peach salad', 'Taste the season with our Tomato Peach Salad!', '10.00', '6457c2ba39175.jpg'),
(28, 58, 'Mushroom fried rice', 'Satisfy your cravings with every savory bite: Mushroom Fried Rice hits the spot just right!', '5.00', '6457c7c7099a0.jpg'),
(29, 58, 'Mushroom soup', 'A warm hug in a bowl: Savour the goodness of our Mushroom Soup!', '5.00', '6457c6758ee44.jpg'),
(30, 58, 'Spaghetti', 'From Italy to your plate, cruelty-free: Enjoy the authentic taste of Vegan Spaghetti!', '12.50', '6457c6b881572.jpg'),
(32, 58, 'Stir fried noodle with brocoli', ' Wok your way to a healthier you: Stir up delicious with our Broccoli Noodle Stir Fry!', '10.00', '6457c76b7b8e7.jpg'),
(33, 58, 'Toasted bread with eggplant', 'Toasted Bread with Eggplant, the perfect combination!', '7.50', '6457c7e86db80.jpg'),
(34, 59, 'Kiwi smoothie', 'Experience the exotic with every sip: Refresh and revitalize with our Kiwi Smoothie!', '2.50', '6457c9998cbec.jpg'),
(35, 59, 'Oat porridge', 'Start your day the wholesome way: Warm up with a bowl of our delicious Oat Porridge!', '7.50', '6457c9cae3fe7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dishes_feedbacks`
--

CREATE TABLE `dishes_feedbacks` (
  `df_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `d_id` int(222) NOT NULL,
  `rating_value` int(222) DEFAULT NULL,
  `feedback` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dishes_feedbacks`
--

INSERT INTO `dishes_feedbacks` (`df_id`, `u_id`, `d_id`, `rating_value`, `feedback`) VALUES
(30, 36, 24, 4, 'So good!');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(76, 70, 'closed', 'done', '2023-05-07 17:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`, `latitude`, `longitude`) VALUES
(57, 12, 'Uu Dam Vegan', 'uudamchay@gmail.com', '0981349898', 'http://uudamchay.com/', '7am', '8pm', 'mon-thu', '34 Hang Bai street, Hoan Kiem district, Hanoi', '6457ba0a5cd5d.jpg', '2023-05-07 14:47:38', 21.0187037, 105.8481346),
(58, 17, 'Loving Hut', 'lovinghut@gmail.com', '0345897748', 'lovinghut.com', '6am', '7pm', 'mon-sat', '147B Au Co street, Tay Ho district, Hanoi', '6457c5fd1f4f0.jpg', '2023-05-07 15:38:37', 21.0644689, 105.7954163),
(59, 21, 'Aummee', 'aummee@gmail.com', '0918226996', 'https://aummee.com.vn/thuc-don/', '8am', '8pm', '24hr-x7', '26 Chau Long, Truc Bach Street, Ba Dinh district, Hanoi', '6457c921d625f.jpg', '2023-05-07 15:52:01', 21.0457368, 105.8425202);

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(12, 'Salad', '2023-05-07 14:42:58'),
(13, 'Porridge', '2023-05-07 14:43:02'),
(14, 'Crispy Fried', '2023-05-07 14:43:06'),
(15, 'Toasted Bread', '2023-05-07 14:43:15'),
(16, 'Soup', '2023-05-07 14:43:21'),
(18, 'Fried Rice', '2023-05-07 14:43:32'),
(20, 'Burger', '2023-05-07 14:43:41'),
(21, 'Smoothie', '2023-05-07 14:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `l_name` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(36, 'duykhanhxx03', 'Khanh', 'Tran Duy', 'duykhanhxx03@gmail.com', '0914508451', 'c87f31787f1020520ef13a45f6640c5e', 'KTX Ngoại ngữ\r\nDịch Vọng Hậu', 1, '2023-05-07 17:01:22'),
(37, 'tunoxy', 'Long', 'Tran Duy', 'duylong@gmail.com', '0914508451', 'c87f31787f1020520ef13a45f6640c5e', '225 Tran Quoc Hoan', 1, '2023-05-08 04:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `d_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `d_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(70, 36, 24, 'Crispy fried mushroom', 1, '5.00', 'closed', '2023-05-07 17:02:50'),
(71, 36, 25, 'Spring roll with orange sauce', 1, '7.50', NULL, '2023-05-07 17:02:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `dishes_feedbacks`
--
ALTER TABLE `dishes_feedbacks`
  ADD PRIMARY KEY (`df_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dishes_feedbacks`
--
ALTER TABLE `dishes_feedbacks`
  MODIFY `df_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishes_feedbacks`
--
ALTER TABLE `dishes_feedbacks`
  ADD CONSTRAINT `dishes_feedbacks_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
