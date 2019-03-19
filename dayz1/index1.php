<?php 

include("Student.php");
$a1=new Student("lyy1",1);
$a2=new Student("lyy2",2);

$a3=new Student("lyy3",3);

$a4=new Student("lyy4",4);

$a5=new Student("lyy12",12);

$a6=new Student("lyy6",6);

$a7=new Student("lyy7",7);

$a8=new Student("lyy8",8);

echo obj(8);

function obj($n){

	for ($i=1; $i <= $n ; $i++) { 
		$c="a".$i;
		global $$c;
	}

	$max=1;
	for ($i=1; $i <= $n; $i++) { 
		$a="a".$i;
		$b="a".$max;
		if($$a->_age > $$b->_age){
			$max=$i;
		}
	}

	$c="a".$max;
	return "最高的name,最高的age----".$$c->_name.",".$$c->_age;
}


?>