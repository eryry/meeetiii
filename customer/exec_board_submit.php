<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}
if(!empty($_SESSION["s_id"])) {
	$_SESSION["c_group_id"]==$_GET;
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj = new Meeting();

//ファイル送信されたら、$board_photoの値は1．なければ0(初期値0にしている）
if(!empty($_FILES["board_photo"]["tmp_name"])) {
	$board_photo=1;
}else{
	$board_photo=0;
}

$body=h($_POST["body"]);
$obj->submitBoard($_POST["c_group_id"],$_POST["submit_member_id"],$body,$board_photo);

$sql ="SELECT LAST_INSERT_ID() AS bid";
$b_id=$obj->pdo->query($sql);
$row=$b_id->fetch(PDO::FETCH_ASSOC);
//print_r($row);
//print_r($board_photo);
//print_r($_FILES["board_photo"]);

//画像送られてきていたら、上で取得した最新投稿のb_id名前つけて保存する
if(!empty($_FILES["board_photo"])) {
	$obj->saveBoardImage($row["bid"]);
}

header("Location:c_board.php?group_id={$_POST['c_group_id']}");
//print_r($_SESSION);
//print_r($_POST);

?>