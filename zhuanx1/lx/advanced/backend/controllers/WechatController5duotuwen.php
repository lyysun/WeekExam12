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
       
          $this->rm();
     }  
		
	 function rm(){
    $str=file_get_contents("php://input");
    $obj=simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
    if ($obj->MsgType=="text") {
           $data=$obj->Content;
            $sql="select * from news where title like '%$data%'";
            // $filename="token33.txt";
            
            $res=yii::$app->db->createCommand($sql)->queryOne();
           if($res){
             $res=$this->tw($obj,$res);
              echo $res;
           }else{
                $content="goods";
                $res=$this->text($obj,$content);
                echo $res;
           }
   
      
      }else if($obj->MsgType=="event" && $obj->Event=="CLICK"){
            if ($obj->EventKey=='php') {
                $sql="select * from news order by id asc limit 3";
            // file_put_contents('/temp/1.txt',$sql);
              $data=yii::$app->db->createCommand($sql)->queryAll();

                $res=$this->tw1($obj,$data);
                 echo $res;
                 
                   }       
      }
  }
       
       function text($obj,$content){
    $xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
    $res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
    return $res;
  }
 

  function tw1($obj,$data){
         $xml="<xml>
         <ToUserName><![CDATA[%s]]></ToUserName>
         <FromUserName><![CDATA[%s]]></FromUserName>
         <CreateTime>%d</CreateTime>
         <MsgType><![CDATA[news]]></MsgType>
         <ArticleCount>3</ArticleCount>
         <Articles>%s</Articles>
         </xml>";
          
          $arr="<item>
          <Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description>
         <PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url>
         </item>";
         $res='';
         foreach ($data as $key => $value) {
             $res.=sprintf($arr,$value['title'],$value['summary'],$value['path'],$value['link']);
        }
      
      $request=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$res);
     
       
      return $request;
   
  }

   

  function tw($obj,$data){
         $xml="<xml>
         <ToUserName><![CDATA[%s]]></ToUserName>
         <FromUserName><![CDATA[%s]]></FromUserName>
         <CreateTime>%d</CreateTime>
         <MsgType><![CDATA[news]]></MsgType>
         <ArticleCount>1</ArticleCount>
         <Articles>
         <item>
         <Title><![CDATA[%s]]></Title>
         <Description><![CDATA[%s]]></Description>
         <PicUrl><![CDATA[%s]]></PicUrl>
         <Url><![CDATA[%s]]></Url></item>
         </Articles></xml>";
         
         $request=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$data['title'],$data['summary'],$data['path'],$data['link']);

         return $request;
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


       function actionInfo(){
        
           $appid="wx2ea2b6a8b3e503a0";
           $redirect_uri="http://47.93.25.138/lyy/advanced/backend/web/index.php?r=wechat/info";
           $appsecret="2256fb7535a572372d8d766cce358737";


           $code=yii::$app->request->get("code");

           if(!$code){
            //当没有code时获取code
             $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=123abc#wechat_redirect";
             header("Location:$url");
           }else{
               $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
               $str=file_get_contents($url);
               $data=json_decode($str,true);
              
               $token=$data['access_token'];
               $openid=$data['openid'];
              //获取个人信息链接
               $url="https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid&lang=zh_CN";

              
               $str=file_get_contents($url);
               $data=json_decode($str,true);
             
               $nickname=$data['nickname'];
               $figure=$data['headimgurl'];
               $sex=$data['sex'];
               $city=$data['city'];
                return $this->render("info",['nickname'=>$nickname,'figure'=>$figure,'sex'=>$sex,'city'=>$city]);
           }
         
       }
}