<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\fz1\fz1;

/**
 * Site controller
 */
class Moni5bController extends CommonController
{
          public $enableCsrfValidation=false;
          //订单查询
       function actionDingdan(){

         $user_id=yii::$app->request->get('user_id');
         $sql="select * from `moni5b_dingdan` where user_id=$user_id";
         $data=yii::$app->db->createCommand($sql)->queryone();
           if($data['zt']==0){
             echo ($data['time']+1000)-time(); //输出有效时间
           }
         if($data){
         	fz1::Mss(1,$data);

         }

       
      

       }

        // 订单添加
       function actionAdd(){

             $good_id=yii::$app->request->post("good_id");
              $price=yii::$app->request->post("price");
              $num=yii::$app->request->post("num");

             $sql="select * from `moni5b_good` where good_id = $good_id";
             $data=yii::$app->db->createCommand($sql)->queryone();
             if($data['kc']<$num){
             	fz1::Mss(3); die;//库存不足
             }
             if($data['down']==0){
             	fz1::Mss(4); die; //已下架
             }



             $sql="insert into `moni5b_dingdan` (good_id,price) values ('$good_id','$price')";
             $res=yii::$app->db->createCommand($sql)->execute();
             yii::$app->db->createCommand("begin")->execute();
             if($res){
             	fz1::Mss(1); //添加成功
             }else{
             	yii::$app->db->createCommand("rollback")->execute();
             }


       }
      // 修改订单
       function actionUpdate(){
              $good_id=yii::$app->request->post("good_id");
              $num=yii::$app->request->post("num");
              

               $sql="select * from `moni5b_dingdan` where good_id=$good_id";
               $data=yii::$app->db->createCommand($sql)->queryone();
               if(!$data){
               	fz1::Mss(5); //商品不再订单中
               }

              $zj=($data['price'])*$num;
              $sql="update `moni5b_dingdan` set num=$num,zj=$zj where good_id=$good_id";
              yii::$app->db->createCommand($sql)->execute();

              $sql="update `moni5b_good` set kc=kc-$num where good_id=$good_id";
              yii::$app->db->createCommand($sql)->execute();



       }



 }