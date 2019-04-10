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
class Day8Controller extends Controller
{            
	public $enableCsrfValidation=false;
	//添加
             function actionAdd(){
            header("content-type:text/html;charset=utf-8");
             	if(yii::$app->request->isPost){
                   $content=yii::$app->request->post('content');

                 yii::$app->db->createCommand("insert into goods (content) value('$content')")->execute();
                    // var_dump($res);die;
                    // echo $res;

             	}else{
             		return $this->render("add");

             	}
             	
             }
}