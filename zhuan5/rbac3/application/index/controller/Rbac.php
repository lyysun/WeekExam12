<?php
namespace app\index\controller;

use think\Controller;
class Rbac extends Controller
{
	public function _initialize(){
		echo "在这里做权限控制";
		// $this->checkauth();
	}

	function checkauth(){
		$this->error('您没有权限');
	}
}