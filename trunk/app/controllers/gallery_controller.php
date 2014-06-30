<?php
class GalleryController extends AppController{
	var $name='Gallery';
	var $uses=array('Gallery');

	function index($id=null){
	
		$this->set('Gallery',$this->Gallery->find('all',array('conditions'=>array('Gallery.id'=>$id),'order' => 'Gallery.id DESC')));
		
	}
}