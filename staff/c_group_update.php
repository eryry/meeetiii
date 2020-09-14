<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}


require_once("../class/meeting.class.php");
$obj =new Meeting();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

//選択用プラン一覧取得
$rows= $obj->getPlan();
//スタッフ一覧取得
$rows2=$obj->getStaff();
//グループIDから情報引っ張ってくる
$res=$obj->getCustomerGrouopByGId($_GET["group_id"]);
//print_r($res);

//未・完了表示
if($res["estimate"]==0) {
	$estimate="☐未発行";
}else {
	$estimate="☑発行済";
}
if($res["invoce"]==0) {
	$invoce="☐未発行";
}else {
	$invoce="☑発行済";
}
if($res["payment"]==0) {
	$payment="☐支払未";
}else {
	$payment="☑支払済";
}
if($res["d_product"]==0) {
	$d_product="☐納品未";
}else {
	$d_product="☑納品済";
}


?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<section>
			<h1>顧客グループ情報編集ページ</h1>
			
				<form action="exec_group_update.php" method="post">
					<table>
						<tr>
							<th>顧客グループID</th>
							<td>
							<input type="hidden" name="c_group_id" value="<?php echo $_GET["group_id"]; ?>">
							<?php echo intVal($_GET["group_id"]); ?></td>
						</tr>
						<tr>
							<th><label for="p_id">予約プラン</label></th>
							<td>
								<select name="p_id" id="p_id">
									<option value="">下記から選択</option>
									<?php while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row["p_id"]; ?>" <?php if($res["p_id"]==$row["p_id"]) {echo "selected";} ; ?>><?php echo h($row["p_name"]);?>
									</option>
									<?php endwhile; ?>
								</select>
							</td>
						</tr>
							<th><label for="reserve_day">予約日</label></th>
							<td><input type="date" name="reserve_day" id="reserve_day" value="<?php echo $res["reserve_day"]?>"></td>
						</tr>
						<tr>
							<th><label for="reserve_time">予約日来店時間</th>
							<td><input type="time" name="reserve_time" id="reserve_time" value="<?php echo $res["reserve_time"]?>"></td>
						</tr>
						<tr>
							<th><label for="estimate">見積もり発行状況</label><span class="font_mini">※情報更新は見積書投稿画面で行ってください</span></th>
							<td><?php echo $estimate;?>
							</td>
						</tr>
						<tr>
							<th><label for="invoce">請求書発行状況</label><span class="font_mini">※情報更新は請求書投稿画面で行ってください</span></th>
							<td><?php echo $invoce;?>
							</td>
						</tr>
						<tr>
							<th><label for="payment">支払い状況</label><span class="font_mini">※情報更新はマネジメント画面で行ってください</span></th>
							<td><?php echo $payment;?>
							</td>
						</tr>
						<tr>
							<th><label for="d_product">商品納品状況</label><span class="font_mini">※情報更新はマネジメント画面で行ってください</span></th>
							<td><?php echo $d_product;?>
							</td>
						</tr>
						<tr>
							<th><label for="zip">新居郵便番号</label></th>
							<td><input type="number" name="new_zip" id="zip" value="<?php echo $res["new_zip"];?>"></td>
						</tr>
						<tr>
							<th><label for="address">新居住所</label></th>
							<td><input type="text" name="new_address" id="address" value="<?php echo $res["new_address"];?>"></td>
						</tr>
						<tr>
							<th><label for="p_id">担当者名</label></th>
							<td>
								<select name="s_id">
									<option>担当スタッフを選択</option>
									<?php while($row=$rows2->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row["s_id"]; ?>" <?php if($res["s_id"]==$row["s_id"]) {echo "selected";} ; ?>><?php echo h($row["s_name"]); ?></option>
									<?php endwhile; ?>
								</select>
							</td>
						</tr>

					</table>
				
				<p><input class="sub_btn" type="submit" value="顧客グループ情報更新"></p>
				</form>


			
			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>



