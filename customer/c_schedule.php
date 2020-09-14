<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");

//サニタイズ関数
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$obj= new Meeting();
$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
$_SESSION["reserve_day"] =$resg["reserve_day"];

$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

$row = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);


//予約日から、2・3日前、2週間前、3週間前、1か月前の日付取得
$s_day=$obj->getScheduleDateByGId($_SESSION["c_group_id"]);
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



//未・完了表示
if($_SESSION["estimate"]==0) {
	$estimate="☐未発行";
}else {
	$estimate="☑発行済";
}
if($_SESSION["invoce"]==0) {
	$invoce="☐未発行";
}else {
	$invoce="☑発行済";
}
if($_SESSION["payment"]==0) {
	$payment="☐支払未";
}else {
	$payment="☑支払済";
}
if($_SESSION["d_product"]==0) {
	$d_product="☐納品未";
}else {
	$d_product="☑納品済";
}
if($_SESSION["before2days"]==0) {
	$before2days="☐確認未";
}else {
	$before2days="☑確認済み";
}
if($_SESSION["make_reh"]==0) {
	$make_reh="☐未";
}else {
	$make_reh="☑済";
}
if($_SESSION["cos_fixed"]==0) {
	$cos_fixed="☐未決定";
}else {
	$cos_fixed="☑決定済";
}
if($_SESSION["cos_fitting"]==0) {
	$cos_fitting="☐未";
}else {
	$cos_fitting="☑済";
}
if($_SESSION["place_fixed"]==0) {
	$place_fixed="☐未決定";
}else {
	$place_fixed="☑決定済";
}
?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>schedule</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($row["p_name"]);	?> </p>
				
				<p>進捗状況</p>
				<table class="list_noborder">
					<tr>
						<th class="check">未・済</th><th class="todo">管理項目</th><th class="limit">期日</th>
					</tr>
					<tr>
						<td class="check"><?php echo $d_product; ?></td><td class="todo">商品納品</td><td class="limit">データのみ：1か月後<br>アルバム：2か月後</td>
					</tr>
					<tr>
						<td class="check"><?php echo $place_fixed; ?></td><td class="todo">撮影判断</td><td class="limit"><?php echo h($b2de); ?></td>
					</tr>
					<tr>
						<td class="check"><?php echo $payment; ?></td><td class="todo">お支払い</td><td class="limit"><?php echo h($b2we); ?>までに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $invoce; ?></td><td class="todo">請求書発行</td><td class="limit"><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $make_reh; ?></td><td class="todo">ヘアメイクリハーサル</td><td class="limit"><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $place_fixed; ?></td><td class="todo">撮影場所決定</td><td class="limit"><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $cos_fixed; ?></td><td class="todo">衣装決定</td><td class="limit"><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $cos_fitting; ?></td><td class="todo">衣装試着予約</td><td class="limit">お早めに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $estimate; ?></td><td class="todo">見積り書発行</td><td class="limit">ご契約時にお渡し</td>
					</tr>
				</table>
				
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


