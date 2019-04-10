<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Controller;
class Rbac extends Controller
{
	function _initialize(){
		echo "这是权限控制";
	}
	
}