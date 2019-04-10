<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\UserModel;
use think\Request;
use think\Db;
class User extends Rbac
{
    public function index()
    {
    		
    
	  //   	$user=new UserModel();

	  //   	$data=$user->select();

    
			// $this->assign('data',$data);
			
			return $this->fetch('index');

      
    }
       public function ajax()
    {
    		
            $data=$this->request->param();
            // dump($data);die;
            $name="";
           if(isset($data['name']) && !empty($data['name'])){
           	$name=$data['name'];
           }

	    	$user=new UserModel();

	    	$data=$user->select($name);
         // dump($data);die;

            $page=$data->render();
            $this->assign('page',$page);
			$this->assign('data',$data);
			
			return view('ajax');

      
    }




    function add(){
    	$data=Request::instance()->param();
    	$user=new UserModel();
    	$res=$user->add($data);
    	if($res){
    		$this->success('添加成功','index/user/index');
    	}else{
    		$this->error('添加失败','index/user/index');
    	}

    }

    function delall(){
    	$data=$this->request->param();
    	$ids=$data['ids'];
    	$user=new UserModel();
    	$res=$user->delall($ids);
         if($res){
         	echo "成功";
         }else{
         	echo "失败";
         }
    	// dump($data);die;

    }
    function delete(){

		$id=Request::instance()->param('id');
		$user=new UserModel();
		$res=$user->deletes($id);
		if($res){
			$this->success('删除成功','/index/user/show');
		}else{
			$this->error('删除失败');
		}
	}

	function update(){
		$id=Request::instance()->param('id');
		$user=new UserModel();
		$data=$user->get_one($id);
		$this->assign('data',$data);
		return $this->fetch();
	}

	function updatedo(){
		$id=Request::instance()->param('id');
		$data=Request::instance()->param();
		$user=new UserModel();
		$res=$user->updates($id,$data);
		if($res){
    		$this->success('修改成功','index/user/index');
    	}else{
    		$this->error('修改失败','index/user/index');
    	}
	}

    function statu(){
    	$data=$this->request->param();
    	// dump($data);die;
    	$id=$data['id'];
    	$status=$data['status'];
    	$user=new UserModel();
    	$res=$user->status($id,$status);
    	// echo $res;die;
    	if($res<=0){
    		echo "修改失败";
    	}else{
    		echo "修改成功";
    	}

    }
	
}