<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj = new Meeting();


if( !empty($_POST["add"]) ){
	//更新ではなく追加なら
		$staff=$obj->getStaffById($_POST["s_id"]);

	if( empty($_POST["s_id"]) || empty($_POST["s_name"]) || empty($_POST["s_pass"]) ) {
		print_r($_POST);
		if( empty($_POST["s_id"]) ){
			$_SESSION["err_msg_sid"]="スタッフIDを入力してください";
		}
		if( empty($_POST["s_name"]) ){
			$_SESSION["err_msg_sname"]="登録スタッフ名を入力してください";
		}
		if( empty($_POST["s_pass"]) ){
			$_SESSION["err_msg_spass"]="パスワードを入力してください";
		}
		if($staff["s_id"]==$_POST["s_id"]){
			$_SESSION["err_msg_check_sid"]="すでに登録済みのidです。別のidを入力してください。";
		}
		header("Location: staff_add.php?err=1");
		exit();
	}
	if($staff["s_id"]==$_POST["s_id"]){
		$_SESSION["err_msg_check_sid"]="すでに登録済みのidです。別のidを入力してください。";
		header("Location: staff_add.php?err=2");
	}	
	
	$s_pass = password_hash($_POST["s_pass"],PASSWORD_DEFAULT);
	$s_id=h($_POST["s_id"]);
	$s_name=h($_POST["s_name"]);
	$s_mail=h($_POST["s_mail"]);
	$role=$_POST["role"];
	$obj->staffAdd($s_id,$s_name,$s_pass,$s_mail,$role);
	
}else{
	//更新ボタンが押されたの場合
	if(empty($_POST["s_id"])) {
		$_SESSION["err_msg_update_sid"]="スタッフIDを選択してください";
		header("Location: staff_add.php#staffupdate");
		exit();
	}
	$staff=$obj->getStaffById($_POST["s_id"]);
	
	

	
	//カラの欄があったら、元のデータをそのまま入れてUPDATEする設定
	if(empty($_POST["s_name"])){
		$s_name=$staff["s_name"];
	}else{
		$s_name=h($_POST["s_name"]);
	}
	if(empty($_POST["s_pass"])){
		$s_pass=$staff["s_pass"];
	}else{
		$s_pass = password_hash($_POST["s_pass"],PASSWORD_DEFAULT);
	}
	if(empty($_POST["s_mail"])){
		$s_mail=$staff["s_mail"];
	}else{
		$s_mail=h($_POST["s_mail"]);
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