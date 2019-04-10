<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class UserModel extends Model
{
        private $pageSize=2;
        function add($userName,$password){
       $sql="insert into user (userName,password) values('$userName','$password')";
       return $this->execute($sql); 
        }

        function getUserList($uname){
        	$sql="select count(*) as count from user where userName like '%$uname%'";
        	 
            $data=$this->query($sql);
            $count=$data[0]['count'];
            // echo $count;die;
            $map['userName']=['like',"%$uname%"];
            $list = Db::name('user')->where($map)->paginate($this->pageSize,$count);
            return $list;
        }
        function deletes($id){
        	$sql="delete from user where id={$id}";
        	return $this->query($sql);
        }
        //批删
        function del_all($ids){
            $str=implode(',',$ids);
            $sql="delete from user where id in ($str)"; 
            return $this->execute($sql);
        }
        function updates($id){
        	$sql="select * from user where id={$id}";
        	return $this->query($sql);
        }

        function updatedos($id,$data){
        	return Db::table('user')->where('id',$id)->update($data);
        	//$sql="update user set userName="$userName" where id={$id}"";
        	//return 	return $this->query($sql);
        }

        function getAuthsByUserId($tuserId){
            $sql="select user.id as userId,node.* from user left join userrole on user.id=userrole.userId left join rolenode on userrole.roleId=rolenode.roleId left join node on rolenode.nodeId=node.id where user.id={$userid}";
                $res=$this->query($sql);
                //租转最外层的

                $controller=array();
                 $methods=array();
                if(isset($res) && !empty($res)){
                    foreach ($res as $item) {
                        if($item['pid']==0){
                       $controller[$item['id']]=$item;
                    }else{
                        $methods[$item['pid']][]=$item;
                    }


                    }
                }

                $auths=array();
                if(isset($controller) && !empty($controller)){
                    foreach ($controller as $id => $con) {
                        if(isset($methdos) && !empty($methdos)){
                            foreach ($methdos as $pid => $meth) {
                                if ($id==0) {
                                    # code...
                                }
                            }
                        }
                    }
                }
                // array(
                //     "user"=>array('add','update'),
                //     'role'=>array('add','update'),
                //     'node'=>array('add',),
                //     )
               
                
        }
        
        
}