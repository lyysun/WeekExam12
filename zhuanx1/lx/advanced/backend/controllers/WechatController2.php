<?php
namespace backend\controllers;

use yii;
use yii\web\Controller;

class WechatController extends Controller{
	public $enableCsrfValidation=false;		// 禁用csrf验证
	public function actionValid(){
	    $echostr=yii::$app->request->get('echostr');
	    // 如果没有接入成功，则微信服务器会向开发者的服务器地址发送get请求，在请求中携带有echostr参数，
	    // 如果接入成功后，则请求中就不会再携带echostr参数了，
	    // 所以我们可以判断请求中是否有echostr参数，如果有则需要接入、验证，如果没有，则表示已经接入成功，可以进行业务处理了
		if(isset($echostr)){
			// 调用check方法，验证接入的有效性
			$this->check();
		}else{
			$this->receiveMessage();
		}
	}

	// 微信服务器和开发服务器相互验证的代码
	private function check()
	{

		$token='hello';		// 注意，此token值必须和 接口配置信息 中的token值一致
		// 当用户单击“提交”按钮后，微信服务器马上向咱们自己的服务器（阿里云）发送一个get请求，这个请求带了几个参数，我们需要接收一下
	    $signature=yii::$app->request->get('signature');
	    $timestamp=yii::$app->request->get('timestamp');
	    $nonce=yii::$app->request->get('nonce');

	    $echostr=yii::$app->request->get('echostr');

		$tmpArr = array($timestamp, $nonce,$token);		// 将接收到的3个字符串组合成数组
		sort($tmpArr, SORT_STRING);			// 将token、timestamp、nonce三个参数进行字典序排序
		$tmpStr = implode( $tmpArr );		// 将三个参数字符串拼接成一个字符串
		$tmpStr = sha1( $tmpStr );			// 进行sha1加密

		// 开发者经过上述步骤后获得了一个加密后的字符串（$tmpStr），将其$signature对比，如果二者相等，则说明该请求来源于微信，相互验证成功、请求合法有效
		if($signature==$tmpStr){
			echo $echostr;		// 如果接入成功，则向微信服务器发送echostr参数的值
		}else{
			return false;
		}
	}

     private function receiveMessage(){
      
     	$str=file_get_contents("php://input");
     	 //将xml格式的字符字符串转换成对象，以便解析
     	$obj=simplexml_load_string($str,'SimpleXMLElement',LIBXML_NOCDATA);
     	// 判断消息的类型，是否是文本信息
     	if($obj->MsgType=='text'){//MsgType	消息类型，event
	     		
	            switch ($obj->Content) { //判断$obj->Content等于什么
	            	case '课程':
	            		$content="课程有，语文，数学，化学";
	            		break;
	            	case '壮壮':
	            		$content="大傻逼比";
	            		break;
	            		case '风景':


	            		//发送图片
	            		$this->sendImageMessage($obj);//显示图片
	            		
	            	   	return;
	            	default:
	            		$content="选项有，’课程‘，‘壮壮’";
	            		break;
	            }
	            //调用封装好的xml数据包
	            $this->sendTextMessage($obj,$content);

          // 事件类型，subscribe(订阅)、unsubscribe(取消订阅) 判断是否关注
            }else if($obj->MsgType=="event" && $obj->Event=='subscribe'){ 
            	// $obj->Event == subscribe(订阅)代表已关注
            
            		$content="欢迎你，关注我们的公众号\n我们有以下这些课程\n1,'课程'\n2,'壮壮'\n开始学习吧！";
            		  $this->sendTextMessage($obj,$content);
            	
  	
     	}


     }
     //封装 推送XML数据包示例：
     function sendTextMessage($obj,$content){
     	$str="<xml>
     		 <ToUserName><![CDATA[%s]]></ToUserName>
     		 <FromUserName><![CDATA[%s]]></FromUserName>
     		 <CreateTime>%d</CreateTime>
     		 <MsgType><![CDATA[text]]></MsgType>
     		 <Content><![CDATA[%s]]></Content>
     		 </xml>";
        $res=sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$content);
        echo $res;
     }
        //发送到微信信息
       function sendImageMessage($obj){
       	$str="<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%d</CreateTime>
		<MsgType><![CDATA[image]]></MsgType>
		<Image><MediaId><![CDATA[%s]]></MediaId></Image>
		</xml>";
		//调用upload上传文件
		$media_id=$this->upload();

		$res=sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$media_id);
		echo $res;
       }
       
       //公共方法 获取acceccToken
       function getAccessToken(){
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


       public function upload(){
       	//调用acceccToken 获取token
       	$token=$this->getAccessToken();
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


       // 公共方法，cURL方式发送请求(实现了get请求和post请求，以及http和hptts请求地址)
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

}