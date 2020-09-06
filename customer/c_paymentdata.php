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
			<h1>見積書・請求書</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<div>
					<h2>見積書</h2>
					<p>見積書がスタッフから投稿されたら、表示されるエリア</p>
					<button><a href="" download>ダウンロード</a></button>
				</div>
				
				<div>
					<h2>請求書</h2>
					<p>請求書がスタッフから投稿されたら、表示されるエリア</p>
					<button><a href="" download>ダウンロード</a></button>
				</div>
				
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


