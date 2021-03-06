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
$rows =$obj->getGroomBrideGrouopAllDate();

$today= date("Y-m-d");

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>お客様グループ一覧</h1>
			<section>
				<p><button class="sort_day_btn all_day"><a href="c_group_list.php">予約日順</a></button>
				<button class="sort_day_btn today"><a href="c_group_list_today.php">本日の予約</a></button>
				<button class="sort_day_btn feature_day activ_page_btn"><a href="">撮影未</a></button>
				<button class="sort_day_btn past_day"><a href="c_group_list_p.php">撮影済</a></button>
				<button class="sort_day_btn no_d"><a href="c_group_list_nd.php">納品未</a></button>
				<button class="sort_day_btn no_d"><a href="c_group_list_serch.php">検索</a></button>
				</p>
				<div id="mainView" class="table-scroll">
					<table class="list c_gropup_list">
						<tr class="c_group_list_head">
							<th class="list_id_num"><p class="line_h_40">ID</p></th><th class="list_id_num"><p class="font_mini_no_padding">連絡<br>note</p></th><th class="list_id_num"><p class="font_mini_no_padding">見積書<br>請求書</p></th>
							<th class="list_r_day"><p class="line_h_40">予約日</p></th><th class="list_c_name"><p class="line_h_40">新郎名</p></th>
							<th class="list_c_name"><p class="line_h_40">新婦名</p></th><th class="list_p_name"><p class="line_h_40">プラン</p></th>
						</tr>
						<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
						<?php if($row["reserve_day"]>$today): ?>
						<tr>
							<td class="list_id_num"><p><a href="c_group_each.php?group_id=<?php echo $row["group_id"];?>" ><?php echo $row["group_id"];?></a></p></td>
							<td class="list_id_num"><p><a href="../customer/c_board.php?group_id=<?php echo $row["group_id"];?>"><i class="far fa-clipboard"></i></a></p></td>
							<td class="list_id_num"><p><a href="../customer/c_paymentdata.php?group_id=<?php echo $row["group_id"];?>"><i class="far fa-file-alt"></i></a></p></td>
							<td class="list_r_day"><p><?php 
								// 撮影予約日の表示（曜日も日本語で）
								$reserve_day = $row["reserve_day"];
								$week = ["日","月","火","水","木","金","土"];
								$hi = date('w', strtotime($reserve_day));
								$youbi = $week[$hi];
								$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
								echo h($rd); 
							?></p></td>
							<td class="list_c_name"><p><?php echo h($row["g_name"]); ?></p></td>
							<td class="list_c_name"><p><?php echo h($row["b_name"]); ?></p></td>
							<td class="list_p_name"><p><?php echo h($row["p_name"]); ?></p></td>
						</tr>
						<?php endif; ?>
						<?php endwhile; ?>
					</table>
				</div>
			</section>
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
