<?php
class ManualController extends AppController{
	var $name='Manual';
	var $uses=array('Manual');

	function index(){
		
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '10','order' => 'Manual.id DESC');
		$this->set('Manual',$this->paginate('Manual',array()));
		
	}
	
	
	function ctManual($id){
		$data=array("css"=>"style2");
		$this->set("data",$data);
		
		$this->set('Manual',$this->Manual->find('all',array('conditions'=>array('Manual.id'=>$id))));
	}
	
	function part_ner(){
	
		$data=array("css"=>"style2");
		$this->set("data",$data);
		$this->paginate = array('limit' => '15','order' => 'Manual.id DESC');
		return $this->paginate('Manual',array());
	
	}
	
	
	
}