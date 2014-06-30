<?php
class NewsController extends AppController{
	var $name='News';
	var $uses=array('New','Category');

	function index($category_id=null){
	
		$this->paginate = array('conditions'=>array('category_id'=>$category_id),'limit' => '6','order' => 'New.created DESC');
		$this->set('new',$this->paginate('New',array()));
		$this->set('category',$this->Category->find('all',array('conditions'=>array('id'=>$category_id))));
		$this->set('li','home');
	}
	
	
	function ctnews($id=null){
		
		$this->set('new',$this->New->find('all',array('conditions'=>array('New.id'=>$id,'New.status'=>1))));
		
		$this->set('listnew',$this->New->find('all',array('conditions'=>array('New.status'=>1))));
		$this->Session->write('li','home');
		//$this->set('li','home');
		
	}

	function news_new(){
	
		return $this->New->find('all', array('conditions'=>array('New.category_id'=>'205'),'limit'=>'0,20', 'order'=>'New.created DESC'));
		
	}
	function km_new(){
	
		return $this->New->find('all', array('conditions'=>array('New.category_id'=>'206'),'limit'=>'0,20', 'order'=>'New.created DESC'));
		
	}
	
	
	function news2_new(){
	
		return $this->New->find('all', array('conditions'=>array('New.category_id'=>'205'),'limit'=>'0,2', 'order'=>'New.created DESC'));
		
	}
	function news3_new(){
	
		return $this->New->find('all', array('conditions'=>array('New.category_id'=>'205'),'limit'=>'2,5', 'order'=>'New.created DESC'));
		
	}


	
	function news3($id=null){
	
		$category=$this->New->find('all',array('conditions'=>array('id'=>$id)));
		foreach ($category as $category){
			$id_cat=$category['New']['category_id'];
		}
		 
		return $this->New->find('all', array('conditions'=>array('AND'=>array('New.category_id'=>$id_cat,"id <> $id")),'limit'=>'10', 'order'=>'New.created DESC'));
	
	}
	
	function get_category($id){
		return $this->Category->find('all',array('conditions'=>array('id'=>$id)));
	
	}
	}