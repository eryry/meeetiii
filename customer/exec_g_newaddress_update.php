<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");

$obj = new Meeting();


$obj->groupNewaddressUpdate($_SESSION["c_group_id"],$_POST["new_zip"],$_POST["new_address"]);

$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
$_SESSION["new_zip"]=$resg["new_zip"];
$_SESSION["new_address"]=$resg["new_address"];

header("Location: c_group_info.php");
//print_r($_POST);


?>

