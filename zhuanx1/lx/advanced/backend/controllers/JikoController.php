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
class JikoController extends Controller
{
    function actionAdd(){
    	if(yii::$app->request->isPost){

    	}else{
    		return $this->render("add");
    	}
    }

}
    