<?php
class Meeting {
	private $pdo;

	public function __construct{
		$host  = "localhost";
		$dbname= "meeting_app";
		$dbuser= "root";
		$dbpass= "";

		$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
		$this->pdo = new PDO($dsn,$dbuser,$dbpass);
	}
	
}


?>
