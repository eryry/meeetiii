-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: mysql7014.xserver.jp
-- Generation Time: 2020 年 11 月 12 日 14:49
-- サーバのバージョン： 5.7.27
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ponicomori_meeetiii`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `b_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `submit_member_id` varchar(32) NOT NULL,
  `body` text NOT NULL,
  `board_photo` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `board`
--

INSERT INTO `board` (`b_id`, `c_group_id`, `submit_member_id`, `body`, `board_photo`, `created`) VALUES
(1, 1, 'guest111', 'はじめての投稿です。\r\n花嫁（ゲストログイン）です。\r\nよろしくお願いいたします。', 0, '2020-11-11 09:48:54'),
(2, 1, 'guest111', '', 1, '2020-11-11 10:11:40'),
(3, 1, 'guest111', '犬と一緒に撮影希望しています。\r\nこのような写真を撮ることはできますか？\r\n\r\nかなりおとなしい犬（トイプードル）です。', 1, '2020-11-11 10:12:27'),
(4, 1, 'staff111', 'こんにちは。\r\nご相談、ありがとうございます。\r\n\r\nおとなしいワンちゃんであれば、撮影一緒にできますのでご安心ください。\r\n\r\nかわいいわんちゃんですね！', 0, '2020-11-11 10:15:21'),
(5, 1, 'guest111', 'こんばんは。\r\nInstagramでこの写真を見たのですが、次回試着の時に見せていただくことはできますか？\r\nまた、現在予約しているものからこちらに変更した場合、追加料金はかかりますか？', 1, '2020-11-11 12:18:33'),
(6, 1, 'guest111', 'ヘアスタイルの希望も決まったので、イメージ送ります！', 1, '2020-11-11 12:20:51'),
(7, 5, 'kimurakiyoshi', '木村です。\r\n先日は詳しいご案内ありがとうございました。\r\n\r\n質問なのですが、私の祖母が撮影を見に来たいと言っています。\r\n問題ないでしょうか？', 0, '2020-11-11 12:41:31'),
(8, 3, 'mari', '見積り、確認しました。\r\n明日振り込み予定です。\r\nよろしくお願いいたしますー！', 0, '2020-11-11 12:50:43'),
(9, 3, 'mari', '着物用肌着・足袋、今のところ自分で用意する予定ですが、\r\nもし用意難しかった場合、撮影当日に追加購入できますか？', 0, '2020-11-11 12:51:19'),
(10, 4, 'makoto', '写真データ、1か月後と聞いてますが、早めに頂けると嬉しいです。\r\nプロフィール動画の使用写真提出期限が思ったより早かったので。。。', 0, '2020-11-11 12:54:02'),
(11, 10, 'tanakatomoko', 'お世話になっております。\r\n今度の日曜日の打合せですが、新郎が行けなくなったので、私と私の母とふたりでお伺いさせていただきます。\r\n母がその時にいろいろ質問してしまうかもしれません。。。\r\nご迷惑おかけしますが、その際は対応よろしくおねがいします。', 0, '2020-11-11 13:12:27'),
(12, 9, 'hayashisachiko', '', 1, '2020-11-11 13:17:42'),
(13, 9, 'hayashisachiko', 'このアルバム、プランからの追加料金が見積りに入ってなかったようです。\r\n\r\n確認お願いします。', 0, '2020-11-11 13:18:16'),
(14, 8, 'itoukyouko', '先日は、お世話になりました。\r\n引っ越し完了し、新居は決まったので、先ほど新居登録しました。\r\n今後の郵送物は、こちらの住所あてにお願いします。', 0, '2020-11-11 13:23:10'),
(15, 7, 'sasakawamika', 'こんにちは。はじめての書き込みなので、試しに書き込んでみました。\r\nお返事特にいそぎません。\r\nお時間のあるときに、書き込み確認できた連絡してくれたらうれしいです(^^)', 0, '2020-11-11 13:29:09'),
(16, 7, 'sasakawamika', '', 1, '2020-11-11 13:29:25'),
(18, 6, 'miyagimika', '先日試着した打掛、こちらの画像の方で決定希望です。\r\nご連絡遅くなりすいません。\r\nよろしくお願いします。', 1, '2020-11-11 13:48:16');

-- --------------------------------------------------------

--
-- テーブルの構造 `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `c_id` varchar(32) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `c_name` varchar(32) NOT NULL,
  `c_pass` varchar(64) NOT NULL,
  `c_mail` varchar(64) NOT NULL,
  `c_tell` varchar(11) NOT NULL,
  `c_zip` char(7) NOT NULL,
  `c_address` varchar(64) NOT NULL,
  `c_gender` tinyint(1) NOT NULL,
  `c_myphoto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `customers`
--

INSERT INTO `customers` (`c_id`, `c_group_id`, `c_name`, `c_pass`, `c_mail`, `c_tell`, `c_zip`, `c_address`, `c_gender`, `c_myphoto`) VALUES
('azusa', 2, '加藤あずさ', '$2y$10$CeJNbE8qjqxou/7gQxU/geJDM25d2BwqMNuAospFmUL69yocg7W2e', '', '09098765432', '', '', 1, 0),
('guest111', 1, 'ゲストログイン花嫁', '$2y$10$J2rWcpUX0XqG75iovwdBue/ornHwTefGA56X2YyIzQEIMOeZgW47u', '', '', '', '', 1, 1),
('guest222', 1, 'ゲスト新郎', '$2y$10$YOTm2S4zVVzm6GXbbmnjgOr3duLf6uu7ZyLojy.8Sik8wB0geWXJi', '', '09012345678', '6060001', '京都府京都市左京区岩倉大鷺町１－１２', 0, 1),
('haruki', 3, '吉田春樹', '$2y$10$u1DAeCNoASMxnAg6C7CZgeZ/6LYIQFh5VzZeOFcjofj8GWNnmvyhK', '', '', '6020803', '京都府京都市上京区阿弥陀寺前町100', 0, 1),
('hayashisachiko', 9, '林幸子', '$2y$10$xrWGawmkuERFk9XRMJMW6.EtMHt6lIZsTsBwjwWE4M8NNkpf3PeDW', '', '07077770000', '', '', 1, 1),
('hondamayu', 5, '本田まゆ', '$2y$10$WKpp1TfWx2uwFdFjS9B84uszjvNyMLDgTezvWnB6tkyjupRys0Tbu', '', '', '', '', 1, 0),
('itoukyouko', 8, '伊藤今日子', '$2y$10$Ud8EXv8aiu0sidDNsQJ02O2gQYMMaRJh6e0RJydc1SgB7WNnOY4Ge', '', '', '', '', 1, 1),
('kawanokouji', 9, '川野浩二', '$2y$10$QrOotPZ5H8WD/BXG9yvhwesme4SYSf9uaGXOpcXm4bhmtGXHF7sC2', '', '08088886666', '', '', 0, 1),
('kimurakiyoshi', 5, '木村清', '$2y$10$JCL7OSWG37c3E3PEV8EzWu4R358yU9EvetAgI5OUlCYxPKEPZSoUa', '', '', '', '', 0, 1),
('maedatomokazu', 7, '前田友和', '$2y$10$R1d1ak.mESlSiw3mO.hGYOEqwY9HCqVKZO2StNqkulLN3B1386.uS', '', '', '', '', 0, 0),
('makoto', 4, '品川誠', '$2y$10$xQrl5J5sZy0uYhqIrGOGlOhZ51UuTQ9fELfm5saNQPYOMj/fM8v16', '', '09020202020', '', '', 0, 1),
('mari', 3, '今井真理', '$2y$10$3f/Qxjj40UhX0KnUkiXiguvNNkxDjhNzhe3Hdpism0HCFYo650Zj.', '', '', '', '', 1, 1),
('michiko', 4, '町田美智子', '$2y$10$XKJl76C3cEseWwJ6JOBTfeAK/0AjdHgnA2L30zfaSd4vIsh97q8oC', 'm.michiko@meeetiii.com', '09099998888', '3330802', '埼玉県川口市戸塚東2-2-101', 1, 1),
('miyagimika', 6, '宮城美香', '$2y$10$jlgx.dMkMxrhrprQCAFeleWdzfWcwGayq6wvbLgfCc6BsFIQdSq1m', '', '', '', '', 1, 1),
('sasakawamika', 7, '笹川みか', '$2y$10$gF8dsm2gHH/6MEInKdTRpON46mPxVv1T.a5NSLwF3sR2MRPCd9Rye', '', '', '', '', 1, 1),
('soumaichirou', 8, '相馬一郎', '$2y$10$BjVVzQXrLtSuWKm.WI7aHOVrDuMrRumHTox0Yb4M.hR72geRLVG5y', '', '', '', '', 0, 1),
('tanakatomoko', 10, '田中智子', '$2y$10$dcY1nMTPiDXwxZJzltn6Auz3wYuZsXBwrqC64L5FbEM42X.FhrK2a', '', '', '', '', 1, 1),
('tokudajirou', 10, '徳田次郎', '$2y$10$UkoLdhUjnvKGxjqls89uve9troGCnzZrpcDsMqMfOi6ix/eqCpbSW', '', '', '', '', 0, 1),
('yoichimamoru', 6, '余市護', '$2y$10$yCI9HGNC74SzJMTXEpiBjexLZrZUm7NGMv8bCcZflI1kKDcOm6FdO', '', '', '', '', 0, 1),
('yusuke', 2, '加藤ゆうすけ', '$2y$10$hppeJn4ZP88/My0n0Yf54udsus.WJRGQZQm4P50VwbnVupW17.fae', '', '09022223333', '', '', 0, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `c_groups`
--

CREATE TABLE IF NOT EXISTS `c_groups` (
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
  `before2days` tinyint(1) NOT NULL DEFAULT '0',
  `make_reh` tinyint(1) NOT NULL DEFAULT '0',
  `cos_fixed` tinyint(1) NOT NULL DEFAULT '0',
  `cos_fitting` tinyint(1) NOT NULL DEFAULT '0',
  `place_fixed` tinyint(1) NOT NULL DEFAULT '0',
  `s_id` varchar(32) NOT NULL,
  `limit_over` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `c_groups`
--

INSERT INTO `c_groups` (`c_group_id`, `p_id`, `reserve_day`, `reserve_time`, `estimate`, `invoce`, `payment`, `d_product`, `new_zip`, `new_address`, `before2days`, `make_reh`, `cos_fixed`, `cos_fitting`, `place_fixed`, `s_id`, `limit_over`) VALUES
(1, 4, '2020-12-01', '10:00:00', 1, 1, 0, 0, '', '', 0, 1, 1, 1, 0, 'staff111', 1),
(2, 5, '2020-12-02', '12:00:00', 1, 0, 0, 0, '', '', 0, 0, 0, 1, 1, 'staff111', 1),
(3, 9, '2020-12-03', '05:30:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'staff111', 0),
(4, 1, '2020-11-07', '11:15:00', 1, 1, 1, 0, '', '', 1, 1, 1, 1, 1, 'staff111', 1),
(5, 5, '2021-01-15', '09:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'katoeri', 1),
(6, 8, '2020-12-12', '10:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'staff111', 0),
(7, 11, '2021-03-01', '10:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 1, 0, 'katoeri', 1),
(8, 2, '2020-11-01', '10:00:00', 0, 0, 0, 0, '4550001', '愛知県名古屋市港区七番町２３－１２－１', 0, 0, 0, 0, 0, 'staff111', 0),
(9, 4, '2020-12-19', '10:00:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'staff111', 0),
(10, 6, '2020-12-11', '08:15:00', 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'katoeri', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `list_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `list_item` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `list`
--

INSERT INTO `list` (`list_id`, `c_group_id`, `list_item`) VALUES
(1, 1, 'ネイルチップ'),
(2, 1, 'フォトプロップス'),
(3, 1, 'つけまつげ'),
(4, 1, '婚約指輪'),
(5, 2, '犬の服'),
(6, 5, 'ビデオカメラ'),
(7, 3, '額縁'),
(8, 3, 'めがね3本'),
(9, 4, '習字'),
(10, 9, '番傘'),
(11, 9, '扇子'),
(12, 9, '花冠'),
(13, 9, 'パールのネックレス'),
(14, 6, '二眼レフカメラ'),
(15, 6, 'ポラロイドカメラ'),
(16, 6, 'ゴープロ'),
(17, 6, 'チェキ');

-- --------------------------------------------------------

--
-- テーブルの構造 `managements`
--

CREATE TABLE IF NOT EXISTS `managements` (
  `m_id` int(11) NOT NULL,
  `c_group_id` int(11) NOT NULL,
  `before2days` tinyint(1) NOT NULL,
  `make_reh` tinyint(1) NOT NULL,
  `cos_fixed` tinyint(1) NOT NULL,
  `cos_fiting` tinyint(1) NOT NULL,
  `place_fixed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `m_id` int(11) NOT NULL,
  `m_body` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `messages`
--

INSERT INTO `messages` (`m_id`, `m_body`) VALUES
(1, 'いよいよ明日撮影本番ですね。\r\n忘れ物のないよう、お気をつけてお越しください！'),
(2, '撮影2日前です。 \r\nロケ撮影のお客様は撮影判断お願いします！'),
(3, '撮影3日前ですね。\r\n明日2日前はロケ撮影の決行判断日なので今日から天気予報見て準備しておきましょう！'),
(7, '撮影1週間前ですね。\r\n撮影当日のためにそろそろ体調管理して体調万全で当日迎えられるようにしますよう！'),
(14, '2週間前ですね。\r\n 当日の持ち物の準備はいかがでしょうか？ \r\nもし不足物があれば、そろそろ準備しましょう♪'),
(20, 'もう一回'),
(30, '1か月前だよ'),
(90, '3か月も前からのご予約、誠にありがとうございます！\r\n早めに準備ばっちりして、ふたりらしいWeddingPhotoを残しましょう');

-- --------------------------------------------------------

--
-- テーブルの構造 `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(32) NOT NULL,
  `p_wear` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE IF NOT EXISTS `staff` (
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
('katoeri', 'かとえり', '$2y$10$Pd6jx5o50gNPtcVpkFQqdu14NCcG7Bg9G6Ia4WtFQafntWUJ.LABm', 'eryry1030@gmail.com', 1),
('staff111', 'gスタッフ', '$2y$10$o7sAxXghnNSvc4LQb689n.TWLhGzDGS9g.wsfXUhYpfu8hTxquD/a', '', 1),
('suzuki', '鈴木', '$2y$10$eQb9CkEGzI2uSl0T7z/.luqppNiPolTyYHr/pGxlzk/fzhbjMnLh.', '', 0),
('yasuda', '安田', '$2y$10$GyLLobtty.dYyXDuN.4ZNu/rZj89X2OoeyOBdmZEN4B9HJZBdYQHu', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `c_groups`
--
ALTER TABLE `c_groups`
  ADD PRIMARY KEY (`c_group_id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `managements`
--
ALTER TABLE `managements`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `managements`
--
ALTER TABLE `managements`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
