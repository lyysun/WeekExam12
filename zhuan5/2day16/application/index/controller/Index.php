<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()
    {   $data=Db('2day16')->select();
    $this->assign('data',$data);
    return view();
        
    }
    function xg(){
    	$data=$this->request->param();
    	// dump($data);die;
    	$id=$data['id'];
    	$name=$data['name'];
    	$a=new IndexModel();
    	$res=$a->up($id,$name);
    	if($res>0){
    		echo "yes";
    	}else{
    		echo "no";
    	}
    }
}
