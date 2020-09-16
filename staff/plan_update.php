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


require_once("../class/meeting.class.php");
$obj =new Meeting();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

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

		<main>
			<section>
			<h1>プラン編集ページ</h1>
				<form action="exec_plan_update.php" method="post" class="update_plan">
					<table>
						<tr>
							<th>プランID</th>
							<td>
							<input type="hidden" name="p_id" value="<?php echo $p_id;?>">
							<?php echo intVal($p_id); ?></td>
						</tr>
						<tr>
							<th><label for="p_name">プラン名</label></th>
							<td><input type="text" name="p_name" id="p_name" value="<?php echo h($p_name); ?>"></td>
						</tr>
						<tr>
							<th><label for="p_wear">衣装の種類</label></th>
							<td>
								<select name="p_wear" id="p_wear">
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
								</select>
							</td>
						</tr>
					</table>
				
				<p><input class="sub_btn" type="submit" value="プラン情報更新"></p>
				</form>

				
				<p><a href="plan_add.php">新規プラン登録ページへ</a></p>
				<p><a href="plan_list.php">プラン一覧ページへ</a></p>
			
			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>

