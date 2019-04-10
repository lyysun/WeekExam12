<?php
namespace app\admin\controller;
use think\Controller;
class Brand extends Controller
{
         function index(){

            $brandList=Db('tp_brand')->paginate(3);
            $page=$brandList->render();
            $brandList=$brandList->toArray();
             // dump($brandList);
            $brandList=$brandList['data'];
            // dump($brandList);
             if(request()->isAjax()){
                     $result['data']=$brandList;
                     $result['page']=$page;
                     return json($result);
             }

            foreach ($brandList as $key => $val) {
                   if($brandList[$key]['is_show']==1){
                         $brandList[$key]['is_show']=  '<img src="images/yes.gif">';
                   }else{
                     $brandList[$key]['is_show']=  '<img src="images/no.gif">';
                   }
            }
            $this->assign('page',$page);
            $this->assign('brandList',$brandList);
         	return view();
         }
         function add(){
         	if($_POST){
         		$data=input('post.');
         		// dump($data);die;
               $file="brand_logo";
               $data['brand_logo']=$this->upload($file);
               $res=Db('tp_brand')->insert($data);
               // echo $res;die;
               if($res){
                  $this->success('添加成功',url('index'));
               }else{
                  $this->error('添加失败');
               }


         	}else{
         		return view();
         	}
         	
         }

         public function upload($f){
   // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file($f);
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
       
        return $info->getSaveName();
       
    }else{
        // 上传失败获取错误信息
        echo $file->getError();
    }
}


      function xg(){
        $data=input('get.');
        // dump($data);
        // return $data;
        $brand_id=$data['brand_id'];
        // return $id;
       
        $data['brand_name']=$data['brand_name'];
        $res=Db('tp_brand')->where("brand_id= $brand_id")->update($data);
        // return $res;
        if($res){
          echo "1";
        }
      }

}