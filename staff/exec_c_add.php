<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

if(empty($_POST["c_group_id"])||empty($_POST["c_id"])||empty($_POST["c_name"])||empty($_POST["c_pass"])) {
	header("Location: c_add.php?err=1");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();
$c_pass = password_hash($_POST["c_pass"],PASSWORD_DEFAULT);
$obj->customerAdd($_POST["c_group_id"],$_POST["c_id"],$_POST["c_name"],$c_pass,$_POST["c_tell"],$_POST["c_mail"],$_POST["c_zip"],$_POST["c_address"],$_POST["c_gender"]);
header("Location:c_add_fin.php");
//print_r($_POST);

?>
