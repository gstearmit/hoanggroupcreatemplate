<?php
class Category2 extends AppModel {
    var $name = 'Category2';//ten cua mode bang contacts
	var $useTable = 'categories';
	
	var $hasMany = array(
		'Product' => array(
		'className' => 'Product',
		'foreignKey' => 'category_id',
		'conditions' => array('Product.status' => '1','Product.rank' => '1'),
		'limit' => '8',
		'order' => 'Product.created DESC',
		'dependent'=> true
		)
	); 
}
?>
