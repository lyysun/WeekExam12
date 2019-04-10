<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\curl\curl;

/**
 * Site controller
 */
class Moni5bController extends Controller
{ 

   function actionLogin(){

   	echo curl::gtoken();
   }

}