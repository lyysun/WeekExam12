<?php 
header("Content-type:text/html;charset=gbk");
$data=curl_init();
curl_setopt($data,CURLOPT_URL,"https://search.51job.com/list/010000,000000,0000,00,9,99,php,2,1.html?lang=c&stype=&postchannel=0000&workyear=99&cotype=99&degreefrom=99&jobterm=99&companysize=99&providesalary=99&lonlat=0%2C0&radius=-1&ord_field=0&confirmdate=9&fromType=&dibiaoid=0&address=&line=&specialarea=00&from=&welfare=");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
curl_setopt($data,CURLOPT_SSL_VERIFYPEER,0);
$res=curl_exec($data);
// var_dump($res);
$par='#<a target="_blank" title=".*" onmousedown="">(.*)</a>#isU';
preg_match_all($par,$res,$arr);
echo "<pre>";
// var_dump($arr[1]);
$zw=$arr[1];

$par1='#<span class=".*"><a target="_blank" title=".*" href=".*">(.*)</a></span>#isU';
preg_match_all($par1,$res,$arr1);
echo "<pre>";
// var_dump($arr1[1]);
$name=$arr1[1];


$par2='#<span class="t3">(.*)</span>#isU';
preg_match_all($par2,$res,$arr2);
echo "<pre>";
// var_dump($arr2[1]);
$zd=$arr2[1];

$par3='#<span class="t4">(.*)</span>#isU';
preg_match_all($par3,$res,$arr3);
echo "<pre>";
// var_dump($arr3[1]);
$m=$arr3[1];

$par4='#<span class="t5">(.*)</span>#isU';
preg_match_all($par4,$res,$arr4);
echo "<pre>";
// var_dump($arr4[1]);
$time=$arr4[1];

$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");
$pdo->exec("set names gbk");

for($i=0;$i<10;$i++){
	$sql="insert into `yx` (zw,name,zd,m,time) values('$zw[$i]','$name[$i]','$zd[$i]','$m[$i]','$time[$i]')";
	// echo $sql;die;
	$pdo->exec($sql);
}

echo '<a href="show.php">yes</a>';
?>