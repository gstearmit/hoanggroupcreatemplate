<?php
class City extends AppModel {
    var $name = 'City';
	var $belongsTo = array( 
					'Classifiedss' => array(
							'className'     => 'Classifiedss', 
							'foreignKey'    => 'id' 				 
												 
					)
	 ); 
}
?>
