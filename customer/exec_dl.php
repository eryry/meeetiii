<?php
session_start();

$img_name = $_SESSION["c_group_id"].'_invoce.jpg';
$img_dir = '../image/upload/invoce/' . $img_name;
$imginfo = getimagesize($img_dir);
header('Content-Type: ' . $imginfo['mime']);
readfile($img_dir);

?>
