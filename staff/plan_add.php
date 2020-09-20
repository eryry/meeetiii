<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>新規プラン登録</h1>
			<section>
				<form action="exec_plan_add.php" method="post">
					<table>
						<tr>
							<th><p><label for="p_name">プラン名</label></p></th>
							<td><input type="text" name="p_name" id="p_name"></td>
						</tr>
						<tr>
							<th><p><label for="p_wear">衣装の種類</label></p></th>
							<td>
								<p><select name="p_wear" id="p_wear">
									<option value="">下記から選択</option>
									<option value="kimono">和装のみ</option>
									<option value="dress">洋装のみ</option>
									<option value="both">和装と洋装</option>
								</select></p>
							</td>
						</tr>
					</table>
				
				<p><input class="sub_btn" type="submit" value="新規プラン登録"></p>
				</form>
				
				<p><a href="plan_list.php">プラン一覧ページへ</a></p>

			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>

