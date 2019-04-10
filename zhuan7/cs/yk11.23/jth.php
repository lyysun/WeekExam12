<?php 
$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from `yx`")->fetchAll();

foreach ($data as $key => $v) {
	 ob_start();
	 $id=$v['id'];
     $da=$pdo->query("select * from `yx` where id=$id")->fetch();
     $zw=$da['zw'];
     $name=$da['name'];
     $zd=$da['zd'];
     $m=$da['m'];
     $time=$da['time'];
     include('ob.html');
     $ob=ob_get_clean();
     file_put_contents("jty-{$id}.html",$ob);

}

?>