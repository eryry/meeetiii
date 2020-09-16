<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

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

//見積もり・請求書発行確認用
$c_data = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);
if($_SESSION["estimate"]==0) {$est_sub="なし";} else {$est_sub="あり";}
if($_SESSION["invoce"]==0)   {$inv_sub="なし";} else {$inv_sub="あり";}

$b_data = $obj->getBoardNewCreatedDate($_SESSION["c_group_id"]);

//schedule期限オーバー確認
if($_SESSION["limit_over"]==0){
	$limit_over_message="なし";
}else{
	$limit_over_message="あり";
}
echo $day;

$all_msg=$obj->getMessage();
foreach($all_msg as $val){
	if($day==$val){
			$msg=$obj->getMessageByMId(intVal($day));
			echo $msg["m_body"];
	}
}

?>

<?php require_once("header_for_customer.php"); ?>
		
		<main>
			<h1>ふたりのページTOP</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($c_data["p_name"]);	?> </p>
				
				<div class="c_photo_and_name_area">
					<div class="c_photo">
						<img src="../image/upload/c_myphoto/<?php echo $c_data["g_id"];?>.jpg" alt="新郎画像">
						<p><?php echo h($c_data["g_name"]); ?></p>
					</div>
					<div class="c_photo">
						<img src="../image/upload/c_myphoto/<?php echo $c_data["b_id"];?>.jpg" alt="新婦画像">
						<p><?php echo h($c_data["b_name"]); ?></p>
					</div>
				</div>
				
				<div>
					<p class="msg">
					<?php 
					foreach($all_msg as $val){
						if($day==$val){
							$msg=$obj->getMessageByMId(intVal($day));
							echo $msg["m_body"];
						}
					}
					;?>
					</p>
					<p class="msg_random"> *random message area*</p>
				</div>
				<?php if(strtotime($today)<=strtotime($reserve_day)): ?>
				<p>撮影当日まであと 【<?php echo $day; ?>】日</p>
				<p>撮影当日の京都の天気予報 【  】</p>
				<?php endif; ?>
			</section>
			<section class="second">
				<h3>お知らせ</h3>
				
				<table class="list_noborder row3">
					<tr>
						<th>掲示板</th><th>最新投稿</th><td><a href="c_board.php">日時:<?php echo date("Y/m/d H:i",strtotime($b_data["created"])); ?> 
						投稿者:<?php 
						if($b_data["submit_member_id"]== $c_data["g_id"]){
							echo h($c_data["g_name"]);
						}else if($b_data["submit_member_id"]== $c_data["b_id"]){
							echo h($c_data["b_name"]);
						}else{
							//最新投稿者名がスタッフだった場合用にスタッフ情報取得
							$s_id=$b_data["submit_member_id"];
							$staff_data=$obj->getStaffById($s_id);
							echo "スタッフ：".h($staff_data["s_name"]);
						}
						;?></a></td>
					</tr>
					<tr>
						<th>スケジュール</th><th>期限超過項目</th><td><a href="c_schedule.php"><?php echo $limit_over_message; ?></a></td>
					</tr>
					<tr>
						<th>見積書</th><th>投稿</th>
						<td><?php if($_SESSION["estimate"]==1) echo "<a href=\"c_paymentdata.php\">";?><?php echo $est_sub;?><?php if($_SESSION["estimate"]==1) echo "</a>";?></td>
					</tr>
					<tr>
						<th>請求書</th><th>投稿</th>
						<td><?php if($_SESSION["invoce"]==1) echo "<a href=\"c_paymentdata.php\">";?><?php echo $inv_sub;?><?php if($_SESSION["estimate"]==1) echo "</a>";?></td>
					</tr>
				</table>
				
				<button class="update_btn"><a href="c_group_info.php">予約内容確認ページへ</a></button>

			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>
