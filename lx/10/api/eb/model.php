<?php 
include("Db.php");

class model{

     protected $_db=null;

     protected $_fields='*';
     protected $_table='';
     protected $_where='';

     protected $_order="";
     protected $_join="";
     protected $_limit='';
     protected $_group="";
     
      //首先执行构造方法
      public function __construct(){
      	// 实例化 Db 
      	$db= Db::getInstance();
      	// 连接数据库
      	$this->_db = $db::connect();

        $name=get_called_class();//调用表名
        $this->_doTableName($name);//调用修改好的格式


      }
    //实例化表名
     public function _doTableName($name){

           $upper=range("A", "Z");
           $str2=$name[0];//首字母不加下滑线
           $len=strlen($name);
           for ($i=1; $i < $len ; $i++) { 
                 $m=$name[$i];//判断$m是否在数组中
                 if (in_array($m,$upper)) {
                          $str2.="_".$m;
                 }else{
                  //不是大写的话 不用加下划线
                  $str2.=$m;
                 }
           }
           $str2=strtolower($str2);
           //拼接成表名的形式 (user_name)
           $this->_table=$str2;
        }
   
    
      public function fields($fields){
      	$this->_fields = $fields; 
      	return $this; 
      }
      

        public function table($table){
        $this->_table = $table;
        return $this; 
      }
         

      public function join($table,$join,$dir="inner"){
                $str =$dir." join ".$table." on ".$join;
                $this->_join=$str;

                return $this;

        } 

       
       public function group($group){
            $str=" group by ".$group;
            $this->_group=$str;
            // var_dump($str);die;
            return $this;

       }

        public function where($where){
      
      	$sql=" where ";
        foreach ($where as $key => $v) {

               $sql .= $key." = '". $v."' and ";

           }
           $sql=substr($sql,0,-4);
           $this->_where= $sql;
          
      	return $this; 
      }


      public function order($field,$order="asc"){
        $str=" order by ".$field." ".$order;
        // echo $str;die;
        $this->_order=$str;
        return $this;


      }

      public function limit($limit,$offset= 0){
               $str = ' limit '.$offset.",".$limit;
               // echo $str;die;
               $this->_limit=$str;
               return $this;
      }
      

      public function select(){
      	 $sql="select ".$this->_fields." from ".$this->_table." ".$this->_join." ".$this->_group." ".$this->_where." ".$this->_order.' '.$this->_limit;
         // if($this->_where){

           // $sql .= " where ".$this->_where;

            // $sql .= " where ";
           // foreach ($this->_where as $key => $v) {
           //     $sql .= $key." = '". $v."' and ";

           // }
           // $sql=substr($sql,0,-4);
           
         // }
         // echo $sql;die;
      	 return $this->_db->query($sql)->fetchAll();
      }

      public function find(){
         $sql="select ".$this->_fields." from ".$this->_table." ".$this->_join." ".$this->_group." ".$this->_where." ".$this->_order.' '.$this->_limit;
         return $this->_db->query($sql)->fetch();
      }


    public function add($values){
        

           $field=array_keys($values);
           $values=array_values($values);
          
           $field=implode(",",  $field);
           $values=implode("','",  $values);

           $sql="insert into ".$this->_table."(".$field.") values('".$values."')";
          
           return $this->_db->exec($sql);

      }

      public function update($values){
           $data='';
           foreach ($values as $key => $value) {
                 $data.= $key."= '".$value."',";
           }
           $data=substr($data, 0,-1);
        

           $sql="update ".$this->_table." set ".$data.$this->_where;
          return $this->_db->exec($sql);
          
      }

      public function delete(){
        $sql="delete from ".$this->_table.$this->_where;
       return $this->_db->exec($sql);
      }


}


?>