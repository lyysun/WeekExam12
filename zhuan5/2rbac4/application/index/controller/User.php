<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\controller\Rbac;
class User extends Rbac
{
         function index(){
         	echo "index";
         }
         function add(){
         	echo "add";
         }
}
    