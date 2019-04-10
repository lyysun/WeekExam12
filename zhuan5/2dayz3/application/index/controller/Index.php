<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()
    { 
    	
    	 // dump($session[0]);die;
    	
    
        return view();
    }
    function dl(){
    	// dump($_GET);die;
    	$data['name']=$_GET['name'];
    	$data['pwd']=$_GET['pwd'];
    	$res=Db('2dayz3_u')->where($data)->select();
    	// dump($res);die;
    	if($res){
    		Session::set('res',$res);
           

    		echo "yes";

    	}else{
    		echo "no";
    	}

    }

   function show(){
           $session=Session::get('res');
          // dump($session);die;
           if($session[0]['name']=="普通用户"){
		           	$a=new IndexModel();
		            $data=$a->selects();
		        // dump($data);die;
		            $this->assign('data',$data);
		            return view();
           }elseif($session[0]['name']=="超级用户"){
           	   	$a=new IndexModel();
		            $data=$a->sel();
		        // dump($data);die;
		            $this->assign('data',$data);
		            return view('show');
          
           }else{
           	$this->error("对不起，无权限访问");
           }


        
   }



}
