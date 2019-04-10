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
class Day4Controller extends Controller
{

	function actionToken(){
		$appid='wx2ea2b6a8b3e503a0';
		$appsecret='2256fb7535a572372d8d766cce358737';
		$filename='token.txt';

		if(file_exists($filename) && (time()-filemtime($filename))<7200){
			$token=file_get_contents($filename);

			//echo $token;
		}else{
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";	
             // var_dump($url);die;
			$str=file_get_contents($url);	
			// var_dump($str);die;	
			$data=json_decode($str,true);	
			// var_dump($data);die;	
			$token=$data['access_token'];
			
			file_put_contents($filename, $token);		
		}
		return $token;
		

	}
}