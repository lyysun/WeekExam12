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
class Moni5aController extends Controller
{
   public $enableCsrfValidation=false;
	function actionAdd(){
		if(yii::$app->request->isPost){
			$data=yii::$app->request->post();
			//本地的路径
			$uploads="uploads/".$_FILES['file']['name'];
	        //已到文件下
			move_uploaded_file($_FILES['file']['tmp_name'],$uploads);
			
			var_dump($data);

		}else{
			return $this->render("add");
		}
		
	}
}