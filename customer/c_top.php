<?php
session_start();
if(empty($_SESSION["c_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}


?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>お客様個人TOP</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<p><a href="c_group_top.php">お客様ページTOPへ</a></p>
				<p><a href="c_update.php">お客様情報確認・変更ページへ</a></p>
				<p><a href="c_group_info.php">お客様グループ情報確認ページTOPへ</a></p>

			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>
