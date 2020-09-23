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


//GETのグループIDをセッションに格納
if(!empty($_GET["group_id"])) $_SESSION["group_id"]=$_GET["group_id"];

//グループに登録されている予約情報をセッションに格納
$resg = $obj->getCustomerGrouopByGId($_SESSION["group_id"]);
$_SESSION["p_id"]        =$resg["p_id"];
$_SESSION["reserve_day"] =$resg["reserve_day"];
$_SESSION["reserve_time"]=$resg["reserve_time"];
$_SESSION["estimate"]    =$resg["estimate"];
$_SESSION["invoce"]      =$resg["invoce"];
$_SESSION["payment"]     =$resg["payment"];
$_SESSION["d_product"]   =$resg["d_product"];
$_SESSION["new_zip"]     =$resg["new_zip"];
$_SESSION["new_address"] =$resg["new_address"];
$_SESSION["before2days"] =$resg["before2days"];
$_SESSION["make_reh"]    =$resg["make_reh"];
$_SESSION["cos_fixed"]   =$resg["cos_fixed"];
$_SESSION["cos_fitting"] =$resg["cos_fitting"];
$_SESSION["place_fixed"] =$resg["place_fixed"];
//$_SESSION["s_id"]      =$resg["s_id"]; s_idは格納しちゃうと、ログインs_idとの兼ね合いでだめなので、変数のまま。

//担当者表示用
if(!empty($resg["s_id"])){
	$staffData=$obj->getStaffById($resg["s_id"]);
}
//期限確認用(overならover/over_s クラスつける）
//overときに、$limit_over_count +1する
$limit_over_count=0;
$s_day=$obj->getScheduleDateByGId($_SESSION["group_id"]);
$today = date('y-m-d');
$today=strtotime($today);
$s_day["before_2day"]=strtotime($s_day["before_2day"]);
$s_day["before_1week"]=strtotime($s_day["before_1week"]);
$s_day["before_2week"]=strtotime($s_day["before_2week"]);
$s_day["before_3week"]=strtotime($s_day["before_3week"]);
$s_day["before_1month"]=strtotime($s_day["before_1month"]);
if($_SESSION["before2days"]==0 && $today>$s_day["before_2day"]){
	$limit_b2day="over";
	$limit_over_count++;
}else{
	$limit_b2day="";
}
if($_SESSION["payment"]==0 && $today>$s_day["before_1week"]){
	$limit_payment="over";
	$limit_over_count++;
}else{
	$limit_payment="";
}
if($_SESSION["invoce"]==0 && $today>$s_day["before_3week"]){
	$limit_invoce="over_s";
	$limit_over_count++;
}else{
	$limit_invoce="";
}
if($_SESSION["make_reh"]==0 && $today>$s_day["before_3week"]){
	$limit_make_reh="over";
	$limit_over_count++;
}else{
	$limit_make_reh="";
}
if($_SESSION["cos_fixed"]==0 && $today>$s_day["before_1month"]){
	$limit_cos_fixed="over";
	$limit_over_count++;
}else{
	$limit_cos_fixed="";
}
if($_SESSION["place_fixed"]==0 && $today>$s_day["before_1month"]){
	$limit_place_fixed="over";
	$limit_over_count++;
}else{
	$limit_place_fixed="";
}
if($_SESSION["cos_fitting"]==0){
	$limit_cos_fitting="over";
	$limit_over_count++;
}else{
	$limit_cos_fitting="";
}
if($_SESSION["estimate"]==0){
	$limit_estimate="over_s";
	$limit_over_count++;
}else{
	$limit_estimate="";
}

//$limit_overが0の時は0じゃないとき、1をデータベースに登録する
if($limit_over_count==0){
	$limit_over=0;
}else{
	$limit_over=1;
}
$obj->updateLimitOver($_SESSION["group_id"],$limit_over);

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
	$before2days="☑確認済";
}
if($_SESSION["make_reh"]==0) {
	$make_reh="☐未実行";
}else {
	$make_reh="☑済/無";
}
if($_SESSION["cos_fixed"]==0) {
	$cos_fixed="☐未決定";
}else {
	$cos_fixed="☑決定済";
}
if($_SESSION["cos_fitting"]==0) {
	$cos_fitting="☐未試着";
}else {
	$cos_fitting="☑試着済";
}
if($_SESSION["place_fixed"]==0) {
	$place_fixed="☐未決定";
}else {
	$place_fixed="☑決定済";
}

//グループのp_id情報からプラン名、プラン衣装取ってきてセッションデータに格納
$resp=$obj->getPlanById($_SESSION["p_id"]);
$_SESSION["p_name"]=$resp["p_name"];
$_SESSION["p_wear"]=$resp["p_wear"];

//入力がない場合も想定した新居表示設定
if(empty($_SESSION["new_zip"])) {
	$new_zip="未定 又は 未入力";
}else {
	$new_zip=$_SESSION["new_zip"];
}
if(empty($_SESSION["new_address"])) {
	$new_address="未定 又は 未入力";
}else {
	$new_address=$_SESSION["new_address"];
}

//GIDから新郎、新婦の情報も取得
$c_data = $obj->getGroomBrideGrouopByGId($_SESSION["group_id"]);

//カスタマー情報をC_IDから取得 新郎
$g_data=$obj->getCustomerById($c_data["g_id"]);
//カスタマー情報をC_IDから取得 新婦
$b_data=$obj->getCustomerById($c_data["b_id"]);

//撮影予約日の表示（曜日も日本語で）
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
//時間表示
$time=date('H:i',strtotime($_SESSION["group_id"]));

//予約日から、2・3日前、2週間前、3週間前、1か月前の日付取得
$s_day=$obj->getScheduleDateByGId($_SESSION["group_id"]);
$b2d = date('w', strtotime($s_day["before_2day"]));
$b3d = date('w', strtotime($s_day["before_3day"]));
$b1w = date('w', strtotime($s_day["before_1week"]));
$b2w = date('w', strtotime($s_day["before_2week"]));
$b3w = date('w', strtotime($s_day["before_3week"]));
$b1m = date('w', strtotime($s_day["before_1month"]));
$a1m = date('w', strtotime($s_day["after_1month"]));
$a2m = date('w', strtotime($s_day["after_2month"]));

$b2dy=$week[$b2d];
$b3dy=$week[$b3d];
$b1wy=$week[$b1w];
$b2wy=$week[$b2w];
$b3wy=$week[$b3w];
$b1my=$week[$b1m];
$a1my=$week[$a1m];
$a2my=$week[$a2m];

$b2de =  date('Y年n月j日', strtotime($s_day["before_2day"]))."(".$b2dy.")";
$b3de =  date('Y年n月j日', strtotime($s_day["before_3day"]))."(".$b3dy.")";
$b1we =  date('Y年n月j日', strtotime($s_day["before_1week"]))."(".$b1wy.")";
$b2we =  date('Y年n月j日', strtotime($s_day["before_2week"]))."(".$b2wy.")";
$b3we =  date('Y年n月j日', strtotime($s_day["before_3week"]))."(".$b3wy.")";
$b1me =  date('Y年n月j日', strtotime($s_day["before_1month"]))."(".$b1my.")";
$a1me =  date('Y年n月j日', strtotime($s_day["after_1month"]))."(".$a1my.")";
$a2me =  date('Y年n月j日', strtotime($s_day["after_2month"]))."(".$a2my.")";

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>お客様個別ページ</h1>
			<section>
				<h2>顧客グループID： <?php echo intVal($_SESSION["group_id"]);?></h2>
				<p>撮影プラン: <?php echo h($_SESSION["p_name"]); ?></p>
				<p>撮影予約日: <?php echo h($rd); ?></p>
				<p>当日お支度開始時間: <?php echo h($time); ?></p>
				<p>お客様名： <?php echo h($c_data["g_name"])."様・".h($c_data["b_name"])."様";	?> </p>
				<p>担当スタッフ: <?php if(!empty($staffData["s_name"])) echo h($staffData["s_name"]); ?></p>
			
			</section>
			<section>
				<h2>グループ登録情報</h2><br>
				<button class="update_link"><a href="c_group_update.php?group_id=<?php echo intVal($_SESSION["group_id"]);?>">顧客グループ情報更新ページへ</a></button>
				
				<table class="list c_group_each_table c_top">
					<tr>
						<th><p>新居</p></th>
						<td><p>〒<?php echo h($new_zip); ?><br>
							<?php echo h($new_address); ?></p>
						</td>
					</tr>
					<tr>
						<th><p>新郎</p></th>
						<td>
							<p>名前：<?php echo h($c_data["g_name"]); ?></p>
							<p>電話：<?php echo h($g_data["c_tell"]); ?></p>
							<p>Mail：<?php echo h($g_data["c_mail"]); ?></>
							<p>住所：〒<?php echo h($g_data["c_zip"]); ?>　<?php echo h($g_data["c_address"]); ?></p>
						</td>
					</tr>
					<tr>
						<th><p>新婦</p></th>
						<td>
							<p>名前：<?php echo h($c_data["b_name"]); ?></p>
							<p>電話：<?php echo h($b_data["c_tell"]); ?></p>
							<p>Mail：<?php echo h($b_data["c_mail"]); ?></p>
							<p>住所：〒<?php echo h($b_data["c_zip"]); ?>　<?php echo h($b_data["c_address"]); ?></p>
						</td>
					</tr>
				</table>
			</section>
			
			<section>
				<h2>進捗状況</h2><p><span class="limit_over"></p></span><br>
				<button class="update_link"><a href="c_group_each_mane.php?group_id=<?php echo intVal($_SESSION["group_id"]);?>">マネジメント（スケジュール）ページへ</a></button>
				
				<table class="list schedule schedule_s">
					<tr>
						<th class="check"><p>未・済</p></th><th class="todo"><p>管理項目</p></th><th class="limit"><p>期日</p></th>
					</tr>
					<tr class="has_limit <?php echo $limit_d_product; ?>">
						<td class="check"><p><?php echo $d_product; ?></p></td><td class="todo"><p>商品納品</p></td>
						<td class="limit"><p>データのみ：1か月後<?php echo h($a1me); ?><br>アルバム：2か月後<?php echo h($a2me); ?></p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_before2days; ?>">
						<td class="check"><p><?php echo $before2days; ?></p></td><td class="todo"><p>撮影判断</p></td><td class="limit"><p>2日前：<?php echo h($b2de); ?></p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_payment; ?>">
						<td class="check"><p><?php echo $payment; ?></p></td><td class="todo"><p>お支払い</p></td><td class="limit"><p>1週間前：<?php echo h($b1we); ?>までに</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_invoce; ?>">
						<td class="check"><p><?php echo $invoce; ?></p></td><td class="todo"><p>請求書発行</p></td><td class="limit"><p>3週間前：<?php echo h($b3we); ?>頃までに</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_make_reh; ?>">
						<td class="check"><p><?php echo $make_reh; ?></p></td><td class="todo"><p>リハーサル</p></td><td class="limit"><p>3週間前：<?php echo h($b3we); ?>頃までに</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_place_fixed; ?>">
						<td class="check"><?php echo $place_fixed; ?></td><td class="todo">撮影場所決定</td><td class="limit"><p>1か月前：<?php echo h($b1me); ?>頃までに</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_cos_fixed; ?>">
						<td class="check"><p><?php echo $cos_fixed; ?></p></td><td class="todo"><p>衣装決定</p></td><td class="limit"><p>1か月前：<?php echo h($b1me); ?>頃までに</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_cos_fitting; ?>">
						<td class="check"><p><?php echo $cos_fitting; ?></p></td><td class="todo"><p>衣装試着予約</p></td><td class="limit"><p>お早めに</p></td>
					</tr>
					<tr class="has_limit <?php echo $limit_estimate; ?>">
						<td class="check"><p><?php echo $estimate; ?></p></td><td class="todo"><p>見積り書発行</p></td><td class="limit"><p>ご契約時にお渡し</p></td>
					</tr>
				</table>
				
			</section>
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
