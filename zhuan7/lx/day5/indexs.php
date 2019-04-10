<?php
session_start();
$_SESSION['name']="zhangsan";
$name=$_SESSION['name'];

$m=$_POST['m'];
$name1=$_POST['name'];

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$pdo->beginTransaction();//启动一个事务 
$data=$pdo->query("select * from mony where name='$name'")->fetch();
$res1=$pdo->exec("update mony set m=m - '$m' where name='$name'");
$res2=$pdo->exec("update mony set m=m + '$m' where name='$name1'");
if($res2>0&&$res1>0&&$data['m']>=$m){
	$pdo->commit();
	echo "success";
}else{
	$pdo->rollBack();
	echo "error";
}

?>