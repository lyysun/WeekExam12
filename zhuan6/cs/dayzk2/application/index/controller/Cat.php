<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Cat extends Controller
{

	function index(){

		$catList=Db::query("select *,concat(path,'-',cat_id) as depath from tp_cat order by depath");
		// dump($catList);die;
  		foreach ($catList as $key => $v) {
  			if($v['is_show']==1){
  				$catList[$key]['is_show']='<img src="images/yes.gif">';
  			}else{
  				$catList[$key]['is_show']='<img src="images/no.gif">';
  			}
  		}
		$this->assign('catList',$catList);
		return view();
	}
  function add(){
  	if($_POST){

  		$data=input('post.');
  		$parent_id=$data['parent_id'];
  		if($parent_id!=0){
               $where['cat_id']=$parent_id;
               $fpath=Db('tp_cat')->where($where)->value('path');
               // dump($fpath);die;
               $data['path']=$fpath.'-'.$parent_id;
               

  		}else{
  			$data['path']=0;
  		}

  		$res=Db('tp_cat')->insert($data);
  		if($res){
  			$this->success('添加成功',url('index'));
  		}


  	}else{

  		  $data=Db('tp_cat')->select();
  		  $arr=nodedg($data);
  		  $this->assign('arr',$arr);
  		  return view();
  	}
  }

}