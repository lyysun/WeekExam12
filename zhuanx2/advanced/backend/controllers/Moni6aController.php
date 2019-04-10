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
class Moni6aController extends Controller
 { 
 	public $enableCsrfValidation=false;
 	function actionImg(){
           
         $sql=" select * from xiaoshuo_chart limit 2";
         $data=yii::$app->db->createCommand($sql)->queryAll();
         fz::Ms(1004,$data);
 	}

 	function actionType(){
 		$sql=" select * from xiaoshuo_type limit 3";
         $data=yii::$app->db->createCommand($sql)->queryAll();
         fz::Ms(1004,$data);
 	}

 	function actionDetail(){
 		 $type_id=yii::$app->request->get("id");
           
         if($type_id){
         	$where=" where type_id=".$type_id;
         	 $sql=" select * from xiaoshuo_detail ".$where." limit 2";
            $data=yii::$app->db->createCommand($sql)->queryAll();
            fz::Ms(1004,$data);
         }else{
                $sql=" select * from xiaoshuo_detail limit 2";
         $data=yii::$app->db->createCommand($sql)->queryAll();
         fz::Ms(1004,$data);
         }

 		
 	}

 	function actionUpdate(){
 		$detail_id=yii::$app->request->get("id");
 		$sql="update xiaoshuo_detail set xs_zan=xs_zan+1 where detail_id=$detail_id";
 		$data=yii::$app->db->createCommand($sql)->execute();
         fz::Ms(1004,$data);
 	}
  
  }