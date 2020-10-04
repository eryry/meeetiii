<?php
session_start();

if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

if(empty($_POST["c_group_id"])) {
	header("Location: c_group_update.php?err=1");
	exit();
}
require_once("../class/meeting.class.php");

$obj = new Meeting();
$obj->customerGroupUpdate($_POST["c_group_id"],$_POST["p_id"],$_POST["reserve_day"],$_POST["reserve_time"],
$_POST["new_zip"],$_POST["new_address"],$_POST["s_id"]);

header("Location:c_group_list.php?updateOK;");
// print_r($_POST["c_group_id"]);

?>
