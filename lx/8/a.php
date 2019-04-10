<?php

echo one('EbUser');
function one($str){

   $upper=range("A", "Z");
   $str2=$str[0];
   $len=strlen($str);
   for ($i=1; $i < $len ; $i++) { 
         $m=$str[$i];
         if (in_array($m,$upper)) {
                  $str2.="_".$m;
         }else{
         	$str2.=$m;
         }
   }
   $str2=strtolower($str2);
   echo $str2;
}


echo a('LyyOne');
function a($n){
	
	echo strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $n));
}

 ?>