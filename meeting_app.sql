-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-09-16 17:50:35
-- サーバのバージョン： 10.4.14-MariaDB
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `meeting_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `board`
--

CREATE TABLE `board` (
  `b_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `submit_member_id` varchar(32) NOT NULL,
  `body` text NOT NULL,
  `board_photo` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `board`
--

INSERT INTO `board` (`b_id`, `c_group_id`, `submit_member_id`, `body`, `board_photo`, `created`) VALUES
(1, 2, 'dora', 'どらやきは、撮影小物になりますか？\r\n大切な思い出の品なんです。\r\n和装でどらやき食べさせあいっこしたいのです。', 0, '2020-09-06 13:22:51'),
(2, 2, 'dora', 'ちなみに、特別サイズのおおきいどらやき持参予定です。', 0, '2020-09-06 13:23:19'),
(3, 9, 'eri', '次回打合せに、9月7日11時に伺いたいのですが、予約可能でしょうか？', 0, '2020-09-06 13:24:07'),
(4, 9, 'eri', 'あと、ドレス試着も打合せのあとにしたいので、予約取れそうならお願いしたいですー！', 0, '2020-09-06 13:25:15'),
(5, 9, 'kiyo', '僕もタキシード再度みたいです！明日、急ですが、予約可能だったらうれしいです。\r\n無理なら来週月曜日も調べてほしいです。', 0, '2020-09-06 13:28:11'),
(7, 2, 'dora', 'お返事くれないのは、どらやきはだめってことですか？\r\n\r\nおにぎりなら問題ないですか？', 0, '2020-09-09 03:59:36'),
(29, 2, 'dorami', '写真投稿した画像どら焼きテスト', 1, '2020-09-09 07:41:47'),
(30, 2, 'dorami', 'いめーじです。', 1, '2020-09-09 07:31:52'),
(31, 2, 'dorami', 'どらやき', 1, '2020-09-09 07:40:43'),
(32, 2, 'dorami', '投稿自由自在でうれしいな。', 1, '2020-09-09 07:45:21'),
(33, 9, 'eri', '質問です！\r\n撮影小物として「どらやき」が流行っているみたいなんですが、持ち込み可能でしょうか？\r\n小物イメージ送付します。', 1, '2020-09-10 06:30:44'),
(51, 9, 'kiyo', '投稿テスト２', 1, '2020-09-12 04:36:35'),
(54, 11, 'umi', '私もたのしみです。\r\n宜しくです。', 1, '2020-09-13 09:15:21'),
(55, 11, 'ume', '楽しみにしてくれてうれしいです！', 1, '2020-09-13 09:16:22'),
(57, 5, 'nobita', 'のび太です。', 1, '2020-09-14 05:17:55'),
(68, 11, 'katoeri', '画像投稿調整テスト（画像なし）', 0, '2020-09-14 16:21:13'),
(69, 5, 'katoeri', 'のび太さん、\r\nよろしくです！', 1, '2020-09-14 16:22:34'),
(70, 5, 'ume', 'スタッフうめです。\r\n本日追加分請求書発行しましたので、ご確認よろしくお願い致します。', 0, '2020-09-15 04:50:49'),
(71, 10, 'azusa', '', 1, '2020-09-15 04:53:01'),
(72, 10, 'azusa', '期限切れがあるかないかを調べることはできるけれど、TOPページへの連動の仕方がわからない。こまた。', 0, '2020-09-16 02:13:36'),
(73, 10, 'azusa', '11時に困ってたことは、なんとか解決できた。\r\nやった！', 1, '2020-09-16 05:54:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `customers`
--

CREATE TABLE `customers` (
  `c_id` varchar(32) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `c_name` varchar(32) NOT NULL,
  `c_pass` varchar(64) NOT NULL,
  `c_mail` varchar(64) NOT NULL,
  `c_tell` varchar(11) NOT NULL,
  `c_zip` char(7) NOT NULL,
  `c_address` varchar(64) NOT NULL,
  `c_gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `customers`
--

INSERT INTO `customers` (`c_id`, `c_group_id`, `c_name`, `c_pass`, `c_mail`, `c_tell`, `c_zip`, `c_address`, `c_gender`) VALUES
('aka', 3, '赤川', '$2y$10$kgfwUD5Dr7KKq/3tC4RFJ.2Ne2CAuXQ9pohS7Q./CVbxUG/4USKJq', '', '0753332212', '', '', 0),
('ao', 3, '青山', '$2y$10$5F5i0F7yolKdbpj79XlLBOqMZFdx2D55/MJ2qmXMRDaGt48W5HhU2', '', '', '', '', 1),
('azusa', 10, '加藤あずさ', '$2y$10$lGs37BoEh8/VOT6Di1.Q3us9oFwIGwinPPjiCZ6opkmy4kVjW.bHe', '', '', '', '', 1),
('dora', 2, 'どらえもん', '$2y$10$nBcTwHrkRsEhLgLQyAQtZureHTY5QDtefvDxFbgz197Du2aRyrP8y', 'dora@dora', '090', '', '', 0),
('dorami', 2, 'どらみ', '$2y$10$O3hJ8/Dgj8OG3/f5Cxebl.Ia4DE1xOJYmYyfVLtn/C.sk.vYfI2r2', 'dorami@dorami.com', '0751234567', '', '', 1),
('eri', 9, 'えり', '$2y$10$pr4p7iMBOr2NVVDdlGWgUOK4.LMlErfWYHBK2wRoXl9fWBtY.Kq6K', 'eri@eri.net', '000', '6020802', '', 1),
('kawachi', 12, '河内', '$2y$10$HzKgT3pmk9bXRiIAHd66me0uSL2nS.48qkWKoMHuPCzF.asmszWI.', '', '', '', '', 0),
('kawada', 6, '川田', '$2y$10$XOjjeMNNDsa30.te/OKZxeJGflYMZFEl6Sry8mRBReeCYNcTZeygG', '', '', '', '', 1),
('kiyo', 9, 'きよ', '$2y$10$T7OiooR6OVtDcRs44u23Su7kf.tbjGX3KImRsXcts9cxl89KjCkOS', 'kiyo@gmail.com', '09036133955', '6020802', '京都府京都市上京区鶴山町', 0),
('moe', 4, 'もえ', '$2y$10$MVkZJoo1XwR2oCm.rsi7UePnnDXHjnMPI7rRULzgpYdhWE8Dd7KLW', '', '', '', '', 1),
('nobita', 5, '野比のび太', '$2y$10$4pDuuMz7DAMjrQh3lPgPXu6WYdspd644cfj3MkxAW8Vw0hXH5IH2K', 'nobi@nobita.net', '0903330000', '', '', 0),
('shizuka', 5, 'しずか', '$2y$10$59tSn92djWcIJp.QyTNHB.ARjp/MZpC2CSrERDpkz3a4dR3Q9sZi6', '', '', '', '', 1),
('sora', 11, 'そら', '$2y$10$MQYpU2QV3./mXeqp..Vmh.X5gMwoOZaPwGDrgfDc7t3npBkrnfPkW', '', '', '', '', 0),
('tanaka', 12, '田中千尋', '$2y$10$RfLaObIFCw44k7BRBmaSU.1rsHdXK403pha5KnqUZHaa2LCAKQf6G', '', '', '', '', 1),
('umi', 11, 'うみ', '$2y$10$vYQVjuLqpPjSAQNz2iGXWe8mZb8eq58ojGEuNRViDeZPYfjq./Y8S', '', '', '', '', 1),
('yama', 4, 'やましたうえ', '$2y$10$FExFb9tx2RQ6OtFEGKupseDj.sHSVwEeOfiu20AIzh4bszA.lzLH2', 'yama@yama', '075', '', '', 0),
('yamada', 6, '山田', '$2y$10$CacSIQB7sqNkPEtPXSU/4.JCv0w..QJOXJE75YnP/oKGAOS1VEtWi', '', '', '', '', 0),
('yusuke', 10, '加藤ユウスケ', '$2y$10$Rv95nvLPoAFat9glrf.Vde8bIisGSFvEbpC23JfY4HP0vE3tuYZEK', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `c_groups`
--

CREATE TABLE `c_groups` (
  `c_group_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `reserve_day` date NOT NULL,
  `reserve_time` time NOT NULL,
  `estimate` tinyint(1) NOT NULL,
  `invoce` tinyint(1) NOT NULL,
  `payment` tinyint(1) NOT NULL,
  `d_product` tinyint(1) NOT NULL,
  `new_zip` char(7) NOT NULL,
  `new_address` varchar(64) NOT NULL,
  `before2days` tinyint(1) NOT NULL DEFAULT 0,
  `make_reh` tinyint(1) NOT NULL DEFAULT 0,
  `cos_fixed` tinyint(1) NOT NULL DEFAULT 0,
  `cos_fitting` tinyint(1) NOT NULL DEFAULT 0,
  `place_fixed` tinyint(1) NOT NULL DEFAULT 0,
  `s_id` varchar(32) NOT NULL,
  `limit_over` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `c_groups`
--

INSERT INTO `c_groups` (`c_group_id`, `p_id`, `reserve_day`, `reserve_time`, `estimate`, `invoce`, `payment`, `d_product`, `new_zip`, `new_address`, `before2days`, `make_reh`, `cos_fixed`, `cos_fitting`, `place_fixed`, `s_id`, `limit_over`) VALUES
(1, 5, '2020-12-31', '12:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '', 0),
(2, 5, '2021-04-01', '11:00:00', 1, 1, 1, 0, '', '', 0, 0, 0, 0, 0, 'sawara', 0),
(3, 3, '2020-12-01', '09:30:00', 1, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'tome', 0),
(4, 4, '2020-08-01', '06:20:00', 1, 1, 1, 1, '1', '', 1, 1, 1, 1, 1, 'sawara', 0),
(5, 5, '2020-09-03', '14:30:00', 1, 1, 1, 0, '6038451', '京都府京都市北区衣笠鏡石町1－12', 0, 0, 0, 0, 0, 'ume', 0),
(6, 2, '2020-09-10', '10:22:00', 1, 1, 1, 0, '1', '', 0, 0, 0, 0, 0, 'ume', 0),
(7, 5, '2020-10-30', '12:00:00', 1, 1, 0, 0, '', '', 0, 0, 0, 0, 0, '', 0),
(8, 6, '2020-06-05', '07:00:00', 1, 1, 1, 1, '', '', 0, 0, 0, 0, 0, '', 0),
(9, 2, '2020-12-19', '05:00:00', 1, 0, 0, 0, '2223333', '夢の国', 1, 1, 1, 1, 1, '', 0),
(10, 6, '2020-09-30', '10:00:00', 1, 0, 0, 0, '', '', 0, 0, 1, 1, 0, 'sawara', 1),
(11, 4, '2020-11-11', '06:00:00', 1, 1, 0, 0, '1234567', 'Firenze Via della cernaia102', 0, 1, 1, 1, 1, 'katoeri', 0),
(12, 9, '2020-09-16', '11:30:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'katoeri', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `list`
--

CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `list_item` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `list`
--

INSERT INTO `list` (`list_id`, `c_group_id`, `list_item`) VALUES
(1, 9, '指輪'),
(2, 9, '足袋'),
(4, 9, 'サスペンダー'),
(5, 9, 'おにぎり'),
(6, 9, 'ネイルチップ'),
(7, 9, 'お金'),
(8, 2, 'どらやき'),
(12, 2, '今川焼'),
(15, 2, 'のびたくん'),
(17, 2, 'どらやき大'),
(18, 11, 'どらやき'),
(19, 11, 'おにぎり'),
(20, 5, 'どらやき大'),
(21, 5, 'おにぎり'),
(48, 10, '三色団子'),
(49, 10, 'どらやき大');

-- --------------------------------------------------------

--
-- テーブルの構造 `managements`
--

CREATE TABLE `managements` (
  `m_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `before2days` tinyint(1) NOT NULL,
  `make_reh` tinyint(1) NOT NULL,
  `cos_fixed` tinyint(1) NOT NULL,
  `cos_fiting` tinyint(1) NOT NULL,
  `place_fixed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `managements`
--

INSERT INTO `managements` (`m_id`, `c_group_id`, `before2days`, `make_reh`, `cos_fixed`, `cos_fiting`, `place_fixed`) VALUES
(1, 9, 0, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `plans`
--

CREATE TABLE `plans` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(32) NOT NULL,
  `p_wear` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `plans`
--

INSERT INTO `plans` (`p_id`, `p_name`, `p_wear`) VALUES
(1, 'STUDIO -和装-', 'kimono'),
(2, 'STUDIO -洋装-', 'dress'),
(3, '和装＆洋装撮影プラン　よくばり', 'both'),
(4, '和装＆洋装撮影プラン「TSUMUGI」', 'both'),
(5, '大覚寺撮影プラン', 'kimono'),
(6, '蹴上インクライン -INCLINE-', 'dress'),
(7, '東山 -HIGASHIYAMA-', 'kimono'),
(8, '祇園＋東山', 'kimono'),
(9, '祇園 -GION-', 'kimono'),
(10, '随心院', 'kimono');

-- --------------------------------------------------------

--
-- テーブルの構造 `staff`
--

CREATE TABLE `staff` (
  `s_id` varchar(32) NOT NULL,
  `s_name` varchar(32) NOT NULL,
  `s_pass` varchar(255) NOT NULL,
  `s_mail` varchar(64) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `staff`
--

INSERT INTO `staff` (`s_id`, `s_name`, `s_pass`, `s_mail`, `role`) VALUES
('katoeri', 'かとえり', '$2y$10$Pd6jx5o50gNPtcVpkFQqdu14NCcG7Bg9G6Ia4WtFQafntWUJ.LABm', 'katoeri@kato', 0),
('sawara', 'いわし', '$2y$10$RiwK.mbgsjA0frAHCPpbwObwluX2tlZOZHRgXWU/KHerqa3.XKt2q', 'iwasi@iwasi', 0),
('tome', 'おとめ', '$2y$10$4ML21xM81p4FkMnjquMInOPNi9audWr421yt05Guic5toxwB4TmLq', 'tometome@tome', 0),
('ume', 'うめ', '$2y$10$P1Rdd8dZ0qZv5pW8QdaLduVMXlEmvTiTVTzbWh6vy1byK2SNltdM.', 'ume@ume', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`b_id`);

--
-- テーブルのインデックス `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- テーブルのインデックス `c_groups`
--
ALTER TABLE `c_groups`
  ADD PRIMARY KEY (`c_group_id`);

--
-- テーブルのインデックス `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`);

--
-- テーブルのインデックス `managements`
--
ALTER TABLE `managements`
  ADD PRIMARY KEY (`m_id`);

--
-- テーブルのインデックス `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`p_id`);

--
-- テーブルのインデックス `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`s_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- テーブルのAUTO_INCREMENT `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- テーブルのAUTO_INCREMENT `managements`
--
ALTER TABLE `managements`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `plans`
--
ALTER TABLE `plans`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
