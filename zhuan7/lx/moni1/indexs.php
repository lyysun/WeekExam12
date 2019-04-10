<?php 
header("Content-type:text/html;charset=utf-8");
//初始化数据
$data=curl_init();
// var_dump($data);die;
//数据传输
curl_setopt($data,CURLOPT_URL,"https://www.readnovel.com/");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
//揭开安全
curl_setopt($data,CURLOPT_SSL_VERIFYPEER,0);
$res=curl_exec($data);
// var_dump($res);
//标题
$para1='#<li data-rid=".*"><div class=".*"><a href=".*" data-eid=".*" data-bid=".*" target=".*"><img src=".*" alt="(.*)"></a></div><div class=".*"><h4><a href=".*" data-eid=".*" data-bid=".*" target=".*" title=".*">.*</a></h4><p>.*</p><div class=".*"><i>(.*)</i><a class=".*" data-eid=".*" target=".*"><img src=".*">(.*)</a></div></div></li>#isU';
preg_match_all($para1,$res,$arr);
echo "<pre>";
// print_r($arr);




$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
foreach ($arr as $key => $v) {
	$title=$arr[1][$key];
	$lx=$arr[2][$key];
	$zz=$arr[3][$key];
	 $sql="insert into moni1 (title,lx,zz) values ('$title','$lx','$zz')";
      $relust=$pdo->exec($sql);
     // print_r($title);
}

echo '<a href="show.php">添加成功</a>';




?>