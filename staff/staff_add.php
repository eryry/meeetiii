<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>新規スタッフ登録</h1>
			<section>
				<form action="exec_staff_add.php" method="post">
					<table>
						<tr>
							<th><label for="s_id">スタッフID</th>
							<td><input type="text" name="s_id" id="s_id"></td>
						</tr>
						<tr>
							<th><label for="s_name">名前</th>
							<td><input type="text" name="s_name" id="s_name"></td>
						</tr>
						<tr>
							<th><label for="s_pass">パスワード</th>
							<td><input type="password" name="s_pass" id="s_pass"></td>
						</tr>
						<tr>
							<th><label for="s_mail">メールアドレス</th>
							<td><input type="text" name="s_mail" id="s_mail"></td>
						</tr>
						<tr>
							<th><label for="role">利用区分</th>
							<td>
								スタッフ<input type="radio" value="user" name="role">
								管理者<input type="radio" value="root" name="role">
							</td>
						</tr>
					</table>
				
				<p><input class="sub_btn" type="submit" value="新規スタッフ登録"></p>
				</form>
			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>
