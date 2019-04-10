<?php
$total=20;//红包总金额  
$num=10;// 分成10个红包，支持10人随机领取  
$min=0.01;//每个人最少能收到0.01元  

$arr=[];
for ($i=1;$i<$num;$i++)  
{  
    $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限  


    $money=mt_rand($min*100,$safe_total*100)/100;  

    $total=$total-$money; 
	$arr[]=$money;

    // echo '第'.$i.'个红包：'.$money.' 元，余额：'.$total.' 元 ';

} 
$arr[]=$total; 
// echo '第'.$num.'个红包：'.$total.' 元，余额：0 元';
echo "<pre>";  
var_dump($arr);
var_dump(array_sum($arr));
?>