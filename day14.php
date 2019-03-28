<?php 

var_dump(a([1,2,3,4],5));
function a($arr,$m){
	$res=[];
   $len=count($arr);
	for ($i=0; $i < $len; $i++) { 
		for ($j=0; $j < $len ; $j++) { 

			 if ($arr[$i]+$arr[$j]==$m) {
			 	   
			 	  $res[]=$arr[$i]*$arr[$j];
			 }
		}
	}
	sort($res);
	return $res[0];
}


?>