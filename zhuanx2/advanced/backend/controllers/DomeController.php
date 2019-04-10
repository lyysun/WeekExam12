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
class DomeController extends Controller
{ 
	public $layout=false;
    public $enableCsrfValidation=false;
     function actionShow(){
     	$pid=yii::$app->request->get("id",0);

     	$sql="select * from ecs_region where parent_id=$pid";
     	$data=yii::$app->db->createCommand($sql)->queryAll();
     	// var_dump($data);die;
     	if (yii::$app->request->isAjax) {
     		return json_encode($data);
     	}
     	return $this->render("show",['data'=>$data]);
     }

     function actionDel(){
          $id=yii::$app->request->get('id');
          $sql="delete from ecs_region where region_id=$id";
         $res= yii::$app->db->createCommand($sql)->execute();
          if($res){
                echo "1";
            
        }else{
            echo "0";
        }
     
     }

     function actionAdd(){
          $data=yii::$app->request->get();
          $parent_id=$data['parent_id'];
          $region_name=$data['region_name'];
          $region_type=$data['region_type'];
          $sql="insert into ecs_region (parent_id,region_name,region_type) values('$parent_id','$region_name','$region_type')";
          yii::$app->db->createCommand($sql)->execute();
     }

     function actionDeng(){
          $code=yii::$app->request->get('code');
          // var_dump($code);
          $appid="wxb9275073e478b583";
          $secret="07efc41b90545dd6cf387acaac3dcc19";

          $url= "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code";
          $data=file_get_contents($url);
          echo $data;
     }

     function actionWei(){
          $num=yii::$app->request->get('num',1);
          $data=yii::$app->db->createCommand("select * from test limit $num")->queryAll();
          echo json_encode($data);
     }

     
     function actionUpdate(){
          $data=yii::$app->request->get();
           $num=yii::$app->request->get('num',1);
          // echo json_encode($data);
          $id=$data['id'];
          $zan=$data['zan'];
          $sql="update test set price=$zan+1 where id=$id";
          yii::$app->db->createCommand($sql)->execute();
        
          $data=yii::$app->db->createCommand("select * from test limit $num")->queryAll();
          echo json_encode($data);
     }
}