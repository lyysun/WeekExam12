<?php 


echo f(7);
function f($a){
	 $y='';

    if($a==1)

    {
     $y=1;

    }

    else if($a==2)

    {

        $y=2;

    }

    else

    {
     $y=f($a-1)+f($a-2);

    }  
    return $y;
}

?>