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

$groups=$obj->getLimitOverBySId($_SESSION["s_id"]);
$rows =$obj->getGroomBrideGrouopAllDate();

$staff=$obj->getStaffById($_SESSION["s_id"]);

$msgs=$obj->getMessage();

?>

<?php require_once("header_for_staff.php"); ?>
		<main>
			<h1>スタッフ用TOP</h1>
			<section>
			<p>ログイン中のスタッフ名: <?php echo h($_SESSION["s_name"]);?></p>
			<?php if(empty($groups)) echo "担当顧客で期限超過ありのお客様はありません";?>
			
			<?php if(!empty($groups)): ?>
			</section>
			<section>
			<h2>期限超過がある担当のお客様の一覧</h2><br>
				<div id="mainView" class="table-scroll">
					<table class="list c_gropup_list c_list">
						<tr class="c_group_list_head">
							<th class="list_id_num"><p>ID</p></th><th class="list_id_num"><p>連絡</p></th><th class="list_id_num"><p class="font_mini">見積書<br>請求書</p></th>
							<th class="list_r_day"><p>予約日</p></th><th class="list_c_name"><p>新郎名</p></th><th class="list_c_name"><p>新婦名</p></th>
							<th class="list_board_notice"><p>連絡note投稿状況</p></th>
						</tr>
						<?php while($row=$rows->fetch(PDO::FETCH_ASSOC)): ?>
						<?php foreach($groups as $group): ?>
						<?php if(!empty($groups) && $row["limit_over"]==1 && $row["group_id"]==$group["c_group_id"]): ?>
						<tr>
							<td class="list_id_num c_group_list_head"><p><a href="c_group_each.php?group_id=<?php echo $row["group_id"];?>" ><?php echo $row["group_id"];?></a></p></td>
							<td class="list_id_num"><p><a href="../customer/c_board.php?group_id=<?php echo $row["group_id"];?>"><i class="far fa-clipboard"></i></a></p></td>
							<td class="list_id_num"><p><a href="../customer/c_paymentdata.php?group_id=<?php echo $row["group_id"];?>"><i class="far fa-file-alt"></i></a></p></td>
							<td class="list_r_day"><p><?php 
								// 撮影予約日の表示（曜日も日本語で）
								$reserve_day = $row["reserve_day"];
								$week = ["日","月","火","水","木","金","土"];
								$hi = date('w', strtotime($reserve_day));
								$youbi = $week[$hi];
								$rd =  date('Y年n月j日', strtotime($reserve_day))."(".$youbi.")";
								echo h($rd); 
							?></p></td>
							<td class="list_c_name"><p><?php echo h($row["g_name"]); ?></p></td>
							<td class="list_c_name"><p><?php echo h($row["b_name"]); ?></p></td>
							<td class="list_board_notice">
								<?php $b_data = $obj->getBoardNewCreatedDate($row["group_id"]); ?>
								<?php if(!empty($b_data)): ?>
								<p><a href="../customer/c_board.php?group_id=<?php echo $row["group_id"];?>">date:
								<?php echo date("Y/m/d H:i",strtotime($b_data["created"]))."&nbsp&nbsp"; ?> 
								name:<?php 
								$c_data = $obj->getGroomBrideGrouopByGId($row["group_id"]);
								if($b_data["submit_member_id"]== $c_data["g_id"]){
									echo h($c_data["g_name"]);
								}else if($b_data["submit_member_id"]== $c_data["b_id"]){
									echo h($c_data["b_name"]);
								}else{
									// 最新投稿者名がスタッフだった場合用にスタッフ情報取得
									$s_id=$b_data["submit_member_id"];
									$staff_data=$obj->getStaffById($s_id);
									echo "スタッフ：".h($staff_data["s_name"]);
								}
								;?></a><p>
								<?php elseif(empty($b_data)): ?>
								<p>投稿はまだありません</p>
								<?php endif; ?>
							</td>
						</tr>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endwhile; ?>
					</table>
				</div>
				<?php endif; ?>
			</section>
			<section>
				<h2>各種登録リンク</h2>
				<div>
				<button class="update_btn"><a href="c_group_id_add.php">顧客グループ登録</a></button>
				<button class="update_btn"><a href="c_add.php">顧客個人登録</a></button>
				<button class="update_btn"><a href="plan_add.php">プラン登録</a></button>
				</div>
			</section>
			<?php if($staff["role"]==1): ?>
			<section>
				<h2>管理者用リンク</h2>
				<div>
				<button class="update_btn"><a href="message_list.php">メッセージ　登録・更新・一覧</a></button>
				<button class="update_btn"><a href="staff_add.php">スタッフ　登録・更新・一覧<a></button>
				</div>
			</section>
			<?php endif; ?>
		</main>
<?php require_once("footer_for_staffpage.php"); ?>
