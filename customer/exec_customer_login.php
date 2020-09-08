<?php
session_start();

if(empty($_POST["c_id"])||empty($_POST["c_pass"])) {
	header("Location: ../index.php?err=1");
	exit();
}

require_once("../class/meeting.class.php");
$obj = new Meeting();

//ログイン情報から、お客様個人の情報をセッションデータに格納
$res = $obj->customerLogin($_POST["c_id"],$_POST["c_pass"]);
$_SESSION["c_name"]=$res["c_name"];
$_SESSION["c_id"]  =$res["c_id"];
$_SESSION["c_group_id"]  =$res["c_group_id"];

//ログインしたお客様個人情報のグループ情報から、グループに登録されている予約情報をセッションに格納
$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
$_SESSION["reserve_day"] =$resg["reserve_day"];
$_SESSION["reserve_time"]=$resg["reserve_time"];
$_SESSION["estimate"]    =$resg["estimate"];
$_SESSION["invoce"]      =$resg["invoce"];
$_SESSION["payment"]     =$resg["payment"];
$_SESSION["d_product"]   =$resg["d_product"];
$_SESSION["new_zip"]     =$resg["new_zip"];
$_SESSION["new_address"] =$resg["new_address"];
$_SESSION["p_id"] 			 =$resg["p_id"];

//グループのp_id情報からプラン名、プラン衣装取ってきてセッションデータに格納
$resp=$obj->getPlanById($_SESSION["p_id"]);
$_SESSION["p_name"]=$resp["p_name"];
$_SESSION["p_wear"]=$resp["p_wear"];

header("Location: c_top.php");

//print_r($_POST);
//print_r($_SESSION);
?>

