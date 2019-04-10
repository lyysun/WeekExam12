<?php
/**
 * @brief 商品模块
 * @class Goods
 * @note  后台
 */
class Test extends IController{
 

 function add(){
 	 // echo "11";
 	$this->redirect("add");
 }

	function add_do(){
		$pwd=IReq::get("pwd");
		$name=IReq::get("name");
		$data=new IModel("test");
		$arr=array(
	           "name"=>$name,
	           "pwd"=>$pwd
			);
		$data->setData($arr);
		$res=$data->add();
		if($res){
			$this->redirect("show");
		}
	}

	function show()
	{
	    	$data=new IModel("test");
	    	$res=$data->query();
	    	// var_dump($res);die;
	    	$this->setRenderData(['res'=>$res]);
	    	$this->redirect("show");
	}

	function up_show()
		{
			$id=IReq::get("id");
			// echo $id;
			$data=new IModel("test");
	    	$res=$data->query("id=$id");
	    	// var_dump($res);die;
	    	$this->setRenderData(['res'=>$res]);
	    	$this->redirect("up_show");

		}

		function updo(){
			$id=IReq::get("id");
			$name=IReq::get("name");
			// echo $name;die;
			$pwd=IReq::get("pwd");
			$data=new IModel("test");
			$arr=array(
                 "name"=>$name,
                 "pwd"=>$pwd
				);
			$data->setData($arr);
			$res=$data->update("id=$id");
		   if($res){
		   	  
		    	$this->redirect("show");
		   }
		}
			function del()
			{
				$id=IReq::get("id");
				// echo $id;die;
				$data=new IModel("test");
		    	$res=$data->del("id=$id");
		    	// var_dump($res);die;
		    	if($res){
		    		$this->redirect("show");
		    	}


			}


			function dt(){

				 $this->redirect("dt");
			}
            //经度纬度查询位置
		function dtss(){
				$address=$_POST['addr'];
				$ak="fZAQ5GXps6eyzh88eCoOjH1kDUMwe06u";
				
				$url="http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak=$ak";
                $data=file_get_contents($url);
                $data=json_decode($data,true);
                $lng=$data['result']['location']['lng'];
                $lat=$data['result']['location']['lat'];
                $arr=array(
                       "lng"=>$lng,
                       "lat"=>$lat
                	 );
                   echo json_encode($arr);

			}


            //1邮件注册email
            function email_add(){
            	$name=IReq::get("name");
            	$pwd=IReq::get("pwd");
            	$eamil=IReq::get("email");
            	$a=new IModel("dayz1m");
            	$arr=array(
                       "name"=>$name,
                        "pwd"=>$pwd,
                         "eamil"=>$eamil,

            		);
            	$a->setData($arr);
            	$id=$a->add();

            	$email=new SendMail();
            	$url="http://www.shop.com/test/email_jh/id/".base64_encode($id);
            	$title="请注册";
            	$content="注册链接".$url;
            	$email->send($eamil,$title,$content);
            	if($id){
            		$this->redirect("email_login");
            	}
            }
             //2登陆普安段是否激活
            function eamil_login_add(){
            		$name=IReq::get("name");
            		$pwd=IReq::get("pwd");
            		$a=new IModel("dayz1m");
            		$data=$a->query("name='$name' and pwd='$pwd'");
            		echo "<pre>";
            		// var_dump($data);die;
            		$state=$data[1]['state'];
            		if($state==0){
                          echo "no";
            		}else{
            			echo "yes";
            		}
            }
           //3邮箱激活
           function email_jh(){
           	$id=IReq::get("id");
           	$id=base64_decode($id);
           	$a=new IModel("dayz1m");
            	$arr=array(
                       "state"=>1,
                       );
            	$a->setData($arr);
            $res=$a->update("id=$id");
            if($res){
            	echo "激活成功";
            }
           }




     
			//发邮件
			function do_email(){

				$addr=IReq::get("email");
				$mail=new SendMail();
				$title="邮件";
				$content="待审核....";
				$mail->send($addr,$title,$content);
			}


			//qq登陆
			function qq_login(){

                  $appid='101353491'; //地址
                  $redirect_uri="http://www.shop.com/index.php"; //url地址
                  $state=rand(1000,9999);//随机状态
				  $url="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=$appid&redirect_uri=$redirect_uri&state=$state";
                  header("location:$url"); //根据url跳转
			}



			//接受后台文件
			function upload(){

                  $sliceNo=$_POST['sliceNo'];//分割数量
                  $filename=$_POST['filename'];//文件的名称
                  $blob_count=$_POST['blob_count'];//切片的总篇数
                  $sliceFile=$_FILES['sliceFile']; //切片文件
                  $tmp_name=$sliceFile['tmp_name'];//文件真实路径
                  // echo $tmp_name;
                  //调用文件转移方法
                  $this->moveSliceFile($tmp_name,$filename,$sliceNo);
          //当切边编号和文件总共片数相等是，带表切片传完；
                  if($sliceNo==$blob_count){
                  	//拼接
                  	$this->mergeSliceFile($sliceNo,$filename);
                  	//删除切片 传过来碎片
                     $this->deleteSliceFile($sliceNo,$filename);
                  }
			}
         //将前台传过来的切片，转移到ipload/video 视频路径
		function moveSliceFile($tmp_name,$filename,$sliceNo){
			//拼接切片文件的目标路径
			$destination ="upload/video/".$filename.'_'.$sliceNo;
			//目标路径
			move_uploaded_file($tmp_name,$destination);


		}
      //将文件切片拼成完整的文件
	    function mergeSliceFile($sliceNo,$filename){
	    	$data='';
	    	for($i=1;$i<=$sliceNo;$i++){
	    		//找到当前所有的切片文件
	    		$new_name="upload/video/".$filename.'_'.$i;
	    		//将文件转成字符串格式
	    		$data.=file_get_contents($new_name);
	    	}
	    	//拼成一个完整的
	    	$new_name="upload/video/".$filename;
	    	file_put_contents($new_name,$data);
	    }
	    //删除多余的切片
       function deleteSliceFile($sliceNo,$filename){
       	for($i=1;$i<=$sliceNo;$i++){
       		$new_name="upload/video/".$filename.'_'.$i;
       		unlink($new_name);
       	}
       }

}