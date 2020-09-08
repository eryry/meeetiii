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

//グループIDから、グループに登録されている予約情報をセッションに格納
$resg = $obj->getCustomerGrouopByGId($_GET["group_id"]);
$_SESSION["reserve_day"] =$resg["reserve_day"];
$_SESSION["reserve_time"]=$resg["reserve_time"];
$_SESSION["estimate"]    =$resg["estimate"];
$_SESSION["invoce"]      =$resg["invoce"];
$_SESSION["payment"]     =$resg["payment"];
$_SESSION["d_product"]   =$resg["d_product"];
$_SESSION["new_zip"]     =$resg["new_zip"];
$_SESSION["new_address"] =$resg["new_address"];
$_SESSION["p_id"] 			 =$resg["p_id"];

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

//撮影予約日の表示（曜日も日本語で）
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

//時間表示
$time=date('H:i',strtotime($_GET["group_id"]));

//GIDから新郎、新婦の情報も取得
$row = $obj->getGroomBrideGrouopByGId($_GET["group_id"]);

//カスタマー情報をC_IDから取得 新郎
$g_data=$obj->getCustomerById($row["g_id"]);
//カスタマー情報をC_IDから取得 新婦
$b_data=$obj->getCustomerById($row["b_id"]);

?>

<?php require_once("header_for_staff.php"); ?>

		<main>
			<h1>お客様個別ページ</h1>
			<section>
			<h2>顧客グループID：<?php echo intVal($_GET["group_id"]);?></h2>
			
				<table class="list_noborder">
					<tr>
						<th>撮影予約日</th><td><?php echo h($rd); ?></td>
					</tr>
					<tr>
						<th>予約来店時間</th><td><?php echo h($time); ?></td>
					</tr>
					<tr>
						<th>撮影プラン</th><td><?php echo h($_SESSION["p_name"]); ?></td>
					</tr>			
				</table>
				<br>
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
				
				<p><a href="c_group_update.php?group_id=<?php echo intVal($_GET["group_id"]);?>">顧客グループ情報更新ページへ</a></p>
				
				<p><a href="c_group_each_mane.php?group_id=<?php echo intVal($_GET["group_id"]);?>">マネジメント（スケジュール）ページへ</a></p>
				
			
			</section>
		</main>
<?php include("footer_for_staffpage.php"); ?>



