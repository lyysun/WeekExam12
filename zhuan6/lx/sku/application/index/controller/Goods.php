<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Goods extends Controller
{
         function index(){
             
             $goodsList=Db('tp_goods')
                          ->field("goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_new,is_hot")
                          ->select();
            // dump($goodsList);

         
            //判断是否有货品组合
             foreach ($goodsList as $key => $val) {
                       $goods_id=$val['goods_id'];

                       $num=Db('tp_attr')
                            ->alias('a')
                            ->join('tp_good_attr g','a.attr_id=g.attr_id')
                            ->where("attr_index=0 and attr_input_type>0 and goods_id=$goods_id")
                            ->count(); 
                             // dump($num);   
                    if($num>0){
                      $goodsList[$key]['product']=1;
                    }else{
                      $goodsList[$key]['product']=0;
                    }
             }
             // dump($goodsList);
              $this->assign('goods_id',$goods_id);
              $this->assign('goodsList',$goodsList);

          return view();
        
         }

        
        //商品咧表添加

           function product(){
            if($_POST){
                    $data=input('post.');
                    $goods_id=$data['goods_id'];
                    $product=$data['product'];
                    //处理数组
                    foreach ($product as $key => $val) {
                      $product[$key]['goods_id']=$goods_id;
                      $product[$key]['attr_list']=implode(',',$val['attr_list']);
                    }
                    $res=Db('tp_product')->insertAll($product);
                    if($res){
                      $this->success('添加成功',url('pindex',['goods_id'=>$goods_id]));
                    }else{
                      $this->error('添加失败');
                    }

            }else{
                
                 $goods_id=input('goods_id');
                  //查看商品名称和货号
                 $goodsList=Db('tp_goods')
                            ->field('goods_name,goods_sn')
                            ->where("goods_id=$goods_id")
                            ->find();
                  $this->assign('goodsList',$goodsList);
                //查看商品属性
                  $attrList=Db('tp_attr')
                            ->alias('a')
                            ->join('tp_good_attr g','a.attr_id=g.attr_id')
                            ->field('g.attr_id,goods_attr_id,attr_value,attr_name')
                            ->where("attr_index=0 and attr_input_type>0 and goods_id=$goods_id")
                            ->select(); 
                   // dump($attrList);

             foreach ($attrList as $key => $val) {
            
             $attr[$val['attr_id']]['attr_name'] = $val['attr_name'];
             $attr[$val['attr_id']]['attr_value'][$val['goods_attr_id']] = $val['attr_value'];
            
          }
          // dump($attr);
                $this->assign('attr',$attr);
                $this->assign('goods_id',$goods_id);
              return view();
            }
           }



         
         //展示添加的属性名称
         function pindex(){
          $goods_id=input('goods_id');
          $productList=Db('tp_product')->where("goods_id=$goods_id")->select();
          // dump($productList);
          //处理属性
          foreach ($productList as $key => $val) {
           
           $in['goods_attr_id']=array('in',$val['attr_list']);
           $attrList=Db('tp_attr')
                                ->alias('a')
                                ->join("tp_good_attr g","a.attr_id=g.attr_id")
                                ->field("attr_name,attr_value")
                                ->where($in)
                                ->select();
                  $str='';
                  foreach ($attrList as $k => $v) {
                   $str.=$v['attr_name'].':'.$v['attr_value'].'<br>';
                   // $str.=$v['attr_name'].":".$v['attr_value'].'<br>';
                  }
                  $productList[$key]['attrInfo']=$str;
          }
          $this->assign('productList',$productList);
          $this->assign("goods_id",$goods_id);
          return view();
         }

         //状态修改
         function xg(){
          $data=input('get.');
          // return $data;
          $id=$data['goods_id'];
          $data['is_on_sale']=$data['is_on_sale'];
          $res=Db('tp_goods')->where("goods_id=$id")->update($data);
          if($res){
            echo "1";
          }else{
            echo "0";
          }
         }
























































        // function pindex(){
        // 	$goods_id=input('goods_id');
        // 	$productList=Db('tp_product')->where("goods_id =$goods_id")->select();
        //     //处理属性
        //     foreach ($productList as $key => $val) {
        //       $in['goods_attr_id']=array("in",$val['attr_list']);
        //       $attrList=Db('tp_attr')
        //                   ->alias('a')
        //                   ->join("tp_good_attr g","a.attr_id =g.attr_id")
        //                   ->field("attr_name,attr_value")
        //                   ->where($in)
        //                   ->select();
        //       $str='';
        //     foreach ($attrList as $key => $v) {
        //        $str.=$v['attr_name'].':'.$v['attr_value']."<br>";
        //       }
        //     $productList[$key]['attrinfo']=$str;
        //     }

        //     dump($productList);
        // 	$this->assign('productList',$productList);
        // 	$this->assign('goods_id',$goods_id);
        // 	return view();
        // }



   









         function add(){
         	if($_POST){
               
                $data = input("post.");
             // dump($data);
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
         		$catList=Db::query("select *,concat(path,'-',cat_id) as depath from tp_cat order by depath");
         		$this->assign('catList',$catList);
                 //商品品牌
         		$brandList=Db('tp_brand')->select();
         		$this->assign('brandList',$brandList);
         		//商品的类型
         		$typeList=Db('tp_type')->select();
         		$this->assign('typeList',$typeList);

         		return view();
         	}
         }

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



}