<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err3");
	exit();
}

if(empty($_GET["c_group_id"])) {
	exit();
}else{
	$group_id = $_GET["c_group_id"];
}

require_once("../class/meetiing.class.php");
$obj = new Meeting();
$json=$obj->getGroomBrideGrouopAllDateJSON();
print_r($json);


?>
