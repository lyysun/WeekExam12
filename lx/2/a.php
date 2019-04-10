<?php 



$str="abc";

for ($i=0 ;$i< 123; $i++){ 
	$a[]=str_shuffle($str);
    
}

var_dump(array_unique($a));

?>