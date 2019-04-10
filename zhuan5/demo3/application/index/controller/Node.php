<?php
namespace app\index\controller;
use app\index\controller\Rbac;
class Node extends Rbac
{
    public function index()
    {
       return view('index');
    }
}
