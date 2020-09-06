<?php
session_start();

if(empty($_POST["s_id"])||empty($_POST["s_pass"])) {
	header("Location: staff_login.php?err=1");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();
$res = $obj->staffLogin($_POST["s_id"],$_POST["s_pass"]);
if($res) {
	$_SESSION["s_name"]=$res["s_name"];
	$_SESSION["s_id"]    =$res["s_id"];
	header("Location: staff_top.php");
}else{
	header("Location: staff_login.php?err2;");
}


header("Location:staff_top.php");
//print_r($_POST);

?>

