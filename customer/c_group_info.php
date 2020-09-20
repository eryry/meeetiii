<?php
session_start();

if(empty($_SESSION["c_id"])) {
 header("Location:../index.php");
 exit();
}

require_once("../class/meeting.class.php");
$obj =new Meeting();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$reserve_day = $_SESSION["reserve_day"];
//撮影予約日の表示（曜日も日本語で）
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
//時間表示
$time=date('H:i',strtotime($_SESSION["c_group_id"]));

//未・完了表示
if($_SESSION["estimate"]==0) {
	$estimete="☐未発行";
}else {
	$estimete="☑発行済";
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

//入力がない場合も想定した新居表示設定
if(empty($_SESSION["new_zip"])) {
	$new_zip="☐未入力";
}else {
	$new_zip=$_SESSION["new_zip"];
}
if(empty($_SESSION["new_address"])) {
	$new_address="☐未入力";
}else {
	$new_address=$_SESSION["new_address"];
}


?>

<?php require_once("header_for_customer.php"); ?>
		<main>
			<div id="title_wrapper">
				<h1>予約内容＆進捗一覧<br><span class="font_mini_no_padding">reservation data</span></h1>
			</div>
			<section>
				<p>ご新居情報は、ご自身で入力・更新可能です。</p>
				<button class="update_btn"><a href="c_group_newaddress_update.php">ご新居入力・更新ページへ</a></button>
				<p class="font_mini">※ご新居情報以外で間違いがある場合は、お電話または掲示板からご連絡ください</p>
				<p class="font_mini">※ご新居情報は、商品お届け先になります。新居未定時はお届け希望住所を入力ください。</p>
			</section>
			<section class="c_g_check">
				<table>
					<tr>
						<th><p>グループID</p></th>
						<td><p><?php echo intVal($_SESSION["c_group_id"]); ?></p></td>
					</tr>
					<tr>
						<th><p>プラン名</p></th>
						<td><p><?php echo $_SESSION["p_name"]; ?></p></td>
					</tr>
					<tr>
						<th><p>予約日</p></th>
						<td><p><?php echo h($rd); ?></p></td>
					</tr>
					<tr>
						<th><p>予約日来店時間</p></th>
						<td><p>支度開始：<?php echo h($time); ?><br><span class="font_mini">※支度開始10分前を目安に来店ください</span></p></td>
					</tr>
					<tr>
						<th><p>見積もり発行状況</p></th>
						<td><p><?php echo h($estimete); ?></p></td>
					</tr>
					<tr>
						<th><p>請求書発行状況</p></th>
						<td><p><?php echo h($invoce); ?></p></td>
					</tr>
					<tr>
						<th><p>お支払い状況</p></th>
						<td><p><?php echo h($payment); ?></p></td>
					</tr>
					<tr>
						<th><p>商品納品状況</p></th>
						<td><p><?php echo h($d_product); ?></p></td>
					</tr>
					<tr>
						<th><p>新居郵便番号</p></th>
						<td><p><?php echo h($new_zip); ?></p></td>
					</tr>
					<tr>
						<th><p>新居住所</p></th>
						<td><p><?php echo h($new_address); ?></p></td>
					</tr>
				</table>
		</section>
	</main>
		<?php include("footer_for_customerpage.php"); ?>

