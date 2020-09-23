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
$obj =new Meeting();
$rows =$obj->getPlan();
$rows2=$obj->getStaff();

$err_msg_id="";
/*
if(){
	$err_msg_id="すでに登録済みのNoです。別のNoを入力ください。";
}
*/
if(!empty($_SESSION["err_msg_cgid"])){
	$err_msg_cgid=$_SESSION["err_msg_cgid"];
	//print_r($_SESSION["err_msg_cgid"]);
}else{
	$err_msg_cgid="";
}
if(!empty($_SESSION["err_msg_pid"])){
	$err_msg_pid=$_SESSION["err_msg_pid"];
}else {
	$err_msg_pid="";
}
if(!empty($_SESSION["err_msg_rd"])){
	$err_msg_rd=$_SESSION["err_msg_rd"];
	//print_r($_SESSION["err_msg_rd"]);
}else{
	$err_msg_rd="";
}

unset($_SESSION["err_msg_cgid"]);
unset($_SESSION["err_msg_pid"]);
unset($_SESSION["err_msg_rd"]);


?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>新規顧客グループ登録</h1>
			<section>
				<p>すでに登録済みのGroupID(数字）は使用不可。</p>
				<form action="exec_c_group_id_add.php" method="post">
					<table class="c_group_add_table">
						<tr>
							<th><p><label for="c_group_id">グループID</label><span class="required_color">必須</span></p></th>
							<td><input type="number" name="c_group_id" id="c_group_id" pattern="^[0-9]+$" placeholder="半角数字/すでに登録済みのNoは登録不可">
							<span class="red"><?php echo $err_msg_cgid; ?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="p_id">プラン名</label><span class="required_color">必須</span></p></th>
							<td><p>
								<select  name="p_id">
									<option value="">プランを選択</option>
									<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row["p_id"]; ?>"><?php echo h($row["p_name"]); ?></option>
									<?php endwhile; ?>
								</select></p>
							<span class="red"><?php echo $err_msg_pid; ?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="reserve_day">予約日</label><span class="required_color">必須</span></p></th>
							<td><input type="date" name="reserve_day" id="reserve_day"><span class="red"><?php echo $err_msg_rd; ?></td>
							</span>
						</tr>
						<tr>
							<th><p><label for="reserve_time">予約日来店時間</label></p></th>
							<td><input type="time" name="reserve_time" id="reserve_time" value="10:00"></td>
						</tr>
						<tr>
							<th><p><label for="estimate">見積もり発行状況</label><span class="font_mini">※発行済みの場合は投稿画面で発行済見積もりを投稿してください</span></p></th>
							<td class="bgc_gray">
							<p>発行未</p></td>
						</tr>
						<tr>
							<th><p><label for="invoce">請求書発行状況</label><span class="font_mini">※発行済みの場合は投稿画面で発行済請求書を投稿してください</span></p></th>
							<td class="bgc_gray">
							<p>発行未</p></td>
						</tr>
						<tr>
							<th><p><label for="payment">支払い状況</label><span class="font_mini">※支払い済みの場合はマネジメント画面で更新してください</span></p></th>
							<td class="bgc_gray">
							<p>支払未<p></td>
						</tr>
						<tr>
							<th><p><label for="d_product">商品納品状況</label><span class="font_mini">※納品済みの場合はマネジメント画面で更新してください</span></p></th>
							<td class="bgc_gray">
							<p>納品未</p></td>
						</tr>
						<tr>
							<th><p><label for="zip">新居郵便番号</label></p></th>
							<td><input type="number" name="new_zip" id="zip"></td>
						</tr>
						<tr>
							<th><p><label for="address">新居住所</label></p></th>
							<td><input type="text" name="new_address" id="address"></td>
						</tr>
						<tr>
							<th><p><label for="s_id">担当者名</label></p></th>
							<td><p>
								<select name="s_id">
									<option>担当スタッフを選択</option>
									<?php while($row2=$rows2->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row2["s_id"]; ?>"><?php echo h($row2["s_name"]); ?></option>
									<?php endwhile; ?>
								</select></p>
							</td>
						</tr>
						</table>
				
				<p><input type="submit" value="新規グループ登録"></p>
				</form>
			
			</section>
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
