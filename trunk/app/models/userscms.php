<?php
class Userscms extends AppModel {
    var $name = 'Userscms';
    var $displayField = 'name';
	var $hasMany = array(
        'Shops' =>
         array('className' => 'Shops',
                         'conditions'    => '',
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'user_id',
                         'dependent'     => true,
                         'exclusive'     => false,
                         'finderQuery'   => '',
                         'fields'        => '',
                         'offset'        => '',
                         'counterQuery'  => ''
    ),
	'Tems' =>
	 array('className' => 'Tems',
							 'conditions'    => '',
							 'order'         => '',
							 'limit'         => '',
							 'foreignKey'    => 'user_id',
							 'dependent'     => true,
							 'exclusive'     => false,
							 'finderQuery'   => '',
							 'fields'        => '',
							 'offset'        => '',
							 'counterQuery'  => ''
		),
	
	);
}
?>
