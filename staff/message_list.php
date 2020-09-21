<?php
session_start();
if(empty($_SESSION["s_id"]) || $_SESSION["role"]==0) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");
$obj =new Meeting();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$msgs =$obj->getMessage();


?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>メッセージ 登録・一覧・更新</h1>
			<p>何日前かで表示変えるメッセージの登録</p>
			
			<section>
				<div class="msg_wrapper">
				<h2>メッセージ登録</h2>
				<form action="exec_msg_add.php" method="post">
				<p class="msg_th"><b>メッセージID(日付連動型/数字のみ/何日前かで数値入力）</b></p>
				<p><input type="number" name="m_id" placeholder="半角数字のみ"></p>
				<p class="msg_th"><b>メッセージ内容</b></p>
				<p><input type="text" name="m_body"></p>
				<button><input class="spg_add_btn" type="submit" value="メッセージ登録" name="add"></button>
				</form>
				<div>
			</section>
			
			<section>
				<div class="msg_wrapper">
				<h2>メッセージ更新</h2>
				<form action="exec_msg_add.php" method="post">
					<p class="msg_th"><b>メッセージID</b></p>
					<p>
						<select name="m_id">
							<option>メッセージIDを選択</option>
							<?php foreach($msgs as $msg): ?>
							<option value="<?php echo $msg["m_id"]; ?>"><?php echo intVal($msg["m_id"]); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<p class="msg_th"><b>メッセージ内容</b></p>
					<p><input type="text" name="m_body" value=""></p>
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

