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
class WechatController extends Controller
{
  public $enableCsrfValidation=false;
  public function actionValid(){

    $this->rM();
    // $this->receiveMessage();
  }
  public function rM(){
  	   $str=file_get_contents("php://input");
  	   $obj=simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
        
        if($obj->MsgType=="event" && $obj->Event=="subscribe"){

        	$openid=$obj->FromUserName;
        	

        	$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getToken()."&openid=".$openid."&lang=zh_CN";
        	$data=file_get_contents($url);
        	$data=json_decode($data,true);
        	
        	$arr=array(
                  "openid"=>$data['openid'],
                  "name"=>$data['nickname'],
                  "ts"=>$data['headimgurl'],
                  "city"=>$data['city'],
                  "addtime"=>time(),

        		);

        	
        	Yii::$app->db->createCommand()->insert('user1',$arr)->execute();

               $xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
               $content="您好";
               $res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
               echo $res;


        }

  }

  public function getToken(){
  	$appid="wx2ea2b6a8b3e503a0";
  	$appsecret="2256fb7535a572372d8d766cce358737";
  	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
  	$data=file_get_contents($url);
  	$data=json_decode($data,true);
  	// var_dump($data);
  	$token=$data['access_token'];
  	// var_dump($token);
  	return $token;
  }

}