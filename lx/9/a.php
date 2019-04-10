<?php
var_dump(a(4,3));
function a($n,$m){
  $list=range(1,$n);
  $num = 1;//计数
   //循环直到剩下一个
    while (count($list) > 1) {
      
             foreach ($list as $k => $v) {
                     //$num数与传过来 $m 相等时 弹出那个人
                    if ($num == $m) {
                      //找到那个值 踢出
                       unset($list[$k]);
                       $num = 1; //从新赋值从1开始
                       continue;
                    }
                    $num++;
              } 
             
      }
   return $list;
 
}


?>