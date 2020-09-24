<?php
session_start();
if(empty($_SESSION["c_id"]) && empty($_SESSION["s_id"])) {
	header("Location: ../index.php?err=no_login");
	exit();
}
function h($str) {
	return htmlspecialchars($str,ENT_QUOTES);
}
require_once("../class/meeting.class.php");
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
			<div id="title_wrapper">
				<h1>当日のお持ちもの<br><span class="font_mini_no_padding">item list</span></h1>
			</div>
			<section>
				<p>ログイン中のお名前：<?php echo h($_SESSION["c_name"]); ?></p>
				<p>撮影予約日： <?php echo h($rd);	?> </p>
				<p class="m_bottom_35">撮影プラン： <?php echo h($r["p_name"]);	?> </p>
			</section>
			<section>
				<img src="../image/photoplan-icon01.png" class="fuwafuwa4">
				<div class="itemlist_cos">
					<?php if($_SESSION["p_wear"]=="kimono"): ?>
					<h2>和装用持ち物リスト</h2>
					<div>
						<p class="itemlist_title">- 新婦様用 -</p>
						<ul>
							<li>□肌襦袢（上下つながっているものでも可）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
							<li>□前開きの服（上）　※ヘアメイク後にお洋服を脱ぐため、崩れないように。</li>
						</ul>
					</div>
					<div>
						<p class="itemlist_title">- 新郎様用 -</p>
						<ul>
							<li>□着物用肌着上下（上は首元が大きく開いているタイプ）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
						</ul>
					</div>
					<?php endif; ?>
					<?php if($_SESSION["p_wear"]=="dress"): ?>
					<h2>洋装用持ち物リスト</h2>
					<div>
						<p class="itemlist_title">- 新婦様用 -</p>
						<ul>
							<li>□ストッキング（ひざ下でもOK）</li>
							<li>□ドレスインナー</li>
							<li>□前開きの服（上）　※ヘアメイク後にお洋服を脱ぐため、崩れないように。</li>
						</ul>
					</div>
					<div>
						<p class="itemlist_title">- 新郎様用 -</p>
						<ul>
							<li>□靴下（タキシード・靴の色に合わせてご準備ください）</li>
							<li>□肌着（シャツの下にきるもの）</li>
						</ul>
					</div>
					<?php endif; ?>
					
					<?php if($_SESSION["p_wear"]=="both"): ?>
					<h2>洋装&和装用　持ち物リスト</h2>
					<div>
						<p class="itemlist_title">- 新婦様用 -</p>
						<ul>
							<li>□肌襦袢（上下つながっているものでも可）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
							<li>□ストッキング（ひざ下でもOK）</li>
							<li>□ドレスインナー</li>
							<li>□前開きの服（上）　※ヘアメイク後にお洋服を脱ぐため、崩れないように。</li>
						</ul>
					</div>
					<div>
						<p class="itemlist_title">- 新郎様用 -</p>
						<ul>
							<li>□着物用肌着上下（上は首元が大きく開いているタイプ）</li>
							<li>□足袋</li>
							<li>□タオル6枚（フェイスタオルサイズ・着付け時補正用）</li>
							<li>□靴下（タキシード・靴の色に合わせてご準備ください）</li>
							<li>□肌着（シャツの下にきるもの）</li>
						</ul>
					</div>
					<?php endif; ?>
					<div>
						<p class="itemlist_title">- おふたり用 -</p>
						<ul>
							<li>□指輪（撮影時に手元写真希望の場合）</li>
							<li>□軽食（撮影準備―撮影時間にお昼を挟む場合・簡単に食べれるものがおすすめ。）</li>
						</ul>
					</div>
				<div>
			</section>
			<section class="second toukou">
				<h2>ふたり専用アイテムリスト</h2>
				<form action="exec_listitem_add.php" method="post">
					<p><input type="hidden" name="c_group_id" id="" value="<?php echo $_SESSION["c_group_id"]; ?>"></p>
					<p>追加アイテム</p>
					<p><input type="text" name="list_item" id="list_item"><button class="add_list_btn" type="submit" value="リストに追加">リストに追加<i class="far fa-plus-square"></i></button></p>
				</form>
			</section>
			<section class="itemllist_sub">
				<h2>追加アイテムリスト</h2>
				<p><?php if(empty($list_data)) echo "追加アイテムリストはまだありません。"; ?></p>
				<ul class="list_noborder row2">
				<?php foreach($list_data as $item): ?>
					<form action="exec_delete_item.php" method="post" class="del" id="<?php echo 'form'.$item['list_id']; ?>">
						<li class="each_item">□<?php echo h($item["list_item"]); ?><button class="del_btn" type="submit" value="削除する">リストから削除<i class="far fa-minus-square"></i></button>
						</li>
						<input type="hidden" name="list_id" value="<?php echo $item["list_id"]; ?>">
					</form>
				<?php endforeach; ?>
				</ul>
			</section>
		</main>
		<script>
			$('.del').submit(function(){
				/*
				var form_id= '#'+$(this).attr('id');
				
				console.log(form_id);
				var item = $(this).attr('id').p.text();
				console.log(item);
				*/
				var res =confirm('本当に削除しますか？');
				if(res==true){
					return true;
				}else{
					return false;
				}
			});	
		</script>

<?php include("footer_for_customerpage.php"); ?>
