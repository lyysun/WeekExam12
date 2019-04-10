<?php 
 $id=$_GET['id'];
 $dsn="mysql:host=127.0.0.1;dbname=2yk";
 $pdo=new PDO($dsn,"root","root");
 $res=$pdo->query("select * from user where id=$id")->fetch();
 // var_dump($res);
 $name=$res['name'];
 $desc=$res['desc'];
 $sum=$res['sum'];
 include("show/show.html");
?>