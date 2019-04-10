<?php
class api{

     private static $_token="123";

       public static function sign($params){
           
           $sign=$params['sign']; //前台传过来的 sign
           unset($params['sign']);
           foreach ($params as $k => $v) {
           	  if (empty($v)) { //如果值为空就删除这个字段
           	  	  unset($params[$k]);
           	  }
           }
           ksort($params);
           $str=http_build_query($params); //a=123&b=123
           $md5=md5($str.self::$_token);
           if($md5 == $sign){
           	return true;
           }

       }

       public static function status($data=[],$code=200,$msg=''){
        echo json_encode([
              "data"=>$data,
              "code"=>$code,
              "msg"=>$msg,
          ]);die;
       } 

}


?>