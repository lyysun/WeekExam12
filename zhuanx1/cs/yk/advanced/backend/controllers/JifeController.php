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
class JifeController extends Controller
{
     public $enableCsrfValidation=false;
     public function actionValid(){
     	$echostr=yii::$app->request->get("echostr");
     	if(isset($echostr)){
     		$this->check();
     	}else{
     		$this->rm();
     	}
     }

     public function check(){
     	   $token="yekao";
	     	$signature=yii::$app->request->get("signature");
	       $timestamp=yii::$app->request->get("timestamp");
	       $nonce=yii::$app->request->get("nonce");

		$tmpArr = array($timestamp, $token,$nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $signature ==$tmpStr){
		   $echostr=yii::$app->request->get("echostr");
		   echo $echostr;
		}else{
		return false;
		}
     }

     public function rm(){

     	$str=file_get_contents("php://input");
     	$obj=simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
     	if($obj->MsgType=="event"){

     		if($obj->Event=="subscribe"){
     			 
                 $openid='1111';
                 $integ=0;
                 $data=array(
                        "openid"=>$openid,
                        "integ"=>$integ,
                 	);
                  
                 yii::$app->db->createCommand()->insert('yk_user',$data)->execute();
                 $content="欢迎关注我的公众号";
                 $res=$this->text($obj,$content);
                 echo $res;

     		}else if($obj->Event=="CLICK"){

     			if($obj->EventKey=="qiandao"){
     				
     			   $sql="select * from yk_jilu";
     			   $data=yii::$app->db->createCommand($sql)->queryone();
     			   if($data){
                           
                           $addtime=$data['addtime'];
                           $time1=date("Y-m-d",$addtime);
                           $time2=date("Y-m-d",time());
                           //判断是否今天签到
                           if ($time1==$time2) {
                                   $content="今天已签到";

		                        $res=$this->text($obj,$content);
		                       echo $res;
                           }else{
                                   $time=time();
                                   $sql="update yk_user set integ=integ+10";
                                   yii::$app->db->createCommand($sql)->execute();
                                    $sql="update yk_user set addtime=$time";
                                   yii::$app->db->createCommand($sql)->execute();
                                   $content="签到成功";

					               $res=$this->text($obj,$content);
					               echo $res;

                           }



     			   }else{
     			   	// 第一次签到
                         $time=time();
                         $openid="111";
                         $sql="update yk_user set integ=10";
                          yii::$app->db->createCommand($sql)->execute();
                           $sql="insert into yk_jilu (openid,addtime) values('$openid',$time)";
                          yii::$app->db->createCommand($sql)->execute();
                          $content="签到成功";

		                 $res=$this->text($obj,$content);
		                 echo $res;
     			   }
     			   // 查询积分
     			}else if($obj->EventKey=="chaxun"){
                        
     			   $sql="select * from yk_user";
     			   $data=yii::$app->db->createCommand($sql)->queryone();
     			   $content="您的积分为：".$data['integ'];
     			   $res=$this->text($obj,$content);
		                 echo $res;

     		        }
     		}
     	}
     }
    //文本回复
     public function text($obj,$content){
     	$xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
        $res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
        return $res;
     }
}