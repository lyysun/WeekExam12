<?php
class DAY3 extends IController{

	function add(){
		$this->redirect("add");
	}

	function dtss(){
		$address=$_POST['addr'];
		$ak="fZAQ5GXps6eyzh88eCoOjH1kDUMwe06u";
		$url="http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak=$ak";
		$data=file_get_contents($url);
		$data=json_decode($data,ture);
		$lng=$data['result']['location']['lng'];
		$lat=$data['result']['location']['lat'];
		$arr=array(
              "lng"=>$lng,
              "lat"=>$lat
			);
		echo json_encode($arr);
	}



}