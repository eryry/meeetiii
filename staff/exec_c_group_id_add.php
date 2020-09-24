<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj = new Meeting();
$get_g_id=$obj-> getScheduleDateByGId($_POST["c_group_id"]);

if(empty($_POST["c_group_id"]) || empty($_POST["p_id"]) || empty($_POST["reserve_day"])) {
	if(empty($_POST["c_group_id"])){
		$_SESSION["err_msg_cgid"]="GrouoIDが入力されていません";
	}
	if(empty($_POST["p_id"])){
		$_SESSION["err_msg_pid"]="プランが選択されていません";
	}
	if(empty($_POST["reserve_day"])){
		$_SESSION["err_msg_rd"]="予約日を入力してください";
	}
	if($get_g_id["c_group_id"]==$_POST["c_group_id"]){
		$_SESSION["err_msg_check_cgid"]="すでに登録済みのGroup_Idです。別のidを入力ください";
	}
	
	header("Location: c_group_id_add.php?err=1");
	exit();
}
if($get_g_id["c_group_id"]==$_POST["c_group_id"]){
	$_SESSION["err_msg_check_cgid"]="すでに登録済みのGroup_Idです。別のidを入力ください";
	header("Location: c_group_id_add.php?err=2");
	exit();
}

$c_group_id=intVal($_POST["c_group_id"]);
$p_id=intVal($_POST["p_id"]);
$new_zip=h($_POST["new_zip"]);
$new_address=h($_POST["new_address"]);

$obj->customerGroupAdd($c_group_id,$p_id,$_POST["reserve_day"],$_POST["reserve_time"],$new_zip,$new_address,$_POST["s_id"]);

header("Location:c_gropu_id_add_fin.php");

?>
