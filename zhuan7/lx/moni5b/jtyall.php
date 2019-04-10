<?php 

header("Content-type:text/html;charset=utf-8");
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from moni1")->fetchAll();
echo "<pre>";
// var_dump($data);
    

foreach ($data as $key => $v) {
	  ob_start();
	  $id=$v['id'];

	  $da=$pdo->query("select * from moni1 where id=$id")->fetch();
	  // var_dump($da);die;
	  $title=$da['title'];
      include("bo/ob.html");

      $ob=ob_get_clean();
      file_put_contents("show-{$id}.html",$ob);
}




?>
