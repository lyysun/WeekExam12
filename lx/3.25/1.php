<?php
// var_dump(a(4));

function a($n){
	$arr=range(1,$n);

	$arr=array_sum($arr);
	return $arr;
}

var_dump(b("1234"));
function b($n){
     $str=strrev($n);
     // var_dump($str);die;
     echo $str;die;

}


?>