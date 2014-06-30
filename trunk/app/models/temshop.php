<?php
class Temshop extends AppModel {
    var $name = 'Temshop';//ten cua mode bang contacts
	var $useTable = 'tems';	
	var $belongsTo = array( 
					'Shops' => array(
							'className'     => 'Shops', 
							'foreignKey'    => 'tem_id' 				 
												 
					),	
					
					'User' => array(
							'className'     => 'User', 
							'foreignKey'    => 'user_id' 				 
												 
					),	
	 ); 
	
}
?>
