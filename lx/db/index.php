<?php 
include("Person.php");
$a1=new Person("lyy1",12);
$a2=new Person("lyy2",12);

$arr=[
    "lyy1"=>12,
     "lyy4"=>15,

    "lyy2"=>13,
    "lyy3"=>14,
   
];

  

  foreach ($arr as $key => $value) {
     
     $arr1[]=['name'=>$key,"age"=>$value];


  }
 
 for ($i=1; $i < count($arr1) ; $i++) { 

   for ($j=count($arr1)-1; $j >=$i ; $j--) { 
     
           if($arr1[$j]['age'] < $arr1[$j-1]['age'] ){

                $t=$arr1[$j]['age'];
                $arr1[$j]['age']=$arr1[$j-1]['age'];
                $arr1[$j-1]['age']=$t;
              
		 }
      
   }
		 

 
 }

   print_r($arr1[count($arr1)-1]['age']);


?>