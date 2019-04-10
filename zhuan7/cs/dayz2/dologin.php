<?php 
session_start();
$tel=$_POST['tel'];
$pwd=$_POST['pwd'];
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("select * from stuend where tel='$tel' and pwd='$pwd'")->fetch();

// var_dump($res);
if($res){
	$_SESSION['tel']=$tel;
	echo '<a href="indexs.php">sucess</a>';

}else{
	echo '<a href="login.html">error</a>';
}



?>