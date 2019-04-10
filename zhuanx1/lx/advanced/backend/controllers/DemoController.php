<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\demo;

/**
 * Site controller
 */
class DemoController extends Controller
{  
 // public $layout=false;
   // 无极限分类
   public function actionAdd(){
        $model=new Demo;
        $data = $model::find()->all();
        $data1=$model->generateTree($data,0,0);
        echo "<pre>";
        // var_dump($data1);die;

		$idArr= array_column($data1,"id");
		// var_dump($idArr);die;

					// 获取$data1数组中所有id元素————形成独立的一维数组
		$nameArr=array_column($data1,'name');		// 获取$data1数组中所有name元素
		$data2=array_combine($idArr,$nameArr);

        if($model->load(yii::$app->request->post()) && $model->save()){


        }
        	 return $this->render("add",['model'=>$model,"data"=>$data2]);
        
       


   }

}