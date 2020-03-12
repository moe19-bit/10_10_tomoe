-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 3 月 12 日 11:34
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
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `user_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `user_id`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'neko', '1234', 0, 0, '2020-02-29 16:55:47', '2020-02-29 16:55:47'),
(2, 'neko', '1234', 0, 0, '2020-02-29 16:56:29', '2020-02-29 16:56:29'),
(3, 'neko', '1234', 0, 0, '2020-02-29 17:00:38', '2020-02-29 17:00:38'),
(4, 'neko', '1234', 0, 0, '2020-02-29 17:00:59', '2020-02-29 17:00:59'),
(5, 'neko', '1234', 0, 0, '2020-02-29 17:04:42', '2020-02-29 17:04:42'),
(6, 'neko', '1234', 0, 0, '2020-02-29 17:05:18', '2020-02-29 17:05:18'),
(7, 'neko', '1234', 0, 0, '2020-02-29 17:05:50', '2020-02-29 17:05:50'),
(8, 'neko', '1234', 0, 0, '2020-02-29 17:06:59', '2020-02-29 17:06:59'),
(9, 'a', 'b', 0, 0, '2020-02-29 17:08:42', '2020-02-29 17:08:42'),
(10, 's', 'g', 0, 0, '2020-02-29 17:09:02', '2020-02-29 17:09:02'),
(11, 'Alice', '12345', 0, 0, '2020-03-05 02:26:58', '2020-03-05 02:26:58'),
(12, 'Rose', '678910', 0, 0, '2020-03-05 22:42:06', '2020-03-05 22:42:06'),
(13, 'Alice', '678910', 0, 0, '2020-03-12 18:21:00', '2020-03-12 18:21:00'),
(14, 'koko', 'abcd', 0, 0, '2020-03-12 18:23:28', '2020-03-12 18:23:28'),
(15, 'koko', '7777', 0, 0, '2020-03-12 18:46:37', '2020-03-12 18:46:37'),
(16, 'miao', '1111', 0, 0, '2020-03-12 18:58:45', '2020-03-12 18:58:45');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
