<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$obj =new Meeting();
$rows =$obj->getGroomBrideGrouopAllDate();

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>お客様グループ一覧</h1>
			<section>
			<h2>予約日順</h2>

					<table class="list">
					
					<tr>
						<th class="list_id_num">g_ID</th><th class="list_r_day">予約日</th><th class="list_p_name">プラン</th><th class="list_c_name">新郎名</th><th class="list_c_name">新婦名</th>
					</tr>
					<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
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
						<td class="list_p_name"><?php echo h($row["p_name"]); ?></td>
						<td class="list_c_name">郎：<?php echo h($row["g_name"]); ?></td>
						<td class="list_c_name">婦：<?php echo h($row["b_name"]); ?></td>
						
					</tr>
					<?php endwhile; ?>
					</table>
				

			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>

