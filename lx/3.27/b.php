<?php 

var_dump(a([1,2,3,4],5));
function a($arr,$m){
	$a=[];
     $len=count($arr);
      for ($i=0; $i < $len; $i++) { 
      	for ($j=0; $j < $len; $j++) { 
      		  if ($arr[$i]+$arr[$j] == $m) {
      		  	    $a[]=$arr[$i]*$arr[$j];
      		  	     
      		  }
      	}
      }
      sort($a);
     return $a[0];
      

}


?>