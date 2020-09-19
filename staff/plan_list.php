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
					<table class="list">
					<tr>
						<th class="list_id_num">p_ID</th><th class="list_p_name">プラン名</th><th class="list_p_wear">プラン衣装種類</th>
					</tr>
					<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
					<tr>
						<td class="list_id_num"><?php echo h($row["p_id"]);?></td>
						<td class="list_p_name"><a href="plan_update.php?p_id=<?php echo $row["p_id"];?>"><?php echo h($row["p_name"]); ?></a></td>
						<td class="list_p_wear"><?php 
							if($row["p_wear"]=='kimono') {
								echo "和装のみ";
							}else if($row["p_wear"]=='dress') {
								echo "洋装のみ";
							}else {
								echo "和装と洋装";
							}
							; ?></td>
						
					</tr>
					<?php endwhile; ?>
					</table>
				
				<p><a href="plan_add.php">新規プラン登録ページへ</a></p>

			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>

