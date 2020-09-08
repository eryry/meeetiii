-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-09-09 02:02:41
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.5

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
  `b_image` mediumblob NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `unread` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `board`
--

INSERT INTO `board` (`b_id`, `c_group_id`, `submit_member_id`, `body`, `b_image`, `created`, `unread`) VALUES
(1, 2, 'dora', 'どらやきは、撮影小物になりますか？\r\n大切な思い出の品なんです。\r\n和装でどらやき食べさせあいっこしたいのです。', '', '2020-09-06 13:22:51', 0),
(2, 2, 'dora', 'ちなみに、特別サイズのおおきいどらやき持参予定です。', '', '2020-09-06 13:23:19', 0),
(3, 9, 'eri', '次回打合せに、9月7日11時に伺いたいのですが、予約可能でしょうか？', '', '2020-09-06 13:24:07', 0),
(4, 9, 'eri', 'あと、ドレス試着も打合せのあとにしたいので、予約取れそうならお願いしたいですー！', '', '2020-09-06 13:25:15', 0),
(5, 9, 'kiyo', '僕もタキシード再度みたいです！明日、急ですが、予約可能だったらうれしいです。\r\n無理なら来週月曜日も調べてほしいです。', '', '2020-09-06 13:28:11', 0),
(6, 2, 'dora', '', '', '2020-09-06 14:25:04', 0);

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
('dora', 2, 'どらえもん', '$2y$10$ryj6F2wbXA7HP35f6OcC.Oope6Daj3KhZ5NP0UpXwKfuMLqPk3ON6', 'dora@dora', '090', '', '', 0),
('dorami', 2, 'どらみ', '$2y$10$LEJZSnNH.y2vp1/WA0NcteMJV8PLFP2WOJDS5lEZYUhj4jRxzu4ru', '', '', '', '', 1),
('eri', 9, 'えり', '$2y$10$8sfu65jsmKMB0GaXv/KP4O4vzRXx5gy0O/UZD1EVrYNXsBp6WYdly', 'eri@eri.net', '000', '6020802', '', 1),
('kiyo', 9, 'きよ', '$2y$10$5xo1iqHCkJkYvFrNnLnTXujtStJI4cx2vRJcPMLVTCs78eM2DrXp.', 'kiyo@gmail.com', '09036133955', '6020802', '鶴山町1-12-001', 0),
('sora', 11, 'そら', '$2y$10$oM2vp9IWwUONZ.TvjO3pgOkr1qJ9u/T2ZVmZVn1Jj2/2Vj2h7wlua', '', '', '', '', 0),
('umi', 11, 'うみ', '$2y$10$E/MolE94kvQqJ0Otr53Gfu98BpPAjOhuDCZg21MYGjhtD797J0FSy', '', '', '', '', 1),
('yama', 4, 'やましたうえ', '$2y$10$FExFb9tx2RQ6OtFEGKupseDj.sHSVwEeOfiu20AIzh4bszA.lzLH2', 'yama@yama', '075', '', '', 0);

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
  `new_address` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `c_groups`
--

INSERT INTO `c_groups` (`c_group_id`, `p_id`, `reserve_day`, `reserve_time`, `estimate`, `invoce`, `payment`, `d_product`, `new_zip`, `new_address`) VALUES
(1, 5, '2020-12-31', '12:00:00', 0, 0, 0, 0, '', ''),
(2, 5, '2021-04-01', '11:00:00', 1, 1, 1, 0, '', ''),
(3, 3, '2020-12-01', '09:30:00', 1, 0, 0, 0, '', ''),
(7, 5, '2020-10-30', '12:00:00', 1, 1, 0, 0, '', ''),
(9, 2, '2020-12-19', '05:00:00', 0, 0, 0, 0, '6669999', '名'),
(10, 6, '2020-09-30', '10:00:00', 0, 0, 0, 0, '', ''),
(11, 4, '2020-11-11', '06:00:00', 0, 0, 0, 0, '', '');

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
(15, 2, 'のびたくん');

-- --------------------------------------------------------

--
-- テーブルの構造 `managements`
--

CREATE TABLE `managements` (
  `m_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `todo` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `s_id` varchar(32) NOT NULL,
  `todo_check` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '和装スタジオ撮影プラン', 'kimono'),
(2, '京都ロケーション撮影プラン', 'both'),
(3, '和装＆洋装撮影プラン　よくばり', 'both'),
(4, '和装＆洋装撮影プラン「TSUMUGI」', 'both'),
(5, '大覚寺撮影プラン', 'kimono'),
(6, 'インクライン撮影プラン', 'dress');

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
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルのAUTO_INCREMENT `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- テーブルのAUTO_INCREMENT `managements`
--
ALTER TABLE `managements`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `plans`
--
ALTER TABLE `plans`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
