-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 3 月 12 日 11:33
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacfd05_10`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(12) NOT NULL,
  `deadline` date NOT NULL,
  `cat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pref` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `task` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `todo_table`
--

INSERT INTO `todo_table` (`id`, `deadline`, `cat`, `pref`, `task`, `comment`, `image`, `created_at`, `updated_at`) VALUES
(1, '2020-02-29', '', '', 't', 'a', '', '2020-02-29 17:35:12', '2020-02-29 17:35:12'),
(3, '2020-03-03', '', '', 'こ', 'み', 'upload/20200301053024d41d8cd98f00b204e9800998ecf8427e.jpeg', '2020-03-01 13:30:24', '2020-03-01 13:30:24'),
(4, '2020-03-28', '', '', '猫', '可愛い', 'upload/20200301102525d41d8cd98f00b204e9800998ecf8427e.png', '2020-03-01 18:25:25', '2020-03-01 18:25:25'),
(5, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 18:37:53', '2020-03-01 18:37:53'),
(6, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 18:54:20', '2020-03-01 18:54:20'),
(7, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 18:59:16', '2020-03-01 18:59:16'),
(8, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 19:02:16', '2020-03-01 19:02:16'),
(9, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 19:04:55', '2020-03-01 19:04:55'),
(10, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 19:09:42', '2020-03-01 19:09:42'),
(11, '2020-03-01', '', '', '犬', '明るい', NULL, '2020-03-01 20:17:51', '2020-03-01 20:17:51'),
(13, '2020-03-31', '', '', '猫', 'よろしく', '', '2020-03-05 02:53:38', '2020-03-05 02:53:38'),
(14, '2020-03-07', '', '', 'テニス', '募集', '', '2020-03-05 03:04:51', '2020-03-05 03:04:51'),
(15, '2020-03-31', '', '', 'ひよこ', '楽しい', '', '2020-03-05 16:46:47', '2020-03-05 16:46:47'),
(16, '2020-04-01', '', '', '花見', '楽しい', '', '2020-03-05 16:51:06', '2020-03-05 16:51:06'),
(17, '2020-03-14', '', '', 'ホワイトデー', 'マシュマロ', '', '2020-03-05 17:44:22', '2020-03-05 17:44:22'),
(18, '2020-03-31', '', '', '囲碁', '対戦', '', '2020-03-05 17:44:48', '2020-03-05 17:44:48'),
(19, '2020-03-31', '', '', 'チェス', '対戦', '', '2020-03-05 17:57:05', '2020-03-05 17:57:05'),
(20, '2020-03-31', '', '', 'バトミントン', 'サークル', '', '2020-03-05 18:03:10', '2020-03-05 18:03:10'),
(21, '2020-04-01', '', '', 'フットサル', 'サークル', '', '2020-03-05 18:48:40', '2020-03-05 18:48:40'),
(22, '2020-03-01', '里親募集', '東京都', '犬', '明るい', NULL, '2020-03-05 21:46:16', '2020-03-05 21:46:16');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
