<?php

$a=a(2,2);

echo $a;
function a($x,$y){
        $xx='';
        $yy='';
        for ($i=1; $i <= $x; $i++) { 
        	$xx=$x*$x;
        }

        for ($j=1; $j <= $y; $j++) { 
        	$yy=$y*$y;
        }

        return $xx+$yy;

}

?>