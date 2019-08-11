-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019-08-11 12:37:02
-- 伺服器版本: 5.7.20-log
-- PHP 版本： 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shopping`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `c_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `cart`
--

INSERT INTO `cart` (`c_id`, `uid`, `product_id`, `quantity`, `createtime`) VALUES
(1, 1, 2, '1', '2019-08-11 02:55:05'),
(1, 1, 3, '3', '2019-08-11 02:55:05'),
(1, 1, 4, '2', '2019-08-11 02:55:05'),
(1, 1, 5, '1', '2019-08-11 02:55:05'),
(1, 2, 1, '1', '2019-08-11 03:15:22'),
(1, 2, 2, '1', '2019-08-11 03:15:22'),
(1, 2, 3, '1', '2019-08-11 03:15:22'),
(2, 1, 1, '1', '2019-08-11 03:08:46'),
(2, 1, 2, '1', '2019-08-11 03:08:46'),
(2, 1, 3, '2', '2019-08-11 03:08:46'),
(2, 1, 4, '3', '2019-08-11 03:08:46'),
(2, 2, 2, '3', '2019-08-11 04:02:42'),
(2, 2, 3, '5', '2019-08-11 04:02:42'),
(3, 1, 1, '2', '2019-08-11 04:34:56'),
(3, 2, 4, '1', '2019-08-11 04:23:03'),
(4, 2, 1, '3', '2019-08-11 04:27:34'),
(4, 2, 2, '3', '2019-08-11 04:27:34'),
(5, 2, 1, '3', '2019-08-11 04:30:28'),
(5, 2, 2, '3', '2019-08-11 04:30:28');

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userpassword` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `customer`
--

INSERT INTO `customer` (`uid`, `username`, `userpassword`) VALUES
(1, 'test1', 'test1'),
(2, 'test2', 'test2');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_desc` varchar(200) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_price`, `product_img`) VALUES
(1, '可樂', '可樂是一種黑褐色、帶有甜味、含咖啡因的碳酸飲料，但不含酒精，非常流行。', '29', 1),
(2, '麥香奶茶', '奶茶，是一種將茶和奶混合的飲料，可加以調理飲用。', '10', 2),
(3, '麥香紅茶', '紅茶是一種全發酵茶，是西方茶文化中的主要茶品。目前紅茶的產地主要有中國、斯里蘭卡、印度、肯亞、印度尼西亞等。', '10', 3),
(4, '牛奶', '牛乳，俗稱牛奶，是最古老的天然飲料之一。顧名思義，牛乳是牛的乳汁。在不同國家，牛乳也分有不同的等級，目前最普遍的是全脂、高鈣低脂及脫脂牛乳。', '35', 4),
(5, '豆漿', '豆漿又稱豆奶、豆腐漿，是指以黃豆或黑豆研磨而成的漿汁，營養與牛乳相似，富含植物性蛋白質與微量鈣質，是素食者的優良蛋白質攝取來源。', '20', 5);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`c_id`,`uid`,`product_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `product_id` (`product_id`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`uid`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `customer` (`uid`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
