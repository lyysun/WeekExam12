<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\IndexModel;
class Index extends Controller
{
	function index(){
		return view();
	}
	function ajax(){
		$data=$this->request->param();
		$name='';
		if(isset($data['name']) && !empty($data['name'])){
			$name=$data['name'];
		}
		$a=new IndexModel();
		$data=$a->selects($name);
		

        $json=json_encode($data);    //json 数据
	    $this->assign('json',$json);
          // dump($json);die;
		
		$data=$a->selects($name);
		$page=$data->render();
		// dump($page);die;
		// $page=json_encode($page);
        // $data=json_encode($data);
		$this->assign('page',$page);
		
		return view('ajax');
	}

	function del(){
		$data=$this->request->param();
		// dump($data);die;
		$ids=$data['ids'];
		$a=new IndexModel();
		$res=$a->dels($ids);
		// echo $res;die;
		if($res){
			echo json_encode(array('code'=>2,'res'=>'删除成功'));
		}else{
			echo json_encode(array('code'=>1,'res'=>'删除失败'));
		}
		// dump($res);die;
	}
    
}
