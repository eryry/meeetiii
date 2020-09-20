<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_top.php?err=no_role");
	exit();
}

if(empty($_POST["m_id"])||empty($_POST["m_body"])) {
	header("Location: message_list.php?err=1");
	exit();
}
require_once("../class/meeting.class.php");

$obj = new Meeting();

if(empty($_POST["update"])){
	$obj->msgAdd($_POST["m_id"],$_POST["m_body"]);
}else{
	$obj->msgUpdate($_POST["m_id"],$_POST["m_body"]);
}
header("Location:message_list.php");
//print_r($_POST);


?>