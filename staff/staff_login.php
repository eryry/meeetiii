<?php
session_start();
$_SESSION=[];
setcookie ("session_name","",time()-1800);
session_destroy();


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
		<header class="staff">
			<h1>スタッフログイン</h1>
		</header>
		<main>
			<section>
				<form action="exec_staff_login.php" method="post">
					<table>
						<tr>
							<th><label for="s_id">スタッフID</th>
							<td><input type="text" name="s_id" id="s_id"></td>
						</tr>
						<tr>
							<th><label for="s_pass">パスワード</th>
							<td><input type="password" name="s_pass" id="s_pass"></td>
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

