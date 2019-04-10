<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Login extends Controller
{
    public function index()
    {  
      

        
       return view();
    }

    function yz(){
    	$data['name']=$_POST['name'];
    	$data['pwd']=$_POST['pwd'];
    	// dump($data);die;
    	$res=Db('user')->where($data)->find();

    	if($res){
             
               if($res['name']=="root"){
                   Session::set('name','root');
               } else{
                       
                          $node=Db("node")->select();
                          $data=nodedg($node);

                          $arr['name']=$res['name'];
                          $arr['url']=$data;
                          Session::set("arr",$arr);


               }
              



    		echo json_encode(array("code"=>1,"msg"=>"登陆成功"));
    	}else{
    		echo json_encode(array("code"=>2,'msg'=>"登陆失败"));
    	}
    }
}