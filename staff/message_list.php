<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_login.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj =new Meeting();
$msgs =$obj->getMessage();

// エラー表示
if(!empty($_SESSION["err_msg_mid"])){
	$err_msg_mid=$_SESSION["err_msg_mid"];
}else{
	$err_msg_mid="";
}
if(!empty($_SESSION["err_msg_mbody"])){
	$err_msg_mbody=$_SESSION["err_msg_mbody"];
}else{
	$err_msg_mbody="";
}
unset($_SESSION["err_msg_mid"]);
unset($_SESSION["err_msg_mbody"]);

if(!empty($_SESSION["err_msg_mid_update"])){
	$err_msg_mid_update=$_SESSION["err_msg_mid_update"];
}else{
	$err_msg_mid_update="";
}
if(!empty($_SESSION["err_msg_mbody_update"])){
	$err_msg_mbody_update=$_SESSION["err_msg_mbody_update"];
}else{
	$err_msg_mbody_update="";
}
unset($_SESSION["err_msg_mid_update"]);
unset($_SESSION["err_msg_mbody_update"]);

?>

<?php require_once("header_for_staff.php"); ?>
		<main>
			<h1>メッセージ 登録・一覧・更新</h1>
			<p>何日前かで表示変えるメッセージの登録</p>
			<section>
				<div class="msg_wrapper">
					<h2>メッセージ登録</h2>
					<form action="exec_msg_add.php" method="post">
						<p class="msg_th"><b>メッセージID</b><span class="required_color">必須</span></p>
						<p><input type="number" name="m_id" placeholder="半角数字のみ(日付連動型/何日前かの数値）"></p>
						<span class="red"><?php echo $err_msg_mid; ?></span>
						<p class="msg_th"><b>メッセージ内容</b><span class="required_color">必須</span></p>
						<p><textarea name="m_body"></textarea></p>
						<p><span class="red"><?php echo $err_msg_mbody; ?></span></p>
						<button><input class="spg_add_btn" type="submit" value="メッセージ登録" name="add"></button>
					</form>
				<div>
			</section>
			<section id="msg_update">
				<div class="msg_wrapper">
					<h2>メッセージ更新</h2>
					<form action="exec_msg_add.php" method="post">
						<p class="msg_th"><b>メッセージID</b><span class="required_color">必須</span></p>
						<p>
							<select name="m_id">
								<option value="">メッセージIDを選択</option>
								<?php foreach($msgs as $msg): ?>
								<option value="<?php echo $msg["m_id"]; ?>"><?php echo intVal($msg["m_id"]); ?></option>
								<?php endforeach; ?>
							</select>
						</p>
						<p><span class="red"><?php echo $err_msg_mid_update; ?></span></p>
						<p class="msg_th"><b>メッセージ内容</b><span class="required_color">必須</span></p>
						<p><textarea name="m_body" value=""></textarea></p>
						<p><span class="red"><?php echo $err_msg_mbody_update; ?></span></p>
						<button><input class="spg_add_btn" type="submit" value="メッセージ編集" name="update" id="m_update"></button>
					</form>	
				</div>
			</section>
			<section>
				<div class="">
					<h2>メッセージ一覧</h2>
					<table class="list msg_list">
						<tr>
							<th class="list_id_num"><p>mID</p></th><th class="list_mbody"><p>メッセージ内容</p></th>
						</tr>
						<?php foreach($msgs as $msg): ?>
						<tr>
							<td class="list_id_num"><p><?php echo intVal($msg["m_id"]);?></p></td>
							<td class="list_mbody"><p><?php echo h($msg["m_body"]); ?></p></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</section>
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
