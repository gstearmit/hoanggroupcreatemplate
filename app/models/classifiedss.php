<?php
class Classifiedss extends AppModel {
    var $name = 'Classifiedss'; 
	var $belongsTo = array( 
					'Userscms' => array(
							'className'     => 'Userscms', 
							'foreignKey'    => 'user_id' 				 
												 
					),
					'City' => array(
							'className'     => 'City', 
							'foreignKey'    => 'id' 				 
												 
					),
					'Catproduct' => array(
							'className'     => 'Catproduct', 
							'foreignKey'    => 'scop_id' 				 
												 
					)
	 ); 
}
?>
