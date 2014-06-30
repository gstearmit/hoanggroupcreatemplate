<?php
class GuestController extends AppController{
	var $name='Guest';
	var $uses=array('Guest');

	function index(){
		
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '10','order' => 'Guest.id DESC');
		$this->set('Guest',$this->paginate('Guest',array()));
		
	}
	
	
	function ctguest($id){
		$data=array("css"=>"style2");
		$this->set("data",$data);
		
		$this->set('Guest',$this->Guest->find('all',array('conditions'=>array('Guest.id'=>$id))));
	}
	
	function part_ner(){
	
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '15','order' => 'Guest.id DESC');
		return $this->paginate('Guest',array());
	
	}
	
	
	
}