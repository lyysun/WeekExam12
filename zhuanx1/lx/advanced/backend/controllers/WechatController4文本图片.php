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
	function actionValid(){
        $echostr=yii::$app->request->get("echostr");
        if (isset($echostr)) {
           $this->check();
        }else{
          $this->rm();
        }
		
	}
  function check(){
        $token="hello";
          $signature= yii::$app->request->get("signature");
          $timestamp =yii::$app->request->get("timestamp");
           $nonce=yii::$app->request->get("nonce");
          $echostr=yii::$app->request->get("echostr");
        $tmpArr = array($token,$timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $signature ==$tmpStr){
        echo  $echostr;
        }else{
        return false;
        }
    }


	function rm(){
		$str=file_get_contents("php://input");
		$obj=simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
		if ($obj->MsgType=="text") {
			 switch ($obj->Content) {
			 	case '你好':
			 		$content="good";
			 		break;
			 	 
			 	  case '风景':

	            		//发送图片
	            		$this->sendImageMessage($obj);//显
			 		break;
			 	default:
			 		$content="no";
			 		break;
			 }
			$this->text($obj,$content);
			
		}
	}
     
    function sendImageMessage($obj){
       	$str="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>";
		//调用upload上传文件
		$media_id=$this->upload();

		$res=sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$media_id);
		echo $res;
       }
       
    
    public function upload(){
       	//调用acceccToken 获取token
       	$token=$this->getToken();
       	//获取acces_token
       	$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=image";
       	//云上的图片路径
       	$filename="/usr/share/nginx/html/lyy/advanced/backend/web/img/p1.jpg";
       	$filename=new \CURLFile($filename);
       	$data=array('media'=>$filename);
       	//调用request方法 获取media_id；
       	$str=$this->request($url,true,'post',$data);
       	$data=json_decode($str,true);
       	$media_id=$data['media_id'];
       	return $media_id;
       }


   function getToken(){
       	  $appid="wx2ea2b6a8b3e503a0";
       	  $appsecret='2256fb7535a572372d8d766cce358737';
       	  $filename='token.txt';
       	  //缓存
       	  if(file_exists($filename) && (time()-filemtime($filename))<7200){
       	  	$token=file_get_contents($filename);

       	  }else{
              $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
              $str=file_get_contents($url);
              $data=json_decode($str,true);
              $token=$data['access_token'];
              file_put_contents($filename, $token);
             
       	  } 
       	  return $token;

       }

       function request($url,$https=false,$method="get",$data=null){
       	$ch=curl_init($url);
       	curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
       	// 判断是否是https请求
          if($https==true){
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          }
           // 判断是否是post请求
          if($method=="post"){
          	curl_setopt($ch, CURLOPT_POST, TRUE);
          	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          }
          $str=curl_exec($ch);
          curl_close($ch);
          return $str;

       }

	function text($obj,$content){
		$xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
		$res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
		echo $res;
	}
}