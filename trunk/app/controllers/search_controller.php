<?php
class SearchController extends AppController {

	var $name = 'Search';
	var $uses='Product';
	function search($title=null) {
		//list danh sach tin tuc
		mysql_query("SET names utf8");		
		$this->set('title_for_layout', 'Sản phẩm tìm thấy- Giày Thành Trung');
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.title like'=>'%'.$title.'%'),'order'=>'Product.id DESC');
   		$this->set('products', $this->paginate('Product',array()));//News la ten model cua bang news
		
		
		
		
		//$this->set('products',$this->Product->find('all',array('conditions'=>array('Product.status'=>1,'Product.title like'=>'%'.$title.' %'),'order'=>'Product.id DESC')));
	}
	
}
?>
