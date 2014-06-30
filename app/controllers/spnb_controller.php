<?php
class SpnbController extends AppController{
	var $name='Spnb';
	var $uses=array('Spnb');
	
	function index($id=null)
	{


		$this->set("Spnb",$this->Spnb->find('all',array('conditions'=>array('Spnb.id'=>$id))));
		
	}
	
	
	
}


