<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");

$obj = new Meeting();

$obj->listDelete($_POST["list_id"]);
header("Location: c_itemlist.php");
//print_r($_SESSION);
//print_r($_POST);

?>
