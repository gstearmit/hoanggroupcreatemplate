<?php
class ServiceController extends AppController{
	var $name='Service';
	var $uses=array('Service');

	function index(){
		
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '10','order' => 'Service.id DESC');
		$this->set('Service',$this->paginate('Service',array()));
		
	}
	
	
	function ctservice($id){
		$data=array("css"=>"style2");
		$this->set("data",$data);
		
		$this->set('Service',$this->Service->find('all',array('conditions'=>array('Service.id'=>$id))));
	}
	
	function service1($id=null){
	
		//return $this->Service->find('all', array('limit'=>'2,5', 'order'=>'New.created DESC'));
		return $this->Service->find('all', array('conditions'=>array("id <> $id"),'limit'=>'10', 'order'=>'Service.created DESC'));
	
	}
}