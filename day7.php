<?php


echo moth(12);
function moth($n){
    $sum=$n;
    for ($i=1; $i <= $n ; $i++) { 
    	 
    	  $sum=$sum/2;
    	  echo $sum;
    	  if($sum !== intval($sum)){
    	  	break;
    	  }

    }
    for ($i=1; $i <= $n ; $i++) { 
    	 
    	  $sum=$sum/3;
    	  echo $sum;die;
    	  if($sum !== intval($sum)){
    	  	break;
    	  }

    }
    for ($i=1; $i <= $n ; $i++) { 
    	 
    	  $sum=$sum/5;
    	  if($sum !== intval($sum)){
    	  	break;
    	  }

    }
    if($sum==1){
    	echo $n;
    }


}
?>