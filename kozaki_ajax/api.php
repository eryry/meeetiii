<?php
	
	$host   = "localhost";
	$dbname = "akd";
	$dbuser = "root";
	$dbpass = "";
	
	
	$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
	$pdo = new PDO($dsn,$dbuser,$dbpass);
	
	$sql  = "SELECT * FROM lunch WHERE c_id=:cat";
	$res  = $pdo->prepare($sql);
	$res  ->bindValue(":cat",$_GET["cat"],PDO::PARAM_STR);
	$res  ->execute();
	$rows = $res->fetchAll(PDO::FETCH_ASSOC);
	
	$json =json_encode($rows);
	echo $json;



?>
