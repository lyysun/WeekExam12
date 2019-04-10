<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\media;
use yii\web\UploadedFile;
use yii\data\Pagination;

class MediaController extends Controller
{
    public function actionAdd()
    {
        $model = new Media();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($path=$model->upload()) {
                // 文件上传成功
                $this->getMediaId($path);
                // echo $path;die;
            }
        }

        return $this->render('add', ['model' => $model]);
    }

    function getMediaId($filename){
    	$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->getToken()."&type=image";
    	var_dump($url);
    	$data=["media"=>new \CURLFile($filename)];
    	// echo "<pre>";
    	
    	$str=$this->request($url,$data);
    	$data=json_decode($str,true);
        $media_id=$data['media_id'];
        $sql="insert into media(media_id) value('$media_id')";
        $res=Yii::$app->db->createCommand($sql)->execute();
 // echo $res;die;
        if($res){
        	yii::$app->session->setFlash("info","上传成功");
        }


    }
     
    public function request($url,$data){
        $ch = curl_init($url);      // 初始化curl，获取curl对象
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);       // 接口返回数据传递给变量而不是显示在浏览器上
        // 判断是否是https请求
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
        // post请求，以及需要传递的数据
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        // 发送请求，获取数据
        $str = curl_exec($ch);      
        curl_close($ch);
        // 返回从接口获取的数据
        return  $str;
    }
 

     function getToken(){
       	  $appid="wx2ea2b6a8b3e503a0";
       	  $appsecret='2256fb7535a572372d8d766cce358737';
       	  $filename='token.txt';
       	  //缓存
       	  if(file_exists($filename) && (time()-filemtime($filename))<7200){
       	  	$token=file_get_contents($filename);

       	  }else{
              $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
              $str=file_get_contents($url);
              $data=json_decode($str,true);
              $token=$data['access_token'];
              file_put_contents($filename, $token);
             
       	  } 
       	  return $token;

       }

       function actionShow(){


		// 创建一个 DB 查询来获得所有 status 为 1 的文章
		$query = (new yii\db\Query())->select("*")->from('media');
		// 得到文章的总数（但是还没有从数据库取数据）
		$count = $query->count();

		// 使用总数来创建一个分页对象
		$pagination = new Pagination(['totalCount' => $count,"defaultPageSize"=>2]);

		// 使用分页对象来填充 limit 子句并取得文章数据
		$articles =(new yii\db\Query())->select("*")->from('media')->offset($pagination->offset)
		    ->limit($pagination->limit)
		    ->all();
          
           if(yii::$app->request->isAjax){
            return $this->renderPartial("show",['data'=>$articles,"pagination"=>$pagination]);
           }else{
            	return $this->render("show",['data'=>$articles,"pagination"=>$pagination]);
           }
		    
       }


     function actionDel(){
     	// echo "111";die;
     	$id=yii::$app->request->get('id');
     	// var_dump($id);
     	$sql="delete from media where id=$id";
     	yii::$app->db->createCommand($sql)->execute();



     	 $query=(new yii\db\Query())->select('*')->from('media');        // 使用查询构建器
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize'=>2]);     // 分页对象
        $query=(new yii\db\Query())->select('*')->from('media')->offset($pagination->offset)->limit($pagination->limit)->all();     // 某页应该显示的数据

        return $this->renderPartial('show',['data'=>$query,'pagination'=>$pagination]);  
   

     }
}