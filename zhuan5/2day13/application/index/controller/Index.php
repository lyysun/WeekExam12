<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\IndexModel;
class Index extends Controller
{
    public function index()//ajax单个搜索
    {  
        // dump($_GET);
        // $name='';
        $data=$this->request->param('name');
        // dump($data);die;
        // $name=$data['name'];die;
        //  $a= User::scope($name)->get();

    	$a=new IndexModel();
        $a=$a->selects($data);
    	$this->assign('a',$a);
    	return view();
     
    }
    function rq(){//人气
        $a=new IndexModel();
        $a=$a->sel();
        $this->assign('a',$a);
        return view('index');
    }


    function tp(){
    	$data=$this->request->param();
    	// dump($data);die;
    	$id=$data['id'];
    	// echo $id;die;
    	$sum=$data['sum'];
    	// echo $sum;die;
    	$a=new IndexModel();
    	$res=$a->up($id,$sum);
    	// echo $res;die;
    	if($res>0){
    		echo "yse";
    	}else{
    		echo "no";
    	}

    }
}
