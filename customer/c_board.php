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

//投稿があったら表示する
$rows = $obj->getBoardDataByGId($_SESSION["c_group_id"]);

?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>掲示板</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
			</section>
			<section class="second">
				<p>投稿エリア</p>
				
				<form action="exec_board_submit.php" method="post"  enctype="multipart/form-data">
					<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
					<p><input type="hidden" name="submit_member_id" id="" value="<?php echo $_SESSION["c_id"]; ?>"></p>
					<p><textarea name="body" id=""></textarea></p>
					
					<!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
					
					<p>画像<input type="file" name="b_image" id=""></p>
					<p><input type="submit" value="投稿する"></p>
				</form>
				
			</section>
			<section class="second">
				<p>表示エリア</p>
				
				<?php foreach($rows as $row): ?>
				<article>
				<p>
					<span class="u_line">投稿者:<?php echo h($row["c_name"]);?></span>
					<span>投稿日時：<?php echo date("Y/m/d H:i",strtotime($row["created"])); ?></span><br>
					<?php echo nl2br(h($row["body"])); ?><br>
				</p>
				</article>
				<?php endforeach; ?>
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


