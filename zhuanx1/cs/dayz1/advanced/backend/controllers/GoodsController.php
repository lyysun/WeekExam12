<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\goods;
/**
 * Site controller
 */
class GoodsController extends Controller
{
	public $enableCsrfValidation=false;

	public function actionAdd(){
            if(yii::$app->request->isPost){
            	$model=new Goods;
            	$data=yii::$app->request->post('goods');
            	$model->name=$data['name'];
            	$model->sj=$data['sj'];
            	$model->lb=$data['lb'];
            	$model->time=time();
            	$model->save();

            }else{
            	return $this->render('add');
            }

             
	}
//展示
	public function actionShow(){

		if(yii::$app->request->isPost){
            
            $name=yii::$app->request->post('name');
            $data=yii::$app->db->createCommand("select * from goods where name like '%$name%'")->queryAll();
		}else{
			$data=yii::$app->db->createCommand("select * from goods")->queryAll();
		}
		
		return $this->render('show',['data'=>$data]);
	}
// 删除
	public function actionDel(){
		$id=yii::$app->request->get('id');
		$res=yii::$app->db->createCommand("delete from goods where id=$id")->execute();
		if($res){
			$this->redirect(['goods/show']);
		}
	}
	// 修改展示
	public function actionUpdate_show(){
		$id=yii::$app->request->get('id');
		$data=yii::$app->db->createCommand("select * from goods where id=$id")->queryone();
        // var_dump($data);
        $name=$data['name'];
        $sj=$data['sj'];
        $lb=$data['lb'];
        $id=$data['id'];
        // var_dump($id);die;
        return $this->render('update_show',['name'=>$name,'sj'=>$sj,'lb'=>$lb,'id'=>$id]);
	}

	//修改
	public function actionUpdate_do(){
		$data=yii::$app->request->post();
		$name=$data['name'];
        $sj=$data['sj'];
        $lb=$data['lb'];
        $id=$data['id'];
        $res=yii::$app->db->createCommand("update goods set name='$name',sj='$sj',lb='$lb' where id=$id")->execute();
        if($res){
        	$this->redirect(['goods/show']);
        }
	}
 
 }