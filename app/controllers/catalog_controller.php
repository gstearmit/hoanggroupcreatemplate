<?php
class CatalogController extends AppController{
	var $name='Catalog';
	var $uses=array('Catalog');

	function index(){
			$this->paginate = array('limit' => '10','order' => 'Catalog.id DESC');
		$this->set('Catalog',$this->paginate('Catalog',array()));
		
	}
	
	
	function ctcatalog($id=null){
				
		return $this->Catalog->find('all',array('conditions'=>array('Catalog.id'=>$id)));
	}
	

	
	
}