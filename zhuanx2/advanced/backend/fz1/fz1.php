<?php 

namespace backend\fz1;
class fz1{

         //定义静态数据 返回状态码
     public static $code=[


                  0=>"未知错误",
                  1=>"请求成功",
                  2=>"账号或密码有误",
                  3=>"库存不足",
                  4=>"已下架",
                  5=>"商品不存在放单中",
                  7=>"名称以重复",
                  8=>"父级id不存在",
     ];

    
    public static function Mss($code,$data=array()){

    	$arr=[

            "code"=>$code,
            "msg"=>self::$code[$code],
            "res"=>$data,
    	];

    	echo json_encode($arr,JSON_UNESCAPED_UNICODE);die;
    } 
}