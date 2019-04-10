<?php
   namespace app\index\model;
   use think\Model;
   use think\Db;
   use think\Request;
   class UserModel extends Model{
   	    function  adds($data){//添加
   	        return Db::table('user')->insert($data);
        }
        function selects(){//展示
   	        return Db::table('user')->paginate(5);

        }

        function deletes($id){//删除
   	        return Db::table('user')->where('id',$id)->delete();
        }


        function get_one($id){
          $sql="select * from user where id={$id}";
          return $this->query($sql);
        }

        function updatedo($id,$userName){
          $sql="update user set userName='$userName' where id={$id}";
          return $this->query($sql);

        }
     
   }