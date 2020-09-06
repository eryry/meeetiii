<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

//撮影当日までの日数表示用
$today = date('y-m-d');
$day= $obj->dayDiff($today,$_SESSION["reserve_day"]);
$reserve_day = $_SESSION["reserve_day"];

//撮影予約日の表示（曜日も日本語で）
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

?>


<?php require_once("header_for_customer.php"); ?>
		
		<main>
			<h1>ふたりのページTOP</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				

				<p><a href="c_update.php">お客様情報確認・変更ページへ</a></p>
				
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<div>
					<img src="" alt="新郎画像">
					<p>新郎：<?php echo h($_SESSION["c_name"]); ?></p>
				</div>
				<div>
					<img src="" alt="新婦画像">
					<p>新婦：<?php echo h($_SESSION["c_name"]); ?></p>
				</div>
				<div>
					<p> *message area*</p>
				</div>
				<p>撮影当日まであと 【<?php echo $day; ?>】日</p>
				<p>撮影当日の京都の天気予報 【  】</p>
				
			</section>
			<section class="second">
				<h3>お知らせ</h3>
				
				<table class="list">
					<tr>
						<th>掲示板</th><th>未読投稿</th><td>あり・なし</td>
					</tr>
					<tr>
						<th>スケジュール</th><th>期限超過項目</th><td>あり・なし</td>
					</tr>
				</table>
				
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>
