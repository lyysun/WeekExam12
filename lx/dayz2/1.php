<?php 

$arr=[1,2,3,4];
$list=a($arr);
// var_dump($list);


function a($arr){
   
   $len=count($arr);
   $res=[];

   for ($i=0; $i < $len; $i++) { 
          for ($j=0; $j < $len ; $j++) { 
          	 for ($k=0; $k < $len; $k++) { 
          	 	 
          	    if ($arr[$i]!=$arr[$j] && $arr[$j]!=$arr[$k] && $arr[$i]!=$arr[$k]) {

          	    	$res[]=$arr[$i].$arr[$j].$arr[$k];
          	    }
          	 }
          }
   }
   return $res;

}

$dir="D:\phpstudy\PHPTutorial\WWW\zhuanx2.5\lx\dayz2";
my_dir($dir);
function my_dir($dir){

	$dh = opendir($dir);//打开一个目录句柄
 
	   while (($file = readdir($dh)) !== false) {
       
          if ($file=='.' || $file=="..") { //如果是 .. 就跳过
             continue;
          }
           
          $path=$dir."/".$file;//路径名 文件夹玩名
     
          if(!is_file($path)){ //如果不是文件就再次调用

          	my_dir($path);//再次调用下自己
          }else{
          	echo $path."\r\n";
          }

        }
         closedir($dh);//关闭由 dir_handle 指定的目录流
}

$aPath="/a/b/c/d/test.php";
$bPath="/a/b/d/c/test.php";
$str=findCommonPath($aPath,$bPath);
var_dump($str);

function findCommonPath($aPath,$bPath){

$res=[];
$aPath=explode("/", $aPath);
$bPath=explode("/", $bPath);

$len=count($aPath)>count($bPath)?count($bPath):count($aPath);


for ($i=0; $i < $len ; $i++) { 
	if($aPath[$i] == $bPath[$i]){
		$res[] = $aPath[$i]; 
	}else{
		break;
	}
}
$res=implode("/", $res);
return $res;

}


?>