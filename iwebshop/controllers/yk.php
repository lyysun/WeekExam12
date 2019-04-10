<?php 

class YK extends IController{

	function dtss(){
       
       $address=$_POST['addr'];
        $ak="fZAQ5GXps6eyzh88eCoOjH1kDUMwe06u";
		$url="http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak=$ak";
		//curl获取
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data=curl_exec($ch);
		// var_dump($data);die;
		$data=json_decode($data,true);

		$lng=$data['result']['location']['lng'];//经度
		$lat=$data['result']['location']['lat'];//维度
		$a=new IModel("seller");
		$arr=array(
			"lng"=>$lng,
			"lat"=>$lat,

			);
		// $a->setData($arr);
		// $a->add();
		
		//传到前台
		echo json_encode($arr);

	}
}

?>