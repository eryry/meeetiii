<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

require_once("../class/meeting.class.php");
$obj = new Meeting();

$obj->groupManageDataUpdate($_SESSION["group_id"],$_POST["d_product"],$_POST["before2days"],$_POST["payment"],$_POST["make_reh"],$_POST["cos_fixed"],
$_POST["cos_fitting"],$_POST["place_fixed"]);

header("Location:c_group_each.php?updateOK;");
//rint_r($_POST);
//print_r($_SESSION["group_id"]);

?>