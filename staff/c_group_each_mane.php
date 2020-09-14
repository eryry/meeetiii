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

//GETの数値からグループ情報取得
$g_data=$obj->getCustomerGrouopByGId($_SESSION["group_id"]);
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



//予約日から、2・3日前、2週間前、3週間前、1か月前の日付取得
$s_day=$obj->getScheduleDateByGId($_SESSION["group_id"]);

//撮影予約日の表示（曜日も日本語で）
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
//時間表示
$time=date('H:i',strtotime($_SESSION["group_id"]));

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
			<h2>顧客グループID： <?php echo intVal($_SESSION["group_id"]);?></h2>
			<p>撮影プラン: <?php echo h($_SESSION["p_name"]); ?></p>
			<p>撮影予約日: <?php echo h($rd); ?></p>
			<p>当日お支度開始時間: <?php echo h($time); ?></p>
			
			<form action="exec_c_g_m_update.php" method="post">
				<table class="list_noborder">
					<tr>
						<th class="check">未・済</th>
						<th class="todo">管理項目</th>
						<th class="limit">期日</th>
					</tr>
					<tr>
						<td class="check">
							<select id="d_product" name="d_product">
								<option value="0" 
									<?php if($_SESSION["d_product"]==0) {echo "selected";}; ?>>☐納品未
								</option>
								<option value="1"
									<?php if($_SESSION["d_product"]==1) {echo "selected";}; ?>>☑納品済
								</option>
							</select>
						</td>
						<td class="todo">商品納品</td>
						<td class="limit">データのみ：1か月後<br>アルバム：2か月後</td>
					</tr>
					<tr>
						<td class="check">
							<select id="before2days" name="before2days">
								<option value="0" 
									<?php if($_SESSION["before2days"]==0) {echo "selected";}; ?>>☐確認未
								</option>
								<option value="1"
									<?php if($_SESSION["before2days"]==1) {echo "selected";}; ?>>☑確認済
								</option>
							</select>
						</td>
						<td class="todo">撮影判断</td>
						<td class="limit"><?php echo h($b2de); ?></td>
					</tr>
					<tr>
						<td class="check">
							<select id="payment" name="payment">
								<option value="0" 
									<?php if($_SESSION["payment"]==0) {echo "selected";}; ?>>☐支払未
								</option>
								<option value="1"
									<?php if($_SESSION["payment"]==1) {echo "selected";}; ?>>☑支払済
								</option>
							</select>
						</td>
						<td class="todo">お支払い</td>
						<td class="limit"><?php echo h($b2we); ?>までに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $invoce; ?></td>
						<td class="todo">請求書発行</td>
						<td class="limit"><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check">
							<select id="make_reh" name="make_reh">
								<option value="0" 
									<?php if($_SESSION["make_reh"]==0) {echo "selected";}; ?>>☐未実行
								</option>
								<option value="1"
									<?php if($_SESSION["make_reh"]==1) {echo "selected";}; ?>>☑実行済
								</option>
							</select>
							</td>
						<td class="todo">ヘアメイクリハーサル</td>
						<td class="limit"><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check">
							<select id="place_fixed" name="place_fixed">
								<option value="0" 
									<?php if($_SESSION["place_fixed"]==0) {echo "selected";}; ?>>☐未決定
								</option>
								<option value="1"
									<?php if($_SESSION["place_fixed"]==1) {echo "selected";}; ?>>☑決定済
								</option>
							</select>
						</td>
						<td class="todo">撮影場所決定</td>
						<td class="limit"><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check">
							<select id="cos_fixed" name="cos_fixed">
								<option value="0" 
									<?php if($_SESSION["cos_fixed"]==0) {echo "selected";}; ?>>☐未決定
								</option>
								<option value="1"
									<?php if($_SESSION["cos_fixed"]==1) {echo "selected";}; ?>>☑決定済
								</option>
							</select>
						</td>
						<td class="todo">衣装決定</td>
						<td class="limit"><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr>
						<td class="check">
							<select id="cos_fitting" name="cos_fitting">
								<option value="0" 
									<?php if($_SESSION["cos_fitting"]==0) {echo "selected";}; ?>>☐試着未
								</option>
								<option value="1"
									<?php if($_SESSION["cos_fitting"]==1) {echo "selected";}; ?>>☑試着済
								</option>
							</select>
						</td>
						<td class="todo">衣装試着予約</td>
						<td class="limit">お早めに</td>
					</tr>
					<tr>
						<td class="check"><?php echo $estimate; ?></td>
						<td class="todo">見積り書発行</td>
						<td class="limit">ご契約時にお渡し</td>
					</tr>
				</table>
				
				<p><input type="submit" value="情報更新"></p>
			</form>

				
			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>



