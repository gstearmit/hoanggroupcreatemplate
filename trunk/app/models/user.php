<?php
class User extends AppModel {
    var $name = 'User';
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
