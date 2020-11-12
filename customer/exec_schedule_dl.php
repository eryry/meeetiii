<?php
session_start();

$img_name = $_SESSION["c_group_id"].'_schedule.jpg';
$img_dir = '../image/upload/schedule/' . $img_name;
$imginfo = getimagesize($img_dir);
header('Content-Type: ' . $imginfo['mime']);
readfile($img_dir);

?>