<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class Day19Controller extends Controller
{  
	public $enableCsrfValidation=false;

     function actionValid(){
     	$this->rm();
     }

	function rm(){
		$str=file_get_contents("php://input");
		$obj=simplexml_load_string($str,'SimpleXMLElement',LIBXML_NOCDATA);
		
       if($obj->MsgType=="event"){
       	  if($obj->Event=="subscribe"){
	       	  	$openid=$obj->FromUserName;
	       	  	$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getToken()."&openid=$openid&lang=zh_CN";
				$data=file_get_contents($url);
				$data=json_decode($data,true);
			     $nickname=$data['nickname'];
			      $sex=$data['sex'];
			      $city=$data['city'];
			      $sql="insert into day19 (nickname,sex,city) values('$nickname','$sex','$city')";
			      yii::$app->db->createCommand($sql)->execute();

       	  }
       }
		

	}

	function getToken(){
		 $appid="wx2ea2b6a8b3e503a0";
         $appsecret="2256fb7535a572372d8d766cce358737";
         $filename="token.txt";
         if(file_exists($filename) && (time()-filemtime($filename))<7200){
         	$token=file_get_contents($filename);

         }else{
                $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
                $data=file_get_contents($url);
                $data=json_decode($data,true);
                $token=$data['access_token'];
                file_put_contents("$filename", $token);

         }
         return $token;

	    


	}
   
   }