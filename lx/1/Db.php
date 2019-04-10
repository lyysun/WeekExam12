<?php 


class Db{

	      private static $_instance=null;//定义一个私有的 空值储存
	      private static $_db=null; //定义一个私有的 空值储存
     //私有的构造方法
      private function __construct(){
            
           if(self::$_db==null){
                //链接数据库
             	self::$_db=new PDO("mysql:host=127.0.0.1;dbname=x2.5","root","root");
		    }

		    return self::$_db;
       }
       
        //私有的克隆方法
	  private function __clone(){

	    }

   //公共的静态方法
    public static function getInstance(){
    	    // 判断是否实例化
           if(!self::$_instance instanceof Db){
            	self::$_instance = new Db();
           }
           return self::$_instanoe;
       }

    //定义查找的方法
    public function show(){
    	$sql="select * from news ";
    	return self::$_db->query($sql)->fetchAll();
    
     }


   }

?>