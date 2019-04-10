<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()
    {
       $bb=new IndexModel();
       // dump($this);die;
    	$data=$bb->select();
    	$this->assign('data',$data);
    	return view();
    }

 

    function xg(){
    	$updates=$this->request->param();
    	// dump($this);die;
    	$id=$updates['id'];
    	$name=$updates['name'];
        $bb=new IndexModel();
    	$data=$bb->updates($id,$name);
    	if($data){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
}
