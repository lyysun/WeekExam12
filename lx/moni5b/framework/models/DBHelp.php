<?php 
 namespace app\models;

class DBHelp{
	private $_pdo;
	public function __construct(){
		$this->_pdo=new \PDO("mysql:host=127.0.0.1;dbname=x2.5","root","root");
    }

    public function add2($sql){
         return $this->_pdo->exec($sql);
    }
      public function save($sql){
         return $this->_pdo->exec($sql);
    }

      public function del($sql){
         return $this->_pdo->exec($sql);
    }

      public function select($sql){
         return $this->_pdo->query($sql)->fetchall();
    }

}
?>