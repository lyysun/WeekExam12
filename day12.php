<?php
 
 var_dump(a(5));
 function a($n){
 	$arr=range(1,$n);
 	$sum=array_sum($arr);
 	return $sum;die;
 }

?>