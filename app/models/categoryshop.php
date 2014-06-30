<?php
class Categoryshop extends AppModel {
    var $name = 'Categoryshop';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $hasMany = array(
        'Productshop' =>
        array('className' => 'Productshop',
                         'conditions'    => array('Productshop.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'categoryshop_id',
                         'dependent'     => true,
                         'exclusive'     => false,
                         'finderQuery'   => '',
                         'fields'        => '',
                         'offset'        => '',
                         'counterQuery'  => ''
    )
	);
}
?>
