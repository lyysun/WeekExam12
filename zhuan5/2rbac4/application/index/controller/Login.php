<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Login extends Controller
{
    public function index()
    {   
    	$session=Session::get();
    	dump($session);
    	Session::delete('uid');
    	Session::delete("id");
    	Session::delete("urls");
    	$session=Session::get();
    	dump($session);
    	return view();
        
    }
    function yz(){
    	$data['uid']=$_POST['uid'];
    	$data['pwd']=$_POST['pwd'];
    	$res=Db('user')->where($data)->find();
    	// dump($res);
    	if($res){
    		
    		if($res['uid']=="admin"){
                   Session::set("uid","admin");
    		}else{
                  

                   Session::set('id',$res['id']);//用户的id存入
                   Session::set('uid',$res['uid']);//用户的uid存入
                   $id=$res['id'];//用户的id
                  // 1.  在role_user 查找用户在里面的角色roleid
                  $role_user=Db("role_user")->field("roleid")
                                           ->where("userid=$id")
                                           ->select();
                                           dump($role_user);
                  foreach ($role_user as $k => $v) {
                               $roleids[]=$v['roleid'];
                                       } 
                   if(empty($roleids)){ $roleids=0; }
                                       // dump($roleids);die;   


                 // 2.  查询当前用户权限  根据角色的id
                   $role_node=Db('role_node')->field('nodeid')
                                        ->where("roleid","in",$roleids)
                                        ->select();
                                        // dump($node);
                   foreach ($role_node as $k => $v) {
                   	        $nodeids[]=$v['nodeid'];
                   }
                   if(empty($nodeids)){ $nodeids=0; }



                   // 3.  根据权限id  找node的操作方法
                   $node=Db("node")->field('node')
                                   ->where("id","in",$nodeids)
                                   ->select();
                                   // dump($node);die;
                   foreach ($node as $k => $v) {
                   	        $nodeurl[]=$v['node'];
                   }
                   // dump($nodeurl);die;
                   if(empty($nodeurl)){ $nodeurl=0; }
                   Session::set("urls",$nodeurl);

    		}

    		$this->success("登陆成功","/index/index/index/");
    	}else{
    		$this->error("登录失败");
    	}
    }
}