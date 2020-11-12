<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();


if(empty($_POST["c_group_id"])||empty($_POST["c_id"])||empty($_POST["c_name"])||empty($_POST["c_pass"])) {
	if(empty($_POST["c_group_id"]) ){
		$_SESSION["err_msg_cgid"]="グループIDを選択して下さい。";
	}
	if(empty($_POST["c_id"])){
		$_SESSION["err_msg_cid"]="お客様IDを入力してください。";
	}
	if(empty($_POST["c_name"])){
		$_SESSION["err_msg_cname"]="お客様名を入力してください。";
	}
	if(empty($_POST["c_pass"])){
		$_SESSION["err_msg_cpass"]="パスワードを設定してください。";
	}
	
	if(!empty($_POST["c_id"])){
		$c_group_data = $obj->getCustomerById($_POST["c_id"]);
		if($c_group_data["c_id"]==$_POST["c_id"]){
			$_SESSION["err_msg_check_cid"]="すでに登録済みのidです。別のidを入力ください。";
		}
	}
	header("Location: c_add.php?err=1");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

if(!empty($_POST["c_id"])){
	$c_group_data = $obj->getCustomerById($_POST["c_id"]);
	if($c_group_data["c_id"]==$_POST["c_id"]){
		$_SESSION["err_msg_check_cid"]="すでに登録済みのidです。別のidを入力ください。";
		header("Location: c_add.php?err=2");	
	}
}

$c_pass = password_hash($_POST["c_pass"],PASSWORD_DEFAULT);

$c_id=h($_POST["c_id"]);
$c_name=h($_POST["c_name"]);
$c_tell=h($_POST["c_tell"]);
$c_mail=h($_POST["c_mail"]);
$c_zip=h($_POST["c_zip"]);
$c_address=h($_POST["c_address"]);
$c_gender=intVal($_POST["c_gender"]);
$obj->customerAdd($_POST["c_group_id"],$c_id,$c_name,$c_pass,$c_tell,$c_mail,$c_zip,$c_address,$c_gender);
header("Location:c_add_fin.php");


?>
