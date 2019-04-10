<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\db\Query;
/**
 * Site controller
 */
class MenuController extends Controller
{
public $enableCsrfValidation=false;
    function actionAdd(){
         if (yii::$app->request->isPost) {
           $data=Yii::$app->request->post();
           yii::$app->db->createCommand()->insert("menu",$data)->execute();
         }

    	$data=(new Query())->select("id,name")->from("menu")->where(['level'=>1])->all();
    	// echo "<pre>";
    	// var_dump($data);die;
    	return $this->render('add',['data'=>$data]);
    }
//自创菜单拼接
    function actionShow(){
    	$menu1=(new Query())->select("*")->from("menu")->where(['level'=>1])->orderBy("sort asc")->all();
    	// echo "<pre>";
    	// var_dump($menu1);
    	$menu2=(new Query())->select("*")->from("menu")->where(['level'=>2])->orderBy("sort asc")->all();
    	
    	foreach ($menu1 as $k1 => $v1) {
    		$flag=false;
    		foreach ($menu2 as $k2 => $v2) {
    		 
    		     if($v1['id']==$v2['pid']){
    		     	   $flag=true;
    		     	   // 一级
    		     	   $button[$k1]['name']=$v1['name'];
    		     	   // 二级类型
    		     	   $button[$k1]['sub_button'][$k2]['type']=$v2['type'];
    		     	     // 二级名称
    		     	   $button[$k1]["sub_button"][$k2]['name']=$v2['name'];
    		     	   if($v2['type']=="click"){
    		     	   	   $button[$k1]['sub_button'][$k2]['key']=$v2['val'];
    		     	   }else{
    		     	   	   $button[$k1]["sub_button"][$k2]['url']=$v2['val'];
    		     	   }

    		     }
    		}
            
            if(!$flag){
            	//一级
            	$button[$k1]['type']=$v1['type'];
            	$button[$k1]['name']=$v1['name'];
            	  if($v1['type']=="click"){
            	 	  $button[$k1]['key']=$v1['val'];
            	  	$button[$k1]['url']=$v1['val'];
            	  }
            }


    	}
        // 放到数据data button中
    	$data['button']=$button;
      //必须是json格式
    	$str=json_encode($data,JSON_UNESCAPED_UNICODE);
    	// var_dump($str);
      // $str=json_decode($str,true);
    
    	$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->getToken();
    	// var_dump($url);

    	$res=$this->request($url,true,'post',$str);
    	echo $res;
    }


   function request($url,$https=false,$method="get",$data=null){
       	$ch=curl_init($url);
       	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
       	// 判断是否是https请求
          if($https==true){
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            
          }
           // 判断是否是post请求
          if($method=="post"){
          	curl_setopt($ch, CURLOPT_POST, TRUE);
          	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          }
          $str=curl_exec($ch);
          curl_close($ch);
          return $str;

       }



  public function getToken(){
		$filename='token.txt';
		if(file_exists($filename) && (time()-filemtime($filename))<7200){
			$token=file_get_contents($filename);
		}else{
			//https请求方式: GET
			$appid='wx46e5b04f365f2596';
			$appsecret='e2afbfacf9cb6ef66ac8f3cd92a5e742';
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
			$str=file_get_contents($url);
			$data=json_decode($str,true);
			$token=$data['access_token'];	
			// 将通过调用接口获取到的token存放到文件中
			file_put_contents($filename, $token);		
		}
		return $token;
	}

}