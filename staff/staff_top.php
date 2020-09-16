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

$groups=$obj->getLimitOverBySId($_SESSION["s_id"]);
$rows =$obj->getGroomBrideGrouopAllDate();

$staff=$obj->getStaffById($_SESSION["s_id"]);

$msgs=$obj->getMessage();


?>


<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>スタッフ用TOP</h1>
			<section>
			<p>ログイン中のスタッフ名: <?php echo h($_SESSION["s_name"]);?></p>
			<?php if(empty($groups)) echo "担当顧客で期限超過ありのお客様はありません。";?>
			<?php if(!empty($groups)): ?>
			<p>担当中で期限超過があるお客様一覧</p>
			<div id="mainView">
				<table class="list_noborder">
					<tr>
						<th class="list_id_num">ID</th>
						<th class="list_r_day">予約日</th><th class="list_c_name">新郎名</th><th class="list_c_name">新婦名</th>
					</tr>
					<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
					<?php if(!empty($groups) && $row["limit_over"]==1 && $row["group_id"]==$groups["c_group_id"]): ?>
					<tr>
						<td class="list_id_num"><a href="c_group_each.php?group_id=<?php echo $row["group_id"];?>" ><?php echo $row["group_id"];?></a></td>
						<td class="list_r_day"><?php 
							//撮影予約日の表示（曜日も日本語で）
							$reserve_day = $row["reserve_day"];
							$week = ["日","月","火","水","木","金","土"];
							$hi = date('w', strtotime($reserve_day));
							$youbi = $week[$hi];
							$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
							echo h($rd); 
						?></td>
						<td class="list_c_name"><?php echo h($row["g_name"]); ?></td>
						<td class="list_c_name"><?php echo h($row["b_name"]); ?></td>
					</tr>
					<?php endif; ?>
					<?php endwhile; ?>
				</table>
			</div>
			<?php endif; ?>
			</section>
			<?php if($staff["role"]==1): ?>
			<section>
				<h3>何日前かで表示変えるメッセージの登録</h3>
				<form action="exec_msg_add.php" method="post">
				<p>メッセージID(日付連動型/数字のみ/何日前かで数値入力）</p>
				<p><input type="number" name="m_id" placeholder="半角数字のみ"></p>
				<p>メッセージ内容</p>
				<p><input type="text" name="m_body"></p>
				<button><input type="submit" value="メッセージ登録" name="add"></button>
				</form>
			</section>
			<section>
				<h3>メッセージの更新</h3>
				<form action="exec_msg_add.php" method="post">
				<p>メッセージID(日付連動型/数字のみ/何日前かで数値入力）</p>
				<p>
					<select name="m_id">
						<option>メッセージIDを選択</option>
						<?php while($msg=$msgs->fetch(PDO::FETCH_ASSOC)): ?>
						<option value="<?php echo $msg["m_id"]; ?>"><?php echo intVal($msg["m_id"]); ?></option>
						<?php endwhile; ?>
					</select>
				</p>
				<p>メッセージ内容</p>
				<p><input type="text" name="m_body" value=""></p>
				<button><input type="submit" value="メッセージ編集" name="update"></button>
				</form>
			</section>
			
			<?php endif; ?>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>

