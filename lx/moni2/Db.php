<?php 

class Db{
       
        private static $_pdo=null;
        private static $_instance;

        public static function getInstance(){
          if(!self::$_instance instanceof Db ){
           return self::$_instance=new Db();

          }
          return self::$_instance;
        }

      public static function connect(){
        if(self::$_pdo==null){
        	return self::$_pdo= new PDO("mysql:host=127.0.0.1;dbname=x2.5","root","root");

        }
        return self::$_pdo;

      }


}

?>