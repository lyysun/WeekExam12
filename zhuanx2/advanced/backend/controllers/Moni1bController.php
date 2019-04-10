<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\fz1\fz1;
use yii\data\Pagination;
/**
 * Site controller
 */
class Moni1bController extends Controller
{

           function actionAdd(){
               
               $data=yii::$app->request->post();
                
                $pid=$data['pid'];
                $type_name=$data['type_name'];

                $sql="select * from `moni1b_type` where type_name='$type_name'";
                $data=yii::$app->db->createCommand($sql)->queryone();
                if($data){
                    fz1::Mss(7);
                }
                
                 $sql="select * from `moni1b_type` where pid=$pid";
                 $data=yii::$app->db->createCommand($sql)->queryone();
                if(!$data){
                    fz1::Mss(8);
                }

                $sql="insert into `moni1b_type` (type_name,pid) values('$type_name','$pid')";

                 $data=yii::$app->db->createCommand($sql)->execute();



           }

           function actionShow(){

              	$sql="select * from `moni1b_type`";
                $data=yii::$app->db->createCommand($sql)->queryAll();
                echo "<pre>";
         
           }
         
         function actionGoodadd(){
                
                $type_id=yii::$app->request->post("type_id");
                $name=yii::$app->request->post("name");
                
                $sql="select * from `moni1b_type` order by type_id desc limit 1";
                $data=yii::$app->db->createCommand($sql)->queryone();
               if($data){
               	   $sql="insert into `moni1b_good` (type_id,name) values('$type_id','$name')";
               	   yii::$app->db->createCommand($sql)->execute();
               }

         } 


         function actionGoodshow(){

                    $sql="select * from `moni1b_type` order by type_id desc limit 1";
                $data=yii::$app->db->createCommand($sql)->queryone();
                $type_id=$data['type_id'];
                 

             

                $sql="select * from `moni1b_good` where type_id=$type_id";
                $data=yii::$app->db->createCommand($sql)->queryall();
              
               

         }


         function actionGooddel(){
         	      $type_id=yii::$app->request->post();
         	      $sql="select * from `moni1b_good` where type_id=$type_id";
         	      $data=yii::$app-> $data=yii::$app->db->createCommand($sql)->queryall();
         	      if($data){
         	      	  echo "不能删除";
         	      }
         	      $sql="select * from `moni1b_type` where pid=$type_id";
         	      $data=yii::$app-> $data=yii::$app->db->createCommand($sql)->queryall();
         	        if($data){
         	      	  echo "不能删除";
         	      }

         	      $sql="delete from `moni1b_type` type_id=$type_id";
         	      yii::$app->db->createCommand($sql)->execute();
         	      
         }


         
         function actionUpdate(){
            $type_id=yii::$app->request->get("type_id");
            $type_name=yii::$app->request->get("type_name");
            $pid=yii::$app->request->get("pid");
            
            $sql="select * from 'moni1b_good' where type_id=$type_id";
            $data=yii::$app->db->createCommand($sql)->queryall();
            if($data){
                echo "不可以有些商品";die;
            }
            $sql="update `moni1b_type` set type_name='$type_name',pid='$pid' where type_id='$type_id'";
            $data=yii::$app->db->createCommand($sql)->execute();

         }
}