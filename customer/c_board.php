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
			<div id="title_wrapper">
				<h1>連絡ノート<br><span class="font_mini_no_padding">note</span></h1>
			</div>
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
			<section>
				<img src="../image/photoplan-icon01.png" class="fuwafuwa4"><br>
				<h2>新規書き込み</h2>
				<div class="toukou">
					<form action="exec_board_submit.php" method="post" enctype="multipart/form-data">
						<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
						<p><input type="hidden" name="submit_member_id" id="" value="<?php 
							if(!empty($_SESSION["c_id"])) {
								echo $_SESSION["c_id"];
							}else{
								echo $_SESSION["s_id"];
							}; ?>"></p>
						<p><textarea name="body" id=""></textarea></p>
						<p>画像<input class="b_photo" type="file" name="board_photo" accept="image/jpeg, image/png" /></p>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
						<p><input type="submit" value="書き込む"></p>
					</form>
				</div>
			</section>
			<section>
				<h2>連絡ノート</h2>
				<p><?php if(empty($rows)) echo "連絡ノートへの投稿は、まだありません。"; ?></p>
				<?php foreach($rows as $row): ?>
				<div class="keijiban_sub" id="keijibanban">
					<div class="b_sub_data_area">
						<?php if($row["submit_member_id"]== $c_data["g_id"] && $c_data["g_myphoto"]==1): ?>
						<img src="../image/upload/c_myphoto/<?php echo $c_data["g_id"];?>.jpg" alt="新郎画像" id="c_photo_border">
						<?php elseif($row["submit_member_id"]== $c_data["g_id"] && $c_data["g_myphoto"]==0): ?>
						<img src="../image/noimage.png">
						<?php elseif($row["submit_member_id"]== $c_data["b_id"] && $c_data["b_myphoto"]==1): ?>
						<img src="../image/upload/c_myphoto/<?php echo $c_data["b_id"];?>.jpg" alt="新婦画像" id="c_photo_border">
						<?php elseif($row["submit_member_id"]== $c_data["b_id"] && $c_data["b_myphoto"]==0): ?>
						<img src="../image/noimage.png">
						<?php else:?>
						<img src="../image/staff_image.png">
						<?php endif; ?>
						<div>
							<p><span class="font_mini3">post:
							<?php 
								if($row["submit_member_id"]== $c_data["g_id"]){
									echo h($c_data["g_name"]);
								}else if($row["submit_member_id"]== $c_data["b_id"]){
									echo h($c_data["b_name"]);
								}else{
									//スタッフ情報取得
									$s_id=$row["submit_member_id"];
									$staff_data=$obj->getStaffById($s_id);
									echo "staff-".h($staff_data["s_name"]);
								};
							?> / <?php echo date("Y/m/d H:i",strtotime($row["created"])); ?></span></p>
						</div>
					</div>
					<p class="font_mini_no_padding"><?php echo nl2br(h($row["body"])); ?></p>
				<?php if(intVal($row["board_photo"])==1): ?>
				<a href="../image/upload/board_photo/<?php echo h($row["b_id"]);?>.jpg" rel="lightbox"><img class="" src="../image/upload/board_photo/<?php echo h($row["b_id"]);?>.jpg" alt="投稿画像"></a>
				<div id=""></div>
				<?php endif; ?>
				</div>
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
