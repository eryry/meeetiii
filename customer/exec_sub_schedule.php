<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();

// ファイル送信されたら、$estimateの値は1．なければ0(初期値0にしている）
if(!empty($_FILES["schedule"])) {
	$estimate=1;
}else{
	$estimate=0;
}
$obj->submitSchedule($_POST["c_group_id"],$schedule);

header("Location:c_schedule.php?group_id={$_POST['c_group_id']}");
// print_r($_POST);

?>