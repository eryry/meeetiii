<?php
session_start();



?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<mate charset="utf-8">
		<title>meeting app | customer LOGIN</title>
		<link rel="stylesheet" href="../css/style.css">
		<meta name="viewport" content="width=device-width">
		<!-- fontAwsome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css" />
		<!-- reset css  -->
		<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
		<!-- google web font -->
		<!-- favicon -->
		<link rel="shortcut icon" href="" />
	</head>
	<body>
		<header>
			<h1>お客様ログイン</h1>
		</header>
		<main>
			<section>
				<form action="exec_customer_login.php" method="post">
					<table>
						<tr>
							<th><label for="c_id">顧客ID</th>
							<td><input type="text" name="c_id" id="c_id"></td>
						</tr>
						<tr>
							<th><label for="c_pass">パスワード</th>
							<td><input type="password" name="c_pass" id="c_pass"></td>
						</tr>

					</table>
				
				<p><input class="sub_btn" type="submit" value="LOGIN"></p>
				</form>			
			
			</section>
		</main>
		<footer>
		
		</footer>
	<script src="../jquery-3.5.1.min.js"></script>
	<script src=""></script>
	</body>
</html>

