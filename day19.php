<?php

$list=a(5);
function a($n){
	$arr=[1,2,3,4,5];
	foreach ($arr as $key => $v) {
	 if($v==$n){
	 	echo $key;die;
	 }
	}
}


?>