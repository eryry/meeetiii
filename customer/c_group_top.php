<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

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
//echo $day;

//日にち指定のメッセージ表示用
$all_msg=$obj->getMessage();
foreach($all_msg as $val){
if($day==$val["m_id"]){
 $msg=$obj->getMessageByMId($val["m_id"]);
 //echo $msg["m_body"];
}};

?>

<?php require_once("header_for_customer.php"); ?>
		<main>
			<div id="title_wrapper">
				<h1>ふたりのページ<br><span class="font_mini_no_padding">bride & groom page</span></h1>
			</div>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($c_data["p_name"]);	?> </p>
			</section>
			<section>
				<div class="c_photo_and_name_area">
					<div class="c_photo">
						<?php if($c_data["g_myphoto"]==1): ?>
						<img src="../image/upload/c_myphoto/<?php echo $c_data["g_id"];?>.jpg" alt="新郎画像">
						<?php elseif($c_data["g_myphoto"]==0): ?>
						<img src="../image/noimage.png">
						<?php endif; ?>
						<p><?php echo h($c_data["g_name"]); ?></p>
					</div>
					<div class="c_photo">
						<?php if($c_data["b_myphoto"]==1): ?>
						<img src="../image/upload/c_myphoto/<?php echo $c_data["b_id"];?>.jpg" alt="新婦画像">
						<?php elseif($c_data["b_myphoto"]==0): ?>
						<img src="../image/noimage.png">
						<?php endif; ?>
						<p><?php echo h($c_data["b_name"]); ?></p>
					</div>
				</div>
				<?php if(strtotime($today)<=strtotime($reserve_day)): ?>
				<p>撮影当日まであと <span class="font_big"><?php echo $day; ?></span>日</p>
				<?php endif; ?>
				<div class="messages">
					<?php if(strtotime($today)<strtotime($reserve_day)): ?>
					<p class="msg">
 						<?php foreach($all_msg as $val) {
	 						if($day==$val["m_id"]){
	 							$msg=$obj->getMessageByMId($val["m_id"]);
	 							echo nl2br($msg["m_body"]);
	 						}else{
	 							$msg["m_body"]="";
							}
						};
						?></p><br>
					<p class="msg_random"></p>
					<?php elseif(strtotime($today)>strtotime($reserve_day) && $_SESSION["d_product"]==0): ?>
					<p>撮影データまたはアルバムの商品出来上がりまで少しお待ちください！</p>
					<?php elseif(strtotime($today)==strtotime($reserve_day)): ?>
					<p>今日は撮影本番！ですね！！楽しみましょう♪</p>
					<?php endif; ?>
				</div>
			</section>
			<section>
				<img src="../image/icon-bird02.png" class="fuwafuwa"><img src="../image/icon-bird02.png" class="fuwafuwa_mini"><h2>お知らせ</h2><img src="../image/photoplan-title-icon02.png" class="fuwafuwa2">
				<div class="notice_wrapper">
				<table class="list_noborder c_g_top_notice">
					<tr>
						<th class="c_g_top_notice1"><p class="font_mini_no_padding">連絡note</p></th>
						<td class="c_g_top_notice2"><p class="font_mini_no_padding">最新投稿</p></td>
						<td class="c_g_top_notice3"><p>
						<?php if(!empty($b_data)): ?>
						<a href="c_board.php">日   時:
						<?php echo date("Y/m/d H:i",strtotime($b_data["created"])); ?> <br>
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
						;?></a></p>
						<?php elseif(empty($b_data)): ?>
						<p>投稿はまだありません。</p>
						<?php endif; ?></td>
					</tr>
					<tr class="bgc_gray_only">
						<th class="c_g_top_notice1"><p class="font_mini_no_padding">schedule</p></th>
						<td class="c_g_top_notice2"><p class="font_mini_no_padding">期限超過</p></td>
						<td class="c_g_top_notice3"><p class="font_mini_no_padding"><a href="c_schedule.php"><?php echo $limit_over_message; ?></a></p></td>
					</tr>
					<tr>
						<th class="c_g_top_notice1"><p class="font_mini_no_padding">見積書</p></th>
						<td class="c_g_top_notice2"><p class="font_mini_no_padding">投稿</p></td>
						<td class="c_g_top_notice3"><p class="font_mini_no_padding"><?php if($_SESSION["estimate"]==1) echo "<a href=\"c_paymentdata.php\">";?><?php echo $est_sub;?><?php if($_SESSION["estimate"]==1) echo "</a>";?></p></td>
					</tr>
					<tr class="bgc_gray_only">
						<th class="c_g_top_notice1"><p class="font_mini_no_padding">請求書</p></th>
						<td class="c_g_top_notice2"><p class="font_mini_no_padding">投稿</p></td>
						<td class="c_g_top_notice3"><p class="font_mini_no_padding"><?php if($_SESSION["invoce"]==1) echo "<a href=\"c_paymentdata.php\">";?><?php echo $inv_sub;?><?php if($_SESSION["estimate"]==1) echo "</a>";?></p></td>
					</tr>
				</table>
				</div>
				<br>
				<button class="update_btn"><a href="c_group_info.php">予約内容確認ページへ</a></button>
			</section>
		</main>
<?php include("footer_for_customerpage.php"); ?>
