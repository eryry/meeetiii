<?php
session_start();
if(empty($_POST["c_id"])||empty($_POST["c_pass"])) {
	if(empty($_POST["c_id"])){
		$_SESSION["err_msg_cid"]="IDを入力してください";
	}
	if(empty($_POST["c_pass"])){
		$_SESSION["err_msg_cpass"]="パスワードを入力してください";
	}
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
$_SESSION["before2days"] =$resg["before2days"];
$_SESSION["make_reh"]    =$resg["make_reh"];
$_SESSION["cos_fixed"]   =$resg["cos_fixed"];
$_SESSION["cos_fitting"] =$resg["cos_fitting"];
$_SESSION["place_fixed"] =$resg["place_fixed"];
$_SESSION["limit_over"]  =$resg["limit_over"];

//グループのp_id情報からプラン名、プラン衣装取ってきてセッションデータに格納
$resp=$obj->getPlanById($_SESSION["p_id"]);
$_SESSION["p_name"]=$resp["p_name"];
$_SESSION["p_wear"]=$resp["p_wear"];

$reserve_day = $_SESSION["reserve_day"];
//撮影予約日の表示（曜日も日本語で）
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$_SESSION["rd"] =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";


header("Location: c_group_top.php");

//print_r($_POST);
//print_r($_SESSION);
?>

