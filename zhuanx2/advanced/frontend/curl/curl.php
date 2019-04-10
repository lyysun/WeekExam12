<?php
namespace frontend\curl;

class curl{





         
































	public static function cl($url,$method='GET',$data=array()){
		
		$curl=curl_init(); //初始化
         // var_dump($url);die;
        curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);

		$data=http_build_query($data);
         
         switch ($method) {
			case 'GET':
		   
				$url=strstr($url,'?') ? '&'.$data : '?'.$data;
			
				break;
			case 'POST':
				curl_setopt($curl,CURLOPT_POST,1);
				curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
				break;
			case 'PUT':
				curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'PUT');
				curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
				break;
			case 'DELETE':
				curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'DELETE');
				curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
				break;
		   }
       
	    $data=curl_exec($curl);
  // var_dump($data);die;
		return json_decode($data,true);


	}
}