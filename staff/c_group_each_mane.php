

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



//撮影予約日の表示（曜日も日本語で）
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
//時間表示
$time=date('H:i',strtotime($_GET["group_id"]));

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>マネジメント（スケジュール管理）ページ</h1>
			<section>
			<h2>顧客グループID：<?php echo intVal($_GET["group_id"]);?></h2>
			
				<table class="list_noborder">
					<tr>
						<th>撮影予約日</th><td><?php echo h($rd); ?></td>
					</tr>
					<tr>
						<th>当日お支度開始時間</th><td><?php echo h($time); ?></td>
					</tr>
					<tr>
						<th>撮影プラン</th><td><?php echo h($_SESSION["p_name"]); ?></td>
					</tr>
					
					<tr>
						<th>撮影判断※ロケ撮影の場合、2・3日前までに</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>お支払い</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>請求書発行</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>ヘアメイクリハーサル</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>撮影場所決定</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>衣装決定</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>衣装試着予約</th><td>日付表示箇所</td>
					</tr>
					<tr>
						<th>見積り書発行</th><td>日付表示箇所</td>
					</tr>
					
					
					
					
				</table>
				<br>

				
			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>



