<?php 

echo moth(14);
function moth($n){
    
      	     $a=$n/2;
      	
             if ($a==intval($a)) {
      	     	 echo $n;die;
                 
      	     }else{
                  
                  $b=$n/3;
                  if ($b==intval($b)) {
      	     	   echo $n;die;
                 
      	         }else{
                    
                       $c=$n/5;
	                  if ($c==intval($c)) {
	      	     	   echo $n;die;
	                 
	      	         }else{
	                    
	                      echo "不是".$n;
	      	          }
      	         }
      	     }
    

}
echo "<pre>";
$arr = [["红色","白色","黄色"],["xl","l","M"]];
 sku($arr);
function sku($arr){
	$a='';
	foreach ($arr as $key => $value1) {
             
         $a .= $value1[$key];
	}
	var_dump($a);
}

?>