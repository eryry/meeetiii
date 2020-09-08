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

//予約日から、2・3日前、2週間前、3週間前、1か月前の日付取得
$s_day=$obj->getScheduleDateByGId($_GET["group_id"]);

//撮影予約日の表示（曜日も日本語で）
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
//時間表示
$time=date('H:i',strtotime($_GET["group_id"]));

$b2d = date('w', strtotime($s_day["before_2day"]));
$b3d = date('w', strtotime($s_day["before_3day"]));
$b2w = date('w', strtotime($s_day["before_2week"]));
$b3w = date('w', strtotime($s_day["before_3week"]));
$b1m = date('w', strtotime($s_day["before_1month"]));
$b2dy=$week[$b2d];
$b3dy=$week[$b3d];
$b2wy=$week[$b2w];
$b3wy=$week[$b3w];
$b1my=$week[$b1m];
$b2de =  date('Y年n月j日', strtotime($s_day["before_2day"]))."(".$b2dy.")";
$b3de =  date('Y年n月j日', strtotime($s_day["before_3day"]))."(".$b3dy.")";
$b2we =  date('Y年n月j日', strtotime($s_day["before_2week"]))."(".$b2wy.")";
$b3we =  date('Y年n月j日', strtotime($s_day["before_3week"]))."(".$b3wy.")";
$b1me =  date('Y年n月j日', strtotime($s_day["before_1month"]))."(".$b1my.")";



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
						<th>撮影判断※ロケ撮影の場合、2・3日前までに</th><td><?php echo h($b2de); ?></td>
					</tr>
					<tr>
						<th>お支払い</th><td><?php echo h($b2we); ?>までに</td>
					</tr>
					<tr>
						<th>請求書発行</th><td><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr>
						<th>ヘアメイクリハーサル</th><td><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr>
						<th>撮影場所決定</th><td><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr>
						<th>衣装決定</th><td><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr>
						<th>衣装試着予約</th><td>お早めに</td>
					</tr>
					<tr>
						<th>見積り書発行</th><td>ご契約時にお渡し</td>
					</tr>
					
					
					
					
				</table>
				<br>

				
			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>



