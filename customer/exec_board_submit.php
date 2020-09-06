<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");

$obj = new Meeting();

$obj->submitBoard($_POST["c_group_id"],$_POST["submit_member_id"],$_POST["body"]);
header("Location: c_board.php");
//print_r($_SESSION);
//print_r($_POST);


?>