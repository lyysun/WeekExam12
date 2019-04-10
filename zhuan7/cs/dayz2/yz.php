<?php 
$tel=$_GET['tel'];
$name=$_GET['name'];
// var_dump($name);
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("select * from stuend where tel='$tel' and name='$name'")->fetch();


if($res){
	echo  "手机号与姓名符合";
}else{
	echo  "手机号与姓名不符合";
}
?>