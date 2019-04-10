<?php 
//2．将十进制数字转换为八进制数字。$n为十进制数字，例如10。
 $a=a(10);
 echo $a;
 function a($n){
 	$str='';
     while ( $n > 0) {
          $str.=$n%8;
           $n=floor($n/8);
       }
     $str=strrev($str);//逆序输出
     return $str;
 }

?>