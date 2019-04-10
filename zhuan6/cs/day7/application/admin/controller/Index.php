<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
         $list = Db('tp_brand')->paginate(2);
// 把分页数据赋值给模板变量list

// 渲染模板输出
           $page = $list->render();

      $this->assign('list', $list);

        
        return view();
    }
     public function add()
    {
    
        return view();
    }
}
