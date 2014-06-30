<?php
class MapController extends AppController{
	var $name='Map';
	var $uses=array('Map','Catproduct');
	
	function index($catMap_id=null)
	{
		$this->paginate = array('conditions'=>array('catMap_id'=>$catMap_id,'status'=>1),'limit' => '15','order' => 'Map.created DESC');
		$this->set('Map',$this->paginate('Map',array()));
		
		
	}
	
	function prarent_Map($id=null){
		
		 $row=$this->Map->find('all',array('conditions'=>array('Map.id'=>$id)));

		$catMap_id=$row[0]['Map']['catMap_id'];
		
	
		return $this->Map->find('all',array('conditions'=>array('Map.catMap_id'=>$catMap_id,'NOT'=>array('Map.id'=>$id))));
		
	}

	
	function search($search_Map=null){

		$search_Map = isset($_POST['search_Map'])?$_POST['search_Map']:'';
		
		$this->paginate = array('conditions'=>array('Map.status'=>1,'Map.title like'=>'%'.$search_Map.'%'),'limit'=>4);
		$this->set('prod', $this->paginate('Map',array()));
		$this->set('txt',$search_Map);
		$this->set('result', $this->Map->getNumRows());
		
	}
	
	
	function search_eg($search_Map=null){
		
		$search_Map = isset($_POST['search_Map'])?$_POST['search_Map']:'';
		$this->paginate = array('conditions'=>array('Map.status'=>1,'Map.title_eg like'=>'%'.$search_Map.'%'),'limit'=>9);
		$this->set('prod', $this->paginate('Map',array()));
		$this->set('result', $this->Map->getNumRows());
		$this->set('txt',$search_Map);
		$this->render('search');
	}
	
	
	function spnb(){
		
		return $this->Map->find('all',array('conditions'=>array('Map.display'=>1),'limit'=>20));
		
	}
	

	
	
}


