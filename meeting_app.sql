-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-09-23 00:46:01
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
(73, 10, 'azusa', '11時に困ってたことは、なんとか解決できた。\r\nやった！', 1, '2020-09-16 05:54:13'),
(74, 4, 'katoeri', 'アルバム出来上がりました！', 0, '2020-09-17 05:41:52'),
(75, 4, 'katoeri', '新居もしくはお届け先の登録をお願いします！', 0, '2020-09-17 05:43:50'),
(76, 4, 'katoeri', '新居もしくはお届け先の登録をお願いします！', 0, '2020-09-17 05:44:03'),
(77, 4, 'katoeri', '新居もしくはお届け先の登録をお願いします！', 0, '2020-09-17 05:44:11'),
(78, 4, 'katoeri', 'すいません。投稿ミスして連投してしまいました。。。', 1, '2020-09-17 05:45:37'),
(79, 4, 'katoeri', '撮影', 0, '2020-09-17 05:51:30'),
(80, 4, 'katoeri', '作成', 0, '2020-09-17 05:53:45'),
(81, 4, 'katoeri', '作成', 0, '2020-09-17 05:54:23'),
(82, 4, 'katoeri', 'もうやだ', 0, '2020-09-17 05:55:17'),
(83, 4, 'katoeri', 'もうやだ', 0, '2020-09-17 05:55:46'),
(84, 4, 'katoeri', '再度', 0, '2020-09-17 05:55:53'),
(85, 5, 'nobita', '確認しました！\r\n振り込んだので、ご確認よろしくお願いします！', 0, '2020-09-17 05:57:09'),
(86, 6, 'katoeri', 'ささささささ', 0, '2020-09-19 10:45:04'),
(87, 10, 'azusa', '徹夜してしまったよ。\r\nねむいけど、CSS進んだね！', 0, '2020-09-20 04:53:25'),
(88, 10, 'ume', '投稿時のアイコン確認です', 0, '2020-09-20 05:23:26'),
(89, 3, 'ao', 'はじめての書き込みです。', 0, '2020-09-20 06:05:03'),
(90, 3, 'aka', 'はじめての書き込み２です。', 0, '2020-09-20 06:05:42'),
(91, 3, 'aka', '', 0, '2020-09-20 06:12:18'),
(92, 3, 'aka', '', 1, '2020-09-20 06:14:56'),
(93, 3, 'ao', '', 1, '2020-09-20 06:17:44'),
(94, 6, 'yamada', 'やまだです。', 0, '2020-09-20 06:23:45'),
(95, 5, 'nobita', '新婚旅行行ってきましたー！', 1, '2020-09-21 09:20:54'),
(96, 5, 'nobita', '縦写真のテストです。', 1, '2020-09-21 09:22:12'),
(97, 4, 'katoeri', 'うめは、トイプードルです。', 1, '2020-09-21 17:09:50'),
(98, 6, 'katoeri', '', 1, '2020-09-21 18:01:16'),
(99, 9, 'eri', 'サニタイズ追加したので、\r\n投稿テストです。', 1, '2020-09-22 09:23:50'),
(100, 9, 'eri', '', 1, '2020-09-22 10:16:04');

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
  `c_gender` tinyint(1) NOT NULL,
  `c_myphoto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `customers`
--

INSERT INTO `customers` (`c_id`, `c_group_id`, `c_name`, `c_pass`, `c_mail`, `c_tell`, `c_zip`, `c_address`, `c_gender`, `c_myphoto`) VALUES
('aka', 3, '赤川　岳', '$2y$10$McNZGmbgeKuwsob6rz.gaOvKJ7yog9Aa9h2RMw2N2BzDdY6kXqluu', 'akagawa@gaku.net', '0753332212', '', '', 0, 1),
('ao', 3, '青山　雪', '$2y$10$O8awrVWnV0dw7D7BrDzvMeMr5a7vNoXxOYt/G2byFAeebo0c6jOMy', '', '', '', '', 1, 1),
('azusa', 10, '加藤あずさ', '$2y$10$DpaD73diRKkzzrFk0MX27OlxBnMkqEP068eVmzS7cD2jqx7i1bwIa', '', '', '4540010', '愛知県名古屋市中川区山王2丁目春田4-2パビリオン303', 1, 1),
('dora', 2, 'どらえもん', '$2y$10$nBcTwHrkRsEhLgLQyAQtZureHTY5QDtefvDxFbgz197Du2aRyrP8y', 'dora@dora', '090', '', '', 0, 1),
('dorami', 2, 'どらみ', '$2y$10$O3hJ8/Dgj8OG3/f5Cxebl.Ia4DE1xOJYmYyfVLtn/C.sk.vYfI2r2', 'dorami@dorami.com', '0751234567', '', '', 1, 1),
('eri', 9, 'えり', '$2y$10$assTB6p8jr3ihxZrcosONOpYW8UVRNHUdNsYUvkrZz0SJn84E44/e', 'eri@eri.net', '000', '6020802', '', 1, 1),
('kawachi', 12, '河内', '$2y$10$LgUmwP767RwJytFCr/bC0esh5l8Kwd.PEsLxYmyWSE6AT5wsnF.Mu', '', '', '', '', 0, 1),
('kawada', 6, '川田', '$2y$10$XOjjeMNNDsa30.te/OKZxeJGflYMZFEl6Sry8mRBReeCYNcTZeygG', '', '', '', '', 1, 0),
('kiyo', 9, 'きよ', '$2y$10$T7OiooR6OVtDcRs44u23Su7kf.tbjGX3KImRsXcts9cxl89KjCkOS', 'kiyo@gmail.com', '09036133955', '6020802', '京都府京都市上京区鶴山町', 0, 1),
('moe', 4, 'もえ', '$2y$10$MVkZJoo1XwR2oCm.rsi7UePnnDXHjnMPI7rRULzgpYdhWE8Dd7KLW', '', '', '', '', 1, 1),
('nobita', 5, '野比のび太', '$2y$10$4pDuuMz7DAMjrQh3lPgPXu6WYdspd644cfj3MkxAW8Vw0hXH5IH2K', 'nobi@nobita.net', '0903330000', '', '', 0, 1),
('shizuka', 5, 'しずか', '$2y$10$59tSn92djWcIJp.QyTNHB.ARjp/MZpC2CSrERDpkz3a4dR3Q9sZi6', '', '', '', '', 1, 0),
('sora', 11, 'そら', '$2y$10$MQYpU2QV3./mXeqp..Vmh.X5gMwoOZaPwGDrgfDc7t3npBkrnfPkW', '', '', '', '', 0, 1),
('tanaka', 12, '田中千尋', '$2y$10$HF45EyTK2e6SpgoaYyPAR.kqUQj7MdHwoGzFsP7ZeXYkn0fSW6Sae', '', '09022223333', '', '', 1, 1),
('umi', 11, 'うみ', '$2y$10$vYQVjuLqpPjSAQNz2iGXWe8mZb8eq58ojGEuNRViDeZPYfjq./Y8S', '', '', '', '', 1, 1),
('yama', 4, 'やましたうえ', '$2y$10$FExFb9tx2RQ6OtFEGKupseDj.sHSVwEeOfiu20AIzh4bszA.lzLH2', 'yama@yama', '075', '', '', 0, 1),
('yamada', 6, '山田', '$2y$10$CacSIQB7sqNkPEtPXSU/4.JCv0w..QJOXJE75YnP/oKGAOS1VEtWi', '', '', '', '', 0, 0),
('yusuke', 10, '加藤ユウスケ', '$2y$10$Rv95nvLPoAFat9glrf.Vde8bIisGSFvEbpC23JfY4HP0vE3tuYZEK', '', '', '', '', 0, 1);

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
(0, 0, '0000-00-00', '10:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '担当スタッフを選択', 0),
(1, 5, '2020-12-31', '12:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '', 0),
(2, 5, '2021-04-01', '11:00:00', 1, 1, 1, 0, '', '', 0, 0, 0, 0, 0, 'sawara', 0),
(3, 3, '2020-12-01', '09:30:00', 1, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'tome', 0),
(4, 4, '2020-08-10', '06:20:00', 1, 1, 1, 1, '6020802', '京都府京都市上京区鶴山町1-12アビタシオン鴨川001号', 1, 1, 1, 1, 1, 'ume', 0),
(5, 5, '2020-09-22', '14:30:00', 1, 1, 1, 0, '6038451', '京都府京都市北区衣笠鏡石町1－12', 0, 0, 1, 1, 0, 'ume', 1),
(6, 2, '2020-09-10', '10:22:00', 1, 1, 1, 0, '1', '', 0, 0, 0, 0, 0, 'ume', 0),
(7, 5, '2020-10-30', '12:00:00', 1, 1, 0, 0, '', '', 0, 0, 0, 0, 0, '', 0),
(8, 6, '2020-06-05', '07:00:00', 1, 1, 1, 1, '', '', 0, 0, 0, 0, 0, '', 0),
(9, 2, '2020-12-19', '05:00:00', 1, 0, 0, 0, '2223333', '夢の国', 1, 1, 1, 1, 1, '', 0),
(10, 6, '2020-10-08', '10:00:00', 1, 1, 0, 0, '', '', 0, 0, 1, 1, 0, 'sawara', 1),
(11, 4, '2020-11-11', '06:00:00', 1, 1, 0, 0, '1234567', 'Firenze Via della cernaia102', 0, 1, 1, 1, 1, 'katoeri', 0),
(12, 9, '2020-09-21', '11:30:00', 1, 0, 1, 0, '5860000', '大阪府河内長野市', 1, 1, 1, 1, 1, 'katoeri', 1),
(21, 0, '2020-10-10', '10:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, '担当スタッフを選択', 0);

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
(49, 10, 'どらやき大'),
(50, 12, '一眼レフ'),
(51, 12, 'ミラーレスカメラ'),
(71, 12, 'ネイルチップ'),
(72, 12, 'どらやき'),
(73, 5, 'おにぎり'),
(74, 5, 'どらやき'),
(76, 3, 'おにぎり'),
(77, 10, 'おにぎり'),
(78, 3, '赤いもの'),
(79, 3, '青いもの'),
(80, 3, 'どらやき');

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
-- テーブルの構造 `messages`
--

CREATE TABLE `messages` (
  `m_id` int(11) NOT NULL,
  `m_body` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `messages`
--

INSERT INTO `messages` (`m_id`, `m_body`) VALUES
(1, 'いよいよ明日撮影本番ですね。忘れ物のないよう、お気をつけてお越しください！'),
(2, '撮影2日前です。ロケ撮影のお客様は撮影判断お願いします！'),
(3, '撮影3日前ですね。明日2日前はロケ撮影の決行判断日なので今日から天気予報見て準備しておきましょう！'),
(7, '撮影1週間前ですね。撮影当日のためにそろそろ体調管理して体調万全で当日迎えられるようにしますよう！'),
(14, '2週間前だよ'),
(20, 'もう一回'),
(30, '1か月前だよ'),
(90, ' 3か月も前からのご予約、誠にありがとうございます！早めに準備ばっちりして、ふたりらしいWeddingPhotoを残しましょう♪');

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
(10, '随心院', 'kimono'),
(11, '毘沙門堂', 'kimono');

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
('horie', '堀江', '$2y$10$9kwF3F.ZgPqzxoEsEW3fsOA9ik0L4/qUUlQv68PwNLxYX7AflhRW2', '', 0),
('iwasi', 'いわし', '$2y$10$0Lf7fXghh.PM5DUPOyhQmeGP8oIBVRzbpBUQ3YQSCle8enwXc9AlC', 'iwasi@au.net', 0),
('katoeri', 'かとえり', '$2y$10$Pd6jx5o50gNPtcVpkFQqdu14NCcG7Bg9G6Ia4WtFQafntWUJ.LABm', 'katoeri@kato', 1),
('mori', '森', '$2y$10$YcjcX3CDKor5HhIqtnHyiuUFblE3rnA76F8Bs7o/dgBgCJNOSw89C', '', 0),
('sawara', 'さわら', '$2y$10$0daO02tcSoogkdXf4j9KsOwd5TW4Y4j1UoKiCOf9MtAhRw/k49eDu', '', 1),
('suzuki', '鈴木', '$2y$10$eQb9CkEGzI2uSl0T7z/.luqppNiPolTyYHr/pGxlzk/fzhbjMnLh.', '', 0),
('tome', 'とめ', '$2y$10$K1s4FDg9uzt1bZaNC3QoDe3B8A2Jdp2MOFSDT8E5luq/uF78SglsC', 'tometome@tome', 0),
('ume', 'うめ', '$2y$10$P1Rdd8dZ0qZv5pW8QdaLduVMXlEmvTiTVTzbWh6vy1byK2SNltdM.', 'ume@ume', 1),
('yasuda', '安田', '$2y$10$GyLLobtty.dYyXDuN.4ZNu/rZj89X2OoeyOBdmZEN4B9HJZBdYQHu', '', 0);

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
-- テーブルのインデックス `messages`
--
ALTER TABLE `messages`
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
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- テーブルのAUTO_INCREMENT `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- テーブルのAUTO_INCREMENT `managements`
--
ALTER TABLE `managements`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `plans`
--
ALTER TABLE `plans`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
