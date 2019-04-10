<?php 
 session_start();
 $tel1=$_SESSION['tel'];
 // var_dump($tel1);

 $tel=$_POST['tel'];
 $m=$_POST['m'];
 $dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDo($dsn,"root","root");
$pdo->beginTransaction();

$res=$pdo->query("select * from stuend")->fetch();

$res1=$pdo->exec("update stuend set m=m - '$m' where tel='$tel1'");

$res2=$pdo->exec("update stuend set m=m + '$m' where tel='$tel'");
if($res1>0&&$res2>0&&$res['m']>$m){
	$pdo->commit();
	echo '<a href="indexs.php">success</a>';
}else{
	$pdo->rollBack();
	echo "error";
}


?>