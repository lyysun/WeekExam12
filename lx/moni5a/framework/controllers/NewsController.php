<?php 
namespace app\controllers;
use app\models\NewsModel;
 

class NewsController{
	
	private $_model;

	public function __construct(){
	
		$this->_model=new NewsModel();

	}

	public function newsList(){

		  $data=$this->_model->getNewsAll();
          return view("list",["list"=>$data]);
	}
   
	public function newsDetail(){
          $id=$_GET['id'];
		  $data=$this->_model->getNewsById($id);
		       $this->_model->setClicksById($id);
          return view("detail",["list"=>$data]);
	}
    

}

?>