<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Controller;
use app\index\model\UserModel;

class User extends Rbac
{
	 function index(){
	 	return view();
	 }
	 function ajax(){
	 	$data=$this->request->param();
	 	$name="";
	 	if(isset($data['name']) && !empty($data['name'])){
	 		$name=$data['name'];
	 	}
	 	// dump($data);die;
	     
	     // echo $name;die;
	 	 $user=new UserModel();
	 	 $data=$user->select($name);
	 	 $page=$data->render();
	 	 $this->assign('page',$page);
	 	 $this->assign('data',$data);
	 	 return view();
	 }

	 function statu(){
	 	$data=$this->request->param();
	 	$id=$data['id'];
	 	$status=$data['status'];
	 	 $user=new UserModel();
	 	 $data=$user->status($id,$status);
	 	 // echo $data;die;
	 	 if($data){
	 	 	echo "修改成功";
	 	 }else{
	 	 	echo "修改失败";
	 	 }
	 }

	 function delall()
	 {
	 	$data=$this->request->param();
	 	$ids=$data['ids'];
	 	// echo $ids;die;
	  	$user=new UserModel();
	 	 $data=$user->delall($ids);
	 	 if($data){
	 	 	echo "删除成功";
	 	 }else{
	 	 	echo "删除失败";
	 	 }
	 }
}