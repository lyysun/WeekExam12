<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\db\Query;
class TextController extends Controller{
	public $layout=false;
	public $enableCsrfValidation=false;
	function actionIndex(){
		
        $data=yii::$app->db->createCommand("select * from goods")->queryAll();
        return $this->render("index",['data'=>$data]);
         
	}
	function actionAdd(){
		if(yii::$app->request->isPost){
			$data=yii::$app->request->post();
			// var_dump($data);die;
		   $name=$data['name'];
		   $num=$data['num'];
		   $sql="insert into goods values('','$num','$name')";
		   $res= yii::$app->db->createCommand($sql)->execute();
            if($res){
            	$this->redirect(["text/index"]);
            }
		}else{
			return $this->render("add");
		}
		
	}

	function actionDel(){
		$id=yii::$app->request->get('id');
	    $sql="delete from goods where id=$id";
	    $res=yii::$app->db->createCommand($sql)->execute();
	    if($res){
	    	$this->redirect(['text/index']);
	    }
	}

	function actionUpdate_show(){

		$id=yii::$app->request->get('id');
		 $data=yii::$app->db->createCommand("select * from goods where id=$id")->QueryAll();
		 $name=$data[0]['name'];
		 $num=$data[0]['num'];
		 $id=$data[0]['id'];
		 return $this->render('update_show',['name'=>$name,'num'=>$num,'id'=>$id]);

	}

	function actionUpdate_do(){
		 $data=yii::$app->request->post();
		 // var_dump($data);die;
		   $name=$data['name'];
		   $num=$data['num'];
		   $id=$data['id'];
		   $sql="update goods set name='$name',num='$num' where id=$id";
		   $res=yii::$app->db->createCommand($sql)->execute();
		   if($res){
		   	$this->redirect(['text/index']);
		   }
	}

}