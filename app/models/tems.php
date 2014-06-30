<?php
class Tems extends AppModel {
    var $name = 'Tems';//ten cua mode bang contacts
	var $belongsTo = array( 
					'Shops' => array(
							'className'     => 'Shops', 
							'foreignKey'    => 'shop_id' 				 
												 
					),	
					'User' => array(
							'className'     => 'User', 
							'foreignKey'    => 'user_id' 				 
												 
					)
	 ); 
	 
	
}
?>
