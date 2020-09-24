<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
if(empty($_GET["p_id"])) {
 header("Location:plan_list.php");
 exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj =new Meeting();

if(empty($_GET["p_id"])) {
	$p_id="";
	$p_name="";
	$p_wear="";
} else {
	$p_id= intval($_GET["p_id"]);
	$row= $obj->getPlanById($p_id);
	$p_name= $row["p_name"];
	$p_wear= $row["p_wear"];
}

?>

<?php require_once("header_for_staff.php"); ?>
		<main class="plan_update_main">
			<section class="plan_update_section">
			<h2>プラン編集ページ</h2>
			<br>
			<div class="remark">
			<p>※ここでの編集内容は、すでに登録済みのお客様データも連動して変更されます。ご注意ください。</p>
			</div>
			<br>
				<form action="exec_plan_update.php" method="post" class="update_plan">
					<table class="p_update_table">
						<tr>
							<th><p>プランID</p></th>
							<td class="bgc_gray">
							<input type="hidden" name="p_id" value="<?php echo $p_id;?>">
							<p class="font_mini3"><?php echo intVal($p_id); ?></p></td>
						</tr>
						<tr>
							<th><p><label for="p_name">プラン名</label></p></th>
							<td><input type="text" name="p_name" id="p_name" value="<?php echo h($p_name); ?>"></td>
						</tr>
						<tr>
							<th><p><label for="p_wear">衣装の種類</label></p></th>
							<td>
								<p><select name="p_wear" id="p_wear">
									<option value="">下記から選択</option>
									<option value="kimono" 
										<?php if($p_wear=="kimono") {echo "selected";}; ?>>和装のみ
									</option>
									<option value="dress" 
										<?php if($p_wear=="dress")  {echo "selected";}; ?>>洋装のみ
									</option>
									<option value="both" 
										<?php if($p_wear=="both")   {echo "selected";}; ?>>和装と洋装
									</option>
								</select></p>
							</td>
						</tr>
					</table>
				<p><input type="submit" value="プラン情報更新"></p>
				</form>
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>
