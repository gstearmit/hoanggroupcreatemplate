<?php
class AboutController extends AppController{
	var $name='About';
	var $uses=array('About');
	function index($id=null)
	{
		$this->set('About',$this->About->find('all',array('conditions'=>array('About.status'=>1,'About.id'=>$id))));
		
		
	}
	

	
}