<?php 

$dsn="mysql:host=127.0.0.1;dbname=2yk";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("select * from user")->fetchAll();

// var_dump($res);
foreach ($res as $key => $v) {
	
	ob_start();
	$id=$v['id'];
	$res=$pdo->query("select * from user where id=$id")->fetch();
	$name=$res['name'];
	$desc=$res['desc'];
	include("show/show.html");
	$ob=ob_get_clean();//得到当前缓冲区的内容并删除当前输出缓冲区。
	file_put_contents("show-$id.html", $ob);

}
echo "success--";

?>