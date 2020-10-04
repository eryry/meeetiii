<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}
if(empty($_POST["list_item"]) || empty($_POST["c_group_id"])) {
	header("Location:c_itemlist.php?err=no_subitem");
}
require_once("../class/meeting.class.php");

$obj = new Meeting();

$obj->listItemAdd($_POST["c_group_id"],$_POST["list_item"]);
header("Location: c_itemlist.php?ok");
// print_r($_SESSION);
// print_r($_POST);


?>