<?php
//z3．有某人上楼梯,一步可以上1,2,3个台阶,楼梯共1000个台阶,从地面到最上层共有多少种不同走法?
 // f(n) = f(n-1) + f(n-2)+ f(n-3), f(1) = 1, f(2) = 2,f(3)=4;


echo f(3);
function f($a){
	 $y='';
      if($a==1){
         $y=1;
        }else if($a==2){
            $y=2;
        }else if($a == 3){
           $y= 4;
       }else{
        //递归调用 
           $y=f($a-1)+f($a-2)+f($a-3);
       }  
    return $y;
}


//非递归
echo a(3);
function a($n){
    $list=[1,2,4];
    for ($i=3; $i <= $n; $i++) { 
       $list[]=$list[$i-1]+$list[$i-2]+$list[$i-3];
    }
    return $list[$n-1];
}


?>