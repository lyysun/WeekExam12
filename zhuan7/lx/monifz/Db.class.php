<?php 

class Db{
	public $pdo;

	public function __construct(){
		$this->pdo=new PDO("mysql:host=127.0.0.1;dbname=zhuan7","root","root");

	}

	public function add($sql){
		return $this->pdo->exec($sql);
	}

	public function delete($sql){
		return $this->pdo->exec($sql);
	}


}

