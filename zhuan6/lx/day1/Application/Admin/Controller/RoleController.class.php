<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends Controller {
              
	function index(){
		$rolelist=M("role")->select();
		$this->assign("rolelist",$rolelist);
		$this->display();
	}
	function add(){
		$data=I("post.");
		// dump($data);
		$res=M("role")->add($data);
		if($res){
			$this->success("添加成功",U('index'));
		}
		$this->display();
	}

	function setPrivillage(){
           if($_POST){
               $role_id=I('post.role_id');
           	   $data=I("post.");
               foreach ($data['node_id'] as $key => $val) {
                   $temp[$key]['node_id']=$val;
                   $temp[$key]['role_id']=$data['role_id'];

               }
               //添加之前先删除
               M("privillage")->where("role_id=$role_id")->delete();
              $res= M('privillage')->addAll($temp);
              if($res){
              	$this->success("分配成功",U('index'));
              }

           	
           }else{
             $role_id=I('get.role_id');
            $role_name=M("role")->where("role_id=$role_id")->getField("role_name");
            //查看角色拥有的权限默认选中
            $rolenode=M("privillage")->where("role_id=$role_id")->getField('node_id',true);
            // dump($rolenode);
            
            $nodelist=M("node")->select();
            foreach ($nodelist as $key => $v) {
            	if(in_array($v['node_id'],$rolenode)){
            		$nodelist[$key]['curr']=1;
            	}
            }
            $nodelist=getSonKey($nodelist);
            // dump($nodelist);
            $this->assign("role_id",$role_id);
            $this->assign("nodelist",$nodelist);
            $this->assign("role_name",$role_name);
	     	$this->display("privillage");
		}
	}


  function xg(){
    $id=I('get.id');
    $status=I('get.status');
    $data['role_sta']=$status;
     M('role')->where("role_id=$id")->save($data);

  }
}