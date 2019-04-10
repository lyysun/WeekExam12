<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class UserModel extends Model
{
         private $size=2;
         function add($data){
         	return Db::table('user')->insert($data);
         }

         function select($name){
         $sql="select count(*) as count from user where username like '%$name%'";
         // echo $sql;die;
         $data=$this->query($sql);
         $count=$data[0]['count'];
          $map['username']  = ['like',"%$name%"];
         $data=Db::name('user')->where($map)->paginate($this->size,$count);
         return $data;
         }
         function deletes($id){//删除数据
		return Db::table('user')->where('id',$id)->delete();
	     }
           function delall($ids){
            $str=implode(',',$ids);
            $sql="delete from user where id in($str)";
            // echo $sql;die;
            return $this->query($sql);
           }

	     function get_one($id){
	     	return Db::table('user')->where('id',$id)->find();
	     }

	     function updates($id,$data){
         return Db::table('user')->where('id',$id)->update($data);
	     }

       function status($id,$status){
        $sql="update user set status='$status' where id='$id'";
        // echo $sql;die;
        return $this->query($sql);
       }
           
          
           // function addUserRole($uid,$roleId){
           //      $sql="delete from userRole where userId={$uid}";
           //      $this->query($sql);
           //      $sql="insert into userRole(userId,roleId) values('$uid','$roleId')";
           //      $this->execute($sql);
           //      $sql="select last_insert_id()";
           //      $id=$this->query($sql);
           //      return $id;

           //   }

}