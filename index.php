<?php
session_start();

if(!empty($_SESSION["err_msg_cid"])){
	$err_msg_cid=$_SESSION["err_msg_cid"];
}else{
	$err_msg_cid="";
}
if(!empty($_SESSION["err_msg_cpass"])){
	$err_msg_cpass=$_SESSION["err_msg_cpass"];
}else{
	$err_msg_cpass="";
}
unset($_SESSION["err_msg_cid"]);
unset($_SESSION["err_msg_cpass"]);

$_SESSION=[];
setcookie ("session_name","",time()-1800);
session_destroy();

$c_pass = password_hash('kiyo',PASSWORD_DEFAULT);
//echo $c_pass;

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("class/meeting.class.php");
$obj= new Meeting();

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>meeting app | customer LOGIN</title>
		<meta name="viewport" content="width=device-width">
		<!-- reset css  -->
		<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
		<link rel="stylesheet" href="css/style.css">
		<!-- fontAwsome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css" />
		<!-- material icon google-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- google web font -->
		<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=M+PLUS+1p:wght@300&family=Noto+Serif+JP:wght@300&display=swap" rel="stylesheet">
		<!-- favicon -->
		<link rel="icon" href="/favicon.ico" />
		<script src="js/jquery-3.5.1.min.js"></script>
	</head>
	<body>
		<header class="index">
			<div>
			<img class="header_img" src="image/photoplan-title-icon02.png" alt="ヘッダー用デザイン"><img class="logo" src="image/meeetiii2.png"><img class="header_img"src="image/photoplan-icon01.png" alt="ヘッダー用デザイン">
			</div>
		</header>
		<main class="top_main">
			<section class="top_section">
			<p><img src="image/staff_image.png" class="hunwari"></p>
			<h1  class="login_title">ログイン</h1>
				<form action="customer/exec_customer_login.php" method="post">
					<table class="login_table">
						<tr>
							<th><p><label for="c_id">顧客ID</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="c_id" id="c_id" pattern="^[0-9A-Za-z]+$">
							<span class="red"><?php echo $err_msg_cid; ?></span></td>
						</tr>
						<tr>
							<th><p><label for="c_pass">パスワード</label><span class="required_color">必須</span></p></th>
							<td><input type="password" autocomplete="current-password" name="c_pass" id="c_pass" pattern="^[0-9A-Za-z]+$">
							<span class="red"><?php echo $err_msg_cpass; ?></span></td>
							</td>
						</tr>
					</table>
					<p><input class="sub_btn" type="submit" value="LOGIN"></p>
				</form>
			</section>
			<section class="top_section_bottom">
				<button><a href="staff/staff_login.php">管理者用ページ</a></button>
			</section>
		</main>
		<script src=""></script>
	</body>
</html>
