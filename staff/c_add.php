<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$obj =new Meeting();
$rows =$obj->getCustomerGroup();

?>


<?php require_once("header_for_staff.php"); ?>
		<main>
			<h1>新規顧客登録ページ</h1>
			<section>
				<form action="exec_c_add.php" method="post">
					<table>
						<tr>
							<th><label for="c_group_id">グループID 必須</th>
							<td>
								<select name="c_group_id">
									<option value="">グループIDを選択</option>
									<?php while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row["c_group_id"]; ?>"><?php echo h($row["c_group_id"]); ?></option>
									<?php endwhile; ?>
								</select>
							</td>
						</tr>
						<tr>
							<th><label for="c_id">顧客ID　必須</th>
							<td><input type="text" name="c_id" id="c_id"></td>
						</tr>
						<tr>
							<th><label for="c_name">名前　必須</th>
							<td><input type="text" name="c_name" id="c_name"></td>
						</tr>
						<tr>
							<th><label for="c_pass">パスワード　必須</th>
							<td><input type="password" name="c_pass" id="c_pass"></td>
						</tr>
						<tr>
							<th><label for="c_tell">電話番号</th>
							<td><input type="number" name="c_tell" id="c_tell"></td>
						</tr>
						<tr>
							<th><label for="c_mail">メールアドレス</th>
							<td><input type="text" name="c_mail" id="c_mail"></td>
						</tr>
						<tr>
							<th><label for="zip">郵便番号</th>
							<td><input type="number" name="c_zip" id="zip"></td>
						</tr>
						<tr>
							<th><label for="address">住所</th>
							<td><input type="text" name="c_address" id="address"></td>
						</tr>
						<tr>
							<th><label for="c_gender">新郎/新婦</th>
							<td>
								<select name="c_gender">
									<option value="">お選びください</option>
									<option value="0">新郎</option>
									<option value="1">新婦</option>
								</select>
							</td>
						</tr>
					</table>
				
				<p><input class="sub_btn" type="submit" value="新規顧客登録"></p>
				</form>

				
			</section>
	</main>
<?php include("footer_for_staffpage.php"); ?>
