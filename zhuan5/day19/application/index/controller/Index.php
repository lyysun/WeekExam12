<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()
    {     $day19=new IndexModel();
    	$data=$day19->select();
    	// dump($data);die;
    	$this->assign('data',$data);
      return view();
    }

    function status(){
    	$data=$this->request->param();
    	$id=$data['id'];
    	$status=$data['status'];
    	$s=new IndexModel();
    	$res=$s->updata($id,$status);
    	if($res>0){
    		echo 1;
    	}else{
    		echo 0;
    	}
    	
    }

    function zt(){
        $data=$this->request->param();
        // dump($data);die;
        $id=$data['id'];
        $status=$data['status'];
        $a=new IndexModel();
        $res=$a->up($id,$status);
        if($res>0){
            echo json_encode(array('code'=>1,'res'=>'修改成功'));
        }

    }
}
