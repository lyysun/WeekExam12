<?php

$arr=[
      [
            "id"=>1,
            "name"=>'女装',
            "pid"=>0
      ],
      [
            "id"=>2,
            "name"=>'女裤子',
            "pid"=>1
      ],
       [
            "id"=>3,
            "name"=>'女裙子',
            "pid"=>1
      ],
      [
            "id"=>4,
            "name"=>'男装',
            "pid"=>0
      ],

];


function a($arr,$pid=0){
  $list=[];
    foreach ($arr as $k => $v) {
    	    if($v['pid']==$pid){

               $v['hz']=a($arr,$v['id']);
               $list[]=$v;
            

            }

    	  
    }
     
    return $list;

}
var_dump(a($arr));


?>