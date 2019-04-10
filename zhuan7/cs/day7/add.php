<?php
$name=$_POST['name'];
$pwd=$_POST['pwd'];

$email=$_POST['email'];

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root",'root');
$res=$pdo->query("insert into day7 (name,pwd,email) values ('$name','$pwd','$email')");
if($res){
	echo "success";
}

?>