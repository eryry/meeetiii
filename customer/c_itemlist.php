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
$list_data=$obj->getItemListByGId($_SESSION["c_group_id"]);


//予約日表示用
$reserve_day = $_SESSION["reserve_day"];
$week = ["日","月","火","水","木","金","土"];
$hi = date('w', strtotime($reserve_day));
$youbi = $week[$hi];
$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
//予約プラン名表示用
$r = $obj->getGroomBrideGrouopByGId($_SESSION["c_group_id"]);

?>

<?php require_once("header_for_customer.php"); ?>

		<main>
			<h1>持ち物リスト</h1>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p>撮影プラン： <?php echo h($r["p_name"]);	?> </p>
				
				<div class="itemlist_cos">
					
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
			<section class="second toukou">
				<div>
					<p>ふたり専用アイテムリスト</p>
					<form action="exec_listitem_add.php" method="post">
						<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
						<p>追加アイテム</p>
						<p><input type="text" name="list_item" id="list_item"><button class="add_list_btn" type="submit" value="リストに追加">リストに追加</button></p>
					</form>
			</section>
			<section class="itemllist_sub second">
					<p class="u_line">追加アイテムリスト</p>
					<table class="list_noborder row2">
					<?php foreach($list_data as $item): ?>
						<form action="exec_delete_item.php" method="post" class="del">
							<tr>
								<input type="hidden" name="list_id" value="<?php echo $item["list_id"]; ?>">
								<td><p class="each_item">□<?php echo h($item["list_item"]); ?></p></td>
								<td><button class="del_btn" type="submit" value="削除する">リストから削除</button></td>
							</tr>
						</form>
					<?php endforeach; ?>
					</table>
				<div>
				
			</section>
		</main>
		<?php include("footer_for_customerpage.php"); ?>


