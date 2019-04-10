<?php 


class DB{


	function __construct(){

		  $dsn="mysql:host=127.0.0.1;dbname=x2.5";
          $pdo=new PDO($dsn,"root","root");

	   }

	   function insert($table,$array){
          $sql="insert into news (title,nr,zz,num) vlaues ('')"

	   }


}