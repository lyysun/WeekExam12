<?php

class Db{
         //私有的静态属性 私有的构造方法  私有的克隆方法  公共的静态方法
         private static $_instance=null;
          
         private static $_pdo=null;

         private function __construct(){

         }

         private function __clone(){

         }
         // 公共的静态方法
         public static function getInstance(){
              // 判断是否实例化过
         	if(!self::$_instance instanceof Db){
         		self::$_instance =new Db();//实例化 Db
         	}
            //如果实例化过的Db 就直接输出
         	return self::$_instance;   
         }
         
         //数据库连接

         public static function connect(){
            //私有的pdo 是否为空
         	if(self::$_pdo == null){

         		self::$_pdo = new PDO("mysql:host=127.0.0.1;dbname=x2.5","root","root");
         	}
            return self::$_pdo;
         }


}



 ?>