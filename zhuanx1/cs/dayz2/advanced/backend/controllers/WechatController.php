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
	}
	public function rM(){
		$str=file_get_contents("php://input");
		$obj=simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
		if($obj->MsgType=="event" && $obj->Event=="subscribe"){
			// 添加入库
			$openid=$obj->FromUserName;
			$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getToken()."&openid=".$openid."&lang=zh_CN";
			$data=file_get_contents($url);
			$data=json_decode($data,true);
			$arr=array(
                    "openid"=>$data['openid'],
                    "name"=>$data['nickname'],
                    "tx"=>$data['headimgurl'],
                    "city"=>$data['city'],
                    "adddtime"=>time(),

				);
      Yii::$app->db->createCommand()->insert('user1',$arr)->execute();

             $str="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
             $content="您好，xyz\n感谢您关注我们\n回复0，获取课程信息\n回复0，获取讲师信息\n回复0，获取课学校地址";
             $res=sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$content);
             echo $res;


		}
	}


// 获取token值
  public function getToken(){
      $appid="wx2ea2b6a8b3e503a0";
      $appsecret="2256fb7535a572372d8d766cce358737";
      $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
      $data=file_get_contents($url);
      $data=json_decode($data,true);
      $token=$data['access_token'];
      return $token;
  }

}