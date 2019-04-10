<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
       
       function index(){
       	$adminlist=M("admin")->select();
       	$this->assign('adminlist',$adminlist);
       	    $this->display();
       }

       function add(){
       	if($_POST){
	       	$data=I('post.');
	       	// $data[""]
	       	$res=M('admin')->add($data);
	           // echo $res;
	       	if ($res) {
	               
	               foreach ($data['role_id'] as $key => $val) {
	               	   $temp[$key]['role_id']=$val;
	               	   $temp[$key]['admin_id']=$res;
	               }
	               $y=M("admin_role")->addAll($temp);
	             // echo $y;
	       		if($y){
	       			$this->success("添加成功",U("index"));
	       		}else{
	       			M("admin")->where("admin_id=$res")->delete();
	       			$this->error("添加失败");
	       		}
	       	}
       }else{
	       	$role_name=M("role")->where("role_sta")->select();
	        $this->assign('role_name',$role_name);
	       	$this->display();
       	}
       }

}