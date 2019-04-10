<?php
   namespace app\index\model;
   use think\Model;
   use think\Db;
   use think\Request;
   class UserModel extends Model{
   	    function  adds($data){
   	        return Db::table('user')->insert($data);
        }
        function selects(){
   	        return Db::table('user')->paginate(5);

        }

        function deletes($id){
   	        return Db::table('user')->where('id',$id)->delete();
        }
//       public function update($id,$arr)
//       {
//           return Db::table('user')->where('id', $id)->update($arr);
//       }
   }