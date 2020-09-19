<?php
session_start();
if(empty($_SESSION["c_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
require_once("../class/meeting.class.php");
$obj= new Meeting();

function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}

$reserve_day = $_SESSION["reserve_day"];
//撮影予約日の表示（曜日も日本語で）
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";

$c_id = $_SESSION["c_id"];
$row  = $obj->getCustomerById($c_id);

$c_group_id  = $row["c_group_id"];
//$reserve_day = $row["reserve_day"];
//$reserve_time= $row["reserve_time"];
$c_name = $row["c_name"];
//$c_pass = $row["c_pass"];
$c_tell = $row["c_tell"];
$c_mail = $row["c_mail"];
$c_zip  = $row["c_zip"];
$c_address=$row["c_address"];
$c_gender=$row["c_gender"];
$c_myphoto=$row["c_myphoto"];

if(empty($c_tell)) $c_tell="未入力";
if(empty($c_zip)) $c_zip="未入力";
if(empty($c_zip)) $c_zip="未入力";

?>

<?php require_once("header_for_customer.php"); ?>

<main>
	<h1>個人ページTOP</h1>
	<section>
	<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
	<p>撮影予約日： <?php echo h($rd);	?> </p>
	<p>撮影プラン： <?php echo h($_SESSION["p_name"]);	?> </p>
		<table class="c_top">
			<tr>
				<th>グループID</th>
				<td><?php echo $c_group_id; ?></td>
			</tr>
			<tr>
				<th>顧客ID</th>
				<td><?php echo $c_id; ?></td>
			</tr>
			<!--
			<tr>
				<th>予約日</th>
				<td><?php echo $reserve_day; ?></td>
			</tr>
			<tr>
				<th>予約日来店時間</th>
				<td><?php echo $reserve_time; ?></td>
			</tr>
			-->
			
			<tr>
				<th>お客様名</th>
				<td><?php echo h($c_name); ?></td>
			</tr>
			<tr>
				<th>パスワード</th>
				<!-- お客様更新可能ページで、パスワード変更できるようにしたほうがよい？ -->
				<td>※非表示</td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td><?php echo h($c_tell); ?></td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td><?php echo h($c_mail); ?></td>
			</tr>
			<tr>
				<th>郵便番号</th>
				<td><?php echo h($c_zip); ?></td>
			</tr>
			<tr>
				<th>住所</th>
				<td><?php echo h($c_address); ?></td>
			</tr>
			<tr>
				<th>新郎/新婦 区分</th>
				<td>
				<?php if($c_gender==0) {echo "新郎";}; ?>
				<?php if($c_gender==1) {echo "新婦";}; ?>
				</td>
			</tr>
			<tr>
				<th>登録画像</th>
				<td class="c_photo">
				<?php if($c_myphoto==0) {echo "未投稿";}; ?>
				<?php if($c_myphoto==1): ?>
				<img src="../image/upload/c_myphoto/<?php echo $c_id.".jpg"; ?>">
				<?php endif; ?>
				</td>
			</tr>
		</table>
		
		
	</section>	
	<section>
		<button  class="update_btn"><a href="c_update.php">個人登録情報更新ページへ</a></button>
	</section>
</main>
<?php include("footer_for_customerpage.php"); ?>
