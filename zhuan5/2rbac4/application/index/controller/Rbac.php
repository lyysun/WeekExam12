<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Request;
class Rbac extends Controller
{    
         function _initialize(){
             $session=Session::get();
             //检测session是否存在id
             if(!isset($session['uid'])){
              $this->error("请先登录",'index/login/index');
             }else{
                 dump($session['uid']);
                 //必须检测uid是否是admin   如果不是进行判断
                 if($session['uid']!=="admin"){
                  //获取控制器  获取方法
                       $request=Request::instance();
                       $ctl=$request->controller();//获取当前url控制器名称
                       $act=$request->action();//获取当前url方法名
                  //session 和 nodeurl 对比
                       $nowurl=$ctl."/".$act;  //User/index
                       $nowurl=strtolower($nowurl); //方法名进行转换：/user/index
                       dump($nowurl);
                       dump($session);
                       
                       if(empty($session['urls'])){ $session['urls']=array();}
                       $res=in_array($nowurl,$session['urls']);
                       dump($res);
                       //不在权限列表 提示没有权限
                       if(!$res){
                            $this->error("您没有访问权限","/index/index/index");
                       }
                 }
             }

         }


       //展示角色
      function showrole(){
      	  $data=Db('role')->select();
      	  $this->assign('data',$data);
      	  return view();
      }
   //展示权限和根据id展示角色
       function shownode(){
           $roleid=input('id');
           $roleshow=Db('role')->where("id=$roleid")->find();
           $this->assign('roleshow',$roleshow);

      	   $data=Db('node')->select();
      	   $this->assign('data',$data);
      	   return view();
      }
     //添加权限
      function addrolenode(){
      	$roleid=input('roleid');
      	$nodeid=input('nodeid/a');
      	// dump($nodeid);die;
         foreach ($nodeid as $k => $v) {
                  $data['roleid']=$roleid;
                  $data['nodeid']=$v;
                  Db('role_node')->insert($data);

              }
              $this->success("添加权限成功","index/rbac/showrole");


      }
}
