<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\UserModel;
class Index extends Controller
{
    public function index()
    {
      return view('add');
    }
    function add(){
    	$data=$this->request->param();
    	$uplod=new UserModel();
    	// $res=$uplod->add($data);
    	$res=$uplod->upload();
    	// if($res){
    		
    	// }
    	// var_dump($data);
    }
}
