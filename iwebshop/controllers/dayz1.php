<?php
class DAYZ1 extends IController{
	//根据经纬度查位置
	function dtss(){
		$address=$_POST['addr'];
		$ak="fZAQ5GXps6eyzh88eCoOjH1kDUMwe06u";
		$url="http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak=$ak";
	    $data=file_get_contents($url);
	    $data=json_decode($data,ture);

	    // echo "<pre>";
	    // var_dump($data);die;
	    $lng=$data['result']['location']['lng'];
	    $lat=$data['result']['location']['lat'];
	    $arr=array(
                "lng"=>$lng,
                "lat"=>$lat,
	    	);
	    echo json_encode($arr);

	}
//注册信息
	function add_do(){
		$name=IReq::get("name");
		$pwd=IReq::get("pwd");
		$tel=IReq::get("tel");
		$addr=IReq::get("addr");
		$data=new IModel("dayz1m");
		$arr=array(
                "name"=>$name,
                "pwd"=>$pwd,
                
                "addr"=>$addr,
                "tel"=>$tel,
			);
		$data->setData($arr);
		$res=$data->add();
		if($res){
			$this->redirect("show");
		}
	}
//展示用户信息
	function show(){
			$data=new IModel("dayz1m");
			$res=$data->query();
			// var_dump($res);
			$this->setRenderData(['res'=>$res]);
			$this->redirect("show");
	}
}