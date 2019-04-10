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
     	$obj=simplexml_load_string($str,'SimpleXMLElement',LIBXML_NOCDATA);
     	if($obj->MsgType=="event"){
     		 if($obj->Event=="CLICK"){
     			 if($obj->EventKey=="chakan"){
                $this->chakan($obj);
     			}
     		}
     	}
     }
     
        function chakan($obj){

            $openid=$obj->FromUserName;
            // 查询moni6bap数据表 最后一个id
            $sql="select * from moni6bap where openid='$openid' order by id desc limit 1";
            $data=yii::$app->db->createCommand($sql)->queryone();
            if($data){
                 //moni6bap 字符串转换成数组
                 $arr=explode(',', $data['kcid']);
                 //moni6bkc 查询所有的课程
                 $sql="select id,name from moni6bkc";
                 $data=yii::$app->db->createCommand($sql)->queryAll();
                 // 从记录集中取出 id 列 作为值，用相应的 "name" 列作为键值：
                 $data1=array_column($data,'id','name');

                foreach ($arr as $key => $value) {
                  if($k=array_search($value, $data1)){
                     $data2[]=$k;  //输出建的值
                  }
                }


                $content="你选择的课程\n
                          第一节课：{$data2[0]}\n
                          第二节课：{$data2[1]}\n
                          第三节课：{$data2[2]}\n
                          第四节课：{$data2[3]}\n";
                $res=$this->text($obj,$content);
                echo $res;

            }else{
              $content="请选择课程";
                $res=$this->text($obj,$content);
                echo $res;
            }


        }

          function text($obj,$content){
            $xml="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%d</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
            $res=sprintf($xml,$obj->FromUserName,$obj->ToUserName,time(),$content);
            return $res;
          }

    //点击管理课程 url是个链接
     function actionAdd(){
          if(yii::$app->cache->get("openid")){
              //取出openid添加入库
             $openid=yii::$app->cache->get("openid");

              if(yii::$app->request->isPost){
              	$data=yii::$app->request->post();
              	$data=implode(',',$data['name']);  //转成字符串

              	$sql="insert into moni6bap (openid,kcid,kj) values('$openid','$data','')";
              	yii::$app->db->createCommand($sql)->execute();
              	echo "成功";
              }else {
	              	$sql="select * from moni6bkc";
	                $data=yii::$app->db->createCommand($sql)->queryAll();
	                return $this->render("add",['data'=>$data]);
              }

           }else{

           	      $appid="wx2ea2b6a8b3e503a0";
                  $appsecret="2256fb7535a572372d8d766cce358737";
                  $code=yii::$app->request->get('code');
    	
          				$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
          				$str=file_get_contents($url);
          				$data=json_decode($str,true);
          				$openid=$data['openid'];	
                  yii::$app->cache->set("openid",$openid);
                  // 展示add页面数据
                  $sql="select * from moni6bkc";
                  $data=yii::$app->db->createCommand($sql)->queryAll();
                  return $this->render("add",['data'=>$data]);


           }
     }
}