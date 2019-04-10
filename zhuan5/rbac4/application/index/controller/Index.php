<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
             return view ('index');
      
    }
    
}
