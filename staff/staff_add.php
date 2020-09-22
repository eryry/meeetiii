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

//追加時のエラーメッセージ
if(!empty($_SESSION["err_msg_sid"])){
	$err_msg_sid=$_SESSION["err_msg_sid"];
}else{
	$err_msg_sid="";
}
if(!empty($_SESSION["err_msg_sname"])){
	$err_msg_sname=$_SESSION["err_msg_sname"];
}else{
	$err_msg_sname="";
}
if(!empty($_SESSION["err_msg_spass"])){
	$err_msg_spass=$_SESSION["err_msg_spass"];
}else{
	$err_msg_spass="";
}

if(!empty($_SESSION["err_msg_check_sid"])){
	$err_msg_check_sid=$_SESSION["err_msg_check_sid"];
}else{
	$err_msg_check_sid="";
}

unset($_SESSION["err_msg_sid"]);
unset($_SESSION["err_msg_sname"]);
unset($_SESSION["err_msg_spass"]);
unset($_SESSION["err_msg_check_sid"]);

if(!empty($_SESSION["err_msg_update_sid"])){
	$err_msg_update_sid=$_SESSION["err_msg_update_sid"];
}else{
	$err_msg_update_sid="";
}
unset($_SESSION["err_msg_update_sid"]);

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>スタッフ 登録・一覧・更新</h1>
			<section>
				<h2>スタッフ新規登録</h2>
				<form action="exec_staff_add.php" method="post" autocomplete="off">
					<table class="staff_add_table">
						<tr>
							<th><p><label for="s_id">スタッフID</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="s_id" id="s_id" placeholder="*半角数字/半角アルファベッ">
								<span class="red"><?php echo $err_msg_sid; ?><?php echo $err_msg_check_sid;?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_name">名前</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="s_name" id="s_name">
								<span class="red"><?php echo $err_msg_sname; ?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_pass">パスワード</label><span class="required_color">必須</span></p></th>
							<td>
								<p class="pass_area">
									<input type="password" autocomplete="new-password" name="s_pass" id="s_pass" placeholder="*半角数字/半角アルファベット">
									<span class="field-icon"><i toggle="password-field" class="fas fa-eye-slash toggle-password"></i></span>
								</p>
								<span class="red"><?php echo $err_msg_spass; ?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_mail">メールアドレス</label></p></th>
							<td><input type="text" name="s_mail" id="s_mail">
							</td>
						</tr>
						<tr>
							<th><p><label for="role">利用区分</label></p></th>
							<td>
								<p><select name="role">
									<option value="">お選びください</option>
									<option value="0">スタッフ</option>
									<option value="1">管理者(staff&message追加権限)</option>
								</select></p>
							</td>
						</tr>
					</table>
				<p><input type="submit" value="新規スタッフ登録" name="add"></p>
				</form>
			</section>
			
			<section id="staffupdate">
				<h2>スタッフ情報更新</h2>
				
				<form action="exec_staff_add.php" method="post" autocomplete="off">
					<table class="staff_update_table">
						<tr>
							<th><p>スタッフID<span class="required_color">必須</span></p></th>
							<td>
								<p><select name="s_id">
									<option value="">スタッフIDを選択</option>
									<?php while($staff=$staffs->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?php echo $staff["s_id"]; ?>"><?php echo h($staff["s_id"]." (登録名：".$staff["s_name"].")"); ?></option>
									<?php endwhile; ?>
								</select></p>
								<span class="red"><?php echo $err_msg_update_sid; ?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="s_name">名前</label></p></th>
							<td><input type="text" name="s_name" id="s_name"></td>
						</tr>
						<tr>
							<th><p><label for="s_pass">パスワード</label></p></th>
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
							<th><p><label for="role">利用区分</label></p></th>
							<td>
								<p><select name="role">
									<option value="">お選びください</option>
									<option value="0">スタッフ</option>
									<option value="1">管理者(staff&message追加権限)</option>
								</select></p>
							</td>
						</tr>
					</table>
					<p><input type="submit" value="スタッフ情報更新" name="update"></p>
				</form>	
			</section>
			
			<!--
			<section>
				<h2>スタッフ一覧</h2>
				<table class="list staff_list">
					<tr>
						<th class="list_sid"><p>S_ID</p></th><th class="list_sname"><p>名前</p></th><th class="list_spass"><p>password</p></th><th class="list_role"><p>権限</p></th>
					</tr>
					<?php while($staff=$staffs->fetchAll(PDO::FETCH_ASSOC)): ?>
					<tr>
						<?php print_r($staff) ;?>
						<td class="list_sid"><p><?php echo $staff["s_id"];?></p></td>
						<td class="list_sname"><p><?php echo $Staff["s_name"]; ?></p></td>
						<td class="list_spass"><p>※非表示</p></td>
						<td class="list_role"><p><?php echo $staff["role"]; ?></p></td>
					</tr>
					<?php endwhile; ?>
				</table>
			</section>
			-->
			
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
