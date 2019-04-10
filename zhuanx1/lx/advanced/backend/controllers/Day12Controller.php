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
class Day12Controller extends Controller
{    //创建菜单
      function actionMenu(){
           $menu='{
			     "button":[
			     {    
			          "type":"click",
			          "name":"学习",
			          "key":"V1001_TODAY_MUSIC"
			      },
			      {
			           "name":"看一看",
			           "sub_button":[
			           {    
			               "type":"view",
			               "name":"搜索",
			               "url":"http://www.soso.com/"
			            },
			          
			            {
			               "type":"click",
			               "name":"赞一下我们",
			               "key":"V1001_GOOD"
			            }]
			       }]
			 }';
            $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->getToken();

			 $str=$this->request($url,true,'post',$menu);
			 echo $str;
      }

   // 菜单删除接口
      function actionDel(){
      	$url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->Token();
      	$res=file_get_contents($url);
      	$data=json_decode($res,true);
      	echo $data;
      }
   //获取token
      function getToken(){
      	$appid="wx2ea2b6a8b3e503a0";
      	$appsecret="2256fb7535a572372d8d766cce358737";
      	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
      	$data=file_get_contents($url);
      	$data=json_decode($data,true);
      	$token=$data['access_token'];
      	return $token;
      }


      //调用结果
     function request($url,$https=false,$method="get",$data=null){
     	$ch=curl_init($url);
     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     	if ($https==true) {
     		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     	}
     	if ($method=="post") {
     		curl_setopt($ch, CURLOPT_POST, 1);
     		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

     	}
     	$str=curl_exec($ch);
     	curl_close($ch);
     	return $str;
     }
}