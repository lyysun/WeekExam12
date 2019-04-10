<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
    public function index(){
    	// echo "111";
    	if(I('get.brand_name')){//所搜
    		$where['brand_name']=I('get.brand_name');
    	}
        $User = M('brand'); // 实例化User对象
        $count      = $User->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
         $this->assign('page',$show);
        $this->assign('list',$list);// 赋值数据集$this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    function add(){
    	 $this->display();
    }

    function insert(){
    	$data=I('post.');
    	$file=$_FILES['brand_logo'];
    	// dump($file);die;
    	$fileInfo=$this->upload($file);
    	// dump($fileInfo);die;
    	if(!$fileInfo){
               $data['brand_logo']=$fileInfo;
               
               //去重
               $data['m_code']=md5_file('.'.$fileInfo);
               $where['m_code']=$data['m_code'];
               $code=M('brand')->where($where)->find();
               if($code){
               	$this->error('上传logo重复');
               }
               $res=M('brand')->add($data);
               if($res){
               	$this->success('添加成功',U('index'));
               }else{
               	$this->error("添加失败");
               }


    	}else{
    		$this->error('上传失败');
    	}

    }

    public function upload($file){
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3145728 ;// 设置附件上传大小   
        $upload->autoSub = true;
        $upload->subName = array('date','Y/m/d');
         $upload->exts      =     array('jpg', 'png');// 设置附件上传类型  
          $upload->rootPath="./" ;
          $upload->savePath  =      '/Public/Uploads/'; // 设置附件上传目录    // 上传单个文件   
            $info   =   $upload->uploadOne($file);  
              if(!$info) {// 上传错误提示错误信息       
               $this->error($upload->getError());   
                }else{// 上传成功 获取上传文件信息       
                  echo $info['savepath'].$info['savename'];  
                    }
                }

                function xg(){//修改
                	$id=I('get.id');
                	$name=I('get.name');
                	$data['brand_desc']=$name;
                	$res=M('brand')->where("brand_id=$id")->save($data);
                	if($res){
                		echo "修改成功";
                	}
                }


}