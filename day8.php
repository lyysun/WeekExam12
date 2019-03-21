<?php

var_dump(a(["1,2,3,4,5,"],3));
 function a($n,$m){
 	$arr=range(1, $n);
 	$str=implode('', $arr);
 	$len=strlen($str);
 	for ($i=1; ; $i++) { 
 		if(strlen($str)==1){
 			return $m;
 		}
 		if($i%m == 0){
 			$str=substr($str, 1);
 		}else{
 			$str=substr($str,0, 1);
 			$str1=substr($str, 1);
 			$str.=$str1;
 		}
 	}
 	echo $str;
 }

?>