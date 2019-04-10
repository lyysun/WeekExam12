<?php 
//二进制转十进制

// bindec();
// 0*2^0+1*2^1+0*2^2
$n = '1010';

echo a($n);

function a($n){
	$len=strlen($n);
	$return=0;
	for ($i=0; $i < $len; $i++) 
	{ 
		$a=pow(2,$len-$i-1);
		$return +=$n[$i]*$a;
	}
	return $return;
}  




?>