<?php
session_start();
if(empty($_SESSION["c_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$obj= new Meeting();
$rows=$obj->getCustomerGrouop($c_group_id);
$row = $rows->fetch(PDO::FETCH_ASSOC);

$_SESSION["c_group_id"]=$row["c_group_id"];
echo $_SESSION["c_group_id"];


//撮影当日までの日数表示用
$today = date('y-m-d');
$day= $obj->dayDiff($today,$_SESSION["reserve_day"]);
$reserve_day = $_SESSION["reserve_day"];

//撮影予約日の表示（曜日も日本語で）
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";



//$res = $obj->getCustomerGroup();
//if($res) {
//	$_SESSION["reserve_day"]= $res["reserve_day"];
//} 
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
			<h1>お客様ログイン後TOP</h1>
		</header>
		<main>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<p>撮影予約日： <?php echo h($rd);?> ></p>
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>
