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
class Day13Controller extends Controller
{    

    function actionAdd(){
        $str=file_get_contents("php://input");
        $obj=simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
        if ($obj->MsgType=="event" && $obj->Event=="subscribe") {
        	
        	 $openid=$obj->FromUserName;

    	   $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getToken()."&openid=$openid&lang=zh_CN";
    	 
             $data=file_get_contents($url);
            $data=json_decode($data,true);
            $nickname=$data['nickname'];
            $city=$data['city'];
            $sql="insert into day13 values('','$nickname','$city')";
            yii::$app->db->createCommand($sql)->execute();
             
        }
      

    }
//获取token
    function getToken(){
    	$appid="wx2ea2b6a8b3e503a0";
    	$appsecret="2256fb7535a572372d8d766cce358737";
    	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    	$data=file_get_contents($url);
    	$data=json_decode($data,true);
    	$token=$data['access_token'];
    	return $token;
    }

 }