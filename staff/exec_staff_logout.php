<?php
session_start();
$_SESSION=[];
setcookie ("session_name","",time()-1800);
session_destroy();

header("Location: ../index.php");
?>
