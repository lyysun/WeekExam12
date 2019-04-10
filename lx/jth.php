<?php 

include("../lx/zsgc.php");
$a=new Db();
$id=$_GET['id'];

$data=$a->jth("select * from news where id=$id");
$title=$data['title'];
$id=$data['id'];
ob_start();
include("../lx/show/show.html");
$ob=ob_get_contents();
file_put_contents("show-$id.html", $ob);
?>