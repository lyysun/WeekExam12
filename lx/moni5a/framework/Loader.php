<?php 


class Loader{
	public static function autoload($class){
		  // 截取 app\controllers\NewsController 当中的 app\
		 // var_dump(__DIR__);die;
           $file=__DIR__.'/'.substr($class,4).".php";
           
           if(file_exists($file)){
           	include $file;
           }
	}
}


function view($name,$data){
	include __DIR__."/views/news/".$name.'.html';
}