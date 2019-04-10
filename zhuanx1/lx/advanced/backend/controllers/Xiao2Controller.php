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
class Xiao2Controller extends Controller
{   public $layout=false;
	public $enableCsrfValidation=false;
	function actionAdd(){
		if(yii::$app->request->isPost){
             $data=yii::$app->request->post();
             // var_dump($data);die;
             $res=Yii::$app->db->createCommand()->insert('staff',[
					    'name' => $data['name'],
					    'age' => $data['age'],
					    'sex' => $data['sex'],
					    'time' => time(),
					])->execute();
		       if($res){
		       	$this->redirect(['xiao2/show']);
		       }
           
		}else{
			return $this->render("add");
		}
	}
	function actionShow(){
		$data = Yii::$app->db->createCommand('SELECT * FROM staff')->queryAll();
		return $this->render("show",['data'=>$data]);

	}
	function actionDel(){
		$id=yii::$app->request->get("id");
		$data = Yii::$app->db->createCommand("delete from staff where id=$id")->execute();
		if($data){
		       	$this->redirect(['xiao2/show']);
		       }
	}
	function actionUpdate_show(){
		$id=yii::$app->request->get("id");
		$data = Yii::$app->db->createCommand("SELECT * FROM staff WHERE id=$id")
           ->queryOne();
           // var_dump($data);die;
         return $this->render("update_show",['name'=>$data['name'],'sex'=>$data['sex'],'age'=>$data['age'],'id'=>$data['id']]);
	}

	function actionUpdate(){
		$data=yii::$app->request->post();
		// var_dump($data);die;
		$name=$data['name'];
		$age=$data['age'];
		$sex=$data['sex'];
        $id=$data['id'];
        $time=time();
		$res=Yii::$app->db->createCommand("update staff set name='$name',age='$age',sex='$sex',time='$time' where id=$id")
   ->execute();
		if($res){
		       	$this->redirect(['xiao2/show']);
		       }

	}

}