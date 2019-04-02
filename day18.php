<?php
var_dump(a(5));
function a($n){
$sum='';
	   for ($i=1; $i < $n; $i++) { 
	      if($i/2){
	    	  $a=$i%2;
            $sum.=$a;
	      }
	   }
        
     $arr=str_split($sum);
     $values=array_values($arr);
     $num='';
     foreach ($values as $key => $value) {
     	// var_dump($value);die;
             $num=$num+$value;
     } 
     return $num;
	  // echo $sum; 
	
	
}


?>