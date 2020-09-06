<?php
session_start();

if(empty($_POST["c_id"])||empty($_POST["c_pass"])) {
	header("Location: ../index.php?err=1");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();

$res = $obj->customerLogin($_POST["c_id"],$_POST["c_pass"]);

if($res) {
	$_SESSION["c_name"]=$res["c_name"];
	$_SESSION["c_id"]  =$res["c_id"];
	$_SESSION["c_group_id"]  =$res["c_group_id"];
	//header("Location: c_top.php");
	
}else{
	header("Location: ../index.php?err2");
}

$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
if($resg) {
	$_SESSION["reserve_day"] =$resg["reserve_day"];
	$_SESSION["reserve_time"]=$resg["reserve_time"];
	$_SESSION["estimate"]    =$resg["estimate"];
	$_SESSION["invoce"]      =$resg["invoce"];
	$_SESSION["payment"]     =$resg["payment"];
	$_SESSION["d_product"]   =$resg["d_product"];
	$_SESSION["new_zip"]     =$resg["new_zip"];
	$_SESSION["new_address"] =$resg["new_address"];
	header("Location: c_top.php");
}else{
	header("Location: ../index.php?err3");
}

print_r($_POST);
print_r($_SESSION);
?>

