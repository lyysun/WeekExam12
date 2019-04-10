<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Week3;
/**
 * Site controller
 */
class Week3Controller extends Controller
{
         function actionAdd(){
         	$model=new Week3;
         	if ($model->load(yii::$app->request->post()) && $model->save()) {
         		echo "yes";
         	}else{
         		return $this->render("add",['model'=>$model]);
         	}
         }
          

          function actionShow(){
          	$model=new Week3;
          	$menu1=$model::find()->select("*")->where("level=1")->asArray()->all();
          	$menu2=$model::find()->select("*")->where("level=2")->asArray()->all();
             foreach ($menu1 as $k1 => $v1) {
             	$flag=1;
             	$i=0;
             	foreach ($menu2 as $k2 => $v2) {
             	       
             	       if ($v1['id']==$v2['pid']) {
             	           $flag=2;
             	           $button[$k1]['name']=$v1['name'];
             	           $button[$k1]['sub_button'][$i]['name']=$v2['name'];
             	           $button[$k1]['sub_button'][$i]['type']=$v2['type'];
             	           if($v2['type']=="click"){
             	           	  $button[$k1]['sub_button'][$i]['key']=$v2['val'];
             	           }else if($v2['type']=="view"){
             	           	$button[$k1]['sub_button'][$i]['url']=$v2['val'];
             	           }
             	           $i++;
             	       }
                 }

                 if($flag==1){
                 	$button[$k1]['name']=$v1['name'];
                 	$button[$k1]['type']=$v1['type'];
                 	if ($v1['type']=="click") {
                 		$button[$k1]['key']=$v1['val'];
                 	}else if($v1['type']=="view"){
                 		$button[$k1]['url']=$v1['val'];
                 	}
                 }
             }

             $arr['button']=$button;
             $data=json_encode($arr,JSON_UNESCAPED_UNICODE);
             $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->getToken();
             $str=$this->r($url,true,"post",$data);
             echo $str;

          	
          }  
    // 删除
          function actionDel(){
          	$url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->getToken();
          	$data=file_get_contents($url);
          	var_dump($data);
          }
          // 查询
          function actionIndex(){
          	$url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->getToken();
          	$data=file_get_contents($url);
          	$data=json_decode($data,true);
          	echo "<pre>";
          	var_dump($data);
          }



             function r($url,$https=false,$method="get",$data=null){
             	$ch=curl_init($url);
             	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             	if ($https==true) {
             		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
             	}
             	if($method=="post"){
             		curl_setopt($ch, CURLOPT_POST, 1);
             		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             	}
             	$str=curl_exec($ch);
             	curl_close($ch);
             	return $str;

             }
         function getToken(){
         	 $appid="wx2ea2b6a8b3e503a0";
             $appsecret="2256fb7535a572372d8d766cce358737";
             $filename="token.txt";
             if (file_exists($filename) && (time()-filemtime($filename))<7200) {
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
}