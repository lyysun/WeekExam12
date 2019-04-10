<?php

// var_dump(a(5,2));
function a($n,$m){
	$arr=range(1,$n);
	$num=1;
	while (count($arr) > 1) {
		
		foreach ($arr as $k => $v) {
		       if($num==$m){
		       	  unset($arr[$k]);
		       	  $num=1;
		       	  continue;
		       }
		       $num++;
		}
	}
	return $arr;
}

var_dump(b([1,2,3,4,5,9]));
function b($n){
	sort($n);
	$k=0;
	$s=count($n);
	$arr=[];
	$arr1=[];
	$arr2=[];
	$i=1;
	$j=0;
  foreach ($n as $key => $v) {
           $arr[].=$n[$k+$j];

           unset($n[$k+$j]);
           $arr[].=$n[$s-$i];
           unset($n[$s-$i]);
           // $arr1[].=$n[$k+$j];
           //  $j++;
           // $arr1[].=$n[$s-$i];
           // $i++;
           // $arr2[].=$n[$k+$j];
           //  $j++;
           // $arr2[].=$n[$s-$i];
           // $i++;

             var_dump(b($arr));
             // var_dump($arr1);
             // var_dump($arr2);
             

    }  
 
}

// var_dump(c([3,2,5,6]));
function c($n){
	rsort($n);
	$str=implode("",$n);
     return $str;
}

?>