<?php
class Registrationshop extends AppModel {
    var $name = 'Registrationshop';//ten cua mode bang contacts
	var $useTable = 'shops';	
	
	var $belongsTo = array(
        'Tems' => array(
            'className' => 'Tems',
            'foreignKey' => 'shop_id'
        )
    );
}
?>
