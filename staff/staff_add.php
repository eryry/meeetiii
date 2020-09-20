<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_top.php?err=no_role");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

require_once("../class/meeting.class.php");
$obj =new Meeting();
$staffs=$obj->getStaff();


?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>スタッフ 登録・一覧・更新</h1>
			<section>
				<h2>スタッフ新規登録</h2>
				<form action="exec_staff_add.php" method="post" autocomplete="off">
					<table>
						<tr>
							<th><p><label for="s_id">スタッフID</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="s_id" id="s_id" placeholder="*半角数字/半角アルファベッ"></td>
						</tr>
						<tr>
							<th><p><label for="s_name">名前</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="s_name" id="s_name"></td>
						</tr>
						<tr>
							<th><p><label for="s_pass">パスワード</label><span class="required_color">必須</span></p></th>
							<td>
								<p class="pass_area">
									<input type="password" autocomplete="new-password" name="s_pass" id="s_pass" placeholder="*半角数字/半角アルファベット">
									<span class="field-icon"><i toggle="password-field" class="fas fa-eye-slash toggle-password"></i></span>
								</p>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_mail">メールアドレス</label></p></th>
							<td><input type="text" name="s_mail" id="s_mail"></td>
						</tr>
						<tr>
							<th><p><label for="role">利用区分</label><span class="required_color">必須</span></p></th>
							<td>
								<p><select name="role">
									<option value="">お選びください</option>
									<option value="0">スタッフ</option>
									<option value="1">管理者(staff&message追加権限)</option>
								</select></p>
							</td>
						</tr>
					</table>
				<p><input class="sub_btn" type="submit" value="新規スタッフ登録" name="add"></p>
				</form>
			</section>
			
			<section>
				<h2>スタッフ情報更新</h2>
				
				<form action="exec_staff_add.php" method="post" autocomplete="off">
					<table>
						<tr>
							<td>
								<p><select name="s_id">
									<option>スタッフIDを選択</option>
									<?php while($staff=$staffs->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $staff["s_id"]; ?>"><?php echo h($staff["s_id"]); ?></option>
									<?php endwhile; ?>
								</select></p>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_name">名前</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="s_name" id="s_name"></td>
						</tr>
						<tr>
							<th><p><label for="s_pass">パスワード</label><span class="required_color">必須</span></p></th>
							<td>
								<p class="pass_area">
									<input type="password" autocomplete="new-password" name="s_pass" id="s_pass" placeholder="*半角数字/半角アルファベット">
									<span class="field-icon"><i toggle="password-field" class="fas fa-eye-slash toggle-password"></i></span>
								</p>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_mail">メールアドレス</label></p></th>
							<td><input type="text" name="s_mail" id="s_mail"></td>
						</tr>
						<tr>
							<th><p><label for="role">利用区分</label><span class="required_color">必須</span></p></th>
							<td>
								<p><select name="role">
									<option value="">お選びください</option>
									<option value="0">スタッフ</option>
									<option value="1">管理者(staff&message追加権限)</option>
								</select></p>
							</td>
						</tr>
					</table>
					<p><input class="sub_btn" type="submit" value="スタッフ情報更新" name="update"></p>
				</form>	
			</section>
			
			<section>
				<h2>スタッフ一覧</h2>
				
				
			</section>
			
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
