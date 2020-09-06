<?php

if(empty($_POST["c_group_id"])) {
	header("Location: c_group_id_add.php?err=1");
	exit();
}
require_once("class/meeting.class.php");

$obj = new Meeting();
$obj->customerGroupAdd($_POST["c_group_id"]);
header("Location:c_gropu_id_add_fin.php");



?>

