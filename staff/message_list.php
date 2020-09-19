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
			<h1>メッセージ一覧＆更新</h1>
			<section>
				<h2>メッセージ一覧</h2>
				<table class="list">
					<tr>
						<th class="list_id_num">mID</th><th class="list_mbody">メッセージ内容</th>
					</tr>
					<?php foreach($msgs as $msg): ?>
					<tr>
						<td class="list_id_num"><?php echo intVal($msg["m_id"]);?></td>
						<td class="list_mbody"><?php echo h($msg["m_body"]); ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</section>
			<section>
				<h2>メッセージ更新</h2>
				<form action="exec_msg_add.php" method="post">
					<p>メッセージID</p>
					<p>
						<select name="m_id">
							<option>メッセージIDを選択</option>
							<?php foreach($msgs as $msg): ?>
							<option value="<?php echo $msg["m_id"]; ?>"><?php echo intVal($msg["m_id"]); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<p>メッセージ内容</p>
					<p><input type="text" name="m_body" value=""></p>
					<button><input type="submit" value="メッセージ編集" name="update" id="m_update"></button>
				</form>	
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>

