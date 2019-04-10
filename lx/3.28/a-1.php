<?php

$str = "abcdefghktolpqffcvtyyeewwqqaa";
var_dump(a($str));

function a($str)
{
	$arr=explode(",",$str);
	var_dump($arr);die;
	$len=count($arr);
	for ($j=0; $j < $len; $j++) { 
		for ($i=0; $i < $len; $i++) { 
			if ($arr[$i] == $arr[$j]) {
				var_dump($arr);
				unset($arr[$j]);
			}
		}
	}
	return $arr;
}
?>