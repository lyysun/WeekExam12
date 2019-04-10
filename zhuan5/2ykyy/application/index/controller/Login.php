<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Login extends Controller
{
    public function index()
    {

        Session::delete("id");
          Session::delete("name");
            Session::delete("urls");
       return view();
    }
    //登陆
    function dl(){
    	$data['name']=$_POST['name'];
    	$data['pwd']=$_POST['pwd'];
    	$res=Db("user")->where($data)->find();
    	if($res){
            if($res['name']=='lyy'){
                 Session::set("name","lyy");
           
            }else{

                  Session::set('id',$res['id']);
                  Session::set("name",$res['name']);
                  $id=$res['id'];
                  //根据id在 role_user 表中找roleid
                  $role_user=Db('role_user')->field('roleid')
                                           ->where("userid=$id")
                                           ->select();
                    foreach ($role_user as $key => $v) {
                            $roleids[]=$v['roleid'];
                    }
                    if (empty($roleids)) { $roleids=0; }

                    //根据roleids 在role_node 表中找nodeid
                    $role_node=Db("role_node")->field('nodeid')
                                            ->where("roleid","in",$roleids)
                                             ->select();
                     foreach ($role_node as $key => $v) {
                            $nodeids[]=$v['nodeid'];
                    }
                    if (empty($nodeids)) { $nodeids=0; }                         
                //根据nodeids 在role_node 表中找url
                    $node=Db('node')->field("url")
                                   ->where("id","in",$nodeids)
                                   ->select();
                     foreach ($node as $key => $v) {
                            $nodeurl[]=$v['url'];
                    }
                    if (empty($nodeurl)) { $nodeurl=0; } 
                    Session::set("urls",$nodeurl);             
                    
    		
            }
            echo "登陆成功";
    	}else{
    		echo "登录失败";
    	}

    }

}
