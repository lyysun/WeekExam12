<?php

    $str='abba';
     $a=strrev($str); //逆序输出
    
  if($str==$a){
  	echo "回文";
  }else{
  	echo "no";
  }

$n=153;
echo a($n);

function a($n){

         $b = $n/100%10;

         $s = $n/10%10;
         $g = $n/1%10;
   

         if($b*$b*$b+$s *$s *$s +$g*$g*$g==$n){
         	return "yes";die;
         }else{
         	echo "no";die;
         }
}
 



?>