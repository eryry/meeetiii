<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();


if(empty($_POST["update"])){
	if(empty($_POST["s_id"]) || empty($_POST["s_name"]) || empty($_POST["s_pass"]) || empty($_POST["role"]) ) {
		print_r($_POST);
		header("Location: staff_add.php?err=1");
		exit();
	}
	$s_pass = password_hash($_POST["s_pass"],PASSWORD_DEFAULT);
	$obj->staffAdd($_POST["s_id"],$_POST["s_name"],$s_pass,$_POST["s_mail"],$_POST["role"]);
}else{
	if(empty($_POST["s_id"])) {
		header("Location: staff_add.php?err=2");
		exit();
	}
	$staff=$obj->getStaffById($_POST["s_id"]);
	
	//カラの欄があったら、元のデータをそのまま入れてUPDATEする設定
	if(empty($_POST["s_name"])){
		$s_name=$staff["s_name"];
	}else{
		$s_name=$_POST["s_name"];
	}
	if(empty($_POST["s_pass"])){
		$s_pass=$staff["s_pass"];
	}else{
		$s_pass = password_hash($_POST["s_pass"],PASSWORD_DEFAULT);
	}
	if(empty($_POST["s_mail"])){
		$s_mail=$staff["s_mail"];
	}else{
		$s_mail=$_POST["s_mail"];
	}
	if(empty($_POST["role"])){
		$role=$staff["role"];
	}else{
		$role=$_POST["role"];
	}
	
	$obj->staffUpdate($_POST["s_id"],$s_name,$s_pass,$s_mail,$role);
}

//print_r($_POST);
//header("Location:staff_add_fin.php");



?>