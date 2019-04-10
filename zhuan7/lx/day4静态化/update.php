<?php 
$id=$_GET['id'];

$sum=$_GET['sum'];
// echo $sum;die;
$dsn="mysql:host=127.0.0.1;dbname=2yk";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("update user set sum=$sum where id=$id");
// $sum=$res['sum'];


?>