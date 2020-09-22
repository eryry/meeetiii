<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

if(!empty($_SESSION["err_msg_pname"])){
	$err_msg_pname=$_SESSION["err_msg_pname"];
}else{
	$err_msg_pname="";
}
if(!empty($_SESSION["err_msg_pwear"])){
 $err_msg_pwear=$_SESSION["err_msg_pwear"];
}else{
 $err_msg_pwear="";
}

unset($_SESSION["err_msg_pname"]);
unset($_SESSION["err_msg_pwear"]);



?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>新規プラン登録</h1>
			<section>
				<form action="exec_plan_add.php" method="post">
					<table class="plan_add_table">
						<tr>
							<th><p><label for="p_name">プラン名</label><span class="required_color">必須</span></p></th>
							<td><input type="text" name="p_name" id="p_name">
								<span class="red"><?php echo $err_msg_pname; ?></span>
							</td>
						</tr>
						<tr>
							<th><p><label for="p_wear">衣装の種類</label><span class="required_color">必須</span></p></th>
							<td>
								<p><select name="p_wear" id="p_wear">
									<option value="">下記から選択</option>
									<option value="kimono">和装のみ</option>
									<option value="dress">洋装のみ</option>
									<option value="both">和装と洋装</option>
								</select></p>
								<span class="red"><?php echo $err_msg_pwear; ?></span>
							</td>
						</tr>
					</table>
				
				<p><input type="submit" value="新規プラン登録"></p>
				</form>
				
				<p><a href="plan_list.php">プラン一覧ページへ</a></p>

			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>

