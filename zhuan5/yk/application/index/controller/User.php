<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\UserModel;
class User extends Rbac
{
    public function index()
    {
          
    		return view();
    }
    function ajax(){
    	  $data=$this->request->param();
    	     $name='';
    	     if(isset($data['name']) && !empty($data['name'])){
    	     	 $name=$data['name'];
    	     }
    	    
    	    $user=new UserModel();
    		$data=$user->select($name);
    		$page=$data->render();
    		$this->assign('page',$page);
    		$this->assign('data',$data);
    		return view();
    }
    function add(){
    	$data=$this->request->param();
    	// dump($data);die;
    	$name=$data['name'];
    	$sex=$data['sex'];
    	$bj=$data['bj'];
    	$xh=$data['xh'];
    	$user=new UserModel();
          $res=$user->add($name,$sex,$bj,$xh);
          if($res){
          	$this->success('添加成功','/index/user/index');
          }else{
          	$this->erroe("添加失败");
          }


    }

    function del(){
    	$data=$this->request->param();
    	$id=$data['id'];
    	$user=new UserModel();
        $res=$user->del($id);
        if($res){
        	echo 1;
        }else{
        	echo 0;
        }
    }
    
    function delall(){
    	$data=$this->request->param();
    	// dump($data);
    	$ids=$data['ids'];
    	$user=new UserModel();
        $res=$user->delall($ids);
        if($res){
        	echo 1;
        }else{
        	echo 0;
        }
    }

    function statu(){
    	$data=$this->request->param();
    	// dump($data);
    	$id=$data['id'];
    	$status=$data['status'];
    	$user=new UserModel();
        $res=$user->status($id,$status);
        if($res){
        	echo 1;
        }else{
        	echo 0;
        }
    }


}