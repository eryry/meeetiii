<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");
$obj =new Meeting();
$rows =$obj->getPlan();
$rows2=$obj->getStaff();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>新規顧客グループ登録</h1>
			<section>
				<form action="exec_c_group_id_add.php" method="post">
					<table>
						<tr>
							<th><label for="c_group_id">グループID</label></th>
							<td><input type="number" name="c_group_id" id="c_group_id"></td>
						</tr>
						<tr>
							<th><label for="p_id">プラン名</label></th>
							<td>
								<select  name="p_id">
									<option>プランを選択</option>
									<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row["p_id"]; ?>"><?php echo h($row["p_name"]); ?></option>
									<?php endwhile; ?>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="reserve_day">予約日</label></th>
							<td><input type="date" name="reserve_day" id="reserve_day"></td>
						</tr>
						<tr>
							<th><label for="reserve_time">予約日来店時間</th>
							<td><input type="time" name="reserve_time" id="reserve_time" value="10:00"></td>
						</tr>
						<tr>
							<th><label for="estimate">見積もり発行状況</label><span class="font_mini">※発行済みの場合は投稿画面で発行済見積もりを投稿してください</span></th>
							<td>発行未</td>
						</tr>
						<tr>
							<th><label for="invoce">請求書発行状況</label><span class="font_mini">※発行済みの場合は投稿画面で発行済請求書を投稿してください</span></th>
							<td>発行未</td>
						</tr>
						<tr>
							<th><label for="payment">支払い状況</label><span class="font_mini">※支払い済みの場合はマネジメント画面で更新してください</span></th>
							<td>支払未</td>
						</tr>
						<tr>
							<th><label for="d_product">商品納品状況</label><span class="font_mini">※納品済みの場合はマネジメント画面で更新してください</span></th>
							<td>納品未</td>
						</tr>
						<tr>
							<th><label for="zip">新居郵便番号</label></th>
							<td><input type="number" name="new_zip" id="zip"></td>
						</tr>
						<tr>
							<th><label for="address">新居住所</label></th>
							<td><input type="text" name="new_address" id="address"></td>
						</tr>
							<th><label for="s_id">担当者名</label></th>
							<td>
								<select name="s_id">
									<option>担当スタッフを選択</option>
									<?php while($row2=$rows2->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row2["s_id"]; ?>"><?php echo h($row2["s_name"]); ?></option>
									<?php endwhile; ?>
								</select>
							</td>
						</tr>
						</table>
				
				<p><input class="sub_btn" type="submit" value="新規顧客グループ登録"></p>
				</form>
			
			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>
