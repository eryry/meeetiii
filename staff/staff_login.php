<?php
session_start();

if(!empty($_SESSION["err_msg_s_id"])){
	$err_msg_s_id=$_SESSION["err_msg_s_id"];
}else{
	$err_msg_s_id="";
}
if(!empty($_SESSION["err_msg_s_pass"])){
	$err_msg_s_pass=$_SESSION["err_msg_s_pass"];
}else{
	$err_msg_s_pass="";
}
unset($_SESSION["err_msg_s_id"]);
unset($_SESSION["err_msg_s_pass"]);

$_SESSION=[];
setcookie ("session_name","",time()-1800);
session_destroy();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj= new Meeting();


?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<mate charset="utf-8">
		<title>meeting app | staff LOGIN</title>
		<link rel="stylesheet" href="../css/style.css">
		<meta name="viewport" content="width=device-width">
		<!-- fontAwsome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css" />
		<!-- reset css  -->
		<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
		<!-- google web font -->
		<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=M+PLUS+1p:wght@300&family=Noto+Serif+JP:wght@300&display=swap" rel="stylesheet">
		<!-- favicon -->
		<link rel="shortcut icon" href="" />
	</head>
	<body>
		<header class="staff staff_login">
			<div>
			<img class="header_img" src="../image/photoplan-title-icon02.png" alt="ヘッダー用デザイン">
			<h1>meeetiii <span class="font_mini">for staff</span></h1><img class="header_img"src="../image/photoplan-icon01.png" alt="ヘッダー用デザイン">
			</div>
		</header>
		<main class="staff_login_main">
			<section class="staff_login_section">
			<p><img src="../image/photoplan-icon01.png" class="hunwari"></p>

			<h1 class="login_title">スタッフログイン</h1><br>
				<form action="exec_staff_login.php" method="post">
					<table class="login_table">
						<tr>
							<th><p><label for="s_id">スタッフID<span class="required_color">必須</span></p></th>
							<td><input type="text" name="s_id" id="s_id" pattern="^[0-9A-Za-z]+$">
							<span class="red"><?php echo $err_msg_s_id; ?></span></td>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_pass">パスワード<span class="required_color">必須</span></p></th>
							<td><input type="password" name="s_pass" id="s_pass" pattern="^[0-9A-Za-z]+$">
							<span class="red"><?php echo $err_msg_s_pass; ?></span></td>
						</tr>
					</table>
				
				<p><input class="sub_btn" type="submit" value="staff LOGIN"></p>
				</form>			
			
			</section>
		</main>
		<footer class="staff">
		
		</footer>
	<script src="../jquery-3.5.1.min.js"></script>
	<script src=""></script>
	</body>
</html>

