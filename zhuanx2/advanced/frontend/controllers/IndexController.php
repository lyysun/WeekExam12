<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\curl\curl;

/**
 * Site controller
 */
class IndexController extends Controller
{     
	  public $enableCsrfValidation=false;

        function actionAdd(){
             // echo 1;die;
           if(yii::$app->request->isPost){

              $data=yii::$app->request->post();
              // var_dump($data);die;

              $url=yii::$app->params['api_url']."fz/add";
       
              $res=curl::cl($url,"GET",$data);
              var_dump($res);
              $this->redirect(["index/show"]);

           }else{
                      //加了一个签名与后台比较
           	        //  $url=yii::$app->params['api_url']."fz/show&sign=".curl::sign();  
        	          
        	           // $a=curl::cl($url,"GET");
            // echo "1";die;

            //封装的yii::$app->params['api_url']  （ 'api_url'=>'http://47.93.25.138/lyy/x2/advanced/backend/web/index.php?r=',）
                 $url=yii::$app->params['api_url']."fz/show&token=".curl::token();  
                  
                     $a=curl::cl($url);
        	         var_dump($a);die;
           	          return $this->render("add",['a'=>$a]);
           }
           

            
        	
        }


        function actionShow(){

        	           $url=yii::$app->params['api_url']."index1/show";  
        	// var_dump($url);die;
        	           $a=curl::cl($url);
              // var_dump($a);die;
        	           return $this->render("show",['a'=>$a]);
        	      
        }

        function actionDel(){
        	$data=yii::$app->request->get();
        	$type_id=$data['type_id'];
     
        	$url=yii::$app->params['api_url'].'fz/del&type_id='.$type_id;
          // var_dump($url);die;
        	$a=curl::cl($url,"DELETE",$data);
     
        	$this->redirect(["index/show"]);

        }

   }