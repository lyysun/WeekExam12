<?php 

header("Content-type:text/html;charset=utf-8");

$data=curl_init();
curl_setopt($data,CURLOPT_URL,"http://news.ifeng.com/world/");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
$res=curl_exec($data);

$para='#<img src="(.*)" width=".*" height=".*">#isU';
preg_match_all($para,$res,$arr1);
echo "<pre>";
// var_dump($arr[1]);
$arr1=$arr1[1];

$para='#<a href=".*" target=".*" title="(.*)">(.*)</a>#isU';
preg_match_all($para,$res,$arr2);
echo "<pre>";
$arr2=$arr2[1];
$arr22=$arr2[2];

// var_dump($arr2[1]);

// var_dump($arr2[2]);
// var_dump($arr[3]);

$para='#<span>(.*)</span>#isU';
preg_match_all($para,$res,$arr3);
echo "<pre>";
$arr3=$arr3[1];

// var_dump($arr3[1]);

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
foreach ($arr1 as $key => $val) {
	$str=file_get_contents($val);
	$path=pathinfo($str);
	var_dump($path);
	$path=$path['extension'];
		// var_dump($path);
	$path='img/'.time().mt_rand(1000,9999)."$path";

	file_put_contents($path,$str);
	$pdo->exec("insert into day14 (title) values('$path')");
}


?>
