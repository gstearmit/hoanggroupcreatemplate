<?php
class EquipmentController extends AppController{
	var $name='Equipment';
	var $uses=array('Equipment');

	function index(){
		
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '10','order' => 'Equipment.id DESC');
		$this->set('Equipment',$this->paginate('Equipment',array()));
		
	}
	
	
	function ctEquipment($id){
		$data=array("css"=>"style2");
		$this->set("data",$data);
		
		$this->set('Equipment',$this->Equipment->find('all',array('conditions'=>array('Equipment.id'=>$id))));
	}
	
	function part_ner(){
	
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '15','order' => 'Equipment.id DESC');
		return $this->paginate('Equipment',array());
	
	}
	
	
	
}