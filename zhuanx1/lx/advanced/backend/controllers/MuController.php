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
class MuController extends Controller
{
         function actionAdd(){

         	$menu='{
				     "button":[
				     {    
				          "type":"click",
				          "name":"今日歌曲",
				          "key":"V1001_TODAY_MUSIC"
				      },
				      {
				           "name":"菜单",
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
	   	$str=$this->request($url,true,'post',$menu);		// 调用创建菜单的接口，微信服务器接收到请求后，就后生成微信菜单
	 		echo $str;	
          // echo $url;
         }


       function actionDelete(){
       	$url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->getToken();
       	echo file_get_contents($url);

       }
        function actionShow(){
       	$url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->getToken();
       	echo file_get_contents($url);

       }


         function getToken(){
         	$appid="wx2ea2b6a8b3e503a0";
         	$appsecret="2256fb7535a572372d8d766cce358737";
         	$filename="token.txt";
         	if(file_exists($filename) && (time()-filemtime($filename))<7200){
         		$token=file_get_contents($filename);
         	}else{
         			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
         	$data=file_get_contents($url);
         	$data=json_decode($data,true);
         	$token=$data['access_token'];
         	file_put_contents($filename, $token);
         	}
         
         	return $token;
         }


         function request($url,$https=false,$method="get",$data=null){
         	$ch=curl_init($url);
         	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         	if($https==true){
	        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	       
		    }
		    // 判断是否是post请求
		    if($method=='post'){
		        curl_setopt($ch, CURLOPT_POST, TRUE);
		        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		    }
		    $str = curl_exec($ch);		// 发送请求，获取数据
		    curl_close($ch);
		    return  $str;
	     }
}