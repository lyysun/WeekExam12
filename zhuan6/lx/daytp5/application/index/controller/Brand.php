<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Brand extends Controller
{
        function index(){

        	$data=Db('tp_brand')->select();
        	$this->assign('data',$data);
        	return view();
        }
        function add(){
        	return view();
        }


        function insert(){
                
           if(request()->isPost()){
           $data = input("post.");
           
           $file ='brand_logo';
           // dump($file);die;
           //文件上传
           $data['brand_logo'] = $this->upload($file);
           //添加 
           // dump($data);die;
           $res = Db('tp_brand')->insert($data);
           // dump($res);die;
           if($res){
           		$this->success("添加成功",url('index'));
           }else{
           		$this->error("添加失败");
           }
          
    	}
        }

       public function upload($f){
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file($f);
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
      
     
      return  $info->getSaveName();
        
     
    }else{
        // 上传失败获取错误信息
       echo $file->getError();
    }
}

}