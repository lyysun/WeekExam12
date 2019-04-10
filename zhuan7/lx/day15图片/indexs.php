<?php 

header("Content-type:text/html;charset=utf-8");
$data=curl_init();
curl_setopt($data,CURLOPT_URL,"http://news.ifeng.com/world/");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
$res=curl_exec($data);
// var_dump($res);
$para='#<a href=".*" target=".*" title=".*"><img src="(.*)" width=".*" height=".*"></a>#isU';

preg_match_all($para,$res,$arr2);
echo "<pre>";
// var_dump($arr2[1]);
$arr3=$arr2[1];

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");

foreach ($arr3 as $key => $val) {
	$str=file_get_contents($val);
	// var_dump($str);
	$path=pathinfo($val);

	$path=$path['extension'];
	
	$path='img/'.time().mt_rand(1000,9999)."$path";
	// var_dump($path);
	file_put_contents($path,$str);
	$pdo->exec("insert into day14 (title) values('$path')");
}

?>