<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\fz\fz;

/**
 * Site controller
 */
class CommonController extends Controller
{
     //初始化 
     function init(){

        // 验证签名
        // if(!$this->check_sign()){
        //       fz::Ms(1);
        // }

        // 判断token是否相同
        $this->check_token();

     }
     //查询token是否过期
     public function check_token(){
     	$token=yii::$app->request->get("token");
     	if(empty($token)){
     		fz::Ms(3);//判断token是否存在
     	}
        //判断token是否相同
     	$sql="select * from redis where token='$token' order by time desc ";
     	$res=yii::$app->db->createCommand($sql)->queryone();
     	if(!$res){
     		fz::Ms(4);
     	}
        //判断token是否过期
     	// if(($res['time']+1000) < time()){
     	// 	fz::Ms(5);
     	// }
     }

     public function check_sign(){
     	$token="token";
     	$data=yii::$app->request->get(); //从前台传过来的
      
     	$sign=$data['sign'];//前台的
       
     	unset($data['r']);
     	unset($data['sign']); //删除原先的
     	ksort($data);
     	$data=http_build_query($data);
     	$check_sign=md5($data.$token);//本地的sign
     
     	if($check_sign==$sign){
     		return true;
     	}else{
     		return false;
     	}
     }

}