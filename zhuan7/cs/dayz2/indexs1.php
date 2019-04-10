<?php 
header("Content-type:text/html;charset=UTF-8");
session_start();
$tel=$_SESSION['tel'];

$tel1=$_POST['tel'];
$m=$_POST['m'];

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
 //开启事务
 $pdo->beginTransaction();
  $data=$pdo->query("select * from stuend where tel='$tel'")->fetch();
  // var_dump($data);
 $res1=$pdo->exec("update stuend set m=m - '$m' where tel='$tel'");
 $res2=$pdo->exec("update stuend set m=m + '$m' where tel='$tel1'");
if($res1>0&&$res2>0&&$data['m']>$m){
	$pdo->commit();
	echo '<a href="">转账成功</a>';
}else{
	$pdo->rollBack();
	echo '<a href="">余额不足</a>';
}
 
?>