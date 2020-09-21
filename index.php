<?php
session_start();
$_SESSION=[];
setcookie ("session_name","",time()-1800);
session_destroy();


$c_pass = password_hash('eri',PASSWORD_DEFAULT);
echo $c_pass;
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<mate charset="utf-8">
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
		<header>
			<h1>ログイン<span class="required_color">必須</span></h1>
		</header>
		<main>
			<section>
				<form action="customer/exec_customer_login.php" method="post">
					<table class="login_table">
						<tr>
							<th><p><label for="c_id">顧客ID</label><p></th>
							<td><input type="text" name="c_id" id="c_id"></td>
						</tr>
						<tr>
							<th><p><label for="c_pass">パスワード</label></p></th>
							<td><input type="password" autocomplete="current-password" name="c_pass" id="c_pass">
							</td>
						</tr>

					</table>
				
				<p><input class="sub_btn" type="submit" value="LOGIN"></p>
				</form>
			
			</section>
			
			<p><a href="staff/staff_login.php">管理者用ページ</a></p>
		</main>
		<footer>
		
		</footer>
	<script src=""></script>
	</body>
</html>

