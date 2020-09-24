<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

?>

<?php require_once("header_for_staff.php"); ?>
		<main>
			<h1>スタッフ登録完了ページ</h1>
			<section>
				<p>新規スタッフ登録完了しました。<br>LOGINページより<br>ログインください。</p>
				<p><a href="staff_login.php">ログインページへ</a></p>
			</section>
		<footer>
		</footer>
	<script src="../jquery-3.5.1.min.js"></script>
	<script src=""></script>
	</body>
</html>
