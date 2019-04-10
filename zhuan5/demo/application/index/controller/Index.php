<?php
namespace app\index\controller;
use app\index\controller\Rbac;
/**
 * 首页控制器
 */
class Index extends Rbac
{
    public function index()
    {
    	return view('index');
    }
}
