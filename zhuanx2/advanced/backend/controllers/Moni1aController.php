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
class Moni1aController extends Controller
{
         public $enableCsrfValidation=false;
         function actionImg(){
                 // echo 1;die;
         	$img=yii::$app->request->get("img");
               // $str="abcdefg";
             $str=str_replace('[','',$img); 
             $str1=str_replace(']','',$str); 
             $str2=str_replace('"','',$str1); 
            // echo $str2;die;
         	$sql="insert into `moni1a_img` (img) values('$str2')";
         	$res=yii::$app->db->createCommand($sql)->execute();

         } 

         function actionShowimg(){
          
            $p=yii::$app->request->get('p');
         	$sql="select * from `moni1a_img` limit $p";
         	$data=yii::$app->db->createCommand($sql)->queryAll();
         	echo json_encode($data);die;
         }

         function actionImgdel(){
         	 $p=yii::$app->request->get('p');
         	$id=yii::$app->request->get("id");
         	$sql="delete from `moni1a_img` where id=$id";
         	$data=yii::$app->db->createCommand($sql)->execute();
         	$sql="select * from `moni1a_img` limit $p";
         	$data=yii::$app->db->createCommand($sql)->queryAll();
         	echo json_encode($data);die;

         }

         function actionShowlb(){
         	$sql="select * from `moni1a_img` ";
         	$data=yii::$app->db->createCommand($sql)->queryAll();
         	echo json_encode($data);die;
         }

         function actionDhadd(){
         	$dh=yii::$app->request->get("dh");
         	$sql="insert into `moni1a_daohang` (dh) values('$dh')";
         	 yii::$app->db->createCommand($sql)->execute();

         }


         function actionShowdh(){

         	$sql="select * from `moni1a_daohang`";
         	$data=yii::$app->db->createCommand($sql)->queryAll();
         	echo json_encode($data);die;
         }
        //下拉分页
          function actionShowdhx(){
             $p=yii::$app->request->get('p');
         	$sql="select * from `moni1a_daohang` limit $p";
         	$data=yii::$app->db->createCommand($sql)->queryAll();
         	echo json_encode($data);die;
         }
          
          function actionDhdel(){

                 $id=yii::$app->request->get("id");
                 $sql="delete from `moni1a_daohang` where id='$id'";
                 yii::$app->db->createCommand($sql)->execute();
                 $sql="select * from `moni1a_daohang`";
                 $data=yii::$app->db->createCommand($sql)->queryAll();
                 echo json_encode($data);die;
          }

          function actionDhupdate(){
                   $id=yii::$app->request->get("id");

                     $sql="select * from `moni1a_daohang` where id=$id";
                 $data=yii::$app->db->createCommand($sql)->queryone();
                 echo json_encode($data);die;
          }

          function actionDhupdateto(){
                        $id=yii::$app->request->get("id");
                        $dh=yii::$app->request->get("dh");
                        $sql="update `moni1a_daohang` set dh='$dh' where id=$id";
                  yii::$app->db->createCommand($sql)->execute();
                

          }


   }