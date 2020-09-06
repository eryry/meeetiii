<?php
session_start();
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
$obj->planUpdate($_POST["p_id"],$_POST["p_name"],$_POST["p_wear"]);
header("Location: plan_list.php");
//print_r($_POST);


?>

