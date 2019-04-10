<?php 
class MONI1 extends IController{
   
   
   function add_do(){
       $name=IReq::get('name');
	   	  $zname=IReq::get('zname');
	      $gz=IReq::get('gz');
        $a=new IModel("moni1");
        $arr=array(
              "name"=>$name,
              "zname"=>$zname,
              "gz"=>$gz,
        	);
        $a->setData($arr);
        $res=$a->add();

        if($res){
        	$this->redirect("login");
        }
   } 
      function login_do(){

         $name=IReq::get('name');
         $pwd=IReq::get('pwd');
         $a=new IModel("moni1");
         $data=$a->query("name='$name' and pwd='$pwd'");
         echo "<pre>";
         // var_dump($data);
         $id=$data[0]['id'];
         ICookie::set("id",$id);  //cookie存id
         if($data){
           $this->redirect("show");
         }
      }
  

       function show(){
      
        //在登陆的时候存的id
        $id=ICookie::get("id");
        // echo $id;die;
        $a=new IModel("moni1");

          if($id==1){//判断是否是管理员

             $data=$a->query();
             $this->admin="admin";
       
          }else{
                $a=new IModel("moni1");
                 $data=$a->query("id=$id");
            
             }

       $this->setRenderData(["res"=>$data]);
       $this->redirect("show");

       }



    function ss(){
      //redis缓存+搜索

	     $name=IReq::get('name');
       // echo $name;
    	$redis=new Redis();
    	$redis->connect("127.0.0.1","6380");
      $nm=$redis->get("nm");
         // echo $nm;die;
        if($nm==$name){
          echo "redis";
	    	  $this->setRenderData(["res"=>$nm]);
	    	  $this->redirect("ss");
	    	 
        }else{

	    	$a=new IModel("moni1");
	    	$data=$a->query("name like'%$name%'");
	        // var_dump($data);die;
	    	$redis->set("nm",$data);
	    	$this->setRenderData(["res"=>$data]);
	    	$this->redirect("ss");
      
      }
    } 

    //下载到数据库
    function excel_do(){
       //PHPExcel存如数据库

        include_once("public/Classes/PHPExcel.php");
        $file=$_FILES['file'];
        
        $name=$file['name'];
        $tmp_name=$file['tmp_name'];
        $img="upload/img/".$name;
        move_uploaded_file($tmp_name,$img);
        $excel=PHPExcel_IOFactory::load("$img");
        $data=$excel->getActiveSheet()->toArray();
        // var_dump($data);die;
         echo "<pre>";

         unset($data[0]);
        
          $a=new IModel("moni1");

         foreach ($data as $key => $v) {
          
             $arr=array(
              "name"=>$v[0],
              "gz"=>$v[3],
              
               );
          $a->setData($arr);
          $res=$a->add();
         }
         if($res){
          $this->redirect("show");
         }

    }

    function excel_out(){
      // echo "1";die;
      $ip=$_SERVER['REMOTE_ADDR'];//获去本地ip
      $time=date("Y-m-d H:i:s");
      // echo $time;die;
      $id=ICookie::get("id");
      // echo $id;die;
      $a=new IModel("moni1");
      $data=$a->query("id=$id");   //根据id查询操作详情
      foreach ($data as $key => $v) {
        // var_dump($v);die;
         $arr=array(
              "ip"=>$ip,
              "name"=>$v['name'],
              "gz"=>$v['gz'],
              "time"=>$time,
          );

         $add=new IModel("g");
         $add->setData($arr);
         $add->add();
      }




      //数据库导出

        $model=new IModel("moni1");
        $data=$model->query();
        // var_dump($data);die;
        $report=new report();//导出数据库
        $report->setTitle(array("用户名","工资"));
        foreach ($data as $key => $v) {
         
                $arr=array(
                    "name"=>$v['name'],
                    "gz"=>$v['gz'],
                  );
                $report->setData($arr);
        }
        $report->toDownload();
    }
   

}

?>