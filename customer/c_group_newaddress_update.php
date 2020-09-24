<?php
session_start();

if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
 header("Location: ../index.php");
 exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj =new Meeting();

$obj->getCustomerById($_SESSION["c_id"]);

$c_id = $_SESSION["c_id"];
$row  = $obj->getCustomerById($c_id);

//Gに登録されている新居データ入力欄に表示するための、Gデータ情報取得
$getgdata = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);
$new_zip=$getgdata["new_zip"];
$new_address=$getgdata["new_address"];

$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

//print_r($row);

?>

<?php require_once("header_for_customer.php"); ?>
		<main>
			<div id="title_wrapper">
				<h1>ご新居登録・更新<br><span class="font_mini_no_padding">new address</span></h1>
			<h1></h1>
			</div>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($getgdata["p_name"]);	?> </p>
				<h2 class="m_top_30">登録・更新</h2>
				<div class="remark">
					<p>出来上がった商品は、こちらの住所あてに発送いたします。</p>
					<p>新居未定の場合は、商品お届け先をご入力ください。</p>
					<p">※入力がない場合は、商品お届け先確認後の発送となります。</p>
				</div>
			</section>
			<section>
				<form action="exec_g_newaddress_update.php" method="post">
					<table class="c_update_table">
						<tr>
							<th><p><label for="zip">新居：郵便番号</label></p></th>
							<td><input type="number" name="new_zip" id="zip" value="<?php echo h($new_zip); ?>"></td>
						</tr>
						<tr>
							<th><p><label for="address">新居：住所</label></p></th>
							<td><input type="text" name="new_address" id="address" value="<?php echo h($new_address); ?>"></td>
						</tr>
					</table>
					<p><input class="sub_btn" type="submit" value="新居情報登録・更新"></p>
				</form>			
			</section>
		</main>
<?php include("footer_for_customerpage.php"); ?>
