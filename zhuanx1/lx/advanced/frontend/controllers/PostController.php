<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class PostController extends Controller
{
       function actionAdd(){
       	if(yii::$app->user->can("createPost")){
       		echo "有添加";
       	}else{
       		echo "无";
       	}
       }
        function actionUpdate(){
       	if(yii::$app->user->can("createPost")){
       		echo "有修改";
       	}else{
       		echo "无";
       	}
       }
}