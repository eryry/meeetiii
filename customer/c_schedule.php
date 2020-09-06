<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$obj= new Meeting();


?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>schedule</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				

				

				
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


