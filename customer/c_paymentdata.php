<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

//スタッフがスタッフログインして（お客様ログインなしで）お客様ページ見れるための準備。
if(!empty($_SESSION["s_id"])) $_SESSION["c_group_id"]=$_GET["group_id"];

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
$_SESSION["reserve_day"] =$resg["reserve_day"];

$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

$c_data = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);

//ログイン中に情報更新があった場合の為に、SESSIONに再代入
$_SESSION["estimate"]=$c_data["estimate"];
$_SESSION["invoce"]=$c_data["invoce"];
?>

<?php 
	if(empty($_SESSION["s_id"])) {
		require_once("header_for_customer.php");
	}else{
		require_once("header_for_staff_inCpage.php");
	}
?>
		<main>
			<h1>見積書・請求書</h1>
			<section>
				<p>ログイン中のお名前：
				<?php 
					if(!empty($_SESSION["c_name"])) {
						echo h($_SESSION["c_name"]);
					}else{
						echo "【スタッフ】".h($_SESSION["s_name"]);
					}; 
				?>
				</p>
				
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($c_data["p_name"]);	?> </p>
				
				<div class="toukou">
					<h2>見積書</h2>
					
					<?php if(!empty($_SESSION["s_id"])): ?>
					<form action="exec_sub_estimate.php" method="post" enctype="multipart/form-data" class="sub_file">
					<input type="file" name="estimate">
					<input type="hidden" name="c_group_id" value="<?php echo intVal($_SESSION["c_group_id"]); ?>">
					<input type="submit" value="見積もり投稿">
					</form>
					<?php endif; ?>
					
					<?php if($c_data["estimate"]==1): ?>
					<p>見積書発行：あり
					<button class="pay_btn"><a href="exec_estimate_dl.php">見積書を表示</a></button></p>
					<?php else: ?>
					<p>見積書発行：未</p>
					<?php endif; ?>
				</div>
				
				<div class="toukou">
					<h2>請求書</h2>
					<?php if(!empty($_SESSION["s_id"])): ?>
					<form action="exec_sub_invoce.php" method="post" enctype="multipart/form-data" class="sub_file">
					<input type="file" name="invoce">
					<input type="hidden" name="c_group_id" value="<?php echo intVal($_SESSION["c_group_id"]); ?>">
					<input type="submit" value="請求書投稿">
					</form>
					<?php endif; ?>
					<?php if($c_data["invoce"]==1): ?>
					<p>請求書発行：あり
					<button class="pay_btn"><a href="exec_invoce_dl.php">請求書を表示</a></button></p>
					<?php else: ?>
					<p>請求書発行：未</p>
					<?php endif ?>
				</div>
				
				
			</section>
		</main>
<?php 
	if(empty($_SESSION["s_id"])) {
		require_once("footer_for_customerpage.php");
	}else{
		require_once("footer_for_staff_inCpage.php");
	}
?>

