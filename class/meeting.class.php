<?php
class Meeting{
	public $pdo;

	public function __construct(){
		$host  = "localhost";
		$dbname= "meeting_app";
		$dbuser= "root";
		$dbpass= "";
		$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
		$this->pdo = new PDO($dsn,$dbuser,$dbpass);
	}

	//プラン登録
	public function planAdd($p_name,$p_wear){
		$sql = "INSERT INTO plans(p_name,p_wear) VALUES(:p_name,:p_wear)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":p_name",$p_name,PDO::PARAM_STR);
		$stmt->bindValue(":p_wear",$p_wear,PDO::PARAM_STR);
		$stmt->execute();
	}
	
	//スタッフ登録
	public function staffAdd($s_id,$s_name,$s_pass,$s_mail,$role) {
		$sql="INSERT INTO staff(s_id,s_name,s_pass,s_mail,role) VALUES(:s_id,:s_name,:s_pass,:s_mail,:role)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":s_id",$s_id,PDO::PARAM_STR);
		$stmt->bindValue(":s_name",$s_name,PDO::PARAM_STR);
		$stmt->bindValue(":s_pass",$s_pass,PDO::PARAM_STR);
		$stmt->bindValue(":s_mail",$s_mail,PDO::PARAM_STR);
		$stmt->bindValue(":role",$role,PDO::PARAM_INT);
		$stmt->execute();
	}
	
	//カスタマーグループ登録
	public function customerGroupAdd($c_group_id,$p_id,$reserve_day,$reserve_time,$new_zip,$new_address,$s_id) {
		$sql  ="INSERT INTO c_groups(c_group_id,p_id,reserve_day,reserve_time,new_zip,new_address,s_id) ";
		$sql .="VALUES(:c_group_id,:p_id,:reserve_day,:reserve_time,:new_zip,:new_address,:s_id)";
		$stmt= $this->pdo->prepare($sql);
		$stmt->bindvalue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->bindvalue(":p_id",$p_id,PDO::PARAM_INT);
		$stmt->bindvalue(":reserve_day",$reserve_day,PDO::PARAM_STR);
		$stmt->bindvalue(":reserve_time",$reserve_time,PDO::PARAM_STR);
		$stmt->bindvalue(":new_zip",$new_zip,PDO::PARAM_STR);
		$stmt->bindvalue(":new_address",$new_address,PDO::PARAM_STR);
		$stmt->bindvalue(":s_id",$s_id,PDO::PARAM_STR);
		$stmt->execute();
	}	
	
	//カスタマー登録
	public function customerAdd($c_group_id,$c_id,$c_name,$c_pass,$c_tell,$c_mail,$c_zip,$c_address,$c_gender) {
		$sql  ="INSERT INTO customers(c_group_id,c_id,c_name,c_pass,c_tell,c_mail,c_zip,c_address,c_gender) ";
		$sql .="VALUES(:c_group_id,:c_id,:c_name,:c_pass,:c_tell,:c_mail,:c_zip,:c_address,:c_gender)";
		$stmt= $this->pdo->prepare($sql);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->bindValue(":c_id",$c_id,PDO::PARAM_STR);
		$stmt->bindValue(":c_name",$c_name,PDO::PARAM_STR);
		$stmt->bindValue(":c_pass",$c_pass,PDO::PARAM_STR);
		$stmt->bindValue(":c_tell",$c_tell,PDO::PARAM_STR);
		$stmt->bindValue(":c_mail",$c_mail,PDO::PARAM_STR);
		$stmt->bindValue(":c_zip",$c_zip,PDO::PARAM_STR);
		$stmt->bindValue(":c_address",$c_address,PDO::PARAM_STR);
		$stmt->bindValue(":c_gender",$c_gender,PDO::PARAM_INT);
		$stmt->execute();
	}
	
	//お客様ページリストアイテム登録
	public function listItemAdd($c_group_id,$list_item){
		$sql = "INSERT INTO list(c_group_id,list_item) VALUES(:c_group_id,:list_item)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->bindValue(":list_item",$list_item,PDO::PARAM_STR);
		$stmt->execute();
	}
	
	//掲示板投稿機能(未完成　画像投稿なしでも 1が入っていてしまう。）
	public function submitBoard($c_group_id,$submit_member_id,$body,$board_photo){
		$sql  = "INSERT INTO board(c_group_id,submit_member_id,body,board_photo) ";
		$sql .= "VALUES(:c_group_id,:submit_member_id,:body,:board_photo)";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt ->bindValue(":submit_member_id",$submit_member_id,PDO::PARAM_STR);
		$stmt ->bindValue(":body",$body,PDO::PARAM_STR);
		$stmt ->bindValue(":board_photo",$board_photo,PDO::PARAM_INT);
		$stmt ->execute();
	}
	
	//掲示板投稿一覧をc_group_idにあわせて表示するこれは表示できるけど、スタッフ投稿が表示されない
	public function getBoardDataByGId($c_group_id) {
		$sql  = "SELECT b_id,body,created,submit_member_id,board_photo ";
		$sql .= "FROM board ";
		$sql .= "WHERE board.c_group_id=:c_group_id ORDER BY created DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
		$row =$stmt->fetchAll(PDO::FETCH_ASSOC);
		return  $row;
	}
	
	//アイテムリストお客様投稿分グループIDで取ってくる
	public function getItemListByGId($c_group_id) {
		$sql ="SELECT * FROM list WHERE c_group_id=:c_group_id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
		$row =$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $row;
	}
	
	//スタッフログイン
	public function staffLogin($s_id,$s_pass){
		$sql="SELECT * FROM staff WHERE s_id=:s_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":s_id",$s_id,PDO::PARAM_STR);
		$stmt ->execute();
		$row =$stmt->fetch(PDO::FETCH_ASSOC);
		$res  = password_verify($s_pass,$row["s_pass"]);
		if($res) {
			return $row;
		}else {
			return false;
		}
	}
	
	//カスタマーログイン
	public function customerLogin($c_id,$c_pass){
		$sql="SELECT * FROM customers WHERE c_id=:c_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":c_id",$c_id,PDO::PARAM_STR);
		$stmt->execute();
		$row =$stmt->fetch(PDO::FETCH_ASSOC);
		$res  = password_verify($c_pass,$row["c_pass"]);
		if($res) {
			return $row;
		}else {
			return false;
		}
	}
	
	//カスタマー情報をC_IDから取得
	public function getCustomerById($c_id){
		$sql = "SELECT * FROM customers WHERE c_id=:c_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":c_id",$c_id,PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	//スタッフ情報をS_IDから取得
	public function getStaffById($s_id){
		$sql = "SELECT * FROM staff WHERE s_id=:s_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":s_id",$s_id,PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	//スタッフ情報取得
	public function getStaff() {
		$sql="SELECT s_id,s_name FROM staff";
		$rs = $this->pdo->query($sql);
		return $rs;
	}

	//カスタマー情報更新
	
	
	//カスタマーグループ取得(顧客登録時のグループNo表示用）
	public function getCustomerGroup() {
		$sql="SELECT * FROM c_groups";
		$rs = $this->pdo->query($sql);
		return $rs;
	}
	
	//ログインした顧客ごとのグループIDからグループ情報取得
	public function getCustomerGrouopByGId($c_group_id) {
		$sql = "SELECT * FROM c_groups,customers ";
		$sql .="WHERE c_groups.c_group_id=customers.c_group_id ";
		$sql .="AND c_groups.c_group_id=:c_group_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	//顧客ごとのグループIDから、新郎・新婦の各情報とグループ情報をまとめて取得
	public function getGroomBrideGrouopByGId($c_group_id) {
		$sql  ="SELECT groom.c_name AS g_name,bride.c_name AS b_name,groom.c_id AS g_id,bride.c_id AS b_id, ";
		$sql .="reserve_day,reserve_time,estimate,invoce,payment,d_product,new_zip,new_address,p_name,plans.p_id ";
		$sql .="FROM customers AS groom,customers AS bride,c_groups,plans ";
		$sql .="WHERE c_groups.c_group_id=groom.c_group_id ";
		$sql .="AND c_groups.c_group_id=bride.c_group_id ";
		$sql .="AND c_groups.p_id=plans.p_id ";
		$sql .="AND groom.c_gender=0 AND bride.c_gender=1 ";
		$sql .="AND c_groups.c_group_id=:c_group_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	//新郎・新婦の各情報とグループ情報をまとめて取得して予約日順表示
	public function getGroomBrideGrouopAllDate() {
		$sql  ="SELECT groom.c_name AS g_name,bride.c_name AS b_name, ";
		$sql .="reserve_day,p_name,c_groups.c_group_id AS group_id,d_product,payment,limit_over ";
		$sql .="FROM customers AS groom,customers AS bride,c_groups,plans ";
		$sql .="WHERE c_groups.c_group_id=groom.c_group_id ";
		$sql .="AND c_groups.c_group_id=bride.c_group_id ";
		$sql .="AND c_groups.p_id=plans.p_id ";
		$sql .="AND groom.c_gender=0 AND bride.c_gender=1 ";
		$sql .="ORDER BY reserve_day";
		$row = $this->pdo->query($sql);
		return $row;
	}
	
	//新郎・新婦の各情報とグループ情報をまとめて取得して予約日順表示 JSON化
	public function getGroomBrideGrouopAllDateJSON() {
		$sql  ="SELECT groom.c_name AS g_name,bride.c_name AS b_name,reserve_day,p_name,c_groups.c_group_id AS group_id ";
		$sql .="FROM customers AS groom,customers AS bride,c_groups,plans ";
		$sql .="WHERE c_groups.c_group_id=groom.c_group_id ";
		$sql .="AND c_groups.c_group_id=bride.c_group_id ";
		$sql .="AND c_groups.p_id=plans.p_id ";
		$sql .="AND groom.c_gender=0 AND bride.c_gender=1 ";
		$sql .="ORDER BY reserve_day";
		$rows = $this->pdo->query($sql);
		$row = $rows->fetch(PDO::FETCH_ASSOC);
		$json=json_encode($row);
		return $json;
	}
	
	//お客様情報一覧情報取得
	public function getCustomerAllData() {
		$sql  = "SELECT customers.c_group_id,reserve_day,p_name,c_name,c_gender ";
		$sql .= "FROM c_groups,plans,customers ";
		$sql .= "WHERE c_groups.p_id=plans.p_id AND c_groups.c_group_id=customers.c_group_id ";
		$sql .= "ORDER BY reserve_day";
		$res  = $this->pdo->query($sql);
		return $res;
	}
	
	//プラン取得
	public function getPlan() {
		$sql="SELECT p_id,p_name,p_wear FROM plans";
		$rs = $this->pdo->query($sql);
		return $rs;
	}
	
	//プランIDからプラン情報取得
	public function getPlanById($p_id) {
		$sql="SELECT p_id,p_name,p_wear FROM plans WHERE p_id=:p_id";
		$stmt= $this->pdo->prepare($sql);
		$stmt ->bindValue(":p_id",$p_id,PDO::PARAM_INT);
		$stmt ->execute();
		$row =  $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	//スケジュール用に、G_IDの予約日から逆算日取得
	public function getScheduleDateByGId($c_group_id) {
	 $sql  ="SELECT reserve_day,DATE_ADD(reserve_day, INTERVAL -2 DAY) AS before_2day, ";
	 $sql .="DATE_ADD(reserve_day, INTERVAL -3 DAY) AS before_3day, ";
	 $sql .="DATE_ADD(reserve_day, INTERVAL -2 WEEK) AS before_2week, ";
	 $sql .="DATE_ADD(reserve_day, INTERVAL -3 WEEK) AS before_3week, ";
	 $sql .="DATE_ADD(reserve_day, INTERVAL -1 MONTH) AS before_1month, ";
	 $sql .="DATE_ADD(reserve_day, INTERVAL 1 MONTH) AS after_1month, ";
	 $sql .="DATE_ADD(reserve_day, INTERVAL 2 MONTH) AS after_2month ";
	 $sql .="FROM c_groups WHERE c_group_id=:c_group_id";
	 $stmt = $this->pdo->prepare($sql);
	 $stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
	 $stmt ->execute();
	 $row =  $stmt->fetch(PDO::FETCH_ASSOC);
	 return $row;
	}
	
	//スタッフが自分の担当のお客様で期限切れがあるGを取得
	public function getLimitOverBySId($s_id){
		$sql ="SELECT c_group_id FROM groups WHERE s_id=:s_id AND limit_over=1";
	 $stmt = $this->pdo->prepare($sql);
	 $stmt ->bindValue(":s_id",$s_id,PDO::PARAM_STR);
	 $stmt ->execute();
	 $row =  $stmt->fetch(PDO::FETCH_ASSOC);
	 return $row;
	}
	
	//プラン情報更新UPDATE
	public function planUpdate($p_id,$p_name,$p_wear){ 
		$sql="UPDATE plans SET p_name=:p_name,p_wear=:p_wear WHERE p_id=:p_id"; 
		$stmt=$this->pdo->prepare($sql);
		$stmt->bindValue(":p_name",$p_name,PDO::PARAM_STR);
		$stmt->bindValue(":p_wear",$p_wear,PDO::PARAM_STR);
		$stmt->bindValue(":p_id",$p_id,PDO::PARAM_INT);
		$stmt->execute();
	}
	
	//カスタマーグループ情報更新
	public function customerGroupUpdate($c_group_id,$p_id,$reserve_day,$reserve_time,$new_zip,$new_address,$s_id) {
		$sql  ="UPDATE c_groups SET p_id=:p_id,reserve_day=:reserve_day,reserve_time=:reserve_time, ";
		$sql .="new_zip=:new_zip,new_address=:new_address,s_id=:s_id ";
		$sql .="WHERE c_group_id=:c_group_id";
		$stmt= $this->pdo->prepare($sql);
		$stmt->bindvalue(":p_id",$p_id,PDO::PARAM_INT);
		$stmt->bindvalue(":reserve_day",$reserve_day,PDO::PARAM_STR);
		$stmt->bindvalue(":reserve_time",$reserve_time,PDO::PARAM_STR);
		$stmt->bindvalue(":new_zip",$new_zip,PDO::PARAM_STR);
		$stmt->bindvalue(":new_address",$new_address,PDO::PARAM_STR);
		$stmt->bindvalue(":s_id",$s_id,PDO::PARAM_STR);
		$stmt->bindvalue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
	}	
	
	//マネジメント情報登録（グループIDの情報を踏まえての更新になる。）
	public function groupManageDataUpdate($c_group_id,$d_product,$before2days,$payment,$make_reh,$cos_fixed,$cos_fitting,$place_fixed){
		$sql  ="UPDATE c_groups SET d_product=:d_product,before2days=:before2days,payment=:payment, ";
		$sql .="make_reh=:make_reh,cos_fixed=:cos_fixed,cos_fitting=:cos_fitting,place_fixed=:place_fixed ";
		$sql .="WHERE c_group_id=:c_group_id";
		$stmt= $this->pdo->prepare($sql);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->bindValue(":d_product",$d_product,PDO::PARAM_INT);
		$stmt->bindValue(":before2days",$before2days,PDO::PARAM_INT);
		$stmt->bindValue(":payment",$payment,PDO::PARAM_INT);
		$stmt->bindValue(":make_reh",$make_reh,PDO::PARAM_INT);
		$stmt->bindValue(":cos_fixed",$cos_fixed,PDO::PARAM_INT);
		$stmt->bindValue(":cos_fitting",$cos_fitting,PDO::PARAM_INT);
		$stmt->bindValue(":place_fixed",$place_fixed,PDO::PARAM_INT);
		$stmt->execute();
	}
	
	//グループの期限過ぎ（limit_over）情報をUPDATE
	public function updateLimitOver($c_group_id,$limit_over){
		$sql ="UPDATE c_groups SET limit_over=:limit_over WHERE c_group_id=:c_group_id";
		$stmt= $this->pdo->prepare($sql);
		$stmt->bindValue(":limit_over",$limit_over,PDO::PARAM_INT);
		$stmt->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
	}
	
	//顧客G新居情報更新(お客様ページでお客様が操作可能）
	public function groupNewaddressUpdate($c_group_id,$new_zip,$new_address) {
		$sql  ="UPDATE c_groups SET new_zip=:new_zip,new_address=:new_address ";
		$sql .="WHERE c_group_id=:c_group_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":new_zip",$new_zip,PDO::PARAM_STR);
		$stmt ->bindValue(":new_address",$new_address,PDO::PARAM_STR);
		$stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt->execute();
	}
	
	//顧客情報更新(お客様ページでお客様が操作可能）
	public function customerUpdate($c_id,$c_name,$c_pass,$c_mail,$c_tell,$c_zip,$c_address,$c_gender){ 
		$sql  ="UPDATE customers SET c_name=:c_name,c_pass=:c_pass,c_mail=:c_mail, ";
		$sql .="c_tell=:c_tell,c_zip=:c_zip,c_address=:c_address,c_gender=:c_gender ";
		$sql .="WHERE c_id=:c_id"; 
		$stmt=$this->pdo->prepare($sql);
		$pass= password_hash($c_pass,PASSWORD_DEFAULT);
		$stmt->bindValue(":c_name",$c_name,PDO::PARAM_STR);
		$stmt->bindValue(":c_pass",$pass,PDO::PARAM_STR);
		$stmt->bindValue(":c_mail",$c_mail,PDO::PARAM_STR);
		$stmt->bindValue(":c_tell",$c_tell,PDO::PARAM_STR);
		$stmt->bindValue(":c_zip",$c_zip,PDO::PARAM_STR);
		$stmt->bindValue(":c_address",$c_address,PDO::PARAM_STR);
		$stmt->bindValue(":c_gender",$c_gender,PDO::PARAM_INT);
		$stmt->bindValue(":c_id",$c_id,PDO::PARAM_STR);
		$stmt->execute();
	}

	//顧客写真投稿 写真に保存先と保存名(g_id or b_id　＋.jpg)を指定する
	public function saveImage($c_id) {
		move_uploaded_file($_FILES["c_myphoto"]["tmp_name"],"../image/upload/c_myphoto/".$c_id.".jpg");
	}
	
	//掲示板写真投稿 写真に保存先と保存名(b_id or created　＋.jpg)を指定する
	public function saveBoardImage($b_id) {
		move_uploaded_file($_FILES["board_photo"]["tmp_name"],"../image/upload/board_photo/".$b_id.".jpg");
	}
	//掲示板投稿最新投稿日の表示
	public function getBoardNewCreatedDate($c_group_id){
		$sql ="SELECT * FROM board WHERE c_group_id=:c_group_id ORDER BY created DESC LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt ->execute();
		$row =  $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	//見積もり投稿 データに保存先と保存名(c_group_id　＋.jpg)を指定する＆グループのestimateの値を1に書き換える
	public function submitEstimate($c_group_id,$estimate) {
		$sql  = "UPDATE c_groups SET estimate=:estimate WHERE c_group_id=:c_group_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":estimate",$estimate,PDO::PARAM_INT);
		$stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt ->execute();
		move_uploaded_file($_FILES["estimate"]["tmp_name"],"../image/upload/estimate/".$c_group_id."_estimate.jpg");
	}	
	//請求書投稿 データに保存先と保存名(c_group_id　＋.jpg)を指定する＆グループのestimateの値を1に書き換える
	public function submitInvoce($c_group_id,$invoce) {
		$sql  = "UPDATE c_groups SET invoce=:invoce WHERE c_group_id=:c_group_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":invoce",$invoce,PDO::PARAM_INT);
		$stmt ->bindValue(":c_group_id",$c_group_id,PDO::PARAM_INT);
		$stmt ->execute();
		move_uploaded_file($_FILES["invoce"]["tmp_name"],"../image/upload/invoce/".$c_group_id."_invoce.jpg");
	}

	//撮影当日までの日数表示するための、日付差を求める。
	public function dayDiff($date1, $date2) {
		// 日付をUNIXタイムスタンプに変換
		$timestamp1 = strtotime($date1);
		$timestamp2 = strtotime($date2);
		// 何秒離れているかを計算 absでどちらが先の日程でもマイナス表記にならないように。
		$seconddiff = abs($timestamp2 - $timestamp1);
		// 日数に変換
		$daydiff = $seconddiff / (60 * 60 * 24);
	  return $daydiff;
	}
	
	//アイテムリストから投稿済みリスト削除機能
	public function listDelete($list_id) {
		$sql ="DELETE FROM list WHERE list_id=:list_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt ->bindValue(":list_id",$list_id,PDO::PARAM_INT);
		$stmt->execute();
	}

}
?>
