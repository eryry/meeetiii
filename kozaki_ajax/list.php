<?php
require_once("config.php");

if(!empty($_GET["cat"])){
	$sql = "SELECT * FROM lunch WHERE c_id=:cat";
	$res =$pdo->prepare($sql);
	$res ->bindValue(":cat",$_GET["cat"],PDO::PARAM_STR);
	$res ->execute();
} else {
	$sql  = "SELECT * FROM lunch";
	$res = $pdo->query($sql);
}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>らんち</title>
		<link rel="stylesheet" href="/style.css">
	</head>
	<body>
		<div id="container">
		<h1>Pranzo Menu</h1>
		
		<form action="" method="get">
			<select name="cat">
				<option value="0">すべて</option>
				<option value="1">洋食</option>
				<option value="2">和食</option>
				<option value="3">中華</option>
				<option value="4">パン</option>
				<option value="5">ドリンク</option>
			</select>
			<input type="submit" value="検索">
		</form>
		
		<ul>	
			<?php while($row=$res->fetch(PDO::FETCH_ASSOC)): ?>
			<li><?php echo $row["menu"]; ?></li>
			<?php endwhile; ?>
		</ul>
		
		</div>
	</body>
</html>

