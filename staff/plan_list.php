<?php
session_start();
if(empty($_SESSION["s_id"])) {
	header("Location:staff_login.php?err=no_login");
	exit();
}

require_once("../class/meeting.class.php");
$obj =new Meeting();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$rows =$obj->getPlan();

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>プラン一覧</h1>
			<section>
					<table class="p_list">
					<tr>
						<th class="list_id_num"><p>P_ID</p></th><th class="list_p_name"><p>プラン名</p></th><th class="list_p_wear"><p>プラン衣装種類</p></th><th class="list_p_link"><p>変更・修正</p></th>
					</tr>
					<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
					<tr>
						<td class="list_id_num"><p><?php echo h($row["p_id"]);?></p></td>
						<td class="list_p_name"><p><?php echo h($row["p_name"]); ?></p></td>
						<td class="list_p_wear"><p><?php 
							if($row["p_wear"]=='kimono') {
								echo "和装のみ";
							}else if($row["p_wear"]=='dress') {
								echo "洋装のみ";
							}else {
								echo "和装と洋装";
							}
							; ?></p></td>
						<td class="list_p_link update_link_mini"><a href="plan_update.php?p_id=<?php echo $row["p_id"];?>">変更・更新</a></td>
					</tr>
					<?php endwhile; ?>
					</table>
				
				<button class="add_link"><a href="plan_add.php">新規プラン登録ページへ</a></button>

			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>

