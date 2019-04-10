<?php

 include("Person.php");
 $a1=new Person("lyy1",124);

 $a2=new Person("lyy2",121);

 $a3=new Person("lyy3",122);

 $a4=new Person("lyy4",123);

 $a5=new Person("lyy5",120);

 $a6=new Person("lyy6",129);

 $a7=new Person("lyy7",128);

 $a8=new Person("lyy8",12);



  echo obj(8);
function obj($n){

	for ($i=1; $i <= $n ; $i++) { 
	     $c="a".$i;
	     global $$c;   //设置全局 变量
	}

	$max = 1;
	for ($i=1; $i <= $n ; $i++) { 

	      $a="a".$i; 
	      $b="a".$max; //定义个最大 对象的 （假设）

        if ($$a->_age > $$b->_age) {
	        $max = $i;
	      }
	}

    //去=取得实例化 对象的名字；
	$c="a".$max;
	
	return $$c->_name.$$c->_age;
}


?>