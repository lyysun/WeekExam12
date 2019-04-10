<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\fz1\fz1;
/**
 * Site controller
 */
class LoginController extends Controller
{
	 public $enableCsrfValidation=false;
           // 入库


        function actionGtoken(){

          $data=yii::$app->request->get();
          // var_dump($data);die;
          $user=$data['user'];
          $pwd=$data['pwd'];

          $sql="select * from admin where user='$user' and pwd='$pwd'";
          $data=yii::$app->db->createCommand($sql)->queryone();

          if(!$data){
                  fz1::Mss(2);
          }

          $token=md5($user.$pwd);
          $arr=[
              "token"=>$token,
              "admin_id"=>$data['admin_id'],
          ];

          yii::$app->db->createCommand()->insert("redis",$arr)->execute();
          // 添加成功返会token
          fz1::Mss(1,$token);

        }







    function actionGettoken(){
            $get=yii::$app->request->get();
            $user=$get['user'];
            $pwd=$get['pwd'];
            // 传过来的值比对是否与数据库相同
           $sql="select * from admin where user='$user' and pwd ='$pwd'";
           $res=yii::$app->db->createCommand($sql)->queryone();
           if(!$res){
                fz::Ms(2);
           }
           // 加密 形成token
           $token=md5($user.$pwd.time());
           // 把token 用户id  时间 村入库中
           $arr=["token"=>$token,"admin_id"=>$res['admin_id'],"time"=>time()];

           $redis=yii::$app->db->createCommand()->insert("redis",$arr)->execute();
           // 入库成功返回token
         if($redis){
            fz::Ms(1004,$token);
         }
    }




      function actionLogin(){
      	$data=yii::$app->request->get();
        $data=$data['data'];
        $data=json_decode($data,true);
        
        $name=$data['nickName'];
        $gender=$data['gender'];
        $city=$data['city'];
        $avatarUrl=$data['avatarUrl'];
        $openid="123123";

        yii::$app->db->createCommand("insert into `xiaoshuo-login` (openid,name,gender,city,avatarUrl) values('$openid','$name','$gender','$city','$avatarUrl')")->execute();
            $data=yii::$app->db->createCommand("select * from `xiaoshuo-login` where openid=123123")->queryone();
      	   // var_dump($data);
      	   if($data){
      	   	  echo json_encode($data);
      	   }else{
      	   	echo "0";
      	   }
         
      }

      function actionShowlogin(){
      	   $data=yii::$app->db->createCommand("select * from `xiaoshuo-login` where openid=123123")->queryone();
      	   // var_dump($data);
      	   if($data){
      	   	  echo json_encode($data);
      	   }else{
      	   	echo "0";
      	   }
      }
}