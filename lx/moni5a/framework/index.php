<?php


// include 'Loader.php';
//接受参数
// $a=isset($_GET['a'])?$_GET['a']:'list';
$a=$_GET['a'];
//类名
$cname="app\controllers\NewsController";
//方法名
$aname="news".ucfirst($a);


function autoload($class){
		  // 截取 app\controllers\NewsController 当中的 app\
		 // var_dump(__DIR__);die;
           $file=__DIR__.'/'.substr($class,4).".php";
           
           if(file_exists($file)){
           	include $file;
           }
	}

spl_autoload_register("autoload");

//实例化
$c=new $cname();

//调用方法
$c->$aname();

function view($name,$data){
	include __DIR__."/views/news/".$name.'.html';
}

?>