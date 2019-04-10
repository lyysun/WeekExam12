<?php 

namespace backend\fz2;
class fz2{

       public static $code=[
                0=>"未知错误",
                1=>"请求成功",
                2=>"密码或账号有误",

       ];

       public static function Ms($code,$data=array()){

       	$arr=[

           "code"=>$code,
           "msg"=>self::$code[$code],
           "res"=>$data,
       	];

       	echo json_encode($arr,JSON_UNESCAPED_UNICODE);die;
       }

}