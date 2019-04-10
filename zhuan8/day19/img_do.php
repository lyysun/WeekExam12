<?php 
$file=$_POST['file'];
// echo $file;die;
$img="img/";
move_uploaded_file($file,$img);
?>