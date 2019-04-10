<?php 

$id=$_GET['id'];
$dsn="mysql:host=127.0.0.1;dbname=2yk";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("select * from user where id=$id")->fetch();
$name=$res['name'];
$desc=$res['desc'];
ob_start();//开启静态化；
include("show/show.html");//进入模板
$ob=ob_get_contents();//只是得到输出缓冲区的内容，但不清除它
file_put_contents("show-$id.html", $ob);//生成html
?>