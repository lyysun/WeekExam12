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
            //点击答题按钮
         		 if($obj->EventKey=="dati"){
                    $id=rand(1,2);
                    $sql="select * from moni4bst where id=$id";
                    $data=yii::$app->db->createCommand($sql)->queryone();
                    $zq=$data['zq'];
                    //存一下正确答案
                    yii::$app->cache->set("zq",$zq);
                    $content=$data['title']."=？    A.答案23，B，答案4";
                    $res=$this->text($obj,$content);
                    echo $res; 
              //点击查询按钮
         		 }else if($obj->EventKey=="show"){

                     $sql="select * from moni4buser";

                    $data=yii::$app->db->createCommand($sql)->queryone();
                     
                    $v=$data['v'];
                    $x=$data['x'];

                    $content="答对:".$v."   答错：".$x;
                    $res=$this->text($obj,$content);
                    echo $res; 
                 }
              }
         	
         //输入答案
         }else if($obj->MsgType=="text"){
               $daan= yii::$app->cache->get("zq");
               //判断前台发送过来的是否正确
               if($obj->Content==$daan){
                     $sql="update moni4buser set v=v+1";
                      yii::$app->db->createCommand($sql)->execute();
                  	$content="恭喜你答对了";
                    $res=$this->text($obj,$content);
                    echo $res;
               }else{
                 $sql="update moni4buser set x=x+1";
                      yii::$app->db->createCommand($sql)->execute();
                    $content="抱歉答题错误";
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