<?php 

class api{

       private static $_token="123";

       public static function sign($params){
       	// var_dump(11);die;
       	// var_dump($params);die;
       	if(!isset($params['sign'])){ //如果没有就输出
       		return false;
       	}
        
        $sign = $params['sign'];
      
          if(self::$_token == $sign){
          	return true;
          }

          return false;
       }
        
        public static function status($data=[],$code=200,$msg=""){
        	echo json_encode([

                     "data"=>$data,
                     "code"=>$code,
                     "msg"=>$msg,
        		]);die;
        }

 

}

?>