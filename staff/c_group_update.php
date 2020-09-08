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

//グループIDから情報引っ張ってくる
$res=$obj->getGroomBrideGrouopByGId($_GET["group_id"]);
print_r($res);


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
							<th><label for="estimate">見積もり発行状況</label></th>
							<td>
								<select id="estimate" name="estimate">
									<option value="">発行状況</option>
									<option value="0" <?php if($res["estimate"]==0){ echo "selected";} ?>>発行未</option>
									<option value="1" <?php if($res["estimate"]==1){ echo "selected";} ?>>発行済</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="invoce">請求書発行状況</label></th>
							<td>
								<select id="invoce" name="invoce">
									<option value="">発行状況</option>
									<option value="0" <?php if($res["invoce"]==0){ echo "selected";} ?>>発行未</option>
									<option value="1" <?php if($res["invoce"]==0){ echo "selected";} ?>>発行済</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="payment">支払い状況</label></th>
							<td>
								<select id="payment"  name="payment">
									<option value="">支払状況</option>
									<option value="0" <?php if($res["payment"]==0){ echo "selected";} ?>>支払未</option>
									<option value="1" <?php if($res["payment"]==0){ echo "selected";} ?>>支払済</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="d_product">商品納品状況</label></th>
							<td>
								<select id="d_product" name="d_product">
									<option value="">納品状況</option>
									<option value="0" <?php if($res["d_product"]==0){ echo "selected";} ?>>納品未</option>
									<option value="1" <?php if($res["d_product"]==0){ echo "selected";} ?>>納品済</option>
								</select>
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


					</table>
				
				<p><input class="sub_btn" type="submit" value="顧客グループ情報更新"></p>
				</form>


			
			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>



