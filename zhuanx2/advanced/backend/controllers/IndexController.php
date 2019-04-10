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
class IndexController extends Controller
{
   
	function actionIndex(){
		// 展示轮播图
		$sql="select * from xiaoshuo_chart  order by sort asc limit 2";
		$data=Yii::$app->db->createCommand($sql)->queryAll();

        //展示热点资讯
           $sql="select * from xiaoshuo_detail where xs_hot=1 limit 2";
		   $hot=Yii::$app->db->createCommand($sql)->queryAll();
		 //潜力新作
		    $sql="select * from xiaoshuo_detail where xs_potential=1 limit 2";
		   $now=Yii::$app->db->createCommand($sql)->queryAll();
		   // 排行榜
		   $sql="select * from xiaoshuo_detail order by xs_view desc limit 3";
		   $ph=Yii::$app->db->createCommand($sql)->queryAll();

		 echo json_encode(["data"=>$data,"hot"=>$hot,"now"=>$now,"ph"=>$ph]);die;

	}

    // 多条件搜索
    function actionList(){

        $bs=yii::$app->request->get();
        $p=yii::$app->request->get("p",1); //下拉分页
        
        // 更具小说类型展示
        if(isset($bs['type']) && !empty($bs['type'])){

              $where[]=" where type_id =".$bs['type'];
               $where =implode(" AND ", $where);
              $sql="select * from xiaoshuo_detail ".$where." limit $p";
       
             $type=Yii::$app->db->createCommand($sql)->queryAll();
              echo json_encode(["type"=>$type]);die;
        
        // 根据小说进度展示
        }else if(isset($bs['jd']) && !empty($bs['jd'])){
             // 连载
             $where[]=" where xs_serialize =".$bs['jd'];
               $where =implode(" AND ", $where);
            $sql="select * from xiaoshuo_detail ".$where." limit $p";
    
            $type=Yii::$app->db->createCommand($sql)->queryAll();
            echo json_encode(["type"=>$type]);die;
         
         // 根据人气排序
        }else if(isset($bs['order']) && strlen($bs['order'])){

                $where[]=" order by xs_view desc ";
                $where =implode(" AND ", $where);
                $sql="select * from xiaoshuo_detail ".$where." limit $p";
    
                $type=Yii::$app->db->createCommand($sql)->queryAll();
                echo json_encode(["type"=>$type]);die;
        } else{
         
         // 页面加载时展示
           $sql="select * from xiaoshuo_detail limit $p";
           $type=Yii::$app->db->createCommand($sql)->queryAll();
            echo json_encode(["type"=>$type]);die;
        }

    }

     // 展示热点资讯 潜力 排行 更多 >
     function actionHot(){
     	// echo 2;die;
     	// 点击更多时接到不同的标识
     	$bs=yii::$app->request->get("bs");
     	$p=yii::$app->request->get("p",1); //下拉分页
        
        $where=$this->where($bs); //调用封装的条件
        // var_dump($where);die;
     	$sql="select * from xiaoshuo_detail ".$where." limit $p";
     	// var_dump($sql);die;
     	$hot=Yii::$app->db->createCommand($sql)->queryAll();
        echo json_encode(["hot"=>$hot]);die;
     }
    
   // 给出的条件 根据不同的标识 展示不同的页面
     function where($bs){
           if($bs==1){ //热力推荐

               $where[]=" where xs_hot=1";
               $where =implode(" AND ", $where);
               return $where;
          
            }else if($bs==2){ //潜力排行
               $where[]=" where xs_potential=1";
                $where =implode(" AND ", $where);
               return $where;
          
            }else if($bs==3){  //排行榜
                
                $where[]=" order by xs_view desc ";
                $where =implode(" AND ", $where);
               return $where;
            }
           
          

           }

          function actionUpdate(){
           $data=yii::$app->request->get();
        
          // echo json_encode($data);
          $id=$data['id'];
          $zan=$data['zan'];
          // echo $zan;die;
          $sql="update xiaoshuo_detail set xs_zan=$zan+1 where detail_id=$id";
          yii::$app->db->createCommand($sql)->execute();
          
          // 从新查询
         $sql="select * from xiaoshuo_chart  order by sort asc limit 2";
		 $data=Yii::$app->db->createCommand($sql)->queryAll();

        //展示热点资讯
           $sql="select * from xiaoshuo_detail where xs_hot=1 limit 2";
		   $hot=Yii::$app->db->createCommand($sql)->queryAll();
		 //潜力新作
		    $sql="select * from xiaoshuo_detail where xs_potential=1 limit 2";
		   $now=Yii::$app->db->createCommand($sql)->queryAll();
		   // 排行榜
		   $sql="select * from xiaoshuo_detail order by xs_view desc limit 3";
		   $ph=Yii::$app->db->createCommand($sql)->queryAll();

		 echo json_encode(["data"=>$data,"hot"=>$hot,"now"=>$now,"ph"=>$ph]);die;

     }
	



}
  