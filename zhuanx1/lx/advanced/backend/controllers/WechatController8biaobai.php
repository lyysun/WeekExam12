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
    if ($obj->MsgType=="event") {

        if($obj->Event=="CLICK"){
           if ($obj->EventKey=="fabiaobai") {
                  $openid=$obj->FromUserName;
                  $addtime=time();
                  $sql="insert into moni5baction (openid,action,addtime) values('$openid','请输入表白人',$addtime)";
                  // file_put_contents("11.txt", $sql);
                  yii::$app->db->createCommand($sql)->execute();
                  $content="请输入表白人";
                  $res=$this->text($obj,$content);
                  echo $res;
           }else if($obj->EventKey=="chabiaobai"){

                   $content="输入查表白人的名字";
                   $res=$this->text($obj,$content);
                   echo $res;

           }

        }
    }else if($obj->MsgType=="text"){
             $openid=$obj->FromUserName;
             $addtime=time();
            
            //查询moni5baction表中的 最后一个时间
            $sql="select * from moni5baction where openid='$openid' order by addtime desc limit 1";
            $data=yii::$app->db->createCommand($sql)->queryone();
            
            //查询moni5bbiaobai表中的表白人
            $sql="select * from moni5bbiaobai where id=1";
            $arr=yii::$app->db->createCommand($sql)->queryone();

          if($data['action']=="请输入表白人"){
               //添加动作action
                $sql="insert into moni5baction (openid,action,addtime) values('$openid','请输入表白内容',$addtime)";
                yii::$app->db->createCommand($sql)->execute();
                    
                //修改content
               $sql="update moni5bbiaobai set ren='$obj->Content' where id=1";
                yii::$app->db->createCommand($sql)->execute();


                $content="请输入表白内容";
                $res=$this->text($obj,$content);
                echo $res;

          }else if($data['action']=="请输入表白内容"){
                //添加动作action
                $sql="insert into moni5baction (openid,action,addtime) values('$openid','表白成功',$addtime)";
                yii::$app->db->createCommand($sql)->execute();

               //修改content
                $sql="update moni5bbiaobai set content='$obj->Content' where id=1";
                yii::$app->db->createCommand($sql)->execute();

                $content="表白成功";
                $res=$this->text($obj,$content);
                echo $res;
          }else if($arr['ren']==$obj->Content){

                $content=$arr['ren'].$arr['content'];
                $res=$this->text($obj,$content);
                echo $res;
          }
    }
  }

   function text($obj,$content){
    $xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
    $res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
    return $res;
  }
}