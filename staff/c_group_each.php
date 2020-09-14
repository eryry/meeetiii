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

//GETのグループIDをセッションに格納
if(!empty($_GET["group_id"]))	$_SESSION["group_id"]=$_GET["group_id"];


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
//$_SESSION["s_id"]        =$resg["s_id"]; s_idは格納しちゃうと、ログインs_idとの兼ね合いでだめなので、変数のまま。

//担当者表示用
if(!empty($resg["s_id"])){
	$staffData=$obj->getStaffById($resg["s_id"]);
}

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
$row = $obj->getGroomBrideGrouopByGId($_SESSION["group_id"]);

//カスタマー情報をC_IDから取得 新郎
$g_data=$obj->getCustomerById($row["g_id"]);
//カスタマー情報をC_IDから取得 新婦
$b_data=$obj->getCustomerById($row["b_id"]);

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
			<h1>お客様個別ページ</h1>
			<section>
				<h2>顧客グループID： <?php echo intVal($_SESSION["group_id"]);?></h2>
				<p>撮影プラン: <?php echo h($_SESSION["p_name"]); ?></p>
				<p>撮影予約日: <?php echo h($rd); ?></p>
				<p>当日お支度開始時間: <?php echo h($time); ?></p>
				<p>担当スタッフ: <?php if(!empty($staffData["s_name"])) echo h($staffData["s_name"]); ?></p>
			

				<br>
				<p>グループ登録情報<span class="update_btn"><a href="c_group_update.php?group_id=<?php echo intVal($_SESSION["group_id"]);?>">顧客グループ情報更新ページへ</a></span></p>
				
				<table class="list_noborder">		
					<tr>
						<th>新居</th>
						<td>〒<?php echo h($new_zip); ?><br>
							<?php echo h($new_address); ?>
						</td>
					</tr>
					<tr>
						<th>新郎</th>
						<td>
						名前：<?php echo h($row["g_name"]); ?><br>
						電話：<?php echo h($g_data["c_tell"]); ?><br>
						Mail：<?php echo h($g_data["c_mail"]); ?><br>
						住所：〒<?php echo h($g_data["c_zip"]); ?>　<?php echo h($g_data["c_address"]); ?><br>
						</td>
					</tr>
					<tr>
						<th>新婦</th>
						<td>
						名前：<?php echo h($row["b_name"]); ?><br>
						電話：<?php echo h($b_data["c_tell"]); ?><br>
						Mail：<?php echo h($b_data["c_mail"]); ?><br>
						住所：〒<?php echo h($b_data["c_zip"]); ?>　<?php echo h($b_data["c_address"]); ?><br>
						</td>
					</tr>
				</table>
				
				<p>進捗状況<span class="update_btn"><a href="c_group_each_mane.php?group_id=<?php echo intVal($_SESSION["group_id"]);?>">マネジメント（スケジュール）ページへ</a></span></p>
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
<?php include("footer_for_staffpage.php"); ?>



