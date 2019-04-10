<?php
header("Content-type:text/html;charset=utf-8");
include("QL/phpQuery.php");//in如文件
include("QL/QueryList.php");//in如文件
$url = 'https://xs.sogou.com/list/6261468923';//创建地址
// var_dump($url);die;
//找出需要的数据
$rules=array(
       
       "name"=>array(".c3","text"),

       // "tp"=>array(".cover img","src"),
       // "zj"=>array(".d1 a","text"),
       // "nr"=>array(".d2","text"),
	);

//调用静态方法
$q=\QL\QueryList::Query($url,$rules);
echo "<pre>";

//过去data数据
$res=$q->getData();
// var_dump($res);die;

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");



$name=$res;

// var_dump($name);
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
 
for($i=0;$i<=20;$i++){
     $name1=$name[$i];
    $name2=$name1['name'];

     // var_dump($name2);
	$sql="insert into xiaoshuo_chapter (detail_id,chapter_name) values('4','$name2')";
    $pdo->exec($sql);
}




// foreach ($res as $key => $v) {
// 	   // var_dump($v);die;
// 	for($i=0;$i<=20;$i++){
// 	   $name=$v['name'];
// 	   // var_dump($name);
//     //    $zj=$v['zj'];
//     //    $nr=$v['nr'];
// 	   // $tp=$v['tp'];
// 		$sql="insert into xiaoshuo_chapter (detail_id,chapter_name) values('2','$name')";
//     $pdo->exec($sql);
	
// 	$i++;
    
	
	 
//  }
// }


?>