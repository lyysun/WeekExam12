<?php 
include("api.php");

if(api::sign($_REQUEST) == false){

   return api::status([],500,"no");
}
return api::status();
    
?>