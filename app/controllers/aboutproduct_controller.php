<?php 
class AboutproductController extends AppController{
	
	var $name='Aboutproduct';
	var $uses=array();
	function index()
	{
		$this->set("data",array('css'=>'style2'));
	
	}
	
}


?>