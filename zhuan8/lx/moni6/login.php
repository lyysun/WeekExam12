<?php 
header("content-type:text/html;charset=utf-8");
$name=$_POST['name'];
$pwd=$_POST['pwd'];
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");

$res=$pdo->query("select * from moni6 where name='$name' and pwd='$pwd'")->fetch();

if($res){
	echo "登陆成功";
}else{
	echo "登陆失败";
}

?>