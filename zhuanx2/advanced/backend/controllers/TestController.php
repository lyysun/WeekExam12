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
class TestController extends Controller
{ 
	public $enableCsrfValidation=false;
	function actionAdd(){
              // echo 1;die;
             $a=0;
		for ($i=1; $i <=100 ; $i++) { 
			 $a=$i+$a;
		}

		echo $a;
	}


}