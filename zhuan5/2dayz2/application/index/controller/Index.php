<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()//展示
    {   
    	$data=$this->request->param();
    	// dump($data);die;
    	$name='';
    	if(isset($data['name']) && !empty($data['name'])){
    		$name=$data['name'];
    	}
    	
    	$staff=new IndexModel();
    	$data=$staff->selects($name);
    	// dump($data);die;
    	$this->assign('data',$data);
    	return view();
       
    }

    function xg(){//修改
    	$data=$this->request->param();
    	// dump($data);die;
    	$id=$data['id'];
    	$name=$data['name'];
    	$staff=new IndexModel();
    	$res=$staff->xgs($id,$name);
    	// echo $res;die;
    	if($res!=0){
    		echo json_encode("code"==1,"res"=="修改成功");
    	}else{
    		echo json_encode("code"==2,"res"=="修改失败");
    	}

    }

    function del(){//删除
    	$data=$this->request->param();
    	// dump($data);die;
    	$id=$data['id'];
    	// $staff=new IndexModel();
    	// $res=$staff->dels($id);
    	$res =Db::table('staff')->delete($id);
    	if($res!=0){
    		echo json_encode("code"==1,"res"=="删除成功");
    	}else{
    		echo json_encode("code"==2,"res"=="删除失败");
    	}
    }

   
}
