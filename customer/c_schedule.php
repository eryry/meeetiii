<?php
session_start();
if(empty($_SESSION["c_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

$resg = $obj->getCustomerGrouopByGId($_SESSION["c_group_id"]);
$_SESSION["reserve_day"] =$resg["reserve_day"];

// 予約日表示用
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

$c_data = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);

// 予約日から、2・3日前、2週間前、3週間前、1か月前の日付取得
$s_day=$obj->getScheduleDateByGId($_SESSION["c_group_id"]);
$b2d = date('w', strtotime($s_day["before_2day"]));
$b3d = date('w', strtotime($s_day["before_3day"]));
$b1w = date('w', strtotime($s_day["before_1week"]));
$b2w = date('w', strtotime($s_day["before_2week"]));
$b3w = date('w', strtotime($s_day["before_3week"]));
$b1m = date('w', strtotime($s_day["before_1month"]));
$b2dy=$week[$b2d];
$b3dy=$week[$b3d];
$b1wy=$week[$b1w];
$b2wy=$week[$b2w];
$b3wy=$week[$b3w];
$b1my=$week[$b1m];
$b2de =  date('Y年n月j日', strtotime($s_day["before_2day"]))."(".$b2dy.")";
$b3de =  date('Y年n月j日', strtotime($s_day["before_3day"]))."(".$b3dy.")";
$b1we =  date('Y年n月j日', strtotime($s_day["before_1week"]))."(".$b1wy.")";
$b2we =  date('Y年n月j日', strtotime($s_day["before_2week"]))."(".$b2wy.")";
$b3we =  date('Y年n月j日', strtotime($s_day["before_3week"]))."(".$b3wy.")";
$b1me =  date('Y年n月j日', strtotime($s_day["before_1month"]))."(".$b1my.")";

// 期限確認用(overならover/over_s クラスつける）
$s_day=$obj->getScheduleDateByGId($_SESSION["c_group_id"]);
$today = date('y-m-d');
$today=strtotime($today);
$s_day["before_2day"]=strtotime($s_day["before_2day"]);
$s_day["before_1week"]=strtotime($s_day["before_1week"]);
$s_day["before_2week"]=strtotime($s_day["before_2week"]);
$s_day["before_3week"]=strtotime($s_day["before_3week"]);
$s_day["before_1month"]=strtotime($s_day["before_1month"]);
if($_SESSION["before2days"]==0 && $today>$s_day["before_2day"]){
	$limit_b2day="over";
}else{
	$limit_b2day="";
}
if($_SESSION["payment"]==0 && $today>$s_day["before_1week"]){
	$limit_payment="over";
}else{
	$limit_payment="";
}
if($_SESSION["invoce"]==0 && $today>$s_day["before_3week"]){
	$limit_invoce="over_s";
}else{
	$limit_invoce="";
}
if($_SESSION["make_reh"]==0 && $today>$s_day["before_3week"]){
	$limit_make_reh="over";
}else{
	$limit_make_reh="";
}
if($_SESSION["cos_fixed"]==0 && $today>$s_day["before_1month"]){
	$limit_cos_fixed="over";
}else{
	$limit_cos_fixed="";
}
if($_SESSION["place_fixed"]==0 && $today>$s_day["before_1month"]){
	$limit_place_fixed="over";
}else{
	$limit_place_fixed="";
}
if($_SESSION["cos_fitting"]==0){
	$limit_cos_fitting="over";
}else{
	$limit_cos_fitting="";
}
if($_SESSION["estimate"]==0){
	$limit_estimate="over_s";
}else{
	$limit_estimate="";
}

// 未・完了表示
if($_SESSION["estimate"]==0) {
	$estimate="☐ 未発行";
}else {
	$estimate="☑ 発行済";
}
if($_SESSION["invoce"]==0) {
	$invoce="☐ 未発行";
}else {
	$invoce="☑ 発行済";
}
if($_SESSION["payment"]==0) {
	$payment="☐ 支払未";
}else {
	$payment="☑ 支払済";
}
if($_SESSION["d_product"]==0) {
	$d_product="☐ 納品未";
}else {
	$d_product="☑ 納品済";
}
if($_SESSION["before2days"]==0) {
	$before2days="☐確認未";
}else {
	$before2days="☑ 確認済";
}
if($_SESSION["make_reh"]==0) {
	$make_reh="☐ 未実行";
}else {
	$make_reh="☑ 済/無";
}
if($_SESSION["cos_fixed"]==0) {
	$cos_fixed="☐ 未決定";
}else {
	$cos_fixed="☑ 決定済";
}
if($_SESSION["cos_fitting"]==0) {
	$cos_fitting="☐ 未試着";
}else {
	$cos_fitting="☑ 試着済";
}
if($_SESSION["place_fixed"]==0) {
	$place_fixed="☐ 未決定";
}else {
	$place_fixed="☑ 決定済";
}
?>

<?php require_once("header_for_customer.php"); ?>
		<main>
			<div id="title_wrapper">
				<h1>スケジュール<br><span class="font_mini_no_padding">schedule</span></h1>
			<h1 class="u_line"></h1>
			</div>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($c_data["p_name"]);	?> </p>
			</section>
			<section>
				<img src="../image/icon-bird02.png" class="fuwafuwa"><img src="../image/icon-bird02.png" class="fuwafuwa_mini"><h2>進捗状況</h2><img src="../image/photoplan-title-icon02.png" class="fuwafuwa2">
				<p><span class="limit_over"></span></p>
				<div class="remark">
					<p class="font_mini">※下記は一般的なスケジュールです。ご予約いただくタイミングやお住い（遠方等）など、おふたりのご事情にあわせてアレンジいたします。</p>
				</div>
				<br>
				<table class="list_noborder schedule">
					<tr>
						<th class="check">管理項目</th><th class="todo">未・済</th><th class="limit">期日</th>
					</tr>
					<tr class="has_limit <?php echo $limit_d_product; ?>">
						<td class="check" rowspan="2">商品の<br class="sp_only">お届け</td>
						<td class="todo"><?php echo $d_product; ?></td>
						<td class="limit">データのみ：1か月後<br>アルバム：2か月後</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2">
							<div class="td_detail_wrap">
								<span class="td_detail_trigger"></span>
								<div class="td_detail_item">
									<p class="font_mini2">「データのみ」の場合は、撮影日から約１ヵ月でデータが完成します。<br>
									「アルバム付き」の場合は、撮影日から約2ヵ月で完成します。<br>
									お急ぎの方は「データ特急仕上げ」のオプションがありますので、ご相談ください。<br>
									お届け先新居（新居未定の方はお届け先住所）の入力が未入力の場合は、お届け先確認後の発送になりますので、事前にご入力いただくとスムーズにお届けできます。</p>
								</div>
							</div>
						</td>
					</tr>
					<tr class="has_limit <?php echo $limit_before2days; ?>">
						<td class="check" rowspan="2">撮影決行<br class="sp_only">判断</td>
						<td class="todo"><?php echo $before2days; ?></td>
						<td class="limit"><?php echo h($b2de); ?></td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2">
						<p class="font_mini2">屋外ロケ撮影プランの場合は、天候不順による日延べを無料で対応しております。ご希望の場合は必ず撮影2日前18時までにご連絡ださい。</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_payment; ?>">
						<td class="check">お支払い</td>
						<td class="todo"><?php echo $payment; ?></td>
						<td class="limit"><?php echo h($b2we); ?>までに</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2"><p class="font_mini2">撮影予約日1週間前までに、残金をお振込み頂きます。</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_invoce; ?>">
						<td class="check">請求書<br class="sp_only">発行</td>
						<td class="todo"><?php echo $invoce; ?></td>
						<td class="limit"><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2">
							<div class="td_detail_wrap">
								<span class="td_detail_trigger"></span>
								<div class="td_detail_item">
									<p class="font_mini2">ご注文内容確定次第、請求書を発行いたします。<br>
									請求書は、<a href="c_paymentdata.php">見積・請求書ページ<a/>からご確認いただけます。<a href="c_group_top.php">おふたりTOPページ</a>のお知らせ欄でも請求書発行有無の確認ができます。</p>
								</div>
							</div>
						</td>
					</tr>
					<tr class="has_limit <?php echo $limit_make_reh; ?>">
						<td class="check">ヘアメイク<br class="sp_only">リハーサル</td>
						<td class="todo"><?php echo $make_reh; ?></td>
						<td class="limit"><?php echo h($b3we); ?>頃までに</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2">
						<div class="td_detail_wrap">
							<span class="td_detail_trigger"></span>
							<div class="td_detail_item">
								<p class="font_mini2">ヘアメイクリハーサルもご予約可能です。当日の担当スタイリストとスケジュール調整し予約をお取りします。<br>
								リハーサルのご希望が無い場合は、事前にご希望イメージの画像を掲示板に投稿してお知らせ下さい。ご希望イメージ画像を元に当日ヘア＆メイクさせていただきます。</p>
							</div>
						</div>
						</td>
					</tr>
					<tr class="has_limit <?php echo $limit_place_fixed; ?>">
						<td class="check">撮影場所<br class="sp_only">決定</td>
						<td class="todo"><?php echo $place_fixed; ?></td>
						<td class="limit"><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2"><p class="font_mini2">プランによりロケ地をおふたりで決めることができます。場所によっては事前に許可・申請が必要になります。早めにご希望をお知らせください。</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_cos_fixed; ?>">
						<td class="check">衣装決定</td>
						<td class="todo"><?php echo $cos_fixed; ?></td>
						<td class="limit"><?php echo h($b1me); ?>頃までに</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2"><p class="font_mini2">ここにもじもじ</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_cos_fitting; ?>">
						<td class="check">衣装試着<br class="sp_only">予約</td>
						<td class="todo"><?php echo $cos_fitting; ?></td>
						<td class="limit">お早めに</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo_detail" colspan="2">
						<div class="td_detail_wrap">
							<span class="td_detail_trigger"></span>
							<div class="td_detail_item">
								<p class="font_mini2">【事前来店可能な場合】<br>試着では衣装のサイズやお色味、デザインなどを見ていただきお気に入りの1着を見つけてください。
								試着をして、納得の1着を事前予約出来ます。人気のシーズン（桜や紅葉の時期）は日程や衣装の埋まりも早いため、早めのご試着・ご予約がおすすめです。<br>
								【事前来店が難しい場合】<br>遠方や直前予約など、事前来店が難しい方は、<a href="">HPの衣装ギャラリー</a>にてお選びいただけます。ご試着前でも第一希望の衣装を予約出来ます。<br>
								ご試着は撮影当日又は前日に行います。事前に選んだ第一希望含め、当日空きのある他の衣装も含め試着し、変更・決定することができます。</p>
							</div>
						</div>
						</td>
					</tr>
					<tr class="has_limit <?php echo $limit_estimate; ?>">
						<td class="check">見積書<br class="sp_only">発行</td>
						<td class="todo"><?php echo $estimate; ?></td>
						<td class="limit">ご契約時にお渡し</td>
					</tr>
					<tr class="has_limit need_line">
						<td class="check"></td><td class="todo" colspan="2"><p class="font_mini2">ここにもじもじ</p></td>
					</tr>
				</table>
			</section>
		</main>
<?php include("footer_for_customerpage.php"); ?>
