<?php 

var_dump(a(100,999));
 function a($k,$n){

  for ($i=$k; $i <= $n ; $i++) { 
           

          $a=$i/100%10;
          $b=$i/10%10;
          $c=$i/1%10;
          if($a*$a*$a+$b*$b*$b+$c*$c*$c==$i){
          	  $ar[]=$i;
          	   
          }

  }
return $ar;

 }

?>