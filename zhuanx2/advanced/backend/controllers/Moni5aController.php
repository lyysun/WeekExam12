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
     	$data=yii::$app->request->get();
     	$name=$data['name'];
     	$pwd=$data['pwd'];
     	$age=$data['age'];
     	$email=$data['email'];
     	$sex=$data['sex'];
     	$tel=$data['tel'];

     	$sql="insert into `moni5a-zc` (name,pwd,age,email,sex,tel) values('$name','$pwd','$age','$email','$sex','$tel')";
     	yii::$app->db->createCommand($sql)->execute();

     }

     function actionDl(){
     	$data=yii::$app->request->get();
     	// var_dump($data);die;
     	$name=$data['name'];
     	$pwd=$data['pwd'];

     	$sql="select * from `moni5a-zc` where name='$name' and pwd='$pwd'";
     	$res=yii::$app->db->createCommand($sql)->queryone();
        if($res){
        	echo 1;die;
        }else{
        	echo 2;die;
        }
     }

     function actionShow(){
     	$sql="select * from `moni5a-zc`";
     	$res=yii::$app->db->createCommand($sql)->queryAll();
     	echo json_encode($res);die;
     }

     function actionUpdate(){
     	$data=yii::$app->request->get();
     	$name=$data['name'];
     	$age=$data['age'];
     	$id=$data['id'];
     	$tel=$data['tel'];
     	$email=$data['email'];
     	$sql="update `moni5a-zc` set name='$name',age='$age',tel='$tel',email='$email' where id=$id";
     	$res=yii::$app->db->createCommand($sql)->execute();
        if($res){
        	echo 1;die;
        }else{
        	echo 2;die;
        }

     }

 }