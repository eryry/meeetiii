<?php
session_start();

if(empty($_SESSION["c_id"])) {
 header("Location:../index.php");
 exit();
}

require_once("../class/meeting.class.php");

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$obj =new Meeting();


?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<mate charset="utf-8">
		<title>meeting app ｜plan LIST</title>
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
			<h1>予約情報＆状況一覧</h1>
		</header>
		<main>
			<section>
			<h2>予約情報＆状況一覧</h2>
			<p>内容に間違いがある場合は、お電話または掲示板からご連絡ください</p>

					<table>
						<tr>
							<th>グループID</th>
							<td><?php echo intVal($_SESSION["c_group_id"]); ?></td>
						</tr>
						<tr>
							<th>プラン名</th>
							<td><?php 
							//echo $_SESSION["p_name"]; 
							?></td>
						</tr>
						<tr>
							<th>予約日</th>
							<td><?php echo h($_SESSION["reserve_day"]); ?></td>
						</tr>
						<tr>
							<th>予約日来店時間</th>
							<td><?php echo h($_SESSION["reserve_time"]); ?></td>
						</tr>
						<tr>
							<th>見積もり発行状況</th>
							<td><?php echo intVal($_SESSION["estimate"]); ?></td>
						</tr>
						<tr>
							<th>請求書発行状況</th>
							<td><?php echo intVal($_SESSION["invoce"]); ?></td>
						</tr>
						<tr>
							<th>支払い状況</th>
							<td><?php echo intVal($_SESSION["payment"]); ?></td>
						</tr>
						<tr>
							<th>商品納品状況</th>
							<td><?php echo intVal($_SESSION["d_product"]); ?></td>
						</tr>
						<tr>
							<th>新居郵便番号</th>
							<td><?php echo h($_SESSION["new_zip"]); ?></td>
						</tr>
						<tr>
							<th>新居住所</th>
							<td><?php echo h($_SESSION["new_address"]); ?></td>
						</tr>

					</table>
			
			</section>
		</main>
		<footer>
		
		</footer>
	<script src="../jquery-3.5.1.min.js"></script>
	<script src=""></script>
	</body>
</html>

