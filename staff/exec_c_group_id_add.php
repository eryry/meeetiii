<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

if(empty($_POST["c_group_id"])) {
	header("Location: c_group_id_add.php?err=1");
	exit();
}
require_once("../class/meeting.class.php");

$obj = new Meeting();
$obj->customerGroupAdd($_POST["c_group_id"],$_POST["p_id"],$_POST["reserve_day"],$_POST["reserve_time"],$_POST["new_zip"],$_POST["new_address"],$_POST["s_id"]);

//print_r($_POST);
header("Location:c_gropu_id_add_fin.php");


?>

