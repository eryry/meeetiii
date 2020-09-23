<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
if( empty($_POST["p_name"]) || empty($_POST["p_wear"]) ) {
	if(empty($_POST["p_name"])){
		$_SESSION["err_msg_pname"]="プラン名を入力してください";
	}
	if(empty($_POST["p_wear"])){
	 $_SESSION["err_msg_pwear"]="衣装の種類を選択してください";
	}

	header("Location: plan_add.php?err=1");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj = new Meeting();




$p_name=h($_POST["p_name"]);
$p_wear=h($_POST["p_wear"]);

$obj->planAdd($p_name,$p_wear);
header("Location:plan_add_fin.php");


?>