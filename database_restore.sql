-- ============================================================
-- Kwan's Trading Platform (樂器實時交易平臺)
-- 原版 MySQL 數據庫結構還原與測試帳號注入腳本
-- 適用於 phpMyAdmin / MySQL 5.7+ / MySQL 8.0+ / MariaDB
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";

-- ------------------------------------------------------------
-- 1. 資料表結構：`user` (對應報告書圖 3-89)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `email` varchar(100) NOT NULL,
  `tel` int(11) NOT NULL,
  `date` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `interested` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 注入測試帳號 (包含原版管理員、原版測試用戶及額外測試帳號)
INSERT INTO `user` (`ID`, `username`, `password`, `balance`, `email`, `tel`, `date`, `gender`, `interested`, `country`, `message`, `type`) VALUES
(1, 'admin123456', 'admin123456', 999999999.99, 'admin@kwantrading.com', 91234567, '2000-01-01', 'male', 'pop jazz classical ', 'China', 'Original SBA Admin Account', 'admin'),
(2, 'sctt_ok', '12345678', 1000000.00, 'sheungkuan.li@gmail.com', 61234567, '2008-05-15', 'male', 'pop classical ', 'China', 'Original SBA User Account', 'user'),
(3, 'admin', '123456', 1000000.00, 'admin2@kwantrading.com', 98765432, '2005-08-20', 'male', 'jazz classical ', 'China', 'Quick Test Admin Account', 'admin'),
(4, 'testuser1', '123456', 1000000.00, 'testuser1@example.com', 51234567, '2007-03-10', 'female', 'pop jazz ', 'Japan', 'Standard Test Buyer Account', 'user'),
(5, 'pooruser', '123456', 50.00, 'pooruser@example.com', 69876543, '2008-11-22', 'male', 'Rock Country ', 'USA', 'Low Balance Test Account', 'user');

-- ------------------------------------------------------------
-- 2. 資料表結構：`products` (對應報告書圖 3-90)
-- 注意：保留原本帶有空格的欄位名稱 `file path` 以完全兼容原版 PHP 代碼
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `products` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `productname` text NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `file path` text NOT NULL,
  `product_status` text NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 注入原版 6 款樂器商品資料 (對應報告書圖 3-62、3-73、3-78、3-84)
INSERT INTO `products` (`productid`, `productname`, `price`, `description`, `file path`, `product_status`) VALUES
(1, 'Piano', 10000, 'The World''s Most Expressive Piano', 'sound/soft-piano-100-bpm-121529.mp3', 'onsale'),
(2, 'Violin', 5000.5, 'The most economical choice', 'sound/violin-music-64019.mp3', 'onsale'),
(3, 'Guitar', 1000, 'Concert-grade guitar', 'sound/relaxing-guitar-loop-v5-245859.mp3', 'onsale'),
(4, 'Cello', 100.25, 'high-quality sound', 'sound/cello-355430.mp3', 'offsale'),
(5, 'Dizi', 10, 'Agile tones', 'sound/dizi-flute-02-72563.mp3', 'offsale'),
(6, 'Erhu', 10000000, 'Erhu with Rich, Sonorous Tones', 'sound/erhu-melodic-loop-62755.mp3', 'offsale');

-- ------------------------------------------------------------
-- 3. 資料表結構：`transactionrecords` (對應報告書圖 3-91)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `transactionrecords` (
  `Transactionid` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `productname` text NOT NULL,
  `Transactiontime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Transactionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 注入原版測試交易記錄 (對應報告書圖 2-10)
INSERT INTO `transactionrecords` (`Transactionid`, `username`, `productname`, `Transactiontime`) VALUES
(1, 'sctt_ok', 'Violin', '2025-10-01 18:15:10'),
(2, 'sctt_ok', 'Guitar', '2025-10-01 18:15:26'),
(3, 'sctt_ok', 'Piano', '2025-10-01 18:15:28'),
(4, 'testuser1', 'Piano', '2025-10-02 10:20:00');

COMMIT;
