<?php
session_start();
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
if( empty($_POST["p_id"]) || empty($_POST["p_name"]) || empty($_POST["p_wear"]) ) {
	header("Location: plan_update.php?err=1");
	exit();
}
require_once("../class/meeting.class.php");

$obj = new Meeting();

$p_name=h($_POST["p_name"]);
$p_wear=h($_POST["p_wear"]);
$obj->planUpdate($_POST["p_id"],$p_name,$p_wear);
header("Location: plan_list.php");

?>
