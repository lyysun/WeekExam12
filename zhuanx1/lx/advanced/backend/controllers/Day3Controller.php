<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;

class Day3Controller extends Controller{

	public $layout=false;
	public $enableCsrfValidation=false;
	function actionAdd(){
		if(yii::$app->request->isPost){
			$name=yii::$app->request->post('name');
            $sql="insert into role values('','$name')";
            // var_dump($sql);die;
            $res=yii::$app->db->createCommand($sql)->execute();
           if($res){
           	$this->redirect(['day3/show']);
           }
            
		}else{
			return $this->render("add");
		}
		
	}
    //展示
	function actionShow(){
          
          if (yii::$app->request->isPost) {
          	 $name=yii::$app->request->post('name');
          	 // var_dump($name);die;
             $sql="select * from role where name like '%$name%'";
             // var_dump($sql);die;
		     $data=yii::$app->db->createCommand($sql)->queryAll();
            // var_dump($data);die;
		     return $this->render("show",['data'=>$data]);
          }else{
          	$sql="select * from role";
		   $data=yii::$app->db->createCommand($sql)->queryAll();
		// var_dump($data);
		  return $this->render("show",['data'=>$data]);
          }

		
	}
   //删除
	function actionDel(){
		$id=yii::$app->request->get("id");
		$sql="delete from role where id=$id";
		$res=yii::$app->db->createCommand($sql)->execute();
		if($res){
			$this->redirect(['day3/show']);
		}
	}
}