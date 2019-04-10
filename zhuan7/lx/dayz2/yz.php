<?php 
session_start();
$tel1=$_SESSION['tel'];
$m=$_GET['m'];
// var_dump($m);
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("select * from stuend where tel='$tel1'")->fetch();
$a=$res['m'];
if($m>$a){
	echo "余额不足";
}


?>