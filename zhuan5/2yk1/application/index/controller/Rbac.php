<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Request;
class Rbac extends Controller
{
	//权限展示
	function _initialize(){
		$session=Session::get();
		dump($session);
		// if(){

		// 	 // $this->error("请先登录",'/index/login/index');
		//   }else{
               
               // if($session['name']!="root"){
                   //获取控制器
		           $nodeurls=$session['arr']['url'];
		           // dump($nodeurls);
		           foreach ($nodeurls as $k => $v) {
		                $nownodeurls[]=$nodeurls[$k]['url'];
		           }
               	   $request=Request::instance();
               	   $ctl=$request->controller();
               	   $act=$request->action();
               	   $nowurl=$ctl."/".$act;  //index/stu_show
               	   $nowurl=strtolower($nowurl);
               	   if(empty($session['urls'])) { $session['urls']=array();}
               	   $res=in_array($nowurl,$nownodeurls);
               	   dump($res);
               	   if(!$res){
               	   	$this->error("您没有权限","/index/rbac/sessionnode");
               	   }

               // }

		  // }
		}
	function shownode(){
		$roleid=input('id');
		// dump($roleid);die;
		$rolename=Db('role')->where("id=$roleid")->find();
		$this->assign('rolename',$rolename);
		// dump($roleid);die;
		$arr=Db('node')->select();
		$a=node($arr);
		$this->assign('a',$a);
		return view('shownode');
	}
   //角色展示
	function showrole(){

		$data=Db("role")->select();
		$this->assign('data',$data);
		return view();
	}
   //分配权限
	function addnode(){
		$roleid=input('roleid');
		$nodeid=input("nodeid/a");
		foreach ($nodeid as $k => $v) {
			$data['roleid']=$roleid;
			$data['nodeid']=$v;
			Db('role_node')->insert($data);
		}
		$this->success("分配成功",'/index/rbac/showrole');

	}

	function sessionnode(){
         $session=Session::get();
         // dump($session);
		return view("sessionnode");
	}

   
   }