<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\model\IndexModel;
use think\Request;

class Rbac extends Controller
{

    function _initialize(){
          $session=Session::get();
          // dump($session);
          if(!isset($session['name'])){
                 $this->error("请先登录",'/index/login/index');
          }else{

            if ($session['name']!='lyy') {
                     $request=Request::instance();
                     $ctl=$request->controller();
                     $act=$request->action();
                     $nowurl=$ctl."/".$act;
                     $nowurl=strtolower($nowurl);
                     if (empty($session['urls'])) {
                           $session[]=array();
                     }
                     $res=in_array($nowurl,$session['urls']);
                     if(!$res){
                      $this->error("对不起，您没有权限");
                     }


            }
          }
    }
   
    public function nn()
    {    
      $session=Session::get();
      // dump($session);
      if($session['name']=='admin'){
        return view("admin");
      }elseif($session['name']=='root'){
          $arr=Db('node')->select();
      $a=nodedg($arr);
      $this->assign('a',$a);
          return view("nodeshow");
      }
      

      
    }




    //递归权限展示
    function nodeshow(){
    	$arr=Db('node')->select();
    	$a=nodedg($arr);
    	$this->assign('a',$a);
    	return view();
    }

    //信息展示
    function show(){
         
    	 return view();
    }
    //分页
     function ajax(){
          $a=new IndexModel();
          $data=$a->select();
          $json=json_encode($data);
          $this->assign('json',$json);
          $data=$a->select();
          $page=$data->render();
          $this->assign("page",$page);
    	 return view();
    }
    //修改
    function xg(){
    	$data=$this->request->param();
    	$id=$data['id'];
    	$name=$data['name'];
    	 $a=new IndexModel();
          $res=$a->xg($id,$name);
          if($res>0){
          	echo "修改成功";
          }else{
          	echo "修改失败";
          }

    }
    //删除
    function del(){
    	$id=$_GET['id'];
    	$res=Db('type')->delete($id);
    	if($res){
    		echo json_encode(array("code"=>1,"msg"=>"删除成功"));
    	}else{
    		echo json_encode(array("code"=>2,"msg"=>"删除失败"));
    	}
    }

}