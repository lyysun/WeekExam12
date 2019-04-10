<?php 


class DAYZ1M extends IController{

	function dtss(){
		$address=$_POST['addr'];
		$ak="fZAQ5GXps6eyzh88eCoOjH1kDUMwe06u";
		$url="http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak=$ak";
		$data=file_get_contents($url);
		$data=json_decode($data,ture);
		// echo "<pre>";
		// echo var_dump($data);
	    $lng=$data['result']['location']['lng'];
	    $lat=$data['result']['location']['lat'];
	    $arr=array(
	    	"lng"=>$lng,
	    	"lat"=>$lat,
	    	);
	    echo json_encode($arr);
	}

	function add_do(){
		$name=IReq::get("name");
		$pwd=IReq::get("pwd");
		$addr=IReq::get("addr");
        $res=new IModel("dayz1m");
        $arr=array(
               "name"=>$name,
               "pwd"=>$pwd,
               "addr"=>$addr,
        	);
        $res->setData($arr);
        $a=$res->add();
        if($a){
        	$this->redirect("show");
        }

	}


	function show(){
		$data=new IModel("dayz1m");
		$res=$data->query();
		$this->setRenderData(['res'=>$res]);
		$this->redirect("show");
	}
} 