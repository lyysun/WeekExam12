<?php
include("Db.php");

class model{

	protected $_pdo=null;

	public function __construct(){
			 $db= Db::getInstance();
		
         	$this->_pdo = $db::connect();
      
	}
	//封装添加add
	public function add($table,$data){

          $name=array_keys($data);
             
         $values=array_values($data);
         $name=implode(',', $name);
         $values=implode("','", $values);
         $sql="insert into $table ($name)"." values ('$values')";
         // var_dump($sql);die;
         return $this->_pdo->exec($sql);
        

	}
   //查询
	public function select($table){
		$sql="select * from $table";
		return $this->_pdo->query($sql)->fetchall();

	}

	//修改
	public function update($table,$data,$id){
           $res='';
           foreach ($data as $key => $value) {
                 $res.= $key."= '".$value."',";
           }

           $res=substr($res, 0,-1);
        
          
		$sql="update $table set $res where id=$id";
		 return $this->_pdo->exec($sql);
	}

	//删除
	public function delete($table,$field='*',$id){
		$sql="delete $field from $table where id=$id";
		return $this->_pdo->exec($sql);
	}

}


?>