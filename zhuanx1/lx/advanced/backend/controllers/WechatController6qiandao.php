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
      if($obj->MsgType=="event"){
                if ($obj->Event=="subscribe") {

                    $openid=$obj->FromUserName;
                    $integ=0;
                     $sql="insert into moni4a (openid,integ) values('$openid','$integ')";
                    
                     yii::$app->db->createCommand($sql)->execute();
                    $content="谢谢你的 关注";
                    $str=$this->text($obj,$content);
                    echo $str;
                }else if($obj->Event=="CLICK"){
                       

                       if ($obj->EventKey=="qiandao") {

                          // 查询数据库有无信息
                           $openid=$obj->FromUserName;
                           $sql="select * from moni4a2 where openid='$openid'";
                           $data=yii::$app->db->createCommand($sql)->queryone();
        
                         if($data){
                                 
                                 $addtime=$data['addtime'];
                                 $time1=date("Y-m-d",$addtime); //年月日
                                 $time2=date("Y-m-d",time());
                                 if($time1==$time2){
                                     $content="今天已签到";
                                     $str=$this->text($obj,$content);
                                     echo $str;
                                 }else{
                                    //修改签到的积分
                                    $time=time();
                                    $sql="update moni4a set integ=integ+10 where openid='$openid'";
                                    yii::$app->db->createCommand($sql)->execute();
                                  //修改签到的时间 换成最新时间
                                     $sql="update moni4a2 set addtime=$time where openid='$openid'";
                                    yii::$app->db->createCommand($sql)->execute();
                                   $content="签到成功";
                                   $str=$this->text($obj,$content);
                                   echo $str;
                                     
                                 }

                         }else{
                           
                             // 第一次数据库里面没有东西
                              $time=time();
                              $sql="insert into moni4a2 (openid,addtime) values('$openid',$time)";
                              yii::$app->db->createCommand($sql)->execute();
                              //修改积分
                              $sql="update moni4a set integ=10 where openid='$openid'";
                               yii::$app->db->createCommand($sql)->execute();
                               $content="签到成功";
                               $str=$this->text($obj,$content);
                               echo $str;
                         }


                               // 查有多少积分
                       }else if($obj->EventKey=="show"){
                            $openid=$obj->FromUserName; 
                            $sql="select * from moni4a where openid='$openid'";
                            $data=yii::$app->db->createCommand($sql)->queryone();
                            $integ=$data['integ'];
                            $str=$this->text($obj,$integ);
                               echo $str;
                       }

                }


           }
         
  }
       


       function text($obj,$content){
         $xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
        $res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
        return $res;
        }

      }