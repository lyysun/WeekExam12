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
class Moni6aController extends Controller
{    
	public $enableCsrfValidation=false;
	function actionAdd(){
		if(yii::$app->request->isPost){
            $data=yii::$app->request->post();
            
            $this->menu($data);
		}else{
			return $this->render("add");
		}
	}
//一级菜单
	function menu($data){

		foreach ($data['name'] as $key => $value) {
	
			  $button[$key]['name']=$value;
			  $button[$key]['type']=$data['type'][$key];

			  if($data['type'][$key]=="click"){

               $button[$key]['key']=$data['nr'][$key];

			  }else if ($data['type'][$key]=="view") {

			  	 $button[$key]['url']=$data['nr'][$key];
			  }
		}

          $arr['button']=$button;
          $data=json_encode($arr,JSON_UNESCAPED_UNICODE);
          echo '<pre>';
          // $data=json_decode($data,true);
          var_dump($data);die;

	}

}