<?php
session_start();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
if( empty($_POST["s_id"]) || empty($_POST["s_pass"]) ) {
	if( empty($_POST["s_id"]) ){
		$_SESSION["err_msg_s_id"]="スタッフIDを入力してください";
		echo $_SESSION["err_msg_s_id"];
	}
	if( empty($_POST["s_pass"]) ){
		$_SESSION["err_msg_s_pass"]="パスワードを入力してください";
		echo $_SESSION["err_msg_s_pass"];
	}
	header("Location: staff_login.php?err=1");
	exit();
}
require_once("../class/meeting.class.php");
$obj = new Meeting();


$res = $obj->staffLogin($_POST["s_id"],$_POST["s_pass"]);
if($res) {
	$_SESSION["s_name"]=$res["s_name"];
	$_SESSION["s_id"]   =$res["s_id"];
	$_SESSION["role"] =$res["role"];
	header("Location: staff_top.php");
}else{
	header("Location: staff_login.php?err2;");
}


header("Location:staff_top.php");
//print_r($_POST);

?>

