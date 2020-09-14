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

$row = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);


?>

<?php require_once("header_for_customer.php"); ?>
		
		<main>
			<h1>ふたりのページTOP</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($row["p_name"]);	?> </p>
				
				<div class="c_photo_and_name_area">
					<div class="c_photo">
						<img src="../image/upload/c_myphoto/<?php echo $row["g_id"];?>.jpg" alt="新郎画像">
						<p><?php echo h($row["g_name"]); ?></p>
					</div>
					<div class="c_photo">
						<img src="../image/upload/c_myphoto/<?php echo $row["b_id"];?>.jpg" alt="新婦画像">
						<p><?php echo h($row["b_name"]); ?></p>
					</div>
				</div>
				
				<div>
					<p> *message area*</p>
				</div>
				<?php if($today>$reserve_day): ?>
				<p>撮影当日まであと 【<?php echo $day; ?>】日</p>
				<p>撮影当日の京都の天気予報 【  】</p>
				<?php endif; ?>
			</section>
			<section class="second">
				<h3>お知らせ</h3>
				
				<table class="list_noborder row3">
					<tr>
						<th>掲示板</th><th>未読投稿</th><td>あり・なし</td>
					</tr>
					<tr>
						<th>スケジュール</th><th>期限超過項目</th><td>あり・なし</td>
					</tr>
				</table>
				
				<button class="update_btn"><a href="c_group_info.php">予約内容確認ページへ</a></button>

			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>
