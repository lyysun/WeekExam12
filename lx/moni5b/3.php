<?php

//3．围棋棋盘是19*19，总共361个交叉点。现在韩梅梅想从左下角开始，每次移动一步，只能向右或向上走交叉点。请问有多少种走法

$a=a(4,4);
echo $a;
function a($m,$n){
	if($m==0 && $n==0){
		return 0;
	} else if($m==0||$n==0){
		return 1;
	}
    

	return a($m,$n-1)+a($m-1,$n);

}
// 非递归
$move=move(4,4);
echo $move;
function move($m,$n){
	//。定义两个坐标的数组
	$a[0][1]=1;
	$a[1][0]=1;
	for ($i=0; $i <=$m ; $i++) { 
		$a[1][$i]=$i+1;
	}
	for ($i=2; $i <=$m ; $i++) { 
		$a[$i][1]=$a[1][$i];
	}
	for ($i=2; $i <=$m ; $i++) { 
		for ($j=2; $j <=$m ; $j++) { 
			$a[$i][$j]=$a[$i-1][$j]+$a[$i][$j-1];
		}
	}
	return $a[$n][$m];
}





?>