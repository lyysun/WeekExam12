<?php 

namespace app\index\controller;
use think\Controller;
/**
* 
*/
class Picture extends Controller
{
	
	function add(){

		return view("add");
	}
	function upload(){
              $file = request()->file('image');

              $info = $file->rule("md5")->move(ROOT_PATH . 'public' . DS . 'uploads');
              if ($info) {
                      $path=$info->getSaveName();
                      $path=str_replace("\\", "/", $path);
                
                      $res=Db("news")->where(['id'=>35])->update(["picture"=>$path]);
                      var_dump($res);die;

              }
	}
}


?>