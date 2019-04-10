<?php 
session_start();
$tel=$_POST['tel'];
$pwd=$_POST['pwd'];
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDo($dsn,"root","root");
$res=$pdo->query("select * from stuend where tel='$tel' and pwd ='$pwd'")->fetch();
echo "<pre>";
// var_dump($res);
$tel1=$res['tel'];
$id=$res['id'];
// var_dump($id);
if($res){
    $_SESSION['tel']=$tel1;
     $_SESSION['id']=$id;
	echo '<a href="indexs.php">success</a>';
}else{
	echo '<a href="">error</a>';
}


?>