<?php

 // echo sum1();
 // echo sum2();
 // echo sum3();

 function sum1(){
 	$sum='';
 	for ($i=1; $i <= 100; $i++) { 
 		$sum=$sum+$i;
 	}
 	echo $sum;
 }

 function sum2(){
       $i=1;
       $sum='';
    while ($i<= 100) {
    	$sum=$sum+$i;
    	$i++;

    }
    echo $sum;

 }

 function sum3(){
    $i=1;
       $sum='';
     do{
     	$sum=$sum+$i;
    	$i++;

     }while ( $i<= 100); 
    echo $sum;
 }



// echo jc2(5);

 function jc1($n){
         $sum=1;
       for ($i=1; $i <= $n ; $i++) { 
             $sum=$sum * $i;

       }
       echo $sum;
 }


 function jc2($n){
    if($n==1){
      return 1;
    }
     return $n*jc2($n-1);

 }

// echo str("abryba");
 function str($str){
  
        $str1=strrev($str);
        if($str1==$str){
        	  return $str1;
        	}else{
        		return "no";
        	}
      

 }


 function str1($n){
    
    for ($i=1; $i <= $n; $i++) { 
         

    }

 }




?>