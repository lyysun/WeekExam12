<?php

class curl{

	function curl1($url){
	$data=curl_init();
	curl_setopt($data,CURLOPT_URL,$url);
	curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
	return $res=curl_exec($data);
 }
}


