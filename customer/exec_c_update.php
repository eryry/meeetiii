<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");

$obj = new Meeting();


$obj->customerUpdate($_SESSION["c_id"],$_POST["c_name"],$_POST["c_pass"],$_POST["c_mail"],$_POST["c_tell"],$_POST["c_zip"],$_POST["c_address"],$_POST["c_gender"]);

if(!empty($_FILES["c_myphoto"])) {
			$obj->saveImage($_SESSION["c_id"]);
}

header("Location: c_top.php");
//print_r($_POST);


?>

