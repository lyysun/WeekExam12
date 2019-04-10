<?php 

/**
* 
*/
namespace app\models;
use app\models\DBHelp;

class NewsModel extends DBHelp
{
	
        public function getNewsAll(){

             $data=$this->select("select * from news");
             return $data;
         
        } 
         public function getNewsById($id){
        	$sql="select * from news where id=$id";
            return $this->select($sql);
        }
         public function setClicksById($id){
        	$sql="update news set num=num+1 where id=$id";
            return $this->save($sql);
        }
    }

?>