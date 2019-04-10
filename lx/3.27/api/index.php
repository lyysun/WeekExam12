<?php 

 include("api.php");
 if(api::sign($_REQUEST) == false){
 	api::status('',500,'');
 }
 api::status();

?>