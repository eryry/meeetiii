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

$c_group_id  = $row["c_group_id"];
//$reserve_day = $row["reserve_day"];
//$reserve_time= $row["reserve_time"];
$c_name = $row["c_name"];
$c_pass = $row["c_pass"];
$c_tell = $row["c_tell"];
$c_mail = $row["c_mail"];
$c_zip  = $row["c_zip"];
$c_address=$row["c_address"];
$c_gender=$row["c_gender"];
$c_myphoto=$row["c_myphoto"];

//print_r($row);
?>

<?php require_once("header_for_customer.php"); ?>

<main>
	<div id="title_wrapper">
		<h1>更新・確認<br><span class="font_mini_no_padding">my data</span></h1>
	</div>
	<section class="c_update">
	<h2 class="padding_top20">登録内容</h2>
		<form action="exec_c_update.php" method="post" enctype="multipart/form-data">
			<table class="c_update_table">
				<tr>
					<th><p>グループID</p></th>
					<td class="bgc_gray">
					<p><input type="hidden" name="c_group_id" value="<?php echo intVal($c_group_id);?>">
					<?php echo $c_group_id; ?></p></td>
				</tr>
				<tr>
					<th><p>顧客ID</p></th>
					<td class="bgc_gray">
					<p><input type="hidden" name="c_id" value="<?php echo h($c_id);?>">
					<?php echo $c_id; ?></p></td>
				</tr>
				
				<!--
				<tr>
					<th>予約日</th>
					<td class="bgc_gray">
					<input type="hidden" name="reserve_day" value="<?php echo h($reserve_day);?>">
					<?php echo $reserve_day; ?></td>
				</tr>
				<tr>
					<th>予約日来店時間</th>
					<td class="bgc_gray">
					<input type="hidden" name="reserve_time" value="<?php echo h($reserve_time);?>">
					<?php echo $reserve_time; ?></td>
				</tr>
				-->
				
				<tr>
					<th><p><label for="c_name">お客様名</label></p></th>
					<td><input type="text" name="c_name" id="c_name" value="<?php echo h($c_name); ?>"></td>
				</tr>
				<tr>
					<th><p><label for="c_pass">パスワード</label><span class="field-icon"><i toggle="password-field" class="fas fa-eye toggle-password"></i></span></p></th>
					<td>
					<p class="pass_area">
						<input type="password" autocomplete="current-password" name="c_pass" id="c_pass" value="" pattern="^[0-9A-Za-z]+$" placeholder="半角数字/アルファベットで入力ください">
						
					</p>
					</td>
				</tr>
				<tr>
					<th><p><label for="c_tell">電話番号</label></p></th>
					<td><input type="number" name="c_tell" id="c_tell" value="<?php echo h($c_tell); ?>" placeholder="半角数字で入力ください"></td>
				</tr>
				<tr>
					<th><p><label for="c_mail">メールアドレス</label></p></th>
					<td><input type="text" name="c_mail" id="c_mail" value="<?php echo h($c_mail); ?>"></td>
				</tr>
				<tr>
					<th><p><label for="zip">郵便番号</label></p></th>
					<td><input type="number" name="c_zip" id="zip" value="<?php echo h($c_zip); ?>" placeholder="半角数字で入力ください"></td>
				</tr>
				<tr>
					<th><p><label for="address">住所</label></p></th>
					<td><textarea name="c_address" id="address" value="<?php echo h($c_address); ?>"></textarea></td>
				</tr>
				<tr>
					<th><p><label for="c_gender">新郎/新婦</label></p></th>
					<td>
						<select name="c_gender">
							<option value="">お選びください</option>
							<option value="0" 
								<?php if($c_gender==0) {echo "selected";}; ?>>新郎
							</option>
							<option value="1"
								<?php if($c_gender==1) {echo "selected";}; ?>>新婦
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<th><p><label for="c_myphoto">登録画像</label><span class="font_mini">※円形にトリミングされます</span></p></th>
					<td><p class="font_mini c_photo">登録済み画像：<?php if($c_myphoto==1) echo "<img src=\"../image/upload/c_myphoto/{$c_id}.jpg\">";?></p>
						<p><input type="file" name="c_myphoto" id="c_myphoto" accept="image/jpeg, image/png" /></p>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
					</td>
				</tr>
			</table>
		
		<button><input class="sub_btn" type="submit" value="お客様情報更新"></button>
		</form>

	
	</section>
</main>
<?php include("footer_for_customerpage.php"); ?>



