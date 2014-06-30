<?php
class OrderController extends AppController{
	var $name='Order';
	var $uses=array();
	function index()
	{
		$this->set("data",array('css'=>'style2'));
		
	}
	
}