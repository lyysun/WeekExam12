<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Brand extends Controller
{
     function index(){

     	$brand_name=input('brand_name');
     	$pid=input('pid');
     	$where['brand_name']=array('like',"%$brand_name%");
     	
     	$brandList=Db('tp_brand')->where($where)->paginate(3);
     	$page=$brandList->render();
     	$brandList=$brandList->toArray();
     	$brandList=$brandList['data'];
     	// dump($brandList);
     	foreach ($brandList as $key => $val) {
     		if($val['is_show']==1){
     			$brandList[$key]['is_show']='<img src="images/yes.gif" >';
     		}else{
     			$brandList[$key]['is_show']='<img src="images/no.gif" >';
     		}
     	}
        if(request()->isAjax()){
        	$result['data']=$brandList;
        	$result['page']=$page;
        	return json($result);
        }
         $this->assign("page",$page);
     	$this->assign('brandList',$brandList);
     	return view();
     }

     function add(){

	     	if($_POST){
                $data=input('post.');
                $file="brand_logo";
                $info=$this->upload($file);
                // dump($info);die;
                if($info){
                     $data['brand_logo']=$info;
                     $res=Db('tp_brand')->insert($data);
                     if($res){
                     	$this->success('添加成功',url('index'));
                     }else{
                     	$this->error('添加失败');
                     }


                }else{
                	$this->error('上传失败');
                }


	     	}else{
                 $catList=Db('tp_brand')->select(); 
                 $cat=nodedg($catList);
                 $this->assign('cat',$cat);   
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


		function del(){
		 $data=$this->request->param();
		 // dump($data);die;
		  $ids=$data['ids'];
	     	$str=implode(",",$ids);
			$res=Db('tp_brand')->where("brand_id in($str)")->delete();
			if($res){
			echo "1";
			}else{
				echo "0";
			}
		}

		function dell(){
			$data=$this->request->param();
			// dump($data);
			$id=$data['brand_id'];

			$res=Db("tp_brand")->delete($id);
			if($res){
				$this->success('成功');
			}

		}


}