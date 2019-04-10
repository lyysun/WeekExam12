<?php

// var_dump(arr([1,2,3,4,5,6]));
function arr($arr){

  $right=[];
  $left=[];

 foreach ($arr as $key => $v) {
      
       $a=$v/2;
      if($a==intval($a)){
      	$right[]=$v;
      }elseif ($a !== intval($a)) {
      	$left[]=$v;
      }
 }

 return array_merge($left,$right);

}

echo sum(1,13);
function sum($n,$m){
  
   $sum='';
    for ($i=$n; $i <= $m; $i++) { 
        $sum.=$i;
    }
    echo substr_count($sum,'1');

}



?>