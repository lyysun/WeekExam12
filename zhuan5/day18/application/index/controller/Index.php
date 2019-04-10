<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()
    {           $data=$this->request->param();
    	        $bt="";
    	        $page=1;
    	      if(isset($data['bt']) && !empty($data['bt'])){
    	      	$bt=$data['bt'];
    	       }
    	        if(isset($data['page']) && !empty($data['page'])){
    	      	$page=$data['page'];
    	       }
    	      $day18=new IndexModel();
    	      $data=$day18->select($page,$bt);
    	      $page=$data->render();
    	      $this->assign('page',$page);
    	      $this->assign('data',$data);
             return view('index');
    
    }

    function delall(){
    	$data=$this->request->param();
    	// dump($data);die;

       $bt="";
    	        $page=1;
    	      if(isset($data['bt']) && !empty($data['bt'])){
    	      	$bt=$data['bt'];
    	       }
    	        if(isset($data['page']) && !empty($data['page'])){
    	      	$page=$data['page'];
    	       }

    	$ids=$data['id'];
    	$day18=new IndexModel();
    	$res =$day18->delall($ids);
    	$data=$day18->select($page,$bt);
    	// dump($data);die;
    	  $page=$data->render();
    	$this->assign('data',$data);
    	 $this->assign('page',$page);
    	 return view('ajax');
    	// echo $res;die;
    }

     // public function ajax()
     //  {           
    	//       $day18=new IndexModel();
    	//       $data=$day18->select();
    	//       $page=$data->render();
    	//       $this->assign('page',$page);
    	//       $this->assign('data',$data);
     //         return view('ajax');
    
     // }



}
