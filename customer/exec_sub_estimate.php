<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}


require_once("../class/meeting.class.php");
$obj = new Meeting();

//ファイル送信されたら、$estimateの値は1．なければ0(初期値0にしている）
if(!empty($_FILES["estimate"])) {
	$estimate=1;
}else{
	$estimate=0;
}
$obj->submitEstimate($_POST["c_group_id"],$estimate);

header("Location:../staff/c_group_list.php");
print_r($_POST);





?>