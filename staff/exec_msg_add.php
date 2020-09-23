<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_top.php?err=no_role");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj = new Meeting();


if(empty($_POST["update"])){
	if(empty($_POST["m_id"])||empty($_POST["m_body"])) {
		if(empty($_POST["m_id"])){
			$_SESSION["err_msg_mid"]="メッセージIDを入力してください";
		}
		if(empty($_POST["m_body"])){
			$_SESSION["err_msg_mbody"]="メッセージ本文を入力してください";
		}
		header("Location: message_list.php?err=1");
		exit();
	}
	$m_id=$_POST["m_id"];
	$m_body=$_POST["m_body"];
	$obj->msgAdd($m_id,$m_body);
}else{
	if(empty($_POST["m_id"])||empty($_POST["m_body"])) {
		if(empty($_POST["m_id"])){
			$_SESSION["err_msg_mid_update"]="メッセージIDを選択してください";
		}
		if(empty($_POST["m_body"])){
			$_SESSION["err_msg_mbody_update"]="メッセージ本文を入力してください";
		}
		header("Location: message_list.php#msg_update");
		exit();
	}	
	$m_id=$_POST["m_id"];
	$m_body=$_POST["m_body"];
	$obj->msgUpdate($m_id,$m_body);
}
header("Location:message_list.php");
//print_r($_POST);


?>