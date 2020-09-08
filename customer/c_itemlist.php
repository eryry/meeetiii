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

?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>持ち物リスト</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				
				<div>
					<p>プラン情報取得してきて、衣裳種類に合わせて表示する内容変えるエリア</p>
					
					<?php if($_SESSION["p_wear"]=="kimono"): ?>
					<h3>和装用持ち物リスト</h3>
					<p class="u_line">新婦様用</p>
						<ul>
							<li>□肌襦袢（上下つながっているものでも可）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
							<li>□前開きの服（上）　※ヘアメイク後にお洋服を脱ぐため、崩れないように。</li>
						</ul>
					<p class="u_line">新郎様用</p>
						<ul>
							<li>□着物用肌着上下（上は首元が大きく開いているタイプ）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
						</ul>
					<?php endif; ?>
					
					<?php if($_SESSION["p_wear"]=="dress"): ?>
					<h3>洋装用持ち物リスト</h3>
					<p class="u_line">新婦様用</p>
						<ul>
							<li>□ストッキング（ひざ下でもOK）</li>
							<li>□ドレスインナー</li>
							<li>□前開きの服（上）　※ヘアメイク後にお洋服を脱ぐため、崩れないように。</li>
						</ul>
					<p class="u_line">新郎様用</p>
						<ul>
							<li>□靴下（タキシード・靴の色に合わせてご準備ください）</li>
							<li>□肌着（シャツの下にきるもの）</li>
						</ul>
					<?php endif; ?>
					
					<?php if($_SESSION["p_wear"]=="both"): ?>
					<h3>洋装&和装用　持ち物リスト</h3>
					<p class="u_line">新婦様用</p>
						<ul>
							<li>□肌襦袢（上下つながっているものでも可）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
							<li>□ストッキング（ひざ下でもOK）</li>
							<li>□ドレスインナー</li>
							<li>□前開きの服（上）　※ヘアメイク後にお洋服を脱ぐため、崩れないように。</li>
						</ul>
					<p class="u_line">新郎様用</p>
						<ul>
							<li>□着物用肌着上下（上は首元が大きく開いているタイプ）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
							<li>□靴下（タキシード・靴の色に合わせてご準備ください）</li>
							<li>□肌着（シャツの下にきるもの）</li>
						</ul>
					<?php endif; ?>
					
					<p class="u_line">おふたり用</p>
						<ul>
							<li>□指輪（撮影時に手元写真希望の場合）</li>
							<li>□軽食（撮影準備―撮影時間にお昼を挟む場合・簡単に食べれるものがおすすめ。））</li>
						</ul>
				<div>
				
			</section>
			<section class="second">
				<div>
					<p>お客様がご自身で投稿してリスト追加できるエリア</p>
					<form action="exec_listitem_add.php" method="post">
						<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
						<p>追加アイテム<input type="text" name="list_item" id=""><button class="add_list_btn" type="submit" value="リストに追加">リストに追加</button></p>
					</form>
			</section>
			<section>
					<p class="u_line">追加アイテムリスト</p>
					<table class="list_noborder row2">
					<?php foreach($rows as $row): ?>
						<form action="exec_delete_item.php" method="post">
							<tr>
								<td>□<?php echo h($row["list_item"]); ?></td>
								<td><button class="del_btn" type="submit" value="削除する">リストから削除</button></td>
								<input type="hidden" name="list_id" value="<?php echo $row["list_id"]; ?>">
							</tr>
						</form>
					<?php endforeach; ?>
					</table>
				<div>
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


