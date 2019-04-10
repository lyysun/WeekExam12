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
        Session::delete("id");
        Session::delete("name");
        Session::delete("urls");
      return view();
    }

    function yz(){
    	$data['name']=$_POST['name'];
    	$data['pwd']=$_POST['pwd'];
    	$res=Db("user")->where($data)->find();
    	// echo $res;
    	if($res){
               if($res['name']=="root"){
               	  Session::set("name","root");
               }else{

               	      Session::set("id",$res['id']);
               	      Session::set("name",$res['name']);
               	      $id=$res['id'];
                      //1. 在role_user里面 找角色roleid
                      $role_user=Db("role_user")->field("roleid")
                                                ->where("userid=$id")
                                                ->select();
                        foreach ($role_user as $k => $v) {
                               $roleids[]=$v['roleid'];
                        }
                        if(empty($roleids)){ $roleids=0;}

                        //2. 从role_node里面 找权限nodeid

                      $role_node=Db("role_node")->field("nodeid")
                                                ->where("roleid","in",$roleids)
                                                ->select();
                       foreach ($role_node as $k => $v) {
                             $nodeids[]=$v['nodeid'];
                       }

                       if(empty($nodeids)){ $nodeids=0;}

                       //3 从node里面 根据权限id 找url控制器方法
                       $node=Db('node')->field('url')
                                       ->where("id","in",$nodeids)
                                       ->select();
                       foreach ($node as $k => $v) {
                              $nodeurl[]=$v['url'];
                       }
                       if(empty($nodeurl)){ $nodeurl=0;}
                       Session::set("urls",$nodeurl);

               }
            
    		echo json_encode(array("code"=>1,"msg"=>"yes"));
    	}else{
    		echo json_encode(array("code"=>2,"msg"=>"no"));
    	}
    }
}
