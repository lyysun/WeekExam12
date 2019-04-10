<?php

class Db{

	private static $_instance=null;
	private static $_pdo=null;
	private function __construct(){

	}
	private function __clone(){

	}

	public static function getInstance(){
		if(!self::$_instance instanceof Db){
			return self::$_instance=new Db();
		}
		return self::$_instance;
	}

	public static function connect(){
        if(!self::$_pdo==null){
        	return self::$_pdo=new PDO("mysql:host=;dbname=","","");

        }
        return self::$_pdo;
	}
}