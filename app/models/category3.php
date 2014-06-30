<?php
class Category3 extends AppModel {
    var $name = 'Category3';//ten cua mode bang contacts
	var $useTable = 'categories';	
	var $hasMany = array(
		'Product' => array(
		'className' => 'Product',
		'foreignKey' => 'category_id',
		'conditions' => array('Product.status' => '1'),
		'limit' => '4',
		'order' => 'Product.created DESC',
		'dependent'=> true
		)
	); 
}
?>
