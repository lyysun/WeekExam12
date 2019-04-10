<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Index extends Controller
{
    public function index()
    {   

    	$brand_name=input('get.brand_name');
    	$brand_desc=input('get.brand_desc');
    	$where['brand_name']=array('like',"%$brand_name%");
    	$where['brand_desc']=array('like',"%$brand_desc%");
    	$brandList=Db('tp_brand')
    	                  ->field("brand_id,brand_name,site_url,brand_desc,brand_logo")
    	                  ->where($where)
    	                  ->paginate(3);
    	$page=$brandList->render();
    	$brandList=$brandList->toArray();
    	$brandList=$brandList['data'];
    	// dump($brandList);
    	session('brandList',$brandList);
    	if(request()->isAjax()){
    		$result['data']=$brandList;
    		$result['page']=$page;
    		return $result;
    	}
    	$this->assign('page',$page);
    	$this->assign('brandList',$brandList);
      return view();
    }

    function add(){
    	if($_POST){
              $data=input('post.');
              $file="brand_logo";
              $info=$this->upload($file);
              if($info){
              	$data['brand_logo']=$info;
              	  $res=Db('tp_brand')->insert($data);
              	  if($res){
              	  	$this->success('添加成功',url('index'));
              	  }else{
              	  	$this->error('添加失败');
              	  }
              }


    	}else{
    		return view();
    	}
    }

    public function upload($f){
	   // 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file($f);
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->validate(['ext'=>'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	   if($info){
	        // 成功上传后 获取上传信息
	       // 输出 jpg
	       
	        return $info->getSaveName();
	      
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
	  }
	}

       function xg(){
       	$data=input("get.");
       	// return $data;
       	$brand_id=$data['brand_id'];
       	$brand_name=$data['brand_name'];
       	$data['brand_name']=$brand_name;
       	$res=Db("tp_brand")->where("brand_id=$brand_id")->update($data);
       	if($res){
       		echo "修改成功";
       	}

       }
       //删除
       function del(){
       	$brand_id=input('brand_id');
       	$res=Db('tp_brand')->delete($brand_id);
       	if($res){
       		echo "1";
       	}
       }

       function d(){
            $brandList=session::get();
            // dump($brandList);
            $header=array('品牌名称','品牌logo','商品描述');
            array_unshift($brandList,$header);
            getExc($brandList,"order");
       }

}
