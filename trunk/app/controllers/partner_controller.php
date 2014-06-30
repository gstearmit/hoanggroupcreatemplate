<?php
class PartnerController extends AppController{
	var $name='Partner';
	var $uses=array('Partner');

	function index(){
		
		$this->paginate = array('limit' => '10','order' => 'Partner.created ASC');
		$this->set('Partner',$this->paginate('Partner',array()));
		
	}
	
	
	function ctpartner($id){
		$data=array("css"=>"style2");
		$this->set("data",$data);
		
		$this->set('Partner',$this->Partner->find('all',array('conditions'=>array('Partner.id'=>$id))));
	}
	
	function part_ner(){
	
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '15','order' => 'Partner.id DESC');
		return $this->paginate('Partner',array());
	
	}
	
	
	
}