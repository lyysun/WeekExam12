<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Goods extends Controller
{
	 function index(){



	 	 $goodsList=Db('tp_goods')
	 	                ->field("goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_new,is_hot,goods_number")
	 	               ->select();
	 	  //判断有货品组合
	 	 foreach ($goodsList as $key => $val) {
	 	          $goods_id=$val['goods_id'];
	 	          $num=Db('tp_attr')
	 	                ->alias('a')
	 	                ->join("tp_good_attr g","a.attr_id = g.attr_id")
	 	                ->where("attr_index=0 and attr_input_type>0 and goods_id=$goods_id")
	 	                ->count();
	 	          if($num>0){
	 	          	$goodsList[$key]['product']=1;

	 	          }else{
	 	          	$goodsList[$key]['product']=0;
	 	          }
	 	 }
	 	 // dump($goodsList);
	 	 $this->assign('goodsList',$goodsList);
	 	 
	 	 return view();
	 }

      //商品的添加
        public function add(){
        if($_POST){

            $data = input("post.");
             // dump($data);die;
            $attr = $data['attr_value_list'];

            $data['add_time'] = time();
            $data['goods_sn'] = $this->createSn();
            //文件上传
            $fname = 'goods_img';
            $fpath = $this->upload($fname);
           
            if($fpath){
                $data['goods_img'] = $fpath['img'];
                $data['goods_thumb'] = $fpath['thumb'];
                $goodsId = Db::name("tp_goods")->strict(false)->insertGetId($data);
                if($goodsId){
                    
                    //多文件上传
                    $gname = "img_url";
                    $path = $this->uploadAll($gname);
                    $desc = $data['img_desc'];
                    foreach ($desc as $key => $val) {
                      $temp[$key]['goods_id'] = $goodsId;
                      $temp[$key]['img_desc'] = $desc[$key];
                      $temp[$key]['thumb_img'] = $path['thumb'][$key];
                      $temp[$key]['original_img'] =$path['img'][$key];
                    }
                    //入库至相册表
                    $res = Db::name('tp_gallery')->insertAll($temp);
                    if(!$res){
                        $this->error("添加失败2");
                    }
                    //入库至商品属性表
                    foreach ($attr as $key => $val) {
                     
                       if(is_array($val)){
                          //是数组
                          foreach ($val as $k => $v) {
                              $atemp['attr_id'] =$key;
                              $atemp['attr_value']=$v;
                              $atemp['goods_id'] =  $goodsId ;
                               //添加
                             $gres =  Db::name("tp_good_attr")->insert($atemp);
                            if(!$gres){
                                $this->error("添加失败3");
                            }
                          } 
                       }else{
                             //不是数组
                           $ntemp['attr_id'] = $key;
                           $ntemp['attr_value'] = $val;
                           $ntemp['goods_id'] =  $goodsId ;
                           //添加
                           $gres = Db::name("tp_good_attr")->insert($ntemp);
                           if(!$gres){
                                $this->error("添加失败4");
                            }
                       }
                      
                       
                    }
                    //添加成功
                    $this->success('添加成功',url('index'));

                }else{
                    $this->error("添加失败1");
                }
            }
            
        }else{
            //商品分类
            $catList = Db::query("select  *,concat(path,'-',cat_id) as depath from tp_cat order by depath");
            //商品品牌
            $brandList = Db::name("tp_brand")->select();
            //商品的类型
            $typeList = Db::name("tp_type")->select();
            $this->assign('typeList',$typeList);
            $this->assign('brandList',$brandList);
            $this->assign("catList",$catList);
        	return view();
        }
    }

           // 自动生成商品货号
          public function createSn(){
        //ECS 000030
        $goods_sn = 'ECS'.rand(100000,999999);
        echo $goods_sn;
        $res = Db::name("tp_goods")->where("goods_sn = '$goods_sn'")->find();
        if($res){
            //重复
            $this->createSn();
        }else{
          return $goods_sn;
        }
    }

         function upload($fname){
             // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file($fname);
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
            // 成功上传后 获取上传信息
            $fpath =  $info->getSaveName();   
            //入库的原图
            $data['img']   = $info->getSaveName();

            //生成缩略图
            
            //  ./uploads/    20181012\b9321f70cc66f09a6061a36304a8d5a5.jpg
            $path = './uploads/'.$fpath;
            //缩略图入库的路劲 20181012\thumb_b9321f70cc66f09a6061a36304a8d5a5.jpg
            $tpath = substr($fpath,0,8).'/thumb_'.substr($fpath,9);
            //生成缩略图
            $image = \think\Image::open($path);
            // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
            $image->thumb(150, 150)->save('./uploads/'.$tpath);
            $data['thumb'] = $tpath;

            return $data;
           
         }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }


     function uploadAll($f){
        // 获取表单上传文件
        $files = request()->file($f);
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $fpath = $info->getSaveName();
                // 成功上传后 获取上传信息
                $data['img'][] =  $info->getSaveName(); 
                //  ./uploads/    20181012\b9321f70cc66f09a6061a36304a8d5a5.jpg
                $path = './uploads/'.$fpath;
                //缩略图入库的路劲 20181012\thumb_b9321f70cc66f09a6061a36304a8d5a5.jpg
                $tpath = substr($fpath,0,8).'/thumb_'.substr($fpath,9);
                //生成缩略图
                $image = \think\Image::open($path);
                // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
                $image->thumb(150, 150)->save('./uploads/'.$tpath);
                $data['thumb'][] = $tpath;
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
           }    
        }
        return $data;
    }


	 //商品sku添加

     public function product(){
      if($_POST){
          $data = input("post.");
          // dump($data);
          $goods_id = $data['goods_id'];
          $product = $data['product'];
          //处理数组
          foreach ($product as $key => $val) {
             $product[$key]['goods_id'] =  $goods_id;
             $product[$key]['attr_list'] = implode(',',$val['attr_list']);

          }
          //添加多行
          $res = Db::name("tp_product")->insertAll($product);

          if($res){
                $this->success("添加成功",url('pindex',['goods_id'=>$goods_id]));
          }else{
                $this->error("添加失败");
          }
      }else{
          $goods_id = input("goods_id");
          $goodsInfo = Db::name('tp_goods')
                                          ->field('goods_name,goods_sn')
                                          ->where("goods_id = $goods_id")
                                          ->find();
          //查属性
          $attrList = Db::name('tp_attr') 
                                          ->alias('a')
                                          ->join('tp_good_attr g','a.attr_id = g.attr_id')
                                          ->field('g.attr_id,goods_attr_id,attr_name,attr_value')
                                          ->where("attr_index=0 and attr_input_type>0 and goods_id = $goods_id")
                                          ->select();
           // dump($attrList);
         //处理属性
          foreach ($attrList as $key => $val) {
            
             $attr[$val['attr_id']] ['attr_name'] = $val['attr_name'];
             $attr[$val['attr_id']]['attr_value'][$val['goods_attr_id']] = $val['attr_value'];
            
          }
          dump($attr);
           $this->assign('attr',$attr);
          $this->assign('goods_id',$goods_id);
          $this->assign('goodsInfo',$goodsInfo);
          
          return view();
      }
   }
        
        //商品sku展示
   public function pindex(){
      $goods_id = input("goods_id");
      $productList = Db::name("tp_product")->where("goods_id = $goods_id")->select();
      //处理属性
      foreach ($productList as $key => $val) {
         $in['goods_attr_id'] = array('in',$val['attr_list']);
         $attrList = Db::name('tp_attr')
                                        ->alias('a')
                                        ->join('tp_good_attr g','a.attr_id = g.attr_id')
                                        ->field('attr_name,attr_value')
                                        ->where($in)
                                        ->select();
         $str = '';
        foreach ($attrList as $k => $v) {
          $str.= $v['attr_name'].":".$v['attr_value'].'<br>';
         }
        $productList[$key]['attrinfo'] = $str;
      }
     
      $this->assign('productList',$productList);
      $this->assign('goods_id',$goods_id);
       return view();
   }

	
    }