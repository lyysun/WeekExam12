<?php
namespace app\index\controller;
use think\Db;
use think\Controller;


class Index extends Controller
{
    public function index()
    {
       return view();
    }

    function aaa(){
    	$data['user']=$_POST['user'];
    	$data['pwd']=$_POST['pwd'];

        $info=Db::table('user3')->where($data)->select();
       
        if(!empty($info)){
        	echo json_encode(array("code"=>'1',"msg"=>'success'));
        }else{
        	echo json_encode(array("code"=>'0',"msg"=>'error'));
        }
    }

}
