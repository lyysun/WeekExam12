<?php

// echo "1";die;
echo sum1();
function sum1(){
    $sum='';

   for ($i=1; $i <=100 ; $i++) { 
        $sum=$sum+$i;
   }
   return $sum;

}
echo sum2();
function sum2(){
	 $sum='';
	 $i=1;
	while ( $i<= 100) {
		$sum=$sum+$i;
		$i++;
	}
	  return $sum;

}
echo sum3();
function sum3(){
    $sum='';
	 $i=1;
	do{
       $sum=$sum+$i;
		$i++;
	}while($i<= 100);
	 return $sum;

}

echo jc1(3);
function jc1($n){

	$sum=1;
	for ($i=1; $i <= $n ; $i++) { 
		$sum = $sum*$i;
	}

	return $sum;
}

echo jc2(3);
function jc2($n){
	if($n == 1)
	{
		return 1;
	}else{
		return $n*jc2($n-1);
	}
	
}


echo str("abba");
function str($n){
	$str=strrev($n);
	if($str==$n){
		echo "是回文";
	}else{
		echo "不是回文";
	}
}


?>