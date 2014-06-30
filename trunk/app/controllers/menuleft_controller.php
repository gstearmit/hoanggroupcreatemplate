<?php
class MenuleftController extends AppController{
	var $name='Menuleft';
	var $uses=array('Product','Catproduct');

	
	function submenuproduct($id=null){
	
		return $this->Catproduct-> find('all',array('conditions'=>array('Catproduct.status'=>1,'Catproduct.parent_id '=>$id),'order'=>'Catproduct.name ASC'));
	}
	
	function cap1($id=null){
	
		return $this->Catproduct-> find('all',array('conditions'=>array('Catproduct.status'=>1,'Catproduct.id '=>$id)));
	}
	
	
	function getproduct($id=null)
	{
		return $this->Product->find('all',array('conditions'=> array('catproduct_id'=>$id),'order'=>'title ASC'));
	}
	
}