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
class DetailController extends Controller
{ 
    // 点击查询章节
    function actionChapter(){
    	$id=yii::$app->request->get("id");
    	$sql="select * from xiaoshuo_chapter where detail_id=$id";
    	$data=yii::$app->db->createCommand($sql)->QueryAll();
     

       echo json_encode(['data'=>$data]);die;
    }

    //点击章节查询内容
    function actionNr(){
              $id=yii::$app->request->get("id");
              $sql="select * from xiaoshuo_chapter where chapter_id=$id";
              $data=yii::$app->db->createCommand($sql)->QueryAll();
              
              echo json_encode(['data'=>$data]);die;
    } 

    // 添加收藏
    function actionShoucang(){
    	$sc=yii::$app->request->get("sc");
    	$id=yii::$app->request->get("detail_id");
    	$sql="update xiaoshuo_detail set xs_sc=$sc where detail_id=$id";
    	$data=yii::$app->db->createCommand($sql)->execute();
    }
    //查询收藏的作品
    function actionShoucang1(){
    	     $sql="select * from xiaoshuo_detail where xs_sc=1";
              $data=yii::$app->db->createCommand($sql)->QueryAll();
               echo json_encode(['data'=>$data]);die;
    }
    // 点赞hot页面
    function actionUpdate(){
    	$id=Yii::$app->request->get("id");
       
        $res =yii::$app->db->createCommand("select xs_zan from xiaoshuo_detail where detail_id=$id")->Queryone();
        // var_dump($res['xs_zan']);die;
        if($res['xs_zan']){
               	$sql="update xiaoshuo_detail set xs_zan =xs_zan-1 where detail_id=$id";
    	   yii::$app->db->createCommand($sql)->execute();


        }else{
        		$sql="update xiaoshuo_detail set xs_zan =xs_zan+1 where detail_id=$id";
    	       yii::$app->db->createCommand($sql)->execute();

        }

    
        
    }
     
}