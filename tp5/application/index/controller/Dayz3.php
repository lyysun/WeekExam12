<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\News as N;

class Dayz3 extends Controller{
	function index(){
		$title=input("title",'');
	    
	 	$Model = New N();
		$data=$Model->where("title","like","%$title%")->paginate(2,false,['query'=>["title"=>$title]]);
         

		if(!empty($title)){
			foreach ($data as $key => $v) {
			  $v['title'] = str_replace("$title","<font style='color:red;'>$title</font>",$v['title']);
			}  
		}
		
		$this->assign('data',$data);
		$this->assign('title',$title);
		return view("index");
	}

	function del(){
        $Model = New N();
		$id=input("get.id");
        $res= N::destroy($id);
       
         if ($res) {
         	echo json_encode(["code"=>1]);die;
         }
		
	}
	// 页面详情
	function detail(){
		$id=input('id');
		$model=new N();
		$data=$model->find($id);
         

		if($data['num']==5){
			$dir= APP_PATH.'../public/static/html/'; //查找存储的方法
			
	        $file=$dir.$id.'.html'; //拼接存储的名称

	        $jty=__DIR__.'/../view/dayz3/detail.html'; //找到存储的模板
	    
	        $html=file_get_contents($jty); //获取模板的内容
	        
	    	$html=str_replace('{$data.id}', $data['id'], $html);

	    	$html=str_replace('{$data.title}', $data['title'], $html);

	    	$html=str_replace('{$data.num}', $data['num'], $html);
	    	file_put_contents($file, $html); //写入模板中
		}
		return view('detail',["data"=>$data]);
	}

	function num(){
		$id=input("id");
		$user = N::get($id);
		$user->num     = $user->num+1;
		
		$user->save();
          echo json_encode(['code'=>1]);die;

	}

}
?>