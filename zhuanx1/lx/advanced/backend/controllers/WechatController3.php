<?php
namespace backend\controllers;

use yii;
use yii\web\Controller;

class WechatController extends Controller{
	public $enableCsrfValidation=false;
	public function actionValid(){
		
		$this->receiveMessage();	
	}

	public function receiveMessage(){
		$str=file_get_contents("php://input");
		$obj=simplexml_load_string($str,'SimpleXMLElement',LIBXML_NOCDATA);
		if($obj->MsgType=='event'){
			switch($obj->Event){
				case 'subscribe':
					$result=$this->reponseSubscribe($obj);
					echo $result;		// 回复		
					break;
				case 'CLICK':			// 单击了菜单
					if($obj->EventKey=='V1001_GOOD'){		// 
						$sql='update dianzan set num=num+1';
						Yii::$app->db->createCommand($sql)->execute();


					}else if($obj->EventKey=='V1001_TODAY_MUSIC'){		// 

					}
			}
		}
	}

	// 把用户关注后回复功能写在一个单独的方法中，以便精简、结构化代码
	public function reponseSubscribe($obj){
		// 1 调用接口获取用户信息、入库（存入user1表中）
		// http请求方式: GET
		$openid=$obj->FromUserName;
		$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getToken()."&openid=".$openid."&lang=zh_CN";
		$str=file_get_contents($url);
		$data=json_decode($str,true);

		$arr['openid']=$data['openid'];
		$arr['nickname']=$data['nickname'];		// 昵称
		$arr['figure']=$data['headimgurl'];
		$arr['city']=$data['city'];
		$arr['addtime']=time();

		// 2 入库
		Yii::$app->db->createCommand()->insert('user1', $arr)->execute();	// 入库

		// 3 给用户回复信息
		$textTemplate="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
		$content="您好，".$arr['nickname']."\n感谢您关注我们，\n回复 0，获取课程信息\n回复 1，获取讲师信息\n回复 2，获取学校地址";
		$result=sprintf($textTemplate,$obj->FromUserName,$obj->ToUserName,time(),$content);		
		return $result;
	}

	public function getToken(){
		$filename='token.txt';
		if(file_exists($filename) && (time()-filemtime($filename))<7200){
			$token=file_get_contents($filename);
		}else{
			//https请求方式: GET
			$appid='wx46e5b04f365f2596';
			$appsecret='e2afbfacf9cb6ef66ac8f3cd92a5e742';
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
			$str=file_get_contents($url);
			$data=json_decode($str,true);
			$token=$data['access_token'];	
			// 将通过调用接口获取到的token存放到文件中
			file_put_contents($filename, $token);		
		}
		return $token;
	}
}