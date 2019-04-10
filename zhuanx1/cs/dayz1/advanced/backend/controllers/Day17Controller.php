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
class Day17Controller extends Controller
{
      function actionAdd(){
      	return $this->render("add");
      }
} 