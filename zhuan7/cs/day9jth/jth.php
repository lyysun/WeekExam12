<?php 
$id=$_GET['id'];
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from day7 where id='$id'")->fetch();
// var_dump($data);
$name=$data['name'];
$news=$data['news'];
//开启静态化
ob_start();
//in如页面
include("show/show.html");
$ob=ob_get_contents();//获取内容
file_put_contents("show-$id.html", $ob);

?>