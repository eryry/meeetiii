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
$rows=$obj->getItemListByGId($_SESSION["c_group_id"]);
//print_r($rows);
?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>持ち物リスト</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<div>
					<p>プラン情報取得してきて、衣裳種類に合わせて表示する内容変えるエリア</p>
				<div>
				
			</section>
			<section class="second">
				<div>
					<p>お客様がご自身で投稿してリスト追加できるエリア</p>
					<form action="exec_listitem_add.php" method="post">
						<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
						<p>追加アイテム<input type="text" name="list_item" id=""><input type="submit" value="リストに追加"></p>
					</form>
					
					<p>追加したアイテムリスト表示エリア</p>
					<ul>
					<?php foreach($rows as $row): ?>
						<li>□<?php echo h($row["list_item"]); ?></li>
					<?php endforeach; ?>
					</ul>
				<div>
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


