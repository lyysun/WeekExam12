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
class FzController extends CommonController
{
   public $enableCsrfValidation=false;


        function actionShow(){
                  

                    $sql="select * from xiaoshuo_type";
                    $data=yii::$app->db->createCommand($sql)->queryAll();
                    echo json_encode($data);die;
           }


   function actionAdd(){
   	$data=Yii::$app->request->post();
      // var_dump($data);die;
 
   // 失败返回分类名称不能为空
   	if(empty($data['type_name'])){
   			
   			 	fz::Ms(1000);
              

   	}
   // 分类名称不能少于6个字节
   	if(strlen($data['type_name'])<6){
   		      fz::Ms(1001);
               
   	}

   	// 分类名称不能重复
   	$type_name=$data['type_name'];

   	$sql="select * from xiaoshuo_type where type_name='$type_name'";
   	$data1=yii::$app->db->createCommand($sql)->queryone();
   
   	if($data1){
   		 fz::Ms(1002);
          
   	}
     

     // 加子及分类时，验证父类是否存在
 
     $pid=$data['pid'];
// var_dump($pid);die;
   	$sql="select * from xiaoshuo_type where type_id='$pid'";
   	$data1=yii::$app->db->createCommand($sql)->queryone();
   	// var_dump($data1);die;
     if(!$data1 && $pid!=0){
             fz::Ms(1003);
     }
     
    
    $res= yii::$app->db->createCommand()->insert("xiaoshuo_type",$data)->execute();
     if($res){
     	fz::Ms(1004);
     }


   }

   function actionUpdate(){
   	   $data=yii::$app->request->get();

       //分类ID不能为空
   	   if(empty($data['id'])){
   	   	       fz::Ms(1000);
   	   }
       // 修改的分类名称不能少于6个字节
   	   	if(strlen($data['name'])<6){
   		      fz::Ms(2002);
               
   	    }
    // 修改分类级别如果为子及 需验证
   	    if($data['pid']){
   	    	  fz::Ms(2003);
   	    }


   	  $name=$data['name'];
      $id=$data['id'];
      $sql="update goods set name='$name' where id=$id";
      yii::$app->db->createCommand($sql)->execute();

      
   }

   function actionDel(){
      $data=yii::$app->request->get();
      // var_dump($data);die;

        if(empty($data['type_id'])){
   	   	       fz::Ms(3000);
   	   }
        
        $type_id=$data['type_id'];

   	   $sql="select * from xiaoshuo_type where type_id=$type_id";
   	   $data1=yii::$app->db->createCommand($sql)->queryone();
      // var_dump($data1);
      if(!$data1){
      	 fz::Ms(3001);
      }



     //  	$name=$data['name'];

	   	// $sql="select * from xiaoshuo_type where name='$name'";
	   	// $data1=yii::$app->db->createCommand($sql)->queryone();
	   
	   	// if($data1){
	   	// 	 fz::Ms(3002);
	          
	   	// }

	   	$sql="delete from xiaoshuo_type where type_id=$type_id";
	   	$res=yii::$app->db->createCommand($sql)->execute();
      if($res){
        fz::Ms(3004);
      }

   }




   function actionXsadd(){

   	   $data=yii::$app->request->get();

   	   if(empty($data['xs_name']) && empty($data['type_id']) && empty($data['xs_imgfm']) && empty($data['xs_author'])){
          fz::Ms(3002);
   	   }



       $type_id=$data['type_id'];

        $sql="select * from xiaoshuo_detail where type_id='$type_id'";
	   	$data1=yii::$app->db->createCommand($sql)->queryone();
	   
	   	if(!$data1){
	   		 fz::Ms(4002);
	          
	   	}

   }
   
   function actionXsupdate(){
   	  $data=yii::$app->request->get();
        if(empty($data['detail_id'])){
        	fz::Ms(5001);
        }


   }




   function actionXsdel(){
        
        $data=yii::$app->request->get();

        if(empty($data['detail_id'])){
        	fz::Ms(5001);
        }

        $id=$data['detail_id'];
        $sql="select * from xiaoshuo_detail where detail_id=$id";
        $data=yii::$app->db->createCommand($sql)->queryone();
        if(!$data){
        	fz::Ms(5002);
        }
   }



}