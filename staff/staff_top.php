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
print_r($groups);
$rows =$obj->getGroomBrideGrouopAllDate();

?>


<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>スタッフ用TOP</h1>
			<section>
			<p>ログイン中のスタッフ名<?php echo h($_SESSION["s_name"]);?></p>
			
			<p>担当中で期限超過があるお客様一覧</p>

			<div id="mainView">
				<table class="list_noborder">
					<tr>
						<th class="list_id_num">ID</th>
						<th class="list_r_day">予約日</th><th class="list_c_name">新郎名</th><th class="list_c_name">新婦名</th>
					</tr>
					<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
					<?php if($row["limit_over"]==1): ?>
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
			
			</section>
		</main>
		
<?php include("footer_for_staffpage.php"); ?>

