<?php
//接的方法名称
$a=$_GET['a'];
// $a=isset($_GET['a'])?$_GET['a']:"register";
//类名
$cname="app\controllers\UsersController";
//方法名
$aname=$a;

function autoload($cname){
     // $cname=str_replace("\\",'/' , $cname);
     $file= __DIR__."/".substr($cname,4).".php";
     if(file_exists($file)){
     	include $file;
     }
}

spl_autoload_register("autoload");

$c= new $cname();
$c->$aname();

function view($name='',$data=[]){
	include __DIR__."/views/users/".$name.".html";
}

?>