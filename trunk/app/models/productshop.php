<?php
class Productshop extends AppModel {
    var $name = 'Productshop'; 
	var $belongsTo = array( 
					'Userscms' => array(
							'className'     => 'Userscms', 
							'foreignKey'    => 'user_id' 				 
												 
					),
					'Categoryshop' => array(
							'className'     => 'Categoryshop', 
							'foreignKey'    => 'categoryshop_id' 				 
												 
					),
					'Shop' => array(
							'className'     => 'Shop', 
							'foreignKey'    => 'shop_id' 				 
												 
					)
	 ); 
}
?>
