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
class WechatController extends Controller
{
         public $enableCsrfValidation=false;
         function actionValid(){
         	$echostr=yii::$app->request->get("echostr");
         	if(isset($echostr)){
              $this->check();
         	}else{
                $this->rm();
         	}
         }
        
        function check(){
              $token="lyy";
			   $signature=yii::$app->request->get("signature");
			  $timestamp =yii::$app->request->get("timestamp");
			  $nonce =yii::$app->request->get("nonce");
               $echostr=yii::$app->request->get("echostr");

			$tmpArr = array($token,$timestamp, $nonce);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );

			if( $signature == $tmpStr){
			echo $echostr;
			}else{
			return false;
			}
        }
 }