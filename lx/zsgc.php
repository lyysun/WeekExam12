<?php


class Db{

       public $pdo=null;

      function __construct(){
             $dsn="mysql:host=127.0.0.1;dbname=x2.5";
             $this->pdo=new PDO($dsn,"root","root");

      }

     function insert($sql){
     	     
             $res=$this->pdo->exec($sql);
             if($res){
             	return 1;
             }

     }
     
     function show($sql){

         $res=$this->pdo->query($sql)->fetchAll();
         // var_dump($res);die;/
         return $res;
     }

     function jth($sql){
        // var_dump($sql);die;

      $res=$this->pdo->query($sql)->fetch();
         return $res;

     }


   

     


}
