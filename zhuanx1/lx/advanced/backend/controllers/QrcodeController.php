<?php
namespace backend\controllers;

use yii;
use yii\web\Controller;		// 控制器基类
use yii\data\ActiveDataProvider;


class QrcodeController extends Controller{
    //调用接口 获取ticket
    public function getTicket(){
    	$url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->getToken();
    	$data='{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}';
    	$str=$this->request($url,true,'post',$data);
    	$data=json_decode($str,true);
    	$ticket=$data['ticket'];
    	$addtime=time();
    	$arr=[
              'ticket'=>$ticket,
              'addtime'=>$addtime
    	];
    	//入库
    	yii::$app->db->createCommand()->insert('ticket',$arr)->execute();
    	return $ticket;

    }
  //展示诶二维码
    public function actionCode(){
    	$url="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$this->getTicket();
    	$str=file_get_contents($url);
        //生成随机数据
    	$key=Yii::$app->getSecurity()->generateRandomString();
    	$filename='img/'.$key.'.jpg';
    	file_put_contents($filename, $str);
    	$addtime=time();
    	$arr=[
            'path'=>$filename,
            'addtime'=>$addtime
    	];
    	yii::$app->db->createCommand()->insert('qrcode',$arr)->execute();
    	header("content-type:image/jpeg");
    	echo $str;
    }
    
    //列表展示
    function actionCodelist(){
    	$query =(new yii\db\Query())->select('*')->from('qrcode');
    	// var_dump($query);die;
    	$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 2,		// 每页显示几条记录
			],
		]);
		// 将数据提供器传递给codelist模板文件，在模板文件中可以使用GridView小部件来显示数据
		return $this->render('codelist',['provider'=>$provider]);
    }


     //长连接
    function actionConvertlink(){
            $url="https://api.weixin.qq.com/cgi-bin/shorturl?access_token=".$this->getToken();
            // var_dump($url);die;
            $arr=[
                  'action'=>"long2short",
                  "long_url"=>'http://www.sohu.com/a/286039484_267106?g=0?code=fae5edb46443d7f788e9b6a14e0c63ca&_f=index_cpc_1'
            ];
            //转成对象  不是数组
		    $data=json_encode($arr);
		   
		    $result=$this->request($url,true,'post',$data);
            
            $data=json_decode($result);
          
            $shortUrl=$data->short_url;
		    echo $shortUrl;


    }
   //活取token
   public function getToken(){
		
		$appid='wx46e5b04f365f2596';
		$appsecret='e2afbfacf9cb6ef66ac8f3cd92a5e742';

		$filename='token.txt';
		
		if(file_exists($filename) && (time()-filemtime($filename))<7200){
			$token=file_get_contents($filename);
			//echo $token;
		}else{
			
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";	// 获取access token的接口地址
            // var_dump($url);die;
			$str=file_get_contents($url);
            // var_dump($str);die;		// 
			$data=json_decode($str,true);		// json格式的字符串转换成PHP数组
			$token=$data['access_token'];
			file_put_contents($filename, $token);		// 将通过调用接口获取到的access token存放到文件中
			// echo $token;
		}
		return $token;
	}

	// 公共方法，cURL方式发送请求(实现了get请求和post请求，以及http和hptts请求地址)
	function request($url,$https=false,$method="get",$data=null){
	    $ch = curl_init($url);		// 初始化curl，获取curl对象
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);	    // 接口返回数据传递给变量而不是显示在浏览器上
	    // 判断是否是https请求
	    if($https==true){
	        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	       
	    }
	    // 判断是否是post请求
	    if($method=='post'){
	        curl_setopt($ch, CURLOPT_POST, TRUE);
	        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    }
	    $str = curl_exec($ch);
	    // var_dump($str);die;	
	    	// 发送请求，获取数据
	    curl_close($ch);
	    return  $str;
	}		
}