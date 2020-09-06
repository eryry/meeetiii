<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}


?>


<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>スタッフ用TOP</h1>
			<section>
			<p>ログイン中のスタッフ名<?php echo h($_SESSION["s_name"]);?></p>
			
			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>

