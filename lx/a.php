<?php

$n = 5;
$result = 1;
for($i=2;$i<=$n;$i++)
{ 
    $result *= $i;
    echo "<br>";

    // echo $i;
    // echo $result;

}
echo $n."的阶乘".$result;
echo  "<br>";



$arr="Have you ever gone shopping and lyyy";
$arr=str_split($arr);  //函数把字符串分割到数组中。
// var_dump($arr);die;
$arr_count=array_count_values($arr);//函数对数组中的所有值进行计数。

echo "出现3次以上的";

foreach ($arr_count as $key => $value) {
      if($value>3){
      	echo "     ".$key.",";
      }

}



?>
