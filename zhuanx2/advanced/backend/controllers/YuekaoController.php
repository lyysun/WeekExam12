<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\fz2\fz2;

/**
 * Site controller
 */
class YuekaoController extends Controller
{
  public $enableCsrfValidation=false;
  //注册
      function actionAdd(){

  	     $data=yii::$app->request->get();
  	     // var_dump($data);die;
  	      $name=$data['name'];
  	      $pwd=$data['pwd'];
  	      $age=$data['age'];
  	      $tel=$data['tel'];
  	      $email=$data['email'];
  	      $sex=$data['sex'];

  	      $sql="insert into `x2_user` (name,pwd,sex,age,email,tel) values('$name','$pwd','$sex','$age','$email','$tel')";
  	      $res=yii::$app->db->createCommand($sql)->execute();
  	      if($res){
               fz2::Ms(1);
  	      }

     }
      //登陆
     function actionDl(){
     	   $data=yii::$app->request->get();
  	     // var_dump($data);die;
  	      $name=$data['name'];
  	      $pwd=$data['pwd'];

  	      $sql="select * from `x2_user` where name='$name' and pwd='$pwd'";
  	      $data=yii::$app->db->createCommand($sql)->queryone();
  	      if($data){
  	      	   fz2::Ms(1);
  	      }else{
  	      	 fz2::Ms(2);
  	      }
     }

     //展示信息
     function actionShow(){
     	$sql="select * from `x2_user`";
     	$data=yii::$app->db->createCommand($sql)->queryAll();
     	if($data){
     		 fz2::Ms(1,$data);
     	}
     }

     function actionUpdateshow(){
     	$id=yii::$app->request->get("id");
     	$sql="select * from `x2_user` where id=$id";
     	$data=yii::$app->db->createCommand($sql)->queryone();
     	if($data){
     		 fz2::Ms(1,$data);
     	}
     }

     function actionUpdate(){
     	 $data=yii::$app->request->get();
  	     // var_dump($data);die;
  	      $name=$data['name'];
  	    
  	      $age=$data['age'];
  	      $tel=$data['tel'];
  	      $email=$data['email'];
  	      $sex=$data['sex'];
  	      $id=$data['id'];

  	      $sql="update `x2_user` set name='$name',sex='$sex',age='$age',email='$email',tel='$tel' where id=$id";
  	     $data=yii::$app->db->createCommand($sql)->execute();
     	if($data){
     		 fz2::Ms(1,$data);
     	}  

     }

  }