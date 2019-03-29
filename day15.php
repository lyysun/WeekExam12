<?php

 $str="wwertyuioddffhhjjkk";
 var_dump(a($str));
 function a($str){
 	$len=strlen($str);
 	for ($i=0; $i < $len; $i++) { 
 		 $num=substr_count($str, $str[$i]);
 		 if($num==1){
 		 	return $i+1;
 		 }
 	}
 }


?>