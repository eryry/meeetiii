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

$rows =$obj->getCustomerGroup();

?>

<?php require_once("header_for_staff.php"); ?>
		<main>
			<h1>新規顧客登録ページ<i class="fas fa-eye"></i></h1>
			<section>
				<form action="exec_c_add.php" method="post" autocomplete="off">
					<table>
						<tr>
							<th><p><label for="c_group_id">グループID </label><span class="required_color">必須</span></p></th>
							<td><p>
								<select name="c_group_id">
									<option value="">グループIDを選択</option>
									<?php while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $row["c_group_id"]; ?>"><?php echo h($row["c_group_id"]); ?></option>
									<?php endwhile; ?>
								</select></p>
							</td>
						</tr>
						<tr>
							<th><p><label for="c_id">顧客ID</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="c_id" id="c_id" placeholder="*半角数字/半角アルファベット"></td>
						</tr>
						<tr>
							<th><p><label for="c_name">名前</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="c_name" id="c_name"></td>
						</tr>
						<tr>
							<th><p><label for="c_pass">パスワード</label><span class="required_color">必須</span></p></th>
							<td>
								<p class="pass_area">
									<input type="password" autocomplete="new-password" name="c_pass" id="c_pass" placeholder="*半角数字/半角アルファベット">
									<span class="field-icon"><i toggle="password-field" class="fas fa-eye-slash toggle-password"></i></span>
								</p>
							</td>
						</tr>
						<tr>
							<th><p><label for="c_tell">電話番号</label></p></th>
							<td><input type="number" name="c_tell" id="c_tell"></td>
						</tr>
						<tr>
							<th><p><label for="c_mail">メールアドレス</label></p></th>
							<td><input type="text" name="c_mail" id="c_mail"></td>
						</tr>
						<tr>
							<th><p><label for="zip">郵便番号</label></p></th>
							<td><input type="number" name="c_zip" id="zip"></td>
						</tr>
						<tr>
							<th><p><label for="address">住所</label></p></th>
							<td><input type="text" name="c_address" id="address"></td>
						</tr>
						<tr>
							<th><p><label for="c_gender">新郎/新婦</label></p></th>
							<td><p>
								<select name="c_gender">
									<option value="">お選びください</option>
									<option value="0">新郎</option>
									<option value="1">新婦</option>
								</select></p>
							</td>
						</tr>
					</table>
				
				<p><input class="sub_btn" type="submit" value="新規顧客登録"></p>
				</form>

				
			</section>
	</main>
<?php require_once("footer_for_staffpage.php"); ?>
