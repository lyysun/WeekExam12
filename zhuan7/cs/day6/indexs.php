<?php 
session_start();
$name=$_SESSION['name']='zhangsan';
$m=$_POST['m'];
$name1=$_POST['name'];

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$pdo->beginTransaction();
$data=$pdo->query("select * from mony where name='$name'")->fetch();
// var_dump($data);
$res1=$pdo->exec("update mony set m=m - '$m' where name='$name'");
// var_dump($res1);
$res2=$pdo->exec("update mony set m=m + '$m' where name='$name1'");
if($res2>0&&$res1>0&&$data['m']>=$m){
	$pdo->commit();
	echo "success";
}else{
	$pdo->rollBack();
	echo "error";
}


?>