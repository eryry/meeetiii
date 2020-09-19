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

//スタッフがスタッフログインして（お客様ログインなしで）お客様ページ見れるための準備。
if(!empty($_SESSION["s_id"])) $_SESSION["c_group_id"]=$_GET["group_id"];

//お客様は自身ログイン時にセッションに各種データ積み込まれるが、
//スタッフログインでは積み込まれないので、ページ最初に予約日積み込んでおく。
$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
$_SESSION["reserve_day"] =$resg["reserve_day"];

$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

$row = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);

//投稿があったら表示する
$rows = $obj->getBoardDataByGId($_SESSION["c_group_id"]);

//スタッフとしてログインしてきた場合の、GIDで顧客情報取得
$c_data=$obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);

?>


<?php 
	if(empty($_SESSION["s_id"])) {
		require_once("header_for_customer.php");
	}else{
		require_once("header_for_staff_inCpage.php");
	}
?>
	
		<main>
			<h1>掲示板</h1>
			<section>
				<p>ログイン中のお名前：
				<?php 
					if(!empty($_SESSION["c_name"])) {
						echo h($_SESSION["c_name"]);
					}else{
						echo "【スタッフ】".h($_SESSION["s_name"]);
					}; ?></p>
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($row["p_name"]);	?> </p>
				<p>お客様名： <?php echo h($c_data["g_name"])."様・".h($c_data["b_name"])."様";	?> </p>
			</section>
			<section class="second toukou">
				<p>新規投稿</p>
				
				<form action="exec_board_submit.php" method="post" enctype="multipart/form-data">
					<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
					<p><input type="hidden" name="submit_member_id" id="" value="<?php 
					if(!empty($_SESSION["c_id"])) {
						echo $_SESSION["c_id"];
					}else{
						echo $_SESSION["s_id"];
					}; ?>"></p>
					<p><textarea name="body" id=""></textarea></p>
				
					<p>画像<input class="b_photo" type="file" name="board_photo"></p>
					
					<p><input type="submit" value="投稿する"></p>
				</form>
				
			</section>
			<section class="second keijiban">
				<p>投稿一覧</p>
				
				<?php foreach($rows as $row): ?>
				<article class="keijiban_sub" id="keijibanban">
				<p>
					<span class="u_line font_mini">name:
					<?php 
					if($row["submit_member_id"]== $c_data["g_id"]){
						echo "【".h($c_data["g_name"])."】";
					}else if($row["submit_member_id"]== $c_data["b_id"]){
						echo "【新婦：".h($c_data["b_name"])."】";
					}else{
						//スタッフ情報取得
						$s_id=$row["submit_member_id"];
						$staff_data=$obj->getStaffById($s_id);
						echo "【スタッフ：".h($staff_data["s_name"])."】";
					};
					?></span>
					<span class="font_mini">post：<?php echo date("Y/m/d H:i",strtotime($row["created"])); ?></span><br>
					<?php echo nl2br(h($row["body"])); ?><br>
				</p>
				<?php if(intVal($row["board_photo"])==1): ?>
				<a href="../image/upload/board_photo/<?php echo h($row["b_id"]);?>.jpg" rel="lightbox"><img class="" src="../image/upload/board_photo/<?php echo h($row["b_id"]);?>.jpg" alt="投稿画像"></a>
				<div id=""></div>
				<?php endif; ?>
				</article>
				<?php endforeach; ?>
				
			</section>
		</main>
		
<?php 
	if(empty($_SESSION["s_id"])) {
		require_once("footer_for_customerpage.php");
	}else{
		require_once("footer_for_staff_inCpage.php");
	}
?>


