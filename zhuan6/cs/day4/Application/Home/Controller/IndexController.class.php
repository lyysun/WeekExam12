<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $a=M("type");
       // dump($a);
       $data=$a->select();
       $this->assign('data',$data);
       $this->display();
    }

    function del(){
    	$id=I('get.id');
    	$a=M("type");
       // dump($a);
       $data=$a->delete($id);

    }

      function xg(){
    	$id=I('get.id');
    	$data=I('get.data');
         $arr['wz']=$data;
    	$a=M("type");
       // dump($a);
      $res=$a->where("id=$id")->save($data);
       
    }
}