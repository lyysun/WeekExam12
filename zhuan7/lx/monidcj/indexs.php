<?php 
header("Content-type:text/html;charset=utf-8");
// include("curl.class.php");
// $a=new curl();
// $b=$a->curl1("http://dianying.114la.com/?kz");
// var_dump($b);die;
// $par='#<h2>(.*)</h2>#isU';


include("QL\phpQuery.php");
include("QL\QueryList.php");

$urls="http://dianying.114la.com/?kz";


$data=array( 
       "title" => array(".liSy2 ul li a","title"),
       "pz"=>array(".wang2 li span b","text"),
       "nr"=>array(".wang2 li .td p","text"),
       "urls"=>array(".liSy2 li a","href"), 
        
	);


$a=\QL\QueryList::Query($urls,$data);
echo "<pre>";
$p=$a->getData();
var_dump($p);





?>