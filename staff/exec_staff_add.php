<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

if(empty($_POST["s_id"])||empty($_POST["s_name"])||empty($_POST["s_pass"])||empty($_POST["s_mail"])||empty($_POST["role"])) {
	header("Location: staff_add.php?err=1");
	exit();
}
require_once("../class/meeting.class.php");

$obj = new Meeting();
$s_pass = password_hash($_POST["s_pass"],PASSWORD_DEFAULT);
$obj->staffAdd($_POST["s_id"],$_POST["s_name"],$s_pass,$_POST["s_mail"],$_POST["role"]);
header("Location:staff_add_fin.php");



?>