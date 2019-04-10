<?php

class DAY6 extends IController{
	function dt(){
		$this->redirect("dt");
	}

	function dtss(){
		$address=$_POST['addr'];
		// echo $address;die;
		$ak="fZAQ5GXps6eyzh88eCoOjH1kDUMwe06u";
		$url="http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak=$ak";
		$data=file_get_contents($url);
		$data=json_decode($data,ture);
		// var_dump($data);die;
		$lng=$data['result']['location']['lng'];
		$lat=$data['result']['location']['lat'];
		$arr=array(
               "lng"=>$lng,
               "lat"=>$lat,
			);
		echo json_encode($arr);
	}
}