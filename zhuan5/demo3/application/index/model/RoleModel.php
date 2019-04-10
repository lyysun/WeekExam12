<?php
   namespace app\index\model;
   use think\Model;
   use think\Db;

   class RoleModel extends Model{
   	function adds($data){
   		return Db::table('role')->insert($data);
   	}

   	function selects(){
   		$sql="select * from role";
   		return $this->query($sql);
   	}
   	function deletes($id){
   		$sql="delete from role where id={$id}";
   		return $this->query($sql);
   	}
      
      function get_one($id){
         $sql="select * from role where id={$id}";
         return $this->query($sql);

      }
      function updatedo($id,$roleName){
         $sql="update role set roleName='$roleName' where id={$id}";
         return $this->query($sql);
      }


   	
   }