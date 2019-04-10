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
class Index1Controller extends Controller
{          
     //分类
          function actionShow(){
                    $sql="select * from xiaoshuo_type";
                    $data=yii::$app->db->createCommand($sql)->queryAll();

                   
                     echo json_encode($data);die;
                    
          }

            function actionList(){
                    $sql="select * from xiaoshuo_detail";
                    $data=yii::$app->db->createCommand($sql)->queryAll();
                    echo json_encode($data);die;
          }
}