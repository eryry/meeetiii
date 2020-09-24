<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location:../index.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj = new Meeting();

$c_data = $obj->getCustomerById($_SESSION["c_id"]);

if(empty($_POST["c_name"])){
	$c_name= $c_data["c_name"];
}else{
	$c_name= h($_POST["c_name"]);
}

if(empty($_POST["c_pass"])){
	$c_pass= $c_data["c_pass"];
}else{
	$c_pass= password_hash($_POST["c_pass"],PASSWORD_DEFAULT);
}
if(empty($_POST["c_mail"])){
	$c_mail= $c_data["c_mail"];
}else{
	$c_mail= h($_POST["c_mail"]);
}
if(empty($_POST["c_tell"])){
	$c_tell= $c_data["c_tell"];
}else{
	$c_tell= h($_POST["c_tell"]);
}
if(empty($_POST["c_zip"])){
	$c_zip= $c_data["c_zip"];
}else{
	$c_zip= h($_POST["c_zip"]);
}
if(empty($_POST["c_address"])){
	$c_address= $c_data["c_address"];
}else{
	$c_address= h($_POST["c_address"]);
}
if(empty($_POST["c_gender"])){
	$c_dgender= $c_data["c_gender"];
}else{
	$c_gender= intVal($_POST["c_gender"]);
}

$files=$_POST["c_myphoto"];

$obj->customerUpdate($_SESSION["c_id"],$c_name,$c_pass,$c_mail,$c_tell,$c_zip,$c_address,$c_gender);

//ファイル送信されたら、$c_myphotoの値は1にしてUPDATEする
if(!empty($_FILES["c_myphoto"]["tmp_name"])) {
	$c_myphoto=1;
	$obj->saveImage($_SESSION["c_id"],$c_myphoto);
}

header("Location: c_top.php");
//print_r($_POST);


?>
