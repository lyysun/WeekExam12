<?php 
include("QL\phpQuery.php");
include("QL\QueryList.php");

$url="http://www.chinanews.com/";
$d=array(
          "imgs"=> array(".leftimg a img","src"),
           "title"=>array(".righttext p a","text"),
           "urls"=>array(".righttext p a","href")
	);
$p=\QL\QueryList::Query($url,$d);
echo "<pre>";
$a=$p->getData();
// var_dump($a);die;

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");

for($i=0;$i<3;$i++){
          $imgs=$a[$i]['imgs'];
       if(!empty($a[$i]['title'])){
       	   $title=$a[$i]['title'];
     
       }
      // var_dump($title);
        $urls=$a[$i]['urls'];
        
        $path=file_get_contents("http://www.chinanews.com".$imgs);
        file_put_contents("imgs/"."img-{$i}.jpg",$path);


      $sql="insert into `d11.19` (urls,title,f) values('$urls','$title','$imgs')";

      $pdo->exec($sql);

}

?>