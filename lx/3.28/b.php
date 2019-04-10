<?php 


$gifts = [
                [
                    "name"=>"mac",
                    "prop"=>1
                ],
                [
                    "name"=>"红米",
                    "prop"=>10
                ],
                [
                    "name"=>"u盘",
                    "prop"=>40
                ],
                [
                    "name"=>"香皂",
                    "prop"=>49
                ]
            ];

$num='';
foreach ($gifts as $key => $v) {
	     $num +=$v['prop'];
	     
}
var_dump($num);

?>