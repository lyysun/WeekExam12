<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
          function index(){
           if(I('get.brand_name')){
           	$where['brand_name']=I('get.brand_name');
           }

          $User = M('brand'); // 实例化User对象
          $count      = $User->where($where)->count();// 查询满足要求的总记录数
          $Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
          $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
          $data = $User->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
          $this->assign('data',$data);// 赋值数据集$this->assign('page',$show);// 赋值分页输出
          $this->assign('page',$show);
          $this->display(); // 输出模板
          }

          function add(){

          	$this->display();
          }

          function insert(){
          	 $data=I("post.");
             $file=$_FILES['brand_logo'];
             $fileInfo=$this->upload($file);
             if($fileInfo){
             	$data['brand_logo']=$fileInfo;

                $data['m_code'] = md5_file('.'.$fileInfo);
            	$where['m_code'] = $data['m_code'];
            	// dump($where['m_code']);
            	//验证图片是否重复
            	$code = M("brand")->where($where)->find();
            	// dump($code);die;
            	if($code){
            		$this->error("品牌logo重复");
            	}
            	

             	$res=M('brand')->add($data);
             	if($res){
             		 $this->success("品牌添加成功",U('index'));
             		}else{
             			 $this->error("品牌添加失败");
             		}

             }

          }

          public function upload($file){  
            $upload = new \Think\Upload();// 实例化上传类   
             $upload->maxSize   =     3145728 ;// 设置附件上传大小    
           
           $upload->autoSub = true;
           $upload->subName = array('date','Y/m/d');
             $upload->exts      =     array('jpg', 'png');// 设置附件上传类型    
             $upload->rootPath="./";
             $upload->savePath  =      '/Public/Uploads/'; // 设置附件上传目录    // 上传文件     
             $info   =   $upload->uploadOne($file);    
             if(!$info) {// 上传错误提示错误信息        
             $this->error($upload->getError());    
             }else{// 上传成功        
             	return $info['savepath'].$info['savename'];  
               }
             }
}