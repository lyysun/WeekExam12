<?php
echo sum(1,13);
function sum($n,$m){
     $sum='';
     for ($i=$n; $i <= $m ; $i++) { 
     	  $sum.=$i;
     }
    echo substr_count($sum, "1");
}
?>