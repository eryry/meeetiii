<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

?>
<?php require_once("header_for_staff.php"); ?>
		<main>
			<h1>新規顧客登録完了ページ</h1>
			<section>
				<p>新規顧客登録完了しました。</p>
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>
