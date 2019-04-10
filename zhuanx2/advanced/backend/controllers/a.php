<?php


        public static function gtoken(){

          $user="admin";
          $pwd="123";
            $json_data=file_get_contents(__DIR__."/../config/token.txt");
            $data=json_decode($json_data,true);
            if(!$json_data){
               $url="http://47.93.25.138/lyy/x2/advanced/backend/web/index.php?r=login/gtoken&user=".$user."&pwd=".$pwd;
               $data=curl::cl($url,"GET");
       
               $token=['token'=>$data['res']];
              $json_data=json_encode($token);
               file_put_contents(__DIR__."/../config/token.txt", $json_data);

            }

         

          echo $data['token'];die;

        }



       public static function token(){
       	
       	$user="admin";
       	$pwd="123";
         
      $json_data=file_get_contents(__DIR__ . '/../config/token1.txt');
      $data=json_decode($json_data,true);
  
      // 没有数据时进行if判断  时间是否超时
      if(!$json_data || ($data['time']+1000)< time() ){
          // URL连接 指的是 把数据存入数据库
          $url="http://47.93.25.138/lyy/x2/advanced/backend/web/index.php?r=login/gettoken&user=".$user.'&pwd='.$pwd;
  

         $data=curl::cl($url,'GET');

         // data 返回 res指的是token 和时间
         $data=['token'=>$data['res'],"time"=>time()];
         $json_data=json_encode($data);
         
        file_put_contents(__DIR__ . '/../config/token1.txt', $json_data);

      }
      // var_dump($data);die;x
      return $data['token'];


       }

  
       public static function sign($data=array()){
        	$token='token';
        	 ksort($data);
        	// 数组变成字符串
       	$data=http_build_query($data);
       	// var_dump($data);die;
        $sign=md5($data.$token);
        // var_dump($sign);die;
        return $sign;

       }