<?php
namespace Home\Controller;
use Think\Controller;
class HxController extends Controller {
	function show(){
		$Day6hx=M('day6hx');
		$data=$Day6hx->select($data);
		$this->assign('data',$data);
		$this->display();
	}
}