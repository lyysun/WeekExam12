<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends Controller {
        
        function index(){
        	$nodelist=M("node")->select();
        	$this->assign('nodelist',$nodelist);
        	$this->display();
        }
        
        function add(){
        	if($_POST){
                   
                   $data=I('post.');
                   $res=M('node')->add($data);

                   if($res){
                   	$this->success("添加成功",U('index'));
                   }else{
                   	$this->error("添加失败");
                   }


        	}else{
                  $nodelist=M("node")->select();
                  $nodelist=getSonList($nodelist);
                  $this->assign('nodelist',$nodelist);
                  $this->display();
        	}
        }


}
       