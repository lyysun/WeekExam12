<?php 
$a=file_get_contents("./view/show.html");
// var_dump($a);
$b=str_replace('{$title}', "李子豪", $a);
// var_dump($b);
$b=str_replace('{$con}', "初中", $b);

file_put_contents('show-1.html',$b);
?>


