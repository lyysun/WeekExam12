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
class Day20Controller extends Controller
{
   function actionAdd(){
     
    if(yii::$app->request->isPost){
    	$data=yii::$app->request->post();
    	yii::$app->db->createCommand()->insert("day20",$data)->execute();
    }

   	return $this->render("add");
   }

   function actionShow(){
   	$meun1=yii::$app-db->createCommand("select * from day20 where level=1")->queryAll();
   	$meun2=yii::$app->db->createCommand("select * from day20 where level=2")->queryAll();
   	foreach ($meun1 as $k1 => $v1) {
   		$flag=1;
   		$i=0;
   		foreach ($meun2 as $k2 => $v2) {
   			 if($v1['id']==$v2['pid']){
   			 	$flag=2;
   			 	$button[$k1]['name']=$v1['name'];
   			 	$button[$k1]['sub_button'][$i]['name']=$v2['name'];
   			 	$button[$k1]['sub_button'][$i]['type']=$v2['type'];
   			 	if($v2['type']=="click"){
   			 		$button[$k1]['sub_button'][$i][
   			 		'key']=$v2['val'];
   			 	}else if($v2['type']=="view"){
   			 		$button[$k1]['sub_button'][$i]['url']=$v2['val'];
   			 	}
   			 }
   		}

   		if($flag==1){
   			$button[$k1]['name']=$v1['name'];
   			$button[$k1]['type']=$v1['type'];
   			if($v1['type']=="click"){
             $button[$k1]['key']=$v1['val'];
   			}else if($v1['type']=="view"){
             $button[$k1]['url']=$v1['val'];
   			}
   		}
   	}
   }
//查询
   function actionIndex(){
   	$url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->getToken();
   	$data=file_get_contents($url);
   	$data=json_decode($data,true);
   	var_dump($data);
   }
}