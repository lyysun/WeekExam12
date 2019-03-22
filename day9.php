<?php

var_dump(a([3,32,321]));
function a($n){
       rsort($n);
       $str=implode('',$n);
       return $str;

    }

?>