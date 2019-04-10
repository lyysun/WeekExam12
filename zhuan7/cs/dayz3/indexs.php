<?php 
header("Content-type:text/html;charset=gbk");
$data=curl_init();
curl_setopt($data,CURLOPT_URL,"https://pvp.qq.com/webplat/info/news_version3/15592/24091/24092/24094/m15240/list_1.shtml");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
curl_setopt($data,CURLOPT_SSL_VERIFYPEER,0);
$res=curl_exec($data);
// var_dump($res);
$para='#<a href=".*" class="art_type fl" target="_blank">(.*)</a>#isU';
$para1='#<a href=".*" class="art_word" target="_blank">(.*)</a>#isU';

preg_match_all($para,$res,$arr);
preg_match_all($para1,$res,$arr1);

echo "<pre>";
// var_dump($arr1[1]);
$news=$arr[1];
// var_dump($news);
$ms=$arr1[1];
// var_dump($ms);die;
$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");
$pdo->exec("set names gbk");
for($i=0;$i<10;$i++){
	$sql="insert into ee (`news`,`ms`) values('$news[$i]','$ms[$i]')";
	 // echo $sql;
	$res=$pdo->exec($sql);

}



echo '<a href="show.php">success</a>';

?>